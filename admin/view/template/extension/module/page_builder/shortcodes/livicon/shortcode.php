<?php 
function liviconYTShortcode($atts,$contentC,$module_id,$id,$database) {    
	$return = '';
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Livicon */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		$atts->animate 			= ($atts->animate 		=== 'yes') ?  'true' : 'false';
		$atts->loop 			= ($atts->loop 			=== 'yes') ?  'true' : 'false';
		$atts->livicon_parent 	= ($atts->livicon_parent === 'yes') ?  'true' : 'false';
		$atts->duration 		=  $atts->duration * 1000;
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
		if ($atts->url) {
			$return .= '<a href="' . $atts->url . '" class="yt-livicon '.$atts->yt_class.'" target="' . $atts->target . '"><span class="livicon" data-name="'.$atts->icon.'" data-size="'.intval($atts->size).'" data-color="'.$atts->color.'" data-hovercolor="'.$atts->hover_color.'" data-animate="'.$atts->animate.'" data-loop="'.$atts->loop.'" data-iteration="'.$atts->iteration.'" data-duration="'.$atts->duration.'" data-eventtype="'.$atts->event_type.'" data-onparent="'.$atts->livicon_parent.'"></span></a>';
		} else {
			$return .= '<span class="yt-livicon livicon '.$atts->yt_class.'" data-name="'.$atts->icon.'" data-size="'.intval($atts->size).'" data-color="'.$atts->color.'" data-hovercolor="'.$atts->hover_color.'" data-animate="'.$atts->animate.'" data-loop="'.$atts->loop.'" data-iteration="'.$atts->iteration.'" data-duration="'.$atts->duration.'" data-eventtype="'.$atts->event_type.'" data-onparent="'.$atts->livicon_parent.'"></span>';
		}
	}
	return $return;
}
?>