<?php
require_once(DIR_APPLICATION."controller/payment/WxPayPubHelper/WxPayPubHelper.php");
require_once(DIR_APPLICATION."controller/payment/WxPayPubHelper/WxPay.pub.config.php");

class ControllerPaymentWeipay extends Controller {
	public function index() {
		
    $data['button_confirm'] = $this->language->get('button_confirm');

		$data['return'] = HTTPS_SERVER . 'index.php?route=checkout/success';
		
		$this->load->model('checkout/order');

		$order_id = $this->session->data['order_id'];

		$order_info = $this->model_checkout_order->getOrder($order_id);

		$currency_code ='CNY';
		$item_name = $this->config->get('config_title');  //待确认mwb
		
		$total = $order_info['total'];  

		$currency_value = $this->currency->getValue($currency_code);
		$amount = $total * $currency_value;
		$amount = number_format($amount,2,'.','');
		$amount = $amount * 100;  //单位换算为分

		//使用jsapi接口
		$jsApi = new JsApi_pub();
		/*
		//=========步骤1：网页授权获取用户openid============
		//通过code获得openid
		if (!isset($_GET['code']))
		{
			//触发微信返回code码
			$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL);
			Header("Location: $url"); 
		}else
		{
			//获取code码，以获取openid
		  $code = $_GET['code'];
			$jsApi->setCode($code);
			$openid = $jsApi->getOpenId();
		}
		*/
		$openid = $this->session->data['weixin_openid'];
		//=========步骤2：使用统一支付接口，获取prepay_id============
		//使用统一支付接口
		$unifiedOrder = new UnifiedOrder_pub();
		
		//设置统一支付接口参数
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//spbill_create_ip已填,商户无需重复填写
		//sign已填,商户无需重复填写
		WxPayConf_pub::$APPID = $this->config->get('weipay_appid');
		WxPayConf_pub::$MCHID = $this->config->get('weipay_mchid');
		WxPayConf_pub::$KEY = $this->config->get('weipay_key');
		WxPayConf_pub::$APPSECRET = $this->config->get('weipay_appsecret');
		$unifiedOrder->setParameter("openid","$openid");//商品描述
		$order_productname = $order_info['store_name'];
		$unifiedOrder->setParameter("body",$order_productname);//商品描述
		//自定义订单号，此处仅作举例
		//$timeStamp = time();
		//$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
		$unifiedOrder->setParameter("out_trade_no","$order_id");//商户订单号 
		$unifiedOrder->setParameter("total_fee","$amount");//总金额
		$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
		$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
		//非必填参数，商户可根据实际情况选填
		//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
		//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
		//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
		//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
		//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
		//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
		//$unifiedOrder->setParameter("openid","XXXX");//用户标识
		//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
	
		$prepay_id = $unifiedOrder->getPrepayId();
		//=========步骤3：使用jsapi调起支付============
		$jsApi->setPrepayId($prepay_id);
	
		$jsApiParameters = $jsApi->getParameters();

		$data['jsApiParameters'] = $jsApiParameters;
		$data['redirect'] = $this->url->link('checkout/success');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/weipay.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/weipay.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/weipay.tpl', $data);
		}
	}


	public function notifycallback() {

		WxPayConf_pub::$APPID = $this->config->get('weipay_appid');
		WxPayConf_pub::$MCHID = $this->config->get('weipay_mchid');
		WxPayConf_pub::$KEY = $this->config->get('weipay_key');
		WxPayConf_pub::$APPSECRET = $this->config->get('weipay_appsecret');

		//以log文件形式记录回调信息
		$log_name="weixin_notify_url.log";//log文件路径
		$log_ = new Log($log_name);
		$log_->write("【进入回调程序】:\n");

    //使用通用通知接口
		$notify = new Notify_pub();
	
		//存储微信的回调
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
		$notify->saveData($xml);
		
		//验证签名，并回应微信。
		//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		//尽可能提高通知的成功率，但微信不保证通知最终能成功。
		if($notify->checkSign() == FALSE){
			$log_->write("【签名验证失败】\n");
			$notify->setReturnParameter("return_code","FAIL");//返回状态码
			$notify->setReturnParameter("return_msg","签名失败");//返回信息
		}else{
			$log_->write("【签名验证成功】\n");
			$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
		}
		$returnXml = $notify->returnXml();
		echo $returnXml;
		
		//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
		
		$log_->write("【接收到的notify通知】:\n".$xml."\n");
	
		if($notify->checkSign() == TRUE)
		{
			if ($notify->data["return_code"] == "FAIL") {
				//此处应该更新一下订单状态，商户自行增删操作
				$log_->write("【通信出错】:\n".$xml."\n");
			}
			elseif($notify->data["result_code"] == "FAIL"){
				//此处应该更新一下订单状态，商户自行增删操作
				$log_->write("【业务出错】:\n".$xml."\n");
			}
			else{
				//此处应该更新一下订单状态，商户自行增删操作
				$log_->write("【支付成功】:\n".$xml."\n");
				
				//支付成功，进行相关处理
				$order_id = $notify->data["out_trade_no"];//获取订单id.
				$this->load->model('checkout/order');
				$order_info = $this->model_checkout_order->getOrder($order_id);
				if ($order_info) {
					$order_status_id = $order_info["order_status_id"];
					// 确定订单没有重复支付
					//if ($order_status_id != $this->config->get('weipay_order_status_id')) {
					if (!$order_status_id) {
		 				//此处需要设置订单状态为“已付款”或“待处理”，根据具体情况定
						$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('weipay_order_status_id')); 
					}else{
						$log_->write( $order_id." Order Has bean Payed.\n");
					}
				}else{
					$log_->write($order_id."Alipaywap No Order Found.\n");
				}
			}
			
			//商户自行增加处理流程,
			//例如：更新订单状态
			//例如：数据库操作
			//例如：推送支付完成信息
		}
		$log_->write("【退出回调程序】:\n");
		
	}
}