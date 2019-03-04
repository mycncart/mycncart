<?php 
function content_sliderYTShortcode($atts,$contentC,$module_id,$id,$database){
	$return = '';
	$css    = '';
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Content Slider */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
        if ($atts->type_change == 'slide'){
			$atts->transitionin = $atts->transitionout = "";
		}
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
        $return .='<div id="'. $id .'" class="yt-content-slider owl2-theme yt-content-slider-style-' . $atts->style .' '. $atts->arrow_position.' '.$atts->yt_class.'" data-transitionin="' . $atts->transitionin . '" data-transitionout="' . $atts->transitionout . '" data-autoplay="' . $atts->autoplay .'" data-autoheight="' . $atts->autoheight .'" data-delay="' . $atts->delay . '" data-speed="' . $atts->speed . '" data-margin="' . $atts->margin . '" data-items_column0="' . $atts->items_column0 . '" data-items_column1="' . $atts->items_column1 . '" data-items_column2="' . $atts->items_column2 . '"  data-items_column3="' . $atts->items_column3 . '" data-items_column4="' . $atts->items_column4 . '" data-arrows="' . $atts->arrows .'" data-pagination="' . $atts->pagination . '" data-lazyload="' . $atts->lazyload . '" data-loop="' . $atts->loop . '" data-hoverpause="' . $atts->hoverpause . '">'; 

		if(!empty($contentC)){
			add_ytshortcode("content_slider_item");
			$atts->dem = 1;
			foreach($contentC as $child => $value){
				$return .= content_slider_itemYTShortcode($value,$atts,$module_id,$id,$database);
				$atts->dem += 1;
			}
		}
		$return .= '</div>';
	}
	return $return;
}
?>