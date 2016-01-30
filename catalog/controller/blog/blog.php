<?php
class ControllerBlogBlog extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('blog/blog');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_blog'),
			'href' => $this->url->link('blog/all')
		);


		if (isset($this->request->get['blog_id'])) {
			$blog_id = (int)$this->request->get['blog_id'];
		} else {
			$blog_id = 0;
		}

		$this->load->model('blog/blog');
		$this->load->model('tool/image');

		$blog_info = $this->model_blog_blog->getBlog($blog_id);

		if ($blog_info) {
			$url = '';

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $blog_info['title'],
				'href' => $this->url->link('blog/blog', $url . '&blog_id=' . $this->request->get['blog_id'])
			);

			$this->document->setTitle($blog_info['meta_title']);
			$this->document->setDescription($blog_info['meta_description']);
			$this->document->setKeywords($blog_info['meta_keyword']);
			$this->document->addLink($this->url->link('blog/blog', 'blog_id=' . $this->request->get['blog_id']), 'canonical');
			$data['heading_title'] = $blog_info['title'];
			
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_blog'] = $this->language->get('text_blog');
			$data['text_written_by'] = $this->language->get('text_written_by');
			$data['text_published_in'] = $this->language->get('text_published_in');
			$data['text_created_date'] = $this->language->get('text_created_date');
			$data['text_hits'] = $this->language->get('text_hits');
			$data['text_comment_count'] = $this->language->get('text_comment_count');
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_loading'] = $this->language->get('text_loading');
			$data['text_blog_category'] = $this->language->get('text_blog_category');
			
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_comment'] = $this->language->get('entry_comment');
			
			$data['button_continue'] = $this->language->get('button_continue');
			
			$data['blog_id'] = $this->request->get['blog_id'];
			
			//$comment_count = $this->model_blog_blog->getBlogTotalComments($result['blog_id']);
			$data['comment_count'] = 0;
			
			if ($blog_info['image']) {
				
				if($this->config->get('cms_blog_image_type') == 'l') {
					$data['thumb'] = $this->model_tool_image->resize($blog_info['image'], $this->config->get('cms_blog_large_image_width'), $this->config->get('cms_blog_large_image_height'));
				}elseif($this->config->get('cms_blog_image_type') == 'm') {
					$data['thumb'] = $this->model_tool_image->resize($blog_info['image'], $this->config->get('cms_blog_middle_image_width'), $this->config->get('cms_blog_middle_image_height'));
				}else{
					$data['thumb'] = $this->model_tool_image->resize($blog_info['image'], $this->config->get('cms_blog_small_image_width'), $this->config->get('cms_blog_small_image_height'));
				}
			} else {
				$data['thumb'] = '';
			}
			
			$users = $this->model_blog_blog->getUsers();

			$data['title']        		= html_entity_decode($blog_info['title'], ENT_QUOTES, 'UTF-8');
			$data['brief'] 	   			= html_entity_decode($blog_info['brief'], ENT_QUOTES, 'UTF-8');
			$data['tags'] 	   	   		= explode(',', $blog_info['tags']);
			$data['created']  	   		= $blog_info['created'];
			$data['status']  	   		= $blog_info['status'];
			$data['author']  	   		= isset($users[$blog_info['user_id']])?$users[$blog_info['user_id']]:$this->language->get('text_none_author');
			$data['hits']  	   			= $blog_info['hits'];
			$data['image']  	   		= $blog_info['image'];
			$data['video_code']   		= $blog_info['video_code'];
			$data['featured']     		= $blog_info['featured'];
			$data['sort_order']   		= $blog_info['sort_order'];
			$data['date_added']   		= $blog_info['date_added'];
			$data['date_modified'] 		= $blog_info['date_modified'];
			$data['description'] 		= html_entity_decode($blog_info['description'], ENT_QUOTES, 'UTF-8');
			
			
			$data['cms_blog_image_type'] = $this->config->get('cms_blog_image_type');
			$data['cms_blog_show_title'] = $this->config->get('cms_blog_show_title');
			$data['cms_blog_show_image'] = $this->config->get('cms_blog_show_image');
			$data['cms_blog_show_author'] = $this->config->get('cms_blog_show_author');
			$data['cms_blog_show_created_date'] = $this->config->get('cms_blog_show_created_date');
			$data['cms_blog_show_hits'] = $this->config->get('cms_blog_show_hits');
			$data['cms_blog_show_comment_counter'] = $this->config->get('cms_blog_show_comment_counter');
			$data['cms_blog_show_comment_form'] = $this->config->get('cms_blog_show_comment_form');
			$data['cms_blog_show_auto_publish_comment'] = $this->config->get('cms_blog_show_auto_publish_comment');
			$data['cms_blog_show_recaptcha'] = $this->config->get('cms_blog_show_recaptcha');
			$data['cms_blog_show_need_login_to_comment'] = $this->config->get('cms_blog_show_need_login_to_comment');
			
				

			
			$data['comment_status'] = $this->config->get('cms_blog_show_comment_form');

			if ($this->config->get('cms_blog_show_need_login_to_comment')) {
				$data['comment_guest'] = false;
			} else {
				$data['comment_guest'] = true;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFullName();
			} else {
				$data['customer_name'] = '';
			}
			
			if ($this->customer->isLogged()) {
				$data['customer_email'] = $this->customer->getEmail();
			} else {
				$data['customer_email'] = '';
			}

			//$data['comments'] = sprintf($this->language->get('text_comments'), (int)$blog_info['comments']);

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('comment', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}


			$data['products'] = array();

			$results = $this->model_blog_blog->getBlogProductRelated($this->request->get['blog_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			$data['tags'] = array();

			if ($blog_info['tags']) {
				$tags = explode(',', $blog_info['tags']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('blog/search', 'tag=' . trim($tag))
					);
				}
			}


			$this->model_blog_blog->updateViewed($this->request->get['blog_id']);
			
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
						'href'  => $this->url->link('blog/category', 'path=' . $category['blog_category_id'] . '_' . $child['blog_category_id'])
					);
				}
		
				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'href'     => $this->url->link('blog/category', 'path=' . $category['blog_category_id'])
				);
				
			}

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/blog.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/blog.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/blog/blog.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('blog/blog', $url . '&blog_id=' . $blog_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('blog/all');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function comment() {
		$this->load->language('blog/blog');

		$this->load->model('blog/comment');

		$data['text_no_comments'] = $this->language->get('text_no_comments');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['comments'] = array();

		$comment_total = $this->model_blog_comment->getTotalCommentsByBlogId($this->request->get['blog_id']);

		$results = $this->model_blog_comment->getCommentsByBlogId($this->request->get['blog_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['comments'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $comment_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('blog/blog/comment', 'blog_id=' . $this->request->get['blog_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($comment_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($comment_total - 5)) ? $comment_total : ((($page - 1) * 5) + 5), $comment_total, ceil($comment_total / 5));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/blog/comment.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/blog/comment.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/blog/comment.tpl', $data));
		}
	}

	public function write() {
		$this->load->language('blog/blog');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 1) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('comment', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if (!isset($json['error'])) {
				$this->load->model('blog/comment');

				$this->model_blog_comment->addComment($this->request->get['blog_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
