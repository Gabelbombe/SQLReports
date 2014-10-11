<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Report Extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_report';
        $this->_blockGroup = 'ehime';
        $this->_headerText = Mage::helper('core')->__('Manage Reports');
        $this->_addButtonLabel = Mage::helper('core')->__('Add Report');

        parent::__construct();
    }

    protected function _prepareLayout()
    {
        return Mage_Adminhtml_Block_Widget_Container::_prepareLayout();
    }
}
