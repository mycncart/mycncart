<?php 	
class ModelPressPress extends Model {
	
	public function getUsers(){
		
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user`");
        $users = $query->rows;
        $output = array();
		
        foreach( $users as $user ){
            $output[$user['user_id']] = $user['username'];
        }
		
        return $output;
    }
	
	public function getPress($press_id) {
		
		$cache = md5($press_id);
		
		$press_data = $this->cache->get('press.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_customer_group_id') . '.' . $cache);
		
		if(!$press_data) {
			
			$query = $this->db->query("SELECT DISTINCT *, pd.title AS name, p.image, p.sort_order FROM " . DB_PREFIX . "press p LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) LEFT JOIN " . DB_PREFIX . "press_to_store p2s ON (p.press_id = p2s.press_id) WHERE p.press_id = '" . (int)$press_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
			
			if ($query->num_rows) {
				$press_data = array(
					'press_id'       => $query->row['press_id'],
					'title'             => $query->row['name'],
					'brief'      => $query->row['brief'],
					'user_id'      => $query->row['user_id'],
					'image'      => $query->row['image'],
					'tags'       => $query->row['tag'],
					'press_category_id' => $query->row['press_category_id'],
					'created'              => $query->row['created'],
					'status'            => $query->row['status'],
					'hits'              => $query->row['hits'],
					'video_code'              => $query->row['video_code'],
					'featured'              => $query->row['featured'],
					'sort_order'             => $query->row['sort_order'],
					'date_added'              => $query->row['date_added'],
					'date_modified'         => $query->row['date_modified'],
					'brief'         	=> $query->row['brief'],
					'meta_title'         => $query->row['meta_title'],
					'meta_keyword'         => $query->row['meta_keyword'],
					'meta_description'         => $query->row['meta_description'],
					'description'         => $query->row['description'],
					
				);
			}
			
			$this->cache->set('press.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_customer_group_id') . '.' . $cache, $press_data);
			 
		}
		
		return $press_data;
		
	}
	
	public function getPresses($data = array()) {
		
		$cache = md5(http_build_query($data));
		
		$press_data = $this->cache->get('press.filter.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache);
		
		if (!$press_data) {
			
			$sql = "SELECT p.press_id, p.image ";
	
			if (!empty($data['filter_press_category_id'])) {
				if (!empty($data['filter_sub_press_category'])) {
					$sql .= " FROM " . DB_PREFIX . "press_category_path cp LEFT JOIN " . DB_PREFIX . "press_to_press_category p2c ON (cp.press_category_id = p2c.press_category_id)";
				} else {
					$sql .= " FROM " . DB_PREFIX . "press_to_press_category p2c";
				}
	
					$sql .= " LEFT JOIN " . DB_PREFIX . "press p ON (p2c.press_id = p.press_id)";
				
			} else {
				$sql .= " FROM " . DB_PREFIX . "press p";
			}
	
			$sql .= " LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) LEFT JOIN " . DB_PREFIX . "press_to_store p2s ON (p.press_id = p2s.press_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
			if (!empty($data['filter_press_category_id'])) {
				if (!empty($data['filter_sub_press_category'])) {
					$sql .= " AND cp.path_id = '" . (int)$data['filter_press_category_id'] . "'";
				} else {
					$sql .= " AND p2c.press_category_id = '" . (int)$data['filter_press_category_id'] . "'";
				}
	
			}
	
			if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
				$sql .= " AND (";
	
				if (!empty($data['filter_name'])) {
					$implode = array();
	
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
	
					foreach ($words as $word) {
						$implode[] = "pd.title LIKE '%" . $this->db->escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
	
					
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
					
				}
	
				if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
				}
	
				if (!empty($data['filter_tag'])) {
					$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
				}
	
				$sql .= ")";
			}
	
			$sql .= " GROUP BY p.press_id";
	
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
	
			$press_data = array();
	
			$query = $this->db->query($sql);
			
	
			foreach ($query->rows as $result) {
				$press_data[$result['press_id']] = $this->getPress($result['press_id']);
			}
			
			$this->cache->set('press.filter.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache, $press_data);
		
		}

		return $press_data;
	}
	
	
	public function getTotalPresses($data = array()) {
			
			$sql = "SELECT COUNT(DISTINCT p.press_id) AS total";
	
			if (!empty($data['filter_press_category_id'])) {
				if (!empty($data['filter_sub_press_category'])) {
					$sql .= " FROM " . DB_PREFIX . "press_category_path cp LEFT JOIN " . DB_PREFIX . "press_to_press_category p2c ON (cp.press_category_id = p2c.press_category_id)";
				} else {
					$sql .= " FROM " . DB_PREFIX . "press_to_press_category p2c";
				}
	
					$sql .= " LEFT JOIN " . DB_PREFIX . "press p ON (p2c.press_id = p.press_id)";
				
			} else {
				$sql .= " FROM " . DB_PREFIX . "press p";
			}
	
			$sql .= " LEFT JOIN " . DB_PREFIX . "press_description pd ON (p.press_id = pd.press_id) LEFT JOIN " . DB_PREFIX . "press_to_store p2s ON (p.press_id = p2s.press_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
			if (!empty($data['filter_press_category_id'])) {
				if (!empty($data['filter_sub_press_category'])) {
					$sql .= " AND cp.path_id = '" . (int)$data['filter_press_category_id'] . "'";
				} else {
					$sql .= " AND p2c.press_category_id = '" . (int)$data['filter_press_category_id'] . "'";
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
	
			if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
				$sql .= " AND (";
	
				if (!empty($data['filter_name'])) {
					$implode = array();
	
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
	
					foreach ($words as $word) {
						$implode[] = "pd.title LIKE '%" . $this->db->escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
	
					
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
					
				}
	
				if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
				}
	
				if (!empty($data['filter_tag'])) {
					$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
				}
	
				$sql .= ")";
			}
	
			$query = $this->db->query($sql);
	
			return $query->row['total'];
	}
	
	public function getPressProductRelated($press_id) {
		$product_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.press_id = '" . (int)$press_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) {
			$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
		}

		return $product_data;
	}
	
	public function getPressRelated($press_id) {
		$press_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_related pr LEFT JOIN " . DB_PREFIX . "press p ON (pr.related_id = p.press_id) LEFT JOIN " . DB_PREFIX . "press_to_store p2s ON (p.press_id = p2s.press_id) WHERE pr.press_id = '" . (int)$press_id . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) {
			$press_data[$result['related_id']] = $this->getProduct($result['related_id']);
		}

		return $press_data;
	}
	
	public function updateViewed($press_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "press SET hits = (hits + 1) WHERE press_id = '" . (int)$press_id . "'");
	}
	
}
