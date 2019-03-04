<?php 
function boxYTShortcode($atts,$contentC,$module_id,$id,$database) {
	$radius ='';
	$css = '';
	$return = '';
	/* $module_id != 0 => call shortcode in Admin */
	if($module_id != "0"){
		// Radius Manage
		if ($atts->radius) {
			$radius = ( $atts->radius != '0' ) ? 'border-radius:' . $atts->radius . 'px;' : '';
		}
		$css .= "/* Style Box */ \n";
		$css .= $atts->css_internal;
		// Get Css in $css variable
		$css .= '#'.$id.'{'.$radius.'border-color:' . $atts->box_color . ';} #'.$id.' .yt-box-title { background-color:' . $atts->box_color . ';color:' . $atts->title_color . ';}';
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		// Output HTML
	/*------Check isset Value Before Call value---------*/
		$name_shortcode_	= 'name_shortcode_'.$database['language_id'];
		$text_name_shortcode = '';
		if(isset($atts->$name_shortcode_) && ($atts->$name_shortcode_ != '')){
			$text_name_shortcode = $atts->$name_shortcode_;
		}
		
		$yt_title_ 			= 'yt_title_'.$database['language_id'];
		$text_yt_title = '';
		if(isset($atts->$yt_title_) && ($atts->$yt_title_ != '')){
			$text_yt_title = $atts->$yt_title_;
		}
		
		$content_ 			= 'content_'.$database['language_id'];
		$text_content 		= '';
		if(isset($atts->$content_) && ($atts->$content_ != '')){
			$text_content 	= $atts->$content_;
		}
	/*--------------------------------------------------*/	
		if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$return .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}
		$return .= '<div id="'.$id.'" class="yt-clearfix yt-box yt-box-style-' . $atts->style .' '.$atts->yt_class.'">
				<div class="yt-box-title">'. $text_yt_title . '
				</div>
				<div class="yt-box-content yt-clearfix">'.$text_content.'</div>
			</div>';
	}
	return $return;
}
?>