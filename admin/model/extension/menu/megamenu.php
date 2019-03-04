<?php
class ModelExtensionMenuMegamenu extends Model {
	protected $children = array();

	public function getInfo( $megamenu_id ){
		$sql = ' SELECT * FROM ' . DB_PREFIX . 'megamenu WHERE megamenu_id='.(int)$megamenu_id;
		$query = $this->db->query( $sql );

		return $query->row;
	}

	public function getChild( $id=null, $store_id = 0){
		$sql = ' SELECT * FROM ' . DB_PREFIX . 'megamenu WHERE store_id='.(int)$store_id;
        
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

	public function delete( $id, $store_id){
		$childs = $this->getChild( null, $store_id );
		
		foreach($childs as $child ){
			$this->children[$child['parent_id']][] = $child;
		}
		
		$this->recursiveDelete($id, $store_id);
	}

	public function recursiveDelete($parent_id, $store_id)
	{
		$sql = " DELETE FROM ".DB_PREFIX ."megamenu WHERE store_id = ".$store_id." AND megamenu_id=".(int)$parent_id .";";
		$this->db->query($sql);

		if( $this->hasChild($parent_id) ){
			$data = $this->getNodes( $parent_id );
			foreach( $data as $menu ){
				if($menu['megamenu_id'] > 1) {
					 $this->recursiveDelete( $menu['megamenu_id'], $store_id );
				}
			}
		}
	}

	public function getTree( $id=null, $store_id = 0 , $selected ){
		
		$childs = $this->getChild( $id, $store_id );
		
		foreach($childs as $child ){
			$this->children[$child['parent_id']][] = $child;
		}
		
		$parent = 1 ;
		$output = $this->generateTree( $parent, 1, $store_id , $selected );
		
		return $output;
	}



	public function generateTree( $parent, $level, $store_id = 0, $selected=0 ){
		
		if( $this->hasChild($parent) ){
			
			$data = $this->getNodes( $parent );
			$t = $level == 1?" sortable":"";
			$output = '<ol class="level'.$level. $t.' ">';

			$store = ($store_id > 0)?'&store_id='.$store_id:'';

			foreach( $data as $menu ){
				$url  = $this->url->link('extension/module/megamenu', 'id='.$menu['megamenu_id'].$store.'&user_token=' . $this->session->data['user_token'], true) ;
				$cls = $menu['megamenu_id'] == $selected ? 'class="active"':"";
				
				$output .='<li id="list_'.$menu['megamenu_id'].'" '.$cls.' >
				<div><span class="disclose"><span></span></span>'.($menu['title']?$menu['title']:"").' (ID:'.$menu['megamenu_id'].') <a class="quickedit" rel="id_'.$menu['megamenu_id'].'" href="'.$url .'">E</a><span class="quickdel" rel="id_'.$menu['megamenu_id'].'">D</span></div>';
				
				if($menu['megamenu_id'] > 1) {
					$output .= $this->generateTree( $menu['megamenu_id'], $level+1, $store_id, $selected );
				}
				
				$output .= '</li>';
			}
			
			$output .= '</ol>';
			
			return $output;
		}
		
		return ;
	}

	public function getDropdown( $id=null, $selected=1, $store_id = 0  ){
		
		$this->children = array();
		$childs = $this->getChild( $id, $store_id );
		
		foreach($childs as $child ){
			$this->children[$child['parent_id']][] = $child;
		}

		$output = '<select class="form-control" name="megamenu[parent_id]" >';
		$output .='<option value="1">ROOT</option>';
		$output .= $this->genOption( 1 ,1, $selected );
		$output .= '</select>';
		
		return $output ;
	}

	public function genOption( $parent, $level=0, $selected){
		$output = '';
		if( $this->hasChild($parent) ){
			$data = $this->getNodes( $parent );

			foreach( $data as $menu ){
				$select = $selected == $menu['megamenu_id'] ? 'selected="selected"':"";
				
				$output .= '<option value="'.$menu['megamenu_id'].'" '.$select.'>'.str_repeat("-",$level) ." ".$menu['title'].' (ID:'.$menu['megamenu_id'].')</option>';
				
				$output .= $this->genOption(  $menu['megamenu_id'],$level+1, $selected );
				
			}
		}

		return $output;
	}

	public function massUpdate( $data, $root ){
		$child = array();
		foreach( $data as $id => $parentId ){
			if( $parentId <=0 ){
				$parentId = $root;
			}
			
			$child[$parentId][] = $id;
		}

		foreach( $child as $parentId => $menus ){
			$i = 1;
			foreach( $menus as $menuId ){
				$sql = " UPDATE  ". DB_PREFIX . "megamenu SET parent_id=".(int)$parentId.', position='.$i.' WHERE megamenu_id='.(int)$menuId;
				$this->db->query( $sql );
				$i++;
			}
		}
	}


	public function checkExitItemMenu($category, $store_id){
		$query = $this->db->query("SELECT megamenu_id FROM ".DB_PREFIX."megamenu WHERE store_id = ".$store_id." AND `type`='category' AND item=".$category['category_id']);
		
		return $query->num_rows;
	}
	
	public function deletecategories($store_id) {
		$this->db->query( "DELETE FROM ".DB_PREFIX ."megamenu WHERE store_id = ".$store_id );
	}

	public function importCategories($store_id = 0){
		$sql = "SELECT * FROM ".DB_PREFIX ."category WHERE category_id != 0 ORDER BY parent_id ASC";
		$query = $this->db->query( $sql );
		
		if($query->num_rows){
			$categories = $query->rows;
		}
		
		$this->load->model('catalog/category');
		
		foreach ($categories as &$category){

			if($this->checkExitItemMenu($category, $store_id) == 0){
				if((int)$category['parent_id'] > 0){
					
					$query1 = $this->db->query("SELECT megamenu_id FROM ".DB_PREFIX."megamenu WHERE store_id = ".$store_id." AND `type`='category' AND item='".$category['parent_id']."'");
					
					if($query1->num_rows){
						$megamenu_parent_id = (int)$query1->row['megamenu_id'];
					}
					
				} else {
					$megamenu_parent_id = 1;
				}
				
				$this->insertCategory($category, $megamenu_parent_id, $store_id);
			}
		}
	}
	
	public function insertCategory($category = array(), $megamenu_parent_id, $store_id = 0){
		$data = array();
		$data['megamenu']['position'] = 99;
		$data['megamenu']['item'] = $category['category_id'];
		$data['megamenu']['published'] = 1;
		$data['megamenu']['parent_id'] = $megamenu_parent_id;
		$data['megamenu']['show_title'] = 1;
		$data['megamenu']['widget_id'] = 1;
		$data['megamenu']['type_submenu'] = 'menu';
		$data['megamenu']['type'] = 'category';
		$data['megamenu']['colums'] = 1;
		$data['megamenu']['store_id'] = $store_id;
		$data['megamenu']['is_group'] = 0;
		$data['megamenu']['title'] = $category['name'];

		$sql = "INSERT INTO ".DB_PREFIX . "megamenu ( `";
		
		$tmp = array();
		$vals = array();
		foreach( $data["megamenu"] as $key => $value ){
			$tmp[] = $key;
			$vals[]=$this->db->escape($value);
		}
		
	 	$sql .= implode("` , `",$tmp)."`) VALUES ('".implode("','",$vals)."') ";
	 	
		$this->db->query( $sql );

	}

	public function editData( $data ){

		if( $data["megamenu"] ){
			
			if(  (int)$data['megamenu']['megamenu_id'] > 0 ){
				
				$sql = " UPDATE  ". DB_PREFIX . "megamenu SET  ";
				$tmp = array();
				
				foreach( $data["megamenu"] as $key => $value ){
					if( $key != "megamenu_id" ){
						$tmp[] = "`".$key."`='".$this->db->escape($value)."'";
					}
				}

				$sql .= implode( " , ", $tmp );
				$sql .= " WHERE megamenu_id=".$data['megamenu']['megamenu_id'];

				$this->db->query( $sql );
				
			} else {
				
				$data['megamenu']['position'] = 99;
				$sql = "INSERT INTO ".DB_PREFIX . "megamenu ( `";
				$tmp = array();
				$vals = array();
				foreach( $data["megamenu"] as $key => $value ){
					$tmp[] = $key;
					$vals[]=$this->db->escape($value);
				}

			 	$sql .= implode("` , `",$tmp)."`) VALUES ('".implode("','",$vals)."') ";
				
				$this->db->query( $sql );
				
				$data['megamenu']['megamenu_id'] = $this->db->getLastId();
				
			}
		}


		return $data['megamenu']['megamenu_id'];
	}

}