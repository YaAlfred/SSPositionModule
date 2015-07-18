<?php

// PositionAdmin.php
class OrderAdmin extends ModelAdmin {

    private static $managed_models = array(
        "Order"
    );
    private static $url_segment = "Orders";
    
}
