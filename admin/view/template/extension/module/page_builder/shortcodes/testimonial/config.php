<?php 
class YT_Shortcode_testimonial_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$content_arr = array();
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_testimonial'));
		$yt_title = (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title');
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value[0]['yt_title_'.$language_]) ? $value[0]['yt_title_'.$language_] : $yt_title);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_testimonial')),
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
			'yt_title'=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title'),
				'values'  	=> $title_arr,
				'name' 		=> $language->get('shortcode_title'),
				'desc' 		=> $language->get('shortcode_title_desc'),
				'child' 	=> array(
					'display_avatar' => array(
						'type'		=> 'bool',
						'default' 	=> (is_array($value) && isset($value[0]['display_avatar']) ? $value[0]['display_avatar'] : 'yes'),
						'name' 		=> $language->get('shortcode_testimonial_display_avatar'),
						'desc' 		=> $language->get('shortcode_testimonial_display_avatar_desc'),
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
			'border'=> array(
				'type' 		=> 'border',
				'default' 	=> (is_array($value) && isset($value[0]['border']) ? $value[0]['border'] : '1px solid #ccc'),
				'name' 		=> $language->get('shortcode_border'),
				'desc' 		=> $language->get('shortcode_border_desc'),
			),
			'background' => array(
				'type' 		=> 'media',
				'default' 	=> (is_array($value) && isset($value[0]['background']) && $value[0]['background'] != "" ? $value[0]['background'] : 'no_image.png'),
				'name' 		=> $language->get('shortcode_background'),
				'desc' 		=> $language->get('shortcode_background_image_desc'),
				'child' => array(
					'title_color'=>array(
						'type' 		=> 'color',
						'default' 	=> (is_array($value) && isset($value[0]['title_color']) ? $value[0]['title_color'] : '#cccccc'),
						'name' 		=> $language->get('shortcode_color'),
						'desc' 		=> $language->get('shortcode_color_desc'),
					),
				),
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