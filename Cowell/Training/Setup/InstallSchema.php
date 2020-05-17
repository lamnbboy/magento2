<?php
namespace Cowell\Training\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('cowell_training_student'))
            ->addColumn(
                'student_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Student ID'
            )
            ->addColumn('slug', Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null])
            ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Student Name')
            ->addColumn('gender', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Student Gender')
            ->addColumn('dob', Table::TYPE_DATE, null, ['nullable' => false], 'Student Dob')
            ->addColumn('address', Table::TYPE_TEXT, 255, [], 'Student Address')
            ->addColumn('email', Table::TYPE_TEXT, 100, [], 'Student Email')
            ->addColumn('created_at', Table::TYPE_DATETIME, null, ['nullable' => false], 'Created At')
            ->addColumn('updated_at', Table::TYPE_DATETIME, null, ['nullable' => false], 'Updated At')
            ->addIndex($installer->getIdxName('training_student', ['slug']), ['slug'])
            ->setComment('Cowell Training Students');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}