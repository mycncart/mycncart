<?php 
class YT_Shortcode_gallery_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$tag_arr = array();
		$content_arr = array();
		$tag = (is_array($value) && isset($value['tag']) ? $value['tag'] : 'Tag');
		$yt_title = (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title gallery');
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_)
		{
			$tag_arr['tag_'.$language_] = (is_array($value) && isset($value['tag_'.$language_]) ? $value['tag_'.$language_] : $tag);
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value['yt_title_'.$language_]) ? $value['yt_title_'.$language_] : $yt_title);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'tag' => array(
				'type' 		=> 'textLanguage',
				'name' 		=> $language->get('shortcode_gallery_item_tag'),
				'desc' 		=> $language->get('shortcode_gallery_item_tag_desc'),
				'default' 	=> (is_array($value) && isset($value['tag']) ? $value['tag'] : 'Tag'),
				'values'	=> $tag_arr,
				'child' 	=> array(
					'yt_title' 		=> array(
						'type' 		=> 'textLanguage',
						'default' 	=> (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title gallery'),
						'values'	=> $title_arr,
						'name' 		=> $language->get('shortcode_gallery_item_title'),
						'desc' 		=> $language->get('shortcode_gallery_item_title_desc'),
					), 
				),
			),
			'src' => array(
				'type' 		=> 'media',
				'name' 		=> $language->get('shortcode_gallery_item_src'),
				'desc' 		=> $language->get('shortcode_gallery_item_src_desc'),
				'default' 	=> (is_array($value) && isset($value['src']) && $value['src'] != '' ? $value['src'] : 'no_image.png'),
				'child'		=> array(
					'video_addr' 	=> array(
						'name' 		=> $language->get('shortcode_gallery_item_video'),
						'desc' 		=> $language->get('shortcode_gallery_item_video_desc'),
						'default' 	=> (is_array($value) && isset($value['video_addr']) ? $value['video_addr'] : ''),
					),
				),
			),
			'content' 	=> array(
				'type' 		=> 'textareaEditorLanguage',
				'name' 		=> $language->get('shortcode_content'),
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : 'Description image'),
				'values'	=> $content_arr,
			),
		);
	}
}

?>