<?php
class ControllerAccountWeiXinLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('account/customer');

		
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$this->load->language('account/weixin_login');

		$this->document->setTitle($this->language->get('heading_title'));

		//weixin_login
		if ($this->customer->login_weixin($this->session->data['weixin_login_unionid'])) {
			
			unset($this->session->data['guest']);

			// Default Shipping Address
			$this->load->model('account/address');

			if ($this->config->get('config_tax_customer') == 'payment') {
				$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
			}

			if ($this->config->get('config_tax_customer') == 'shipping') {
				$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
			}
			
			if(isset($this->session->data['weixin_checkout_redirect'])) {
				
				$weixin_login_redirect = $this->session->data['weixin_checkout_redirect'];
				unset($this->session->data['weixin_checkout_redirect']);
				
			}else{
				
				$weixin_login_redirect = $this->url->link('account/login', '', true);
				
			}
			
			$this->response->redirect($weixin_login_redirect);
			
		}else{
			
			$this->session->data['weixin_login_warning'] = sprintf($this->language->get('text_weixin_login_warning'), $this->config->get('config_name'));
			
			$this->response->redirect($this->url->link('account/login', '', true));
			
		}

		
	}
	
	
	public function weixin_pclogin_code() {
		
		print_r($this->request->get);
		
		$code = $this->request->get['code'];
		
		$this->weixin_pclogin($code);
		
	}
	
	protected function weixin_pclogin($code) {
		$this->load->language('account/weixin_login');
		
		$appid = $this->config->get('wx_login_appid');
		$appsecret = $this->config->get('wx_login_appsecret');
		
		$this->load->helper('mobile');
		
		$info = getWeiXinUserInfo($appid, $appsecret);
		
		if(isset($info['openid']) && isset($info['unionid'])) {
			
			if($info['unionid'] != '') {
			
				$this->session->data['weixin_pclogin_unionid'] = $info['unionid'];
				$this->session->data['weixin_pclogin_openid'] = $info['openid'];
				
				if ($this->customer->login_weixin($this->session->data['weixin_pclogin_unionid'])) {
				
					unset($this->session->data['guest']);
		
					// Default Shipping Address
					$this->load->model('account/address');
		
					if ($this->config->get('config_tax_customer') == 'payment') {
						$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
					}
		
					if ($this->config->get('config_tax_customer') == 'shipping') {
						$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
					}
		
					$this->response->redirect($this->url->link('account/account', '', true));
				}else{
					
					$this->session->data['weixin_login_warning'] = sprintf($this->language->get('text_weixin_login_warning'), $this->config->get('config_name'));
					
					$this->response->redirect($this->url->link('account/login', '', true));
				}
			
			}else{
				$this->response->redirect($this->url->link('account/login', '', true));
			}
			
		}else{
			$this->response->redirect($this->url->link('account/login', '', true));
		}
		
	}

	
}