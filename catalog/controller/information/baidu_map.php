<?php
class ControllerInformationBaiduMap extends Controller {
	public function index() {
		$this->load->language('information/baidu_map');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$data['breadcrumbs'][] = array(
			'text' => $this->config->get('config_name'),
			'href' => $this->url->link('information/baidu_map')
		);

		$data['heading_title'] = $this->config->get('config_name');
		
		$geocode = explode(',', $this->config->get('config_geocode'));
		
		if($geocode & (count($geocode) == 2)) {
			$data['geocode_x'] = $geocode[0];
			$data['geocode_y'] = $geocode[1];
		}else{
			$data['geocode_x'] = 116.403866;
			$data['geocode_y'] = 39.91523;
		}
		
		$data['store_name'] = $this->config->get('config_name');
		
		$data['store_address'] = $this->config->get('config_address');

		$data['button_continue'] = $this->language->get('button_continue');


		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/baidu_map.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/baidu_map.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/baidu_map.tpl', $data));
		}
		
	}

}