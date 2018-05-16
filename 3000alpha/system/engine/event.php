<?php
/**
 * @package       MyCnCart
 * @作者        	  杨兆锋
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
 */

class Event {
	protected $registry;
	protected $data = array();
	
	/**
	 * 构造函数
	 *
	 * @参数		对象	$route
 	*/
	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	/**
	 * @参数		字符串	$trigger
	 * @参数		对象		$action
	 * @参数		数字型	$priority
 	*/	
	public function register($trigger, Action $action, $priority = 0) {
		$this->data[] = array(
			'trigger'  => $trigger,
			'action'   => $action,
			'priority' => $priority
		);
		
		$sort_order = array();

		foreach ($this->data as $key => $value) {
			$sort_order[$key] = $value['priority'];
		}

		array_multisort($sort_order, SORT_ASC, $this->data);	
	}
	
	/**
	 * @参数		字符串	$event
	 * @参数		数组		$args
 	*/		
	public function trigger($event, array $args = array()) {
		foreach ($this->data as $value) {
			if (preg_match('/^' . str_replace(array('\*', '\?'), array('.*', '.'), preg_quote($value['trigger'], '/')) . '/', $event)) {
				$result = $value['action']->execute($this->registry, $args);

				if (!is_null($result) && !($result instanceof Exception)) {
					return $result;
				}
			}
		}
	}
	
	/**
	 * @参数		字符串	$trigger
	 * @参数		字符串	$route
 	*/	
	public function unregister($trigger, $route) {
		foreach ($this->data as $key => $value) {
			if ($trigger == $value['trigger'] && $value['action']->getId() == $route) {
				unset($this->data[$key]);
			}
		}			
	}
	
	/**
	 * @参数		字符串	$trigger
 	*/		
	public function clear($trigger) {
		foreach ($this->data as $key => $value) {
			if ($trigger == $value['trigger']) {
				unset($this->data[$key]);
			}
		}
	}	
}