<?php
class ControllerExtensionModuleWeiXinLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('account/customer');
		
		$this->load->language('extension/module/weixin_login');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['text_weixin_login'] = $this->language->get('text_weixin_login');
		
		if ($this->customer->isLogged()) {
			$data['logged'] = 1;
		} else {
			$data['logged'] = 0;
		}
		
		if(isset($this->session->data['weixin_login_unionid'])) {
			$data['weixin_login_authorized'] = 1;
		} else {
			$data['weixin_login_authorized'] = 0;
		}
		
		$this->load->helper('mobile');
		if(is_weixin()) {
			$data['is_weixin'] = 1;
			
		}else{
			$data['is_weixin'] = 0;
		}
		
		if(is_mobile()) {
			$data['is_mobile'] = 1;
			
		}else{
			$data['is_mobile'] = 0;
		}
		
		$appid = $this->config->get('weixin_login_appid');
		
		$appkey = $this->config->get('weixin_login_appkey');
		
		$data['weixin_login'] = $this->url->link('extension/module/weixin_login/login', '', 'SSL');
		
		$weixin_pclogin_redirect_uri = HTTPS_SERVER.'index.php?route=extension/module/weixin_login/weixin_pclogin_code';
		
		$data['wxpclogin_url'] = 'https://open.weixin.qq.com/connect/qrconnect?appid='.$appid.'&redirect_uri='.urlencode($weixin_pclogin_redirect_uri).'&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect';
		
		return $this->load->view('extension/module/weixin_login', $data);

		
	}
	
	
	public function weixin_pclogin_code() {
		
		$code = $this->request->get['code'];
		
		$this->weixin_pclogin($code);
		
	}
	
	protected function weixin_pclogin($code) {
		
		$this->load->language('extension/module/weixin_login');
		
		$appid = $this->config->get('weixin_login_appid');
		$appsecret = $this->config->get('weixin_login_appsecret');
		
		$openid_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code=' . $code . '&grant_type=authorization_code';
		
		$result = file_get_contents($openid_url);
		
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
					
					$this->session->data['weixin_login_warning'] =  sprintf($this->language->get('text_weixin_login_warning'), $this->config->get('config_name'));
					
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
		
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}
		
		if (isset($this->session->data['weixin_login_openid'])) {
			
			$this->load->language('extension/module/weixin_login');
			
			if ($this->customer->login_weixin($this->session->data['weixin_login_openid'])) {
				
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
		
		} else {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		
	}
	
}