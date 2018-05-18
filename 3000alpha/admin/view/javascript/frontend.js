$(document).ready(function(){

    var map = new GMaps({
      el: "#map",
	  lat: -12.043333,
	  lng: -77.028333,
	  scrollwheel: false,
      zoomControl : true,
      zoomControlOpt: {
        style : "SMALL",
        position: "TOP_LEFT"
      },
      panControl : true,
      streetViewControl : false,
      mapTypeControl: false,
      overviewMapControl: false
    });

	map.drawOverlay({
		lat: map.getCenter().lat(),
		lng: map.getCenter().lng(),
		layer: 'overlayLayer',
		content: '<div class="box-arrow bg-danger b-a-danger">1355 Market Street, Suite 900<br>San Francisco, CA 94103<span></span></div>',
		verticalAlign: 'top',
		horizontalAlign: 'center'
	});
    
    var styles = [
        {
          stylers: [
            { hue: "#333" },
            { saturation: -100 }
          ]
        }, {
            featureType: "road",
            elementType: "geometry",
            stylers: [
                { lightness: 100 },
                { visibility: "simplified" }
          ]
        }, {
            featureType: "road",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
          ]
        }
    ];
    
    map.addStyle({
        styledMapName:"Styled Map",
        styles: styles,
        mapTypeId: "map_style"  
    });
    
    map.setStyle("map_style");

	$(function () {
	    $(document).on('click', '.b-to-top', function () {
		    $('html, body').animate({
		        scrollTop: 0
		    }, 500);
		    return false;
	    });
	});

});