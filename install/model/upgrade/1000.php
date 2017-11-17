<?php
class ModelUpgrade1000 extends Model {
	public function upgrade() {
		// attribute
		$query = $this->db->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME = '" . DB_PREFIX . "attribute'");
		
		if ($query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute` CHANGE `attribute_id` `attribute_id` INT(11) NOT NULL AUTO_INCREMENT;");
		}
		
		// attribute_group
		$query = $this->db->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME = '" . DB_PREFIX . "attribute_group'");
		
		if ($query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group` CHANGE `attribute_group_id` `attribute_group_id` INT(11) NOT NULL AUTO_INCREMENT;");
		}
		
		// Setting
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `code` = 'total_sub_total', `value` = '1', `key` = 'total_sub_total_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_coupon', `value` = '4' WHERE `code` = 'total_coupon' AND `key` = 'total_coupon_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_credit', `value` = '7' WHERE `code` = 'total_credit' AND `key` = 'total_credit_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_total', `value` = '9' WHERE `code` = 'total_total' AND `key` = 'total_total_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_shipping', `value` = '3' WHERE `code` = 'total_shipping' AND `key` = 'total_shipping_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_tax', `value` = '5' WHERE `code` = 'total_tax' AND `key` = 'total_tax_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_voucher', `value` = '8' WHERE `code` = 'total_voucher' AND `key` = 'total_voucher_sort_order'");
		
		$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `code` = 'total_reward', `value` = '2' WHERE `code` = 'total_reward' AND `key` = 'total_reward_sort_order'");
		
	}
}