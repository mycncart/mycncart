<?php
class ControllerStartupUpgrade extends Controller {
	public function index() {
		$upgrade = false;
		
		if (is_file(DIR_MYCNCART . 'config.php') && filesize(DIR_MYCNCART . 'config.php') > 0) {
			$upgrade = true;
		}
		
		if (isset($this->request->get['route'])) {
			if (($this->request->get['route'] == 'install/step_4') || (substr($this->request->get['route'], 0, 8) == 'upgrade/') || (substr($this->request->get['route'], 0, 10) == '3rd_party/')) {
				$upgrade = false;
			}
		}
		
		if ($upgrade) {
			echo "You have installed MyCnCart!";
		}
	}
}