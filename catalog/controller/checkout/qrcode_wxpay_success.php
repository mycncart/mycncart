<?php
class ControllerCheckoutQrcodeWxPaySuccess extends Controller {
	public function index() {
		$this->load->language('checkout/qrcode_wxpay_success');
		
		$order_id = $this->session->data['order_id'];
		
		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('checkout/checkout', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('checkout/success')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->session->data['code_url'])) {
			$data['code_url'] = $this->session->data['code_url'];
		} else {
			$data['redirect'] = $this->url->link('checkout/checkout');
		}
		
		$data['order_id'] = $order_id;
		$data['ajax_check_order_status'] = $this->url->link('checkout/qrcode_wxpay_success/check', '', true);
		
		$data['success'] = $this->url->link('checkout/success', '', true);

		$data['address'] = $this->url->link('account/address', '', true);


		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/qrcode_wxpay_success', $data));
		
	}

	public function check() {
		$json = array();
		
		$this->load->language('checkout/success');

		if ($this->request->get['order_id']) {
			
			$order_id = $this->request->get['order_id'];
			
			$this->load->model('account/order');
			$order_info = $this->model_account_order->getWxQrcodeUnpaidOrder($order_id);
			
			if ($order_info) {
				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
}
