<?php 
$tab_array = array();
function tabsYTShortcode($atts,$contentC,$module_id,$id,$database){
	global $tab_array;
	$css    = '';
	$tab ="";
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Tabs */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		if(!empty($contentC)){
			add_ytshortcode("tabs_item");
			$atts->dem = 1;
			foreach($contentC as $child => $value){
				tabs_itemYTShortcode($value,$atts,$module_id,$id,$database);
				$atts->dem += 1;
			}
		}
		$tabs_style =(($atts->style != '')? "style-".$atts->style : "");
		$num = count($tab_array);
	/*------Check isset Value Before Call value---------*/
		$name_shortcode_	= 'name_shortcode_'.$database['language_id'];
		$text_name_shortcode = '';
		if(isset($atts->$name_shortcode_) && ($atts->$name_shortcode_ != '')){
			$text_name_shortcode = $atts->$name_shortcode_;
		}
		
	/*--------------------------------------------------*/	
		if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$tab .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}
		$tab .= "<div class='yt-tabs ".$atts->type." ".$tabs_style." yt-clearfix ".$atts->yt_class."'><ul class='nav-tabs clearfix'>";

		for($i = 0; $i < $num; $i ++) {
			$active = ($i == 0) ? 'active' : '';
			$tab_id = str_replace(' ', '-', $tab_array[$i]["title"]);

			$tab .= '<li class="'.$active.'"><a href="#' . $tab_id  . $id . '" class="';
			$tab .= $active .'" >'.$tab_array[$i]["icon"].'' . $tab_array[$i]["title"] . '</a></li>';
		}

		$tab .= "</ul>";
		$tab .= "<div class='tab-content'>";

		for($i = 0; $i < $num; $i ++) {
			$active = ($i == 0) ? 'active' : '';
			$tab_id = str_replace(' ', '-', $tab_array[$i]["title"]);

			$tab = $tab . '<div id="' . $tab_id . $id . '" class="clearfix ';
			$tab = $tab . $active . '" >' . $tab_array[$i]["content"] . '</div>';
		}
		$tab .= "</div></div>";
		$tab_array= array();
	}
	return $tab;
}
?>