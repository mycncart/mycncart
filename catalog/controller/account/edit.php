<?php
class ControllerAccountEdit extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->load->language('account/edit');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_account_customer->editCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFullName()
			);

			$this->model_account_activity->addActivity('edit', $activity_data);

			$this->response->redirect($this->url->link('account/account', '', 'SSL'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_edit'),
			'href'      => $this->url->link('account/edit', '', 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_additional'] = $this->language->get('text_additional');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_get_sms_code'] = $this->language->get('text_get_sms_code');
		$data['text_sms_hint'] = $this->language->get('text_sms_hint');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_fullname'] = $this->language->get('entry_fullname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_sms_code'] = $this->language->get('entry_sms_code');
		$data['entry_fax'] = $this->language->get('entry_fax');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');
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
		
		if (isset($this->error['sms_code'])) {
			$data['error_sms_code'] = $this->error['sms_code'];
		} else {
			$data['error_sms_code'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		$data['action'] = $this->url->link('account/edit', '', 'SSL');

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

		if (isset($this->request->post['fullname'])) {
			$data['fullname'] = $this->request->post['fullname'];
		} elseif (!empty($customer_info)) {
			$data['fullname'] = $customer_info['fullname'];
		} else {
			$data['fullname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$data['email'] = $customer_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$data['telephone'] = $customer_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} elseif (!empty($customer_info)) {
			$data['fax'] = $customer_info['fax'];
		} else {
			$data['fax'] = '';
		}
		
		//SMS
		if($this->smsgateway()) {
			
			$sms_gateway = $this->smsgateway();
			
			$data['sms_gateway'] = $sms_gateway[0];
			
		}else{
			
			$data['sms_gateway'] = '';
			
		}
		
		if (isset($this->request->post['sms_code'])) {
			$data['sms_code'] = $this->request->post['sms_code'];
		} else {
			$data['sms_code'] = '';
		}

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		if (isset($this->request->post['custom_field'])) {
			$data['account_custom_field'] = $this->request->post['custom_field'];
		} elseif (isset($customer_info)) {
			$data['account_custom_field'] = json_decode($customer_info['custom_field']);
		} else {
			$data['account_custom_field'] = array();
		}

		$data['back'] = $this->url->link('account/account', '', 'SSL');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/edit.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/edit.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/edit.tpl', $data));
		}
	}

	protected function validate() {
		if ((utf8_strlen(trim($this->request->post['fullname'])) < 2) || (utf8_strlen(trim($this->request->post['fullname'])) > 32)) {
			$this->error['fullname'] = $this->language->get('error_fullname');
		}


		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (($this->customer->getEmail() != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}else{
			if($this->customer->getTelephone() == trim($this->request->post['telephone'])) {
			
			}else{
				// if sms code is not correct
				// if sms code is not correct
				if (isset($this->request->post['sms_code'])) {
					$this->load->model('account/smsmobile');
					if($this->model_account_smsmobile->verifySmsCode($this->request->post['telephone'], $this->request->post['sms_code']) == 0) {
						$this->error['sms_code'] = $this->language->get('error_sms_code');
					}
				}
			}
			
			
		}

		// Custom field validation
		$this->load->model('account/custom_field');

		$custom_fields = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		foreach ($custom_fields as $custom_field) {
			if (($custom_field['location'] == 'account') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		return !$this->error;
	}
	
	public function smsgateway() {
		
		$sms_gateway = array();

		$this->load->model('extension/extension');

		$results = $this->model_extension_extension->getExtensions('sms');


		foreach ($results as $result) {
			if ($this->config->get($result['code'] . '_status')) {

					$sms_gateway[] = $result['code'];

			}
		}
		
		return $sms_gateway;
		
	}
}