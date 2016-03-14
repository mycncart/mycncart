<?php
// Version
define('VERSION', '1.4.0.0');

// Configuration
require_once('../../../config.php');

date_default_timezone_set('PRC');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

$application_config = 'catalog';

$pay_method_callback = 'payment/alipay_guarantee/callback';


// Application
require_once(DIR_SYSTEM . 'framework.php');