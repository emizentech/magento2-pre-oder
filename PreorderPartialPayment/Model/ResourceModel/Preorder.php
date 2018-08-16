<?php

namespace Emizentech\PreorderPartialPayment\Model\ResourceModel;
class Preorder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('preorder_partial_orders', 'preorder_id');
	}
	
}
