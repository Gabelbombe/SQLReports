<?php
$this->startSetup();
$this->getConnection()->addColumn($this->getTable('ehime/report'), 'javascript_config',
    //[
    //    'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    //    'length'    => '65536',
    //    'comment'   => 'Javascript Configuration',
    //]);

    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => '65536',
        'comment'   => 'Javascript Configuration',
    ));
$this->endSetup();