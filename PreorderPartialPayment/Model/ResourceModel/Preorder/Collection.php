<?php
namespace Emizentech\PreorderPartialPayment\Model\ResourceModel\Preorder;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'preorder_id';
	protected $_eventPrefix = 'preorder_partial_orders_collection';
	protected $_eventObject = 'preorder_partial_orders';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Emizentech\PreorderPartialPayment\Model\Preorder', 'Emizentech\PreorderPartialPayment\Model\ResourceModel\Preorder');
	}

}

