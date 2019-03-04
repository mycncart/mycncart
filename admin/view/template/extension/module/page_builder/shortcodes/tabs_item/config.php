<?php 
class YT_Shortcode_tabs_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$content_arr = array();
		$yt_title = (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title');
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_)
		{
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value['yt_title_'.$language_]) ? $value['yt_title_'.$language_] : $yt_title);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'yt_title'=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title'),
				'values'	=> $title_arr,
				'name' 		=> $language->get('shortcode_title'),
				'desc' 		=> $language->get('shortcode_title_desc'),
				'child' 	=> array(
					'icon'	=> array(
						'type'		=> 'icon',
						'default' 	=> (is_array($value) && isset($value['icon']) ? $value['icon'] : ''),
						'name' 		=> $language->get('shortcode_icon'),
						'desc' 		=> $language->get('shortcode_icon_desc'),
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