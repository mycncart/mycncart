$(document).ready(function() {

	$('#world').vectorMap({
	    map: 'world_mill',
	    backgroundColor: '#fff',
	    regionStyle : {
	        initial : {
	          fill : '#3e70c9'
	        }
	    }
	});

	$('#europe').vectorMap({
	    map : 'europe_mill',
	    backgroundColor : 'transparent',
	    regionStyle : {
	        initial : {
	            fill : '#43b968'
	        }
	    }
	});

	$('#france').vectorMap({
	    map : 'fr_regions_2016_mill',
	    backgroundColor : 'transparent',
	    regionStyle : {
	        initial : {
	            fill : '#f59345'
	        }
	    }
	});

	$('#usa').vectorMap({
	    map : 'us_aea',
	    backgroundColor : 'transparent',
	    regionStyle : {
	        initial : {
	            fill : '#f44236'
	        }
	    }
	});

	$('#newyork').vectorMap({
	    map : 'us-ny-newyork_mill',
	    backgroundColor : 'transparent',
	    regionStyle : {
	        initial : {
	            fill : '#a567e2'
	        }
	    }
	});

});