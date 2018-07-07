<?php
class ModelDesignLayoutPC extends Model {
	public function addLayoutPC($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "layout_pc SET name = '" . $this->db->escape((string)$data['name']) . "'");

		$layout_pc_id = $this->db->getLastId();

		if (isset($data['layout_route_pc'])) {
			foreach ($data['layout_route_pc'] as $layout_route_pc) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route_pc SET layout_pc_id = '" . (int)$layout_pc_id . "', store_id = '" . (int)$layout_route_pc['store_id'] . "', route = '" . $this->db->escape($layout_route_pc['route']) . "'");
			}
		}

		if (isset($data['layout_module_pc'])) {
			foreach ($data['layout_module_pc'] as $layout_module_pc) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module_pc SET layout_pc_id = '" . (int)$layout_pc_id . "', code = '" . $this->db->escape($layout_module_pc['code']) . "', position = '" . $this->db->escape($layout_module_pc['position']) . "', sort_order = '" . (int)$layout_module_pc['sort_order'] . "'");
			}
		}

		return $layout_pc_id;
	}

	public function editLayoutPC($layout_pc_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "layout_pc SET name = '" . $this->db->escape((string)$data['name']) . "' WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");

		if (isset($data['layout_route_pc'])) {
			foreach ($data['layout_route_pc'] as $layout_route_pc) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route_pc SET layout_pc_id = '" . (int)$layout_pc_id . "', store_id = '" . (int)$layout_route_pc['store_id'] . "', route = '" . $this->db->escape($layout_route_pc['route']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_module_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");

		if (isset($data['layout_module_pc'])) {
			foreach ($data['layout_module_pc'] as $layout_module_pc) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module_pc SET layout_pc_id = '" . (int)$layout_pc_id . "', code = '" . $this->db->escape($layout_module_pc['code']) . "', position = '" . $this->db->escape($layout_module_pc['position']) . "', sort_order = '" . (int)$layout_module_pc['sort_order'] . "'");
			}
		}
	}

	public function deleteLayoutPC($layout_pc_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_module_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");
	}

	public function getLayoutPC($layout_pc_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "layout_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");

		return $query->row;
	}

	public function getLayoutPCs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "layout_pc";

		$sort_data = array('name');

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
	}

	public function getLayoutPCRoutes($layout_pc_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "'");

		return $query->rows;
	}

	public function getLayoutPCModules($layout_pc_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_module_pc WHERE layout_pc_id = '" . (int)$layout_pc_id . "' ORDER BY position ASC, sort_order ASC");

		return $query->rows;
	}

	public function getTotalLayoutPCs() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "layout_pc");

		return $query->row['total'];
	}
}