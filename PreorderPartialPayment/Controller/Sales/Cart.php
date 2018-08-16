<?php
namespace Emizentech\PreorderPartialPayment\Controller\Sales;

class Cart extends \Magento\Framework\App\Action\Action
{
	protected $_postFactory;
	protected $request;
	protected $product;
	protected $cart;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Emizentech\PreorderPartialPayment\Model\PreorderFactory $postFactory,
		\Magento\Framework\App\Request\Http $request,
		\Magento\Catalog\Model\Product $product,
		\Magento\Framework\Data\Form\FormKey $formKey,
		\Magento\Checkout\Model\Cart $cart
	)
	{
		$this->request = $request;
		$this->_postFactory         = $postFactory;
		$this->product = $product;
		$this->formKey = $formKey;
    	$this->cart = $cart;
		return parent::__construct($context);
	}

	public function execute()
	{
		$orderId= $this->request->getParam('order_id');
        $collections = $this->_postFactory->create()->getCollection()->addFieldToFilter('order_id', $orderId);
        foreach($collections as $item)
        {
            $itemData   = $item->getData();
            $productId  = $itemData['product_id'];
            $amountDue  = $itemData['amount_due'];
		    $params = array(
		    			'form_key' 	=> $this->formKey->getFormKey(),
		                'product' 	=> $productId, //product Id
		                'qty'     	=> 1,
		                'price' 	=> $amountDue,
		                'preorders'	=> 'complete'                
		            );              
		    //Load the product based on productID   
		    $_product = $this->product->load($productId);       
		    $_product->setCompleteOrder(true);
		    $_product->setDuePrice($amountDue);
		    $_product->setOrderId($orderId);
		    $this->cart->addProduct($_product, $params);
		    $this->cart->save();
		}
		$this->_redirect('checkout/cart');
	}
}