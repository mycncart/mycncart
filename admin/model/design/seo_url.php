<?php
class ModelDesignSeoUrl extends Model {
	public function addSeoUrl($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "seo_url` SET store_id = '" . (int)$data['store_id'] . "', language_id = '" . (int)$data['language_id'] . "', query = '" . $this->db->escape($data['query']) . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
	}

	public function editSeoUrl($seo_url_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "seo_url` SET store_id = '" . (int)$data['store_id'] . "', language_id = '" . (int)$data['language_id'] . "', query = '" . $this->db->escape($data['query']) . "', keyword = '" . $this->db->escape($data['keyword']) . "' WHERE seo_url_id = '" . (int)$seo_url_id . "'");
	}

	public function deleteSeoUrl($seo_url_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE seo_url_id = '" . (int)$seo_url_id . "'");
	}

	public function getSeoUrl($seo_url_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE seo_url_id = '" . (int)$seo_url_id . "'");

		return $query->row;
	}

	public function getSeoUrls($data = array()) {
		$sql = "SELECT *, (SELECT `name` FROM `" . DB_PREFIX . "store` s WHERE s.store_id = su.store_id) AS store, (SELECT `name` FROM `" . DB_PREFIX . "language` l WHERE l.language_id = su.language_id) AS language FROM `" . DB_PREFIX . "seo_url` su";

		$implode = array();

		if (!empty($data['filter_query'])) {
			$implode[] = "`query` LIKE '" . $this->db->escape($data['filter_query']) . "'";
		}
		
		if (!empty($data['filter_keyword'])) {
			$implode[] = "`keyword` LIKE '" . $this->db->escape($data['filter_keyword']) . "'";
		}
		
		if (isset($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$implode[] = "`store_id` = '" . (int)$data['filter_store_id'] . "'";
		}
				
		if (!empty($data['filter_language_id']) && $data['filter_language_id'] !== '') {
			$implode[] = "`language_id` = '" . (int)$data['filter_language_id'] . "'";
		}
		
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}	
		
		$sort_data = array(
			'query',
			'keyword',
			'language_id',
			'store_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY query";
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

	public function getTotalSeoUrls($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "seo_url`";
		
		$implode = array();

		if (!empty($data['filter_query'])) {
			$implode[] = "query LIKE '" . $this->db->escape($data['filter_query']) . "'";
		}
		
		if (!empty($data['filter_keyword'])) {
			$implode[] = "keyword LIKE '" . $this->db->escape($data['filter_keyword']) . "'";
		}
		
		if (!empty($data['filter_store_id']) && $data['filter_store_id'] !== '') {
			$implode[] = "store_id = '" . (int)$data['filter_store_id'] . "'";
		}
				
		if (!empty($data['filter_language_id']) && $data['filter_language_id'] !== '') {
			$implode[] = "language_id = '" . (int)$data['filter_language_id'] . "'";
		}
		
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}		
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getSeoUrlsByKeyword($keyword) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE keyword = '" . $this->db->escape($keyword) . "'");

		return $query->rows;
	}	
	
	public function getSeoUrlsByQuery($keyword) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE keyword = '" . $this->db->escape($keyword) . "'");

		return $query->rows;
	}	

	public function getUrlAliasByQuery($seo_query, $language_id, $store_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = '" . $this->db->escape($seo_query) . "' AND language_id = '" . $language_id . "' AND store_id = '" . $store_id . "'");

		return $query->row;
	}
	
	public function getUrlAliasByKeyword($seo_keyword, $language_id, $store_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE keyword = '" . $this->db->escape($seo_keyword) . "' AND language_id = '" . $language_id . "' AND store_id = '" . $store_id . "'");

		return $query->row;
	}
	
	public function getBSeoUrls($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "url_alias WHERE url_alias_id != 0 AND query LIKE 'blog%'";

		$query = $this->db->query($sql);

		return $query->rows;
	}	
	
	public function getProducts($data = array()) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)");

		return $query->rows;
	}
	
	public function getCategories($data = array()) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id)");

		return $query->rows;
	}
	
	public function getInformations($data = array()) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information c LEFT JOIN " . DB_PREFIX . "information_description cd ON (c.information_id = cd.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (c.information_id = i2s.information_id)");

		return $query->rows;
	}
	
	public function getManufacturers($data = array()) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m  LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id)");

		return $query->rows;
	}
}