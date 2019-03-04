<?php 
function promotion_boxYTShortcode($atts,$contentC,$module_id,$id,$database){
	$css ='';
	$return ='';
	if($module_id != "0"){		
		$css .= "/* Style Promotion Box */ \n";
		$css .= $atts->css_internal;
		// Get Css in $css variable
		$padding = '';
		$bdt_hbg = ($atts->button_background_hover) ? $atts->button_background_hover :'';
        $width = ($atts->type=="arrow-box" ? "100%" : $atts->width);
		$atts->arrow_height = '52px';
        if (intval($atts->promotion_radius) > 40 && intval($atts->button_radius) > 40) {
            $padding = "padding: 20px 20px 20px 40px;";
        }
        if($atts->type=="border")
        {
        	$background = 'border:' . $atts->promotion_background.' 1px solid; background:#fff;';					
			$css .= '#'.$id.' .border{'.$background.'}';
        }else if($atts->type =="background-border")
        {
        	$background = 'border:' . $atts->border_color.' 1px solid; background:'.$atts->promotion_background.';';
        	$css .= '#'.$id.' .background-border{ '. $background.'}';
        }
        else
        {
        	$background = 'background-color:' . $atts->promotion_background;
        	$css .= '#'.$id.' { ' . $background.'}';
        }
        $css .= '#'.$id.' {'.$padding.'; border-radius:' . $atts->promotion_radius. '; margin-bottom:15px; '.$background.' }';
        $css .= '#'.$id.' a.cta-dbtn { border-radius:' . $atts->button_radius . '; color:' . $atts->button_color . '; background:' . $atts->button_background . ';}';
        $css .= '#'.$id.' a.cta-dbtn:hover { background:' . $bdt_hbg . ';}';
        $css .= '#'.$id.' .cta-content > h3 { color: '.$atts->title_color.';}';
        $css .= '#'.$id.' .cta-content div { color:' . $atts->promotion_color.';}';
        $css .= '#'.$id.' .cta-content h3 { color:' . $atts->promotion_color.'; margin:0; padding:0}';
        if($atts->type == "arrow-box") {
        	$css .= '@media only screen and (min-width: 980px){';
        	$css .='#'.$id.'.arrow-box {position: relative;padding-right:'.$atts->arrow_height.';}';
        	$css .='#'.$id.'.arrow-box:before{content: "";width: 0px;height: 0px;position: absolute;border-style: solid;border-color:transparent transparent transparent #FFF  ;border-width: '.$atts->arrow_height.';	top:0px;left: 0;z-index: 1;}';
			$css .='#'.$id.'.arrow-box:after{content: "";	width: 0px;	height: 0px;position: absolute;	border-style: solid;border-color: #FFF #FFF #FFF transparent ;border-width: '.$atts->arrow_height.' ;	top:0px;right: 0;z-index: 1;}';
			$css .= '#'.$id.'.arrow-box .cta-content {margin:0 '.$atts->arrow_height.'}';
			$css .= '#'.$id.'.arrow-box a.cta-dbtn {margin-right:'.$atts->arrow_height.'}';
			$css .='}';
        }
		$css .= '#'.$id.'{width:'.$width.'%;}';
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
		$yt_title_ 			= 'yt_title_'.$database['language_id'];
		$text_yt_title = '';
		if(isset($atts->$yt_title_) && ($atts->$yt_title_ != '')){
			$text_yt_title = $atts->$yt_title_;
		}
		$button_text_ 			= 'button_text_'.$database['language_id'];
		
		$text_button_text = '';
		if(isset($atts->$button_text_) && ($atts->$button_text_ != '')){
			$text_button_text = $atts->$button_text_;
		}
		
		$content_ 			= 'content_'.$database['language_id'];
		$text_content 		= '';
		if(isset($atts->$content_) && ($atts->$content_ != '')){
			$text_content 	= $atts->$content_;
		}
	/*--------------------------------------------------*/
		if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
			$return .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
		}	
        $title  = ($text_yt_title) ? "<h3>" . $text_yt_title . "</h3>" : '';      
        $return  .= '<section id="'.$id.'" class="promotion cta-align-'. $atts->align .' '.$atts->type.' '.$atts->yt_class.'">';
        $return .= "<a class='cta-dbtn hidden-phone' target='" . $atts->target . "' href='" . $atts->button_link . "'>" . $text_button_text . "</a>";
        $return .= "<div class='cta-content'>" . $title ."<div>".$text_content."</div></div>";
        $return .= "<a class='cta-dbtn visible-phone' target='" . $atts->target . "' href='" . $atts->button_link . "'>" . $text_button_text . "</a>";
        $return .= '<div class="clear"></div></section>';
	}
	 return $return;
}

?>