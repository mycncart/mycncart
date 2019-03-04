<?php 
class YT_Shortcode_testimonial_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$author_arr = array();
		$position_arr = array();
		$content_arr = array();
		$author = (is_array($value) && isset($value['author']) ? $value['author'] : 'TESTIMONIAL AUTHOR');
		$position = (is_array($value) && isset($value['position']) ? $value['position'] : 'AUTHOR POSITION');
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_)
		{
			$author_arr['author_'.$language_] = (is_array($value) && isset($value['author_'.$language_]) ? $value['author_'.$language_] : $author);
			$position_arr['position_'.$language_] = (is_array($value) && isset($value['position_'.$language_]) ? $value['position_'.$language_] : $position);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'author' => array(
				'type' 		=> 'textLanguage',
				'default'	=> (is_array($value) && isset($value['author']) ? $value['author'] : 'TESTIMONIAL AUTHOR'),
				'values'	=> $author_arr,
				'name' 		=> $language->get('shortcode_testimonial_author'),
				'desc' 		=> $language->get('shortcode_testimonial_author_desc'),
				'child' => array(
					'position' => array(
						'type' 		=> 'textLanguage',
						'default'	=> (is_array($value) && isset($value['position']) ? $value['position'] : 'AUTHOR POSITION'),
						'values'	=> $position_arr,
						'name' 		=> $language->get('shortcode_testimonial_position'),
						'desc' 		=> $language->get('shortcode_testimonial_position_desc'),
					),
					'avatar' => array(
						'type' 		=> 'media',
						'default'	=> (is_array($value) && isset($value['avatar']) && $value['avatar'] != "" ? $value['avatar'] : 'no_image.png'),
						'name' 		=> $language->get('shortcode_testimonial_avatar'),
						'desc' 		=> $language->get('shortcode_testimonial_avatar_desc')
					),	
				),
			),
			'content' => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : 'Add content here'),
				'values'	=> $content_arr,
				'name' 		=> $language->get('shortcode_content'),
				
			),
		);
	}
}

?>