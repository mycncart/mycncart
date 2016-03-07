<?php
class ModelCmsFaqCategory extends Model {
	public function addFaqCategory($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category SET parent_id = '" . (int)$data['parent_id'] . "',  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$faq_category_id = $this->db->getLastId();


		foreach ($data['faq_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category_description SET faq_category_id = '" . (int)$faq_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "faq_category_path` SET `faq_category_id` = '" . (int)$faq_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "faq_category_path` SET `faq_category_id` = '" . (int)$faq_category_id . "', `path_id` = '" . (int)$faq_category_id . "', `level` = '" . (int)$level . "'");

		

		if (isset($data['faq_category_store'])) {
			foreach ($data['faq_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category_to_store SET faq_category_id = '" . (int)$faq_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this faq_category
		if (isset($data['faq_category_layout'])) {
			foreach ($data['faq_category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category_to_layout SET faq_category_id = '" . (int)$faq_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'faq_category_id=" . (int)$faq_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('faq_category');

		return $faq_category_id;
	}

	public function editFaqCategory($faq_category_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "faq_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE faq_category_id = '" . (int)$faq_category_id . "'");


		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_description WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		foreach ($data['faq_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category_description SET faq_category_id = '" . (int)$faq_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "faq_category_path` WHERE path_id = '" . (int)$faq_category_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $faq_category_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$faq_category_path['faq_category_id'] . "' AND level < '" . (int)$faq_category_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$faq_category_path['faq_category_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "faq_category_path` SET faq_category_id = '" . (int)$faq_category_path['faq_category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$faq_category_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "faq_category_path` SET faq_category_id = '" . (int)$faq_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "faq_category_path` SET faq_category_id = '" . (int)$faq_category_id . "', `path_id` = '" . (int)$faq_category_id . "', level = '" . (int)$level . "'");
		}

		

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_to_store WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		if (isset($data['faq_category_store'])) {
			foreach ($data['faq_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category_to_store SET faq_category_id = '" . (int)$faq_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_to_layout WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		if (isset($data['faq_category_layout'])) {
			foreach ($data['faq_category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "faq_category_to_layout SET faq_category_id = '" . (int)$faq_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'faq_category_id=" . (int)$faq_category_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'faq_category_id=" . (int)$faq_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('faq_category');

	}

	public function deleteFaqCategory($faq_category_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_path WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_category_path WHERE path_id = '" . (int)$faq_category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteFaqCategory($result['faq_category_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category WHERE faq_category_id = '" . (int)$faq_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_description WHERE faq_category_id = '" . (int)$faq_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_to_store WHERE faq_category_id = '" . (int)$faq_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_category_to_layout WHERE faq_category_id = '" . (int)$faq_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_faq_category WHERE faq_category_id = '" . (int)$faq_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'faq_category_id=" . (int)$faq_category_id . "'");

		$this->cache->delete('faq_category');

	}

	public function repairFaqCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_category WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $faq_category) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$faq_category['faq_category_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "faq_category_path` WHERE faq_category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "faq_category_path` SET faq_category_id = '" . (int)$faq_category['faq_category_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "faq_category_path` SET faq_category_id = '" . (int)$faq_category['faq_category_id'] . "', `path_id` = '" . (int)$faq_category['faq_category_id'] . "', level = '" . (int)$level . "'");

			$this->repairCategories($faq_category['faq_category_id']);
		}
	}

	public function getFaqCategory($faq_category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "faq_category_path cp LEFT JOIN " . DB_PREFIX . "faq_category_description cd1 ON (cp.path_id = cd1.faq_category_id AND cp.faq_category_id != cp.path_id) WHERE cp.faq_category_id = c.faq_category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.faq_category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'faq_category_id=" . (int)$faq_category_id . "') AS keyword FROM " . DB_PREFIX . "faq_category c LEFT JOIN " . DB_PREFIX . "faq_category_description cd2 ON (c.faq_category_id = cd2.faq_category_id) WHERE c.faq_category_id = '" . (int)$faq_category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getFaqCategories($data = array()) {
		$sql = "SELECT cp.faq_category_id AS faq_category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "faq_category_path cp LEFT JOIN " . DB_PREFIX . "faq_category c1 ON (cp.faq_category_id = c1.faq_category_id) LEFT JOIN " . DB_PREFIX . "faq_category c2 ON (cp.path_id = c2.faq_category_id) LEFT JOIN " . DB_PREFIX . "faq_category_description cd1 ON (cp.path_id = cd1.faq_category_id) LEFT JOIN " . DB_PREFIX . "faq_category_description cd2 ON (cp.faq_category_id = cd2.faq_category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.faq_category_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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

	public function getFaqCategoryDescriptions($faq_category_id) {
		$faq_category_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_category_description WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		foreach ($query->rows as $result) {
			$faq_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $faq_category_description_data;
	}


	public function getFaqCategoryStores($faq_category_id) {
		$faq_category_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_category_to_store WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		foreach ($query->rows as $result) {
			$faq_category_store_data[] = $result['store_id'];
		}

		return $faq_category_store_data;
	}

	public function getFaqCategoryLayouts($faq_category_id) {
		$faq_category_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_category_to_layout WHERE faq_category_id = '" . (int)$faq_category_id . "'");

		foreach ($query->rows as $result) {
			$faq_category_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $faq_category_layout_data;
	}

	public function getTotalFaqCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "faq_category");

		return $query->row['total'];
	}
	
	public function getTotalFaqCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "faq_category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	
}
