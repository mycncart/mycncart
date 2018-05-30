<?php
class ControllerLocalisationZone extends Controller {
	private $error = array();
	private $parent_zones = array();

	public function index() {
		$this->load->language('localisation/zone');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/zone');

		$this->getList();
	}

	public function add() {
		$this->load->language('localisation/zone');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/zone');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_zone->addZone($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['parent_id'])) {
				$url .= '&parent_id=' . $this->request->get['parent_id'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/zone');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/zone');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_zone->editZone($this->request->get['zone_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['parent_id'])) {
				$url .= '&parent_id=' . $this->request->get['parent_id'];
			}
			
			if (isset($this->request->get['parent_id'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/zone');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/zone');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $zone_id) {
				$this->model_localisation_zone->deleteZone($zone_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['parent_id'])) {
				$url .= '&parent_id=' . $this->request->get['parent_id'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getList();
	}

	protected function getList() {
		
		if (isset($this->request->get['parent_id'])) {
			$parent_id = $this->request->get['parent_id'];
		} else {
			$parent_id = 0;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'zone_id';
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
			'href' => $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('localisation/zone/add', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $parent_id . $url);
		$data['delete'] = $this->url->link('localisation/zone/delete', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $parent_id . $url);

		$data['zones'] = array();

		$filter_data = array(
			'parent_id'  => $parent_id,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$zone_total = $this->model_localisation_zone->getTotalZones($filter_data);

		$results = $this->model_localisation_zone->getZones($filter_data);

		foreach ($results as $result) {
			$data['zones'][] = array(
				'zone_id' => $result['zone_id'],
				'name'    => $result['name'] . (($result['zone_id'] == $this->config->get('config_zone_id')) ? $this->language->get('text_default') : null),
				'level'    => $result['level'],
				'parent_id'    => $result['parent_id'],
				'edit'    => $this->url->link('localisation/zone/edit', 'user_token=' . $this->session->data['user_token'] . '&zone_id=' . $result['zone_id'] . '&parent_id=' . $result['parent_id'] . $url),
				'add_subzone'    => $this->url->link('localisation/zone/add', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $result['zone_id'] . $url),
				'subzone'    => $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $result['zone_id'] . $url)
			);
		}
		
		$data['back_top'] = $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url);
		
		//获取上级循环级的资料
		$list = $this->getParentZones($parent_id);
		
		$data['parent_zones'] = array_reverse($list);
		
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

		$data['sort_name'] = $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . '&sort=z.name' . $url);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $zone_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($zone_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($zone_total - $this->config->get('config_limit_admin'))) ? $zone_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $zone_total, ceil($zone_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/zone_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['zone_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
			'href' => $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		
		if (isset($this->request->get['zone_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$zone_info = $this->model_localisation_zone->getZone($this->request->get['zone_id']);
		}
		
		if (isset($this->request->get['parent_id'])) {
			$parent_zone_info = $this->model_localisation_zone->getZone($this->request->get['parent_id']);
		}
		
		//设定所处上一级参数
		if (isset($this->request->get['parent_id'])) {
			$data['parent_id'] = (int)$this->request->get['parent_id'];
			$parent_id = (int)$this->request->get['parent_id'];
		} else {
			$data['parent_id'] = 0;
			$parent_id = 0;
		}
		
		//设定所在层级参数
		if ($parent_id == 0) {
			$data['level'] = 1;
		} elseif (!empty($parent_zone_info)) {
			$data['level'] = $parent_zone_info['level'] + 1;
		} else {
			$data['level'] = 1;
		}
		
		//设定上一级的信息展示
		if ($parent_zone_info) {
			$data['text_current_parent'] = sprintf($this->language->get('text_current_parent_zone'), $parent_zone_info['name']);;
		} else {
			$data['text_current_parent'] = $this->language->get('text_current_parent_zone_id_top');
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($zone_info)) {
			$data['name'] = $zone_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (!isset($this->request->get['zone_id'])) {
			$data['action'] = $this->url->link('localisation/zone/add', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $parent_id . $url);
		} else {
			$data['action'] = $this->url->link('localisation/zone/edit', 'user_token=' . $this->session->data['user_token'] . '&zone_id=' . $this->request->get['zone_id'] . '&parent_id=' . $parent_id  . $url);
		}

		$data['cancel'] = $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $parent_id . $url);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/zone_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/zone')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/zone')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		/*
		$this->load->model('setting/store');
		$this->load->model('customer/customer');
		$this->load->model('localisation/geo_zone');

		foreach ($this->request->post['selected'] as $zone_id) {
			if ($this->config->get('config_zone_id') == $zone_id) {
				$this->error['warning'] = $this->language->get('error_default');
			}

			$store_total = $this->model_setting_store->getTotalStoresByZoneId($zone_id);

			if ($store_total) {
				$this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
			}

			$address_total = $this->model_customer_customer->getTotalAddressesByZoneId($zone_id);

			if ($address_total) {
				$this->error['warning'] = sprintf($this->language->get('error_address'), $address_total);
			}

			$zone_to_geo_zone_total = $this->model_localisation_geo_zone->getTotalZoneToGeoZoneByZoneId($zone_id);

			if ($zone_to_geo_zone_total) {
				$this->error['warning'] = sprintf($this->language->get('error_zone_to_geo_zone'), $zone_to_geo_zone_total);
			}
		}
		*/

		return !$this->error;
	}
	
	public function getParentZones($zone_id) {
		
		$zone_info = $this->model_localisation_zone->getZone($zone_id);
		
		if ($zone_info) {
			$this->parent_zones[] = array(
				'zone_id' => $zone_info['zone_id'],
				'href' => $this->url->link('localisation/zone', 'user_token=' . $this->session->data['user_token'] . '&parent_id=' . $zone_info['zone_id']),
				'name' => $zone_info['name'],
			);
			$this->getParentZones($zone_info['parent_id']);
		}

		return $this->parent_zones;
	}
	
}