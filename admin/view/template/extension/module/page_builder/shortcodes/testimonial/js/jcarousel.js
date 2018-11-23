!function ($) {
    "use strict";
    var JCarousel = function (element, options) {
        this.$element = $(element)
        this.options = options
        this.options.jslide && this.slide(this.options.jslide)
        this.options.pause == 'hover' && this.$element.on('mouseenter', $.proxy(this.pause, this)).on('mouseleave', $.proxy(this.cycle, this))
        this.transition = (function () {
            var transitionEnd = (function () {
                var el = document.createElement('bootstrap'),
                    transEndEventNames = {
                        'WebkitTransition': 'webkitTransitionEnd',
                        'MozTransition': 'transitionend',
                        'OTransition': 'oTransitionEnd otransitionend',
                        'transition': 'transitionend'
                    },
                    name
                for (name in transEndEventNames) {
                    if (el.style[name] !== undefined) {
                        return transEndEventNames[name]
                    }
                }
            }())
            return transitionEnd && {
                end: transitionEnd
            }
        })()
    }

    JCarousel.prototype = {
        cycle: function (e) {
            if (!e) this.paused = false
            if (this.interval) {
                clearInterval(this.interval)
                this.interval = null
            }
            this.options.interval && !this.paused && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))
            return this
        },
        to: function (pos) {
            var $active = this.$element.find('.item.active'),
                children = $active.parent().children(),
                activePos = children.index($active),
                that = this
            if (pos > (children.length - 1) || pos < 0) return
            if (this.sliding) {
                return this.$element.one('jslid', function () {
                    that.to(pos)
                })
            }
            if (activePos == pos) {
                return this.pause().cycle()
            }
            return this.slide(pos > activePos ? 'next' : 'prev', $(children[pos]))
        },
        pause: function (e) {
            if (!e) this.paused = true
            if (this.$element.find('.next, .prev').length && this.transition.end) {
            }
            clearInterval(this.interval)
            this.interval = null
            return this
        },
        next: function () {
            if (this.sliding) return
            return this.slide('next')
        },
        prev: function () {
            if (this.sliding) return
            return this.slide('prev')
        },
        slide: function (type, next) {
            var $active = this.$element.find('.item.active'),
                $next = next || $active[type](),
                isCycling = this.interval,
                direction = type == 'next' ? 'left' : 'right',
                fallback = type == 'next' ? 'first' : 'last',
                that = this

            this.sliding = true
            isCycling && this.pause()
            $next = $next.length ? $next : this.$element.find('.item')[fallback]()
            if ($next.hasClass('active')) return
            var e = $.Event('jslide', {
                relatedTarget: $next[0]
            })
            if (this.transition && this.$element.hasClass('slide')) {
                this.$element.trigger(e)
                if (e.isDefaultPrevented()) return
                $next.addClass(type)
                $next[0].offsetWidth
                $active.addClass(direction)
                $next.addClass(direction)
                this.$element.one(this.transition.end, function () {
                    $next.removeClass([type, direction].join(' ')).addClass('active')
                    $active.removeClass(['active', direction].join(' '))
                    that.sliding = false
                    setTimeout(function () {
                        that.$element.trigger('jslid')
                    }, 0)
                })
            } else {
                this.$element.trigger(e)
                if (e.isDefaultPrevented()) return
                if (this.options.pager) {
                    $(this.options.pager).removeClass('sel').eq($next.index()).addClass('sel');
                }
                var that = this, end = 0, endFn = function () {
                        $active.removeClass('active')
                        $next.addClass('active')
                        $active.attr('style', null)
                        $next.attr('style', null)
                        that.sliding = false
                        that.$element.trigger('jslid')
                    },
                    chk4end = function () {
                        end++;
                        if (end == 2) {
                            endFn();
                        }
                    },
                    nextCss = {
                        display: 'block',
                        width: '100%',
                        position: 'absolute',
                        top: 0,
                        left: '100%'
                    },
                    nextOpt = {
                        left: '0'
                    },
                    actiOpt = {
                        left: '-100%'
                    },
                    commOpt = {
                        duration: 800,
                        complete: chk4end
                    };
                if (this.$element.hasClass('slide')) {
                    if (type == 'prev') {
                        nextCss.left = '-100%';
                        actiOpt.left = '100%';
                    } else if (type == 'next') {
                    }

                } else {
                    nextCss.left = 0;
                    nextCss.opacity = 0;
                    nextOpt = {
                        opacity: 1
                    }
                    actiOpt = {
                        opacity: 0
                    }
                }
                $next.css(nextCss).animate(nextOpt, commOpt);
                $active.animate(actiOpt, commOpt);
            }
            isCycling && this.cycle()
            return this
        }
    }

    $.fn.jcarousel = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('jcarousel'),
                options = $.extend({}, $.fn.jcarousel.defaults, typeof option == 'object' && option),
                action = typeof option == 'string' ? option : options.jslide
            if (!data) $this.data('jcarousel', (data = new JCarousel(this, options)))
            if (typeof action == 'number') data.to(action)
            else if (action) data[action]()
            else if (options.interval) data.cycle()
        })
    }

    $.fn.jcarousel.defaults = {
        interval: 5000,
        pause: 'hover'
    }

    $.fn.jcarousel.Constructor = JCarousel

    $(function () {
        $('body').on('click.jcarousel.data-api', '[data-jslide]', function (e) {
            var $this = $(this), href,
                $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')),
                options = !$target.data('modal') && $.extend({}, $target.data(), $this.data())
            $target.jcarousel(options)
            e.preventDefault()
        });
        $('[data-start-jcarousel]').each(function () {
            var $this = $(this), options = options = !$this.data('modal') && $.extend({}, $this.data());
            $this.jcarousel(options);
            $this.bind('jslide', function (e) {
                var index = $(this).find(e.relatedTarget).index();
                $('[data-jslide]').each(function () {
                    var $nav = $(this), $navData = $nav.data(), href, $target = $($nav.attr('data-target') || (href = $nav.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''));
                    if (!$target.is($this)) return;
                    if (typeof $navData.jslide == 'number' && $navData.jslide == index) {
                        $nav.addClass('sel');
                    } else {
                        $nav.removeClass('sel');
                    }
                });
            });
        });
    })
}(window.jQuery);