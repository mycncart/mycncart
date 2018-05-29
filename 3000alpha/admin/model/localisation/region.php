<?php
class ModelLocalisationRegion extends Model {
	public function addRegion($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "region SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape((string)$data['name']) . "', code = '" . $this->db->escape((string)$data['code']) . "', country_id = '" . (int)$data['country_id'] . "'");

		$this->cache->delete('region');
		
		return $this->db->getLastId();
	}

	public function editRegion($region_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "region SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape((string)$data['name']) . "', code = '" . $this->db->escape((string)$data['code']) . "', country_id = '" . (int)$data['country_id'] . "' WHERE region_id = '" . (int)$region_id . "'");

		$this->cache->delete('region');
	}

	public function deleteRegion($region_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "region WHERE region_id = '" . (int)$region_id . "'");

		$this->cache->delete('region');
	}

	public function getRegion($region_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "region WHERE region_id = '" . (int)$region_id . "'");

		return $query->row;
	}

	public function getRegions($data = array()) {
		$sql = "SELECT *, z.name, c.name AS country FROM " . DB_PREFIX . "region z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id)";

		$sort_data = array(
			'c.name',
			'z.name',
			'z.code'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY c.name";
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

	public function getRegionsByCountryId($country_id) {
		$region_data = $this->cache->get('region.' . (int)$country_id);

		if (!$region_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "region WHERE country_id = '" . (int)$country_id . "' AND status = '1' ORDER BY name");

			$region_data = $query->rows;

			$this->cache->set('region.' . (int)$country_id, $region_data);
		}

		return $region_data;
	}

	public function getTotalRegions() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "region");

		return $query->row['total'];
	}

	public function getTotalRegionsByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "region WHERE country_id = '" . (int)$country_id . "'");

		return $query->row['total'];
	}
}