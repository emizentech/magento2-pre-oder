<?php
 
namespace Emizentech\PreorderPartialPayment\Observer;
 
use Magento\Framework\ObjectManager\ObjectManager;
 
class AfterCheckoutSaveOrder implements \Magento\Framework\Event\ObserverInterface {
 
    /** @var \Magento\Framework\Logger\Monolog */
    protected $_logger;
    
    /**
     * @var \Magento\Framework\ObjectManager\ObjectManager
     */
    protected $_objectManager;
    
    protected $_orderFactory;    
    protected $_checkoutSession;
    protected $_postFactory;
    protected $_productRepository;
    
    public function __construct(        
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\ObjectManager\ObjectManager $objectManager,
        \Emizentech\PreorderPartialPayment\Model\PreorderFactory $postFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository

    ) {
        $this->_logger              = $loggerInterface;
        $this->_objectManager       = $objectManager;        
        $this->_orderFactory        = $orderFactory;
        $this->_checkoutSession     = $checkoutSession; 
        $this->_postFactory         = $postFactory;   
        $this->_productRepository   = $productRepository;    
    }
 
    /**
     * This is the method that fires when the event runs.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer ) {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (count($orderIds)) {
            $orderId = $orderIds[0];   
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $order = $objectManager->create('Magento\Sales\Api\Data\OrderInterface')->load($orderId);
            $orderItems = $order->getAllItems();
            foreach($orderItems as $item){
                
              $item_detail = (array) $item->getData();
              $product = $item->getProduct();
              $itemPrice  = $item_detail['price_incl_tax'];
                
              if($product->getAttributeText('preorder') == 'Yes'){

                $product_id = $item_detail['product_id'];
                $quote = $observer->getEvent()->getQuote();
                //echo $quote->getOrderId();
                $collections = $this->_postFactory->create()->getCollection()->addFieldToFilter('order_id', 140)->addFieldToFilter('product_id', $product_id)->addFieldToFilter('status', 'PARTIAL');
                $productPrice = $product->getPrice(); 
                if($collections->count() > 0){

                    foreach($collections as $item)
                    {
                        $item->setStatus('COMPLETED');
                        $item->setAmount_due('0');
                        $item->setAmount_paid($productPrice);
                    }
                    $collections->save();
                }else{   
                    $amountDue = $productPrice - $itemPrice;
                        /***Insert into Preorder Table**/
                        $post = $this->_postFactory->create();
                        $post->addData([
                            "order_id"      => $orderId,
                            "product_id"    => $product_id,
                            "total_amount"  => $productPrice,
                            "amount_due"    => $amountDue,
                            "amount_paid"   => $itemPrice,
                            "status"        => 'PARTIAL'
                            ]);
                        $saveData = $post->save();
                }
                    /**************/
              }
            }//endforeach  
        }//endif
        //die;
    }
}