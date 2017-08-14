<?php
class ControllerExtensionModuleKefu extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/kefu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('kefu', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_weixin_image'] = $this->language->get('entry_weixin_image');
		$data['entry_weixin_image_title'] = $this->language->get('entry_weixin_image_title');
		$data['entry_qq_number'] = $this->language->get('entry_qq_number');
		$data['entry_qq_name'] = $this->language->get('entry_qq_name');
		$data['entry_qq'] = $this->language->get('entry_qq');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_qq_add'] = $this->language->get('button_qq_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add'] = $this->language->get('button_add');

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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/kefu', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/kefu', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/kefu', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/kefu', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}


		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($module_info)) {
			$data['telephone'] = $module_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['image_title'])) {
			$data['image_title'] = $this->request->post['image_title'];
		} elseif (!empty($module_info)) {
			$data['image_title'] = $module_info['image_title'];
		} else {
			$data['image_title'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($module_info)) {
			$data['image'] = $module_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($module_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['service_qq'])) {
			$data['service_qqs'] = $this->request->post['service_qq'];
		} elseif (!empty($module_info)) {
			$data['service_qqs'] = $module_info['service_qq'];
		} else {
			$data['service_qqs'] = array();
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/kefu', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/kefu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}


		return !$this->error;
	}
}
