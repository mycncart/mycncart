<?php
class ModelDesignLayoutMobile extends Model {
	public function addLayoutMobile($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "layout_mobile SET name = '" . $this->db->escape((string)$data['name']) . "'");

		$layout_mobile_id = $this->db->getLastId();

		if (isset($data['layout_route_mobile'])) {
			foreach ($data['layout_route_mobile'] as $layout_route_mobile) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route_mobile SET layout_mobile_id = '" . (int)$layout_mobile_id . "', store_id = '" . (int)$layout_route_mobile['store_id'] . "', route = '" . $this->db->escape($layout_route_mobile['route']) . "'");
			}
		}

		if (isset($data['layout_module_mobile'])) {
			foreach ($data['layout_module_mobile'] as $layout_module_mobile) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module_mobile SET layout_mobile_id = '" . (int)$layout_mobile_id . "', code = '" . $this->db->escape($layout_module_mobile['code']) . "', position = '" . $this->db->escape($layout_module_mobile['position']) . "', sort_order = '" . (int)$layout_module_mobile['sort_order'] . "'");
			}
		}

		return $layout_mobile_id;
	}

	public function editLayoutMobile($layout_mobile_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "layout_mobile SET name = '" . $this->db->escape((string)$data['name']) . "' WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");

		if (isset($data['layout_route_mobile'])) {
			foreach ($data['layout_route_mobile'] as $layout_route_mobile) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_route_mobile SET layout_mobile_id = '" . (int)$layout_mobile_id . "', store_id = '" . (int)$layout_route_mobile['store_id'] . "', route = '" . $this->db->escape($layout_route_mobile['route']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_module_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");

		if (isset($data['layout_module_mobile'])) {
			foreach ($data['layout_module_mobile'] as $layout_module_mobile) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module_mobile SET layout_mobile_id = '" . (int)$layout_mobile_id . "', code = '" . $this->db->escape($layout_module_mobile['code']) . "', position = '" . $this->db->escape($layout_module_mobile['position']) . "', sort_order = '" . (int)$layout_module_mobile['sort_order'] . "'");
			}
		}
	}

	public function deleteLayoutMobile($layout_mobile_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_route_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "layout_module_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_to_layout_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");
	}

	public function getLayoutMobile($layout_mobile_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "layout_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");

		return $query->row;
	}

	public function getLayoutMobiles($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "layout_mobile";

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

	public function getLayoutMobileRoutes($layout_mobile_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "'");

		return $query->rows;
	}

	public function getLayoutMobileModules($layout_mobile_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_module_mobile WHERE layout_mobile_id = '" . (int)$layout_mobile_id . "' ORDER BY position ASC, sort_order ASC");

		return $query->rows;
	}

	public function getTotalLayoutMobiles() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "layout_mobile");

		return $query->row['total'];
	}
}