<?php
class ControllerExtensionModuleMegamenu extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/megamenu');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addStyle('view/stylesheet/megamenu.css');
		$this->document->addScript('view/javascript/megamenu/jquerycookie.js');
		$this->document->addStyle('view/javascript/jquery/jquery-ui/jquery-ui.min.css');
		$this->document->addScript('view/javascript/jquery/jquery-ui/jquery-ui.min.js');
		$this->document->addScript('view/javascript/megamenu/jquery.nestable.js');
		$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
		$this->document->addScript('view/javascript/ckeditor/adapters/jquery.js');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.min.js');//再次加载以解决jquery ui 与 bootstrap的冲突
		
		$this->load->model('extension/menu/megamenu');
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/information');
		$this->load->model('localisation/language');
		$this->load->model('tool/image');
		$this->load->model('setting/setting');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			
			$id = 0;
			$this->load->model('extension/menu/megamenu');
			$megamenu = $this->request->post['megamenu'];
			$store_param = isset($megamenu['store_id'])?'&store_id='.$megamenu['store_id']:'';
			
			//模组状态与菜单项参数分离
			$module_status = array(
				'module_megamenu_status' => $this->request->post['module_megamenu_status'],
			); 
			
			$this->model_setting_setting->editSetting('module_megamenu', $module_status);
			
			$posts = $this->request->post;
			unset($posts['module_megamenu_status']);
			
			if($this->request->post['save_mode']=='delete-categories'){
				$this->model_extension_menu_megamenu->deletecategories($megamenu['store_id']);
			} elseif ($this->request->post['save_mode']=='import-categories'){
				$this->model_extension_menu_megamenu->importCategories($megamenu['store_id']);
			} else {
				if($this->validate() ) {
					$id = $this->model_extension_menu_megamenu->editData($posts);
				}
			}

			if( isset($id) && $this->request->post['save_mode']=='save-edit'){
				$this->response->redirect($this->url->link('extension/module/megamenu', 'id='.$id.'&user_token=' . $this->session->data['user_token'].$store_param));
			}else {
				$this->response->redirect($this->url->link('extension/module/megamenu', 'user_token=' . $this->session->data['user_token'].$store_param));
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module'));

		}

		if (isset($this->session->data['warning'])) {
			$data['error_warning'] =$this->session->data['warning'];
			unset($this->session->data['warning']);
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['dimension'])) {
			$data['error_dimension'] = $this->error['dimension'];
		} else {
			$data['error_dimension'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/megamenu', 'user_token=' . $this->session->data['user_token'])
		);
		
		if (isset($this->request->get['store_id'])){
			$store_id = $this->request->get['store_id'];
			$store_param = "&store_id=".$store_id;
		} else {
			$store_id = 0;
			$store_param = "";
		}
		
		$data['store_id'] = $store_id;
		
		//操作链接
		$actionDel  = $this->url->link('extension/module/megamenu/delete', 'user_token=' . $this->session->data['user_token'].$store_param);
   		$updateTree = $this->url->link('extension/module/megamenu/update', 'root=1'.$store_param.'&user_token=' . $this->session->data['user_token']);
		
		$data['action']        = $this->url->link('extension/module/megamenu', 'user_token=' . $this->session->data['user_token'].$store_param);
		$data['actionGetTree'] = $this->url->link('extension/module/megamenu/gettree', 'user_token=' . $this->session->data['user_token'].$store_param);
		$data['actionDel']     = str_replace("&amp;", "&", $actionDel);
		$data['updateTree']    = str_replace("&amp;", "&", $updateTree);
		$data['liveedit_url']  = $this->url->link('extension/module/megamenu/liveedit', 'root=1'.$store_param.'&user_token=' . $this->session->data['user_token']);
		$data['cancel']        = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'].$store_param.'&type=module');
		
		//获取店铺
		$this->load->model('setting/store');

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
		
		//菜单链接类型
		$data['megamenutypes'] = array(
			'url' 	 	   => $this->language->get('text_url'),
			'category' 	   => $this->language->get('text_category'),
			'information'  => $this->language->get('text_information'),
			'product' 	   => $this->language->get('text_product'),
			'manufacturer' => $this->language->get('text_manufacturer'),
			'html'  	   => $this->language->get('text_html')
		);
		

		//模组状态
		if (isset($this->request->post['module_megamenu_status'])) {
			$data['module_megamenu_status'] = $this->request->post['module_megamenu_status'];
		} else {
			$data['module_megamenu_status'] = $this->config->get('module_megamenu_status');
		}
		
		//megamenu id
		$data['currentID'] = 0 ;
		if(isset($this->request->get['id'] ) ){
			$data['currentID'] = $this->request->get['id'];
		}

		//菜单树
		$data['tree'] = $this->model_extension_menu_megamenu->getTree(null, $store_id, $data['currentID'] );
		
		//占位符
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		//获取表单
		$id = 0;
		
		if(isset($this->request->post) && isset($this->request->post['id']) ) {
			$id = (int)$this->request->post['id'] ;
		}elseif(isset($this->request->get["id"]) ){
			$id = (int)$this->request->get['id'];
		}
		
		$default = array(
			'megamenu_id'=>'',
			'title' => '',
			'parent_id'=> '',
			'image' => '',
			'is_group'=>'',
			'width'=>'12',
			'menu_class'=>'',
			'submenu_colum_width'=>'',
			'is_group'=>'',
			'submenu_width'=>'12',
			'column_width'=>'200',
			'submenu_column_width'=>'',
			'colums'=>'1',
			'type' => '',
			'item' => '',
			'is_content'=>'',
			'show_title'=>'1',
			'type_submenu'=>'',
			'level_depth'=>'',
			'status'    => '',
			'position'  => '',
			'show_sub' => '',
			'url' => '',
			'targer' => '',
			'level'=> '',
			'content_text'=>'',
			'submenu_content'=>'',
			'published' => 1,
			'widget_id'=> 0,
			'badges' =>''
		);
		
		
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
	
		
		$data['user_token'] = $this->session->data['user_token'];
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['informations'] = $this->model_catalog_information->getInformations();

		$menu = $this->model_extension_menu_megamenu->getInfo($id);
		$menu = array_merge($default, $menu);
		
		$data['menu'] = $menu;  
		$data['menus'] = $this->model_extension_menu_megamenu->getDropdown(null, $menu['parent_id'], $store_id );
		
		if ($menu['image']) {
			$data['thumb'] = $this->model_tool_image->resize($menu['image'], 100, 100);
		} else {
			$data['thumb'] = $data['placeholder'];
		}
		
		if( $menu['item'] ){   
			switch( $menu['type'] ){
				case 'category':
					$category = $this->model_catalog_category->getCategory($menu['item']);
					$menu['megamenu-category'] = isset($category['name'])?$category['name']:"";
					$menu['megamenu_category'] = $menu['megamenu-category'];
					break;
				case 'product':
					$product = $this->model_catalog_product->getProduct($menu['item']);
					$menu['megamenu-product'] = isset($product['name'])?$product['name']:"";
					$menu['megamenu_product'] = $menu['megamenu-product'];
					break;
				case 'information':
					$menu['megamenu-information'] = $menu['item'];
					$menu['megamenu_information'] = $menu['megamenu-information'];
					break;
				case 'manufacturer':
					$manufacturer = $this->model_catalog_manufacturer->getManufacturer( $menu['item'] );
					$menu['megamenu-manufacturer'] = isset($manufacturer['name'])?$manufacturer['name']:"";
					$menu['megamenu_manufacturer'] = $menu['megamenu-manufacturer'];
					break;						
			}
		}
		
		if( isset($this->request->post['megamenu']) ){
			$menu = array_merge($menu, $this->request->post['megamenu'] );
		}

		$data['menu'] = $menu;
		
		$data['submenutypes'] = array('menu'=>'Menu', 'html'=>'HTML' );

		$data['width_aligns'] = array(
			'' => 'auto',
			'aligned-left' => 'Left',
			'aligned-right' => 'Right',
			'aligned-fullwidth' => 'FullWidth'
		); 
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/megamenu/megamenu', $data));
	}
	
	public function delete(){
		if (!$this->user->hasPermission('modify', 'extension/module/megamenu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if(isset($this->request->get['id']) ){
			$this->load->model('extension/menu/megamenu');

			$store_id = isset($this->request->get['store_id'])?$this->request->get['store_id']:0;

			$store = ($store_id == 0)?'':'&store_id='.$store_id;

			$this->model_extension_menu_megamenu->delete((int)$this->request->get['id'], $store_id );
			
		}
		
		$this->response->redirect($this->url->link('extension/module/megamenu', 'user_token=' . $this->session->data['user_token'].$store));
	}
	
	public function update(){
		$this->load->language('extension/module/megamenu');
		
		$json = array();
		if (!$this->user->hasPermission('modify', 'extension/module/megamenu')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$data =  ( ($this->request->post['list']) );
			$root = $this->request->get['root'];
		
			$this->load->model('extension/menu/megamenu');
			$this->model_extension_menu_megamenu->massUpdate( $data, $root  );
			$json['success'] = $this->language->get('text_update_success');
		}
		
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
		
		
	}

	protected function validate() {
	
		if (!$this->user->hasPermission('modify', 'extension/module/megamenu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['megamenu']['title']) < 1) || (utf8_strlen($this->request->post['megamenu']['title']) > 255)) {
			$this->error['warning']=$this->language->get('error_missing_title');
			$this->session->data['warning'] = $this->error['warning'];
		}
			
		return !$this->error;
	}
	
	protected function delByValue($arr, $value){
		$keys = array_keys($arr, $value);
		
		if(!empty($keys)){
		  foreach ($keys as $key) {
			unset($arr[$key]);
		  }
		}
		
		return $arr;
	}
}