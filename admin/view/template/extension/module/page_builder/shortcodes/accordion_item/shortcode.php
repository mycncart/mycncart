<?php
function accordion_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	$accordion_style = $contentP->style;
	$accordion_color_background_active = $contentP->color_background_active;
	$accordion_color_active = $contentP->color_active;
	$accordion_background_active = $contentP->background_active;
	
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
	$idparent = $id;
	$id = $id."-".$contentP->dem;
	$css= '';
	$icon_color = ($atts->icon_color) ? 'color:' . $atts->icon_color . ';' : '';
    $icon_size_ = ($atts->icon_size) ? 'font-size: '.intval($atts->icon_size).'px;' : '';
	
	if($contentP->style=='border')	{
		$css .= '#'.$id.'.yt-accordion-group {border:1px solid '.$atts->border_color.'}';
	}
	$acc_item = "<li class='yt-accordion-group' id='".$id."'>";
	$active = ($contentP->dem == $contentP->item_active) ? 'enable' : 'disable';
	$acc_item .= "<h3 class='accordion-heading ".$active."'>" ;
	$css .= '#'.$id.' h3.accordion-heading {background:' . $atts->background . '; color:'.$atts->color_title.';font-size:'.$atts->icon_size.'px}';
	if($atts->icon !=''){
		if (strpos($atts->icon, 'icon:') !== false) {
			$acc_item .= "<i class='icon_accordion fa fa-" . trim(str_replace('icon:', '', $atts->icon)) . "'></i> ";
			if ($icon_color or $atts->icon_size) {
	                $css .= '#'.$id.' .icon_accordion {'.$icon_color.$icon_size_.'}';
	       	}
		}else{
			$acc_item .= '<img src="'.yt_image_media($atts->icon).'" style="width:'.$atts->icon_size.'px" alt="" /> ';
		}
	}
	
	$acc_item .=' '. $text_yt_title . "</h3>";
	$acc_item .= "<div class='yt-accordion-inner'>".$text_content."</div>";
	$acc_item .= "</li>";
	$css .= '#'.$id.' .yt-accordion-inner {background:' . $atts->background . ';color:'.$atts->color_desc.';border-color:'.$atts->color_title.'}';
	if($accordion_style != 'line' && $accordion_color_background_active =="yes"){
		$css .= 'ul.yt-accordion.'.$idparent.' li#'.$id.'.yt-accordion-group h3.accordion-heading.active{color: '.$accordion_color_active.' !important;background : '.$accordion_background_active.' !important;} ul.yt-accordion.'.$idparent.' li#'.$id.'.yt-accordion-group .yt-accordion-inner.active{background : '.$accordion_background_active.' !important;} ul.yt-accordion.'.$idparent.' li#'.$id.'.yt-accordion-group .active i{color: '.$accordion_color_active.' !important;}';
	}else{
		$css .= 'ul.yt-accordion.'.$idparent.'.line li#'.$id.'.yt-accordion-group .yt-accordion-inner.active{
	border-top: '.$accordion_color_active.' 1px solid !important;	} ul.yt-accordion.'.$idparent.' li#'.$id.'.yt-accordion-group h3.accordion-heading.active{color: '.$accordion_color_active.' !important;} ul.yt-accordion.'.$idparent.' li#'.$id.'.yt-accordion-group .active i{color: '.$accordion_color_active.' !important;}';
	}
	if($module_id != "0"){
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}
	return $acc_item;
}	
?>