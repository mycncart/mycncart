<?php
class ModelUserPermission extends Model {
	public function addPermission($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "permission SET name = '" . $this->db->escape($data['name']) . "', permission_group_id = '" . (int)$data['permission_group_id'] . "', controller = '" . $this->db->escape($data['controller']) . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW(), date_modified = NOW()");
		
		$permission_id = $this->db->getLastId();

		return $permission_id;
	}

	public function editPermission($permission_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "permission SET name = '" . $this->db->escape($data['name']) . "', permission_group_id = '" . (int)$data['permission_group_id'] . "', controller = '" . $this->db->escape($data['controller']) . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE permission_id = '" . (int)$permission_id . "'");
	}

	public function deletePermission($permission_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "permission WHERE permission_id = '" . (int)$permission_id . "'");
	}

	public function getPermission($permission_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "permission WHERE permission_id = '" . (int)$permission_id . "'");

		return $query->row;
	}

	public function getPermissions($data = array()) {
		$sql = "SELECT *, (SELECT pd.name FROM " . DB_PREFIX . "permission_group pd WHERE pd.permission_group_id = p.permission_group_id) AS permission_group FROM " . DB_PREFIX . "permission p WHERE p.permission_id != 0";

		if (!empty($data['filter_name'])) {
			$sql .= " AND p.name LIKE '" . $this->db->escape((string)$data['filter_name']) . "%'";
		}

		if (!empty($data['filter_permission_group_id'])) {
			$sql .= " AND a.permission_group_id = '" . (int)$data['filter_permission_group_id'] . "'";
		}

		$sort_data = array(
			'p.name',
			'permission_group',
			'p.controller',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY permission_group, p.sort_order, p.name";
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

	public function getTotalPermissions() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "permission");

		return $query->row['total'];
	}

	public function getTotalPermissionsByPermissionGroupId($permission_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "permission WHERE permission_group_id = '" . (int)$permission_group_id . "'");

		return $query->row['total'];
	}
	
	public function getPermissionByControllerName($controller) {
		$query = $this->db->query("SELECT permission_id FROM " . DB_PREFIX . "permission WHERE controller LIKE '" . $controller . "'");

		return $query->row;
	}
	
}
