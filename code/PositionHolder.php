<?php

class PositionHolder extends Page {

    private static $db               = array(
    );
    private static $allowed_children = array(
        'Position'
    );
    private static $has_many         = array(
        'Positions' => 'Position',
    );

    function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);

        $labels['Position']  = _t('PositionHolder.Position', 'Position');
        $labels['Positions'] = _t('PositionHolder.Positions', 'Positions');
        $labels['Orders'] = _t('Orders.PLURALNAME', 'Orders');

        return $labels;
    }

}

class PositionHolder_Controller extends Page_Controller {

    private static $allowed_actions = array(
        'addingStatus',
        'anketaForm',
        'saveAnket',
        'formSetOrder',
        'submitForm'
    );

    public function setMessage($type, $message)
    {
        Session::set('Message', array(
            'MessageType' => $type,
            'Message' => $message
        ));
    }

    public function getMessage()
    {
        if($message = Session::get('Message')){
            Session::clear('Message');
            $array = new ArrayData($message);
            return $array->renderWith('Message');
        }
    }

    function init() {
        parent::init();
        Requirements::insertHeadTags('<meta http-equiv="Content-language" content="' . i18n::get_locale() . '" />');
        Requirements::add_i18n_javascript('ss-position-module/javascript/lang');
        Requirements::javascript("http://code.jquery.com/jquery-1.10.2.js");
        Requirements::javascript("ss-position-module/javascript/alertifyjs/lib/alertify.min.js");
        Requirements::javascript("ss-position-module/javascript/position_module.js");
        Requirements::css("ss-position-module/javascript/alertifyjs/themes/alertify.core.css");
        Requirements::css("ss-position-module/javascript/alertifyjs/themes/alertify.default.css");
        Requirements::css("ss-position-module/css/position_module.css");

    }

    public function anketaForm() {
        $fields = FieldList::create(
                TextField::create('Name', _t('MemberExtend.FirstName', "Name")),
                TextField::create('Surname', _t('MemberExtend.SecondName', "Surname")),
                TextField::create('PhoneWork', _t('MemberExtend.PhoneWork', "Phone Work")),
                TextField::create('PhoneMobile', _t('MemberExtend.PhoneMobile', "Phone Mobile")),
                TextField::create('Education', _t('MemberExtend.Education', "Education")),
                EmailField::create('CorporateEmail', _t('MemberExtend.CorporateEmail', "Corporate Email")),
                DateField::create('Birthday', _t('MemberExtend.Birthday', "Birthday")),
                TextField::create('TabNumber', _t('MemberExtend.TabNumber', "Tab Number")),
                TextField::create('CurrentPosition', _t('MemberExtend.CurrentPosition', "Current Position")),
                TextareaField::create('CurrentPositionExperience', _t('MemberExtend.CurrentPositionExperience', "Current Position Experience")),
                TextField::create('Languages', _t('MemberExtend.Languages', "Languages"))
        );

        $actions = FieldList::create(
                        FormAction::create("saveAnket")->setTitle(_t('anketaForm.saveAnket', 'Сохранить анкету'))
        );

        $required = RequiredFields::create('Name', 'Surname', 'PhoneWork', 'PhoneMobile', 'Education', 'CorporateEmail', 'Birthday', 'TabNumber', 'CurrentPosition', 'CurrentPositionExperience', 'Languages');

        $form = Form::create($this, 'anketaForm', $fields, $actions, $required);
        $form->addExtraClass('form-horizontal');
        //$form->Fields()->addExtraClass('requiredField form-control');
        //Load your data into the form here.
        $form->loadDataFrom(Member::get()->byId(Member::currentUserID()));

        return $form;
    }

    public function saveAnket($data, $form) {
        $user = Member::get()->byId(Member::currentUserID());
        $form->saveInto($user);
        $user->write();

        $form->setMessage('Success', _t('saveAnket.sucess', 'Your anket is update!'));
        return $this->redirectBack();
    }

    public function formSetOrder() {
        $fields                     = new FieldList(
                new HiddenField('PositionID', 'PositionID'),
                new HiddenField('MemberID', 'MemberID', Member::currentUserID()),
                $field = new UploadField('MotivationLetter', _t('formSetOrder.addLetter', 'Add motivation letter'))
        );
        $field->setConfig('allowedMaxFileNumber', 1);
        $field->getValidator()->setAllowedExtensions(array('doc','docx'));
        $field->setCanAttachExisting(false); // Block access to SilverStripe assets library
        $field->getUpload()->setReplaceFile(false);
        $field->setOverwriteWarning(false);
        $field->setCanPreviewFolder(false); // Don't show target filesystem folder on upload field
        $field->relationAutoSetting = false; // Prevents the form thinking the GalleryPage is the underlying object
        $required                   = new RequiredFields('MotivationLetter');
        $actions                    = new FieldList(new FormAction('submitForm', _t('formSetOrder.submit', 'Create an Order')));
        return new Form($this, 'formSetOrder', $fields, $actions, $required);
    }

    public function submitForm($data, $form) {
        $order = Order::create();
        $form->saveInto($order);
        $result = $order->write();

        if (!empty($result)) {
            $this->setMessage('Success', _t('submitForm.success', 'You order is set!'));
        }
        else {
            $this->setMessage('failed', 'bad');
        }
        return $this->redirectBack();
        //return $this->redirectBack();
    }

    public function addingStatus($data) {
        $positionId   = $this->request->param('ID');
        $positionName = Position::get()->byId($positionId)->Name;
        $memberId     = Member::currentUserID();
        if (Director::is_ajax()) {
            //Debug::show($data);
            if (Member::currentUserID()) {
                //$order             = Order::create();
                //$order->PositionID = $positionId;
                //$order->MemberID   = $memberId;
                //$id   = $order->write();
                //$data = $id;
                $data = $positionName;
            } else {
                $data = _t("addingStaus.False","You cannot set the order. Please login or register.");
            }
            return $data;
        }
    }

    /*public function getOrders() {
        $orders = Orders::get()->byId();
        $member = $player->Team();
        // returns a 'Team' instance.

        echo $player->Member::currentUserID()()->Title;
        // returns the 'Title' column on the 'Team' or `getTitle` if it exists.
    }*/

}
