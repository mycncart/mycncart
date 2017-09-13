<?php
class ControllerExtensionSmsChuangLan extends Controller {
	public function getrandchar($len) {
		$chars = array( "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" ); 
		$charslen = count($chars) - 1; 
		shuffle($chars);   
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars[mt_rand(0, $charslen)]; 
		}  
		return $output;  
	}
	
	public function create_mobile_code() {
		
		$this->load->language('extension/sms/chuanglan');
		
		$this->load->model('account/smsmobile');
		
		$this->load->model('account/customer');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen(trim($this->request->post['telephone'])) != 11) || (!is_numeric($this->request->post['telephone']))) {
				$json['error'] = $this->language->get('error_telephone');
			}
			
			// if telephone already registered:
			if ($this->model_account_customer->getTotalCustomersByTelephone($this->request->post['telephone'])) {
				$json['error'] = $this->language->get('error_telephone_registered');
			}

			if (!isset($json['error'])) {
				
				$verify_code = $this->getrandchar(6);
				
				$this->model_account_smsmobile->deleteSmsMobile(trim($this->request->post['telephone']));
				
				$this->model_account_smsmobile->addSmsMobile(trim($this->request->post['telephone']), $verify_code);
				
				require_once(DIR_SYSTEM.'library/sms/chuanglansmsapi.php');
				
				define('SMS_ACCOUNT', $this->config->get('sms_chuanglan_account'));
				define('SMS_PASSWORD', $this->config->get('sms_chuanglan_password'));
				
				$chuanglan = new ChuanglanSmsApi();
				
				$result = $chuanglan->sendSMS(trim($this->request->post['telephone']), sprintf($this->language->get('text_content'), $verify_code));
				$result = $chuanglan->execResult($result);
				if(isset($result[1]) && $result[1]==0){
					$json['success'] = $this->language->get('text_success');
				}else{
					$json['error'] = $this->language->get('text_error').$result[1];
				}
				
			}
		}

		$this->response->setOutput(json_encode($json));
	}

}