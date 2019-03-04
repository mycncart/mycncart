<?php 
function fancy_textYTShortcode($atts,$contentC,$module_id,$id,$database){
    $return = "";   
	$tags = array();
	$tag = '';
	if($module_id != "0"){
		$css .= "/* Style Fancy Text */ \n";
		$css .= $atts->css_internal;
		$css .= '#'.$id.'{color:'.$atts->color.'; font-size:'.$atts->size.'px;}';
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
		$tags_			= 'tags_'.$database['language_id'];
		$text_tags = '';
		if(isset($atts->$tags_) && ($atts->$tags_ != '')){
			$text_tags = $atts->$tags_;
		}
		
        // class manage
        $classes = array('yt-fancy-text', 'yt-fteffect'.$atts->type,$atts->yt_class);

        // Fancy Text interchangeable tag spliting
        if($text_tags) {
            $tags = explode(',', $text_tags);
            foreach ($tags as $word) {
                $tag .='<b>'.$word.'</b>';
            }
            $tag = str_replace('<b>'.$tags['0'].'</b>', '<b class="is-visible">'.$tags['0'].'</b>' , $tag);
        }

        // Manage class for different type of Fancy Text
        if ($atts->type == 1 or $atts->type == 2 or $atts->type == 4 or $atts->type == 5)
            $classes[] = 'yt-ft-letters';
        if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$return .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}
        $return .= "
            <span id='".$id."' class='".yt_acssc($classes). "'>
                <span class='yt-ft-wrap'>
                    ".$tag."
                </span>
            </span>";
	}
	return $return;
}
?>