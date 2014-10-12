<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Report_View_Grid Extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_sqlQueryResults;

    public function __construct()
    {
        parent::__construct();

        $this->setId('reportsGrid');
        $this->setDefaultSort('report_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->addExportType('*/*/exportCsv', $this->__('CSV'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->unsetChild('search_button');
        $this->unsetChild('reset_filter_button');

        return $this;
    }

    /**
     * @return Ehimeprefecture_Reports_Model_Report
     */
    protected function _getReport()
    {
        return Mage::registry('current_report');
    }

    /**
     * @return Varien_Data_Collection_Db mixed
     */
    protected function _createCollection()
    {
        return $this->_getReport()->getReportCollection();
    }

    /**
     * makes an attempt to catch errors loading/preparing grid
     * for instance: if the query contains an `id` column which
     * is non-unique, the varien data collector will throw:
     *
     *  "Item (Varien_Object) with the same id "1" already exist" exception
     *
     * @see Mage_Adminhtml_Block_Widget_Grid::_prepareCollection
     */
    protected function _prepareCollection()
    {
        if (isset($this->_collection)) return $this->_collection;

        $collection = $this->_createCollection();
        $this->setCollection($collection);

        try
        {
            parent::_prepareCollection();
        }

        catch (\ErrorException $ee)
        {
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__('An error has occurred attempting to rendering the grid: ' . $ee->getMessage())
            );

            Mage::logException($ee);

            //abort rendering and replace with an empty data collection
            $this->setCollection(New Varien_Data_Collection());
        }
        return $this;
    }

    protected function _prepareColumns()
    {
        try
        {
            $collection = $this->_createCollection();
            $collection->setPageSize(1);
            $collection->load();
        }

        catch (\ErrorException $ee)
        {
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__('An error has occurred attempting to rendering the grid: ' . $ee->getMessage())
            );

            Mage::logException($ee);

            $collection = New Varien_Data_Collection();
        }

        $config     = $this->_getReport()->getGridConfig();
        $filterable = $config->getFilterable();
        $items      = $collection->getItems();

        if (count($items))
        {
            $item = reset($items);
            foreach ($item->getData() AS $key => $val)
            {
                $isFilterable = false;
                if (isset($filterable[$key]))
                {
                    $isFilterable = $filterable[$key];
                }

                elseif (in_array($key, $filterable)) {
                    $isFilterable = 'adminhtml/widget_grid_column_filter_text';
                }

                //$this->addColumn(
                //    $key,
                //    [
                //        'header'   => Mage::helper('core')->__($key),
                //        'index'    => $key,
                //        'filter'   => $isFilterable,
                //        'sortable' => 1,
                //    ]
                //);

                $this->addColumn(
                    $key,
                    array(
                        'header'   => Mage::helper('core')->__($key),
                        'index'    => $key,
                        'filter'   => $isFilterable,
                        'sortable' => true,
                    )
                );
            }
        }

        return parent::_prepareColumns();
    }
}
