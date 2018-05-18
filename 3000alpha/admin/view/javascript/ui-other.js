$(document).ready(function(){
	
	/* =================================================================
		Colored tooltips
	================================================================= */

	$('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
		id = $(this).attr('aria-describedby')
		color = $(this).attr('data-color');
		$('.tooltip#' + id).addClass(color);
	})

});