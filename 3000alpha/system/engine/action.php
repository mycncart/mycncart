<?php
/**
 * @package       MyCnCart
 * @作者        	  杨兆锋
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
*/

/**
 * 操作类
 */
class Action {
	private $id;
	private $route;
	private $method = 'index';

	/**
	 * 构造函数
	 *
	 * @参数    字符串 $route
	 */
	public function __construct($route) {
		$this->id = $route;

		$parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

		// 拆分路由
		while ($parts) {
			$file = DIR_APPLICATION . 'controller/' . implode('/', $parts) . '.php';

			if (is_file($file)) {
				$this->route = implode('/', $parts);

				break;
			} else {
				$this->method = array_pop($parts);
			}
		}
	}

	/**
	 * @返回    字符串
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @参数    对象 $registry
	 * @参数    数组 $args
	 */
	public function execute($registry, array $args = array()) {
		
		// 禁止任何魔术方法被调用
		if (substr($this->method, 0, 2) == '__') {
			return new \Exception('错误: 不允许调用魔术方法！');
		}

		$file = DIR_APPLICATION . 'controller/' . $this->route . '.php';
		$class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $this->route);

		// 如果是文件，则初始化该类
		if (is_file($file)) {
			include_once($file);

			$controller = new $class($registry);
		} else {
			return new \Exception('错误: 无法调用 ' . $this->route . '/' . $this->method . '!');
		}

		$reflection = new ReflectionClass($class);

		if ($reflection->hasMethod($this->method) && $reflection->getMethod($this->method)->getNumberOfRequiredParameters() <= count($args)) {
			return call_user_func_array(array($controller, $this->method), $args);
		} else {
			return new \Exception('错误: 无法调用 ' . $this->route . '/' . $this->method . '!');
		}
	}
}
