<?php
class ControllerModuleWeiXinLogin extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$appkey = $this->config->get('weixin_login_appkey');
			$appsecret = $this->config->get('weixin_login_appsecret');
			$callback_url = $this->url->link('module/weixin_login/callback', '', true);
			
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
			
			$data['weixin_login'] = $this->url->link('module/weixin_login/login', '', true);
		
			$data['wxpclogin_url'] = 'https://open.weixin.qq.com/connect/qrconnect?appid=' . trim($this->config->get('wx_login_appid')) . '&redirect_uri='.urlencode(HTTPS_SERVER.'index.php?route=module/weixin_login/weixin_pclogin_code').'&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect';
			
			
			return $this->load->view('module/weixin_login', $data);
			

		}
	}
	
	public function weixin_pclogin_code() {
		
		print_r($this->request->get);
		
		$code = $this->request->get['code'];
		
		$this->weixin_pclogin($code);
		
	}
	
	protected function weixin_pclogin($code) {
		$this->load->language('module/weixin_login');
		
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
	
	public function login() {
		$this->load->model('account/customer');

		
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$this->load->language('module/weixin_login');

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
	
	public function callback() {

		$appkey = $this->config->get('weixin_login_appkey');
		$appsecret = $this->config->get('weixin_login_appsecret');
		$callback_url = $this->url->link('module/weixin_login/callback', '', true);
		
		$this->load->language('module/weixin_login');
		
		$data['text_weixin_login'] = $this->language->get('text_weixin_login');

		include_once(DIR_SYSTEM.'library/weixin/saetv2.ex.class.php');

		$o = new SaeTOAuthV2($appkey, $appsecret);
		
		if (isset($_REQUEST['code'])) {
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = $callback_url;
			try {
				$token = $o->getAccessToken( 'code', $keys ) ;
			} catch (OAuthException $e) {
			}
		}
		
		if ($token) {
			
			//setcookie( 'weixinjs_'.$o->client_id, http_build_query($token) );
			
			$c = new SaeTClientV2($appkey, $appsecret, $token['access_token']);
			$ms  = $c->home_timeline();
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$user_message = $c->show_user_by_id($uid);
			
			$this->session->data['weixin_login_access_token'] = $token['access_token'];
			
			$this->session->data['weixin_login_uid'] = $uid;
			
			if ($this->customer->login_weixin($this->session->data['weixin_login_access_token'],  $this->session->data['weixin_login_uid'])) {
				
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
					
					$this->session->data['weixin_login_warning'] = sprintf($this->language->get('text_weixin_login_warning'), $this->config->get('config_name'));
					
					$this->response->redirect($this->url->link('account/login', '', 'SSL'));
				}
			
		}else{
			echo $this->language->get('text_weixin_fail');	
		}
	
	}

}