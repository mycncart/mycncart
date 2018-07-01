<?php
class ControllerDesignLayoutMobile extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('design/layout_mobile');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('design/layout_mobile');

		$this->getList();
	}

	public function add() {
		$this->load->language('design/layout_mobile');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/layout_mobile');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_layout_mobile->addLayoutMobile($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('design/layout_mobile');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/layout_mobile');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_layout_mobile->editLayoutMobile($this->request->get['layout_mobile_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('design/layout_mobile');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/layout_mobile');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $layout_mobile_id) {
				$this->model_design_layout_mobile->deleteLayoutMobile($layout_mobile_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('design/layout_mobile/add', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('design/layout_mobile/delete', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['layout_mobiles'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$layout_mobile_total = $this->model_design_layout_mobile->getTotalLayoutMobiles();

		$results = $this->model_design_layout_mobile->getLayoutMobiles($filter_data);

		foreach ($results as $result) {
			$data['layout_mobiles'][] = array(
				'layout_mobile_id' => $result['layout_mobile_id'],
				'name'      => $result['name'],
				'edit'      => $this->url->link('design/layout_mobile/edit', 'user_token=' . $this->session->data['user_token'] . '&layout_mobile_id=' . $result['layout_mobile_id'] . $url)
			);
		}

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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $layout_mobile_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($layout_mobile_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($layout_mobile_total - $this->config->get('config_limit_admin'))) ? $layout_mobile_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $layout_mobile_total, ceil($layout_mobile_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/layout_mobile_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['layout_mobile_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		if (!isset($this->request->get['layout_mobile_id'])) {
			$data['action'] = $this->url->link('design/layout_mobile/add', 'user_token=' . $this->session->data['user_token'] . $url);
		} else {
			$data['action'] = $this->url->link('design/layout_mobile/edit', 'user_token=' . $this->session->data['user_token'] . '&layout_mobile_id=' . $this->request->get['layout_mobile_id'] . $url);
		}

		$data['cancel'] = $this->url->link('design/layout_mobile', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->get['layout_mobile_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$layout_mobile_info = $this->model_design_layout_mobile->getLayoutMobile($this->request->get['layout_mobile_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($layout_mobile_info)) {
			$data['name'] = $layout_mobile_info['name'];
		} else {
			$data['name'] = '';
		}

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['layout_mobile_route'])) {
			$data['layout_mobile_routes'] = $this->request->post['layout_mobile_route'];
		} elseif (isset($this->request->get['layout_mobile_id'])) {
			$data['layout_mobile_routes'] = $this->model_design_layout_mobile->getLayoutMobileRoutes($this->request->get['layout_mobile_id']);
		} else {
			$data['layout_mobile_routes'] = array();
		}

		$this->load->model('setting/extension');

		$this->load->model('setting/module');

		$data['extensions'] = array();
		
		// Get a list of installed modules
		$extensions = $this->model_setting_extension->getInstalled('module_mobile');

		// Add all the modules which have multiple settings for each module
		foreach ($extensions as $code) {
			$this->load->language('extension/module/' . $code, 'extension');

			$module_data = array();

			$modules = $this->model_setting_module->getModulesByCode($code);

			foreach ($modules as $module) {
				$module_data[] = array(
					'name' => strip_tags($module['name']),
					'code' => $code . '.' .  $module['module_id']
				);
			}

			if ($this->config->has('module_' . $code . '_status') || $module_data) {
				$data['extensions'][] = array(
					'name'   => strip_tags($this->language->get('extension')->get('heading_title')),
					'code'   => $code,
					'module' => $module_data
				);
			}
		}

		// Modules layout_mobile
		if (isset($this->request->post['layout_mobile_module'])) {
			$layout_mobile_modules = $this->request->post['layout_mobile_module'];
		} elseif (isset($this->request->get['layout_mobile_id'])) {
			$layout_mobile_modules = $this->model_design_layout_mobile->getLayoutMobileModules($this->request->get['layout_mobile_id']);
		} else {
			$layout_mobile_modules = array();
		}

		$data['layout_mobile_modules'] = array();
		
		// Add all the modules which have multiple settings for each module
		foreach ($layout_mobile_modules as $layout_mobile_module) {
			$part = explode('.', $layout_mobile_module['code']);
		
			$this->load->language('extension/module_mobile/' . $part[0]);

			if (!isset($part[1])) {
				$data['layout_mobile_modules'][] = array(
					'name'       => strip_tags($this->language->get('heading_title')),
					'code'       => $layout_mobile_module['code'],
					'position'   => $layout_mobile_module['position'],
					'sort_order' => $layout_mobile_module['sort_order']
				);
			} else {
				$module_info = $this->model_setting_module->getModule($part[1]);
				
				if ($module_info) {
					$data['layout_mobile_modules'][] = array(
						'name'       => strip_tags($module_info['name']),
						'code'       => $layout_mobile_module['code'],
						'position'   => $layout_mobile_module['position'],
						'sort_order' => $layout_mobile_module['sort_order']
					);
				}				
			}
		}		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/layout_mobile_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/layout_mobile')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/layout_mobile')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('catalog/information');

		foreach ($this->request->post['selected'] as $layout_mobile_id) {
			if ($this->config->get('config_layout_mobile_id') == $layout_mobile_id) {
				$this->error['warning'] = $this->language->get('error_default');
			}

			$store_total = $this->model_setting_store->getTotalStoresByLayoutMobileId($layout_mobile_id);

			if ($store_total) {
				$this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
			}

			$product_total = $this->model_catalog_product->getTotalProductsByLayoutMobileId($layout_mobile_id);

			if ($product_total) {
				$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
			}

			$category_total = $this->model_catalog_category->getTotalCategoriesByLayoutMobileId($layout_mobile_id);

			if ($category_total) {
				$this->error['warning'] = sprintf($this->language->get('error_category'), $category_total);
			}

			$information_total = $this->model_catalog_information->getTotalInformationsByLayoutMobileId($layout_mobile_id);

			if ($information_total) {
				$this->error['warning'] = sprintf($this->language->get('error_information'), $information_total);
			}
		}

		return !$this->error;
	}
}
