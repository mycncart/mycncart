<?php
class ControllerReportVisitor extends Controller {
	public function index() {
		$this->load->language('report/visitor');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = '';
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = '';
		}

		if (isset($this->request->get['filter_store_id'])) {
			$filter_store_id = $this->request->get['filter_store_id'];
		} else {
			$filter_store_id = '';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
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
			'href' => $this->url->link('report/visitor', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		$this->load->model('report/visitor');

		$data['visitors'] = array();

		$filter_data = array(
			'filter_ip'       => $filter_ip,
			'filter_product_id' => $filter_product_id,
			'filter_store_id' => $filter_store_id,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$visitor_total = $this->model_report_visitor->getTotalVisitors($filter_data);

		$results = $this->model_report_visitor->getVisitors($filter_data);

		foreach ($results as $result) {
			$block_info = $this->model_report_visitor->getBlockInfo($result['ip']);

			if ($block_info) {
				$block_status = 1;
			} else {
				$block_status = 0;
			}

			$data['visitors'][] = array(
				'visitor_id' 	=> $result['visitor_id'],
				'store'         => $result['store'] ? $result['store'] : $this->language->get('text_default_store'),
				'visit_time'    => $result['visit_time'],
				'd_time'        => $result['d_time'] ? $result['d_time'].'s' : $this->language->get('text_page_change'),
				'referer'       => $result['referer'] ? $result['referer'] : $this->language->get('text_direct'),
				'current_page'  => $result['current_page'],
				'ip'          	=> $result['ip'],
				'country'       => $result['country'],
				'product_id'    => $result['product_id'] ? $result['product_id'] : '',
				'browser'       => $result['browser'],
				'block_status' 	=> $block_status,
				'cancel'        => $this->url->link('report/visitor/cancel', 'user_token=' . $this->session->data['user_token'] . '&ip=' . $result['ip'], true),
				'block'        => $this->url->link('report/visitor/block', 'user_token=' . $this->session->data['user_token'] . '&ip=' . $result['ip'], true)
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		$this->load->model('setting/store');

		$data['stores'] = array();
		
		$data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->language->get('text_default_store')
		);

		$stores = $this->model_setting_store->getStores();
		foreach ($stores as $store) {
			$data['stores'][] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name']
			);
		}

		$url = '';

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_store_id'])) {
			$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
		}

		$pagination = new Pagination();
		$pagination->total = $visitor_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('report/visitor', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($visitor_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($visitor_total - $this->config->get('config_limit_admin'))) ? $visitor_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $visitor_total, ceil($visitor_total / $this->config->get('config_limit_admin')));

		$data['filter_product_id'] = $filter_product_id;
		$data['filter_store_id'] = $filter_store_id;
		$data['filter_ip'] = $filter_ip;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('report/visitor', $data));
	}

	public function cancel() {
		$this->load->language('report/visitor');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('report/visitor');

		if (isset($this->request->get['ip'])) {
			
			$this->model_report_visitor->deleteIP($this->request->get['ip']);
			

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
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

			$this->response->redirect($this->url->link('report/visitor', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		
	}

	public function block() {
		$this->load->language('report/visitor');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('report/visitor');

		if (isset($this->request->get['ip'])) {
			$this->model_report_visitor->addIP($this->request->get['ip']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}

			if (isset($this->request->get['filter_store_id'])) {
				$url .= '&filter_store_id=' . $this->request->get['filter_store_id'];
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

			$this->response->redirect($this->url->link('report/visitor', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		
	}
}