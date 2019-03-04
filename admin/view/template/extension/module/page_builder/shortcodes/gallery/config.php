<?php 
class YT_Shortcode_gallery_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_gallery'));
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_gallery')),
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
			'caption' 		=> array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['caption']) ? $value[0]['caption'] : '0'),
				'values' 	=> YT_Data::caption_gallery($language),
				'name' 		=> $language->get('shortcode_caption_style'),
				'desc' 		=> $language->get('shortcode_caption_style_desc'),
				'child'=> array(
					'hover' 		=> array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value[0]['hover']) ? $value[0]['hover'] : '1'),
						'values' 	=> YT_Data::hover_gallery($language),
						'name' 		=> $language->get('shortcode_gallery_hover'),
						'desc' 		=> $language->get('shortcode_gallery_hover_desc')
					)
				),
			),
			'align' 		=> array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['align']) ? $value[0]['align'] : 'center'),
				'values' 	=> YT_Data::aligns_center($language),
				'name' 		=> $language->get('shortcode_align'),
				'desc' 		=> $language->get('shortcode_align_desc'),
				'child' 	=> array(
					'padding' 		=> array(
						'default' 	=> (is_array($value) && isset($value[0]['padding']) ? $value[0]['padding'] : '0px'),
						'name'		=> $language->get('shortcode_padding'),
						'desc' 		=> $language->get('shortcode_padding_desc')
					),
				),
			),
			'border' 		=> array(
				'type' 		=> 'border',
				'default' 	=> (is_array($value) && isset($value[0]['border']) ? $value[0]['border'] : '0px solid #4e9e41'),
				'name' 		=> $language->get('shortcode_border'),
				'desc' 		=> $language->get('shortcode_border_desc')
			),
			'columns_0' =>array(
				'type'    	=> 'slider',
				'default' 	=> (is_array($value) && isset($value[0]['columns_0']) ? $value[0]['columns_0'] : 4),
				'min'     	=> 1,
				'max'     	=> 6,
				'step'    	=> 1,
				'name' 		=> $language->get('shortcode_gallery_column0'),
				'desc' 		=> $language->get('shortcode_gallery_column0_desc'),
				'values' 	=> YT_Data::columns(),
				'child' 	=> array(
					'columns_1' => array(
						'type'    	=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['columns_1']) ? $value[0]['columns_1'] : 4),
						'min'     	=> 1,
						'max'     	=> 6,
						'step'    	=> 1,
						'name' 		=> $language->get('shortcode_gallery_column1'),
						'desc' 		=> $language->get('shortcode_gallery_column1_desc')
					),
					'columns_2' => array(
						'type'    	=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['columns_2']) ? $value[0]['columns_2'] : '3'),
						'min'     	=> 1,
						'max'     	=> 6,
						'step'    	=> 1,
						'name' 		=> $language->get('shortcode_gallery_column2'),
						'desc' 		=> $language->get('shortcode_gallery_column2_desc')
					),
				),
			),
			'columns_3' =>array(
				'type'    	=> 'slider',
				'default' 	=> (is_array($value) && isset($value[0]['columns_3']) ? $value[0]['columns_3'] : '2'),
				'min'     	=> 1,
				'max'     	=> 6,
				'step'    	=> 1,
				'name' 		=> $language->get('shortcode_gallery_column3'),
				'desc' 		=> $language->get('shortcode_gallery_column3_desc'),
				'child' 	=> array(
					'columns_4' => array(
						'type'    	=> 'slider',
						'default' 	=> (is_array($value) && isset($value[0]['columns_4']) ? $value[0]['columns_4'] : '1'),
						'min'     	=> 1,
						'max'     	=> 6,
						'step'    	=> 1,
						'name' 		=> $language->get('shortcode_gallery_column4'),
						'desc' 		=> $language->get('shortcode_gallery_column4_desc')
					)
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