<?php
class ControllerPressAll extends Controller {
	public function index() {
		$this->load->language('press/all');

		$this->load->model('press/press');
		
		$this->load->model('tool/image');
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('cms_press_items_per_page');
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
		$data['text_created_date'] = $this->language->get('text_created_date');
		$data['text_press_category'] = $this->language->get('text_press_category');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['presses'] = array();

		$filter_data = array(
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$press_total = $this->model_press_press->getTotalPresses($filter_data);

		$results = $this->model_press_press->getPresses($filter_data);

		foreach ($results as $result) {
			
			$data['presses'][] = array(
				'press_id'  	   		=> $result['press_id'],
				'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
				'status'  	   		=> $result['status'],
				'sort_order'   		=> $result['sort_order'],
				'date_added'   		=> $result['date_added'],
				'link'				=> $this->url->link('press/press', 'press_id='.$result['press_id'], true),
			
				
			);
			
		}
		

		
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
					'href'  => $this->url->link('press/category', 'road=' . $category['press_category_id'] . '_' . $child['press_category_id'])
				);
			}
	
			// Level 1
			$data['categories'][] = array(
				'name'     => $category['name'],
				'children' => $children_data,
				'href'     => $this->url->link('press/category', 'road=' . $category['press_category_id'])
			);
			
		}
		
		

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}


		$pagination = new Pagination();
		$pagination->total = $press_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('press/all', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($press_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($press_total - $limit)) ? $press_total : ((($page - 1) * $limit) + $limit), $press_total, ceil($press_total / $limit));

		$data['continue'] = $this->url->link('press/all');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('press/all', $data));
		
	}
}