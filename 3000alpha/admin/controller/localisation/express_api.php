<?php
class ControllerLocalisationExpressAPI extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('localisation/express_api');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express_api');

		$this->getList();
	}

	public function add() {
		$this->load->language('localisation/express_api');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express_api');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_express_api->addExpressAPI($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/express_api');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express_api');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_express_api->editExpressAPI($this->request->get['express_api_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/express_api');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/express_api');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $express_api_id) {
				$this->model_localisation_express_api->deleteExpressAPI($express_api_id);
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

			$this->response->redirect($this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url, true));
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('localisation/express_api/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('localisation/express_api/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['express_apis'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$express_api_total = $this->model_localisation_express_api->getTotalExpressAPIs();

		$results = $this->model_localisation_express_api->getExpressAPIs($filter_data);

		foreach ($results as $result) {
			$data['express_apis'][] = array(
				'express_api_id' 	=> $result['express_api_id'],
				'name'       		=> $result['name'],
				'status'     		=> $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       		=> $this->url->link('localisation/express_api/edit', 'user_token=' . $this->session->data['user_token'] . '&express_api_id=' . $result['express_api_id'] . $url, true)
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

		$data['sort_name'] = $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url, true);
		$data['sort_code'] = $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . '&sort=code' . $url, true);
		$data['sort_iso_code_3'] = $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . '&sort=iso_code_3' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $express_api_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($express_api_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($express_api_total - $this->config->get('config_limit_admin'))) ? $express_api_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $express_api_total, ceil($express_api_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/express_api_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['express_api_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['express_api_id'])) {
			$data['action'] = $this->url->link('localisation/express_api/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('localisation/express_api/edit', 'user_token=' . $this->session->data['user_token'] . '&express_api_id=' . $this->request->get['express_api_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('localisation/express_api', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['express_api_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$express_api_info = $this->model_localisation_express_api->getExpressAPI($this->request->get['express_api_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($express_api_info)) {
			$data['name'] = $express_api_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['api_key'])) {
			$data['api_key'] = $this->request->post['api_key'];
		} elseif (!empty($express_api_info)) {
			$data['api_key'] = $express_api_info['api_key'];
		} else {
			$data['api_key'] = '';
		}
		
		if (isset($this->request->post['api_username'])) {
			$data['api_username'] = $this->request->post['api_username'];
		} elseif (!empty($express_api_info)) {
			$data['api_username'] = $express_api_info['api_username'];
		} else {
			$data['api_username'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($express_api_info)) {
			$data['status'] = $express_api_info['status'];
		} else {
			$data['status'] = '1';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/express_api_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/express_api')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 128)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/express_api')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
}