<?php 
function skills_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	$no_number = $contentP->no_number;
/*------Check isset Value Before Call value---------*/
	$yt_title_ 			= 'yt_title_'.$database['language_id'];
	$text_yt_title = '';
	if(isset($atts->$yt_title_) && ($atts->$yt_title_ != '')){
		$text_yt_title = $atts->$yt_title_;
	}
/*--------------------------------------------------*/	
	$skill_item  =  "<div class='form-group'>";
	$skill_item .=  "<strong>".$text_yt_title."</strong>";
	$atts->number = (is_int((int)$atts->number) && (int)$atts->number > 0 ? $atts->number : 100);
	$skill_item .=   ($no_number != 'no') ? "<span class='pull-right'>".$atts->number."%</span>" : '' ;
	$skill_item .=   "<div class='progress progress-danger active'> <div style='width:". $atts->number ."%' class='bar'></div> </div>";
	$skill_item .=  "</div>";

	return $skill_item;
}
?>