<?php
class ModelLocalisationWeightClass extends Model {
	public function addWeightClass($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "weight_class SET value = '" . (float)$data['value'] . "', title = '" . $this->db->escape($data['title']) . "', unit = '" . $this->db->escape($data['unit']) . "'");

		$this->cache->delete('weight_class');
		
		return $weight_class_id;
	}

	public function editWeightClass($weight_class_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "weight_class SET value = '" . (float)$data['value'] . "', title = '" . $this->db->escape($data['title']) . "', unit = '" . $this->db->escape($data['unit']) . "' WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		$this->cache->delete('weight_class');
	}

	public function deleteWeightClass($weight_class_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "weight_class WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		$this->cache->delete('weight_class');
	}

	public function getWeightClasses($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "weight_class WHERE weight_class_id != 0";

			$sort_data = array(
				'title',
				'unit',
				'value'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY title";
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
			$weight_class_data = $this->cache->get('weight_class');

			if (!$weight_class_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "weight_class");

				$weight_class_data = $query->rows;

				$this->cache->set('weight_class', $weight_class_data);
			}

			return $weight_class_data;
		}
	}

	public function getWeightClass($weight_class_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "weight_class WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row;
	}

	public function getTotalWeightClasses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "weight_class");

		return $query->row['total'];
	}
}