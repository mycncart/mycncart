<?php
class ControllerCheckoutQrcodeWxPaySuccess extends Controller {
	public function index() {
		$this->load->language('checkout/success');
		
		$order_id = 0;
		
		if (isset($this->session->data['order_id'])) {
			
			$this->cart->clear();
			
			$order_id = $this->session->data['order_id'];
			
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
			if(isset($this->session->data['cs_shipfrom'])) {
				unset($this->session->data['cs_shipfrom']);
			}
			
			if(isset($this->sesssion->data['personal_card'])) {
				unset($this->sesssion->data['personal_card']);
			}
			
			if(isset($this->sesssion->data['code_url'])) {
				unset($this->sesssion->data['code_url']);
			}
			

		}

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
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('checkout/success')
		);

		$data['heading_title'] = $this->language->get('heading_title');


		$data['code_url'] = $this->session->data['code_url'];

		$data['address'] = $this->url->link('account/address', '', 'SSL');


		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/qrcode_wxpay_success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/qrcode_wxpay_success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/qrcode_wxpay_success.tpl', $data));
		}
	}
	
	
	

	
}
