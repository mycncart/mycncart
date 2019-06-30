<?php
class ModelDesignMenu extends Model {
    public function getMenuById($menu_id) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "menu` WHERE menu_id = '" . (int)$menu_id . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getTopItems($menu_id) {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "menu_top_item` m WHERE m.menu_id = '". (int) $menu_id ."' ORDER BY m.position ASC";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTopItemDescriptionById($menu_item_id) {
        $menu_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_top_item_description WHERE menu_item_id = '" . (int)$menu_item_id . "'");

        foreach ($query->rows as $result) {
            $menu_description_data[$result['language_id']] = $result['title'];
        }

        return $menu_description_data;
    }

    public function getSubItems($parent_item_id, $level) {
        $sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "menu_sub_item` m WHERE m.parent_menu_item_id = '". (int) $parent_item_id ."' AND m.level = '" . (int) $level . "' ORDER BY m.position ASC";

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getSubItemDescriptionById($sub_item_id) {
        $menu_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_sub_item_description WHERE sub_menu_item_id = '" . (int) $sub_item_id . "'");

        foreach ($query->rows as $result) {
            $menu_description_data[$result['language_id']] = $result['title'];
        }

        return $menu_description_data;
    }

    public function getLanguageByCode($language_code) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE code = '" . $this->db->escape($language_code) . "'");

        return $query->row;
    }
}