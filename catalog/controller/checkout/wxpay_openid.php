<?php
class ControllerCheckoutWxPayOpenId extends Controller {
	public function index() {
				
		//echo "one";
		$this->load->library('wxpayexception');
		//echo "two";
		
		
		define('APPID', $this->config->get('wxpay_appid'));
		define('MCHID', $this->config->get('wxpay_mchid'));
		define('KEY', $this->config->get('wxpay_key'));
		define('APPSECRET', $this->config->get('wxpay_appsecret'));
		define('SSLCERT_PATH', DIR_SYSTEM.'helper/wxpay_api/apiclient_cert.pem');
		define('SSLKEY_PATH', DIR_SYSTEM.'helper/wxpay_api/apiclient_key.pem');
		define('CURL_PROXY_HOST', '0.0.0.0');
		define('CURL_PROXY_PORT', 0);
		define('REPORT_LEVENL', 1);

		//echo "three";
		$this->load->library('wxpaydata');
		//echo "four";
		$this->load->library('wxpayapi');
		//echo "five";
		
		$this->load->library('wxpayjsapipay');
		
		$tools = new JsApiPay();
		$openId = $tools->GetOpenidFromMp($_GET['code']);
		
		$this->session->data['weixin_openid'] = $openId;
		
		//echo $this->session->data['redirect'];
		//echo "微信支付测试中......";
		//exit;
		
		$url = $this->url->link('checkout/checkout', '', 'SSL');
		
		header("Location: $url");
		//exit();
		
		//$this->response->redirect(str_replace('&amp;', '&', $this->sesssion->data['redirect']));
	}
}