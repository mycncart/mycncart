<?php
class ModelLocalisationExpressAPI extends Model {
	public function addExpressAPI($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "express_api SET name = '" . $this->db->escape($data['name']) . "', api_key = '" . $this->db->escape($data['api_key']) . "', api_username = '" . $this->db->escape($data['api_username']) . "', status = '" . (int)$data['status'] . "'");

		$this->cache->delete('express_api');
		
		return $this->db->getLastId();
	}

	public function editExpressAPI($express_api_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "express_api SET name = '" . $this->db->escape($data['name']) . "', api_key = '" . $this->db->escape($data['api_key']) . "', api_username = '" . $this->db->escape($data['api_username']) . "', status = '" . (int)$data['status'] . "' WHERE express_api_id = '" . (int)$express_api_id . "'");

		$this->cache->delete('express_api');
	}

	public function deleteExpressAPI($express_api_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "express_api WHERE express_api_id = '" . (int)$express_api_id . "'");

		$this->cache->delete('express_api');
	}

	public function getExpressAPI($express_api_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "express_api WHERE express_api_id = '" . (int)$express_api_id . "'");

		return $query->row;
	}

	public function getExpressAPIs($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "express_api";

			$sort_data = array(
				'name',
				'status'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
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
		} else {
			$express_api_data = $this->cache->get('express_api.admin');

			if (!$express_api_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "express_api ORDER BY name ASC");

				$express_api_data = $query->rows;

				$this->cache->set('express_api.admin', $express_api_data);
			}

			return $express_api_data;
		}
	}

	public function getTotalExpressAPIs() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "express_api");

		return $query->row['total'];
	}
}