<?php
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

function is_weixin(){ 
	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
		return true;
	} 
	
	return false;
}

function is_iphone_ipad() {
	if (( strpos($_SERVER['HTTP_USER_AGENT'], 'iphone') !== false ) || ( strpos($_SERVER['HTTP_USER_AGENT'], 'ipad') !== false )) {
		return true;
	} 
	
	return false;
}

function getOpenid($appid, $appsecret, $code){	
	$openid_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code=' . $code . '&grant_type=authorization_code';
	
	$result_one = file_get_contents($openid_url);
	
	$result = json_decode($result_one, true);

	return $result;
}


function getWeiXinUserInfo($APPID, $APPSECRET, $openid){
	$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

	$json=file_get_contents($TOKEN_URL);
	$result=json_decode($json);

	$ACC_TOKEN=$result->access_token;
	$USER_URL = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $ACC_TOKEN . '&openid=' . $openid . '&lang=zh_CN';

	$wxuser_json = file_get_contents($USER_URL);
	$result = json_decode($wxuser_json,true);

   return $result;
}
