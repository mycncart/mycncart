<?php
class ChuanglanSmsApi {

	const API_SEND_URL='https://sms.253.com/msg/send';

	const API_BALANCE_QUERY_URL='http://sms.253.com/msg/balance';

	const API_ACCOUNT=SMS_ACCOUNT;

	const API_PASSWORD=SMS_PASSWORD;

	public function sendSMS( $mobile, $msg, $needstatus = 1) {
		
		$postArr = array (
				          'un' => self::API_ACCOUNT,
				          'pw' => self::API_PASSWORD,
				          'msg' => $msg,
				          'phone' => $mobile,
				          'rd' => $needstatus
                     );
		
		$result = $this->curlPost( self::API_SEND_URL , $postArr);
		return $result;
	}
	
	public function queryBalance() {
		
		$postArr = array ( 
		          'un' => self::API_ACCOUNT,
		          'pw' => self::API_PASSWORD,
		);
		$result = $this->curlPost(self::API_BALANCE_QUERY_URL, $postArr);
		return $result;
	}

	public function execResult($result){
		$result=preg_split("/[,\r\n]/",$result);
		return $result;
	}

	private function curlPost($url,$postFields){
		$postFields = http_build_query($postFields);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $postFields );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		return $result;
	}
	
	public function __get($name){
		return $this->$name;
	}
	
	public function __set($name,$value){
		$this->$name=$value;
	}
}
