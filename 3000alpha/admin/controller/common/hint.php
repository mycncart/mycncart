<?php
class ControllerCommonHint extends Controller {
	public function index() {
		if (isset($this->request->get['user_token']) && isset($this->session->data['user_token']) && ((string)$this->request->get['user_token'] == $this->session->data['user_token'])) {
			$this->load->language('common/hint');

			echo $this->route();
			exit;

			return $this->load->view('common/hint', $data);
		}
	}
}
