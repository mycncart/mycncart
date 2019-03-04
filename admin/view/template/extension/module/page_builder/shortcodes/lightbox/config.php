<?php 
class YT_Shortcode_lightbox_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$description_arr = array();
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_lightbox'));
		$yt_title = (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title');
		$description = (is_array($value) && isset($value[0]['description']) ? $value[0]['description'] : 'Add content here');
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value[0]['yt_title_'.$language_]) ? $value[0]['yt_title_'.$language_] : $yt_title);
			$description_arr['description_'.$language_] = (is_array($value) && isset($value[0]['description_'.$language_]) ? $value[0]['description_'.$language_] : $description);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_lightbox')),
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
			'yt_title' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title'),
				'values'  	=> $title_arr,
				'name' 		=> $language->get('shortcode_lightbox_title'),
				'desc' 		=> $language->get('shortcode_lightbox_title_desc'),
				'child' => array(
					'align' 		=> array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value[0]['align']) ? $value[0]['align'] : 'left'),
						'values' 	=> YT_Data::aligns($language),
						'name' 		=> $language->get('shortcode_align'),
						'desc' 		=> $language->get('shortcode_align_desc')
					),
				),
			),
			'type' => array(
				'type'   	=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['type']) ? $value[0]['type'] : 'none'),
				'values' 	=> YT_Data::type_lightbox($language),
				'name'    	=> $language->get('shortcode_lightbox_inline'),
				'desc'    	=> $language->get('shortcode_lightbox_inline_desc'),
				'child'   	=> array(
					 'style' => array(
						'type'   => 'select',
						'default' => (is_array($value) && isset($value[0]['style']) ? $value[0]['style'] : 'none'),
						'values' => YT_Data::style_lightbox($language),
						'name'    => $language->get('shortcode_style'),
						'desc'    => $language->get('shortcode_style_desc'),
					),
				),
			),
			'src' => array(
				'type' 		=> 'media',
				'default' 	=> (is_array($value) && isset($value[0]['src']) ? $value[0]['src'] : 'no_image.png'),
				'name' 		=> $language->get('shortcode_lightbox_src'),
				'desc' 		=> $language->get('shortcode_lightbox_src_desc'),
				'child' => array(
					'video_addr' => array(
						'default' 	=> (is_array($value) && isset($value[0]['video_addr']) ? $value[0]['video_addr'] : ''),
						'name' 		=> $language->get('shortcode_lightbox_video'),
						'desc' 		=> $language->get('shortcode_lightbox_video_desc'),
					),
				),
			),
			'width' =>array(
				'default' 	=> (is_array($value) && isset($value[0]['width']) ? $value[0]['width'] : '100%'),
				'name' 		=> $language->get('shortcode_width'),
				'desc' 		=> $language->get('shortcode_width_px_%_desc'),
				'child' => array(
					'height' =>array(
						'default' 	=> (is_array($value) && isset($value[0]['height']) ? $value[0]['height'] : '100%'),
						'name'  	=> $language->get('shortcode_height'),
						'desc' 		=> $language->get('shortcode_height_desc'),
					),
					'lightbox' => array(
						'type' 		=> 'bool',
						'default' 	=> (is_array($value) && isset($value[0]['lightbox']) ? $value[0]['lightbox'] : 'yes'),
						'name' 		=> $language->get('shortcode_lightbox_light'),
						'desc' 		=> $language->get('shortcode_lightbox_light_desc'),
					),
				),
			),
			'description' => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['description']) ? $value[0]['description'] : ''),
				'values'	=> $description_arr,
				'name' 		=> $language->get('shortcode_lightbox_description'),
				'desc' 		=> $language->get('shortcode_lightbox_description_desc'),
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