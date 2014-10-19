<?php
Class Ehimeprefecture_Reports_Adminhtml_ReportController Extends Mage_Adminhtml_Controller_Action
{
    protected $report;

    public function preDispatch()
    {
        parent::preDispatch();

        $this->_title($this->__("Market Reports"));
    }

    public function indexAction()
    {
        $this->_render();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        Mage::register('current_report', $this->_getReport());
        $this->_title($this->__("Edit: %s", $this->_getReport()->getTitle()));
        $this->_render();
    }

    public function viewtableAction()
    {
        Mage::register('current_report', $this->_getReport());
        $this->_title($this->_getReport()->getTitle());
        $this->_render();
    }

    public function viewchartAction()
    {
        Mage::register('current_report', $this->_getReport());
        $this->_title($this->_getReport()->getTitle());
        $this->_render();
    }

    public function saveAction()
    {
        $report = $this->_getReport();
        $postData = $this->getRequest()->getParams();

        $report->addData($postData['report']);
        $report->save();

        Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Saved report: %s", $report->getTitle()));

        $this->_redirect('*/*');

        return $this;
    }

    public function deleteAction()
    {
        $report = $this->_getReport();

        if (! $report->getId())
        {
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Wasn't able to find the report"));
            $this->_redirect('adminhtml/adminhtml_report');

            return $this;
        }

        $report->delete();
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Deleted report: %s", $report->getTitle()));

        $this->_redirect('*/*');

        return $this;
    }

    /**
     * Export grid to CSV format
     */
    public function exportCsvAction()
    {
        Mage::register('current_report', $this->_getReport());

        $this->loadLayout();

        /*
         * @var $grid Mage_Adminhtml_Block_Widget_Grid
         */
        $grid = $this->getLayout()->getBlock('report.view.grid');

        if(! $grid instanceof Mage_Adminhtml_Block_Widget_Grid)
        {
            $this->_forward('noroute');
            return;
        }

        $fileName = strtolower(str_replace(' ', '_', $this->_getReport()->getTitle())) . '_' . time() . '.csv';

        $this->_prepareDownloadResponse(
            $fileName,
            $grid->getCsvFile(),
            'text/csv'
        );
    }

    /**
     * Get JSON action
     *
     * @return void
     */
    public function getJsonAction()
    {
        try
        {
            $report = $this->_getReport();

            $json = ($report->getOutputType() == Ehimeprefecture_Reports_Model_Config_OutputType::TYPE_CALENDAR_CHART)
                ? $report->getReportCollection()->toCalendarJson()
                : $report->getReportCollection()->toReportJson();

            $this->getResponse()->setBody($json);
            $this->getResponse()->setHeader('Content-type', 'application/json');
        }

        catch (Exception $e)
        {
            $this->getResponse()->setBody(json_encode(array('error' => $e->getMessage())));
            $this->getResponse()->setHeader('Content-type', 'application/json');
        }
    }

    /**
     * @return Ehimeprefecture_Reports_Model_Report
     */
    protected function _getReport()
    {
        if (! isset($this->report))
        {
            $report = Mage::getModel ('ehime/report');

            $this->report = ($this->getRequest ()->getParam ('report_id'))
                ? $report->load ($this->getRequest ()->getParam ('report_id'))
                : $report;
        }

        return $this->report;
    }

    protected function _isAllowed()
    {
        $isView = in_array($this->getRequest()->getActionName(), array('index', 'view', 'viewTable'));

        /*
         * @var $helper Ehimeprefecture_SqlReport_Helper_Data
         */
        $helper = Mage::helper('ehime');

        return ($isView ? $helper->getAllowView() : $helper->getAllowEdit());
    }

    protected function _render($tab = false)
    {
        $this->loadLayout()
             ->_setActiveMenu((! $tab) ? 'foodhub/ehime' : $tab)
             ->_addBreadcrumb(Mage::helper('ehime')->__('Market Reports'), Mage::helper('ehime')->__('Market Reports'))
             ->renderLayout();

        return $this;
    }
}
