<?php
class ControllerBlogBlog extends Controller {
	public function index() {
		$this->load->language('blog/blog');

		$this->load->model('blog/blog');
		
		$this->load->model('tool/image');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
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
			
			if ($result['image']) {
				
				if($this->config->get('cms_blog_image_type') == 'l') {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_blog_large_image_width'), $this->config->get('cms_blog_large_image_height'));
				}elseif($this->config->get('cms_blog_image_type') == 'm') {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_blog_middle_image_width'), $this->config->get('cms_blog_middle_image_height'));
				}else{
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_blog_small_image_width'), $this->config->get('cms_blog_small_image_height'));
				}
			} else {
				$image = '';
			}

					
			$data['blogs'][] = array(
				'blog_id'  	   		=> $result['blog_id'],
				'thumb'       		=> $image,
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
				'link'				=> $this->url->link('blog/blog', 'blog_id='.$result['blog_id'], 'SSL'),
			
				
			);
			
		}
		
		$data['cms_blog_large_image_width'] = $this->config->get('cms_blog_large_image_width');
		$data['cms_blog_large_image_height'] = $this->config->get('cms_blog_large_image_height');
		$data['cms_blog_middle_image_width'] = $this->config->get('cms_blog_middle_image_width');
		$data['cms_blog_middle_image_height'] = $this->config->get('cms_blog_middle_image_height');
		$data['cms_blog_small_image_width'] = $this->config->get('cms_blog_small_image_width');
		$data['cms_blog_small_image_height'] = $this->config->get('cms_blog_small_image_height');
		$data['cms_blog_category_page_show_title'] = $this->config->get('cms_blog_category_page_show_title');
		$data['cms_blog_category_page_show_brief'] = $this->config->get('cms_blog_category_page_show_brief');
		$data['cms_blog_category_page_show_readmore'] = $this->config->get('cms_blog_category_page_show_readmore');
		$data['cms_blog_category_page_show_image'] = $this->config->get('cms_blog_category_page_show_image');
		$data['cms_blog_category_page_show_author'] = $this->config->get('cms_blog_category_page_show_author');
		$data['cms_blog_category_page_show_category'] = $this->config->get('cms_blog_category_page_show_category');
		$data['cms_blog_category_page_show_created_date'] = $this->config->get('cms_blog_category_page_show_created_date');
		$data['cms_blog_category_page_show_hits'] = $this->config->get('cms_blog_category_page_show_hits');
		$data['cms_blog_category_page_show_comment_counter'] = $this->config->get('cms_blog_category_page_show_comment_counter');
		$data['cms_blog_image_type'] = $this->config->get('cms_blog_image_type');
		$data['cms_blog_show_title'] = $this->config->get('cms_blog_show_title');
		$data['cms_blog_show_image'] = $this->config->get('cms_blog_show_image');
		$data['cms_blog_show_author'] = $this->config->get('cms_blog_show_author');
		$data['cms_blog_show_category'] = $this->config->get('cms_blog_show_category');
		$data['cms_blog_show_created_date'] = $this->config->get('cms_blog_show_created_date');
		$data['cms_blog_show_hits'] = $this->config->get('cms_blog_show_hits');
		$data['cms_blog_show_comment_counter'] = $this->config->get('cms_blog_show_comment_counter');
		$data['cms_blog_show_comment_form'] = $this->config->get('cms_blog_show_comment_form');
		$data['cms_blog_show_auto_publish_comment'] = $this->config->get('cms_blog_show_auto_publish_comment');
		$data['cms_blog_show_recaptcha'] = $this->config->get('cms_blog_show_recaptcha');
		$data['cms_blog_show_need_login_to_comment'] = $this->config->get('cms_blog_show_need_login_to_comment');

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

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/all.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/all.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/blog/all.tpl', $data));
		}
		
	}
}