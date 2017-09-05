<?php
// Heading
$_['heading_title']     			= 'Excel格式导入导出商品数据';

// Text
$_['text_success']      			= '成功: 已导入商品数据!';
$_['text_nochange']     			= '数据没有任何更新。';
$_['text_log_details']  			= '请查看系统里面的日志错误';
$_['text_select_file_to_import']  	= '选择导入文件';
$_['text_select_type_to_export']  	= '选择导出类型';
$_['text_edit']  				    = 'Excel格式导入导出商品数据 - (在线教程: <a href="http://www.mycncart.com/blog-141.html" target="_blank">http://www.mycncart.com/blog-141.html</a>)';

// Entry
$_['entry_restore']     			= '从excel文件导入商品数据';
$_['entry_description'] 			= '使用Excel表格管理您的商品数据';
$_['entry_exportway_sel'] 			= '选择导出商品数据的方式';
$_['entry_start_id'] 				= '商品起始ID号';
$_['entry_end_id'] 					= '商品终止ID号';
$_['entry_start_index'] 			= '每批次商品个数';
$_['entry_end_index'] 				= '批次编号';


// Button
$_['button_import']     			= '导入';
$_['button_export']     			= '导出';
$_['button_export_pid']     		= '根据商品ID号导出';
$_['button_export_page']     		= '批次导出';

//Error
$_['error_exist_product'] 			= '商品ID %s 已经存在于数据库中，请检查Excel文件！';
$_['error_permission']          	= '警告: 无权限修改本插件！';
$_['error_upload']              	= '上传文件不是有效excel文件，或者文件内容数据格式不符!';
$_['error_sheet_count']         	= '无效工作表数目，应该为8个工作表';
$_['error_categories_header']   	= '分类工作表顶部无效';
$_['error_filtergroups_header']   	= '筛选组工作表顶部无效';
$_['error_filters_header']   		= '筛选工作表顶部无效';
$_['error_products_header']     	= '商品工作表顶部无效';
$_['error_descriptions_header']     = '商品描述工作表顶部无效';
$_['error_additionalimages_header'] = '商品附加图片工作表顶部无效';
$_['error_product_options_header']  = '商品选项工作表顶部无效';
$_['error_options_header']      	= '选项工作表顶部无效';
$_['error_option_values_header']    = '选项值工作表顶部无效';
$_['error_attributes_header']  	 	= '属性工作表顶部无效';
$_['error_specials_header']     	= '特价商品工作表顶部无效';
$_['error_discounts_header']    	= '折扣工作表顶部无效';
$_['error_rewards_header']      	= '奖励积分工作表顶部无效';
$_['error_select_file']         	= '点击【导入】前请先选择文件';
$_['error_post_max_size']       	= '文件大小大于了PHP设定【post_max_size】超过 %1 ';
$_['error_upload_max_filesize'] 	= '文件大小大于了PHP设定【upload_max_file_size】超过 %1 ';
$_['error_pid_no_data']         	= '不存在介于开始商品ID和结束商品ID号之间的商品。';
$_['error_page_no_data']        	= '没有更多符合条件商品。';
$_['error_param_not_number']        = '参数必须是数字。';
