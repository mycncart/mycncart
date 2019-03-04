<?php 
class YT_Shortcode_promotion_box_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$button_text_arr = array();
		$content_arr = array();
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_promotion_box'));
		$yt_title = (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title');
		$button_text = (is_array($value) && isset($value[0]['button_text']) ? $value[0]['button_text'] : 'Click here');
		$content = (is_array($value) && isset($value[0]['content']) ? $value[0]['content'] : 'Add content here');
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value[0]['yt_title_'.$language_]) ? $value[0]['yt_title_'.$language_] : $yt_title);
			$button_text_arr['button_text_'.$language_] = (is_array($value) && isset($value[0]['button_text_'.$language_]) ? $value[0]['button_text_'.$language_] : $button_text);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value[0]['content_'.$language_]) ? $value[0]['content_'.$language_] : $content);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_promotion_box')),
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
			'type' => array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['type']) ? $value[0]['type'] : ''),
				'name' 		=> $language->get('shortcode_promotion_box_type'),
				'desc' 		=> $language->get('shortcode_promotion_box_type_desc'),
				'values' 	=> array(
						'' 					=> $language->get('shortcode_none'),
						'border' 			=> $language->get('shortcode_border'),
						'background-border'	=> $language->get('shortcode_background_border'),
						'arrow-box' 		=> $language->get('shortcode_arrow_box'),
				),
				'child' 	=> array(
					'align' => array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value[0]['align']) ? $value[0]['align'] : 'left'),
						'name' 		=> $language->get('shortcode_promotion_box_align'),
						'desc' 		=> $language->get('shortcode_promotion_box_align_desc'),
						'values' 	=> array(
							'left' 	=> $language->get('shortcode_left'),
							'center'=> $language->get('shortcode_center'),
							'right' => $language->get('shortcode_right'),
						),
					),
				),
			),
			'yt_title' 		=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title'),
				'values'	=> $title_arr,
				'name' 		=> $language->get('shortcode_title'),
				'desc' 		=> $language->get('shortcode_title_desc'),
				'child'  	=> array(
					'title_color' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['title_color']) ? $value[0]['title_color'] : '#ffffff'),
						'name'    => $language->get('shortcode_title_color'),
						'desc'    => $language->get('shortcode_title_color_desc')
					)
				)
			), 
			'button_text' 	=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['button_text']) ? $value[0]['button_text'] : 'Click here' ),
				'values'	=> $button_text_arr,
				'name' 		=> $language->get('shortcode_promotion_box_button_text'),
				'desc' 		=> $language->get('shortcode_promotion_box_button_text_desc'),
				'child' 	=> array(
					'button_link' 	=> array(
						'name' 		=> $language->get('shortcode_promotion_box_button_link'),
						'desc' 		=> $language->get('shortcode_promotion_box_button_link_desc'),
						'default' 	=> (is_array($value) && isset($value[0]['button_link']) ? $value[0]['button_link'] : ''),
					),
				),
			),
			'width' => array(
				'type' 		=> 'slider',
				'default' 	=> (is_array($value) && isset($value[0]['width']) ? $value[0]['width'] : 100),
				'min' 		=> 0,
				'max' 		=> 100,
				'step' 		=> 1,
				'name' 		=> $language->get('shortcode_width'),
				'desc' 		=> $language->get('shortcode_width_px_desc'),
				'child' => array(
					'target' 		=> array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value[0]['target']) ? $value[0]['target'] : '_self'),
						'name' 		=> $language->get('shortcode_promotion_box_target'),
						'desc' 		=> $language->get('shortcode_promotion_box_target_desc'),
						'values'	=> array(
							'_self' => $language->get('shortcode_self'),
							'_blank'=> $language->get('shortcode_blank')
						),
					),
				),
			),
			'promotion_color' 	=> array(
				'type'			=> 'color',
				'default' 		=> (is_array($value) && isset($value[0]['promotion_color']) ? $value[0]['promotion_color'] : '#000'),
				'name' 			=> $language->get('shortcode_promotion_box_color'),
				'desc' 			=> $language->get('shortcode_promotion_box_color_desc'),
				'child' 	=> array(
					'promotion_background' 	=> array(
						'type'				=> 'color',
						'default' 			=> (is_array($value) && isset($value[0]['promotion_background']) ? $value[0]['promotion_background'] : '#ddd'),
						'name' 				=> $language->get('shortcode_promotion_box_background'),
						'desc' 				=> $language->get('shortcode_promotion_box_background_desc'),
					),
					'promotion_radius' 		=> array(
						'default' 			=> (is_array($value) && isset($value[0]['promotion_radius']) ? $value[0]['promotion_radius'] : '3px'),
						'name' 				=> $language->get('shortcode_promotion_box_radius'),
						'desc' 				=> $language->get('shortcode_promotion_box_radius_desc'),
					),
				),
			),
			'button_color' 		=> array(
				'type'			=>'color',
				'default' 		=> (is_array($value) && isset($value[0]['button_color']) ? $value[0]['button_color'] : '#fff'),
				'name' 			=> $language->get('shortcode_promotion_box_button_color'),
				'desc' 			=> $language->get('shortcode_promotion_box_button_color_desc'),
				'child' 	=> array(
					'button_background' => array('type'=>'color',
						'default' 		=> (is_array($value) && isset($value[0]['button_background']) ? $value[0]['button_background'] : '#4e9e41'),
						'name' 			=> $language->get('shortcode_promotion_box_button_background'),
						'desc' 			=> $language->get('shortcode_promotion_box_button_background_desc'),
					),
					'button_background_hover' 	=> array('type'=>'color',
						'default' 				=> (is_array($value) && isset($value[0]['button_background_hover']) ? $value[0]['button_background_hover'] : '#2e6b24'),
						'name' 					=> $language->get('shortcode_promotion_box_button_background_hover'),
						'desc' 					=> $language->get('shortcode_promotion_box_button_background_hover_desc'),
					),
					'button_radius' 	=> array(
						'default' 		=> (is_array($value) && isset($value[0]['button_radius']) ? $value[0]['button_radius'] : '3px'),
						'name' 			=> $language->get('shortcode_promotion_box_button_radius'),
						'desc' 			=> $language->get('shortcode_promotion_box_button_radius_desc'),
					),
				),
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