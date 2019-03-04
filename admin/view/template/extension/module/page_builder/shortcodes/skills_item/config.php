<?php 
class YT_Shortcode_skills_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$yt_title = (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title');
		foreach($multiLanguage as $language_)
		{
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value['yt_title_'.$language_]) ? $value['yt_title_'.$language_] : $yt_title);
		}
		return array(
			'yt_title' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title'),
				'values'	=> $title_arr,
				'name' 		=> $language->get('shortcode_skill_item_title'),
				'desc' 		=> $language->get('shortcode_skill_item_title_desc'),
				'child' => array(
					'number' => array(
						'default' 	=> (is_array($value) && isset($value['number']) ? $value['number'] : '30'),
						'name' 		=> $language->get('shortcode_skill_number'),
						'desc'		=> $language->get('shortcode_skill_number_desc')
					),
				),
			),
		); 
	}
}

?>