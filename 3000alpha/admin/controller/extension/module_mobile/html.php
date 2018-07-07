<?php
class ControllerExtensionModuleMobileHTML extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module_mobile/html');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
		$this->document->addScript('view/javascript/ckeditor/adapters/jquery.js');

		$this->load->model('setting/module_mobile');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_mobile_id'])) {
				$this->model_setting_module_mobile->addModuleMobile('html', $this->request->post);
			} else {
				$this->model_setting_module_mobile->editModuleMobile($this->request->get['module_mobile_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module_mobile'));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module_mobile')
		);

		if (!isset($this->request->get['module_mobile_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module_mobile/html', 'user_token=' . $this->session->data['user_token'])
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module_mobile/html', 'user_token=' . $this->session->data['user_token'] . '&module_mobile_id=' . $this->request->get['module_mobile_id'])
			);
		}

		if (!isset($this->request->get['module_mobile_id'])) {
			$data['action'] = $this->url->link('extension/module_mobile/html', 'user_token=' . $this->session->data['user_token']);
		} else {
			$data['action'] = $this->url->link('extension/module_mobile/html', 'user_token=' . $this->session->data['user_token'] . '&module_mobile_id=' . $this->request->get['module_mobile_id']);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module_mobile');

		if (isset($this->request->get['module_mobile_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_mobile_info = $this->model_setting_module_mobile->getModuleMobile($this->request->get['module_mobile_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_mobile_info)) {
			$data['name'] = $module_mobile_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['module_mobile_description'])) {
			$data['module_mobile_description'] = $this->request->post['module_mobile_description'];
		} elseif (!empty($module_mobile_info)) {
			$data['module_mobile_description'] = $module_mobile_info['module_mobile_description'];
		} else {
			$data['module_mobile_description'] = array();
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_mobile_info)) {
			$data['status'] = $module_mobile_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module_mobile/html', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module_mobile/html')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}
}