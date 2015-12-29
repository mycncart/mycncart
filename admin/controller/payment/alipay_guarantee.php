<?php 
class ControllerPaymentAlipayGuarantee extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/alipay_guarantee');

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
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/alipay_guarantee', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/alipay_guarantee', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('alipay_guarantee', $this->request->post);				
			
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
		
		$data['entry_alipay_guarantee_seller_email'] = $this->language->get('entry_alipay_guarantee_seller_email');
		$data['entry_alipay_guarantee_security_code'] = $this->language->get('entry_alipay_guarantee_security_code');
		$data['entry_alipay_guarantee_partner'] = $this->language->get('entry_alipay_guarantee_partner');
		$data['entry_alipay_guarantee_trade_type'] = $this->language->get('entry_alipay_guarantee_trade_type');
			
		$data['entry_alipay_guarantee_status'] = $this->language->get('entry_alipay_guarantee_status');
		$data['entry_alipay_guarantee_sort_order'] = $this->language->get('entry_alipay_guarantee_sort_order');
		$data['entry_total'] = $this->language->get('entry_total');
		
		$data['entry_wait_buyer_pay_status'] = $this->language->get('entry_wait_buyer_pay_status');
		$data['entry_wait_seller_send_goods_status'] = $this->language->get('entry_wait_seller_send_goods_status');
		$data['entry_wait_buyer_confirm_goods_status'] = $this->language->get('entry_wait_buyer_confirm_goods_status');
		$data['entry_trade_finished_status'] = $this->language->get('entry_trade_finished_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		
		
		$data['help_seller_email'] = $this->language->get('help_seller_email');
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
		
 		if (isset($this->error['seller_email'])) {
			$data['error_alipay_guarantee_seller_email'] = $this->error['seller_email'];
		} else {
			$data['error_alipay_guarantee_seller_email'] = '';
		}
		
		if (isset($this->error['security_code'])) {
			$data['error_alipay_guarantee_security_code'] = $this->error['security_code'];
		} else {
			$data['error_alipay_guarantee_security_code'] = '';
		}
		
		if (isset($this->error['partner'])) {
			$data['error_alipay_guarantee_partner'] = $this->error['partner'];
		} else {
			$data['error_alipay_guarantee_partner'] = '';
		}


		
		if (isset($this->request->post['alipay_guarantee_seller_email'])) {
			$data['alipay_guarantee_seller_email'] = $this->request->post['alipay_guarantee_seller_email'];
		} else {
			$data['alipay_guarantee_seller_email'] = $this->config->get('alipay_guarantee_seller_email');
		}

		if (isset($this->request->post['alipay_guarantee_security_code'])) {
			$data['alipay_guarantee_security_code'] = $this->request->post['alipay_guarantee_security_code'];
		} else {
			$data['alipay_guarantee_security_code'] = $this->config->get('alipay_guarantee_security_code');
		}

		if (isset($this->request->post['alipay_guarantee_partner'])) {
			$data['alipay_guarantee_partner'] = $this->request->post['alipay_guarantee_partner'];
		} else {
			$data['alipay_guarantee_partner'] = $this->config->get('alipay_guarantee_partner');
		}		
		
		if (isset($this->request->post['alipay_guarantee_total'])) {
			$data['alipay_guarantee_total'] = $this->request->post['alipay_guarantee_total'];
		} else {
			$data['alipay_guarantee_total'] = $this->config->get('alipay_guarantee_total');
		}

		if (isset($this->request->post['alipay_guarantee_wait_buyer_pay_status_id'])) {
			$data['alipay_guarantee_wait_buyer_pay_status_id'] = $this->request->post['alipay_guarantee_wait_buyer_pay_status_id'];
		} elseif($this->config->get('alipay_guarantee_wait_buyer_pay_status_id')) {
			$data['alipay_guarantee_wait_buyer_pay_status_id'] = $this->config->get('alipay_guarantee_wait_buyer_pay_status_id'); 
		} else {
			$data['alipay_guarantee_wait_buyer_pay_status_id'] = 16;//voided
		}
		
		if (isset($this->request->post['alipay_guarantee_wait_seller_send_goods_status_id'])) {
			$data['alipay_guarantee_wait_seller_send_goods_status_id'] = $this->request->post['alipay_guarantee_wait_seller_send_goods_status_id'];
		} elseif($this->config->get('alipay_guarantee_wait_seller_send_goods_status_id')) {
			$data['alipay_guarantee_wait_seller_send_goods_status_id'] = $this->config->get('alipay_guarantee_wait_seller_send_goods_status_id'); 
		} else {
			$data['alipay_guarantee_wait_seller_send_goods_status_id'] = 1;//pending
		}
		
		if (isset($this->request->post['alipay_guarantee_wait_buyer_confirm_goods_status_id'])) {
			$data['alipay_guarantee_wait_buyer_confirm_goods_status_id'] = $this->request->post['alipay_guarantee_wait_buyer_confirm_goods_status_id'];
		} elseif($this->config->get('alipay_guarantee_wait_buyer_confirm_goods_status_id')) {
			$data['alipay_guarantee_wait_buyer_confirm_goods_status_id'] = $this->config->get('alipay_guarantee_wait_buyer_confirm_goods_status_id'); 
		} else {
			$data['alipay_guarantee_wait_buyer_confirm_goods_status_id'] = 3;//shipped
		}
		
		if (isset($this->request->post['alipay_guarantee_trade_finished_status_id'])) {
			$data['alipay_guarantee_trade_finished_status_id'] = $this->request->post['alipay_guarantee_trade_finished_status_id'];
		} elseif($this->config->get('alipay_guarantee_trade_finished_status_id')) {
			$data['alipay_guarantee_trade_finished_status_id'] = $this->config->get('alipay_guarantee_trade_finished_status_id'); 
		} else {
			$data['alipay_guarantee_trade_finished_status_id'] = 5;//complete
		}

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			
		if (isset($this->request->post['alipay_guarantee_geo_zone_id'])) {
			$data['alipay_guarantee_geo_zone_id'] = $this->request->post['alipay_guarantee_geo_zone_id'];
		} else {
			$data['alipay_guarantee_geo_zone_id'] = $this->config->get('alipay_guarantee_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['alipay_guarantee_status'])) {
			$data['alipay_guarantee_status'] = $this->request->post['alipay_guarantee_status'];
		} else {
			$data['alipay_guarantee_status'] = $this->config->get('alipay_guarantee_status');
		}
		
		if (isset($this->request->post['alipay_guarantee_sort_order'])) {
			$data['alipay_guarantee_sort_order'] = $this->request->post['alipay_guarantee_sort_order'];
		} else {
			$data['alipay_guarantee_sort_order'] = $this->config->get('alipay_guarantee_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/alipay_guarantee.tpl', $data));
		
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/alipay_guarantee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['alipay_guarantee_seller_email']) {
			$this->error['seller_email'] = $this->language->get('error_alipay_guarantee_seller_email');
		}

		if (!$this->request->post['alipay_guarantee_security_code']) {
			$this->error['security_code'] = $this->language->get('error_alipay_guarantee_security_code');
		}

		if (!$this->request->post['alipay_guarantee_partner']) {
			$this->error['partner'] = $this->language->get('error_alipay_guarantee_partner');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>