<?php

class ControllerPaymentAlipayGuarantee extends Controller {
	public function index() {
		
		$this->load->helper('alipay_ga_core');
		$this->load->helper('alipay_ga_md');
		
		$this->language->load('payment/alipay_guarantee');

		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$alipay_config['partner']	=	$this->config->get('alipay_guarantee_partner');

		$alipay_config['key']		=	$this->config->get('alipay_guarantee_security_code');
		
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

        $notify_url = HTTPS_SERVER.'catalog/controller/payment/alipay_guarantee_callback.php';

        $return_url = $this->url->link('checkout/success');

        $seller_email = $this->config->get('alipay_guarantee_seller_email');

        $out_trade_no = $this->session->data['order_id'];

        $subject = $item_name . ' ' . $this->language->get('text_order') .' '. $order_id;

        $amount = $order_info['total'];
		
		$currency_value = $this->currency->getValue('CNY');
		$price = $amount * $currency_value;
		$price = number_format($price,2,'.','');
		

        $quantity = "1";

        $logistics_fee = $shipping_cost;

        $logistics_type = "EXPRESS";

        $logistics_payment = "SELLER_PAY";


        $body =  $this->language->get('text_owner') . ' ' . $fullname;

        $show_url = $this->url->link('common/home', '', 'SSL');


        $receive_name = $order_info['payment_fullname'];

        $receive_address = $order_info['shipping_country'].$order_info['shipping_zone'].$order_info['shipping_city'].$order_info['shipping_address'] .$order_info['shipping_company'];

        $receive_zip = $order_info['shipping_postcode'];

        $receive_phone = $order_info['telephone'];

        $receive_mobile = $order_info['telephone'];


		$parameter = array(
				"service" => "create_partner_trade_by_buyer",
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"price"	=> $price,
				"quantity"	=> $quantity,
				"logistics_fee"     =>'0.00',
				"logistics_type"	=> $logistics_type,
				"logistics_payment"	=> $logistics_payment,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"receive_name"	=> $receive_name,
				"receive_address"	=> $receive_address,
				"receive_zip"	=> $receive_zip,
				"receive_phone"	=> $receive_phone,
				"receive_mobile"	=> $receive_mobile,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);

		
		$this->load->library('alipaygasubmit');
		
		$this->alipaygasubmit = new Alipaygasubmit($alipay_config);
		
		
		$data['html_text'] = $this->alipaygasubmit->buildRequestForm($parameter,"get", $this->language->get('button_confirm'));
		
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/alipay_guarantee.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/alipay_guarantee.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/alipay_guarantee.tpl', $data);
		}
		
	}
	
	public function callback() {
		
		$this->load->helper('alipay_ga_core');
		$this->load->helper('alipay_ga_md');	
		
		$alipay_config['partner']	=	$this->config->get('alipay_guarantee_partner');

		$alipay_config['key']		=	$this->config->get('alipay_guarantee_security_code');
		
		
		$alipay_config['sign_type']    = strtoupper('MD5');
		
		$alipay_config['input_charset']= strtolower('utf-8');
		
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		
		$alipay_config['transport']    = HTTPS_SERVER;
		
		$this->log->write('Alipay_Guarantee :: One: ');
		
		$this->load->library('alipayganotify');
		
		$alipayNotify = new Alipayganotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		$this->log->write('Alipay_Guarantee :: Two: ' . $verify_result);
		
		
		
		if($verify_result) {
		
			$out_trade_no = $this->request->post['out_trade_no'];
			
			$order_id   = $out_trade_no; 
		
		
			$trade_no = $this->request->post['trade_no'];
		
			$trade_status = $this->request->post['trade_status'];
			
			$order_status_id = $this->config->get('config_order_status_id');
			
			$this->load->model('checkout/order');

			$order_info = $this->model_checkout_order->getOrder($order_id);
			
			$this->log->write('Alipay_Guarantee :: Three: ');
			
			if ($order_info) {
				
				$this->log->write('Alipay_Guarantee :: Four: ');
			
				if($this->request->post['trade_status'] == 'WAIT_BUYER_PAY') {
				
					$this->log->write('Alipay_Guarantee :: Five: ');
				
					$order_status_id = $this->config->get('alipay_guarantee_wait_buyer_pay_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
				
						
					echo "success";	
			
				} else if($this->request->post['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
					
					$this->log->write('Alipay_Guarantee :: Six: ');
				
					$order_status_id = $this->config->get('alipay_guarantee_wait_seller_send_goods_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
						
					echo "success";	
			
				} else if($this->request->post['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
				
					$this->log->write('Alipay_Guarantee :: Seven: ');
				
					$order_status_id = $this->config->get('alipay_guarantee_wait_buyer_confirm_goods_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
						
					echo "success";	
			
				} else if($this->request->post['trade_status'] == 'TRADE_FINISHED') {
					
					$this->log->write('Alipay_Guarantee :: Eight: ');
					
					$order_status_id = $this->config->get('alipay_guarantee_trade_finished_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
						
					echo "success";	
			
				} else {
					
					$this->log->write('Alipay_Guarantee :: Nine: ');
					
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
				
				$this->log->write('Alipay_Guarantee :: Ten: ');
				
				echo "fail";
				
			}
			
		} else {
			
			$this->log->write('Alipay_Guarantee :: Eleven: ');
			
			echo "fail";
		
		}
		
		
		
		
	}

	
}