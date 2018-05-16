<?php
/**
 * @package       MyCnCart
 * @作者        	  青岛万物一体网络科技有限公司
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
**/

function token($length = 32) {
	if(!isset($length) || intval($length) <= 8 ){
		$length = 32;
	}	
	if (function_exists('random_bytes')) {
		$token = bin2hex(random_bytes($length));
	}
	if (function_exists('mcrypt_create_iv') && phpversion() < '7.1') {
		$token = bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
	}
	if (function_exists('openssl_random_pseudo_bytes')) {
		$token = bin2hex(openssl_random_pseudo_bytes($length));
	}
	return substr($token, -$length, $length);
}

/**
 * http://php.net/manual/en/function.hash-equals.php
**/

if(!function_exists('hash_equals')) {
	function hash_equals($known_string, $user_string) {
		$known_string = (string)$known_string;
		$user_string = (string)$user_string;

		if(strlen($known_string) != strlen($user_string)) {
			return false;
		} else {
			$res = $known_string ^ $user_string;
			$ret = 0;

			for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);

			return !$ret;
		}
	}
}
