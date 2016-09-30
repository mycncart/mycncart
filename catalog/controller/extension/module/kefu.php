<?php
class ControllerExtensionModuleKefu extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/kefu');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_qq'] = $this->language->get('text_qq');
		$data['text_weixin_image'] = $this->language->get('text_weixin_image');
		
		$data['telephone'] = $setting['telephone'];
		$data['image'] = $setting['image'];
		$data['qqs'] = $setting['service_qq'];
		

		if ($data['telephone'] || $data['image'] || $data['qqs']) {
			return $this->load->view('extension/module/kefu', $data);
		}
	}
}