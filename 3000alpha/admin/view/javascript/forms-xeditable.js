$(function(){

    $.fn.editableform.buttons = 
    '<button type="submit" class="btn btn-primary editable-submit waves-effect waves-light"><i class="ti-check"></i></button>' +
    '<button type="button" class="btn editable-cancel btn-secondary waves-effect"><i class="ti-close"></i></button>';


	$('#inline-username').editable({
		type: 'text',
		pk: 1,
		name: 'username',
		title: 'Enter username',
		mode: 'inline'
	});
    
	$('#inline-firstname').editable({
		validate: function(value) {
			if($.trim(value) == '') return 'This field is required';
		},
		mode: 'inline'
    });
    
    $('#inline-sex').editable({
		prepend: "not selected",
		mode: 'inline',
		source: [
			{value: 1, text: 'Male'},
			{value: 2, text: 'Female'}
		],
		display: function(value, sourceData) {
			var colors = {"": "#98a6ad", 1: "#5fbeaa", 2: "#5d9cec"},
			elem = $.grep(sourceData, function(o){return o.value == value;});

			if(elem.length) {
				$(this).text(elem[0].text).css("color", colors[value]);
			} else {
				$(this).empty();
			}
		}
   	});
    
    
    $('#inline-group').editable({
		showbuttons: false,
		mode: 'inline'
    });

    $('#inline-dob').editable({mode: 'inline'});

    $('#inline-comments').editable({
		showbuttons: 'bottom',
		mode: 'inline'
    });

  });