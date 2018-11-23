(function($) {
	$.fn.mcc_page_builder = function(datajson) {
	/* Default Config */
	var maxWidth = '100%';
	var minWidth = '8.3333';
	var countColumn = '12';
	var screenActive = 'lg_col';
	var initDataRow = function () {
		this.text_class_id			= 'row_'+randString(4);
		this.text_class   			= 'row-style';
		this.text_color 			= '#000000';
		this.link_color 			= '#000000';
		this.link_hover_color 		= '#000000';
		this.heading_color 			= '#000000';
		this.background_type 		= 0;
		this.bg_color 				= '#FFFFFF';
		this.bg_opacity 			= '100%';
		this.bg_image 				= '';
		this.bg_repeat 				= 'no-repeat';
		this.bg_position 			= 'center center';
		this.bg_attachment 			= 'fixed';
		this.bg_scale 				= 'cover';
		this.video_type 			= 0;
		this.link_video 			= 'YE7VzlLtp-4';
		this.margin 				= '';
		this.padding 				= '';
		this.row_container_fluid	= 0;
		this.row_section 			= 0;
		this.row_section_class 		= 'section-style';
		this.row_section_id 		= '';
		this.section_background_type = 0;
		this.section_bg_color 		= '#FFFFFF';
		this.section_bg_opacity 	= '100%';
		this.section_bg_image 		= '';
		this.section_bg_repeat 		= 'no-repeat';
		this.section_bg_position 	= 'center center';
		this.section_bg_attachment 	= 'fixed';
		this.section_bg_scale 		= 'cover';
		this.section_video_type 	= 0;
		this.section_link_video 	= 'YE7VzlLtp-4';
	}
	var initDataRowChild = function () {
		this.text_class_id			= 'row_'+randString(4);
		this.text_class   			= 'row-style';
		this.text_color 			= '#000000';
		this.link_color 			= '#000000';
		this.link_hover_color 		= '#000000';
		this.heading_color 			= '#000000';
		this.background_type 		= 0;
		this.bg_color 				= '#FFFFFF';
		this.bg_opacity 			= '100%';
		this.bg_image 				= '';
		this.bg_repeat 				= 'no-repeat';
		this.bg_position 			= 'center center';
		this.bg_attachment 			= 'fixed';
		this.bg_scale 				= 'cover';
		this.video_type 			= 0;
		this.link_video 			= 'YE7VzlLtp-4';
		this.margin 				= '';
		this.padding 				= '';
	}
	var initDataCol = function () {
		this.text_class_id 			= 'col_'+randString(4);
		this.text_class 			= 'col-style';
		this.text_color 			= '#000000';
		this.link_color 			= '#000000';
		this.link_hover_color 		= '#000000';
		this.heading_color 			= '#000000';
		this.background_type 		= 0;
		this.bg_color 				= '#FFFFFF';
		this.bg_opacity 			= '100%';
		this.bg_image 				= '';
		this.bg_repeat 				= 'no-repeat';
		this.bg_position 			= 'center center';
		this.bg_attachment 			= 'fixed';
		this.bg_scale 				= 'cover';
		this.col_video_type 		= 0;
		this.col_link_video 		= 'YE7VzlLtp-4';
		
		this.padding 				= '';
		this.margin  				= '';
		this.lg_col 				= 4;
		this.md_col 				= 4;
		this.sm_col 				= 6;
		this.xs_col 				= 12; 
	}
	/* Prepare data */
	var $generator = $('#yt-generator'),
		$search = $('#yt-generator-search'),
		$filter = $('#yt-generator-filter'),
		$filters = $filter.children('a'),
		$choices = $('.yt-generator-choices'),
		$choice = $choices.find('div.mcc-page-widget'),
		$listShortcode = $('.wpo-widgetslist'),
		$settingsC = $('.wpo-widgetform','#config_shortcode');
		$settingsE = $('.wpo-widgetform','#edit_shortcode');
		$bodyModal = $('.modal-dialog .modal-content .modal-body');
	window.setTimeout(function () {
			$search.focus();
		}, 200);
	/* Filters */
	$filters.click(function (e) {
		/* Prepare data */ 
		var filter = $(this).data('filter');
		$filters.css("background","#1a3867");
		$(this).css("background","#0d264e");
		/* If filter All, show all choices */ 
		if (filter === 'all') $choice.css({
			opacity: 1
		})
		/* Else run search */ 
		else {
			var regex = new RegExp(filter, 'gi');
			/* Hide all choices */ 
			$choice.css({
				opacity: 0.2
			});
			/* Find searched choices and show */ 
			$choice.each(function () {
				/* Get shortcode name */ 
				var group = $(this).data('group');
				/* Show choice if matched */ 
				if (group.match(regex) !== null) $(this).css({
					opacity: 1
				})
			});
		}
		/* Hide button back to list*/
		$('#config_shortcode .modal-footer').find('button.yt-generator-home').addClass('hidden');
		/* Hide button save change*/
		$('#config_shortcode .modal-footer').find('button.submit').addClass('hidden');
		$('#config_shortcode .modal-footer').find('button.submit-save').addClass('hidden');
		e.preventDefault();
	});
	
	/* Search field */
	$search.on({
		focus: function () {
			/* Clear field */ 
			$(this).val('');
			/* Hide settings */ 
			$settingsC.html('').hide(500);
			$settingsE.html('').hide(500);
			/* Remove narrow class */ 
			$generator.removeClass('yt-generator-narrow');
			/* Show choices panel */ 
			$choices.show(500);
			$choice.css({
				opacity: 1
			})
			/* Show filters */ 
			$filter.show(500);
			$listShortcode.show(500);
			/* Hide button back to list*/
			$('#config_shortcode .modal-footer').find('button.yt-generator-home').addClass('hidden');
			/* Hide button save change*/
			$('#config_shortcode .modal-footer').find('button.submit').addClass('hidden');
			$('#config_shortcode .modal-footer').find('button.submit-save').addClass('hidden');
		},
		blur: function () {},
		keyup: function (e) {
			var $first = $('.yt-generator-choice-first:first'),
				val = $(this).val(),
				regex = new RegExp(val, 'gi');
			/* Hotkey action */ 
			if (e.keyCode === 13 && $first.length > 0) {
				e.preventDefault();
				$(this).val('').blur();
				$first.trigger('click');
			}
			/* Hide all choices */ 
			$choice.css({
				opacity: 0.2
			}).removeClass('yt-generator-choice-first');
			/* Find searched choices and show */ 
			$choice.each(function () {
				/*  Get shortcode name */
				var id = $(this).data('shortcode'),
					name = $(this).data('name'),
					desc = $(this).data('desc'),
					group = $(this).data('group');
				/* Show choice if matched */ 
				if ((id + name + desc + group).match(regex) !== null) {
					$(this).css({
						opacity: 1
					})
					if (val === id || val === name || val === name.toLowerCase()) {
						$(this).addClass('yt-generator-choice-first');
					}
				}
			});
		}
	});
	
	/* Go to home link */
	$('#config_shortcode').on('click', '.yt-generator-home', function (e) {
		/* Clear search field */ 
		$search.val('');
		/* Hide settings */ 
		$settingsC.html('').hide();
		$settingsE.html('').hide();
		$choices.css("display","block");
		/* Show filters */ 
		$filter.show();
		/* Show choices panel */ 
		$choices.show();
		$choice.show();
		
		/* Focus search field */ 
		$search.focus();
		e.preventDefault();
		$listShortcode.show();
		/* Hide button back to list*/
		$('#config_shortcode .modal-footer').find('button.yt-generator-home').addClass('hidden');
		/* Hide button save change*/
		$('#config_shortcode .modal-footer').find('button.submit').addClass('hidden');
		$('#config_shortcode .modal-footer').find('button.submit-save').addClass('hidden');
	});
	
	/* Change Color */
	function changeColor(item){
		$("."+item+"-text-color").each(function (index) {
			$(this).find("."+item+"-text-color-wheel").filter(":first").farbtastic("."+item+"-text-color-value:eq(" + index + ")");
			$(this).find("."+item+"-text-color-value").focus(function () {
				$("."+item+"-text-color-wheel:eq(" + index + ")").show();
			});
			$(this).find("."+item+"-text-color-value").blur(function () {
				$("."+item+"-text-color-wheel:eq(" + index + ")").hide();
			});
		});
		$("."+item+"-link-color").each(function (index) {
			$(this).find("."+item+"-link-color-wheel").filter(":first").farbtastic("."+item+"-link-color-value:eq(" + index + ")");
			$(this).find("."+item+"-link-color-value").focus(function () {
				$("."+item+"-link-color-wheel:eq(" + index + ")").show();
			});
			$(this).find("."+item+"-link-color-value").blur(function () {
				$("."+item+"-link-color-wheel:eq(" + index + ")").hide();
			});
		});
		$("."+item+"-link-hover-color").each(function (index) {
			$(this).find("."+item+"-link-hover-color-wheel").filter(":first").farbtastic("."+item+"-link-hover-color-value:eq(" + index + ")");
			$(this).find("."+item+"-link-hover-color-value").focus(function () {
				$("."+item+"-link-hover-color-wheel:eq(" + index + ")").show();
			});
			$(this).find("."+item+"-link-hover-color-value").blur(function () {
				$("."+item+"-link-hover-color-wheel:eq(" + index + ")").hide();
			});
		});
		$("."+item+"-heading-color").each(function (index) {
			$(this).find("."+item+"-heading-color-wheel").filter(":first").farbtastic("."+item+"-heading-color-value:eq(" + index + ")");
			$(this).find("."+item+"-heading-color-value").focus(function () {
				$("."+item+"-heading-color-wheel:eq(" + index + ")").show();
			});
			$(this).find("."+item+"-heading-color-value").blur(function () {
				$("."+item+"-heading-color-wheel:eq(" + index + ")").hide();
			});
		});
		$("."+item+"-bg-color").each(function (index) {
			$(this).find("."+item+"-bg-color-wheel").filter(":first").farbtastic("."+item+"-bg-color-value:eq(" + index + ")");
			$(this).find("."+item+"-bg-color-value").focus(function () {
				$("."+item+"-bg-color-wheel:eq(" + index + ")").show();
			});
			$(this).find("."+item+"-bg-color-value").blur(function () {
				$("."+item+"-bg-color-wheel:eq(" + index + ")").hide();
			});
		});
	}
	
	/* Change Slider*/
	function changeSlider(){
		$(".yt-generator-range-picker").each(function (index) {	
			var $picker = $(this),
				$val = $picker.find("input"),
				min = $val.attr("min"),
				max = $val.attr("max"),
				step = $val.attr("step");
			/* Apply noUIslider */ 
			$val.simpleSlider({
				snap: true,
				step: step,
				range: [min, max],
				setValue: $val.val()
			});
			$val.attr("type", "text").show();
			$val.on("keyup blur", function (e) {
				$val.simpleSlider("setValue", $val.val());
			});
		});
	}
	
	/* Change switches */
	function changeBool(){
		$('.yt-generator-switch').unbind('click').click(function (index) {
		/* Prepare data */ 
			var $switch = $(this),
				$value = $switch.parent().children("input"),
				is_on = $value.val() === "yes";
			/* Disable */ 
			if (is_on) {
				/* Change value */ 
				$value.val("no").trigger("change");
			}
			/* Enable */ 
			else {
				/* Change value */ 
				$value.val("yes").trigger("change");
			}
		});
		$('.yt-generator-switch-value').on('change', function () {
			/* Prepare data */ 
			var $value = $(this),
				$switch = $value.parent().children(".yt-generator-switch"),
				value = $value.val();
			/* Disable */ 
			if (value === "yes") $switch.removeClass("yt-generator-switch-no").addClass("yt-generator-switch-yes");
			/* Enable */ 
			else if (value === "no") $switch.removeClass("yt-generator-switch-yes").addClass("yt-generator-switch-no");
		});
	}
	
	/* Change Color Shortcode */
	function changeColorShortcode(){
		$(".yt-generator-select-color").each(function (index) {
			$(this).find(".yt-generator-select-color-wheel").filter(":first").farbtastic(".yt-generator-select-color-value:eq(" + index + ")");
			$(this).find(".yt-generator-select-color-value").focus(function () {
				$(".yt-generator-select-color-wheel:eq(" + index + ")").show();
			});
			$(this).find(".yt-generator-select-color-value").blur(function () {
				$(".yt-generator-select-color-wheel:eq(" + index + ")").hide();
			});
		});
	}
	
	/* Change Icon*/
	function changeIcon(){
		$(".yt-generator-icon-picker-button").each(function () {
			var $button = $(this),
				$field = $(this).parents(".yt-generator-field-container"),
				$val = $field.find(".yt-generator-attr"),
				$picker = $field.find(".yt-generator-icon-picker"),
				$filter = $picker.find("input:text"),
				$ht =0;
			$button.click(function (e) {
				if($ht ==0)
				{
					$ht =1;
					$picker.addClass("yt-generator-icon-picker-visible");
				}else
				{
					$ht =0;
					$picker.removeClass("yt-generator-icon-picker-visible");
					
				}
			});
			var $icons = $picker.children("i");
			$icons.click(function (e) {
				$val.val("icon: " + $(this).attr("title"));
				$picker.removeClass("yt-generator-icon-picker-visible");
				$val.trigger("change");
				e.preventDefault();
				$ht =0;
			});
			$filter.on({
				keyup: function () {
					var val = $(this).val(),
						regex = new RegExp(val, "gi");
					/* Hide all choices */ 
					$icons.hide();
					/* Find searched choices and show */ 
					$icons.each(function () {
						/* Get shortcode name */ 
						var name = $(this).attr("title");
						/* Show choice if matched */ 
						if (name.match(regex) !== null) $(this).show();
					});
				},
				focus: function () {
					$(this).val("");
					$icons.show();
				}
			});
		});
		}
				
	/* Change border*/
	function changeBorder(){
		$(".yt-generator-border-picker").each(function (index) {
			var $picker = $(this),
				$fields = $picker.find(".yt-generator-border-picker-field input, .yt-generator-border-picker-field select"),
				$width = $picker.find(".yt-generator-bp-width"),
				$style = $picker.find(".yt-generator-bp-style"),
				$color = {
					cnt: $picker.find(".yt-generator-border-picker-color"),
					value: $picker.find(".yt-generator-border-picker-color-value"),
					wheel: $picker.find(".yt-generator-border-picker-color-wheel")
				},
				$val = $picker.find(".yt-generator-attr");
			/* Init color picker */ 
			$color.wheel.farbtastic($color.value);
			$color.value.focus(function () {
				$color.wheel.show();
			});
			$color.value.blur(function () {
				$color.wheel.hide();
			});
			/* Handle text fields */ 
			$fields.on("change blur keyup", function () {
				$val.val($width.val() + "px " + $style.val() + " " + $color.value.val()).trigger("change");
			});
			$val.on("keyup", function () {
				var value = $(this).val().split(" ");
				/* Value is correct */ 
				if (value.length === 3) {
					$width.val(value[0].replace("px", ""));
					$style.val(value[1]);
					$color.value.val(value[2]);
					$fields.trigger("keyup");
				}
			});
		});
	}
	
	/* Change Shadow*/
	function changeShadow(){
		$(".yt-generator-shadow-picker").each(function (index) {
			var $picker = $(this),
				$fields = $picker.find(".yt-generator-shadow-picker-field input"),
				$hoff = $picker.find(".yt-generator-sp-hoff"),
				$voff = $picker.find(".yt-generator-sp-voff"),
				$blur = $picker.find(".yt-generator-sp-blur"),
				$color = {
					cnt: $picker.find(".yt-generator-shadow-picker-color"),
					value: $picker.find(".yt-generator-shadow-picker-color-value"),
					wheel: $picker.find(".yt-generator-shadow-picker-color-wheel")
				},
				$val = $picker.find(".yt-generator-attr");
			/* Init color picker */ 
			$color.wheel.farbtastic($color.value);
			$color.value.focus(function () {
				$color.wheel.show();
			});
			$color.value.blur(function () {
				$color.wheel.hide();
			});
			/* Handle text fields */ 
			$fields.on("change blur keyup", function () {
				$val.val($hoff.val() + "px " + $voff.val() + "px " + $blur.val() + "px " + $color.value.val()).trigger("change");
			});
			$val.on("keyup", function () {
				var value = $(this).val().split(" ");
				/* Value is correct */ 
				if (value.length === 4) {
					$hoff.val(value[0].replace("px", ""));
					$voff.val(value[1].replace("px", ""));
					$blur.val(value[2].replace("px", ""));
					$color.value.val(value[3]);
					$fields.trigger("keyup");
				}
			});
		});
	}
	
	/*Init Source*/
	function initSource(){
		$(".yt-generator-isp").each(function () {
			var $picker = $(this),
				$sources = $picker.find(".yt-generator-isp-sources"),
				$source = $picker.find(".yt-generator-isp-source"),
				$add_media = $picker.find(".yt-generator-isp-add-media"),
				$images = $picker.find(".yt-generator-isp-images"),
				$cats = $picker.find(".yt-generator-isp-categories"),
				$terms = $(".yt-generator-isp-terms"),
				$val = $picker.find(".yt-generator-attr"),
				frame;
			/* Update hidden value */ 
		
			var update = function () {
				var val = "none",
					ids = "",
					source = $sources.val();
				/* Media library */ 
				if (source === "media") {
					var images = [];
					$images.find("input[name='media_image{}']").each(function (i) {
						images[i] = $(this).val();
					});
					if (images.length > 0) ids = images.join(",");
				}
				/* Category */ 
				else if (source === "category") {
					var categories = $cats.val() || [];
					if (categories.length > 0) ids = categories.join(",");
				}
				/* Deselect */ 
				else if (source === "0") {
					val = "none";
				}
				/* Other options */ 
				else {
					val = source;
				}
				if (ids !== "") val = source + ": " + ids;
				$val.val(val).trigger("change");
			}
			update();
			/* Switch source */ 
			$sources.on("change", function (e) {
				var source = $(this).val();
				e.preventDefault();
				$source.removeClass("yt-generator-isp-source-open");
				if (source.indexOf(":") === -1) $picker.find(".yt-generator-isp-source-" + source).addClass("yt-generator-isp-source-open");
				update();
			});
			/* Remove image */ 
			$images.on("click", "span i", function () {
				$(this).parent("span").css("border-color", "#f03").fadeOut(300, function () {
					$(this).remove();
					update();
				});
			});
			/* Select categories and terms */ 
			$cats.on("change", update);
		});
	}
	
	/*Init image sourse pickers */ 
	function initImageSource(){
		$(".yt-generator-isp").each(function () {
			var $picker = $(this),
				$sources = $picker.find(".yt-generator-isp-sources"),
				$source = $picker.find(".yt-generator-isp-source"),
				$add_media = $picker.find(".yt-generator-isp-add-media"),
				$images = $picker.find(".yt-generator-isp-images"),
				$val = $picker.find(".yt-generator-attr"),
				frame;
			/* Update hidden value */ 
			var update = function () {
				var val = "none",
					ids = "",
					source = $sources.val();
				var images = [];
				$images.find("input[name='media_image{}']").each(function (i) {
					images[i] = $(this).val();
				});
				if (images.length > 0) ids = images.join(",");	
				if (ids !== "") val = "media: " + ids;
				$val.val(val).trigger("change");
			}
			update();
			/* Remove image */ 
			$images.on("click", "span i", function () {
				$(this).parent("span").css("border-color", "#f03").fadeOut(300, function () {
					$(this).remove();
					update();
				});
			});
		});
	}
	
	/* Init product sourcee pickers*/
	function initProductSource(){
		$(".yt-generator-isp").each(function () {
			var $picker = $(this),
				$sources = $picker.find(".yt-generator-isp-sources"),
				$source = $picker.find(".yt-generator-isp-source"),
				$cats = $picker.find(".yt-generator-isp-categories"),
				$terms = $(".yt-generator-isp-terms"),
				$val = $picker.find(".yt-generator-attr"),
				frame;
			/* Update hidden value */ 
		
			var update = function () {
				var val = "none",
					ids = "",
					source = $sources.val();
				
				var categories = $cats.val() || [];
				if (categories.length > 0) ids = categories.join(",");
				if (ids !== "") val = "category: " + ids;
				$val.val(val).trigger("change");
			}
			update();
			/* Select categories and terms */ 
			$cats.on("change", update);
		});
	}
	
	/* Override summernotes image manager */
	function overrideSummernotes(){
		$(".summernote").each(function(){
			var element = this;
			$(element).summernote({
				disableDragAndDrop: true,
				height: 300,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['fontname', ['fontname']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'image', 'video']],
					['view', ['fullscreen', 'codeview', 'help']]
				],
				buttons: {
					image: function() {
						var ui = $.summernote.ui;

						// create button
						var button = ui.button({
							contents: '<i class="fas fa-image" />',
							tooltip: $.summernote.lang[$.summernote.options.lang].image.image,
							click: function () {
								$('#modal-image').remove();
							
								$.ajax({
									url: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
									dataType: 'html',
									beforeSend: function() {
										$('#button-image i').replaceWith('<i class="fas fa-circle-o-notch fa-spin"></i>');
										$('#button-image').prop('disabled', true);
									},
									complete: function() {
										$('#button-image i').replaceWith('<i class="fas fa-upload"></i>');
										$('#button-image').prop('disabled', false);
									},
									success: function(html) {
										$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
										
										$('#modal-image').modal('show');
										
										$('#modal-image').delegate('a.thumbnail', 'click', function(e) {
											e.preventDefault();
											
											$(element).summernote('insertImage', $(this).attr('href'));
																		
											$('#modal-image').modal('hide');
										});
									}
								});						
							}
						});
					
						return button.render();
					}
				}
			});
		});
	}
	
	/* Remove Html in Title*/
	function removeHtml(html){
	   var tmp = document.createElement("div");
	   tmp.innerHTML = html;
	   return tmp.textContent || tmp.innerText || "";
	}
	
	/* Js for Shortcode*/
	function jsShortcode(){
		/* Show hide element */
		$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').each(function (){
			var group = $(this).data('group');
			/* Show choice if matched */ 
			if (group =="all" || group == $(".yt_shortcodes_wrap_form_element #yt-generator-attr-type_change").val() || group == $(".yt_shortcodes_wrap_form_element .yt-generator-isp-sources")){
				$(this).show();
			}else{
				$(this).hide();
			}
		});	
		$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').each(function () {
			var group = $(this).data('group');
			/* Show choice if matched */ 
			if (group =="all" || group == $(".yt_shortcodes_wrap_form_element #yt-generator-attr-type_change").val() || group == $(".yt_shortcodes_wrap_form_element .yt-generator-isp-sources").val())
			{
				$(this).show();
			}else{
				$(this).hide();
			}
		});
		$("#yt-generator-attr-type_change").change(function(){
			var change = $(this).val();
			var regex = new RegExp(change, 'gi');
			/* Hide all choices */ 
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').hide();
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').hide();
			/* Find searched choices and show */ 
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').each(function () {
				/* Get shortcode name */ 
				var group = $(this).data('group');
				/* Show choice if matched */ 
				if (group.match(regex) !== null || group =="all") 
				$(this).show();
			});
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').each(function () {
				/* Get shortcode name */ 
				var group = $(this).data('group');
				/* Show choice if matched */ 
				if (group.match(regex) !== null || group =="all") 
				$(this).show();
			});
		});
		$(".yt-generator-isp-sources").change(function(){
			var change = $(this).val();
			var regex = new RegExp(change, 'gi');
			/* Hide all choices */ 
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').hide();
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').hide();
			/* Find searched choices and show */ 
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').each(function () {
				/* Get shortcode name */ 
				var group = $(this).data('group');
				/* Show choice if matched */ 
				if (group.match(regex) !== null || group =="all") 
				$(this).show();
			});
			$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').each(function () {
				/* Get shortcode name */ 
				var group = $(this).data('group');
				/* Show choice if matched */ 
				if (group.match(regex) !== null || group =="all") 
				$(this).show();
			});
		});
	}
	
	/* Init all Js for shortcode*/
	function initAllJsShortcode(){
		changeSlider();
		changeBool();
		changeColorShortcode();
		changeIcon();
		changeBorder();
		changeShadow();
		initSource();
		overrideSummernotes();
		addImage();
		jsShortcode();
		/* Click tab show all tab & tab content*/
		$("ul.language li").click(function(){ 
			var hrefTab = $(this).find("a").attr("href");
			$("a[href$='"+hrefTab+"']").parent().parent().find("li").removeClass("active");
			$("a[href$='"+hrefTab+"']").parent().addClass("active");
			$("a[href$='"+hrefTab+"']").parent().parent().next(".tab-content").find(".tab-pane").removeClass("active");
			$(".tab-content .tab-pane"+hrefTab+"").addClass("active");
			
		});
	}
	
	/* Click button Add Widget*/
	function createWidget(){
		$("#config_shortcode .shortcode-item").unbind( 'click');
		$("#config_shortcode .shortcode-item").bind( 'click', function(){ 
			/* Show button back to list */
			$('#config_shortcode .modal-footer').find('button.yt-generator-home').removeClass('hidden');
			/* Show button save change*/
			$('#config_shortcode .modal-footer').find('button.submit').removeClass('hidden');
			$('#config_shortcode .modal-footer').find('button.submit-save').removeClass('hidden');
			var shortcode = $(this).attr("data-shortcode");
			var desc = $(this).attr("data-desc");
			var name = $(this).attr("data-name");
			var content 	= '';
			var ajax_url = window.location.href;
			$.ajax({
				type: "POST",
				url: ajax_url,
				data: {
					get_form_shortcodes: 1,
					shortcode: shortcode,
					desc :desc,
					name :name,
					content :content
				},
				beforeSend: function () {
					$filter.hide(500);
					$listShortcode.hide(500);
					$bodyModal.addClass('yt-generator-loading');
				},
				success: function (data) {
					$settingsC.html(data["html"]);
					$settingsC.show();
					$bodyModal.removeClass('yt-generator-loading');
					initAllJsShortcode();
				},
				dataType: "json"
			});
		});
	}
	
	/* Click button delete Widget*/
	function deleteWidget(mod){
		$(".mcc-page-wdelete",mod).click( function(){
			/* Add Class Active for Column*/
			$(".mcc-page-col",$pagebuilder).removeClass("active");
			$(this).parent().parent().parent().parent().parent().parent('.mcc-page-col').addClass('active');
			/* Delete widget*/
			if(confirm(textDelete)){ 
				$(this).parent().parent('.mcc-page-widget').remove();
			}
		} );
	}
	
	/* Click button Edit Widget*/
	function editWidget(mod){
		$(".mcc-page-wedit",mod).unbind( 'click');
		$(".mcc-page-wedit",mod).bind( 'click', function(){
			/* Add Class Active for Column*/
			$(".mcc-page-col",$pagebuilder).removeClass("active");
			$(this).parent().parent().parent().parent().parent().parent('.mcc-page-col').addClass('active');
			$('.textarea.hidden-content-shortcode').removeClass('active');
			$('.w-inner').removeClass('active');
			$("textarea.hidden-content-shortcode,.w-inner",$pagebuilder).removeClass("active");
			$(this).parent().parent().find('textarea.hidden-content-shortcode').addClass('active');
			$(this).parent().parent().find('.w-inner').addClass('active');
			var type 		= $(this).parent().parent(".mcc-page-widget").attr("data-type");
			if(type=="module"){
				var html  = '<iframe id="ifmEditModule" src="'+$(this).data('href')+'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe>';
				$( "#edit_module" ).modal({
					backdrop :"static",
					keyboard :false
				});
				$("#edit_module .modal-body").html(html);
				$("#edit_module .modal-body").css("height","400px");
				$("#ifmEditModule").load( function(){
			 		$('#ifmEditModule').contents().find("#header").remove();
			 		$('#ifmEditModule').contents().find("#column-left").remove();
			 		$('#ifmEditModule').contents().find("#footer").remove();
	 			} );
			}else{
				/* Edit Shortcode*/
				var shortcode 	= $(this).parent().parent(".mcc-page-widget").attr('data-shortcode');
				var desc 		= $(this).parent().parent(".mcc-page-widget").attr("data-desc");
				var name 		= $(this).parent().parent(".mcc-page-widget").attr("data-name");
				var content 	= $(this).parent().parent(".mcc-page-widget").find('.hidden-content-shortcode').val();
				var ajax_url 	= window.location.href;
				$listShortcode.hide();
				$settingsC.html('').hide();
				$settingsE.html('').hide();
				//$settingsE.show();
				
				/* Ucword Shortcode*/
				strshortcode = name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$('#edit_shortcode .modal-header .modal-title').html(textShortcode["editShortcode"]+' '+strshortcode);
				$( "#edit_shortcode" ).modal({
					backdrop :"static",
					keyboard :false
				});
				$.ajax({
					type: "POST",
					url: ajax_url,
					dataType: "json",
					traditional: true,
					data: {
						get_form_shortcodes: 1,
						shortcode: shortcode,
						desc : desc,
						name : name,
						content : "["+content+"]"
					},
					beforeSend: function () {
						$filter.hide(500);
						$listShortcode.hide(500);
						$bodyModal.addClass('yt-generator-loading');
					},
					success: function (data) {
						$settingsE.html(data["html"]);
						$settingsE.show();
						setTimeout(function(){ 
							initAllJsShortcode();
							$bodyModal.removeClass('yt-generator-loading');
						}, 1000);
						
					}
				});
			}
			
		});
	}
	
	/* Click button duplicate Widget */
	function duplicateWidget(col,mod){
		$(".mcc-page-wcopy",mod).click( function(event){
			/* Add Class Active for Column*/
			$(".mcc-page-col",$pagebuilder).removeClass("active");
			$(this).parent().parent().parent().parent().parent().parent('.mcc-page-col').addClass('active');
			if(confirm(textDuplicate)){
				var clone = $(mod).clone();
				var type = clone.data("type");
				if(type == "shortcode"){
					var key =  clone.data("shortcode") + "_" + randString(4);
					clone.data('module',key);
					clone.attr('data-module',key);
				}
				//var data = $("#widget-"+  mod.data('module').replace('.', '-') ).val();
				$('.mcc-page-content',col).append( clone );
				/* Click button edit widget*/
				editWidget(clone);
				/* Click button delete widget*/
				deleteWidget(clone);
				/* Click button duplicate widget*/
				duplicateWidget(col,clone);
			}
			event.stopPropagation();
		});
	}
	
	/* Click Add Element */
	$("body").on("click",".yt_shortcodes_add_element",function(e){
		initAllJsShortcode();
	});
	$("body").on("click",".yt_shortcodes_son_button",function(e){
		var active = $(this).attr("data-active");
		$(this).parent().parent().find(".yt_shortcodes_wrap_form").slideUp(500);
		$(this).parent().parent().find(".yt_shortcodes_son_button").attr("data-active","");
		if(active == "active" )
		{
			$(this).parent().find(".yt_shortcodes_wrap_form").slideUp(500);
			$(this).attr("data-active","");	
		}else
		{
			$(this).attr("data-active","active");
			$(this).parent().find(".yt_shortcodes_wrap_form").slideDown(500);
		}
		
	});
	
	/* Init value setters */
	$('body').on('click','.yt-generator-set-value', function(e){
		$(this).parents(".yt-generator-field-container").find("input").val($(this).text()).trigger("change");
	});
		
	/* For data */
	function cloneData(data, target,item){
		for( var k in target ){
			if(k == 'text_class_id'){
				target[k] = item+'_'+randString(4);
			}else{
				target[k] = data[k];
			}
		}
		return target;
	}		
	
	/* Duplicate Row */	
	function duplicateRow( row, sub, srow){
		var rowNew = func_creatRow( sub == true ? srow: '',sub);
		rowNew.data('rowData',cloneData(row.data('rowData'),new initDataRow(),'row')); /* Add style for Row new*/
		$(row).children('.inner-row').children(".mcc-page-col").each(function(){
			var colNew = func_creatColumn(rowNew);
			 $(this).children('.mcc-col-content').children('.inner-col').children('.mcc-page-content').children( '.mcc-page-widget' ).each( function(){   
				mod = $(this).clone();
				var type = mod.data("type");
				if(type == "shortcode"){
					var key =  mod.data("shortcode") + "_" + randString(4);
					mod.data('module',key);
					mod.attr('data-module',key);
				}
				$(".mcc-page-content",colNew).first().append( mod );
				/*Click button delete*/
				deleteWidget(mod);
				/*Click button edit shortcode*/
				editWidget(mod);
				/*Click button duplicate shortcode*/
				duplicateWidget(colNew,mod);
			} );
			colNew.data('colData', cloneData($(this).data('colData'),new initDataCol(),'col')); /* Add style for Col new*/
			var colNum = $(colNew).data('colData')[screenActive];
			if(colNum == 15){
				$(colNew).css({'width':'20%'}); 
			}else{
				$(colNew).css({'width':colNum/countColumn*100+'%'}); 
			}
			
			if(colNum > 1){
				$(colNew).find('.show-width-col').html(colNum+' '+textCol["cols"]);	
			}else{
				$(colNew).find('.show-width-col').html(colNum+' '+textCol["col"]);
			}
			if( $(this).children('.mcc-col-content').children('.inner-col').children( '.mcc-page-row' ).length > 0 ){  
				$(this).children('.mcc-col-content').children('.inner-col').children( '.mcc-page-row' ).each( function(){  
					duplicateRow( $(this), true, colNew.children('.mcc-col-content').children( '.inner-col' ));
				});
			}
		});
		countRow(); /*update count row */
	}
	
	/* Duplicate Col */	
	function duplicateCol( col,sub ,row){
		_row = (sub == true ? row : col.parent().parent(".mcc-page-row"));
		var colNew = func_creatColumn(_row);
		colNew.data('colData',cloneData(col.data('colData'),new initDataCol(),'col')); /* Add style for Col new*/
		var colNum = $(colNew).data('colData')[screenActive];
		if(colNum == 15){
			$(colNew).css({'width':'20%'}); 
		}else{
			$(colNew).css({'width':colNum/countColumn*100+'%'}); 
		}
		if(colNum > 1){
			$(colNew).find('.show-width-col').html(colNum+' '+textCol["cols"]);	
		}else{
			$(colNew).find('.show-width-col').html(colNum+' '+textCol["col"]);
		}
		$(col).children('.mcc-col-content').children('.inner-col').children( ".mcc-page-content" ).children( '.mcc-page-widget' ).each( function(){
			mod = $(this).clone();
			var type = mod.data("type");
			if(type == "shortcode"){
				var key =  mod.data("shortcode") + "_" + randString(4);
				mod.data('module',key);
				mod.attr('data-module',key);
			}
			$(".mcc-page-content",colNew).first().append( mod );
			/* Click button delete */
			deleteWidget(mod);
			/* Click button edit shortcode */
			editWidget(mod);
			/* Click button duplicate shortcode */
			duplicateWidget(colNew,mod);
		});
		$(col).children('.mcc-col-content').children('.inner-col').children( ".mcc-page-row" ).each( function(){
			rowNew = func_creatRow(colNew.children('.mcc-col-content').children('.inner-col'),true);
			rowNew.data('rowData', cloneData($(this).data('rowData'),new initDataRow(),'row'));  /* Add style for Row new*/
			if( $(this).children('.inner-row').children( '.mcc-page-col' ).length > 0 ){  
				$(this).children('.inner-row').children( '.mcc-page-col' ).each( function(){ 
					duplicateCol($(this), true, rowNew );
				});
			}
		});
	}
	
	/* Create Column */
	function func_creatColumn(row){
		$( ".mcc-page-col", $pagebuilder ).removeClass( "active" );	
		var col = $( '<div class="mcc-page-col active"><div class="mcc-col-content"> <div class="mcc-col-tool"> </div><div class="inner-col clearfix"> </div> </div></div>' );
		var sort = $('<div class="mcc-page-sortable-col mcc-page-icon" data-iconTitle="'+textCol["sortCol"]+'"><i class="fas fa-arrows-alt"></i></div>');
		var del = $('<div class="mcc-page-delete mcc-page-icon" data-iconTitle="'+textCol["deleteCol"]+'"><i class="fas fa-minus-circle"></i></div></div>');
		var edit = $('<div class="mcc-page-edit mcc-page-icon" data-iconTitle="'+textCol["editCol"]+'"><i class="fas fa-edit"></i></div></div>');
		var copy = $('<div class="mcc-page-copy mcc-page-icon" data-iconTitle="'+textCol["duplicateCol"]+'"><i class="fas fa-copy"></i></div>');
		var add_row = $('<div class="mcc-page-addRow mcc-page-icon" data-iconTitle="'+textCol["addRow"]+'"><i class="fas fa-plus-square"></i></div></div>');
		var add_module = $('<div class="mcc-page-addModule mcc-page-icon" data-iconTitle="'+textCol["addModule"]+'"><i class="fas fa-plus-circle"></i></div>');
		var add_shortcode = $('<div class="mcc-page-addShortcode mcc-page-icon" data-iconTitle="'+textCol["addShortcode"]+'"><i class="fas fa-plus-square-o"></i></div>');
		var content = $('<div class="mcc-page-content"></div>');
		var show_width_col = $('<span class="show-width-col"></span>');
		col.children('.mcc-col-content').children('.mcc-col-tool').append(sort).append(del).append(edit).append(copy).append(add_row).append(add_module).append(add_shortcode);
		
		col.children('.mcc-col-content').children('.inner-col').append(content);
		
		col.children('.mcc-col-content').append(show_width_col);
		
		row.children('.inner-row').append(col); /* Add column */
		
		//col.addClass("active");
		
		eventsForColumn( col , row );	/* Add event for column */
		/*Add style for column*/
		col.data('colData', new initDataCol());
		
		return col;
	}
	
	/* Change width to column */
	function changeWidthToCol($width){
		if($width < 9){
			c = 1;
		}else if(9 <= $width && $width < 17){
			c = 2;
		}else if(17 <= $width && $width < 21){
			c = 15;
		}else if(21 <= $width && $width < 26){
			c = 3;
		}else if(26 <= $width && $width < 34){
			c = 4;
		}else if(34 <= $width && $width < 42){
			c = 5;
		}else if(42 <= $width && $width < 51){
			c = 6;
		}else if(51 <= $width && $width < 59){
			c = 7;
		}else if(59 <= $width && $width < 67){
			c = 8;
		}else if(67 <= $width && $width < 76){
			c = 9;
		}else if(76 <= $width && $width < 84){
			c = 10;
		}else if(84 <= $width && $width < 92){
			c = 11;
		}else if(92 <= $width && $width <= 100){
			c = 12;
		}
		return c;
	}
	
	/* Event for Column */
	function eventsForColumn( col, row ){
		/* Resizable Column */
		col.resizable({	
			resize: function(event,ui){
				d =  countColumn*col.width()/row.width();
				$width_ = Math.floor(d/countColumn*100);
				d = changeWidthToCol($width_);
				if(d > 1){
					$(col).children('.mcc-col-content').children(".show-width-col").html(d+' '+textCol["cols"]);
				}else{
					$(col).children('.mcc-col-content').children(".show-width-col").html(d+' '+textCol["col"]);
				}
				$(".layout-builder").addClass("show-column").removeClass("hide-column");
			},
			stop: function( event, ui ) {
				c =  countColumn*col.width()/row.width();
				if(c > 12) {c = 12;}
				$width = Math.floor(c/countColumn*100);
				c = changeWidthToCol($width);
				changeWidthColumn(col,c); /* Update width of Column*/
				$(".layout-builder").addClass("hide-column").removeClass("show-column");
			},	
			handles: 'e',
			maxWidth:maxWidth,
			minWidth:minWidth
		}); 
		
		/* Click button Delete Column */
		$(".mcc-page-delete",col).click( function(){
			if( confirm(textDelete) ){
				/* CalculateWidthColumn( row ); */
				row = col.parent().parent();
				var childnum = row.children('.inner-row').children( ".mcc-page-col" ).length;
				col.remove();
			}
		} );
		
		/* Add Class Active for Col */
		$(".mcc-page-icon",col).click(function(){
			$(".mcc-page-col",$pagebuilder).removeClass("active");
			col.addClass("active");
		});
		
		/*Sortable Column*/
		$(".mcc-page-content",col).sortable({
			connectWith: ".mcc-page-col .mcc-page-content",
			handle:".mcc-page-wsort",
			placeholder: "ui-state-highlight-widget",
			over:function(event, ui ){   ui.item.width(ui.placeholder.width() ) }
		}); 
		$(".inner-col",col).sortable({
			connectWith: ".mcc-page-col .inner-col",
			handle:".mcc-page-sortable",
			placeholder: "ui-state-highlight-widget",
			over:function(event, ui ){   ui.item.width(ui.placeholder.width() ) }
		}); 
			
		/* Click button Edit Style for Column */
		$(".mcc-page-edit",col).click( function(event){ 
			$(".form-control", "#style_col").val('');
			var style_col = col.data('colData');
			
			$('input, textarea, select', '#style_col').each(function() {
				$(this).val('');
				var k = $(this).attr('name');
				$("[name="+k+"]", "#style_col").attr( "value", style_col[k] ); 
				$("[name="+k+"]", "#style_col").val( style_col[k] ); 
				if( k == 'text_color' || k == 'link_color' || k == 'link_hover_color' || k == 'heading_color' || k == 'bg_color')
				{
					$("[name="+k+"]", "#style_col").css("background-color", style_col[k]);
					if(style_col[k] == '#000000')
					{
						$("[name="+k+"]", "#style_col").css("color", '#ffffff');
					}else{
						$("[name="+k+"]", "#style_col").css("color", '#000000');
					}
					changeColor("col");
				}
				if( k.indexOf('bg_image') != -1 ){
					var data = $("[name="+k+"]", "#style_col").val();
					if( data ){
						var parent = $("[name="+k+"]", "#style_col").parent();
						$('img', parent).attr( 'src', $("[name="+k+"]", "#style_col").data('base')+data );
					}else { 						
						var parent = $("[name="+k+"]", "#style_col").parent();
						$('img', parent).attr( 'src', $('img', parent).attr('data-placeholder') );
					}
				}
			}); 
			
			$("#style_col").modal({
				backdrop :"static",
				keyboard :false
			});
			$(".mcc-page-col.active").removeClass( 'active' );
			$(col).addClass('active');
			col_background_type = $("#col_background_type").val();
			switch(col_background_type){
				case '0':
					$('.col-background').hide();
				break;
				case '1':
					$('.col-background').hide();
					$('.col-background-color').show();
				break;
				case '2':
					$('.col-background').hide();
					$('.col-background-photo').show();
				break;
				case '3':
					$('.col-background').hide();
					$('.col-background-video').show();
				break;
			}
			
			 event.stopPropagation();
		} );
		
		/* Click button Add Shortcode */
		$(".mcc-page-addShortcode",col).click( function(){
			$listShortcode.show();
			$settingsC.html('').hide();
			$settingsE.html('').hide();
			/* Show button back to list */
			$('#config_shortcode .modal-footer').find('button.yt-generator-home').addClass('hidden');
			/* Show button save change*/
			$('#config_shortcode .modal-footer').find('button.submit').addClass('hidden');
			$('#config_shortcode .modal-footer').find('button.submit-save').addClass('hidden');
			/* Show filters */ 
			$filter.show();
			var col = ".mcc-page-col.active";
			$( "#config_shortcode" ).modal({
				backdrop :"static",
				keyboard :false
			});
			createWidget();
		});
		
		/*Click button Add Module*/
		$(".mcc-page-addModule",col).click( function(){
			var col = ".mcc-page-col.active";
			$( "#config_module" ).modal({
				backdrop :"static",
				keyboard :false
			});
			$("#config_module .module-item").unbind( 'click');
			$("#config_module .module-item").bind( 'click', function(){
				var mod = $(this).clone();
				$(".mcc-page-content",col).first().append( mod );
				$("#config_module").modal('hide');
				/* Click button delete */
				deleteWidget(mod);
				/* Click button Edit Shortcode */
				editWidget(mod);
				/* Click button Duplicate Shortcode */
				duplicateWidget(col,mod);
				/*Save Module*/
				$('#action').val('save_edit');
				$('#form-featured').submit();
			} );
		} );
		
		/*Click button Copy Col*/
		$(".mcc-page-copy",col).click( function( event ){
			if(confirm(textDuplicate)){
				duplicateCol( col ,false);
			}
			event.stopPropagation();
		} );
		
		/*Click button Add Row*/
		$(".mcc-page-addRow",col).click( function(){
			func_creatRow( col.children( '.mcc-col-content' ).children( '.inner-col' ), true ); 
		} );	
	}

	/*Change width for Column*/
	function changeWidthColumn( col, dcol ){  
		if(dcol == 15){
			$(col).css( {'width':'20%'} );
		}else{
			$(col).css( {'width':dcol/countColumn*100 +'%'} );
		}
		$(col).data("colData")[screenActive] = dcol;
		if(dcol > 1){
			$(col).children('.mcc-col-content').children(".show-width-col").html(dcol+' '+textCol["cols"]);
		}else{
			$(col).children('.mcc-col-content').children(".show-width-col").html(dcol+' '+textCol["col"]);
		}
		
	}
	
	/*Update count row*/
	function countRow(){
		$('.mcc-page-textRow .countRow').each(function(e){
			$(this).text(e+1);
			if((e+1)%2 == 0){
				$(this).parent().parent().next().addClass("row-leg");
			}else{
				$(this).parent().parent().next().removeClass("row-leg");
			}
		});
	}
		
	/*Create Row*/
	function func_creatRow( srow, sub ){
		/*Create Button : Sort Edit Copy Delete*/
		if( sub !=null && sub== true ){
			var edit 	= $('<div class="mcc-page-edit-child mcc-page-icon" data-iconTitle="'+textRow["editRow"]+'"><i class="fas fa-edit"></i></div>');
			var row 	= $('<div class="mcc-page-row"><div class="mcc-page-tool"></div><div class="inner-row clearfix"></div></div>');
			var showTextRow = $('<div class="mcc-page-textRow mcc-page-icon">'+textRow["row"]+' <span class="countRowSub"></span></div>');
		}else{
			var edit 	= $('<div class="mcc-page-edit mcc-page-icon" data-iconTitle="'+textRow["editRow"]+'"><i class="fas fa-edit"></i></div>');
			var row 	= $('<div class="mcc-page-row"><div class="mcc-page-tool"></div><div class="inner-row clearfix"></div></div>');	
			var showTextRow = $('<div class="mcc-page-textRow mcc-page-icon">'+textRow["row"]+' <span class="countRow"></span></div>');
		}
		
		var sort 	= $('<div class="mcc-page-sortable mcc-page-icon" data-iconTitle="'+textRow["sortRow"]+'"><i class="fas fa-arrows-alt"></i></div>');
		var del 	= $('<div class="mcc-page-delete mcc-page-icon" data-iconTitle="'+textRow["deleteRow"]+'"><i class="fas fa-minus-circle"></i></div>');
		
		
		var copy 	= $('<div class="mcc-page-copy mcc-page-icon" data-iconTitle="'+textRow["duplicateRow"]+'"><i class="fas fa-copy"></i></div>');
		var addcol 	= $('<div class="mcc-page-add-col mcc-page-icon" data-iconTitle="'+textRow["addCol"]+'" data-toggle="modal" data-target="#config_column" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i></div>' );
		
		$(row).children(".mcc-page-tool").append(showTextRow).append(sort).append(del).append(edit).append(copy).append(addcol);
		
		eventsForRow( row ,sub, srow );
		row.data('rowData', new initDataRow());
		
		if( sub !=null && sub== true ){
			srow.append( row );
			$( ".mcc-page-row").removeClass( "active" );
			row.addClass( 'active' );
		}else {
			$pagebuilder.children('.mcc-col-content').children('.inner-col').append( row );
			$( ".mcc-page-row").removeClass( "active" );
			row.addClass( 'active' );
		}
		countRow(); /*update count row */
		return row;
	};

	/*Event For Row*/
	function eventsForRow( row ,sub, srow ){
		/*Click button Delete Row*/
		$(".mcc-page-tool .mcc-page-delete", row).click( function(){
			if( confirm(textDelete) ){
				if( row.parent().children('.mcc-page-row').length<= 1 ){
					row.parent().removeClass( 'hd-widgets-func' );
				}
				row.remove();
				countRow(); /*update count row */
			}
		} );
		
		/*Add Class Active for Row*/
		$(".mcc-page-icon", row).click(function(){
			$(".mcc-page-row",$pagebuilder).removeClass("active");
			row.addClass("active");
		});
		
		/*Click button Edit Style for Row Parent*/
		function soPageEdit(){
			$(".form-control", "#style_row").val('');
			var style_row = row.data('rowData');
			$('input, textarea, select', '#style_row').each(function() {
				$(this).val('');
				
				var k = $(this).attr('name');
				$("[name="+k+"]", "#style_row").attr( "value", style_row[k] );  
				$("[name="+k+"]", "#style_row").val( style_row[k] ); 
				if( k == 'text_color' || k == 'link_color' || k == 'link_hover_color' || k == 'heading_color' || k == 'bg_color'){
					$("[name="+k+"]", "#style_row").css("background-color", style_row[k]);
					if(style_row[k] == '#000000'){
						$("[name="+k+"]", "#style_row").css("color", '#ffffff');
					}else{
						$("[name="+k+"]", "#style_row").css("color", '#000000');
					}
					changeColor("row");
				}
				if( k == 'section_text_color' || k == 'section_bg_color'){
					$("[name="+k+"]", "#style_row").css("background-color", style_row[k]);
					if(style_row[k] == '#000000'){
						$("[name="+k+"]", "#style_row").css("color", '#ffffff');
					}else{
						$("[name="+k+"]", "#style_row").css("color", '#000000');
					}
					changeColor("section");
				}
				if( k.indexOf('bg_image') != -1 ){
					var data = $("[name="+k+"]", "#style_row").val();
					if( data ){
						var parent = $("[name="+k+"]", "#style_row").parent();
						$('img', parent).attr( 'src', $("[name="+k+"]", "#style_row").data('base')+data );
					}else { 						
						var parent = $("[name="+k+"]", "#style_row").parent();
						$('img', parent).attr( 'src', $('img', parent).attr('data-placeholder') );
					}
				}
			}); 
			$(".mcc-page-row.active").removeClass( 'active' );
			$(row).addClass( 'active' );
			/*Show background*/
			row_background_type = $("#row_background_type").val();
			switch(row_background_type){
				case '0':
					$('.row-background').hide();
				break;
				case '1':
					$('.row-background').hide();
					$('.row-background-color').show();
				break;
				case '2':
					$('.row-background').hide();
					$('.row-background-photo').show();
				break;
				case '3':
					$('.row-background').hide();
					$('.row-background-video').show();
				break;
				case '4':
					$('.row-background').hide();
					$('.row-background-parallax').show();
				break;
			}
			
			/*Show section*/
			row_section = $('#row_section').val();
			switch(row_section){
				case '0':
					$('.row-section-id,.row-section-class,.row-section-style').hide();
				break;
				case '1':
					$('.row-section-id,.row-section-class,.row-section-style').show();
					/*Show section style*/
					section_background_type = $("#section_background_type").val();
					switch(section_background_type)	{
						case '0':
							$('.section-background').hide();
						break;
						case '1':
							$('.section-background').hide();
							$('.section-background-color').show();
						break;
						case '2':
							$('.section-background').hide();
							$('.section-background-photo').show();
						break;
						case '3':
							$('.section-background').hide();
							$('.section-background-video').show();
						break;
					}
				break;
			}
			
			 
		}
		$(".mcc-page-tool .mcc-page-edit", row ).click(function(event){ 
			soPageEdit();
			$("#style_row").find(".row-parent").show();
			$( "#style_row" ).modal({
				backdrop :"static",
				keyboard :false
			});
			event.stopPropagation();
		});
		
		/*Click button Edit Style for Row Children*/
		$(".mcc-page-tool .mcc-page-edit-child", row ).click(function(event){ 
			soPageEdit();
			$("#style_row").find(".row-parent").hide();
			$( "#style_row" ).modal({
				backdrop :"static",
				keyboard :false
			});
			event.stopPropagation();
		});
		
		/*Click button Copy Row*/
		$(".mcc-page-tool .mcc-page-copy", row).click( function( event ){
			if(confirm(textDuplicate)){
				duplicateRow( row, sub, srow );
			}
			event.stopPropagation();
		} );
			
		/*Sortable For Row*/
		$(row).children('.inner-row').sortable({
			connectWith: ".mcc-page-row > .inner-row", 
			placeholder: "ui-state-highlightcol",
			remove:function(){  
				var trow = $(this).parent();
				CalculateWidthColumn( trow );
				countRow(); /*update count row */
			},
			start:function( event, ui ){
				$( '.ui-state-highlightcol', row ).width( $(ui.item).width() );
			},
			receive: function( event, ui ) {
				var trow = $(this).parent();
				CalculateWidthColumn( trow );
				countRow(); /*update count row */
			},
			handle:'.mcc-page-sortable-col',
			cancel: ".mcc-page-sortable"
		});	 
		
		/*Sortable Row*/
		$($pagebuilder).children('.mcc-col-content').children(".inner-col" ).sortable({
			connectWith: ".layout-builder",
			placeholder: "ui-state-highlight",
			stop:function(event,ui){
				countRow(); /*update count row */
			},
			handle:'.mcc-page-sortable',
			cancel:'.mcc-page-content' 
		});			
	
	}
	
	/*show widget*/
	function showWidget( col, widget ){ 
		if( $("#config_module [data-module=\'"+widget.module+"\']") || $("#config_shortcode [data-shortcode=\'"+widget.shortcode+"\']") ){
			if( widget.type == 'shortcode' ){
				var mod = $("#config_shortcode [data-shortcode=\'"+widget.shortcode+"\']").clone();
				mod.children('.hidden-content-shortcode').text(widget.content);
				mod.attr( 'data-module', widget.module );
				var dataShortcode = widget.content;
				var nameShortcodeEdit = JSON.parse(dataShortcode).cparent[0]["name_shortcode_"+languagesDefault+""];
				var nameShortcodeEditNoHtml = removeHtml(nameShortcodeEdit);
			}else {
				var mod = $("#config_module [data-module=\'"+widget.module+"\']").clone();	
			}
			/* Click button Create Shortcode*/
			createWidget();	
			
			/* Click button Edit Shortcode */
			editWidget(mod);
			
			/* Click button Delete Shortcode */
			deleteWidget(mod);	
			
			/* Click button Duplicate Shortcode */
			duplicateWidget(col,mod);
			
			/*Show module */
			$('.mcc-page-content',col).append( mod );
			mod.find('.widget-title-shortcode').text(nameShortcodeEditNoHtml);
		}
	}
			
	/*Show Layout*/
	function showLayout( rows, widgetids, sub, incol ){
		$(rows).each( function() {
			/* Create row */ 
			var row = func_creatRow( sub==true ? incol.children('.mcc-col-content').children( '.inner-col' ): '',sub);
			$( this.cols ).each( function(){ 
				/*Create Column */
				var col = func_creatColumn(row); 
				/*Update Style for column*/
				col.data('colData',this);
				
				/*Update content*/
				$( this.widgets ).each(function(){   
					showWidget(col, this);
				});
					
				/*Update width for column*/
				if(this.lg_col == 15){
					$(col).css( {'width':'20%'} ); 
				}else{
					$(col).css( {'width':(this.lg_col/countColumn*100)+'%'} ); 
				}
				
				if(this.lg_col > 1){
					$(col).find('.show-width-col').html(this.lg_col+' '+textCol["cols"]);
				}else{
					$(col).find('.show-width-col').html(this.lg_col+' '+textCol["col"]);
				}					
				
				/*Check Row child in Column*/
				if( this.rows.length > 0 ){
					 showLayout( this.rows, widgetids, true, col ); 
				}
				this.rows = null;
			} );

			this.cols = null;
			/*Update style for Row*/
			row.data( 'rowData', this );
		} );
		return true;
	}	
	
	/*Start*/
	this.each(function() {  
		$pagebuilder = $(this);
		
		/* Config column*/
		function configRow(){
			var sub_row = $("#config_row").attr("data-sub");
			func_creatRow();
			var num_col = $("[name=number-col]", "#config_row").val();
			var large_col = $("[name=large-col]", "#config_row").val();
			var medium_col = $("[name=medium-col]", "#config_row").val();
			var small_col = $("[name=small-col]", "#config_row").val();
			var extra_col = $("[name=extra-col]", "#config_row").val();
			screenActive = $("[name=screens-active]", "#config_row").val();
			$(".change-screens button").removeClass('active');
			$('.change-screens button[data-option="'+screenActive+'"]').addClass('active');
			row = $('.mcc-page-row.active');
			col = $('.mcc-page-col');
			for(i =0 ; i<num_col ; i++){
				func_creatColumn(row);
			}
			/*Update col & width for Column*/
			$( '.mcc-page-col', row ).each( function(){
				$(this).data("colData")['lg_col'] = large_col;
				$(this).data("colData")['md_col'] = medium_col;
				$(this).data("colData")['sm_col'] = small_col;
				$(this).data("colData")['xs_col'] = extra_col;
				var colNum = $(this).data('colData')[screenActive];
				if(colNum == 15){
					$(this).css({'width': '20%'}); 
				}else{
					$(this).css({'width':colNum/countColumn*100+'%'}); 
				}
				
				if(colNum > 1){
					$(this).find('.show-width-col').html(colNum+' '+textCol["cols"]);	
				}else{
					$(this).find('.show-width-col').html(colNum+' '+textCol["col"]);
				}
				
			});
			$( "#config_row" ).modal('hide');
		}
		$("#config_row .submit").click(function(){ 
			configRow();
			return false;
		});
		$("#config_row .submit-save").click(function(){ 
			configRow();
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		});
		$("#edit_module .submit-save").click(function(){ 
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		});
		
		/*Click button Add Column*/
		function configColumn(){
			$( ".mcc-page-col", $pagebuilder ).removeClass( "active" );
			_row = $('.mcc-page-row.active');
			var itemAdd = $("[name=number-col]", "#config_column").val();
			var large_col = $("[name=large-col]", "#config_column").val();
			var medium_col = $("[name=medium-col]", "#config_column").val();
			var small_col = $("[name=small-col]", "#config_column").val();
			var extra_col = $("[name=extra-col]", "#config_column").val();
			for(i =0 ; i<itemAdd ; i++){
				var childnum = _row.children('.inner-row').children( ".mcc-page-col" ).length;
				func_creatColumn(_row);
				_col = $('.mcc-page-col.active');
				_col.data("colData")['lg_col'] = large_col;
				_col.data("colData")['md_col'] = medium_col;
				_col.data("colData")['sm_col'] = small_col;
				_col.data("colData")['xs_col'] = extra_col;
				var colNum = _col.data('colData')[screenActive];
				if(colNum == 15)
				{
					_col.css({'width': '20%'}); 
				}else{
					_col.css({'width':colNum/countColumn*100+'%'}); 
				}
				
				if(colNum > 1 )
				{
					_col.find( '.show-width-col').html(colNum+' '+textCol["cols"]);
				}else{
					_col.find('.show-width-col').html(colNum+' '+textCol["col"]);
				}
			}
			$( "#config_column" ).modal('hide');
		}
		$("#config_column .submit").click(function(){
			configColumn();
			return false;
		});
		$("#config_column .submit-save").click(function(){
			configColumn();
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		} );
		
		/*Show form*/
		$pagebuilder.fadeIn(400);	

		/*Change screen */
		$(".change-screens button").click( function (){
			screenActive = $(this).data('option');
			$(".change-screens button").removeClass('active');
			$(this).addClass( 'active' );
	  		$(".mcc-page-row",$pagebuilder).each( function(){
	 			var _row = $(this);
	 			$( '.mcc-page-col', _row ).each( function(){
					var colNum = $(this).data('colData')[screenActive];
					if(colNum == 15){
						$(this).css({'width': '20%'}); 
					}else{
						$(this).css({'width':colNum/countColumn*100+'%'}); 
					}
	 				
					if(colNum > 1){
						$(this).find('.show-width-col').html(colNum+' '+textCol["cols"]);
					}else{
						$(this).find('.show-width-col').html(colNum+' '+textCol["col"]);
					}
					
	 			});
		 	});	

		} );
			
		/* Render layout */
		if(datajson){
			var rows = $.parseJSON(datajson);
			var widgetids = new Array(); 
			showLayout( rows , widgetids, false );
		}
		
		/* Row Style */
		function styleRow(){
			if( $(".mcc-page-row.active") ){
				var style_row = $(".mcc-page-row.active").data('rowData');
				for( var item in style_row ){
					if( item == 'bg_image' ){
						var img = $('[name="bg_image"]').attr('value');
						if( img != "" ){
							style_row[item] = img;
						}else {
							style_row[item] = $("[name="+item+"]", "#style_row").val(  ); 
						}
					}else if( item == 'text_color' ){
						style_row[item] = $(".row-text-color-value").val();
					}else if( item == 'link_color' ){
						style_row[item] = $(".row-link-color-value").val();
					}else if( item == 'link_hover_color' ){
						style_row[item] = $(".row-link-hover-color-value").val();
					}else if( item == 'heading_color' ){
						style_row[item] = $(".row-heading-color-value").val();
					}else if( item == 'bg_color' ){
						style_row[item] = $(".row-bg-color-value").val();
					}else{
						style_row[item] = $("[name="+item+"]", "#style_row").val(  ); 
					}
				}
				$(".mcc-page-row.active").data('rowData',style_row);
			}  
			$( "#style_row" ).modal('hide');
		}
		$("#style_row .submit").click(function(){ 
			styleRow();
			return false;
		});
		$("#style_row .submit-save").click(function(){ 
			styleRow();
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		});
		
		/* Column Style */
		function styleCol(){
			if( $(".mcc-page-col.active") ){
				var style_col = $(".mcc-page-col.active").data('colData');
				for( var item in style_col ){
					if( item == 'bg_image' ){
						var img = $('[name="bg_image"]', "#style_col").attr('value');
						if( img != "" ){
							style_col[item] = img;
						}else {
							style_col[item] = $("[name="+item+"]", "#style_col").val(); 
						}
					}else if( item == 'text_color' ){
						style_col[item] = $(".col-text-color-value", "#style_col").val();
					}else if( item == 'link_color' ){
						style_col[item] = $(".col-link-color-value", "#style_col").val();
					}else if( item == 'link_hover_color' ){
						style_col[item] = $(".col-link-hover-color-value", "#style_col").val();
					}else if( item == 'heading_color' ){
						style_col[item] = $(".col-heading-color-value", "#style_col").val();
					}else if( item == 'bg_color' ){
						style_col[item] = $(".col-bg-color-value", "#style_col").val();
					}else					
					{
						style_col[item] = $("[name="+item+"]", "#style_col").val(); 
					}
				}
				$(".mcc-page-col.active").data('colData',style_col);
				var colNum = $(".mcc-page-col.active").data('colData')[screenActive];
				if(colNum == 15){
					$(".mcc-page-col.active").css({'width': '20%'}); 
				}else{
					$(".mcc-page-col.active").css({'width':colNum/countColumn*100+'%'}); 
				}
				
				if(colNum > 1){
					$(".mcc-page-col.active").find('.show-width-col').html(colNum+' '+textCol["cols"]);
				}else{
					$(".mcc-page-col.active").find('.show-width-col').html(colNum+' '+textCol["col"]);
				}
			}
			$( "#style_col" ).modal('hide');
		}
		$("#style_col .submit").click(function(){ 
			styleCol();
			return false;
		});
		$("#style_col .submit-save").click(function(){ 
			styleCol();
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		});
		var decodeHtmlEntity = function(str) {
			return str.replace(/&#(\d+);/g, function(match, dec) {
				return String.fromCharCode(dec);
			  });
			};

		var encodeHtmlEntity = function(str) {
		  var buf = [];
			for (var i=str.length-1;i>=0;i--) {
				buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
			}
			return buf.join('');
		};
		/* Function Get Shortcode*/
		function GetShortcode(idConfig){
			
			var content = new Object();
			var contentParent = new Array();
			var contentChild = new Array();
			var contentCO = new Object();
			var group = $("#yt-generator-attr-type_change",idConfig).val();
			var group_source = $(".yt-generator-isp-sources",idConfig).val();
			var $parentShortcode = $(".yt_shortcodes_parent_form_element",idConfig);
			var $parentShortcodeField = $(".yt_shortcodes_parent_form_element .yt-generator-field-container",idConfig);
			var $childShortcode = $(".yt_shortcodes_son_form_element",idConfig);
			var $childShortcodeWrap = $childShortcode.children('.yt_shortcodes_son_wrap',idConfig);
			var dataItemP = new Object();
			$parentShortcodeField.each(function (index){
				var multiLanguage = ""+$(this).data("language")+"";
				if(multiLanguage.indexOf(',') > -1){
					var multiLanguage_arr = multiLanguage.split(',');
				}else{
					var multiLanguage_arr = multiLanguage;
				}
				
				if(($(this).data("group")) == group || ($(this).data("group"))=="all" || ($(this).data("group")) == group_source){
					data 	= $(this).data("name");
					value 	= $(this).find(".yt-generator-attr").val();
					type 	= $(this).data("type");
					if(type == "textLanguage" || type == "textareaEditorLanguage"){
						for(i=0; i< multiLanguage_arr.length;i++){
							value = $(this).find(".yt-generator-attr-"+data+"_"+multiLanguage_arr[i]+".yt-generator-attr").val();
							value = value.replace(/&quot;/g, '"');
							value = value.replace(/&amp;/g, '&');
							value = value.replace(/&lt;/g, '<');
							value = value.replace(/&gt;/g, '>');
							value = value.replace(/&quot;/g, '"');
							value = value.replace(/&#39;/g, "'");
							value = value.replace(/&#124;/g, '|');
							dataItemP[""+data+"_"+multiLanguage_arr[i]+""] = value;
						}
					}else{
						dataItemP[""+data+""] = value;
					}
				}
			});
			if ($(".yt_shortcodes_son_form_element")[0]){
				var i= 1;
				$childShortcodeWrap.each(function (index){
					var dataItemC = new Object();
					var $childShortcodeField = $(this).find('.yt_shortcodes_wrap_form .yt-generator-field-container_son .yt-generator-field-container');
					$childShortcodeField.each(function (index){
						var multiLanguage_c = ""+$(this).data("language")+"";
						if(multiLanguage_c.indexOf(',') > -1){
							var multiLanguage_arr_c = multiLanguage_c.split(',');
						}else{
							var multiLanguage_arr_c = multiLanguage_c;
						}
						
						if(($(this).data("group")) == group || ($(this).data("group"))=="all" || ($(this).data("group")) == group_source){
							data = $(this).data("name");
							value = $(this).find(".yt-generator-attr").val();
							type 	= $(this).data("type");
							if(type == "textLanguage" || type == "textareaEditorLanguage"){
								for(j=0; j< multiLanguage_arr_c.length;j++){
									value = $(this).find(".yt-generator-attr-"+data+"_"+multiLanguage_arr_c[j]+".yt-generator-attr").val();
									value = value.replace(/&quot;/g, '"');
									value = value.replace(/&amp;/g, '&');
									value = value.replace(/&lt;/g, '<');
									value = value.replace(/&gt;/g, '>');
									value = value.replace(/&quot;/g, '"');
									value = value.replace(/&#39;/g, "'");
									value = value.replace(/&#124;/g, '|');
									dataItemC[""+data+"_"+multiLanguage_arr_c[j]+""] = value;
								}
							}else{
								dataItemC[""+data+""] = value;
							}
							
						}
					});
					contentCO["child"+i] = dataItemC;
					i++;
				});
			}
			
			contentParent.push(dataItemP); /* Add content Cparent*/
			content.cparent = contentParent; /* Object chua cparent*/
			content.cchild 	= contentCO; /* Object chua cchild*/
			return JSON.stringify(content);
			
		}
		
		/* Add Shortcode */
		function configShortcode(){
			if( $(".mcc-page-col.active") ){
				var addShort = $('.yt_shortcodes_parent_form_element').attr('data-shortcodes');
				var col = $(".mcc-page-col.active");
				initSource();
				mod = $('.wpo-widgetslist').find('div.shortcode-item[data-shortcode='+ addShort +']').clone();
				var key =  $(mod).data("shortcode") + "_" + randString(4);
				mod.attr('data-module',key);
				mod.data('module',key);
				mod.find('textarea.hidden-content-shortcode').text(GetShortcode("#config_shortcode"));
				var dataShortcode = GetShortcode("#config_shortcode");
				var nameShortcodeEdit = JSON.parse(dataShortcode).cparent[0]["name_shortcode_"+languagesDefault+""];
				var nameShortcodeEditNoHtml = removeHtml(nameShortcodeEdit);
				mod.find('.widget-title-shortcode').text(nameShortcodeEditNoHtml);
				$(".mcc-page-content",col).first().append( mod );
				
				/* Click button delete */
				deleteWidget(mod);
				/* Click button Edit Shortcode */
				editWidget(mod);
				/* Click button Duplicate Shortcode */
				duplicateWidget(col,mod);
			}
			$("#config_shortcode").modal('hide');
			$('#config_shortcode .modal-body .wpo-widgetform').html('');
		}
		$("#config_shortcode .submit").click( function(){ 
			configShortcode();
			return false;
		});
		$("#config_shortcode .submit-save").click( function(){ 
			configShortcode();
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		});
		
		/* Close Add Shortcode*/
		$("#config_shortcode .mcc-close").click( function(){ 
			$('#config_shortcode .modal-body .wpo-widgetform').html('');
		});
		
		/* Edit Shortcode*/
		function editShortcode(){
			if( $(".mcc-page-col.active") ){
				var col = $(".mcc-page-col.active");
				initSource();
				//initProductSource();
				$('textarea.hidden-content-shortcode.active').text(GetShortcode("#edit_shortcode"));
				var dataShortcode = GetShortcode("#edit_shortcode");
				var nameShortcodeEdit = JSON.parse(dataShortcode).cparent[0]["name_shortcode_"+languagesDefault+""];
				var nameShortcodeEditNoHtml = removeHtml(nameShortcodeEdit);
				$('.w-inner.active').find('.widget-title-shortcode').text(nameShortcodeEditNoHtml);
			}
			$("#edit_shortcode").modal('hide');
			$('#edit_shortcode .modal-body .wpo-widgetform').html('');
		}
		$("#edit_shortcode .submit").click( function(){ 
			editShortcode();
			return false;
		});
		$("#edit_shortcode .submit-save").click( function(){ 
			editShortcode();
			$('#action').val('save_edit');
			$('#form-featured').submit();
			return false;
		});
		
		/* Close Edit Shortcode*/
		$("#edit_shortcode .mcc-close").click( function(){ 
			$('#edit_shortcode .modal-body .wpo-widgetform').html('');
		});
	
	});    
	return this;
};
})(jQuery);