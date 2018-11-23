<?php
require_once 'simpledata'.DIRECTORY_SEPARATOR.'pagebuilder.php';
class ModelExtensionModulePageBuilder extends Model {
	public function getModuleId() {
		$sql = " SHOW TABLE STATUS LIKE '" . DB_PREFIX . "module'" ;
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getCategories($data = array()) {
		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c1.status=1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
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
	
	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) WHERE cp.category_id = c.category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = 1");

		return $query->row;
	}
	
	public function getInstalled($type) {
		$extension_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "' ORDER BY code");

		foreach ($query->rows as $result) {
			$extension_data[] = $result['code'];
		}

		return $extension_data;
	}
	
	public function groups() {
		$this->load->language('module/page_builder');
		return array(
			 'content' 		=> $this->language->get('group_content'),
			 'box' 			=> $this->language->get('group_box'),
			 "media" 		=> $this->language->get('group_media'),
			 'gallery' 		=> $this->language->get('group_gallery'),
			 'other' 		=> $this->language->get('group_other'),
		 );
	}
	
	public function importSimpleData($theme,$dataExtensions){
		$setting = '';
		switch ($theme){
			case "1":
				$setting = pageSportbike($dataExtensions);
				$namePage = 'Page Builder - Sportbike';
			break;
			case "2":
				$setting = pageComputer($dataExtensions);
				$namePage = 'Page Builder - Computer';
			break;
			case "3":
				$setting = pageFurniture($dataExtensions);
				$namePage = 'Page Builder - Furniture';
			break;
			case "4":
				$setting = pageFashion($dataExtensions);
				$namePage = 'Page Builder - Fashion';
			break;
			case "5":
				$setting = pageLanding($dataExtensions);
				$namePage = 'Page Builder - Landing';
			break;
			case "6":
				$setting = pageFaq($dataExtensions);
				$namePage = 'Page Builder - Faq';
			break;
			case "7":
				$setting = pagePricing($dataExtensions);
				$namePage = 'Page Builder - Pricing Table';
			break;
		}
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "module` SET `name` = '" . $this->db->escape($namePage) . "', `code` = '" . $this->db->escape('page_builder') . "', `setting` = '" . $this->db->escape($setting) . "'");
		return $setting;
	}

	public function duplicateModule($module_id) {
		/*Get Data Module ID*/
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module` WHERE `module_id` = '" . (int)$module_id . "'");
		$data_name 		= $query->row['name']." ".$this->generateRandomString();
		$data_code 		= $query->row['code'];
		$data_setting 	= $query->row['setting'];
		/* Add Module Id New*/
		$this->db->query("INSERT INTO `" . DB_PREFIX . "module` SET `name` = '" . $this->db->escape($data_name) . "', `code` = '" . $this->db->escape($data_code) . "', `setting` = '" . $this->db->escape($data_setting) . "'");
		return $query;
	}
	
	function generateRandomString($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
?>