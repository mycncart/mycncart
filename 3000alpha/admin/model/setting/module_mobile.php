<?php
class ModelSettingModuleMobile extends Model {
	public function addModuleMobile($code, $data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "module_mobile` SET `name` = '" . $this->db->escape((string)$data['name']) . "', `code` = '" . $this->db->escape($code) . "', `setting` = '" . $this->db->escape(json_encode($data)) . "'");
	}
	
	public function editModuleMobile($module_mobile_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "module_mobile` SET `name` = '" . $this->db->escape((string)$data['name']) . "', `setting` = '" . $this->db->escape(json_encode($data)) . "' WHERE `module_mobile_id` = '" . (int)$module_mobile_id . "'");
	}

	public function deleteModuleMobile($module_mobile_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "module_mobile` WHERE `module_mobile_id` = '" . (int)$module_mobile_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "layout_module_mobile` WHERE `code` LIKE '%." . (int)$module_mobile_id . "'");
	}
		
	public function getModuleMobile($module_mobile_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module_mobile` WHERE `module_mobile_id` = '" . (int)$module_mobile_id . "'");

		if ($query->row) {
			return json_decode($query->row['setting'], true);
		} else {
			return array();
		}
	}
	
	public function getModuleMobiles() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module_mobile` ORDER BY `code`");

		return $query->rows;
	}	
		
	public function getModuleMobilesByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module_mobile` WHERE `code` = '" . $this->db->escape($code) . "' ORDER BY `name`");

		return $query->rows;
	}	
	
	public function deleteModuleMobilesByCode($code) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "module_mobile` WHERE `code` = '" . $this->db->escape($code) . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "layout_module_mobile` WHERE `code` LIKE '" . $this->db->escape($code) . "' OR `code` LIKE '" . $this->db->escape($code . '.%') . "'");
	}	
}