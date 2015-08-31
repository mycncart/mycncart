<?php
class ControllerCheckoutWxPayOpenId extends Controller {
	public function index() {
				
		//echo "one";
		$this->load->library('wxpayexception');
		//echo "two";
		$this->load->library('wxpayconfig');
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
		
		header('Location: http://www.suubuy.cn/index.php?route=checkout/checkout');
		//exit();
		
		//$this->response->redirect(str_replace('&amp;', '&', $this->sesssion->data['redirect']));
	}
}