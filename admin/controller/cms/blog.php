<?php
class ControllerCmsBlog extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('cms/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('cms/blog');

		$this->getList();
	}

	public function add() {
		$this->load->language('cms/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('cms/blog');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cms_blog->addBlog($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}


			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('cms/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('cms/blog');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			
			$this->model_cms_blog->editBlog($this->request->get['blog_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('cms/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('cms/blog');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			foreach ($this->request->post['selected'] as $blog_id) {
				$this->model_cms_blog->deleteBlog($blog_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}



	protected function getList() {
		if (isset($this->request->get['filter_title'])) {
			$filter_title = $this->request->get['filter_title'];
		} else {
			$filter_title = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.title';
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

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('cms/blog/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['copy'] = $this->url->link('cms/blog/copy', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('cms/blog/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['blogs'] = array();

		$filter_data = array(
			'filter_title'	  => $filter_title,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$blog_total = $this->model_cms_blog->getTotalBlogs($filter_data);

		$results = $this->model_cms_blog->getBlogs($filter_data);

		foreach ($results as $result) {

			$data['blogs'][] = array(
				'blog_id' => $result['blog_id'],
				'title'       => $result['title'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('cms/blog/edit', 'user_token=' . $this->session->data['user_token'] . '&blog_id=' . $result['blog_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_title'] = $this->language->get('column_title');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

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

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_title'] = $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . '&sort=pd.title' . $url, true);
		$data['sort_status'] = $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . '&sort=p.status' . $url, true);
		$data['sort_order'] = $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . '&sort=p.sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $blog_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($blog_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($blog_total - $this->config->get('config_limit_admin'))) ? $blog_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $blog_total, ceil($blog_total / $this->config->get('config_limit_admin')));

		$data['filter_title'] = $filter_title;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('cms/blog_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['blog_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_slider'] = $this->language->get('text_slider');
		$data['text_classic'] = $this->language->get('text_classic');
		$data['text_keyword'] = $this->language->get('text_keyword');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_brief'] = $this->language->get('entry_brief');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_featured'] = $this->language->get('entry_featured');
		$data['entry_hits'] = $this->language->get('entry_hits');
		$data['entry_created'] = $this->language->get('entry_created');
		$data['entry_user'] = $this->language->get('entry_user');
		$data['entry_video_code'] = $this->language->get('entry_video_code');
		$data['entry_blog_category'] = $this->language->get('entry_blog_category');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_youtube'] = $this->language->get('entry_youtube');
		$data['entry_soundcloud'] = $this->language->get('entry_soundcloud');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_product_related'] = $this->language->get('entry_product_related');
		$data['entry_blog_related'] = $this->language->get('entry_blog_related');
		

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_tag'] = $this->language->get('help_tag');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_design'] = $this->language->get('tab_design');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
		}
		
		if (isset($this->error['description'])) {
			$data['error_description'] = $this->error['description'];
		} else {
			$data['error_description'] = array();
		}
		
		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['blog_id'])) {
			$data['action'] = $this->url->link('cms/blog/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('cms/blog/edit', 'user_token=' . $this->session->data['user_token'] . '&blog_id=' . $this->request->get['blog_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('cms/blog', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['blog_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$blog_info = $this->model_cms_blog->getBlog($this->request->get['blog_id']);
		}

		$data['user_token'] = $this->session->data['user_token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['blog_description'])) {
			$data['blog_description'] = $this->request->post['blog_description'];
		} elseif (isset($this->request->get['blog_id'])) {
			$data['blog_description'] = $this->model_cms_blog->getBlogDescription($this->request->get['blog_id']);
		} else {
			$data['blog_description'] = array();
		}


		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['blog_store'])) {
			$data['blog_store'] = $this->request->post['blog_store'];
		} elseif (isset($this->request->get['blog_id'])) {
			$data['blog_store'] = $this->model_cms_blog->getBlogStores($this->request->get['blog_id']);
		} else {
			$data['blog_store'] = array(0);
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($blog_info)) {
			$data['image'] = $blog_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($blog_info) && is_file(DIR_IMAGE . $blog_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($blog_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($blog_info)) {
			$data['keyword'] = $blog_info['keyword'];
		} else {
			$data['keyword'] = '';
		}
		
		if (isset($this->request->post['featured'])) {
			$data['featured'] = $this->request->post['featured'];
		} elseif (!empty($blog_info)) {
			$data['featured'] = $blog_info['featured'];
		} else {
			$data['featured'] = 0;
		}
		
		if (isset($this->request->post['hits'])) {
			$data['hits'] = $this->request->post['hits'];
		} elseif (!empty($blog_info)) {
			$data['hits'] = $blog_info['hits'];
		} else {
			$data['hits'] = '';
		}
		
		if (isset($this->request->post['created'])) {
			$data['created'] = $this->request->post['created'];
		} elseif (!empty($blog_info)) {
			$data['created'] = ($blog_info['created'] != '0000-00-00') ? $blog_info['created'] : '';
		} else {
			$data['created'] = date('Y-m-d');
		}
		
		$this->load->model('user/user');

		$data['users'] = $this->model_user_user->getUsers();
		
		if (isset($this->request->post['user_id'])) {
			$data['user_id'] = $this->request->post['user_id'];
		} elseif (!empty($blog_info)) {
			$data['user_id'] = $blog_info['user_id'];
		} else {
			$data['user_id'] = $this->user->getId();
		}
		

		$data['stores'] = array();
		
		$data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->language->get('text_default')
		);
		
		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
			);
		}
		
		
		//Blog Categories
		$this->load->model('cms/blog_category');

		if (isset($this->request->post['blog_category'])) {
			$blog_categories = $this->request->post['blog_category'];
		} elseif (isset($this->request->get['blog_id'])) {
			$blog_categories = $this->model_cms_blog->getBlogBlogCategories($this->request->get['blog_id']);
		} else {
			$blog_categories = array();
		}

		$data['blog_categories'] = array();

		foreach ($blog_categories as $blog_category_id) {
			$blog_category_info = $this->model_cms_blog_category->getBlogCategory($blog_category_id);

			if ($blog_category_info) {
				$data['blog_categories'][] = array(
					'blog_category_id' => $blog_category_info['blog_category_id'],
					'name'        => ($blog_category_info['path']) ? $blog_category_info['path'] . ' &gt; ' . $blog_category_info['name'] : $blog_category_info['name']
				);
			}
		}	
		
		if (isset($this->request->post['video_code'])) {
			$data['video_code'] = $this->request->post['video_code'];
		} elseif (!empty($blog_info)) {
			$data['video_code'] = $blog_info['video_code'];
		} else {
			$data['video_code'] = '';
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($blog_info)) {
			$data['sort_order'] = $blog_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($blog_info)) {
			$data['status'] = $blog_info['status'];
		} else {
			$data['status'] = true;
		}
		
		$this->load->model('catalog/product');
		
		if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} elseif (isset($this->request->get['blog_id'])) {
			$products = $this->model_cms_blog->getProductRelated($this->request->get['blog_id']);
		} else {
			$products = array();
		}

		$data['product_relateds'] = array();

		foreach ($products as $product_id) {
			$related_info = $this->model_catalog_product->getProduct($product_id);

			if ($related_info) {
				$data['product_relateds'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}
		
		
		if (isset($this->request->post['blog_related'])) {
			$blogs = $this->request->post['blog_related'];
		} elseif (isset($this->request->get['blog_id'])) {
			$blogs = $this->model_cms_blog->getBlogRelated($this->request->get['blog_id']);
		} else {
			$blogs = array();
		}

		$data['blog_relateds'] = array();
		

		foreach ($blogs as $blog_id) {
			$related_info = $this->model_cms_blog->getBlog($blog_id);

			if ($related_info) {
				$data['blog_relateds'][] = array(
					'blog_id' => $related_info['blog_id'],
					'title'       => $related_info['title']
				);
			}
		}
		
		if (isset($this->request->post['blog_seo_url'])) {
			$data['blog_seo_url'] = $this->request->post['blog_seo_url'];
		} elseif (isset($this->request->get['blog_id'])) {
			$data['blog_seo_url'] = $this->model_cms_blog->getBlogSeoUrls($this->request->get['blog_id']);
		} else {
			$data['blog_seo_url'] = array();
		}
		
		if (isset($this->request->post['blog_layout'])) {
			$data['blog_layout'] = $this->request->post['blog_layout'];
		} elseif (isset($this->request->get['blog_id'])) {
			$data['blog_layout'] = $this->model_cms_blog->getBlogLayouts($this->request->get['blog_id']);
		} else {
			$data['blog_layout'] = array();
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('cms/blog_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'cms/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['blog_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}
		
		if ($this->request->post['blog_seo_url']) {
			$this->load->model('design/seo_url');
			
			foreach ($this->request->post['blog_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (trim($keyword)) {
						if (count(array_keys($language, $keyword)) > 1) {
							$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
						}

						$seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);
	
						foreach ($seo_urls as $seo_url) {
							if (($seo_url['store_id'] == $store_id) && (!isset($this->request->get['blog_id']) || ($seo_url['query'] != 'blog_id=' . $this->request->get['blog_id']))) {		
								$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');
				
								break;
							}
						}
					}
				}
			}
		}
		

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'cms/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_title'])) {
			$this->load->model('cms/blog');

			if (isset($this->request->get['filter_title'])) {
				$filter_title = $this->request->get['filter_title'];
			} else {
				$filter_title = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = $this->config->get('config_limit_autocomplete');
			}

			$filter_data = array(
				'filter_title'  => $filter_title,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_cms_blog->getBlogs($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$json[] = array(
					'blog_id' => $result['blog_id'],
					'title'       => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}