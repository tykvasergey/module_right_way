<?php

namespace BroSolutions\RequestQuote\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Innovadeltech\Wishlist\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @method install
     * @param  SchemaSetupInterface   $setup
     * @param  ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('requestquote')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Id'
        )->addColumn(
           'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Created At'
        )->addColumn(
           'full_name',
            Table::TYPE_TEXT,
            null,
            [],
            'Full name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            [],
            'Email'
        )->addColumn(
            'city_state',
            Table::TYPE_TEXT,
            null,
            [],
            'Ccity State'
        )->addColumn(
            'phone',
            Table::TYPE_TEXT,
            255,
            [],
            'Phone'
        )->addColumn(
            'budget',
            Table::TYPE_TEXT,
            255,
            [],
            'Budget'
        )->addColumn(
            'part_size',
            Table::TYPE_TEXT,
            255,
            [],
            'Part size'
        )->addColumn(
            'existing_line',
            Table::TYPE_SMALLINT,
            5,
            [],
            'Existing line'
        )->addColumn(
            'product_to_be_coated',
            Table::TYPE_TEXT,
            null,
            [],
            'Product to be coated'
        )->addColumn(
            'installation',
            Table::TYPE_SMALLINT,
            5,
            [],
            'Installation'
        )->addColumn(
            'comments',
            Table::TYPE_TEXT,
            null,
            [],
            'Comments'
        )->addColumn(
            'check_mark_options',
            Table::TYPE_TEXT,
            null,
            [],
            'Check mark options'
        )->addColumn(
            'zipcode',
            Table::TYPE_TEXT,
            null,
            [],
            'Zip code'
        )->addColumn(
            'interested_financing',
            Table::TYPE_SMALLINT,
            5,
            [],
            'Interested financing'
        );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
