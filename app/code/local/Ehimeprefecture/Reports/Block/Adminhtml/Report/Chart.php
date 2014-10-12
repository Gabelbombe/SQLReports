<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Report_Chart Extends Mage_Adminhtml_Block_Template
{
    protected $_template = 'ehimeprefecture_reports/chart.phtml';

    /**
     * @return Ehimeprefecture_Reports_Model_Report
     */
    protected function _getReport()
    {
        return Mage::registry('current_report');
    }

    public function renderChart()
    {
        $report = $this->_getReport();

        return $report->getChartConfig();

    }

}