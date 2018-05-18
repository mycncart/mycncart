$(document).ready(function(){

	map = new GMaps({
		el: '#map',
		lat: -12.043333,
		lng: -77.028333
	});
	map.drawOverlay({
		lat: map.getCenter().lat(),
		lng: map.getCenter().lng(),
		layer: 'overlayLayer',
		content: '<div class="box-arrow bg-danger b-a-danger">Welcome!<span></span></div>',
		verticalAlign: 'top',
		horizontalAlign: 'center'
	});

});