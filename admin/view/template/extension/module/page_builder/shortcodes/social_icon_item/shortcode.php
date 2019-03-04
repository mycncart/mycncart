<?php 
function social_icon_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	$social_color=(($atts->color == "yes")? 'color' : "");
	$social_item = "";
/*------Check isset Value Before Call value---------*/
	$yt_title_ 			= 'yt_title_'.$database['language_id'];
	$text_yt_title = '';
	if(isset($atts->$yt_title_) && ($atts->$yt_title_ != '')){
		$text_yt_title = $atts->$yt_title_;
	}
/*--------------------------------------------------*/	
	$social_item .= '<a data-placement="top" target="_blank" class="sb '.$atts->type." ". $atts->size."  ".$atts->style." ".$social_color.' " title="' . $text_yt_title . '" href="' . trim($atts->link) . '">';
	$social_item .= '<i class="fa fa-'.$atts->type.'"></i></a>';
	
	return $social_item;
}
?>