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

				$post_data = array();
				$post_data['account'] = $this->config->get('chuanglan_account');
				$post_data['pswd'] = $this->config->get('chuanglan_password');
				$post_data['mobile'] = trim($this->request->post['telephone']);
				$post_data['msg'] = sprintf($this->language->get('text_content'), $verify_code);
				$post_data['needstatus'] = 'true';
				
				$url = 'http://222.73.117.156/msg/HttpBatchSendSM';

				$o = "";
				foreach ($post_data as $k=>$v) {
				   $o.= "$k=".urlencode($v)."&";
				}
				
				$post_data=substr($o,0,-1);
				
				$result = $this->sms_post($post_data, $url);
				
				if ($result == 0) {
					$json['success'] = $this->language->get('text_success');
				} else {
					$json['error'] = $this->language->get('text_error');
				}
			}
		}

		$this->response->setOutput(json_encode($json));
	}
	
	public function sms_post($curlPost,$url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
		$result = curl_exec($curl);
		curl_close($curl);
		
		$return_str = explode(',', $result);
		
		return $return_str[1];
	}
	
}