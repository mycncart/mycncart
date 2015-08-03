<?php
class ControllerPaymentchinapay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/chinapay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting($this->payment_module_name, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['entry_id'] = $this->language->get('entry_id');
		$data['entry_key'] = $this->language->get("entry_key");
	
		$data['entry_total'] = $this->language->get('entry_total');	
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['id'])) {
			$data['error_id'] = $this->error['id'];
		} else {
			$data['error_id'] = '';
		}
		
		if (isset($this->error['key'])) {
			$data['error_key'] = $this->error['key'];
		} else {
			$data['error_key'] = '';
		}

	

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/chinapay', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['action'] = $this->url->link('payment/chinapay', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['chinapay_id'])) {
			$data['chinapay_id'] = $this->request->post['chinapay_id'];
		} else {
			$data['chinapay_id'] = $this->config->get('chinapay_id');
		}

		if (isset($this->request->post['chinapay_key'])) {
			$data['chinapay_key'] = $this->request->post['chinapay_key'];
		} else {
			$data['chinapay_key'] = $this->config->get('chinapay_key');
		}

	


		if (isset($this->request->post['chinapay_total'])) {
			$data['chinapay_total'] = $this->request->post['chinapay_total'];
		} else {
			$data['chinapay_total'] = $this->config->get('chinapay_total'); 
		} 

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['chinapay_geo_zone_id'])) {
			$data['chinapay_geo_zone_id'] = $this->request->post['chinapay_geo_zone_id'];
		} else {
			$data['chinapay_geo_zone_id'] = $this->config->get('chinapay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['chinapay_status'])) {
			$data['chinapay_status'] = $this->request->post['chinapay_status'];
		} else {
			$data['chinapay_status'] = $this->config->get('chinapay_status');
		}

		if (isset($this->request->post['chinapay_sort_order'])) {
			$data['chinapay_sort_order'] = $this->request->post['chinapay_sort_order'];
		} else {
			$data['chinapay_sort_order'] = $this->config->get('chinapay_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/chinapay.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/chinapay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['chinapay_id']) {
			$this->error['id'] = $this->language->get('error_id');
		}

		if (!$this->request->post['chinapay_key']) {
			$this->error['key'] = $this->language->get('error_key');
		}
		


		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
