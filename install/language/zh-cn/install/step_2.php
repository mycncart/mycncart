<?php
// Heading
$_['heading_title']          = '预安装';

// Text
$_['text_step_2']            = '检查服务器环境是否正确';
$_['text_install_php']       = '1. 请配置服务器的PHP相关参数以符合下述要求。';
$_['text_install_extension'] = '2. 请确保如下PHP扩展已被正确安装。';
$_['text_install_db']        = '3. 请确保至少一个可用数据库驱动。';
$_['text_install_file']      = '4. 请确保如下文件的正确权限。';
$_['text_install_directory'] = '5. 请确保如下文件目录的正确权限。';
$_['text_setting']           = 'PHP 环境配置';
$_['text_current']           = '当前配置';
$_['text_required']          = '所需配置';
$_['text_extension']         = '扩展配置';
$_['text_db']            	 = '数据库';
$_['text_db_driver']         = '数据库驱动';
$_['text_file']              = '文件';
$_['text_directory']         = '目录';
$_['text_status']            = '状态';
$_['text_version']           = 'PHP 版本';
$_['text_global']            = 'Register Globals';
$_['text_magic']             = 'Magic Quotes GPC';
$_['text_file_upload']       = '文件上传';
$_['text_session']           = 'Session Auto Start';
$_['text_gd']                = 'GD';
$_['text_curl']              = 'cURL';
$_['text_mcrypt']            = 'mCrypt';
$_['text_zlib']              = 'ZLIB';
$_['text_zip']               = 'ZIP';
$_['text_mbstring']          = 'mbstring';
$_['text_on']                = 'On';
$_['text_off']               = 'Off';
$_['text_writable']          = '可写';
$_['text_unwritable']        = '不可写';
$_['text_missing']           = '丢失';

// Error
$_['error_version']          = '警告: 请使用 PHP 5.3 或更新版本！';
$_['error_file_upload']      = '警告: 需要开启文件上传扩展！';
$_['error_session']          = '警告: 请关闭 session.auto_start ！';
$_['error_db']               = '警告: 需要在 php.ini 加载至少一个数据库驱动！';
$_['error_gd']               = '警告: GD 扩展需要开启！';
$_['error_curl']             = '警告: CURL 扩展需要开启！';
$_['error_mcrypt']           = '警告: mCrypt 扩展需要开启！';
$_['error_zlib']             = '警告: ZLIB 扩展需要开启！';
$_['error_zip']              = '警告: ZIP 扩展需要开启！';
$_['error_mbstring']         = '警告: mbstring 扩展需要开启！';
$_['error_catalog_exist']    = '警告: config.php 文件不存在。你需要修改文件 config-dist.php 为 config.php！';
$_['error_catalog_writable'] = '警告: 安装过程中 config.php 文件必须可写！';
$_['error_admin_exist']      = '警告: admin/config.php 不存在。你需要修改文件 admin/config-dist.php 为 admin/config.php！';
$_['error_admin_writable']   = '警告: 安装过程中 admin/config.php 文件必须可写！';
$_['error_image']            = '警告: image 图片目录必须可写！';
$_['error_image_cache']      = '警告: image/cache 图片缓存目录必须可写！';
$_['error_image_catalog']    = '警告: image/catalog 目录必须可写！';
$_['error_cache']            = '警告: system/storage/cache 缓存目录必须可写！';
$_['error_log']              = '警告: system/storage/logs 日志目录必须徐可写！';
$_['error_download']         = '警告: system/storage/download 下载目录必须可写！';
$_['error_upload']           = '警告: system/storage/upload 上传目录必须可写！';
$_['error_modification']     = '警告: system/storage/modification 代码调整目录必须可写！';