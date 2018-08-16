<?php
namespace Emizentech\Preorder\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        /*** Add attributes to the eav/attribute*/
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
    }
}
