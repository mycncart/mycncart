<?php 
class YT_Shortcode_content_slider_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_)
		{
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'src' => array(
				'type' 		=> 'media',
				'default' 	=> (is_array($value) && isset($value['src']) ? $value['src'] : 'no_image.png'),
				'name' 		=> $language->get('shortcode_media'),
				'desc' 		=> $language->get('shortcode_media_desc'),
				'child' 	=> array(
					'caption' 		=> array(
						'type' 		=> 'bool',
						'default' 	=> (is_array($value) && isset($value['caption']) ? $value['caption'] : 'no'),
						'name' 		=> $language->get('shortcode_caption'),
						'desc' 		=> $language->get('shortcode_caption_desc'),
					),
			   ),
			),
			'link'  => array(
				'default' 	=> (is_array($value) && isset($value['link']) ? $value['link'] : ''),
				'name' 		=> $language->get('shortcode_link'),
				'desc' 		=> $language->get('shortcode_link_desc'),
			),	   
			'content' => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : 'Add Content Here'),
				'values'	=> $content_arr,
				'name'  	=> $language->get('shortcode_content'),
			),		
		);
	}
}

?>