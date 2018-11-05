<?php
class ModelCatalogOptionGroup extends Model {
	public function addOptionGroup($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "option_group SET name = '" . $this->db->escape((string)$data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");

		return $this->db->getLastId();
	}

	public function editOptionGroup($option_group_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "option_group SET name = '" . $this->db->escape((string)$data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE option_group_id = '" . (int)$option_group_id . "'");

	}

	public function deleteOptionGroup($option_group_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "option_group WHERE option_group_id = '" . (int)$option_group_id . "'");
	}

	public function getOptionGroup($option_group_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "option_group WHERE option_group_id = '" . (int)$option_group_id . "'");

		return $query->row;
	}

	public function getOptionGroups($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "option_group";

			$sort_data = array(
				'name',
				'sort_order',
				'status'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY sort_order ASC, name";
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

	public function getTotalOptionGroups() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "option_group");

		return $query->row['total'];
	}
}