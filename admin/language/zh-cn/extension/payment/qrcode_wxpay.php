<?php
// Heading
$_['heading_title']      				= '微信扫码支付';

// Text 
$_['text_mchid'] 						= '商户号';
$_['text_appid'] 						= '公众账号APPID或者应用APPID';
$_['text_key'] 							= 'API密钥';
$_['text_appsecret'] 					= 'AppSecret';


$_['text_payment']       				= '支付方式';
$_['text_qrcode_wxpay']						= '<img src="view/image/payment/qrcode_wxpay.png" alt="微信扫码支付" title="微信公众号支付" style="border: 1px solid #EEEEEE;" />';
$_['text_success']       				= '成功: 已修改微信扫码支付！';
$_['text_edit']          				= '编辑微信扫码支付';

// Entry
$_['entry_qrcode_wxpay_mchid'] 				= '商户号';
$_['entry_qrcode_wxpay_appid'] 				= '公众账号APPID或者应用APPID';
$_['entry_qrcode_wxpay_key'] 					= 'API密钥';
$_['entry_qrcode_wxpay_appsecret'] 			= 'AppSecret';
$_['entry_qrcode_wxpay_status'] 		    	= '状态';
$_['entry_qrcode_wxpay_sort_order']   			= '排序';
$_['entry_total']					 	= '最低金额';

$_['entry_trade_success_status']       	= '交易成功';

$_['entry_geo_zone']				 	= '区域群组';
$_['entry_log']		 					= '调试日志';

// Help
$_['help_mchid']		    			= '这里填开户邮件中的商户号';
$_['help_appid']		    			= '这里填开户邮件中的（公众账号APPID或者应用APPID）';
$_['help_key']		    				= '这里请使用商户平台登录账户和密码登录http://pay.weixin.qq.com 平台设置的“API密钥”，为了安全，请设置为32字符串';
$_['help_appsecret']		    		= '该参数在JSAPI支付（open平台账户不能进行JSAPI支付）的时候需要用来获取用户openid，可使用APPID对应的公众平台登录http://mp.weixin.qq.com 的开发者中心获取AppSecret';
$_['help_total']					 	= '为使该支付方式生效，订单所需达到的最低金额';
$_['help_log']			 				= '如果出现异常，通过日志记录相关过程，便于分析处理。';
$_['help_trade_success']			 	= '当交易成功时，订单要置为的状态';



// Tab
$_['tab_general']					 	= '常规';
$_['tab_order_status']       		 	= '订单状态';

// Error
$_['error_permission']   				= '警告: 无权修改微信扫码支付接口！';
$_['error_qrcode_wxpay_mchid']      			= '请填写商户号！'; 
$_['error_qrcode_wxpay_appid']     			= '请填写公众账号APPID或者应用APPID！'; 
$_['error_qrcode_wxpay_key']        			= '请填写API密钥！'; 
$_['error_qrcode_wxpay_appsecret']    			= '请填写AppSecret！'; 