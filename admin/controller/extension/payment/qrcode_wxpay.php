<?php 
class ControllerExtensionPaymentQrcodeWxPay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('extension/payment/qrcode_wxpay');

		$this->document->settitle($this->language->get('heading_title'));
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/qrcode_wxpay', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/qrcode_wxpay', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('qrcode_wxpay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_qrcode_wxpay_mchid'] = $this->language->get('entry_qrcode_wxpay_mchid');
		$data['entry_qrcode_wxpay_appid'] = $this->language->get('entry_qrcode_wxpay_appid');
		$data['entry_qrcode_wxpay_key'] = $this->language->get('entry_qrcode_wxpay_key');
		$data['entry_qrcode_wxpay_appsecret'] = $this->language->get('entry_qrcode_wxpay_appsecret');
			
		$data['entry_qrcode_wxpay_status'] = $this->language->get('entry_qrcode_wxpay_status');
		$data['entry_qrcode_wxpay_sort_order'] = $this->language->get('entry_qrcode_wxpay_sort_order');
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
			$data['error_qrcode_wxpay_mchid'] = $this->error['mchid'];
		} else {
			$data['error_qrcode_wxpay_mchid'] = '';
		}
		
		if (isset($this->error['appid'])) {
			$data['error_qrcode_wxpay_appid'] = $this->error['appid'];
		} else {
			$data['error_qrcode_wxpay_appid'] = '';
		}
		
		if (isset($this->error['key'])) {
			$data['error_qrcode_wxpay_key'] = $this->error['key'];
		} else {
			$data['error_qrcode_wxpay_key'] = '';
		}
		
		if (isset($this->error['appsecret'])) {
			$data['error_qrcode_wxpay_appsecret'] = $this->error['appsecret'];
		} else {
			$data['error_qrcode_wxpay_appsecret'] = '';
		}


		
		if (isset($this->request->post['qrcode_wxpay_mchid'])) {
			$data['qrcode_wxpay_mchid'] = $this->request->post['qrcode_wxpay_mchid'];
		} else {
			$data['qrcode_wxpay_mchid'] = $this->config->get('qrcode_wxpay_mchid');
		}

		if (isset($this->request->post['qrcode_wxpay_appid'])) {
			$data['qrcode_wxpay_appid'] = $this->request->post['qrcode_wxpay_appid'];
		} else {
			$data['qrcode_wxpay_appid'] = $this->config->get('qrcode_wxpay_appid');
		}

		if (isset($this->request->post['qrcode_wxpay_key'])) {
			$data['qrcode_wxpay_key'] = $this->request->post['qrcode_wxpay_key'];
		} else {
			$data['qrcode_wxpay_key'] = $this->config->get('qrcode_wxpay_key');
		}
		
		if (isset($this->request->post['qrcode_wxpay_appsecret'])) {
			$data['qrcode_wxpay_appsecret'] = $this->request->post['qrcode_wxpay_appsecret'];
		} else {
			$data['qrcode_wxpay_appsecret'] = $this->config->get('qrcode_wxpay_appsecret');
		}		
		
		if (isset($this->request->post['qrcode_wxpay_total'])) {
			$data['qrcode_wxpay_total'] = $this->request->post['qrcode_wxpay_total'];
		} else {
			$data['qrcode_wxpay_total'] = $this->config->get('qrcode_wxpay_total');
		}
		
		if (isset($this->request->post['qrcode_wxpay_log'])) {
			$data['qrcode_wxpay_log'] = $this->request->post['qrcode_wxpay_log'];
		} else {
			$data['qrcode_wxpay_log'] = $this->config->get('qrcode_wxpay_log');
		}

		if (isset($this->request->post['qrcode_wxpay_trade_success_status_id'])) {
			$data['qrcode_wxpay_trade_success_status_id'] = $this->request->post['qrcode_wxpay_trade_success_status_id'];
		} elseif($this->config->get('qrcode_wxpay_trade_success_status_id')) {
			$data['qrcode_wxpay_trade_success_status_id'] = $this->config->get('qrcode_wxpay_trade_success_status_id'); 
		} else {
			$data['qrcode_wxpay_trade_success_status_id'] = 5;//complete
		}
		
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			
		if (isset($this->request->post['qrcode_wxpay_geo_zone_id'])) {
			$data['qrcode_wxpay_geo_zone_id'] = $this->request->post['qrcode_wxpay_geo_zone_id'];
		} else {
			$data['qrcode_wxpay_geo_zone_id'] = $this->config->get('qrcode_wxpay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['qrcode_wxpay_status'])) {
			$data['qrcode_wxpay_status'] = $this->request->post['qrcode_wxpay_status'];
		} else {
			$data['qrcode_wxpay_status'] = $this->config->get('qrcode_wxpay_status');
		}
		
		if (isset($this->request->post['qrcode_wxpay_sort_order'])) {
			$data['qrcode_wxpay_sort_order'] = $this->request->post['qrcode_wxpay_sort_order'];
		} else {
			$data['qrcode_wxpay_sort_order'] = $this->config->get('qrcode_wxpay_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/qrcode_wxpay', $data));
		
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/qrcode_wxpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['qrcode_wxpay_mchid']) {
			$this->error['mchid'] = $this->language->get('error_qrcode_wxpay_mchid');
		}

		if (!$this->request->post['qrcode_wxpay_appid']) {
			$this->error['appid'] = $this->language->get('error_qrcode_wxpay_appid');
		}

		if (!$this->request->post['qrcode_wxpay_key']) {
			$this->error['key'] = $this->language->get('error_qrcode_wxpay_key');
		}
		
		if (!$this->request->post['qrcode_wxpay_appsecret']) {
			$this->error['qrcode_wxpay_appsecret'] = $this->language->get('error_qrcode_wxpay_appsecret');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}