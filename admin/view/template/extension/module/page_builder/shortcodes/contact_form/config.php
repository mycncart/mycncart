<?php 
class YT_Shortcode_contact_form_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$add_field_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_contact_form'));
		$submit_button_text = (is_array($value) && isset($value[0]['submit_button_text']) ? $value[0]['submit_button_text'] : '');
		$add_field = (is_array($value) && isset($value[0]['add_field']) ? $value[0]['add_field'] : '');
		foreach($multiLanguage as $language_)
		{
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
			$add_field_arr['add_field_'.$language_] = (is_array($value) && isset($value[0]['add_field_'.$language_]) ? $value[0]['add_field_'.$language_] : $add_field);
			$submit_button_text_arr['submit_button_text_'.$language_] = (is_array($value) && isset($value[0]['submit_button_text_'.$language_]) ? $value[0]['submit_button_text_'.$language_] : $submit_button_text);
		}
		return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_contact_form')),
				'name'    	=> $language->get('shortcode_name_shortcode'),
				'values'  	=> $name_shortcode_arr,
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
			'email' => array(
				'default' => (is_array($value) && isset($value[0]['email']) ? $value[0]['email'] : ''),
				'name'    => $language->get('shortcode_email'),
				'desc'    => $language->get('shortcode_email_desc')
			),
			'type' => array(
				'type' 		=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['type']) ? $value[0]['type'] : 'border'),
				'values' 	=> YT_Data::type_contact($language),
				'name' 		=> $language->get('shortcode_type'),
				'desc' 		=> $language->get('shortcode_type_desc'),
				'child' => array(
					'margin' => array(
						'default' => (is_array($value) && isset($value[0]['margin']) ? $value[0]['margin'] : '20px'),
						'name'    => $language->get('shortcode_margin'),
						'desc'    => $language->get('shortcode_margin_desc'),                         
					),
				),
			),
			'name' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['name']) ? $value[0]['name'] : 'yes'),
				'name'    => $language->get('shortcode_name'),
				'desc'    => $language->get('shortcode_name_desc'),
				'child'   => array(
					'label_show' 	=> array(
						'type'    	=> 'bool',
						'default' 	=> (is_array($value) && isset($value[0]['label_show']) ? $value[0]['label_show'] : 'yes'),
						'name'    	=> $language->get('shortcode_label_show'),
						'desc'    	=> $language->get('shortcode_label_show_desc'),
					),
					'subject' 		=> array(
						'type'    	=> 'bool',
						'default' 	=> (is_array($value) && isset($value[0]['subject']) ? $value[0]['subject'] : 'yes'),
						'name'    	=> $language->get('shortcode_subject'),
						'desc'    	=> $language->get('shortcode_subject_desc'),
					),
				),
			),
			'color_name' 	=> array(
				'type'		=> 'color',
				'default' 	=> (is_array($value) && isset($value[0]['color_name']) ? $value[0]['color_name'] : '#000000'),
				'name' 		=> $language->get('shortcode_color_name'),
				'desc' 		=> $language->get('shortcode_color_name_desc'),
				'child' 	=> array(
					'background_name' 	=> array(
						'type'			=> 'color',
						'default' 		=> (is_array($value) && isset($value[0]['background_name']) ? $value[0]['background_name'] : '#ffffff'),
						'name' 			=> $language->get('shortcode_name_background'),
						'desc' 			=> $language->get('shortcode_background_desc'),
					),
					'icon_name' 	=> array(
						'type' 		=> 'icon',
						'default' 	=> (is_array($value) && isset($value[0]['icon_name']) ? $value[0]['icon_name'] : ''),
						'name' 		=> $language->get('shortcode_name_icon'),
						'desc' 		=> $language->get('shortcode_icon_desc'),
					),									
				),
			),
			'color_email' => array(
				'type'		=> 'color',
				'default' 	=> (is_array($value) && isset($value[0]['color_email']) ? $value[0]['color_email'] : '#000000'),
				'name' 		=> $language->get('shortcode_color_email'),
				'desc' 		=> $language->get('shortcode_color_email_desc'),
				'child' =>array(
					'background_email' 	=> array(
						'type'			=> 'color',
						'default' 		=> (is_array($value) && isset($value[0]['background_email']) ? $value[0]['background_email'] : '#ffffff'),
						'name' 			=> $language->get('shortcode_email_background'),
						'desc' 			=> $language->get('shortcode_background_desc'),
					),
					'icon_email' 	=> array(
						'type' 		=> 'icon',
						'default' 	=> (is_array($value) && isset($value[0]['icon_email']) ? $value[0]['icon_email'] : ''),
						'name' 		=> $language->get('shortcode_icon_email'),
						'desc' 		=> $language->get('shortcode_icon_email_desc'),
					),									
				),
			),			
			'color_subject' => array(
				'type'		=> 'color',
				'default' 	=> (is_array($value) && isset($value[0]['color_subject']) ? $value[0]['color_subject'] : '#000000'),
				'name' 		=> $language->get('shortcode_color_subject'),
				'desc' 		=> $language->get('shortcode_color_subject_desc'),
				'child' =>array(
					'background_subject' 	=> array(
						'type'				=> 'color',
						'default' 			=> (is_array($value) && isset($value[0]['background_subject']) ? $value[0]['background_subject'] : '#ffffff'),
						'name' 				=> $language->get('shortcode_subject_background'),
						'desc' 				=> $language->get('shortcode_background_desc'),
					),
					'icon_subject' 	=> array(
						'type' 		=> 'icon',
						'default' 	=> (is_array($value) && isset($value[0]['icon_subject']) ? $value[0]['icon_subject'] : ''),
						'name' 		=> $language->get('shortcode_icon_subject'),
						'desc' 		=> $language->get('shortcode_icon_subject_desc'),
					),									
				),
			),
			'color_message' => array(
				'type'		=> 'color',
				'default' 	=> (is_array($value) && isset($value[0]['color_message']) ? $value[0]['color_message'] : '#000000'),
				'name' 		=> $language->get('shortcode_color_message'),
				'desc' 		=> $language->get('shortcode_color_desc'),
				'child' =>array(
					'background_message' => array(
						'type'		=> 'color',
						'default' 	=> (is_array($value) && isset($value[0]['background_message']) ? $value[0]['background_message'] : '#ffffff'),
						'name' 		=> $language->get('shortcode_message_background'),
						'desc' 		=> $language->get('shortcode_background_desc'),
					),
					'textarea_height' 	=> array(
						'default' 		=> (is_array($value) && isset($value[0]['textarea_height']) ? $value[0]['textarea_height'] : '120'),
						'name'    		=> $language->get('shortcode_textarea_height'),
						'desc'    		=> $language->get('shortcode_textarea_height_desc')                         
					),
				),			
			),
			'reset' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['reset']) ? $value[0]['reset'] : 'yes'),
				'name'    => $language->get('shortcode_reset'),
				'desc'    => $language->get('shortcode_reset_desc'),
				'child'   => array(
					'btn_reset' => array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value[0]['btn_reset']) ? $value[0]['btn_reset'] : 'warning'),
						'values' 	=> YT_Data::btn_contact($language),
						'name' 		=> $language->get('shortcode_reset_style'),
						'desc' 		=> $language->get('shortcode_reset_style_desc')
					),
				),
			),
			'submit_button_text' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['submit_button_text']) ? $value[0]['submit_button_text'] : ''),
				'values'	=> $submit_button_text_arr,
				'name'    	=> $language->get('shortcode_submit'),
				'desc'    	=> $language->get('shortcode_submit_desc'),
				'child'   => array(
					'btn_submit' => array(
						'type' 		=> 'select',
						'default' 	=> (is_array($value) && isset($value[0]['btn_submit']) ? $value[0]['btn_submit'] : 'info'),
						'values' 	=> YT_Data::btn_contact($language),
						'name' 		=> $language->get('shortcode_submit_style'),
						'desc' 		=> $language->get('shortcode_submit_style_desc')
					),
				),
			),
			'add_field' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['add_field']) ? $value[0]['add_field'] : ''),
				'values'	=> $add_field_arr,
				'name'    	=> $language->get('shortcode_add_field'),
				'desc'    	=> $language->get('shortcode_add_field_desc'),
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