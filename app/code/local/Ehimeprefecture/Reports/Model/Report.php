<?php

/**
 * @method getCreatedAt()
 * @method Ehimeprefecture_Reports_Model_Report setCreatedAt($value)
 *
 * @method getTitle()
 * @method Ehimeprefecture_Reports_Model_Report setTitle($value)
 *
 * @method getOutputType()
 * @method Ehimeprefecture_Reports_Model_Report setOutputType($value)
 *
 * @method getChartConfig() ~ Not exist
 * @method Ehimeprefecture_Reports_Model_Report setChartConfig($value)
 */
class Ehimeprefecture_Reports_Model_Report extends Mage_Core_Model_Abstract
{
    /**
     * @var Ehimeprefecture_Reports_Model_Report_GridConfig
     */
    protected $gridConfig = null;
    
    public function _construct()
    {
        parent::_construct();

        $this->_init('ehime/report');
    }

    /**
     * Get report collection
     *
     * @return mixed|obj
     */
    public function getReportCollection()
    {
        $connection = Mage::helper('ehime')->getDefaultConnection();
        $collection = Mage::getModel('ehime/reportCollection', $connection);

        $collection->getSelect()->from(New Zend_Db_Expr('(' . $this->getData('sql_query') . ')'));

        return $collection;
    }

    /**
     * Sets the chart div space
     *
     * @return string
     */
    public function getChartDiv()
    {
        return 'chart_' . $this->getId();
    }

    /**
     * Is chart available
     *
     * @return bool
     */
    public function hasChart()
    {
        return (! $this->getOutputType() || $this->getOutputType() == Ehimeprefecture_Reports_Model_Config_OutputType::TYPE_PLAIN_TABLE)
            ? false
            : true;
    }

    /**
     * @return Ehimeprefecture_Reports_Model_Report_GridConfig
     */
    public function getGridConfig()
    {
        if (! $this->gridConfig)
        {
            $config = json_decode($this->getData('grid_config'), true);

            if (! is_array($config)) $config = array(); // $config = [];

            $this->gridConfig = Mage::getModel('ehime/reportgridConfig', $config);
        }

        return $this->gridConfig;
    }
}