<?php
class ControllerFaqFaq extends Controller {
	public function index() {
		$this->load->language('faq/faq');

		$this->load->model('faq/faq');
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get('cms_faq_items_per_page');
		}
		
		if (isset($this->request->get['filter_faq'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['filter_faq']);
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
			'text' => $this->language->get('text_faq'),
			'href' => $this->url->link('faq/faq', $url)
		);
		
		if (isset($this->request->get['filter_faq'])) {
			$data['heading_title'] = $this->language->get('heading_title') .  ' - ' . $this->request->get['filter_faq'];
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
		}
		
		$faq_description = $this->config->get('cms_faq_description');

		$this->document->setTitle($faq_description[(int)$this->config->get('config_language_id')]['meta_title']);
		$this->document->setDescription($faq_description[(int)$this->config->get('config_language_id')]['meta_description']);
		$this->document->setKeywords($faq_description[(int)$this->config->get('config_language_id')]['meta_keyword']);
		$this->document->addLink($this->url->link('faq/faq', ''), 'canonical');
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_faq'] = $this->language->get('text_faq');
		$data['text_created_date'] = $this->language->get('text_created_date');
		$data['text_faq_category'] = $this->language->get('text_faq_category');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['faqs'] = array();

		$filter_data = array(
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);

		$faq_total = $this->model_faq_faq->getTotalFaqs($filter_data);

		$results = $this->model_faq_faq->getFaqs($filter_data);

		foreach ($results as $result) {
			
			$data['faqs'][] = array(
				'faq_id'  	   		=> $result['faq_id'],
				'title'        		=> html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
				'answer'       		=> html_entity_decode($result['answer'], ENT_QUOTES, 'UTF-8'),
				'status'  	   		=> $result['status'],
				'sort_order'   		=> $result['sort_order'],
				'date_added'   		=> $result['date_added'],
				'link'				=> $this->url->link('faq/faq', 'faq_id='.$result['faq_id'], true),
			
				
			);
			
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
		
		

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}


		$pagination = new Pagination();
		$pagination->total = $faq_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('faq/faq', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($faq_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($faq_total - $limit)) ? $faq_total : ((($page - 1) * $limit) + $limit), $faq_total, ceil($faq_total / $limit));

		$data['continue'] = $this->url->link('faq/faq');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('faq/faq', $data));
		
	}
}