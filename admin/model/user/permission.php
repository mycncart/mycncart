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

		if (!empty($data['filter_permission_group_id'])) {
			$sql .= " AND p.permission_group_id = '" . (int)$data['filter_permission_group_id'] . "'";
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

	public function getTotalPermissions($data = array()) {
		$sql = "SELECT COUNT(*) AS total, name, controller, permission_group_id FROM " . DB_PREFIX . "permission WHERE permission_id != 0";
		
		if (!empty($data['filter_permission_group_id'])) {
			$sql .= " AND permission_group_id = '" . (int)$data['filter_permission_group_id'] . "'";
		}
		
		$query = $this->db->query($sql);

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
	
	public function repairPermissions() {
		$ignore = array(
			'common/dashboard',
			'common/startup',
			'common/login',
			'common/logout',
			'common/forgotten',
			'common/reset',			
			'common/footer',
			'common/header',
			'error/not_found',
			'error/permission'
		);

		$permissions = array();

		$files = array();

		// Make path into an array
		$path = array(DIR_APPLICATION . 'controller/*');

		// While the path array is still populated keep looping through
		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array
				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}

		// Sort the file array
		sort($files);
					
		foreach ($files as $file) {
			$controller = substr($file, strlen(DIR_APPLICATION . 'controller/'));

			$permission = substr($controller, 0, strrpos($controller, '.'));

			if (!in_array($permission, $ignore)) {
				$permissions[] = $permission;
			}
		}
		
		$current_permissions = $this->getPermissions();
		
		foreach ($current_permissions as $current_permission) {
			if (!in_array($current_permission['controller'], $permissions)) {
				$this->deletePermission($current_permission['permission_id']);
			}
		}
		
	}
	
}
