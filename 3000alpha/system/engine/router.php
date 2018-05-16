<?php
/**
 * @package       MyCnCart
 * @作者        	  杨兆锋
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
*/

final class Router {
	private $registry;
	private $pre_action = array();
	private $error;
	
	/**
	 * 构造函数
	 * @参数		对象		$route
 	*/
	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	/**
	 * @参数		对象		$pre_action
 	*/	
	public function addPreAction(Action $pre_action) {
		$this->pre_action[] = $pre_action;
	}

	/**
	 * @参数		对象		$action
	 * @参数		对象		$error
 	*/		
	public function dispatch(Action $action, Action $error) {
		$this->error = $error;

		foreach ($this->pre_action as $pre_action) {
			$result = $this->execute($pre_action);

			if ($result instanceof Action) {
				$action = $result;

				break;
			}
		}

		while ($action instanceof Action) {
			$action = $this->execute($action);
		}
	}
	
	/**
	 * @参数		对象		$action
	 * @return	对象
 	*/
	private function execute(Action $action) {
		$result = $action->execute($this->registry);

		if ($result instanceof Action) {
			return $result;
		} 
		
		if ($result instanceof Exception) {
			$action = $this->error;
			
			$this->error = null;
			
			return $action;
		}
	}
}