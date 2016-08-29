<?php
class ModelPressCategory extends Model {
	public function getPressCategory($press_category_id) {
		
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "press_category c LEFT JOIN " . DB_PREFIX . "press_category_description cd ON (c.press_category_id = cd.press_category_id) LEFT JOIN " . DB_PREFIX . "press_category_to_store c2s ON (c.press_category_id = c2s.press_category_id) WHERE c.press_category_id = '" . (int)$press_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}
	
	public function getPressCategories($parent_id = 0) {
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "press_category c LEFT JOIN " . DB_PREFIX . "press_category_description cd ON (c.press_category_id = cd.press_category_id) LEFT JOIN " . DB_PREFIX . "press_category_to_store c2s ON (c.press_category_id = c2s.press_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}

	

}
