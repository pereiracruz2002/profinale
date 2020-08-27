<?php
namespace Trezo\Frenet\Model\Api;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Sales\Model\Order\Shipment;
use Magento\Store\Model\StoreManagerInterface;
use Trezo\Frenet\Model\Source\Path as configPath;

abstract class AbstractServiceRequest
{

    public $scopeConfig;
    public $storeManager;
    const DEFAULT_GATEWAY_URL = 'http://api.frenet.com.br/shipping/quote';
    const DEFAULT_TRACKING_URL = 'http://api.frenet.com.br/tracking/trackinginfo';

    public function __construct(ScopeConfigInterface $scopeConfig, StoreManagerInterface $storeManager)
    {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    public function getStoreId()
    {
        return $this->storeManager->getStore()->getStoreId();
    }

    /**
     * Return Frenet WS url
     * @return String
     */
    public function getUrl()
    {
        return self::DEFAULT_GATEWAY_URL;
    }

    /**
     * Return Frenet WS Tracking url
     * @return String
     */
    public function getTrackingUrl()
    {
        return self::DEFAULT_TRACKING_URL;
    }

    /**
     * Clean postcode
     * @return string
     */
    public function cleanPostcode($postcode)
    {
        return str_replace(['-', ' '], '', $postcode);
    }

    /**
     * Set header request from Frenet WS
     * @return Array
     */
    public function getHeaderRequest()
    {
        return [
            'Content-Type' => 'application/json',
            'token' => $this->getConfigValue(configPath::TOKEN, $this->getStoreId())
        ];
    }

    /**
     * Get origin postcode
     * @return string
     */
    public function getOriginPostcode()
    {
        return $this->cleanPostcode(
            $this->getConfigValue(Shipment::XML_PATH_STORE_ZIP, $this->getStoreId())
        );
    }

    public function getConfigValue($configPath, $storeId)
    {
        return $this->scopeConfig->getValue($configPath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Show shipping delivery time
     * @return boolean
     */
    public function showEstimate()
    {
        if ($this->getConfigValue(configPath::SHOW_ESTIMATE, $this->getStoreId())) {
            return true;
        }
        return false;
    }

    /**
     * Return dimension [Cm/Millimeters] to be used
     * @return int [Cm => 1, mm => 0]
     */
    public function getDimensionToUse()
    {
        return $this->getConfigValue(configPath::DIMENSIONS, $this->getStoreId());
    }

    /**
     * Mapper for correios code
     * @return String
     */
    public function getMethodTitle($shippingService)
    {
        if ($this->showEstimate()) {
            $additional = (int) $this->getConfigValue(configPath::ADDITIONAL_DAYS, $this->getStoreId());
            return __('%1 (up to %2 business days*)', $shippingService->ServiceDescription, $shippingService->DeliveryTime + $additional);
        }
        return $shippingService->ServiceDescription;
    }
}
