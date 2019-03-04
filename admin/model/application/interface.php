<?php
class ModelApplicationInterface extends Model {
	public function addInterface($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "interface` SET type = '" . $this->db->escape($data['type']) . "', username = '" . $this->db->escape($data['username']) . "', `secret` = '" . $this->db->escape($data['secret']) . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");

		$interface_id = $this->db->getLastId();
	
		return $interface_id;
	}

	public function editInterface($interface_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "interface` SET type = '" . $this->db->escape($data['type']) . "', username = '" . $this->db->escape($data['username']) . "', `secret` = '" . $this->db->escape($data['secret']) . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE interface_id = '" . (int)$interface_id . "'");
	}

	public function deleteInterface($interface_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "interface` WHERE interface_id = '" . (int)$interface_id . "'");
	}

	public function getInterface($interface_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "interface` WHERE interface_id = '" . (int)$interface_id . "'");

		return $query->row;
	}

	public function getInterfaces($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "interface`";

		$sort_data = array(
			'type',
			'username',
			'status',
			'date_added',
			'date_modified'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY type";
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

	public function getTotalInterfaces() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "interface`");

		return $query->row['total'];
	}	
}
