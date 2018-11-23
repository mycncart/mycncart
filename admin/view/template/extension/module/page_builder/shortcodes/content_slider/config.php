<?php 
class YT_Shortcode_content_slider_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_content_slider'));
		foreach($multiLanguage as $language_)
		{
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_content_slider')),
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
			'style' => array(
				'type'    => 'select',
				'default' => (is_array($value) && isset($value[0]['style']) ? $value[0]['style'] : 'default'),
				'values'  => YT_Data::style_content_slider($language),
				'name'    => $language->get('shortcode_style'),
				'desc'    => $language->get('shortcode_style_desc'),
				'child'   => array(
					'margin' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['margin']) ? $value[0]['margin'] : 10),
						'min'     => 0,
						'max'     => 80,
						'step'    => 5,
						'name'    => $language->get('shortcode_margin'),
						'desc'    => $language->get('shortcode_margin_slider_desc'),
					),     
				),
			),
			'items_column0' => array(
				'type'    	=> 'slider',
				'default' 	=> (is_array($value) && isset($value[0]['items_column0']) ? $value[0]['items_column0'] : 4),
				'min'     	=> 1,
				'max'     	=> 6,
				'step'    	=> 1,
				'name'    	=> $language->get('shortcode_item_column0'),
				'desc'    	=> $language->get('shortcode_item_column0_desc'),
				'child'   => array(
					'items_column1' => array(
						'type'    	=> 'slider',
						'default' 	=> (is_array($value)&& isset($value[0]['items_column1']) ? $value[0]['items_column1'] : 4),
						'min'    	=> 1,
						'max'     	=> 6,
						'step'    	=> 1,
						'name'    	=> $language->get('shortcode_item_column1'),
						'desc'    	=> $language->get('shortcode_item_column1_desc'),
					),  
					'items_column2' => array(
						'type'    => 'slider',
						'default' => (is_array($value)&& isset($value[0]['items_column2']) ? $value[0]['items_column2'] : 3),
						'min'     => 1,
						'max'     => 6,
						'step'    => 1,
						'name'    => $language->get('shortcode_item_column2'),
						'desc'    => $language->get('shortcode_item_column2_desc'),
					),					
				),
			),
			'items_column3' => array(
				'type'    	=> 'slider',
				'default' 	=> (is_array($value)&& isset($value[0]['items_column3']) ? $value[0]['items_column3'] : 2),
				'min'     	=> 1,
				'max'     	=> 6,
				'step'    	=> 1,
				'name'    => $language->get('shortcode_item_column3'),
				'desc'    => $language->get('shortcode_item_column3_desc'),
				'child'   => array(
					'items_column4' => array(
						'type'    	=> 'slider',
						'default' 	=> (is_array($value)&& isset($value[0]['items_column4']) ? $value[0]['items_column4'] : 1),
						'min'     	=> 1,
						'max'     	=> 6,
						'step'    	=> 1,
						'name'    	=> $language->get('shortcode_item_column4'),
						'desc'    	=> $language->get('shortcode_item_column4_desc'),
					),     						
				),
			), 
			'type_change' => array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value)&& isset($value[0]['type_change']) ? $value[0]['type_change'] : 'fade'),
				'values' 	=> YT_Data::type_change_content_slider($language),
				'name' 		=> $language->get('shortcode_type'),
				'desc' 		=> $language->get('shortcode_type_desc'),
				'child'   => array(
					'transitionin' => array(
						'group'   => 'fade',
						'type'    => 'select',
						'default' => (is_array($value)&& isset($value[0]['transitionin']) ? $value[0]['transitionin'] : 'fadeIn'),
						'values'  => array_combine(YT_Data::animations_in(), YT_Data::animations_in()),
						'name'    => $language->get('shortcode_transition_in'),
						'desc'    => $language->get('shortcode_transition_in_desc'),
						
					),       
					'transitionout' => array(
						'group'   => 'fade',
						'type'    => 'select',
						'default' => (is_array($value)&& isset($value[0]['transitionout']) ? $value[0]['transitionout'] : 'fadeOut'),
						'values'  => array_combine(YT_Data::animations_out(), YT_Data::animations_out()),
						'name'    => $language->get('shortcode_transition_out'),
						'desc'    => $language->get('shortcode_transition_out_desc')
					)
				)
			),
			'arrows' => array(
				'type'    => 'bool',
				'default' => (is_array($value)&& isset($value[0]['arrows']) ? $value[0]['arrows'] : 'yes'),
				'name'    => $language->get('shortcode_arrow'),
				'desc'    => $language->get('shortcode_arrow_desc'),
				'child'   => array(
					'arrow_position' 	=> array(
						'type' 			=> 'select',
						'default' 		=> (is_array($value)&& isset($value[0]['arrow_position']) ? $value[0]['arrow_position'] : 'arrow-default'),
						'values' 		=> YT_Data::arrow_position($language),
						'name'    		=> $language->get('shortcode_arrow_position'),
						'desc'    		=> $language->get('shortcode_arrow_position_desc')
					)
				)
			),
			'pagination' => array(
				'type'    => 'bool',
				'default' => (is_array($value)&& isset($value[0]['pagination']) ? $value[0]['pagination'] : 'no'),
				'name'    => $language->get('shortcode_pagination'),
				'desc'    => $language->get('shortcode_pagination_desc'),
				'child'   => array(
					'autoplay' => array(
						'type'    => 'bool',
						'default' => (is_array($value)&& isset($value[0]['autoplay']) ? $value[0]['autoplay'] : 'yes'),
						'name'    => $language->get('shortcode_autoplay'),
						'desc'    => $language->get('shortcode_autoplay_desc'),
					),
					'autoheight' => array(
						'type'    => 'bool',
						'default' => (is_array($value)&& isset($value[0]['autoheight']) ? $value[0]['autoheight'] : 'no'),
						'name'    => $language->get('shortcode_autoheight'),
						'desc'    => $language->get('shortcode_autoheight_desc')
					)
				)
			),
			
			'hoverpause' => array(
				'type'    => 'bool',
				'default' => (is_array($value)&& isset($value[0]['hoverpause']) ? $value[0]['hoverpause'] : 'yes'),
				'name'    => $language->get('shortcode_pasuse_hover'),
				'desc'    => $language->get('shortcode_pasuse_hover_desc'),
				'child'   => array(
					'lazyload' => array(
						'type'    => 'bool',
						'default' => (is_array($value)&& isset($value[0]['lazyload']) ? $value[0]['lazyload'] : 'no'),
						'name'    => $language->get('shortcode_lazyload'),
						'desc'    => $language->get('shortcode_lazyload_desc'),
					),
					'loop' => array(
						'type'    => 'bool',
						'default' => (is_array($value)&& isset($value[0]['loop']) ? $value[0]['loop'] : 'yes'),
						'name'    => $language->get('shortcode_loop'),
						'desc'    => $language->get('shortcode_loop_desc'),
					)
				)
			),
			
			'speed' => array(
				'type'    => 'slider',
				'default' => (is_array($value)&& isset($value[0]['speed']) ? $value[0]['speed'] : 0.6),
				'min'     => 0.1,
				'max'     => 15,
				'step'    => 0.2,
				'name'    => $language->get('shortcode_speed'),
				'desc'    => $language->get('shortcode_speed_desc'),
				'child'   => array(
					'delay' => array(
						'type'    => 'slider',
						'default' => (is_array($value)&& isset($value[0]['delay']) ? $value[0]['delay'] : 4),
						'min'     => 1,
						'max'     => 10,
						'step'    => 1,
						'name'    => $language->get('shortcode_delay'),
						'desc'    => $language->get('shortcode_delay_desc'),
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