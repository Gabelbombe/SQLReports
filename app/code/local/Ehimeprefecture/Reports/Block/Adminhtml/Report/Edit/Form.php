<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Report_Edit_Form Extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('report_edit_form');
    }

    protected function _prepareForm()
    {
        $form = New Varien_Data_Form(
            //['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );

        $form->setData('use_container', 1);
        $this->setForm($form);

        $this->_addBaseFieldset();
        $form->setValues($this->_getReport()->getData());

        return parent::_prepareForm();
    }

    /**
     * @return Ehimeprefecture_Reports_Model_Report
     */
    protected function _getReport()
    {
        return Mage::registry('current_report');
    }

    protected function _addBaseFieldset()
    {
        //$fieldset = $this->getForm()->addFieldset('base_fieldset', [
        //    'legend'    => Mage::helper('core')->__('General'),
        //]);

        $fieldset = $this->getForm()->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('core')->__('General'),
        ));

        //$fieldset->addField('report_id', 'hidden', [
        //    'name'      => 'report_id',
        //);

        $fieldset->addField('report_id', 'hidden', array(
            'name'      => 'report_id',
        ));

        //$fieldset->addField('title', 'text', [
        //    'name'      => 'report[title]',
        //    'label'     => Mage::helper('core')->__('Title'),
        //    'required'  => 1,
        //]);

        $fieldset->addField('title', 'text', array(
            'name'      => 'report[title]',
            'label'     => Mage::helper('core')->__('Title'),
            'required'  => true,
        ));

        //$fieldset->addField('sql_query', 'textarea', [
        //    'name'      => 'report[sql_query]',
        //    'label'     => Mage::helper('core')->__('SQL'),
        //    'required'  => 1,
        //    'style'     => 'width: 640px; height: 200;'
        //]);

        $fieldset->addField('sql_query', 'textarea', array(
            'name'      => 'report[sql_query]',
            'label'     => Mage::helper('core')->__('SQL'),
            'required'  => true,
            'style'     => 'width: 640px; height: 200;'
        ));

        //$fieldset->addField('output_type', 'select', [
        //    'name' => 'report[output_type]',
        //    'label' => Mage::helper('core')->__('Output Type'),
        //    'values' => Mage::getModel('ehime/config_outputType')->toOptionArray(),
        //    'required' => 1,
        //]);

        //replace with predefined types and a source
        $fieldset->addField('output_type', 'select', array(
            'name' => 'report[output_type]',
            'label' => Mage::helper('core')->__('Output Type'),
            'values' => Mage::getModel('ehime/config_outputType')->toOptionArray(),
            'required' => true,
        ));

        //$fieldset->addField('chart_config', 'textarea', [
        //    'name'      => 'report[chart_config]',
        //    'label'     => Mage::helper('core')->__('Chart Configuration'),
        //    'style'     => 'width: 640px; height: 200px;'
        //]);


        $fieldset->addField('chart_config', 'textarea', array(
            'name'      => 'report[chart_config]',
            'label'     => Mage::helper('core')->__('Chart Configuration'),
            'style'     => 'width: 640px; height: 200px;'
        ));

        //$fieldset->addField('grid_config', 'textarea', [
        //    'name'      => 'report[grid_config]',
        //    'label'     => Mage::helper('core')->__('Grid Configuration'),
        //    'style'     => 'width: 640px; height: 200px;'
        //]);

        $fieldset->addField('grid_config', 'textarea', array(
            'name'      => 'report[grid_config]',
            'label'     => Mage::helper('core')->__('Grid Configuration'),
            'style'     => 'width: 640px; height: 200px;'
        ));
    }
}