<?php
class ModelExtensionModuleMegaMenu extends Model {
    public function getMenu($module_id) {
		
        $output = array();
        $lang_id = $this->config->get('config_language_id');
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."mega_menu WHERE parent_id='0' AND status='0' AND module_id = '".$module_id."' ORDER BY rang");
		foreach ($query->rows as $row) {
            $icon = false;
            if($row['icon']) {
                if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
                    $link = $this->config->get('config_ssl') . 'image/' . $row['icon'];
                } else {
                    $link = $this->config->get('config_url') . 'image/' . $row['icon'];
                }
                $icon = '<img src="'.$link.'" alt="">';
            }
            $description = false;
            $description_array = @unserialize($row['description']);
            if(isset($description_array[$lang_id])) {
                if(!empty($description_array[$lang_id])) {
                    $description = '<br><span class="description">'.$description_array[$lang_id].'</span>';
                }
            }
			
            $output[] = array(
                'icon' => $icon,
                'name' => @unserialize($row['name']),
                'link' => $row['link'],
				'type_link' => $row['type_link'],
                'label_item' => $row['label_item'],
                'icon_font' => $row['icon_font'],
				'class_menu' => $row['class_menu'],
                'description' => $description,
                'new_window' => $row['new_window'],
                'position' => $row['position'],
                'submenu_width' => $row['submenu_width'],
                'submenu_type' => $row['submenu_type'],
                'submenu' => $this->getSubmenu($row['id'])
            );
        }
        return $output;
    }

    public function getSubmenu($id) {
		$registry = $this->registry;
        $output = array();
        $lang_id = $this->config->get('config_language_id');

        // Product model
        $this->load->model('catalog/product');
        $model = $registry->get('model_catalog_product');

        // Tool model
        $this->load->model('tool/image');
        $model_image = $registry->get('model_tool_image');

        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."mega_menu WHERE parent_id='".$id."' AND status='0' ORDER BY rang");
		
		foreach ($query->rows as $row) {
            $content = @@unserialize($row['content']);
            if(isset($content['html']['text'][$lang_id])) {
                $html = htmlspecialchars_decode($content['html']['text'][$lang_id]);
            } else {
                $html = false;
            }

            if(isset($content['categories'])) {
                if(is_array($content['categories'])) {
                    $categories = $this->getCategories($content['categories']);
                } else {
                    $categories = false;
                }
            } else {
                $categories = false;
            }
			
			if(isset($content['manufacture']['id']) && $content['manufacture']['id']) {
				$manufactures =  array();
				foreach($content['manufacture']['id'] as $key=>$id_manufacture){
					$manufacture['name'] = $content['manufacture']['name'][$key];
					$manufacture['link'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $id_manufacture);
					$manufactures[] = $manufacture;
				}
			}
			else
				$manufactures = false;
				
			if(isset($content['productlist']) && $content['productlist']) {
				$productlist =  array();
				$limit_product = ($content['productlist']['limit']) ? $content['productlist']['limit'] : 4;
				$type_product = ($content['productlist']['type']) ? $content['productlist']['type'] : 'new';
				$data = array(
					'start'	=> 0,
					'limit'     => $limit_product
				);
				
				$results = array();
				switch ($type_product) {
					case 'new':
						$results = $this->model_catalog_product->getLatestProducts($limit_product);
						break;
					case 'special':
						$results = $this->model_catalog_product->getProductSpecials($data);
						break;
					case 'bestseller':
						$results = $this->model_catalog_product->getBestSellerProducts($limit_product);
						break;
					case 'popular':
						$results = $this->model_catalog_product->getPopularProducts($limit_product);
						break;						
					default:
						$results = $this->model_catalog_product->getProducts($data);
				}
				$productlist['show_title'] = (isset($content['productlist']['show_title'])) ? $content['productlist']['show_title'] : 0;
				$productlist['col'] = (isset($content['productlist']['col'])) ? $content['productlist']['col'] : 4;
				if($results){
					foreach($results as $key=>$result){
						if ($result['image']) {
							$image = $this->model_tool_image->resize($result['image'], 100, 100);
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', 100, 100);
						}
						// Check Version
						if(version_compare(VERSION, '2.1.0.2', '>')) {
							if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
								$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							} else {
								$price = false;
							}

							if ((float)$result['special']) {
								$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							} else {
								$special = false;
							}

							if ($this->config->get('config_tax')) {
								$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
							} else {
								$tax = false;
							}

							if ($this->config->get('config_review_status')) {
								$rating = $result['rating'];
							} else {
								$rating = false;
							}
						} else {
							if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
								$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							} else {
								$price = false;
							}

							if ((float)$result['special']) {
								$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							} else {
								$special = false;
							}

							if ($this->config->get('config_tax')) {
								$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
							} else {
								$tax = false;
							}

							if ($this->config->get('config_review_status')) {
								$rating = $result['rating'];
							} else {
								$rating = false;
							}
						}
						
						$productlist['products'][] = array(
							'product_id'  => $result['product_id'],
							'thumb'       => $image,
							'name'        => $result['name'],
							'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
							'price'       => $price,
							'special'     => $special,
							'tax'         => $tax,
							'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
							'rating'      => $result['rating'],
							'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id'])
						);
					}
				}
			}
			else
				$productlist = false;				
            if(isset($content['subcategory'])) {
				$subcategory = array();
				$children_categories = array(); 
				$limit_level1 = (isset($content['subcategory']['limit_level_1']) && $content['subcategory']['limit_level_1'] ) ? $content['subcategory']['limit_level_1'] :0;
				$limit_level2 = (isset($content['subcategory']['limit_level_2']) && $content['subcategory']['limit_level_2'] ) ? $content['subcategory']['limit_level_2'] :0;
				$limit_level3 = (isset($content['subcategory']['limit_level_3']) && $content['subcategory']['limit_level_3'] ) ? $content['subcategory']['limit_level_3'] :0;
				$array_categories = (isset($content['subcategory']['category']) && $content['subcategory']['category']) ? @unserialize($content['subcategory']['category']) :  array();
				$subcategory['show_title'] = (isset($content['subcategory']['show_title'])) ? $content['subcategory']['show_title'] : 0;
				$subcategory['show_image'] = (isset($content['subcategory']['show_image'])) ? $content['subcategory']['show_image'] : 0; 
				
				if($array_categories){
					foreach($array_categories as $id_category){
						$categories_info = $this->model_catalog_category->getCategory($id_category);
						$sub['name'] = (isset($categories_info['name'])) ? $categories_info['name'] : '';
						$sub['href']  = $this->url->link('product/category', 'path=' . $id_category);
						
						$this->load->model('tool/image');
						$image = empty($categories_info['image']) ? 'no_image.png' : $categories_info['image'];
						$sub['thumb']	= $this->model_tool_image->resize($image, 100, 100);
						
						$data_categories = array();
						$data_categories['columns'] = (isset($content['subcategory']['columns'])) ? $content['subcategory']['columns'] : 1;
						$data_categories['submenu'] = (isset($content['subcategory']['submenu'])) ? $content['subcategory']['submenu'] : 1;
						$data_categories['submenu_columns'] = (isset($content['subcategory']['submenu_columns'])) ? $content['subcategory']['submenu_columns'] : 1;
						$child_categories = $this->getCategoriesByCatId($id_category,$limit_level1);
						
						if($child_categories){
							foreach ($child_categories as &$category) {
								$children_data = array();
								$children = $this->getCategoriesByCatId($category['category_id'],$limit_level2);
								foreach ($children as $key=>$child) {
									$filter_data = array(
										'filter_category_id'  => $child['category_id'],
										'filter_sub_category' => true
									);							
									$children_data[$key] = array(
										'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
										'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
										'id'	=> $child['category_id'],
										'children' => array()
									);
									
									$children2 = $this->getCategoriesByCatId($child['category_id'],$limit_level3);
								
									if($children2){
										foreach ($children2 as $child2){
											$filter_data2 = array(
												'filter_category_id'  => $child2['category_id'],
												'filter_sub_category' => true
											);							
											$children_data[$key]['children'][] = array(
												'name'  => $child2['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data2) . ')' : ''),
												'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child2['category_id']),
												'id'	=> $child2['category_id']
											);
										}
									}
								}
								
								$category['children'] = 	$children_data;
								
							}
						}
						
						$data_categories['categories'] = $child_categories;
						
						if(is_array($data_categories)) {
							$sub['categories']= $this->getCategories($data_categories);
						} else {
							$sub['categories'] = false;
						}							
						$children_categories[] = 	$sub;
					}
					$subcategory['categories'] = $children_categories;
				}
            } else {
                $subcategory = false;
            }
	
			if(isset($content['image']['link']) && $content['image']['link']) {
                if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
                    $link = $this->config->get('config_ssl') . 'image/' . $content['image']['link'];
                } else {
                    $link = $this->config->get('config_url') . 'image/' . $content['image']['link'];
                }
                $images['link'] = '<img src="'.$link.'" alt="" style="width: 100%;">';
				$images['show_title'] = $content['image']['show_title'];
			}
			else
				$images = false;	
				
            if(isset($content['product']['id'])) {
                $product = $model->getProduct($content['product']['id']);
                if(is_array($product)) {
                    $product_link = $this->url->link('product/product', 'product_id=' . $content['product']['id']);
					
					// Check Version
					if(version_compare(VERSION, '2.1.0.2', '>')) {
						if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$price = false;
						}

						if ((float)$product['special']) {
							$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$special = false;
						}
					} else {
						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$price = false;
						}

						if ((float)$product['special']) {
							$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$special = false;
						}
					}
                } else {
                    $product = false;
                    $product_link = false;
                    $price = false;
                    $special = false;
                }
            } else {
                $product = false;
                $product_link = false;
                $price = false;
                $special = false;
            }

            if(isset($product['image'])) {
                $product_image = $model_image->resize($product['image'], 300, 300);
            } else {
                $product_image = false;
            }
            $output[] = array(
				'name' => @unserialize($row['name']),
                'content_width' => intval($row['content_width']),
                'content_type' => $row['content_type'],
                'html' => $html,
                'product' => array(
                    'name' => $product['name'],
                    'link' => $product_link,
                    'image' => $product_image,
                    'price' => $price,
                    'special' => $special
                ),
                'categories' => $categories,
				'manufactures' => $manufactures,
				'subcategory' => $subcategory,
				'productlist' => $productlist,
				'images'	=> $images,
				'class_menu'	=> $row['class_menu'],
                'submenu' => $this->getSubmenu($row['id'])
            );
        }
        return $output;
    }
	public function getCategoriesByCatId($parent_id = 0,$limit = 0) {
		$query = $this->db->query("SELECT * , c.category_id as id  FROM " . DB_PREFIX . "category c 
										LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) 
										LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) 
										WHERE c.parent_id = '" . (int)$parent_id . "' 
											AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
											AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  
											AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name) LIMIT ".(int)$limit."");

		return $query->rows;
	}
    public function getCategories($array = array()) {
        $output = false;
		$registry = $this->registry;
        // Category model
        $this->load->model('catalog/category');
        $model = $registry->get('model_catalog_category');

        $output .= '<div class="row">';
        $row_fluid = 12;
        if($array['columns'] == 2) { $row_fluid = 6; }
        if($array['columns'] == 3) { $row_fluid = 4; }
        if($array['columns'] == 4) { $row_fluid = 3; }
        if($array['columns'] == 5) { $row_fluid = 25; }
        if($array['columns'] == 6) { $row_fluid = 2; }
        if(!($array['columns'] > 0 && $array['columns'] < 7)) { $array['columns'] = 1; }
        $menu_class = 'hover-menu';
        if($array['submenu'] == 2) { $menu_class = 'static-menu'; }
		$limit = (isset($array['limit']) && $array['limit']) ? $array['limit'] : count($array['categories']);
        for ($i = 0; $i < count($array['categories']);) {
            $output .= '<div class="col-sm-'.$row_fluid.' '.$menu_class.'">';
            $output .= '<div class="menu">';
            $output .= '<ul>';
            $j = $i + ceil(count($array['categories']) / $array['columns']);
			$lim = (isset($array['limit']) && $array['limit']) ? $array['limit'] : $j;
            for (; $i < $j; $i++) {
                if(isset($array['categories'][$i]['id'])) {
                    $info_category = $model->getCategory($array['categories'][$i]['id']);
                    if(isset($info_category['category_id'])) {
                        $path = '';
                        if($info_category['parent_id'] > 0) {
                            $path = $info_category['parent_id'];
                            $info_category2 = $model->getCategory($info_category['parent_id']);
                            if(isset($info_category2['parent_id']) && $info_category2['parent_id'] > 0) {
                                $path = $info_category2['parent_id'] . '_' . $path;
                                $info_category3 = $model->getCategory($info_category2['parent_id']);
                                if(isset($info_category3['parent_id']) && $info_category3['parent_id'] > 0) {
                                    $path = $info_category3['parent_id'] . '_' . $path;
                                }
                            }
                        }

                        if($path != '') {
                            $path = $path . '_';
                        }
                        if(is_array($info_category)) {
                            $link = $this->url->link('product/category', 'path=' . $path . $info_category['category_id']);
                            $output .= '<li><a href="'.$link.'" onclick="window.location = \''.$link.'\';" class="main-menu">'.$info_category['name'].'';
							if(isset($array['categories'][$i]['children']) && $array['categories'][$i]['children'] && ($array['submenu'] == 1))
								$output .= '<b class="fa fa-angle-right"></b>';
							$output .= '</a>';
                            if(isset($array['categories'][$i]['children'])) {
                                if(!empty($array['categories'][$i]['children'])) {
                                    $output .= $this->getCategoriesChildren($array['categories'][$i]['children'], $info_category['category_id'], $array['submenu_columns'], $array['submenu'],$limit);
                                }
                            }
                            $output .= '</li>';
                        }
                    }
                }
            }
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }

    public function getCategoriesChildren($array = array(), $path, $columns, $type, $submenu = false,$limit=4) {
        $output = false;
		$registry = $this->registry;
        // Category model
        $this->load->model('catalog/category');
        $model = $registry->get('model_catalog_category');
        if($type == 2) {
            $row_fluid = 12;
            if($columns == 2) { $row_fluid = 6; }
            if($columns == 3) { $row_fluid = 4; }
            if($columns == 4) { $row_fluid = 3; }
            if($columns == 5) { $row_fluid = 25; }
            if($columns == 6) { $row_fluid = 2; }
            if(!($columns > 0 && $columns < 7)) { $columns = 1; }
			if($submenu == 0) { $columns = 1; $row_fluid = 12; }
            if($columns != 1) {
                $output .= '<div class="row visible">';
            }
			$limit = (isset($array['limit']) && $array['limit']) ? $array['limit'] : count($array);
            for ($i = 0; $i < count($array);) {
                if($columns != 1) {
                    $output .= '<div class="col-sm-'.$row_fluid.'">';
                }
                $output .= '<ul>';
                $j = $i + ceil(count($array) / $columns);
				$lim = (isset($array['limit']) && $array['limit']) ? $array['limit'] : $j;
					
                for (; $i < $j; $i++) {
                    if(isset($array[$i]['id'])) {
                        $info_category = $model->getCategory($array[$i]['id']);
                        if(isset($info_category['category_id'])) {
                            $path = '';

                            if($info_category['parent_id'] > 0) {
                                $path = $info_category['parent_id'];
                                $info_category2 = $model->getCategory($info_category['parent_id']);
                                if(isset($info_category2['parent_id']) &&  $info_category2['parent_id'] > 0) {
                                    $path = $info_category2['parent_id'] . '_' . $path;
                                    $info_category3 = $model->getCategory($info_category2['parent_id']);
                                    if(isset($info_category3['parent_id']) && $info_category3['parent_id'] > 0) {
                                        $path = $info_category3['parent_id'] . '_' . $path;
                                    }
                                }
                            }

                            if($path != '') {
                                $path = $path . '_';
                            }
                            if(is_array($info_category)) {
                                $link = $this->url->link('product/category', 'path=' . $path . $info_category['category_id']);
                                $output .= '<li><a href="'.$link.'" onclick="window.location = \''.$link.'\';">'.$info_category['name'].'';
								if(isset($array[$i]['children']) && !empty($array[$i]['children'])){
									$output .= '<b class="fa fa-angle-right"></b>';
								}
								$output .= '</a>';
                                if(isset($array[$i]['children'])) {
                                    if(!empty($array[$i]['children'])) {
                                        $output .= $this->getCategoriesChildren($array[$i]['children'], $path.'_'.$info_category['category_id'], $columns, $type, 0,$limit);
                                    }
                                }
                                $output .= '</li>';
                            }
                        }
                    }
                }
                $output .= '</ul>';
                if($columns != 1) {
                    $output .= '</div>';
                }
            }
            if($columns != 1) {
                $output .= '</div>';
            }
        } else {
            $output .= '<ul>';
            foreach($array as $row) {
                $info_category = $model->getCategory($row['id']);
                if(isset($info_category['category_id'])) {
                    $path = '';

                    if($info_category['parent_id'] > 0) {
                        $path = $info_category['parent_id'];
                        $info_category2 = $model->getCategory($info_category['parent_id']);
                        if(isset($info_category2['parent_id']) && $info_category2['parent_id'] > 0) {
                            $path = $info_category2['parent_id'] . '_' . $path;
                            $info_category3 = $model->getCategory($info_category2['parent_id']);
                            if(isset($info_category3['parent_id']) && $info_category3['parent_id'] > 0) {
                                $path = $info_category3['parent_id'] . '_' . $path;
                            }
                        }
                    }

                    if($path != '') {
                        $path = $path . '_';
                    }

                    $link = $this->url->link('product/category', 'path=' . $path . $info_category['category_id']);
                    $output .= '<li><a href="'.$link.'" onclick="window.location = \''.$link.'\';">'.$info_category['name'].'';
						if(isset($row['children']) && !empty($row['children'])){
							$output .= '<b class="fa fa-angle-right"></b>';
						}
					$output .= '</a>';
                    if(isset($row['children'])) {
                        if(!empty($row['children'])) {
                            $output .= $this->getCategoriesChildren($row['children'], $path.'_'.$info_category['category_id'], $columns, $type);
                        }
                    }
                    $output .= '</li>';
                }
            }
            $output .= '</ul>';
        }
        return $output;
    }

}
?>