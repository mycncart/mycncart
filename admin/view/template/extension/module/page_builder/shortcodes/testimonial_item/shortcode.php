<?php 
function testimonial_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	$display_avatar = $contentP->display_avatar;
    $css='';
	$testimonial_item ='';
	$testimonial_avatar = '';
	/*------Check isset Value Before Call value---------*/	
		$author_ 			= 'author_'.$database['language_id'];
		$text_author 		= '';
		if(isset($atts->$author_) && ($atts->$author_ != '')){
			$text_author 	= $atts->$author_;
		}
		
		$position_ 			= 'position_'.$database['language_id'];
		$text_position 		= '';
		if(isset($atts->$position_) && ($atts->$position_ != '')){
			$text_position 	= $atts->$position_;
		}
		
		$content_ 			= 'content_'.$database['language_id'];
		$text_content 		= '';
		if(isset($atts->$content_) && ($atts->$content_ != '')){
			$text_content 	= $atts->$content_;
		}
	/*--------------------------------------------------*/	
		$atts->avatar 		= ($atts->avatar != '' ? $atts->avatar : 'no_image.png');
		$testimonial_avatar .='<img class="img-responsive" src="' . $database['url'] . yt_image_media($atts->avatar) . '" alt="'.$text_author.'" width="150" height="150"/> ';
		$testimonial_item = '<div class="item">
								<div class="item-wrap">
									<div class="item-wrap-inner">';
									if($display_avatar == 'yes'){
		$testimonial_item .= '			<div class="item-img-info">
											'.$testimonial_avatar.'
										</div>';
									}
		$testimonial_item .= '			<div class="item-info">';
									if($text_content != ''){
		$testimonial_item .=			$text_content;
									}
									if($text_author != ''){
		$testimonial_item .= '			<h5>'.$text_author.'</h5>';
									}
									if($text_position != ''){
		$testimonial_item .= '			<span class="position">'.$text_position.'</span>';
									}
		$testimonial_item .= '			</div>
									</div>
								</div>
							</div>';
	return $testimonial_item;
}
?>
