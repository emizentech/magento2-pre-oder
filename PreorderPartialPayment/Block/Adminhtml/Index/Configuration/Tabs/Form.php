<?php 

namespace Emizentech\PreorderPartialPayment\Block\Adminhtml\Index\Configuration\Tabs;

/**
 * 
 */
class Form extends \Magento\Config\Block\System\Config\Form
{
	
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\Data\FormFactory $formfactory,
		\Magento\Config\Model\Config\Factory $configFactory,
		\Emizentech\PreorderPartialPayment\Model\Config\Structure $configStructure,
		\Magento\Config\Block\System\Config\Form\Fieldset\Factory $fieldsetFactory,
		\Magento\Config\Block\System\Config\Form\Field\Factory $fieldFactory,
		array $data = []
	)
	{
		parent::construct($context, $registry, $formfactory, $configFactory, $configStructure, $fieldsetFactory, $fieldFactory, $data);
	}
}