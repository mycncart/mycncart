<?php 
class YT_Shortcode_social_icon_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$yt_title = (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title');
		foreach($multiLanguage as $language_)
		{
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value['yt_title_'.$language_]) ? $value['yt_title_'.$language_] : $yt_title);
		}
		return array(
			'type' => array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value) && isset($value['type']) ? $value['type'] : 'facebook'),
				'values' 	=> YT_Data::social_icons($language),
				'name' 		=> $language->get('shortcode_social_icons_type'),
				'desc' 		=> $language->get('shortcode_social_icons_type_desc'),
				'child' => array(
					'yt_title' => array(
						'type' 		=> 'textLanguage',
						'default' 	=> (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Title'),
						'values'	=> $title_arr,
						'name' 		=> $language->get('shortcode_social_icons_title'),
						'desc' 		=> $language->get('shortcode_social_icons_title_desc')
					),
					'color' => array(
						'type' 		=> 'bool',
						'default' 	=> (is_array($value) && isset($value['color']) ? $value['color'] : 'yes'),
						'name' 		=> $language->get('shortcode_social_icons_color'),
						'desc' 		=> $language->get('shortcode_social_icons_color_desc')
					),
				),
			),
			'style' => array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value) && isset($value['style']) ? $value['style'] : ''),
				'values' 	=> YT_Data::social_icons_style($language),
				'name' 		=> $language->get('shortcode_social_icons_style'),
				'desc' 		=> $language->get('shortcode_social_icons_style_desc'),
				'child' => array(
					'size' => array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value['size']) ? $value['size'] : 'default'),
						'values' 	=> YT_Data::size_social_icons($language),
						'name' 		=> $language->get('shortcode_social_icons_size'),
						'desc' 		=> $language->get('shortcode_social_icons_size_desc')
					),
					'link' => array(
						'default' 	=> (is_array($value) && isset($value['link']) ? $value['link'] : 'http://smartaddons.com'),
						'name' 		=> $language->get('shortcode_social_icons_link'),
						'desc' 		=> $language->get('shortcode_social_icons_link_desc')
					),
				),
			),
		);
	}
}

?>