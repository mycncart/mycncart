<?php
class ModelPaymentWxPay extends Model {
	public function getMethod($address, $total) {
		$this->load->language('payment/wxpay');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('pp_standard_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('wxpay_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('wxpay_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}
		
		//判断是否移動端
		$this->load->helper('mobile');
		if (is_weixin()) {
			$status = true;
		}else{
			$status = false;
		}
		
		

		$currencies = array(
			'CNY',
		);

		if (!in_array(strtoupper($this->currency->getCode()), $currencies)) {
			$status = false;
		}
		
		

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'wxpay',
				'title'      => $this->language->get('text_title'),
				'terms'      => '',
				'sort_order' => $this->config->get('wxpay_sort_order')
			);
		}

		return $method_data;
	}
}