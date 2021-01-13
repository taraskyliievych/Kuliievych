<?php
namespace Kuliievych\ViewsCounter\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Kuliievych\ViewsCounter\Setup
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

        if (!$setup->getConnection()->isTableExists($setup->getTable('product_views_counter'))) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable('product_views_counter'))
                ->addColumn(
                    'product_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )
                ->addColumn(
                    'views',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable'=>true, 'default'=>0]
                )
                ->setOption('charset', 'utf8')
                ->setComment("Greeting Message table");

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
