<?php
class ModelReportVisitor extends Model {
	public function getVisitors($data = array()) {
		$sql = "SELECT *, (SELECT s.name FROM `" . DB_PREFIX . "store` s WHERE s.store_id = v.store_id) AS store FROM " . DB_PREFIX . "visitor v";

		$implode = array();

		if (!empty($data['filter_ip'])) {
			$implode[] = "v.ip LIKE '%" . $this->db->escape($data['filter_ip']) . "%'";
		}

		if ($data['filter_product_id']) {
			$implode[] = "v.product_id = '" . (int)$data['filter_product_id'] . "'";
		}

		if ($data['filter_store_id'] != '') {
			$implode[] = "v.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}



		$sql .= " ORDER BY v.visitor_id DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		//echo $sql;exit;

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalVisitors($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "visitor` v";

		$implode = array();

		if (!empty($data['filter_ip'])) {
			$implode[] = "v.ip LIKE '%" . $this->db->escape($data['filter_ip']) . "%'";
		}

		if ($data['filter_product_id']) {
			$implode[] = "v.product_id = '" . (int)$data['filter_product_id'] . "'";
		}

		if ($data['filter_store_id'] != '') {
			$implode[] = "v.store_id = '" . (int)$data['filter_store_id'] . "'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getBlockInfo($ip) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blockip WHERE ip LIKE '".$ip."'");

		return $query->row;
	}

	public function addIP($ip) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "blockip SET ip = '" . $this->db->escape($ip) . "'");		
	}

	public function deleteIP($ip) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "blockip WHERE ip LIKE '" . $this->db->escape($ip) . "'");
	}

}