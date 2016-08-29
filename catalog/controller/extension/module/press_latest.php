<?php
class ControllerExtensionModulePressLatest extends Controller {
	public function index() {
		$this->load->language('extension/module/press_latest');

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('press/press');

		$this->load->model('tool/image');

		$data['presses'] = array();

		$filter_data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 5
		);

		$results = $this->model_press_press->getPresses($filter_data);

		if ($results) {
			foreach ($results as $result) {

				$data['presses'][] = array(
					'press_id'  => $result['press_id'],
					'name'        => $result['title'],
					'href'        => $this->url->link('press/press', 'press_id=' . $result['press_id'])
				);
			}

			return $this->load->view('extension/module/press_latest', $data);
			
		}
	}
}
