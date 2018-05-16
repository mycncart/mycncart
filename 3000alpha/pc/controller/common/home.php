<?php
class ControllerCommonHome extends Controller {
	public function index() {

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		echo "Hello PC";
		exit;

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
