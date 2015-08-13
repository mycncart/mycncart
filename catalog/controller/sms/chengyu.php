<?php
class ControllerSmsChengyu extends Controller {
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
		
		$this->load->language('sms/chengyu');
		
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
				$post_data['userid'] = $this->config->get('chengyu_userid');
				$post_data['account'] = $this->config->get('chengyu_account');
				$post_data['password'] = $this->config->get('chengyu_password');
				//$post_data['content'] = urlencode(sprintf($this->language->get('text_content'), $verify_code));
				$post_data['content'] = sprintf($this->language->get('text_content'), $verify_code);
				
				$post_data['mobile'] = trim($this->request->post['telephone']);
				$post_data['sendtime'] = '';
				$url='http://113.11.210.114:5888/sms.aspx?action=send';
				$o='';
				foreach ($post_data as $k=>$v)
				{
				   $o.="$k=".urlencode($v).'&';
				}
				$post_data=substr($o,0,-1);
				
				$result = $this->xml_to_array($this->sms_post($post_data, $url));
				
				$json['success'] = $this->language->get('text_success');
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
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
	}
	
	public function xml_to_array($xml){
		$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
		if(preg_match_all($reg, $xml, $matches)){
			$count = count($matches[0]);
			for($i = 0; $i < $count; $i++){
			$subxml= $matches[2][$i];
			$key = $matches[1][$i];
				if(preg_match( $reg, $subxml )){
					$arr[$key] = $this->xml_to_array( $subxml );
				}else{
					$arr[$key] = $subxml;
				}
			}
		}
		return $arr;
	}
}