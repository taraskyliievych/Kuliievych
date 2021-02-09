<?php
namespace Kuliievych\PriceRequest\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Kuliievych\PriceRequest\Setup
 */
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->getConnection()->isTableExists($setup->getTable('price_request'))) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('price_request'))
                ->addColumn(
                    'request_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],
                    'Request Id'
                )
                ->addColumn(
                    'product_sku',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false],
                    'Product SKU'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    64,
                    ['nullable'=>false],
                    'Name'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    96,
                    ['nullable'=>false],
                    'Email'
                )
                ->addColumn(
                    'comment',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false, 'default'=>0, 'unsigned'=>true],
                    'Comment'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_BOOLEAN,
                    null,
                    ['nullable'=>false],
                    'Status'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable'=>false, 'default'=> Table::TIMESTAMP_INIT],
                    'Creation Time'

                )
                ->setOption('charset', 'utf8')
                ->setComment("Creating Price Request Table");

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
