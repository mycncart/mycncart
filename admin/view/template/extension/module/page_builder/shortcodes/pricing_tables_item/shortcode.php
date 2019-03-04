<?php 
function pricing_tables_itemYTShortcode($atts,$contentP,$module_id,$id,$database){
	$type = $contentP->type;
	$pcolumns	= $contentP->columns;
	$return='';
	
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
	
	$button_label_	= 'button_label_'.$database['language_id'];
	$text_button_label = '';
	if(isset($atts->$button_label_) && ($atts->$button_label_ != '')){
		$text_button_label = $atts->$button_label_;
	}
	
	$yt_text_	= 'yt_text_'.$database['language_id'];
	$text_yt_text = '';
	if(isset($atts->$yt_text_) && ($atts->$yt_text_ != '')){
		$text_yt_text = $atts->$yt_text_;
	}
	
/*--------------------------------------------------*/	
	if($atts->icon_name != ''){
		if (strpos($atts->icon_name, 'icon:') !== false) { 
		  $atts->icon_name = '<i class="fa fa-' . trim(str_replace('icon:', '', $atts->icon_name)) . '"></i>';
		}
	}
	switch ($type) {
		case 'style1':
			$text= (strtolower($atts->featured)=="yes" ? $text_yt_text : '');
			$return = '<div class="col-xs-12 col-sm-6 col-md-'.round(12/$pcolumns).' col-lg-'.round(12/$pcolumns).'">
				<div class="'.$type.' column '.(('yes' == strtolower($atts->featured)) ? ' featured' : '') .'">
				<span class="pricing-featured">'.$text.'</span>
				<div class="pricing-basic " style=""><h2>' . $text_yt_title . '</h2></div>' .
				'<div class="pricing-money block " style="" >' . $atts->price . '</div>' .$text_content .
				'<div class="pricing-bottom">
		<div class="signup"><a href="'.$atts->button_link.'">'.$text_button_label.'<div class="iconsignup">'.$atts->icon_name.'</div></a></div>

	</div> ' .
			 '</div></div>';
			break;

		default:
		case 'style2':
			$return = '<div class="col-xs-12 col-sm-6 col-md-'.round(12/$pcolumns).' col-lg-'.round(12/$pcolumns).'">
				<div class="'.$type.' column '.((strtolower($atts->featured) == 'yes') ? ' featured' : '') .'">
				<div class="pricing-basic " style="background:'.$atts->background.'; color:'.$atts->color.'"><h2>' . $text_yt_title . '</h2><span class="pricing-featured">'.$text_yt_text.'</span></div>' .$text_content .
				'<div class="pricing-money block ">' . $atts->price . '</div>' .
				'<div class="pricing-bottom" >
		<a class="signup" style="background:'.$atts->background.';color:'.$atts->color.'" href="'.$atts->button_link.'">'.$text_button_label.'</a>
			</div> ' .
			 '</div></div>';
			break;
		case 'style3':
			$text= (strtolower($atts->featured)=="yes" ? $text_yt_text : '');
			$return = '<div class="col-xs-12 col-sm-6 col-md-'.round(12/$pcolumns).' col-lg-'.round(12/$pcolumns).'">
				<div class="'.$type.' column '.((strtolower($atts->featured) == 'yes') ? ' featured' : '') .'">
				<div class="pricing-basic " style="background:#e74847; color:'.$atts->color.'"><h2>' . $text_yt_title . '</h2>';
			if($text != ''){
				$return .= '<span class="pricing-featured">'.$text.'</span>';
			}
			$return .='</div>';
			if($atts->price != ''){
				$return .='<div class="pricing-money block "><h1>' . $atts->price . '</h1></div>';
			}
			$return .= $text_content.'<div class="pricing-bottom" >
		<a class="signup" style="background:#e74847;color:'.$atts->color.'" href="'.$atts->button_link.'">'.$text_button_label.'</a>
			</div> ' .
			 '</div></div>';

	}
	return $return;
}
?>