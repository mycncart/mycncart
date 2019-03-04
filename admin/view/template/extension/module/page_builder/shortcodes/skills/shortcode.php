<?php 
function skillsYTShortcode($atts,$contentC,$module_id,$id,$database){
	$skills = "";
	$css    = "";
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Skills */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
	/*------Check isset Value Before Call value---------*/
		$name_shortcode_	= 'name_shortcode_'.$database['language_id'];
		$text_name_shortcode = '';
		if(isset($atts->$name_shortcode_) && ($atts->$name_shortcode_ != '')){
			$text_name_shortcode = $atts->$name_shortcode_;
		}
	/*--------------------------------------------------*/	
		if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$skills .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}
		$skills .= '<div class="yt-skills '.$atts->yt_class.'" style="width:'.$atts->width.'">';
		if(!empty($contentC)){
			add_ytshortcode("skills_item");
			$atts->dem = 1;
			foreach($contentC as $child => $value){
				$skills .= skills_itemYTShortcode($value,$atts,$module_id,$id,$database);
				$atts->dem += 1;
			}
		}
		$skills .= '</div>';
	}
	return $skills;
}
?>