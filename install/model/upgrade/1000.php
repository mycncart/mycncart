<?php
class ModelUpgrade1000 extends Model {
	public function upgrade() {
		
		// zone_to_geo_zone
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "zone_to_geo_zone` ADD `city_id` INT NOT NULL AFTER `zone_id` , ADD `district_id` INT NOT NULL AFTER `city_id`");
		
		// address
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "address` ADD `city_id` INT NOT NULL AFTER `zone_id`, ADD `district_id` INT NOT NULL AFTER `city_id`");
		
		// order
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `payment_city_id` INT NOT NULL AFTER `payment_city`");
		
		// order
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `payment_district` VARCHAR( 128 ) NOT NULL AFTER `payment_address`, ADD `payment_district_id` INT NOT NULL AFTER `payment_district`");
		
		// order
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `shipping_city_id` INT NOT NULL AFTER `shipping_city`");
		
		// order
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `shipping_district` VARCHAR( 128 ) NOT NULL AFTER `shipping_address`, ADD `shipping_district_id` INT NOT NULL AFTER `shipping_district`");
		
		// order
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `payment_telephone` VARCHAR( 32 ) NOT NULL AFTER `payment_code`");
		
		// affiliate
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "affiliate` ADD `city_id` INT NOT NULL AFTER `zone_id` , ADD `district_id` INT NOT NULL AFTER `city_id`");
		

	}
}