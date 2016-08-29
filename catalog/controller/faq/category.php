<?php
class ControllerFaqCategory extends Controller {
	public function index() {
		$this->load->language('faq/category');

		$this->load->model('faq/category');

		$this->load->model('faq/faq');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$limit = $this->config->get('cms_faq_items_per_page');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_faq'),
			'href' => $this->url->link('faq/faq')
		);

		if (isset($this->request->get['line'])) {
			$url = '';


			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$line = '';

			$parts = explode('_', (string)$this->request->get['line']);

			$faq_category_id = (int)array_pop($parts);

			foreach ($parts as $line_id) {
				if (!$line) {
					$line = (int)$line_id;
				} else {
					$line .= '_' . (int)$line_id;
				}

				$faq_category_info = $this->model_faq_category->getFaqCategory($line_id);

				if ($faq_category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $faq_category_info['name'],
						'href' => $this->url->link('faq/category', 'line=' . $line . $url)
					);
				}
			}
		} else {
			$faq_category_id = 0;
		}

		$faq_category_info = $this->model_faq_category->getFaqCategory($faq_category_id);

		if ($faq_category_info) {
			$this->document->setTitle($faq_category_info['meta_title']);
			$this->document->setDescription($faq_category_info['meta_description']);
			$this->document->setKeywords($faq_category_info['meta_keyword']);

			$data['heading_title'] = $faq_category_info['name'];

			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_faq'] = $this->language->get('text_faq');
			$data['text_faq_category'] = $this->language->get('text_faq_category');

			$data['button_continue'] = $this->language->get('button_continue');

			// Set the last faq category breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $faq_category_info['name'],
				'href' => $this->url->link('faq/category', 'line=' . $this->request->get['line'])
			);


			$data['description'] = html_entity_decode($faq_category_info['description'], ENT_QUOTES, 'UTF-8');
			
			$url = '';


			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}


			$data['faqs'] = array();

			$filter_data = array(
				'filter_faq_category_id' => $faq_category_id,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$faq_total = $this->model_faq_faq->getTotalFaqs($filter_data);

			$results = $this->model_faq_faq->getFaqs($filter_data);

			foreach ($results as $result) {
				
				$data['faqs'][] = array(
					'faq_id'  			=> $result['faq_id'],
					'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
					'answer'        	=> html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8'),
					'created'  	   		=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'status'  	   		=> $result['status'],
					'sort_order'   		=> $result['sort_order'],
					'date_added'   		=> $result['date_added'],
					'link'				=> $this->url->link('faq/faq', 'faq_id='.$result['faq_id'], true),
					
				);
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			// Faq Category Menu
			$this->load->model('faq/category');
	
			$data['categories'] = array();
	
			$categories = $this->model_faq_category->getFaqCategories(0);
	
			foreach ($categories as $category) {
	
				// Level 2
				$children_data = array();
		
				$children = $this->model_faq_category->getFaqCategories($category['faq_category_id']);
		
				foreach ($children as $child) {
		
					$children_data[] = array(
						'name'  => $child['name'],
						'href'  => $this->url->link('faq/category', 'line=' . $category['faq_category_id'] . '_' . $child['faq_category_id'])
					);
				}
		
				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'href'     => $this->url->link('faq/category', 'line=' . $category['faq_category_id'])
				);
				
			}

			$pagination = new Pagination();
			$pagination->total = $faq_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('faq/category', 'line=' . $this->request->get['line'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($faq_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($faq_total - $limit)) ? $faq_total : ((($page - 1) * $limit) + $limit), $faq_total, ceil($faq_total / $limit));

			// http://googlewebmastercentral.faqspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('faq/category', 'line=' . $faq_category_info['faq_category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('faq/category', 'line=' . $faq_category_info['faq_category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('faq/category', 'line=' . $faq_category_info['faq_category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			if ($limit && ceil($faq_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('faq/category', 'line=' . $faq_category_info['faq_category_id'] . '&page='. ($page + 1), true), 'next');
			}

			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('faq/faq');
			
			

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('faq/category', $data));
			
		} else {
			$url = '';

			if (isset($this->request->get['line'])) {
				$url .= '&line=' . $this->request->get['line'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('faq/category', $url)
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
