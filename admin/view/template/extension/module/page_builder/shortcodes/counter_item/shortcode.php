<?php 
function counter_itemYTShortcode($atts,$contentP,$module_id,$id,$database) {
	$return_item = '';
	$id = $id."-".$contentP->dem;
	if($module_id != "0"){
		$css = '';
		$css .= "/* Style Counter */ \n";
		$css .= '#'.$id.'{border-radius:'.$atts->border_radius.'}';
		$border = ($atts->border) ? 'border:'.$atts->border.';' : '';
		$background = ($atts->background) ? 'background-color:'.$atts->background.';' : '';
		if ($border or $background) {
			$css .= '#'.$id.' {' .$background.$border.'}';
		}
		$count_color = ($atts->count_color) ? 'color:' . $atts->count_color . ';' : '';
		$text_color = ($atts->text_color) ? 'color:' . $atts->text_color . ';' : '';
		$icon_color = ($atts->icon_color) ? 'color:' . $atts->icon_color . ';' : '';
		$css .= '#'.$id.' .yt-counter-number {font-size: '.$atts->count_size.'; '. $count_color .' }';
		$css .= '#'.$id.' .yt-counter-text {'. $text_color .' font-size: '.$atts->text_size.';}';
		$css .= '#'.$id.' i {' . $icon_color .'' . 'font-size:' . $atts->count_size . ';}';
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		if (strpos($atts->icon, 'icon:') !== false) {
			$atts->icon = '<i class="fa fa-' . trim(str_replace('icon:', '', $atts->icon)) . '"></i>';
		}
		$icon = ($atts->icon) ? '<div class="yt-counter-icon">'. $atts->icon .'</div>' : '';
	/*------Check isset Value Before Call value---------*/
		$prefix_	= 'prefix_'.$database['language_id'];
		$text_prefix = '';
		if(isset($atts->$prefix_) && ($atts->$prefix_ != '')){
			$text_prefix = $atts->$prefix_;
		}
		
		$suffix_ 			= 'suffix_'.$database['language_id'];
		$text_suffix = '';
		if(isset($atts->$suffix_) && ($atts->$suffix_ != '')){
			$text_suffix = $atts->$suffix_;
		}
		
		$content_ 			= 'content_'.$database['language_id'];
		$text_content 		= '';
		if(isset($atts->$content_) && ($atts->$content_ != '')){
			$text_content 	= $atts->$content_;
		}
	/*--------------------------------------------------*/	
			
		$return_item .= '<div id="'. $id .'" class="yt-counter-wrapper clearfix yt-counter-'.$atts->align.'" data-id="'.$id.'" data-from="'.$atts->count_start.'" data-to="'.$atts->count_end.'" data-speed="'.$atts->counter_speed.'" data-separator="'.$atts->separator.'" data-prefix="'.$text_prefix.'" data-suffix="'.$text_suffix.'">';
		$return_item .= '<div class="yt-counter-desc" >';
		$return_item .= $icon;
		$return_item .= '<div id="'. $id .'_count"  class="yt-counter-number">
						</div>
						<div class="yt-counter-text">'. $text_content .'</div>
					</div>';
		$return_item .= '</div>';
	}
	return $return_item;
}
?>