<?php
namespace Emizentech\PreorderPartialPayment\Model;

class Preorder extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'preorder_partial_orders';

	protected $_cacheTag = 'preorder_partial_orders';

	protected $_eventPrefix = 'preorder_partial_orders';

	protected function _construct()
	{
		$this->_init('Emizentech\PreorderPartialPayment\Model\ResourceModel\Preorder');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
