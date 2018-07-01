<?php
class ControllerExtensionExtensionModulePC extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/extension/module_pc');

		$this->load->model('setting/extension');

		$this->load->model('setting/module_pc');

		$this->getList();
	}

	public function install() {
		$this->load->language('extension/extension/module_pc');

		$this->load->model('setting/extension');

		$this->load->model('setting/module_pc');

		if ($this->validate()) {
			$this->model_setting_extension->install('module_pc', $this->request->get['extension']);

			$this->load->model('user/user_group');

			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module_pc/' . $this->request->get['extension']);
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module_pc/' . $this->request->get['extension']);

			// Call install method if it exsits
			$this->load->controller('extension/module_pc/' . $this->request->get['extension'] . '/install');

			$this->session->data['success'] = $this->language->get('text_success');
		} else {
			$this->session->data['error'] = $this->error['warning'];
		}
	
		$this->getList();
	}

	public function uninstall() {
		$this->load->language('extension/extension/module_pc');

		$this->load->model('setting/extension');

		$this->load->model('setting/module_pc');

		if ($this->validate()) {
			$this->model_setting_extension->uninstall('module_pc', $this->request->get['extension']);

			$this->model_setting_module_pc->deleteModulePCsByCode($this->request->get['extension']);

			// Call uninstall method if it exsits
			$this->load->controller('extension/module_pc/' . $this->request->get['extension'] . '/uninstall');

			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->getList();
	}
	
	public function add() {
		$this->load->language('extension/extension/module_pc');

		$this->load->model('setting/extension');

		$this->load->model('setting/module_pc');

		if ($this->validate()) {
			$this->load->language('module_pc' . '/' . $this->request->get['extension']);
			
			$this->model_setting_module_pc->addModulePC($this->request->get['extension'], $this->language->get('heading_title'));

			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->getList();
	}

	public function delete() {
		$this->load->language('extension/extension/module_pc');

		$this->load->model('setting/extension');

		$this->load->model('setting/module_pc');

		if (isset($this->request->get['module_pc_id']) && $this->validate()) {
			$this->model_setting_module_pc->deleteModulePC($this->request->get['module_pc_id']);

			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$this->getList();
	}

	protected function getList() {
		$data['text_layout'] = sprintf($this->language->get('text_layout'), $this->url->link('design/layout', 'user_token=' . $this->session->data['user_token']));

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$extensions = $this->model_setting_extension->getInstalled('module_pc');

		foreach ($extensions as $key => $value) {
			if (!is_file(DIR_APPLICATION . 'controller/extension/module_pc/' . $value . '.php') && !is_file(DIR_APPLICATION . 'controller/module_pc/' . $value . '.php')) {
				$this->model_setting_extension->uninstall('module_pc', $value);

				unset($extensions[$key]);
				
				$this->model_setting_module_pc->deleteModulePCsByCode($value);
			}
		}

		$data['extensions'] = array();

		// Create a new language container so we don't pollute the current one
		$language = new Language($this->config->get('config_language'));
		
		// Compatibility code for old extension folders
		$files = glob(DIR_APPLICATION . 'controller/extension/module_pc/*.php');

		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');

				$this->load->language('extension/module_pc/' . $extension, 'extension');

				$module_pc_data = array();

				$module_pcs = $this->model_setting_module_pc->getModulePCsByCode($extension);

				foreach ($module_pcs as $module_pc) {
					if ($module_pc['setting']) {
						$setting_info = json_decode($module_pc['setting'], true);
					} else {
						$setting_info = array();
					}
					
					$module_pc_data[] = array(
						'module_pc_id' => $module_pc['module_pc_id'],
						'name'      => $module_pc['name'],
						'status'    => (isset($setting_info['status']) && $setting_info['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
						'edit'      => $this->url->link('extension/module_pc/' . $extension, 'user_token=' . $this->session->data['user_token'] . '&module_pc_id=' . $module_pc['module_pc_id']),
						'delete'    => $this->url->link('extension/extension/module_pc/delete', 'user_token=' . $this->session->data['user_token'] . '&module_pc_id=' . $module_pc['module_pc_id'])
					);
				}

				$data['extensions'][] = array(
					'name'      => $this->language->get('extension')->get('heading_title'),
					'status'    => $this->config->get('module_pc_' . $extension . '_status') ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
					'module_pc'    => $module_pc_data,
					'install'   => $this->url->link('extension/extension/module_pc/install', 'user_token=' . $this->session->data['user_token'] . '&extension=' . $extension),
					'uninstall' => $this->url->link('extension/extension/module_pc/uninstall', 'user_token=' . $this->session->data['user_token'] . '&extension=' . $extension),
					'installed' => in_array($extension, $extensions),
					'edit'      => $this->url->link('extension/module_pc/' . $extension, 'user_token=' . $this->session->data['user_token'])
				);
			}
		}

		$sort_order = array();

		foreach ($data['extensions'] as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $data['extensions']);

		$this->response->setOutput($this->load->view('extension/extension/module_pc', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/extension/module_pc')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
