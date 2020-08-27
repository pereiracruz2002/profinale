<?php
namespace Trezo\Frenet\Controller\Index;

use Trezo\Frenet\Model\Api\ServiceRequest;

class Tracking extends \Magento\Framework\App\Action\Action
{

    const TYPE_EMAIL = 'email';
    const TYPE_TAXVAT = 'taxvat';
    protected $_orderFactory;
    protected $_serviceRequest;
    protected $_httpClientFactory;
    protected $_data = array('success' => false, 'message' => null, 'content' => null);

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory,
        ServiceRequest $serviceRequest
    ) {
        parent::__construct($context);
        $this->_orderFactory = $orderFactory;
        $this->_serviceRequest = $serviceRequest;
        $this->_httpClientFactory = $httpClientFactory;
    }

    public function execute()
    {
        $orderNumber = $this->getRequest()->getParam('order_number');
        $customerInfo = $this->getRequest()->getParam('customer_info');

        if ($this->getRequest()->isAjax()) {
            $trackingData = $this->prepareTracking($orderNumber, $customerInfo);
            if ($trackingData['success']) {
                $trackingInfo = $this->getTrackingInfo($trackingData);
                $trackingInfo = json_encode($trackingInfo);
                echo $trackingInfo;
                return;
            }
            $trackingInfo = json_encode($this->_data);
            echo $trackingInfo;
            return;
        }
    }

    /**
     * Loads the product and checks if have shipping number
     *
     * @return array
     * @param $orderNumber order increment_id, $customerInfo Email|CPF|CNPJ
     **/
    public function prepareTracking($orderNumber, $customerInfo)
    {
        $order = $this->_orderFactory->create()->loadByIncrementId($orderNumber);
        if (!$order) {
            $this->_data['message'] = __('Order not found');
            return $this->_data;
        }

        $trackingInfo = $order->getTracksCollection()->getFirstItem();
        $trackNumber = $trackingInfo->getTrackNumber();

        if (!$trackNumber) {
            $this->_data['message'] = __('Does not have delivery');
            return $this->_data;
        }


        if (strstr($customerInfo, '@')) {
            if ($this->belongsToTheCustomer(self::TYPE_EMAIL, $order, $customerInfo)) {
                $this->_data['track_number'] = $trackNumber;
                $this->_data['success'] = true;
            }
        } else {
            if ($this->belongsToTheCustomer(self::TYPE_TAXVAT, $order, $customerInfo)) {
                $this->_data['track_number'] = $trackNumber;
                $this->_data['success'] = true;
            }
        }
        return $this->_data;
    }


    /**
     * Checks if this order belongs to the customer
     *
     * @return boolean
     * @param $type const TYPE_EMAIL|TYPE_TAXVAT, $order Order, $customerInfo Email|cpf|cnpj
     **/
    public function belongsToTheCustomer($type, $order, $customerInfo)
    {
        if ($type == 'email') {
            if ($order->getCustomerEmail() != $customerInfo) {
                $this->_data['message'] = __('This order does not belong to the customer');
                return false;
            }
            return true;
        }

        if ($order->getCustomerTaxvat() != $customerInfo) {
            $this->_data['message'] = __('This order does not belong to the customer');
            return false;
        }
        return true;
    }

    /**
     * Do request for get track info
     *
     * @return array
     * @param $trackingData array
     **/
    public function getTrackingInfo($trackingData)
    {
        $client = $this->_httpClientFactory->create();
        $client->setUri($this->_serviceRequest->getTrackingUrl());
        $client->setHeaders($this->_serviceRequest->getHeaderRequest());
        $trackingResult = $this->_serviceRequest->getParametersForTracking($trackingData['track_number']);

        if (is_null($trackingResult['ShippingServiceCode'])) {
            return false;
        }

        $client->setRawData(json_encode($trackingResult));
        try {
            $response = $client->request(\Zend_Http_Client::POST);
            if ($response->getStatus() == 200) {
                $this->_data['success'] = true;
                $this->_data['content'] = json_decode($response->getBody());
                return $this->_data;
            }
            $this->_data['success'] = false;
            $this->_data['message'] = __('There was a small internal error');
            return $this->_data;
        } catch (\Exception $e) {
            $this->_data['success'] = false;
            $this->_data['message'] = __('There was a small internal error');
            return $this->_data;
        }
    }
}
