<?php
class ControllerCommonMobileFooter extends Controller {
	public function index() {
		$this->load->language('common/mobile_footer');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'language=' . $this->config->get('config_language') . '&information_id=' . $result['information_id'])
				);
			}
		}

		$data['contact'] = $this->url->link('information/contact', 'language=' . $this->config->get('config_language'));
		$data['return'] = $this->url->link('account/return/add', 'language=' . $this->config->get('config_language'));

		if ($this->config->get('config_gdpr_id')) {
			$data['gdpr'] = $this->url->link('information/gdpr', 'language=' . $this->config->get('config_language'));
		} else {
			$data['gdpr'] = '';
		}

		$data['sitemap'] = $this->url->link('information/sitemap', 'language=' . $this->config->get('config_language'));
		$data['tracking'] = $this->url->link('information/tracking', 'language=' . $this->config->get('config_language'));
		$data['manufacturer'] = $this->url->link('product/manufacturer', 'language=' . $this->config->get('config_language'));
		$data['voucher'] = $this->url->link('account/voucher', 'language=' . $this->config->get('config_language'));
		$data['affiliate'] = $this->url->link('affiliate/login', 'language=' . $this->config->get('config_language'));
		$data['special'] = $this->url->link('product/special', 'language=' . $this->config->get('config_language'));
		$data['account'] = $this->url->link('account/account', 'language=' . $this->config->get('config_language'));
		$data['order'] = $this->url->link('account/order', 'language=' . $this->config->get('config_language'));
		$data['wishlist'] = $this->url->link('account/wishlist', 'language=' . $this->config->get('config_language'));
		$data['newsletter'] = $this->url->link('account/newsletter', 'language=' . $this->config->get('config_language'));

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['HTTP_X_REAL_IP'])) {
				$ip = $this->request->server['HTTP_X_REAL_IP'];
			} else if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = ($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		//Census visitors
		$this->load->model('catalog/visitor');

		$ip = getIp();

		$visitor['ip'] = $ip;

		$visitor['country'] = getLocation($ip);
			
		$visitor['browser'] = getBrowser($ip);

		$visitor['referer'] = getFromPage();

		$visitor['current_page'] = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

		$visitor['visit_time'] = date("Y-m-d H:i:s");

		$visitor['start_time'] = time();

		if (isset($this->request->get['product_id'])) {
			$visitor['product_id'] = $this->request->get['product_id'];
		} else {
			$visitor['product_id'] = 0;
		}
			
		$visitor['visit_token'] = token(32);

		$data['visit_token'] = $visitor['visit_token'];

		$visitor['store_id'] = $this->config->get('config_store_id');

		$this->model_catalog_visitor->addVisitor($visitor);

		$data['scripts'] = $this->document->getScripts('mobile_footer');

		return $this->load->view('common/mobile_footer', $data);
	}
}
