<?php
class ControllerYouzanConfig extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('youzan/config');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('youzan', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('youzan/config', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_edit');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_signup'] = $this->language->get('text_signup');
		
		$data['entry_youzan_appid'] = $this->language->get('entry_youzan_appid');
		$data['entry_youzan_appsecret'] = $this->language->get('entry_youzan_appsecret');

		$data['help_youzan_appid'] = $this->language->get('help_youzan_appid');
		$data['help_youzan_appsecret'] = $this->language->get('help_youzan_appsecret');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');



		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		

		if (isset($this->error['youzan_appid'])) {
			$data['error_youzan_appid'] = $this->error['youzan_appid'];
		} else {
			$data['error_youzan_appid'] = '';
		}
		
		if (isset($this->error['youzan_appsecret'])) {
			$data['error_youzan_appsecret'] = $this->error['youzan_appsecret'];
		} else {
			$data['error_youzan_appsecret'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('youzan/config', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('youzan/config', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('common/dashborad', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['youzan_appid'])) {
			$data['youzan_appid'] = $this->request->post['youzan_appid'];
		} else {
			$data['youzan_appid'] = $this->config->get('youzan_appid');
		}
		
		if (isset($this->request->post['youzan_appsecret'])) {
			$data['youzan_appsecret'] = $this->request->post['youzan_appsecret'];
		} else {
			$data['youzan_appsecret'] = $this->config->get('youzan_appsecret');
		}
		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('youzan/config.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'youzan/config')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (utf8_strlen($this->request->post['youzan_appid']) < 1) {
			
			$this->error['youzan_appid'] = $this->language->get('error_youzan_appid');
			
		}
		
		if (utf8_strlen($this->request->post['youzan_appsecret']) < 1) {
			
			$this->error['youzan_appsecret'] = $this->language->get('error_youzan_appsecret');
			
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

}