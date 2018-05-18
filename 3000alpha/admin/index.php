<?php
/**
 * @package       MyCnCart
 * @作者        	  青岛万物一体网络科技有限公司
 * @版权     	  (c) 2015 - 2018 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
**/

// 定义版本
define('VERSION', '3.0.0.0alpha');

// 加载配置文件
if (is_file('config.php')) {
	require_once('config.php');
}

// 如果没有定义相关变量，则转向到安装目录
if (!defined('DIR_APPLICATION')) {
	header('Location: ../install/index.php');
	exit;
}

// 加载所需类和函数
require_once(DIR_SYSTEM . 'startup.php');

// 加载后台配置
start('admin');