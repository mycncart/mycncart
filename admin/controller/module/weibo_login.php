<?php
class ControllerModuleWeiBoLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/weibo_login');

		$this->load->model('setting/setting');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('weibo_login', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_weibo_open_signup'] = $this->language->get('text_weibo_open_signup');

		$data['entry_appkey'] = $this->language->get('entry_appkey');
		$data['entry_appsecret'] = $this->language->get('entry_appsecret');
		$data['entry_callback_url'] = $this->language->get('entry_callback_url');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['appkey'])) {
			$data['error_appkey'] = $this->error['appkey'];
		} else {
			$data['error_appkey'] = '';
		}

		if (isset($this->error['appsecret'])) {
			$data['error_appsecret'] = $this->error['appsecret'];
		} else {
			$data['error_appsecret'] = '';
		}
		
		if (isset($this->error['callback_url'])) {
			$data['error_callback_url'] = $this->error['callback_url'];
		} else {
			$data['error_callback_url'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/weibo_login', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('module/weibo_login', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);

		if (isset($this->request->post['weibo_login_appkey'])) {
			$data['weibo_login_appkey'] = $this->request->post['weibo_login_appkey'];
		} else {
			$data['weibo_login_appkey'] = $this->config->get('weibo_login_appkey');
		}

		if (isset($this->request->post['weibo_login_appsecret'])) {
			$data['weibo_login_appsecret'] = $this->request->post['weibo_login_appsecret'];
		} else {
			$data['weibo_login_appsecret'] = $this->config->get('weibo_login_appsecret');
		}
		if (isset($this->request->post['weibo_login_callback_url'])) {
			$data['weibo_login_callback_url'] = $this->request->post['weibo_login_callback_url'];
		} elseif($this->config->get('weibo_login_callback_url')) {
			$data['weibo_login_callback_url'] = $this->config->get('weibo_login_callback_url');
		} else {
			$data['weibo_login_callback_url'] =$this->url->link('module/weibo_login/callback', '', true);
		}

		if (isset($this->request->post['weibo_login_status'])) {
			$data['weibo_login_status'] = $this->request->post['weibo_login_status'];
		} else {
			$data['weibo_login_status'] = $this->config->get('weibo_login_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/weibo_login', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/weibo_login')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['weibo_login_appkey']) {
			$this->error['appkey'] = $this->language->get('error_appkey');
		}

		if (!$this->request->post['weibo_login_appsecret']) {
			$this->error['appsecret'] = $this->language->get('error_appsecret');
		}
		
		if (!$this->request->post['weibo_login_callback_url']) {
			$this->error['callback_url'] = $this->language->get('error_callback_url');
		}

		return !$this->error;
	}

	public function install() {
		$this->load->model('extension/event');

		$this->model_extension_event->addEvent('weibo_login', 'post.customer.logout', 'module/weibo_login/logout');
	}

	public function uninstall() {
		$this->load->model('extension/event');

		$this->model_extension_event->deleteEvent('weibo_login');
	}
}