<?php
class ControllerCatalogProductOptionGroup extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/product_option_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_option_group');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/product_option_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_option_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_option_group->addProductOptionGroup($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_group'])) {
				$url .= '&filter_option_group=' . urlencode(html_entity_decode($this->request->get['filter_option_group'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_sort'])) {
				$url .= '&filter_sort=' . $this->request->get['filter_sort'];
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

			$this->response->redirect($this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/product_option_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_option_group');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_option_group->editProductOptionGroup($this->request->get['product_option_group_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_group'])) {
				$url .= '&filter_option_group=' . urlencode(html_entity_decode($this->request->get['filter_option_group'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/product_option_group');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_option_group');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $option_id) {
				$this->model_catalog_product_option_group->deleteProductOptionGroup($option_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}

			if (isset($this->request->get['filter_product'])) {
				$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_option_group'])) {
				$url .= '&filter_option_group=' . urlencode(html_entity_decode($this->request->get['filter_option_group'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = '';
		}

		if (isset($this->request->get['filter_product'])) {
			$filter_product = $this->request->get['filter_product'];
		} else {
			$filter_product = '';
		}

		if (isset($this->request->get['filter_option_group'])) {
			$filter_option_group = $this->request->get['filter_option_group'];
		} else {
			$filter_option_group = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
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

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_group'])) {
			$url .= '&filter_option_group=' . urlencode(html_entity_decode($this->request->get['filter_option_group'], ENT_QUOTES, 'UTF-8'));
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('catalog/product_option_group/add', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('catalog/product_option_group/delete', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['product_option_groups'] = array();

		$filter_data = array(
			'filter_product_id'	=> $filter_product_id,
			'filter_product'	=> $filter_product,
			'filter_option_group'	    => $filter_option_group,
			'sort'              => $sort,
			'order'             => $order,
			'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'             => $this->config->get('config_limit_admin')
		);

		$product_option_group_total = $this->model_catalog_product_option_group->getTotalProductOptionGroups($filter_data);

		$results = $this->model_catalog_product_option_group->getProductOptionGroups($filter_data);

		foreach ($results as $result) {
			$data['product_option_groups'][] = array(
				'product_option_group_id' => $result['product_option_group_id'],
				'product'           => $result['product'],
				'option_group'      => $result['option_group'],
				'edit'              => $this->url->link('catalog/product_option_group/edit', 'user_token=' . $this->session->data['user_token'] . '&product_option_group_id=' . $result['product_option_group_id'] . $url)
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
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

		$data['sort_product'] = $this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . '&sort=pd.name' . $url);

		$data['sort_option'] = $this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . '&sort=og.name' . $url);

		$url = '';

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_group'])) {
			$url .= '&filter_option_group=' . urlencode(html_entity_decode($this->request->get['filter_option_group'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['pagination'] = $this->load->controller('common/pagination', array(
			'total' => $product_option_group_total,
			'page'  => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'url'   => $this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		));

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_option_group_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_option_group_total - $this->config->get('config_limit_admin'))) ? $product_option_group_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_option_group_total, ceil($product_option_group_total / $this->config->get('config_limit_admin')));

		$data['filter_product'] = $filter_product;
		$data['filter_option_group'] = $filter_option_group;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_option_group_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['product_option_group_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['product'])) {
			$data['error_product'] = $this->error['product'];
		} else {
			$data['error_product'] = '';
		}

		if (isset($this->error['option_group'])) {
			$data['error_option_group'] = $this->error['option_group'];
		} else {
			$data['error_option_group'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_option_group'])) {
			$url .= '&filter_option_group=' . urlencode(html_entity_decode($this->request->get['filter_option_group'], ENT_QUOTES, 'UTF-8'));
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		if (!isset($this->request->get['product_option_group_id'])) {
			$data['action'] = $this->url->link('catalog/product_option_group/add', 'user_token=' . $this->session->data['user_token'] . $url);
		} else {
			$data['action'] = $this->url->link('catalog/product_option_group/edit', 'user_token=' . $this->session->data['user_token'] . '&product_option_group_id=' . $this->request->get['product_option_group_id'] . $url);
		}

		$data['cancel'] = $this->url->link('catalog/product_option_group', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['product_option_group_id'] = '';

		$data['existing_value_ids'] = array();

		if (isset($this->request->get['product_option_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_option_group_info = $this->model_catalog_product_option_group->getProductOptionGroup($this->request->get['product_option_group_id']);

			//编辑时获取已经选定的商品选项值
			/*
			$product_option_value_combinations = $this->model_catalog_product_option_group->getProductOptionValueCombinations($this->request->get['product_option_group_id']);
			
			$exist = array();
				
			foreach ($product_option_value_combinations as $combination) {
				$value = explode('_', $combination['option_value_combination']);
				$exist = array_merge($value, $exist);
			}

			$data['existing_value_ids'] = array_unique($exist);
			*/

			$data['product_option_group_id'] = $this->request->get['product_option_group_id'];
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['product_id'])) {
			$data['product_id'] = $this->request->post['product_id'];
		} elseif (!empty($product_option_group_info)) {
			$data['product_id'] = $product_option_group_info['product_id'];
		} else {
			$data['product_id'] = 0;
		}

		if (isset($this->request->post['product'])) {
			$data['product'] = $this->request->post['product'];
		} elseif (!empty($product_option_group_info)) {
			$data['product'] = $product_option_group_info['product'];
		} else {
			$data['product'] = '';
		}

		if (isset($this->request->post['option_group_id'])) {
			$data['option_group_id'] = $this->request->post['option_group_id'];
		} elseif (!empty($product_option_group_info)) {
			$data['option_group_id'] = $product_option_group_info['option_group_id'];
		} else {
			$data['option_group_id'] = 0;
		}

		$this->load->model('catalog/option_group');

		$data['option_groups'] = $this->model_catalog_option_group->getOptionGroups();



		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_option_group_form', $data));
	}

	protected function validateForm() {
		/*
		echo "<pre>";
		print_r($this->request->post);
		echo "</pre>";
		exit;
		*/

		if (!$this->user->hasPermission('modify', 'catalog/product_option_group')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['product_id']) {
			$this->error['product'] = $this->language->get('error_product');
		}

		if (!$this->request->post['option_group_id']) {
			$this->error['option_group'] = $this->language->get('error_option_group');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/product_option')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function ajaxtable1() {
		$data['options'] = array();
		$product_id = $this->request->get['product_id'];
		$product_option_group_id = $this->request->get['product_option_group_id'];
		$option_group_id = $this->request->get['option_group_id'];

		$this->load->model('catalog/option');
		$this->load->model('catalog/product_option_group');

		//新增
		if ($option_group_id && (!$product_id) && (!$product_option_group_id)) {
			$option_datas = $this->model_catalog_option->getOptionsByOptionGroup($option_group_id);

			foreach ($option_datas as $option_data) {
				//新增时将选项值设定为0-未选
				$option_values = array();
				$option_ones = $this->model_catalog_option->getOptionValues($option_data['option_id']);

				foreach ($option_ones as $one) {
					$option_values[] = array(
						'option_value_id' => $one['option_value_id'],
						'name'	=> $one['name'],
						'choosen' => '0',
					);
				}

				$data['options'][] = array(
					'name'	=> $option_data['name'],
					'option_id'	=> $option_data['option_id'],
					'option_values'	=> $option_values,

				);

				echo $this->response->setOutput($this->load->view('catalog/option_table1', $data));
			}
		}

		//编辑
		if ($option_group_id && $product_id && $product_option_group_id) {

			$product_option_value_combinations = $this->model_catalog_product_option_group->getProductOptionValueCombinations($product_option_group_id);


			//编辑时获取已经选定的商品选项值
			$exist = array();
			
			foreach ($product_option_value_combinations as $combination) {
				$value = explode('_', $combination['option_value_combination']);
				$exist = array_merge($value, $exist);
			}

			$existing = array_unique($exist);

			/*

			$data['existing_value_ids'] = $existing;

			$c = '';
			foreach($existing as $a=>$b){
				$c.= ", ".$b;
			}

			$data['existing_value_string'] = $c;
			*/
			//echo $c;exit;
			

			$option_datas = $this->model_catalog_option->getOptionsByOptionGroup($option_group_id);

			foreach ($option_datas as $option_data) {
				$option_values = array();
				$option_ones = $this->model_catalog_option->getOptionValues($option_data['option_id']);

				foreach ($option_ones as $one) {
					$option_values[] = array(
						'option_value_id' => $one['option_value_id'],
						'name'	=> $one['name'],
						'choosen' => in_array($one['option_value_id'], $existing) ? '1' : '0',
					);
				}


				$data['options'][] = array(
					'name'	=> $option_data['name'],
					'option_id'	=> $option_data['option_id'],
					'option_values'	=> $option_values,
				);

				echo $this->response->setOutput($this->load->view('catalog/option_table1', $data));
			}

		}

		

		if ($option_group_id && (!$product_id) && (!$product_option_group_id)) {
		

		}
	}

	

	public function ajaxtable2() {
		$this->load->model('catalog/option');
		$this->load->model('catalog/product_option_group');
		$data['option_value_combinations'] = array();
		$product_id = $this->request->get['product_id'];
		$product_option_group_id = $this->request->get['product_option_group_id'];
		$option_group_id = $this->request->get['option_group_id'];
		$option_values_selected = explode(',', $this->request->get['ova']);

		$option_value_ids = array();
		$option_ids = array();
		if ($option_values_selected) {
			foreach ($option_values_selected as $option_value_id) {
				
				$option_value_info = $this->model_catalog_option->getOptionValue($option_value_id);

				if ($option_value_info) {
					$option_info = $this->model_catalog_option->getOption($option_value_info['option_id']);
					$option_value_ids[$option_value_info['option_id']][] = array(
						'option_value_id' => $option_value_id,
					);
					
					
				}

			}

			//echo "<pre>";
			//print_r($option_ids);
			//echo "</pre>";
			
			$this->load->model('tool/image');
			
			$thumb = 'no_image.png';
			
			$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
			
			
			//获取选项值组合
			$data['items'] = array();
			$one = $this->combineDika($option_value_ids);

			foreach ($one as $two) {
				$four = '';
				$five = '';
				$i = count($two);
				$j = 0;
				foreach ($two as $three) {
					
					$option_value_info = $this->model_catalog_option->getOptionValue($three['option_value_id']);

					if ($j < ($i - 1)) {
						$four .= $three['option_value_id'].'_';
						$five .= $option_value_info['name'].'-';
						
					} else {
						$four .= $three['option_value_id'];
						$five .= $option_value_info['name'];
					}
					
					$j ++;
					
				}

				$combine_info = $this->model_catalog_product_option_group->getInfoByCombination($product_option_group_id, $four);

				if ($combine_info) {

			

					if ($combine_info['image']) {
						$combine_thumb = $this->model_tool_image->resize(html_entity_decode($combine_info['image'], ENT_QUOTES, 'UTF-8'), 100, 100);
					} else {
						$combine_thumb = $this->model_tool_image->resize(html_entity_decode($thumb, ENT_QUOTES, 'UTF-8'), 100, 100);
					}

					$data['items'][] = array(
						'number' => $four,
						'title' => $five,
						'image' => $combine_info['image'],
						'thumb' => $combine_thumb,
						'price' => $combine_info['price'],
						'cost_price' => $combine_info['cost_price'],
						'quantity' => $combine_info['quantity'],
						'points' => $combine_info['points'],
						'weight' => $combine_info['weight'],
						'sku' => $combine_info['sku'],
						'status' => $combine_info['status'],
					);

				} else {
				
					$data['items'][] = array(
						'number' => $four,
						'title' => $five,
						'image' => '',
						'thumb' => $this->model_tool_image->resize(html_entity_decode($thumb, ENT_QUOTES, 'UTF-8'), 100, 100),
						'price' => '',
						'cost_price' => '',
						'quantity' => '',
						'points' => '',
						'weight' => '',
						'sku' => '',
						'status' => '1',
					);
				}
			}
			
			/*
			echo "<pre>";
			print_r($data['items']);
			echo "</pre>";
			exit;
			*/
			
			echo $this->response->setOutput($this->load->view('catalog/option_table2', $data));

		} else {

		}

	}

	public function combineDika() {
		$receive_data = func_get_args();
		$receive_data = current($receive_data);
		$cnt = count($receive_data);
		$result = array();
		$arr1 = array_shift($receive_data);
		
		if ($arr1) {
			foreach($arr1 as $key=>$item) {
				$result[] = array($item);
			}		

			foreach($receive_data as $key=>$item) {                                
				$result = $this->combineArray($result,$item);
			}

		}
		return $result;
	}

	public function combineArray($arr1,$arr2) {		 
		$result = array();
		
		foreach ($arr1 as $item1) {
			foreach ($arr2 as $item2) {
				$temp = $item1;
				$temp[] = $item2;
				$result[] = $temp;
			}
		}
	
		return $result;
	}

}