<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Desenvolvido por Jamacio Rocha
 */
namespace IW3\Productsucesspage\Block;
class Success  extends \Magento\Framework\View\Element\Template
{
    public function getOrderId()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $checkout_session = $objectManager->get('Magento\Checkout\Model\Session');
        $order = $checkout_session->getLastRealOrder();
        return $order->getIncrementId();
    }

}
