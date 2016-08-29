<?php
class ModelBaiDuPushUrl extends Model {
	
	public function getAllCategories() {
		$sql = "SELECT cp.category_id AS category_id, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id)  LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c1.status = 1";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getAllProducts() {
		$sql = "SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = 1";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getAllManufacturers() {
		$sql = "SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id != 0";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getAllBlogs() {
		$sql = "SELECT b.blog_id FROM " . DB_PREFIX . "blog b LEFT JOIN " . DB_PREFIX . "blog_description bd ON (b.blog_id = bd.blog_id) WHERE bd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND b.status = 1";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getAllPresses() {
		$sql = "SELECT p.press_id FROM " . DB_PREFIX . "press p LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = 1";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	
	public function addPushUrl($product_url) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "pushurl SET url = '" . $this->db->escape($product_url) . "'");
		
	}
	
	public function addNewPushUrl($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "pushurl SET url = '" . $this->db->escape($data['url']) . "'");
		
	}
	
	public function editPushUrl($pushurl_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "pushurl SET url = '" . $this->db->escape($data['url']) . "' WHERE pushurl_id = '".$pushurl_id."'");
		
	}
	
	public function updatePushUrl($pushurl_id) {

		$this->db->query("UPDATE " . DB_PREFIX . "pushurl SET pushed = 1, push_date = NOW() WHERE pushurl_id = '".$pushurl_id."'");
		
	}
	
	public function deletePushUrl($pushurl_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "pushurl WHERE pushurl_id = '" . (int)$pushurl_id . "'");

	}
	
	public function getPushUrlByProductUrl($product_url) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE url LIKE '" . $this->db->escape($product_url) . "'");

		return $query->row;
	}
	
	public function getPushUrlByCategoryUrl($category_url) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE url LIKE '" . $this->db->escape($category_url) . "'");

		return $query->row;
	}
	
	public function getPushUrlByInformationUrl($information_url) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE url LIKE '" . $this->db->escape($information_url) . "'");

		return $query->row;
	}
	
	public function getPushUrlByManufacturerUrl($manufacturer_url) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE url LIKE '" . $this->db->escape($manufacturer_url) . "'");

		return $query->row;
	}
	
	public function getPushUrlByBlogUrl($blog_url) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE url LIKE '" . $this->db->escape($blog_url) . "'");

		return $query->row;
	}
	
	public function getPushUrlByPressUrl($press_url) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE url LIKE '" . $this->db->escape($press_url) . "'");

		return $query->row;
	}
	
	public function getPushUrl($pushurl_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pushurl  WHERE pushurl_id = '" . (int)$pushurl_id . "'");

		return $query->row;
	}
	
	public function getPushUrls($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "pushurl WHERE pushurl_id != 0";

		if (!empty($data['filter_url'])) {
			$sql .= " AND url LIKE '%" . $this->db->escape($data['filter_url']) . "%'";
		}
		
		if (isset($data['filter_pushed']) && !is_null($data['filter_pushed'])) {
			$sql .= " AND pushed = '" . (int)$data['filter_pushed'] . "'";
		}

		$sort_data = array(
			'url',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pushurl_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}


	public function getTotalPushUrls($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "pushurl WHERE pushurl_id != 0";

		if (!empty($data['filter_url'])) {
			$sql .= " AND url LIKE '%" . $this->db->escape($data['filter_url']) . "%'";
		}
		
		if (isset($data['filter_pushed']) && !is_null($data['filter_pushed'])) {
			$sql .= " AND pushed = '" . (int)$data['filter_pushed'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getProductSEOUrl($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'");	
		
		if($query->rows) {
			return HTTP_CATALOG.$query->row['keyword'];
		}else{
			return HTTP_CATALOG."index.php?route=product/product&product_id=".$product_id;
		}
		
	}
	
	public function getCategorySEOUrl($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "'");	
		
		if($query->rows) {
			return HTTP_CATALOG.$query->row['keyword'];
		}else{
			return HTTP_CATALOG."index.php?route=product/category&category_id=".$category_id;
		}
		
	}
	
	public function getInformationSEOUrl($information_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");	
		
		if($query->rows) {
			return HTTP_CATALOG.$query->row['keyword'];
		}else{
			return HTTP_CATALOG."index.php?route=information/information&information_id=".$information_id;
		}
		
	}
	
	public function getManufacturerSEOUrl($manufacturer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id . "'");	
		
		if($query->rows) {
			return HTTP_CATALOG.$query->row['keyword'];
		}else{
			return HTTP_CATALOG."index.php?route=product/manufacturer&manufacturer_id=".$manufacturer_id;
		}
		
	}
	
	public function getBlogSEOUrl($blog_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_id=" . (int)$blog_id . "'");	
		
		if($query->rows) {
			return HTTP_CATALOG.$query->row['keyword'];
		}else{
			return HTTP_CATALOG."index.php?route=blog/blog&blog_id=".$blog_id;
		}
		
	}
	
	public function getPressSEOUrl($press_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = 'press_id=" . (int)$press_id . "'");	
		
		if($query->rows) {
			return HTTP_CATALOG.$query->row['keyword'];
		}else{
			return HTTP_CATALOG."index.php?route=press/press&press_id=".$press_id;
		}
		
	}

	
}