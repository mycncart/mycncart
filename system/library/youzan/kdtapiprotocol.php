<?php
class Kdtapiprotocol {
	const APP_ID_KEY = 'app_id';
	const METHOD_KEY = 'method';
	const TIMESTAMP_KEY = 'timestamp';
	const FORMAT_KEY = 'format';
	const VERSION_KEY = 'v';
	const SIGN_KEY = 'sign';
	const SIGN_METHOD_KEY = 'sign_method';
	
	const ALLOWED_DEVIATE_SECONDS = 600;
	
	
	
	const ERR_SYSTEM = -1;
	const ERR_INVALID_APP_ID = 40001;
	const ERR_INVALID_APP = 40002;
	const ERR_INVALID_TIMESTAMP = 40003;
	const ERR_EMPTY_SIGNATURE = 40004;
	const ERR_INVALID_SIGNATURE = 40005;
	const ERR_INVALID_METHOD_NAME = 40006;
	const ERR_INVALID_METHOD = 40007;
	const ERR_INVALID_TEAM = 40008;
	const ERR_PARAMETER = 41000;
	const ERR_LOGIC = 50000;
	
	
	
	public static function sign($appSecret, $params, $method = 'md5') {
		if (!is_array($params)) $params = array();
		
		ksort($params);
		$text = '';
		foreach ($params as $k => $v) {
			$text .= $k . $v;
		}
		
		return self::hash($method, $appSecret . $text . $appSecret);
	}
	
	private static function hash($method, $text) {
		switch ($method) {
			case 'md5':
			default:
				$signature = md5($text);
				break;
		}
		return $signature;
	}
	
	public static function allowedSignMethods() {
		return array('md5');
	}
	
	public static function allowedFormat() {
		return array('json');
	}
	
	
	
	public static function doc() {
		return array(
			'params' => array(
				self::APP_ID_KEY => array(
					'type' => 'String',
					'required' => true,
					'desc' => 'App ID',
				),
				self::METHOD_KEY => array(
					'type' => 'String',
					'required' => true,
					'desc' => 'API接口名称',
				),
				self::TIMESTAMP_KEY => array(
					'type' => 'String',
					'required' => true,
					'desc' => '时间戳，格式为yyyy-mm-dd HH:mm:ss，例如：2013-05-06 13:52:03。服务端允许客户端请求时间误差为' . intval(self::ALLOWED_DEVIATE_SECONDS / 60) . '分钟。',
				),
				self::FORMAT_KEY => array(
					'type' => 'String',
					'required' => false,
					'desc' => '可选，指定响应格式。默认json,目前支持格式为json',
				),
				self::VERSION_KEY => array(
					'type' => 'String',
					'required' => true,
					'desc' => 'API协议版本，可选值:1.0',
				),
				self::SIGN_KEY => array(
					'type' => 'String',
					'required' => true,
					'desc' => '对 API 输入参数进行 md5 加密获得，详细参考签名章节',
				),
				self::SIGN_METHOD_KEY => array(
					'type' => 'String',
					'required' => false,
					'desc' => '可选，参数的加密方法选择。默认为md5，可选值是：md5',
				),
			),
			
		);
	}
	
	public static function errors() {
		return array(
			'response' => array (
				'code' => array (
					'type' => 'Number',
					'desc' => '错误编号',
					'example' => 40002,
					'required' => true,
				),
				'msg' => array (
					'type' => 'String',
					'desc' => '错误信息',
					'example' => 'invalid app',
					'required' => true,
				),
				'params' => array (
					'type' => 'List',
					'desc' => '请求参数列表',
					'example' => array(
						'app_id' => 'ac9aaepv37d2a5guc',
						'method' => 'kdt.trades.sold.get',
						'timestamp' => '2014-01-20 20:38:42',
						'format' => 'json',
						'sign_method' => 'md5',
						'v' => '1.0',
						'sign' => 'wi93n31d034a9207ert7d3971e3vno10',
					),
					'required' => true,
				),
			),
			'errors' => array(
				self::ERR_SYSTEM => array(
					'desc' => '系统错误',
					'suggest' => '',
				),
				self::ERR_INVALID_APP_ID => array(
					'desc' => '未指定 AppId',
					'suggest' => '请求时传入 AppId',
				),
				self::ERR_INVALID_APP => array(
					'desc' => '无效的App',
					'suggest' => '申请有效的 AppId',
				),
				self::ERR_INVALID_TIMESTAMP => array(
					'desc' => '无效的时间参数',
					'suggest' => '以当前时间重新发起请求；如果系统时间和服务器时间误差超过10分钟，请调整系统时间',
				),
				self::ERR_EMPTY_SIGNATURE => array(
					'desc' => '请求没有签名',
					'suggest' => '请使用协议规范对请求中的参数进行签名',
				),
				self::ERR_INVALID_SIGNATURE => array(
					'desc' => '签名校验失败',
					'suggest' => '检查 AppId 和 AppSecret 是否正确；如果是自行开发的协议分装，请检查代码',
				),
				self::ERR_INVALID_METHOD_NAME => array(
					'desc' => '未指定请求的 Api 方法',
					'suggest' => '指定 Api 方法',
				),
				self::ERR_INVALID_METHOD => array(
					'desc' => '请求非法的方法',
					'suggest' => '检查请求的方法的值',
				),
				self::ERR_INVALID_TEAM => array(
					'desc' => '校验团队信息失败',
					'suggest' => '检查团队是否有效、是否绑定微信',
				),
				self::ERR_PARAMETER => array(
					'desc' => '请求方法的参数错误',
					'suggest' => '',
				),
				self::ERR_LOGIC => array(
					'desc' => '请求方法时业务逻辑发生错误',
					'suggest' => '',
				),
			),
		);
	}
}

