$(document).ready(function(){

    if(!jQuery.browser.mobile) {
      $('.animate').each(function () {
          var $curr = $(this);
          $curr.css('opacity', '0');
          $curr.bind('animt', function () {
            $curr.css('opacity', '');
            $curr.addClass($curr.data('gen'));
          });
      });

      $('.animate').each(function () {
          var $curr = $(this);
          var $currOffset = $curr.attr('data-gen-offset');
          if ($currOffset === '' || $currOffset === 'undefined' || $currOffset === undefined) {
            $currOffset = 'bottom-in-view';
          }
          $curr.waypoint(function () {
            $curr.trigger('animt');
          }, {
            triggerOnce: true,
            offset: $currOffset
          });
      });
    }

});