<?php
Class Ehimeprefecture_Reports_Model_Report_GridConfig Extends Varien_Object
{
    /**
     * get list of filterable columns
     * @return array
     */
    public function getFilterable()
    {
        $filterable = $this->getData('filterable');

        return (is_array($filterable))
            ? $filterable
            : array();  // [];
    }
}