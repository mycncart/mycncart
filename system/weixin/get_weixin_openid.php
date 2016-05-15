<?php
// Version
define('VERSION', '1.4.0.0');

// Configuration
require_once('../../config.php');

date_default_timezone_set('PRC');


require_once(DIR_SYSTEM . 'library/wxpayexception.php');


define('APPID', '');
define('MCHID', '');
define('KEY', '');
define('APPSECRET', '');
define('SSLCERT_PATH', DIR_SYSTEM.'helper/wxpay_api/apiclient_cert.pem');
define('SSLKEY_PATH', DIR_SYSTEM.'helper/wxpay_api/apiclient_key.pem');
define('CURL_PROXY_HOST', '0.0.0.0');
define('CURL_PROXY_PORT', 0);
define('REPORT_LEVENL', 1);

require_once(DIR_SYSTEM.'library/wxpayconfig.php');

require_once(DIR_SYSTEM . 'library/wxpaydata.php');

require_once(DIR_SYSTEM . 'library/wxpayapi.php');


require_once(DIR_SYSTEM . 'library/wxpayjsapipay.php');

$tools = new JsApiPay();

$openId = $tools->GetOpenid();

?>