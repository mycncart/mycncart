<?php
// Configuration
if (is_file('../../config.php')) {
	require_once('../../config.php');
}


// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();

$registry->set('config', $config);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

// Store
if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
	$store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`ssl`, 'www.', '') = '" . $db->escape('https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
} else {
	$store_query = $db->query("SELECT * FROM " . DB_PREFIX . "store WHERE REPLACE(`url`, 'www.', '') = '" . $db->escape('http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/') . "'");
}

if ($store_query->num_rows) {
	$config->set('config_store_id', $store_query->row['store_id']);
} else {
	$config->set('config_store_id', 0);
}

// Settings
$query = $db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' OR store_id = '" . (int)$config->get('config_store_id') . "' ORDER BY store_id ASC");

foreach ($query->rows as $result) {
	if (!$result['serialized']) {
		$config->set($result['key'], $result['value']);
	} else {
		$config->set($result['key'], unserialize($result['value']));
	}
}


require_once(DIR_SYSTEM . 'library/wxpayexception.php');


define('APPID', $config->get('wxpay_appid'));
define('MCHID', $config->get('wxpay_mchid'));
define('KEY', $config->get('wxpay_key'));
define('APPSECRET', $config->get('wxpay_appsecret'));
define('SSLCERT_PATH', DIR_SYSTEM.'helper/wxpay_api/apiclient_cert.pem');
define('SSLKEY_PATH', DIR_SYSTEM.'helper/wxpay_api/apiclient_key.pem');
define('CURL_PROXY_HOST', '0.0.0.0');
define('CURL_PROXY_PORT', 0);
define('REPORT_LEVENL', 1);


require_once(DIR_SYSTEM . 'library/wxpaydata.php');

require_once(DIR_SYSTEM . 'library/wxpayapi.php');


require_once(DIR_SYSTEM . 'library/wxpayjsapipay.php');

$tools = new JsApiPay();

$openId = $tools->GetOpenid();

?>