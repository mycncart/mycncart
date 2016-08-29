<?php
class ControllerExtensionModuleBlogCategory extends Controller {
	public function index() {
		$this->load->language('extension/module/blog_category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['way'])) {
			$parts = explode('_', (string)$this->request->get['way']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['blog_category_id'] = $parts[0];
		} else {
			$data['blog_category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('blog/category');

		$this->load->model('blog/blog');

		$data['blog_categories'] = array();

		$blog_categories = $this->model_blog_category->getBlogCategories(0);

		foreach ($blog_categories as $blog_category) {
			$children_data = array();

			$children = $this->model_blog_category->getBlogCategories($blog_category['blog_category_id']);

			foreach($children as $child) {

				$children_data[] = array(
					'blog_category_id' => $child['blog_category_id'], 
					'name' => $child['name'], 
					'href' => $this->url->link('blog/category', 'way=' . $blog_category['blog_category_id'] . '_' . $child['blog_category_id'])
				);
			}

			$data['blog_categories'][] = array(
				'blog_category_id' => $blog_category['blog_category_id'],
				'name'        => $blog_category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('blog/category', 'way=' . $blog_category['blog_category_id'])
			);
		}

		return $this->load->view('extension/module/blog_category', $data);
		
	}
}