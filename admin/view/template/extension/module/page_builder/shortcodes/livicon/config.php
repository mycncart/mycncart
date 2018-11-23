<?php 
class YT_Shortcode_livicon_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_livicon'));
		$yt_title = (is_array($value) && isset($value[0]['yt_title']) ? $value[0]['yt_title'] : 'Title');
		$content = (is_array($value) && isset($value[0]['content']) ? $value[0]['content'] : 'Add content here');
		foreach($multiLanguage as $language_){
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_livicon')),
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
			'icon' => array(
				'type'    => 'select',
				'values'  => array_combine( YT_Data::livicons(), YT_Data::livicons() ),
				'default' => (is_array($value) && isset($value[0]['icon']) ? $value[0]['icon'] : 'heart'),
				'name'    => $language->get('shortcode_livicon_icon'),
				'desc'    => $language->get('shortcode_livicon_icon_desc'),
				'child'   => array(
					'size' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['size']) ? $value[0]['size'] : 32),
						'min'     => '4',
						'max'     => '256',
						'step'    => '2',
						'name'    => $language->get('shortcode_livicon_icon_size'),
						'desc'    => $language->get('shortcode_livicon_icon_size_desc')
					)
				)
			),
			'color' => array(
				'type'    => 'color',
				'default' => (is_array($value) && isset($value[0]['color']) ? $value[0]['color'] : '#555555'),
				'name'    => $language->get('shortcode_livicon_icon_color'),
				'desc'    => $language->get('shortcode_livicon_icon_color_desc'),
				'child'   => array(
					'hover_color' => array(
						'type'    => 'color',
						'default' => (is_array($value) && isset($value[0]['hover_color']) ? $value[0]['hover_color'] : '#000000'),
						'name'    => $language->get('shortcode_livicon_hover_color'),
						'desc'    => $language->get('shortcode_livicon_hover_color_desc')
					),
					'event_type' 	=> array(
						'type' 		=> 'select',
						'values' 	=> array(
							'hover' => $language->get('shortcode_hover'),
							'click' => $language->get('shortcode_click')
						),
						'default' 	=> (is_array($value) && isset($value[0]['event_type']) ? $value[0]['event_type'] : 'hover'),
						'name' 		=> $language->get('shortcode_livicon_event_type'),
						'desc' 		=> $language->get('shortcode_livicon_event_type_desc'),
					),
				)
			),
			'animate' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['animate']) ? $value[0]['animate'] : 'yes'),
				'name'    => $language->get('shortcode_livicon_animation'),
				'desc'    => $language->get('shortcode_livicon_animation_desc'),
				'child'   => array(
					'loop' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['loop']) ? $value[0]['loop'] : 'no'),
						'name'    => $language->get('shortcode_loop'),
						'desc'    => $language->get('shortcode_loop_desc')
					),
					'livicon_parent' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['livicon_parent']) ? $value[0]['livicon_parent'] : 'no'),
						'name'    => $language->get('shortcode_livicon_parent'),
						'desc'    => $language->get('shortcode_livicon_parent_desc')
					)
				)
			),
			'duration' => array(
				'type'    => 'slider',
				'default' => (is_array($value) && isset($value[0]['duration']) ? $value[0]['duration'] : 0.6),
				'min'     => 0.2,
				'max'     => 5,
				'step'    => 0.2,
				'name'    => $language->get('shortcode_duration'),
				'desc'    => $language->get('shortcode_duration_desc'),
				'child'   => array(
					'iteration' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['iteration']) ? $value[0]['iteration'] : 1),
						'min'     => 1,
						'max'     => 5,
						'step'    => 1,
						'name'    => $language->get('shortcode_iteraction'),
						'desc'    => $language->get('shortcode_iteraction_desc')
					)
				)
			),
			'url' => array(
				'default' => (is_array($value) && isset($value[0]['url']) ? $value[0]['url'] : ''),
				'name'    => $language->get('shortcode_url'),
				'desc'    => $language->get('shortcode_url_desc'),
				'child'  => array(
					'target' => array(
						'type'   => 'select',
						'values' => array(
							'self'   => $language->get('shortcode_self'),
							'blank'  => $language->get('shortcode_blank'),
						),                    
						'default' => (is_array($value) && isset($value[0]['target']) ? $value[0]['target'] : 'self'),
						'name'    => $language->get('shortcode_target'),
						'desc'    => $language->get('shortcode_target_desc')
					)
				)
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