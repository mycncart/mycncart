<?php
class ControllerPaymentupop extends Controller {
	public function index() {
		$this->load->library('upopservice');
		$this->language->load('payment/upop');
		$data['text_testmode'] = $this->language->get('text_testmode');
    	$data['button_confirm'] = $this->language->get('button_confirm');

		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		

		$data['merchant'] = $this->config->get('upop_merchant');
		$data['order_id'] = $order_info['order_id'];


		$data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		$data['currency'] = $order_info['currency_code'];
		$data['description'] = $this->config->get('config_name') . ' - #' . $order_info['order_id'];
		$data['name'] = $order_info['payment_fullname'] . ' ' . $order_info['payment_fullname'];
		
		
		$data['address'] = $order_info['payment_address'] . ', ' . $order_info['payment_city'] . ', ' . $order_info['payment_zone'];
		
		$data['postcode'] = $order_info['payment_postcode'];
		$data['country'] = $order_info['payment_iso_code_2'];
		$data['telephone'] = $order_info['telephone'];
		$data['email'] = $order_info['email'];
		$data['test'] = $this->config->get('upop_test');
		
		

		
		static $api_url = array(
			0  => array(
				'front_pay_url' => 'http://58.246.226.99/UpopWeb/api/Pay.action',
				'back_pay_url'  => 'http://58.246.226.99/UpopWeb/api/BSPay.action',
				'query_url'     => 'http://58.246.226.99/UpopWeb/api/Query.action',
			),
			1  => array(
				'front_pay_url' => 'http://www.epay.lxdns.com/UpopWeb/api/Pay.action',
				'back_pay_url'  => 'http://www.epay.lxdns.com/UpopWeb/api/BSPay.action',
				'query_url'     => 'http://www.epay.lxdns.com/UpopWeb/api/Query.action',
			),
			2  => array(
				'front_pay_url' => 'https://unionpaysecure.com/api/Pay.action',
				'back_pay_url'  => 'https://besvr.unionpaysecure.com/api/BSPay.action',
				'query_url'     => 'https://query.unionpaysecure.com/api/Query.action',
			),
		);
		
	
		$upop_evn		= $this->config->get('upop_environment_type');	
		
		
	
		upopconfig::$pay_params['merAbbr']		= $this->config->get('upop_business_name');

        foreach ($api_url[$upop_evn] as $key => $value)
        {
            upopconfig::$$key = $value;
        }

		if ($upop_evn == '2')
		{
			upopconfig::$security_key			= $this->config->get('upop_production_business_key');
			upopconfig::$pay_params['merId']		= $this->config->get('upop_production_business_account');
		}
		else if ($upop_evn == '1')
		{
			upopconfig::$security_key			= $this->config->get('upop_pm_business_key');
			upopconfig::$pay_params['merId']		= $this->config->get('upop_pm_business_account');
		}
		else if ($upop_evn == '0') 
		{
			upopconfig::$security_key			= $this->config->get('upop_test_business_key');
			upopconfig::$pay_params['merId']		= $this->config->get('upop_test_business_account');
		}
		
		

		mt_srand(upopservice::make_seed());
		
		$param['transType']             = upopconfig::CONSUME;  
		
		$param['orderAmount']           = round($order_info['total'],2) * 100;       

		$param['orderNumber']           = "0000000".trim($this->session->data['order_id']);
		$param['orderTime']             = date('YmdHis');   
		$param['orderCurrency']         = upopconfig::CURRENCY_CNY;  
		
		$param['customerIp']            = $_SERVER['REMOTE_ADDR'];  
		

		$param['frontEndUrl']           = HTTPS_SERVER . 'index.php?route=checkout/success';  
		
		

		$param['backEndUrl']            = HTTPS_SERVER . 'index.php?route=payment/upop/callback';  
		
		

		
		$pay_service = new upopservice($param, upopconfig::FRONT_PAY);
		$html = $pay_service->create_html();
		
		header("Content-Type: text/html; charset=" . upopconfig::$pay_params['charset']);
		
		$html .= '

			</form>
				  
      <a href="javascript:document.E_FORM.submit()" class="btn btn-primary">'. $data['button_confirm']. '</a>
    </div>
  </div>
		
		';
		
		
		$data['html'] =  $html; 
		$data['cancel_return'] = $this->url->link('checkout/checkout', '', 'SSL');
	


		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/upop.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/payment/upop.tpl', $data);
			} else {
				return $this->load->view('default/template/payment/chinapay.tpl', $data);
			}
		
	
	}
	
	public function callback() {
		$this->load->model('checkout/order');
		$pending = 1;
		$failed = 10;
		$this->load->library('upopservice');

		try {
			$response = new upopservice($_POST, upopconfig::RESPONSE);
			$arr_ret = $response->get_args();
			$order_id = str_replace("0000000","",$response->get('orderNumber'));
			if ($response->get('respCode') != upopservice::RESP_SUCCESS) {
				$err = sprintf("Error: %d => %s", $response->get('respCode'), $response->get('respMsg'));
				$this->model_checkout_order->addOrderHistory($order_id, $failed);
				$this->response->redirect($this->url->link('checkout/failure'));
				throw new Exception($err);
			}else {
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('upop_order_status_id'));
				$this->response->redirect($this->url->link('checkout/success'));
				
			}
		
			$arr_ret = $response->get_args();
		
			file_put_contents('notify.txt', var_export($arr_ret, true));
		
		}
		catch(Exception $exp) {

			file_put_contents('notify.txt', var_export($exp, true));
			$this->model_checkout_order->addOrderHistory($order_id, $failed);
			$this->response->redirect($this->url->link('checkout/failure'));
		}

		
	}
}
