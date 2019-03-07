<?php
class ControllerStartupBlockIp extends Controller {
	public function index() {
		$ip = $this->getIP();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blockip WHERE ip LIKE '".$ip."'");
		if ($query->rows) {
			echo "You are forbidden to visit this website.";
			exit;
		}
	}
	
	private function getIP() {
		static $realip;
		if (isset($_SERVER)){
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
				$realip = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realip = $_SERVER["REMOTE_ADDR"];
			}
		} else {
			if (getenv("HTTP_X_FORWARDED_FOR")){
				$realip = getenv("HTTP_X_FORWARDED_FOR");
			} else if (getenv("HTTP_CLIENT_IP")) {
				$realip = getenv("HTTP_CLIENT_IP");
			} else {
				$realip = getenv("REMOTE_ADDR");
			}
		}
		return $realip;
	}
	
}
