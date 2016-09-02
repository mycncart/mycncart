<?php
class ControllerExtensionModulePressCategory extends Controller {
	public function index() {
		$this->load->language('extension/module/press_category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['road'])) {
			$parts = explode('_', (string)$this->request->get['road']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['press_category_id'] = $parts[0];
		} else {
			$data['press_category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('press/category');

		$this->load->model('press/press');

		$data['press_categories'] = array();

		$press_categories = $this->model_press_category->getPressCategories(0);

		foreach ($press_categories as $press_category) {
			$children_data = array();

			$children = $this->model_press_category->getPressCategories($press_category['press_category_id']);
  
			foreach($children as $child) {
  
				$children_data[] = array(
					'press_category_id' => $child['press_category_id'], 
					'name' => $child['name'], 
					'href' => $this->url->link('press/category', 'road=' . $press_category['press_category_id'] . '_' . $child['press_category_id'])
				);
			}

			$data['press_categories'][] = array(
				'press_category_id' => $press_category['press_category_id'],
				'name'        => $press_category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('press/category', 'road=' . $press_category['press_category_id'])
			);
		}

		return $this->load->view('extension/module/press_category', $data);
		
	}
}