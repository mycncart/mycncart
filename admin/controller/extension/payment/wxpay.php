<?php 
class ControllerExtensionPaymentWxPay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('extension/payment/wxpay');

		$this->document->settitle($this->language->get('heading_title'));
		
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
			'href' => $this->url->link('extension/payment/wxpay', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/wxpay', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('payment_wxpay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

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


		
		if (isset($this->request->post['payment_wxpay_mchid'])) {
			$data['payment_wxpay_mchid'] = $this->request->post['payment_wxpay_mchid'];
		} else {
			$data['payment_wxpay_mchid'] = $this->config->get('payment_wxpay_mchid');
		}

		if (isset($this->request->post['payment_wxpay_appid'])) {
			$data['payment_wxpay_appid'] = $this->request->post['payment_wxpay_appid'];
		} else {
			$data['payment_wxpay_appid'] = $this->config->get('payment_wxpay_appid');
		}

		if (isset($this->request->post['payment_wxpay_key'])) {
			$data['payment_wxpay_key'] = $this->request->post['payment_wxpay_key'];
		} else {
			$data['payment_wxpay_key'] = $this->config->get('payment_wxpay_key');
		}
		
		if (isset($this->request->post['payment_wxpay_appsecret'])) {
			$data['payment_wxpay_appsecret'] = $this->request->post['payment_wxpay_appsecret'];
		} else {
			$data['payment_wxpay_appsecret'] = $this->config->get('payment_wxpay_appsecret');
		}		
		
		if (isset($this->request->post['payment_wxpay_total'])) {
			$data['payment_wxpay_total'] = $this->request->post['payment_wxpay_total'];
		} else {
			$data['payment_wxpay_total'] = $this->config->get('payment_wxpay_total');
		}
		
		if (isset($this->request->post['payment_wxpay_log'])) {
			$data['payment_wxpay_log'] = $this->request->post['payment_wxpay_log'];
		} else {
			$data['payment_wxpay_log'] = $this->config->get('payment_wxpay_log');
		}

		if (isset($this->request->post['payment_wxpay_trade_success_status_id'])) {
			$data['payment_wxpay_trade_success_status_id'] = $this->request->post['payment_wxpay_trade_success_status_id'];
		} elseif($this->config->get('payment_wxpay_trade_success_status_id')) {
			$data['payment_wxpay_trade_success_status_id'] = $this->config->get('payment_wxpay_trade_success_status_id'); 
		} else {
			$data['payment_wxpay_trade_success_status_id'] = 5;//complete
		}
		
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			
		if (isset($this->request->post['payment_wxpay_geo_zone_id'])) {
			$data['payment_wxpay_geo_zone_id'] = $this->request->post['payment_wxpay_geo_zone_id'];
		} else {
			$data['payment_wxpay_geo_zone_id'] = $this->config->get('payment_wxpay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payment_wxpay_status'])) {
			$data['payment_wxpay_status'] = $this->request->post['payment_wxpay_status'];
		} else {
			$data['payment_wxpay_status'] = $this->config->get('payment_wxpay_status');
		}
		
		if (isset($this->request->post['payment_wxpay_sort_order'])) {
			$data['payment_wxpay_sort_order'] = $this->request->post['payment_wxpay_sort_order'];
		} else {
			$data['payment_wxpay_sort_order'] = $this->config->get('payment_wxpay_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/wxpay', $data));
		
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/wxpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['payment_wxpay_mchid']) {
			$this->error['mchid'] = $this->language->get('error_wxpay_mchid');
		}

		if (!$this->request->post['payment_wxpay_appid']) {
			$this->error['appid'] = $this->language->get('error_wxpay_appid');
		}

		if (!$this->request->post['payment_wxpay_key']) {
			$this->error['key'] = $this->language->get('error_wxpay_key');
		}
		
		if (!$this->request->post['payment_wxpay_appsecret']) {
			$this->error['wxpay_appsecret'] = $this->language->get('error_wxpay_appsecret');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}