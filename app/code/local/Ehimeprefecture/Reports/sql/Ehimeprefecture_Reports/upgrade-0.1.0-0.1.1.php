<?php
/*
 * @var $this Mage_Core_Model_Resource_Setup
 */
$this->startSetup();
$this->getConnection()->addColumn($this->getTable('ehime/report'), 'output_type',
    //[
    //    'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    //    'length'    => '255',
    //    'comment'   => 'Output Type',
    //]);

    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => '255',
        'comment'   => 'Output Type',
    ));

$this->getConnection()->addColumn($this->getTable('ehime/report'), 'chart_config',
    //[
    //    'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    //    'length'    => '65536',
    //    'comment'   => 'Chart Configuration',
    //]);

    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => '65536',
        'comment'   => 'Chart Configuration',
    ));
$this->endSetup();