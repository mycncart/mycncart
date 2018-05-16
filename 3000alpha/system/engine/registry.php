<?php
/**
 * @package       MyCnCart
 * @作者        	  杨兆锋
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
*/


final class Registry {
	private $data = array();

	/**
     * @参数		字符串	$key
	 * @返回		混合
     */
	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

    /**
     * @参数		字符串	$key
	 * @参数		字符串	$value
     */	
	public function set($key, $value) {
		$this->data[$key] = $value;
	}
	
    /**
     * @参数	string	$key
	 * @返回		bool
     */
	public function has($key) {
		return isset($this->data[$key]);
	}
}