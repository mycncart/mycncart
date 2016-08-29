<?php
class ControllerExtensionModuleWeiXinLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('account/customer');

		
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', 'SSL'));
		}

		$this->load->language('account/weixin_login');

		$this->document->setTitle($this->language->get('heading_title'));

		//微信登录
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
				$this->log->write('weixin-->login1');
			}else{
				$weixin_login_redirect = $this->url->link('account/login', '', 'SSL');
				$this->log->write('weixin-->login2');
			}
			
			//$this->response->redirect($this->url->link('account/login', '', 'SSL'));
			$this->response->redirect($weixin_login_redirect);

			//$this->response->redirect($this->url->link('account/account', '', 'SSL'));
			
		}else{
			
			$this->session->data['weixin_login_warning'] = '您已登陆，只差一步即可完成微信与舒优派帐号绑定。';
			
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		
	}
	
	
	public function weixin_pclogin_code() {
		
		print_r($this->request->get);
		
		$code = $this->request->get['code'];
		
		$this->weixin_pclogin($code);
		
	}
	
	protected function weixin_pclogin($code) {
		
		$appid = $this->config->get('wx_login_appid');
		$appsecret = $this->config->get('wx_login_appsecret');
		
		$openid_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code=' . $code . '&grant_type=authorization_code';
		
		$result = file_get_contents($openid_url);
		
		//echo "<pre>";
		//print_r(json_decode($result, true));
		//echo "</pre>";
		//exit;
		
		$info = json_decode($result, true);
		
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
		
					$this->response->redirect($this->url->link('account/account', '', 'SSL'));
				}else{
					
					$this->session->data['weixin_login_warning'] = '您已登陆，只差一步即可完成微信与舒优派帐号绑定。';
					
					$this->response->redirect($this->url->link('account/login', '', 'SSL'));
				}
			
			}else{
				$this->response->redirect($this->url->link('account/login', '', 'SSL'));
			}
			
		}else{
			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		
	}
	
	public function login() {
		$this->load->model('account/customer');

		
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$this->load->language('extension/module/weixin_login');

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

}