<?php
class ControllerBlogBlog extends Controller {
	public function index() {
		$this->load->language('blog/blog');

		$this->load->model('blog/blog');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_blog'),
			'href' => $this->url->link('blog/blog', '')
		);
		
		$blog_description = $this->config->get('blog_description');

		$this->document->setTitle($blog_description[(int)$this->config->get('config_language_id')]['meta_title']);
		$this->document->setDescription($blog_description[(int)$this->config->get('config_language_id')]['meta_description']);
		$this->document->setKeywords($blog_description[(int)$this->config->get('config_language_id')]['meta_keyword']);
		$this->document->addLink($this->url->link('blog/blog', ''), 'canonical');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_blog'] = $this->language->get('text_blog');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['blogs'] = array();

		$filter_data = array(
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$blog_total = $this->model_blog_blog->getTotalBlogs($filter_data);

		$results = $this->model_blog_blog->getBlogs($filter_data);

		foreach ($results as $result) {
					
			$data['blogs'][] = array(
				'blog_id'  	   		=> $result['blog_id'],
				'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
				'brief' 	   		=> html_entity_decode($result['brief'], ENT_QUOTES, 'UTF-8'),
				'tags' 	   	   		=> explode(',', $result['tag']),
				'blog_category_id'  => $result['blog_category_id'],
				'created'  	   		=> $result['created'],
				'status'  	   		=> $result['status'],
				'user_id'  	   		=> $result['user_id'],
				'hits'  	   		=> $result['hits'],
				'image'  	   		=> $result['image'],
				'video_code'   		=> $result['video_code'],
				'featured'     		=> $result['featured'],
				'keyword'  	   		=> $result['keyword'],
				'sort_order'   		=> $result['sort_order'],
				'date_added'   		=> $result['date_added'],
				'date_modified' 	=> $result['date_modified'],
				
			);
			
		}


		$pagination = new Pagination();
		$pagination->total = $blog_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('blog/blog', 'page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($blog_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($blog_total - $limit)) ? $blog_total : ((($page - 1) * $limit) + $limit), $blog_total, ceil($blog_total / $limit));

		$data['continue'] = $this->url->link('common/home');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/template/blog.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/template/blog.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/blog/template/blog.tpl', $data));
		}
		
	}
}