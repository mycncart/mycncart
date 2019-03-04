<?php
class ControllerApplicationInterface extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('application/interface');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('application/interface');

		$this->getList();
	}

	public function add() {
		$this->load->language('application/interface');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('application/interface');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_application_interface->addInterface($this->request->post);

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

			$this->response->redirect($this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('application/interface');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('application/interface');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_application_interface->editInterface($this->request->get['interface_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('application/interface');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('application/interface');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $interface_id) {
				$this->model_application_interface->deleteInterface($interface_id);
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

			$this->response->redirect($this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'type';
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('application/interface/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('application/interface/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['interfaces'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$application_total = $this->model_application_interface->getTotalInterfaces();

		$results = $this->model_application_interface->getInterfaces($filter_data);

		foreach ($results as $result) {
			$data['interfaces'][] = array(
				'interface_id'        => $result['interface_id'],
				'type'      	=> $result['type'],
				'username'      => $result['username'],
				'status'        => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'edit'          => $this->url->link('application/interface/edit', 'user_token=' . $this->session->data['user_token'] . '&interface_id=' . $result['interface_id'] . $url, true)
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

		$data['sort_type'] = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . '&sort=type' . $url, true);
		$data['sort_username'] = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . '&sort=username' . $url, true);
		$data['sort_status'] = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . '&sort=status' . $url, true);
		$data['sort_date_added'] = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . '&sort=date_added' . $url, true);
		$data['sort_date_modified'] = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . '&sort=date_modified' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $application_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($application_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($application_total - $this->config->get('config_limit_admin'))) ? $application_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $application_total, ceil($application_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('application/interface_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['interface_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_ip'] = sprintf($this->language->get('text_ip'), $this->request->server['REMOTE_ADDR']);
		
		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['type'])) {
			$data['error_type'] = $this->error['type'];
		} else {
			$data['error_type'] = '';
		}

		if (isset($this->error['username'])) {
			$data['error_username'] = $this->error['username'];
		} else {
			$data['error_username'] = '';
		}

		if (isset($this->error['secret'])) {
			$data['error_secret'] = $this->error['secret'];
		} else {
			$data['error_secret'] = '';
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['interface_id'])) {
			$data['action'] = $this->url->link('application/interface/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('application/interface/edit', 'user_token=' . $this->session->data['user_token'] . '&interface_id=' . $this->request->get['interface_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('application/interface', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['interface_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$interface_info = $this->model_application_interface->getInterface($this->request->get['interface_id']);
		}

		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($interface_info)) {
			$data['type'] = $interface_info['type'];
		} else {
			$data['type'] = '';
		}

		if (isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} elseif (!empty($interface_info)) {
			$data['username'] = $interface_info['username'];
		} else {
			$data['username'] = '';
		}

		if (isset($this->request->post['secret'])) {
			$data['secret'] = $this->request->post['secret'];
		} elseif (!empty($interface_info)) {
			$data['secret'] = $interface_info['secret'];
		} else {
			$data['secret'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($interface_info)) {
			$data['status'] = $interface_info['status'];
		} else {
			$data['status'] = 0;
		}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('application/interface_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'application/interface')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->request->post['type'] == "") {
			$this->error['type'] = $this->language->get('error_type');
		}

		if ((utf8_strlen(trim($this->request->post['username'])) < 4) || (utf8_strlen(trim($this->request->post['username'])) > 64)) {
			$this->error['username'] = $this->language->get('error_username');
		}

		if ((utf8_strlen($this->request->post['secret']) < 64) || (utf8_strlen($this->request->post['secret']) > 256)) {
			$this->error['secret'] = $this->language->get('error_secret');
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->application->hasPermission('modify', 'application/interface')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
}
