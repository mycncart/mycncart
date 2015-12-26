<?php
class ControllerPaymentEBaTong extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/ebatong');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ebatong', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['entry_appid'] = $this->language->get('entry_appid');
		$data['entry_appkey'] = $this->language->get('entry_appkey');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_debug'] = $this->language->get('entry_debug');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_completed_status'] = $this->language->get('entry_completed_status');
		$data['entry_voided_status'] = $this->language->get('entry_voided_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_test'] = $this->language->get('help_test');
		$data['help_debug'] = $this->language->get('help_debug');
		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_order_status'] = $this->language->get('tab_order_status');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['appid'])) {
			$data['error_appid'] = $this->error['appid'];
		} else {
			$data['error_appid'] = '';
		}
		
		if (isset($this->error['appkey'])) {
			$data['error_appkey'] = $this->error['appkey'];
		} else {
			$data['error_appkey'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/ebatong', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/ebatong', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ebatong_appid'])) {
			$data['ebatong_appid'] = $this->request->post['ebatong_appid'];
		} else {
			$data['ebatong_appid'] = $this->config->get('ebatong_appid');
		}
		
		if (isset($this->request->post['ebatong_appkey'])) {
			$data['ebatong_appkey'] = $this->request->post['ebatong_appkey'];
		} else {
			$data['ebatong_appkey'] = $this->config->get('ebatong_appkey');
		}
		
		if (isset($this->request->post['ebatong_test'])) {
			$data['ebatong_test'] = $this->request->post['ebatong_test'];
		} else {
			$data['ebatong_test'] = $this->config->get('ebatong_test');
		}

		if (isset($this->request->post['ebatong_debug'])) {
			$data['ebatong_debug'] = $this->request->post['ebatong_debug'];
		} else {
			$data['ebatong_debug'] = $this->config->get('ebatong_debug');
		}

		if (isset($this->request->post['ebatong_total'])) {
			$data['ebatong_total'] = $this->request->post['ebatong_total'];
		} else {
			$data['ebatong_total'] = $this->config->get('ebatong_total');
		}

		if (isset($this->request->post['ebatong_completed_status_id'])) {
			$data['ebatong_completed_status_id'] = $this->request->post['ebatong_completed_status_id'];
		} else {
			$data['ebatong_completed_status_id'] = $this->config->get('ebatong_completed_status_id');
		}

		if (isset($this->request->post['ebatong_voided_status_id'])) {
			$data['ebatong_voided_status_id'] = $this->request->post['ebatong_voided_status_id'];
		} else {
			$data['ebatong_voided_status_id'] = $this->config->get('ebatong_voided_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['ebatong_geo_zone_id'])) {
			$data['ebatong_geo_zone_id'] = $this->request->post['ebatong_geo_zone_id'];
		} else {
			$data['ebatong_geo_zone_id'] = $this->config->get('ebatong_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['ebatong_status'])) {
			$data['ebatong_status'] = $this->request->post['ebatong_status'];
		} else {
			$data['ebatong_status'] = $this->config->get('ebatong_status');
		}

		if (isset($this->request->post['ebatong_sort_order'])) {
			$data['ebatong_sort_order'] = $this->request->post['ebatong_sort_order'];
		} else {
			$data['ebatong_sort_order'] = $this->config->get('ebatong_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/ebatong.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/ebatong')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['ebatong_appid']) {
			$this->error['appid'] = $this->language->get('error_appid');
		}
		
		if (!$this->request->post['ebatong_appkey']) {
			$this->error['appkey'] = $this->language->get('error_appkey');
		}

		return !$this->error;
	}
}