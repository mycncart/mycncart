<?php
// Configuration
if (is_file('../../config.php')) {
	require_once('../../config.php');
}


require_once(DIR_SYSTEM . 'library/wxpayexception.php');

require_once(DIR_SYSTEM . 'library/wxpayconfig.php');

require_once(DIR_SYSTEM . 'library/wxpaydata.php');

require_once(DIR_SYSTEM . 'library/wxpayapi.php');


require_once(DIR_SYSTEM . 'library/wxpayjsapipay.php');


$tools = new JsApiPay();

$openId = $tools->GetOpenid();

?>