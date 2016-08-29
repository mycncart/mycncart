<?php
// Site
$_['site_base']         = HTTP_SERVER;
$_['site_ssl']          = HTTP_SERVER;

// Language
$_['language_default']  = 'zh-cn';
$_['language_autoload'] = array('zh-cn');

// Actions
$_['action_default']    = 'install/step_1';
$_['action_router']     = 'startup/router';
$_['action_error']      = 'error/not_found';
$_['action_pre_action'] = array(
	'startup/language',
	'startup/upgrade',
	'startup/database'
);