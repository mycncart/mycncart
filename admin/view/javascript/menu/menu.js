$(document).ready(function () {
    ocmegamenu.initSortMenuItem();
});

var ocmegamenu = {
    'initSortMenuItem' : function () {
        $('.top_sortable').sortable({
            placeholder: "ui-state-highlight ui-top-highlight",
            stop: function () {
                var position = 0;
                $('.top_item_content').each(function () {
                    $(this).find('.top-item-position').val(position);
                    position++;
                });
            }
        });

        $('.second_sortable').sortable({
            placeholder: "ui-state-highlight ui-second-highlight",
            stop: function () {
                $('.top_item_content').each(function () {
                    var position = 0;
                    $(this).find('.second_item_content').each(function () {
                        $(this).find('.sub-item-position2').val(position);
                        position++;
                    });
                });
            }
        });

        $('.third_sortable').sortable({
            placeholder: "ui-state-highlight ui-third-highlight",
            stop: function () {
                $('.top_item_content').each(function () {
                    $(this).find('.second_item_content').each(function () {
                        var position = 0;
                        $(this).find('.third_item_content').each(function () {
                            $(this).find('.sub-item-position3').val(position);
                            position++;
                        });
                    });
                });
            }
        });
        
        $('.widget-sortable').sortable({
            placeholder: "widget-block ui-state-highlight",
            items: "> .widget-block",
            start : function (event, ui) {
                var cols = ui.item.find('.widget-cols').val();
                $('.ui-state-highlight').addClass('col-sm-' + cols).html('<div class="widget-content"></div>');
                $('.widget-block').removeClass('w-transition');
            },
            stop : function (event, ui) {
                var position = 0;
                $('.widget-block').each(function () {
                    $(this).find('.widget-position').val(position);
                    position++;
                });
            }
        });
    },

    'appendTopItemNewForm': function (url) {
        $.ajax({
            url         : url,
            type        : 'get',
            beforeSend  : function () {
                $('#form-container-bg').show();
                $('#form-ajax-loader').show();
            },
            success : function (json) {
                $('#form-container').html(json['html']).show(600);
            }
        });
    },

    'appendAddSubItemForm' : function (parent_menu_item_id, level) {
        var url = $('#sub-item-form-url').val();
        $.ajax({
            url         : url + '&parent_id=' + parent_menu_item_id + '&level=' + level,
            type        : 'get',
            beforeSend  : function () {
                $('#form-container-bg').show();
                $('#form-ajax-loader').show();
            },
            success : function (json) {
                $('#form-container').addClass('sub-frm').html(json['html']).show(600);
            }
        });
    },

    'appendEditSubItemForm' : function (sub_item_id) {
        var url = $('#sub-item-edit-form-url').val();
        $.ajax({
            url         : url + '&sub_item_id=' + sub_item_id,
            type        : 'get',
            beforeSend  : function () {
                $('#form-container-bg').show();
                $('#form-ajax-loader').show();
            },
            success : function (json) {
                $('#form-container').addClass('sub-frm').html(json['html']).show(600);
            }
        });
    },

    'submitTopItemForm' : function (menu_id) {
        var url = $('#form-menu-item').attr('action');
        var text_success = $('#text-success-item').val();
        var flag = true;

        $.ajax({
            url     : url,
            type    : 'post',
            data    : $('#form-menu-item').serialize(),
            beforeSend  : function () {
                $('#form-container').html('').hide();
            },
            success : function (json) {
                if(json['submit'] === true) {
                    ocmegamenu.getItemsToContainer(menu_id);
                } else {
                    flag = false;
                    $('#form-container-bg').show();
                    $('#form-ajax-loader').show();
                    $('#form-container').html(json['html']).show(600);
                }
            },
            complete : function () {
                $('.alert').remove();
                if(flag) {
                    $('.panel-default').before('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + text_success + '\n' +
                        '            <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                        '        </div>');
                }
            }
        });
    },
    
    'submitSubItemForm' : function (menu_id) {
        var url = $('#form-menu-item').attr('action');
        var text_success = $('#text-success-item').val();
        var flag = true;
        
        $.ajax({
            url     : url,
            type    : 'post',
            data    : $('#form-menu-item').serialize(),
            beforeSend  : function () {
                $('#form-container').removeClass('sub-frm').html('').hide();
            },
            success : function (json) {
                if(json['submit'] === true) {
                    ocmegamenu.getItemsToContainer(menu_id);
                } else {
                    flag = false;
                    $('#form-container-bg').show();
                    $('#form-ajax-loader').show();
                    $('#form-container').addClass('sub-frm').html(json['html']).show(600);
                }
            },
            complete : function () {
                $('.alert').remove();
                if(flag) {
                    $('.panel-default').before('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + text_success + '\n' +
                        '            <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                        '        </div>');
                }
            }
        });
    },

    'deleteMenuItem' : function (url) {
        var text_confirm_delete = $('#text-confirm-delete').val();
        var text_success = $('#text-success-item').val();

        var flag = confirm(text_confirm_delete);
        if(flag) {
            var result = true;

            $.ajax({
                url         : url,
                type        : 'get',
                beforeSend  : function () {
                    $('#form-container-bg').show();
                    $('#form-ajax-loader').show();
                },
                success     : function (json) {
                    var menu_id = json['menu_id'];
                    if(json['result'] === true) {
                        ocmegamenu.getItemsToContainer(menu_id);
                    } else {
                        result = false;
                    }
                },
                complete : function () {
                    $('.alert').remove();
                    if(result) {
                        $('.panel-default').before('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + text_success + '\n' +
                            '            <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                            '        </div>');
                    }
                    ocmegamenu.closeForm();
                }
            });
        }
    },

    'deleteCheckItems' : function() {
        var text_confirm_multiple_delete = $('#text-confirm-multiple-delete').val();
        var text_choose_delete = $('#text-choose-delete').val();
        var text_success = $('#text-success-item').val();
        var isChecked = false;

        var top_item_id = [];
        var sub_item_id = []

        $('.top-ck-del:checked').each(function () {
            isChecked = true;
            top_item_id.push($(this).val());
        });

        $('.sub-ck-del:checked').each(function () {
            isChecked = true;
            sub_item_id.push($(this).val());
        });

        if(isChecked) {
            var flag = confirm(text_confirm_multiple_delete);
            if(flag) {
                var url = $('#multiple-del-url').val();
                var result = true;

                $.ajax({
                    url : url,
                    type : 'post',
                    data : {
                        'top_items' : top_item_id,
                        'sub_items' : sub_item_id
                    },
                    beforeSend  : function () {
                        $('#form-container-bg').show();
                        $('#form-ajax-loader').show();
                    },
                    success     : function (json) {
                        var menu_id = json['menu_id'];
                        if(json['result'] === true) {
                            ocmegamenu.getItemsToContainer(menu_id);
                        } else {
                            result = false;
                        }
                    },
                    complete : function () {
                        $('.alert').remove();
                        if(result) {
                            $('.panel-default').before('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + text_success + '\n' +
                                '            <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                                '        </div>');
                        }
                        ocmegamenu.closeForm();
                    }
                });
            }
        } else {
            alert(text_choose_delete);
        }
    },

    'getItemsToContainer' : function (menu_id) {
        var url = $('#get-top-item-url').val() + '&menu_id=' + menu_id;
        var text_add_sub_item = $('#input-add-sub-item').val();
        var text_no_items = $('#text-no-items').val();

        $.ajax({
            url         : url,
            type        : 'get',
            beforeSend  : function () {
                $('#form-container-bg').show();
                $('#form-ajax-loader').show();
            },
            success     : function (json) {
                var top_items = json['top_items'];
                var sub_items = [];
                var html = '';
                if(top_items) {
                    html += '<div class="top_item_container top_sortable">';
                    for(i in top_items) {
                        html += '<div class="top_item_content">';
                        html += '   <div class="top_item item row">';
                        html += '       <div class="del-name col-sm-6">';
                        html += '           <div class="del-action">';
                        html += '               <input type="checkbox" class="ck-del top-ck-del" value="' + top_items[i]['menu_item_id'] + '" />';
                        html += '           </div>';
                        html += '           <i class="fa fa-ellipsis-v" aria-hidden="true"></i>';
                        html += '           <div class="name"><span>' + top_items[i]['name'] + '</span></div>';
                        html += '       </div>';
                        html += '       <div class="action col-sm-6">';
                        html += '           <a href="javascript:void(0)" onclick="ocmegamenu.appendTopItemNewForm(\'' + top_items[i]['url'] + '\')" class="a-config"><i class="fa fa-cogs"></i></a>';
                        html += '           <a href="javascript:void(0)" onclick="ocmegamenu.deleteMenuItem(\'' + top_items[i]['del_url'] + '\')" class="a-delete"><i class="fa fa-trash"></i></a>';
                        html += '           <a href="javascript:void(0)" onclick="ocmegamenu.appendAddSubItemForm(\'' + top_items[i]['menu_item_id'] + '\', \'2\')" class="a-config"><i class="fa fa-plus"></i> ' + text_add_sub_item + '</a>';
                        html += '       </div>';
                        html += '   </div>';

                        if(top_items[i]['sub_items']) {
                            sub_items = top_items[i]['sub_items'];
                            html += '<div class="second_item_container second_sortable">';
                            for(j in sub_items) {
                                html += '<div class="second_item_content">';
                                html += '   <div class="second_item item row">';
                                html += '       <div class="del-name col-sm-6">';
                                html += '           <div class="del-action">';
                                html += '               <input type="checkbox" class="ck-del sub-ck-del" value="' + sub_items[j]['item_id'] + '" />';
                                html += '           </div>';
                                html += '           <i class="fa fa-ellipsis-v" aria-hidden="true"></i>';
                                html += '           <div class="name"><span>' + sub_items[j]['name'] + '</span></div>';
                                html += '       </div>';
                                html += '       <div class="action col-sm-6">';
                                html += '           <a href="javascript:void(0)" onclick="ocmegamenu.appendEditSubItemForm(\'' + sub_items[j]['item_id'] + '\')" class="a-config"><i class="fa fa-cogs"></i></a>';
                                html += '           <a href="javascript:void(0)" onclick="ocmegamenu.deleteMenuItem(\'' + sub_items[j]['del_url'] + '\')" class="a-delete"><i class="fa fa-trash"></i></a>';
                                html += '           <a href="javascript:void(0)" onclick="ocmegamenu.appendAddSubItemForm(\'' + sub_items[j]['item_id'] + '\', \'3\')" class="a-config"><i class="fa fa-plus"></i> ' + text_add_sub_item + '</a>';
                                html += '       </div>';
                                html += '   </div>';

                                if(sub_items[j]['sub_items']) {
                                    s_items = sub_items[j]['sub_items'];
                                    html += '<div class="third_item_container third_sortable">';
                                    for(k in s_items) {
                                        html += '<div class="third_item_content">';
                                        html += '   <div class="third_item item row">';
                                        html += '       <div class="del-name col-sm-6">';
                                        html += '           <div class="del-action">';
                                        html += '               <input type="checkbox" class="ck-del sub-ck-del" value="' + s_items[k]['item_id'] + '" />';
                                        html += '           </div>';
                                        html += '           <i class="fa fa-ellipsis-v" aria-hidden="true"></i>';
                                        html += '           <div class="name"><span>' + s_items[k]['name'] + '</span></div>';
                                        html += '       </div>';
                                        html += '       <div class="action col-sm-6">';
                                        html += '           <a href="javascript:void(0)" onclick="ocmegamenu.appendEditSubItemForm(\'' + s_items[k]['item_id'] + '\')" class="a-config"><i class="fa fa-cogs"></i></a>';
                                        html += '           <a href="javascript:void(0)" onclick="ocmegamenu.deleteMenuItem(\'' + s_items[k]['del_url'] + '\')" class="a-delete"><i class="fa fa-trash"></i></a>';
                                        html += '       </div>';
                                        html += '   </div>';
                                        html += '   <input type="hidden" class="sub-item-position3" name="sub_item_position3[' + s_items[k]['item_id'] + ']" value="' + s_items[k]['position'] + '"/>';
                                        html += '</div>';
                                    }
                                    html += '</div>';
                                }

                                html += '   <input type="hidden" class="sub-item-position2" name="sub_item_position2[' + sub_items[j]['item_id'] + ']" value="' + sub_items[j]['position'] + '"/>';
                                html += '</div>';
                            }
                            html += '</div>';
                        }

                        html += '   <input type="hidden" class="top-item-position" name="top_item_position[' + top_items[i]['menu_item_id'] + ']" value="' + top_items[i]['position'] + '"/>';
                        html += '</div>';
                    }
                    html += '</div>';
                } else {
                    html += '<p class="text-center">' + text_no_items + '</p>';
                }
                $('.menu_item_container').html(html);
            },
            complete    : function () {
                ocmegamenu.initSortMenuItem();
                ocmegamenu.closeForm();
            }
        });
    },

    'addCategoryWidget' : function () {
        var category_id = $('#input-sub-menu-category').val();
        var text_show_image = $('#text-show-image').val();
        var text_show_child = $('#text-show-child').val();
        var text_no_children_items = $('#text-no-children-items').val();
        var url = $('#input-append-categories-link').val() + '&category_id=' + category_id;
        var html = '';

        $.ajax({
            url     : url,
            type    : 'get',
            beforeSend  : function () {
                $('#widget-type-category-container .p-widget-items').remove();
                $('.frm-loader-img').show();
            },
            success : function (json) {
                $('#widget-type-category-container').html('');
                var child_categories = json['child_categories'];

                if(child_categories) {
                    for(i in child_categories) {
                        html += '<div class="widget-block col-sm-2">';
                        html += '   <div class="widget-content">';
                        html += '       <div class="widget-resize-action">';
                        html += '           <a class="a-resize-minus a-left" onclick="ocmegamenu.decreaseColumn($(this))"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>';
                        html += '           <a class="a-resize-plus a-left" onclick="ocmegamenu.increaseColumn($(this))"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
                        html += '           <a class="a-delete a-right" onclick="ocmegamenu.deleteWidget($(this))"><i class="fa fa-times-circle" aria-hidden="true"></i></a>';
                        html += '           <a class="a-config a-right" onclick="ocmegamenu.showWidgetConfiguration($(this))"><i class="fa fa-cogs" aria-hidden="true"></i></a>';
                        html += '       </div>';
                        html += '       <div class="widget-name-container">';
                        html += '           <i class="fa fa-star" aria-hidden="true"></i><span class="name">' + child_categories[i]['name'] + '</span>';
                        html += '       </div>';
                        html += '   </div>';
                        html += '   <div class="widget-configuration">';
                        html += '       <div><input type="checkbox" class="show-image" /> ' + text_show_image + '</div>';
                        html += '       <div><input type="checkbox" class="show-child" /> ' + text_show_child + '</div>';
                        html += '   </div>';
                        html += '   <input type="hidden" class="widget-name" value="' + child_categories[i]['name'] + '" name="widget[category][' + i + '][name]" />';
                        html += '   <input type="hidden" class="widget-type" value="category" name="widget[category][' + i + '][type]" />';
                        html += '   <input type="hidden" class="widget-cols" value="2" name="widget[category][' + i + '][cols]" />';
                        html += '   <input type="hidden" class="widget-position" value="' + i + '" name="widget[category][' + i + '][position]" />';
                        html += '   <input type="hidden" class="widget-category-id" value="' + child_categories[i]['category_id'] + '" name="widget[category][' + i + '][category_id]" />';
                        html += '   <input type="hidden" class="widget-show-image" value="0" name="widget[category][' + i + '][show_image]" />';
                        html += '   <input type="hidden" class="widget-show-child" value="0" name="widget[category][' + i + '][show_child]" />';
                        html += '</div>';
                    }

                    $('#input-has-child').val('1');
                    $('#widget-type-category-container').html(html);
                } else {
                    $('#input-has-child').val('0');
                    $('#widget-type-category-container').html('<p class="p-widget-items">' + text_no_children_items + '</p>');
                }

                $('#input-link').val(json['category_link']);
                $('#input-category-id').val(category_id);
            },
            complete: function() {
                $('.frm-loader-img').hide();
                ocmegamenu.checkBoxClick();
                ocmegamenu.initSortMenuItem();
            }
        });
    },

    'addWidget': function() {
        var user_token = $('#text-user-token').val();
        var widget_type = $('#widget-type').val();
        var widget_cols = $('#widget-cols').val();
        var sub_content_type = $('#input-sub-menu-content-type').val();

        var text_show_image = $('#text-show-image').val();
        var text_show_child = $('#text-show-child').val();
        var text_choose_category = $('#text-choose-category').val();
        var text_choose_product = $('#text-choose-product').val();
        var text_title = $('#text-title').val();
        var text_link = $('#text-link').val();
        var text_html = $('#text-html').val();
        var text_hide_title = $('#text-hide-title').val();

        var i = $('.widget-block').length;
        if(i === null) i = 0;

        $('#widget-type-'+ sub_content_type +'-container .p-widget-items').hide();

        var html = '';

        html += '<div class="widget-block col-sm-'+ widget_cols +'">';
        html += '   <div class="widget-content">';
        html += '       <div class="widget-resize-action">';
        html += '           <a class="a-resize-minus a-left" onclick="ocmegamenu.decreaseColumn($(this))"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>';
        html += '           <a class="a-resize-plus a-left" onclick="ocmegamenu.increaseColumn($(this))"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
        html += '           <a class="a-delete a-right" onclick="ocmegamenu.deleteWidget($(this))"><i class="fa fa-times-circle" aria-hidden="true"></i></a>';
        html += '           <a class="a-config a-right" onclick="ocmegamenu.showWidgetConfiguration($(this))"><i class="fa fa-cogs" aria-hidden="true"></i></a>';
        html += '       </div>';
        html += '       <div class="widget-name-container">';
        html += '           <i class="fa fa-star" aria-hidden="true"></i><span class="name">...</span>';
        html += '       </div>';
        html += '   </div>';

        if (widget_type == 'category') {
            html += '<div class="widget-configuration">';
            html += '   <div class="option"><input type="text" class="w-category" placeholder="' + text_choose_category + '" /></div>';
            html += '   <div class="option"><input type="checkbox" class="show-image" /> ' + text_show_image + '</div>';
            html += '   <div class="option"><input type="checkbox" class="show-child" /> ' + text_show_child + '</div>';
            html += '</div>';
            html += '<input type="hidden" class="widget-name" value="" name="widget['+ sub_content_type +'][' + i + '][name]" />';
        }

        if (widget_type == 'product') {
            html += '<div class="widget-configuration">';
            html += '   <div class="option"><input type="text" class="w-product" placeholder="' + text_choose_product + '" /></div>';
            html += '   <div class="option"><input type="checkbox" class="show-image" /> ' + text_show_image + '</div>';
            html += '</div>';
            html += '<input type="hidden" class="widget-name" value="" name="widget['+ sub_content_type +'][' + i + '][name]" />';
        }

        if(widget_type == 'html') {
            html += '<div class="widget-configuration">';
            html += '   <ul class="nav nav-tabs ul-widget-lang" id="ul-widget-html-' + i + '">';
            html += '   </ul>';
            html += '   <div class="tab-content" id="tab-widget-html-' + i + '">';
            html += '   </div>';
            html += '   <div class="option"><input type="checkbox" class="show-title" /> ' + text_hide_title + '</div>';
            html += '</div>';

            $.ajax({
                url : 'index.php?route=extension/module/ocmegamenu/getLanguageData&user_token=' + user_token,
                type: 'get',
                success : function (json) {
                    $.each(json['languages'], function (item, value) {
                        $('#ul-widget-html-' + i).append('<li><a href="#widget-html-language' + value.language_id + '-' + i + '" data-toggle="tab">' +
                            '<img src="language/' + value.code + '/' + value.code + '.png" title="' + value.name + '" /> ' + value.name + '</a></li>');
                        
                        var tab_html = '';
                        tab_html += '<div class="tab-pane" id="widget-html-language' + value.language_id + '-' + i + '">';
                        tab_html += '   <div class="option"><input type="text" name="widget['+ sub_content_type +'][' + i + '][name][' + value.language_id + ']" placeholder="' + text_title + '" /></div>';
                        tab_html += '   <div class="option">';
                        tab_html += '       <textarea data-toggle="summernote" rows="10" class="w-html-content" name="widget['+ sub_content_type +'][' + i + '][content][' + value.language_id + ']" placeholder="' + text_html + '"></textarea>';
                        tab_html += '   </div>';
                        tab_html += '</div>';
                        
                        $('#tab-widget-html-' + i).append(tab_html);
                    });
                },
                complete : function () {
                    $('#ul-widget-html-' + i + ' a:first').tab('show');
                    ocmegamenu.initSortMenuItem();
                    ocmegamenu.initSummerNote();
                    ocmegamenu.checkBoxClick();
                }
            });
        }

        if(widget_type == 'link') {
            html += '<div class="widget-configuration">';
            html += '   <ul class="nav nav-tabs ul-widget-lang" id="ul-widget-link-' + i + '">';
            html += '   </ul>';
            html += '   <div class="tab-content" id="tab-widget-link-' + i + '">';
            html += '   </div>';
            html += '   <div class="option"><input type="text" name="widget['+ sub_content_type +'][' + i + '][link]" placeholder="' + text_link + '" /></div>';
            html += '</div>';

            $.ajax({
                url : 'index.php?route=extension/module/ocmegamenu/getLanguageData&user_token=' + user_token,
                type: 'get',
                success : function (json) {
                    $.each(json['languages'], function (item, value) {
                        $('#ul-widget-link-' + i).append('<li><a href="#widget-link-language' + value.language_id + '-' + i + '" data-toggle="tab">' +
                            '<img src="language/' + value.code + '/' + value.code + '.png" title="' + value.name + '" /> ' +
                            value.name +
                            '</a></li>');

                        var tab_html = '';
                        tab_html += '<div class="tab-pane" id="widget-link-language' + value.language_id + '-' + i + '">';
                        tab_html += '   <div class="option"><input type="text" name="widget['+ sub_content_type +'][' + i + '][name][' + value.language_id + ']" placeholder="' + text_title + '" /></div>';
                        tab_html += '</div>';

                        $('#tab-widget-link-' + i).append(tab_html);
                    });
                },
                complete : function () {
                    $('#ul-widget-link-' + i + ' a:first').tab('show');
                    ocmegamenu.initSortMenuItem();
                    ocmegamenu.checkBoxClick();
                }
            });
        }

        html += '   <input type="hidden" class="widget-type" value="' + widget_type + '" name="widget[' + sub_content_type + '][' + i + '][type]" />';
        html += '   <input type="hidden" class="widget-cols" value="' + widget_cols + '" name="widget[' + sub_content_type + '][' + i + '][cols]" />';
        html += '   <input type="hidden" class="widget-position" value="' + i + '" name="widget[' + sub_content_type + '][' + i + '][position]" />';

        if (widget_type == 'category') {
            html += '   <input type="hidden" class="widget-category-id" value="" name="widget[' + sub_content_type + '][' + i + '][category_id]" />';
            html += '   <input type="hidden" class="widget-show-image" value="0" name="widget[' + sub_content_type + '][' + i + '][show_image]" />';
            html += '   <input type="hidden" class="widget-show-child" value="0" name="widget[' + sub_content_type + '][' + i + '][show_child]" />';
        }

        if (widget_type == 'product') {
            html += '   <input type="hidden" class="widget-product-id" value="" name="widget[' + sub_content_type + '][' + i + '][product_id]" />';
            html += '   <input type="hidden" class="widget-show-image" value="0" name="widget[' + sub_content_type + '][' + i + '][show_image]" />';
        }

        if(widget_type == 'html') {
            html += '   <input type="hidden" class="widget-show-title" value="1" name="widget[' + sub_content_type + '][' + i + '][show_title]" />';
        }
        html += '</div>';

        $('#input-has-child').val('1');

        $('#widget-type-'+ sub_content_type +'-container').append(html);

        ocmegamenu.initSortMenuItem();
        ocmegamenu.chooseCategory();
        ocmegamenu.chooseProduct();
        ocmegamenu.initSummerNote();
        ocmegamenu.checkBoxClick();
    },

    'deleteWidget'  : function (element) {
        element.closest('.widget-block').remove();
        var position = 0;
        $('.widget-block').each(function () {
            $(this).find('.widget-position').val(position);
            position++;
        });
    },

    'increaseColumn' : function (element) {
        var cols = parseInt(element.closest('.widget-block').find('.widget-cols').val());

        if(cols < 12) {
            cols += 1;
            element.closest('.widget-block').find('.widget-cols').val(cols);
            element.closest('.widget-block').removeClass().addClass('widget-block').addClass('w-transition').addClass('col-sm-' + cols);
        }

        ocmegamenu.initSortMenuItem();
    },

    'decreaseColumn' : function (element) {
        var cols = element.closest('.widget-block').find('.widget-cols').val();

        if(cols > 2) {
            cols -= 1;
            element.closest('.widget-block').find('.widget-cols').val(cols);
            element.closest('.widget-block').removeClass().addClass('widget-block').addClass('w-transition').addClass('col-sm-' + cols);
        }

        ocmegamenu.initSortMenuItem();
    },

    'showWidgetConfiguration'   : function (element) {
        var configuration = element.closest('.widget-block').find('.widget-configuration');

        if(configuration.hasClass('active')) {
            configuration.removeClass('active');
            $('.widget-sortable').sortable("enable");
        } else {
            $('.widget-sortable').sortable("disable");
            $('.widget-configuration').removeClass('active');
            configuration.addClass('active');
        }
    },

    'closeForm' : function () {
        $('#form-container-bg').hide();
        $('#form-ajax-loader').hide();
        $('#form-container').removeClass('sub-frm').html('').hide();
    },

    'chooseCategory' : function () {
        var user_token = $('#text-user-token').val();

        $('.w-category').customAutoComplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=extension/module/ocmegamenu/autoCompleteCategory&user_token=' + user_token + '&filter_name=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['category_id']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $(this).val(item['label']);
                $(this).closest('.widget-block').find('.widget-category-id').val(item['value']);
                $(this).closest('.widget-block').find('.widget-name').val(item['label']);
                $(this).closest('.widget-block').find('.widget-content').find('.widget-name-container').find('.name').html(item['label']);
            }
        });
    },

    'chooseProduct' : function () {
        var user_token = $('#text-user-token').val();

        $('.w-product').customAutoComplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=catalog/product/autocomplete&user_token=' + user_token + '&filter_name=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['product_id']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $(this).val(item['label']);
                $(this).closest('.widget-block').find('.widget-product-id').val(item['value']);
                $(this).closest('.widget-block').find('.widget-name').val(item['label']);
                $(this).closest('.widget-block').find('.widget-content').find('.widget-name-container').find('.name').html(item['label']);
            }
        });
    },

    'checkBoxClick' : function () {
        $('.show-image').change(function () {
            var show_image = $(this).closest('.widget-block').find('.widget-show-image').val();
            if(show_image == '1') {
                $(this).closest('.widget-block').find('.widget-show-image').val('0');
            } else {
                $(this).closest('.widget-block').find('.widget-show-image').val('1');
            }
        });

        $('.show-child').change(function () {
            var show_child = $(this).closest('.widget-block').find('.widget-show-child').val();
            if(show_child == '1') {
                $(this).closest('.widget-block').find('.widget-show-child').val('0');
            } else {
                $(this).closest('.widget-block').find('.widget-show-child').val('1');
            }
        });
        
        $('.show-title').change(function () {
            var show_title = $(this).closest('.widget-block').find('.widget-show-title').val();
            if(show_title == '1') {
                $(this).closest('.widget-block').find('.widget-show-title').val('0');
            } else {
                $(this).closest('.widget-block').find('.widget-show-title').val('1');
            }
        });
    },

    'initSummerNote' : function () {
        // Override summernotes image manager
        $('[data-toggle=\'summernote\']').each(function() {
            var element = this;

            if ($(this).attr('data-lang')) {
                $('head').append('<script type="text/javascript" src="view/javascript/summernote/lang/summernote-' + $(this).attr('data-lang') + '.js"></script>');
            }

            $(element).summernote({
                lang: $(this).attr('data-lang'),
                disableDragAndDrop: true,
                height: 300,
                emptyPara: '',
                codemirror: { // codemirror options
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                },
                fontsize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
                toolbar: [
                    ['font', ['bold', 'underline', 'italic']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'image']],
                    ['view', ['codeview']]
                ],
                popover: {
                    image: [
                        ['custom', ['imageAttributes']],
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                },
                buttons: {
                    image: function() {
                        var ui = $.summernote.ui;

                        // create button
                        var button = ui.button({
                            contents: '<i class="note-icon-picture" />',
                            tooltip: $.summernote.lang[$.summernote.options.lang].image.image,
                            click: function () {
                                $('#modal-image').remove();

                                $.ajax({
                                    url: 'index.php?route=common/filemanager&user_token=' + getURLVar('user_token'),
                                    dataType: 'html',
                                    beforeSend: function() {
                                        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                                        $('#button-image').prop('disabled', true);
                                    },
                                    complete: function() {
                                        $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
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
};

// Autocomplete */
(function($) {
    $.fn.customAutoComplete = function(option) {
        return this.each(function() {
            var $this = $(this);
            var $dropdown = $('<ul class="dropdown-menu" />');

            this.timer = null;
            this.items = [];

            $.extend(this, option);

            $this.attr('autocomplete', 'off');

            // Focus
            $this.on('focus', function() {
                this.request();
            });

            // Blur
            $this.on('blur', function() {
                setTimeout(function(object) {
                    object.hide();
                }, 200, this);
            });

            // Keydown
            $this.on('keydown', function(event) {
                switch(event.keyCode) {
                    case 27: // escape
                        this.hide();
                        break;
                    default:
                        this.request();
                        break;
                }
            });

            // Click
            this.click = function(event) {
                event.preventDefault();

                var value = $(event.target).parent().attr('data-value');

                if (value && this.items[value]) {
                    this.select(this.items[value]);
                }
            }

            // Show
            this.show = function() {
                var pos = $this.position();

                $dropdown.css({
                    top: pos.top + $this.outerHeight(),
                    left: pos.left
                });

                $dropdown.show();
            }

            // Hide
            this.hide = function() {
                $dropdown.hide();
            }

            // Request
            this.request = function() {
                clearTimeout(this.timer);

                this.timer = setTimeout(function(object) {
                    object.source($(object).val(), $.proxy(object.response, object));
                }, 200, this);
            }

            // Response
            this.response = function(json) {
                var html = '';
                var category = {};
                var name;
                var i = 0, j = 0;

                if (json.length) {
                    for (i = 0; i < json.length; i++) {
                        // update element items
                        this.items[json[i]['value']] = json[i];

                        if (!json[i]['category']) {
                            // ungrouped items
                            html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
                        } else {
                            // grouped items
                            name = json[i]['category'];
                            if (!category[name]) {
                                category[name] = [];
                            }

                            category[name].push(json[i]);
                        }
                    }

                    for (name in category) {
                        html += '<li class="dropdown-header">' + name + '</li>';

                        for (j = 0; j < category[name].length; j++) {
                            html += '<li data-value="' + category[name][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[name][j]['label'] + '</a></li>';
                        }
                    }
                }

                if (html) {
                    this.show();
                } else {
                    this.hide();
                }

                $dropdown.html(html);
            }

            $dropdown.on('click', '> li > a', $.proxy(this.click, this));
            $this.after($dropdown);
        });
    }
})(window.jQuery);