<?php
$this->startSetup();
$this->getConnection()->addColumn($this->getTable('ehime/report'), 'grid_config',
    //[
    //    'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    //    'length'    => '65536',
    //    'comment'   => 'Grid Configuration',
    //]);

    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => '65536',
        'comment'   => 'Grid Configuration',
    ));

$this->endSetup();