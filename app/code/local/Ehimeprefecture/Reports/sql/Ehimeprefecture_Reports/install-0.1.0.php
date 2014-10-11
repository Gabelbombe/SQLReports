<?php
/*
 * @var $this Mage_Core_Model_Resource_Setup
 */
$this->startSetup();

$table = $this->getConnection()->newTable($this->getTable('ehime/report'));

$table->addColumn('report_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,

    //['identity' => 1, 'primary'  => 1, 'unsigned' => 1, 'nullable' => 0]

    array(
        'identity' => true,
        'primary'  => true,
        'unsigned' => true,
        'nullable' => false,
    )
);

$table->addColumn('sql_query', Varien_Db_Ddl_Table::TYPE_TEXT, 65536,

    // ['nullable' => 0]

    array(
        'nullable' => false,
    )
);
$table->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255,

    // ['nullable' => 0]

    array(
        'nullable' => false,
    )
);
$table->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null);
$this->getConnection()->createTable($table);
$this->endSetup();
