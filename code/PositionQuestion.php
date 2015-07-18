<?php

class PositionQuestion extends DataObject {

    private static $db = array(
        'Question' => 'Text',
    );

    function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);

        $labels['Question']      = _t('PositionQuestion.Question', "Question");
        $labels['PositionTitle'] = _t('PositionQuestion.PositionTitle', "PositionTitle");

        return $labels;
    }


    private static $has_one = array(
        'Position' => 'Position',
    );
    private static $summary_fields = array(
        'Question',
        'PositionTitle'
    );

    public function getPositionTitle() {
        return $this->Position()->Name;
    }
}
