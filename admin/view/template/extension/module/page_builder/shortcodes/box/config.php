<?php 
class YT_Shortcode_box_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$content_arr = array();
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_box'));
		$yt_title = (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title');
		$content = (is_array($value) && isset($value[0]['content']) ? $value[0]['content'] : 'Add content here');
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value[0]['yt_title_'.$language_]) ? $value[0]['yt_title_'.$language_] : $yt_title);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value[0]['content_'.$language_]) ? $value[0]['content_'.$language_] : $content);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_box')),
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
				'values'  => YT_Data::style_box($language),
				'name'    => $language->get('shortcode_style'),
				'desc'    => $language->get('shortcode_style_desc'),
				'child'   => array(
					'box_color' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['box_color']) ? $value[0]['box_color'] : '#333333'),
						'name'    => $language->get('shortcode_color'),
						'desc'    => $language->get('shortcode_color_desc'),    
					),                     
					'radius' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['radius']) ? $value[0]['radius'] : 0),
						'min' 		=> 0,
						'max' 		=> 20,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_radius'),
						'desc' 		=> $language->get('shortcode_radius_slide_desc'),
					),
				),
			),
			'yt_title' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title'),
				'values'	=> $title_arr,
				'name' 		=> $language->get('shortcode_title'),
				'desc' 		=> $language->get('shortcode_title_desc'),
				'child'  => array(
					'title_color' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['title_color']) ? $value[0]['title_color'] : '#ffffff'),
						'name'    => $language->get('shortcode_title_color'),
						'desc'    => $language->get('shortcode_title_color_desc')
					)
				)
			), 
			'content'  => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['text_content']) ? $value[0]['text_content'] : 'Add content here'),
				'values'	=> $content_arr,
				'name' 		=> $language->get('shortcode_content'),
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