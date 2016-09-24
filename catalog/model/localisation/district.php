<?php
class ModelLocalisationDistrict extends Model {
	public function getDistrict($district_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "district WHERE district_id = '" . (int)$district_id . "' AND status = '1'");

		return $query->row;
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
}