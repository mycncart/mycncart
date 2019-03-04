<?php
class ModelExtensionMenuMegamenu extends Model {

	private $output = false;
	private $_editString = '';
	private $children;
	private $shopUrl ;
	private $megaConfig = array();
	private $_editStringCol = '';
	private $_isLiveEdit = true;

	public function getChilds( $id=null, $store_id=0 ){
		$sql = ' SELECT * FROM ' . DB_PREFIX . 'megamenu WHERE published = 1 AND store_id='.(int)$store_id;
		if( $id != null ) {
			$sql .= ' AND parent_id='.(int)$id;
		}
		
		$sql .= ' ORDER BY `position`  ';
		$query = $this->db->query( $sql );
		return $query->rows;
	}

	public function hasChild( $id ){
		return isset($this->children[$id]);
	}

	public function getNodes( $id ){
		return $this->children[$id];
	}

	public function getTree( $parent=1 , $edit=false, $params, $store_id = 0){

		if ( $this->output !== false ) {
			return $this->output;
		}

		$this->load->language("menu/megamenu");

		if( $edit ){
			$this->_editString  = ' data-id="%s" data-group="%s"  data-cols="%s" ';
		}
		
		$this->_editStringCol = ' data-colwidth="%s" data-class="%s" ' ;


		$childs = $this->getChilds( null, $store_id );
		
		foreach($childs as $child ){

			$this->children[$child['parent_id']][] = $child;
		}


		$parent = 1 ;
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->load->model('setting/module');


		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->shopUrl = $this->config->get('config_ssl') ;
		} else {
			$this->shopUrl = $this->config->get('config_url') ;
		}
		
	 	$output  = '';
		
		if( $this->hasChild($parent) ){
			$data = $this->getNodes( $parent );
			// render menu at level 0
			$output = '<ul class="nav navbar-nav megamenu">';
			foreach( $data as $menu ){

				// set width align ment
				if( isset($menu['width']) && !empty($menu['width']) ){
                    $menu['menu_class'] .= ' '.$menu['width'];
                }

				if( $this->hasChild($menu['megamenu_id']) || $menu['type_submenu'] == 'html' ||  $menu['type_submenu'] == 'blkbuilder' ){

					$output .= '<li class="parent dropdown '.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';

					$output .= '<a class="dropdown-toggle" href="'.$this->getLink( $menu ).'">';

					if (isset($menu['badges']) && !empty($menu['badges'])) {
						$output .= '<span class="badges '.$menu['badges'].'">'.$this->language->get($menu['badges']).'</span>';
					}

					if( $menu['image'] ) {
					 	$output .= '<span class="menu-icon" style="background:url(\''.$this->shopUrl."image/".$menu['image'].'\') no-repeat;">';
					} else if (!empty($menu['icon'])) {
						$output .= '<span class="'.$menu['icon'].'"></span>';
					}
					if($menu['show_title']) {
						if (isset($menu['badges']) && !empty($menu['badges'])) {
							$output .= '<span class="badges '.$menu['badges'].'">'.$this->language->get($menu['badges']).'</span>';
						}
						$output .= '<span class="menu-title">'.$menu['title']."</span>";
					}
					if( $menu['description'] ){
						$output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
					}
					if( $menu['image']){  $output .= '</span>'; }
					$output .= "<b class=\"caret\"></b>";
					$output .= '</a>';
					if($menu['megamenu_id'] > 1) {
						$output .= $this->genTree( $menu['megamenu_id'], 1, $menu );
					}

					$output .= '</li>';
				} elseif($menu['type'] == 'html'){
					$output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';

					if (isset($menu['badges']) && !empty($menu['badges'])) {
						$output .= '<span class="badges '.$menu['badges'].'">'.$this->language->get($menu['badges']).'</span>';
					}

					if( $menu['image'] ) {
					 	$output .= '<span class="menu-icon" style="background:url(\''.$this->shopUrl."image/".$menu['image'].'\') no-repeat;">';
					} else if (!empty($menu['icon'])) {
						$output .= '<span class="'.$menu['icon'].'"></span>';
					}

					if($menu['show_title']) {


						$output .= '<span class="menu-title">'.$menu['title']."</span>";
					}

					if( $menu['description'] ){
						$output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
					}
					if( $menu['image']){ $output .= '</span>';	}
					$output .= '</li>';
				}else {
					$output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';

					$output .= '<a href="'.$this->getLink( $menu ).'">';

					if (isset($menu['badges']) && !empty($menu['badges'])) {
						$output .= '<span class="badges '.$menu['badges'].'">'.$this->language->get($menu['badges']).'</span>';
					}

					if( $menu['image'] ) {
					 	$output .= '<span class="menu-icon" style="background:url(\''.$this->shopUrl."image/".$menu['image'].'\') no-repeat;">';
					} else if (!empty($menu['icon'])) {
						$output .= '<span class="'.$menu['icon'].'"></span>';
					}

					if($menu['show_title']) {

						$output .= '<span class="menu-title">'.$menu['title']."</span>";
					}

					if( $menu['description'] ){
						$output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
					}
					if( $menu['image']){ $output .= '</span>';	}
					$output .= '</a></li>';
				}
			}
			$output .= '</ul>';

		}

		return $this->output = $output;

	}

	public function genTree( $parentId, $level,$parent, $store_id = 0){


		$attrw = '';
		$class = $parent['is_group']?"dropdown-mega":"dropdown-menu";

		if( isset($parent['submenu_width']) &&  (int)$parent['submenu_width'] ){
			$attrw .= ' style="width:'.(int)$parent['submenu_width'] .'px"' ;
		}

		if( $parent['type_submenu'] == 'blkbuilder' ){
			$output = '<div class="'.$class.'" '.$attrw.'><div class="dropdown-menu-inner content-blockbuilder">';
			$output .= $this->renderBlockbuilder( $parent['widget_id'] );
			$output .= '</div></div>';
			return $output;
		}

		if ( $parent['type_submenu'] == 'html' ){
			$output = '<div class="'.$class.'"><div class="menu-content content-html">';
			$output .= html_entity_decode($parent['submenu_content']);
			$output .= '</div></div>';
			return $output;
		} elseif ( $this->hasChild($parentId) ) {

			$data = $this->getNodes( $parentId );

			$failse = false;

			$output = '<div class="'.$class.' level'.$level.'" '.$attrw.' ><div class="dropdown-menu-inner">';
			$row = '<ul>';
			
			foreach( $data as $menu ){
				if( $level == 1 ){

				}
				$row .= $this->renderMenuContent( $menu , $level+1 );
			}
			
			$row .= '</ul></div></div>';

			$output .= $row;

			return $output;

		}
		return ;
	}

	public function renderMenuContent( $menu , $level ){

		$output = '';
		$class = $menu['is_group']?"mega-group":"";
		$menu['menu_class'] = ' '.$class;
		
		if( $menu['type'] == 'html' ){
			$output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';
			$output .= '<div class="menu-content">'.html_entity_decode($menu['content_text']).'</div>';
			$output .= '</li>';
			return $output;
		}
		
		if( $this->hasChild($menu['megamenu_id']) ){

			$output .= '<li class="parent dropdown-submenu'.$menu['menu_class'].'" '.$this->renderAttrs($menu). '>';
			
			if( $menu['show_title'] ){
				$output .= '<a class="dropdown-toggle" data-toggle="dropdown" href="'.$this->getLink( $menu ).'">';
				$t = '%s';
				
				if( $menu['image']){ $output .= '<span class="menu-icon" style="background:url(\''.$this->shopUrl."image/".$menu['image'].'\') no-repeat;">';	}

				if (isset($menu['badges']) && !empty($menu['badges'])) {
					$output .= '<span class="badges '.$menu['badges'].'">'.$this->language->get($menu['badges']).'</span>';
				}

				$output .= '<span class="menu-title">'.$menu['title']."</span>";
				if( $menu['description'] ){
					$output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
				}
				$output .= "<b class=\"caret\"></b>";
				if( $menu['image']){
					$output .= '</span>';
				}
				$output .= '</a>';
			}
			
			if($menu['megamenu_id'] > 1) {
				$output .= $this->genTree( $menu['megamenu_id'], $level, $menu );
			}
			
			$output .= '</li>';

		} else {
			$output .= '<li class="'.$menu['menu_class'].'" '.$this->renderAttrs($menu).'>';
			
			if( $menu['show_title'] ){
				$output .= '<a href="'.$this->getLink( $menu ).'">';

				if( $menu['image']){ $output .= '<span class="menu-icon" style="background:url(\''.$this->shopUrl."image/".$menu['image'].'\') no-repeat;">';	}
				$output .= '<span class="menu-title">'.$menu['title']."</span>";
				if( $menu['description'] ){
					$output .= '<span class="menu-desc">' . $menu['description'] . "</span>";
				}
				if( $menu['image']){
					$output .= '</span>';
				}

				$output .= '</a>';
			}
			
			$output .= '</li>';
		}
		
		return $output;
	}
	
	public function renderAttrs( $menu ){

	}

	public function getParentCategory($id_child){
		$result = $this->db->query("SELECT `parent_id` FROM `" . DB_PREFIX . "category` WHERE `category_id` = '".$id_child."'");
 		return $result->row;
	}

	public function getLink( $menu ){
		$id = (int)$menu['item'];
		switch( $menu['type'] ){
			case 'category':
				$parent = $this->getParentCategory($id);
				if( $parent && isset($parent['parent_id']) && $parent['parent_id'] ){
					$id = $parent['parent_id'].'_'.$id;
				}
				return $this->url->link('product/category', 'path=' . $id,'SSL');
			case 'product':
				return  $this->url->link('product/product', 'product_id=' . $id,'SSL');
			case 'information':
				return   $this->url->link('information/information', 'information_id=' . $id,'SSL');
			case 'manufacturer':
				return  $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $id,'SSL');
			default:
				return $menu['url'];
		}
	}

}
