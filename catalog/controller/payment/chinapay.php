<?php
class ControllerPaymentChinaPay extends Controller {
	public function index() {
		$this->language->load('payment/chinapay');

		$data['text_testmode'] = $this->language->get('text_testmode');		

		$data['button_confirm'] = $this->language->get('button_confirm');

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$total = $order_info['total'];
	
		$data['remark2'] = '[url:=' . HTTP_SERVER . 'index.php?route=payment/chinapay/callback]';
		$data['v_mid'] = trim($this->config->get('chinapay_id'));
		$data['key'] = trim($this->config->get('chinapay_key'));
		$data['v_oid'] = trim($this->session->data['order_id']);
		$data['v_amount'] = round($total,2);
		$data['v_moneytype'] = "CNY";
		$data['v_url'] = HTTP_SERVER . 'index.php?route=payment/chinapay/callback';
		$data['text'] = $data['v_amount'].$data['v_moneytype'].$data['v_oid'].$data['v_mid'].$data['v_url'].$data['key']; 
		$data['v_md5info'] = strtoupper(md5($data['text']));
		$data['remark1'] = $order_info['order_id'];


		 
		 
		$data['cancel_return'] = $this->url->link('checkout/checkout', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/chinapay.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/payment/chinapay.tpl', $data);
			} else {
				return $this->load->view('default/template/payment/chinapay.tpl', $data);
			}
		

	}
					
	public function callback() {		

		$this->load->model('checkout/order');
		
		$order_status_id = $this->config->get('config_order_status_id');
		
		$order_id  = trim($_POST['v_oid']);
		
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		
		
    $v_oid     =trim($_POST['v_oid']);     
    $v_pmode   =trim($_POST['v_pmode']);  
    $v_pstatus =trim($_POST['v_pstatus']);  
    $v_pstring =trim($_POST['v_pstring']);  
    $v_amount  =trim($_POST['v_amount']);     
    $v_moneytype  =trim($_POST['v_moneytype']); 
    $remark1   =trim($_POST['remark1' ]);   
    $remark2   =trim($_POST['remark2' ]);    
    $v_md5str  =trim($_POST['v_md5str' ]);   
    $key = trim($this->config->get('chinapay_key'));
    $pending = 1;
    $failed = 10;
                           
    $md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));
    if ($v_md5str==$md5string)
    {
      if($v_pstatus=="20")
      {
        // Success page redirect
        $this->model_checkout_order->addOrderHistory($order_id, $pending);
        $this->response->redirect($this->url->link('checkout/success'));
        }else {
         // Failure
         $this->model_checkout_order->addOrderHistory($order_id, $failed);
         $this->response->redirect($this->url->link('checkout/failure'));
              }
     }
	}
}
?>