$(document).ready(function() {
	
	/* Search */
	$('#filter-blog input[name=\'filter_blog\']').parent().find('button').on('click', function() {
		url = $('base').attr('href') + 'index.php?route=blog/all';

		var value = $('input[name=\'filter_blog\']').val();

		if (value) {
			url += '&filter_blog=' + encodeURIComponent(value);
		}

		location = url;
	});

	$('#filter-blog input[name=\'filter_blog\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			$('input[name=\'filter_blog\']').parent().find('button').trigger('click');
		}
	});


});
