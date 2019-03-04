<?php 
class YT_Shortcode_google_map_config {
    static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$name_shortcode_arr = array();
		$name_shortcode = (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_google_map'));
		foreach($multiLanguage as $language_)
		{
			$name_shortcode_arr['name_shortcode_'.$language_] = (is_array($value) && isset($value[0]['name_shortcode_'.$language_]) ? $value[0]['name_shortcode_'.$language_] : $name_shortcode);
		}
        return array(
			'name_shortcode' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value[0]['name_shortcode']) ? $value[0]['name_shortcode'] : $language->get('shortcode_google_map')),
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
            'map_type' => array(
				'type'   => 'select',
				'default' => (is_array($value) && isset($value[0]['map_type']) ? $value[0]['map_type'] : ''),
				'values' => YT_Data::map_types($language),
				'name'    => $language->get('shortcode_style'),
				'desc'    => $language->get('shortcode_style_desc'),
				'child'   => array(
					'zoom' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['zoom']) ? $value[0]['zoom'] : 16),
						'min'     => 1,
						'max'     => 20,
						'step'    => 1,
						'name'    => $language->get('shortcode_gmap_zoom'),
						'desc'    => $language->get('shortcode_gmap_zoom_desc')
					),   
				)
			),
			'width' => array(
				'type'    => 'slider',
				'default' => (is_array($value) && isset($value[0]['width']) ? $value[0]['width'] : 600),
				'min'     => 200,
				'max'     => 1600,
				'step'    => 20,
				'name'    => $language->get('shortcode_width'),
				'desc'    => $language->get('shortcode_width_px_desc'),
				'child'   => array(
					'height' => array(
						'type'    => 'slider',
						'default' => (is_array($value) && isset($value[0]['height']) ? $value[0]['height'] : 400),
						'min'     => 200,
						'max'     => 1600,
						'step'    => 20,
						'name'    => $language->get('shortcode_height'),
						'desc'    => $language->get('shortcode_height_desc')
					)
				)
			),
			'border' => array(
				'type'    => 'border',
				'default' => (is_array($value) && isset($value[0]['border']) ? $value[0]['border'] : '0px solid #ccc'),
				'name'    => $language->get('shortcode_border'),
				'desc'    => $language->get('shortcode_border_desc')
			),
			'lat' => array(
				'default' => (is_array($value) && isset($value[0]['lat']) ? $value[0]['lat'] : '24.824874643579022'),
				'name'    => $language->get('shortcode_gmap_lat'),
				'desc'    => $language->get('shortcode_gmap_lat_desc'),
				'child'   => array(
					'lng' => array(
						'default' => (is_array($value) && isset($value[0]['lng']) ? $value[0]['lng'] : '89.38262999446634'),
						'name'    => $language->get('shortcode_gmap_lng'),
						'desc'    => $language->get('shortcode_gmap_lng_desc'),
					)
				)
			),
			'zoom_control_style' => array(
				'type'   	=> 'select',
				'default' 	=> (is_array($value) && isset($value[0]['zoom_control_style']) ? $value[0]['zoom_control_style'] : 'SMALL'),
				'values' 	=> YT_Data::zoom_control_styles($language),
				'name'    	=> $language->get('shortcode_gmap_zoom_control_style'),
				'desc'    	=> $language->get('shortcode_gmap_zoom_control_style_desc'),
				'child'   	=> array(
					'zoom_control' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['zoom_control']) ? $value[0]['zoom_control'] : 'yes'),
						'name'    => $language->get('shortcode_gmap_zoom_control'),
						'desc'    => $language->get('shortcode_gmap_zoom_control_desc')
					)
				)
			),
			'pan_control' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['pan_control']) ? $value[0]['pan_control'] : 'yes'),
				'name'    => $language->get('shortcode_gmap_pan_control'),
				'desc'    => $language->get('shortcode_gmap_pan_control_desc'),
				'child'   => array(
					'street_view_control' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['street_view_control']) ? $value[0]['street_view_control'] : 'yes'),
						'name'    => $language->get('shortcode_gmap_street_view_control'),
						'desc'    => $language->get('shortcode_gmap_street_view_control_desc')
					),
				)
			),
			'map_location_marker' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['map_location_marker']) ? $value[0]['map_location_marker'] : 'yes'),
				'name'    => $language->get('shortcode_marker'),
				'desc'    => $language->get('shortcode_marker_desc'),
				'child'   => array(
					'custom_marker' => array(
						'type'    => 'media',
						'default' => (is_array($value) && isset($value[0]['custom_marker']) ? $value[0]['custom_marker'] : 'so_page_builder/images/custom-marker1.png'),
						'name'    => $language->get('shortcode_custom_marker'),
						'desc'    => $language->get('shortcode_custom_marker_desc'),
					)
				)
			),
			'address' => array(
				'default' => (is_array($value) && isset($value[0]['address']) ? $value[0]['address'] : ''),
				'name'    => $language->get('shortcode_address'),
				'desc'    => $language->get('shortcode_address_desc'),
				'child'   => array(
					'key_text' => array(
						'default' => (is_array($value) && isset($value[0]['key_text']) ? $value[0]['key_text'] : 'AIzaSyAYvfhU3lQ4Z52FXziEBemhbiXzFycLj7U'),
						'name'    => $language->get('shortcode_key_text'),
						'desc'    => $language->get('shortcode_key_text_desc'),
					)
				)
			),
			'responsive' => array(
				'type'    => 'bool',
				'default' => (is_array($value) && isset($value[0]['responsive']) ? $value[0]['responsive'] : 'yes'),
				'name'    => $language->get('shortcode_responsive'),
				'desc'    => $language->get('shortcode_responsive_desc'),
				'child'   => array(
					'zoom_on_scroll' => array(
						'type'    => 'bool',
						'default' => (is_array($value) && isset($value[0]['zoom_on_scroll']) ? $value[0]['zoom_on_scroll'] : 'yes'),
						'name'    => $language->get('shortcode_zoom_on_scroll'),
						'desc'    => $language->get('shortcode_zoom_on_scroll_desc'),
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
