<?php
class ControllerBlogAll extends Controller {
	public function index() {
		$this->load->language('blog/all');

		$this->load->model('blog/blog');
		
		$this->load->model('tool/image');
		
		if (isset($this->request->get['filter_blog'])) {
			$filter_blog = $this->request->get['filter_blog'];
		} else {
			$filter_blog = '';
		}
		
		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['filter_blog'])) {
			$tag = $this->request->get['filter_blog'];
		} else {
			$tag = '';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('cms_blog_items_per_page');
		}
		
		if (isset($this->request->get['filter_blog'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['filter_blog']);
		} elseif (isset($this->request->get['tag'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->language->get('heading_tag') . $this->request->get['tag']);
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		
		
		$url = '';

		if (isset($this->request->get['filter_blog'])) {
			$url .= '&filter_blog=' . urlencode(html_entity_decode($this->request->get['filter_blog'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['tag'])) {
			$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_blog'),
			'href' => $this->url->link('blog/all', $url)
		);
		
		if (isset($this->request->get['filter_blog'])) {
			$data['heading_title'] = $this->language->get('heading_title') .  ' - ' . $this->request->get['filter_blog'];
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
		}
		
		$blog_description = $this->config->get('cms_blog_description');

		$this->document->setTitle($blog_description[(int)$this->config->get('config_language_id')]['meta_title']);
		$this->document->setDescription($blog_description[(int)$this->config->get('config_language_id')]['meta_description']);
		$this->document->setKeywords($blog_description[(int)$this->config->get('config_language_id')]['meta_keyword']);
		$this->document->addLink($this->url->link('blog/all', ''), 'canonical');
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_blog'] = $this->language->get('text_blog');
		$data['text_written_by'] = $this->language->get('text_written_by');
		$data['text_published_in'] = $this->language->get('text_published_in');
		$data['text_created_date'] = $this->language->get('text_created_date');
		$data['text_hits'] = $this->language->get('text_hits');
		$data['text_comment_count'] = $this->language->get('text_comment_count');
		$data['text_blog_category'] = $this->language->get('text_blog_category');
		$data['text_readmore'] = $this->language->get('text_readmore');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['blogs'] = array();

		$filter_data = array(
		    'filter_name'         => $filter_blog,
			'filter_tag'          => $tag,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$blog_total = $this->model_blog_blog->getTotalBlogs($filter_data);

		$results = $this->model_blog_blog->getBlogs($filter_data);

		foreach ($results as $result) {
			
			if ($result['image']) {
				
				if($this->config->get('cms_blog_category_leading_image_type') == 'l') {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_blog_large_image_width'), $this->config->get('cms_blog_large_image_height'));
				}elseif($this->config->get('cms_blog_category_leading_image_type') == 'm') {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_blog_middle_image_width'), $this->config->get('cms_blog_middle_image_height'));
				}else{
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_blog_small_image_width'), $this->config->get('cms_blog_small_image_height'));
				}
			} else {
				$image = '';
			}
			
			
			$blog_categories = $this->model_blog_blog->getBlogCategoriesByBlogId($result['blog_id']);
			
			if ($blog_categories) {
				$categories = $blog_categories;
			} else {
				$categories = array();
			}
			
			$users = $this->model_blog_blog->getUsers();
			
			$this->load->model('blog/comment');
				
			$comment_count = $this->model_blog_comment->getTotalCommentsByBlogId($result['blog_id']);
					
			$data['blogs'][] = array(
				'blog_id'  	   		=> $result['blog_id'],
				'thumb'       		=> $image,
				'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
				'brief' 	   		=> html_entity_decode($result['brief'], ENT_QUOTES, 'UTF-8'),
				'tags' 	   	   		=> explode(',', $result['tags']),
				'blog_category_id'  => $categories,
				'created'  	   		=> date($this->language->get('date_format_short'), strtotime($result['created'])),
				'status'  	   		=> $result['status'],
				'author'  	   		=> isset($users[$result['user_id']])?$users[$result['user_id']]:$this->language->get('text_none_author'),
				'comment_count'		=> $comment_count,
				'hits'  	   		=> $result['hits'],
				'image'  	   		=> $result['image'],
				'video_code'   		=> $result['video_code'],
				'featured'     		=> $result['featured'],
				'sort_order'   		=> $result['sort_order'],
				'date_added'   		=> $result['date_added'],
				'date_modified' 	=> $result['date_modified'],
				'link'				=> $this->url->link('blog/blog', 'blog_id='.$result['blog_id'], true),
			
				
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
		
		// Blog Category Menu
		$this->load->model('blog/category');

		$data['categories'] = array();

		$categories = $this->model_blog_category->getBlogCategories(0);

		foreach ($categories as $category) {

			// Level 2
			$children_data = array();
	
			$children = $this->model_blog_category->getBlogCategories($category['blog_category_id']);
	
			foreach ($children as $child) {
	
				$children_data[] = array(
					'name'  => $child['name'],
					'href'  => $this->url->link('blog/category', 'way=' . $category['blog_category_id'] . '_' . $child['blog_category_id'])
				);
			}
	
			// Level 1
			$data['categories'][] = array(
				'name'     => $category['name'],
				'children' => $children_data,
				'href'     => $this->url->link('blog/category', 'way=' . $category['blog_category_id'])
			);
			
		}
		
		

		$url = '';

		if (isset($this->request->get['filter_blog'])) {
			$url .= '&filter_blog=' . urlencode(html_entity_decode($this->request->get['filter_blog'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['tag'])) {
			$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}


		$pagination = new Pagination();
		$pagination->total = $blog_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('blog/all', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($blog_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($blog_total - $limit)) ? $blog_total : ((($page - 1) * $limit) + $limit), $blog_total, ceil($blog_total / $limit));

		$data['continue'] = $this->url->link('blog/all');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('blog/all', $data));
		
	}
}