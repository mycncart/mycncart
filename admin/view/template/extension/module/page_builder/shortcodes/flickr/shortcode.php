<?php 
function flickrYTShortcode($atts,$contentC,$module_id,$id,$database) {
	$return = "";
	$css = "";
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Flickr */ \n";
		$css .= $atts->css_internal;
		$rounded 	= ($atts->radius) ? 'border-radius: ' . $atts->radius . ';' : '';
		$css .= '#'.$id.' .yt-lightbox {'.$rounded.'}';
		$css .= '#'.$id.' img{'.$rounded.'}';
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		$image = ($atts->lightbox == 'yes') ? '<a class="yt-lightbox" data-mfp-type="image" href="{{image_b}}" title="{{title}}"> ' : '';
		$image .= '<img src="{{image_s}}" alt="{{title}}" />';
		$image .= ($atts->lightbox == 'yes') ? '</a> ' : '';
		$classflick ="";
		if ($atts->lightbox == 'yes') {
			$classflick = ' yt-flickr-lightbox';
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
		$return .= "<ul id='".$id."' class='flickrfeed ".$classflick." ".$atts->yt_class."'></ul> <div class='clear'></div>";
		$return .="<script type='text/javascript'>
			  jQuery(document).ready(function() {
					  jQuery('#".$id."').jflickrfeed({
						limit: " . $atts->limit . ", qstrings: {
						  id: '" . $atts->id_flickr . "'},
						  itemTemplate: '<li>" . addslashes($image) . "</li>' });
					});
			  </script> ";
	}
	return $return;
}
?>