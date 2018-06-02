
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `3000alpha`
--

-- --------------------------------------------------------

--
-- 表的结构 `mcc_attribute`
--

DROP TABLE IF EXISTS `mcc_attribute`;
CREATE TABLE IF NOT EXISTS `mcc_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `store_id` tinyint(4) NOT NULL COMMENT '所属店铺',
  `attribute_group_id` int(11) NOT NULL COMMENT '所属属性组',
  `sort_order` int(3) NOT NULL COMMENT '排序',
  `name` varchar(64) NOT NULL COMMENT '名称',
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='属性';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_attribute_group`
--

DROP TABLE IF EXISTS `mcc_attribute_group`;
CREATE TABLE IF NOT EXISTS `mcc_attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `store_id` tinyint(4) NOT NULL COMMENT '所属店铺',
  `sort_order` int(3) NOT NULL COMMENT '排序',
  `name` varchar(64) NOT NULL COMMENT '名称',
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='属性分组';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_cart`
--

DROP TABLE IF EXISTS `mcc_cart`;
CREATE TABLE IF NOT EXISTS `mcc_cart` (
  `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `quantity` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  `pwr_id` int(11) NOT NULL,
  `pwr_code_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_id` (`api_id`,`customer_id`,`session_id`,`product_id`,`recurring_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_currency`
--

DROP TABLE IF EXISTS `mcc_currency`;
CREATE TABLE IF NOT EXISTS `mcc_currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` double(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_customer`
--

DROP TABLE IF EXISTS `mcc_customer`;
CREATE TABLE IF NOT EXISTS `mcc_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_group_id` int(11) NOT NULL,
  `store_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属店铺',
  `language_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `cart` text,
  `wishlist` text,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `address_id` int(11) NOT NULL DEFAULT '0',
  `custom_field` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `safe` tinyint(1) NOT NULL,
  `token` text NOT NULL,
  `code` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_customer_activity`
--

DROP TABLE IF EXISTS `mcc_customer_activity`;
CREATE TABLE IF NOT EXISTS `mcc_customer_activity` (
  `customer_activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_customer_online`
--

DROP TABLE IF EXISTS `mcc_customer_online`;
CREATE TABLE IF NOT EXISTS `mcc_customer_online` (
  `ip` varchar(40) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `referer` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_event`
--

DROP TABLE IF EXISTS `mcc_event`;
CREATE TABLE IF NOT EXISTS `mcc_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_extension`
--

DROP TABLE IF EXISTS `mcc_extension`;
CREATE TABLE IF NOT EXISTS `mcc_extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_geo_zone`
--

DROP TABLE IF EXISTS `mcc_geo_zone`;
CREATE TABLE IF NOT EXISTS `mcc_geo_zone` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_language`
--

DROP TABLE IF EXISTS `mcc_language`;
CREATE TABLE IF NOT EXISTS `mcc_language` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_length_class`
--

DROP TABLE IF EXISTS `mcc_length_class`;
CREATE TABLE IF NOT EXISTS `mcc_length_class` (
  `length_class_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `value` decimal(15,0) NOT NULL COMMENT '值',
  `title` varchar(32) NOT NULL COMMENT '名称',
  `unit` varchar(4) NOT NULL COMMENT '单位',
  PRIMARY KEY (`length_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='尺寸单位';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_option`
--

DROP TABLE IF EXISTS `mcc_option`;
CREATE TABLE IF NOT EXISTS `mcc_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `store_id` tinyint(4) NOT NULL COMMENT '所属店铺',
  `option_group_id` int(11) NOT NULL COMMENT '所属选项分组',
  `name` varchar(30) NOT NULL COMMENT '名称',
  `sort_order` tinyint(4) NOT NULL COMMENT '排序',
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品选项规格';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_option_group`
--

DROP TABLE IF EXISTS `mcc_option_group`;
CREATE TABLE IF NOT EXISTS `mcc_option_group` (
  `option_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `store_id` tinyint(4) NOT NULL COMMENT '所属店铺',
  `name` varchar(30) NOT NULL COMMENT '选项组名称',
  PRIMARY KEY (`option_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='选项规格分组';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_option_value`
--

DROP TABLE IF EXISTS `mcc_option_value`;
CREATE TABLE IF NOT EXISTS `mcc_option_value` (
  `option_value_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `option_id` int(11) NOT NULL COMMENT '所属选项规格',
  `name` int(11) NOT NULL COMMENT '名称',
  `sort_order` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`option_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='选项规格值';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order`
--

DROP TABLE IF EXISTS `mcc_order`;
CREATE TABLE IF NOT EXISTS `mcc_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL DEFAULT '0',
  `invoice_prefix` varchar(26) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `store_name` varchar(64) NOT NULL,
  `store_url` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `custom_field` text NOT NULL,
  `payment_firstname` varchar(32) NOT NULL,
  `payment_lastname` varchar(32) NOT NULL,
  `payment_company` varchar(60) NOT NULL,
  `payment_address_1` varchar(128) NOT NULL,
  `payment_address_2` varchar(128) NOT NULL,
  `payment_city` varchar(128) NOT NULL,
  `payment_postcode` varchar(10) NOT NULL,
  `payment_country` varchar(128) NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(128) NOT NULL,
  `payment_zone_id` int(11) NOT NULL,
  `payment_address_format` text NOT NULL,
  `payment_custom_field` text NOT NULL,
  `payment_method` varchar(128) NOT NULL,
  `payment_code` varchar(128) NOT NULL,
  `shipping_firstname` varchar(32) NOT NULL,
  `shipping_lastname` varchar(32) NOT NULL,
  `shipping_company` varchar(40) NOT NULL,
  `shipping_address_1` varchar(128) NOT NULL,
  `shipping_address_2` varchar(128) NOT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_postcode` varchar(10) NOT NULL,
  `shipping_country` varchar(128) NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_zone` varchar(128) NOT NULL,
  `shipping_zone_id` int(11) NOT NULL,
  `shipping_address_format` text NOT NULL,
  `shipping_custom_field` text NOT NULL,
  `shipping_method` varchar(128) NOT NULL,
  `shipping_code` varchar(128) NOT NULL,
  `comment` text NOT NULL,
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `order_status_id` int(11) NOT NULL DEFAULT '0',
  `affiliate_id` int(11) NOT NULL,
  `commission` decimal(15,4) NOT NULL,
  `marketing_id` int(11) NOT NULL,
  `tracking` varchar(64) NOT NULL,
  `language_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(3) NOT NULL,
  `currency_value` decimal(15,8) NOT NULL DEFAULT '1.00000000',
  `ip` varchar(40) NOT NULL,
  `forwarded_ip` varchar(40) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `accept_language` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order_history`
--

DROP TABLE IF EXISTS `mcc_order_history`;
CREATE TABLE IF NOT EXISTS `mcc_order_history` (
  `order_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order_option`
--

DROP TABLE IF EXISTS `mcc_order_option`;
CREATE TABLE IF NOT EXISTS `mcc_order_option` (
  `order_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`order_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order_product`
--

DROP TABLE IF EXISTS `mcc_order_product`;
CREATE TABLE IF NOT EXISTS `mcc_order_product` (
  `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `reward` int(8) NOT NULL,
  `pwr_id` int(11) NOT NULL,
  `pwr_code_id` int(11) NOT NULL,
  PRIMARY KEY (`order_product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order_status`
--

DROP TABLE IF EXISTS `mcc_order_status`;
CREATE TABLE IF NOT EXISTS `mcc_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`order_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order_total`
--

DROP TABLE IF EXISTS `mcc_order_total`;
CREATE TABLE IF NOT EXISTS `mcc_order_total` (
  `order_total_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`order_total_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_order_voucher`
--

DROP TABLE IF EXISTS `mcc_order_voucher`;
CREATE TABLE IF NOT EXISTS `mcc_order_voucher` (
  `order_voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `from_email` varchar(96) NOT NULL,
  `to_name` varchar(64) NOT NULL,
  `to_email` varchar(96) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  PRIMARY KEY (`order_voucher_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product`
--

DROP TABLE IF EXISTS `mcc_product`;
CREATE TABLE IF NOT EXISTS `mcc_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `store_id` tinyint(4) NOT NULL COMMENT '所属店铺',
  `model` varchar(64) NOT NULL COMMENT '商品型号，不填写会自动生成',
  `sku` varchar(64) NOT NULL COMMENT 'SKU',
  `quantity` int(6) NOT NULL DEFAULT '0' COMMENT '总库存 - 与选项库存对应（如有规格选项）',
  `stock_status_id` int(11) NOT NULL COMMENT '库存状态ID',
  `image` varchar(255) DEFAULT NULL COMMENT '主图片',
  `brand_id` int(11) NOT NULL COMMENT '品牌ID',
  `shipping` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否配送',
  `price` decimal(10,0) UNSIGNED NOT NULL DEFAULT '0' COMMENT '价格',
  `cost` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '成本价',
  `points` int(8) NOT NULL DEFAULT '0' COMMENT '购买此商品所需积分',
  `tax_class_id` int(11) NOT NULL COMMENT '税类ID',
  `date_available` date DEFAULT NULL COMMENT '上架日期',
  `weight` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '重量',
  `weight_class_id` int(11) NOT NULL DEFAULT '0' COMMENT '重量单位ID',
  `length` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '长度',
  `width` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '宽度',
  `height` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '高度',
  `length_class_id` int(11) NOT NULL DEFAULT '0' COMMENT '尺寸单位ID',
  `subtract` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否减少库存',
  `minimum` int(11) NOT NULL DEFAULT '1' COMMENT '最少购买量',
  `sort_order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `viewed` int(5) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `date_added` datetime NOT NULL COMMENT '添加日期',
  `date_modified` datetime NOT NULL COMMENT '修改日期',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `description` text NOT NULL COMMENT '内容',
  `tag` text NOT NULL COMMENT '标签',
  `meta_title` varchar(255) NOT NULL COMMENT 'META 标题',
  `meta_description` varchar(255) NOT NULL COMMENT 'META 描述',
  `meta_keyword` varchar(255) NOT NULL COMMENT 'META 关键词',
  PRIMARY KEY (`product_id`),
  KEY `store_id` (`store_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_attribute`
--

DROP TABLE IF EXISTS `mcc_product_attribute`;
CREATE TABLE IF NOT EXISTS `mcc_product_attribute` (
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `attribute_id` int(11) NOT NULL COMMENT '属性ID',
  `text` text NOT NULL COMMENT '属性内容',
  PRIMARY KEY (`product_id`,`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品对应属性';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_discount`
--

DROP TABLE IF EXISTS `mcc_product_discount`;
CREATE TABLE IF NOT EXISTS `mcc_product_discount` (
  `product_discount_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `customer_group_id` int(11) NOT NULL COMMENT '会员等级ID',
  `quantity` int(4) NOT NULL DEFAULT '0' COMMENT '数量',
  `priority` int(5) NOT NULL DEFAULT '1' COMMENT '优先级',
  `price` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '价格',
  `date_start` date DEFAULT NULL COMMENT '开始日期',
  `date_end` date DEFAULT NULL COMMENT '结束日期',
  PRIMARY KEY (`product_discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品数量折扣';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_image`
--

DROP TABLE IF EXISTS `mcc_product_image`;
CREATE TABLE IF NOT EXISTS `mcc_product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `sort_order` int(3) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`product_image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品附加图片';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_option`
--

DROP TABLE IF EXISTS `mcc_product_option`;
CREATE TABLE IF NOT EXISTS `mcc_product_option` (
  `product_option_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `option_id` int(11) NOT NULL COMMENT '规格选项ID',
  `assemble_key` int(11) NOT NULL COMMENT '规格选项键值组合',
  `assemble_key_name` int(11) NOT NULL COMMENT '规格选项组合名称',
  `quantity` int(11) NOT NULL COMMENT '库存数量',
  `barcode` int(11) NOT NULL COMMENT 'BarCode',
  `sku` int(11) NOT NULL COMMENT 'SKU',
  `subtract` tinyint(1) NOT NULL COMMENT '是否减少库存',
  `price` int(15) NOT NULL COMMENT '价格',
  `price_prefix` varchar(1) NOT NULL COMMENT '价格前缀',
  `points` int(8) NOT NULL COMMENT '积分',
  `points_prefix` varchar(1) NOT NULL COMMENT '积分前缀',
  PRIMARY KEY (`product_option_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品对应规格选项';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_option_image`
--

DROP TABLE IF EXISTS `mcc_product_option_image`;
CREATE TABLE IF NOT EXISTS `mcc_product_option_image` (
  `product_option_image_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `image` int(11) NOT NULL COMMENT '图片',
  PRIMARY KEY (`product_option_image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品规格选项对应的图片';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_related`
--

DROP TABLE IF EXISTS `mcc_product_related`;
CREATE TABLE IF NOT EXISTS `mcc_product_related` (
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `related_id` int(11) NOT NULL COMMENT '有关商品ID',
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_reward`
--

DROP TABLE IF EXISTS `mcc_product_reward`;
CREATE TABLE IF NOT EXISTS `mcc_product_reward` (
  `product_reward_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `customer_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员等级ID',
  `points` int(8) NOT NULL DEFAULT '0' COMMENT '应得积分',
  PRIMARY KEY (`product_reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品奖励积分';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_special`
--

DROP TABLE IF EXISTS `mcc_product_special`;
CREATE TABLE IF NOT EXISTS `mcc_product_special` (
  `product_special_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `customer_group_id` int(11) NOT NULL COMMENT '会员等级ID',
  `priority` int(5) NOT NULL DEFAULT '1' COMMENT '优先级',
  `price` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '价格',
  `date_start` date DEFAULT NULL COMMENT '开始日期',
  `date_end` date DEFAULT NULL COMMENT '结束日期',
  PRIMARY KEY (`product_special_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品促销价格';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_to_category`
--

DROP TABLE IF EXISTS `mcc_product_to_category`;
CREATE TABLE IF NOT EXISTS `mcc_product_to_category` (
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `category_id` int(11) NOT NULL COMMENT '分类ID',
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品所属分类';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_to_download`
--

DROP TABLE IF EXISTS `mcc_product_to_download`;
CREATE TABLE IF NOT EXISTS `mcc_product_to_download` (
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `download_id` int(11) NOT NULL COMMENT '下载文件ID',
  PRIMARY KEY (`product_id`,`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品对应下载文件';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_product_to_layout`
--

DROP TABLE IF EXISTS `mcc_product_to_layout`;
CREATE TABLE IF NOT EXISTS `mcc_product_to_layout` (
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `layout_id` int(11) NOT NULL COMMENT '布局ID',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品对应布局';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_session`
--

DROP TABLE IF EXISTS `mcc_session`;
CREATE TABLE IF NOT EXISTS `mcc_session` (
  `session_id` varchar(32) NOT NULL,
  `data` text NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_setting`
--

DROP TABLE IF EXISTS `mcc_setting`;
CREATE TABLE IF NOT EXISTS `mcc_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(128) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_statistics`
--

DROP TABLE IF EXISTS `mcc_statistics`;
CREATE TABLE IF NOT EXISTS `mcc_statistics` (
  `statistics_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `code` varchar(64) NOT NULL COMMENT '代码',
  `value` decimal(15,0) NOT NULL COMMENT '值',
  PRIMARY KEY (`statistics_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='统计数据';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_store`
--

DROP TABLE IF EXISTS `mcc_store`;
CREATE TABLE IF NOT EXISTS `mcc_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ssl` varchar(255) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_system_menu`
--

DROP TABLE IF EXISTS `mcc_system_menu`;
CREATE TABLE IF NOT EXISTS `mcc_system_menu` (
  `system_menu_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(50) DEFAULT NULL COMMENT '权限名字',
  `group` varchar(20) DEFAULT NULL COMMENT '所属分组',
  `right` text COMMENT '权限码(控制器+动作)',
  PRIMARY KEY (`system_menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站系统后台菜单';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_system_module`
--

DROP TABLE IF EXISTS `mcc_system_module`;
CREATE TABLE IF NOT EXISTS `mcc_system_module` (
  `module_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `module` varchar(30) DEFAULT 'module' COMMENT '类型',
  `level` tinyint(1) DEFAULT '3' COMMENT '层级',
  `ctl` varchar(50) DEFAULT '' COMMENT '控制器',
  `act` varchar(50) DEFAULT '' COMMENT '控制器方法',
  `name` varchar(30) DEFAULT '' COMMENT '名称',
  `visible` tinyint(1) DEFAULT '1' COMMENT '可见否',
  `parent_id` smallint(6) DEFAULT '0' COMMENT '父类型',
  `orderby` smallint(6) DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站后台控制器及方法';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_tax_class`
--

DROP TABLE IF EXISTS `mcc_tax_class`;
CREATE TABLE IF NOT EXISTS `mcc_tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(32) NOT NULL COMMENT '名称',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `date_added` datetime NOT NULL COMMENT '添加日期',
  `date_modified` datetime NOT NULL COMMENT '修改日期',
  PRIMARY KEY (`tax_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='税类';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_tax_rate`
--

DROP TABLE IF EXISTS `mcc_tax_rate`;
CREATE TABLE IF NOT EXISTS `mcc_tax_rate` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `geo_zone_id` int(11) NOT NULL DEFAULT '0' COMMENT '区域群组',
  `name` varchar(32) NOT NULL COMMENT '名称',
  `rate` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '税率',
  `type` char(1) NOT NULL COMMENT '类型: P - 百分比,  F -  固定值',
  `date_added` datetime NOT NULL COMMENT '添加日期',
  `date_modified` datetime NOT NULL COMMENT '修改日期',
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COMMENT='税目';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_tax_rate_to_customer_group`
--

DROP TABLE IF EXISTS `mcc_tax_rate_to_customer_group`;
CREATE TABLE IF NOT EXISTS `mcc_tax_rate_to_customer_group` (
  `tax_rate_id` int(11) NOT NULL COMMENT '税目',
  `customer_group_id` int(11) NOT NULL COMMENT '会员等级',
  PRIMARY KEY (`tax_rate_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='税目与会员等级关系';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_tax_rule`
--

DROP TABLE IF EXISTS `mcc_tax_rule`;
CREATE TABLE IF NOT EXISTS `mcc_tax_rule` (
  `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tax_class_id` int(11) NOT NULL COMMENT '税类',
  `tax_rate_id` int(11) NOT NULL COMMENT '税目',
  `based` varchar(10) NOT NULL COMMENT '纳税根据',
  `priority` int(5) NOT NULL DEFAULT '1' COMMENT '优先级',
  PRIMARY KEY (`tax_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COMMENT='纳税规则';

-- --------------------------------------------------------

--
-- 表的结构 `mcc_user`
--

DROP TABLE IF EXISTS `mcc_user`;
CREATE TABLE IF NOT EXISTS `mcc_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_user_group`
--

DROP TABLE IF EXISTS `mcc_user_group`;
CREATE TABLE IF NOT EXISTS `mcc_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_weight_class`
--

DROP TABLE IF EXISTS `mcc_weight_class`;
CREATE TABLE IF NOT EXISTS `mcc_weight_class` (
  `weight_class_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `value` decimal(15,0) NOT NULL DEFAULT '0' COMMENT '值',
  `title` varchar(32) NOT NULL COMMENT '名称',
  `unit` varchar(4) NOT NULL COMMENT '单位',
  PRIMARY KEY (`weight_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_zone`
--

DROP TABLE IF EXISTS `mcc_zone`;
CREATE TABLE IF NOT EXISTS `mcc_zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(64) DEFAULT NULL COMMENT '地区名称',
  `level` tinyint(4) DEFAULT '0' COMMENT '地区等级 分省市县区乡镇',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  PRIMARY KEY (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47501 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mcc_zone_to_geo_zone`
--

DROP TABLE IF EXISTS `mcc_zone_to_geo_zone`;
CREATE TABLE IF NOT EXISTS `mcc_zone_to_geo_zone` (
  `zone_to_geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `geo_zone_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`zone_to_geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
