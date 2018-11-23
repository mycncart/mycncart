<?php 
class YT_Shortcode_counter_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$prefix_arr = array();
		$suffix_arr = array();
		$content_arr = array();
		$prefix = (is_array($value) && isset($value['prefix']) ? $value['prefix'] : '');
		$suffix = (is_array($value) && isset($value['suffix']) ? $value['suffix'] : '');
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_)
		{
			$prefix_arr['prefix_'.$language_] = (is_array($value) && isset($value['prefix_'.$language_]) ? $value['prefix_'.$language_] : $prefix);
			$suffix_arr['suffix_'.$language_] = (is_array($value) && isset($value['suffix_'.$language_]) ? $value['suffix_'.$language_] : $suffix);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
	    return array(
			'count_start' => array(
				'type'    => 'number',
				'default' => (is_array($value) && isset($value['count_start']) ? $value['count_start'] : 0),
				'min'     => 0,
				'max'     => 9999999,
				'step'    => 10,
				'name'    => $language->get('shortcode_count_start'),
				'desc'    => $language->get('shortcode_count_start_desc'),
				'child'   => array(
					'count_end' 	=> array(
						'type'    	=> 'number',
						'default' 	=> (is_array($value) && isset($value['count_end']) ? $value['count_end'] : 5000),
						'min'     	=> 1,
						'max'    	=> 9999999,
						'step'    	=> 10,
						'name'    	=> $language->get('shortcode_count_end'),
						'desc'    	=> $language->get('shortcode_count_end_desc')
					),
					'counter_speed' => array(
						'type'    	=> 'number',
						'default' 	=> (is_array($value) && isset($value['counter_speed']) ? $value['counter_speed'] : 5),
						'min'     	=> 1,
						'max'     	=> 100,
						'step'    	=> 1,
						'name'    	=> $language->get('shortcode_count_speed'),
						'desc'    	=> $language->get('shortcode_count_speed_desc')
					)
				)
			), 
			'prefix' 		=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value['prefix']) ? $value['prefix'] : ''),
				'values'  	=> $prefix_arr,
				'name'    	=> $language->get('shortcode_count_prefix_text'),
				'desc'    	=> $language->get('shortcode_count_prefix_text_desc'),
				'child'   	=> array(
					'suffix' 		=> array(
						'type' 		=> 'textLanguage',
						'default' 	=> (is_array($value) && isset($value['suffix']) ? $value['suffix'] : ''),
						'values'  	=> $suffix_arr,
						'name'    	=> $language->get('shortcode_count_suffix_text'),
						'desc'    	=> $language->get('shortcode_count_suffix_text_desc'),
					),
					'separator' 	=> array(
						'type'    	=> 'bool',
						'default' 	=> (is_array($value) && isset($value['separator']) ? $value['separator'] : 'no'),
						'name'    	=> $language->get('shortcode_count_separator'),
						'desc'    	=> $language->get('shortcode_count_separator_desc')
					),
				)
			),
			'align' 		=> array(
				'type'    	=> 'select',
				'default' 	=> (is_array($value) && isset($value['align']) ? $value['align'] : 'none'),
				'values'  	=> YT_Data::aligns($language),
				'name'    	=> $language->get('shortcode_align'),
				'desc'    	=> $language->get('shortcode_align_desc'),
				'child'   	=> array(
					'background' 	=> array(
						'type'    	=> 'color',
						'default' 	=> (is_array($value) && isset($value['background']) ? $value['background'] : '#ffffff'),
						'name'    	=> $language->get('shortcode_background'),
						'desc'    	=> $language->get('shortcode_background_desc'),
					),
					'border_radius' => array(
						'default' 	=> (is_array($value) && isset($value['border_radius']) ? $value['border_radius'] : '0px'),
						'name'    	=> $language->get('shortcode_border_radius'),
						'desc'    	=> $language->get('shortcode_border_radius_desc'),
					),
				),
			),
			'icon' 			=> array(
				'type'    	=> 'icon',
				'default' 	=> (is_array($value) && isset($value['icon']) ? $value['icon'] : ''),
				'name'    	=> $language->get('shortcode_icon'),
				'desc'    	=> $language->get('shortcode_icon_desc'),
				'child'   	=> array(
					'icon_color' 	=> array(
						'type'    	=> 'color',
						'default' 	=> (is_array($value) && isset($value['icon_color']) ? $value['icon_color'] : '#444444'),
						'name'    	=> $language->get('shortcode_icon_color'),
						'desc'    	=> $language->get('shortcode_icon_color_desc')
					)
				)
			),
			'count_color' => array(
				'type'    => 'color',
				'default' => (is_array($value) && isset($value['count_color']) ? $value['count_color'] : '#444444'),
				'name'    => $language->get('shortcode_count_color'),
				'desc'    => $language->get('shortcode_count_color_desc'),
				'child'   => array(
					'count_size' 	=> array(
						'default' 	=> (is_array($value) && isset($value['count_size']) ? $value['count_size'] : '32px'),
						'name'    	=> $language->get('shortcode_count_size'),
						'desc'    	=> $language->get('shortcode_count_size_desc'),
					)
				)
			),
			'text_color' 	=> array(
				'type'    	=> 'color',
				'default' 	=> (is_array($value) && isset($value['text_color']) ? $value['text_color'] : '#666666'),
				'name'    	=> $language->get('shortcode_count_text_color'),
				'desc'    	=> $language->get('shortcode_count_text_color_desc'),
				'child'   	=> array(
					'text_size' 	=> array(
						'default' 	=> (is_array($value) && isset($value['text_size']) ? $value['text_size'] : '14px'),
						'name'    	=> $language->get('shortcode_count_text_size'),
						'desc'    	=> $language->get('shortcode_count_text_size_desc'),
					)     
				)
			),      
			'border' 		=> array(
				'type'    	=> 'border',
				'default' 	=> (is_array($value) && isset($value['border']) ? $value['border'] : '0px solid #DDD'),
				'name'    	=> $language->get('shortcode_border'),
				'desc'    	=> $language->get('shortcode_border_desc')
			),
			'content' 		=> array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : ''),
				'values'	=> $content_arr,
				'name'    	=> $language->get('shortcode_content'),
			),
		);
	}
}

?>