<?php 	
class ModelFaqFaq extends Model {
	
	public function getFaq($faq_id) {
		
		$cache = md5($faq_id);
		
		$faq_data = $this->cache->get('faq.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_customer_group_id') . '.' . $cache);
		
		if(!$faq_data) {
			
			$query = $this->db->query("SELECT DISTINCT *, pd.title AS name, pd.answer, p.sort_order FROM " . DB_PREFIX . "faq p LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id) LEFT JOIN " . DB_PREFIX . "faq_to_store p2s ON (p.faq_id = p2s.faq_id) WHERE p.faq_id = '" . (int)$faq_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
			
			if ($query->num_rows) {
				$faq_data = array(
					'faq_id'         => $query->row['faq_id'],
					'title'          => $query->row['name'],
					'status'         => $query->row['status'],
					'sort_order'     => $query->row['sort_order'],
					'date_added'     => $query->row['date_added'],
					'answer'         => $query->row['answer'],
					
				);
			}
			
			$this->cache->set('faq.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_customer_group_id') . '.' . $cache, $faq_data);
			 
		}
		
		return $faq_data;
		
	}
	
	public function getFaqs($data = array()) {
		
		$cache = md5(http_build_query($data));
		
		$faq_data = $this->cache->get('faq.filter.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache);
		
		if (!$faq_data) {
			
			$sql = "SELECT p.faq_id, p.image ";
	
			if (!empty($data['filter_faq_category_id'])) {
				if (!empty($data['filter_sub_faq_category'])) {
					$sql .= " FROM " . DB_PREFIX . "faq_category_path cp LEFT JOIN " . DB_PREFIX . "faq_to_faq_category p2c ON (cp.faq_category_id = p2c.faq_category_id)";
				} else {
					$sql .= " FROM " . DB_PREFIX . "faq_to_faq_category p2c";
				}
	
					$sql .= " LEFT JOIN " . DB_PREFIX . "faq p ON (p2c.faq_id = p.faq_id)";
				
			} else {
				$sql .= " FROM " . DB_PREFIX . "faq p";
			}
	
			$sql .= " LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id) LEFT JOIN " . DB_PREFIX . "faq_to_store p2s ON (p.faq_id = p2s.faq_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
			if (!empty($data['filter_faq_category_id'])) {
				if (!empty($data['filter_sub_faq_category'])) {
					$sql .= " AND cp.path_id = '" . (int)$data['filter_faq_category_id'] . "'";
				} else {
					$sql .= " AND p2c.faq_category_id = '" . (int)$data['filter_faq_category_id'] . "'";
				}
	
			}
		
			$sql .= " GROUP BY p.faq_id";
	
				$sql .= " ORDER BY p.date_added";
			
	
				$sql .= " ASC, LCASE(pd.title) ASC";
	
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
	
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
	
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
	
			$faq_data = array();
	
			$query = $this->db->query($sql);
			
	
			foreach ($query->rows as $result) {
				$faq_data[$result['faq_id']] = $this->getFaq($result['faq_id']);
			}
			
			$this->cache->set('faq.filter.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache, $faq_data);
		
		}

		return $faq_data;
	}
	
	
	public function getTotalFaqs($data = array()) {
			
			$sql = "SELECT COUNT(DISTINCT p.faq_id) AS total";
	
			if (!empty($data['filter_faq_category_id'])) {
				if (!empty($data['filter_sub_faq_category'])) {
					$sql .= " FROM " . DB_PREFIX . "faq_category_path cp LEFT JOIN " . DB_PREFIX . "faq_to_faq_category p2c ON (cp.faq_category_id = p2c.faq_category_id)";
				} else {
					$sql .= " FROM " . DB_PREFIX . "faq_to_faq_category p2c";
				}
	
					$sql .= " LEFT JOIN " . DB_PREFIX . "faq p ON (p2c.faq_id = p.faq_id)";
				
			} else {
				$sql .= " FROM " . DB_PREFIX . "faq p";
			}
	
			$sql .= " LEFT JOIN " . DB_PREFIX . "faq_description pd ON (p.faq_id = pd.faq_id) LEFT JOIN " . DB_PREFIX . "faq_to_store p2s ON (p.faq_id = p2s.faq_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
			if (!empty($data['filter_faq_category_id'])) {
				if (!empty($data['filter_sub_faq_category'])) {
					$sql .= " AND cp.path_id = '" . (int)$data['filter_faq_category_id'] . "'";
				} else {
					$sql .= " AND p2c.faq_category_id = '" . (int)$data['filter_faq_category_id'] . "'";
				}
	
				if (!empty($data['filter_filter'])) {
					$implode = array();
	
					$filters = explode(',', $data['filter_filter']);
	
					foreach ($filters as $filter_id) {
						$implode[] = (int)$filter_id;
					}
	
					$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
				}
			}
	
			$query = $this->db->query($sql);
	
			return $query->row['total'];
	}
	
	public function getFaqProductRelated($faq_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_product pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.faq_id = '" . (int)$faq_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");


		return $query->rows;
	}
	
}
