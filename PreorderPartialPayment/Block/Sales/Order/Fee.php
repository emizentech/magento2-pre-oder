<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Tax totals modification block. Can be used just as subblock of \Magento\Sales\Block\Order\Totals
 */
namespace Emizentech\PreorderPartialPayment\Block\Sales\Order;



class Fee extends \Magento\Framework\View\Element\Template
{
    /**
     * Tax configuration model
     *
     * @var \Magento\Tax\Model\Config
     */
    protected $_config;

    /**
     * @var Order
     */
    protected $_order;

    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Tax\Model\Config $taxConfig,
        array $data = []
    ) {
        $this->_config = $taxConfig;
        parent::__construct($context, $data);
    }

    /**
     * Check if we nedd display full tax total info
     *
     * @return bool
     */
    public function displayFullSummary()
    {
        return true;
    }

    /**
     * Get data (totals) source model
     *
     * @return \Magento\Framework\DataObject
     */
    public function getSource()
    {
        return $this->_source;
    } 
    public function getStore()
    {
        return $this->_order->getStore();
    }

      /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }

    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

    /**
     * Initialize all order totals relates with tax
     *
     * @return \Magento\Tax\Block\Sales\Order\Tax
     */
     public function initTotals()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        $items = $this->_order->getAllItems();
        $amountCharged =0;
        $partial = '';
        foreach($items as $item) {
           $product     = $item->getProduct();
            $item_detail = (array) $item->getData();
            if($product->getAttributeText('preorder') == 'Yes'){
                $productPrice  = $product->getPrice();
                $perPreorder=  $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('preorder/general/preorder_percent');
                $preorderAmount = ($perPreorder / 100) * $productPrice;
                $amountCharged += number_format((float)$preorderAmount, 2, '.', '');
                $partial = 'yes';
            }else{
                $amountCharged += $item_detail['price_incl_tax'];
            }           
        }


        $store = $this->getStore();
        if($partial == 'yes'){
        $fee = new \Magento\Framework\DataObject(
                [
                    'code'      => 'fee',
                    'strong'    => true,                    
                    'value'     => $amountCharged   ,
                    'label'     => __('Partial Amount'),
                ]
            );
        }
            // $this->_addTax('grand_total');
            $parent->addTotal($fee, 'fee');


            return $this;
    }

}