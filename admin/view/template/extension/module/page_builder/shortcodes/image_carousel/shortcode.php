<?php 
function image_carouselYTShortcode($atts,$contentC,$module_id,$id,$database){
    $css = '';
	$return = '';
	$title = '';
    $lang = 'false';
	if($database['language_id'] != 1){
		$lang = 'true';
	}
	/* $module_id != 0 => call shortcode in Admin */
	if($module_id != "0" && $atts->css_internal != ''){
		$css .= "/* Style Image Carousel */ \n";
		$css .= $atts->css_internal;
		$file = '../catalog/view/javascript/so_page_builder/css/style_render_'.$module_id.'.css';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $css."\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
	}else{
		$slides = (array)get_slides($atts,$database);
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
		if (count($slides)) {
			$source = substr($atts->source, 0, 5);
			$class = "";
			if ($source == 'media'){
				$class .= ' yt-carousel-media';
			}
			if($atts->lazyload == 'yes'){
				$atts->items_column4 = $atts->items_column4 < count($slides) ? $atts->items_column4 : count($slides);
				$atts->items_column3 = $atts->items_column3 < count($slides) ? $atts->items_column3 : count($slides);
				$atts->items_column2 = $atts->items_column2 < count($slides) ? $atts->items_column2 : count($slides);
				$atts->items_column1 = $atts->items_column1 < count($slides) ? $atts->items_column1 : count($slides);
				$atts->items_column0 = $atts->items_column0 < count($slides) ? $atts->items_column0 : count($slides);
			}
			$return .= '<div id="' . $id . '" class="yt-clearfix '.$class.' '.$id.' '.$atts->yt_class.' yt-carousel yt-carousel-style-'.$atts->style.' arrow-'. $atts->arrow_position.'" data-autoplay="' . $atts->autoplay .'" data-delay="' . $atts->delay . '" data-speed="' . $atts->speed . '" data-arrows="' . $atts->arrows .'" data-pagination="' . $atts->pagination . '" data-lazyload="' . $atts->lazyload . '" data-hoverpause="' . $atts->hoverpause . '" data-items_column0="' . $atts->items_column0 . '" data-items_column1="' . $atts->items_column1 . '" data-items_column2="' . $atts->items_column2 . '"  data-items_column3="' . $atts->items_column3 . '" data-items_column4="' . $atts->items_column4 . '" data-margin="' . $atts->margin . '" data-scroll="1" data-loop="' . $atts->loop . '" data-rtl="' . $lang . '"  ><div class="'.$id.' yt-carousel-slides">';
			$limit = 1;
			foreach ((array) $slides as $slide) {
				$image_url ='';
				$title = html_entity_decode($slide['title']);
				$title_new = str_replace('"',"'",$title);
				if($slide['image']){
					$image_url = resize($slide['image'], $atts->image_width, $atts->image_height);
				}else{
					$image_url = resize('no_image.png', $atts->image_width, $atts->image_height);
				}
				
				$return .= '<div class="'.$id.' yt-carousel-slide">';

					if (isset($image_url)) {
						$return .= '<div class="yt-carousel-image">';
							if (isset($image_url)) {
								$return .= '<div class="yt-carousel-links">
									<a class="yt-lightbox-item" href="'. yt_image_media($slide['image']) .'" title="'.$title_new.'">
										<i class="fa fa-search"></i>
									</a>';
								$return .= '</div>';
							}
							if($atts->lazyload == 'yes'){
								$return .= '<img class="owl2-lazy" data-src="'. yt_image_media($image_url) . '" src="'. yt_image_media($image_url) . '" alt="'.$title_new.'" />';
							}else{
								$return .= '<img src="'. yt_image_media($image_url) . '" alt="'.$title_new.'" />';
							}
						$return .= '</div>';
					}
				$return .= '</div>';
			}
			$return .= '</div>';
			$return .= '</div>';
			$script = 'jQuery(document).ready(function ($) {
					// Enable carousels
						jQuery(\'.'.$id.'.yt-carousel\').each(function () {
							// Prepare data
							var $carousel = $(this),
								$slides = $(\'.'.$id.'.yt-carousel-slides\'),
								$slide = $(\'.'.$id.'.yt-carousel-slide\'),
								data = $carousel.data();
							// Apply Swiper
							var $owlCarousel = $slides.owlCarousel2({
								responsiveClass: true,
								mouseDrag: true,
								autoplayTimeout: data.delay * 1000,
								smartSpeed: data.speed * 1000,
								lazyLoad: (data.lazyload == \'yes\') ? true : false,
								autoplay: (data.autoplay == \'yes\') ? true : false,
								autoplayHoverPause: (data.hoverpause == \'yes\') ? true : false,
								center: (data.center == \'yes\') ? true : false,
								loop: (data.loop == \'yes\') ? true : false,
								margin: data.margin,
								navText: [\'\',\'\'],
								rtl: data.rtl,
								dots: (data.pagination == \'yes\') ? true : false,
								nav: (data.arrows == \'yes\') ? true : false,
								responsive:{
									0:{
										items: data.items_column4,
										nav: (data.items > data.items_column4 && data.arrows == \'yes\') ? true : false
									},
									480: {
										items: data.items_column3,
										nav: (data.items > data.items_column3 && data.arrows == \'yes\') ? true : false
									},
									768: {
										items: data.items_column2,
										nav: (data.items > data.items_column2 && data.arrows == \'yes\') ? true : false
									},
									992: { 
										items: data.items_column1,
										nav: (data.items > data.items_column1 && data.arrows == \'yes\') ? true : false
									},
									1200: {
										items: data.items_column0,
										nav: (data.items > data.items_column0 && data.arrows == \'yes\') ? true : false
									}
								}
							   
							});

							// Lightbox for galleries (slider, carousel, custom_gallery)
							$(this).find(\'.yt-lightbox-item\').magnificPopup({
								type: \'image\',
								mainClass: \'mfp-zoom-in mfp-img-mobile\',
								tLoading: \'\', // remove text from preloader
								removalDelay: 400, //delay removal by X to allow out-animation
								gallery: {
									enabled: true,
									navigateByImgClick: true,
									preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
								},
								callbacks: {
									open: function() {
										//overwrite default prev + next function. Add timeout for css3 crossfade animation
										$.magnificPopup.instance.next = function() {
											var self = this;
											self.wrap.removeClass(\'mfp-image-loaded\');
											setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
										}
										$.magnificPopup.instance.prev = function() {
											var self = this;
											self.wrap.removeClass(\'mfp-image-loaded\');
											setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
										}
									},
									imageLoadComplete: function() {
										var self = this;
										setTimeout(function() { self.wrap.addClass(\'mfp-image-loaded\'); }, 16);
									}
								}
							});

						});
					});';
			$return .= '<script type="text/javascript">'.$script.'</script>';
		}
		else{
			$return .= yt_alert_box($database['language']->get("shortcode_carousel_not_item_desc"), 'warning');
		}
	}
    return $return;
}
?>