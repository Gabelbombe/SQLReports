<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Page_Menu Extends Mage_Adminhtml_Block_Page_Menu
{
    /**
     * Retrieve Adminhtml Menu array
     *
     * @return array
     */
    public function getMenuArray()
    {
        $menuArray = $this->_buildMenuArray();

        if (isset($menuArray['report']) && isset($menuArray['report']['children'])
        &&  isset($menuArray['report']['children']['ehime']))
        {
            $this->_appendEhimeprefectureReports($menuArray['report']['children']['ehime']);
        }

        return $menuArray;
    }

    /**
     * @param array $menuArray
     */
    protected function _appendEhimeprefectureReports(array &$menuArray)
    {
        if (! isset($menuArray['children'])) $menuArray['children'] = array(); // $menuArray['children'] = [];

        $maxReports       = (int)Mage::getStoreConfig('reports/ehime/max_reports_in_menu');
        $reportCollection = Mage::getModel('ehime/report')->getCollection()->setOrder('title', 'ASC');
        $reportCount      = $reportCollection->count();
        $i                = 1;

        foreach ($reportCollection AS $report)
        {
            /*
             * @var $report Ehimeprefecture_Reports_Model_Report
             */
            $titleNodeName = $this->_getXmlTitle($report);
            $route         = Mage::helper('ehime')->getPrimaryReportRoute($report);

            //$menuArray['children'][$titleNodeName] = [
            //    'label'      => $report->getTitle(),
            //    'sort_order' => 0,
            //    'url'        => $this->getUrl('adminhtml/adminhtml_report/' . $route, ['report_id' => $report->getId()]),
            //    'active'     => 1,
            //    'level'      => 2,
            //    'last'       => $i === $reportCount || $i === $maxReports, // $i === ($reportCount || $maxReports)
            //];

            $menuArray['children'][$titleNodeName] = array(
                'label'      => $report->getTitle(),
                'sort_order' => 0,
                'url'        => $this->getUrl('adminhtml/adminhtml_report/' . $route, array('report_id' => $report->getId())),
                'active'     => true,
                'level'      => 2,
                'last'       => $i === $reportCount|| $i === $maxReports,
            );

            if ($i === $maxReports) break;

            $i++;
        }
    }

    /**
     * @param Ehimeprefecture_Reports_Model_Report $report
     *
     * @return string
     */
    protected function _getXmlTitle(Ehimeprefecture_Reports_Model_Report $report)
    {
        return strtolower(preg_replace('/[^a-z0-9]+/i', '', $report->getTitle()));
    }
}
