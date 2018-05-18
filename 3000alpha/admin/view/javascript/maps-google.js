$(document).ready(function(){

	/* =================================================================
	    Default
	================================================================= */

	map = new GMaps({
		el: '#default',
		lat: -12.043333,
		lng: -77.028333,
		zoomControl : true,
		zoomControlOpt: {
				style : 'SMALL',
				position: 'TOP_LEFT'
		},
		panControl : false,
		streetViewControl : false,
		mapTypeControl: false,
		overviewMapControl: false
	});

	/* =================================================================
	    Styled
	================================================================= */

    var map = new GMaps({
      el: "#styled",
      lat: 41.895465,
      lng: 12.482324,
      zoom: 5, 
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
    
    var styles = [
        {
          stylers: [
            { hue: "#43b968" },
            { saturation: -40 }
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

	/* =================================================================
	    Routes
	================================================================= */

	map = new GMaps({
		el: '#routes',
		lat: -12.043333,
		lng: -77.028333
	});
	map.drawRoute({
		origin: [-12.044012922866312, -77.02470665341184],
		destination: [-12.090814532191756, -77.02271108990476],
		travelMode: 'driving',
		strokeColor: '#131540',
		strokeOpacity: 0.6,
		strokeWeight: 6
	});

	/* =================================================================
	    Overlays
	================================================================= */

	map = new GMaps({
		el: '#overlays',
		lat: -12.043333,
		lng: -77.028333
	});
	map.drawOverlay({
		lat: map.getCenter().lat(),
		lng: map.getCenter().lng(),
		layer: 'overlayLayer',
		content: '<div class="box-arrow bg-danger b-a-danger">Lima<span></span></div>',
		verticalAlign: 'top',
		horizontalAlign: 'center'
	});

});