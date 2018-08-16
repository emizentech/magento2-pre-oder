<?php 

namespace Emizentech\PreorderPartialPayment\Block\Adminhtml\Index\Configuration;

class Edit extends \Magento\Config\Block\System\Config\Edit{

	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Emizentech\PreorderPartialPayment\Model\Config\Structure $configStructure,
		array $data=[]
	){
		parent::__construct($context, $configStructure, $data);
	}

	public function _prepareLayout(){
		$this->getToolbar()->addChild(
			'save_button',
			'Magento\Backend\Block\Widget\Button',
			[
				'id'			=> 'save',
				'label'			=> __('Save Config'),
				'class'			=> 'save primary',
				'data_attribute'=> [
					'mage-init' =>['button' => ['event' => 'save', 'target'	=> '#config-edit-form']],
				]
			]
		);
		$block = $this->getLayout()
				->createBlock('Emizentech\PreorderPartialPayment\Block\Adminhtml\Index\Configuration\Tabs\Form');
		$this->setChild('form',$block);
	}
}