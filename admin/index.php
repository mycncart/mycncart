<?php
// Version
define('VERSION', '1.5.0.1');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: ../install/index.php');
	exit;
}

define('PAY_METHOD_CALLBACK', '');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('admin');