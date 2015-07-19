<?php

class EBaTongRealTime {

	var $ebatong_config;

	function __construct($ebatong_config){
		$this->ebatong_config = $ebatong_config;
	}


	function getRealTime(){                     
        $ask_for_time_stamp_gateway = $this->ebatong_config['ask_for_time_stamp_gateway'];
        $service                    = "query_timestamp";
        $partner                    = $this->ebatong_config['appid'];
		$key                    	= trim($this->ebatong_config['appkey']);
        $sign_type                  = "MD5";
		$input_charset 				= $this->ebatong_config['input_charset'];
        
        //对所有参数进行排列
        $params = array("service"=>$service,"partner"=>$partner,"input_charset"=>$input_charset,"sign_type"=>$sign_type);
        $paramKey = array_keys($params);
        sort($paramKey);
        $md5src = "";
        $i = 0;
        $paramStr="";
        foreach($paramKey as $arraykey){
            if($i == 0){
                $paramStr .= $arraykey."=".$params[$arraykey];
            }
            else{
                $paramStr .= "&".$arraykey."=".$params[$arraykey];
            }
            $i++;
        }
        $md5src .= $paramStr.$key;  
        $sign = md5($md5src);        
        $paramStr .= "&sign=".$sign;  
         
        $url=$ask_for_time_stamp_gateway."?".$paramStr;             
        $doc = new DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
        return $encrypt_key;
    }
		

}
?>