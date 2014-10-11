<?php
Class Ehimeprefecture_Reports_Model_ReportCollection Extends Varien_Data_Collection_Db
{
    /**
     * There should probably be a collection model that is specific to the pie chart
     * type, which has specific json handling. We should map a drop down type field
     * on the report definition to map to this.
     */

    public function toReportJson()
    {
        $results = array(); // $results = [];
        $first   = true;

        /*
         * @var $item Varien_Object
         */
        foreach ($this AS $item)
        {
            if ($first)
            {
                $labels = array(); // $labels = [];

                foreach ($item->getData() AS $key => $value) $labels[] = $key;

                $results[] = $labels;
                $first = false;
            }

            $row = array(); // $row = [];

            foreach ($item->getData() AS $key => $value)
            {
                if (is_numeric($value)) $value = (float)$value;

                $row[] = $value;
            }

            $results[] = $row;
        }
        $jsonEncoded = json_encode($results);

        return $jsonEncoded;
    }

    public function toCalendarJson()
    {
        $results = array(); // $results = [];

        foreach ($this AS $item)
        {
            $row = array(); // $row = [];

            foreach ($item->getData() as $key => $value)
            {
                if (is_numeric($value) && $value < 1000000) $value = (float)$value;

                $row[] = $value;
            }
            $results[] = $row;
        }
        $jsonEncoded = json_encode($results);

        return $jsonEncoded;
    }

}