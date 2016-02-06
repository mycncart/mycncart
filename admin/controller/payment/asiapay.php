<?php
class ControllerPaymentAsiaPay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/asiapay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('asiapay', $this->request->post);

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
		$data['text_authorization'] = $this->language->get('text_authorization');
		$data['text_sale'] = $this->language->get('text_sale');

		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_transaction'] = $this->language->get('entry_transaction');
		$data['entry_debug'] = $this->language->get('entry_debug');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_canceled_reversal_status'] = $this->language->get('entry_canceled_reversal_status');
		$data['entry_completed_status'] = $this->language->get('entry_completed_status');
		$data['entry_denied_status'] = $this->language->get('entry_denied_status');
		$data['entry_expired_status'] = $this->language->get('entry_expired_status');
		$data['entry_failed_status'] = $this->language->get('entry_failed_status');
		$data['entry_pending_status'] = $this->language->get('entry_pending_status');
		$data['entry_processed_status'] = $this->language->get('entry_processed_status');
		$data['entry_refunded_status'] = $this->language->get('entry_refunded_status');
		$data['entry_reversed_status'] = $this->language->get('entry_reversed_status');
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

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
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
			'href' => $this->url->link('payment/asiapay', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/asiapay', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['asiapay_email'])) {
			$data['asiapay_email'] = $this->request->post['asiapay_email'];
		} else {
			$data['asiapay_email'] = $this->config->get('asiapay_email');
		}

		if (isset($this->request->post['asiapay_test'])) {
			$data['asiapay_test'] = $this->request->post['asiapay_test'];
		} else {
			$data['asiapay_test'] = $this->config->get('asiapay_test');
		}

		if (isset($this->request->post['asiapay_transaction'])) {
			$data['asiapay_transaction'] = $this->request->post['asiapay_transaction'];
		} else {
			$data['asiapay_transaction'] = $this->config->get('asiapay_transaction');
		}

		if (isset($this->request->post['asiapay_debug'])) {
			$data['asiapay_debug'] = $this->request->post['asiapay_debug'];
		} else {
			$data['asiapay_debug'] = $this->config->get('asiapay_debug');
		}

		if (isset($this->request->post['asiapay_total'])) {
			$data['asiapay_total'] = $this->request->post['asiapay_total'];
		} else {
			$data['asiapay_total'] = $this->config->get('asiapay_total');
		}

		if (isset($this->request->post['asiapay_canceled_reversal_status_id'])) {
			$data['asiapay_canceled_reversal_status_id'] = $this->request->post['asiapay_canceled_reversal_status_id'];
		} else {
			$data['asiapay_canceled_reversal_status_id'] = $this->config->get('asiapay_canceled_reversal_status_id');
		}

		if (isset($this->request->post['asiapay_completed_status_id'])) {
			$data['asiapay_completed_status_id'] = $this->request->post['asiapay_completed_status_id'];
		} else {
			$data['asiapay_completed_status_id'] = $this->config->get('asiapay_completed_status_id');
		}

		if (isset($this->request->post['asiapay_denied_status_id'])) {
			$data['asiapay_denied_status_id'] = $this->request->post['asiapay_denied_status_id'];
		} else {
			$data['asiapay_denied_status_id'] = $this->config->get('asiapay_denied_status_id');
		}

		if (isset($this->request->post['asiapay_expired_status_id'])) {
			$data['asiapay_expired_status_id'] = $this->request->post['asiapay_expired_status_id'];
		} else {
			$data['asiapay_expired_status_id'] = $this->config->get('asiapay_expired_status_id');
		}

		if (isset($this->request->post['asiapay_failed_status_id'])) {
			$data['asiapay_failed_status_id'] = $this->request->post['asiapay_failed_status_id'];
		} else {
			$data['asiapay_failed_status_id'] = $this->config->get('asiapay_failed_status_id');
		}

		if (isset($this->request->post['asiapay_pending_status_id'])) {
			$data['asiapay_pending_status_id'] = $this->request->post['asiapay_pending_status_id'];
		} else {
			$data['asiapay_pending_status_id'] = $this->config->get('asiapay_pending_status_id');
		}

		if (isset($this->request->post['asiapay_processed_status_id'])) {
			$data['asiapay_processed_status_id'] = $this->request->post['asiapay_processed_status_id'];
		} else {
			$data['asiapay_processed_status_id'] = $this->config->get('asiapay_processed_status_id');
		}

		if (isset($this->request->post['asiapay_refunded_status_id'])) {
			$data['asiapay_refunded_status_id'] = $this->request->post['asiapay_refunded_status_id'];
		} else {
			$data['asiapay_refunded_status_id'] = $this->config->get('asiapay_refunded_status_id');
		}

		if (isset($this->request->post['asiapay_reversed_status_id'])) {
			$data['asiapay_reversed_status_id'] = $this->request->post['asiapay_reversed_status_id'];
		} else {
			$data['asiapay_reversed_status_id'] = $this->config->get('asiapay_reversed_status_id');
		}

		if (isset($this->request->post['asiapay_voided_status_id'])) {
			$data['asiapay_voided_status_id'] = $this->request->post['asiapay_voided_status_id'];
		} else {
			$data['asiapay_voided_status_id'] = $this->config->get('asiapay_voided_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['asiapay_geo_zone_id'])) {
			$data['asiapay_geo_zone_id'] = $this->request->post['asiapay_geo_zone_id'];
		} else {
			$data['asiapay_geo_zone_id'] = $this->config->get('asiapay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['asiapay_status'])) {
			$data['asiapay_status'] = $this->request->post['asiapay_status'];
		} else {
			$data['asiapay_status'] = $this->config->get('asiapay_status');
		}

		if (isset($this->request->post['asiapay_sort_order'])) {
			$data['asiapay_sort_order'] = $this->request->post['asiapay_sort_order'];
		} else {
			$data['asiapay_sort_order'] = $this->config->get('asiapay_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/asiapay.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/asiapay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['asiapay_email']) {
			$this->error['email'] = $this->language->get('error_email');
		}

		return !$this->error;
	}
}