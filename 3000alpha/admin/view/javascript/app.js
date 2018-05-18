$(document).ready(function(){

	/* Content appear */
	if($('body').hasClass('content-appear')) {
		$('body').addClass('content-appearing')
		setTimeout(function() {
			$('body').removeClass('content-appear content-appearing');
		}, 800);
	}
	
	/* Preloader */
	setTimeout(function() {
		$('.preloader').fadeOut();
	}, 500);

	/* Scroll */
	if(jQuery.browser.mobile == false) {
		function initScroll(){
			$('.custom-scroll').jScrollPane({
				autoReinitialise: true,
				autoReinitialiseDelay: 100
			});
		}

		initScroll();

		$(window).resize(function() {
			initScroll();
		});
	}

	/* Scroll - if mobile */
	if(jQuery.browser.mobile == true) {
		$('.custom-scroll').css('overflow-y','scroll');
	}

    /* Switch sidebar to compact */
	if (matchMedia) {
		var mq = window.matchMedia("(min-width: 768px) and (max-width: 991px)");
		mq.addListener(WidthChange);
		WidthChange(mq);
	}

	function WidthChange(mq) {
		if (mq.matches) {
			$('body').addClass('compact-sidebar');
			$('.site-sidebar li.with-sub').find('>ul').slideUp();
		} else {
			$('body').removeClass('compact-sidebar');
			sidebarIfActive();
		}
	}

	/* Fullscreen */
	$('.toggle-fullscreen').click(function() {
		$(document).toggleFullScreen();
	});

    /* Sidebar - on click */
	$('.site-sidebar li.with-sub > a').click(function() {
		if (!$('body').hasClass('compact-sidebar')) {
			if ($(this).parent().hasClass('active')) {
				$(this).parent().removeClass('active');
				$(this).parent().find('>ul').slideUp();
			} else {
				if (!$(this).parent().parent().closest('.with-sub').length) {
					$('.site-sidebar li.with-sub').removeClass('active').find('>ul').slideUp();
				}
				$(this).parent().addClass('active');
				$(this).parent().find('>ul').slideDown();
			}
		}
	});

	/* Sidebar - if active */
	function sidebarIfActive(){
		$('.site-sidebar ul > li:not(.with-sub)').removeClass('active');
		var url = window.location;
	    var element = $('.site-sidebar ul > li > a').filter(function () {
	        return this.href == url || url.href.indexOf(this.href) == 0;
	    });
		element.parent().addClass('active');

		$('.site-sidebar li.with-sub').removeClass('active').find('>ul').hide();
		var url = window.location;
	    var element = $('.site-sidebar ul li ul li a').filter(function () {
	        return this.href == url || url.href.indexOf(this.href) == 0;
	    });
		element.parent().addClass('active');
		element.parent().parent().parent().addClass('active');

	    if(!$('body').hasClass('compact-sidebar')) {
			element.parent().parent().slideDown();
	    }
	}

	sidebarIfActive();

	/* Sidebar - show and hide */
	$('.site-header .sidebar-toggle-first').click(function() {
		if ($('body').hasClass('site-sidebar-opened')) {
			$('body').removeClass('site-sidebar-opened');
			if(jQuery.browser.mobile == false){
				$('html').css('overflow','auto');
			}
		} else {
			$('body').addClass('site-sidebar-opened');
			if(jQuery.browser.mobile == false){
				$('html').css('overflow','hidden');
			}
		}
	});

	$('.site-header .sidebar-toggle-second').click(function() {
		var compact = 'compact-sidebar';

		if($('body').hasClass(compact)) {
			$('body').removeClass(compact);
			sidebarIfActive();
		} else {
			$('body').addClass(compact);
			$('.site-sidebar li.with-sub').find('>ul').slideUp();
		}
	});

	/* Sidebar - overlay */
	$('.site-overlay').click(function() {
		$('.site-header .sidebar-toggle-first').removeClass('active');
		$('body').removeClass('site-sidebar-opened');
		if(jQuery.browser.mobile == false){
			$('html').css('overflow','auto');
		}
	});

	/* Sidebar second - toggle */
	$('.toggle-button-second').click(function() {
		$('.template-options').toggle();
		$('.template-options').removeClass('opened');
		$(this).toggleClass('active');
		$('.site-sidebar-second').toggleClass('opened');
	});

	/* Template options - toggle */
	$('.template-options .to-toggle').click(function() {
		$('.template-options').toggleClass('opened');
	});

	/* Chat */
	$('.sidebar-chat a, .sidebar-chat-window a').click(function() {
		$('.sidebar-chat').toggle();
		$('.sidebar-chat-window').toggle();
	});

	/* Switchery */
	$('.js-switch').each(function() {
		new Switchery($(this)[0], $(this).data());
	});

	/* Template options */
	$('.template-options input:checkbox').change(function() {

		if($('body').hasClass('fixed-footer')) {
			$('body').removeClass('fixed-footer');
		}

		var setting = $(this).attr('name');

		if($('body').hasClass(setting)) {
			$('body').removeClass(setting);
			if(setting == 'compact-sidebar') {
				sidebarIfActive();
			}
			if(setting == 'fixed-header') {
				$('body').removeClass('fixed-sidebar');
				$('.template-options input[name="fixed-sidebar"]').prop('checked', false);
			}
			if(setting == 'boxed-wrapper') {
				$('.template-options input[name="fixed-header"]').parent().parent().removeClass('disabled');
				$('.template-options input[name="fixed-sidebar"]').parent().parent().removeClass('disabled');
			}
		} else {
			$('body').addClass(setting);
			if(setting == 'compact-sidebar') {
				$('.site-sidebar li.with-sub').find('>ul').slideUp();
			}
			if(setting == 'fixed-sidebar') {
				$('body').addClass('fixed-header');
				$('.template-options input[name="fixed-header"]').prop('checked', true);
			}
			if(setting == 'boxed-wrapper') {
				$('body').removeClass('fixed-header');
				$('.template-options input[name="fixed-header"]').prop('checked', false);
				$('.template-options input[name="fixed-header"]').parent().parent().addClass('disabled');
				$('body').removeClass('fixed-sidebar');
				$('.template-options input[name="fixed-sidebar"]').prop('checked', false);
				$('.template-options input[name="fixed-sidebar"]').parent().parent().addClass('disabled');
				$('body').removeClass('static');
				$('.template-options input[name="static"]').prop('checked', false);
			}
			if(setting == 'static') {
				$('body').removeClass('fixed-header');
				$('.template-options input[name="fixed-header"]').prop('checked', false);
				$('.template-options input[name="fixed-header"]').parent().parent().removeClass('disabled');
				$('body').removeClass('fixed-sidebar');
				$('.template-options input[name="fixed-sidebar"]').prop('checked', false);
				$('.template-options input[name="fixed-sidebar"]').parent().parent().removeClass('disabled');
				$('body').removeClass('boxed-wrapper');
				$('.template-options input[name="boxed-wrapper"]').prop('checked', false);
			}
		}
		
	});

	$('.template-options input:radio').change(function() {
		var setting = $(this).val();

		$('body').removeClass (function (index, css) {
			return (css.match (/(^|\s)skin-\S+/g) || []).join(' ');
		});

		$('body').addClass(setting);

		if(setting == 'skin-default' || setting == 'skin-2'  || setting == 'skin-3') {
			$('.site-header .navbar').removeClass('navbar-dark').addClass('navbar-light');
		} else {
			$('.site-header .navbar').removeClass('navbar-light').addClass('navbar-dark');
		}

		if(setting == 'skin-3' || setting == 'skin-4') {
			$('.site-header .navbar .navbar-left .toggle-button.dark').removeClass('dark').addClass('light');
			$('.site-header .navbar .navbar-left .toggle-button-second.dark').removeClass('dark').addClass('light');
		} else {
			$('.site-header .navbar .navbar-left .toggle-button.light').removeClass('light').addClass('dark');
			$('.site-header .navbar .navbar-left .toggle-button-second.light').removeClass('light').addClass('dark');
		}

		if(setting == 'skin-default' || setting == 'skin-2' || setting == 'skin-3') {
			$('.site-header .navbar .navbar-right .toggle-button.dark').removeClass('dark').addClass('light');
			$('.site-header .navbar .navbar-right .toggle-button-second.dark').removeClass('dark').addClass('light');
		} else {
			$('.site-header .navbar .navbar-right .toggle-button.light').removeClass('light').addClass('dark');
			$('.site-header .navbar .navbar-right .toggle-button-second.light').removeClass('light').addClass('dark');
		}

		if(setting == 'skin-default' || setting == 'skin-2' || setting == 'skin-6') {
			$('.site-sidebar .custom-scroll').removeClass('custom-scroll-dark').addClass('custom-scroll-light');
			$('.site-sidebar .progress-widget').removeClass('progress-widget-dark').addClass('progress-widget-light');
		} else {
			$('.site-sidebar .custom-scroll').removeClass('custom-scroll-light').addClass('custom-scroll-dark');
			$('.site-sidebar .progress-widget').removeClass('progress-widget-light').addClass('progress-widget-dark');
		}
	});

	/* Hide on outside click */
	$(document).mouseup(function (e) {
	    var container = $('.template-options, .site-sidebar-second, .toggle-button-second');

	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	        container.removeClass('opened');
			$('.template-options').show();
			$('.toggle-button-second').removeClass('active');
	    }
	});

	/*  Tooltip */
	$('[data-toggle="tooltip"]').tooltip();

	/*  Popover */
	$('[data-toggle="popover"]').popover();

});