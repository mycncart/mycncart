<?php
class ControllerExtensionSmsChuangLan extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/sms/chuanglan');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('sms_chuanglan', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=sms', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_account'] = $this->language->get('entry_account');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['account'])) {
			$data['error_account'] = $this->error['account'];
		} else {
			$data['error_account'] = '';
		}
		
		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_sms'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/sms/chuanglan', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/sms/chuanglan', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], true);

		if (isset($this->request->post['sms_chuanglan_account'])) {
			$data['sms_chuanglan_account'] = $this->request->post['sms_chuanglan_account'];
		} else {
			$data['sms_chuanglan_account'] = $this->config->get('sms_chuanglan_account');
		}
		
		if (isset($this->request->post['sms_chuanglan_password'])) {
			$data['sms_chuanglan_password'] = $this->request->post['sms_chuanglan_password'];
		} else {
			$data['sms_chuanglan_password'] = $this->config->get('sms_chuanglan_password');
		}
		
		if (isset($this->request->post['sms_chuanglan_status'])) {
			$data['sms_chuanglan_status'] = $this->request->post['sms_chuanglan_status'];
		} else {
			$data['sms_chuanglan_status'] = $this->config->get('sms_chuanglan_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/sms/chuanglan', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/sms/chuanglan')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['sms_chuanglan_account']) {
			$this->error['account'] = $this->language->get('error_account');
		}
		
		if (!$this->request->post['sms_chuanglan_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}
		
		return !$this->error;
	}
}