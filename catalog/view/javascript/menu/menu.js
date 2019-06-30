$(document).ready(function () {
    var current_url = window.location.href;
    
    $('.oc-menu .li-top-item .a-top-link').each(function () {
        var link = $(this).attr('href');
        if(current_url.indexOf(link) !== -1) {
            $(this).closest('.li-top-item').addClass('active');
        }
    });

    $('.horizontal-menu .mega-menu-container').each(function () {
        if($(this).hasClass('right')) {
            if($(this).hasClass('full-width')) {
                $(this).closest('li').removeClass().addClass('li-top-item mega-right');
            } else {
                $(this).closest('li').removeClass().addClass('li-top-item right');

                var menu = $('.oc-menu-bar').offset();
                var dropdown = $(this).parent().offset();

                var dropdownRight = $('.oc-menu-bar').outerWidth() - dropdown.left;

                var i = (dropdownRight + $(this).outerWidth()) - ($('.oc-menu-bar').outerWidth());

                if (i > 0) {
                    $(this).css('margin-right', '-' + (i) + 'px');
                }
            }
        }

        if($(this).hasClass('left')) {
            if($(this).hasClass('full-width') == false) {
                var menu = $('.oc-menu-bar').offset();
                var dropdown = $(this).parent().offset();

                var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('.oc-menu-bar').outerWidth());

                if (i > 0) {
                    $(this).css('margin-left', '-' + (i + 10) + 'px');
                }
            }
        }
    });

    $('.sub-menu-container').each(function () {
        var total_cols = 0;
        $(this).find('.sub-item2-content').each(function () {
            var cols = parseFloat($(this).data('cols'));
            if(total_cols == 0) {
                $(this).css('clear', 'left');
            }
            total_cols += cols;
            if(total_cols > 12) {
                $(this).css('clear', 'left');
                total_cols = cols;
            }
            if(total_cols == 12) {
                total_cols = 0;
            }
        });
    });

    $('.vertical-menu .oc-menu-bar').click(function () {
        var effect = $(this).closest('.oc-menu').find('.menu-effect').val();
        if(effect == "none") {
            $('.vertical-menu .ul-top-items').toggle();
        }

        if(effect == "fade") {
            $('.vertical-menu .ul-top-items').fadeToggle();
        }

        if(effect == "slide") {
            $('.vertical-menu .ul-top-items').slideToggle();
        }
    });

    $('.a-plus').click(function() {
        var effect = $(this).closest('.oc-menu').find('.menu-effect').val();
        if(effect == "none") {
            $('.li-plus').hide();
            $('.over').show();
        }

        if(effect == "fade") {
            $('.li-plus').fadeOut();
            $('.over').fadeIn();
        }

        if(effect == "slide") {
            $('.li-plus').slideUp();
            $('.over').slideDown();
        }
    });

    $('.a-minus').click(function() {
        var effect = $(this).closest('.oc-menu').find('.menu-effect').val();
        if(effect == "none") {
            $('.over').hide();
            $('.li-plus').show();
        }

        if(effect == "fade") {
            $('.over').fadeOut();
            $('.li-plus').fadeIn();
        }

        if(effect == "slide") {
            $('.over').slideUp();
            $('.li-plus').slideDown();
        }
    });

    $('.mobile-menu .oc-menu-bar').click(function () {
        var effect = $(this).closest('.oc-menu').find('.menu-effect').val();
        if(effect == "none") {
            $('.mobile-menu .ul-top-items').toggle();
        }

        if(effect == "fade") {
            $('.mobile-menu .ul-top-items').fadeToggle();
        }

        if(effect == "slide") {
            $('.mobile-menu .ul-top-items').slideToggle();
        }
    });

    $('.oc-menu').each(function () {
        var $mobile = $(this).hasClass('mobile-menu');
        var effect = $(this).find('.menu-effect').val();

        if($mobile) {
            $(this).find('.li-top-item .top-click-show').click(function () {
                var flag = $(this).closest('.li-top-item').hasClass('expand');

                if(flag) {
                    $(this).closest('.li-top-item').removeClass('expand');

                    if (effect == "none") {
                        $(this).closest('.li-top-item').find('.sub-menu-container').hide();
                    }

                    if (effect == "fade") {
                        $(this).closest('.li-top-item').find('.sub-menu-container').fadeOut('slow');
                    }

                    if (effect == "slide") {
                        $(this).closest('.li-top-item').find('.sub-menu-container').slideUp();
                    }
                } else {
                    $('.li-top-item').removeClass('expand');

                    $(this).closest('.li-top-item').addClass('expand');

                    if (effect == "none") {
                        $('.mobile-menu .sub-menu-container').hide();
                        $(this).closest('.li-top-item').find('.sub-menu-container').show();
                    }

                    if (effect == "fade") {
                        $('.mobile-menu .sub-menu-container').fadeOut('slow');
                        $(this).closest('.li-top-item').find('.sub-menu-container').fadeIn('slow');
                    }

                    if (effect == "slide") {
                        $('.mobile-menu .sub-menu-container').slideUp();
                        $(this).closest('.li-top-item').find('.sub-menu-container').slideDown('slow');
                    }
                }
            });

            $(this).find('.li-second-items .second-click-show').click(function () {
                var flag = $(this).closest('.li-second-items').hasClass('expand');

                if(flag) {

                    $(this).closest('.li-second-items').removeClass('expand');

                    if (effect == "none") {
                        $(this).closest('.li-second-items').find('.flyout-third-items').hide();
                    }

                    if (effect == "fade") {
                        $(this).closest('.li-second-items').find('.flyout-third-items').fadeOut('slow');
                    }

                    if (effect == "slide") {
                        $(this).closest('.li-second-items').find('.flyout-third-items').slideUp();
                    }
                } else {
                    $('.li-second-items').removeClass('expand');

                    $(this).closest('.li-second-items').addClass('expand');

                    if (effect == "none") {
                        $('.mobile-menu .flyout-third-items').hide();
                        $(this).closest('.li-second-items').find('.flyout-third-items').show();
                    }

                    if (effect == "fade") {
                        $('.mobile-menu .flyout-third-items').fadeOut('slow');
                        $(this).closest('.li-second-items').find('.flyout-third-items').fadeIn('slow');
                    }

                    if (effect == "slide") {
                        $('.mobile-menu .flyout-third-items').slideUp();
                        $(this).closest('.li-second-items').find('.flyout-third-items').slideDown('slow');
                    }
                }
            });
        } else {
            $(this).find('.li-top-item').hover(
                function () {
                    var effect = $(this).closest('.oc-menu').find('.menu-effect').val();

                    if (effect == "none") {
                        $('.sub-menu-container').hide();
                        $(this).find('.sub-menu-container').show();
                    }

                    if (effect == "fade") {
                        $('.sub-menu-container').fadeOut('slow');
                        $(this).find('.sub-menu-container').fadeIn('slow');
                    }

                    if (effect == "slide") {
                        $('.sub-menu-container').slideUp();
                        $(this).find('.sub-menu-container').slideDown('slow');
                    }
                },

                function () {
                    var effect = $(this).closest('.oc-menu').find('.menu-effect').val();

                    if (effect == "none") {
                        $(this).find('.sub-menu-container').hide();
                    }

                    if (effect == "fade") {
                        $(this).find('.sub-menu-container').fadeOut('slow');
                    }

                    if (effect == "slide") {
                        $(this).find('.sub-menu-container').slideUp();
                    }
                }
            );

            $(this).find('.li-second-items').hover(
                function () {
                    var effect = $(this).closest('.oc-menu').find('.menu-effect').val();

                    if (effect == "none") {
                        $('.flyout-third-items').hide();
                        $(this).find('.flyout-third-items').show();
                    }

                    if (effect == "fade") {
                        $('.flyout-third-items').fadeOut('slow');
                        $(this).find('.flyout-third-items').fadeIn('slow');
                    }

                    if (effect == "slide") {
                        $('.flyout-third-items').slideUp();
                        $(this).find('.flyout-third-items').slideDown('slow');
                    }
                },

                function () {
                    var effect = $(this).closest('.oc-menu').find('.menu-effect').val();

                    if (effect == "none") {
                        $(this).find('.flyout-third-items').hide();
                    }

                    if (effect == "fade") {
                        $(this).find('.flyout-third-items').fadeOut('slow');
                    }

                    if (effect == "slide") {
                        $(this).find('.flyout-third-items').slideUp();
                    }
                }
            );
        }
    });

    if($('.oc-menu').hasClass('mobile-menu')) {

    } else {

    }
})