var active = false;
var hover = false;
$(document).ready(function() {
	$("ul.megamenu li .sub-menu .content .hover-menu ul li").hover(function () {
		$(this).children("ul").show();

	},function () {
		$(this).children("ul").hide();
	});
	
	
	var wd_width = $(window).width();
	if(wd_width <= 991) {
		$("ul.megamenu > li.hover").unbind('mouseenter mouseleave');
		removeWidthSubmenu();	
		clickMegaMenu();
	} else {
		$( "ul.megamenu > li.hover").unbind( "click" );
		hoverMegaMenu();
		renderWidthSubmenu();
	}
	
	$(window).resize(function() {
		var sp_width = $(window).width();
		if(sp_width <= 991){
			$("ul.megamenu > li.hover").unbind('mouseenter mouseleave');
			removeWidthSubmenu();
			clickMegaMenu();
		}	
		else{
			$( "ul.megamenu > li.hover").unbind( "click" );
			hoverMegaMenu();
			renderWidthSubmenu();
		}	
	});
	
	
	$("ul.megamenu > li.click").click(function () {
		if($(this).find(".content").is(':visible')) { return false; }
		active = $(this);
		hover = true;
		var transition = $(this).closest(".megamenu").data("transition");
		var animation_time = $(this).closest(".megamenu").data("animationtime");		
		$("ul.megamenu > li").removeClass("active");
		$(this).addClass("active");
		$("ul.megamenu > li").children(".sub-menu").hide();
		$("ul.megamenu > li").find(".content").hide();
		$(this).children(".sub-menu").show();
		if(transition == 'slide') {
			$(this).find(".content").show();
			$(this).find(".content").css("height", "auto");
			var originalHeight = $(this).find(".content").height();
			$(this).find(".content").css("height", 0);
			$(this).find(".content").stop(true, true).animate({ height:originalHeight },animation_time);
		} else if(transition == 'fade') {
			$(this).find(".content").fadeIn(animation_time);
		} else {
			$(this).find(".content").show();
		}		
		$(this).children(".sub-menu").css("right", "auto");
			if ($("html").css("direction").toLowerCase() == "rtl"){
				var $whatever        = $(this).children(".sub-menu");
				var $whatever2       =  $($whatever).closest('ul.megamenu');
				if($whatever.offset().left < $whatever2.offset().left) {
					$(this).children(".sub-menu").css("right", "0");
				}				
			}else{
				var $whatever        = $(this).children(".sub-menu");
				var ending_right     = ($(window).width() - ($whatever.offset().left + $whatever.outerWidth()));
				var $whatever2       =  $($whatever).closest('ul.megamenu');
				var ending_right2    = ($(window).width() - ($whatever2.offset().left + $whatever2.outerWidth()));
				if(ending_right2 > ending_right) {
					$(this).children(".sub-menu").css("right", "0");
				}				
			}

		return false;
	});
	
	$("#show-megamenu").click(function () {
		if($('.megamenu-wrapper').hasClass('so-megamenu-active'))
			$('.megamenu-wrapper').removeClass('so-megamenu-active');
		else
			$('.megamenu-wrapper').addClass('so-megamenu-active');
	}); 
	$('#remove-megamenu').click(function() {
        $('.megamenu-wrapper').removeClass('so-megamenu-active');
        return false;
    });		
	
	$("#show-verticalmenu").click(function () {
		if($('.vertical-wrapper').hasClass('so-vertical-active'))
			$('.vertical-wrapper').removeClass('so-vertical-active');
		else
			$('.vertical-wrapper').addClass('so-vertical-active');
	}); 
	$('#remove-verticalmenu').click(function() {
        $('.vertical-wrapper').removeClass('so-vertical-active');
        return false;
    });	
	
	$('html').on('click', function () {
		$("ul.megamenu > li.click").removeClass("active");
		$("ul.megamenu > li.click").children(".sub-menu").hide();
		$("ul.megamenu > li.click").find(".content").hide();
	});
	$('.close-menu').on('click', function () {
		$(this).parent().removeClass("active");
		$(this).parent().children(".sub-menu").hide();
		$(this).parent().find(".content").hide();
		return false;
	});
});

function renderWidthSubmenu()
{
	$('.vertical .sub-menu').each(function(){
		value = $(this).data("subwidth");
		if(value){
			var container_width = $('.container').width();
			var vertical_width = $('.vertical').width();
			var full_width = container_width - vertical_width;
			var width_submenu = (full_width*value)/100;
			$(this).css('width',width_submenu+'px');
		}	
	});
}	
function removeWidthSubmenu()
{
	$('.vertical .sub-menu').each(function(){
		$(this).css('width','100%');
	});
}
function clickMegaMenu(){
	$("ul.megamenu > li.hover").click(function () {
		if($(this).find(".content").is(':visible')) { return true; }
		active = $(this);
		hover = true;
		var transition = $(this).closest(".megamenu").data("transition");
		var animation_time = $(this).closest(".megamenu").data("animationtime");
		$("ul.megamenu > li").removeClass("active");
		$(this).addClass("active");
		$("ul.megamenu > li").children(".sub-menu").hide();
		$("ul.megamenu > li").find(".content").hide();
		$(this).children(".sub-menu").show();
		if(transition == 'slide') {
			$(this).find(".content").show();
			$(this).find(".content").css("height", "auto");
			var originalHeight = $(this).find(".content").height();
			$(this).find(".content").css("height", 0);
			$(this).find(".content").stop(true, true).animate({ height:originalHeight },animation_time);
		} else if(transition == 'fade') {
			$(this).find(".content").fadeIn(animation_time);
		} else {
			$(this).find(".content").show();
		}		
		$(this).children(".sub-menu").css("right", "auto");
			if ($("html").css("direction").toLowerCase() == "rtl"){
				var $whatever        = $(this).children(".sub-menu");
				var $whatever2       =  $($whatever).closest('ul.megamenu');
				if($whatever.offset().left < $whatever2.offset().left) {
					$(this).children(".sub-menu").css("right", "0");
				}				
			}else{
				var $whatever        = $(this).children(".sub-menu");
				var ending_right     = ($(window).width() - ($whatever.offset().left + $whatever.outerWidth()));
				var $whatever2       =  $($whatever).closest('ul.megamenu');
				var ending_right2    = ($(window).width() - ($whatever2.offset().left + $whatever2.outerWidth()));
				if(ending_right2 > ending_right) {
					$(this).children(".sub-menu").css("right", "0");
				}				
			}

	});	
}

function hoverMegaMenu(){
		$("ul.megamenu > li.hover").hover(function () {
			active = $(this);
			hover = true;
			var transition = $(this).closest(".megamenu").data("transition");
			var animation_time = $(this).closest(".megamenu").data("animationtime");
			$("ul.megamenu > li").removeClass("active");
			$(this).addClass("active");
			$("ul.megamenu > li").children(".sub-menu").hide();
			$("ul.megamenu > li").find(".content").hide();
			$(this).children(".sub-menu").show();
			if(transition == 'slide') {
				$(this).find(".content").show();
				$(this).find(".content").css("height", "auto");
				var originalHeight = $(this).find(".content").height();
				$(this).find(".content").css("height", 0);
				$(this).find(".content").stop(true, true).animate({ height:originalHeight },animation_time);
			} else if(transition == 'fade') {
				$(this).find(".content").fadeIn(animation_time);
			} else {
				$(this).find(".content").show();
			}	
			$(this).children(".sub-menu").css("right", "auto");	
			if ($("html").css("direction").toLowerCase() == "rtl"){
				var $whatever        = $(this).children(".sub-menu");
				var $whatever2       =  $($whatever).closest('ul.megamenu');
				if($whatever.offset().left < $whatever2.offset().left) {
					$(this).children(".sub-menu").css("right", "0");
				}				
			}else{
				var $whatever        = $(this).children(".sub-menu");
				var ending_right     = ($(window).width() - ($whatever.offset().left + $whatever.outerWidth()));
				var $whatever2       =  $($whatever).closest('ul.megamenu');
				var ending_right2    = ($(window).width() - ($whatever2.offset().left + $whatever2.outerWidth()));
				if(ending_right2 > ending_right) {
					$(this).children(".sub-menu").css("right", "0");
				}				
			}

		},function () {
			var rel = $(this).attr("title");
			hover = false;
			var transition = $(this).closest(".megamenu").data("transition");
			var animation_time = $(this).closest(".megamenu").data("animationtime");
			if(rel == 'hover-intent') {
				var hoverintent = $(this);
				setTimeout(function (){
					if(hover == false) {
						if(transition == 'slide') {
							$(hoverintent).find(".content").stop(true, true).animate({ height:"hide" },animation_time, function() { if(hover == false) { $(hoverintent).removeClass("active"); $(hoverintent).children(".sub-menu").hide(); } });
						} else if(transition == 'fade') {
							$(hoverintent).removeClass("active");
							$(hoverintent).find(".content").fadeOut(animation_time, function() {
								if(hover == false) { $(hoverintent).children(".sub-menu").hide(); }
							});
						} else {
							$(hoverintent).removeClass("active");
							$(hoverintent).children(".sub-menu").hide();
							$(hoverintent).find(".content").hide();
						}
					}
				}, 500);
			} else {
				if(transition == 'slide') {
					$(this).find(".content").stop(true, true).animate({ height:"hide" },animation_time, function() { if(hover == false) { $(active).removeClass("active"); $(active).children(".sub-menu").hide(); } });
				} else if(transition == 'fade') {
					$(active).removeClass("active");
					$(this).find(".content").fadeOut(animation_time, function() {
						if(hover == false) { $(active).children(".sub-menu").hide(); }
					});
				} else {
					$(this).removeClass("active");
					$(this).children(".sub-menu").hide();
					$(this).find(".content").hide();
				}
			}
		});	
}