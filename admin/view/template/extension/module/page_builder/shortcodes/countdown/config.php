<?php 
class YT_Shortcode_countdown_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_countdown'));
		foreach($multiLanguage as $language_)
		{
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_countdown')),
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
			'count_date' 	=> array(
				'default' 	=> (is_array($value) && isset($value[0]['count_date']) ? $value[0]['count_date'] : '2020/12/25'),
				'name' 		=> $language->get('shortcode_cd_date'),
				'desc' 		=> $language->get('shortcode_cd_date_desc'),
				'child'   	=> array(
					'count_time' 	=> array(
						'default' 	=> (is_array($value) && isset($value[0]['count_time']) ? $value[0]['count_time'] : ''),
						'name' 		=> $language->get('shortcode_cd_time'),
						'desc' 		=> $language->get('shortcode_cd_time_desc')
					)         
				)
			),                
			'align' => array(
				'type'    => 'select',
				'default' => (is_array($value) && isset($value[0]['align']) ? $value[0]['align'] : 'left'),
				'values'  => YT_Data::aligns_center($language),
				'name'    => $language->get('shortcode_cd_align'),
				'desc'    => $language->get('shortcode_cd_align_desc'),
				'child' => array(
					'count_size' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['count_size']) ? $value[0]['count_size'] : 32),
						'min' 		=> 8,
						'max' 		=> 128,
						'step' 		=> 2,
						'name' 		=> $language->get('shortcode_cd_size'),
						'desc' 		=> $language->get('shortcode_cd_size_desc'),
					),
				),
			),
			'count_color' 	=> array(
				'type' 		=> 'color',
				'default' 	=> (is_array($value) && isset($value[0]['count_color']) ? $value[0]['count_color'] : '#666666'),
				'name' 		=> $language->get('shortcode_cd_color'),
				'desc' 		=> $language->get('shortcode_cd_color_desc'),
				'child'   	=> array(
					'background' 	=> array(
						'type' 		=> 'color',
						'default' 	=> (is_array($value) && isset($value[0]['background']) ? $value[0]['background'] : '#ffffff'),
						'name' 		=> $language->get('shortcode_cd_txt_background'),
						'desc' 		=> $language->get('shortcode_cd_txt_background_desc'),
					),
					'text_color' => array(
						'type' 		=> 'color',
						'default' 	=> (is_array($value) && isset($value[0]['text_color']) ? $value[0]['text_color'] : '#999999'),
						'name' 		=> $language->get('shortcode_cd_txt_color'),
						'desc' 		=> $language->get('shortcode_cd_txt_color_desc'),
					)
				)
			),                
			'text_align' 	=> array(
				'type'    	=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['text_align']) ? $value[0]['text_align'] : 'default'),
				'values'   	=> YT_Data::text_align($language),
				'name'    	=> $language->get('shortcode_cd_txt_align'),
				'desc'    	=> $language->get('shortcode_cd_txt_align_desc'),
				'child'   	=> array(
					'text_size' 	=> array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['text_size']) ? $value[0]['text_size'] : 14),
						'min' 		=> 8,
						'max' 		=> 72,
						'step' 		=> 2,
						'name' 		=> $language->get('shortcode_cd_txt_size'),
						'desc' 		=> $language->get('shortcode_cd_txt_size_desc'),
					)
				)
			),
			'padding' => array(
				'default' 	=> (is_array($value) && isset($value[0]['padding']) ? $value[0]['padding'] : '0px'),
				'name' 		=> $language->get('shortcode_padding'),
				'desc' 		=> $language->get('shortcode_padding_desc'),
				'child'   	=> array(
					'margin' 	=> array(
						'default' 	=> (is_array($value) && isset($value[0]['margin']) ? $value[0]['margin'] : '0px'),
						'name' 		=> $language->get('shortcode_margin'),
						'desc'	 	=> $language->get('shortcode_margin_desc'),
					),
					'radius' 	=> array(
						'default' 	=> (is_array($value) && isset($value[0]['radius']) ? $value[0]['radius'] : '0px'),
						'name' 		=> $language->get('shortcode_radius'),
						'desc' 		=> $language->get('shortcode_radius_desc')
					)
				)
			),   
			'divider' => array(
				'type'    	=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['divider']) ? $value[0]['divider'] : 'none'),
				'values'   	=> YT_Data::dividers($language),
				'name'    	=> $language->get('shortcode_cd_divider'),
				'desc'    	=> $language->get('shortcode_cd_divider_desc'),
				'child'   	=> array(
					'divider_color' => array(
						'type' 		=> 'color',
						'default' 	=> (is_array($value) && isset($value[0]['divider_color']) ? $value[0]['divider_color'] : '#999999'),
						'name' 		=> $language->get('shortcode_cd_divider_color'),
						'desc' 		=> $language->get('shortcode_cd_divider_color_desc')
					),
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