<?php
namespace Cart;
class Customer {
	private $customer_id;
	private $fullname;
	private $customer_group_id;
	private $email;
	private $telephone;
	private $fax;
	private $newsletter;
	private $address_id;

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['customer_id'])) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND status = '1'");

			if ($customer_query->num_rows) {
				$this->customer_id = $customer_query->row['customer_id'];
				$this->fullname = $customer_query->row['fullname'];
				$this->customer_group_id = $customer_query->row['customer_group_id'];
				$this->email = $customer_query->row['email'];
				$this->telephone = $customer_query->row['telephone'];
				$this->fax = $customer_query->row['fax'];
				$this->newsletter = $customer_query->row['newsletter'];
				$this->address_id = $customer_query->row['address_id'];

				$this->db->query("UPDATE " . DB_PREFIX . "customer SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

				if (!$query->num_rows) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customer_ip SET customer_id = '" . (int)$this->session->data['customer_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
		} else {
			//Email login
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
			
			if ($customer_query->num_rows == 0) {
				//Telephone login
				$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(telephone) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
				
			}
		}

		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];

			$this->customer_id = $customer_query->row['customer_id'];
			$this->fullname = $customer_query->row['fullname'];
			$this->customer_group_id = $customer_query->row['customer_group_id'];
			$this->email = $customer_query->row['email'];
			$this->telephone = $customer_query->row['telephone'];
			$this->fax = $customer_query->row['fax'];
			$this->newsletter = $customer_query->row['newsletter'];
			$this->address_id = $customer_query->row['address_id'];

			$this->db->query("UPDATE " . DB_PREFIX . "customer SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			
			//if pc weixin login
			if(isset($this->session->data['weixin_pclogin_openid']) &&  isset($this->session->data['weixin_pclogin_unionid'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET weixin_login_openid = '" . $this->db->escape($this->session->data['weixin_pclogin_openid']) . "', weixin_login_unionid = '" . $this->db->escape($this->session->data['weixin_pclogin_unionid']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
				
				//clear other customer's same weixin info
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET weixin_login_openid = '', weixin_login_unionid = '' WHERE weixin_login_openid LIKE  '" . $this->db->escape($this->session->data['weixin_pclogin_openid']) . "' AND weixin_login_unionid LIKE '" . $this->db->escape($this->session->data['weixin_pclogin_unionid']) . "' AND customer_id != '" . (int)$this->customer_id . "'");
						
			}
			
			//if mobile weixin login
			if(isset($this->session->data['weixin_login_openid']) &&  isset($this->session->data['weixin_login_unionid'])) {
				
				if ($this->session->data['weixin_login_unionid']) {
					$this->db->query("UPDATE " . DB_PREFIX . "customer SET weixin_login_openid = '" . $this->db->escape($this->session->data['weixin_login_openid']) . "', weixin_login_unionid = '" . $this->db->escape($this->session->data['weixin_login_unionid']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
					
					//clear other customer's same weixin info
					$this->db->query("UPDATE " . DB_PREFIX . "customer SET weixin_login_openid = '', weixin_login_unionid = '' WHERE weixin_login_openid LIKE  '" . $this->db->escape($this->session->data['weixin_login_openid']) . "' AND weixin_login_unionid LIKE '" . $this->db->escape($this->session->data['weixin_login_unionid']) . "' AND customer_id != '" . (int)$this->customer_id . "'");
				}
						
			}
			
			//if weibo login
			if(isset($this->session->data['weibo_login_access_token']) &&  isset($this->session->data['weibo_login_uid'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET weibo_login_access_token = '" . $this->db->escape($this->session->data['weibo_login_access_token']) . "', weibo_login_uid = '" . $this->db->escape($this->session->data['weibo_login_uid']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
				
				//clear other customer's same weibo info
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET weibo_login_access_token = '', weibo_login_uid = '' WHERE weibo_login_access_token LIKE  '" . $this->db->escape($this->session->data['weibo_login_access_token']) . "' AND weibo_login_uid LIKE '" . $this->db->escape($this->session->data['weibo_login_uid']) . "' AND customer_id != '" . (int)$this->customer_id . "'");
						
			}
			
			//if qq login
			if(isset($this->session->data['qq_openid'])) {
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET qq_openid = '" . $this->db->escape($this->session->data['qq_openid']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
				
				//clear other customer's same qq info
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET qq_openid = '' WHERE qq_openid LIKE  '" . $this->db->escape($this->session->data['qq_openid']) . "' AND customer_id != '" . (int)$this->customer_id . "'");
						
			}

			return true;
		} else {
			return false;
		}
	}
	
	public function login_weixin($weixin_login_unionid){
		
		if ($weixin_login_unionid) {
			$customer = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE weixin_login_unionid = '" . $this->db->escape($weixin_login_unionid) . "'");
	
			if ($customer->num_rows) {
				$this->session->data['customer_id'] = $customer->row['customer_id'];
	
				if ($customer->row['cart'] && is_string($customer->row['cart'])) {
					$cart = unserialize($customer->row['cart']);
	
					foreach ($cart as $key => $value) {
						if (!array_key_exists($key, $this->session->data['cart'])) {
							$this->session->data['cart'][$key] = $value;
						} else {
							$this->session->data['cart'][$key] += $value;
						}
					}
				}
	
				if ($customer->row['wishlist'] && is_string($customer->row['wishlist'])) {
					if (!isset($this->session->data['wishlist'])) {
						$this->session->data['wishlist'] = array();
					}
	
					$wishlist = unserialize($customer->row['wishlist']);
	
					foreach ($wishlist as $product_id) {
						if (!in_array($product_id, $this->session->data['wishlist'])) {
							$this->session->data['wishlist'][] = $product_id;
						}
					}
				}
	
				$this->customer_id = $customer->row['customer_id'];
				$this->fullname = $customer->row['fullname'];
				$this->email = $customer->row['email'];
				$this->telephone = $customer->row['telephone'];
				$this->fax = $customer->row['fax'];
				$this->newsletter = $customer->row['newsletter'];
				$this->customer_group_id = $customer->row['customer_group_id'];
				$this->address_id = $customer->row['address_id'];
	
				$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
	
				return true;
			} else {
				return false;
			}
		
		} else {
			return false;
		}

	}
	
	public function login_weibo($weibo_login_access_token, $weibo_login_uid){
		$customer = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE weibo_login_access_token = '" . $this->db->escape($weibo_login_access_token) . "' AND weibo_login_uid = '" . $this->db->escape($weibo_login_uid) . "'");

		
		if ($customer->num_rows) {
			$this->session->data['customer_id'] = $customer->row['customer_id'];

			if ($customer->row['cart'] && is_string($customer->row['cart'])) {
				$cart = unserialize($customer->row['cart']);

				foreach ($cart as $key => $value) {
					if (!array_key_exists($key, $this->session->data['cart'])) {
						$this->session->data['cart'][$key] = $value;
					} else {
						$this->session->data['cart'][$key] += $value;
					}
				}
			}

			if ($customer->row['wishlist'] && is_string($customer->row['wishlist'])) {
				if (!isset($this->session->data['wishlist'])) {
					$this->session->data['wishlist'] = array();
				}

				$wishlist = unserialize($customer->row['wishlist']);

				foreach ($wishlist as $product_id) {
					if (!in_array($product_id, $this->session->data['wishlist'])) {
						$this->session->data['wishlist'][] = $product_id;
					}
				}
			}

			$this->customer_id = $customer->row['customer_id'];
			$this->fullname = $customer->row['fullname'];
			$this->email = $customer->row['email'];
			$this->telephone = $customer->row['telephone'];
			$this->fax = $customer->row['fax'];
			$this->newsletter = $customer->row['newsletter'];
			$this->customer_group_id = $customer->row['customer_group_id'];
			$this->address_id = $customer->row['address_id'];

			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			
			$this->session->data['weibo_logout_status'] = 0;

			return true;
		} else {
			return false;
		}
		

	}
	
	public function login_qq($qq_openid){
		$customer = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE qq_openid = '" . $this->db->escape($qq_openid) . "'");

		
		if ($customer->num_rows) {
			$this->session->data['customer_id'] = $customer->row['customer_id'];

			if ($customer->row['cart'] && is_string($customer->row['cart'])) {
				$cart = unserialize($customer->row['cart']);

				foreach ($cart as $key => $value) {
					if (!array_key_exists($key, $this->session->data['cart'])) {
						$this->session->data['cart'][$key] = $value;
					} else {
						$this->session->data['cart'][$key] += $value;
					}
				}
			}

			if ($customer->row['wishlist'] && is_string($customer->row['wishlist'])) {
				if (!isset($this->session->data['wishlist'])) {
					$this->session->data['wishlist'] = array();
				}

				$wishlist = unserialize($customer->row['wishlist']);

				foreach ($wishlist as $product_id) {
					if (!in_array($product_id, $this->session->data['wishlist'])) {
						$this->session->data['wishlist'][] = $product_id;
					}
				}
			}

			$this->customer_id = $customer->row['customer_id'];
			$this->fullname = $customer->row['fullname'];
			$this->email = $customer->row['email'];
			$this->telephone = $customer->row['telephone'];
			$this->fax = $customer->row['fax'];
			$this->newsletter = $customer->row['newsletter'];
			$this->customer_group_id = $customer->row['customer_group_id'];
			$this->address_id = $customer->row['address_id'];

			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");
			
			return true;
		} else {
			return false;
		}
		

	}

	public function logout() {
		unset($this->session->data['customer_id']);
		unset($this->session->data['weibo_login_access_token']);
		unset($this->session->data['weibo_login_uid']);
		unset($this->session->data['qq_openid']);

		$this->customer_id = '';
		$this->fullname = '';
		$this->customer_group_id = '';
		$this->email = '';
		$this->telephone = '';
		$this->fax = '';
		$this->newsletter = '';
		$this->address_id = '';
	}

	public function isLogged() {
		return $this->customer_id;
	}

	public function getId() {
		return $this->customer_id;
	}

	public function getFullName() {
		return $this->fullname;
	}

	public function getGroupId() {
		return $this->customer_group_id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function getFax() {
		return $this->fax;
	}

	public function getNewsletter() {
		return $this->newsletter;
	}

	public function getAddressId() {
		return $this->address_id;
	}

	public function getBalance() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$this->customer_id . "'");

		return $query->row['total'];
	}

	public function getRewardPoints() {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$this->customer_id . "'");

		return $query->row['total'];
	}
}
