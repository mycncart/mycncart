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

// 定义判断是否移动端函数
function is_mobile() { 
	if (isset($_SERVER['HTTP_USER_AGENT'])) {   
		$user_agent = $_SERVER['HTTP_USER_AGENT'];    
		$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");    
		$is_mobile = false;    
		foreach ($mobile_agents as $device) {      
			if (stristr($user_agent, $device)) {        
				$is_mobile = true;        
				break;      
			}    
		}  
		
		return $is_mobile;    
	
	} else {
		return false;
	}
}

// 加载配置文件
if (is_file('config.php')) {
	require_once('config.php');
}

// 如果没有定义相关变量，则转向到安装目录
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}

// 加载所需类和函数
require_once(DIR_SYSTEM . 'startup.php');

// 根据访问设备分别加载配置
if (is_mobile()) {
	start('mobile');
} else {
	start('pc');
}

