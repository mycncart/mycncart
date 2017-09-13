<?php
class ControllerStartupWeiXin extends Controller {
	public function index() {
		$wechat_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		
		$this->load->helper('mobile');
		
		if(is_weixin()) {
			
			//solve redirect error in weixin
			if (isset($this->session->data['first_wechat_url'])) {
				$wechat_url = $this->session->data['first_wechat_url'];
			} else {
				$this->session->data['first_wechat_url'] = $wechat_url;
			}
			
			if (!$this->customer->isLogged()) {
				 
				if ($this->config->get('payment_wxpay_status')) {
					
					if(isset($this->session->data['weixin_openid'])) {
						
						if ($this->customer->login_weixin($this->session->data['weixin_openid'])) {
									  
							// Unset guest
							unset($this->session->data['guest']);
				
							// Default Shipping Address
							$this->load->model('account/address');
				
							if ($this->config->get('config_tax_customer') == 'payment') {
								$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
							}
				
							if ($this->config->get('config_tax_customer') == 'shipping') {
								$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
							}
				
							// Wishlist
							if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
								$this->load->model('account/wishlist');
				
								foreach ($this->session->data['wishlist'] as $key => $product_id) {
									$this->model_account_wishlist->addWishlist($product_id);
				
									unset($this->session->data['wishlist'][$key]);
								}
							}
				
							
						} else {
							
							unset($this->session->data['weixin_openid']);
							$this->response->redirect($this->session->data['first_wechat_url']);
							
						}
						 
						  
					 } elseif (isset($this->request->get['code'])) {
					   
						$appid = $this->config->get('payment_wxpay_appid');
						$appsecret = $this->config->get('payment_wxpay_appsecret');
						
						$openid_result = getOpenid($appid, $appsecret, $this->request->get['code']);
						
						$this->session->data['weixin_openid'] = $openid_result['openid'];
						
						$user_info = getWeiXinUserInfo($appid, $appsecret, $openid_result['openid'], $openid_result['access_token']);
						
						if ($user_info['openid']) {
							
							if ($this->customer->login_weixin($user_info['openid'])) {
									  
								// Unset guest
								unset($this->session->data['guest']);
					
								// Default Shipping Address
								$this->load->model('account/address');
					
								if ($this->config->get('config_tax_customer') == 'payment') {
									$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
								}
					
								if ($this->config->get('config_tax_customer') == 'shipping') {
									$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
								}
					
								// Wishlist
								if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
									$this->load->model('account/wishlist');
					
									foreach ($this->session->data['wishlist'] as $key => $product_id) {
										$this->model_account_wishlist->addWishlist($product_id);
					
										unset($this->session->data['wishlist'][$key]);
									}
								}
								
								$this->response->redirect($this->session->data['first_wechat_url']);
					
								
							}else{ //register
							
							  $weixin_login_unionid = '';
							  $weixin_login_openid = $user_info['openid'];
							  
							  $customer_data = array(
								  'registertype'	=> 'email',
								  'firstname'	=> $user_info['nickname'],
								  'lastname'	=> '',
								  'email'		=> $user_info['openid'],
								  'telephone'	=> $user_info['openid'],
								  'password'	=> $user_info['openid'],
							  );
							  
							  $this->load->model('account/customer');
							  
							  $customer_id = $this->model_account_customer->addCustomer($customer_data, $weixin_login_openid, $weixin_login_unionid);
							  $this->customer->login_weixin($weixin_login_openid);
		  
							  //Unset Third party login session
							  unset($this->session->data['qq_login_warning']);
							  unset($this->session->data['weibo_login_warning']);
							  unset($this->session->data['weixin_login_warning']);
							  unset($this->session->data['qq_nickname']);
				  
							  unset($this->session->data['guest']);
							  
							  $this->response->redirect($this->session->data['first_wechat_url']);
							  
							  //$this->response->redirect($this->url->link('account/account'));
								
							}
							
						}
						
						
					} else {
						$appid = $this->config->get('payment_wxpay_appid');
					   header('Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$wechat_url.'&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect');
						
					}
				  
				}
				
				
			}
		
		}

	}
	

}
