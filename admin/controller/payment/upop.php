<?php 
class ControllerPaymentUpop extends Controller {
	private $error = array(); 
	
	public function index() {
		
		if($this->config->get('upop_pay_name') == ''){
			
			$this->language->load('payment/upop');
		
			$this->config->set('upop_pay_name',$this->language->get('default_pay_name'));
			
			$this->config->set('upop_pay_desc',$this->language->get('default_pay_desc'));
			
			$this->config->set('upop_business_name',$this->language->get('default_upop_business_name'));
			
			$this->config->set('upop_environment_type',$this->language->get('default_upop_environment_type'));
			
			$this->config->set('upop_test_business_account',$this->language->get('default_upop_test_business_account'));
			
			$this->config->set('upop_test_business_key',$this->language->get('default_upop_test_business_key'));
			
		}
		
		
		$this->language->load('payment/upop');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('upop', $this->request->post);				
			
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
		$data['text_successful'] = $this->language->get('text_successful');
		$data['text_declined'] = $this->language->get('text_declined');
		$data['text_off'] = $this->language->get('text_off');
		
	
		$data['entry_pay_name'] = $this->language->get('entry_pay_name');
		$data['entry_pay_desc'] = $this->language->get('entry_pay_desc');
	
		$data['entry_business_name'] = $this->language->get('entry_business_name');
		
		
		$data['entry_environment_type'] = $this->language->get('entry_environment_type');

		
		$data['entry_test_business_account'] = $this->language->get('entry_test_business_account');
		$data['entry_test_business_key'] = $this->language->get('entry_test_business_key');
		$data['entry_pm_business_account'] = $this->language->get('entry_pm_business_account');
		$data['entry_pm_business_key'] = $this->language->get('entry_pm_business_key');
		$data['entry_production_business_account'] = $this->language->get('entry_production_business_account');
		$data['entry_production_business_key'] = $this->language->get('entry_production_business_key');
		
		$data['entry_total'] = $this->language->get('entry_total');	
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_order_status'] = $this->language->get('tab_order_status');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		
	
 		if (isset($this->error['upop_pay_name'])) {
			$data['error_upop_pay_name'] = $this->error['upop_pay_name'];
		} else {
			$data['error_upop_pay_name'] = '';
		}
		
	

 		if (isset($this->error['upop_business_name'])) {
			$data['error_upop_business_name'] = $this->error['upop_business_name'];
		} else {
			$data['error_upop_business_name'] = '';
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
			'href'      => $this->url->link('payment/upop', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('payment/upop', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		
	
		if (isset($this->request->post['upop_pay_name'])) {
			$data['upop_pay_name'] = $this->request->post['upop_pay_name'];
		} else {
			$data['upop_pay_name'] = $this->config->get('upop_pay_name');
		}
		
	
		if (isset($this->request->post['upop_pay_desc'])) {
			$data['upop_pay_desc'] = $this->request->post['upop_pay_desc'];
		} else {
			$data['upop_pay_desc'] = $this->config->get('upop_pay_desc');
		}
		
		$data['callback'] = HTTP_CATALOG . 'index.php?route=payment/upop/callback';


		if (isset($this->request->post['upop_business_name'])) {
			$data['upop_business_name'] = $this->request->post['upop_business_name'];
		} else {
			$data['upop_business_name'] = $this->config->get('upop_business_name');
		}
	
		$data['array_upop_environment_type'][] = array(
			'title'  => '开发联调环境',
			'value' => '0'
		);
		$data['array_upop_environment_type'][] = array(
			'title'  => 'PM环境(预上线)',
			'value' => '1'
		);
		$data['array_upop_environment_type'][] = array(
			'title'  => '生产环境',
			'value' => '2'
		);
		if (isset($this->request->post['upop_environment_type'])) {
			$data['upop_environment_type'] = $this->request->post['upop_environment_type'];
		} else {
			$data['upop_environment_type'] = $this->config->get('upop_environment_type');
		}
		
		
        if (isset($this->request->post['upop_test_business_account'])) {
			$data['upop_test_business_account'] = $this->request->post['upop_test_business_account'];
		} else {
			$data['upop_test_business_account'] = $this->config->get('upop_test_business_account');
		}
		
		if (isset($this->request->post['upop_test_business_key'])) {
			$data['upop_test_business_key'] = $this->request->post['upop_test_business_key'];
		} else {
			$data['upop_test_business_key'] = $this->config->get('upop_test_business_key');
		}
        
        if (isset($this->request->post['upop_pm_business_account'])) {
			$data['upop_pm_business_account'] = $this->request->post['upop_pm_business_account'];
		} else {
			$data['upop_pm_business_account'] = $this->config->get('upop_pm_business_account');
		}
        
        
         if (isset($this->request->post['upop_pm_business_key'])) {
			$data['upop_pm_business_key'] = $this->request->post['upop_pm_business_key'];
		} else {
			$data['upop_pm_business_key'] = $this->config->get('upop_pm_business_key');
		}
        
         if (isset($this->request->post['upop_production_business_account'])) {
			$data['upop_production_business_account'] = $this->request->post['upop_production_business_account'];
		} else {
			$data['upop_production_business_account'] = $this->config->get('upop_production_business_account');
		}
        
        if (isset($this->request->post['upop_production_business_key'])) {
			$data['upop_production_business_key'] = $this->request->post['upop_production_business_key'];
		} else {
			$data['upop_production_business_key'] = $this->config->get('upop_production_business_key');
		}
        
				
		if (isset($this->request->post['upop_order_status_id'])) {
			$data['upop_order_status_id'] = $this->request->post['upop_order_status_id'];
		} else {
			$data['upop_order_status_id'] = $this->config->get('upop_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['upop_geo_zone_id'])) {
			$data['upop_geo_zone_id'] = $this->request->post['upop_geo_zone_id'];
		} else {
			$data['upop_geo_zone_id'] = $this->config->get('upop_geo_zone_id'); 
		} 

		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['upop_status'])) {
			$data['upop_status'] = $this->request->post['upop_status'];
		} else {
			$data['upop_status'] = $this->config->get('upop_status');
		}
		
		if (isset($this->request->post['upop_sort_order'])) {
			$data['upop_sort_order'] = $this->request->post['upop_sort_order'];
		} else {
			$data['upop_sort_order'] = $this->config->get('upop_sort_order');
		}

		$this->template = 'payment/upop.tpl';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');		
		$this->response->setOutput($this->load->view('payment/upop.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/upop')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['upop_pay_name']) {
			$this->error['upop_pay_name'] = $this->language->get('error_upop_pay_name');
		}
		
		if (!$this->request->post['upop_business_name']) {
			$this->error['upop_business_name'] = $this->language->get('error_upop_business_name');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>