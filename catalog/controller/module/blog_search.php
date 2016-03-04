<?php
class ControllerModuleBlogSearch extends Controller {
	public function index() {
		$this->load->language('module/blog_search');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->document->addScript('catalog/view/javascript/blog.js');

		$data['text_blog_search'] = $this->language->get('text_blog_search');
		
		if (isset($this->request->get['filter_blog'])) {
			$data['filter_blog'] = $this->request->get['filter_blog'];
		} else {
			$data['filter_blog'] = '';
		}
		
		$data['action'] = $this->url->link('blog/all', '', true);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/blog_search')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/blog_search', $data);
		} else {
			return $this->load->view('default/template/module/blog_search', $data);
		}
	}
}