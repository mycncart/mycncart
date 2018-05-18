$(document).ready(function() {

	/* =================================================================
		Basic
	================================================================= */

    $('#exampleBasic').wizard({
        templates: {
            buttons: function(){
                var options = this.options;
                return '<div class="clearfix">' +
                    '<button class="btn btn-secondary" data-target="#'+this.id+'" data-wizard="back">'+options.buttonLabels.back+'</button>' +
                    '<button class="btn btn-primary float-right" data-target="#'+this.id+'" data-wizard="next">'+options.buttonLabels.next+'</button>' +
                    '<button class="btn btn-primary float-right" data-target="#'+this.id+'" data-wizard="finish">'+options.buttonLabels.finish+'</button>' +
                '</div>';
            }
        },
    });
	
	/* =================================================================
		Validation
	================================================================= */

    $('#exampleValidator').wizard({
        templates: {
            buttons: function(){
                var options = this.options;
                return '<div class="clearfix">' +
                    '<button class="btn btn-secondary" data-target="#'+this.id+'" data-wizard="back">'+options.buttonLabels.back+'</button>' +
                    '<button class="btn btn-primary float-right" data-target="#'+this.id+'" data-wizard="next">'+options.buttonLabels.next+'</button>' +
                    '<button class="btn btn-primary float-right" data-target="#'+this.id+'" data-wizard="finish">'+options.buttonLabels.finish+'</button>' +
                '</div>';
            }
        },
        onInit: function(){
            $('#validation').formValidation({
                framework: 'bootstrap',
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'The username is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'The username must be more than 6 and less than 30 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: 'The username can only consist of alphabetical, number, dot and underscore'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email address is required'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            different: {
                                field: 'username',
                                message: 'The password cannot be the same as username'
                            }
                        }
                    }
                }
            });
        },
        validator: function(){
            var fv = $('#validation').data('formValidation');

            var $this = $(this);

            // Validate the container
            fv.validateContainer($this);

            var isValidStep = fv.isValidContainer($this);
            if (isValidStep === false || isValidStep === null) {
                return false;
            }

            return true;
        },
        onFinish: function(){
            $('#validation').submit();
            alert('finish');
        }
    });

	/* =================================================================
		Tabs
	================================================================= */

    $('.wizard').wizard({
        step: '> .nav > li > a',
        templates: {
            buttons: function(){
                var options = this.options;
                return '<div class="clearfix">' +
                    '<button class="btn btn-default" data-target="#'+this.id+'" data-wizard="back">'+options.buttonLabels.back+'</button>' +
                    '<button class="btn btn-primary float-right" data-target="#'+this.id+'" data-wizard="next">'+options.buttonLabels.next+'</button>' +
                    '<button class="btn btn-primary float-right" data-target="#'+this.id+'" data-wizard="finish">'+options.buttonLabels.finish+'</button>' +
                '</div>';
            }
        },
        onBeforeShow: function(step){
            step.$element.tab('show');
        },

        onFinish: function(){
            alert('finish');
        }
    });

});