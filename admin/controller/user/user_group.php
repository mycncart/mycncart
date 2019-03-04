<?php
class ControllerUserUserGroup extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/user_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/user_group');

		$this->getList();
	}

	public function add() {
		$this->load->language('user/user_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/user_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_user_group->addUserGroup($this->request->post);

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

			$this->response->redirect($this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('user/user_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/user_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_user_group->editUserGroup($this->request->get['user_group_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('user/user_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/user_group');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $user_group_id) {
				$this->model_user_user_group->deleteUserGroup($user_group_id);
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

			$this->response->redirect($this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url));
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
			'href' => $this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('user/user_group/add', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('user/user_group/delete', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['user_groups'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$user_group_total = $this->model_user_user_group->getTotalUserGroups();

		$results = $this->model_user_user_group->getUserGroups($filter_data);

		foreach ($results as $result) {
			$data['user_groups'][] = array(
				'user_group_id' => $result['user_group_id'],
				'name'          => $result['name'],
				'edit'          => $this->url->link('user/user_group/edit', 'user_token=' . $this->session->data['user_token'] . '&user_group_id=' . $result['user_group_id'] . $url)
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

		$data['sort_name'] = $this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['pagination'] = $this->load->controller('common/pagination', array(
			'total' => $user_group_total,
			'page'  => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'url'   => $this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		));

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_group_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($user_group_total - $this->config->get('config_limit_admin'))) ? $user_group_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $user_group_total, ceil($user_group_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/user_group_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['user_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
			'href' => $this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		if (!isset($this->request->get['user_group_id'])) {
			$data['action'] = $this->url->link('user/user_group/add', 'user_token=' . $this->session->data['user_token'] . $url);
		} else {
			$data['action'] = $this->url->link('user/user_group/edit', 'user_token=' . $this->session->data['user_token'] . '&user_group_id=' . $this->request->get['user_group_id'] . $url);
		}

		$data['cancel'] = $this->url->link('user/user_group', 'user_token=' . $this->session->data['user_token'] . $url);

		if (isset($this->request->get['user_group_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$user_group_info = $this->model_user_user_group->getUserGroup($this->request->get['user_group_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($user_group_info)) {
			$data['name'] = $user_group_info['name'];
		} else {
			$data['name'] = '';
		}

		$data['permission_groups'] = $this->model_user_user_group->getSystemPermisions();
		
		if (isset($this->request->post['permission']['access'])) {
			$data['access'] = $this->request->post['permission']['access'];
		} elseif (isset($user_group_info['permission']['access'])) {
			$data['access'] = $user_group_info['permission']['access'];
		} else {
			$data['access'] = array();
		}

		if (isset($this->request->post['permission']['modify'])) {
			$data['modify'] = $this->request->post['permission']['modify'];
		} elseif (isset($user_group_info['permission']['modify'])) {
			$data['modify'] = $user_group_info['permission']['modify'];
		} else {
			$data['modify'] = array();
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/user_group_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/user_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'user/user_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('user/user');

		foreach ($this->request->post['selected'] as $user_group_id) {
			$user_total = $this->model_user_user->getTotalUsersByGroupId($user_group_id);

			if ($user_total) {
				$this->error['warning'] = sprintf($this->language->get('error_user'), $user_total);
			}
		}

		return !$this->error;
	}
}