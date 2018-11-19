<?php
class ControllerExtensionModuleMegamenu extends Controller {
    public function index($setting) {
		
        $this->load->model('extension/module/megamenu');
        
		$this->document->addStyle('catalog/view/javascript/start/megamenu/megamenu.css');
        $this->document->addStyle('catalog/view/javascript/start/megamenu/wide-grid.css');
        $this->document->addScript('catalog/view/javascript/start/megamenu/megamenu.js');
		
		$module_id = (isset($setting['moduleid']) && $setting['moduleid']) ? $setting['moduleid'] : 0;
        
		$data['menu'] = $this->model_extension_module_megamenu->getMenu($module_id);

        //dev
        $this->load->language('extension/module/megamenu');
        $data['text_more_category']             = $this->language->get('text_more_category');
        $data['text_close_category']            = $this->language->get('text_close_category');

		foreach($data['menu'] as &$menu){
			if(isset($menu['link']) && $menu['link']){
				$menu['link'] = trim($menu['link']);
				$link = (isset($menu['link']) && ($menu['link'])) ? unserialize($menu['link']) : array();
				$menu['route'] = '';
				$menu['path'] = '';
				if($link){
					if(isset($menu['type_link']) && $menu['type_link'] == 1){
						$menu['link'] = $this->url->link('product/category', 'path=' . $link['category']);
						$menu['route'] = 'product/category';
						$menu['path']	= $link['category'];
					}else
						$menu['link'] = $link['url'];
				}
				else
					$menu['link'] = '';
			}	
		}
        
		$lang_id = $this->config->get('config_language_id');
		
		if($setting['show_itemver'] == ""){
			$setting['show_itemver'] = 5;
		}
        
		$data['megamenu_setting'] = array(
            'orientation' => $setting['orientation'],
            'search_bar' => $setting['search_bar'],
            'navigation_text' => $setting['navigation_text'],
            'full_width' => $setting['full_width'],
            'home_item' => $setting['home_item'],
            'home_text' => $setting['home_text'],
            'animation' => $setting['animation'],
            'show_itemver' => $setting['show_itemver'],
            'animation_time' => $setting['animation_time'],
			'disp_title_module' => isset($setting['disp_title_module']) ? $setting['disp_title_module'] : ''
        );
		
        $data['navigation_text'] = 'Navigation';
        
		if(isset($setting['navigation_text'][$lang_id])) {
            if(!empty($setting['navigation_text'][$lang_id])) {
                $data['navigation_text'] = $setting['navigation_text'][$lang_id];
            }
        }
        
		if(isset($setting['head_name'][$lang_id])) {
            if(!empty($setting['head_name'][$lang_id])) {
                $data['head_name'] = $setting['head_name'][$lang_id];
            }
        }		
        
		$data['home_text'] = 'Home';
        
		if(isset($setting['home_text'][$lang_id])) {
            if(!empty($setting['home_text'][$lang_id])) {
                $data['home_text'] = $setting['home_text'][$lang_id];
            }
        }
        
		$data['home'] = $this->url->link('common/home');
        $data['lang_id'] = $this->config->get('config_language_id');

        $http = $_SERVER["HTTPS"]  ? 'https://' : 'http://';
        $data['actual_link'] = $http."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (isset($_GET['route'])) {
            $data['route']  = $_GET['route'];
		} else {
            $data['route']  = '';
		}

        if (isset($_GET['path'])) {
            $data['path']   = $_GET['path'];
		} else {
            $data['path']   = '';
		}
		
        // Search
        $this->language->load('common/header');

       
			
        return $this->load->view('extension/module/megamenu/default', $data);
        
    }
}
?>