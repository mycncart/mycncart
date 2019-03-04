jQuery(document).ready(function($) {

    $('.yt-flickr-lightbox').each(function() {
        // Lightbox for galleries (slider, carousel, custom_gallery)
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            mainClass: 'mfp-zoom-in mfp-img-mobile',
            closeBtnInside: false,
            tLoading: '', // remove text from preloader
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
                        self.wrap.removeClass('mfp-image-loaded');
                        setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
                    }
                    $.magnificPopup.instance.prev = function() {
                        var self = this;
                        self.wrap.removeClass('mfp-image-loaded');
                        setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
                    }
                },
                imageLoadComplete: function() {
                    var self = this;
                    setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
                }
            }
        });
    });
});