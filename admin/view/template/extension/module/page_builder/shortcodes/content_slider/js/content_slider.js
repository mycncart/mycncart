jQuery(document).ready(function ($) {
	// Content slider
	$('.yt-content-slider').each(function () {
		var $slider = $(this),
			$panels = $slider.children('div'),
			data = $slider.data(),
			$totalItem = $panels.length;
		// Remove unwanted br's
		$slider.children(':not(.yt-content-slide)').remove();
		// Apply Owl Carousel
		$slider.owlCarousel2({
			responsiveClass: true,
			mouseDrag: true,
			video:true,
			animateIn: data.transitionin,
    		animateOut: data.transitionout,
    		lazyLoad: (data.lazyload == 'yes') ? true : false,
			autoplay: (data.autoplay == 'yes') ? true : false,
			autoHeight: (data.autoheight == 'yes') ? true : false,
			autoplayTimeout: data.delay * 1000,
			smartSpeed: data.speed * 1000,
			autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
			center: (data.center == 'yes') ? true : false,
			loop: (data.loop == 'yes') ? true : false,
            dots: (data.pagination == 'yes') ? true : false,
            nav: (data.arrows == 'yes') ? true : false,
			dotClass: "owl2-dot",
			dotsClass: "owl2-dots",
            margin: data.margin,
            navText: ['',''],
			navClass: ["owl2-prev", "owl2-next"],
			responsive: {
				0: {
					items	: data.items_column4,
					nav		: ($totalItem > data.items_column4 && data.arrows == 'yes') ? true : false
				},
				480: {
					items	: data.items_column3,
					nav		: ($totalItem > data.items_column3 && data.arrows == 'yes') ? true : false
				},
				768: {
					items	: data.items_column2,
					nav		: ($totalItem > data.items_column2 && data.arrows == 'yes') ? true : false
				},
				992: { 
					items	: data.items_column1,
					nav		: ($totalItem > data.items_column1 && data.arrows == 'yes') ? true : false
				},
				1200: {
					items	: data.items_column0,
					nav		: ($totalItem > data.items_column0 && data.arrows == 'yes') ? true : false				
				}
			}
		});
		//$slider.data('owlCarousel').transitionTypes("backSlide");
		
		if ($slider.find('.yt-testimonial')) {
			$slider.addClass('yt-testimonials-slider');
			if ($slider.find('.yt-testimonial').hasClass('yt-testimonial-style-1')) {
				$slider.addClass('yt-tmstyle1');
			}
			else if ($slider.find('.yt-testimonial').hasClass('yt-testimonial-style-2')) {
				$slider.addClass('yt-tmstyle2');
			}
			else if ($slider.find('.yt-testimonial').hasClass('yt-testimonial-style-3')) {
				$slider.addClass('yt-tmstyle3');
			}
		}

	});
});
