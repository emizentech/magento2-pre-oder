<?php

namespace Emizentech\PreorderPartialPayment\Block;



   class Order extends \Magento\Framework\View\Element\Template
   {
   	protected $order;
    protected $_postFactory;
    protected $cart;
    protected $product;

     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\OrderFactory $order,
        \Emizentech\PreorderPartialPayment\Model\PreorderFactory $postFactory,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\Product $product,
         array $data = []
     ) {
     	$this->order = $order;
      $this->_postFactory         = $postFactory;
      $this->cart = $cart;
      $this->product = $product;
     	parent::__construct($context, $data);
   	}

    public function completeOrder($orderId){
        $collections = $this->_postFactory->create()->getCollection()->addFieldToFilter('order_id', $orderId);
        
        foreach($collections as $item)
        {
            $itemData   = $item->getData();
            $productId  = $itemData['product_id'];
            $status     = $itemData['status'];
            $amountDue  = $itemData['amount_due'];
            if($status == 'PARTIAL'){
                return true;
            }
        }
    }

   
}
