<?php

class Order extends DataObject {

    private static $db             = array(
        'OrderDate'        => 'Date',
        'Status'           => 'i18nEnum("Pendling, Approved, Disaproved", "Pendling")',
        'DisaproveReason'  => 'Text'
    );

    
    //Translate enum values(Statuses)
    public function DbField() {
        return i18nEnum::getTranslatedValue($this->className, __FUNCTION__, $this->{__FUNCTION__});
    }
    
    private static $has_one        = array(
        'Position' => 'Position',
        'Member'   => 'Member',
        'MotivationLetter' => 'File'
    );
    private static $summary_fields = array(
        'MemberName',
        'PositionTitle',
        'i18nStatus'
    );

    function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);

        $labels['MotivationLetter']       = _t('Order.MotivationLetter', "Motivation Letter");
        $labels['OrderDate']       = _t('Order.OrderDate', "Order Date");
        $labels['i18nStatus']      = _t('Order.Status', "Status");
        $labels['DisaproveReason'] = _t('Order.DisaproveReason', "DisaproveReason");
        $labels['MemberName']      = _t('Order.MemberName', "MemberName");
        $labels['PositionTitle']   = _t('Order.PositionTitle', "PositionTitle");

        return $labels;
    }
    
    public function geti18nStatus() { 
        //return $this->Status;
        return _t('Order.db_Status_'.$this->Status, $this->Status);
    }

    public function getMemberName() {
        $Member = Member::get()->byId($this->MemberID);
        return $Member->FirstName;
    }

    public function getPositionTitle() {
        return $this->Position()->Name;
    }

    public function populateDefaults() {
        $this->OrderDate = date("Y-m-d");
    }


    //if(Permission::checkMember($this->owner->ID, "VIEW_FORUM")) {
    public function canView($member = null) {
        //return Permission::check('CMS_ACCESS_StatusesBar', 'any', $member);
        //return (Permission::check($member, 'ADMIN') || ($member && $member->ID == $this->MemberID));
        return ((Permission::check('ADMIN')) || (Member::currentUserID() == $this->MemberID));
        //return Permission::check($member, $this->owner);
    }

    public function canEdit($member = null) {
        return Permission::check('ADMIN');
    }

    public function canDelete($member = null) {
        return Permission::check('ADMIN');
    }

    public function canCreate($member = null) {
        //return Permission::check('CMS_ACCESS_StatusesBar', 'any', $member);
        return Permission::check('ADMIN');
    }
    
    function getCMSFields() {
        $fields = parent::getCMSFields();
        $upload = new UploadField(
                    $name = 'MotivationLetter',
                    $title = _t('Order.MotivationLetter', 'Motivation Letter')
                );
        $upload->setConfig('allowedMaxFileNumber', 1);
        $upload->getValidator()->setAllowedExtensions(array('doc', 'docx'));
        $fields->addFieldToTab('Root.Main', $upload);
        
    
        return $fields;
    }

}
