<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if ($this->detect->isPC()) {
	 		$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
		} else {
			//echo "Mobile Home";exit;
			//$data['mobile_content'] = $this->load->controller('common/mobile_content');
			$data['mobile_footer'] = $this->load->controller('common/mobile_footer');
			$data['mobile_header'] = $this->load->controller('common/mobile_header');
		}

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}