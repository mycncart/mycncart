<?php
class ControllerExtensionModuleKefu extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/kefu');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_online'] = $this->language->get('text_online');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_qq'] = $this->language->get('text_qq');
		$data['text_weixin_image'] = $this->language->get('text_weixin_image');
		
		$data['telephone'] = $setting['telephone'];
		
		$this->load->model('tool/image');
		
		if ($setting['image']) {
			$data['image'] = $this->model_tool_image->resize($setting['image'], 106, 106);
		} else {
			$data['image'] = '';
		}
		
		$data['image_title'] = $setting['image_title'];
		$data['qqs'] = $setting['service_qq'];
		
		$this->load->helper('mobile');
		if (is_mobile()) {
			
		} else {
			if ($data['telephone'] || $data['image'] || $data['qqs']) {
				return $this->load->view('extension/module/kefu', $data);
			}
		}
	}
}