<?php 
function tabs_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	global $tab_array;
	if($atts->icon !=''){
		if (strpos($atts->icon, 'icon:') !== false) {
			$atts->icon = "<i class='fa fa-" . trim(str_replace('icon:', '', $atts->icon)) . "'></i> ";	
		}
	}
/*------Check isset Value Before Call value---------*/
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
	$tab_array[] = array("title" => $text_yt_title,"icon" => $atts->icon , "content" => $text_content);
}
?>