<?php
class ControllerWeidianConfig extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('weidian/config');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('weidian', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('weidian/config', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_edit');
		$data['text_select'] = $this->language->get('text_select');
		
		
		$data['entry_weidian_appkey'] = $this->language->get('entry_weidian_appkey');
		$data['entry_weidian_secret'] = $this->language->get('entry_weidian_secret');

		$data['help_weidian_appkey'] = $this->language->get('help_weidian_appkey');
		$data['help_weidian_secret'] = $this->language->get('help_weidian_secret');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');



		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		

		if (isset($this->error['weidian_appkey'])) {
			$data['error_weidian_appkey'] = $this->error['weidian_appkey'];
		} else {
			$data['error_weidian_appkey'] = '';
		}
		
		if (isset($this->error['weidian_secret'])) {
			$data['error_weidian_secret'] = $this->error['weidian_secret'];
		} else {
			$data['error_weidian_secret'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('weidian/config', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('weidian/config', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('common/dashborad', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['weidian_appkey'])) {
			$data['weidian_appkey'] = $this->request->post['weidian_appkey'];
		} else {
			$data['weidian_appkey'] = $this->config->get('weidian_appkey');
		}
		
		if (isset($this->request->post['weidian_secret'])) {
			$data['weidian_secret'] = $this->request->post['weidian_secret'];
		} else {
			$data['weidian_secret'] = $this->config->get('weidian_secret');
		}
		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('weidian/config.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'weidian/config')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (utf8_strlen($this->request->post['weidian_appkey']) < 1) {
			
			$this->error['weidian_appkey'] = $this->language->get('error_weidian_appkey');
			
		}
		
		if (utf8_strlen($this->request->post['weidian_secret']) < 1) {
			
			$this->error['weidian_secret'] = $this->language->get('error_weidian_secret');
			
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

}