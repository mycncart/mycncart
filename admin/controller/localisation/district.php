<?php
class ControllerLocalisationDistrict extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('localisation/district');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/district');

		$this->getList();
	}

	public function add() {
		$this->load->language('localisation/district');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/district');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_district->addDistrict($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/district');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/district');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_district->editDistrict($this->request->get['district_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/district');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/district');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $district_id) {
				$this->model_localisation_district->deleteDistrict($district_id);
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

			$this->response->redirect($this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'c.name';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('localisation/district/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('localisation/district/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['districts'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$district_total = $this->model_localisation_district->getTotalDistricts();

		$results = $this->model_localisation_district->getDistricts($filter_data);

		foreach ($results as $result) {
			$data['districts'][] = array(
				'district_id' => $result['district_id'],
				'country' => $result['country'],
				'zone' 	  => $result['zone'],
				'city' 	  => $result['city'],
				'name'    => $result['name'] . (($result['district_id'] == $this->config->get('config_district_id')) ? $this->language->get('text_default') : null),
				'edit'    => $this->url->link('localisation/district/edit', 'token=' . $this->session->data['token'] . '&district_id=' . $result['district_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_country'] = $this->language->get('column_country');
		$data['column_zone'] = $this->language->get('column_zone');
		$data['column_city'] = $this->language->get('column_city');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		$data['sort_country'] = $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . '&sort=c.name' . $url, true);
		$data['sort_name'] = $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . '&sort=d.name' . $url, true);
		$data['sort_zone'] = $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . '&sort=z.name' . $url, true);
		$data['sort_city'] = $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . '&sort=ct.name' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $district_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($district_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($district_total - $this->config->get('config_limit_admin'))) ? $district_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $district_total, ceil($district_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/district_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['district_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_select'] = $this->language->get('text_select');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url, true)
		);
		
		$data['token'] = $this->session->data['token'];

		if (!isset($this->request->get['district_id'])) {
			$data['action'] = $this->url->link('localisation/district/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('localisation/district/edit', 'token=' . $this->session->data['token'] . '&district_id=' . $this->request->get['district_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('localisation/district', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['district_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$district_info = $this->model_localisation_district->getDistrict($this->request->get['district_id']);
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($district_info)) {
			$data['status'] = $district_info['status'];
		} else {
			$data['status'] = '1';
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($district_info)) {
			$data['name'] = $district_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($district_info)) {
			$data['country_id'] = $district_info['country_id'];
		} else {
			$data['country_id'] = 44;
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($district_info)) {
			$data['zone_id'] = $district_info['zone_id'];
		} else {
			$data['zone_id'] = '';
		}
		
		if (isset($this->request->post['city_id'])) {
			$data['city_id'] = $this->request->post['city_id'];
		} elseif (!empty($district_info)) {
			$data['city_id'] = $district_info['city_id'];
		} else {
			$data['city_id'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/district_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/district')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/district')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('setting/store');
		$this->load->model('customer/customer');
		$this->load->model('marketing/affiliate');
		$this->load->model('localisation/geo_zone');
		
		
		foreach ($this->request->post['selected'] as $city_id) {
			if ($this->config->get('config_district_id') == $district_id) {
				$this->error['warning'] = $this->language->get('error_default');
			}
			
			$store_total = $this->model_setting_store->getTotalStoresByDistrictId($district_id);

			if ($store_total) {
				$this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
			}

			$address_total = $this->model_customer_customer->getTotalAddressesByDistrictId($district_id);

			if ($address_total) {
				$this->error['warning'] = sprintf($this->language->get('error_address'), $address_total);
			}

			$affiliate_total = $this->model_marketing_affiliate->getTotalAffiliatesByDistrictId($district_id);

			if ($affiliate_total) {
				$this->error['warning'] = sprintf($this->language->get('error_affiliate'), $affiliate_total);
			}

			$district_to_geo_zone_total = $this->model_localisation_geo_zone->getTotalDistrictToGeoZoneByDistrictId($district_id);

			if ($district_to_geo_zone_total) {
				$this->error['warning'] = sprintf($this->language->get('error_district_to_geo_zone'), $district_to_geo_zone_total);
			}
		}

		return !$this->error;
	}
}