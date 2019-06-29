<?php
class ModelExtensionModuleOcmegamenu extends Model
{
    public function createMenuTable() {
        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "megamenu` (
			    `menu_id` INT(11) NOT NULL AUTO_INCREMENT,
	            `status` TINYINT(1) NOT NULL DEFAULT '0',
	            `name` VARCHAR(255) NOT NULL,
	            `menu_type` VARCHAR(255) NOT NULL,
	        PRIMARY KEY (`menu_id`)
		) DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "megamenu_top_item` (
			    `menu_item_id` INT(11) NOT NULL AUTO_INCREMENT,
			    `menu_id` INT(11) NOT NULL,
	            `status` TINYINT(1) NOT NULL DEFAULT '0',
	            `has_title` TINYINT(1) NOT NULL DEFAULT '0',
	            `has_link` TINYINT(1) NOT NULL DEFAULT '0',
	            `has_child` TINYINT(1) NOT NULL DEFAULT '0',
                `category_id` INT(11),
                `position` INT(11) NOT NULL DEFAULT '0',
	            `name` VARCHAR(255) NOT NULL,
	            `link` VARCHAR(255),
	            `icon` VARCHAR(255),
	            `item_align` VARCHAR(255) NOT NULL,
	            `sub_menu_type` VARCHAR(255) NOT NULL,
	            `sub_menu_content_type` VARCHAR(255) NOT NULL,
	            `sub_menu_content_columns` INT(11),
	            `sub_menu_content` text,
	        PRIMARY KEY (`menu_item_id`)
		) DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "megamenu_top_item_description` (
			    `menu_item_id` INT(11) NOT NULL,
			    `language_id` int(11) NOT NULL,
	            `title` VARCHAR(255) NOT NULL,
	            PRIMARY KEY (`menu_item_id`,`language_id`)
		) DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "megamenu_sub_item` (
			    `sub_menu_item_id` INT(11) NOT NULL AUTO_INCREMENT,
			    `parent_menu_item_id` INT(11) NOT NULL,
			    `level` INT(11) NOT NULL,
	            `status` TINYINT(1) NOT NULL DEFAULT '0',
	            `name` VARCHAR(255) NOT NULL,
	            `position` INT(11) NOT NULL,
	            `link` VARCHAR(255),
	        PRIMARY KEY (`sub_menu_item_id`)
		) DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "megamenu_sub_item_description` (
			    `sub_menu_item_id` INT(11) NOT NULL,
			    `language_id` int(11) NOT NULL,
	            `title` VARCHAR(255) NOT NULL,
	            PRIMARY KEY (`sub_menu_item_id`,`language_id`)
		) DEFAULT COLLATE=utf8_general_ci;");
    }

    public function addMenu($data) {
        $sql = "INSERT INTO " . DB_PREFIX . "megamenu SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', menu_type = '" . $this->db->escape($data['menu_type']) . "'";

        $this->db->query($sql);

        $menu_id = $this->db->getLastId();

        $top_items = $this->getTopItems(0);

        foreach($top_items as $top_item) {
            $sql_update = "UPDATE " . DB_PREFIX . "megamenu_top_item SET menu_id = '" . (int) $menu_id . "' WHERE menu_item_id = '" . (int) $top_item['menu_item_id'] . "'";

            $this->db->query($sql_update);
        }
    }

    public function editMenu($menu_id, $data) {
        $sql_update = "UPDATE " . DB_PREFIX . "megamenu SET status = '" . (int)$data['status'] . "', name = '". $this->db->escape($data['name']) ."', menu_type = '" . $this->db->escape($data['menu_type']) . "' WHERE menu_id = '" . (int) $menu_id . "'";

        $this->db->query($sql_update);
    }

    public function deleteMenu($menu_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "megamenu_top_item WHERE menu_id = '" . (int)$menu_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "megamenu WHERE menu_id = '" . (int)$menu_id . "'");
    }

    public function addTopItem($data) {
        $sql = "INSERT INTO ". DB_PREFIX . "megamenu_top_item SET status = '" . (int)$data['status'] . "', menu_id = '" . (int)$data['menu_id'] . "', has_title = '" . (int)$data['has_title'] . "', has_link = '" . (int)$data['has_link'] . "', has_child = '" . (int)$data['has_child'] . "', category_id = '" . (int)$data['category_id'] . "', position = '" . (int)$data['position'] . "', name = '" . $this->db->escape($data['name']) . "', link = '" . $this->db->escape($data['link']) . "', icon = '" . $this->db->escape($data['icon']) . "', item_align = '" . $this->db->escape($data['item_align']) . "', sub_menu_type = '" . $this->db->escape($data['sub_menu_type']) . "', sub_menu_content_type = '" . $this->db->escape($data['sub_menu_content_type']) . "', sub_menu_content_columns = '" . (int)$data['sub_menu_content_columns'] . "', sub_menu_content = '" . $this->db->escape(json_encode($data['sub_menu_content'])) . "'";

        $this->db->query($sql);

        $menu_item_id = $this->db->getLastId();

        foreach ($data['title'] as $language_id => $title) {
            $sql_title = "INSERT INTO " . DB_PREFIX . "megamenu_top_item_description SET language_id = '" . (int) $language_id . "', menu_item_id = '" . (int) $menu_item_id . "', title = '" . $this->db->escape($title) . "'";

            $this->db->query($sql_title);
        }

        return $menu_item_id;
    }

    public function editTopItem($data, $menu_item_id) {
        $sql = "UPDATE ". DB_PREFIX . "megamenu_top_item SET status = '" . (int)$data['status'] . "', menu_id = '" . (int)$data['menu_id'] . "', has_title = '" . (int)$data['has_title'] . "', has_link = '" . (int)$data['has_link'] . "', has_child = '" . (int)$data['has_child'] . "', category_id = '" . (int)$data['category_id'] . "', position = '" . (int)$data['position'] . "', name = '" . $this->db->escape($data['name']) . "', link = '" . $this->db->escape($data['link']) . "', icon = '" . $this->db->escape($data['icon']) . "', item_align = '" . $this->db->escape($data['item_align']) . "', sub_menu_type = '" . $this->db->escape($data['sub_menu_type']) . "', sub_menu_content_type = '" . $this->db->escape($data['sub_menu_content_type']) . "', sub_menu_content_columns = '" . (int)$data['sub_menu_content_columns'] . "', sub_menu_content = '" . $this->db->escape(json_encode($data['sub_menu_content'])) . "' WHERE menu_item_id = '". (int) $menu_item_id."'";

        $this->db->query($sql);

        $sql_reset = "DELETE FROM " . DB_PREFIX . "megamenu_top_item_description WHERE menu_item_id = '" . (int) $menu_item_id . "'";

        $this->db->query($sql_reset);

        foreach ($data['title'] as $language_id => $title) {
            $sql_title = "INSERT INTO " . DB_PREFIX . "megamenu_top_item_description SET language_id = '" . (int) $language_id . "', menu_item_id = '" . (int) $menu_item_id . "', title = '" . $this->db->escape($title) . "'";

            $this->db->query($sql_title);
        }
    }

    public function editTopItemPosition($position, $menu_item_id) {
        $sql = "UPDATE ". DB_PREFIX . "megamenu_top_item SET position = '" . (int) $position . "' WHERE menu_item_id = '". (int) $menu_item_id."'";

        $this->db->query($sql);
    }

    public function deleteTopItem($menu_item_id) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "megamenu_sub_item` WHERE parent_menu_item_id = '" . (int) $menu_item_id . "'";

        $query = $this->db->query($sql);

        foreach($query->rows as $item) {
            $this->deleteSubItem($item['sub_menu_item_id']);
        }

        $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_top_item_description` WHERE menu_item_id = '" . (int) $menu_item_id . "'";

        $this->db->query($sql);

        $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_top_item` WHERE menu_item_id = '" . (int) $menu_item_id . "'";

        $this->db->query($sql);
    }

    public function deleteTopItemByMenu($menu_id) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "megamenu_top_item` WHERE menu_id = '" . (int) $menu_id . "'";

        $query = $this->db->query($sql);

        $top_items = $query->rows;

        foreach($top_items as $item) {
            $menu_item_id = $item['menu_item_id'];

            $this->deleteTopItem($menu_item_id);
        }
    }

    public function addSubItem($data) {
        $sql = "INSERT INTO ". DB_PREFIX . "megamenu_sub_item SET status = '" . (int) $data['status'] . "', parent_menu_item_id = '" . (int) $data['parent_menu_item_id'] . "', level = '" . (int)$data['level'] . "', position = '" . (int)$data['position'] . "', name = '" . $this->db->escape($data['name']) . "', link = '" . $this->db->escape($data['link']) . "'";

        $this->db->query($sql);

        $sub_item_id = $this->db->getLastId();

        foreach ($data['title'] as $language_id => $title) {
            $sql_title = "INSERT INTO " . DB_PREFIX . "megamenu_sub_item_description SET language_id = '" . (int) $language_id . "', sub_menu_item_id = '" . (int) $sub_item_id . "', title = '" . $this->db->escape($title) . "'";

            $this->db->query($sql_title);
        }

        $level = (int) $data['level'];

        if($level == 2) {
            $sqlTopChild = "UPDATE ". DB_PREFIX . "megamenu_top_item SET has_child = '1' WHERE menu_item_id = '" . (int) $data['parent_menu_item_id'] . "'";

            $this->db->query($sqlTopChild);
        }

        return $sub_item_id;
    }

    public function editSubItem($data, $sub_item_id) {
        $sql = "UPDATE ". DB_PREFIX . "megamenu_sub_item SET status = '" . (int)$data['status'] . "', parent_menu_item_id = '" . (int)$data['parent_menu_item_id'] . "', level = '" . (int)$data['level'] . "', position = '" . (int)$data['position'] . "', name = '" . $this->db->escape($data['name']) . "', link = '" . $this->db->escape($data['link']) . "' WHERE sub_menu_item_id = '". (int) $sub_item_id."'";

        $this->db->query($sql);

        $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_sub_item_description` WHERE sub_menu_item_id = '" . (int) $sub_item_id. "'";

        $this->db->query($sql);

        foreach ($data['title'] as $language_id => $title) {
            $sql_title = "INSERT INTO " . DB_PREFIX . "megamenu_sub_item_description SET language_id = '" . (int) $language_id . "', sub_menu_item_id = '" . (int) $sub_item_id . "', title = '" . $this->db->escape($title) . "'";

            $this->db->query($sql_title);
        }
    }

    public function editSubItemPosition($position, $sub_menu_id) {
        $sql = "UPDATE ". DB_PREFIX . "megamenu_sub_item SET position = '" . (int) $position . "' WHERE sub_menu_item_id = '". (int) $sub_menu_id."'";

        $this->db->query($sql);
    }

    public function deleteSubItem($sub_item_id) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "megamenu_sub_item` WHERE parent_menu_item_id = '" . (int) $sub_item_id . "'";

        $query = $this->db->query($sql);

        foreach($query->rows as $item) {
            $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_sub_item_description` WHERE sub_menu_item_id = '" . (int) $item['sub_menu_item_id']. "'";

            $this->db->query($sql);

            $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_sub_item` WHERE sub_menu_item_id = '" . (int) $item['sub_menu_item_id'] . "'";

            $this->db->query($sql);
        }

        $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_sub_item_description` WHERE sub_menu_item_id = '" . (int) $sub_item_id . "'";

        $this->db->query($sql);

        $sql = "DELETE FROM `" . DB_PREFIX . "megamenu_sub_item` WHERE sub_menu_item_id = '" . (int) $sub_item_id . "'";

        $this->db->query($sql);
    }

    public function getTopItems($menu_id) {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "megamenu_top_item` m WHERE m.menu_id = '". (int) $menu_id ."' ORDER BY m.position ASC";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTopItemById($menu_item_id) {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "megamenu_top_item` m LEFT JOIN `" . DB_PREFIX . "megamenu_top_item_description` md ON (m.menu_item_id = md.menu_item_id) WHERE m.menu_item_id = '". (int) $menu_item_id ."' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getTopItemDescriptionById($menu_item_id) {
        $menu_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megamenu_top_item_description WHERE menu_item_id = '" . (int)$menu_item_id . "'");

        foreach ($query->rows as $result) {
            $menu_description_data[$result['language_id']] = $result['title'];
        }

        return $menu_description_data;
    }

    public function getSubItems($parent_item_id, $level) {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "megamenu_sub_item` m WHERE m.parent_menu_item_id = '". (int) $parent_item_id ."' AND m.level = '" . (int) $level . "' ORDER BY m.position ASC";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getSubItemById($sub_item_id) {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "megamenu_sub_item` m LEFT JOIN `" . DB_PREFIX . "megamenu_sub_item_description` md ON (m.sub_menu_item_id = md.sub_menu_item_id) WHERE m.sub_menu_item_id = '". (int) $sub_item_id ."' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getSubItemDescriptionById($sub_item_id) {
        $menu_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megamenu_sub_item_description WHERE sub_menu_item_id = '" . (int) $sub_item_id . "'");

        foreach ($query->rows as $result) {
            $menu_description_data[$result['language_id']] = $result['title'];
        }

        return $menu_description_data;
    }

    public function getMenu($menu_id) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "megamenu` WHERE menu_id = '" . (int)$menu_id . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getMenuList($data = array()) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "megamenu`";

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

    public function getMenuCount() {
        $sql = "SELECT COUNT(menu_id) AS total FROM `" . DB_PREFIX . "megamenu`";

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTopCategories() {
        $category_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category WHERE top = 1 AND parent_id = 0");

        foreach ($query->rows as $result) {
            $category_data[] = $result['category_id'];
        }

        return $category_data;
    }

    public function getCategories($parent_id = 0) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

        return $query->rows;
    }

    public function getAllCategories($data = array()) {
        $sql = "SELECT cp.category_id AS category_id, cd2.name AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND cd2.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sql .= " GROUP BY cp.category_id";

        $sort_data = array(
            'name',
            'sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY sort_order";
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

    public function deleteMenuData() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "megamenu_sub_item_description`;");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "megamenu_sub_item`;");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "megamenu_top_item_description`;");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "megamenu_top_item`;");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "megamenu`;");
    }

    public function getLanguageByCode($language_code) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE code = '" . $this->db->escape($language_code) . "'");

        return $query->row;
    }
}