<?php
// Heading
$_['heading_title']     			= 'Excel格式導入導出數據';

// Text
$_['text_success']      			= '成功: 已導入分類和商品數據!';
$_['text_nochange']     			= '數據沒有任何更新。';
$_['text_log_details']  			= '請查看系統裏面的日誌錯誤';
$_['text_select_file_to_import']  	= '選擇導入文件';
$_['text_select_type_to_export']  	= '選擇導出類型';

// Entry
$_['entry_restore']     			= '從excel文件導入數據';
$_['entry_description'] 			= '使用Excel表格管理您的數據';
$_['entry_exportway_sel'] 			= '選擇導出數據的方式';
$_['entry_start_id'] 				= '商品起始ID號';
$_['entry_end_id'] 					= '商品終止ID號';
$_['entry_start_index'] 			= '每批次商品個數';
$_['entry_end_index'] 				= '批次編號';


// Button
$_['button_import']     			= '導入';
$_['button_export']     			= '導出';
$_['button_export_pid']     		= '根據商品ID號導出';
$_['button_export_page']     		= '批次導出';

//Error
$_['error_exist_product'] 			= '商品ID %s 已經存在於數據庫中，請檢查Excel文件！';
$_['error_permission']          	= '警告: 無權限修改本插件！';
$_['error_upload']              	= '上傳文件不是有效excel文件，或者文件內容數據格式不符!';
$_['error_sheet_count']         	= '無效工作表數目，應該為8個工作表';
$_['error_categories_header']   	= '分類工作表頂部無效';
$_['error_filtergroups_header']   	= '篩選組工作表頂部無效';
$_['error_filters_header']   		= '篩選工作表頂部無效';
$_['error_products_header']     	= '商品工作表頂部無效';
$_['error_descriptions_header']     = '商品描述工作表頂部無效';
$_['error_additionalimages_header'] = '商品附加圖片工作表頂部無效';
$_['error_product_options_header']  = '商品選項工作表頂部無效';
$_['error_options_header']      	= '選項工作表頂部無效';
$_['error_option_values_header']    = '選項值工作表頂部無效';
$_['error_attributes_header']  	 	= '屬性工作表頂部無效';
$_['error_specials_header']     	= '特價商品工作表頂部無效';
$_['error_discounts_header']    	= '折扣工作表頂部無效';
$_['error_rewards_header']      	= '獎勵積分工作表頂部無效';
$_['error_select_file']         	= '點擊【導入】前請先選擇文件';
$_['error_post_max_size']       	= '文件大小大於了PHP設定【post_max_size】超過 %1 ';
$_['error_upload_max_filesize'] 	= '文件大小大於了PHP設定【upload_max_file_size】超過 %1 ';
$_['error_pid_no_data']         	= '不存在介於開始商品ID和結束商品ID號之間的商品。';
$_['error_page_no_data']        	= '沒有更多符合條件商品。';
$_['error_param_not_number']        = '參數必須是數字。';
