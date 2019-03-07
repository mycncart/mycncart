<?php
class ModelCatalogVisitor extends Model {
	public function addVisitor($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "visitor SET  store_id = '" . (int)$data['store_id'] . "', ip = '" . $this->db->escape($data['ip']) . "', country = '" . $this->db->escape($data['country']) . "', browser = '" . $this->db->escape($data['browser']) . "', referer = '" . $this->db->escape($data['referer']) . "', current_page = '" . $this->db->escape($data['current_page']) . "', visit_time = '" . $this->db->escape($data['visit_time']) . "', start_time = '" . (int)$data['start_time'] . "', product_id = '" . (int)$data['product_id'] . "', visit_token = '" . $this->db->escape($data['visit_token']) . "'");
	}

	public function updateVisitor($product_id, $d_time, $visit_token) {
		if ($product_id) {
			$this->db->query("UPDATE " . DB_PREFIX . "visitor SET d_time = '" . (int)$d_time . "' WHERE product_id = '" . (int)$product_id . "' AND visit_token = '" . $this->db->escape($visit_token) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "visitor SET d_time = '" . (int)$d_time . "' WHERE visit_token = '" . $this->db->escape($visit_token) . "'");
		}
	}
}