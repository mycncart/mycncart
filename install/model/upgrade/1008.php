<?php
class ModelUpgrade1008 extends Model {
	public function upgrade() {
		// setting
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `key` = 'cms_blog_items_per_page'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `key` = 'cms_blog_items_per_page', `value` = '10', `code` = 'cms_blog', `store_id` = 0");
		}
		
		// setting
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `key` = 'cms_press_items_per_page'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `key` = 'cms_press_items_per_page', `value` = '10', `code` = 'cms_press', `store_id` = 0");
		}
		
		// setting
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `key` = 'cms_faq_items_per_page'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `key` = 'cms_faq_items_per_page', `value` = '10', `code` = 'cms_faq', `store_id` = 0");
		}
	}
	
}