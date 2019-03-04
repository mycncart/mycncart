<?php 
function product_carouselYTShortcode($atts,$contentC,$module_id,$id,$database){
    $css = '';
	$return = '';
	$title = '';
    $lang = 'false';
	$intro_text = '';
	if($database['language_id'] != 1){
		$lang = 'true';
	}
	/* $module_id != 0 => call shortcode in Admin */
	if($module_id != "0"){
		$css .= "/* Style Product Carousel */ \n";
		$css .= $atts->css_internal;
		if($atts->type_change == "horizontal"){
			if ( $atts->background != '' or $atts->color != '' ) {
				$background = 'background-color:'.$atts->background.';';
				$color = 'color:'.$atts->color.';';
				$css .= '.'.$id.' .yt-carousel-slide {' . $background . $color .'}';
				if ($atts->style == 3) {
					$css .= '.'.$id.'.yt-carousel-style-3 .yt-carousel-caption:after {border-bottom-color: '.$background.';}';
				}
			}
			if ($atts->title_color) {
				$css .= '.'.$id.'.yt-carousel-slide .yt-carousel-slide-title a {color: '.$atts->title_color.';}';
				$css .= '.'.$id.'.yt-carousel-slide .price {color: '.$atts->title_color.';}';
				$css .= '.'.$id.'.yt-carousel-slide .yt-carousel-slide-title a:hover {color: '.yt_lighten($atts->title_color,'10%').';}';
				$css .= '.'.$id.'.yt-carousel-slide .price:hover {color: '.yt_lighten($atts->title_color,'10%').';}';
			}
		}else{
			if ( $atts->background != '' or $atts->color != '' ) {
				$background = 'background-color:'.$atts->background.';';
				//$border = 'border:'.$atts->background.' 1px solid;border-top:none';
				$color = 'color:'.$atts->color.';';
				$css .= '.'.$id.' .yt-slick-slide .yt-slick-wrap{' . $background . $color .' display:block; overflow:hidden;}';
				//$css .= '.'.$id.' .yt-slick-slide .yt-slick-wrap .yt-slick-caption{' .$border . $color .'}';
				if ($atts->style == 3) {
					$css .= '.'.$id.'.yt-slick-style-3 .yt-slick-caption:after {border-bottom-color: '.$background.';}';
				}
			}
			if ($atts->title_color) {
				$css .= '.'.$id.' .yt-slick-slide .yt-slick-slide-title a {color: '.$atts->title_color.';}';
				$css .= '.'.$id.' .yt-slick-slide .price {color: '.$atts->title_color.';}';
				$css .= '.'.$id.' .yt-slick-slide .yt-slick-slide-title a:hover {color: '.yt_lighten($atts->title_color,'10%').';}';
				$css .= '.'.$id.' .yt-slick-slide .price:hover {color: '.yt_lighten($atts->title_color,'10%').';}';
			}
		}
		
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
		if (count($slides) and ($atts->yt_title == 'yes' or $atts->image  == 'yes' or  $atts->intro_text === 'yes')) {
			if($atts->type_change == "horizontal"){
				$source = substr($atts->source, 0, 5);
				if($atts->lazyload == 'yes'){
					$atts->items_column4 = $atts->items_column4 < count($slides) ? $atts->items_column4 : count($slides);
					$atts->items_column3 = $atts->items_column3 < count($slides) ? $atts->items_column3 : count($slides);
					$atts->items_column2 = $atts->items_column2 < count($slides) ? $atts->items_column2 : count($slides);
					$atts->items_column1 = $atts->items_column1 < count($slides) ? $atts->items_column1 : count($slides);
					$atts->items_column0 = $atts->items_column0 < count($slides) ? $atts->items_column0 : count($slides);
				}
				$return .= '<div id="' . $id . '" class="yt-clearfix ' . $id . ' '.$atts->yt_class.' yt-carousel yt-carousel-style-'.$atts->style.' yt-carousel-title-' . $atts->yt_title .' '. $atts->arrow_position.'" data-autoplay="' . $atts->autoplay .'" data-delay="' . $atts->delay . '" data-speed="' . $atts->speed . '" data-arrows="' . $atts->arrows .'" data-pagination="' . $atts->pagination . '" data-lazyload="' . $atts->lazyload . '" data-hoverpause="' . $atts->hoverpause . '" data-items="' . $atts->limit . '" data-items_column0="' . $atts->items_column0 . '" data-items_column1="' . $atts->items_column1 . '" data-items_column2="' . $atts->items_column2 . '"  data-items_column3="' . $atts->items_column3 . '" data-items_column4="' . $atts->items_column4 . '" data-margin="' . $atts->margin . '" data-scroll="1" data-loop="' . $atts->loop . '" data-rtl="' . $lang . '"  ><div class="'.$id.' yt-carousel-slides">';
				foreach ((array) $slides as $slide) {
					$image_url ='';
					if($slide['image']){
						$image_url = resize($slide['image'], $atts->image_width, $atts->image_height);
					}
					else{
						$image_url = resize('no_image.png', $atts->image_width, $atts->image_height);
					}

					if($atts->yt_title == 'yes' && $slide['title'] ) {

						$title = html_entity_decode($slide['title']);
						$title_new = str_replace('"',"'",$title);

						if ($atts->title_limit && $atts->title_limit!= 'no') {
							$title = yt_char_limit($title, $atts->title_limit);
						}

						if ($atts->title_link == "yes") {
							$title = '<a href="'.$slide['link'].'">'.$title.'</a>';
						}
						$title = '<h3 class="yt-carousel-slide-title">' . $title . '</h3>';
					}

					if ($atts->intro_text == 'yes' and isset($slide['introtext'])) {

						$intro_text = html_entity_decode($slide['introtext']);

						if ($atts->intro_text_limit) {
							$intro_text = yt_char_limit($intro_text, $atts->intro_text_limit);
						}

						$intro_text =  '<div class="yt-carousel-item-text">'. $intro_text.'</div>';
					}
					$return .= '<div class="'.$id.' yt-carousel-slide">';
						if (isset($image_url) && $atts->image  == 'yes') {
							$return .= '<div class="yt-carousel-image">';
								if (isset($image_url)) {
									$return .= '<div class="yt-carousel-links">
										<a class="yt-lightbox-item" href="'. yt_image_media($slide['image']) .'" title="'.$slide['title'].'">
											<i class="fa fa-search"></i>
										</a>';

										if ($source != 'media') {
											$return .= '<a class="yt-carousel-link" href="'.$slide['link'].'" title="'.$slide['title'].'">
												<i class="fa fa-link"></i>
											</a>';
										}
									$return .= '</div>';
								}
								if($atts->lazyload == 'yes'){
									$return .= '<img class="owl2-lazy" data-src="'. yt_image_media($image_url) . '" src="'. yt_image_media($image_url) . '" alt="'.$slide['title'].'" />';
								}else{
									$return .= '<img src="'. yt_image_media($image_url) . '" alt="'.$slide['title'].'"/>';
								}
									
								
							$return .= '</div>';
						} //$atts->image  == 'yes'
						if (($atts->yt_title == 'yes') or ($atts->intro_text == 'yes')) {
							$return .= '<div class="yt-carousel-caption">'.$title . $intro_text .'';
							if($atts->rating == 'yes')
							{
								$return .= '<div class="rating">';
								for ($i = 1; $i <= 5; $i++) {
									if ($slide['rating'] < $i) {
										$return .=  '<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>';
									} else { 
										$return .=  '<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>';
									} 
								} 
								$return .= '</div>';
							}
							if($atts->price == 'yes'){
								if ($slide['price']) {
									$return .=  '<p class="price">';
									if (!$slide['special']) {
										$return .=  $slide['price'];
									} else {
										$return .= '<span class="price-new">'.$slide['special'].'</span> <span class="price-old">'.$slide['price'].'</span>';
									} 
									if ($slide['tax']) {
										$return .= '<span class="price-tax">'.$database['language']->get('text_tax').$slide['tax'].'</span>';
									}
									$return .= '</p>';
								} 
							}
							if($atts->display_add_to_cart == 'yes' || $atts->display_wishlist == 'yes' || $atts->display_compare == 'yes'){
								$return .= '<div class="button-group">';
								if($atts->style == '3'){
									if ($atts->display_wishlist == 'yes') {
										$return .= '<button type="button" data-toggle="tooltip" title="'.$database['language']->get('button_wishlist').'" onclick="wishlist.add('.$slide['product_id'].');"><i class="fa fa-heart"></i></button>';
									}
									if ($atts->display_add_to_cart == 'yes') {
											$return .= '<button type="button" onclick="cart.add('.$slide['product_id'].');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">'.$database['language']->get('button_cart').'</span></button>';
									}
									if ($atts->display_compare == 'yes') {
										$return .= '<button type="button" data-toggle="tooltip" title="'.$database['language']->get('button_compare').'" onclick="compare.add('.$slide['product_id'].');"><i class="fa fa-exchange"></i></button>';
									}
								}else{
									if ($atts->display_add_to_cart == 'yes') {
											$return .= '<button type="button" onclick="cart.add('.$slide['product_id'].');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">'.$database['language']->get('button_cart').'</span></button>';
									}
									if ($atts->display_wishlist == 'yes') {
										$return .= '<button type="button" data-toggle="tooltip" title="'.$database['language']->get('button_wishlist').'" onclick="wishlist.add('.$slide['product_id'].');"><i class="fa fa-heart"></i></button>';
									}
									if ($atts->display_compare == 'yes') {
										$return .= '<button type="button" data-toggle="tooltip" title="'.$database['language']->get('button_compare').'" onclick="compare.add('.$slide['product_id'].');"><i class="fa fa-exchange"></i></button>';
									}
								}
								$return .= '</div>';
							} //$atts->display_add_to_cart == 'yes'
							$return .= '</div>';
						} //$atts->yt_title == 'yes'
					$return .= '</div>';
				}//End foreach

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
			}else{
				$return .= '<div class="' . $id . ' yt-slick yt-slick-style-'.$atts->style.'">';
				$return .= '<div id="' . $id . '" class="yt-slick-slides">';
				foreach ((array) $slides as $slide) {
					$image_url ='';
					if($slide['image']){
						$image_url = resize($slide['image'], $atts->image_width, $atts->image_height);
					}
					else{
						$image_url = resize('no_image.png', $atts->image_width, $atts->image_height);
					}

					if($atts->yt_title == 'yes' && $slide['title'] ) {

						$title = html_entity_decode($slide['title']);
						$title_new = str_replace('"',"'",$title);

						if ($atts->title_limit && $atts->title_limit!= 'no') {
							$title = yt_char_limit($title, $atts->title_limit);
						}

						if ($atts->title_link == "yes") {
							$title = '<a href="'.$slide['link'].'">'.$title.'</a>';
						}
						$title = '<h3 class="yt-slick-slide-title">' . $title . '</h3>';
					}

					$return .= '<div class="item yt-slick-slide">';
						$return .= '<div class="yt-slick-wrap">';
							if (isset($image_url) && $atts->image  == 'yes') {
								$return .= '<div class="yt-slick-image">';
									if (isset($image_url)) {
										$return .= '<div class="yt-slick-links">
											<a class="yt-lightbox-item" href="'. yt_image_media($slide['image']) .'" title="'.$slide['title'].'">
												<i class="fa fa-search"></i>
											</a>';
										$return .= '<a class="yt-slick-link" href="'.$slide['link'].'" title="'.$slide['title'].'">
													<i class="fa fa-link"></i>
												</a>';
										$return .= '</div>';
									}
									$return .= '<img src="'. yt_image_media($image_url) . '" alt="'.$slide['title'].'"/>';
								$return .= '</div>';
							} //$atts->image  == 'yes'
							if (($atts->yt_title == 'yes') or ($atts->intro_text == 'yes')) {
								$return .= '<div class="yt-slick-caption">'.$title . $intro_text .'';
								if($atts->rating == 'yes')
								{
									$return .= '<div class="rating">';
									for ($i = 1; $i <= 5; $i++) {
										if ($slide['rating'] < $i) {
											$return .=  '<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>';
										} else { 
											$return .=  '<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>';
										} 
									} 
									$return .= '</div>';
								}
								if($atts->price == 'yes'){
									if ($slide['price']) {
										$return .=  '<p class="price">';
										if (!$slide['special']) {
											$return .=  $slide['price'];
										} else {
											$return .= '<span class="price-new">'.$slide['special'].'</span> <span class="price-old">'.$slide['price'].'</span>';
										} 
										if ($slide['tax']) {
											$return .= '<span class="price-tax">'.$database['language']->get('text_tax').$slide['tax'].'</span>';
										}
										$return .= '</p>';
									} 
								}
								$return .= '</div>';
							} //$atts->yt_title == 'yes'
						$return .= '</div>'; //.yt-slick-wrap
					$return .= '</div>'; //.yt-slick-slide
				}//End foreach
				$return .= '</div>'; //.yt-slick-slides
				$return .= '<div class="control-slick">';
				$return .= '<div class="sw-dot"></div>';
				$return .= '</div>';//.control-slick
				$return .= '</div>'; //.yt-slick
				$pagination_slick = ($atts->pagination == "yes" ? "true" : "false");
				$arrows_slick = ($atts->arrows == "yes" ? "true" : "false");
				$autoplay_slick = ($atts->autoplay == "yes" ? "true" : "false");
				$hoverpause_slick = ($atts->hoverpause == "yes" ? "true" : "false");
				$script = 'jQuery(document).ready(function ($) {
						$(\'.'.$id.'.yt-slick\').each(function () {
							$("#'.$id.'.yt-slick-slides").slick({
								centerMode: true,
								centerPadding: "0px",
								dots: '.$pagination_slick.',
								infinite: true,
								speed: 300,
								slidesToShow: '.$atts->items_column0.',
								slidesToScroll: 1,
								autoplay: '.$autoplay_slick.',
								autoplaySpeed: 2000,
								vertical:true,
								verticalSwiping:false,
								appendArrows:".'.$id.' .control-slick",
								appendDots : ".'.$id.' .sw-dot",
								adaptiveHeight: false,
								arrows: '.$arrows_slick.',
								prevArrow: "<div data-role=\"none\" class=\"res-button slick-prev\" aria-label=\"previous\">&#60;</div>",
								nextArrow: "<div data-role=\"none\" class=\"res-button slick-next\" aria-label=\"next\">&#62;</div>",
								pauseOnHover: '.$hoverpause_slick.',
								responsive: [
									{
										breakpoint: 1199,
										settings: {
											centerMode: true,
											centerPadding: "0px",
											slidesToShow: '.$atts->items_column1.',
										}
									},
									{
										breakpoint: 991,
										settings: {
											centerMode: false,
											centerPadding: "0px",
											slidesToShow: '.$atts->items_column2.',
										}
									},
									{
										breakpoint: 767,
										settings: {
											centerMode: false,
											centerPadding: "0px",
											slidesToShow: '.$atts->items_column3.',
										}
									},
									{
										breakpoint: 480,
										settings: {
											centerMode: false,
											centerPadding: "0px",
											slidesToShow: '.$atts->items_column4.'
										}
									}
								],
							  });

							
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
		}else
			$return .= yt_alert_box($database['language']->get('shortcode_carousel_not_item_desc'), 'warning');
	}
    return $return;
}
?>