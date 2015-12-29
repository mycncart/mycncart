<?php
class ControllerSmsChengYu extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('sms/chengyu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('chengyu', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/sms', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_userid'] = $this->language->get('entry_userid');
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

		if (isset($this->error['userid'])) {
			$data['error_userid'] = $this->error['userid'];
		} else {
			$data['error_userid'] = '';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_sms'),
			'href' => $this->url->link('extension/sms', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sms/chengyu', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('sms/chengyu', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/sms', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['chengyu_userid'])) {
			$data['chengyu_userid'] = $this->request->post['chengyu_userid'];
		} else {
			$data['chengyu_userid'] = $this->config->get('chengyu_userid');
		}

		if (isset($this->request->post['chengyu_account'])) {
			$data['chengyu_account'] = $this->request->post['chengyu_account'];
		} else {
			$data['chengyu_account'] = $this->config->get('chengyu_account');
		}
		
		if (isset($this->request->post['chengyu_password'])) {
			$data['chengyu_password'] = $this->request->post['chengyu_password'];
		} else {
			$data['chengyu_password'] = $this->config->get('chengyu_password');
		}

		if (isset($this->request->post['chengyu_status'])) {
			$data['chengyu_status'] = $this->request->post['chengyu_status'];
		} else {
			$data['chengyu_status'] = $this->config->get('chengyu_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sms/chengyu.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'sms/chengyu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['chengyu_userid']) {
			$this->error['userid'] = $this->language->get('error_userid');
		}
		
		if (!$this->request->post['chengyu_account']) {
			$this->error['account'] = $this->language->get('error_account');
		}
		
		if (!$this->request->post['chengyu_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}

		return !$this->error;
	}
}