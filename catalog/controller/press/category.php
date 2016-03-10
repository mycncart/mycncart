<?php
class ControllerPressCategory extends Controller {
	public function index() {
		$this->load->language('press/category');

		$this->load->model('press/category');

		$this->load->model('press/press');

		$this->load->model('tool/image');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$limit = $this->config->get('cms_press_items_per_page');
		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_press'),
			'href' => $this->url->link('press/all')
		);

		if (isset($this->request->get['road'])) {
			$url = '';


			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$road = '';

			$parts = explode('_', (string)$this->request->get['road']);

			$press_category_id = (int)array_pop($parts);

			foreach ($parts as $road_id) {
				if (!$road) {
					$road = (int)$road_id;
				} else {
					$road .= '_' . (int)$road_id;
				}

				$press_category_info = $this->model_press_category->getPressCategory($road_id);

				if ($press_category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $press_category_info['name'],
						'href' => $this->url->link('press/category', 'road=' . $road . $url)
					);
				}
			}
		} else {
			$press_category_id = 0;
		}

		$press_category_info = $this->model_press_category->getPressCategory($press_category_id);

		if ($press_category_info) {
			$this->document->setTitle($press_category_info['meta_title']);
			$this->document->setDescription($press_category_info['meta_description']);
			$this->document->setKeywords($press_category_info['meta_keyword']);

			$data['heading_title'] = $press_category_info['name'];

			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_press'] = $this->language->get('text_press');
			$data['text_press_category'] = $this->language->get('text_press_category');

			$data['button_continue'] = $this->language->get('button_continue');

			// Set the last press category breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $press_category_info['name'],
				'href' => $this->url->link('press/category', 'road=' . $this->request->get['road'])
			);


			$data['description'] = html_entity_decode($press_category_info['description'], ENT_QUOTES, 'UTF-8');
			
			$url = '';


			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


			$data['presses'] = array();

			$filter_data = array(
				'filter_press_category_id' => $press_category_id,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$press_total = $this->model_press_press->getTotalPresses($filter_data);

			$results = $this->model_press_press->getPresses($filter_data);

			foreach ($results as $result) {
				
				$data['presses'][] = array(
					'press_id'  			=> $result['press_id'],
					'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
					'created'  	   		=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'status'  	   		=> $result['status'],
					'sort_order'   		=> $result['sort_order'],
					'date_added'   		=> $result['date_added'],
					'link'				=> $this->url->link('press/press', 'press_id='.$result['press_id'], true),
					
				);
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
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

			$pagination = new Pagination();
			$pagination->total = $press_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('press/category', 'road=' . $this->request->get['road'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($press_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($press_total - $limit)) ? $press_total : ((($page - 1) * $limit) + $limit), $press_total, ceil($press_total / $limit));

			// http://googlewebmastercentral.pressespot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('press/category', 'road=' . $press_category_info['press_category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('press/category', 'road=' . $press_category_info['press_category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('press/category', 'road=' . $press_category_info['press_category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			if ($limit && ceil($press_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('press/category', 'road=' . $press_category_info['press_category_id'] . '&page='. ($page + 1), true), 'next');
			}

			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('press/all');
			
			

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('press/category', $data));
			
		} else {
			$url = '';

			if (isset($this->request->get['road'])) {
				$url .= '&road=' . $this->request->get['road'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('press/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
			
		}
	}
}
