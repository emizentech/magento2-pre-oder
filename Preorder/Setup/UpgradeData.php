<?php  
namespace Emizentech\Preorder\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class UpgradeData implements UpgradeDataInterface {

    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        
        if(version_compare($context->getVersion(), '1.9', '<')) {
             $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'preorder',
            [
                 'type' => 'text',
                 'backend' => '',
                 'frontend' => '',
                 'label' => 'Preorder',
                 'input' => 'select',
                 'class' => '',
                 'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                 'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                 'visible' => true,
                 'required' => false,
                 'user_defined' => false,
                 'default' => '',
                 'searchable' => true,
                 'filterable' => false,
                 'comparable' => false,
                 'visible_on_front' => false,
                 'used_in_product_listing' => true,
                 'unique' => false,
                 'apply_to' => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'availability_date',
            [
                'label' => 'Preorder Availability Date',
                'type' => 'datetime',
                'input' => 'date',
                'input_renderer' => 'Velanapps\Test\Block\Adminhtml\Form\Element\Datetime',
                'class' => 'validate-date',
                'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => true,
                'filterable' => true,
                'filterable_in_search' => true,
                'visible_in_advanced_search' => true,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false
            ]
        );
        $setup->endSetup();
    }

}
}
?>
