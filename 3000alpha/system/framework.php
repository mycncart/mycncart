<?php
// 生成加载对象
$registry = new Registry();

// 生成配置对象
$config = new Config();

// 加载默认配置
$config->load('default');
$config->load($application_config);
$registry->set('config', $config);

// 日志
$log = new Log($config->get('error_filename'));
$registry->set('log', $log);

date_default_timezone_set($config->get('date_timezone'));

set_error_handler(function($code, $message, $file, $line) use($log, $config) {
	// error suppressed with @
	if (error_reporting() === 0) {
		return false;
	}

	switch ($code) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = '提示';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = '警告';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = '致命错误';
			break;
		default:
			$error = '未知';
			break;
	}

	if ($config->get('error_display')) {
		echo '<b>' . $error . '</b>: ' . $message . ', 在文件 <b>' . $file . '</b> 第 <b>' . $line . ' 行</b>';
	}

	if ($config->get('error_log')) {
		$log->write('PHP ' . $error . ':  ' . $message . ', 在文件 ' . $file . ' 第 ' . $line . ' 行');
	}

	return true;
});

// 事件
$event = new Event($registry);
$registry->set('event', $event);

// 注册事件
if ($config->has('action_event')) {
	foreach ($config->get('action_event') as $key => $value) {
		foreach ($value as $priority => $action) {
			$event->register($key, new Action($action), $priority);
		}
	}
}

// 加载器
$loader = new Loader($registry);
$registry->set('load', $loader);

// 请求
$registry->set('request', new Request());

// 响应
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
$registry->set('response', $response);

// 数据库
if ($config->get('db_autostart')) {
	$registry->set('db', new DB($config->get('db_engine'), $config->get('db_hostname'), $config->get('db_username'), $config->get('db_password'), $config->get('db_database'), $config->get('db_port')));
}

// 会话
$session = new Session($config->get('session_engine'), $registry);
$registry->set('session', $session);

// 为会话创建不同的cookie，从而避免混淆
if ($config->get('session_autostart')) {
	
	if (isset($_COOKIE[$config->get('session_name')])) {
		$session_id = $_COOKIE[$config->get('session_name')];
	} else {
		$session_id = '';
	}

	$session->start($session_id);

	setcookie($config->get('session_name'), $session->getId(), (ini_get('session.cookie_lifetime') ? (time() + ini_get('session.cookie_lifetime')) : 0), ini_get('session.cookie_path'), ini_get('session.cookie_domain'));
}

// 缓存
$registry->set('cache', new Cache($config->get('cache_engine'), $config->get('cache_expire')));

// Url
if ($config->get('url_autostart')) {
	$registry->set('url', new Url($config->get('site_url')));
}

// 加载默认语言
$language = new Language($config->get('language_directory'));
$registry->set('language', $language);

// 文档
$registry->set('document', new Document());

// 配置自动加载 Autoload
if ($config->has('config_autoload')) {
	foreach ($config->get('config_autoload') as $value) {
		$loader->config($value);
	}
}

// 语言自动加载
if ($config->has('language_autoload')) {
	foreach ($config->get('language_autoload') as $value) {
		$loader->language($value);
	}
}

// 类自动加载
if ($config->has('library_autoload')) {
	foreach ($config->get('library_autoload') as $value) {
		$loader->library($value);
	}
}

// 数据层自动加载
if ($config->has('model_autoload')) {
	foreach ($config->get('model_autoload') as $value) {
		$loader->model($value);
	}
}

// 路由
$route = new Router($registry);

// 前置操作
if ($config->has('action_pre_action')) {
	foreach ($config->get('action_pre_action') as $value) {
		$route->addPreAction(new Action($value));
	}
}

// 错误输出
$route->dispatch(new Action($config->get('action_router')), new Action($config->get('action_error')));

// 输出
$response->output();