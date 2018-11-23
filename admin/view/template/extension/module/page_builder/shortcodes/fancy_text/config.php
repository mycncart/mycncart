<?php 
class YT_Shortcode_fancy_text_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$tags_arr = array();
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_fancy_text'));
		$tags = (is_array($value) && isset($value[0]['tags']) ? $value[0]['tags'] : 'Text 1, Text 2, Text 3');
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
			$tags_arr['tags_'.$language_] = (is_array($value) && isset($value[0]['tags_'.$language_]) ? $value[0]['tags_'.$language_] : $tags);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_fancy_text')),
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
			'tags' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['tags']) ? $value[0]['tags'] : 'Text 1, Text 2, Text 3'),
				'values'  	=> $tags_arr,
				'name'    	=> $language->get('shortcode_fancy_text_tags'),
				'desc'    	=> $language->get('shortcode_fancy_text_tags_desc'),
				'child'   	=> array(
					'type' => array(
						'type'   => 'select',
						'values' => array(
							'1'  => $language->get('shortcode_type_1'),
							'2'  => $language->get('shortcode_type_2'),
							'3'  => $language->get('shortcode_type_3'),
							'4'  => $language->get('shortcode_type_4'),
							'5'  => $language->get('shortcode_type_5'),
							'6'  => $language->get('shortcode_type_6'),
							'7'  => $language->get('shortcode_type_7'),
							'8'  => $language->get('shortcode_type_8'),
							'9'  => $language->get('shortcode_type_9'),
							'10' => $language->get('shortcode_type_10'),
						),
						'default' => (is_array($value) && isset($value[0]['type']) ? $value[0]['type'] : 'rotate-1'),
						'name'    => $language->get('shortcode_type'),
						'desc'    => $language->get('shortcode_type_desc')
					),
				),
			),
			 
			'color' => array(
				'type'		=> 'color',
				'default' 	=> (is_array($value) && isset($value[0]['color']) ? $value[0]['color'] : '#000'),
				'name' 		=> $language->get('shortcode_color'),
				'desc' 		=> $language->get('shortcode_color_desc'),
				'child' => array(
					'size' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['size']) ? $value[0]['size'] : 12),
						'min' 		=> 1,
						'max' 		=> 50,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_size'),
						'desc' 		=> $language->get('shortcode_size_desc'),
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