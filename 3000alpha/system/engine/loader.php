<?php
/**
 * @package       MyCnCart
 * @作者        	  杨兆锋
 * @版权     	  (c) 2018 - 2019 , 青岛万物一体网络科技有限公司. (https://www.mycncart.com/)
 * @授权协议       https://opensource.org/licenses/GPL-3.0
 * @网站链接       https://www.mycncart.com
 */


final class Loader {
	protected $registry;

	/**
	 * 构造函数
	 * @参数		对象		$registry
	 */
	public function __construct($registry) {
		$this->registry = $registry;
	}

	/**
	 * 加载控制器
	 * @参数    字符串 $route
	 * @参数    数组 $data
	 * @返回   混合
	 */
	public function controller($route) {
		$args = func_get_args();

		array_shift($args);

		// 审核调用
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

		// 保持起始触发器
		$trigger = $route;

		// 触发前置事件
		$result = $this->registry->get('event')->trigger('controller/' . $trigger . '/before', array(&$route, &$args));

		// 如果必须，确保是最后一个事件
		if ($result != null && !$result instanceof Exception) {
			$output = $result;
		} else {
			$action = new Action($route);
			$output = $action->execute($this->registry, $args);
		}

		// 触发后置事件
		$result = $this->registry->get('event')->trigger('controller/' . $trigger . '/after', array(&$route, &$args, &$output));

		if ($result && !$result instanceof Exception) {
			$output = $result;
		}

		if (!$output instanceof Exception) {
			return $output;
		}
	}

	/**
	 * 加载数据层
	 * @参数    字符串 $route
	 */
	public function model($route) {
		// 审查调用
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

		if (!$this->registry->has('model_' . str_replace('/', '_', $route))) {
			$file = DIR_APPLICATION . 'model/' . $route . '.php';
			$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $route);

			if (is_file($file)) {
				include_once($file);

				$proxy = new Proxy();

				// 覆盖数据层比较困难，因此先使用PHP的魔术方法，未来版本考虑使用runkit
				foreach (get_class_methods($class) as $method) {
					$proxy->{$method} = $this->callback($this->registry, $route . '/' . $method);
				}

				$this->registry->set('model_' . str_replace('/', '_', (string)$route), $proxy);
			} else {
				throw new \Exception('错误: 无法加载数据层 ' . $route . '!');
			}
		}
	}

	/**
	 * 加载视图
	 * @参数    字符串	 $route
	 * @参数    数组		 $data
	 * @返回    字符串
	 */
	public function view($route, $data = array()) {
		// 审查调用
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

		// 保持起始触发器
		$trigger = $route;

		// 模板内容，不是输出！
		$template = '';

		// 触发前置事件
		$result = $this->registry->get('event')->trigger('view/' . $trigger . '/before', array(&$route, &$data, &$template));

		// 如果必须，确保是最后一个事件
		if ($result && !$result instanceof Exception) {
			$output = $result;
		} else {
			$template = new Template($this->registry->get('config')->get('template_engine'));

			foreach ($data as $key => $value) {
				$template->set($key, $value);
			}

			$output = $template->render($this->registry->get('config')->get('template_directory') . $route, $this->registry->get('config')->get('template_cache'));
		}

		// 触发后置事件
		$result = $this->registry->get('event')->trigger('view/' . $trigger . '/after', array(&$route, &$data, &$output));

		if ($result && !$result instanceof Exception) {
			$output = $result;
		}

		return $output;
	}

	/**
	 * 加载类
	 *
	 * @参数    字符串  $route
	 */
	public function library($route) {
		// Sanitize the call
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

		$file = DIR_SYSTEM . 'library/' . $route . '.php';
		$class = str_replace('/', '\\', $route);

		if (is_file($file)) {
			include_once($file);

			$this->registry->set(basename($route), new $class($this->registry));
		} else {
			throw new \Exception('错误: 无法加载类 ' . $route . '!');
		}
	}

	/**
	 * 加载 Helper 下函数
	 *
	 * @参数    字符串   $route
	 */
	public function helper($route) {
		$file = DIR_SYSTEM . 'helper/' . preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route) . '.php';

		if (is_file($file)) {
			include_once($file);
		} else {
			throw new \Exception('Error: Could not load helper ' . $route . '!');
		}
	}

	/**
	 *  加载配置
	 *
	 * @参数    string $route
	 */
	public function config($route) {
		
		// 触发前置事件
		$this->registry->get('event')->trigger('config/' . $route . '/before', array(&$route));

		$this->registry->get('config')->load($route);
		
		// 触发后置事件
		$this->registry->get('event')->trigger('config/' . $route . '/after', array(&$route));
	}

	/**
	 * 加载语言包
	 *
	 * @参数    string $route
	 * @参数    string $key
	 *
	 * @return    array
	 */
	public function language($route, $key = '') {
		// 审查路由
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

		// 保持初始触发器
		$trigger = $route;
		
		// 触发前置事件
		$result = $this->registry->get('event')->trigger('language/' . $trigger . '/before', array(&$route, &$key));

		if ($result && !$result instanceof Exception) {
			$output = $result;
		} else {
			$output = $this->registry->get('language')->load($route, $key);
		}
		
		// 触发后置事件
		$result = $this->registry->get('event')->trigger('language/' . $trigger . '/after', array(&$route, &$key, &$output));

		if ($result && !$result instanceof Exception) {
			$output = $result;
		}

		return $output;
	}

	protected function callback($registry, $route) {
		return function ($args) use ($registry, $route) {
			static $model;

			$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

			// 保持初始触发器
			$trigger = $route;

			// 触发前置事件
			$result = $registry->get('event')->trigger('model/' . $trigger . '/before', array(&$route, &$args));

			if ($result && !$result instanceof Exception) {
				$output = $result;
			} else {
				$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', substr($route, 0, strrpos($route, '/')));

				// 保存数据库对象
				$key = substr($route, 0, strrpos($route, '/'));

				if (!isset($model[$key])) {
					$model[$key] = new $class($registry);
				}

				$method = substr($route, strrpos($route, '/') + 1);

				$callable = array($model[$key], $method);

				if (is_callable($callable)) {
					$output = call_user_func_array($callable, $args);
				} else {
					throw new \Exception('错误: 无法加载 model/' . $route . '!');
				}
			}

			// 触发后置事件
			$result = $registry->get('event')->trigger('model/' . $trigger . '/after', array(&$route, &$args, &$output));

			if ($result && !$result instanceof Exception) {
				$output = $result;
			}

			return $output;
		};
	}
}