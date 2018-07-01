<?php
class ModelSettingModulePC extends Model {
	public function addModulePC($code, $data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "module_pc` SET `name` = '" . $this->db->escape((string)$data['name']) . "', `code` = '" . $this->db->escape($code) . "', `setting` = '" . $this->db->escape(json_encode($data)) . "'");
	}
	
	public function editModulePC($module_pc_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "module_pc` SET `name` = '" . $this->db->escape((string)$data['name']) . "', `setting` = '" . $this->db->escape(json_encode($data)) . "' WHERE `module_pc_id` = '" . (int)$module_pc_id . "'");
	}

	public function deleteModulePC($module_pc_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "module_pc` WHERE `module_pc_id` = '" . (int)$module_pc_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "layout_module_pc` WHERE `code` LIKE '%." . (int)$module_pc_id . "'");
	}
		
	public function getModulePC($module_pc_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module_pc` WHERE `module_pc_id` = '" . (int)$module_pc_id . "'");

		if ($query->row) {
			return json_decode($query->row['setting'], true);
		} else {
			return array();
		}
	}
	
	public function getModulePCs() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module_pc` ORDER BY `code`");

		return $query->rows;
	}	
		
	public function getModulePCsByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module_pc` WHERE `code` = '" . $this->db->escape($code) . "' ORDER BY `name`");

		return $query->rows;
	}	
	
	public function deleteModulePCsByCode($code) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "module_pc` WHERE `code` = '" . $this->db->escape($code) . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "layout_module_pc` WHERE `code` LIKE '" . $this->db->escape($code) . "' OR `code` LIKE '" . $this->db->escape($code . '.%') . "'");
	}	
}