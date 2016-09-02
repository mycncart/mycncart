<?php
class ControllerExtensionModuleBlogComment extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/blog_comment');

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('blog/comment');


		$data['comments'] = array();

		$filter_data = array(
			'sort'  => 'r.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_blog_comment->getComments($filter_data);

		if ($results) {
			foreach ($results as $result) {
				
				$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				

				$data['comments'][] = array(
					'comment_id'  => $result['blog_comment_id'],
					'thumb'       => $image,
					'author'      => $result['author'],
					'name'        => $result['title'],
					'text' => utf8_substr(strip_tags(html_entity_decode($result['text'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('cms_blog_comment_length')) . '..',
					'href'        => $this->url->link('blog/blog', 'blog_id=' . $result['blog_id'])
				);
			}

			return $this->load->view('extension/module/blog_comment', $data);
			
		}
	}
}
