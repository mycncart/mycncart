<?php
class ModelLocalisationDistrict extends Model {
	public function addDistrict($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "district SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', city_id = '" . (int)$data['city_id'] . "'");

		$this->cache->delete('district');
		
		return $this->db->getLastId();
	}

	public function editDistrict($district_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "district SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', city_id = '" . (int)$data['city_id'] . "' WHERE district_id = '" . (int)$district_id . "'");

		$this->cache->delete('district');
	}

	public function deleteDistrict($district_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "district WHERE district_id = '" . (int)$district_id . "'");

		$this->cache->delete('district');
	}

	public function getDistrict($district_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "district WHERE district_id = '" . (int)$district_id . "'");

		return $query->row;
	}

	public function getDistricts($data = array()) {
		$sql = "SELECT *, d.name, ct.name AS city, z.name AS zone, c.name AS country FROM " . DB_PREFIX . "district d LEFT JOIN " . DB_PREFIX . "country c ON (d.country_id = c.country_id) LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = d.zone_id) LEFT JOIN " . DB_PREFIX . "city ct ON (ct.city_id = d.city_id)";

		$sort_data = array(
			'c.name',
			'ct.name',
			'z.name',
			'd.name',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY d.name";
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

	public function getDistrictsByCityId($city_id) {
		$district_data = $this->cache->get('district.' . (int)$city_id);

		if (!$district_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "district WHERE city_id = '" . (int)$city_id . "' AND status = '1' ORDER BY name");

			$district_data = $query->rows;

			$this->cache->set('district.' . (int)$city_id, $district_data);
		}

		return $district_data;
	}

	public function getTotalDistricts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "district");

		return $query->row['total'];
	}

	public function getTotalDistrictsByCityId($city_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "district WHERE city_id = '" . (int)$city_id . "'");

		return $query->row['total'];
	}
}