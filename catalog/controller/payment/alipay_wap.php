<?php
class ControllerPaymentAlipayWap extends Controller {
	public function index() {
		$alipay_config['partner']		= $this->config->get('alipay_wap_partner');
		
		$alipay_config['seller_id']	= $this->config->get('alipay_wap_seller_email');
		
		$alipay_config['private_key_path']	= DIR_SYSTEM.'helper/alipay_wap_key/rsa_private_key.pem';
		
		$alipay_config['ali_public_key_path']= DIR_SYSTEM.'helper/alipay_wap_key/alipay_public_key.pem';
		
		$alipay_config['sign_type']    = strtoupper('RSA');
		
		$alipay_config['input_charset']= strtolower('utf-8');
		
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		
		$alipay_config['transport']    = 'http';
		
		
		$this->load->helper('alipay_wap_core');
		
		$this->load->helper('alipay_wap_rsa');
		
		$this->language->load('payment/alipay_wap');

		$data['button_confirm'] = $this->language->get('button_confirm');
		
        $payment_type = "1";

        $notify_url =HTTPS_SERVER.'catalog/controller/payment/alipay_wap_callback.php';

        $return_url = $this->url->link('checkout/success');

        $out_trade_no =  $this->session->data['order_id'];
		
		$this->load->model('checkout/order');
		
		$order_id = $this->session->data['order_id'];

		$order_info = $this->model_checkout_order->getOrder($order_id);

        $subject = $this->config->get('config_name') . '订单号'. $order_id;
		
		$amount = $order_info['total'];
		
		$currency_value = $this->currency->getValue('CNY');
		
		$price = $amount * $currency_value;
		
		$price = number_format($price,2,'.','');
		
		$total_fee = $price;

        $show_url = $this->url->link('checkout/cart');

        //订单描述
        $body = '';
        //选填

        //超时时间
        $it_b_pay = '';
        //选填

        //钱包token
        $extern_token = '';
        //选填		
		
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "alipay.wap.create.direct.pay.by.user",
				"partner" => trim($alipay_config['partner']),
				"seller_id" => trim($alipay_config['seller_id']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"show_url"	=> $show_url,
				"body"	=> $body,
				"it_b_pay"	=> $it_b_pay,
				"extern_token"	=> $extern_token,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
		
		//建立请求
		
		$this->load->library('alipaywapsubmit');
		
		$alipaywapsubmit = new AlipayWapSubmit($alipay_config);
		$data['html_text'] = $alipaywapsubmit->buildRequestForm($parameter, "get", $this->language->get('button_confirm'));
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/alipay_wap.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/alipay_wap.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/alipay_wap.tpl', $data);
		}
		
	}
	
	public function callback() {
		
		$alipay_config['partner']		= $this->config->get('alipay_wap_partner');
		
		$alipay_config['seller_id']	= $this->config->get('alipay_wap_seller_email');
		
		$alipay_config['private_key_path']	= DIR_SYSTEM.'helper/alipay_wap_key/rsa_private_key.pem';
		
		$alipay_config['ali_public_key_path']= DIR_SYSTEM.'helper/alipay_wap_key/alipay_public_key.pem';
		
		$alipay_config['sign_type']    = strtoupper('RSA');
		
		$alipay_config['input_charset']= strtolower('utf-8');
		
		$alipay_config['cacert']    = getcwd().'\\cacert.pem';
		
		$alipay_config['transport']    = 'http';
		
		$this->load->helper('alipay_wap_core');
		$this->load->helper('alipay_wap_rsa');	
		
		
		
		$log = $this->config->get('alipay_wap_log');
		
		
		if($log) {
			
			$this->log->write('Alipay_Wap :: One: ');
			
		}	
		
		$this->load->library('alipaywapnotify');
		$alipayNotify = new AlipayWapNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		
		if($log) {
			$this->log->write('Alipay_Wap :: Two: ' . $verify_result);
		}
		
		if($verify_result) {//验证成功
			//商户订单号
		
			$out_trade_no = $_POST['out_trade_no'];
			
			$order_id   = $out_trade_no; 
		
			//支付宝交易号
		
			$trade_no = $_POST['trade_no'];
		
			//交易状态
			$trade_status = $_POST['trade_status'];
			
			$order_status_id = $this->config->get('config_order_status_id');
			
			$this->load->model('checkout/order');

			$order_info = $this->model_checkout_order->getOrder($order_id);
				
			if($log) {
				
				$this->log->write('Alipay_Wap :: Three: ');
				
			}
			
			if ($order_info) {
				
				if($log) {
					
					$this->log->write('Alipay_Wap :: Four: ');
					
				}
		
		
				if($_POST['trade_status'] == 'TRADE_FINISHED') {
					
					if($log) {
						$this->log->write('Alipay_Wap :: Five: ');
					}
				
					$order_status_id = $this->config->get('alipay_wap_trade_finished_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
				
				}elseif ($_POST['trade_status'] == 'TRADE_SUCCESS') {
							
							
					if($log) {
						
						$this->log->write('Alipay_Wap :: Six: ');
						
					}
				
					$order_status_id = $this->config->get('alipay_wap_trade_success_status_id');
					
					if (!$order_info['order_status_id']) {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					} else {
						
						$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, '', true);
						
					}
			
					
				}
				
				//清除sesssion，避免手机网页回复后不清除原有的购物车等信息
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
			
					
				echo "success";	
			
			}else{
					
				if($log) {
					
					$this->log->write('Alipay_Wap :: Seven: ');
					
				}
				
			}
			
		}else{
			
			if($log) {
				
				$this->log->write('Alipay_Wap :: Eight: ');
				
			}
			
			
			echo "fail";
		
			
		}	
	}

}