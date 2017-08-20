<?php 
class ControllerExtensionPaymentAlipayDirect extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('extension/payment/alipay_direct');

		$this->document->settitle($this->language->get('heading_title'));
		
		if (isset($this->error['secrity_code'])) {
			$data['error_secrity_code'] = $this->error['secrity_code'];
		} else {
			$data['error_secrity_code'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['partner'])) {
			$data['error_partner'] = $this->error['partner'];
		} else {
			$data['error_partner'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/alipay_direct', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/alipay_direct', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('payment_alipay_direct', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['seller_email'])) {
			$data['error_alipay_direct_seller_email'] = $this->error['seller_email'];
		} else {
			$data['error_alipay_direct_seller_email'] = '';
		}
		
		if (isset($this->error['security_code'])) {
			$data['error_alipay_direct_security_code'] = $this->error['security_code'];
		} else {
			$data['error_alipay_direct_security_code'] = '';
		}
		
		if (isset($this->error['partner'])) {
			$data['error_alipay_direct_partner'] = $this->error['partner'];
		} else {
			$data['error_alipay_direct_partner'] = '';
		}


		
		if (isset($this->request->post['payment_alipay_direct_seller_email'])) {
			$data['payment_alipay_direct_seller_email'] = $this->request->post['payment_alipay_direct_seller_email'];
		} else {
			$data['payment_alipay_direct_seller_email'] = $this->config->get('payment_alipay_direct_seller_email');
		}

		if (isset($this->request->post['payment_alipay_direct_security_code'])) {
			$data['payment_alipay_direct_security_code'] = $this->request->post['payment_alipay_direct_security_code'];
		} else {
			$data['payment_alipay_direct_security_code'] = $this->config->get('payment_alipay_direct_security_code');
		}

		if (isset($this->request->post['payment_alipay_direct_partner'])) {
			$data['payment_alipay_direct_partner'] = $this->request->post['payment_alipay_direct_partner'];
		} else {
			$data['payment_alipay_direct_partner'] = $this->config->get('payment_alipay_direct_partner');
		}		
		
		if (isset($this->request->post['payment_alipay_direct_total'])) {
			$data['payment_alipay_direct_total'] = $this->request->post['payment_alipay_direct_total'];
		} else {
			$data['payment_alipay_direct_total'] = $this->config->get('payment_alipay_direct_total');
		}
		
		if (isset($this->request->post['payment_alipay_direct_log'])) {
			$data['payment_alipay_direct_log'] = $this->request->post['payment_alipay_direct_log'];
		} else {
			$data['payment_alipay_direct_log'] = $this->config->get('payment_alipay_direct_log');
		}

		if (isset($this->request->post['payment_alipay_direct_trade_success_status_id'])) {
			$data['payment_alipay_direct_trade_success_status_id'] = $this->request->post['payment_alipay_direct_trade_success_status_id'];
		} elseif($this->config->get('payment_alipay_direct_trade_success_status_id')) {
			$data['payment_alipay_direct_trade_success_status_id'] = $this->config->get('payment_alipay_direct_trade_success_status_id'); 
		} else {
			$data['payment_alipay_direct_trade_success_status_id'] = 5;//complete
		}
		
		
		if (isset($this->request->post['payment_alipay_direct_trade_finished_status_id'])) {
			$data['payment_alipay_direct_trade_finished_status_id'] = $this->request->post['payment_alipay_direct_trade_finished_status_id'];
		} elseif($this->config->get('payment_alipay_direct_trade_finished_status_id')) {
			$data['payment_alipay_direct_trade_finished_status_id'] = $this->config->get('payment_alipay_direct_trade_finished_status_id'); 
		} else {
			$data['payment_alipay_direct_trade_finished_status_id'] = 5;//complete
		}

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			
		if (isset($this->request->post['payment_alipay_direct_geo_zone_id'])) {
			$data['payment_alipay_direct_geo_zone_id'] = $this->request->post['payment_alipay_direct_geo_zone_id'];
		} else {
			$data['payment_alipay_direct_geo_zone_id'] = $this->config->get('payment_alipay_direct_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payment_alipay_direct_status'])) {
			$data['payment_alipay_direct_status'] = $this->request->post['payment_alipay_direct_status'];
		} else {
			$data['payment_alipay_direct_status'] = $this->config->get('payment_alipay_direct_status');
		}
		
		if (isset($this->request->post['payment_alipay_direct_sort_order'])) {
			$data['payment_alipay_direct_sort_order'] = $this->request->post['payment_alipay_direct_sort_order'];
		} else {
			$data['payment_alipay_direct_sort_order'] = $this->config->get('payment_alipay_direct_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/alipay_direct', $data));
		
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/alipay_direct')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['payment_alipay_direct_seller_email']) {
			$this->error['seller_email'] = $this->language->get('error_alipay_direct_seller_email');
		}

		if (!$this->request->post['payment_alipay_direct_security_code']) {
			$this->error['security_code'] = $this->language->get('error_alipay_direct_security_code');
		}

		if (!$this->request->post['payment_alipay_direct_partner']) {
			$this->error['partner'] = $this->language->get('error_alipay_direct_partner');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}