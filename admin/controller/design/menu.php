<?php
class ControllerDesignMenu extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('design/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/menu');

		$this->getList();
	}

	public function add() {
		$this->load->language('design/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/menu');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_menu->addMenu($this->request->post);

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

			$this->response->redirect($this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('design/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/menu');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_menu->editmenu($this->request->get['menu_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('design/menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/menu');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $menu_id) {
				$this->model_design_menu->deletemenu($menu_id);
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

			$this->response->redirect($this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url));
		}

		$this->getList();
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		$data['add'] = $this->url->link('design/menu/add', 'user_token=' . $this->session->data['user_token'] . $url);
		$data['delete'] = $this->url->link('design/menu/delete', 'user_token=' . $this->session->data['user_token'] . $url);

		$data['menus'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$menu_total = $this->model_design_menu->getTotalMenus();

		$results = $this->model_design_menu->getMenus($filter_data);

		foreach ($results as $result) {
			$data['menus'][] = array(
				'menu_id' => $result['menu_id'],
				'name'      => $result['name'],
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'      => $this->url->link('design/menu/edit', 'user_token=' . $this->session->data['user_token'] . '&menu_id=' . $result['menu_id'] . $url)
			);
		}

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

		$data['sort_name'] = $this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url);
		$data['sort_status'] = $this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . '&sort=status' . $url);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['pagination'] = $this->load->controller('common/pagination', array(
			'total' => $menu_total,
			'page'  => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'url'   => $this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}')
		));

		$data['results'] = sprintf($this->language->get('text_pagination'), ($menu_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($menu_total - $this->config->get('config_limit_admin'))) ? $menu_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $menu_total, ceil($menu_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/menu_list', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['menu_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
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
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url)
		);

		if (!isset($this->request->get['menu_id'])) {
			$data['action'] = $this->url->link('design/menu/add', 'user_token=' . $this->session->data['user_token'] . $url);
		} else {
			$data['action'] = $this->url->link('design/menu/edit', 'user_token=' . $this->session->data['user_token'] . '&menu_id=' . $this->request->get['menu_id'] . $url);
		}

		$data['cancel'] = $this->url->link('design/menu', 'user_token=' . $this->session->data['user_token'] . $url);

		if (isset($this->request->get['menu_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$menu_info = $this->model_design_menu->getmenu($this->request->get['menu_id']);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($menu_info)) {
			$data['name'] = $menu_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($menu_info)) {
			$data['status'] = $menu_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['menu_type'])) {
            $data['menu_type'] = $this->request->post['menu_type'];
        } elseif (!empty($menu_info)) {
            $data['menu_type'] = $menu_info['menu_type'];
        } else {
            $data['menu_type'] = 'horizontal';
        }

		$data['top_items'] = array();
        if (isset($this->request->get['menu_id'])) {
            $results = $this->model_design_menu->getTopItems($this->request->get['menu_id']);

            foreach ($results as $result) {
                $sub_items_lv2 = $this->model_design_menu->getSubItems($result['menu_item_id'], 2);

                $sub_items2 = array();

                if($sub_items_lv2) {
                    foreach ($sub_items_lv2 as $item) {
                        $sub_items_lv3 = $this->model_design_menu->getSubItems($item['sub_menu_item_id'], 3);

                        $sub_items3 = array();

                        if($sub_items_lv3) {
                            foreach ($sub_items_lv3 as $s_item) {
                                $sub_items3[] = array(
                                    'item_id'   => $s_item['sub_menu_item_id'],
                                    'name'      => $s_item['name'],
                                    'position'  => $s_item['position'],
                                    'url'           => $this->url->link('design/menu/editSubItem', 'user_token=' . $this->session->data['user_token'] . '&sub_menu_item_id=' . $s_item['sub_menu_item_id'] . '&menu_id=' . $this->request->get['menu_id'], true),
                                    'del_url'       => $this->url->link('design/menu/deleteSubItem', 'user_token=' . $this->session->data['user_token'] . '&sub_menu_item_id=' . $s_item['sub_menu_item_id'] . '&menu_id=' . $this->request->get['menu_id'], true)
                                );
                            }
                        }

                        $sub_items2[] = array(
                            'sub_items'     => $sub_items3,
                            'item_id'   => $item['sub_menu_item_id'],
                            'name'      => $item['name'],
                            'position'  => $item['position'],
                            'url'           => $this->url->link('design/menu/editSubItem', 'user_token=' . $this->session->data['user_token'] . '&sub_menu_item_id=' . $item['sub_menu_item_id'] . '&menu_id=' . $this->request->get['menu_id'], true),
                            'del_url'       => $this->url->link('design/menu/deleteSubItem', 'user_token=' . $this->session->data['user_token'] . '&sub_menu_item_id=' . $item['sub_menu_item_id'] . '&menu_id=' . $this->request->get['menu_id'], true)
                        );
                    }
                }

                $data['top_items'][] = array(
                    'sub_items'     => $sub_items2,
                    'name'          => $result['name'],
                    'menu_item_id'  => $result['menu_item_id'],
                    'position'      => $result['position'],
                    'url'           => $this->url->link('design/menu/editTopItem', 'user_token=' . $this->session->data['user_token'] . '&menu_item_id=' . $result['menu_item_id'] . '&menu_id=' . $this->request->get['menu_id'], true),
                    'del_url'       => $this->url->link('design/menu/deleteTopItem', 'user_token=' . $this->session->data['user_token'] . '&menu_item_id=' . $result['menu_item_id'] . '&menu_id=' . $this->request->get['menu_id'], true)
                );
            }
        }

        if (isset($this->request->get['menu_id'])) {
            $data['top_items_form_url'] = $this->url->link('design/menu/addTopItem', 'user_token=' . $this->session->data['user_token'] . '&menu_id=' . $this->request->get['menu_id'], true);
            $data['sub_item_add_form_url'] = $this->url->link('design/menu/addSubItem', 'user_token=' . $this->session->data['user_token'] . '&menu_id=' . $this->request->get['menu_id'], true);
            $data['sub_item_edit_form_url'] = $this->url->link('design/menu/editSubItem', 'user_token=' . $this->session->data['user_token'] . '&menu_id=' . $this->request->get['menu_id'], true);
            $data['multiple_del_url'] = $this->url->link('design/menu/deleteMultipleItems', 'user_token=' . $this->session->data['user_token'] . '&menu_id=' . $this->request->get['menu_id'], true);
        } else {
            $data['top_items_form_url'] = $this->url->link('design/menu/addTopItem', 'user_token=' . $this->session->data['user_token'], true);
            $data['sub_item_add_form_url'] = $this->url->link('design/menu/addSubItem', 'user_token=' . $this->session->data['user_token'], true);
            $data['sub_item_edit_form_url'] = $this->url->link('design/menu/editSubItem', 'user_token=' . $this->session->data['user_token'], true);
            $data['multiple_del_url'] = $this->url->link('design/menu/deleteMultipleItems', 'user_token=' . $this->session->data['user_token'], true);
        }

        $data['get_top_items_url'] = $this->url->link('design/menu/getTopItemsByAjax', 'user_token=' . $this->session->data['user_token'], true);

        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $data['loader_image'] = HTTP_SERVER . 'view/image/menu/ajax_loader.gif';
        } else {
            $data['loader_image'] = HTTP_SERVER . 'view/image/menu/ajax_loader.gif';
        }

        $this->document->addScript('view/javascript/menu/jscolor.js');
        $this->document->addScript('view/javascript/menu/menu.js');
        $this->document->addScript('view/javascript/jquery/jquery-ui/jquery-ui.js');
        $this->document->addStyle('view/javascript/jquery/jquery-ui/jquery-ui.css');
        $this->document->addStyle('view/stylesheet/menu/menu.css');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/menu_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (isset($this->request->post['menu_image'])) {
			foreach ($this->request->post['menu_image'] as $language_id => $value) {
				foreach ($value as $menu_image_id => $menu_image) {
					if ((utf8_strlen($menu_image['title']) < 2) || (utf8_strlen($menu_image['title']) > 64)) {
						$this->error['menu_image'][$language_id][$menu_image_id] = $this->language->get('error_title');
					}
				}
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}