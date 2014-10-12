<?php
Class Ehimeprefecture_Reports_Model_Mysql4_Report Extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('ehime/report', 'report_id');
    }
}