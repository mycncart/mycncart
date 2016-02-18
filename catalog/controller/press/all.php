<?php
class ControllerPressAll extends Controller {
	public function index() {
		$this->load->language('press/all');

		$this->load->model('press/press');
		
		$this->load->model('tool/image');
		
		if (isset($this->request->get['filter_press'])) {
			$filter_press = $this->request->get['filter_press'];
		} else {
			$filter_press = '';
		}
		
		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['filter_press'])) {
			$tag = $this->request->get['filter_press'];
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
			$limit = $this->config->get('config_product_limit');
		}
		
		if (isset($this->request->get['filter_press'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['filter_press']);
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

		if (isset($this->request->get['filter_press'])) {
			$url .= '&filter_press=' . urlencode(html_entity_decode($this->request->get['filter_press'], ENT_QUOTES, 'UTF-8'));
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
			'text' => $this->language->get('text_press'),
			'href' => $this->url->link('press/all', $url)
		);
		
		if (isset($this->request->get['filter_press'])) {
			$data['heading_title'] = $this->language->get('heading_title') .  ' - ' . $this->request->get['filter_press'];
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
		}
		
		$press_description = $this->config->get('cms_press_description');

		$this->document->setTitle($press_description[(int)$this->config->get('config_language_id')]['meta_title']);
		$this->document->setDescription($press_description[(int)$this->config->get('config_language_id')]['meta_description']);
		$this->document->setKeywords($press_description[(int)$this->config->get('config_language_id')]['meta_keyword']);
		$this->document->addLink($this->url->link('press/all', ''), 'canonical');
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_press'] = $this->language->get('text_press');
		$data['text_written_by'] = $this->language->get('text_written_by');
		$data['text_published_in'] = $this->language->get('text_published_in');
		$data['text_created_date'] = $this->language->get('text_created_date');
		$data['text_hits'] = $this->language->get('text_hits');
		$data['text_comment_count'] = $this->language->get('text_comment_count');
		$data['text_press_category'] = $this->language->get('text_press_category');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['presses'] = array();

		$filter_data = array(
		    'filter_name'         => $filter_press,
			'filter_tag'          => $tag,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$press_total = $this->model_press_press->getTotalPresses($filter_data);

		$results = $this->model_press_press->getPresses($filter_data);

		foreach ($results as $result) {
			
			if ($result['image']) {
				
				if($this->config->get('cms_press_image_type') == 'l') {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_press_large_image_width'), $this->config->get('cms_press_large_image_height'));
				}elseif($this->config->get('cms_press_image_type') == 'm') {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_press_middle_image_width'), $this->config->get('cms_press_middle_image_height'));
				}else{
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('cms_press_small_image_width'), $this->config->get('cms_press_small_image_height'));
				}
			} else {
				$image = '';
			}
			
			$users = $this->model_press_press->getUsers();
			
			$this->load->model('press/comment');
				
			$comment_count = $this->model_press_comment->getTotalCommentsByPressId($result['press_id']);
					
			$data['presses'][] = array(
				'press_id'  	   		=> $result['press_id'],
				'thumb'       		=> $image,
				'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
				'brief' 	   		=> html_entity_decode($result['brief'], ENT_QUOTES, 'UTF-8'),
				'tags' 	   	   		=> explode(',', $result['tags']),
				'press_category_id'  => $result['press_category_id'],
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
				'link'				=> $this->url->link('press/press', 'press_id='.$result['press_id'], 'SSL'),
			
				
			);
			
		}
		
		$data['cms_press_large_image_width'] = $this->config->get('cms_press_large_image_width');
		$data['cms_press_large_image_height'] = $this->config->get('cms_press_large_image_height');
		$data['cms_press_middle_image_width'] = $this->config->get('cms_press_middle_image_width');
		$data['cms_press_middle_image_height'] = $this->config->get('cms_press_middle_image_height');
		$data['cms_press_small_image_width'] = $this->config->get('cms_press_small_image_width');
		$data['cms_press_small_image_height'] = $this->config->get('cms_press_small_image_height');
		$data['cms_press_category_page_show_title'] = $this->config->get('cms_press_category_page_show_title');
		$data['cms_press_category_page_show_brief'] = $this->config->get('cms_press_category_page_show_brief');
		$data['cms_press_category_page_show_readmore'] = $this->config->get('cms_press_category_page_show_readmore');
		$data['cms_press_category_page_show_image'] = $this->config->get('cms_press_category_page_show_image');
		$data['cms_press_category_page_show_author'] = $this->config->get('cms_press_category_page_show_author');
		$data['cms_press_category_page_show_category'] = $this->config->get('cms_press_category_page_show_category');
		$data['cms_press_category_page_show_created_date'] = $this->config->get('cms_press_category_page_show_created_date');
		$data['cms_press_category_page_show_hits'] = $this->config->get('cms_press_category_page_show_hits');
		$data['cms_press_category_page_show_comment_counter'] = $this->config->get('cms_press_category_page_show_comment_counter');
		
		$data['cms_press_image_type'] = $this->config->get('cms_press_image_type');
		$data['cms_press_show_title'] = $this->config->get('cms_press_show_title');
		$data['cms_press_show_image'] = $this->config->get('cms_press_show_image');
		$data['cms_press_show_author'] = $this->config->get('cms_press_show_author');
		$data['cms_press_show_category'] = $this->config->get('cms_press_show_category');
		$data['cms_press_show_created_date'] = $this->config->get('cms_press_show_created_date');
		$data['cms_press_show_hits'] = $this->config->get('cms_press_show_hits');
		$data['cms_press_show_comment_counter'] = $this->config->get('cms_press_show_comment_counter');
		$data['cms_press_show_comment_form'] = $this->config->get('cms_press_show_comment_form');
		$data['cms_press_show_auto_publish_comment'] = $this->config->get('cms_press_show_auto_publish_comment');
		$data['cms_press_show_recaptcha'] = $this->config->get('cms_press_show_recaptcha');
		$data['cms_press_show_need_login_to_comment'] = $this->config->get('cms_press_show_need_login_to_comment');
		
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
		
		

		$url = '';

		if (isset($this->request->get['filter_press'])) {
			$url .= '&filter_press=' . urlencode(html_entity_decode($this->request->get['filter_press'], ENT_QUOTES, 'UTF-8'));
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


		$pagination = new Pagination();
		$pagination->total = $press_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('press/all', $url . 'page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($press_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($press_total - $limit)) ? $press_total : ((($page - 1) * $limit) + $limit), $press_total, ceil($press_total / $limit));

		$data['continue'] = $this->url->link('press/all');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/press/all.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/press/all.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/press/all.tpl', $data));
		}
		
	}
}