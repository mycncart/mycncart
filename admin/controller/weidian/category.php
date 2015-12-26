<?php
class ControllerWeidianCategory extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('weidian/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('weidian/category');

		$this->getList();
	}
	
	//增加微店分类
	public function push() {
		
		$this->load->language('weidian/category');
		
		$category_id = $this->request->get['category_id'];
		
		$this->load->model('weidian/category');
		
		$appkey = $this->config->get('weidian_appkey');
		
		
		
		$secret = $this->config->get('weidian_secret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appkey='.trim($appkey).'&secret='.trim($secret);
		
		$return_json = file_get_contents($url);
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		$token_status_reason = $return_info->status->status_reason;
		
		
		
		
		
		
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			
			$access_token = $return_info->result->access_token;
			
			
			$category_info = $this->model_weidian_category->getCategory($category_id);
			
			
			$submit_url = 'https://api.vdian.com/api?param={"cates":[{"cate_name":"'.$category_info['name'].'","sort_num":"'.$category_info['sort_order'].'"}]}&public={"method":"vdian.shop.cate.add","access_token":"'.$access_token.'","version":"1.0","format":"json"}';
			
			$submit_return_json = file_get_contents($submit_url);
			
			
			$submit_info = json_decode($submit_return_json);
			
			
			
			$status_code = $submit_info->status->status_code;
			$status_reason = $submit_info->status->status_reason;
			
			if(($status_code == 0) && ($status_reason == 'success')) {
				
				//更新已推送及微店分类id
				
				$get_cate_url = 'http://api.vdian.com/api?param={}&public={"method":"vdian.shop.cate.get","access_token":"'.$access_token.'","version":"1.0","format":"json"}';
		
				$get_json = file_get_contents($get_cate_url);
				$get_info = json_decode($get_json);
				
				$results = $get_info->result;
				foreach($results as $result) {
					
					if(($category_info['name'] == $result->cate_name) && ($category_info['sort_order'] == $result->sort_num)) {
						$this->model_weidian_category->updateSent($category_id, $result->cate_id);
					}
					
				}
				
				
				
				
				
				$this->session->data['success'] = $this->language->get('text_success');
	
				$url = '';
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}else{
				$this->session->data['warning'] = $this->language->get('text_warning');
	
				$url = '';
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		
		}else{
			
			$this->session->data['warning'] = $this->language->get('text_warning');
	
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}
	
	//更新微店分类
	public function update() {
		
		$this->load->language('weidian/category');
		
		$category_id = $this->request->get['category_id'];
		
		$this->load->model('weidian/category');
		
		$appkey = $this->config->get('weidian_appkey');
		
		
		
		$secret = $this->config->get('weidian_secret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appkey='.trim($appkey).'&secret='.trim($secret);
		
		$return_json = file_get_contents($url);
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		$token_status_reason = $return_info->status->status_reason;
		
		
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			
			$access_token = $return_info->result->access_token;
			
			
			$category_info = $this->model_weidian_category->getCategory($category_id);
			
			
			
			$submit_url = 'http://api.vdian.com/api?param={"cates":[{"cate_id":'.$category_info['weidian_category_id'].',"cate_name":"'.$category_info['name'].'","sort_num":'.$category_info['sort_order'].'}]}&public={"method":"vdian.shop.cate.update","access_token":"'.$access_token.'","version":"1.0","format":"json"}';
			
			
			$submit_return_json = file_get_contents($submit_url);
			
			$submit_info = json_decode($submit_return_json);
			
			
			
			
			$status_code = $submit_info->status->status_code;
			$status_reason = $submit_info->status->status_reason;
			
			if(($status_code == 0) && ($status_reason == 'success')) {
				
				
				$this->session->data['success'] = $this->language->get('text_success');
	
				$url = '';
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}else{
				$this->session->data['warning'] = $this->language->get('text_warning');
	
				$url = '';
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		
		}else{
			
			$this->session->data['warning'] = $this->language->get('text_warning');
	
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}
	
	//删除微店分类
	public function unpush() {
		
		$this->load->language('weidian/category');
		
		$category_id = $this->request->get['category_id'];
		
		$this->load->model('weidian/category');
		
		$appkey = $this->config->get('weidian_appkey');
		
		
		
		$secret = $this->config->get('weidian_secret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appkey='.trim($appkey).'&secret='.trim($secret);
		
		$return_json = file_get_contents($url);
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		$token_status_reason = $return_info->status->status_reason;
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			
			$access_token = $return_info->result->access_token;
			
			$category_info = $this->model_weidian_category->getCategory($category_id);
			
			
			$submit_url = 'http://api.vdian.com/api?param={"cate_id":'.$category_info['weidian_category_id'].'}&public={"method":"vdian.shop.cate.delete","access_token":"'.$access_token.'","version":"1.0","format":"json"}';
			
			$submit_return_json = file_get_contents($submit_url);
			
			
			$submit_info = json_decode($submit_return_json);
			
			
			
			$status_code = $submit_info->status->status_code;
			$status_reason = $submit_info->status->status_reason;
			
			if(($status_code == 0) && ($status_reason == 'success')) {
				
				$this->model_weidian_category->deleteSent($category_id);
				
				$this->session->data['success'] = $this->language->get('text_delete_success');
	
				$url = '';
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}else{
				$this->session->data['warning'] = $this->language->get('text_warning');
	
				$url = '';
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		
		}else{
			
			$this->session->data['warning'] = $this->language->get('text_warning');
	
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}


	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		

		$data['categories'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$category_total = $this->model_weidian_category->getTotalCategories();

		$results = $this->model_weidian_category->getCategories($filter_data);

		foreach ($results as $result) {
			$data['categories'][] = array(
				'category_id' => $result['category_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'sent'  	  => $result['sent'],
				'push'        => $this->url->link('weidian/category/push', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, 'SSL'),
				'update'        => $this->url->link('weidian/category/update', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, 'SSL'),
				'unpush'      => $this->url->link('weidian/category/unpush', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_push'] = $this->language->get('button_push');
		$data['button_unpush'] = $this->language->get('button_unpush');
		$data['button_update'] = $this->language->get('button_update');

		
		
		if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];

			unset($this->session->data['warning']);
		} else {
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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('weidian/category', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('weidian/category', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $category_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('weidian/category', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('weidian/category_list.tpl', $data));
	}
	
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 200
			);

			$results = $this->model_catalog_category->getCategories($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}