<?php
class ControllerPressPress extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('press/press');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_press'),
			'href' => $this->url->link('press/all')
		);


		if (isset($this->request->get['press_id'])) {
			$press_id = (int)$this->request->get['press_id'];
		} else {
			$press_id = 0;
		}

		$this->load->model('press/press');
		$this->load->model('tool/image');

		$press_info = $this->model_press_press->getPress($press_id);

		if ($press_info) {
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
				'text' => $press_info['title'],
				'href' => $this->url->link('press/press', $url . '&press_id=' . $this->request->get['press_id'])
			);

			$this->document->setTitle($press_info['meta_title']);
			$this->document->setDescription($press_info['meta_description']);
			$this->document->setKeywords($press_info['meta_keyword']);
			$this->document->addLink($this->url->link('press/press', 'press_id=' . $this->request->get['press_id']), 'canonical');
			$data['heading_title'] = $press_info['title'];
			
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_press'] = $this->language->get('text_press');
			$data['text_written_by'] = $this->language->get('text_written_by');
			$data['text_published_in'] = $this->language->get('text_published_in');
			$data['text_created_date'] = $this->language->get('text_created_date');
			$data['text_hits'] = $this->language->get('text_hits');
			$data['text_comment_count'] = $this->language->get('text_comment_count');
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_loading'] = $this->language->get('text_loading');
			$data['text_press_category'] = $this->language->get('text_press_category');
			$data['text_tags'] = $this->language->get('text_tags');
			
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_comment'] = $this->language->get('entry_comment');
			
			$data['button_continue'] = $this->language->get('button_continue');
			
			$data['logged'] = $this->customer->isLogged();
			
			$data['press_id'] = $this->request->get['press_id'];
			
			if($this->customer->isLogged()) {
				$data['name'] = $this->customer->getFullName();
			}else{
				$data['name'] = '';
			}
			
			$this->load->model('press/comment');
				
			$data['comment_count'] = $this->model_press_comment->getTotalCommentsByPressId($this->request->get['press_id']);
			
			if ($press_info['image']) {
				
				if($this->config->get('cms_press_image_type') == 'l') {
					$data['thumb'] = $this->model_tool_image->resize($press_info['image'], $this->config->get('cms_press_large_image_width'), $this->config->get('cms_press_large_image_height'));
				}elseif($this->config->get('cms_press_image_type') == 'm') {
					$data['thumb'] = $this->model_tool_image->resize($press_info['image'], $this->config->get('cms_press_middle_image_width'), $this->config->get('cms_press_middle_image_height'));
				}else{
					$data['thumb'] = $this->model_tool_image->resize($press_info['image'], $this->config->get('cms_press_small_image_width'), $this->config->get('cms_press_small_image_height'));
				}
			} else {
				$data['thumb'] = '';
			}
			
			$users = $this->model_press_press->getUsers();

			$data['title']        		= html_entity_decode($press_info['title'], ENT_QUOTES, 'UTF-8');
			$data['brief'] 	   			= html_entity_decode($press_info['brief'], ENT_QUOTES, 'UTF-8');
			$data['tags'] 	   	   		= explode(',', $press_info['tags']);
			$data['created']  	   		= $press_info['created'];
			$data['status']  	   		= $press_info['status'];
			$data['author']  	   		= isset($users[$press_info['user_id']])?$users[$press_info['user_id']]:$this->language->get('text_none_author');
			$data['hits']  	   			= $press_info['hits'];
			$data['image']  	   		= $press_info['image'];
			$data['video_code']   		= $press_info['video_code'];
			$data['featured']     		= $press_info['featured'];
			$data['sort_order']   		= $press_info['sort_order'];
			$data['date_added']   		= $press_info['date_added'];
			$data['date_modified'] 		= $press_info['date_modified'];
			$data['description'] 		= html_entity_decode($press_info['description'], ENT_QUOTES, 'UTF-8');
			
			
			$data['cms_press_image_type'] = $this->config->get('cms_press_image_type');
			$data['cms_press_show_title'] = $this->config->get('cms_press_show_title');
			$data['cms_press_show_image'] = $this->config->get('cms_press_show_image');
			$data['cms_press_show_author'] = $this->config->get('cms_press_show_author');
			$data['cms_press_show_created_date'] = $this->config->get('cms_press_show_created_date');
			$data['cms_press_show_hits'] = $this->config->get('cms_press_show_hits');
			$data['cms_press_show_comment_counter'] = $this->config->get('cms_press_show_comment_counter');
			$data['cms_press_show_comment_form'] = $this->config->get('cms_press_show_comment_form');
			$data['cms_press_show_auto_publish_comment'] = $this->config->get('cms_press_show_auto_publish_comment');
			$data['cms_press_show_recaptcha'] = $this->config->get('cms_press_show_recaptcha');
			$data['cms_press_show_need_login_to_comment'] = $this->config->get('cms_press_show_need_login_to_comment');
			
				

			
			$data['comment_status'] = $this->config->get('cms_press_show_comment_form');

			if ($this->config->get('cms_press_show_need_login_to_comment')) {
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

			//$data['comments'] = sprintf($this->language->get('text_comments'), (int)$press_info['comments']);

			// Captcha
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('comment', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}


			$data['products'] = array();

			$results = $this->model_press_press->getPressProductRelated($this->request->get['press_id']);

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

			if ($press_info['tags']) {
				$tags = explode(',', $press_info['tags']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('press/all', 'tag=' . trim($tag))
					);
				}
			}


			$this->model_press_press->updateViewed($this->request->get['press_id']);
			
			// Press Category Menu
			$this->load->model('press/category');
	
			$data['categories'] = array();
	
			$categories = $this->model_press_category->getPressCategories(0);
	
			foreach ($categories as $category) {
	
				// Level 2
				$children_data = array();
		
				$children = $this->model_press_category->getPressCategories($category['press_category_id']);
		
				foreach ($children as $child) {
		
					$children_data[] = array(
						'name'  => $child['name'],
						'href'  => $this->url->link('press/category', 'way=' . $category['press_category_id'] . '_' . $child['press_category_id'])
					);
				}
		
				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'href'     => $this->url->link('press/category', 'way=' . $category['press_category_id'])
				);
				
			}

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/press/press.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/press/press.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/press/press.tpl', $data));
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
				'href' => $this->url->link('press/press', $url . '&press_id=' . $press_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('press/all');

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
		$this->load->language('press/press');

		$this->load->model('press/comment');

		$data['text_no_comments'] = $this->language->get('text_no_comments');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['comments'] = array();

		$comment_total = $this->model_press_comment->getTotalCommentsByPressId($this->request->get['press_id']);

		$results = $this->model_press_comment->getCommentsByPressId($this->request->get['press_id'], ($page - 1) * 5, 5);

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
		$pagination->url = $this->url->link('press/press/comment', 'press_id=' . $this->request->get['press_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($comment_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($comment_total - 5)) ? $comment_total : ((($page - 1) * 5) + 5), $comment_total, ceil($comment_total / 5));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/press/comment.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/press/comment.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/press/comment.tpl', $data));
		}
	}

	public function write() {
		$this->load->language('press/press');

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
				$this->load->model('press/comment');

				$this->model_press_comment->addComment($this->request->get['press_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
