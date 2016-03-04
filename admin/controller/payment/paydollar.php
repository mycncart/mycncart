<?php
class ControllerPaymentPayDollar extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/paydollar');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('paydollar', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_authorization'] = $this->language->get('text_authorization');
		$data['text_sale'] = $this->language->get('text_sale');

		$data['entry_merchantid'] = $this->language->get('entry_merchantid');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_transaction'] = $this->language->get('entry_transaction');
		$data['entry_debug'] = $this->language->get('entry_debug');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_securehash'] = $this->language->get('entry_securehash');
		$data['entry_mpsmode'] = $this->language->get('entry_mpsmode');
		$data['entry_paymethod'] = $this->language->get('entry_paymethod');
		$data['entry_paytype'] = $this->language->get('entry_paytype');
		$data['entry_completed_status'] = $this->language->get('entry_completed_status');
		$data['entry_failed_status'] = $this->language->get('entry_failed_status');
		$data['entry_voided_status'] = $this->language->get('entry_voided_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_test'] = $this->language->get('help_test');
		$data['help_debug'] = $this->language->get('help_debug');
		$data['help_total'] = $this->language->get('help_total');
		$data['help_paymethod'] = $this->language->get('help_paymethod');
		$data['help_mpsmode'] = $this->language->get('help_mpsmode');
		$data['help_paytype'] = $this->language->get('help_paytype');
		$data['help_securehash'] = $this->language->get('help_securehash');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_order_status'] = $this->language->get('tab_order_status');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['merchantid'])) {
			$data['error_merchantid'] = $this->error['merchantid'];
		} else {
			$data['error_merchantid'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/paydollar', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('payment/paydollar', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], true);

		if (isset($this->request->post['paydollar_merchantid'])) {
			$data['paydollar_merchantid'] = $this->request->post['paydollar_merchantid'];
		} else {
			$data['paydollar_merchantid'] = $this->config->get('paydollar_merchantid');
		}
		
		if (isset($this->request->post['paydollar_securehash'])) {
			$data['paydollar_securehash'] = $this->request->post['paydollar_securehash'];
		} else {
			$data['paydollar_securehash'] = $this->config->get('paydollar_securehash');
		}

		if (isset($this->request->post['paydollar_test'])) {
			$data['paydollar_test'] = $this->request->post['paydollar_test'];
		} else {
			$data['paydollar_test'] = $this->config->get('paydollar_test');
		}

		if (isset($this->request->post['paydollar_paytype'])) {
			$data['paydollar_paytype'] = $this->request->post['paydollar_paytype'];
		} else {
			$data['paydollar_paytype'] = $this->config->get('paydollar_paytype');
		}
		
		if (isset($this->request->post['paydollar_paymethod'])) {
			$data['paydollar_paymethod'] = $this->request->post['paydollar_paymethod'];
		} else {
			$data['paydollar_paymethod'] = $this->config->get('paydollar_paymethod');
		}
		
		$data['paymethods'] = array(
			'ALL',
			'CC',
			'VISA',
			'Master',
			'JCB',
			'AMEX',
			'Diners',
			'PPS',
			'PAYPAL',
			'CHINAPAY',
			'ALIPAY',
			'TENPAY',
			'99BILL',
			'MEPS',
			'SCB',
			'BPM',
			'KTB',
			'UOB',
			'KRUNGSRIONLINE',
			'TMB',
			'IBANKING',
			'BancNet',
			'GCash',
			'SMARTMONEY'
		);	
		
		if (isset($this->request->post['paydollar_mpsmode'])) {
			$data['paydollar_mpsmode'] = $this->request->post['paydollar_mpsmode'];
		} else {
			$data['paydollar_mpsmode'] = $this->config->get('paydollar_mpsmode');
		}
		
		$data['mpsmodes'] = array(
			'NIL',
			'SCP',
			'DCC',
			'MCP'
			/*
			'NIL-没有提供,关闭MPS（没有货币转换）',
			'SCP-开启MPS简单货币转换',
			'DCC-开启MPS动态货币转换',
			'MCP-开启MPS多货币计价'
			*/
		);

		if (isset($this->request->post['paydollar_debug'])) {
			$data['paydollar_debug'] = $this->request->post['paydollar_debug'];
		} else {
			$data['paydollar_debug'] = $this->config->get('paydollar_debug');
		}

		if (isset($this->request->post['paydollar_total'])) {
			$data['paydollar_total'] = $this->request->post['paydollar_total'];
		} else {
			$data['paydollar_total'] = $this->config->get('paydollar_total');
		}

		if (isset($this->request->post['paydollar_completed_status_id'])) {
			$data['paydollar_completed_status_id'] = $this->request->post['paydollar_completed_status_id'];
		} else {
			$data['paydollar_completed_status_id'] = $this->config->get('paydollar_completed_status_id');
		}

		if (isset($this->request->post['paydollar_failed_status_id'])) {
			$data['paydollar_failed_status_id'] = $this->request->post['paydollar_failed_status_id'];
		} else {
			$data['paydollar_failed_status_id'] = $this->config->get('paydollar_failed_status_id');
		}

		if (isset($this->request->post['paydollar_voided_status_id'])) {
			$data['paydollar_voided_status_id'] = $this->request->post['paydollar_voided_status_id'];
		} else {
			$data['paydollar_voided_status_id'] = $this->config->get('paydollar_voided_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['paydollar_geo_zone_id'])) {
			$data['paydollar_geo_zone_id'] = $this->request->post['paydollar_geo_zone_id'];
		} else {
			$data['paydollar_geo_zone_id'] = $this->config->get('paydollar_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['paydollar_status'])) {
			$data['paydollar_status'] = $this->request->post['paydollar_status'];
		} else {
			$data['paydollar_status'] = $this->config->get('paydollar_status');
		}

		if (isset($this->request->post['paydollar_sort_order'])) {
			$data['paydollar_sort_order'] = $this->request->post['paydollar_sort_order'];
		} else {
			$data['paydollar_sort_order'] = $this->config->get('paydollar_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/paydollar', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/paydollar')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['paydollar_merchantid']) {
			$this->error['merchantid'] = $this->language->get('error_merchantid');
		}

		return !$this->error;
	}
}