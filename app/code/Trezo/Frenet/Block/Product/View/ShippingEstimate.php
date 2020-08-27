<?php

namespace Trezo\Frenet\Block\Product\View;

use Magento\Catalog\Block\Product\View\abstractView;
use Magento\Framework \Stdlib\CookieManagerInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Stdlib\ArrayUtils;

class ShippingEstimate extends abstractView
{
    protected $_cookieManager;

    public function __construct(CookieManagerInterface $cookieManager, Context $context, ArrayUtils $arrayUtils, array $data = [])
    {
        $this->_cookieManager = $cookieManager;
        parent::__construct($context, $arrayUtils, $data);
    }

    public function getCookieShippingQuote()
    {
        return $this->_cookieManager->getCookie(\Trezo\Frenet\Controller\Index\Index::COOKIE_NAME);
    }

    public function getCurrentCurrencySymbol()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        $currency = $objectManager->get('\Magento\Directory\Model\Currency');
        return $currency->getCurrencySymbol();
    }
}
