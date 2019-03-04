<?php
class ControllerUserPermissionGroup extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/permission_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission_group');

		$this->getList();
	}

	public function add() {
		$this->load->language('user/permission_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_permission_group->addPermissionGroup($this->request->post);

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

			$this->response->redirect($this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('user/permission_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_permission_group->editPermissionGroup($this->request->get['permission_group_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('user/permission_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/permission_group');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $permission_group_id) {
				$this->model_user_permission_group->deletePermissionGroup($permission_group_id);
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

			$this->response->redirect($this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'sort_order';
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
			'href' => $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('user/permission_group/add', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('user/permission_group/delete', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['permission_groups'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$permission_group_total = $this->model_user_permission_group->getTotalPermissionGroups();

		$results = $this->model_user_permission_group->getPermissionGroups($filter_data);

		foreach ($results as $result) {
			$data['permission_groups'][] = array(
				'permission_group_id' => $result['permission_group_id'],
				'name'       => $result['name'],
				'sort_order' => $result['sort_order'],
				'status'     => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('user/permission_group/edit', 'user_token=' . $this->session->data['user_token'] . '&permission_group_id=' . $result['permission_group_id'] . $url)
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

		$data['sort_name'] = $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url);
		$data['sort_sort_order'] = $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . '&sort=sort_order' . $url);
		$data['sort_status'] = $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . '&sort=status' . $url);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['pagination'] = $this->load->controller('common/pagination', array(
			'total' => $permission_group_total,
			'page'  => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'url'   => $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		));

		$data['results'] = sprintf($this->language->get('text_pagination'), ($permission_group_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($permission_group_total - $this->config->get('config_limit_admin'))) ? $permission_group_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $permission_group_total, ceil($permission_group_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/permission_group_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['permission_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
			'href' => $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		if (!isset($this->request->get['permission_group_id'])) {
			$data['action'] = $this->url->link('user/permission_group/add', 'user_token=' . $this->session->data['user_token'] . $url);
		} else {
			$data['action'] = $this->url->link('user/permission_group/edit', 'user_token=' . $this->session->data['user_token'] . '&permission_group_id=' . $this->request->get['permission_group_id'] . $url);
		}

		$data['cancel'] = $this->url->link('user/permission_group', 'user_token=' . $this->session->data['user_token'] . $url);

		if (isset($this->request->get['permission_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$permission_group_info = $this->model_user_permission_group->getPermissionGroup($this->request->get['permission_group_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($permission_group_info)) {
			$data['name'] = $permission_group_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($permission_group_info)) {
			$data['sort_order'] = $permission_group_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($permission_group_info)) {
			$data['status'] = $permission_group_info['status'];
		} else {
			$data['status'] = '1';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/permission_group_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/permission_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 128)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'user/permission_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('user/permission');

		foreach ($this->request->post['selected'] as $permission_group_id) {
			$permission_total = $this->model_user_permission->getTotalPermissionsByPermissionGroupId($permission_group_id);

			if ($permission_total) {
				$this->error['warning'] = sprintf($this->language->get('error_permission_used'), $permission_total);
			}
		}

		return !$this->error;
	}
	
}