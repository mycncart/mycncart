<?php 
class YT_Shortcode_points_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$content_arr = array();
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_){
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'x'=> array(
				'type' 		=> 'slider',
				'default' 	=> (is_array($value) && isset($value['x']) ? $value['x'] : 30),
				'min' 		=> 0,
				'max' 		=> 100,
				'step' 		=> 1,
				'name' 		=> $language->get('shortcode_points_x'),
				'desc' 		=> $language->get('shortcode_points_x_desc'),
				'child' => array(
					'y'		=> array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value['y']) ? $value['y'] : 30),
						'min' 		=> 0,
						'max' 		=> 100,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_points_y'),
						'desc' 		=> $language->get('shortcode_points_y_desc'),
					),
					'position' => array(
						'type' 		=> 'select',
						'name' 		=> $language->get('shortcode_points_position'),
						'desc' 		=> $language->get('shortcode_points_position_desc'),
						'default' 	=> (is_array($value) && isset($value['position']) ? $value['position'] : 'left'),
						'values' 	=> array(
							'bottom' 	=> $language->get('shortcode_bottom'),
							'left' 		=> $language->get('shortcode_left'),
							'top' 		=> $language->get('shortcode_top'),
							'right' 	=> $language->get('shortcode_right'),
						),
					),
				),
			),
			'content'  => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : 'Add content here'),
				'values'	=> $content_arr,
				'name' 		=> $language->get('shortcode_content'),
			),	
		);
	}
}

?>