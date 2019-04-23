<?php
function token($length = 32) {
	if (!isset($length) || intval($length) <= 8) {
		$length = 32;
	}

	if (function_exists('random_bytes')) {
		$token = bin2hex(random_bytes($length));
	}

	if (function_exists('mcrypt_create_iv') && version_compare(phpversion(), '7.1', '<')) {
		$token = bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
	}

	if (function_exists('openssl_random_pseudo_bytes')) {
		$token = bin2hex(openssl_random_pseudo_bytes($length));
	}

	return substr($token, -$length, $length);
}

/**
 * Backwards support for timing safe hash string comparisons
 *
 * http://php.net/manual/en/function.hash-equals.php
 */

if (!function_exists('hash_equals')) {
	function hash_equals($known_string, $user_string) {
		$known_string = (string)$known_string;
		$user_string = (string)$user_string;

		if (strlen($known_string) != strlen($user_string)) {
			return false;
		} else {
			$res = $known_string ^ $user_string;
			$ret = 0;

			for ($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);

			return !$ret;
		}
	}
}

/**
 *
 * 获取ip
**/
function getIp() {
	$ip = false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}

  	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
   		if ($ip) {
   			array_unshift($ips, $ip); 
   			$ip = FALSE; 
   		}

   		for ($i = 0; $i < count($ips); $i++) {
    		//if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
     			$ip = $ips[$i];
     			break;
    		//}
   		}
  	}

  	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}
	 
/**
 *
 * 获取地址
**/
function getLocation($ip) {
    if ($ip == "127.0.0.1") {
    	return "本机地址";
    }

    $api = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
    $arr = json_decode($api, true);
   
    $country = $arr['data']['country'];
    $province = $arr['data']['region'];
    $city = $arr['data']['city'];

    $location = '';
	    
    if ((string)$country == "中国") {
	        
        if ((string)($province) != (string)$city) {
            $location = $country . $province . $city;
        } else {
            $location = $country . $city;
        }

    } else {
        $location = $country;
    }

    return $location;
}

/**
 *
 * 获取用户浏览器类型
**/
function getBrowser() {
 	$agent=$_SERVER["HTTP_USER_AGENT"];
 	if (strpos($agent,'MSIE') !== false || strpos($agent,'rv:11.0')) {
 		return "ie";
 	} elseif (strpos($agent,'Firefox') !== false) {
		return "firefox";
 	} elseif (strpos($agent,'Chrome') !== false) {
   		return "chrome";
  	} elseif (strpos($agent,'Opera') !== false) {
   		return 'opera';
  	} elseif ((strpos($agent,'Chrome') == false) && strpos($agent,'Safari') !== false) {
   		return 'safari';
  	} else {
   		return 'unknown';
	}
}

/**
 *
 * 获取网站来源
**/	 
function getFromPage(){
 	$http_referer = '';
 	if (isset($_SERVER['HTTP_REFERER'])) {
 		$http_referer = $_SERVER['HTTP_REFERER'];
 	}

 	return $http_referer;
 	
}
