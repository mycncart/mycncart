<?php
class ModelCmsPress extends Model {
	public function addPress($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "press SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$press_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "press SET image = '" . $this->db->escape($data['image']) . "' WHERE press_id = '" . (int)$press_id . "'");
		}

		foreach ($data['press_description'] as $language_id => $value) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "press_description SET press_id = '" . (int)$press_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['press_store'])) {
			foreach ($data['press_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_to_store SET press_id = '" . (int)$press_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['press_press_category'])) {
			foreach ($data['press_press_category'] as $press_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_to_press_category SET press_id = '" . (int)$press_id . "', press_category_id = '" . (int)$press_category_id . "'");
			}
		}
		
		if (isset($data['product_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "press_product WHERE press_id = " . (int)$press_id);
			
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_product SET press_id = '" . (int)$press_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'press_id=" . (int)$press_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'press_id=" . (int)$press_id . "', keyword = 'press-" . (int)$press_id . ".html'");
		}

		if (isset($data['press_layout'])) {
			foreach ($data['press_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_to_layout SET press_id = '" . (int)$press_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('press');


		return $press_id;
	}

	public function editPress($press_id, $data) {
		
	

		$this->db->query("UPDATE " . DB_PREFIX . "press SET status = '" . (int)$data['status'] . "',  sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE press_id = '" . (int)$press_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "press SET image = '" . $this->db->escape($data['image']) . "' WHERE press_id = '" . (int)$press_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_description WHERE press_id = '" . (int)$press_id . "'");

		foreach ($data['press_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "press_description SET press_id = '" . (int)$press_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_to_store WHERE press_id = '" . (int)$press_id . "'");

		if (isset($data['press_store'])) {
			foreach ($data['press_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_to_store SET press_id = '" . (int)$press_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_to_press_category WHERE press_id = '" . (int)$press_id . "'");

		if (isset($data['press_press_category'])) {
			foreach ($data['press_press_category'] as $press_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_to_press_category SET press_id = '" . (int)$press_id . "', press_category_id = '" . (int)$press_category_id . "'");
			}
		}
		
		if (isset($data['product_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "press_product WHERE press_id = " . (int)$press_id);
			
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_product SET press_id = '" . (int)$press_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'press_id=" . (int)$press_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'press_id=" . (int)$press_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'press_id=" . (int)$press_id . "', keyword = 'press-" . (int)$press_id . ".html'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_to_layout WHERE press_id = '" . (int)$press_id . "'");

		if (isset($data['press_layout'])) {
			foreach ($data['press_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_to_layout SET press_id = '" . (int)$press_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}


		$this->cache->delete('press');

	}

	public function deletePress($press_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "press WHERE press_id = '" . (int)$press_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_description WHERE press_id = '" . (int)$press_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_to_press_category WHERE press_id = '" . (int)$press_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_to_layout WHERE press_id = '" . (int)$press_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_to_store WHERE press_id = '" . (int)$press_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'press_id=" . (int)$press_id . "'");

		$this->cache->delete('press');

	}

	public function getPress($press_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'press_id=" . (int)$press_id . "') AS keyword FROM " . DB_PREFIX . "press p LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) WHERE p.press_id = '" . (int)$press_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPresses($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "press p LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND pd.title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
		}


		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.press_id";

		$sort_data = array(
			'pd.title',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.title";
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

	public function getPressesByPressCategoryId($press_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press p LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) LEFT JOIN " . DB_PREFIX . "press_to_press_category p2c ON (p.press_id = p2c.press_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.press_category_id = '" . (int)$press_category_id . "' ORDER BY pd.title ASC");

		return $query->rows;
	}

	public function getPressDescription($press_id) {
		$press_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_description WHERE press_id = '" . (int)$press_id . "'");

		foreach ($query->rows as $result) {
			$press_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'description'       => $result['description'],
				'meta_title'      	=> $result['meta_title'],
				'meta_description'  => $result['meta_description'],
				'meta_keyword'      => $result['meta_keyword'],
			);
		}

		return $press_description_data;
	}

	public function getPressPressCategories($press_id) {
		$press_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_to_press_category WHERE press_id = '" . (int)$press_id . "'");

		foreach ($query->rows as $result) {
			$press_category_data[] = $result['press_category_id'];
		}

		return $press_category_data;
	}

	public function getPressStores($press_id) {
		$press_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_to_store WHERE press_id = '" . (int)$press_id . "'");

		foreach ($query->rows as $result) {
			$press_store_data[] = $result['store_id'];
		}

		return $press_store_data;
	}

	public function getPressLayouts($press_id) {
		$press_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_to_layout WHERE press_id = '" . (int)$press_id . "'");

		foreach ($query->rows as $result) {
			$press_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $press_layout_data;
	}

	public function getTotalPresses($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.press_id) AS total FROM " . DB_PREFIX . "press p LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND pd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalPressesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "press_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
	public function getProductRelated($press_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_product WHERE press_id = '" . (int)$press_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}
		
		return $product_related_data;
	}
}