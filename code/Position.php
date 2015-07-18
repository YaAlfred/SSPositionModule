<?php

class Position extends DataObject {

    private static $db = array(
        'Name' => 'Varchar(255)',
    );

    function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);
        
        $labels['Name']    = _t('Position.Name', "Position");      

        return $labels;
    }

    private static $has_many = array(
        'PositionQuestions' => 'PositionQuestion',
        'Orders' => 'Order'
    );

    static $has_one = array (
        'PositionHolder' => 'PositionHolder',
        'Department' => 'Department'
    );
}
