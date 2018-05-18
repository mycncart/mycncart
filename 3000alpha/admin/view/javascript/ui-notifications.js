$(document).ready(function(){

	/* =================================================================
		SweetAlert2
	================================================================= */

	$('.run-swal').on('click', function() {
		var type = $(this).data('type');
		if (type === 'basic') {
			swal({
				title: 'The Internet?',
				text: 'That thing is still around?',
				type: 'question',
				confirmButtonClass: 'btn btn-primary btn-lg',
				buttonsStyling: false
			});
		}
		if (type === 'auto-close') {
			swal({
				title: 'Auto close alert!',
				text: 'I will close in 2 seconds.',
				timer: 2000,
				confirmButtonClass: 'btn btn-primary btn-lg',
				buttonsStyling: false
			});
		}
		if (type === 'html') {
			swal({
				title: '<i>HTML</i> <u>example</u>',
				type: 'info',
				html:
					'You can use <b>bold text</b>, ' +
					'<a href="//github.com">links</a> ' +
					'and other HTML tags',
				showCloseButton: true,
				showCancelButton: true,
				confirmButtonText: 'Great!',
				confirmButtonClass: 'btn btn-primary btn-lg mr-1',
				cancelButtonClass: 'btn btn-danger btn-lg',
				buttonsStyling: false
			})
		}
		if (type === 'confirm') {
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				confirmButtonClass: 'btn btn-primary btn-lg mr-1',
				cancelButtonClass: 'btn btn-danger btn-lg',
				buttonsStyling: false
				}).then(function(isConfirm) {
				if (isConfirm) {
					swal({
						title: 'Deleted!',
						text: 'Your file has been deleted.',
						type: 'success',
						confirmButtonClass: 'btn btn-primary btn-lg',
						buttonsStyling: false
					});
				}
			})
		}
		if (type === 'cancel') {
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				confirmButtonClass: 'btn btn-primary btn-lg mr-1',
				cancelButtonClass: 'btn btn-danger btn-lg',
				buttonsStyling: false
				}).then(function(isConfirm) {
				if (isConfirm === true) {
					swal({
						title: 'Deleted!',
						text: 'Your file has been deleted.',
						type: 'success',
						confirmButtonClass: 'btn btn-primary btn-lg',
						buttonsStyling: false
					});
				} else if (isConfirm === false) {
					swal({
						title: 'Cancelled',
						text: 'Your imaginary file is safe :)',
						type: 'error',
						confirmButtonClass: 'btn btn-primary btn-lg',
						buttonsStyling: false
					});
				}
			})
		}
	});

	/* =================================================================
		Toastr
	================================================================= */

	$('.run-toast').on('click', function() {
		var type = $(this).data('type')
		if (type === 'info') {
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.info('Info!');
		}
		if (type === 'success') {
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.success('Success!');
		}
		if (type === 'warning') {
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.warning('Warning!');
		}
		if (type === 'danger') {
			toastr.options = {
				positionClass: 'toast-top-right'
			};
			toastr.error('Danger!');
		}
	});

});