<?php 
class YT_Shortcode_feature_box_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$content_arr = array();
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_feature_box'));
		$yt_title = (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'So Page Builder');
		$content = (is_array($value) && isset($value[0]['content']) ? $value[0]['content'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.');
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
				'values'  => YT_Data::style_feature_box($language),
				'name'    => $language->get('shortcode_style'),
				'desc'    => $language->get('shortcode_style_desc'),
				'child'   => array(
					'box_color' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['box_color']) ? $value[0]['box_color'] : '#a1c63d'),
						'name'    => $language->get('shortcode_color'),
						'desc'    => $language->get('shortcode_color_desc'),    
					),                     
					'radius' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['radius']) ? $value[0]['radius'] : 100),
						'min' 		=> 0,
						'max' 		=> 100,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_radius'),
						'desc' 		=> $language->get('shortcode_radius_slide_desc'),
					),
				),
			),
			
			'icon' 	=> array(
				'type'		=>'icon',
				'default' 	=> (is_array($value) && isset($value[0]['icon']) ? $value[0]['icon'] : 'icon:android'),
				'name' 		=> $language->get('shortcode_icon'),
				'desc' 		=> $language->get('shortcode_icon_desc'),
				'child'		=> array(
					'icon_color'=>array(
						'type' 		=> 'color',
						'default'	=> (is_array($value) && isset($value[0]['icon_color']) ? $value[0]['icon_color'] : '#ffffff'),
						'name' 		=> $language->get('shortcode_icon_color'),
						'desc' 		=> $language->get('shortcode_icon_color_desc')
					),
					'icon_size' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['icon_size']) ? $value[0]['icon_size'] : 32),
						'min'  		=> 14,
						'max'  		=> 40,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_icon_size'),
						'desc' 		=> $language->get('shortcode_icon_size_desc'),
					),
				)
			),
			'yt_title' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'So Page Builder'),
				'values'	=> $title_arr,
				'name' 		=> $language->get('shortcode_title'),
				'desc' 		=> $language->get('shortcode_title_desc')
			), 
			'title_color' => array(
				'type'    => 'color',
				'default' => (is_array($value) && isset($value[0]['title_color']) ? $value[0]['title_color'] : '#1a1a1a'),
				'name'    => $language->get('shortcode_title_color'),
				'desc'    => $language->get('shortcode_title_color_desc'),
				'child'  	=> array(
					'align' => array(
						'type'    => 'select',
						'default' => (is_array($value) && isset($value[0]['align']) ? $value[0]['align'] : 'center'),
						'values'  => YT_Data::aligns_center($language),
						'name'    => $language->get('shortcode_align'),
						'desc'    => $language->get('shortcode_align_desc')
					),
					'padding' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['padding']) ? $value[0]['padding'] : 40),
						'min'  		=> 0,
						'max'  		=> 40,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_padding'),
						'desc' 		=> $language->get('shortcode_padding_slide_desc'),
					)
				)
			),
			'content'  => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['text_content']) ? $value[0]['text_content'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.'),
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