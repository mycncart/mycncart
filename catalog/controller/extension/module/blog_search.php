<?php
class ControllerExtensionModuleBlogSearch extends Controller {
	public function index() {
		$this->load->language('extension/module/blog_search');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->document->addScript('catalog/view/javascript/blog.js');

		$data['text_blog_search'] = $this->language->get('text_blog_search');
		
		if (isset($this->request->get['filter_blog'])) {
			$data['filter_blog'] = $this->request->get['filter_blog'];
		} else {
			$data['filter_blog'] = '';
		}
		
		$data['action'] = $this->url->link('blog/all', '', true);

		return $this->load->view('extension/module/blog_search', $data);
		
	}
}