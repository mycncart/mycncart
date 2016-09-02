<?php
class ModelCmsPressCategory extends Model {
	public function addPressCategory($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "press_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = '".date('Y-m-d H:i:s')."', date_added = '".date('Y-m-d H:i:s')."'");

		$press_category_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "press_category SET image = '" . $this->db->escape($data['image']) . "' WHERE press_category_id = '" . (int)$press_category_id . "'");
		}

		foreach ($data['press_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "press_category_description SET press_category_id = '" . (int)$press_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "press_category_path` SET `press_category_id` = '" . (int)$press_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "press_category_path` SET `press_category_id` = '" . (int)$press_category_id . "', `path_id` = '" . (int)$press_category_id . "', `level` = '" . (int)$level . "'");

		if (isset($data['press_category_store'])) {
			foreach ($data['press_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_category_to_store SET press_category_id = '" . (int)$press_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this press_category
		if (isset($data['press_category_layout'])) {
			foreach ($data['press_category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_category_to_layout SET press_category_id = '" . (int)$press_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'press_category_id=" . (int)$press_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('press_category');

		return $press_category_id;
	}

	public function editPressCategory($press_category_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "press_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = '".date('Y-m-d H:i:s')."' WHERE press_category_id = '" . (int)$press_category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "press_category SET image = '" . $this->db->escape($data['image']) . "' WHERE press_category_id = '" . (int)$press_category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_description WHERE press_category_id = '" . (int)$press_category_id . "'");

		foreach ($data['press_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "press_category_description SET press_category_id = '" . (int)$press_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "press_category_path` WHERE path_id = '" . (int)$press_category_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $press_category_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$press_category_path['press_category_id'] . "' AND level < '" . (int)$press_category_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$press_category_path['press_category_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "press_category_path` SET press_category_id = '" . (int)$press_category_path['press_category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$press_category_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "press_category_path` SET press_category_id = '" . (int)$press_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "press_category_path` SET press_category_id = '" . (int)$press_category_id . "', `path_id` = '" . (int)$press_category_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_to_store WHERE press_category_id = '" . (int)$press_category_id . "'");

		if (isset($data['press_category_store'])) {
			foreach ($data['press_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_category_to_store SET press_category_id = '" . (int)$press_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_to_layout WHERE press_category_id = '" . (int)$press_category_id . "'");

		if (isset($data['press_category_layout'])) {
			foreach ($data['press_category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "press_category_to_layout SET press_category_id = '" . (int)$press_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'press_category_id=" . (int)$press_category_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'press_category_id=" . (int)$press_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('press_category');

	}

	public function deletePressCategory($press_category_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_path WHERE press_category_id = '" . (int)$press_category_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_category_path WHERE path_id = '" . (int)$press_category_id . "'");

		foreach ($query->rows as $result) {
			$this->deletePressCategory($result['press_category_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category WHERE press_category_id = '" . (int)$press_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_description WHERE press_category_id = '" . (int)$press_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_to_store WHERE press_category_id = '" . (int)$press_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "press_category_to_layout WHERE press_category_id = '" . (int)$press_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'press_category_id=" . (int)$press_category_id . "'");

		$this->cache->delete('press_category');

	}

	public function repairPressCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_category WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $press_category) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$press_category['press_category_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "press_category_path` WHERE press_category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "press_category_path` SET press_category_id = '" . (int)$press_category['press_category_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "press_category_path` SET press_category_id = '" . (int)$press_category['press_category_id'] . "', `path_id` = '" . (int)$press_category['press_category_id'] . "', level = '" . (int)$level . "'");

			$this->repairPressCategories($press_category['press_category_id']);
		}
	}

	public function getPressCategory($press_category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "press_category_path cp LEFT JOIN " . DB_PREFIX . "press_category_description cd1 ON (cp.path_id = cd1.press_category_id AND cp.press_category_id != cp.path_id) WHERE cp.press_category_id = c.press_category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.press_category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'press_category_id=" . (int)$press_category_id . "') AS keyword FROM " . DB_PREFIX . "press_category c LEFT JOIN " . DB_PREFIX . "press_category_description cd2 ON (c.press_category_id = cd2.press_category_id) WHERE c.press_category_id = '" . (int)$press_category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPressCategories($data = array()) {
		$sql = "SELECT cp.press_category_id AS press_category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "press_category_path cp LEFT JOIN " . DB_PREFIX . "press_category c1 ON (cp.press_category_id = c1.press_category_id) LEFT JOIN " . DB_PREFIX . "press_category c2 ON (cp.path_id = c2.press_category_id) LEFT JOIN " . DB_PREFIX . "press_category_description cd1 ON (cp.path_id = cd1.press_category_id) LEFT JOIN " . DB_PREFIX . "press_category_description cd2 ON (cp.press_category_id = cd2.press_category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.press_category_id";

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

	public function getPressCategoryDescriptions($press_category_id) {
		$press_category_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_category_description WHERE press_category_id = '" . (int)$press_category_id . "'");

		foreach ($query->rows as $result) {
			$press_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $press_category_description_data;
	}

	public function getPressCategoryStores($press_category_id) {
		$press_category_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_category_to_store WHERE press_category_id = '" . (int)$press_category_id . "'");

		foreach ($query->rows as $result) {
			$press_category_store_data[] = $result['store_id'];
		}

		return $press_category_store_data;
	}

	public function getPressCategoryLayouts($press_category_id) {
		$press_category_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_category_to_layout WHERE press_category_id = '" . (int)$press_category_id . "'");

		foreach ($query->rows as $result) {
			$press_category_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $press_category_layout_data;
	}

	public function getTotalPressCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "press_category");

		return $query->row['total'];
	}
	
	public function getTotalPressCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "press_category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	
	
	
}
