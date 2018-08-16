<?php 

namespace Emizentech\PreorderPartialPayment\Model\Config\Structure;

class Data extends \Magento\Config\Model\Config\Structure\Data{

	public function __construct(
		Reader $reader,
		\Magento\Framework\Config\ScopeInterface $configScope,
		\Magento\Framework\Config\CacheInterface $cache,
		$cacheId
	){
		parent::__construct($reader, $configScope, $cache, $cacheId);
	}

}