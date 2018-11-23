<?php 
function points_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	$css ='';
	$id = $id.$contentP->dem;
	if($module_id != "0"){
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		$css .= "#".$id.".yt-single-point{top:".$atts->y."%; left: ".$atts->x."%; list-style:none}";
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}
	$content_ 			= 'content_'.$database['language_id'];
	$text_content 		= '';
	if(isset($atts->$content_) && ($atts->$content_ != '')){
		$text_content 	= $atts->$content_;
	}
	
	$points_item  =  "<li class='yt-single-point' id='".$id."'>";
	$points_item .=  "<a class='yt-img-replace' href='#0'>More</a>";
	$points_item .=  "<div class='yt-more-info yt-".$atts->position."'>" ;
	$points_item .=  $text_content ;
	$points_item .=  "<a href='#0' class='yt-close-info yt-img-replace'>Close</a></div> </li>";

	return $points_item;
}
?>