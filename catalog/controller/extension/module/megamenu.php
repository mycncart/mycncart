<?php
class ControllerExtensionModuleMegamenu extends Controller {
	public function index() {
		$this->load->model('catalog/product'); 
		$this->load->model('tool/image');
		$this->load->model( 'extension/menu/megamenu' );
		
		$this->load->language('extension/module/megamenu');

		$config_theme = $this->config->get('config_theme');
		
		if (file_exists('catalog/view/theme/' . $config_theme . '/stylesheet/megamenu/style.css')) {
			$this->document->addStyle('catalog/view/theme/' . $config_theme . '/stylesheet/megamenu/style.css');
		} else {
			echo '缺少菜单css文件';
		}		
		
		$params = '';
		
		//$params = $this->config->get( 'params' );
	 	
		$this->load->model('setting/setting');
		
		//$params = $this->model_setting_setting->getSetting( 'pavmegamenu_params' );

		 
		//if( isset($params['pavmegamenu_params']) && !empty($params['pavmegamenu_params']) ){
	 		//$params = json_decode( $params['pavmegamenu_params'] );
	 	//}
		
		//get store
		$store_id = $this->config->get('config_store_id');
		$data['store_id'] = $store_id;

		$parent = '1';
		$data['treemenu'] = $this->model_extension_menu_megamenu->getTree( $parent, true, $params, $store_id);
		
 		return $this->load->view('extension/module/megamenu', $data);

	}
}