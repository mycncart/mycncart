<?php 
function galleryYTShortcode($atts,$contentC,$module_id,$id,$database){
	global $gcolumns, $galleryArray,$cation_gallery,$border_gallery, $padding_item,$id_uniq,$hover_gallery;
	$border_gallery = "border: ".$atts->border."";
	$css = '';
	$gallery = '';
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Gallery */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		switch ($atts->caption) {
			case '1':
				$cation_gallery =  'caption_gallery_1';
				break;
			case '2':
				$cation_gallery =  'caption_gallery_2';
				break;
			default:
				$cation_gallery =  '';
				break;
		}
		$hover_gallery  = $atts->hover;
		$padding_item   = ($atts->padding == '0px') ? '' : "padding:".$atts->padding."";
		$id_uniq = uniqid("yt").rand().time();
		$galleryArray = array();
		if(!empty($contentC)){
			add_ytshortcode("gallery_item");
			$atts->dem = 1;
			foreach($contentC as $child => $value){
				gallery_itemYTShortcode($value,$atts,$module_id,$id,$database);
				$atts->dem += 1;
			}
		}
		$tags = array();
		$tags = '';
		foreach ($galleryArray as $key=>$item) $tags .= ',' . strtolower($item['tag']);
			$tags = ltrim($tags, ',');

			$tags = explode(',', $tags);
			$newtags = array();
			foreach($tags as $tag) $newtags[] = trim($tag);
			$tags = array_values(array_unique($newtags));
			if($atts->align !='')
			$align = 'pull-'.$atts->align;
			else
			$align ='';
		/*------Check isset Value Before Call value---------*/
			$name_shortcode_	= 'name_shortcode_'.$database['language_id'];
			$text_name_shortcode = '';
			if(isset($atts->$name_shortcode_) && ($atts->$name_shortcode_ != '')){
				$text_name_shortcode = $atts->$name_shortcode_;
			}
		/*--------------------------------------------------*/	
			if($atts->name_shortcode_status == "yes" && $text_name_shortcode != ''){
				$gallery .= '<h3 class="shortcodeTitle">'.$text_name_shortcode.'</h3>';
			}
			$gallery .= '<div class="yt-gallery clearfix '.$align.' '.$atts->yt_class.'" style="margin:0 auto; ">';
				$gallery.='<div class = "yt-gallery-tabbed" style="display:table; margin-bottom:10px;">';
				$gallery.='<ul class="tabnav">';

					$gallery.='<li class="showall active '.$id_uniq.'"><span >'.$database['language']->get('Show all').'</span></li>';
					foreach($tags as $tag )	{
						$gallery.='<li id='.trim($tag).$id_uniq.' class="'.$id_uniq.'"><span>'.ucfirst(trim($tag)).'</span></li>';
					}
				$gallery.='</ul>';
				$gallery.='</div>';
				$gallery .= '<ul class="gallery-list clearfix">';
					if(!empty($contentC))
					{
						add_ytshortcode("gallery_item");
						$atts->dem = 1;
						foreach($contentC as $child => $value)
						{
							$gallery .= gallery_itemYTShortcode($value,$atts,$module_id,$id,$database);
							$atts->dem += 1;
						}
					}
				$gallery .= '</ul>';
				$gallery .= '</div>';
				$gallery .= '<script>
					jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$atts->columns_0).'%");
					  window.onresize = function(event) {
						var width = jQuery(window).width();
						if(width >= 1200)
						{
							jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$atts->columns_0).'%");
						}else if(width >= 992 && width < 1200)
						{
							jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$atts->columns_1).'%");
						}else if(width >= 768 && width < 992)
						{
							jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$atts->columns_2).'%");
						}else if(width >= 480 && width < 768)
						{
							jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$atts->columns_3).'%");
						}else
						{
							jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$atts->columns_4).'%");
						}

				};</script>';
	}
	return $gallery;
}
?>