var validation_name = '';
var validation_email = '';
var validation_vemail = '';
var validation_subject = '';
var validation_message = '';

function resetForm(id) {
	jQuery('#' + id).each(function() {
		this.reset();
	});
	if (jQuery('.error-message').is(':visible')) {
		jQuery('.error-message').slideUp(800);
	}
}

function isValidEmail(email) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) {
		return false;
	} else {
		return true;
	}
}





