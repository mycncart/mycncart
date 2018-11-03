<?php
class ControllerUserPermission extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/permission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission');

		$this->getList();
	}

	public function add() {
		$this->load->language('user/permission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_permission->addPermission($this->request->post);

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

			$this->response->redirect($this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('user/permission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_permission->editPermission($this->request->get['permission_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('user/permission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $permission_id) {
				$this->model_user_permission->deletePermission($permission_id);
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

			$this->response->redirect($this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'permission_group';
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
			'href' => $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('user/permission/add', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('user/permission/delete', 'user_token=' . $this->session->data['user_token'] . $url);
		
		$data['generate_all'] = $this->url->link('user/permission/generate_all', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['permissions'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$permission_total = $this->model_user_permission->getTotalPermissions();

		$results = $this->model_user_permission->getPermissions($filter_data);

		foreach ($results as $result) {
			$data['permissions'][] = array(
				'permission_id'    => $result['permission_id'],
				'name'            => $result['name'],
				'permission_group' => $result['permission_group'],
				'controller'      => $result['controller'],
				'sort_order'      => $result['sort_order'],
				'edit'            => $this->url->link('user/permission/edit', 'user_token=' . $this->session->data['user_token'] . '&permission_id=' . $result['permission_id'] . $url)
			);
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} elseif (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];

			unset($this->session->data['warning']);
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

		$data['sort_name'] = $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . '&sort=p.name' . $url);
		$data['sort_permission_group'] = $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . '&sort=permission_group' . $url);
		$data['sort_controller'] = $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . '&sort=p.controller' . $url);
		$data['sort_sort_order'] = $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . '&sort=p.sort_order' . $url);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['pagination'] = $this->load->controller('common/pagination', array(
			'total' => $permission_total,
			'page'  => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'url'   => $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		));

		$data['results'] = sprintf($this->language->get('text_pagination'), ($permission_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($permission_total - $this->config->get('config_limit_admin'))) ? $permission_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $permission_total, ceil($permission_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/permission_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['permission_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['permission_group'])) {
			$data['error_permission_group'] = $this->error['permission_group'];
		} else {
			$data['error_permission_group'] = '';
		}
		
		if (isset($this->error['controller'])) {
			$data['error_controller'] = $this->error['controller'];
		} else {
			$data['error_controller'] = array();
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
			'href' => $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		if (!isset($this->request->get['permission_id'])) {
			$data['action'] = $this->url->link('user/permission/add', 'user_token=' . $this->session->data['user_token'] . $url);
		} else {
			$data['action'] = $this->url->link('user/permission/edit', 'user_token=' . $this->session->data['user_token'] . '&permission_id=' . $this->request->get['permission_id'] . $url);
		}

		$data['cancel'] = $this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url);

		if (isset($this->request->get['permission_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$permission_info = $this->model_user_permission->getPermission($this->request->get['permission_id']);
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($permission_info)) {
			$data['name'] = $permission_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['permission_group_id'])) {
			$data['permission_group_id'] = $this->request->post['permission_group_id'];
		} elseif (!empty($permission_info)) {
			$data['permission_group_id'] = $permission_info['permission_group_id'];
		} else {
			$data['permission_group_id'] = '';
		}
		
		$this->load->model('user/permission_group');

		$data['permission_groups'] = $this->model_user_permission_group->getPermissionGroups();
		
		if (isset($this->request->post['controller'])) {
			$data['controller'] = $this->request->post['controller'];
		} elseif (!empty($permission_info)) {
			$data['controller'] = $permission_info['controller'];
		} else {
			$data['controller'] = '';
		}
		
		$ignore = array(
			'common/dashboard',
			'common/startup',
			'common/login',
			'common/logout',
			'common/forgotten',
			'common/reset',			
			'common/footer',
			'common/header',
			'error/not_found',
			'error/permission'
		);

		$data['permission_controllers'] = array();

		$files = array();

		// Make path into an array
		$path = array(DIR_APPLICATION . 'controller/*');

		// While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}

		// Sort the file array
		sort($files);
					
		foreach ($files as $file) {
			$controller = substr($file, strlen(DIR_APPLICATION . 'controller/'));

			$permission = substr($controller, 0, strrpos($controller, '.'));

			if (!in_array($permission, $ignore)) {
				$data['permission_controllers'][] = $permission;
			}
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($permission_info)) {
			$data['sort_order'] = $permission_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/permission_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/permission')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['permission_group_id']) {
			$this->error['permission_group'] = $this->language->get('error_permission_group');
		}
		
		if (!$this->request->post['controller']) {
			$this->error['controller'] = $this->language->get('error_controller');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'user/permission')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('user/user_group');

		foreach ($this->request->post['selected'] as $permission_id) {
			$permission_total = $this->model_user_user_group->getTotalPermissionsByPermissionId($permission_id);

			if ($permission_total) {
				$this->error['warning'] = sprintf($this->language->get('error_user_group'), $permission_total);
			}
		}

		return !$this->error;
	}
	
	public function generate_all() {
		
		if (!$this->user->hasPermission('modify', 'user/permission')) {
			
			$this->session->data['warning'] = $this->language->get('error_permission');
			
		} else {
		
			$ignore = array(
				'common/dashboard',
				'common/startup',
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',			
				'common/footer',
				'common/header',
				'error/not_found',
				'error/permission'
			);
	
			$permissions = array();
	
			$files = array();
	
			// Make path into an array
			$path = array(DIR_APPLICATION . 'controller/*');
	
			// While the path array is still populated keep looping through
			while (count($path) != 0) {
				$next = array_shift($path);
	
				foreach (glob($next) as $file) {
					// If directory add to path array
					if (is_dir($file)) {
						$path[] = $file . '/*';
					}
	
					// Add the file to the files to be deleted array
					if (is_file($file)) {
						$files[] = $file;
					}
				}
			}
	
			// Sort the file array
			sort($files);
						
			foreach ($files as $file) {
				$controller = substr($file, strlen(DIR_APPLICATION . 'controller/'));
	
				$permission = substr($controller, 0, strrpos($controller, '.'));
	
				if (!in_array($permission, $ignore)) {
					$permissions[] = $permission;
				}
			}
			
			$this->load->model('user/permission');
			
			foreach ($permissions as $controller) {
				$result = $this->model_user_permission->getPermissionByControllerName($controller);
				if (!$result) {
					$data = array(
						'name' => $controller,
						'controller' => $controller,
						'permission_group_id' => 9999,
						'sort_order' => 0
					);
					$this->model_user_permission->addPermission($data);
				}
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
	
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
		
		$this->response->redirect($this->url->link('user/permission', 'user_token=' . $this->session->data['user_token'] . $url));
		
	}

}
