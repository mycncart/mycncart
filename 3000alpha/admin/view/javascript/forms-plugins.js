$(document).ready(function(){

	/* =================================================================
		Select2
	================================================================= */

	$('[data-plugin="select2"]').select2($(this).attr('data-options'));
	

	/* =================================================================
		Switchery
	================================================================= */
 	
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	$('.js-switch').each(function() {
		new Switchery($(this)[0], $(this).data());
	});

	/* =================================================================
		Multi Select
	================================================================= */
 	
    $('#pre-selected-options').multiSelect();

    $('#optgroup').multiSelect({ selectableOptgroup: true });

	/* =================================================================
		TouchSpin
	================================================================= */

	$("input[name='demo1']").TouchSpin({
	    min: 0,
	    max: 100,
	    step: 0.1,
	    decimals: 2,
	    boostat: 5,
	    maxboostedstep: 10,
	    postfix: '%',
	    buttondown_class: "btn btn-secondary",
        buttonup_class: "btn btn-secondary"
	});


	$("input[name='demo2']").TouchSpin({
	    min: -1000000000,
	    max: 1000000000,
	    stepinterval: 50,
	    maxboostedstep: 10000000,
	    prefix: '$',
	    buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
	});

    $("input[name='demo_vertical']").TouchSpin({
    	verticalbuttons: true,
	    buttondown_class: "btn btn-secondary",
        buttonup_class: "btn btn-secondary",
      	verticalupclass: 'ti-plus',
      	verticaldownclass: 'ti-minus'
    });

	/* =================================================================
		Maxlength
	================================================================= */

    $('input[maxlength]').maxlength({
		warningClass: "tag tag-success",
		limitReachedClass: "tag tag-danger",
    });

	$('textarea#textarea').maxlength({
		alwaysShow: true,
		warningClass: "tag tag-success",
		limitReachedClass: "tag tag-danger",
	});

	$('input#placement').maxlength({
        alwaysShow: true,
        placement: 'top-left',
		warningClass: "tag tag-success",
		limitReachedClass: "tag tag-danger",
    });

});