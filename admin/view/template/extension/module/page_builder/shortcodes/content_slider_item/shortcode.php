<?php
function content_slider_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	if($atts->src){
		$image_url = $atts->src;
	}else{
		$image_url = 'no_image.png';
	}
    if($atts->link != '') {
        $image = '<a href="'.$atts->link.'" title="" target="brank"><img src="'. $database['url']. yt_image_media($image_url) . '" alt="' .uniqid("title_").rand().time(). '" /></a>';
    }else{
		$image = '<img src="'. $database['url']. yt_image_media($image_url) . '" alt="' .uniqid("title_").rand().time(). '" />';
    }
    if($atts->caption == "yes")  {
/*------Check isset Value Before Call value---------*/
	$content_ 			= 'content_'.$database['language_id'];
	$text_content 		= '';
	if(isset($atts->$content_) && ($atts->$content_ != '')){
		$text_content 	= $atts->$content_;
	}	
/*--------------------------------------------------*/		
        return '<div class="yt-content-slide yt-content-wrap"> '.$image.' <div class="caption">'.$text_content.'</div></div>';
    } else{
        return '<div class="yt-content-slide yt-clearfix yt-content-wrap"> '.$image.'</div>';
    }
}
?>
