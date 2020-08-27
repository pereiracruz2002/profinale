<?php
namespace Trezo\Frenet\Controller\Index;

use Trezo\Frenet\Model\Api\ServiceRequest;

class Index extends \Magento\Framework\App\Action\Action
{

    const COOKIE_NAME = 'zip-code';
    const COOKIE_DURATION = 86400;
    private $_httpClientFactory;
    private $_serviceRequest;
    protected $_cookieManager;
    protected $_cookieMetadataFactory;
    protected $_sessionManager;
    protected $_jsonHelper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\Session\SessionManagerInterface $sessionManager,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        ServiceRequest $serviceRequest
    ) {
        parent::__construct($context);
        $this->_httpClientFactory = $httpClientFactory;
        $this->_serviceRequest = $serviceRequest;
        $this->_cookieManager = $cookieManager;
        $this->_cookieMetadataFactory = $cookieMetadataFactory;
        $this->_sessionManager = $sessionManager;
        $this->_jsonHelper = $jsonHelper;
    }

    public function execute()
    {
        try {
            $data = $this->getRequest()->getParams();
            $metadata = $this->_cookieMetadataFactory
                        ->createPublicCookieMetadata()
                        ->setDuration(self::COOKIE_DURATION)
                        ->setPath($this->_sessionManager->getCookiePath())
                        ->setDomain($this->_sessionManager->getCookieDomain());
            $this->_cookieManager->setPublicCookie(self::COOKIE_NAME, $this->_serviceRequest->cleanPostcode($data['zipcode']), $metadata);

            $isCentimeters = $this->_serviceRequest->getDimensionToUse();
            if ($isCentimeters) {
                $produtData[] = [
                    'Weight' => (float) $data['weight'],
                    'Length' => (float) $data['length'],
                    'Height' => (float) $data['height'],
                    'Width'  => (float) $data['width'],
                    'Quantity' => (int) $data['quantity'],
                ];
            } else {
                $produtData[] = [
                    'Weight' => (float) $data['weight'],
                    'Length' => (float) ($data['length'] * 0.1),
                    'Height' => (float) ($data['height'] * 0.1),
                    'Width'  => (float) ($data['width']  * 0.1),
                    'Quantity' => (int) $data['quantity'],
                ];
            }

            $params = [
                'SellerCEP' => $this->_serviceRequest->getOriginPostcode(),
                'RecipientCEP' => $data['zipcode'],
                'ShipmentInvoiceValue' => ($data['price'] < 18 ? 18 : $data['price']),
                'ShippingItemArray' => $produtData,
            ];

            $client = $this->_httpClientFactory->create();
            $client->setUri($this->_serviceRequest->getUrl());
            $client->setHeaders($this->_serviceRequest->getHeaderRequest());
            $client->setRawData(json_encode($params));
            $response = $client->request(\Zend_Http_Client::POST);
            $result = [];
            $rates = [];
            $result = ['status' => 0, 'services' => 0, 'message' => $response->getMessage()];

            if (!$response->isError()) {
                $services = json_decode($response->getBody());
                if (isset($services->ShippingSevicesArray)) {
                    foreach ($services->ShippingSevicesArray as $shippingService) {
                        if (isset($shippingService->ShippingPrice)) {
                            $rates[] = [
                                'service_title'  => $this->_serviceRequest->getMethodTitle($shippingService),
                                'service_price'  => number_format($shippingService->ShippingPrice, 2, ',', '.'),
                            ];
                        }
                    }
                    $result = ['status' => 1, 'services' => $rates, 'message' => 1];
                }
            }
        } catch (\Exception $e) {
            $result = ['status' => 0, 'services' => 0, 'message' => __($e->getMessage())];
        }
        $this->getResponse()->representJson($this->_jsonHelper->jsonEncode(['result' => $result]));
        return;
    }
}
