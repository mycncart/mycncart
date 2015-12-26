<?php
class ModelAccountSmsMobile extends Model {

	public function addSmsMobile($telephone, $verify_code) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "sms_mobile SET sms_mobile = '" . $telephone . "', verify_code = '" . $verify_code . "'");
		
	}
	
	public function editSmsMobile($sms_mobile_id, $telephone, $verify_code) {
		$this->db->query("UPDATE " . DB_PREFIX . "sms_mobile SET sms_mobile = '" . $telephone . "', verify_code = '" . $verify_code . "' WHERE sms_mobile_id = '" . $sms_mobile_id . "'");

	}
	
	public function deleteSmsMobile($sms_mobile) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "sms_mobile WHERE sms_mobile = '" . $sms_mobile . "'");
	}
	
	public function getIdBySmsMobile($sms_mobile) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sms_mobile WHERE sms_mobile = '" . $sms_mobile . "'");
		

		return $query->row;
	}
	
	public function verifySmsCode($sms_mobile, $sms_code) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sms_mobile WHERE sms_mobile = '" . $sms_mobile . "' AND verify_code = '" . $sms_code . "'");

		return $query->row['total'];
	}

}