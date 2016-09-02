<?php
// Version
define('VERSION', '1.5.0.0');

// Configuration
require_once('../../../../config.php');

date_default_timezone_set('PRC');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

define('PAY_METHOD_CALLBACK', 'extension/payment/wxpay/callback');
start('catalog');