<?php
class ModelCatalogUrlAlias extends Model {
	public function getUrlAlias($keyword) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($keyword) . "'");

		return $query->row;
	}
	
	//以下为新增seo keyword所需方法
	
	public function addUrlAlias($data) {
		$this->event->trigger('pre.admin.url_alias.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($data['query']) . "', keyword = '" . $this->db->escape($data['keyword']) . "'");

		$url_alias_id = $this->db->getLastId();
		$this->event->trigger('post.admin.url_alias.add', $url_alias_id);

		return $url_alias_id;
	}

	public function editUrlAlias($url_alias_id, $data) {
		$this->event->trigger('pre.admin.url_alias.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "url_alias SET query = '" . $this->db->escape($data['query']) . "', keyword = '" . $this->db->escape($data['keyword']) . "' WHERE url_alias_id = '" . (int)$url_alias_id . "'");

		$this->event->trigger('post.admin.url_alias.edit', $url_alias_id);
	}

	public function deleteUrlAlias($url_alias_id) {
		$this->event->trigger('pre.admin.url_alias.delete', $url_alias_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE url_alias_id = '" . (int)$url_alias_id . "'");

		$this->event->trigger('post.admin.url_alias.delete', $url_alias_id);
	}

	public function getUrlAliasByID($url_alias_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE url_alias_id = '" . (int)$url_alias_id . "'");

		return $query->row;
	}

	public function getUrlAliases($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "url_alias WHERE url_alias_id != 0 ";
		
		if (!empty($data['filter_keyword'])) {
			$sql .= " AND keyword LIKE '%" . $this->db->escape($data['filter_keyword']) . "%'";
		}

		if (!empty($data['filter_query'])) {
			$sql .= " AND query LIKE '%" . $this->db->escape($data['filter_query']) . "%'";
		}

		$sort_data = array(
			'query',
			'keyword'
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


	public function getTotalUrlAliases($data) {
		
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "url_alias WHERE url_alias_id != 0 ";
		
		if (!empty($data['filter_keyword'])) {
			$sql .= " AND keyword LIKE '%" . $this->db->escape($data['filter_keyword']) . "%'";
		}

		if (!empty($data['filter_query'])) {
			$sql .= " AND query LIKE '%" . $this->db->escape($data['filter_query']) . "%'";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getUrlAliasByQuery($seo_query) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query = '" . $this->db->escape($seo_query) . "'");

		return $query->row;
	}
}