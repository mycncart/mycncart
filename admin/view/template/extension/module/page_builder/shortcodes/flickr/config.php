<?php 
class YT_Shortcode_flickr_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_flickr'));
		foreach($multiLanguage as $language_)
		{
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_flickr')),
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
			'id_flickr' => array(
				'default' => (is_array($value) && isset($value[0]['id_flickr']) ? $value[0]['id_flickr'] : '95572727@N00'),
				'name'    => $language->get('shortcode_flickr_id'),
				'desc'    => $language->get('shortcode_flickr_id_desc'),
			),  
			'limit' => array(
				'type'    => 'slider',
				'default' => (is_array($value) && isset($value[0]['limit']) ? $value[0]['limit'] : '9'),
				'min'     => '0',
				'max'     => '100',
				'step'    => '1',
				'name'    => $language->get('shortcode_limit'),
				'desc'    => $language->get('shortcode_limit_desc'),
				'child'   => array(
					'lightbox' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['lightbox']) ? $value[0]['lightbox'] : 'no'),
						'name'    => $language->get('shortcode_lightbox'),
						'desc'    => $language->get('shortcode_lightbox_desc'),
					),                  
					'radius' => array(
						'default' => (is_array($value) && isset($value[0]['radius']) ? $value[0]['radius'] : '0px'),
						'name'    => $language->get('shortcode_radius'),
						'desc'    => $language->get('shortcode_radius_desc'),
					),
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