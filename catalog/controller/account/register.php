<?php
class ControllerAccountRegister extends Controller {
	private $error = array();

	public function index() {
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}
		
		//weixin
		if(isset($this->session->data['weixin_login_openid']) &&  isset($this->session->data['weixin_login_unionid'])){
			$weixin_login_unionid = $this->session->data['weixin_login_unionid'];
			$weixin_login_openid = $this->session->data['weixin_login_openid'];
		}elseif(isset($this->session->data['weixin_pclogin_openid']) &&  isset($this->session->data['weixin_pclogin_unionid'])){
			$weixin_login_unionid = $this->session->data['weixin_pclogin_unionid'];
			$weixin_login_openid = $this->session->data['weixin_pclogin_openid'];
		}else{
			$weixin_login_unionid = '';
			$weixin_login_openid = '';
		}
		
		//weibo
		if(isset($this->session->data['weibo_login_access_token']) &&  isset($this->session->data['weibo_login_uid'])) {
			$weibo_login_uid = $this->session->data['weibo_login_uid'];
			$weibo_login_access_token = $this->session->data['weibo_login_access_token'];
		}else{
			$weibo_login_uid = '';
			$weibo_login_access_token = '';
		}
		
		//qq
		if(isset($this->session->data['qq_openid'])) {
			$qq_openid = $this->session->data['qq_openid'];
		}else{
			$qq_openid = '';
		}

		$this->load->language('account/register');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$customer_id = $this->model_account_customer->addCustomer($this->request->post, $weixin_login_openid, $weixin_login_unionid);
			
			if($weibo_login_access_token && $weibo_login_uid) {
				$this->model_account_customer->updateCustomerWeiBoInfo($customer_id, $weibo_login_access_token, $weibo_login_uid);
			}
			
			if($qq_openid) {
				$this->model_account_customer->updateCustomerQQInfo($customer_id, $qq_openid);
			}

			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

			$this->customer->login($this->request->post['email'], $this->request->post['password']);
			
			//Unset Third party login session
			unset($this->session->data['qq_login_warning']);
			unset($this->session->data['weibo_login_warning']);
			unset($this->session->data['weixin_login_warning']);
			unset($this->session->data['qq_nickname']);

			unset($this->session->data['guest']);

			// Add to activity log
			if ($this->config->get('config_customer_activity')) {
				$this->load->model('account/activity');

				$activity_data = array(
					'customer_id' => $customer_id,
					'name'        => $this->request->post['fullname']
				);

				$this->model_account_activity->addActivity('register', $activity_data);
			}

			$this->response->redirect($this->url->link('account/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('account/register', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_your_password'] = $this->language->get('text_your_password');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_get_sms_code'] = $this->language->get('text_get_sms_code');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_fullname'] = $this->language->get('entry_fullname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_sms_code'] = $this->language->get('entry_sms_code');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		
		//Tabs
		$data['tab_email_register'] = $this->language->get('tab_email_register');
		$data['tab_mobile_register'] = $this->language->get('tab_mobile_register');
		
		
		//Buttons
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['fullname'])) {
			$data['error_fullname'] = $this->error['fullname'];
		} else {
			$data['error_fullname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}
		
		if (isset($this->error['sms_code'])) {
			$data['error_sms_code'] = $this->error['sms_code'];
		} else {
			$data['error_sms_code'] = '';
		}

		$data['action'] = $this->url->link('account/register', '', true);

		$data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$data['customer_groups'][] = $customer_group;
				}
			}
		}

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
		
		if (isset($this->request->post['registertype'])) {
			$data['registertype'] = $this->request->post['registertype'];
		} else {
			$data['registertype'] = 'email';
		}

		if (isset($this->request->post['fullname'])) {
			$data['fullname'] = $this->request->post['fullname'];
		} else {
			$data['fullname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = '';
		}
		
		//SMS
		
		if ($this->config->get($this->config->get('config_sms') . '_status') && in_array('register', (array)$this->config->get('config_sms_page'))) {
			$data['sms_gateway'] = $this->config->get('config_sms');
		} else {
			$data['sms_gateway'] = '';
		}
		
		if (isset($this->request->post['sms_code'])) {
			$data['sms_code'] = $this->request->post['sms_code'];
		} else {
			$data['sms_code'] = '';
		}

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields();

		if (isset($this->request->post['custom_field'])) {
			if (isset($this->request->post['custom_field']['account'])) {
				$account_custom_field = $this->request->post['custom_field']['account'];
			} else {
				$account_custom_field = array();
			}

			if (isset($this->request->post['custom_field']['address'])) {
				$address_custom_field = $this->request->post['custom_field']['address'];
			} else {
				$address_custom_field = array();
			}

			$data['register_custom_field'] = $account_custom_field + $address_custom_field;
		} else {
			$data['register_custom_field'] = array();
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} else {
			$data['newsletter'] = '';
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/register', $data));
	}

	private function validate() {
		
		if ($this->request->post['registertype'] == 'email') {
			
			if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
				$this->error['email'] = $this->language->get('error_email');
			}
	
			if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
				$this->error['email'] = $this->language->get('error_exists');
			}
			
		} else {
			
			if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
				$this->error['telephone'] = $this->language->get('error_telephone');
			}else{
				
				if ($this->model_account_customer->getTotalCustomersByTelephone(trim($this->request->post['telephone']))) {
					$this->error['telephone'] = $this->language->get('error_telephone_exists');
				} else {
					// if sms code is not correct
					if (isset($this->request->post['sms_code'])) {
						$this->load->model('account/smsmobile');
						if($this->model_account_smsmobile->verifySmsCode($this->request->post['telephone'], $this->request->post['sms_code']) == 0) {
							$this->error['sms_code'] = $this->language->get('error_sms_code');
						}
					}
				
				}
				
			}
		
		}
		
		// Customer Group
		if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
            if ($custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
            	$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
            }
		}

		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}

		return !$this->error;
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
}