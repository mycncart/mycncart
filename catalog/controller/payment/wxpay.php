<?php
class ControllerPaymentWxPay extends Controller {
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
		//echo "six";



		//echo "1";
		
		/*
		WxPayConfig::$APPID = $this->config->get('wxpay_appid');
	    WxPayConfig::$MCHID = $this->config->get('wxpay_mchid');
	    WxPayConfig::$KEY = $this->config->get('wxpay_key');
		WxPayConfig::$APPSECRET = $this->config->get('wxpay_appsecret');
		WxPayConfig::$SSLCERT_PATH = DIR_SYSTEM.'helper/wxpay_key/apiclient_cert.pem';
		WxPayConfig::$SSLKEY_PATH = DIR_SYSTEM.'helper/wxpay_key/apiclient_key.pem';
		*/
		
		//echo "2";
		$this->language->load('payment/wxpay');

		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$this->load->model('checkout/order');

		$order_id = $this->session->data['order_id'];

		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		$item_name = $this->config->get('config_name');
		
		$fullname = $order_info['payment_fullname'];
		
		$this->load->model('account/order');

		$shipping_cost = 0;

		$totals = $this->model_account_order->getOrderTotals($order_id);

		foreach ($totals as $total) {
			
			if($total['title'] == 'shipping') {
				
				$shipping_cost = $total['value'];
				
			}
			
		}
		
		$notify_url = HTTPS_SERVER.'catalog/controller/payment/wxpay_callback.php';

        


        $out_trade_no = $this->session->data['order_id'];

        $subject = $item_name . ' ' . $this->language->get('text_order') .' '. $order_id;

        $amount = $order_info['total'];
		
		$currency_value = $this->currency->getValue('CNY');
		$price = $amount * $currency_value;
		$price = number_format($price,2,'.','');
		
		$total_fee = $price * 100;//乘100去掉小数点，以传递整数给微信支付
		
		
		//$total_fee = 1;
		//echo "Total Fee: ".$total_fee."<br>";
		
		//echo "3";		
				
		//①、获取用户openid
		$tools = new JsApiPay();
		//$openId = $tools->GetOpenid();
		$openId = $this->session->data['weixin_openid'];
		//echo "4<br>";
		//echo $openId;
		
		//②、统一下单
		$input = new WxPayUnifiedOrder();
		
		//echo "5";
		
		$input->SetBody($subject);
		$input->SetAttach("test by yang");
		$input->SetOut_trade_no($order_id);
		$input->SetTotal_fee($total_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test goods tags");
		$input->SetNotify_url($notify_url);
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		
		//echo "6";
		
		$order = WxPayApi::unifiedOrder($input);
		//print_r($order);
		
		//echo "7";
		//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		//printf_info($order);
		$data['jsApiParameters'] = $tools->GetJsApiParameters($order);
		
		//echo "8";
		//获取共享收货地址js函数参数
		$data['editAddress'] = $tools->GetEditAddressParameters();
		//echo "9";		
		
		$data['return_url'] = $this->url->link('checkout/success');
		$data['checkout_url'] = $this->url->link('checkout/checkout');	

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/wxpay.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/wxpay.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/wxpay.tpl', $data);
		}
		
	}
	
	
	public function callback() {
		
		$log = $this->config->get('wxpay_log');
		
		if($log) {
			$this->log->write('WxPay :: One: ');
		}
		
		$this->load->library('wxpayexception');
		
		if($log) {
			$this->log->write('WxPay :: Two: ');
		}
		
		$this->load->library('wxpayconfig');
		
		if($log) {
			$this->log->write('WxPay :: Three: ');
		}
		
		$this->load->library('wxpaydata');
		
		if($log) {
			$this->log->write('WxPay :: Four: ');
		}
		
		$this->load->library('wxpaynotify');
		
		if($log) {
			$this->log->write('WxPay :: Five: ');
		}
		
		$this->load->library('wxpayapi');
		
		if($log) {
			$this->log->write('WxPay :: Six: ');
		}
		
		$this->load->library('wxpaynotifycallback');
		
		if($log) {
			$this->log->write('WxPay :: Seven: ');
		}
		
		$notify = new PayNotifyCallBack();
		
		if($log) {
			$this->log->write('WxPay :: Eight: ');
		}
		
		
		$notify->Handle(false);
		
		$getxml = $GLOBALS['HTTP_RAW_POST_DATA'];
		
		libxml_disable_entity_loader(true);
		
		$result= json_decode(json_encode(simplexml_load_string($getxml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		
		if($notify->GetReturn_code() == "SUCCESS") {
			
			
			if ($result["return_code"] == "FAIL") {
				
				$this->log->write("WxPay ::【通信出错】:\n".$getxml."\n");
				
			}elseif($result["result_code"] == "FAIL"){
				
				$this->log->write("WxPay ::【业务出错】:\n".$getxml."\n");
				
			}else{
				
				
				
			
				$order_id = $result['out_trade_no'];
				
				if($log) {
					$this->log->write('WxPay :: Order ID: '.$order_id);
				}
				
				$this->load->model('checkout/order');
	
				$order_info = $this->model_checkout_order->getOrder($order_id);
				
				if ($order_info) {
					
					if($log) {
						$this->log->write('WxPay :: 1: ');
					}
				
					$order_status_id = $this->config->get('wxpay_trade_success_status_id');
						
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
						$this->log->write('WxPay :: 2: ');
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
						$this->log->write('WxPay :: 3: ');
						
					}
					
					//清除sesssion，避免客户返回不到成功页面而无法清除原有的购物车等信息
					$this->cart->clear();
					unset($this->session->data['shipping_method']);
					unset($this->session->data['shipping_methods']);
					unset($this->session->data['payment_method']);
					unset($this->session->data['payment_methods']);
					unset($this->session->data['guest']);
					unset($this->session->data['comment']);
					unset($this->session->data['order_id']);
					unset($this->session->data['coupon']);
					unset($this->session->data['reward']);
					unset($this->session->data['voucher']);
					unset($this->session->data['vouchers']);
					unset($this->session->data['totals']);
					if(isset($this->session->data['cs_shipfrom'])) {
						unset($this->session->data['cs_shipfrom']);
					}
					
					if(isset($this->sesssion->data['personal_card'])) {
						unset($this->sesssion->data['personal_card']);
					}
				
					
				}else{
					
					if($log) {
						$this->log->write('WxPay :: Seven: ');
					}
					
				}
			
			}
			
			
		}else{
			
			$this->log->write('WxPay :: Nine: '.$result);
			
		}
		
		
		
	
		
	}
	
	public function callbackbak() {
		
		$this->load->helper('alipay_dt_core');
		$this->load->helper('alipay_dt_md');	
		
		$alipay_config['partner']	=	$this->config->get('alipay_direct_partner');

		$alipay_config['key']		=	$this->config->get('alipay_direct_security_code');
		
		$alipay_config['sign_type']    = strtoupper('MD5');
		
		$alipay_config['input_charset']= strtolower('utf-8');
		
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		
		$alipay_config['transport']    = HTTPS_SERVER;
		
		$log = $this->config->get('alipay_direct_log');
		
		if($log) {
			$this->log->write('Alipay_Direct :: One: ');
		}
		
		$this->load->library('alipaydtnotify');
		
		$alipayNotify = new Alipaydtnotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		if($log) {
			$this->log->write('Alipay_Direct :: Two: ' . $verify_result);
		}
		
		
		
		if($verify_result) {
					
			$out_trade_no = $this->request->post['out_trade_no'];
			
			$order_id   = $out_trade_no; 
		
		
			$trade_no = $this->request->post['trade_no'];
		
			$trade_status = $this->request->post['trade_status'];
			
			$order_status_id = $this->config->get('config_order_status_id');
			
			$this->load->model('checkout/order');

			$order_info = $this->model_checkout_order->getOrder($order_id);
			
			if($log) {
				$this->log->write('Alipay_Direct :: Three: ');
			}
			
			if ($order_info) {
				
				if($log) {
					$this->log->write('Alipay_Direct :: Four: ');
				}
				
			
				if($_POST['trade_status'] == 'TRADE_FINISHED') {
				
					if($log) {
						$this->log->write('Alipay_Direct :: Five: ');
					}
				
					$order_status_id = $this->config->get('alipay_direct_trade_finished_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
				
						
					echo "success";
			
				} else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
					
					if($log) {
						$this->log->write('Alipay_Direct :: Six: ');
					}
				
					$order_status_id = $this->config->get('alipay_direct_trade_success_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
						
					echo "success";
			
				}
				
				//清除sesssion，避免客户返回不到成功页面而无法清除原有的购物车等信息
				$this->cart->clear();
				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);
				unset($this->session->data['guest']);
				unset($this->session->data['comment']);
				unset($this->session->data['order_id']);
				unset($this->session->data['coupon']);
				unset($this->session->data['reward']);
				unset($this->session->data['voucher']);
				unset($this->session->data['vouchers']);
				unset($this->session->data['totals']);
				if(isset($this->session->data['cs_shipfrom'])) {
					unset($this->session->data['cs_shipfrom']);
				}
				
				if(isset($this->sesssion->data['personal_card'])) {
					unset($this->sesssion->data['personal_card']);
				}
			
				
			}else{
				
				if($log) {
					$this->log->write('Alipay_Direct :: Seven: ');
				}
				
				echo "fail";
				
			}
			
		} else {
			
			if($log) {
				$this->log->write('Alipay_Direct :: Eight: ');
			}
			
			echo "fail";
		
		}
		
		
		
		
	}

	
}