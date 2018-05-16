<?php
/**
*
* 该配置应用于PC路由参数
*
**/

// 网址
$_['site_url']           = HTTP_SERVER;
$_['site_ssl']           = HTTPS_SERVER;

// URL
$_['url_autostart']      = false;

// 数据库
$_['db_autostart']       = true;
$_['db_engine']          = DB_DRIVER; // mpdo, mssql, mysql, mysqli or postgre
$_['db_hostname']        = DB_HOSTNAME;
$_['db_username']        = DB_USERNAME;
$_['db_password']        = DB_PASSWORD;
$_['db_database']        = DB_DATABASE;
$_['db_port']            = DB_PORT;

// 会话
$_['session_autostart']  = true;
$_['session_engine']     = 'db';
$_['session_name']       = 'MCCSESSID';

// 模板
$_['template_engine']    = 'twig';
$_['template_directory'] = '';
$_['template_cache']     = true;

// 自动加载类文件
$_['library_autoload']   = array();

// 前置运行程序操作
$_['action_pre_action']  = array(
	'startup/session',
	'startup/startup',
	'startup/error',
	'startup/event',
	'startup/maintenance',
	'startup/seo_url'
);

// 操作事件
$_['action_event'] = array(
	'controller/*/before' => array(
		'event/language/before'
	),
	'controller/*/after' => array(
		'event/language/after'
	),	
	'view/*/before' => array(
		500  => 'event/theme/override',
		998  => 'event/language',
		1000 => 'event/theme'
	),
	'language/*/after' => array(
		'event/translation'
	),
);