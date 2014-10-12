<?php
Class Ehimeprefecture_Reports_Block_Adminhtml_Report_Grid Extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('reportsGrid');
        $this->setDefaultSort('report_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);

        /**
         * TODO: remove this direct helper access and replace with an action element in the layout XML
         */

        $this->setData('allow_edit', Mage::helper('ehime')->getAllowEdit());
    }

    protected function _prepareCollection()
    {
        /*
         * @var $collection Ehimeprefecture_Reports_Model_Mysql4_Report_Collection
         */

        $collection = Mage::getModel('ehime/report')->getCollection();
        $collection->setOrder('title', 'ASC');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        //$this->addColumn(
        //    'title',
        //    [
        //        'header' => $this->__('Title'),
        //        'index'  => 'title',
        //    ]
        //);

        $this->addColumn(
            'title',
            array(
                'header' => $this->__('Title'),
                'index'  => 'title',
            )
        );

        //$actions = [
        //    [
        //        'caption' => $this->__('Table'),
        //        'url'     => [
        //            'base'   => '*/*/viewtable',
        //            'params' => [],
        //        ],
        //        'field'   => 'report_id'
        //    ],
        //];

        $actions = array(
            array(
                'caption' => $this->__('Table'),
                'url'     => array(
                    'base'   => '*/*/viewtable',
                    'params' => array(),
                ),
                'field'   => 'report_id'
            ),
        );

        //if ($this->getAllowEdit()) {
        //    $actions[] = [
        //        'caption' => $this->__('Edit'),
        //        'url'     => [
        //            'base'   => '*/*/edit',
        //            'params' => [],
        //        ],
        //        'field'   => 'report_id'
        //    ];
        //}

        if ($this->getAllowEdit()) {
            $actions[] = array(
                'caption' => $this->__('Edit'),
                'url'     => array(
                    'base'   => '*/*/edit',
                    'params' => array(),
                ),
                'field'   => 'report_id'
            );
        }

        //$this->addColumn(
        //    'action_view',
        //    [
        //        'header'     => $this->__('Action'),
        //        'index'      => 'report_id',
        //        'sortable'   => 0,
        //        'filter'     => 0,
        //        'type'       => 'action',
        //        'actions'    => $actions,
        //        'link_limit' => 3,
        //    ]
        //);

        $this->addColumn(
            'action_view',
            array(
                'header'     => $this->__('Action'),
                'index'      => 'report_id',
                'sortable'   => false,
                'filter'     => false,
                'type'       => 'action',
                'actions'    => $actions,
                'link_limit' => 3,
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Return row
     *
     * @param Ehimeprefecture_Reports_Model_Report $item
     * @return string
     */
    public function getRowUrl($item)
    {
        $route = Mage::helper('ehime')->getPrimaryReportRoute($item);

        //return $this->getUrl("*/*/{$route}", ['report_id' => $item->getId()]);

        return $this->getUrl("*/*/{$route}", array('report_id' => $item->getId()));
    }
}