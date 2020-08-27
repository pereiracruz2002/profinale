<?php


namespace IW3\MudarPrecoProduto\Observer\Frontend\Checkout;

class CartProductAddAfter implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $_atributo = $objectManager->get('Magento\Catalog\Model\Product')->load($item->getProduct()->getId());
       if($qtyIncremet = $_atributo->getData('incrementar_decimal')) {
           $qttyProd = str_replace(',', '.', $qtyIncremet);
           $price = ($qttyProd * $item->getProduct()->getFinalPrice());
           $item->setCustomPrice($price);
           $item->setOriginalCustomPrice($price);
           $item->getProduct()->setIsSuperMode(true);
       }
    }
}
