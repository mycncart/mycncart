<?php
class ControllerCocFaqConfig extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('coc/faq_config');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('coc_faq', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('coc/faq_config', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_edit');
		$data['text_select'] = $this->language->get('text_select');
		
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_coc_faq_seo_keyword'] = $this->language->get('entry_coc_faq_seo_keyword');
		$data['entry_coc_faq_license_id'] = $this->language->get('entry_coc_faq_license_id');
		$data['entry_coc_faq_template'] = $this->language->get('entry_coc_faq_template');

		$data['help_coc_faq_seo_keyword'] = $this->language->get('help_coc_faq_seo_keyword');
		$data['help_coc_faq_license_id'] = $this->language->get('help_coc_faq_license_id');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_license'] = $this->language->get('tab_license');
		
		$data['need_license'] = '';
		
		if(stristr(HTTP_SERVER, 'localhost')) {
			
			
		}else{
			
			if($this->config->get('coc_faq_license_id')) {
				
				
				
			}else{
				
				$data['need_license'] = 'This extension is used for 10 days for free, please enter license code in license tab page and save.';
			
			}
			
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if(stristr(HTTP_SERVER, 'localhost')) {
			
		}else{
			
			
		}

		if (isset($this->error['coc_faq_seo_keyword'])) {
			$data['error_coc_faq_seo_keyword'] = $this->error['coc_faq_seo_keyword'];
		} else {
			$data['error_coc_faq_seo_keyword'] = '';
		}
		
		if (isset($this->error['coc_faq_license_id'])) {
			$data['error_coc_faq_license_id'] = $this->error['coc_faq_license_id'];
		} else {
			$data['error_coc_faq_license_id'] = '';
		}



		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_stores'),
			'href' => $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('coc/faq_config', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('common/dashborad', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['coc_faq_seo_keyword'])) {
			$data['coc_faq_seo_keyword'] = $this->request->post['coc_faq_seo_keyword'];
		} else {
			$data['coc_faq_seo_keyword'] = $this->config->get('coc_faq_seo_keyword');
		}
		
		if (isset($this->request->post['coc_faq_license_id'])) {
			$data['coc_faq_license_id'] = $this->request->post['coc_faq_license_id'];
		} else {
			$data['coc_faq_license_id'] = $this->config->get('coc_faq_license_id');
		}
		
		if (isset($this->request->post['coc_faq_template'])) {
			$data['coc_faq_template'] = $this->request->post['coc_faq_template'];
		} elseif ($this->config->get('coc_faq_template')) {
			$data['coc_faq_template'] = $this->config->get('coc_faq_template');
		} else {
			$data['coc_faq_template'] = 'default';
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['coc_faq_description'])) {
			$data['coc_faq_description'] = $this->request->post['coc_faq_description'];
		} elseif ($this->config->get('coc_faq_description')) {
			$data['coc_faq_description'] = $this->config->get('coc_faq_description');
		} else {
			$data['coc_faq_description'] = array();
		}
		


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('coc/faq_config.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'coc/faq_config')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['coc_faq_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if (utf8_strlen($this->request->post['coc_faq_seo_keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['coc_faq_seo_keyword']);

			if ($url_alias_info) {
				$this->error['coc_faq_seo_keyword'] = sprintf($this->language->get('error_coc_faq_seo_keyword'));
			}

		}


		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

}