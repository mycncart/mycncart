<?php
class ControllerBaiDuPushUrl extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('baidu/pushurl');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('baidu/pushurl');
				
		$this->getList();
	}
	
	public function add() {
		$this->load->language('baidu/pushurl');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('baidu/pushurl');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_baidu_pushurl->addNewPushUrl($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_url'])) {
				$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_pushed'])) {
				$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('baidu/pushurl');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('baidu/pushurl');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_baidu_pushurl->editPushUrl($this->request->get['pushurl_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_url'])) {
				$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_pushed'])) {
				$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('baidu/pushurl');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('baidu/pushurl');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $pushurl_id) {
				$this->model_baidu_pushurl->deletePushUrl($pushurl_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_url'])) {
				$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_pushed'])) {
				$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}
	
	public function push() {
		
		$this->load->language('baidu/pushurl');

		$this->load->model('baidu/pushurl');

		if (isset($this->request->post['selected'])) {
			
			$urls = array();
			foreach ($this->request->post['selected'] as $pushurl_id) {
				$pushurl_info = $this->model_baidu_pushurl->getPushUrl($pushurl_id);
				$urls[] = $pushurl_info['url'];
			}
			
			$api = html_entity_decode($this->config->get('config_baidu_api'), ENT_QUOTES, 'UTF-8');
			
			
			if($api) {
			
				$ch = curl_init();
				$options =  array(
					CURLOPT_URL => $api,
					CURLOPT_POST => true,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POSTFIELDS => implode("\n", $urls),
					CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
				);
				curl_setopt_array($ch, $options);
				$result = curl_exec($ch);
				
				$result = json_decode($result, true);
				
				if(isset($result['success'])) {
					
					$this->session->data['success'] = sprintf($this->language->get('text_push_success'), $result['success'], $result['remain']);
					
					foreach ($this->request->post['selected'] as $pushurl_id) {
						$this->model_baidu_pushurl->updatePushUrl($pushurl_id);
					}
					
				}else{
					
					if(isset($result['error'])) {
						$this->session->data['warning'] = $this->language->get('error_push_warning') . $result['message'];
					}
				}
			
			}else{
				
				$this->session->data['warning'] = $this->language->get('error_push_config_warning');
				
			}


			$url = '';

			if (isset($this->request->get['filter_url'])) {
				$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_pushed'])) {
				$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
			}
		
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}
	
	public function updateproducturl() {
		
		$this->load->language('baidu/pushurl');
		
		$this->load->model('baidu/pushurl');
		
		$products = $this->model_baidu_pushurl->getAllProducts();
		
		foreach ($products as $product) {
			
			
			$product_url = $this->model_baidu_pushurl->getProductSEOUrl($product['product_id']);
			
			if(!$this->model_baidu_pushurl->getPushUrlByProductUrl($product_url)) {
				$this->model_baidu_pushurl->addPushUrl($product_url);
			}
			
		}
		
		$this->session->data['success'] = $this->language->get('text_success');
		 
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		 
	}
	
	public function updatecategoryurl() {
		
		$this->load->language('baidu/pushurl');
		
		$this->load->model('baidu/pushurl');
			 
		$categories = $this->model_baidu_pushurl->getAllCategories();
		
			 
		foreach ($categories as $category) {
			
			$category_url = $this->model_baidu_pushurl->getCategorySEOUrl($category['category_id']);
			
			if(!$this->model_baidu_pushurl->getPushUrlByCategoryUrl($category_url)) {
				$this->model_baidu_pushurl->addPushUrl($category_url);	
			}
			
			
		}
		 
		$this->session->data['success'] = $this->language->get('text_success');
		 
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
	}
	
	public function updateinformationurl() {
		
		$this->load->language('baidu/pushurl');
		
		$this->load->model('baidu/pushurl');
		
		$this->load->model('catalog/information');    
			
		foreach ($this->model_catalog_information->getInformations() as $result) {
			
			$information_url = $this->model_baidu_pushurl->getInformationSEOUrl($result['information_id']);
			
			if(!$this->model_baidu_pushurl->getPushUrlByInformationUrl($information_url)) {
				$this->model_baidu_pushurl->addPushUrl($information_url);	
			}
			 
		}
		
		
		$this->session->data['success'] = $this->language->get('text_success');
		 
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		
	}
	
	
	public function updatemanufacturerurl() {
		
		$this->load->language('baidu/pushurl');
		
		$this->load->model('baidu/pushurl');
			
		foreach ($this->model_baidu_pushurl->getAllManufacturers() as $result) {
			
			$manufacturer_url = $this->model_baidu_pushurl->getManufacturerSEOUrl($result['manufacturer_id']);
			
			if(!$this->model_baidu_pushurl->getPushUrlByManufacturerUrl($manufacturer_url)) {
				$this->model_baidu_pushurl->addPushUrl($manufacturer_url);
			}
			 
		}
		
		$this->session->data['success'] = $this->language->get('text_success');
		 
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		
	}
	
	public function updateblogurl() {
		
		$this->load->language('baidu/pushurl');
		
		$this->load->model('baidu/pushurl');
			
		foreach ($this->model_baidu_pushurl->getAllBlogs() as $result) {
			
			$blog_url = $this->model_baidu_pushurl->getBlogSEOUrl($result['blog_id']);
			
			if(!$this->model_baidu_pushurl->getPushUrlByBlogUrl($blog_url)) {
				$this->model_baidu_pushurl->addPushUrl($blog_url);
			}
			 
		}
		
		$this->session->data['success'] = $this->language->get('text_success');
		 
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		
	}
	
	public function updatepressurl() {
		
		$this->load->language('baidu/pushurl');
		
		$this->load->model('baidu/pushurl');
			
		foreach ($this->model_baidu_pushurl->getAllPresses() as $result) {
			
			$press_url = $this->model_baidu_pushurl->getPressSEOUrl($result['press_id']);
			
			if(!$this->model_baidu_pushurl->getPushUrlByPressUrl($press_url)) {
				$this->model_baidu_pushurl->addPushUrl($press_url);
			}
			 
		}
		
		$this->session->data['success'] = $this->language->get('text_success');
		 
		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->response->redirect($this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true));
		
	}

	protected function getList() {
		if (isset($this->request->get['filter_url'])) {
			$filter_url = $this->request->get['filter_url'];
		} else {
			$filter_url = null;
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$filter_pushed = $this->request->get['filter_pushed'];
		} else {
			$filter_pushed = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pushurl_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('baidu/pushurl/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('baidu/pushurl/delete', 'token=' . $this->session->data['token'] . $url, true);
		$data['category'] = $this->url->link('baidu/pushurl/updatecategoryurl', 'token=' . $this->session->data['token'] . $url, true);
		$data['product'] = $this->url->link('baidu/pushurl/updateproducturl', 'token=' . $this->session->data['token'] . $url, true);
		$data['information'] = $this->url->link('baidu/pushurl/updateinformationurl', 'token=' . $this->session->data['token'] . $url, true);
		$data['manufacturer'] = $this->url->link('baidu/pushurl/updatemanufacturerurl', 'token=' . $this->session->data['token'] . $url, true);
		$data['blog'] = $this->url->link('baidu/pushurl/updateblogurl', 'token=' . $this->session->data['token'] . $url, true);
		$data['press'] = $this->url->link('baidu/pushurl/updatepressurl', 'token=' . $this->session->data['token'] . $url, true);
		$data['push'] = $this->url->link('baidu/pushurl/push', 'token=' . $this->session->data['token'] . $url, true);

		$data['pushurls'] = array();

		$filter_data = array(
			'filter_url'	  => $filter_url,
			'filter_pushed'	  => $filter_pushed,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$pushurl_total = $this->model_baidu_pushurl->getTotalPushUrls($filter_data);

		$results = $this->model_baidu_pushurl->getPushUrls($filter_data);

		foreach ($results as $result) {
			$data['pushurls'][] = array(
				'pushurl_id' => $result['pushurl_id'],
				'url'       => $result['url'],
				'push_date'   => $result['push_date'],
				'pushed'     => ($result['pushed']) ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'edit'       => $this->url->link('baidu/pushurl/edit', 'token=' . $this->session->data['token'] . '&pushurl_id=' . $result['pushurl_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_id'] = $this->language->get('column_id');
		$data['column_url'] = $this->language->get('column_url');
		$data['column_pushed'] = $this->language->get('column_pushed');
		$data['column_push_date'] = $this->language->get('column_push_date');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_pushed'] = $this->language->get('entry_pushed');

		$data['button_push'] = $this->language->get('button_push');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_category'] = $this->language->get('button_category');
		$data['button_product'] = $this->language->get('button_product');
		$data['button_information'] = $this->language->get('button_information');
		$data['button_manufacturer'] = $this->language->get('button_manufacturer');
		$data['button_blog'] = $this->language->get('button_blog');
		$data['button_press'] = $this->language->get('button_press');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} elseif(isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		}else{
			$data['error_warning'] = '';	
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_url'] = $this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . '&sort=url' . $url, true);

		$url = '';
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $pushurl_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($pushurl_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($pushurl_total - $this->config->get('config_limit_admin'))) ? $pushurl_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $pushurl_total, ceil($pushurl_total / $this->config->get('config_limit_admin'))). '&nbsp;&nbsp;<input type="text" value="" name="pnum" size="2">&nbsp;&nbsp;<button type="button" id="button-jump" class="btn btn-primary pull-right"><i class="fa fa-arrow-right"></i>'.$this->language->get("button_jump").'</button>';

		$data['filter_url'] = $filter_url;
		$data['filter_pushed'] = $filter_pushed;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('baidu/pushurl_list', $data));
	}
	
	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
	
		$data['text_form'] = !isset($this->request->get['pushurl_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_url'] = $this->language->get('entry_url');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['url'])) {
			$data['error_url'] = $this->error['url'];
		} else {
			$data['error_url'] = '';
		}

		$url = '';
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . urlencode(html_entity_decode($this->request->get['filter_url'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_pushed'])) {
			$url .= '&filter_pushed=' . $this->request->get['filter_pushed'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['pushurl_id'])) {
			$data['action'] = $this->url->link('baidu/pushurl/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('baidu/pushurl/edit', 'token=' . $this->session->data['token'] . '&pushurl_id=' . $this->request->get['pushurl_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('baidu/pushurl', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['pushurl_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$pushurl_info = $this->model_baidu_pushurl->getPushUrl($this->request->get['pushurl_id']);
		}

		if (isset($this->request->post['url'])) {
			$data['url'] = $this->request->post['url'];
		} elseif (!empty($pushurl_info)) {
			$data['url'] = $pushurl_info['url'];
		} else {
			$data['url'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('baidu/pushurl_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'baidu/pushurl')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['url']) < 5) || (utf8_strlen($this->request->post['url']) > 255)) {
			$this->error['url'] = $this->language->get('error_url');
		}

		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'baidu/pushurl')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_url'])) {
			$this->load->model('baidu/pushurl');

			if (isset($this->request->get['filter_url'])) {
				$filter_url = $this->request->get['filter_url'];
			} else {
				$filter_url = '';
			}


			$filter_data = array(
				'filter_url'  => $filter_url,
				'start'        => 0,
				'limit'       => $this->config->get('config_limit_autocomplete')
			);

			$results = $this->model_baidu_pushurl->getPushUrls($filter_data);

			foreach ($results as $result) {

				$json[] = array(
					'pushurl_id' => $result['pushurl_id'],
					'url'       => strip_tags(html_entity_decode($result['url'], ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	
        
}