<?php
// PositionAdmin.php
class PositionAdmin extends ModelAdmin {

    private static $managed_models = array(
    	"Department",
        "Position",
        "PositionQuestion"
    );

    private static $menu_title = 'Positions';

    private static $url_segment = "positions";

    function getSomeVar() {
	  return _t('PositionAdmin.MENU', $this->stat('menu_title'));
	}

}