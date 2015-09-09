<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		$this->load->language('common/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_map'] = $this->language->get('text_map');
		$data['text_activity'] = $this->language->get('text_activity');
		$data['text_recent'] = $this->language->get('text_recent');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}
		
		$data['compare_version_message'] = $this->version_check();

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['order'] = $this->load->controller('dashboard/order');
		$data['sale'] = $this->load->controller('dashboard/sale');
		$data['customer'] = $this->load->controller('dashboard/customer');
		$data['online'] = $this->load->controller('dashboard/online');
		$data['map'] = $this->load->controller('dashboard/map');
		$data['chart'] = $this->load->controller('dashboard/chart');
		$data['activity'] = $this->load->controller('dashboard/activity');
		$data['recent'] = $this->load->controller('dashboard/recent');
		$data['footer'] = $this->load->controller('common/footer');

		// Run currency update
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->refresh();
		}
			
		$this->response->setOutput($this->load->view('common/dashboard.tpl', $data));
	}
	
	private function version_check(){
		
		$this->load->language('common/dashboard');
		
		$check_version_url = 'http://www.mycncart.com/index.php?route=version/version&store_url=' . HTTP_SERVER . '&mycncart_version=' . VERSION . '&ip='.$this->request->server['REMOTE_ADDR'];
		
		$return_code = file_get_contents($check_version_url);
		
		$message = '';

      	if ($return_code == '1') {
        
	  		$message = $this->language->get('text_no_update') ;
		
	  	}elseif($return_code == '2') {
		  
		  	$message = $this->language->get('text_available_update');
			
	  	}elseif($return_code == '4'){
			$message = '无法判断您的 MyCnCart 版本！';	
		}elseif($return_code == '3') {
			$message = '';	
		}
		
		
         
		return $message;
		
	  
   }
}
