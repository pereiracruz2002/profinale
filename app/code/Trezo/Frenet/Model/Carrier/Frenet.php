<?php
namespace Trezo\Frenet\Model\Carrier;

use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Trezo\Frenet\Model\Api\ServiceRequest;
use Magento\Shipping\Model\Tracking\ResultFactory;
use Magento\Shipping\Model\Tracking\Result\StatusFactory;
use Magento\Shipping\Model\Tracking\Result\ErrorFactory;

class Frenet extends AbstractCarrier implements CarrierInterface
{
    protected $_code = 'trezo_frenet';
    private $_httpClientFactory;
    private $_serviceRequest;
    protected $_rateMethodFactory;
    protected $_result;
    protected $_rates;
    protected $_trackFactory;
    protected $_trackStatusFactory;
    protected $_trackErrorFactory;
    protected $_freeMethod;
    protected $_shippingPrice;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,
        ResultFactory $trackFactory,
        ErrorFactory $trackErrorFactory,
        StatusFactory $trackStatusFactory,
        ServiceRequest $serviceRequest,
        array $data = []
    ) {
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
        $this->_httpClientFactory = $httpClientFactory;
        $this->_serviceRequest = $serviceRequest;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->rateResultFactory = $rateResultFactory;
        $this->_trackFactory = $trackFactory;
        $this->_trackStatusFactory = $trackStatusFactory;
        $this->_trackErrorFactory = $trackErrorFactory;
    }

    /**
     * Collect and get rates
     *
     * @param RateRequest $request
     * @return \Magento\Framework\DataObject|bool|null
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active') || !$this->getConfigFlag('token')) {
            return false;
        }

        $responseBody = $this->_doShipmentRequest($request);

        if ($responseBody['status']) {
            $freeBoxes = $this->getFreeBoxesCount($request);
            $this->setFreeBoxes($freeBoxes);

            $this->_shippingPrice = $this->getShippingPrice($request, $freeBoxes);
            $this->_result = $this->getQuotes($responseBody);
        }

        return $this->_result;
    }

    public function getShippingPricePerItem(RateRequest $request, $basePrice, $freeBoxes)
    {
        return $request->getPackageQty() * $basePrice - $freeBoxes * $basePrice;
    }

    /**
     * @param RateRequest $request
     * @param int $freeBoxes
     * @return bool|float
     */
    private function getShippingPrice(RateRequest $request, $freeBoxes)
    {
        $shippingPrice = false;
        $configPrice = 1;
        $shippingPrice = $this->getShippingPricePerItem($request, $configPrice, $freeBoxes);
        $shippingPrice = $this->getFinalPriceWithHandlingFee($shippingPrice);

        if ($shippingPrice !== false && (
                $request->getFreeShipping() === true || $request->getPackageQty() == $freeBoxes
            )
        ) {
            $shippingPrice = 0;
        }
        return $shippingPrice;
    }


    /**
     * @param RateRequest $request
     * @return int
     */
    private function getFreeBoxesCount(RateRequest $request)
    {
        $freeBoxes = 0;
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
                if ($item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }

                if ($item->getHasChildren() && $item->isShipSeparately()) {
                    $freeBoxes += $this->getFreeBoxesCountFromChildren($item);
                } elseif ($item->getFreeShipping()) {
                    $freeBoxes += $item->getQty();
                }
            }
        }
        return $freeBoxes;
    }

    /**
     * Do request to Frenet web service
     * @param \Magento\Framework\DataObject $request
     * @return Array
     */
    protected function _doShipmentRequest(\Magento\Framework\DataObject $request)
    {
        try {
            $client = $this->_httpClientFactory->create();
            $this->_serviceRequest->setRateRequest($request);
            $client->setUri($this->_serviceRequest->getUrl());
            $client->setHeaders($this->_serviceRequest->getHeaderRequest());
            $client->setRawData(json_encode($this->_serviceRequest->getParametersForQuotation()));
            $response = $client->request(\Zend_Http_Client::POST);
            if (!$response->isError()) {
                return ['status' => 1, 'response_message' => json_decode($response->getBody())];
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e);
            $response = $e;
        }

        return ['status' => 0, 'response_message' => $response->getMessage()];
    }

    /**
     * Check if the object has shipping price attribute
     * @param array responseBody
     * @return array
     */
    protected function checkShippingPrice($responseBody)
    {
        foreach ($responseBody['response_message']->ShippingSevicesArray as $key => $shippingService) {
            if (!isset($shippingService->ShippingPrice)) {
                unset($responseBody['response_message']->ShippingSevicesArray[$key]);
            }
        }
        return $responseBody;
    }

    /**
     * @param $responseBody
     * @return Result|\Magento\Framework\DataObject
     */
    protected function getQuotes($responseBody)
    {
        if (!isset($responseBody['response_message']->ShippingSevicesArray)) {
            return false;
        }

        $responseBody = $this->checkShippingPrice($responseBody);

        usort($responseBody['response_message']->ShippingSevicesArray, function ($optionA, $optionB) {
            return strcmp($optionA->ShippingPrice, $optionB->ShippingPrice);
        });

        if (isset($responseBody['response_message']->ShippingSevicesArray[0]->ServiceCode)) {
            $this->_freeMethod = $responseBody['response_message']->ShippingSevicesArray[0]->ServiceCode;
        }

        foreach ($responseBody['response_message']->ShippingSevicesArray as $shippingService) {
            if (isset($shippingService->ShippingPrice)) {
                $this->addRate($shippingService);
            }
        }

        $result = $this->rateResultFactory->create();

        if (!$this->_rates) {
            if ($this->getConfigData('show_specificerrmsg')) {
                return $this->getErrorMessage();
            }
            return null;
        }

        foreach ($this->_rates as $rateData) {
            $result->append($this->createRateObject($rateData));
        }

        return $result;
    }

    /**
     * @param $shippingService
     */
    protected function addRate($shippingService)
    {
        if (isset($shippingService->ServiceDescription) && isset($shippingService->ServiceCode)) {
            if ($this->_shippingPrice == 0) {
                if ($this->_freeMethod == $shippingService->ServiceCode) {
                    $price = $this->_shippingPrice;
                } else {
                    $price =  $shippingService->ShippingPrice;
                }
                $this->_rates[] = [
                    'service_code'   => $this->_code,
                    'service_title'  => $this->_serviceRequest->getMethodTitle($shippingService),
                    'service_method' => $shippingService->ServiceDescription,
                    'service_price'  => (float) $price,
                    'service_cost'   => (float) $price,
                    'service_shipping_code' => $shippingService->ServiceCode,
                ];
            } else {
                $this->_rates[] = [
                    'service_code'   => $this->_code,
                    'service_title'  => $this->_serviceRequest->getMethodTitle($shippingService),
                    'service_method' => $shippingService->ServiceDescription,
                    'service_price'  => (float) $shippingService->ShippingPrice,
                    'service_cost'   => (float) $shippingService->ShippingPrice,
                    'service_shipping_code' => $shippingService->ServiceCode,
                ];
            }
        }
        return $this;
    }


    /**
     * @param $serviceData
     * @return \Magento\Quote\Model\Quote\Address\RateResult\Method
     */
    protected function createRateObject($serviceData)
    {

        // var_dump($serviceData['service_shipping_code']);
        $method = $this->_rateMethodFactory->create();
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('name'));
        $method->setMethod(strtolower($serviceData['service_shipping_code']));
        $method->setMethodTitle($serviceData['service_title']);
        $method->setPrice($serviceData['service_price']);
        $method->setCost($serviceData['service_cost']);
        return $method;
    }

    /**
     * @return Error
     */
    protected function getErrorMessage()
    {
        $error = $this->_rateErrorFactory->create();
        $error->setCarrier($this->getCarrierCode());
        $error->setCarrierTitle($this->getConfigData('name'));
        $error->setErrorMessage($this->getConfigData('specificerrmsg'));
        return $error;
    }

    /**
     * Get allowed shipping methods
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->getCarrierCode() => $this->getConfigData('name')];
    }

    /**
     * Check if carrier has shipping tracking option available
     * All \Magento\Usa carriers have shipping tracking option available
     *
     * @return boolean
     */
    public function isTrackingAvailable()
    {
        return true;
    }

    /**
     * Get tracking information
     *
     * @param string $tracking
     * @return string|false
     * @api
     */
    public function getTrackingInfo($tracking)
    {
        $result = $this->getTracking($tracking);

        if ($result instanceof \Magento\Shipping\Model\Tracking\Result) {
            $trackings = $result->getAllTrackings();
            if ($trackings) {
                return $trackings[0];
            }
        } elseif (is_string($result) && !empty($result)) {
            return $result;
        }

        return false;
    }

    /**
     * Get tracking
     *
     * @param string|string[] $trackings
     * @return Result
     */
    public function getTracking($trackings)
    {
        if (is_array($trackings)) {
            $trackings = $trackings[0];
        }

        $client = $this->_httpClientFactory->create();
        $client->setUri($this->_serviceRequest->getTrackingUrl());
        $client->setHeaders($this->_serviceRequest->getHeaderRequest());
        $trackingResult = $this->_serviceRequest->getParametersForTracking($trackings);

        if (is_null($trackingResult['ShippingServiceCode'])) {
            return false;
        }

        $client->setRawData(json_encode($trackingResult));
        $response = $client->request(\Zend_Http_Client::POST);
        if (!$response->isError()) {
            $dataTracking = json_decode($response->getBody());
            $result = $this->_trackFactory->create();
            $dataResult = [];
            $packageProgress = [];

            if (isset($dataTracking->ErrorMessage)) {
                $error = $this->_trackErrorFactory->create();
                $error->setCarrier($this->_code);
                $error->setCarrierTitle($this->getConfigData('name'));
                $error->setTracking($trackings);
                $error->setErrorMessage($dataTracking->ErrorMessage);
                $result->append($error);
                $this->_result = $result;
                return $result;
            }

            if (isset($dataTracking->TrackingEvents)) {
                foreach ($dataTracking->TrackingEvents as $trackingInfo) {
                    $deliveryDate = explode(' ', $trackingInfo->EventDateTime);
                    $data = [];
                    $data['activity'] = $trackingInfo->EventDescription;
                    $data['deliverydate'] = str_replace('/', '-', $deliveryDate[0]);
                    $data['deliverytime'] = $deliveryDate[1];
                    $data['deliverylocation'] = $trackingInfo->EventLocation;
                    $packageProgress[] = $data;
                }
            }

            $dataResult['progressdetail'] = $packageProgress;

            if ($dataResult) {
                $tracking = $this->_trackStatusFactory->create();
                $tracking->setCarrier($this->_code);
                $tracking->setCarrierTitle($this->getConfigData('name'));
                $tracking->setTracking($trackings);
                $tracking->addData($dataResult);
                $result->append($tracking);
            }

            $this->_result = $result;
            return $result;
        }
    }
}
