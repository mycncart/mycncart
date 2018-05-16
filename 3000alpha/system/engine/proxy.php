<?php
/**
 * @package       MyCnCart
 * @作者        	  杨兆锋
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
*/

class Proxy {
    /**
     * @参数		字符串	$key
     */	
	public function &__get($key) {
		return $this->{$key};
	}	

    /**
     * @参数		字符串	$key
	 * @参数		字符串	$value
     */	
	public function __set($key, $value) {
		 $this->{$key} = $value;
	}
	
	public function __call($key, $args) {
		$arg_data = array();
		
		$args = func_get_args();
		
		foreach ($args as $arg) {
			if ($arg instanceof Ref) {
				$arg_data[] =& $arg->getRef();
			} else {
				$arg_data[] =& $arg;
			}
		}
		
		if (isset($this->{$key})) {		
			return call_user_func_array($this->{$key}, $arg_data);	
		} else {
			$trace = debug_backtrace();

			exit('<b>Notice</b>:  Undefined property: Proxy::' . $key . ' in <b>' . $trace[1]['file'] . '</b> on line <b>' . $trace[1]['line'] . '</b>');
		}
	}
}