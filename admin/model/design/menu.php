<?php
class ModelDesignMenu extends Model {
	public function addMenu($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "menu SET name = '" . $this->db->escape((string)$data['name']) . "', status = '" . (int)$data['status'] . "', menu_type = '" . $this->db->escape((string)$data['menu_type']) . "'";

        $menu_id = $this->db->getLastId();

        $top_items = $this->getTopItems(0);

        foreach($top_items as $top_item) {
            $this->db->query("UPDATE " . DB_PREFIX . "menu_top_item SET menu_id = '" . (int) $menu_id . "' WHERE menu_item_id = '" . (int) $top_item['menu_item_id'] . "'");
        }

		return $menu_id;
	}

	public function editMenu($menu_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "menu SET name = '" . $this->db->escape((string)$data['name']) . "', status = '" . (int)$data['status'] . "' WHERE menu_id = '" . (int)$menu_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_image WHERE menu_id = '" . (int)$menu_id . "'");

		if (isset($data['menu_image'])) {
			foreach ($data['menu_image'] as $language_id => $value) {
				foreach ($value as $menu_image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "menu_image SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', title = '" .  $this->db->escape($menu_image['title']) . "', link = '" .  $this->db->escape($menu_image['link']) . "', image = '" .  $this->db->escape($menu_image['image']) . "', sort_order = '" . (int)$menu_image['sort_order'] . "'");
				}
			}
		}
	}

	public function deleteMenu($menu_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_image WHERE menu_id = '" . (int)$menu_id . "'");
	}

	public function getMenu($menu_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");

		return $query->row;
	}

	public function getMenus($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "menu";

		$sort_data = array(
			'name',
			'status'
		);

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

	public function getTotalMenus() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu");

		return $query->row['total'];
	}

	public function getTopItems($menu_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "menu_top_item` WHERE menu_id = '". (int) $menu_id ."' ORDER BY position ASC");

        return $query->rows;
    }
}
