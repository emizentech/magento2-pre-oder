<?php
    /**
     * Emizentech PreorderPartialPayment CustomPrice Observer
     *
     * @category    Emizentech
     * @package     Emizentech_PreorderPartialPayment
     * @author      Emizentech Private Limited
     *
     */
    namespace Emizentech\PreorderPartialPayment\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
    



    class CustomPrice implements ObserverInterface
    {
        public function execute(\Magento\Framework\Event\Observer $observer) {
        $item=$observer->getEvent()->getData('quote_item');
        $product=$observer->getEvent()->getData('product');

        if($product->getCompleteOrder())
        {
            $item->setCustomPrice($product->getDuePrice());
            $item->setOriginalCustomPrice($product->getDuePrice());
            $item->getProduct()->setIsSuperMode(true);

        }else{
            /***Preorder****/
            $_getPreorder = $product->getResource()->getAttribute('preorder');
            $preorder = $_getPreorder->getFrontend()->getValue($product);
            /*********/
            /**Get Preorder Percentage**/
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $perPreorder=  $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('preorder/general/preorder_percent');
            /****/

            // here i am using item's product final price
            if($preorder == 'Yes'){
                $newPrice = ($perPreorder / 100) * $item->getProduct()->getFinalPrice();
                $price = $newPrice;

            }else{
                $price = $item->getProduct()->getFinalPrice();
            }
            
            // Set the custom price
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            // Enable super mode on the product.
            $item->getProduct()->setIsSuperMode(true);
        }
        return $this;
        }
    }