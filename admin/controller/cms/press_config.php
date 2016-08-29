<?php
class ControllerCmsPressConfig extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('cms/press_config');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('cms_press', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('cms/press_config', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_edit');
		$data['text_select'] = $this->language->get('text_select');
		
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_cms_press_seo_keyword'] = $this->language->get('entry_cms_press_seo_keyword');
		$data['entry_cms_press_brief_length'] = $this->language->get('entry_cms_press_brief_length');
		$data['entry_cms_press_items_per_page'] = $this->language->get('entry_cms_press_items_per_page');

		$data['help_cms_press_seo_keyword'] = $this->language->get('help_cms_press_seo_keyword');
		$data['help_cms_press_brief_length'] = $this->language->get('help_cms_press_brief_length');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['cms_press_seo_keyword'])) {
			$data['error_cms_press_seo_keyword'] = $this->error['cms_press_seo_keyword'];
		} else {
			$data['error_cms_press_seo_keyword'] = '';
		}
		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('cms/press_config', 'token=' . $this->session->data['token'], true)
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('cms/press_config', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['cms_press_description'])) {
			$data['cms_press_description'] = $this->request->post['cms_press_description'];
		} elseif ($this->config->get('cms_press_description')) {
			$data['cms_press_description'] = $this->config->get('cms_press_description');
		} else {
			$data['cms_press_description'] = array();
		}
		
		if (isset($this->request->post['cms_press_seo_keyword'])) {
			$data['cms_press_seo_keyword'] = $this->request->post['cms_press_seo_keyword'];
		} else {
			$data['cms_press_seo_keyword'] = $this->config->get('cms_press_seo_keyword');
		}
		
		
		if (isset($this->request->post['cms_press_brief_length'])) {
			$data['cms_press_brief_length'] = $this->request->post['cms_press_brief_length'];
		} else {
			$data['cms_press_brief_length'] = $this->config->get('cms_press_brief_length');
		}
		
		if (isset($this->request->post['cms_press_items_per_page'])) {
			$data['cms_press_items_per_page'] = $this->request->post['cms_press_items_per_page'];
		} else {
			$data['cms_press_items_per_page'] = $this->config->get('cms_press_items_per_page');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('cms/press_config', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'cms/press_config')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['cms_press_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if (utf8_strlen($this->request->post['cms_press_seo_keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['cms_press_seo_keyword']);

			if ($url_alias_info) {
				$this->error['cms_press_seo_keyword'] = sprintf($this->language->get('error_cms_press_seo_keyword'));
			}

		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

}