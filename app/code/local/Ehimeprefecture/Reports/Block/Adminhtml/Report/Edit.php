<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Report_Edit Extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'report_id';
        $this->_controller = 'adminhtml_report';
        $this->_blockGroup = 'ehime';

        $this->_headerText = Mage::helper('core')->__('Edit Report');

        parent::__construct();

        $this->_addDeleteButton();
        $this->_removeButton('reset');
    }

    protected function _addDeleteButton()
    {
        $deleteUrl = $this->getDeleteUrl();
        $confirmText = Mage::helper('adminhtml')->__('Sure you want to delete this?');

        //$this->_addButton('delete', [
        //    'label'     => 'Delete',
        //    'onclick'   => "deleteConfirm('$confirmText', '$deleteUrl');",
        //    'class'     => 'save',
        //]);

        $this->_addButton('delete', array(
            'label'     => 'Delete',
            'onclick'   => "deleteConfirm('$confirmText', '$deleteUrl');",
            'class'     => 'save',
        ));
    }
}