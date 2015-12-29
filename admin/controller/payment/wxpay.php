<?php 
class ControllerPaymentWxPay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/wxpay');

		$this->document->settitle($this->language->get('heading_title'));
		
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
			'href' => $this->url->link('payment/wxpay', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/wxpay', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('wxpay', $this->request->post);				
			
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
		
		$data['entry_wxpay_mchid'] = $this->language->get('entry_wxpay_mchid');
		$data['entry_wxpay_appid'] = $this->language->get('entry_wxpay_appid');
		$data['entry_wxpay_key'] = $this->language->get('entry_wxpay_key');
		$data['entry_wxpay_appsecret'] = $this->language->get('entry_wxpay_appsecret');
			
		$data['entry_wxpay_status'] = $this->language->get('entry_wxpay_status');
		$data['entry_wxpay_sort_order'] = $this->language->get('entry_wxpay_sort_order');
		$data['entry_total'] = $this->language->get('entry_total');
		
		$data['entry_trade_success_status'] = $this->language->get('entry_trade_success_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_log'] = $this->language->get('entry_log');
		
		
		$data['help_mchid'] = $this->language->get('help_mchid');
		$data['help_appid'] = $this->language->get('help_appid');
		$data['help_key'] = $this->language->get('help_key');
		$data['help_appsecret'] = $this->language->get('help_appsecret');
		$data['help_total'] = $this->language->get('help_total');
		$data['help_trade_success'] = $this->language->get('help_trade_success');
		$data['help_log'] = $this->language->get('help_log');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_order_status'] = $this->language->get('tab_order_status');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['mchid'])) {
			$data['error_wxpay_mchid'] = $this->error['mchid'];
		} else {
			$data['error_wxpay_mchid'] = '';
		}
		
		if (isset($this->error['appid'])) {
			$data['error_wxpay_appid'] = $this->error['appid'];
		} else {
			$data['error_wxpay_appid'] = '';
		}
		
		if (isset($this->error['key'])) {
			$data['error_wxpay_key'] = $this->error['key'];
		} else {
			$data['error_wxpay_key'] = '';
		}
		
		if (isset($this->error['appsecret'])) {
			$data['error_wxpay_appsecret'] = $this->error['appsecret'];
		} else {
			$data['error_wxpay_appsecret'] = '';
		}


		
		if (isset($this->request->post['wxpay_mchid'])) {
			$data['wxpay_mchid'] = $this->request->post['wxpay_mchid'];
		} else {
			$data['wxpay_mchid'] = $this->config->get('wxpay_mchid');
		}

		if (isset($this->request->post['wxpay_appid'])) {
			$data['wxpay_appid'] = $this->request->post['wxpay_appid'];
		} else {
			$data['wxpay_appid'] = $this->config->get('wxpay_appid');
		}

		if (isset($this->request->post['wxpay_key'])) {
			$data['wxpay_key'] = $this->request->post['wxpay_key'];
		} else {
			$data['wxpay_key'] = $this->config->get('wxpay_key');
		}
		
		if (isset($this->request->post['wxpay_appsecret'])) {
			$data['wxpay_appsecret'] = $this->request->post['wxpay_appsecret'];
		} else {
			$data['wxpay_appsecret'] = $this->config->get('wxpay_appsecret');
		}		
		
		if (isset($this->request->post['wxpay_total'])) {
			$data['wxpay_total'] = $this->request->post['wxpay_total'];
		} else {
			$data['wxpay_total'] = $this->config->get('wxpay_total');
		}
		
		if (isset($this->request->post['wxpay_log'])) {
			$data['wxpay_log'] = $this->request->post['wxpay_log'];
		} else {
			$data['wxpay_log'] = $this->config->get('wxpay_log');
		}

		if (isset($this->request->post['wxpay_trade_success_status_id'])) {
			$data['wxpay_trade_success_status_id'] = $this->request->post['wxpay_trade_success_status_id'];
		} elseif($this->config->get('wxpay_trade_success_status_id')) {
			$data['wxpay_trade_success_status_id'] = $this->config->get('wxpay_trade_success_status_id'); 
		} else {
			$data['wxpay_trade_success_status_id'] = 5;//complete
		}
		
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			
		if (isset($this->request->post['wxpay_geo_zone_id'])) {
			$data['wxpay_geo_zone_id'] = $this->request->post['wxpay_geo_zone_id'];
		} else {
			$data['wxpay_geo_zone_id'] = $this->config->get('wxpay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['wxpay_status'])) {
			$data['wxpay_status'] = $this->request->post['wxpay_status'];
		} else {
			$data['wxpay_status'] = $this->config->get('wxpay_status');
		}
		
		if (isset($this->request->post['wxpay_sort_order'])) {
			$data['wxpay_sort_order'] = $this->request->post['wxpay_sort_order'];
		} else {
			$data['wxpay_sort_order'] = $this->config->get('wxpay_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/wxpay.tpl', $data));
		
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/wxpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['wxpay_mchid']) {
			$this->error['mchid'] = $this->language->get('error_wxpay_mchid');
		}

		if (!$this->request->post['wxpay_appid']) {
			$this->error['appid'] = $this->language->get('error_wxpay_appid');
		}

		if (!$this->request->post['wxpay_key']) {
			$this->error['key'] = $this->language->get('error_wxpay_key');
		}
		
		if (!$this->request->post['wxpay_appsecret']) {
			$this->error['wxpay_appsecret'] = $this->language->get('error_wxpay_appsecret');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}