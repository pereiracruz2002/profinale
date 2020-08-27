<?php
namespace Trezo\Frenet\Model\Api;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Trezo\Frenet\Model\Api\AbstractServiceRequest;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Sales\Model\Order\Shipment\TrackFactory;
use Magento\Sales\Model\OrderFactory;

class ServiceRequest extends AbstractServiceRequest
{

    public $rateRequest;
    public $trackFactory;
    public $orderFactory;

    const DEFAULT_LENGTH = 16;
    const DEFAULT_HEIGHT = 2;
    const DEFAULT_WIDTH  = 11;

    public function __construct(
        RateRequest $rateRequest,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        TrackFactory $trackFactory,
        OrderFactory $orderFactory
    ) {
        parent::__construct($scopeConfig, $storeManager);
        $this->rateRequest = $rateRequest;
        $this->trackFactory = $trackFactory;
        $this->orderFactory = $orderFactory;
    }

    public function setRateRequest(RateRequest $rateRequest)
    {
        $this->rateRequest = $rateRequest;
        return $this;
    }

    /**
     * Set Frenet ws params
     * @return Array
     */
    public function getParametersForQuotation()
    {
        $shippingItemArray = array();
        $isCentimeters = $this->getDimensionToUse();

        foreach ($this->rateRequest->getAllItems() as $item) {
            $product = $item->getProduct();
            if ($product->getTypeId() != 'configurable') {
                if ($isCentimeters) {
                    $shippingItemArray[] = [
                        'Weight' => (float) $product->getWeight(),
                        'Length' => (float) $product->getData('volume_length') ? $product->getData('volume_length') : self::DEFAULT_LENGTH,
                        'Height' => (float) $product->getData('volume_height') ? $product->getData('volume_height') : self::DEFAULT_HEIGHT,
                        'Width'  => (float) $product->getData('volume_width')  ? $product->getData('volume_width') : self::DEFAULT_WIDTH,
                        'Quantity' => (int) $item->getQty()
                    ];
                } else {
                    $shippingItemArray[] = [
                        'Weight' => (float) $product->getWeight(),
                        'Length' => (float) $product->getData('volume_length') ? ($product->getData('volume_length') * 0.1) : self::DEFAULT_LENGTH,
                        'Height' => (float) $product->getData('volume_height') ? ($product->getData('volume_height') * 0.1) : self::DEFAULT_HEIGHT,
                        'Width'  => (float) $product->getData('volume_width')  ? ($product->getData('volume_width')  * 0.1) : self::DEFAULT_WIDTH,
                        'Quantity' => (int) $item->getQty()
                    ];
                }
            }
        }

        $packageValue = (float) $this->rateRequest['package_value_with_discount'];
        if ($packageValue < 18.0) {
            $packageValue = 18.0;
        }
        return [
            'SellerCEP' => (string) $this->getOriginPostcode(),
            'RecipientCEP' => (string) $this->cleanPostcode($this->rateRequest->getDestPostcode()),
            'ShipmentInvoiceValue' => (float) $packageValue,
            'ShippingItemArray' => $shippingItemArray,
        ];
    }

    /**
     * Set parameters for tracking
     *
     * @param string
     * @return Array
     */
    public function getParametersForTracking($trackingNumber)
    {
        $trackModel = $this->trackFactory->create();
        $orderModel = $this->orderFactory->create();
        $track = $trackModel->getCollection()->addAttributeToFilter('track_number', $trackingNumber)->getFirstItem();
        if ($track->getId()) {
            $order = $orderModel->load($track->getOrderId());
            if ($order->getId()) {
                $method = explode('trezo_frenet_', $order->getShippingMethod());
                $method = end($method);
                return [
                    'ShippingServiceCode' => $method,
                    'TrackingNumber' => $trackingNumber,
                ];
            }
        }
        return [
            'ShippingServiceCode' => null,
            'TrackingNumber' => null,
        ];
    }
}
