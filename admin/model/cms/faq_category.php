<?php
class ModelCocDocCategory extends Model {
	public function addDocCategory($data) {
		$this->event->trigger('pre.admin.doc_category.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category SET parent_id = '" . (int)$data['parent_id'] . "',  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$doc_category_id = $this->db->getLastId();


		foreach ($data['doc_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category_description SET doc_category_id = '" . (int)$doc_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "doc_category_path` SET `doc_category_id` = '" . (int)$doc_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "doc_category_path` SET `doc_category_id` = '" . (int)$doc_category_id . "', `path_id` = '" . (int)$doc_category_id . "', `level` = '" . (int)$level . "'");

		

		if (isset($data['doc_category_store'])) {
			foreach ($data['doc_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category_to_store SET doc_category_id = '" . (int)$doc_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this doc_category
		if (isset($data['doc_category_layout'])) {
			foreach ($data['doc_category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category_to_layout SET doc_category_id = '" . (int)$doc_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'doc_category_id=" . (int)$doc_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('doc_category');

		$this->event->trigger('post.admin.doc_category.add', $doc_category_id);

		return $doc_category_id;
	}

	public function editDocCategory($doc_category_id, $data) {
		$this->event->trigger('pre.admin.doc_category.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "doc_category SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE doc_category_id = '" . (int)$doc_category_id . "'");


		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_description WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		foreach ($data['doc_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category_description SET doc_category_id = '" . (int)$doc_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "doc_category_path` WHERE path_id = '" . (int)$doc_category_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $doc_category_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$doc_category_path['doc_category_id'] . "' AND level < '" . (int)$doc_category_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$doc_category_path['doc_category_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "doc_category_path` SET doc_category_id = '" . (int)$doc_category_path['doc_category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$doc_category_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "doc_category_path` SET doc_category_id = '" . (int)$doc_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "doc_category_path` SET doc_category_id = '" . (int)$doc_category_id . "', `path_id` = '" . (int)$doc_category_id . "', level = '" . (int)$level . "'");
		}

		

		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_to_store WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		if (isset($data['doc_category_store'])) {
			foreach ($data['doc_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category_to_store SET doc_category_id = '" . (int)$doc_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_to_layout WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		if (isset($data['doc_category_layout'])) {
			foreach ($data['doc_category_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "doc_category_to_layout SET doc_category_id = '" . (int)$doc_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'doc_category_id=" . (int)$doc_category_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'doc_category_id=" . (int)$doc_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('doc_category');

		$this->event->trigger('post.admin.doc_category.edit', $doc_category_id);
	}

	public function deleteDocCategory($doc_category_id) {
		$this->event->trigger('pre.admin.doc_category.delete', $doc_category_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_path WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "doc_category_path WHERE path_id = '" . (int)$doc_category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteDocCategory($result['doc_category_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category WHERE doc_category_id = '" . (int)$doc_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_description WHERE doc_category_id = '" . (int)$doc_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_to_store WHERE doc_category_id = '" . (int)$doc_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "doc_category_to_layout WHERE doc_category_id = '" . (int)$doc_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_doc_category WHERE doc_category_id = '" . (int)$doc_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'doc_category_id=" . (int)$doc_category_id . "'");

		$this->cache->delete('doc_category');

		$this->event->trigger('post.admin.doc_category.delete', $doc_category_id);
	}

	public function repairDocCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "doc_category WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $doc_category) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$doc_category['doc_category_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "doc_category_path` WHERE doc_category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "doc_category_path` SET doc_category_id = '" . (int)$doc_category['doc_category_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "doc_category_path` SET doc_category_id = '" . (int)$doc_category['doc_category_id'] . "', `path_id` = '" . (int)$doc_category['doc_category_id'] . "', level = '" . (int)$level . "'");

			$this->repairCategories($doc_category['doc_category_id']);
		}
	}

	public function getDocCategory($doc_category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "doc_category_path cp LEFT JOIN " . DB_PREFIX . "doc_category_description cd1 ON (cp.path_id = cd1.doc_category_id AND cp.doc_category_id != cp.path_id) WHERE cp.doc_category_id = c.doc_category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.doc_category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'doc_category_id=" . (int)$doc_category_id . "') AS keyword FROM " . DB_PREFIX . "doc_category c LEFT JOIN " . DB_PREFIX . "doc_category_description cd2 ON (c.doc_category_id = cd2.doc_category_id) WHERE c.doc_category_id = '" . (int)$doc_category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getDocCategories($data = array()) {
		$sql = "SELECT cp.doc_category_id AS doc_category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "doc_category_path cp LEFT JOIN " . DB_PREFIX . "doc_category c1 ON (cp.doc_category_id = c1.doc_category_id) LEFT JOIN " . DB_PREFIX . "doc_category c2 ON (cp.path_id = c2.doc_category_id) LEFT JOIN " . DB_PREFIX . "doc_category_description cd1 ON (cp.path_id = cd1.doc_category_id) LEFT JOIN " . DB_PREFIX . "doc_category_description cd2 ON (cp.doc_category_id = cd2.doc_category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.doc_category_id";

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

	public function getDocCategoryDescriptions($doc_category_id) {
		$doc_category_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "doc_category_description WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		foreach ($query->rows as $result) {
			$doc_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $doc_category_description_data;
	}


	public function getDocCategoryStores($doc_category_id) {
		$doc_category_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "doc_category_to_store WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		foreach ($query->rows as $result) {
			$doc_category_store_data[] = $result['store_id'];
		}

		return $doc_category_store_data;
	}

	public function getDocCategoryLayouts($doc_category_id) {
		$doc_category_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "doc_category_to_layout WHERE doc_category_id = '" . (int)$doc_category_id . "'");

		foreach ($query->rows as $result) {
			$doc_category_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $doc_category_layout_data;
	}

	public function getTotalDocCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "doc_category");

		return $query->row['total'];
	}
	
	public function getTotalDocCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "doc_category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	
}
