<?php

class ControllerPaymentAlipayDirect extends Controller {
	public function index() {
		
		$this->load->helper('alipay_dt_core');
		$this->load->helper('alipay_dt_md');
		
		$this->language->load('payment/alipay_direct');

		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$alipay_config['partner']	=	$this->config->get('alipay_direct_partner');

		$alipay_config['key']		=	$this->config->get('alipay_direct_security_code');
		
		$alipay_config['sign_type']    = strtoupper('MD5');
		
		$alipay_config['input_charset']= strtolower('utf-8');
		
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		
		$alipay_config['transport']    = HTTPS_SERVER;
		
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
		

        $payment_type = "1";

        $notify_url = HTTPS_SERVER.'catalog/controller/payment/alipay_direct_callback.php';

        $return_url = $this->url->link('checkout/success');

        $seller_email = $this->config->get('alipay_direct_seller_email');

        $out_trade_no = $this->session->data['order_id'];

        $subject = $item_name . ' ' . $this->language->get('text_order') .' '. $order_id;

        $amount = $order_info['total'];
		
		$currency_value = $this->currency->getValue('CNY');
		$price = $amount * $currency_value;
		$price = number_format($price,2,'.','');
		
		$total_fee = $price;
		
        $body =  $this->language->get('text_owner') . ' ' . $fullname;

        $show_url = $this->url->link('common/home', '', 'SSL');

        $anti_phishing_key = "";

        $exter_invoke_ip = "";

		$parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
		
		$this->load->library('alipaydtsubmit');
		
		$this->alipaydtsubmit = new Alipaydtsubmit($alipay_config);
		
		
		$data['html_text'] = $this->alipaydtsubmit->buildRequestForm($parameter,"get", $this->language->get('button_confirm'));
		
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/alipay_direct.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/alipay_direct.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/alipay_direct.tpl', $data);
		}
		
	}
	
	public function callback() {
		
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