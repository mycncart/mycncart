<?php
class ControllerExtensionModuleQQLogin extends Controller {
	private $error = array();
	
	public function index() {
		if (!$this->customer->isLogged()) {
			$data['qq_login_url'] = $this->url->link('extension/module/qq_login/login', '', true);
			
			$this->load->language('extension/module/qq_login');
			
			$data['text_qq_login'] = $this->language->get('text_qq_login');

			if ($this->customer->isLogged()) {
				$data['logged'] = 1;
			} else {
				$data['logged'] = 0;
			}
			
			if(isset($this->session->data['qq_login_openid'])) {
				$data['qq_login_authorized'] = 1;
			} else {
				$data['qq_login_authorized'] = 0;
			}
			
			$this->load->helper('mobile');
			if(is_weixin()) {
				$data['is_weixin'] = 1;
				
			}else{
				$data['is_weixin'] = 0;
			}
			
			
			return $this->load->view('extension/module/qq_login', $data);

		}
	}
	
	public function callback() {
		define('QQ_LOGIN_APPID', $this->config->get('module_qq_login_appid'));
		define('QQ_LOGIN_APPKEY', $this->config->get('module_qq_login_appkey'));
		define('QQ_CALLBACK_URI', HTTP_SERVER.'catalog/controller/api/qq_callback.php');
		require_once(DIR_SYSTEM.'library/qq/qqConnectAPI.php');
		$qc = new QC();
		$access_token = $qc->qq_callback();
		$openid = $qc->get_openid();
		
		$qui = new QC($access_token, $openid);
		$user_info = $qui->get_user_info();
		
		$this->load->model('account/customer');
		
		$this->session->data['qq_nickname'] = $user_info['nickname'];
		
		$this->load->language('extension/module/qq_login');
		
		$data['text_qq_login'] = $this->language->get('text_qq_login');
		
		if (stristr($openid, 'error')) {
			echo $this->language->get('error_openid');
		} elseif ($openid) {
			
			$this->session->data['qq_openid'] = $openid;
			
			if ($this->customer->login_qq($this->session->data['qq_openid'])) {
				
				unset($this->session->data['guest']);
	
				// Default Addresses
				$this->load->model('account/address');

				if ($this->config->get('config_tax_customer') == 'payment') {
					$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				if ($this->config->get('config_tax_customer') == 'shipping') {
					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}
	
				$this->response->redirect($this->url->link('account/account', '', 'SSL'));
			}else{
				
				
				$weixin_login_unionid = '';
				$weixin_login_openid = '';
				
				$customer_data = array(
					'registertype'	=> 'email',
					'firstname'	=> $this->session->data['qq_nickname'],
					'lastname'	=> '',
					'email'		=> $openid,
					'telephone'	=> $openid,
					'password'	=> $openid,
				);
				
				$customer_id = $this->model_account_customer->addCustomer($customer_data, $weixin_login_openid, $weixin_login_unionid);
			
				
				$this->model_account_customer->updateCustomerQQInfo($customer_id, $openid);
				
				
				$this->customer->login($openid, $openid);
				
				//Unset Third party login session
				unset($this->session->data['qq_login_warning']);
				unset($this->session->data['weibo_login_warning']);
				unset($this->session->data['weixin_login_warning']);
				unset($this->session->data['qq_nickname']);
	
				unset($this->session->data['guest']);
				
				$this->response->redirect($this->url->link('account/account'));
			}
			
		}else{
			echo $this->language->get('text_qq_fail');	
		}
	
	}
	
	public function login() {
		define('QQ_LOGIN_APPID', $this->config->get('module_qq_login_appid'));
		define('QQ_LOGIN_APPKEY', $this->config->get('module_qq_login_appkey'));
		define('QQ_CALLBACK_URI', HTTP_SERVER.'catalog/controller/api/qq_callback.php');
		
		
		require_once(DIR_SYSTEM.'library/qq/qqConnectAPI.php');
		$qc = new QC();
		$qc->qq_login();
	}

}