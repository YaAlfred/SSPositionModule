<?php

class Department extends DataObject {

    private static $db = array(
        'Name' => 'Varchar(255)',
        //"ExternalURL" => "Text"
    );

    function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);
        
        $labels['Name']    = _t('Department.Name', "Department");      

        return $labels;
    }

    private static $has_many = array(
        'Positions' => 'Position'
    );

}
