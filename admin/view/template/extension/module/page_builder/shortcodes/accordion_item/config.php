<?php 
class YT_Shortcode_accordion_item_config {
	static function get_config($language,$value){
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$content_arr = array();
		$yt_title = (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Item Title');
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : 'Add content here');
		foreach($multiLanguage as $language_)
		{
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value['yt_title_'.$language_]) ? $value['yt_title_'.$language_] : $yt_title);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'yt_title'=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Item Title'),
				'values'	=> $title_arr,
				'name'  	=> $language->get('shortcode_title'),
				'desc'  	=> $language->get('shortcode_title_desc'),
				'child'=> array(
					'icon' 	=> array(
						'type'		=>'icon',
						'default' 	=> (is_array($value) && isset($value['icon']) ? $value['icon'] : 'icon:heart'),
						'name' 		=> $language->get('shortcode_icon'),
						'desc' 		=> $language->get('shortcode_icon_desc'),
					),
				),
			),
		   	'icon_color'=>array(
				'type' 		=> 'color',
				'default'	=> (is_array($value) && isset($value['icon_color']) ? $value['icon_color'] : '#cccccc'),
				'name' 		=> $language->get('shortcode_icon_color'),
				'desc' 		=> $language->get('shortcode_icon_color_desc'),
				'child'=>array(
					'icon_size' => array(
						'type' 		=> 'slider',
						'default' 	=> (is_array($value) && isset($value['icon_size']) ? $value['icon_size'] : 16),
						'min'  		=> 14,
						'max'  		=> 20,
						'step' 		=> 1,
						'name' 		=> $language->get('shortcode_icon_size'),
						'desc' 		=> $language->get('shortcode_icon_size_desc'),
					),
				),
			),
			'color_title'=>array(
				'type' 		=> 'color',
				'default'	=> (is_array($value) && isset($value['color_title']) ? $value['color_title'] : '#000000'),
				'name' 		=> $language->get('shortcode_title_color'),
				'desc' 		=> $language->get('shortcode_title_color_desc'),
				'child' => array(
					'color_desc'=>array(
						'type' 		=> 'color',
						'default'	=> (is_array($value) && isset($value['color_desc']) ? $value['color_desc'] : '#000000'),
						'name' 		=> $language->get('shortcode_item_color_desc'),
						'desc' 		=> $language->get('shortcode_item_color_desc_desc'),
					),
				),
			),
			'background'=>array(
				'type' 		=> 'color',
				'default'	=> (is_array($value) && isset($value['background']) ? $value['background'] : '#ffffff'),
				'name' 		=>	$language->get('shortcode_background'),
				'desc' 		=>  $language->get('shortcode_background_desc'),
				'child' => array(
					'border_color' => array(
						'type' 		=> 'color',
						'default' 	=> (is_array($value) && isset($value['border_color']) ? $value['border_color'] : '#cccccc'),
						'name' 		=> $language->get('shortcode_border_color'),
						'desc' 		=> $language->get('shortcode_border_color_desc'),		
					),
				),
			),
			'content' => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : 'Add Content Here'),
				'values'	=> $content_arr,
				'name'  	=> $language->get('shortcode_content')
			),			  
		);
	}
	
}

?>