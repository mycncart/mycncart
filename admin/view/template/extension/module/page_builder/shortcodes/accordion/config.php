<?php
class YT_Shortcode_accordion_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_accordion'));
		foreach($multiLanguage as $language_)
		{
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
        return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_accordion')),
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
				'type'    	=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['style']) ? $value[0]['style'] : 'basic'),
				'values'   	=> YT_Data::style_accordion($language),
				'name'    	=> $language->get('shortcode_style'),
				'desc'    	=> $language->get('shortcode_style_desc'),
				'child'  => array(
	                'width' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['width']) ? $value[0]['width'] : 100),
						'min' 		=> 0,
						'max' 		=> 100,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_width'),
						'desc' 		=> $language->get('shortcode_width_desc'),
					)
	            )
			),
			'color_background_active' => array(
				'type' 			=> 'bool',
				'default' 		=> (is_array($value) && isset($value[0]['color_background_active']) ? $value[0]['color_background_active'] : 'yes'),
				'name' 			=> $language->get('shortcode_color_background_active'),
				'desc' 			=> $language->get('shortcode_color_background_active_desc'),
				'child' 		=> array(
					'item_active' => array(
	                	'type'    	=> 'select',
	                    'default' 	=> (is_array($value) && isset($value[0]['item_active']) ? $value[0]['item_active'] : '1'),
	                    'values'   	=> array('1' => '1',),
	                    'name'    	=> $language->get('shortcode_item_active'),
	                    'desc'    	=> $language->get('shortcode_item_active_desc'),
	                )
				),
			),
			'background_active'=>array(
				'type' 			=> 'color',
				'default'		=> (is_array($value) && isset($value[0]['background_active']) ? $value[0]['background_active'] : '#ffffff'),
				'name' 			=> $language->get('shortcode_item_background_active'),
				'desc' 			=> $language->get('shortcode_item_background_active_desc'),
				'child' 		=> array(
					'color_active' => array(
						'type' 			=> 'color',
						'default' 		=> (is_array($value) && isset($value[0]['color_active']) ? $value[0]['color_active'] : '#cccccc'),
						'name' 			=> $language->get('shortcode_item_color_active'),
						'desc' 			=> $language->get('shortcode_item_color_active_desc'),
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