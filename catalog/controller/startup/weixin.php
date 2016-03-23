<?php
class ControllerStartupWeiXin extends Controller {
	public function index() {
		$wechat_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		
		$this->load->helper('mobile');
		
		if(is_weixin()) {
			
			if (!$this->customer->isLogged()) {
				
				  if(isset($this->session->data['weixin_login_openid']) &&  isset($this->session->data['weixin_login_unionid'])) {
					 
					   //自动登录开始
					   
					   
					   //是否存在微信用户点击了退出或登录状态，
					   if(isset($this->session->data['weixin_logout_status'])) {
						   //如果用户实现了微信登录(无论是PC端还是微信端)
						   if($this->session->data['weixin_logout_status'] == 0) {
					   
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
						
									
								}else{
									
								}
							
						   }
						
					   }else{ //如果不存在微信用户点击了退出或登录状态，则直接微信登录或创建新账户
							
							
					   
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
					
								$this->response->redirect($wechat_url);
							}else{
								
							}
							
						      
						   
					   }
						
						
						
						
					  
				  }else{
					 
					  $appid = $this->config->get('wx_login_appid');
					  $appsecret = $this->config->get('wx_login_appsecret');
							  
					  $weixin_result = getWeiXinUserInfo($appid, $appsecret);
					  
						
					  if($weixin_result['openid'] && $weixin_result['unionid']) {	
						
						  $this->session->data['weixin_login_openid'] = $weixin_result['openid'];
						  
						  $this->session->data['weixin_login_unionid'] = $weixin_result['unionid'];
					  
					  }else{
						  
						  $this->session->data['weixin_login_openid'] = '';
					  
					  	  $this->session->data['weixin_login_unionid'] = '';
					  }
	  
					  header('Location: '.$wechat_url);
					  
				  }
			  
			}
		
		}
		
		
	}

}
