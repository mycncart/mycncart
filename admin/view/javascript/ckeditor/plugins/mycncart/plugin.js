CKEDITOR.plugins.add('mycncart', {
	init: function(editor) {
		editor.addCommand('MyCnCart', {
			exec: function(editor) {
				$.ajax({
					url: 'index.php?route=common/filemanager&user_token=' + getURLVar('user_token') + '&ckeditor=' + editor.name,
					dataType: 'html',
					success: function(html) {
						$('body').append(html);

						$('#modal-image').modal('show');
					}
				});
			}
		});

		editor.ui.addButton('MyCnCart', {
			label: 'MyCnCart',
			command: 'MyCnCart',
			icon: this.path + 'images/icon.png'
		});
	}
});