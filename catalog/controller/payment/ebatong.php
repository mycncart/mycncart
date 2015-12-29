<?php
class ControllerPaymentEBaTong extends Controller {
	public function index() {
		
		$this->load->language('payment/ebatong');
		
		$data['text_testmode'] = $this->language->get('text_testmode');
		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$input_charset      = "utf-8";
		
		$data['testmode'] = $this->config->get('ebatong_test');

		if (!$this->config->get('ebatong_test')) {
			
			$data['action'] = 'https://www.ebatong.com/direct/gateway.htm';
		} else {
			$data['action'] = 'http://180.168.127.5/direct/gateway.htm';
		}
		
		$ebatong_config['appid']	=	$this->config->get('ebatong_appid');

		$ebatong_config['appkey']	=	$this->config->get('ebatong_appkey');
		
		$ebatong_config['input_charset']	=	$input_charset;
		
		
		
		if (!$this->config->get('ebatong_test')) {
			
			$ebatong_config['ask_for_time_stamp_gateway']	=	'https://www.ebatong.com/gateway.htm';
		} else {
			$ebatong_config['ask_for_time_stamp_gateway']	=	'http://180.168.127.5/gateway.htm';
		}
		
		$service            = "create_direct_pay_by_user";
		$partner            = $this->config->get('ebatong_appid'); 
		
		
		$sign_type          = "MD5"; 
		
	
		$anti_phishing_key  = "";
		$exter_invoke_ip    = "";
			   
		
		if (!$this->config->get('ebatong_test')) {
			
			$out_trade_no = $this->session->data['order_id'];
			
		} else {
			
			$iRandom            = rand(0,10000)+10000000;
			
			$out_trade_no = $this->session->data['order_id'].'-'.date("YmdHis").'-'.$iRandom;
			
		}
		
		$payment_type       = "1"; 
		
		
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
		

		$notify_url         = HTTPS_SERVER.'catalog/controller/payment/ebatong_callback.php';
		$return_url         = $this->url->link('checkout/success');
		$error_notify_url   = "";

        

        $subject = $item_name . ' ' . $this->language->get('text_order') .' '. $order_id;

        $amount = $order_info['total'];
		
		$currency_value = $this->currency->getValue('CNY');
		$price = $amount * $currency_value;
		$price = number_format($price,2,'.','');
		
		$total_fee = $price;
		
		 
		$seller_email        = "";
		$seller_id           = $this->config->get('ebatong_appid');
		$buyer_email         = "";
		$buyer_id            = "";
		$exter_invoke_ip     = $this->request->server['REMOTE_ADDR'];
		$price               = "";
		$total_fee           = $total_fee;
		$quantity            = "";
		$body                = "";
		$show_url            = "";
		$pay_method          = "bankPay";
		$default_bank        = "";

		$royalty_parameters = ""; 
		$royalty_type = ""; 
		 
		$params = array(
			"service" => $service,
			"partner" => trim($partner),
			"input_charset"	=> $input_charset,
			"sign_type"	=> $sign_type,
			"notify_url"	=> $notify_url,
			"return_url"	=> $return_url,
			"error_notify_url"	=> $error_notify_url,
			"anti_phishing_key"	=> $anti_phishing_key,
			"exter_invoke_ip"	=> $exter_invoke_ip,
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"payment_type"	=> $payment_type,
			"seller_email"	=> $seller_email,
			"seller_id"	=> $seller_id,
			"buyer_email"	=> $buyer_email,
			"buyer_id"	=> $buyer_id,
			"price"	=> $price,
			"total_fee"	=> $total_fee,
			"quantity"	=> $quantity,
			"body"	=> $body,
			"show_url"	=> $show_url,
			"pay_method"	=> $pay_method,
			"default_bank"	=> $default_bank,
			"royalty_parameters"	=> $royalty_parameters,
			"royalty_type"	=> $royalty_type,
		);
		
		
		
		
		
		$this->load->library('ebatongrealtime');
		
		$this->ebatongrealtime = new Ebatongrealtime($ebatong_config);
		
		$realtime = $this->ebatongrealtime->getRealTime();    
		$params['anti_phishing_key'] = $realtime;
		
		$paramKey = array_keys($params);
		sort($paramKey);
		$md5src = "";
		$i = 0;
		$paramStr = "";
		foreach($paramKey as $arraykey){
		   if($i==0){
				$paramStr .= $arraykey."=".$params[$arraykey];
		   }
		   else{
				$paramStr .= "&".$arraykey."=".$params[$arraykey];
		   }
				$i++;
		}
		
		$md5src .= $paramStr.$this->config->get('ebatong_appkey');   
		$sign = md5($md5src);
		$params['sign'] = $sign;
	 
	 	
		$data['params'] = $params;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ebatong.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/ebatong.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/ebatong.tpl', $data);
		}
		
	}
	
	public function callback() {
		
		$log = $this->config->get('ebatong_debug');
		
		if($log) {
			$this->log->write('Ebatong :: One: ');
		}
		
		if(isset($this->request->get['notify_id'])) {
			
			$params = $this->request->get;
			
			$key = $this->config->get('ebatong_appkey');
			
			$checkSign = $params['sign'];
			
			if($log) {
				$this->log->write('Ebatong :: Two: ' . $checkSign);
			}
			
			$paramKey = array_keys($params);
			
			sort($paramKey);
			
			$md5src = "";
			
			$i=0;
			
			$paramStr = "";
			
			foreach($paramKey as $arraykey){
				
				if(strcmp($arraykey,"sign") == 0){       
				
				}else{
					
					if($i==0){
						
						$paramStr .= $arraykey . "=" . $params[$arraykey];
						
					}else{
						
						$paramStr .= "&". $arraykey . "=" . $params[$arraykey];
						
					}
					
					$i++;
					
				}
				
			}
			
			$md5src .= $paramStr . $key;
			
			$sign = md5($md5src);
			
			if($log) {
				$this->log->write('Ebatong :: Three: ' . $sign);
			}
			
			if($checkSign == $sign){

				if(isset($this->request->get['out_trade_no'])) {
		
					$order_id = $this->request->get['out_trade_no'];
					
					if (!$this->config->get('ebatong_test')) {
				
						$order_id = $order_id;
						
					} else {
						$order_number = explode('-', $order_id);
						
						$order_id = $order_number[0];
					}
				
				}else{
					
					$order_id = 0;
					
				}
				
				if($log) {
					$this->log->write('Ebatong :: Four: ' . $order_id);
				}
				
				$this->load->model('checkout/order');
	
				$order_info = $this->model_checkout_order->getOrder($order_id);
				
				if ($order_info) {
					
					if($log) {
						$this->log->write('Ebatong :: Five: ');
					}
					
					
					$order_status_id = $this->config->get('ebatong_completed_status_id');
						
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
						
						if($log) {
							$this->log->write('Ebatong :: Six: ');
						}
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
						
						if($log) {
							$this->log->write('Ebatong :: Seven: ');
						}
						
					}
					
					echo $params['notify_id'];
					
				}else{
					
					if($log) {
						$this->log->write('Ebatong :: Eight: ');
					}
					
				}
		  
			}else{
				if($log) {
					$this->log->write('Ebatong :: Nine: ');
				}	
			}
			
		}else{
		
			if($log) {
				$this->log->write('Ebatong :: Ten: ');
			}
			
		}
		
	
		
	}

	
}