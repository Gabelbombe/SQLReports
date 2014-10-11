<?php
Class Ehimeprefecture_Reports_Helper_Data Extends Mage_Core_Helper_Abstract
{
    /**
     * Return a flag indicating if the currently logged in admin user can view reports
     *
     * @return bool
     */
    public function getAllowView()
    {
        return $this->getAdminSession()->isAllowed('report/ehime');
    }

    /**
     * Return a flag indicating if the currently logged in admin user can add/edit reports
     *
     * @return bool
     */
    public function getAllowEdit()
    {
        return $this->getAdminSession()->isAllowed('report/ehime/edit');
    }

    /**
     * Get the admin session singleton
     *
     * @return Mage_Admin_Model_Session
     */
    public function getAdminSession()
    {
        return Mage::getSingleton('admin/session');
    }

    /**
     * @param $report Ehimeprefecture_Reports_Model_Report
     * @return bool
     */
    public function getPrimaryReportRoute($report)
    {
        return ($report->hasChart())
            ? 'viewChart'
            : 'viewTable';
    }
    /**
     * Get active db connection resource config nodes
     *
     * @return Mage_Core_Model_Config_Element
     */
    public function getConnectionResourceConfig()
    {
        $resourceConfig = Mage::getConfig()->getXpath('global/resources/*[child::connection and descendant::active=1]');

        return $resourceConfig;
    }
    /**
     * Get default connection resource model
     *
     * @return Magento_Db_Adapter_Pdo_Mysql
     */
    public function getDefaultConnection()
    {
        /*
         * @var $resource Mage_Core_Model_Resource
         */
        $resource       = Mage::getSingleton('core/resource');
        $connectionName = Mage::getStoreConfig('reports/ehime/default_connection');

        if (! $connectionName) $connectionName = 'core_read';

        return $resource->getConnection($connectionName);
    }
}
