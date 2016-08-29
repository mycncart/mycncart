<?php
class ControllerExtensionModuleFaqCategory extends Controller {
	public function index() {
		$this->load->language('extension/module/faq_category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['line'])) {
			$parts = explode('_', (string)$this->request->get['line']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['faq_category_id'] = $parts[0];
		} else {
			$data['faq_category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('faq/category');

		$this->load->model('faq/faq');

		$data['faq_categories'] = array();

		$faq_categories = $this->model_faq_category->getFaqCategories(0);

		foreach ($faq_categories as $faq_category) {
			$children_data = array();

			if ($faq_category['faq_category_id'] == $data['faq_category_id']) {
				$children = $this->model_faq_category->getFaqCategories($faq_category['faq_category_id']);

				foreach($children as $child) {

					$children_data[] = array(
						'faq_category_id' => $child['faq_category_id'], 
						'name' => $child['name'], 
						'href' => $this->url->link('faq/category', 'line=' . $faq_category['faq_category_id'] . '_' . $child['faq_category_id'])
					);
				}
			}

			$data['faq_categories'][] = array(
				'faq_category_id' => $faq_category['faq_category_id'],
				'name'        => $faq_category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('faq/category', 'line=' . $faq_category['faq_category_id'])
			);
		}

		return $this->load->view('extension/module/faq_category', $data);
		
	}
}