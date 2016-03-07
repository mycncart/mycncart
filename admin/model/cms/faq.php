<?php
class ModelCmsFaq extends Model {
	public function addFaq($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "faq SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$faq_id = $this->db->getLastId();

		foreach ($data['faq_description'] as $language_id => $value) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET faq_id = '" . (int)$faq_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', answer = '" . $this->db->escape($value['answer']) . "'");
		}

		if (isset($data['faq_store'])) {
			foreach ($data['faq_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_store SET faq_id = '" . (int)$faq_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['faq_faq_category'])) {
			foreach ($data['faq_faq_category'] as $faq_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_faq_category SET faq_id = '" . (int)$faq_id . "', faq_category_id = '" . (int)$faq_category_id . "'");
			}
		}
		
		if (isset($data['product_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "faq_product WHERE faq_id = " . (int)$faq_id);
			
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_product SET faq_id = '" . (int)$faq_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}

		if (isset($data['faq_layout'])) {
			foreach ($data['faq_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_layout SET faq_id = '" . (int)$faq_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('faq');

		return $faq_id;
	}

	public function editFaq($faq_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "faq SET status = '" . (int)$data['status'] . "',  sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE faq_id = '" . (int)$faq_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($data['faq_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET faq_id = '" . (int)$faq_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', answer = '" . $this->db->escape($value['answer']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_store WHERE faq_id = '" . (int)$faq_id . "'");

		if (isset($data['faq_store'])) {
			foreach ($data['faq_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_store SET faq_id = '" . (int)$faq_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_faq_category WHERE faq_id = '" . (int)$faq_id . "'");

		if (isset($data['faq_faq_category'])) {
			foreach ($data['faq_faq_category'] as $faq_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_faq_category SET faq_id = '" . (int)$faq_id . "', faq_category_id = '" . (int)$faq_category_id . "'");
			}
		}
		
		if (isset($data['product_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "faq_product WHERE faq_id = " . (int)$faq_id);
			
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_product SET faq_id = '" . (int)$faq_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_layout WHERE faq_id = '" . (int)$faq_id . "'");

		if (isset($data['faq_layout'])) {
			foreach ($data['faq_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_layout SET faq_id = '" . (int)$faq_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}


		$this->cache->delete('faq');

	}

	public function deleteFaq($faq_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq WHERE faq_id = '" . (int)$faq_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE faq_id = '" . (int)$faq_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_faq_category WHERE faq_id = '" . (int)$faq_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_layout WHERE faq_id = '" . (int)$faq_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_store WHERE faq_id = '" . (int)$faq_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'faq_id=" . (int)$faq_id . "'");

		$this->cache->delete('faq');

	}

	public function getFaq($faq_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'faq_id=" . (int)$faq_id . "') AS keyword FROM " . DB_PREFIX . "faq p LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id) WHERE p.faq_id = '" . (int)$faq_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getFaqs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "faq p LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND pd.title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
		}


		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.faq_id";

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

	public function getFaqsByFaqCategoryId($faq_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq p LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id) LEFT JOIN " . DB_PREFIX . "faq_to_faq_category p2c ON (p.faq_id = p2c.faq_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.faq_category_id = '" . (int)$faq_category_id . "' ORDER BY pd.title ASC");

		return $query->rows;
	}

	public function getFaqDescription($faq_id) {
		$faq_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_description WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($query->rows as $result) {
			$faq_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'answer'      		=> $result['answer'],
			);
		}

		return $faq_description_data;
	}

	public function getFaqFaqCategories($faq_id) {
		$faq_faq_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_to_faq_category WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($query->rows as $result) {
			$faq_faq_category_data[] = $result['faq_category_id'];
		}

		return $faq_faq_category_data;
	}

	public function getFaqStores($faq_id) {
		$faq_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_to_store WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($query->rows as $result) {
			$faq_store_data[] = $result['store_id'];
		}

		return $faq_store_data;
	}

	public function getFaqLayouts($faq_id) {
		$faq_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_to_layout WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($query->rows as $result) {
			$faq_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $faq_layout_data;
	}

	public function getTotalFaqs($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.faq_id) AS total FROM " . DB_PREFIX . "faq p LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id)";

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

	public function getTotalFaqsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "faq_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
	public function getProductRelated($faq_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_product WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}
		
		return $product_related_data;
	}
}