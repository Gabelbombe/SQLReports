<?php
Class Ehimeprefecture_Reports_Model_Mysql4_Report_Collection Extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();

        $this->_init('ehime/report');
    }
}