jQuery(document).ready(function ($) {
	
	 $(".yt_shortcode_overlay").hide();
     $(".yt_shortcodes_plugin").hide();
     $(".yt_shortcode_element_config").hide();
     $(".yt_shortcode_overlay").click(function(){
		$(".yt_shortcode_element_config").hide();
		$(".yt_shortcode_overlay").hide();
		$(".yt_shortcodes_plugin").hide();
		$(".yt_shortcodes_close").hide();
	});
	$(".yt_shortcodes_close").click(function(){
		$(".yt_shortcode_element_config").hide();
		$(".yt_shortcode_overlay").hide();
		$(".yt_shortcodes_plugin").hide();
		$(".yt_shortcodes_close").hide();
	});
	// Prepare data
	var $generator = $('#yt-generator'),
		$search = $('#yt-generator-search'),
		$filter = $('#yt-generator-filter'),
		$filters = $filter.children('a'),
		$choices = $('#yt-generator-choices'),
		$choice = $choices.find('span'),
		$settings = $('.yt_shortcode_element_config'),
		$prefix = $('#yt-compatibility-mode-prefix'),
		$result = $('#yt-generator-result'),
		$selected = $('#yt-generator-selected'),
		mce_selection = '';                
		window.setTimeout(function () {
			$search.focus();
		}, 200);
	// Filters
	$filters.click(function (e) {
		// Prepare data
		var filter = $(this).data('filter');
		$filters.css("background","#1a3867");
		$(this).css("background","#0d264e");
		// If filter All, show all choices
		if (filter === 'all') $choice.css({
			opacity: 1
		}).removeClass('yt-generator-choice-first');
		// Else run search
		else {
			var regex = new RegExp(filter, 'gi');
			// Hide all choices
			$choice.css({
				opacity: 0.2
			});
			// Find searched choices and show
			$choice.each(function () {
				// Get shortcode name
				var group = $(this).data('group');
				// Show choice if matched
				if (group.match(regex) !== null) $(this).css({
					opacity: 1
				}).removeClass('yt-generator-choice-first');
			});
		}
		e.preventDefault();
	});
	// Go to home link
	$('.yt_shortcodes_plugin').on('click', '.yt-generator-home', function (e) {
		// Clear search field
		$search.val('');
		// Hide settings
		$settings.html('').hide();
		$choices.css("display","block");
		// Show filters
		$filter.show();
		// Show choices panel
		$choices.show();
		$choice.show();
		// Clear selection
		mce_selection = '';
		// Focus search field
		$search.focus();
		e.preventDefault();
		$(".yt_shortcodes_list_shortcodes").show();
	});
	
	// Search field
	$search.on({
		focus: function () {
			// Clear field
			$(this).val('');
			// Hide settings
			$settings.html('').hide(500);
			// Remove narrow class
			$generator.removeClass('yt-generator-narrow');
			// Show choices panel
			$choices.show(500);
			$choice.css({
				opacity: 1
			}).removeClass('yt-generator-choice-first');
			// Show filters
			$filter.show(500);
			$(".yt_shortcodes_list_shortcodes").show(500);
		},
		blur: function () {},
		keyup: function (e) {
			var $first = $('.yt-generator-choice-first:first'),
				val = $(this).val(),
				regex = new RegExp(val, 'gi');
			// Hotkey action
			if (e.keyCode === 13 && $first.length > 0) {
				e.preventDefault();
				$(this).val('').blur();
				$first.trigger('click');
			}
			// Hide all choices
			$choice.css({
				opacity: 0.2
			}).removeClass('yt-generator-choice-first');
			// Find searched choices and show
			$choice.each(function () {
				// Get shortcode name
				var id = $(this).data('shortcode'),
					name = $(this).data('name'),
					desc = $(this).data('desc'),
					group = $(this).data('group');
				// Show choice if matched
				if ((id + name + desc + group).match(regex) !== null) {
					$(this).css({
						opacity: 1
					}).removeClass('yt-generator-choice-first');
					if (val === id || val === name || val === name.toLowerCase()) {
						$(this).addClass('yt-generator-choice-first');
					}
				}
			});
		}
	});
	
	var $_pathname = window.location.pathname.replace("administrator/index.php","").replace("index.php",""); 
	var add_css_js = 0;
	$("#yt_shorcodes").click(function(){
		if(add_css_js == 0)
		{
			$('head').append('<link rel="stylesheet" href="'+$_pathname+'plugins/system/ytshortcodes/assets/css/loadconfig/farbtastic.css" type="text/css" />');
			$('head').append('<link rel="stylesheet" href="'+$_pathname+'plugins/system/ytshortcodes/assets/css/loadconfig/simpleslider.css" type="text/css" />');
			$('head').append('<script rel="text/javascript" src="'+$_pathname+'plugins/system/ytshortcodes/assets/js/loadconfig/farbtastic.js"  /></script>');
			$('head').append('<script rel="text/javascript" src="'+$_pathname+'plugins/system/ytshortcodes/assets/js/loadconfig/simpleslider.js"  /></script>');
			add_css_js = 1;
		}
		
		 
		$(".yt_shortcodes_plugin").show(500);
		$(".yt_shortcode_overlay").show();
		$(".yt_shortcodes_plugin").css("display","block");
		$(".yt_shortcode_overlay").css("display","block");
		$("#yt-generator-choices").show(500);
		$(".yt_shortcodes_close").show(500);
		$(".yt_shortcodes_list_shortcodes").css("display","block");
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
	$(".yt_shortcode_element").click(function(){
		var element = $(this).attr("data-shortcode");
		var desc = $(this).attr("data-desc");
		var name = $(this).attr("data-name");
		var ajax_url = window.location.href;
		
		$.ajax({
			type: "POST",
			url: ajax_url,
			data: {
				get_form_shortcodes: 1,
				element: element,
				desc :desc,
				name :name,
			},
			beforeSend: function () {
				// Show loading animation
				$(".yt_shortcodes_list_shortcodes").hide();
				$("#yt-generator-filter").hide(500);
				$(".yt_shortcode_element_config").addClass("yt-generator-loading").show();
			},
			success: function (data) {
				// Hide loading animation
				$(".yt_shortcode_element_config").removeClass("yt-generator-loading");
				$(".yt_shortcode_element_config").show();
				$(".yt_shortcode_element_config").html(data["html"]);
				
				$(".yt_shortcodes_add_element").click(function(){
						
						change_slider();
						change_color();
						change_icon();
						change_border();
						change_shadow();
						change_bool();
					});
				// Init switches
				function change_bool(){
					//$(document).on("click",".yt-generator-switch",function(e){
					$('.yt-generator-switch').unbind('click').click(function (index) {
					// Prepare data
						var $switch = $(this),
							$value = $switch.parent().children("input"),
							is_on = $value.val() === "yes";
						// Disable
						if (is_on) {
							// Change value
							$value.val("no").trigger("change");
						}
						// Enable
						else {
							// Change value
							$value.val("yes").trigger("change");
						}
						//e.preventDefault();
					});
					$('.yt-generator-switch-value').on('change', function () {
						// Prepare data
						var $value = $(this),
							$switch = $value.parent().children(".yt-generator-switch"),
							value = $value.val();
						// Disable
						if (value === "yes") $switch.removeClass("yt-generator-switch-no").addClass("yt-generator-switch-yes");
						// Enable
						else if (value === "no") $switch.removeClass("yt-generator-switch-yes").addClass("yt-generator-switch-no");
					});
				}
				change_bool();
				// change slider 
				function change_slider(){
					$(".yt-generator-range-picker").each(function (index) {	
						var $picker = $(this),
							$val = $picker.find("input"),
							min = $val.attr("min"),
							max = $val.attr("max"),
							step = $val.attr("step");
						// Apply noUIslider
						$val.simpleSlider({
							snap: true,
							step: step,
							range: [min, max]
						});
						$val.attr("type", "text").show();
						$val.on("keyup blur", function (e) {
							$val.simpleSlider("setValue", $val.val());
						});
					});
				}
				change_slider();
				// Init border pickers
				function change_border(){
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
						// Init color picker
						$color.wheel.farbtastic($color.value);
						$color.value.focus(function () {
							$color.wheel.show();
						});
						$color.value.blur(function () {
							$color.wheel.hide();
						});
						// Handle text fields
						$fields.on("change blur keyup", function () {
							$val.val($width.val() + "px " + $style.val() + " " + $color.value.val()).trigger("change");
						});
						$val.on("keyup", function () {
							var value = $(this).val().split(" ");
							// Value is correct
							if (value.length === 3) {
								$width.val(value[0].replace("px", ""));
								$style.val(value[1]);
								$color.value.val(value[2]);
								$fields.trigger("keyup");
							}
						});
					});
				}
				change_border();
				// Init shadow pickers
				function change_shadow(){
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
						// Init color picker
						$color.wheel.farbtastic($color.value);
						$color.value.focus(function () {
							$color.wheel.show();
						});
						$color.value.blur(function () {
							$color.wheel.hide();
						});
						// Handle text fields
						$fields.on("change blur keyup", function () {
							$val.val($hoff.val() + "px " + $voff.val() + "px " + $blur.val() + "px " + $color.value.val()).trigger("change");
						});
						$val.on("keyup", function () {
							var value = $(this).val().split(" ");
							// Value is correct
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
				change_shadow();
				// Init value setters
					$('body').on('click','.yt-generator-set-value', function(e){
					//$(".yt-generator-set-value").click(function (e) {
						$(this).parents(".yt-generator-field-container").find("input").val($(this).text()).trigger("change");
					});
				// Init icon pickers
				function change_icon(){
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
							// Hide all choices
							$icons.hide();
							// Find searched choices and show
							$icons.each(function () {
								// Get shortcode name
								var name = $(this).attr("title");
								// Show choice if matched
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
				change_icon();
				// Init color pickers
				function change_color(){
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
				change_color();
				// Init image sourse pickers
				$(".yt-generator-isp").each(function () {
					var $picker = $(this),
						$sources = $picker.find(".yt-generator-isp-sources"),
						$source = $picker.find(".yt-generator-isp-source"),
						$add_media = $picker.find(".yt-generator-isp-add-media"),
						$images = $picker.find(".yt-generator-isp-images"),
						$cats = $picker.find(".yt-generator-isp-categories"),
						$k2cats = $picker.find(".yt-generator-isp-k2-categories"),
						$taxes = $picker.find(".yt-generator-isp-taxonomies"),
						$terms = $(".yt-generator-isp-terms"),
						$val = $picker.find(".yt-generator-attr"),
						frame;
					// Update hidden value
					var update = function () {
						var val = "none",
							ids = "",
							source = $sources.val();
						// Media library
						if (source === "media") {
							var images = [];
							$images.find("span").each(function (i) {
								images[i] = $(this).data("id");
							});
							if (images.length > 0) ids = images.join(",");
						}
						// Category
						else if (source === "category") {
							var categories = $cats.val() || [];
							if (categories.length > 0) ids = categories.join(",");
						}
						// k2 Category
						else if (source === "k2-category") {
							var k2_categories = $k2cats.val() || [];
							if (k2_categories.length > 0) ids = k2_categories.join(",");
							
						}
						// Taxonomy
						else if (source === "taxonomy") {
							var tax = $taxes.val() || "",
								terms = $terms.val() || [];
							if (tax !== "0" && terms.length > 0) val = "taxonomy: " + tax + "/" + terms.join(",");
						}
						// Deselect
						else if (source === "0") {
							val = "none";
						}
						// Other options
						else {
							val = source;
						}
						if (ids !== "") val = source + ": " + ids;
						$val.val(val).trigger("change");
					}
					// Switch source
					$sources.on("change", function (e) {
						var source = $(this).val();
						e.preventDefault();
						$source.removeClass("yt-generator-isp-source-open");
						if (source.indexOf(":") === -1) $picker.find(".yt-generator-isp-source-" + source).addClass("yt-generator-isp-source-open");
						update();
					});
					function change_sources(){
						var $picker = $('.yt-generator-isp'),
							$sources = $picker.find(".yt-generator-isp-sources");
						var source = $sources.val();
						$source.removeClass("yt-generator-isp-source-open");
						if (source.indexOf(":") === -1) $picker.find(".yt-generator-isp-source-" + source).addClass("yt-generator-isp-source-open");
						update();
					}
					change_sources();
					// Remove image
					$images.on("click", "span i", function () {
						$(this).parent("span").css("border-color", "#f03").fadeOut(300, function () {
							$(this).remove();
							update();
						});
					});
					// Add image
					$add_media.click(function (e) {
						e.preventDefault();
					});
					// Select categories and terms
					$cats.on("change", update);
					$k2cats.on("change", update);
					$terms.on("change", update);
					// Select taxonomy
					$taxes.on("change", function () {
						var $cont = $(this).parents(".yt-generator-isp-source"),
							tax = $(this).val();
						// Remove terms
						$terms.hide().find("option").remove();
						update();
						// Taxonomy is not selected
						if (tax === "0") return;
						// Taxonomy selected
						else {
							var ajax_term_select = $.ajax({
								url: ajaxurl,
								type: "post",
								dataType: "html",
								data: {
									"action": "yt_generator_get_terms",
									"tax": tax,
									"class": "yt-generator-isp-terms",
									"multiple": true,
									"size": 10
								},
								beforeSend: function () {
									if (typeof ajax_term_select === "object") ajax_term_select.abort();
									$terms.html("").attr("disabled", true).hide();
									$cont.addClass("yt-generator-loading");
								},
								success: function (data) {
									$terms.html(data).attr("disabled", false).show();
									$cont.removeClass("yt-generator-loading");
								}
							});
						}
					});
				});
				
				$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').each(function () {
					var group = $(this).data('group');
					// Show choice if matched
					if (group =="all" || group == $(".yt_shortcodes_wrap_form_element #yt-generator-attr-type_change").val())
					{
						$(this).show();
					}else{
						$(this).hide();
					}
				});	
				$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').each(function () {
				var group = $(this).data('group');
				// Show choice if matched
				if (group =="all" || group == $(".yt_shortcodes_wrap_form_element #yt-generator-attr-type_change").val())
				{
					$(this).show();
				}else{
					$(this).hide();
				}	
				
				});	
				
				$("#yt-generator-attr-type_change").change(function(){
					var change = $(this).val();
					var regex = new RegExp(change, 'gi');
					// Hide all choices
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').hide();
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').hide();
					// Find searched choices and show
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').each(function () {
						// Get shortcode name
						var group = $(this).data('group');
						// Show choice if matched
						if (group.match(regex) !== null || group =="all") 
						$(this).show();
					});
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').each(function () {
						// Get shortcode name
						var group = $(this).data('group');
						// Show choice if matched
						if (group.match(regex) !== null || group =="all") 
						$(this).show();
					});
				});
				$(".yt-generator-isp-sources").change(function(){
					var change = $(this).val();
					var regex = new RegExp(change, 'gi');
					// Hide all choices
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').hide();
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').hide();
					// Find searched choices and show
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-container').each(function () {
						// Get shortcode name
						var group = $(this).data('group');
						// Show choice if matched
						if (group.match(regex) !== null || group =="all") 
						$(this).show();
					});
					$('.yt_shortcodes_wrap_form_element .yt-generator-field-group').each(function () {
						// Get shortcode name
						var group = $(this).data('group');
						// Show choice if matched
						if (group.match(regex) !== null || group =="all") 
						$(this).show();
					});
				});
			},
			dataType: "json"
		});
	});
		
});
