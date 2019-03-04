<?php
function google_mapYTShortcode($atts,$contentC,$module_id,$id,$database) {
	$return = '';
	if($module_id != "0"){
		$css  = "";
		$css .= "/* Style Google Map */ \n";
		$css .= $atts->css_internal;
		// Get Css in $css variable
		$atts->width = ($atts->responsive=='yes') ? "auto" : $atts->width.'px' ;     
		$css .= '#'.$id.'{width:'.$atts->width.';height:'.$atts->height.'px;border:'.$atts->border.';} ';
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		$atts->zoom_control        	= ($atts->zoom_control 			== 'yes') ? "true" : 'false';
		$atts->pan_control         	= ($atts->pan_control 			== 'yes') ? "true" : 'false';
		$atts->street_view_control 	= ($atts->street_view_control	== 'yes') ? "true" : 'false';
		$atts->zoom_on_scroll 		= ($atts->zoom_on_scroll		== 'yes') ? "true" : 'false';
		
		if ($atts->address && $atts->map_location_marker) {
			$atts->address = 'infoWindow: { content: "'.$atts->address.'" }';                                           
		}
		else {
			$atts->address ='';
		} 
		if($atts->map_location_marker == 'yes') {
			$custom_marker = ($atts->custom_marker) ? 'icon:"'.$database['url'].yt_image_media($atts->custom_marker).'",' : '';
			$atts->map_location_marker = 'map.addMarker({ lat: '.$atts->lat.', lng: '.$atts->lng.','.$custom_marker.$atts->address .'});';
		}
		else {
			$atts->map_location_marker = '';                                                                                     
		}
		$atts->zoom_control_style = ($atts->zoom_control_style) ? "zoomControlOpt: {
					style : '".($atts->zoom_control_style)."',
					position: 'TOP_LEFT'  
				},": "";
	/*------Check isset Value Before Call value---------*/
		$name_shortcode_	= 'name_shortcode_'.$database['language_id'];
		$text_name_shortcode = '';
		if(isset($atts->$name_shortcode_) && ($atts->$name_shortcode_ != '')){
			$text_name_shortcode = $atts->$name_shortcode_;
		}
		
	/*--------------------------------------------------*/	
		if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$return .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}
		$return .= '<script type="text/javascript">
			$(document).ready(function(){
				var map;
				map = new GMaps({
					el: '.$id.',
					lat: '. $atts->lat.',
					lng: '. $atts->lng.',
					zoomControl : '. $atts->zoom_control.',
					mapType: "'. $atts->map_type.'",
					mapTypeControl: false,
					zoom: '. $atts->zoom.',
					'.$atts->zoom_control_style. '
					panControl : '.$atts->pan_control .',
					streetViewControl: '.$atts->street_view_control.',
					scrollwheel: '.$atts->zoom_on_scroll.',
					keyMap:"AIzaSyAYvfhU3lQ4Z52FXziEBemhbiXzFycLj7U"
				});

				'.$atts->map_location_marker.'
			});</script>';
		$return .= '<div id="'. $id .'" class="map_advanced '.$atts->yt_class.'"></div>';	
	}
	return $return;
}
