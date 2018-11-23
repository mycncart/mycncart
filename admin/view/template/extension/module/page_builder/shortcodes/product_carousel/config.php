<?php 
class YT_Shortcode_product_carousel_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_product_carousel'));
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_product_carousel')),
				'values'  	=> $name_shortcode_arr,
				'name'    	=> $language->get('shortcode_name_shortcode'),
				'desc'    	=> $language->get('shortcode_name_shortcode_desc'),
				'child'  => array(
	                'name_shortcode_status' => array(
						'type' 		=> 'bool',
						'default' 	=> (is_array($value) && isset($value[0]['name_shortcode_status']) ? $value[0]['name_shortcode_status'] : 'no'),
						'name' 		=> $language->get('shortcode_name_shortcode_status'),
						'desc' 		=> $language->get('shortcode_name_shortcode_status_desc'),
					)
	            )
			),
			'source' => array(
				'type'    => 'source_product',
				'default' => (is_array($value) && isset($value[0]['source']) ? $value[0]['source'] : 'none'),
				'name'    => $language->get('shortcode_source'),
				'desc'    => $language->get('shortcode_source_desc'),
			),
			'type_change' 	=> array(
				'type'   		=> 'select',
				'default' 		=> (is_array($value) && isset($value[0]['type_change']) ? $value[0]['type_change'] : 'ASC'),
				'values' 		=> YT_Data::type_carousel($language),
				'name'    		=> $language->get('shortcode_type_change'),
				'desc'    		=> $language->get('shortcode_type_change_desc'),
				'child'   => array(
					'limit' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['limit']) ? $value[0]['limit'] : 5),
						'min'     => 1,
						'max'     => 100,
						'step'    => 1,
						'name'    => $language->get('shortcode_limit'),
						'desc'    => $language->get('shortcode_limit_desc'),
					),
				),
			),   
			'product_sort' 	=> array(
				'type'   	=> 'select',
				'default' => (is_array($value) && isset($value[0]['product_sort']) ? $value[0]['product_sort'] : 'pd_name'),
				'values' 	=> YT_Data::product_sorts($language),
				'name'    => $language->get('shortcode_product_sort'),
				'desc'    => $language->get('shortcode_product_sort_desc'),
				'child'   => array(
					'product_order' 	=> array(
						'type'   		=> 'select',
						'default' => (is_array($value) && isset($value[0]['product_order']) ? $value[0]['product_order'] : 'ASC'),
						'values' 		=> YT_Data::product_orders($language),
						'name'    => $language->get('shortcode_product_order'),
						'desc'    => $language->get('shortcode_product_order_desc'),
					),     
				),
			),
			'rating' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['rating']) ? $value[0]['rating'] : 'no'),
				'name'    => $language->get('shortcode_rating'),
				'desc'    => $language->get('shortcode_rating_desc'),
				'child'  => array(                        
					'price' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['price']) ? $value[0]['price'] : 'no'),
						'name'    => $language->get('shortcode_price'),
						'desc'    => $language->get('shortcode_price_desc'),
					)
				)
			),
			'display_add_to_cart' => array(
				'type'    => 'bool',
				'group'		=> 'horizontal',
				'default' => (is_array($value) && isset($value[0]['display_add_to_cart']) ? $value[0]['display_add_to_cart'] : 'no'),
				'name'    => $language->get('shortcode_display_add_to_cart'),
				'desc'    => $language->get('shortcode_display_add_to_cart_desc'),
				'child'  => array(                        
					'display_wishlist' => array(
						'type'    => 'bool',
						'group'		=> 'horizontal',
						'default' => (is_array($value) && isset($value[0]['display_wishlist']) ? $value[0]['display_wishlist'] : 'no'),
						'name'    => $language->get('shortcode_display_wishlist'),
						'desc'    => $language->get('shortcode_display_wishlist_desc'),
					),
					'display_compare' => array(
						'type'    	=> 'bool',
						'group'		=> 'horizontal',
						'default' 	=> (is_array($value) && isset($value[0]['display_compare']) ? $value[0]['display_compare'] : 'no'),
						'name'    	=> $language->get('shortcode_display_compare'),
						'desc'    	=> $language->get('shortcode_display_compare_desc'),
					)
				)
			),
			'items_column0' => array(
				'type'    => 'slider',
				'default' => (is_array($value) && isset($value[0]['items_column0']) ? $value[0]['items_column0'] : 4),
				'min'     => 1,
				'max'     => 6,
				'step'    => 1,
				'name'    => $language->get('shortcode_item_column0'),
				'desc'    => $language->get('shortcode_item_column0_desc'),
				'child'   => array(
					'items_column1' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['items_column1']) ? $value[0]['items_column1'] : 4),
						'min'     => 1,
						'max'     => 6,
						'step'    => 1,
						'name'    => $language->get('shortcode_item_column1'),
						'desc'    => $language->get('shortcode_item_column1_desc'),
					), 
					'items_column2' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['items_column2']) ? $value[0]['items_column2'] : 3),
						'min'     => 1,
						'max'     => 6,
						'step'    => 1,
						'name'    => $language->get('shortcode_item_column2'),
						'desc'    => $language->get('shortcode_item_column2_desc'),
					),					
				),
			),
			'items_column3' => array(
				'type'    => 'slider',
				'default' => (is_array($value) && isset($value[0]['items_column3']) ? $value[0]['items_column3'] : 2),
				'min'     => 1,
				'max'     => 6,
				'step'    => 1,
				'name'    => $language->get('shortcode_item_column3'),
				'desc'    => $language->get('shortcode_item_column3_desc'),
				'child'   => array(
					'items_column4' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['items_column4']) ? $value[0]['items_column4'] : 1),
						'min'     => 1,
						'max'     => 6,
						'step'    => 1,
						'name'    => $language->get('shortcode_item_column4'),
						'desc'    => $language->get('shortcode_item_column4_desc'),
					),                          
				),
			), 
			
			'style' => array(
				'type'   	=> 'select',
				//'group'   	=> 'horizontal',
				'default' 	=> (is_array($value) && isset($value[0]['style']) ? $value[0]['style'] : 1),
				'values' 	=> YT_Data::style_carousels($language),
				'name'    	=> $language->get('shortcode_style'),
				'desc'    	=> $language->get('shortcode_style_desc'),
				'child'   	=> array(
					'margin' => array(
						'type'    => 'slider',
						'group'   => 'horizontal',
						'default' => (is_array($value) && isset($value[0]['margin']) ? $value[0]['margin'] : 10),
						'min'     => 0,
						'max'     => 80,
						'step'    => 5,
						'name'    => $language->get('shortcode_margin'),
						'desc'    => $language->get('shortcode_margin_slider_desc'),
					),
				),
			),
			'image' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['image']) ? $value[0]['image'] : 'yes'),
				'name'    => $language->get('shortcode_image'),
				'desc'    => $language->get('shortcode_image_desc'),
				'child'  => array(     
					'image_width' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['image_width']) ? $value[0]['image_width'] : 240),
						'min'     => 10,
						'max'     => 640,
						'step'    => 10,
						'name'    => $language->get('shortcode_image_width'),
						'desc'    => $language->get('shortcode_image_width_desc'),
					),				
					'image_height' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['image_height']) ? $value[0]['image_height'] : 180),
						'min'     => 10,
						'max'     => 640,
						'step'    => 10,
						'name'    => $language->get('shortcode_image_height'),
						'desc'    => $language->get('shortcode_image_height_desc'),
					)
				)
			),
			'yt_title' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'yes'),
				'name'    => $language->get('shortcode_title'),
				'desc'    => $language->get('shortcode_title_desc'),
				'child'  => array(
					'title_link' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['title_link']) ? $value[0]['title_link'] : 'yes'),
						'name'    => $language->get('shortcode_title_link'),
						'desc'    => $language->get('shortcode_title_link_desc'),
					),
					'title_limit' => array(
						'default' => (is_array($value) && isset($value[0]['title_limit']) ? $value[0]['title_limit'] : ''),
						'name'    => $language->get('shortcode_title_limit'),
						'desc'    => $language->get('shortcode_title_limit_desc'),
					)
				)
			),
			'intro_text' => array(
				'type'    => 'bool',
				'group'   => 'horizontal',
				'default' => (is_array($value) && isset($value[0]['intro_text']) ? $value[0]['intro_text'] : 'no'),
				'name'    => $language->get('shortcode_intro_text'),
				'desc'    => $language->get('shortcode_intro_text_desc'),
				'child'  => array(                        
					'intro_text_limit' => array(
						'default' => (is_array($value) && isset($value[0]['intro_text_limit']) ? $value[0]['intro_text_limit'] : '60'),
						'name'    => $language->get('shortcode_intro_text_limit'),
						'desc'    => $language->get('shortcode_intro_text_limit_desc'),
					)
				)
			),
			'color' => array(
				'type'    => 'color',
				'default' => (is_array($value) && isset($value[0]['color']) ? $value[0]['color'] : '#ffffff'),
				'name'    => $language->get('shortcode_color'),
				'desc'    => $language->get('shortcode_color_desc'),
				'child' => array(
					'background' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['background']) ? $value[0]['background'] : '#2d89ef'),
						'name'    => $language->get('shortcode_background'),
						'desc'    => $language->get('shortcode_background_desc'),
					),
					'title_color' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['title_color']) ? $value[0]['title_color'] : '#ffffff'),
						'name'    => $language->get('shortcode_title_color'),
						'desc'    => $language->get('shortcode_title_color_desc'),
					)
				)
			),
			'arrows' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['arrows']) ? $value[0]['arrows'] : 'no'),
				'name'    => $language->get('shortcode_arrow'),
				'desc'    => $language->get('shortcode_arrow_desc'),
				'child'  => array(                        
					'arrow_position' => array(
						'type'   	=> 'select',
						'group'		=> 'horizontal',
						'default' 	=> (is_array($value) && isset($value[0]['arrow_position']) ? $value[0]['arrow_position'] : 'default'),
						'values' 	=> YT_Data::arrow_position($language),
						'name'    	=> $language->get('shortcode_arrow_position'),
						'desc'    	=> $language->get('shortcode_arrow_position_desc'),
					),
					'pagination' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['pagination']) ? $value[0]['pagination'] : 'yes'),
						'name'    => $language->get('shortcode_pagination'),
						'desc'    => $language->get('shortcode_pagination_desc'),
					)
				)
			),
			'autoplay' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['autoplay']) ? $value[0]['autoplay'] : 'yes'),
				'name'    => $language->get('shortcode_autoplay'),
				'desc'    => $language->get('shortcode_autoplay_desc'),
				'child'  => array(                        
					'hoverpause' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['hoverpause']) ? $value[0]['hoverpause'] : 'yes'),
						'name'    => $language->get('shortcode_pasuse_hover'),
						'desc'    => $language->get('shortcode_pasuse_hover_desc'),
					),
					'lazyload' => array(
						'type'    	=> 'bool',
						'group'		=> 'horizontal',
						'default' 	=> (is_array($value) && isset($value[0]['lazyload']) ? $value[0]['lazyload'] : 'no'),
						'name'    	=> $language->get('shortcode_lazyload'),
						'desc'    	=> $language->get('shortcode_lazyload_desc'),
					),
					'loop' => array(
						'type'    	=> 'bool',
						'group'		=> 'horizontal',
						'default' 	=> (is_array($value) && isset($value[0]['loop']) ? $value[0]['loop'] : 'no'),
						'name'    	=> $language->get('shortcode_loop'),
						'desc'    	=> $language->get('shortcode_loop_desc'),
					)
				)
			),                
			'delay' => array(
				'type'    	=> 'slider',
				'group'		=> 'horizontal',
				'default' 	=> (is_array($value) && isset($value[0]['delay']) ? $value[0]['delay'] : 4),
				'min'     	=> 1,
				'max'     	=> 10,
				'step'    	=> 0.5,
				'name'    	=> $language->get('shortcode_delay'),
				'desc'    	=> $language->get('shortcode_delay_desc'),
				'child'  => array(                        
					'speed' => array(
						'type'    	=> 'slider',
						'group'		=> 'horizontal',
						'default' 	=> (is_array($value) && isset($value[0]['speed']) ? $value[0]['speed'] : 0.35),
						'min'     	=> 0.1,
						'max'     	=> 15,
						'step'    	=> 0.2,
						'name'    	=> $language->get('shortcode_speed'),
						'desc'    	=> $language->get('shortcode_speed_desc'),
					)
				)
			),
			'yt_class'=> array(
				'default' 	=> (is_array($value) && isset($value[0]['yt_class']) ? $value[0]['yt_class'] : ''),
				'name'  	=> $language->get('shortcode_yt_class'),
				'desc'  	=> $language->get('shortcode_yt_class_desc')
			),
			'css_internal'=> array(
				'type' 		=> 'textarea',
				'default' 	=> (is_array($value) && isset($value[0]['css_internal']) ? $value[0]['css_internal'] : ''),
				'name'  	=> $language->get('shortcode_css_internal'),
				'desc'  	=> $language->get('shortcode_css_internal_desc')
			),
		);
	}
}

?>