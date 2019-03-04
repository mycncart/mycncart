<?php
class ControllerStartupStartup extends Controller {
	public function index() {
		// Settings
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '0'");
		
		foreach ($query->rows as $setting) {
			if (!$setting['serialized']) {
				$this->config->set($setting['key'], $setting['value']);
			} else {
				$this->config->set($setting['key'], json_decode($setting['value'], true));
			}
		}

		// Set time zone
		if ($this->config->get('config_timezone')) {
			date_default_timezone_set($this->config->get('config_timezone'));

			// Sync PHP and DB time zones.
			$this->db->query("SET time_zone = '" . $this->db->escape(date('P')) . "'");
		}

		// Response output compression level
		if ($this->config->get('config_compression')) {
			$this->response->setCompression($this->config->get('config_compression'));
		}

		// Theme
		$this->config->set('template_cache', $this->config->get('developer_theme'));
		
		// Language
		$code = '';

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();

		$language_codes = array_column($languages, 'language_id', 'code');

		// Language Cookie
		if (isset($this->request->cookie['admin_language']) && array_key_exists($this->request->cookie['admin_language'], $language_codes)) {
			$code = $this->request->cookie['admin_language'];
		}

		// Language not available then use default
		if (!array_key_exists($code, $language_codes)) {
			$code = $this->config->get('config_admin_language');
		}

		// Set a new language cookie if the code does not match the current one
		if (!isset($this->request->cookie['admin_language']) || $this->request->cookie['admin_language'] != $code) {
			setcookie('admin_language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
		}
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE code = '" . $code . "'");
		
		if ($query->num_rows) {
			$this->config->set('config_language_id', $query->row['language_id']);
		}

		// Replace the default language object
		$language = new Language($code);
		$language->load($code);
		$this->registry->set('language', $language);
		
		// Customer
		$this->registry->set('customer', new Cart\Customer($this->registry));

		// Currency
		$this->registry->set('currency', new Cart\Currency($this->registry));
	
		// Tax
		$this->registry->set('tax', new Cart\Tax($this->registry));
		
		if ($this->config->get('config_tax_default') == 'shipping') {
			$this->tax->setShippingAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));
		}

		if ($this->config->get('config_tax_default') == 'payment') {
			$this->tax->setPaymentAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));
		}

		$this->tax->setStoreAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));

		// Weight
		$this->registry->set('weight', new Cart\Weight($this->registry));
		
		// Length
		$this->registry->set('length', new Cart\Length($this->registry));
		
		// Cart
		$this->registry->set('cart', new Cart\Cart($this->registry));
		
		// Encryption
		$this->registry->set('encryption', new Encryption($this->config->get('config_encryption')));
	}
}
