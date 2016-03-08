<?php
class ControllerYouzanProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('youzan/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('youzan/product');

		$this->getList();
	}
	
	public function push() {
		$this->load->language('youzan/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('youzan/product');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$result = $this->addYouZanProduct($this->request->get['product_id'], $this->request->post);
			
			if($result) {
				$this->session->data['success'] = $this->language->get('text_success');
			}else{
				$this->session->data['warning'] = $this->language->get('text_add_youzan_warning');
			}

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}
	
	//update youzan product
	public function update() {
		$this->load->language('youzan/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('youzan/product');
		
		$youzan_info = $this->model_youzan_product->getProductToYouZan($this->request->get['product_id']);
			
		if(!$youzan_info) {
			
			$this->session->data['warning'] = $this->language->get('text_no_youzan_warning');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true));
		
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$result = $this->updateYouZanProduct($this->request->get['product_id'], $youzan_info['youzan_id'], $this->request->post);
			
			if($result) {
				$this->session->data['success'] = $this->language->get('text_success');
			}else{
				$this->session->data['warning'] = $this->language->get('text_update_youzan_warning');
			}
			
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getUpdateForm();
	}

	
	//delete youzan product
	public function unpush() {
		
		$this->load->language('youzan/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('youzan/product');

		if (isset($this->request->get['product_id'])) {
			
			$youzan_info = $this->model_youzan_product->getProductToYouZan($this->request->get['product_id']);
			
			if($youzan_info) {
				
				$result = $this->deleteYouZanProduct($youzan_info['youzan_id']);
			
				if($result) {
					
					$this->model_youzan_product->deleteProductToYouZan($this->request->get['product_id']);
					
					$this->session->data['success'] = $this->language->get('text_success');
					
				}else{
					
					$this->session->data['warning'] = $this->language->get('text_delete_youzan_warning');
					
				}
				
			}else{
				$this->session->data['warning'] = $this->language->get('text_delete_youzan_warning');
			}
			
			

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$filter_sent = $this->request->get['filter_sent'];
		} else {
			$filter_sent = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.product_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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
			'href' => $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('youzan/product/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['copy'] = $this->url->link('youzan/product/copy', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('youzan/product/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_product_id' => $filter_product_id,
			'filter_status'   => $filter_status,
			'filter_sent'     => $filter_sent,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$product_total = $this->model_youzan_product->getTotalProducts($filter_data);

		$results = $this->model_youzan_product->getProducts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$product_specials = $this->model_youzan_product->getProductSpecials($result['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];

					break;
				}
			}
			
			$youzan_exist = $this->model_youzan_product->getProductToYouZan($result['product_id']);
			
			if($youzan_exist) {
				$sent = 1;	
			}else{
				$sent = 0;
			}

			$data['products'][] = array(
				'product_id' => $result['product_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'special'    => $special,
				'quantity'   => $result['quantity'],
				'sent'  	 => $sent,
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('youzan/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, true),
				'push'        => $this->url->link('youzan/product/push', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, true),
				'update'        => $this->url->link('youzan/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, true),
				'unpush'      => $this->url->link('youzan/product/unpush', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_push'] = $this->language->get('text_push');
		$data['text_unpush'] = $this->language->get('text_unpush');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_id'] = $this->language->get('column_id');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_product_id'] = $this->language->get('entry_product_id');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sent'] = $this->language->get('entry_sent');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_push'] = $this->language->get('button_push');
		$data['button_unpush'] = $this->language->get('button_unpush');
		$data['button_update'] = $this->language->get('button_update');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} elseif(isset($this->session->data['warning'])) {
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);
		$data['sort_model'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, true);
		$data['sort_price'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, true);
		$data['sort_quantity'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, true);
		$data['sort_status'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true);
		$data['sort_order'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin'))). '&nbsp;&nbsp;<input type="text" value="" name="pnum" size="2">&nbsp;&nbsp;<button type="button" id="button-jump" class="btn btn-primary pull-right"><i class="fa fa-arrow-right"></i>'.$this->language->get("button_jump").'</button>';

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_price'] = $filter_price;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_product_id'] = $filter_product_id;
		$data['filter_status'] = $filter_status;
		$data['filter_sent'] = $filter_sent;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('youzan/product_list', $data));
	}
	
	
	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_upc'] = $this->language->get('entry_upc');
		$data['entry_ean'] = $this->language->get('entry_ean');
		$data['entry_jan'] = $this->language->get('entry_jan');
		$data['entry_isbn'] = $this->language->get('entry_isbn');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_date_available'] = $this->language->get('entry_date_available');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_download'] = $this->language->get('entry_download');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_option_value'] = $this->language->get('entry_option_value');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_recurring'] = $this->language->get('entry_recurring');
		$data['entry_youzan_category'] = $this->language->get('entry_youzan_category');
		$data['entry_youzan_promotion'] = $this->language->get('entry_youzan_promotion');
		$data['entry_youzan_tag'] = $this->language->get('entry_youzan_tag');
		$data['entry_youzan_is_virtual'] = $this->language->get('entry_youzan_is_virtual');
		$data['entry_youzan_post_fee'] = $this->language->get('entry_youzan_post_fee');
		$data['entry_youzan_price'] = $this->language->get('entry_youzan_price');
		$data['entry_youzan_origin_price'] = $this->language->get('entry_youzan_origin_price');
		$data['entry_youzan_buy_url'] = $this->language->get('entry_youzan_buy_url');
		$data['entry_youzan_outer_id'] = $this->language->get('entry_youzan_outer_id');
		$data['entry_youzan_buy_quota'] = $this->language->get('entry_youzan_buy_quota');
		$data['entry_youzan_quantity'] = $this->language->get('entry_youzan_quantity');
		$data['entry_youzan_hide_quantity'] = $this->language->get('entry_youzan_hide_quantity');
		$data['entry_youzan_is_display'] = $this->language->get('entry_youzan_is_display');
		$data['entry_youzan_join_level_discount'] = $this->language->get('entry_youzan_join_level_discount');
		

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_sku'] = $this->language->get('help_sku');
		$data['help_upc'] = $this->language->get('help_upc');
		$data['help_ean'] = $this->language->get('help_ean');
		$data['help_jan'] = $this->language->get('help_jan');
		$data['help_isbn'] = $this->language->get('help_isbn');
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_category'] = $this->language->get('help_category');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_option'] = $this->language->get('tab_option');
		$data['tab_recurring'] = $this->language->get('tab_recurring');
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_special'] = $this->language->get('tab_special');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_openbay'] = $this->language->get('tab_openbay');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		
		if (isset($this->error['description'])) {
			$data['error_description'] = $this->error['description'];
		} else {
			$data['error_description'] = array();
		}

		if (isset($this->error['price'])) {
			$data['error_price'] = $this->error['price'];
		} else {
			$data['error_price'] = array();
		}

		if (isset($this->error['outer_id'])) {
			$data['error_outer_id'] = $this->error['outer_id'];
		} else {
			$data['error_outer_id'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, true)
		);

		
		$data['action'] = $this->url->link('youzan/product/push', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, true);
		

		$data['cancel'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			
			$product_info = $this->model_youzan_product->getProduct($this->request->get['product_id']);
			
		}

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['product_description'])) {
			$data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_description'] = $this->model_youzan_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$data['product_description'] = array();
		}

		$data['youzan_categories'] = $this->getYouZanCategories();
		
		$data['youzan_promotions'] = $this->getYouZanPromotionCids();
		
		$data['youzan_tags'] = $this->getYouZanTags();
		
		if (isset($this->request->post['youzan_category_id'])) {
			$data['youzan_category_id'] = $this->request->post['youzan_category_id'];
		} else {
			$data['youzan_category_id'] = 0;
		}
		
		if (isset($this->request->post['youzan_promotion_id'])) {
			$data['youzan_promotion_id'] = $this->request->post['youzan_promotion_id'];
		} else {
			$data['youzan_promotion_id'] = 0;
		}
		
		if (isset($this->request->post['youzan_tag_id'])) {
			$data['youzan_tag_id'] = $this->request->post['youzan_tag_id'];
		} else {
			$data['youzan_tag_id'] = 0;
		}
		
		if (isset($this->request->post['post_fee'])) {
			$data['post_fee'] = $this->request->post['post_fee'];
		} else {
			$data['post_fee'] = '';
		}

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$data['price'] = $product_info['price'];
		} else {
			$data['price'] = '';
		}
		
		if (isset($this->request->post['origin_price'])) {
			$data['origin_price'] = $this->request->post['origin_price'];
		} elseif (!empty($product_info)) {
			$data['origin_price'] = $product_info['price'];
		} else {
			$data['origin_price'] = '';
		}

		if (isset($this->request->post['buy_url'])) {
			$data['buy_url'] = $this->request->post['buy_url'];
		} else {
			$data['buy_url'] = HTTP_CATALOG.'index.php?route=product/product&product_id='.$this->request->get['product_id'];
		}

		if (isset($this->request->post['outer_id'])) {
			$data['outer_id'] = $this->request->post['outer_id'];
		} elseif (!empty($product_info)) {
			$data['outer_id'] = $product_info['model'];
		} else {
			$data['outer_id'] = '';
		}

		if (isset($this->request->post['buy_quota'])) {
			$data['buy_quota'] = $this->request->post['buy_quota'];
		} else {
			$data['buy_quota'] = '';
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = '';
		}

		if (isset($this->request->post['hide_quantity'])) {
			$data['hide_quantity'] = $this->request->post['hide_quantity'];
		} else {
			$data['hide_quantity'] = '';
		}

		if (isset($this->request->post['is_display'])) {
			$data['is_display'] = $this->request->post['is_display'];
		} else {
			$data['is_display'] = 1;
		}
		
		if (isset($this->request->post['join_level_discount'])) {
			$data['join_level_discount'] = $this->request->post['join_level_discount'];
		} else {
			$data['join_level_discount'] = 1;
		}

		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('youzan/product_form', $data));
	}
	
	
	protected function getUpdateForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');

		$data['entry_youzan_category'] = $this->language->get('entry_youzan_category');
		$data['entry_youzan_promotion'] = $this->language->get('entry_youzan_promotion');
		$data['entry_youzan_tag'] = $this->language->get('entry_youzan_tag');
		$data['entry_youzan_is_virtual'] = $this->language->get('entry_youzan_is_virtual');
		$data['entry_youzan_post_fee'] = $this->language->get('entry_youzan_post_fee');
		$data['entry_youzan_price'] = $this->language->get('entry_youzan_price');
		$data['entry_youzan_origin_price'] = $this->language->get('entry_youzan_origin_price');
		$data['entry_youzan_buy_url'] = $this->language->get('entry_youzan_buy_url');
		$data['entry_youzan_outer_id'] = $this->language->get('entry_youzan_outer_id');
		$data['entry_youzan_buy_quota'] = $this->language->get('entry_youzan_buy_quota');
		$data['entry_youzan_quantity'] = $this->language->get('entry_youzan_quantity');
		$data['entry_youzan_hide_quantity'] = $this->language->get('entry_youzan_hide_quantity');
		$data['entry_youzan_is_display'] = $this->language->get('entry_youzan_is_display');
		$data['entry_youzan_join_level_discount'] = $this->language->get('entry_youzan_join_level_discount');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		
		if (isset($this->error['description'])) {
			$data['error_description'] = $this->error['description'];
		} else {
			$data['error_description'] = array();
		}

		if (isset($this->error['price'])) {
			$data['error_price'] = $this->error['price'];
		} else {
			$data['error_price'] = array();
		}

		if (isset($this->error['outer_id'])) {
			$data['error_outer_id'] = $this->error['outer_id'];
		} else {
			$data['error_outer_id'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
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
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, true)
		);

		
		$data['action'] = $this->url->link('youzan/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, true);
		

		$data['cancel'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$product_info = $this->model_youzan_product->getProduct($this->request->get['product_id']);
			
		}
		
		

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['product_description'])) {
			$data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_description'] = $this->model_youzan_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$data['product_description'] = array();
		}

		$data['youzan_categories'] = $this->getYouZanCategories();
		
		$data['youzan_promotions'] = $this->getYouZanPromotionCids();
		
		$data['youzan_tags'] = $this->getYouZanTags();
		
		if (isset($this->request->post['youzan_category_id'])) {
			$data['youzan_category_id'] = $this->request->post['youzan_category_id'];
		} else {
			$data['youzan_category_id'] = 0;
		}
		
		if (isset($this->request->post['youzan_promotion_id'])) {
			$data['youzan_promotion_id'] = $this->request->post['youzan_promotion_id'];
		} else {
			$data['youzan_promotion_id'] = 0;
		}
		
		if (isset($this->request->post['youzan_tag_id'])) {
			$data['youzan_tag_id'] = $this->request->post['youzan_tag_id'];
		} else {
			$data['youzan_tag_id'] = 0;
		}
		
		if (isset($this->request->post['post_fee'])) {
			$data['post_fee'] = $this->request->post['post_fee'];
		} else {
			$data['post_fee'] = '';
		}

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$data['price'] = $product_info['price'];
		} else {
			$data['price'] = '';
		}
		
		if (isset($this->request->post['origin_price'])) {
			$data['origin_price'] = $this->request->post['origin_price'];
		} elseif (!empty($product_info)) {
			$data['origin_price'] = $product_info['price'];
		} else {
			$data['origin_price'] = '';
		}

		if (isset($this->request->post['buy_url'])) {
			$data['buy_url'] = $this->request->post['buy_url'];
		} else {
			$data['buy_url'] = HTTP_CATALOG.'index.php?route=product/product&product_id='.$this->request->get['product_id'];
		}

		if (isset($this->request->post['outer_id'])) {
			$data['outer_id'] = $this->request->post['outer_id'];
		} elseif (!empty($product_info)) {
			$data['outer_id'] = $product_info['model'];
		} else {
			$data['outer_id'] = '';
		}

		if (isset($this->request->post['buy_quota'])) {
			$data['buy_quota'] = $this->request->post['buy_quota'];
		} else {
			$data['buy_quota'] = '';
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = '';
		}

		if (isset($this->request->post['hide_quantity'])) {
			$data['hide_quantity'] = $this->request->post['hide_quantity'];
		} else {
			$data['hide_quantity'] = '';
		}

		if (isset($this->request->post['is_display'])) {
			$data['is_display'] = $this->request->post['is_display'];
		} else {
			$data['is_display'] = 1;
		}
		
		if (isset($this->request->post['join_level_discount'])) {
			$data['join_level_discount'] = $this->request->post['join_level_discount'];
		} else {
			$data['join_level_discount'] = 1;
		}

		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('youzan/product_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'youzan/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['description']) < 12) || (utf8_strlen($value['description']) > 25000)) {
				$this->error['description'][$language_id] = $this->language->get('error_description');
			}
		}

		if ($this->request->post['price'] <= 0) {
			$this->error['price'] = $this->language->get('error_price');
		}
		
		if ((utf8_strlen($this->request->post['outer_id']) < 1) || (utf8_strlen($this->request->post['outer_id']) > 64)) {
			$this->error['outer_id'] = $this->language->get('error_outer_id');
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}


	
	protected function getYouZanCategories() {
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method='kdt.itemcategories.get';
		$timestamp=date("Y-m-d H:i:s");
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$category_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&sign_method=md5&format=json';
		
		$result = file_get_contents($category_url);
		
		$youzan_categories = array();
		
		$news = json_decode($result, true);
		
		foreach($news as $category) {
	
			foreach($category['categories'] as $one) {
				
				if($one['is_parent']) {
					$youzan_categories[] = array(
						'cid'	=> $one['cid'],
						'name'	=> $one['name'],
						
					);
				}
				
				if(count($one['sub_categories']) > 1) {
					foreach($one['sub_categories'] as $two) {
						
						$youzan_categories[] = array(
							'cid'	=> $two['cid'],
							'name'	=> $one['name'].'-->'.$two['name'],
							
						);
						
					}
				}
				
			}
			
		}
		
		return $youzan_categories;
	}
	
	protected function getYouZanPromotionCids() {
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method='kdt.itemcategories.promotions.get';
		$timestamp=date("Y-m-d H:i:s");
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$promotion_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&sign_method=md5&format=json';
		
		$result = file_get_contents($promotion_url);
		
		$youzan_promotions = json_decode($result, true);
		
		return $youzan_promotions['response']['categories'];
	}
	
	protected function getYouZanTags() {
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method='kdt.itemcategories.tags.get';
		$timestamp=date("Y-m-d H:i:s");
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$tag_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&sign_method=md5&format=json';
		
		$result = file_get_contents($tag_url);
		
		$youzan_tags = json_decode($result, true);
		
		return $youzan_tags['response']['tags'];
	}
	
	public function getProductFromYouZan($youzan_id) {
		
		
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method = 'kdt.item.get';
		
		$num_iid = $youzan_id;
		
		$timestamp = date("Y-m-d H:i:s");
		
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'num_iid'.$num_iid.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$youzan_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&num_iid='.$num_iid.'&sign_method=md5&format=json';
		
		$result = file_get_contents($youzan_url);
		
		$youzan_info = json_decode($result, true);
		
		if(isset($youzan_info['response']['item']['num_iid'])) {
			
			if((int)$youzan_info['response']['item']['num_iid'] == $youzan_id) {
				
				$youzan_info = $youzan_info['response']['item'];
				
			}else{
				
				$youzan_info = false;
				
			}
			
		}else{
			$youzan_info = false;	
		}
		
		return $youzan_info;
	}
	
	public function addYouZanProduct($product_id, $data) {
		
		
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		$this->load->library('youzan/kdtapiprotocol');
		
		$this->load->library('youzan/simplehttpclient');
		
		$this->load->library('youzan/kdtapiclient');
		
		$this->load->model('youzan/product');
		
		
		date_default_timezone_set('PRC');
		
		$client = new KdtApiClient($appid, $appsecret);

		$method = 'kdt.item.add';
		$params = array(
			'cid'					=> (int)$data['youzan_category_id'],
			'promotion_cid'			=> (int)$data['youzan_promotion_id'],
			'price'					=> (float)$data['price'],
			'title' 				=> html_entity_decode($data['product_description'][(int)$this->config->get('config_language_id')]['name'], ENT_QUOTES, 'UTF-8'), 
			'desc' 					=> html_entity_decode($data['product_description'][(int)$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8'), 
			'is_virtual'			=> (int)$data['is_virtual'],
			'post_fee' 				=> (float)$data['post_fee'],	
			'origin_price'			=> $data['origin_price'],
			'buy_url'				=> urlencode($data['buy_url']),
			'outer_id'				=> trim($data['outer_id']),
			'buy_quota'				=> (int)$data['buy_quota'],
			'quantity'				=> (int)$data['quantity'],
			'hide_quantity'			=> (int)$data['hide_quantity'],
			'is_display'			=> (int)$data['is_display'],
			'join_level_discount'	=> (int)$data['join_level_discount'],
			
		);
		
		
		$product_info = $this->model_youzan_product->getProduct($product_id);
		
		$files = array();
		
		$files[] = array(
			'url' => DIR_IMAGE.$product_info['image'],
			'field' => 'images[]',
		);
		
		$product_images = $this->model_youzan_product->getProductImages($product_id);
		
		if($product_images) {
			foreach($product_images as $product_image) {
				$files[] = array(
					'url' => DIR_IMAGE.$product_image['image'],
					'field' => 'images[]',
				);
			}
		}
		
		$result = $client->post($method, $params, $files);
		
		
		if((int)$result['response']['item']['num_iid']) {
			$this->model_youzan_product->addProductYouZan($product_id, (int)$result['response']['item']['num_iid']);
			return true;
		}else{
			return false;
		}
		
	}
	
	public function updateYouZanProduct($product_id, $youzan_id, $data) {
		
		
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		$this->load->library('youzan/kdtapiprotocol');
		
		$this->load->library('youzan/simplehttpclient');
		
		$this->load->library('youzan/kdtapiclient');
		
		$this->load->model('youzan/product');
		
		
		date_default_timezone_set('PRC');
		
		$client = new KdtApiClient($appid, $appsecret);

		$method = 'kdt.item.update';
		$params = array(
			'num_iid'				=> $youzan_id,
			'cid'					=> (int)$data['youzan_category_id'],
			'promotion_cid'			=> (int)$data['youzan_promotion_id'],
			'price'					=> (float)$data['price'],
			'title' 				=> html_entity_decode($data['product_description'][(int)$this->config->get('config_language_id')]['name'], ENT_QUOTES, 'UTF-8'), 
			'desc' 					=> html_entity_decode($data['product_description'][(int)$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8'), 
			'is_virtual'			=> (int)$data['is_virtual'],
			'post_fee' 				=> (float)$data['post_fee'],	
			'origin_price'			=> $data['origin_price'],
			'buy_url'				=> urlencode($data['buy_url']),
			'outer_id'				=> trim($data['outer_id']),
			'buy_quota'				=> (int)$data['buy_quota'],
			'quantity'				=> (int)$data['quantity'],
			'hide_quantity'			=> (int)$data['hide_quantity'],
			'is_display'			=> (int)$data['is_display'],
			'join_level_discount'	=> (int)$data['join_level_discount'],
			
		);
		
		
		$product_info = $this->model_youzan_product->getProduct($product_id);
		
		$files = array();
		
		$files[] = array(
			'url' => DIR_IMAGE.$product_info['image'],
			'field' => 'images[]',
		);
		
		$product_images = $this->model_youzan_product->getProductImages($product_id);
		
		if($product_images) {
			foreach($product_images as $product_image) {
				$files[] = array(
					'url' => DIR_IMAGE.$product_image['image'],
					'field' => 'images[]',
				);
			}
		}
		
		$result = $client->post($method, $params, $files);
		
		
		if((int)$result['response']['item']['num_iid']) {
			return true;
		}else{
			return false;
		}
		
	}
	
	public function deleteYouZanProduct($youzan_id) {
		
		
		$appid = $this->config->get('config_youzan_appid');
		
		$appsecret = $this->config->get('config_youzan_appsecret');
		
		$this->load->library('youzan/kdtapiprotocol');
		
		$this->load->library('youzan/simplehttpclient');
		
		$this->load->library('youzan/kdtapiclient');
		
		date_default_timezone_set('PRC');
		
		$client = new KdtApiClient($appid, $appsecret);

		$method = 'kdt.item.delete';
		$params = array(
			'num_iid'				=> $youzan_id,
		);

		$result = $client->post($method, $params);
		
		if($result['response']['is_success']) {
			return true;
		}else{
			return false;
		}
		
	}
	
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('youzan/product');
			$this->load->model('catalog/option');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 50;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_youzan_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_youzan_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
}


