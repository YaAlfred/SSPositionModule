<?php

class MemberExtend extends DataExtension {

    private static $db = array(
        'PhoneWork'                 => 'Varchar(255)',
        'PhoneMobile'               => 'Varchar(255)',
        'Education'                 => 'Varchar(255)',
        'CorporateEmail'            => 'Varchar(255)',
        'Birthday'                  => 'Date',
        'TabNumber'                 => 'Int',
        'CurrentPosition'           => 'Varchar(255)',
        'CurrentPositionExperience' => 'Text',
        'Languages'                 => 'Text'
    );
    
    public function updateMemberFormFields(FieldList $fields) {
        $fields->push(new TextField('PhoneWork', _t('MemberExtend.PhoneWork', "Phone Work")));
        $fields->push(new TextField('PhoneMobile', _t('MemberExtend.PhoneMobile', "Phone Mobile")));
        $fields->push(new TextField('Education', _t('MemberExtend.Education', "Education")));
        $fields->push(new EmailField('CorporateEmail', _t('MemberExtend.CorporateEmail', "Corporate Email")));
        $fields->push(new DateField('Birthday', _t('MemberExtend.Birthday', "Birthday")));
        $fields->push(new TextField('TabNumber', _t('MemberExtend.TabNumber', "Tab Number")));
        $fields->push(new TextField('CurrentPosition', _t('MemberExtend.CurrentPosition', "Current Position")));
        $fields->push(new TextareaField('CurrentPositionExperience', _t('MemberExtend.PhoneWork', "Phone Work")));
        $fields->push(new TextField('Languages', _t('MemberExtend.Languages', "Languages")));
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();
	$this->extend('updateMemberFormFields', $fields, $actions); 
        return $fields; 
    }

}
