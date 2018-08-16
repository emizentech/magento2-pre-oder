<?php
namespace Emizentech\PreorderPartialPayment\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    
    public function install(
         \Magento\Framework\Setup\SchemaSetupInterface $setup,
         \Magento\Framework\Setup\ModuleContextInterface $context
         ){
            $installer = $setup;
            $installer->startSetup();
         
            $table = $installer->getConnection()
                ->newTable($installer->getTable('preorder_partial_orders'))
                ->addColumn(
                 'preorder_id',
                 \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                 null,
                 ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
                 'Preorder ID'
                 )
                ->addColumn(
                 'order_id',
                 \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                 100,
                 ['nullable' => false],
                 'Order ID'
                 )
                ->addColumn(
                 'product_id',
                 \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                 100,
                 [],
                 'Product ID'
                 )
                ->addColumn(
                 'total_amount',
                 \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                 100,
                 [],
                 'Total Amount'
                 )
                ->addColumn(
                 'amount_due',
                 \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                 100,
                 [],
                 'Amount Due'
                 )
                ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => 'simple'],
                'Status'
                 )
                ->addColumn(
                 'created_at',
                 \Magento\Framework\Db\Ddl\Table::TYPE_TIMESTAMP,
                 null,
                 ['nullable' => false, 'default' => \Magento\Framework\Db\Ddl\Table::TIMESTAMP_INIT],
                 'Created At'
                 );
                $installer->getConnection()->createTable($table);
                $installer->endSetup();
         }
    }
 ?>