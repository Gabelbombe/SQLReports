<?php
Class Ehimeprefecture_Reports_Model_Config_Connections //connection config source model
{
    /**
     * Generate option array based on configured database resources
     *
     * @return array
     */
    public function toOptionArray()
    {
        $resourceConfig = Mage::helper('ehime')->getConnectionResourceConfig();
        //$options        = [];
        $options        = array();

        foreach ($resourceConfig AS $connNode)
        {
            /*
             * @var $connNode Mage_Core_Model_Config_Element
             */
            //$options[] = [
            //    'label' => $connNode->getName(),
            //    'value' => $connNode->getName()
            //];

            $options[] = array(
                'label' => $connNode->getName(),
                'value' => $connNode->getName()
            );
        }

        return $options;
    }
}
