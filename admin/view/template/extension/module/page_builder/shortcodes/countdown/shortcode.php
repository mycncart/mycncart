<?php 
function countdownYTShortcode($atts,$contentC,$module_id,$id,$database) {
	$css = '';
	$return = "";
	if($module_id != "0"){
		$css .= "/* Style Countdown */ \n";
		$css .= $atts->css_internal;
		if ($atts->divider == 'colon') {
			$divider_style = '#'.$id.' .yt-countdown-content .yt-cd-timer > span:after { font-size: '.round($atts->count_size/2).'px;line-height: '.round($atts->count_size/2).'px; color: '.$atts->divider_color.';}';
		}
		if ($atts->divider == 'vertical_line' || $atts->divider == 'horizontal_line') {
			$divider_style = '#'.$id.' .yt-countdown-content .yt-cd-timer > span:after {background-color: '.$atts->divider_color.';}';
		}
		else {
			$divider_style = '#'.$id.' .yt-countdown-content .yt-cd-timer > span:after { font-size: '.$atts->count_size.'px;line-height: '.$atts->count_size.'px; color: '.$atts->divider_color.';}'; 
		}
		if ($atts->margin or $atts->padding or $atts->radius or $atts->background) {
			$margin = ($atts->margin) ? 'margin: '.$atts->margin.';' : '';
			$padding = ($atts->padding) ? 'padding: '.$atts->padding.';' : '';
			$radius = ($atts->radius) ? 'border-radius: '.$atts->radius.';' : '';
			$background = ($atts->background) ? 'background-color: '.$atts->background.';' : '';
			$css .= '#'.$id.' {'.$margin.$padding.$radius.$background.'}';
		}
		$count_color = ($atts->count_color) ? 'color: '.$atts->count_color.';' : '';

		$css .= '#'.$id.'  .yt-cd-timer > span span[class*="text"] { color: '.$atts->text_color.'; font-size: '.$atts->text_size.'px; } #'.$id.'  .yt-cd-timer span > span { font-size: '.$atts->count_size.'px; line-height: '.$atts->count_size.'px; '. $count_color .'} '.$divider_style.'';
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		$js = '';
		$divider_style = '';
		$message ='';
		$countdown  = $atts->count_date;
		$countdown .=  ($atts->count_time) ? ' '. $atts->count_time : '';

		if (isset($content)) {
			$message = '.on("finish.countdown", function(event) {
				$(this).parent()
				   .addClass("disabled")
				   .html("'.$atts->text_content.'");
			})';
		}
		$js .= '
			jQuery(document).ready(function ($) {
			   $("#'.$id.' .yt-cd-timer").countdown("'.$countdown.'").on("update.countdown", function(event) {
				   var $this = $(this).html(event.strftime(
					   "<span class=\'yt-cd-day\'><span class=\'yt-cd-day-data\'>%-D</span> <span class=\'yt-cd-day-text\'>DAY</span></span> "
					 + "<span class=\'yt-cd-hour\'><span class=\'yt-cd-hour-data\'>%H</span> <span class=\'yt-cd-hour-text\'>HOUR</span></span> "
					 + "<span class=\'yt-cd-minute\'><span class=\'yt-cd-minute-data\'>%M</span> <span class=\'yt-cd-minute-text\'>MIN</span></span> "
					 + "<span class=\'yt-cd-second\'><span class=\'yt-cd-second-data\'>%S</span> <span class=\'yt-cd-second-text\'>SEC</span></span>"));
				})'.$message.';
			});
		';
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
		$return .= '<div id="'.$id.'" class="yt-countdown-wrapper clearfix yt-countdown-'.$atts->align.' yt-cd-divider-'. $atts->divider.' yt-countdown-text-'.$atts->text_align.' '.$atts->yt_class.'">
			<div class="yt-countdown-content">
				<div class="yt-cd-timer"></div>
			</div>
		</div>'.'<script>'.$js.'</script>';
	}
	return $return;
}
?>