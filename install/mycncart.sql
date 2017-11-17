--
-- Database: `mycncart`
--

-- --------------------------------------------------------

SET sql_mode = '';

--
-- Table structure for table `mcc_address`
--

DROP TABLE IF EXISTS `oc_address`;
CREATE TABLE `mcc_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `company` varchar(40) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `custom_field` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_api`
--

DROP TABLE IF EXISTS `mcc_api`;
CREATE TABLE `mcc_api` (
  `api_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `key` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_api`
--

INSERT INTO `mcc_api` (`api_id`, `username`, `key`, `status`, `date_added`, `date_modified`) VALUES
(1, 'Default', '4dIXlZnOHIlcjkij6KGB7PHJxQETxLaQWwHBERzD7zCTfnxHBUPOjuFjNPRv5PQF2LedXCQVxlT1uzyYEiZYAHcLBE72FXB4P0ArleMeFnLck4EZOfG5uuVOmHbuFYLegLORfdL0z0sPASgMabVnguVnNEdS00NhxpMdJUMKPP1UGoOUBXwXweGHV2QcurN1ijTVoDzPL0TCrqmijk04VFz3e4PS4DnLUfl0TgTbXCMuNhVP74XzrwaYxQLdWSn4', 1, '2017-09-05 05:47:06', '2017-09-05 05:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_api_ip`
--

DROP TABLE IF EXISTS `mcc_api_ip`;
CREATE TABLE `mcc_api_ip` (
  `api_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  PRIMARY KEY (`api_ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_api_session`
--

DROP TABLE IF EXISTS `mcc_api_session`;
CREATE TABLE `mcc_api_session` (
  `api_session_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`api_session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_attribute`
--

DROP TABLE IF EXISTS `mcc_attribute`;
CREATE TABLE `mcc_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_group_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_attribute`
--

INSERT INTO `mcc_attribute` (`attribute_id`, `attribute_group_id`, `sort_order`) VALUES
(1, 6, 1),
(2, 6, 5),
(3, 6, 3),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3),
(7, 3, 4),
(8, 3, 5),
(9, 3, 6),
(10, 3, 7),
(11, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_attribute_description`
--

DROP TABLE IF EXISTS `mcc_attribute_description`;
CREATE TABLE `mcc_attribute_description` (
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`attribute_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_attribute_description`
--

INSERT INTO `mcc_attribute_description` (`attribute_id`, `language_id`, `name`) VALUES
(4, 3, '测试 1'),
(5, 3, '测试 2'),
(6, 3, '测试 3'),
(7, 3, '测试 4'),
(8, 3, '测试 5'),
(9, 3, '测试 6'),
(10, 3, '测试 7'),
(11, 3, '测试 8'),
(1, 2, 'Description'),
(2, 2, 'No. of Cores'),
(4, 2, 'test 1'),
(5, 2, 'test  2'),
(6, 2, 'test 3'),
(7, 2, 'test 4'),
(8, 2, 'test 5'),
(9, 2, 'test 6'),
(10, 2, 'test 7'),
(11, 2, 'test 8'),
(3, 2, 'Clockspeed'),
(1, 1, '描述'),
(2, 1, '核数'),
(4, 1, '测试 1'),
(5, 1, '测试 2'),
(6, 1, '测试 3'),
(7, 1, '测试 4'),
(8, 1, '测试 5'),
(9, 1, '测试 6'),
(10, 1, '测试 7'),
(11, 1, '测试 8'),
(3, 1, '时钟'),
(3, 3, '时钟'),
(1, 3, '描述'),
(2, 3, '核数');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_attribute_group`
--

DROP TABLE IF EXISTS `mcc_attribute_group`;
CREATE TABLE `mcc_attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_attribute_group`
--

INSERT INTO `mcc_attribute_group` (`attribute_group_id`, `sort_order`) VALUES
(3, 2),
(4, 1),
(5, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_attribute_group_description`
--

DROP TABLE IF EXISTS `mcc_attribute_group_description`;
CREATE TABLE `mcc_attribute_group_description` (
  `attribute_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`attribute_group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_attribute_group_description`
--

INSERT INTO `mcc_attribute_group_description` (`attribute_group_id`, `language_id`, `name`) VALUES
(3, 3, '内存'),
(6, 3, '处理器'),
(4, 3, '技术参数'),
(3, 2, 'Memory'),
(4, 2, 'Technical'),
(5, 2, 'Motherboard'),
(6, 2, 'Processor'),
(3, 1, '内存'),
(4, 1, '技术参数'),
(5, 3, '主板'),
(6, 1, '处理器'),
(5, 1, '主板');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_banner`
--

DROP TABLE IF EXISTS `mcc_banner`;
CREATE TABLE `mcc_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_banner`
--

INSERT INTO `mcc_banner` (`banner_id`, `name`, `status`) VALUES
(6, '侧边广告图片', 1),
(7, '首页幻灯片', 1),
(8, '品牌展示', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_banner_image`
--

DROP TABLE IF EXISTS `mcc_banner_image`;
CREATE TABLE `mcc_banner_image` (
  `banner_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`banner_image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=260 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_banner_image`
--

INSERT INTO `mcc_banner_image` (`banner_image_id`, `banner_id`, `language_id`, `title`, `link`, `image`, `sort_order`) VALUES
(179, 6, 3, 'HP Banner', 'index.php?route=product/manufacturer/info&amp;manufacturer_id=7', 'catalog/demo/compaq_presario.jpg', 0),
(259, 7, 3, '客廳 2', 'index.php?route=product/product&amp;path=34_43&amp;product_id=34', 'catalog/demo/slider/slide2.jpg', 2),
(258, 7, 3, '客廳 1', 'index.php?route=product/product&amp;path=57&amp;product_id=49', 'catalog/demo/slider/slide1.jpg', 1),
(178, 6, 2, 'HP Banner', 'index.php?route=product/manufacturer/info&amp;manufacturer_id=7', 'catalog/demo/compaq_presario.jpg', 0),
(252, 8, 3, 'Starbucks', '', '', 0),
(253, 8, 3, 'Nintendo', '', '', 0),
(251, 8, 3, 'Disney', '', '', 0),
(248, 8, 3, 'Canon', '', '', 0),
(249, 8, 3, 'Harley Davidson', '', '', 0),
(250, 8, 3, 'Dell', '', '', 0),
(247, 8, 3, 'Burger King', '', '', 0),
(257, 7, 2, 'Living Room 2', 'index.php?route=product/product&amp;path=34_43&amp;product_id=34', 'catalog/demo/slider/slide2.jpg', 2),
(177, 6, 1, 'HP Banner', 'index.php?route=product/manufacturer/info&amp;manufacturer_id=7', 'catalog/demo/banners/banner_left.jpg', 0),
(246, 8, 3, 'NFL', '', '', 0),
(245, 8, 3, 'RedBull', '', '', 0),
(243, 8, 3, 'Coca Cola', '', '', 0),
(244, 8, 3, 'Sony', '', '', 0),
(242, 8, 2, 'Nintendo', '', '', 0),
(241, 8, 2, 'Starbucks', '', '', 0),
(240, 8, 2, 'Disney', '', '', 0),
(256, 7, 2, 'Living Room 1', 'index.php?route=product/product&amp;path=57&amp;product_id=49', 'catalog/demo/slider/slide1.jpg', 1),
(237, 8, 2, 'Canon', '', '', 0),
(238, 8, 2, 'Harley Davidson', '', '', 0),
(239, 8, 2, 'Dell', '', '', 0),
(255, 7, 1, '客厅 2', 'index.php?route=product/product&amp;path=34_43&amp;product_id=34', 'catalog/demo/slider/slide2.jpg', 2),
(234, 8, 2, 'Sony', '', '', 0),
(235, 8, 2, 'Coca Cola', '', '', 0),
(236, 8, 2, 'Burger King', '', '', 0),
(232, 8, 2, 'NFL', '', '', 0),
(233, 8, 2, 'RedBull', '', '', 0),
(231, 8, 1, 'Nintendo', '', 'catalog/demo/manufacturer/brand_1.png', 0),
(229, 8, 1, 'Disney', '', 'catalog/demo/manufacturer/brand_2.png', 0),
(230, 8, 1, 'Starbucks', '', 'catalog/demo/manufacturer/brand_4.png', 0),
(227, 8, 1, 'Harley Davidson', '', 'catalog/demo/manufacturer/brand_4.png', 0),
(228, 8, 1, 'Dell', '', 'catalog/demo/manufacturer/brand_1.png', 0),
(254, 7, 1, '客厅 1', 'index.php?route=product/product&amp;path=57&amp;product_id=49', 'catalog/demo/slider/slide1.jpg', 1),
(226, 8, 1, 'Canon', '', 'catalog/demo/manufacturer/brand_3.png', 0),
(225, 8, 1, 'Burger King', '', 'catalog/demo/manufacturer/brand_2.png', 0),
(224, 8, 1, 'Coca Cola', '', 'catalog/demo/manufacturer/brand_1.png', 0),
(223, 8, 1, 'Sony', '', 'catalog/demo/manufacturer/brand_4.png', 0),
(222, 8, 1, 'RedBull', '', 'catalog/demo/manufacturer/brand_2.png', 0),
(221, 8, 1, 'NFL', '', 'catalog/demo/manufacturer/brand_1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog`
--

DROP TABLE IF EXISTS `mcc_blog`;
CREATE TABLE `mcc_blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video_code` text NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `sort_order` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog`
--

INSERT INTO `mcc_blog` (`blog_id`, `blog_category_id`, `created`, `status`, `user_id`, `hits`, `image`, `video_code`, `featured`, `keyword`, `sort_order`, `date_added`, `date_modified`) VALUES
(1, 0, '2016-01-15', 1, 2, 34, 'catalog/demo/blog/blog-1.jpg', '0', 0, '', 1, '2016-01-13 21:25:09', '2016-03-13 14:59:00'),
(2, 0, '2016-01-13', 1, 2, 71, 'catalog/demo/blog/blog-2.jpg', '', 0, '', 2, '2016-01-14 09:36:37', '2016-08-22 12:07:16'),
(3, 0, '2016-01-17', 1, 2, 17, 'catalog/demo/blog/blog-3.jpg', '', 0, '', 1, '2016-01-19 14:00:48', '2016-03-13 16:29:40'),
(4, 0, '2016-01-18', 1, 2, 17, 'catalog/demo/blog/blog-4.jpg', '', 0, '', 1, '2016-01-19 14:01:28', '2016-08-10 15:43:19'),
(5, 0, '2016-01-14', 1, 2, 6, 'catalog/demo/blog/blog-5.jpg', '', 0, '', 1, '2016-01-19 14:02:13', '2016-03-13 16:29:59'),
(6, 0, '2016-03-13', 1, 1, 5, 'catalog/demo/blog/blog-6.jpg', ' ', 0, '', 1, '2016-03-13 15:31:33', '2017-09-04 08:07:04'),
(7, 0, '2016-03-13', 1, 2, 4, 'catalog/demo/blog/blog-7.jpg', '', 0, '', 1, '2016-03-13 15:34:49', '2016-03-13 16:28:08'),
(8, 0, '2016-03-13', 1, 2, 5, 'catalog/demo/blog/blog-8.jpg', '', 0, '', 1, '2016-03-13 15:42:11', '2016-03-13 16:28:23'),
(9, 0, '2016-03-13', 1, 2, 5, 'catalog/demo/blog/blog-9.jpg', '', 0, '', 1, '2016-03-13 15:45:35', '2016-03-13 16:30:13'),
(10, 0, '2016-03-13', 1, 2, 10, 'catalog/demo/blog/blog-10.jpg', '', 0, '', 1, '2016-03-13 15:47:42', '2016-03-13 16:27:53'),
(11, 0, '2016-03-13', 1, 2, 4, 'catalog/demo/blog/blog-11.jpg', '', 0, '', 1, '2016-03-13 15:50:51', '2016-03-13 16:28:55'),
(12, 0, '2016-03-13', 1, 2, 8, 'catalog/demo/blog/blog-12.jpg', '', 0, '', 1, '2016-03-13 15:56:30', '2016-03-13 16:27:38'),
(13, 0, '2016-03-13', 1, 2, 9, 'catalog/demo/blog/blog-13.jpg', '', 0, '', 1, '2016-03-13 16:02:28', '2016-03-13 16:29:23'),
(14, 0, '2016-03-13', 1, 2, 9, 'catalog/demo/blog/blog-14.jpg', '', 0, '', 1, '2016-03-13 16:06:05', '2016-03-13 16:28:42'),
(15, 0, '2016-03-13', 1, 2, 15, 'catalog/demo/blog/blog-15.jpg', '', 0, '', 1, '2016-03-13 16:08:21', '2016-08-22 12:17:15'),
(16, 0, '2017-08-31', 1, 1, 0, 'catalog/demo/blog/blog-23.jpg', '  ', 0, '', 1, '2017-08-31 08:11:46', '2017-08-31 08:12:51'),
(17, 0, '2017-09-04', 1, 1, 1, '', '  ', 0, '', 1, '2017-09-04 09:48:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_category`
--

DROP TABLE IF EXISTS `mcc_blog_category`;
CREATE TABLE `mcc_blog_category` (
  `blog_category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_group` smallint(6) NOT NULL DEFAULT '2',
  `width` varchar(255) DEFAULT NULL,
  `submenu_width` varchar(255) DEFAULT NULL,
  `colum_width` varchar(255) DEFAULT NULL,
  `submenu_colum_width` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `colums` varchar(255) DEFAULT '1',
  `type` varchar(255) NOT NULL,
  `is_content` smallint(6) NOT NULL DEFAULT '2',
  `show_title` smallint(6) NOT NULL DEFAULT '1',
  `level_depth` smallint(6) NOT NULL DEFAULT '0',
  `published` smallint(6) NOT NULL DEFAULT '1',
  `store_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `show_sub` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(25) DEFAULT NULL,
  `privacy` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `position_type` varchar(25) DEFAULT 'top',
  `menu_class` varchar(25) DEFAULT NULL,
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `sort_order` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`blog_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_category`
--

INSERT INTO `mcc_blog_category` (`blog_category_id`, `image`, `parent_id`, `is_group`, `width`, `submenu_width`, `colum_width`, `submenu_colum_width`, `item`, `colums`, `type`, `is_content`, `show_title`, `level_depth`, `published`, `store_id`, `position`, `show_sub`, `url`, `target`, `privacy`, `position_type`, `menu_class`, `left`, `right`, `keyword`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(1, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 1, 1, '2016-01-13 21:18:53', '2017-08-31 14:58:41'),
(2, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 2, 1, '2016-01-21 11:30:13', '2017-08-31 14:30:50'),
(8, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 7, 1, '2017-08-31 14:34:03', '2017-08-31 15:01:02'),
(9, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 4, 1, '2017-08-31 14:52:44', '2017-08-31 14:59:12'),
(6, 'catalog/demo/canon_logo.jpg', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 3, 1, '2016-01-21 11:33:00', '2017-08-31 14:58:55'),
(10, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 5, 1, '2017-08-31 14:54:18', '2017-08-31 14:59:24'),
(11, '', 0, 2, NULL, NULL, NULL, NULL, NULL, '1', '', 2, 1, 0, 1, 0, 0, 0, NULL, NULL, 0, 'top', NULL, 0, 0, '', 6, 1, '2017-08-31 14:58:25', '2017-08-31 14:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_category_description`
--

DROP TABLE IF EXISTS `mcc_blog_category_description`;
CREATE TABLE `mcc_blog_category_description` (
  `blog_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`blog_category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_category_description`
--

INSERT INTO `mcc_blog_category_description` (`blog_category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 1, '与神对话1', '&lt;p&gt;与神对话1&lt;br&gt;&lt;/p&gt;', '与神对话1', '与神对话1', '与神对话1'),
(1, 3, '与神对话1', '&lt;p&gt;与神对话1&lt;br&gt;&lt;/p&gt;', '与神对话1', '与神对话1', '与神对话1'),
(2, 2, 'Conversation With God 2', '&lt;p&gt;Conversation With God 2&lt;br&gt;&lt;/p&gt;', 'Conversation With God 2', 'Conversation With God 2', 'Conversation With God 2'),
(2, 1, '与神对话2', '&lt;p&gt;与神对话2&lt;br&gt;&lt;/p&gt;', '与神对话2', '与神对话2', '与神对话2'),
(2, 3, '与神对话2', '&lt;p&gt;与神对话2&lt;br&gt;&lt;/p&gt;', '与神对话2', '与神对话2', '与神对话2'),
(6, 2, 'Conversation With God 3', '&lt;p&gt;Conversation With God 3&lt;br&gt;&lt;/p&gt;', 'Conversation With God 3', 'Conversation With God 3', 'Conversation With God 3'),
(8, 3, '唤醒人类', '&lt;p&gt;唤醒人类&lt;br&gt;&lt;/p&gt;', '唤醒人类', '唤醒人类', '唤醒人类'),
(8, 2, 'Awake the species', '&lt;p&gt;Awake the species&lt;br&gt;&lt;/p&gt;', 'Awake the species', 'Awake the species', 'Awake the species'),
(8, 1, '唤醒人类', '&lt;p&gt;唤醒人类&lt;br&gt;&lt;/p&gt;', '唤醒人类', '唤醒人类', '唤醒人类'),
(9, 3, '与神为友', '&lt;p&gt;与神为友&lt;br&gt;&lt;/p&gt;', '与神为友', '与神为友', '与神为友'),
(6, 1, '与神对话3', '&lt;p&gt;与神对话3&lt;br&gt;&lt;/p&gt;', '与神对话3', '与神对话3', '与神对话3'),
(6, 3, '与神对话3', '&lt;p&gt;与神对话3&lt;br&gt;&lt;/p&gt;', '与神对话3', '与神对话3', '与神对话3'),
(1, 2, 'Conversation With God 1', '&lt;p&gt;Conversation With God 1&lt;br&gt;&lt;/p&gt;', 'Conversation With God 1', 'Conversation With God 1', 'Conversation With God 1'),
(9, 1, '与神为友', '&lt;p&gt;与神为友&lt;br&gt;&lt;/p&gt;', '与神为友', '与神为友', '与神为友'),
(9, 2, 'Be Friend With God', '&lt;p&gt;Be Friend With God&lt;br&gt;&lt;/p&gt;', 'Be Friend With God', 'Be Friend With God', 'Be Friend With God'),
(10, 1, '与神合一', '&lt;p&gt;与神合一&lt;br&gt;&lt;/p&gt;', '与神合一', '与神合一', '与神合一'),
(10, 3, '与神合一', '&lt;p&gt;与神合一&lt;br&gt;&lt;/p&gt;', '与神合一', '与神合一', '与神合一'),
(10, 2, 'Oneness with God', '&lt;p&gt;Oneness with God&lt;br&gt;&lt;/p&gt;', 'Oneness with God', 'Oneness with God', 'Oneness with God'),
(11, 1, '与神回家', '&lt;p&gt;与神回家&lt;br&gt;&lt;/p&gt;', '与神回家', '与神回家', '与神回家'),
(11, 3, '与神回家', '&lt;p&gt;与神回家&lt;br&gt;&lt;/p&gt;', '与神回家', '与神回家', '与神回家'),
(11, 2, 'Home With God', '&lt;p&gt;Home With God&lt;br&gt;&lt;/p&gt;', 'Home With God', 'Home With God', 'Home With God');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_category_path`
--

DROP TABLE IF EXISTS `mcc_blog_category_path`;
CREATE TABLE `mcc_blog_category_path` (
  `blog_category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`blog_category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_category_path`
--

INSERT INTO `mcc_blog_category_path` (`blog_category_id`, `path_id`, `level`) VALUES
(1, 1, 0),
(2, 2, 0),
(11, 11, 0),
(10, 10, 0),
(9, 9, 0),
(8, 8, 0),
(6, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_category_to_layout`
--

DROP TABLE IF EXISTS `mcc_blog_category_to_layout`;
CREATE TABLE `mcc_blog_category_to_layout` (
  `blog_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_category_to_layout`
--

INSERT INTO `mcc_blog_category_to_layout` (`blog_category_id`, `store_id`, `layout_id`) VALUES
(1, 0, 0),
(2, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(6, 0, 0),
(11, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_category_to_store`
--

DROP TABLE IF EXISTS `mcc_blog_category_to_store`;
CREATE TABLE `mcc_blog_category_to_store` (
  `blog_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_category_to_store`
--

INSERT INTO `mcc_blog_category_to_store` (`blog_category_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(6, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_comment`
--

DROP TABLE IF EXISTS `mcc_blog_comment`;
CREATE TABLE `mcc_blog_comment` (
  `blog_comment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`blog_comment_id`),
  KEY `FK_blog_comment` (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_comment`
--

INSERT INTO `mcc_blog_comment` (`blog_comment_id`, `blog_id`, `customer_id`, `author`, `text`, `status`, `email`, `date_added`, `date_modified`) VALUES
(4, 2, 0, 'yyy', 'hhhh', 1, '', '2016-01-27 09:02:37', '2017-07-17 09:02:58'),
(3, 2, 0, 'eeee', 'dddd', 1, '', '2016-01-27 09:00:23', '2017-07-17 09:02:58'),
(5, 2, 0, 'fff', 'ggg', 1, '', '2016-01-27 19:06:02', '2017-07-17 09:02:58'),
(6, 2, 0, 'aaa', 'bbb', 1, '', '2016-01-27 19:10:22', '2017-07-17 09:02:58'),
(7, 2, 0, 'sss', 'ddd', 1, '', '2016-01-27 19:10:37', '2017-07-17 09:02:58'),
(8, 2, 0, 'eee', 'rrr', 1, '', '2016-01-27 19:11:05', '2017-07-17 09:02:58'),
(9, 2, 0, 'iii', 'kkk', 1, '', '2016-01-27 19:11:22', '2017-07-17 09:02:58'),
(10, 2, 0, 'vvv', 'bbb', 1, '', '2016-01-27 19:11:37', '2017-07-17 09:02:58'),
(11, 2, 0, 'ggg', 'hhh', 1, '', '2016-01-27 19:11:50', '2017-07-17 09:02:58'),
(12, 2, 0, 'uuu', 'kkk', 1, '', '2016-01-27 19:11:57', '2017-07-17 09:02:58'),
(13, 2, 0, 'ooo', 'ppp', 1, '', '2016-01-27 19:12:10', '2017-07-17 09:02:58'),
(14, 2, 0, 'dfg', 'jhff', 1, '', '2016-01-27 19:12:17', '2017-07-17 09:02:58'),
(15, 2, 0, 'tytyt', 'fsdfsdfs', 1, '', '2016-01-27 19:12:22', '2017-07-17 09:02:58'),
(16, 2, 0, 'frfr', 'ffff', 1, '', '2016-01-27 19:15:46', '2017-07-17 09:02:58'),
(17, 1, 0, '測試ing', '測試評論內容', 1, '', '2016-02-09 20:17:23', '2017-07-17 09:02:58'),
(18, 1, 0, 'testone', 'tesing now', 1, '', '2016-02-09 20:17:53', '2017-07-17 09:02:58'),
(19, 2, 0, 'tesdfdfd', 'dsfsdfsfsd', 1, '', '2016-02-13 14:17:50', '2017-07-17 09:02:58'),
(20, 1, 0, 'testtwo', 'testing ok ', 1, '', '2016-02-13 14:51:27', '2017-07-17 09:02:58'),
(21, 1, 0, 'testing yang', 'testing now', 1, '', '2016-03-13 16:32:38', '2017-07-17 09:02:58'),
(22, 1, 2, '测试一', 'Testing by Yang', 0, '', '2016-08-10 19:19:30', '2017-07-17 09:02:58'),
(23, 1, 2, '测试一', 'Testing by Yang', 0, '', '2016-08-10 19:19:46', '2017-07-17 09:02:58'),
(24, 1, 2, '测试一', 'Testing by Yang 2016', 0, '', '2016-08-10 19:25:17', '2017-07-17 09:02:58'),
(25, 1, 2, '测试一', 'Testing by Yang 2016', 0, '', '2016-08-10 19:27:11', '2017-07-17 09:02:58'),
(26, 1, 2, '测试一', 'Testing by Yang 2016', 0, '', '2016-08-10 19:35:37', '2017-07-17 09:02:58'),
(27, 1, 2, '测试一', 'Testing by Yang 2016', 1, '', '2016-08-10 19:37:15', '2016-08-10 19:38:47'),
(28, 1, 2, '测试一', 'ceshiing', 1, '', '2016-08-10 19:39:38', '2017-07-17 09:02:58'),
(29, 4, 2, '测试一', '测试登陆才可以评论', 1, '', '2016-08-10 19:40:43', '2017-07-17 09:02:58'),
(30, 15, 1, '杨兆锋', '测试中评论', 1, '', '2016-08-22 14:45:07', '2017-07-17 09:02:58'),
(31, 15, 1, 'testone', '再次测试', 1, '', '2016-08-22 14:46:49', '2016-08-22 14:47:03'),
(32, 10, 6, '11111', 'mmmmm', 1, '', '2016-08-26 23:21:50', '2017-07-17 09:02:58'),
(33, 15, 1, '杨兆锋', '测试邮件发送内容', 1, '', '2016-09-02 14:58:31', '2017-07-17 09:02:58'),
(34, 15, 1, '杨兆锋', '再次测试邮件发送标题', 1, '', '2016-09-02 15:02:18', '2017-07-17 09:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_description`
--

DROP TABLE IF EXISTS `mcc_blog_description`;
CREATE TABLE `mcc_blog_description` (
  `blog_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `brief` text NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `tag` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_description`
--

INSERT INTO `mcc_blog_description` (`blog_id`, `language_id`, `title`, `brief`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `tag`) VALUES
(1, 2, '神在每一时刻、与每一个人说话', '我跟每个人说话，一向就是如此。问题不是在我跟谁说，而是谁在听？就拿基督为例，为什么有一些人，仿佛比别的人更能听到神的讯息？那因为有些人愿意真正倾听。他们愿意听，纵使当讯息看起来似乎是可怕，或疯狂，或根本就错误时，他们仍愿对这样的通讯保持开放的心态。 除非你不再告诉我你的真理，否则我无法告诉你我的真理。所有的人都是特别的，而所有的片刻也都珍贵如黄金。并没有哪一个人或哪一个时刻比其他的更特别。', '&lt;p&gt;我跟每个人说话，一向就是如此。问题不是在我跟谁说，而是谁在听？就拿基督为例，为什么有一些人，仿佛比别的人更能听到神的讯息？那因为有些人愿意真正倾听。他们愿意听，纵使当讯息看起来似乎是可怕，或疯狂，或根本就错误时，他们仍愿对这样的通讯保持开放的心态。 除非你不再告诉我你的真理，否则我无法告诉你我的真理。所有的人都是特别的，而所有的片刻也都珍贵如黄金。并没有哪一个人或哪一个时刻比其他的更特别。&lt;br&gt;&lt;br&gt;让我们以沟通这个字来取代说话这个字。沟通是个好得多、充实得多、正确得多的字眼。我邀请你来参加与神的一种新型的沟通。一个双向沟通。事实上，是你邀请了我。我最常用的沟通方式是透过感受（又译为“感觉”）。感受是灵魂的语言。我也以思维来沟通。我最强而有力的讯息是体验，但这个你们也忽略了。你们尤其是忽略了这个。而最后，如果感受、思维及体验全都失效时，我才用语言。它们最容易招致错误的诠释，最容易被误解。然而，最大的讽刺是，你们全都将神的话语视为如此重要，反而轻视体验。倾听你的感受。倾听你最高的思维。倾听你的体验。一旦有任何与你的老师们告诉你的，或与你在书里读到的话不同时，就忘掉那些话。话语是最不可靠的真理供应商。&lt;/p&gt;', 'MyCnCart - 神在每一时刻、与每一个人说话', 'MyCnCart - 神在每一时刻、与每一个人说话', 'MyCnCart - 神在每一时刻、与每一个人说话', '1,2,3'),
(1, 1, '神在每一时刻、与每一个人说话', '我跟每个人说话，一向就是如此。问题不是在我跟谁说，而是谁在听？就拿基督为例，为什么有一些人，仿佛比别的人更能听到神的讯息？那因为有些人愿意真正倾听。他们愿意听，纵使当讯息看起来似乎是可怕，或疯狂，或根本就错误时，他们仍愿对这样的通讯保持开放的心态。 除非你不再告诉我你的真理，否则我无法告诉你我的真理。所有的人都是特别的，而所有的片刻也都珍贵如黄金。并没有哪一个人或哪一个时刻比其他的更特别。', '&lt;p&gt;我跟每个人说话，一向就是如此。问题不是在我跟谁说，而是谁在听？就拿基督为例，为什么有一些人，仿佛比别的人更能听到神的讯息？那因为有些人愿意真正倾听。他们愿意听，纵使当讯息看起来似乎是可怕，或疯狂，或根本就错误时，他们仍愿对这样的通讯保持开放的心态。 除非你不再告诉我你的真理，否则我无法告诉你我的真理。所有的人都是特别的，而所有的片刻也都珍贵如黄金。并没有哪一个人或哪一个时刻比其他的更特别。&lt;br&gt;&lt;br&gt;让我们以沟通这个字来取代说话这个字。沟通是个好得多、充实得多、正确得多的字眼。我邀请你来参加与神的一种新型的沟通。一个双向沟通。事实上，是你邀请了我。我最常用的沟通方式是透过感受（又译为“感觉”）。感受是灵魂的语言。我也以思维来沟通。我最强而有力的讯息是体验，但这个你们也忽略了。你们尤其是忽略了这个。而最后，如果感受、思维及体验全都失效时，我才用语言。它们最容易招致错误的诠释，最容易被误解。然而，最大的讽刺是，你们全都将神的话语视为如此重要，反而轻视体验。倾听你的感受。倾听你最高的思维。倾听你的体验。一旦有任何与你的老师们告诉你的，或与你在书里读到的话不同时，就忘掉那些话。话语是最不可靠的真理供应商。&lt;/p&gt;', 'MyCnCart - 神在每一时刻、与每一个人说话', 'MyCnCart - 神在每一时刻、与每一个人说话', 'MyCnCart - 神在每一时刻、与每一个人说话', '1,2,3'),
(2, 3, '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。', '&lt;p&gt;神以神的肖像创造了你们。透过神给你们的力量，你们又创造了其余的。神创造了如你们所知的生命过程和生命本身。但是神也给了你们自由选择权，你们可\r\n以随心所欲的去过生活。以这种说法来看，你对自己的意愿也即是神对你的意愿。你就以你自己的方式过你的人生，我在这件事上并没有什么偏好。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;神\r\n的计划，是让你们去创造任何东西――每样东西――不论你们想要的是什么东西。在这种自由里，存在着神之为神的体验――而就是为了这个体验，我才创造你们，\r\n以及生命本身。（神赋予了人选择的自由、创造的自由，人的自由选择、创造，就是一种上帝的状态。）我什么都不轻视。神在悲伤和欢笑里，在苦与甜里。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '2,3,4'),
(2, 2, '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。', '&lt;p&gt;神以神的肖像创造了你们。透过神给你们的力量，你们又创造了其余的。神创造了如你们所知的生命过程和生命本身。但是神也给了你们自由选择权，你们可\r\n以随心所欲的去过生活。以这种说法来看，你对自己的意愿也即是神对你的意愿。你就以你自己的方式过你的人生，我在这件事上并没有什么偏好。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;神\r\n的计划，是让你们去创造任何东西――每样东西――不论你们想要的是什么东西。在这种自由里，存在着神之为神的体验――而就是为了这个体验，我才创造你们，\r\n以及生命本身。（神赋予了人选择的自由、创造的自由，人的自由选择、创造，就是一种上帝的状态。）我什么都不轻视。神在悲伤和欢笑里，在苦与甜里。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '2,3,4'),
(3, 2, '生命并非一个发现的过程，而是一个创造的过程', '你们会在这儿，为的是忆起，并且重新创造你是谁。', '&lt;p&gt;生命只有一个目的，那就是让你和所有活着的东西体验最完满的荣耀。这个目的的神奇是在于它是永无结束的。一个结束是一个局限，而神的目的没有这样的\r\n界限。一个最深的秘密就是：生命并非一个发现的过程，而是一个创造的过程。你并不是在发现你自己，而是在重新创造你自己。所以，不（仅）要去弄清你是谁，\r\n而（更）要去确定你想成为谁。&lt;/p&gt;&lt;p&gt;你们会在这儿，为的是忆起，并且重新创造你是谁。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', '3,4,5'),
(3, 3, '生命并非一个发现的过程，而是一个创造的过程', '你们会在这儿，为的是忆起，并且重新创造你是谁。', '&lt;p&gt;生命只有一个目的，那就是让你和所有活着的东西体验最完满的荣耀。这个目的的神奇是在于它是永无结束的。一个结束是一个局限，而神的目的没有这样的\r\n界限。一个最深的秘密就是：生命并非一个发现的过程，而是一个创造的过程。你并不是在发现你自己，而是在重新创造你自己。所以，不（仅）要去弄清你是谁，\r\n而（更）要去确定你想成为谁。&lt;/p&gt;&lt;p&gt;你们会在这儿，为的是忆起，并且重新创造你是谁。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', '3,4,5'),
(4, 3, '神创造了相对性，你藉由你不是的东西来界定你自己是什么', '就最终的逻辑而言，就是除非你面对了你不是的东西，否则你无法经验自己以为你是的东西。这乃是相对论及所有具体生命的目的。你得藉由你不是的东西来界定你自己是什么。', '&lt;p&gt;我是一切东西（All Things）――可见与不可见的。一切万有（All That Is）无法认识他自己――因为一切万有是所有的一切，而没有任何其他的东西。因此，一切万有……是不在的。（于是，为了认识自己，）神创造了相对性――是神给他自己的最大礼物。因此，关系就是神给你们的最大礼物，这主题后面会再详加讨论。我创造你们――我的心灵儿女――的目的，是为了要体认我自己为神。除了经由你们，我没有其他办法做到这一点。所以可以说（并且也已说过许多次）我要你们做到的是：你们该体认到自己为我。这看似如此令人惊异的简单，然而却变得非常复杂――因为你们只有一个方法得以体认你们自己为我――那就是，首先，你们要先体认自己不是我。就最终的逻辑而言，就是除非你面对了你不是的东西，否则你无法经验自己以为你是的东西。这乃是相对论及所有具体生命的目的。你得藉由你不是的东西来界定你自己是什么。&lt;/p&gt;', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', '4,5,6'),
(1, 3, '神在每一时刻、与每一个人说话', '我跟每个人说话，一向就是如此。问题不是在我跟谁说，而是谁在听？就拿基督为例，为什么有一些人，仿佛比别的人更能听到神的讯息？那因为有些人愿意真正倾听。他们愿意听，纵使当讯息看起来似乎是可怕，或疯狂，或根本就错误时，他们仍愿对这样的通讯保持开放的心态。 除非你不再告诉我你的真理，否则我无法告诉你我的真理。所有的人都是特别的，而所有的片刻也都珍贵如黄金。并没有哪一个人或哪一个时刻比其他的更特别。', '&lt;p&gt;我跟每个人说话，一向就是如此。问题不是在我跟谁说，而是谁在听？就拿基督为例，为什么有一些人，仿佛比别的人更能听到神的讯息？那因为有些人愿意真正倾听。他们愿意听，纵使当讯息看起来似乎是可怕，或疯狂，或根本就错误时，他们仍愿对这样的通讯保持开放的心态。 除非你不再告诉我你的真理，否则我无法告诉你我的真理。所有的人都是特别的，而所有的片刻也都珍贵如黄金。并没有哪一个人或哪一个时刻比其他的更特别。&lt;br&gt;&lt;br&gt;让我们以沟通这个字来取代说话这个字。沟通是个好得多、充实得多、正确得多的字眼。我邀请你来参加与神的一种新型的沟通。一个双向沟通。事实上，是你邀请了我。我最常用的沟通方式是透过感受（又译为“感觉”）。感受是灵魂的语言。我也以思维来沟通。我最强而有力的讯息是体验，但这个你们也忽略了。你们尤其是忽略了这个。而最后，如果感受、思维及体验全都失效时，我才用语言。它们最容易招致错误的诠释，最容易被误解。然而，最大的讽刺是，你们全都将神的话语视为如此重要，反而轻视体验。倾听你的感受。倾听你最高的思维。倾听你的体验。一旦有任何与你的老师们告诉你的，或与你在书里读到的话不同时，就忘掉那些话。话语是最不可靠的真理供应商。&lt;/p&gt;', 'MyCnCart - 神在每一时刻、与每一个人说话', 'MyCnCart - 神在每一时刻、与每一个人说话', 'MyCnCart - 神在每一时刻、与每一个人说话', '1,2,3'),
(2, 1, '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。', '&lt;p&gt;神以神的肖像创造了你们。透过神给你们的力量，你们又创造了其余的。神创造了如你们所知的生命过程和生命本身。但是神也给了你们自由选择权，你们可\r\n以随心所欲的去过生活。以这种说法来看，你对自己的意愿也即是神对你的意愿。你就以你自己的方式过你的人生，我在这件事上并没有什么偏好。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;神\r\n的计划，是让你们去创造任何东西――每样东西――不论你们想要的是什么东西。在这种自由里，存在着神之为神的体验――而就是为了这个体验，我才创造你们，\r\n以及生命本身。（神赋予了人选择的自由、创造的自由，人的自由选择、创造，就是一种上帝的状态。）我什么都不轻视。神在悲伤和欢笑里，在苦与甜里。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', 'MyCnCart - 你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '2,3,4'),
(3, 1, '生命并非一个发现的过程，而是一个创造的过程', '你们会在这儿，为的是忆起，并且重新创造你是谁。', '&lt;p&gt;生命只有一个目的，那就是让你和所有活着的东西体验最完满的荣耀。这个目的的神奇是在于它是永无结束的。一个结束是一个局限，而神的目的没有这样的\r\n界限。一个最深的秘密就是：生命并非一个发现的过程，而是一个创造的过程。你并不是在发现你自己，而是在重新创造你自己。所以，不（仅）要去弄清你是谁，\r\n而（更）要去确定你想成为谁。&lt;/p&gt;&lt;p&gt;你们会在这儿，为的是忆起，并且重新创造你是谁。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', 'MyCnCart - 生命并非一个发现的过程，而是一个创造的过程', '3,4,5'),
(4, 2, '神创造了相对性，你藉由你不是的东西来界定你自己是什么', '就最终的逻辑而言，就是除非你面对了你不是的东西，否则你无法经验自己以为你是的东西。这乃是相对论及所有具体生命的目的。你得藉由你不是的东西来界定你自己是什么。', '&lt;p&gt;我是一切东西（All Things）――可见与不可见的。一切万有（All That Is）无法认识他自己――因为一切万有是所有的一切，而没有任何其他的东西。因此，一切万有……是不在的。（于是，为了认识自己，）神创造了相对性――是神给他自己的最大礼物。因此，关系就是神给你们的最大礼物，这主题后面会再详加讨论。我创造你们――我的心灵儿女――的目的，是为了要体认我自己为神。除了经由你们，我没有其他办法做到这一点。所以可以说（并且也已说过许多次）我要你们做到的是：你们该体认到自己为我。这看似如此令人惊异的简单，然而却变得非常复杂――因为你们只有一个方法得以体认你们自己为我――那就是，首先，你们要先体认自己不是我。就最终的逻辑而言，就是除非你面对了你不是的东西，否则你无法经验自己以为你是的东西。这乃是相对论及所有具体生命的目的。你得藉由你不是的东西来界定你自己是什么。&lt;/p&gt;', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', '4,5,6'),
(4, 1, '神创造了相对性，你藉由你不是的东西来界定你自己是什么', '就最终的逻辑而言，就是除非你面对了你不是的东西，否则你无法经验自己以为你是的东西。这乃是相对论及所有具体生命的目的。你得藉由你不是的东西来界定你自己是什么。', '&lt;p&gt;我是一切东西（All Things）――可见与不可见的。一切万有（All That Is）无法认识他自己――因为一切万有是所有的一切，而没有任何其他的东西。因此，一切万有……是不在的。（于是，为了认识自己，）神创造了相对性――是神给他自己的最大礼物。因此，关系就是神给你们的最大礼物，这主题后面会再详加讨论。我创造你们――我的心灵儿女――的目的，是为了要体认我自己为神。除了经由你们，我没有其他办法做到这一点。所以可以说（并且也已说过许多次）我要你们做到的是：你们该体认到自己为我。这看似如此令人惊异的简单，然而却变得非常复杂――因为你们只有一个方法得以体认你们自己为我――那就是，首先，你们要先体认自己不是我。就最终的逻辑而言，就是除非你面对了你不是的东西，否则你无法经验自己以为你是的东西。这乃是相对论及所有具体生命的目的。你得藉由你不是的东西来界定你自己是什么。&lt;/p&gt;', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', 'MyCnCart  - 神创造了相对性，你藉由你不是的东西来界定你自己是什么', '4,5,6'),
(5, 3, '痛苦是错误思想的结果，是你自己创造了这经验', '地狱是你的选择、决定和创造所可能产生的最糟结果的经验。', '&lt;p&gt;你无法改变外在事件（因为那是你们许多人创造的，而你的意识还没成长到你能个别地改变集体创造出来的东西），所以你必须改变内在的经验。这是在生活\r\n中到达主控权之路。没有一件事其本身是痛苦的。痛苦是错误思想的结果。它是思维里的一个谬误。痛苦来自你对一件事的批判。去掉批判，痛苦便消失了。在神的\r\n世界里，没有什么“该”或“不该”。做你想做的事。但不要去批判，也不要去指责，因为你并不知道事情为何发生，也不知是为了什么目的。要祝福一切――因为\r\n一切都是神透过活生生的生命所创造的，而那就是最高的创造。&lt;/p&gt;&lt;p&gt;地狱是你的选择、决定和创造所可能产生的最糟结果的经验。它是否定我或对与我有\r\n关联的你之为谁说“不”的任何思维之自然后果。它是你因为错误的思想而遭受的痛苦。然而，即使“错误思想”这个词也是个误称，因为根本没有错的事。地狱是\r\n喜悦的反面。它是不圆满。它是知道你是谁和是什么，却无法去经验。它是逊于你的本质。那就是地狱，对你的灵魂而言，不可能有的更大痛苦。我告诉你，在死\r\n后，根本没有你们在以恐惧为基础的理论里所建构的那种经验。然而，灵魂有一种经验，会是很不快乐、很不完全、很不完整，而且让你远离神的最大喜悦，以致对\r\n你的灵魂而言会是地狱一般的。但我告诉你，不是我要送你去那儿，也不是我导致你有这经验。而是每当你以任何方式，将你自己与对你自己之最高想法分开时；每\r\n当你排斥你真的是谁或是什么时，是你，你自己，创造了这经验。&lt;/p&gt;&lt;p&gt;你们是你们自己的规则判定者，而你是唯一可评估你做的多好的人。你可以照你希\r\n望的去做而不必害怕报应。不过，事先觉知其后果对你却是有用的。后果只是后果。这些和报应或惩罚完全不同。那些在你看来象是惩罚的事――或你称之为邪恶或\r\n恶运的事――只不过是自然律在维护它自己而已。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', ''),
(5, 1, '痛苦是错误思想的结果，是你自己创造了这经验', '地狱是你的选择、决定和创造所可能产生的最糟结果的经验。', '&lt;p&gt;你无法改变外在事件（因为那是你们许多人创造的，而你的意识还没成长到你能个别地改变集体创造出来的东西），所以你必须改变内在的经验。这是在生活中到达主控权之路。没有一件事其本身是痛苦的。痛苦是错误思想的结果。它是思维里的一个谬误。痛苦来自你对一件事的批判。去掉批判，痛苦便消失了。在神的世界里，没有什么“该”或“不该”。做你想做的事。但不要去批判，也不要去指责，因为你并不知道事情为何发生，也不知是为了什么目的。要祝福一切――因为一切都是神透过活生生的生命所创造的，而那就是最高的创造。&lt;/p&gt;&lt;p&gt;地狱是你的选择、决定和创造所可能产生的最糟结果的经验。它是否定我或对与我有关联的你之为谁说“不”的任何思维之自然后果。它是你因为错误的思想而遭受的痛苦。然而，即使“错误思想”这个词也是个误称，因为根本没有错的事。地狱是喜悦的反面。它是不圆满。它是知道你是谁和是什么，却无法去经验。它是逊于你的本质。那就是地狱，对你的灵魂而言，不可能有的更大痛苦。我告诉你，在死后，根本没有你们在以恐惧为基础的理论里所建构的那种经验。然而，灵魂有一种经验，会是很不快乐、很不完全、很不完整，而且让你远离神的最大喜悦，以致对你的灵魂而言会是地狱一般的。但我告诉你，不是我要送你去那儿，也不是我导致你有这经验。而是每当你以任何方式，将你自己与对你自己之最高想法分开时；每当你排斥你真的是谁或是什么时，是你，你自己，创造了这经验。&lt;/p&gt;&lt;p&gt;你们是你们自己的规则判定者，而你是唯一可评估你做的多好的人。你可以照你希望的去做而不必害怕报应。不过，事先觉知其后果对你却是有用的。后果只是后果。这些和报应或惩罚完全不同。那些在你看来象是惩罚的事――或你称之为邪恶或恶运的事――只不过是自然律在维护它自己而已。&lt;/p&gt;', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', ''),
(5, 2, '痛苦是错误思想的结果，是你自己创造了这经验', '地狱是你的选择、决定和创造所可能产生的最糟结果的经验。', '&lt;p&gt;你无法改变外在事件（因为那是你们许多人创造的，而你的意识还没成长到你能个别地改变集体创造出来的东西），所以你必须改变内在的经验。这是在生活\r\n中到达主控权之路。没有一件事其本身是痛苦的。痛苦是错误思想的结果。它是思维里的一个谬误。痛苦来自你对一件事的批判。去掉批判，痛苦便消失了。在神的\r\n世界里，没有什么“该”或“不该”。做你想做的事。但不要去批判，也不要去指责，因为你并不知道事情为何发生，也不知是为了什么目的。要祝福一切――因为\r\n一切都是神透过活生生的生命所创造的，而那就是最高的创造。&lt;/p&gt;&lt;p&gt;地狱是你的选择、决定和创造所可能产生的最糟结果的经验。它是否定我或对与我有\r\n关联的你之为谁说“不”的任何思维之自然后果。它是你因为错误的思想而遭受的痛苦。然而，即使“错误思想”这个词也是个误称，因为根本没有错的事。地狱是\r\n喜悦的反面。它是不圆满。它是知道你是谁和是什么，却无法去经验。它是逊于你的本质。那就是地狱，对你的灵魂而言，不可能有的更大痛苦。我告诉你，在死\r\n后，根本没有你们在以恐惧为基础的理论里所建构的那种经验。然而，灵魂有一种经验，会是很不快乐、很不完全、很不完整，而且让你远离神的最大喜悦，以致对\r\n你的灵魂而言会是地狱一般的。但我告诉你，不是我要送你去那儿，也不是我导致你有这经验。而是每当你以任何方式，将你自己与对你自己之最高想法分开时；每\r\n当你排斥你真的是谁或是什么时，是你，你自己，创造了这经验。&lt;/p&gt;&lt;p&gt;你们是你们自己的规则判定者，而你是唯一可评估你做的多好的人。你可以照你希\r\n望的去做而不必害怕报应。不过，事先觉知其后果对你却是有用的。后果只是后果。这些和报应或惩罚完全不同。那些在你看来象是惩罚的事――或你称之为邪恶或\r\n恶运的事――只不过是自然律在维护它自己而已。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', 'MyCnCart  - 痛苦是错误思想的结果，是你自己创造了这经验', ''),
(17, 2, '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '', '&lt;p&gt;不可原谅的东西是不存在的。没有任何罪行严重到我会拒绝原谅你。哪怕人类最严厉的宗教也传播这个道理。&lt;/p&gt;&lt;p&gt;这些宗教也许在救赎的方式上有争议，也许在救赎的道路上有争议，但他们全都同意的是，这样的方式和道路是有的。&lt;/p&gt;&lt;p&gt;在你成为死亡的时刻，你自然会得到补赎的机会。&lt;/p&gt;&lt;p&gt;所谓补赎，就是意识到你和所有其他人是一体。那就是明白你和万物——包括我——是合一的。&lt;/p&gt;&lt;p&gt;死亡之后，当你和你的肉体分开之后，你将会立刻拥有——忆起——这种经验。&lt;/p&gt;&lt;p&gt;所有灵魂都以最有意思的方式经验到他们的“合一”。它们将得到机会再次经历他们刚完成的人生的每个时刻——不仅是从它们的角度去经验它，而且也从所有受该时刻影响的人角度去经验它。他们将会重新思考每个思维，重新说出每句话，重新做出每件事，去经验那对每个受牵涉的人的影响，仿佛它们是别人一样——而它们确实就是别人。&lt;/p&gt;&lt;p&gt;它们将会经验地认识到它们的身份。在这个时刻，“我们所有人是一体”这句话不再是概念，它将会变成经验。&lt;/p&gt;&lt;p&gt;让你们承受无尽的折磨和诅咒的地方并不存在，那是你们的神学理论杜撰出来的。但你们——你们所有人——将会经验到你们的选择和决定造成的影响、后果和结局。然而这关乎成长，而非“正义”。这是进化的过程，而非神佛的“惩罚”。&lt;/p&gt;&lt;p&gt;在你进行“人生回顾”——有些人这么称呼它——过程中，你不会受到任何人的审判，而只是有机会去经验你的整体在生活的每时每刻所经验到的东西，而非你那寄居在当前肉身中的个体所经验到的东西。&lt;/p&gt;&lt;p&gt;你经验到的不是痛苦，而是觉悟。你将会深深地理解、深深地省悟每个时刻的总体和它蕴含的意义。然而这不会令你痛苦，这会让你进入光明的境界。&lt;br&gt;&lt;/p&gt;', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', ''),
(6, 3, '每件事和每件冒险，都是你的灵魂召来你自己身边的', '', '&lt;p&gt;没有什么是你不能成为的，没有什么是你不能做的。没有什么是你不能拥有的。你可以是、可以做、并可以拥有任何你能想象的东西。相信神就是相信神最伟大的礼物――无条件的爱，及神最大的允诺――无限的潜能。你并不事先选择你将经验的人生。不过，你可以选择用以创造你的经验的任务、地点和事件――条件和情境、挑战和障碍、机会和选择。在你所有选择去做的事里，你的潜能是无限的。所以不要先肯定说，一个投生在你所谓受限的肉体里的灵魂，是无法达到它完全的潜能的，因为你并不知道那个灵魂想做些什么。你并不了解他的生命议程（agenda）。你对他的意图并不清楚。因此，祝福并感谢每个人和每个情况吧！如此，你就是肯定了神的创造之完美――并且表示出你对他的信心。因为在神的世界里是没有意外的，没有一件事是巧合，也没有什么事是“因意外”而发生的。每件事和每件冒险，都是你的灵魂召来你自己身边的，以使你能创造并经验你真的是谁。世界会是这样的现状，是由于你及你做过――或没有做――的选择。（不做决定也是决定。）&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', ''),
(6, 2, '每件事和每件冒险，都是你的灵魂召来你自己身边的', '', '&lt;p&gt;没有什么是你不能成为的，没有什么是你不能做的。没有什么是你不能拥有的。你可以是、可以做、并可以拥有任何你能想象的东西。相信神就是相信神最伟大的礼物――无条件的爱，及神最大的允诺――无限的潜能。你并不事先选择你将经验的人生。不过，你可以选择用以创造你的经验的任务、地点和事件――条件和情境、挑战和障碍、机会和选择。在你所有选择去做的事里，你的潜能是无限的。所以不要先肯定说，一个投生在你所谓受限的肉体里的灵魂，是无法达到它完全的潜能的，因为你并不知道那个灵魂想做些什么。你并不了解他的生命议程（agenda）。你对他的意图并不清楚。因此，祝福并感谢每个人和每个情况吧！如此，你就是肯定了神的创造之完美――并且表示出你对他的信心。因为在神的世界里是没有意外的，没有一件事是巧合，也没有什么事是“因意外”而发生的。每件事和每件冒险，都是你的灵魂召来你自己身边的，以使你能创造并经验你真的是谁。世界会是这样的现状，是由于你及你做过――或没有做――的选择。（不做决定也是决定。）&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', ''),
(6, 1, '每件事和每件冒险，都是你的灵魂召来你自己身边的', '', '&lt;p&gt;没有什么是你不能成为的，没有什么是你不能做的。没有什么是你不能拥有的。你可以是、可以做、并可以拥有任何你能想象的东西。相信神就是相信神最伟大的礼物――无条件的爱，及神最大的允诺――无限的潜能。你并不事先选择你将经验的人生。不过，你可以选择用以创造你的经验的任务、地点和事件――条件和情境、挑战和障碍、机会和选择。在你所有选择去做的事里，你的潜能是无限的。所以不要先肯定说，一个投生在你所谓受限的肉体里的灵魂，是无法达到它完全的潜能的，因为你并不知道那个灵魂想做些什么。你并不了解他的生命议程（agenda）。你对他的意图并不清楚。因此，祝福并感谢每个人和每个情况吧！如此，你就是肯定了神的创造之完美――并且表示出你对他的信心。因为在神的世界里是没有意外的，没有一件事是巧合，也没有什么事是“因意外”而发生的。每件事和每件冒险，都是你的灵魂召来你自己身边的，以使你能创造并经验你真的是谁。世界会是这样的现状，是由于你及你做过――或没有做――的选择。（不做决定也是决定。）&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', 'MyCnCart  - 每件事和每件冒险，都是你的灵魂召来你自己身边的', ''),
(7, 3, '在宇宙里没有巧合，神在所有的路途上', '你认为是什么将你带到这资料里来的？你怎么会将它拿在你手上的？你认为我不知道我在做什么吗？在宇宙里没有巧合。', '&lt;p&gt;你认为是什么将你带到这资料里来的？你怎么会将它拿在你手上的？你认为我不知道我在做什么吗？在宇宙里没有巧合。我听到了你心的哭喊。我看到了你灵魂的追求。我明白你对真理的渴望有多深。你在痛苦中，也在喜悦中召唤它。你不停不休的恳求我显示我自己，解释我自己，透露我自己。我现在就在这样做，以如此浅白的文字，使你不会误解。以如此简单的语言，让你不会搞混。以如此平凡的语汇，让你不致迷失在冗词中。所以就来吧，问我任何事。任何事！我会设法给你答案。我会用整个宇宙去做这件事。所以注意了！这本书并非我唯一的工具。差得远呢！你可以在问个问题后，就放下这本书。但注意看！注意听！你听到的下一首歌的歌词、你读到的下一篇文章里的资讯、你看的下一部电影的故事情节、你遇见的下一个人无意中说的话，或下一条河、下一片海洋的私语，轻抚你耳朵的下一抹微风――所有这些的设计都是来自我的；所有这些途径都对我开放。如果你肯听我向你说话。如果你邀请我，我会来。那时我会显示给你看，我一直都在那儿。在所有路途上。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', ''),
(7, 2, '在宇宙里没有巧合，神在所有的路途上', '你认为是什么将你带到这资料里来的？你怎么会将它拿在你手上的？你认为我不知道我在做什么吗？在宇宙里没有巧合。', '&lt;p&gt;你认为是什么将你带到这资料里来的？你怎么会将它拿在你手上的？你认为我不知道我在做什么吗？在宇宙里没有巧合。我听到了你心的哭喊。我看到了你灵魂的追求。我明白你对真理的渴望有多深。你在痛苦中，也在喜悦中召唤它。你不停不休的恳求我显示我自己，解释我自己，透露我自己。我现在就在这样做，以如此浅白的文字，使你不会误解。以如此简单的语言，让你不会搞混。以如此平凡的语汇，让你不致迷失在冗词中。所以就来吧，问我任何事。任何事！我会设法给你答案。我会用整个宇宙去做这件事。所以注意了！这本书并非我唯一的工具。差得远呢！你可以在问个问题后，就放下这本书。但注意看！注意听！你听到的下一首歌的歌词、你读到的下一篇文章里的资讯、你看的下一部电影的故事情节、你遇见的下一个人无意中说的话，或下一条河、下一片海洋的私语，轻抚你耳朵的下一抹微风――所有这些的设计都是来自我的；所有这些途径都对我开放。如果你肯听我向你说话。如果你邀请我，我会来。那时我会显示给你看，我一直都在那儿。在所有路途上。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', ''),
(7, 1, '在宇宙里没有巧合，神在所有的路途上', '你认为是什么将你带到这资料里来的？你怎么会将它拿在你手上的？你认为我不知道我在做什么吗？在宇宙里没有巧合。', '&lt;p&gt;你认为是什么将你带到这资料里来的？你怎么会将它拿在你手上的？你认为我不知道我在做什么吗？在宇宙里没有巧合。我听到了你心的哭喊。我看到了你灵魂的追求。我明白你对真理的渴望有多深。你在痛苦中，也在喜悦中召唤它。你不停不休的恳求我显示我自己，解释我自己，透露我自己。我现在就在这样做，以如此浅白的文字，使你不会误解。以如此简单的语言，让你不会搞混。以如此平凡的语汇，让你不致迷失在冗词中。所以就来吧，问我任何事。任何事！我会设法给你答案。我会用整个宇宙去做这件事。所以注意了！这本书并非我唯一的工具。差得远呢！你可以在问个问题后，就放下这本书。但注意看！注意听！你听到的下一首歌的歌词、你读到的下一篇文章里的资讯、你看的下一部电影的故事情节、你遇见的下一个人无意中说的话，或下一条河、下一片海洋的私语，轻抚你耳朵的下一抹微风――所有这些的设计都是来自我的；所有这些途径都对我开放。如果你肯听我向你说话。如果你邀请我，我会来。那时我会显示给你看，我一直都在那儿。在所有路途上。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', 'MyCnCart  - 在宇宙里没有巧合，神在所有的路途上', ''),
(8, 3, '天堂就是此时此地', '根本没有所谓“上天堂”这一回事。只有你已经在那儿的一种明白。那是一种接受，一种了解，而不是努力追求或奋斗。', '&lt;p&gt;根本没有所谓“上天堂”这一回事。只有你已经在那儿的一种明白。那是一种接受，一种了解，而不是努力追求或奋斗。你无法去你已经在的地方。悟道就是：了解无处可去，无事可做，并且，除了你现在是的那个人之外，你也不必做任何其他人。所以你们所谓的天堂是个乌有之乡（nowhere）。让我们在W与H这两个字之间留一点空间，你就会明白天堂就是此时…此地（now…here）。要知道：没有不正确的途径这种东西――因为在这旅途上，你无法“不到”你去的地方。只不过是速度的问题――只不过是你何时抵达的问题――然而，即使这样也是个幻象，因为并没有“何时”，也没有“之前”或“之后”，只有现在；一个永远的永恒片刻，你在其中经验你自己。人生的重点并非到达任何地方――人生是注意到你已经在那儿，并且一向都在那儿。人生的重点是创造――创造你是谁和是什么，然后去经验它。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 天堂就是此时此地', 'MyCnCart  - 天堂就是此时此地', 'MyCnCart  - 天堂就是此时此地', ''),
(8, 2, '天堂就是此时此地', '根本没有所谓“上天堂”这一回事。只有你已经在那儿的一种明白。那是一种接受，一种了解，而不是努力追求或奋斗。', '&lt;p&gt;根本没有所谓“上天堂”这一回事。只有你已经在那儿的一种明白。那是一种接受，一种了解，而不是努力追求或奋斗。你无法去你已经在的地方。悟道就是：了解无处可去，无事可做，并且，除了你现在是的那个人之外，你也不必做任何其他人。所以你们所谓的天堂是个乌有之乡（nowhere）。让我们在W与H这两个字之间留一点空间，你就会明白天堂就是此时…此地（now…here）。要知道：没有不正确的途径这种东西――因为在这旅途上，你无法“不到”你去的地方。只不过是速度的问题――只不过是你何时抵达的问题――然而，即使这样也是个幻象，因为并没有“何时”，也没有“之前”或“之后”，只有现在；一个永远的永恒片刻，你在其中经验你自己。人生的重点并非到达任何地方――人生是注意到你已经在那儿，并且一向都在那儿。人生的重点是创造――创造你是谁和是什么，然后去经验它。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 天堂就是此时此地', 'MyCnCart  - 天堂就是此时此地', 'MyCnCart  - 天堂就是此时此地', ''),
(8, 1, '天堂就是此时此地', '根本没有所谓“上天堂”这一回事。只有你已经在那儿的一种明白。那是一种接受，一种了解，而不是努力追求或奋斗。', '&lt;p&gt;根本没有所谓“上天堂”这一回事。只有你已经在那儿的一种明白。那是一种接受，一种了解，而不是努力追求或奋斗。你无法去你已经在的地方。悟道就是：了解无处可去，无事可做，并且，除了你现在是的那个人之外，你也不必做任何其他人。所以你们所谓的天堂是个乌有之乡（nowhere）。让我们在W与H这两个字之间留一点空间，你就会明白天堂就是此时…此地（now…here）。要知道：没有不正确的途径这种东西――因为在这旅途上，你无法“不到”你去的地方。只不过是速度的问题――只不过是你何时抵达的问题――然而，即使这样也是个幻象，因为并没有“何时”，也没有“之前”或“之后”，只有现在；一个永远的永恒片刻，你在其中经验你自己。人生的重点并非到达任何地方――人生是注意到你已经在那儿，并且一向都在那儿。人生的重点是创造――创造你是谁和是什么，然后去经验它。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 天堂就是此时此地', 'MyCnCart  - 天堂就是此时此地', 'MyCnCart  - 天堂就是此时此地', ''),
(9, 3, '真正的爱是让人独立', '一旦你上升到神的意识层面，你将了解自己不必为任何别的人负责，而且，虽然希望每个灵魂都过着安适的生活是值得赞扬的，但每个灵魂在每一瞬间都必须选择――都在选择――其本身的命运。', '&lt;p&gt;一旦你上升到神的意识层面，你将了解自己不必为任何别的人负责，而且，虽然希望每个灵魂都过着安适的生活是值得赞扬的，但每个灵魂在每一瞬间都必须选择――都在选择――其本身的命运。让你的爱推你所爱的人进入世界――并且进入完全体验他们是谁的经验里。这样做，你才算是真正爱过人。你的责任是令他们独立。只有当他们醒悟到你是不必要的时候，你才真的是他们的一项赐福。同样的，当你醒悟到你不需要神时，也才是神最快乐的时刻。一位真正的大师并非拥有最多学生的人，而是创造出最多大师的人。而一位真正的神，并非拥有最多佣仆的那一位，却是为最多人服务的，因而使得所有其他人都成为神的那一位。我的喜悦是在你的自由，而非在你的服从。这是神的目标，也是神的荣耀：即，他不再有臣民，并且所有的人都认识到，神并非那不可及的，却是那不可避免的。你快乐的命运是不可避免的。你无法不“得救”。除了不明白此点之外，并没有别的地狱。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 真正的爱是让人独立', 'MyCnCart  - 真正的爱是让人独立', 'MyCnCart  - 真正的爱是让人独立', ''),
(9, 2, '真正的爱是让人独立', '一旦你上升到神的意识层面，你将了解自己不必为任何别的人负责，而且，虽然希望每个灵魂都过着安适的生活是值得赞扬的，但每个灵魂在每一瞬间都必须选择――都在选择――其本身的命运。', '&lt;p&gt;一旦你上升到神的意识层面，你将了解自己不必为任何别的人负责，而且，虽然希望每个灵魂都过着安适的生活是值得赞扬的，但每个灵魂在每一瞬间都必须选择――都在选择――其本身的命运。让你的爱推你所爱的人进入世界――并且进入完全体验他们是谁的经验里。这样做，你才算是真正爱过人。你的责任是令他们独立。只有当他们醒悟到你是不必要的时候，你才真的是他们的一项赐福。同样的，当你醒悟到你不需要神时，也才是神最快乐的时刻。一位真正的大师并非拥有最多学生的人，而是创造出最多大师的人。而一位真正的神，并非拥有最多佣仆的那一位，却是为最多人服务的，因而使得所有其他人都成为神的那一位。我的喜悦是在你的自由，而非在你的服从。这是神的目标，也是神的荣耀：即，他不再有臣民，并且所有的人都认识到，神并非那不可及的，却是那不可避免的。你快乐的命运是不可避免的。你无法不“得救”。除了不明白此点之外，并没有别的地狱。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 真正的爱是让人独立', 'MyCnCart  - 真正的爱是让人独立', 'MyCnCart  - 真正的爱是让人独立', ''),
(9, 1, '真正的爱是让人独立', '一旦你上升到神的意识层面，你将了解自己不必为任何别的人负责，而且，虽然希望每个灵魂都过着安适的生活是值得赞扬的，但每个灵魂在每一瞬间都必须选择――都在选择――其本身的命运。', '&lt;p&gt;一旦你上升到神的意识层面，你将了解自己不必为任何别的人负责，而且，虽然希望每个灵魂都过着安适的生活是值得赞扬的，但每个灵魂在每一瞬间都必须选择――都在选择――其本身的命运。让你的爱推你所爱的人进入世界――并且进入完全体验他们是谁的经验里。这样做，你才算是真正爱过人。你的责任是令他们独立。只有当他们醒悟到你是不必要的时候，你才真的是他们的一项赐福。同样的，当你醒悟到你不需要神时，也才是神最快乐的时刻。一位真正的大师并非拥有最多学生的人，而是创造出最多大师的人。而一位真正的神，并非拥有最多佣仆的那一位，却是为最多人服务的，因而使得所有其他人都成为神的那一位。我的喜悦是在你的自由，而非在你的服从。这是神的目标，也是神的荣耀：即，他不再有臣民，并且所有的人都认识到，神并非那不可及的，却是那不可避免的。你快乐的命运是不可避免的。你无法不“得救”。除了不明白此点之外，并没有别的地狱。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 真正的爱是让人独立', 'MyCnCart  - 真正的爱是让人独立', 'MyCnCart  - 真正的爱是让人独立', ''),
(10, 3, '关系是神圣的，祝福每个关系', '关系是经常具挑战性的；经常召唤你去创造、表现，并且经验你自己之更高又更高的面向，你自己之更宏伟又更宏伟的视野，你自己之越来越崇高的版本。', '&lt;p&gt;关系是经常具挑战性的；经常召唤你去创造、表现，并且经验你自己之更高又更高的面向，你自己之更宏伟又更宏伟的视野，你自己之越来越崇高的版本。唯有透过你与其他人、地及事件的关系，你才能存在于宇宙里！所以，祝福每个关系，将每个都视为特殊，并且都形成了你是谁――并且现在选择做谁。关系的目的是，决定你喜欢看到你自己的哪个部分“显出来”，而非你可以捕获且保留别人的哪个部分。就关系――并且就整个人生――而言，只能有一个目的：去做，并且去决定你真正是谁。由于关系提供了人生最大的机会――的确，其唯一的机会――去创造及制作你对自己之最高观念的经验，所以关系是神圣的。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 关系是神圣的，祝福每个关系', 'MyCnCart  - 关系是神圣的，祝福每个关系', 'MyCnCart  - 关系是神圣的，祝福每个关系', ''),
(10, 2, '关系是神圣的，祝福每个关系', '关系是经常具挑战性的；经常召唤你去创造、表现，并且经验你自己之更高又更高的面向，你自己之更宏伟又更宏伟的视野，你自己之越来越崇高的版本。', '&lt;p&gt;关系是经常具挑战性的；经常召唤你去创造、表现，并且经验你自己之更高又更高的面向，你自己之更宏伟又更宏伟的视野，你自己之越来越崇高的版本。唯有透过你与其他人、地及事件的关系，你才能存在于宇宙里！所以，祝福每个关系，将每个都视为特殊，并且都形成了你是谁――并且现在选择做谁。关系的目的是，决定你喜欢看到你自己的哪个部分“显出来”，而非你可以捕获且保留别人的哪个部分。就关系――并且就整个人生――而言，只能有一个目的：去做，并且去决定你真正是谁。由于关系提供了人生最大的机会――的确，其唯一的机会――去创造及制作你对自己之最高观念的经验，所以关系是神圣的。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 关系是神圣的，祝福每个关系', 'MyCnCart  - 关系是神圣的，祝福每个关系', 'MyCnCart  - 关系是神圣的，祝福每个关系', ''),
(10, 1, '关系是神圣的，祝福每个关系', '关系是经常具挑战性的；经常召唤你去创造、表现，并且经验你自己之更高又更高的面向，你自己之更宏伟又更宏伟的视野，你自己之越来越崇高的版本。', '&lt;p&gt;关系是经常具挑战性的；经常召唤你去创造、表现，并且经验你自己之更高又更高的面向，你自己之更宏伟又更宏伟的视野，你自己之越来越崇高的版本。唯有透过你与其他人、地及事件的关系，你才能存在于宇宙里！所以，祝福每个关系，将每个都视为特殊，并且都形成了你是谁――并且现在选择做谁。关系的目的是，决定你喜欢看到你自己的哪个部分“显出来”，而非你可以捕获且保留别人的哪个部分。就关系――并且就整个人生――而言，只能有一个目的：去做，并且去决定你真正是谁。由于关系提供了人生最大的机会――的确，其唯一的机会――去创造及制作你对自己之最高观念的经验，所以关系是神圣的。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 关系是神圣的，祝福每个关系', 'MyCnCart  - 关系是神圣的，祝福每个关系', 'MyCnCart  - 关系是神圣的，祝福每个关系', ''),
(11, 3, '最有爱心的人就是“自我中心”的人', '当你将关系看作是去创造和制作你对他人之最高观念的经验时，关系便会失败。', '&lt;p&gt;当你将关系看作是去创造和制作你对他人之最高观念的经验时，关系便会失败。让在关系里的每个人都只担心他自己――自己在作谁、做什么和有什么；自己在要什么、要求什么、给与什么；自己在寻求、创造和经验什么，那么，所有的关系都会绰绰有余地满足其目的――及它们的参与者！让在关系里的人别去担心别人，却只、只、只担心自己。最有爱心的人就是“自我中心”的人。如果你无法爱你的自己，你便无法爱别人。在关系中失去自我，是在这种结合中造成大多数痛苦的原因。当你再也看不到彼此为神圣旅程上的神圣灵魂时，你就无法看见在所有关系背后之理由和目的。为了进化的目的，灵魂才进入身体。你是谁就是在与所有其他一切的关系中，你创造自己成为什么。在这过程中，最重要的因素就是你的个人关系。你的第一个关系必然是与你自己的关系。你必须先学会尊重、珍惜，并且爱你自己。在你能视别人为有价值的人之前，你首先必须视你自己为有价值的。在你能视别人为有福的之前，你首先必须视你自己为有福的。在你能承认别人的神圣性之前，你首先必须认识你自己为神圣的。老师们全都带来同样的讯息：并非“我比你神圣”，却是“你与我一样神圣”。因此我告诉你：现在并且永远以你自己为中心。你的救赎并不能在别人的行为（action）中找到，只能在你的反应（re-action）中找到。在与别人的互动过程里，第一个问题是：现在我是谁，还有，与那个相关的，我想要作谁？&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', ''),
(11, 2, '最有爱心的人就是“自我中心”的人', '当你将关系看作是去创造和制作你对他人之最高观念的经验时，关系便会失败。', '&lt;p&gt;当你将关系看作是去创造和制作你对他人之最高观念的经验时，关系便会失败。让在关系里的每个人都只担心他自己――自己在作谁、做什么和有什么；自己在要什么、要求什么、给与什么；自己在寻求、创造和经验什么，那么，所有的关系都会绰绰有余地满足其目的――及它们的参与者！让在关系里的人别去担心别人，却只、只、只担心自己。最有爱心的人就是“自我中心”的人。如果你无法爱你的自己，你便无法爱别人。在关系中失去自我，是在这种结合中造成大多数痛苦的原因。当你再也看不到彼此为神圣旅程上的神圣灵魂时，你就无法看见在所有关系背后之理由和目的。为了进化的目的，灵魂才进入身体。你是谁就是在与所有其他一切的关系中，你创造自己成为什么。在这过程中，最重要的因素就是你的个人关系。你的第一个关系必然是与你自己的关系。你必须先学会尊重、珍惜，并且爱你自己。在你能视别人为有价值的人之前，你首先必须视你自己为有价值的。在你能视别人为有福的之前，你首先必须视你自己为有福的。在你能承认别人的神圣性之前，你首先必须认识你自己为神圣的。老师们全都带来同样的讯息：并非“我比你神圣”，却是“你与我一样神圣”。因此我告诉你：现在并且永远以你自己为中心。你的救赎并不能在别人的行为（action）中找到，只能在你的反应（re-action）中找到。在与别人的互动过程里，第一个问题是：现在我是谁，还有，与那个相关的，我想要作谁？&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', ''),
(11, 1, '最有爱心的人就是“自我中心”的人', '当你将关系看作是去创造和制作你对他人之最高观念的经验时，关系便会失败。', '&lt;p&gt;当你将关系看作是去创造和制作你对他人之最高观念的经验时，关系便会失败。让在关系里的每个人都只担心他自己――自己在作谁、做什么和有什么；自己在要什么、要求什么、给与什么；自己在寻求、创造和经验什么，那么，所有的关系都会绰绰有余地满足其目的――及它们的参与者！让在关系里的人别去担心别人，却只、只、只担心自己。最有爱心的人就是“自我中心”的人。如果你无法爱你的自己，你便无法爱别人。在关系中失去自我，是在这种结合中造成大多数痛苦的原因。当你再也看不到彼此为神圣旅程上的神圣灵魂时，你就无法看见在所有关系背后之理由和目的。为了进化的目的，灵魂才进入身体。你是谁就是在与所有其他一切的关系中，你创造自己成为什么。在这过程中，最重要的因素就是你的个人关系。你的第一个关系必然是与你自己的关系。你必须先学会尊重、珍惜，并且爱你自己。在你能视别人为有价值的人之前，你首先必须视你自己为有价值的。在你能视别人为有福的之前，你首先必须视你自己为有福的。在你能承认别人的神圣性之前，你首先必须认识你自己为神圣的。老师们全都带来同样的讯息：并非“我比你神圣”，却是“你与我一样神圣”。因此我告诉你：现在并且永远以你自己为中心。你的救赎并不能在别人的行为（action）中找到，只能在你的反应（re-action）中找到。在与别人的互动过程里，第一个问题是：现在我是谁，还有，与那个相关的，我想要作谁？&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', 'MyCnCart  - 最有爱心的人就是“自我中心”的人', ''),
(12, 3, '做神的信使，唤醒每一个人', '灵魂的工作是唤醒你自己。神的工作是唤醒每一个人。', '&lt;p&gt;灵魂的工作是唤醒你自己。神的工作是唤醒每一个人。你能以两种方式做到此点――藉由提醒他们他们是谁（但这非常困难，因为他们不会相信你），或藉由记得你是谁（这容易得多，因为你并不需要他们的相信，只需要你自己的）。经常展现此点终究会提醒别人他们是谁，因为他们会在你身上看到他们自己。许多大师曾被派到地球来展示永恒的真理。你便是这样的一个信使。――你们全都是特殊的……宣告自己为一个属神的人需要很大的勇气。你愿意吗？你的心是否渴望说出关于我的真理？你是否愿意忍受你的人类同胞的耻笑？你是否准备好放弃世上的荣耀，为了使灵魂的更大荣耀得以完全的实现？去与他人分享永恒的真理……并非出于获得光荣的需要，却是出于你内心最深的愿望，去终止别人的痛苦和受罪；去带来喜悦和快乐，以及助力和治愈；去重新让别人与你一向体验到的与神的合伙之感连结。我选择了你做我的信使。你和许多其他人。因为现在，在即刻的眼前，世界将需要许多号角来吹出清亮的召唤。世界将需要许多声音，来说出百千万人渴望的真理和治愈的话语。世界将需要许多心结合在一起，来做灵魂的工作，并且准备去做神的工作。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 做神的信使，唤醒每一个人', 'MyCnCart  - 做神的信使，唤醒每一个人', 'MyCnCart  - 做神的信使，唤醒每一个人', ''),
(12, 2, '做神的信使，唤醒每一个人', '灵魂的工作是唤醒你自己。神的工作是唤醒每一个人。', '&lt;p&gt;灵魂的工作是唤醒你自己。神的工作是唤醒每一个人。你能以两种方式做到此点――藉由提醒他们他们是谁（但这非常困难，因为他们不会相信你），或藉由记得你是谁（这容易得多，因为你并不需要他们的相信，只需要你自己的）。经常展现此点终究会提醒别人他们是谁，因为他们会在你身上看到他们自己。许多大师曾被派到地球来展示永恒的真理。你便是这样的一个信使。――你们全都是特殊的……宣告自己为一个属神的人需要很大的勇气。你愿意吗？你的心是否渴望说出关于我的真理？你是否愿意忍受你的人类同胞的耻笑？你是否准备好放弃世上的荣耀，为了使灵魂的更大荣耀得以完全的实现？去与他人分享永恒的真理……并非出于获得光荣的需要，却是出于你内心最深的愿望，去终止别人的痛苦和受罪；去带来喜悦和快乐，以及助力和治愈；去重新让别人与你一向体验到的与神的合伙之感连结。我选择了你做我的信使。你和许多其他人。因为现在，在即刻的眼前，世界将需要许多号角来吹出清亮的召唤。世界将需要许多声音，来说出百千万人渴望的真理和治愈的话语。世界将需要许多心结合在一起，来做灵魂的工作，并且准备去做神的工作。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 做神的信使，唤醒每一个人', 'MyCnCart  - 做神的信使，唤醒每一个人', 'MyCnCart  - 做神的信使，唤醒每一个人', ''),
(12, 1, '做神的信使，唤醒每一个人', '灵魂的工作是唤醒你自己。神的工作是唤醒每一个人。', '&lt;p&gt;灵魂的工作是唤醒你自己。神的工作是唤醒每一个人。你能以两种方式做到此点――藉由提醒他们他们是谁（但这非常困难，因为他们不会相信你），或藉由记得你是谁（这容易得多，因为你并不需要他们的相信，只需要你自己的）。经常展现此点终究会提醒别人他们是谁，因为他们会在你身上看到他们自己。许多大师曾被派到地球来展示永恒的真理。你便是这样的一个信使。――你们全都是特殊的……宣告自己为一个属神的人需要很大的勇气。你愿意吗？你的心是否渴望说出关于我的真理？你是否愿意忍受你的人类同胞的耻笑？你是否准备好放弃世上的荣耀，为了使灵魂的更大荣耀得以完全的实现？去与他人分享永恒的真理……并非出于获得光荣的需要，却是出于你内心最深的愿望，去终止别人的痛苦和受罪；去带来喜悦和快乐，以及助力和治愈；去重新让别人与你一向体验到的与神的合伙之感连结。我选择了你做我的信使。你和许多其他人。因为现在，在即刻的眼前，世界将需要许多号角来吹出清亮的召唤。世界将需要许多声音，来说出百千万人渴望的真理和治愈的话语。世界将需要许多心结合在一起，来做灵魂的工作，并且准备去做神的工作。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 做神的信使，唤醒每一个人', 'MyCnCart  - 做神的信使，唤醒每一个人', 'MyCnCart  - 做神的信使，唤醒每一个人', ''),
(13, 3, '灵魂只关注你存在的状态', '人生的讽刺是，一旦世俗的物品和世俗的成功不再为你所关心，它们流向你的路便打开了。记住，你无法拥有你想要的东西，但你可以经验你所拥有的不论什么东西。', '&lt;p&gt;做事是身体的一个机能。存在是灵魂的一个机能。你的灵魂不在乎你做什么维生――而当你的人生过完了时，你也不会在意。你的灵魂只在乎，当你在做不论你做的什么时，你是什么。灵魂追求的是一种存在的状态，而非一种做事的状态。“是”吸引“是”，而产生经验。灵魂寻求神，但它寻求的这个我是非常复杂，非常多重次元、多种感觉、多重面向的。在寻求是我的当儿，灵魂在它前面有个宏大的工作；一个可自其中挑选的庞大的“是”之菜单。然后产生正确而完美的条件，在其中创造对那存在状态的经验。所以，真实的事是，没有一件发生在你身上或经由你发生的事，不是为了你自己的最高善的。现在，在这一刻，你的灵魂又创造了机会让你去是、做，并且拥有认识你真的是谁所需的东西。你的灵魂带你到你现在正在读的字句――正如它以前曾带你到智慧和真理的字句。你现在要做什么？你选择要是什么？你的灵魂怀着兴趣等着、看着，正如它以前做过许多次的。我并不关心你世俗的成功，只有你关心。真正的大师们是那些选择去创造一个人生，而非维持一个生活的人。从某种存在状态会跃出一个如此丰富、如此圆满、如此宏伟，而且如此有益的人生，以致世俗的物品和世俗的成功将不再为你所关心了。人生的讽刺是，一旦世俗的物品和世俗的成功不再为你所关心，它们流向你的路便打开了。记住，你无法拥有你想要的东西，但你可以经验你所拥有的不论什么东西。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 灵魂只关注你存在的状态', 'MyCnCart  - 灵魂只关注你存在的状态', 'MyCnCart  - 灵魂只关注你存在的状态', ''),
(13, 2, '灵魂只关注你存在的状态', '人生的讽刺是，一旦世俗的物品和世俗的成功不再为你所关心，它们流向你的路便打开了。记住，你无法拥有你想要的东西，但你可以经验你所拥有的不论什么东西。', '&lt;p&gt;做事是身体的一个机能。存在是灵魂的一个机能。你的灵魂不在乎你做什么维生――而当你的人生过完了时，你也不会在意。你的灵魂只在乎，当你在做不论你做的什么时，你是什么。灵魂追求的是一种存在的状态，而非一种做事的状态。“是”吸引“是”，而产生经验。灵魂寻求神，但它寻求的这个我是非常复杂，非常多重次元、多种感觉、多重面向的。在寻求是我的当儿，灵魂在它前面有个宏大的工作；一个可自其中挑选的庞大的“是”之菜单。然后产生正确而完美的条件，在其中创造对那存在状态的经验。所以，真实的事是，没有一件发生在你身上或经由你发生的事，不是为了你自己的最高善的。现在，在这一刻，你的灵魂又创造了机会让你去是、做，并且拥有认识你真的是谁所需的东西。你的灵魂带你到你现在正在读的字句――正如它以前曾带你到智慧和真理的字句。你现在要做什么？你选择要是什么？你的灵魂怀着兴趣等着、看着，正如它以前做过许多次的。我并不关心你世俗的成功，只有你关心。真正的大师们是那些选择去创造一个人生，而非维持一个生活的人。从某种存在状态会跃出一个如此丰富、如此圆满、如此宏伟，而且如此有益的人生，以致世俗的物品和世俗的成功将不再为你所关心了。人生的讽刺是，一旦世俗的物品和世俗的成功不再为你所关心，它们流向你的路便打开了。记住，你无法拥有你想要的东西，但你可以经验你所拥有的不论什么东西。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 灵魂只关注你存在的状态', 'MyCnCart  - 灵魂只关注你存在的状态', 'MyCnCart  - 灵魂只关注你存在的状态', ''),
(13, 1, '灵魂只关注你存在的状态', '人生的讽刺是，一旦世俗的物品和世俗的成功不再为你所关心，它们流向你的路便打开了。记住，你无法拥有你想要的东西，但你可以经验你所拥有的不论什么东西。', '&lt;p&gt;做事是身体的一个机能。存在是灵魂的一个机能。你的灵魂不在乎你做什么维生――而当你的人生过完了时，你也不会在意。你的灵魂只在乎，当你在做不论你做的什么时，你是什么。灵魂追求的是一种存在的状态，而非一种做事的状态。“是”吸引“是”，而产生经验。灵魂寻求神，但它寻求的这个我是非常复杂，非常多重次元、多种感觉、多重面向的。在寻求是我的当儿，灵魂在它前面有个宏大的工作；一个可自其中挑选的庞大的“是”之菜单。然后产生正确而完美的条件，在其中创造对那存在状态的经验。所以，真实的事是，没有一件发生在你身上或经由你发生的事，不是为了你自己的最高善的。现在，在这一刻，你的灵魂又创造了机会让你去是、做，并且拥有认识你真的是谁所需的东西。你的灵魂带你到你现在正在读的字句――正如它以前曾带你到智慧和真理的字句。你现在要做什么？你选择要是什么？你的灵魂怀着兴趣等着、看着，正如它以前做过许多次的。我并不关心你世俗的成功，只有你关心。真正的大师们是那些选择去创造一个人生，而非维持一个生活的人。从某种存在状态会跃出一个如此丰富、如此圆满、如此宏伟，而且如此有益的人生，以致世俗的物品和世俗的成功将不再为你所关心了。人生的讽刺是，一旦世俗的物品和世俗的成功不再为你所关心，它们流向你的路便打开了。记住，你无法拥有你想要的东西，但你可以经验你所拥有的不论什么东西。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 灵魂只关注你存在的状态', 'MyCnCart  - 灵魂只关注你存在的状态', 'MyCnCart  - 灵魂只关注你存在的状态', ''),
(14, 3, '平衡身、心、灵----三位一体，即神成肉身', '当身、心和灵在和谐与统一中一同创造时，神成肉身。于是，灵魂真的在其自己的经验中认识它自己。于是，天堂真的欢欣鼓舞。', '&lt;p&gt;不要轻视你身体正在做的事。它是重要的。但却非以你所想的方式。身体的行动本意是反映一种存在状态，而非想达到一种存在状态的企图。“你的人生并不是关于你的身体在做什么”这个声明的意思。然而，真实的，你的身体在做什么，却是你的人生是关乎什么的一个反映。你在这星球上并不是要以你的身体生产任何东西。你在这个星球上是要以你的灵魂生产一些东西。你的身体只不过单纯的是你灵魂的工具，你的头脑是令身体做事的力量。所以，你在此所有的是个有力的工具，用来创造灵魂之所欲。&lt;br&gt;&lt;br&gt;发现生命和身体毫无关系，可能创造出另一方面的一个不平衡。虽然一开始实体的行为是――仿佛身体是所有的一切，现在它的行为却象是身体根本不重要。当然，这并不是真的――如果实体很快的忆起来的话。&lt;br&gt;&lt;br&gt;你是个三部分的存在，由身、心和灵构成。你将永远是个三部分的存在，不只当你活在地球上时。在死亡时，身和心并没被丢掉，是身体改变了形式，心智（不可与大脑混淆）也仍与你同行，加入灵和身，成为一个三次元或三面的能量团。事实上，你们全是一个能量，却有三个分别的特征。身与心一起并不需要做任何事去控制灵魂――因为灵魂是全然没有“需要”的（不象身和心都为“需要”所羁绊），因而容许身和心意志照自己的意思而行。服从并非创造，因此永远不能产生救赎。灵魂永远不会凌越身体或心智。我造你们为一个三合一的生灵。你是三个存在合而为一的。按照我的形象造成的。自己的三个面向彼此并非不平等的。每个都有个机能，但没有一个机能比其他的机能更伟大，并且也没有任何一个机能能实际上在另一个之前。灵魂孕育，心智创造，身体体验。所有的都以完全平等的方式彼此相连。灵魂的机能是指明其欲望，并非强加其欲望。头脑的机能是由其选择的余地中选择。身体的机能是表现出那选择。当身、心和灵在和谐与统一中一同创造时，神成肉身。于是，灵魂真的在其自己的经验中认识它自己。于是，天堂真的欢欣鼓舞。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', ''),
(14, 2, '平衡身、心、灵----三位一体，即神成肉身', '当身、心和灵在和谐与统一中一同创造时，神成肉身。于是，灵魂真的在其自己的经验中认识它自己。于是，天堂真的欢欣鼓舞。', '&lt;p&gt;不要轻视你身体正在做的事。它是重要的。但却非以你所想的方式。身体的行动本意是反映一种存在状态，而非想达到一种存在状态的企图。“你的人生并不是关于你的身体在做什么”这个声明的意思。然而，真实的，你的身体在做什么，却是你的人生是关乎什么的一个反映。你在这星球上并不是要以你的身体生产任何东西。你在这个星球上是要以你的灵魂生产一些东西。你的身体只不过单纯的是你灵魂的工具，你的头脑是令身体做事的力量。所以，你在此所有的是个有力的工具，用来创造灵魂之所欲。&lt;br&gt;&lt;br&gt;发现生命和身体毫无关系，可能创造出另一方面的一个不平衡。虽然一开始实体的行为是――仿佛身体是所有的一切，现在它的行为却象是身体根本不重要。当然，这并不是真的――如果实体很快的忆起来的话。&lt;br&gt;&lt;br&gt;你是个三部分的存在，由身、心和灵构成。你将永远是个三部分的存在，不只当你活在地球上时。在死亡时，身和心并没被丢掉，是身体改变了形式，心智（不可与大脑混淆）也仍与你同行，加入灵和身，成为一个三次元或三面的能量团。事实上，你们全是一个能量，却有三个分别的特征。身与心一起并不需要做任何事去控制灵魂――因为灵魂是全然没有“需要”的（不象身和心都为“需要”所羁绊），因而容许身和心意志照自己的意思而行。服从并非创造，因此永远不能产生救赎。灵魂永远不会凌越身体或心智。我造你们为一个三合一的生灵。你是三个存在合而为一的。按照我的形象造成的。自己的三个面向彼此并非不平等的。每个都有个机能，但没有一个机能比其他的机能更伟大，并且也没有任何一个机能能实际上在另一个之前。灵魂孕育，心智创造，身体体验。所有的都以完全平等的方式彼此相连。灵魂的机能是指明其欲望，并非强加其欲望。头脑的机能是由其选择的余地中选择。身体的机能是表现出那选择。当身、心和灵在和谐与统一中一同创造时，神成肉身。于是，灵魂真的在其自己的经验中认识它自己。于是，天堂真的欢欣鼓舞。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', ''),
(14, 1, '平衡身、心、灵----三位一体，即神成肉身', '当身、心和灵在和谐与统一中一同创造时，神成肉身。于是，灵魂真的在其自己的经验中认识它自己。于是，天堂真的欢欣鼓舞。', '&lt;p&gt;不要轻视你身体正在做的事。它是重要的。但却非以你所想的方式。身体的行动本意是反映一种存在状态，而非想达到一种存在状态的企图。“你的人生并不是关于你的身体在做什么”这个声明的意思。然而，真实的，你的身体在做什么，却是你的人生是关乎什么的一个反映。你在这星球上并不是要以你的身体生产任何东西。你在这个星球上是要以你的灵魂生产一些东西。你的身体只不过单纯的是你灵魂的工具，你的头脑是令身体做事的力量。所以，你在此所有的是个有力的工具，用来创造灵魂之所欲。&lt;br&gt;&lt;br&gt;发现生命和身体毫无关系，可能创造出另一方面的一个不平衡。虽然一开始实体的行为是――仿佛身体是所有的一切，现在它的行为却象是身体根本不重要。当然，这并不是真的――如果实体很快的忆起来的话。&lt;br&gt;&lt;br&gt;你是个三部分的存在，由身、心和灵构成。你将永远是个三部分的存在，不只当你活在地球上时。在死亡时，身和心并没被丢掉，是身体改变了形式，心智（不可与大脑混淆）也仍与你同行，加入灵和身，成为一个三次元或三面的能量团。事实上，你们全是一个能量，却有三个分别的特征。身与心一起并不需要做任何事去控制灵魂――因为灵魂是全然没有“需要”的（不象身和心都为“需要”所羁绊），因而容许身和心意志照自己的意思而行。服从并非创造，因此永远不能产生救赎。灵魂永远不会凌越身体或心智。我造你们为一个三合一的生灵。你是三个存在合而为一的。按照我的形象造成的。自己的三个面向彼此并非不平等的。每个都有个机能，但没有一个机能比其他的机能更伟大，并且也没有任何一个机能能实际上在另一个之前。灵魂孕育，心智创造，身体体验。所有的都以完全平等的方式彼此相连。灵魂的机能是指明其欲望，并非强加其欲望。头脑的机能是由其选择的余地中选择。身体的机能是表现出那选择。当身、心和灵在和谐与统一中一同创造时，神成肉身。于是，灵魂真的在其自己的经验中认识它自己。于是，天堂真的欢欣鼓舞。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', 'MyCnCart  - 平衡身、心、灵----三位一体，即神成肉身', ''),
(15, 3, '你是神的身体', '现在我要解释给你听那终极的神秘：你们和我的精确而真实的关系。你们是我的身体。正如你的身体相对于你的心智和灵魂的关系，你们相对于我的心智和灵魂的关系也是一样的。所以：我所经验的每样事，是我透过你们来经验的。正如你的身心和灵是一体的，我的也是一样。', '&lt;p&gt;现在我要解释给你听那终极的神秘：你们和我的精确而真实的关系。你们是我的身体。正如你的身体相对于你的心智和灵魂的关系，你们相对于我的心智和灵魂的关系也是一样的。所以：我所经验的每样事，是我透过你们来经验的。正如你的身心和灵是一体的，我的也是一样。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 你是神的身体', 'MyCnCart  - 你是神的身体', 'MyCnCart  - 你是神的身体', ''),
(15, 2, '你是神的身体', '现在我要解释给你听那终极的神秘：你们和我的精确而真实的关系。你们是我的身体。正如你的身体相对于你的心智和灵魂的关系，你们相对于我的心智和灵魂的关系也是一样的。所以：我所经验的每样事，是我透过你们来经验的。正如你的身心和灵是一体的，我的也是一样。', '&lt;p&gt;现在我要解释给你听那终极的神秘：你们和我的精确而真实的关系。你们是我的身体。正如你的身体相对于你的心智和灵魂的关系，你们相对于我的心智和灵魂的关系也是一样的。所以：我所经验的每样事，是我透过你们来经验的。正如你的身心和灵是一体的，我的也是一样。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 你是神的身体', 'MyCnCart  - 你是神的身体', 'MyCnCart  - 你是神的身体', ''),
(15, 1, '你是神的身体', '现在我要解释给你听那终极的神秘：你们和我的精确而真实的关系。你们是我的身体。正如你的身体相对于你的心智和灵魂的关系，你们相对于我的心智和灵魂的关系也是一样的。所以：我所经验的每样事，是我透过你们来经验的。正如你的身心和灵是一体的，我的也是一样。', '&lt;p&gt;现在我要解释给你听那终极的神秘：你们和我的精确而真实的关系。你们是我的身体。正如你的身体相对于你的心智和灵魂的关系，你们相对于我的心智和灵魂的关系也是一样的。所以：我所经验的每样事，是我透过你们来经验的。正如你的身心和灵是一体的，我的也是一样。&lt;br&gt;&lt;/p&gt;', 'MyCnCart  - 你是神的身体', 'MyCnCart  - 你是神的身体', 'MyCnCart  - 你是神的身体', ''),
(16, 3, '别成为你曾经想要成为的人，要成为你现在希望成为的人', '', '&lt;p&gt;别成为你曾经想要成为的人，要成为你现在希望成为的人&lt;br&gt;&lt;/p&gt;&lt;p&gt;这是你生活中最大的区别。到目前为止，你一直都在努力“成为”你曾经想要成为的人。从现在开始，你将会成为你最崇高愿望的产物。&lt;/p&gt;&lt;p&gt;改变并非为了让神佛接受你。在神佛的眼里，现在的你完全是可以接受的。你改变，只是因为你选择改变，你选择去实现你对自我的新期许。&lt;/p&gt;', '别成为你曾经想要成为的人，要成为你现在希望成为的人', '别成为你曾经想要成为的人，要成为你现在希望成为的人', '别成为你曾经想要成为的人，要成为你现在希望成为的人', ''),
(16, 1, '别成为你曾经想要成为的人，要成为你现在希望成为的人', '', '&lt;p&gt;别成为你曾经想要成为的人，要成为你现在希望成为的人&lt;br&gt;&lt;/p&gt;&lt;p&gt;这是你生活中最大的区别。到目前为止，你一直都在努力“成为”你曾经想要成为的人。从现在开始，你将会成为你最崇高愿望的产物。&lt;/p&gt;&lt;p&gt;改变并非为了让神佛接受你。在神佛的眼里，现在的你完全是可以接受的。你改变，只是因为你选择改变，你选择去实现你对自我的新期许。&lt;/p&gt;', '别成为你曾经想要成为的人，要成为你现在希望成为的人', '别成为你曾经想要成为的人，要成为你现在希望成为的人', '别成为你曾经想要成为的人，要成为你现在希望成为的人', ''),
(16, 2, '别成为你曾经想要成为的人，要成为你现在希望成为的人', '', '&lt;p&gt;别成为你曾经想要成为的人，要成为你现在希望成为的人&lt;br&gt;&lt;/p&gt;&lt;p&gt;这是你生活中最大的区别。到目前为止，你一直都在努力“成为”你曾经想要成为的人。从现在开始，你将会成为你最崇高愿望的产物。&lt;/p&gt;&lt;p&gt;改变并非为了让神佛接受你。在神佛的眼里，现在的你完全是可以接受的。你改变，只是因为你选择改变，你选择去实现你对自我的新期许。&lt;/p&gt;', '别成为你曾经想要成为的人，要成为你现在希望成为的人', '别成为你曾经想要成为的人，要成为你现在希望成为的人', '别成为你曾经想要成为的人，要成为你现在希望成为的人', ''),
(17, 1, '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '', '&lt;p&gt;不可原谅的东西是不存在的。没有任何罪行严重到我会拒绝原谅你。哪怕人类最严厉的宗教也传播这个道理。&lt;/p&gt;&lt;p&gt;这些宗教也许在救赎的方式上有争议，也许在救赎的道路上有争议，但他们全都同意的是，这样的方式和道路是有的。&lt;/p&gt;&lt;p&gt;在你成为死亡的时刻，你自然会得到补赎的机会。&lt;/p&gt;&lt;p&gt;所谓补赎，就是意识到你和所有其他人是一体。那就是明白你和万物——包括我——是合一的。&lt;/p&gt;&lt;p&gt;死亡之后，当你和你的肉体分开之后，你将会立刻拥有——忆起——这种经验。&lt;/p&gt;&lt;p&gt;所有灵魂都以最有意思的方式经验到他们的“合一”。它们将得到机会再次经历他们刚完成的人生的每个时刻——不仅是从它们的角度去经验它，而且也从所有受该时刻影响的人角度去经验它。他们将会重新思考每个思维，重新说出每句话，重新做出每件事，去经验那对每个受牵涉的人的影响，仿佛它们是别人一样——而它们确实就是别人。&lt;/p&gt;&lt;p&gt;它们将会经验地认识到它们的身份。在这个时刻，“我们所有人是一体”这句话不再是概念，它将会变成经验。&lt;/p&gt;&lt;p&gt;让你们承受无尽的折磨和诅咒的地方并不存在，那是你们的神学理论杜撰出来的。但你们——你们所有人——将会经验到你们的选择和决定造成的影响、后果和结局。然而这关乎成长，而非“正义”。这是进化的过程，而非神佛的“惩罚”。&lt;/p&gt;&lt;p&gt;在你进行“人生回顾”——有些人这么称呼它——过程中，你不会受到任何人的审判，而只是有机会去经验你的整体在生活的每时每刻所经验到的东西，而非你那寄居在当前肉身中的个体所经验到的东西。&lt;/p&gt;&lt;p&gt;你经验到的不是痛苦，而是觉悟。你将会深深地理解、深深地省悟每个时刻的总体和它蕴含的意义。然而这不会令你痛苦，这会让你进入光明的境界。&lt;br&gt;&lt;/p&gt;', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', ''),
(17, 3, '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '', '&lt;p&gt;不可原谅的东西是不存在的。没有任何罪行严重到我会拒绝原谅你。哪怕人类最严厉的宗教也传播这个道理。&lt;/p&gt;&lt;p&gt;这些宗教也许在救赎的方式上有争议，也许在救赎的道路上有争议，但他们全都同意的是，这样的方式和道路是有的。&lt;/p&gt;&lt;p&gt;在你成为死亡的时刻，你自然会得到补赎的机会。&lt;/p&gt;&lt;p&gt;所谓补赎，就是意识到你和所有其他人是一体。那就是明白你和万物——包括我——是合一的。&lt;/p&gt;&lt;p&gt;死亡之后，当你和你的肉体分开之后，你将会立刻拥有——忆起——这种经验。&lt;/p&gt;&lt;p&gt;所有灵魂都以最有意思的方式经验到他们的“合一”。它们将得到机会再次经历他们刚完成的人生的每个时刻——不仅是从它们的角度去经验它，而且也从所有受该时刻影响的人角度去经验它。他们将会重新思考每个思维，重新说出每句话，重新做出每件事，去经验那对每个受牵涉的人的影响，仿佛它们是别人一样——而它们确实就是别人。&lt;/p&gt;&lt;p&gt;它们将会经验地认识到它们的身份。在这个时刻，“我们所有人是一体”这句话不再是概念，它将会变成经验。&lt;/p&gt;&lt;p&gt;让你们承受无尽的折磨和诅咒的地方并不存在，那是你们的神学理论杜撰出来的。但你们——你们所有人——将会经验到你们的选择和决定造成的影响、后果和结局。然而这关乎成长，而非“正义”。这是进化的过程，而非神佛的“惩罚”。&lt;/p&gt;&lt;p&gt;在你进行“人生回顾”——有些人这么称呼它——过程中，你不会受到任何人的审判，而只是有机会去经验你的整体在生活的每时每刻所经验到的东西，而非你那寄居在当前肉身中的个体所经验到的东西。&lt;/p&gt;&lt;p&gt;你经验到的不是痛苦，而是觉悟。你将会深深地理解、深深地省悟每个时刻的总体和它蕴含的意义。然而这不会令你痛苦，这会让你进入光明的境界。&lt;br&gt;&lt;/p&gt;', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '如果我犯下了不可原谅的大错，我如何能够原谅自己？', '');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_product`
--

DROP TABLE IF EXISTS `mcc_blog_product`;
CREATE TABLE `mcc_blog_product` (
  `blog_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  UNIQUE KEY `blog_id` (`blog_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_product`
--

INSERT INTO `mcc_blog_product` (`blog_id`, `related_id`) VALUES
(1, 28),
(1, 41),
(2, 48),
(3, 41),
(3, 47),
(15, 29),
(15, 30),
(15, 31),
(16, 33),
(16, 41),
(16, 45),
(16, 46);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_related`
--

DROP TABLE IF EXISTS `mcc_blog_related`;
CREATE TABLE `mcc_blog_related` (
  `blog_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_related`
--

INSERT INTO `mcc_blog_related` (`blog_id`, `related_id`) VALUES
(1, 2),
(1, 3),
(1, 5),
(3, 1),
(3, 3),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_to_blog_category`
--

DROP TABLE IF EXISTS `mcc_blog_to_blog_category`;
CREATE TABLE `mcc_blog_to_blog_category` (
  `blog_id` int(11) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`,`blog_category_id`),
  KEY `blog_category_id` (`blog_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_to_blog_category`
--

INSERT INTO `mcc_blog_to_blog_category` (`blog_id`, `blog_category_id`) VALUES
(1, 1),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 6),
(4, 1),
(4, 4),
(5, 1),
(5, 5),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 9),
(17, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_to_layout`
--

DROP TABLE IF EXISTS `mcc_blog_to_layout`;
CREATE TABLE `mcc_blog_to_layout` (
  `blog_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_to_layout`
--

INSERT INTO `mcc_blog_to_layout` (`blog_id`, `store_id`, `layout_id`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0),
(13, 0, 0),
(14, 0, 0),
(15, 0, 0),
(16, 0, 0),
(17, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_blog_to_store`
--

DROP TABLE IF EXISTS `mcc_blog_to_store`;
CREATE TABLE `mcc_blog_to_store` (
  `blog_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_blog_to_store`
--

INSERT INTO `mcc_blog_to_store` (`blog_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_cart`
--

DROP TABLE IF EXISTS `mcc_cart`;
CREATE TABLE `mcc_cart` (
  `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `quantity` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `cart_id` (`api_id`,`customer_id`,`session_id`,`product_id`,`recurring_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_category`
--

DROP TABLE IF EXISTS `mcc_category`;
CREATE TABLE `mcc_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL,
  `column` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_category`
--

INSERT INTO `mcc_category` (`category_id`, `image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(43, '', 34, 0, 0, 0, 1, '2010-09-18 14:06:49', '2011-04-22 01:55:40'),
(40, '', 34, 0, 0, 0, 1, '2010-09-18 14:05:36', '2010-09-18 14:05:36'),
(41, '', 34, 0, 0, 0, 1, '2010-09-18 14:05:49', '2011-04-22 01:55:30'),
(42, '', 34, 0, 0, 0, 1, '2010-09-18 14:06:34', '2010-11-07 20:31:04'),
(39, '', 34, 0, 0, 0, 1, '2010-09-18 14:04:17', '2011-04-22 01:55:20'),
(38, '', 34, 0, 0, 0, 1, '2010-09-18 14:03:51', '2010-09-18 14:03:51'),
(37, '', 34, 0, 0, 0, 1, '2010-09-18 14:03:39', '2011-04-22 01:55:08'),
(57, '', 28, 0, 0, 3, 1, '2011-04-26 08:53:16', '2016-08-04 12:52:21'),
(29, '', 32, 0, 0, 1, 1, '2009-02-02 13:11:37', '2016-08-04 12:47:16'),
(30, '', 32, 0, 0, 1, 1, '2009-02-02 13:11:59', '2016-08-04 12:44:42'),
(31, '', 32, 0, 0, 1, 1, '2009-02-03 14:17:24', '2016-08-04 12:43:10'),
(36, '', 28, 0, 0, 0, 1, '2010-09-17 10:07:13', '2016-08-04 12:50:26'),
(35, '', 28, 0, 0, 0, 1, '2010-09-17 10:06:48', '2016-08-04 12:49:23'),
(32, '', 25, 0, 0, 1, 1, '2009-02-03 14:17:34', '2016-08-04 12:36:03'),
(28, '', 25, 0, 0, 1, 1, '2009-02-02 13:11:12', '2016-08-04 12:35:01'),
(27, '', 20, 0, 0, 2, 1, '2009-01-31 01:55:34', '2017-07-20 09:46:20'),
(26, '', 20, 0, 0, 1, 1, '2009-01-31 01:55:14', '2016-08-04 12:31:46'),
(34, 'catalog/demo/ipod_touch_4.jpg', 0, 1, 4, 7, 1, '2009-02-03 14:18:11', '2016-08-13 14:13:13'),
(17, '', 0, 1, 1, 4, 1, '2009-01-03 21:08:57', '2016-08-04 12:54:23'),
(25, '', 0, 1, 1, 3, 1, '2009-01-31 01:04:25', '2016-08-04 12:33:28'),
(20, 'catalog/demo/compaq_presario.jpg', 0, 1, 1, 1, 1, '2009-01-05 21:49:43', '2016-08-04 12:28:28'),
(44, '', 34, 0, 0, 0, 1, '2010-09-21 15:39:21', '2010-11-07 20:30:55'),
(47, '', 34, 0, 0, 0, 1, '2010-11-07 11:13:16', '2010-11-07 11:13:16'),
(48, '', 34, 0, 0, 0, 1, '2010-11-07 11:13:33', '2010-11-07 11:13:33'),
(49, '', 34, 0, 0, 0, 1, '2010-11-07 11:14:04', '2010-11-07 11:14:04'),
(50, '', 34, 0, 0, 0, 1, '2010-11-07 11:14:23', '2011-04-22 01:16:01'),
(51, '', 34, 0, 0, 0, 1, '2010-11-07 11:14:38', '2011-04-22 01:16:13'),
(52, '', 34, 0, 0, 0, 1, '2010-11-07 11:16:09', '2011-04-22 01:54:57'),
(53, '', 34, 0, 0, 0, 1, '2010-11-07 11:28:53', '2011-04-22 01:14:36'),
(54, '', 34, 0, 0, 0, 1, '2010-11-07 11:29:16', '2011-04-22 01:16:50'),
(55, '', 34, 0, 0, 0, 1, '2010-11-08 10:31:32', '2010-11-08 10:31:32'),
(56, '', 34, 0, 0, 0, 1, '2010-11-08 10:31:50', '2011-04-22 01:16:37'),
(58, '', 52, 0, 0, 0, 1, '2011-05-08 13:44:16', '2011-05-08 13:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_category_description`
--

DROP TABLE IF EXISTS `mcc_category_description`;
CREATE TABLE `mcc_category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_category_description`
--

INSERT INTO `mcc_category_description` (`category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(42, 3, 'test 9', '', 'test 9', '', ''),
(39, 3, 'test 6', '', 'test 6', '', ''),
(40, 1, 'test 7', '', 'test 7', '', ''),
(40, 2, 'test 7', '', 'test 7', '', ''),
(40, 3, 'test 7', '', 'test 7', '', ''),
(41, 1, 'test 8', '', 'test 8', '', ''),
(41, 2, 'test 8', '', 'test 8', '', ''),
(41, 3, 'test 8', '', 'test 8', '', ''),
(42, 1, 'test 9', '', 'test 9', '', ''),
(42, 2, 'test 9', '', 'test 9', '', ''),
(30, 1, '梳妆台', '', '梳妆台', '', ''),
(29, 1, '床', '', '床', '', ''),
(57, 1, '咖啡桌', '', '咖啡桌', '', ''),
(36, 1, '椅子', '', '椅子', '', ''),
(35, 2, 'Sofa Set', '', 'Sofa Set', '', ''),
(32, 2, 'Bed Room', '', 'Bed Room', '', ''),
(17, 2, 'Lighting', '', 'Lighting', '', ''),
(25, 1, '实木家具', '&lt;p&gt;分类说明信息&lt;/p&gt;\n', '实木家具', '', ''),
(43, 1, 'test 11', '', 'test 11', '', ''),
(31, 2, 'Reading Table', '', 'Reading Table', '', ''),
(31, 3, '書桌', '', '書桌', '', ''),
(37, 1, 'test 5', '', 'test 5', '', ''),
(37, 2, 'test 5', '', 'test 5', '', ''),
(37, 3, 'test 5', '', 'test 5', '', ''),
(29, 3, '床', '', '床', '', ''),
(57, 2, 'Coffee Table', '', 'Coffee Table', '', ''),
(36, 3, '椅子', '', '椅子', '', ''),
(35, 3, '沙發', '', '沙發', '', ''),
(35, 1, '沙发', '', '沙发', '', ''),
(32, 1, '臥室', '', '臥室', '', ''),
(34, 2, 'Home Decor', '&lt;p&gt;\n	Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that every laptop - in every colour, style, size and technical spec - is featured on the site at the lowest possible price.&lt;/p&gt;\n', 'Home Decor', '', ''),
(34, 1, '装饰品', '&lt;p&gt;\n	装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容\n\n&lt;/p&gt;', '装饰品', '', ''),
(17, 1, '灯具', '', '灯具', '', ''),
(43, 2, 'test 11', '', 'test 11', '', ''),
(38, 1, 'test 4', '', 'test 4', '', ''),
(38, 2, 'test 4', '', 'test 4', '', ''),
(38, 3, 'test 4', '', 'test 4', '', ''),
(39, 1, 'test 6', '', 'test 6', '', ''),
(39, 2, 'test 6', '', 'test 6', '', ''),
(29, 2, 'Beds', '', 'Beds', '', ''),
(57, 3, '咖啡桌', '', '咖啡桌', '', ''),
(36, 2, 'Chair', '', 'Chair', '', ''),
(32, 3, '卧室', '', '卧室', '', ''),
(34, 3, '裝飾品', '&lt;p&gt;\n	装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容 装饰品分类描述内容\n\n&lt;/p&gt;', 'MP3 Players', '', ''),
(26, 1, '菜板', '', '菜板', '', ''),
(26, 2, 'Chop board', '', 'Chop board', '', ''),
(26, 3, '菜板', '', '菜板', '', ''),
(27, 1, '餐具', '&lt;p&gt;分类描述信息&lt;br&gt;&lt;/p&gt;', '餐具', '', ''),
(27, 2, 'Dining Set', '', 'Dining Set', '', ''),
(27, 3, '餐具', '&lt;p&gt;分類描述信息&lt;br&gt;&lt;/p&gt;', '餐具', '', ''),
(28, 1, '客厅', '', '客厅', '', ''),
(28, 2, 'Living Room', '', 'Living Room', '', ''),
(28, 3, '客廳', '', '客廳', '', ''),
(17, 3, '燈具', '', '燈具', '', ''),
(25, 3, '實木家具', '&lt;p&gt;\n	分類說明信息&lt;/p&gt;\n', '實木家具', '', ''),
(25, 2, 'Solid Wood', '&lt;p&gt;\n	Example of category description text&lt;/p&gt;\n', 'Solid Wood', '', ''),
(20, 1, '厨房用品', '&lt;p&gt;分类说明信息&lt;/p&gt;\n', '厨房用品', '', ''),
(20, 2, 'Kitchen', '&lt;p&gt;\n	Example of category description text&lt;/p&gt;\n', 'Kitchen', '', ''),
(20, 3, '厨房用品', '&lt;p&gt;\n	分類說明信息&lt;/p&gt;\n', '厨房用品', '', ''),
(30, 2, 'Dressing Table', '', 'Dressing Table', '', ''),
(30, 3, '梳妝台', '', '梳妝台', '', ''),
(31, 1, '书桌', '', '书桌', '', ''),
(43, 3, 'test 11', '', 'test 11', '', ''),
(44, 1, 'test 12', '', 'test 12', '', ''),
(44, 2, 'test 12', '', 'test 12', '', ''),
(44, 3, 'test 12', '', 'test 12', '', ''),
(47, 1, 'test 15', '', 'test 15', '', ''),
(47, 2, 'test 15', '', 'test 15', '', ''),
(47, 3, 'test 15', '', 'test 15', '', ''),
(48, 1, 'test 16', '', 'test 16', '', ''),
(48, 2, 'test 16', '', 'test 16', '', ''),
(48, 3, 'test 16', '', 'test 16', '', ''),
(49, 1, 'test 17', '', 'test 17', '', ''),
(49, 2, 'test 17', '', 'test 17', '', ''),
(49, 3, 'test 17', '', 'test 17', '', ''),
(50, 1, 'test 18', '', 'test 18', '', ''),
(50, 2, 'test 18', '', 'test 18', '', ''),
(50, 3, 'test 18', '', 'test 18', '', ''),
(51, 1, 'test 19', '', 'test 19', '', ''),
(51, 2, 'test 19', '', 'test 19', '', ''),
(51, 3, 'test 19', '', 'test 19', '', ''),
(52, 1, 'test 20', '', 'test 20', '', ''),
(52, 2, 'test 20', '', 'test 20', '', ''),
(52, 3, 'test 20', '', 'test 20', '', ''),
(53, 1, 'test 21', '', 'test 21', '', ''),
(53, 2, 'test 21', '', 'test 21', '', ''),
(53, 3, 'test 21', '', 'test 21', '', ''),
(54, 1, 'test 22', '', 'test 22', '', ''),
(54, 2, 'test 22', '', 'test 22', '', ''),
(54, 3, 'test 22', '', 'test 22', '', ''),
(55, 1, 'test 23', '', 'test 23', '', ''),
(55, 2, 'test 23', '', 'test 23', '', ''),
(55, 3, 'test 23', '', 'test 23', '', ''),
(56, 1, 'test 24', '', 'test 24', '', ''),
(56, 2, 'test 24', '', 'test 24', '', ''),
(56, 3, 'test 24', '', 'test 24', '', ''),
(58, 1, 'test 25', '', 'test 25', '', ''),
(58, 2, 'test 25', '', 'test 25', '', ''),
(58, 3, 'test 25', '', 'test 25', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_category_filter`
--

DROP TABLE IF EXISTS `mcc_category_filter`;
CREATE TABLE `mcc_category_filter` (
  `category_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_category_path`
--

DROP TABLE IF EXISTS `mcc_category_path`;
CREATE TABLE `mcc_category_path` (
  `category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_category_path`
--

INSERT INTO `mcc_category_path` (`category_id`, `path_id`, `level`) VALUES
(26, 20, 0),
(36, 36, 2),
(36, 28, 1),
(57, 25, 0),
(57, 28, 1),
(28, 28, 1),
(31, 31, 2),
(28, 25, 0),
(31, 32, 1),
(30, 25, 0),
(29, 29, 2),
(29, 25, 0),
(32, 32, 1),
(25, 25, 0),
(17, 17, 0),
(36, 25, 0),
(57, 57, 2),
(26, 26, 1),
(35, 25, 0),
(20, 20, 0),
(35, 35, 2),
(27, 27, 1),
(27, 20, 0),
(56, 34, 0),
(55, 55, 1),
(55, 34, 0),
(54, 54, 1),
(54, 34, 0),
(53, 53, 1),
(53, 34, 0),
(58, 58, 2),
(58, 52, 1),
(58, 34, 0),
(52, 52, 1),
(52, 34, 0),
(51, 51, 1),
(51, 34, 0),
(50, 50, 1),
(50, 34, 0),
(49, 49, 1),
(49, 34, 0),
(48, 48, 1),
(48, 34, 0),
(47, 47, 1),
(47, 34, 0),
(44, 44, 1),
(44, 34, 0),
(37, 37, 1),
(37, 34, 0),
(38, 38, 1),
(38, 34, 0),
(43, 43, 1),
(43, 34, 0),
(34, 34, 0),
(39, 39, 1),
(39, 34, 0),
(42, 42, 1),
(42, 34, 0),
(41, 41, 1),
(41, 34, 0),
(40, 40, 1),
(40, 34, 0),
(30, 32, 1),
(56, 56, 1),
(32, 25, 0),
(29, 32, 1),
(31, 25, 0),
(30, 30, 2),
(35, 28, 1),
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_category_to_layout`
--

DROP TABLE IF EXISTS `mcc_category_to_layout`;
CREATE TABLE `mcc_category_to_layout` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_category_to_store`
--

DROP TABLE IF EXISTS `mcc_category_to_store`;
CREATE TABLE `mcc_category_to_store` (
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_category_to_store`
--

INSERT INTO `mcc_category_to_store` (`category_id`, `store_id`) VALUES
(17, 0),
(20, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(34, 0),
(35, 0),
(36, 0),
(37, 0),
(38, 0),
(39, 0),
(40, 0),
(41, 0),
(42, 0),
(43, 0),
(44, 0),
(47, 0),
(48, 0),
(49, 0),
(50, 0),
(51, 0),
(52, 0),
(53, 0),
(54, 0),
(55, 0),
(56, 0),
(57, 0),
(58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_city`
--

DROP TABLE IF EXISTS `mcc_city`;
CREATE TABLE `mcc_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=344 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_city`
--

INSERT INTO `mcc_city` (`city_id`, `country_id`, `zone_id`, `name`, `status`) VALUES
(1, 44, 684, '合肥市', 1),
(2, 44, 684, '芜湖市', 1),
(3, 44, 684, '蚌埠市', 1),
(4, 44, 684, '淮南市', 1),
(5, 44, 684, '马鞍山市', 1),
(6, 44, 684, '淮北市', 1),
(7, 44, 684, '铜陵市', 1),
(8, 44, 684, '安庆市', 1),
(9, 44, 684, '黄山市', 1),
(10, 44, 684, '滁州市', 1),
(11, 44, 684, '阜阳市', 1),
(12, 44, 684, '宿州市', 1),
(13, 44, 684, '巢湖市', 1),
(14, 44, 684, '六安市', 1),
(15, 44, 684, '亳州市', 1),
(16, 44, 684, '池州市', 1),
(17, 44, 684, '宣城市', 1),
(18, 44, 685, '北京市', 1),
(22, 44, 687, '福州市', 1),
(23, 44, 687, '厦门市', 1),
(24, 44, 687, '莆田市', 1),
(25, 44, 687, '三明市', 1),
(26, 44, 687, '泉州市', 1),
(27, 44, 687, '漳州市', 1),
(28, 44, 687, '南平市', 1),
(29, 44, 687, '龙岩市', 1),
(30, 44, 687, '宁德市', 1),
(31, 44, 688, '兰州市', 1),
(32, 44, 688, '嘉峪关市', 1),
(33, 44, 688, '金昌市', 1),
(34, 44, 688, '白银市', 1),
(35, 44, 688, '天水市', 1),
(36, 44, 688, '武威市', 1),
(37, 44, 688, '张掖市', 1),
(38, 44, 688, '平凉市', 1),
(39, 44, 688, '酒泉市', 1),
(40, 44, 688, '庆阳市', 1),
(41, 44, 688, '定西市', 1),
(42, 44, 688, '陇南市', 1),
(43, 44, 688, '临夏回族自治州', 1),
(44, 44, 688, '甘南藏族自治州', 1),
(45, 44, 689, '广州市', 1),
(46, 44, 689, '韶关市', 1),
(47, 44, 689, '深圳市', 1),
(48, 44, 689, '珠海市', 1),
(49, 44, 689, '汕头市', 1),
(50, 44, 689, '佛山市', 1),
(51, 44, 689, '江门市', 1),
(52, 44, 689, '湛江市', 1),
(53, 44, 689, '茂名市', 1),
(54, 44, 689, '肇庆市', 1),
(55, 44, 689, '惠州市', 1),
(56, 44, 689, '梅州市', 1),
(57, 44, 689, '汕尾市', 1),
(58, 44, 689, '河源市', 1),
(59, 44, 689, '阳江市', 1),
(60, 44, 689, '清远市', 1),
(61, 44, 689, '东莞市', 1),
(62, 44, 689, '中山市', 1),
(63, 44, 689, '潮州市', 1),
(64, 44, 689, '揭阳市', 1),
(65, 44, 689, '云浮市', 1),
(66, 44, 690, '南宁市', 1),
(67, 44, 690, '柳州市', 1),
(68, 44, 690, '桂林市', 1),
(69, 44, 690, '梧州市', 1),
(70, 44, 690, '北海市', 1),
(71, 44, 690, '防城港市', 1),
(72, 44, 690, '钦州市', 1),
(73, 44, 690, '贵港市', 1),
(74, 44, 690, '玉林市', 1),
(75, 44, 690, '百色市', 1),
(76, 44, 690, '贺州市', 1),
(77, 44, 690, '河池市', 1),
(78, 44, 690, '来宾市', 1),
(79, 44, 690, '崇左市', 1),
(80, 44, 691, '贵阳市', 1),
(81, 44, 691, '六盘水市', 1),
(82, 44, 691, '遵义市', 1),
(83, 44, 691, '安顺市', 1),
(84, 44, 691, '铜仁地区', 1),
(85, 44, 691, '黔西南布依族苗族自治州', 1),
(86, 44, 691, '毕节地区', 1),
(87, 44, 691, '黔东南苗族侗族自治州', 1),
(88, 44, 691, '黔南布依族苗族自治州', 1),
(89, 44, 692, '海口市', 1),
(90, 44, 692, '三亚市', 1),
(91, 44, 692, '省直辖县级行政单位', 1),
(92, 44, 693, '石家庄市', 1),
(93, 44, 693, '唐山市', 1),
(94, 44, 693, '秦皇岛市', 1),
(95, 44, 693, '邯郸市', 1),
(96, 44, 693, '邢台市', 1),
(97, 44, 693, '保定市', 1),
(98, 44, 693, '张家口市', 1),
(99, 44, 693, '承德市', 1),
(100, 44, 693, '沧州市', 1),
(101, 44, 693, '廊坊市', 1),
(102, 44, 693, '衡水市', 1),
(103, 44, 694, '哈尔滨市', 1),
(104, 44, 694, '齐齐哈尔市', 1),
(105, 44, 694, '鸡西市', 1),
(106, 44, 694, '鹤岗市', 1),
(107, 44, 694, '双鸭山市', 1),
(108, 44, 694, '大庆市', 1),
(109, 44, 694, '伊春市', 1),
(110, 44, 694, '佳木斯市', 1),
(111, 44, 694, '七台河市', 1),
(112, 44, 694, '牡丹江市', 1),
(113, 44, 694, '黑河市', 1),
(114, 44, 694, '绥化市', 1),
(115, 44, 694, '大兴安岭地区', 1),
(116, 44, 695, '郑州市', 1),
(117, 44, 695, '开封市', 1),
(118, 44, 695, '洛阳市', 1),
(119, 44, 695, '平顶山市', 1),
(120, 44, 695, '安阳市', 1),
(121, 44, 695, '鹤壁市', 1),
(122, 44, 695, '新乡市', 1),
(123, 44, 695, '焦作市', 1),
(124, 44, 695, '濮阳市', 1),
(125, 44, 695, '许昌市', 1),
(126, 44, 695, '漯河市', 1),
(127, 44, 695, '三门峡市', 1),
(128, 44, 695, '南阳市', 1),
(129, 44, 695, '商丘市', 1),
(130, 44, 695, '信阳市', 1),
(131, 44, 695, '周口市', 1),
(132, 44, 695, '驻马店市', 1),
(133, 44, 697, '武汉市', 1),
(134, 44, 697, '黄石市', 1),
(135, 44, 697, '十堰市', 1),
(136, 44, 697, '宜昌市', 1),
(137, 44, 697, '襄樊市', 1),
(138, 44, 697, '鄂州市', 1),
(139, 44, 697, '荆门市', 1),
(140, 44, 697, '孝感市', 1),
(141, 44, 697, '荆州市', 1),
(142, 44, 697, '黄冈市', 1),
(143, 44, 697, '咸宁市', 1),
(144, 44, 697, '随州市', 1),
(145, 44, 697, '恩施土家族苗族自治州', 1),
(146, 44, 697, '省直辖行政单位', 1),
(147, 44, 698, '长沙市', 1),
(148, 44, 698, '株洲市', 1),
(149, 44, 698, '湘潭市', 1),
(150, 44, 698, '衡阳市', 1),
(151, 44, 698, '邵阳市', 1),
(152, 44, 698, '岳阳市', 1),
(153, 44, 698, '常德市', 1),
(154, 44, 698, '张家界市', 1),
(155, 44, 698, '益阳市', 1),
(156, 44, 698, '郴州市', 1),
(157, 44, 698, '永州市', 1),
(158, 44, 698, '怀化市', 1),
(159, 44, 698, '娄底市', 1),
(160, 44, 698, '湘西土家族苗族自治州', 1),
(161, 44, 699, '呼和浩特市', 1),
(162, 44, 699, '包头市', 1),
(163, 44, 699, '乌海市', 1),
(164, 44, 699, '赤峰市', 1),
(165, 44, 699, '通辽市', 1),
(166, 44, 699, '鄂尔多斯市', 1),
(167, 44, 699, '呼伦贝尔市', 1),
(168, 44, 699, '巴彦淖尔市', 1),
(169, 44, 699, '乌兰察布市', 1),
(170, 44, 699, '兴安盟', 1),
(171, 44, 699, '锡林郭勒盟', 1),
(172, 44, 699, '阿拉善盟', 1),
(173, 44, 700, '南京市', 1),
(174, 44, 700, '无锡市', 1),
(175, 44, 700, '徐州市', 1),
(176, 44, 700, '常州市', 1),
(177, 44, 700, '苏州市', 1),
(178, 44, 700, '南通市', 1),
(179, 44, 700, '连云港市', 1),
(180, 44, 700, '淮安市', 1),
(181, 44, 700, '盐城市', 1),
(182, 44, 700, '扬州市', 1),
(183, 44, 700, '镇江市', 1),
(184, 44, 700, '泰州市', 1),
(185, 44, 700, '宿迁市', 1),
(186, 44, 701, '南昌市', 1),
(187, 44, 701, '景德镇市', 1),
(188, 44, 701, '萍乡市', 1),
(189, 44, 701, '九江市', 1),
(190, 44, 701, '新余市', 1),
(191, 44, 701, '鹰潭市', 1),
(192, 44, 701, '赣州市', 1),
(193, 44, 701, '吉安市', 1),
(194, 44, 701, '宜春市', 1),
(195, 44, 701, '抚州市', 1),
(196, 44, 701, '上饶市', 1),
(197, 44, 702, '长春市', 1),
(198, 44, 702, '吉林市', 1),
(199, 44, 702, '四平市', 1),
(200, 44, 702, '辽源市', 1),
(201, 44, 702, '通化市', 1),
(202, 44, 702, '白山市', 1),
(203, 44, 702, '松原市', 1),
(204, 44, 702, '白城市', 1),
(205, 44, 702, '延边朝鲜族自治州', 1),
(206, 44, 703, '沈阳市', 1),
(207, 44, 703, '大连市', 1),
(208, 44, 703, '鞍山市', 1),
(209, 44, 703, '抚顺市', 1),
(210, 44, 703, '本溪市', 1),
(211, 44, 703, '丹东市', 1),
(212, 44, 703, '锦州市', 1),
(213, 44, 703, '营口市', 1),
(214, 44, 703, '阜新市', 1),
(215, 44, 703, '辽阳市', 1),
(216, 44, 703, '盘锦市', 1),
(217, 44, 703, '铁岭市', 1),
(218, 44, 703, '朝阳市', 1),
(219, 44, 703, '葫芦岛市', 1),
(220, 44, 705, '银川市', 1),
(221, 44, 705, '石嘴山市', 1),
(222, 44, 705, '吴忠市', 1),
(223, 44, 705, '固原市', 1),
(224, 44, 705, '中卫市', 1),
(225, 44, 706, '西安市', 1),
(226, 44, 706, '铜川市', 1),
(227, 44, 706, '宝鸡市', 1),
(228, 44, 706, '咸阳市', 1),
(229, 44, 706, '渭南市', 1),
(230, 44, 706, '延安市', 1),
(231, 44, 706, '汉中市', 1),
(232, 44, 706, '榆林市', 1),
(233, 44, 706, '安康市', 1),
(234, 44, 706, '商洛市', 1),
(235, 44, 707, '济南市', 1),
(236, 44, 707, '青岛市', 1),
(237, 44, 707, '淄博市', 1),
(238, 44, 707, '枣庄市', 1),
(239, 44, 707, '东营市', 1),
(240, 44, 707, '烟台市', 1),
(241, 44, 707, '潍坊市', 1),
(242, 44, 707, '济宁市', 1),
(243, 44, 707, '泰安市', 1),
(244, 44, 707, '威海市', 1),
(245, 44, 707, '日照市', 1),
(246, 44, 707, '莱芜市', 1),
(247, 44, 707, '临沂市', 1),
(248, 44, 707, '德州市', 1),
(249, 44, 707, '聊城市', 1),
(250, 44, 707, '滨州市', 1),
(251, 44, 707, '荷泽市', 1),
(343, 44, 711, '天津市', 1),
(254, 44, 709, '太原市', 1),
(255, 44, 709, '大同市', 1),
(256, 44, 709, '阳泉市', 1),
(257, 44, 709, '长治市', 1),
(258, 44, 709, '晋城市', 1),
(259, 44, 709, '朔州市', 1),
(260, 44, 709, '晋中市', 1),
(261, 44, 709, '运城市', 1),
(262, 44, 709, '忻州市', 1),
(263, 44, 709, '临汾市', 1),
(264, 44, 709, '吕梁市', 1),
(265, 44, 710, '成都市', 1),
(266, 44, 710, '自贡市', 1),
(267, 44, 710, '攀枝花市', 1),
(268, 44, 710, '泸州市', 1),
(269, 44, 710, '德阳市', 1),
(270, 44, 710, '绵阳市', 1),
(271, 44, 710, '广元市', 1),
(272, 44, 710, '遂宁市', 1),
(273, 44, 710, '内江市', 1),
(274, 44, 710, '乐山市', 1),
(275, 44, 710, '南充市', 1),
(276, 44, 710, '眉山市', 1),
(277, 44, 710, '宜宾市', 1),
(278, 44, 710, '广安市', 1),
(279, 44, 710, '达州市', 1),
(280, 44, 710, '雅安市', 1),
(281, 44, 710, '巴中市', 1),
(282, 44, 710, '资阳市', 1),
(283, 44, 710, '阿坝藏族羌族自治州', 1),
(284, 44, 710, '甘孜藏族自治州', 1),
(285, 44, 710, '凉山彝族自治州', 1),
(286, 44, 712, '乌鲁木齐市', 1),
(287, 44, 712, '克拉玛依市', 1),
(288, 44, 712, '吐鲁番地区', 1),
(289, 44, 712, '哈密地区', 1),
(290, 44, 712, '昌吉回族自治州', 1),
(291, 44, 712, '博尔塔拉蒙古自治州', 1),
(292, 44, 712, '巴音郭楞蒙古自治州', 1),
(293, 44, 712, '阿克苏地区', 1),
(294, 44, 712, '克孜勒苏柯尔克孜自治州', 1),
(295, 44, 712, '喀什地区', 1),
(296, 44, 712, '和田地区', 1),
(297, 44, 712, '伊犁哈萨克自治州', 1),
(298, 44, 712, '塔城地区', 1),
(299, 44, 712, '阿勒泰地区', 1),
(300, 44, 712, '省直辖行政单位', 1),
(301, 44, 713, '昆明市', 1),
(302, 44, 713, '曲靖市', 1),
(303, 44, 713, '玉溪市', 1),
(304, 44, 713, '保山市', 1),
(305, 44, 713, '昭通市', 1),
(306, 44, 713, '丽江市', 1),
(307, 44, 713, '思茅市', 1),
(308, 44, 713, '临沧市', 1),
(309, 44, 713, '楚雄彝族自治州', 1),
(310, 44, 713, '红河哈尼族彝族自治州', 1),
(311, 44, 713, '文山壮族苗族自治州', 1),
(312, 44, 713, '西双版纳傣族自治州', 1),
(313, 44, 713, '大理白族自治州', 1),
(314, 44, 713, '德宏傣族景颇族自治州', 1),
(315, 44, 713, '怒江傈僳族自治州', 1),
(316, 44, 713, '迪庆藏族自治州', 1),
(317, 44, 714, '杭州市', 1),
(318, 44, 714, '宁波市', 1),
(319, 44, 714, '温州市', 1),
(320, 44, 714, '嘉兴市', 1),
(321, 44, 714, '湖州市', 1),
(322, 44, 714, '绍兴市', 1),
(323, 44, 714, '金华市', 1),
(324, 44, 714, '衢州市', 1),
(325, 44, 714, '舟山市', 1),
(326, 44, 714, '台州市', 1),
(327, 44, 714, '丽水市', 1),
(328, 44, 4225, '拉萨市', 1),
(329, 44, 4225, '昌都地区', 1),
(330, 44, 4225, '山南地区', 1),
(331, 44, 4225, '日喀则地区', 1),
(332, 44, 4225, '那曲地区', 1),
(333, 44, 4225, '阿里地区', 1),
(334, 44, 4225, '林芝地区', 1),
(335, 44, 4227, '西宁市', 1),
(336, 44, 4227, '海东地区', 1),
(337, 44, 4227, '海北藏族自治州', 1),
(338, 44, 4227, '黄南藏族自治州', 1),
(339, 44, 4227, '海南藏族自治州', 1),
(340, 44, 4227, '果洛藏族自治州', 1),
(341, 44, 4227, '玉树藏族自治州', 1),
(342, 44, 4227, '海西蒙古族藏族自治州', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_country`
--

DROP TABLE IF EXISTS `mcc_country`;
CREATE TABLE `mcc_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_country`
--

INSERT INTO `mcc_country` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '', 0, 1),
(2, 'Albania', 'AL', 'ALB', '', 0, 1),
(3, 'Algeria', 'DZ', 'DZA', '', 0, 1),
(4, 'American Samoa', 'AS', 'ASM', '', 0, 1),
(5, 'Andorra', 'AD', 'AND', '', 0, 1),
(6, 'Angola', 'AO', 'AGO', '', 0, 1),
(7, 'Anguilla', 'AI', 'AIA', '', 0, 1),
(8, 'Antarctica', 'AQ', 'ATA', '', 0, 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '', 0, 1),
(10, 'Argentina', 'AR', 'ARG', '', 0, 1),
(11, 'Armenia', 'AM', 'ARM', '', 0, 1),
(12, 'Aruba', 'AW', 'ABW', '', 0, 1),
(13, 'Australia', 'AU', 'AUS', '', 0, 1),
(14, 'Austria', 'AT', 'AUT', '', 0, 1),
(15, 'Azerbaijan', 'AZ', 'AZE', '', 0, 1),
(16, 'Bahamas', 'BS', 'BHS', '', 0, 1),
(17, 'Bahrain', 'BH', 'BHR', '', 0, 1),
(18, 'Bangladesh', 'BD', 'BGD', '', 0, 1),
(19, 'Barbados', 'BB', 'BRB', '', 0, 1),
(20, 'Belarus', 'BY', 'BLR', '', 0, 1),
(21, 'Belgium', 'BE', 'BEL', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 0, 1),
(22, 'Belize', 'BZ', 'BLZ', '', 0, 1),
(23, 'Benin', 'BJ', 'BEN', '', 0, 1),
(24, 'Bermuda', 'BM', 'BMU', '', 0, 1),
(25, 'Bhutan', 'BT', 'BTN', '', 0, 1),
(26, 'Bolivia', 'BO', 'BOL', '', 0, 1),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', '', 0, 1),
(28, 'Botswana', 'BW', 'BWA', '', 0, 1),
(29, 'Bouvet Island', 'BV', 'BVT', '', 0, 1),
(30, 'Brazil', 'BR', 'BRA', '', 0, 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', '', 0, 1),
(33, 'Bulgaria', 'BG', 'BGR', '', 0, 1),
(34, 'Burkina Faso', 'BF', 'BFA', '', 0, 1),
(35, 'Burundi', 'BI', 'BDI', '', 0, 1),
(36, 'Cambodia', 'KH', 'KHM', '', 0, 1),
(37, 'Cameroon', 'CM', 'CMR', '', 0, 1),
(38, 'Canada', 'CA', 'CAN', '', 0, 1),
(39, 'Cape Verde', 'CV', 'CPV', '', 0, 1),
(40, 'Cayman Islands', 'KY', 'CYM', '', 0, 1),
(41, 'Central African Republic', 'CF', 'CAF', '', 0, 1),
(42, 'Chad', 'TD', 'TCD', '', 0, 1),
(43, 'Chile', 'CL', 'CHL', '', 0, 1),
(44, '中国', 'CN', 'CHN', '', 0, 1),
(45, 'Christmas Island', 'CX', 'CXR', '', 0, 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 0, 1),
(47, 'Colombia', 'CO', 'COL', '', 0, 1),
(48, 'Comoros', 'KM', 'COM', '', 0, 1),
(49, 'Congo', 'CG', 'COG', '', 0, 1),
(50, 'Cook Islands', 'CK', 'COK', '', 0, 1),
(51, 'Costa Rica', 'CR', 'CRI', '', 0, 1),
(52, 'Cote D\'Ivoire', 'CI', 'CIV', '', 0, 1),
(53, 'Croatia', 'HR', 'HRV', '', 0, 1),
(54, 'Cuba', 'CU', 'CUB', '', 0, 1),
(55, 'Cyprus', 'CY', 'CYP', '', 0, 1),
(56, 'Czech Republic', 'CZ', 'CZE', '', 0, 1),
(57, 'Denmark', 'DK', 'DNK', '', 0, 1),
(58, 'Djibouti', 'DJ', 'DJI', '', 0, 1),
(59, 'Dominica', 'DM', 'DMA', '', 0, 1),
(60, 'Dominican Republic', 'DO', 'DOM', '', 0, 1),
(61, 'East Timor', 'TL', 'TLS', '', 0, 1),
(62, 'Ecuador', 'EC', 'ECU', '', 0, 1),
(63, 'Egypt', 'EG', 'EGY', '', 0, 1),
(64, 'El Salvador', 'SV', 'SLV', '', 0, 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '', 0, 1),
(66, 'Eritrea', 'ER', 'ERI', '', 0, 1),
(67, 'Estonia', 'EE', 'EST', '', 0, 1),
(68, 'Ethiopia', 'ET', 'ETH', '', 0, 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 0, 1),
(70, 'Faroe Islands', 'FO', 'FRO', '', 0, 1),
(71, 'Fiji', 'FJ', 'FJI', '', 0, 1),
(72, 'Finland', 'FI', 'FIN', '', 0, 1),
(74, 'France, Metropolitan', 'FR', 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(75, 'French Guiana', 'GF', 'GUF', '', 0, 1),
(76, 'French Polynesia', 'PF', 'PYF', '', 0, 1),
(77, 'French Southern Territories', 'TF', 'ATF', '', 0, 1),
(78, 'Gabon', 'GA', 'GAB', '', 0, 1),
(79, 'Gambia', 'GM', 'GMB', '', 0, 1),
(80, 'Georgia', 'GE', 'GEO', '', 0, 1),
(81, 'Germany', 'DE', 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(82, 'Ghana', 'GH', 'GHA', '', 0, 1),
(83, 'Gibraltar', 'GI', 'GIB', '', 0, 1),
(84, 'Greece', 'GR', 'GRC', '', 0, 1),
(85, 'Greenland', 'GL', 'GRL', '', 0, 1),
(86, 'Grenada', 'GD', 'GRD', '', 0, 1),
(87, 'Guadeloupe', 'GP', 'GLP', '', 0, 1),
(88, 'Guam', 'GU', 'GUM', '', 0, 1),
(89, 'Guatemala', 'GT', 'GTM', '', 0, 1),
(90, 'Guinea', 'GN', 'GIN', '', 0, 1),
(91, 'Guinea-Bissau', 'GW', 'GNB', '', 0, 1),
(92, 'Guyana', 'GY', 'GUY', '', 0, 1),
(93, 'Haiti', 'HT', 'HTI', '', 0, 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 0, 1),
(95, 'Honduras', 'HN', 'HND', '', 0, 1),
(96, 'Hong Kong', 'HK', 'HKG', '', 0, 1),
(97, 'Hungary', 'HU', 'HUN', '', 0, 1),
(98, 'Iceland', 'IS', 'ISL', '', 0, 1),
(99, 'India', 'IN', 'IND', '', 0, 1),
(100, 'Indonesia', 'ID', 'IDN', '', 0, 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', '', 0, 1),
(102, 'Iraq', 'IQ', 'IRQ', '', 0, 1),
(103, 'Ireland', 'IE', 'IRL', '', 0, 1),
(104, 'Israel', 'IL', 'ISR', '', 0, 1),
(105, 'Italy', 'IT', 'ITA', '', 0, 1),
(106, 'Jamaica', 'JM', 'JAM', '', 0, 1),
(107, 'Japan', 'JP', 'JPN', '', 0, 1),
(108, 'Jordan', 'JO', 'JOR', '', 0, 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', '', 0, 1),
(110, 'Kenya', 'KE', 'KEN', '', 0, 1),
(111, 'Kiribati', 'KI', 'KIR', '', 0, 1),
(112, 'North Korea', 'KP', 'PRK', '', 0, 1),
(113, 'South Korea', 'KR', 'KOR', '', 0, 1),
(114, 'Kuwait', 'KW', 'KWT', '', 0, 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '', 0, 1),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO', '', 0, 1),
(117, 'Latvia', 'LV', 'LVA', '', 0, 1),
(118, 'Lebanon', 'LB', 'LBN', '', 0, 1),
(119, 'Lesotho', 'LS', 'LSO', '', 0, 1),
(120, 'Liberia', 'LR', 'LBR', '', 0, 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '', 0, 1),
(122, 'Liechtenstein', 'LI', 'LIE', '', 0, 1),
(123, 'Lithuania', 'LT', 'LTU', '', 0, 1),
(124, 'Luxembourg', 'LU', 'LUX', '', 0, 1),
(125, 'Macau', 'MO', 'MAC', '', 0, 1),
(126, 'FYROM', 'MK', 'MKD', '', 0, 1),
(127, 'Madagascar', 'MG', 'MDG', '', 0, 1),
(128, 'Malawi', 'MW', 'MWI', '', 0, 1),
(129, 'Malaysia', 'MY', 'MYS', '', 0, 1),
(130, 'Maldives', 'MV', 'MDV', '', 0, 1),
(131, 'Mali', 'ML', 'MLI', '', 0, 1),
(132, 'Malta', 'MT', 'MLT', '', 0, 1),
(133, 'Marshall Islands', 'MH', 'MHL', '', 0, 1),
(134, 'Martinique', 'MQ', 'MTQ', '', 0, 1),
(135, 'Mauritania', 'MR', 'MRT', '', 0, 1),
(136, 'Mauritius', 'MU', 'MUS', '', 0, 1),
(137, 'Mayotte', 'YT', 'MYT', '', 0, 1),
(138, 'Mexico', 'MX', 'MEX', '', 0, 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '', 0, 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', '', 0, 1),
(141, 'Monaco', 'MC', 'MCO', '', 0, 1),
(142, 'Mongolia', 'MN', 'MNG', '', 0, 1),
(143, 'Montserrat', 'MS', 'MSR', '', 0, 1),
(144, 'Morocco', 'MA', 'MAR', '', 0, 1),
(145, 'Mozambique', 'MZ', 'MOZ', '', 0, 1),
(146, 'Myanmar', 'MM', 'MMR', '', 0, 1),
(147, 'Namibia', 'NA', 'NAM', '', 0, 1),
(148, 'Nauru', 'NR', 'NRU', '', 0, 1),
(149, 'Nepal', 'NP', 'NPL', '', 0, 1),
(150, 'Netherlands', 'NL', 'NLD', '', 0, 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', '', 0, 1),
(152, 'New Caledonia', 'NC', 'NCL', '', 0, 1),
(153, 'New Zealand', 'NZ', 'NZL', '', 0, 1),
(154, 'Nicaragua', 'NI', 'NIC', '', 0, 1),
(155, 'Niger', 'NE', 'NER', '', 0, 1),
(156, 'Nigeria', 'NG', 'NGA', '', 0, 1),
(157, 'Niue', 'NU', 'NIU', '', 0, 1),
(158, 'Norfolk Island', 'NF', 'NFK', '', 0, 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '', 0, 1),
(160, 'Norway', 'NO', 'NOR', '', 0, 1),
(161, 'Oman', 'OM', 'OMN', '', 0, 1),
(162, 'Pakistan', 'PK', 'PAK', '', 0, 1),
(163, 'Palau', 'PW', 'PLW', '', 0, 1),
(164, 'Panama', 'PA', 'PAN', '', 0, 1),
(165, 'Papua New Guinea', 'PG', 'PNG', '', 0, 1),
(166, 'Paraguay', 'PY', 'PRY', '', 0, 1),
(167, 'Peru', 'PE', 'PER', '', 0, 1),
(168, 'Philippines', 'PH', 'PHL', '', 0, 1),
(169, 'Pitcairn', 'PN', 'PCN', '', 0, 1),
(170, 'Poland', 'PL', 'POL', '', 0, 1),
(171, 'Portugal', 'PT', 'PRT', '', 0, 1),
(172, 'Puerto Rico', 'PR', 'PRI', '', 0, 1),
(173, 'Qatar', 'QA', 'QAT', '', 0, 1),
(174, 'Reunion', 'RE', 'REU', '', 0, 1),
(175, 'Romania', 'RO', 'ROM', '', 0, 1),
(176, 'Russian Federation', 'RU', 'RUS', '', 0, 1),
(177, 'Rwanda', 'RW', 'RWA', '', 0, 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 0, 1),
(179, 'Saint Lucia', 'LC', 'LCA', '', 0, 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 0, 1),
(181, 'Samoa', 'WS', 'WSM', '', 0, 1),
(182, 'San Marino', 'SM', 'SMR', '', 0, 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', '', 0, 1),
(184, 'Saudi Arabia', 'SA', 'SAU', '', 0, 1),
(185, 'Senegal', 'SN', 'SEN', '', 0, 1),
(186, 'Seychelles', 'SC', 'SYC', '', 0, 1),
(187, 'Sierra Leone', 'SL', 'SLE', '', 0, 1),
(188, 'Singapore', 'SG', 'SGP', '', 0, 1),
(189, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 1),
(190, 'Slovenia', 'SI', 'SVN', '', 0, 1),
(191, 'Solomon Islands', 'SB', 'SLB', '', 0, 1),
(192, 'Somalia', 'SO', 'SOM', '', 0, 1),
(193, 'South Africa', 'ZA', 'ZAF', '', 0, 1),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 0, 1),
(195, 'Spain', 'ES', 'ESP', '', 0, 1),
(196, 'Sri Lanka', 'LK', 'LKA', '', 0, 1),
(197, 'St. Helena', 'SH', 'SHN', '', 0, 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 0, 1),
(199, 'Sudan', 'SD', 'SDN', '', 0, 1),
(200, 'Suriname', 'SR', 'SUR', '', 0, 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 0, 1),
(202, 'Swaziland', 'SZ', 'SWZ', '', 0, 1),
(203, 'Sweden', 'SE', 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(204, 'Switzerland', 'CH', 'CHE', '', 0, 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', '', 0, 1),
(206, 'Taiwan', 'TW', 'TWN', '', 0, 1),
(207, 'Tajikistan', 'TJ', 'TJK', '', 0, 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 0, 1),
(209, 'Thailand', 'TH', 'THA', '', 0, 1),
(210, 'Togo', 'TG', 'TGO', '', 0, 1),
(211, 'Tokelau', 'TK', 'TKL', '', 0, 1),
(212, 'Tonga', 'TO', 'TON', '', 0, 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '', 0, 1),
(214, 'Tunisia', 'TN', 'TUN', '', 0, 1),
(215, 'Turkey', 'TR', 'TUR', '', 0, 1),
(216, 'Turkmenistan', 'TM', 'TKM', '', 0, 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '', 0, 1),
(218, 'Tuvalu', 'TV', 'TUV', '', 0, 1),
(219, 'Uganda', 'UG', 'UGA', '', 0, 1),
(220, 'Ukraine', 'UA', 'UKR', '', 0, 1),
(221, 'United Arab Emirates', 'AE', 'ARE', '', 0, 1),
(222, 'United Kingdom', 'GB', 'GBR', '', 1, 1),
(223, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 0, 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 0, 1),
(225, 'Uruguay', 'UY', 'URY', '', 0, 1),
(226, 'Uzbekistan', 'UZ', 'UZB', '', 0, 1),
(227, 'Vanuatu', 'VU', 'VUT', '', 0, 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 0, 1),
(229, 'Venezuela', 'VE', 'VEN', '', 0, 1),
(230, 'Viet Nam', 'VN', 'VNM', '', 0, 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '', 0, 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 0, 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 0, 1),
(234, 'Western Sahara', 'EH', 'ESH', '', 0, 1),
(235, 'Yemen', 'YE', 'YEM', '', 0, 1),
(237, 'Democratic Republic of Congo', 'CD', 'COD', '', 0, 1),
(238, 'Zambia', 'ZM', 'ZMB', '', 0, 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', '', 0, 1),
(242, 'Montenegro', 'ME', 'MNE', '', 0, 1),
(243, 'Serbia', 'RS', 'SRB', '', 0, 1),
(244, 'Aaland Islands', 'AX', 'ALA', '', 0, 1),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '', 0, 1),
(246, 'Curacao', 'CW', 'CUW', '', 0, 1),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', '', 0, 1),
(248, 'South Sudan', 'SS', 'SSD', '', 0, 1),
(249, 'St. Barthelemy', 'BL', 'BLM', '', 0, 1),
(250, 'St. Martin (French part)', 'MF', 'MAF', '', 0, 1),
(251, 'Canary Islands', 'IC', 'ICA', '', 0, 1),
(252, 'Ascension Island (British)', 'AC', 'ASC', '', 0, 1),
(253, 'Kosovo, Republic of', 'XK', 'UNK', '', 0, 1),
(254, 'Isle of Man', 'IM', 'IMN', '', 0, 1),
(255, 'Tristan da Cunha', 'TA', 'SHN', '', 0, 1),
(256, 'Guernsey', 'GG', 'GGY', '', 0, 1),
(257, 'Jersey', 'JE', 'JEY', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_coupon`
--

DROP TABLE IF EXISTS `mcc_coupon`;
CREATE TABLE `mcc_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(20) NOT NULL,
  `type` char(1) NOT NULL,
  `discount` decimal(15,4) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL,
  `total` decimal(15,4) NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_coupon`
--

INSERT INTO `mcc_coupon` (`coupon_id`, `name`, `code`, `type`, `discount`, `logged`, `shipping`, `total`, `date_start`, `date_end`, `uses_total`, `uses_customer`, `status`, `date_added`) VALUES
(4, '10% 折扣', '2222', 'P', '10.0000', 0, 0, '0.0000', '2015-04-01', '2020-01-01', 10, '10', 0, '2009-01-27 13:55:03'),
(5, '免费配送', '3333', 'P', '0.0000', 0, 1, '100.0000', '2015-01-01', '2015-02-01', 10, '10', 0, '2009-03-14 21:13:53'),
(6, '10元折扣券', '1111', 'F', '10.0000', 0, 0, '10.0000', '2015-01-01', '2020-01-01', 100000, '10000', 0, '2009-03-14 21:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_coupon_category`
--

DROP TABLE IF EXISTS `mcc_coupon_category`;
CREATE TABLE `mcc_coupon_category` (
  `coupon_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_coupon_history`
--

DROP TABLE IF EXISTS `mcc_coupon_history`;
CREATE TABLE `mcc_coupon_history` (
  `coupon_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`coupon_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_coupon_product`
--

DROP TABLE IF EXISTS `mcc_coupon_product`;
CREATE TABLE `mcc_coupon_product` (
  `coupon_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_currency`
--

DROP TABLE IF EXISTS `mcc_currency`;
CREATE TABLE `mcc_currency` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_currency`
--

INSERT INTO `mcc_currency` (`currency_id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_place`, `value`, `status`, `date_modified`) VALUES
(6, '港币', 'HKD', '$', '', '2', 1.16110003, 1, '2016-08-31 11:07:00'),
(5, 'US Dollar', 'USD', '$', '', '2', 0.14970000, 1, '2016-08-31 11:07:00'),
(4, '人民币', 'CNY', '￥', '', '2', 1.00000000, 1, '2016-09-01 03:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer`
--

DROP TABLE IF EXISTS `mcc_customer`;
CREATE TABLE `mcc_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_group_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
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
  `weixin_login_openid` varchar(64) NOT NULL,
  `weixin_login_unionid` varchar(64) NOT NULL,
  `weibo_login_access_token` varchar(128) NOT NULL,
  `weibo_login_uid` varchar(50) NOT NULL,
  `qq_openid` varchar(64) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_activity`
--

DROP TABLE IF EXISTS `mcc_customer_activity`;
CREATE TABLE `mcc_customer_activity` (
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
-- Table structure for table `mcc_customer_affiliate`
--

DROP TABLE IF EXISTS `mcc_customer_affiliate`;
CREATE TABLE `mcc_customer_affiliate` (
  `customer_id` int(11) NOT NULL,
  `company` varchar(40) NOT NULL,
  `website` varchar(255) NOT NULL,
  `tracking` varchar(64) NOT NULL,
  `commission` decimal(4,2) NOT NULL DEFAULT '0.00',
  `tax` varchar(64) NOT NULL,
  `payment` varchar(6) NOT NULL,
  `cheque` varchar(100) NOT NULL,
  `paypal` varchar(64) NOT NULL,
  `bank_name` varchar(64) NOT NULL,
  `bank_branch_number` varchar(64) NOT NULL,
  `bank_swift_code` varchar(64) NOT NULL,
  `bank_account_name` varchar(64) NOT NULL,
  `bank_account_number` varchar(64) NOT NULL,
  `custom_field` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_approval`
--

DROP TABLE IF EXISTS `mcc_customer_approval`;
CREATE TABLE `mcc_customer_approval` (
  `customer_approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `type` varchar(9) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_approval_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_group`
--

DROP TABLE IF EXISTS `mcc_customer_group`;
CREATE TABLE `mcc_customer_group` (
  `customer_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`customer_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_customer_group`
--

INSERT INTO `mcc_customer_group` (`customer_group_id`, `approval`, `sort_order`) VALUES
(1, 0, 1),
(2, 0, 3),
(3, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_group_description`
--

DROP TABLE IF EXISTS `mcc_customer_group_description`;
CREATE TABLE `mcc_customer_group_description` (
  `customer_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`customer_group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_customer_group_description`
--

INSERT INTO `mcc_customer_group_description` (`customer_group_id`, `language_id`, `name`, `description`) VALUES
(1, 1, '普通', '测试'),
(1, 2, 'Default', 'Test'),
(1, 3, '普通', '测试'),
(2, 3, 'VIP', ''),
(2, 2, 'VIP', ''),
(2, 1, 'VIP', ''),
(3, 1, '批发商', ''),
(3, 2, 'WholeSale', ''),
(3, 3, '批發商', '');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_history`
--

DROP TABLE IF EXISTS `mcc_customer_history`;
CREATE TABLE `mcc_customer_history` (
  `customer_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_ip`
--

DROP TABLE IF EXISTS `mcc_customer_ip`;
CREATE TABLE `mcc_customer_ip` (
  `customer_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_ip_id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_login`
--

DROP TABLE IF EXISTS `mcc_customer_login`;
CREATE TABLE `mcc_customer_login` (
  `customer_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(96) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `total` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`customer_login_id`),
  KEY `email` (`email`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_online`
--

DROP TABLE IF EXISTS `mcc_customer_online`;
CREATE TABLE `mcc_customer_online` (
  `ip` varchar(40) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `referer` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_reward`
--

DROP TABLE IF EXISTS `mcc_customer_reward`;
CREATE TABLE `mcc_customer_reward` (
  `customer_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `points` int(8) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_reward_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_search`
--

DROP TABLE IF EXISTS `mcc_customer_search`;
CREATE TABLE `mcc_customer_search` (
  `customer_search_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category` tinyint(1) NOT NULL,
  `description` tinyint(1) NOT NULL,
  `products` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_search_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_transaction`
--

DROP TABLE IF EXISTS `mcc_customer_transaction`;
CREATE TABLE `mcc_customer_transaction` (
  `customer_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_customer_wishlist`
--

DROP TABLE IF EXISTS `mcc_customer_wishlist`;
CREATE TABLE `mcc_customer_wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_custom_field`
--

DROP TABLE IF EXISTS `mcc_custom_field`;
CREATE TABLE `mcc_custom_field` (
  `custom_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `value` text NOT NULL,
  `validation` varchar(255) NOT NULL,
  `location` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`custom_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_custom_field_customer_group`
--

DROP TABLE IF EXISTS `mcc_custom_field_customer_group`;
CREATE TABLE `mcc_custom_field_customer_group` (
  `custom_field_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_custom_field_description`
--

DROP TABLE IF EXISTS `mcc_custom_field_description`;
CREATE TABLE `mcc_custom_field_description` (
  `custom_field_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_custom_field_value`
--

DROP TABLE IF EXISTS `mcc_custom_field_value`;
CREATE TABLE `mcc_custom_field_value` (
  `custom_field_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_field_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`custom_field_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_custom_field_value_description`
--

DROP TABLE IF EXISTS `mcc_custom_field_value_description`;
CREATE TABLE `mcc_custom_field_value_description` (
  `custom_field_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`custom_field_value_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_district`
--

DROP TABLE IF EXISTS `mcc_district`;
CREATE TABLE `mcc_district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3141 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_district`
--

INSERT INTO `mcc_district` (`district_id`, `country_id`, `zone_id`, `city_id`, `name`, `status`) VALUES
(2, 44, 684, 1, '瑶海区', 1),
(3, 44, 684, 1, '庐阳区', 1),
(4, 44, 684, 1, '蜀山区', 1),
(5, 44, 684, 1, '包河区', 1),
(6, 44, 684, 1, '长丰县', 1),
(7, 44, 684, 1, '肥东县', 1),
(8, 44, 684, 1, '肥西县', 1),
(10, 44, 684, 2, '镜湖区', 1),
(11, 44, 684, 2, '马塘区', 1),
(12, 44, 684, 2, '新芜区', 1),
(13, 44, 684, 2, '鸠江区', 1),
(14, 44, 684, 2, '芜湖县', 1),
(15, 44, 684, 2, '繁昌县', 1),
(16, 44, 684, 2, '南陵县', 1),
(18, 44, 684, 3, '龙子湖区', 1),
(19, 44, 684, 3, '蚌山区', 1),
(20, 44, 684, 3, '禹会区', 1),
(21, 44, 684, 3, '淮上区', 1),
(22, 44, 684, 3, '怀远县', 1),
(23, 44, 684, 3, '五河县', 1),
(24, 44, 684, 3, '固镇县', 1),
(26, 44, 684, 4, '大通区', 1),
(27, 44, 684, 4, '田家庵区', 1),
(28, 44, 684, 4, '谢家集区', 1),
(29, 44, 684, 4, '八公山区', 1),
(30, 44, 684, 4, '潘集区', 1),
(31, 44, 684, 4, '凤台县', 1),
(33, 44, 684, 5, '金家庄区', 1),
(34, 44, 684, 5, '花山区', 1),
(35, 44, 684, 5, '雨山区', 1),
(36, 44, 684, 5, '当涂县', 1),
(38, 44, 684, 6, '杜集区', 1),
(39, 44, 684, 6, '相山区', 1),
(40, 44, 684, 6, '烈山区', 1),
(41, 44, 684, 6, '濉溪县', 1),
(43, 44, 684, 7, '铜官山区', 1),
(44, 44, 684, 7, '狮子山区', 1),
(45, 44, 684, 7, '郊　区', 1),
(46, 44, 684, 7, '铜陵县', 1),
(48, 44, 684, 8, '迎江区', 1),
(49, 44, 684, 8, '大观区', 1),
(50, 44, 684, 8, '郊　区', 1),
(51, 44, 684, 8, '怀宁县', 1),
(52, 44, 684, 8, '枞阳县', 1),
(53, 44, 684, 8, '潜山县', 1),
(54, 44, 684, 8, '太湖县', 1),
(55, 44, 684, 8, '宿松县', 1),
(56, 44, 684, 8, '望江县', 1),
(57, 44, 684, 8, '岳西县', 1),
(58, 44, 684, 8, '桐城市', 1),
(60, 44, 684, 9, '屯溪区', 1),
(61, 44, 684, 9, '黄山区', 1),
(62, 44, 684, 9, '徽州区', 1),
(63, 44, 684, 9, '歙　县', 1),
(64, 44, 684, 9, '休宁县', 1),
(65, 44, 684, 9, '黟　县', 1),
(66, 44, 684, 9, '祁门县', 1),
(68, 44, 684, 10, '琅琊区', 1),
(69, 44, 684, 10, '南谯区', 1),
(70, 44, 684, 10, '来安县', 1),
(71, 44, 684, 10, '全椒县', 1),
(72, 44, 684, 10, '定远县', 1),
(73, 44, 684, 10, '凤阳县', 1),
(74, 44, 684, 10, '天长市', 1),
(75, 44, 684, 10, '明光市', 1),
(77, 44, 684, 11, '颍州区', 1),
(78, 44, 684, 11, '颍东区', 1),
(79, 44, 684, 11, '颍泉区', 1),
(80, 44, 684, 11, '临泉县', 1),
(81, 44, 684, 11, '太和县', 1),
(82, 44, 684, 11, '阜南县', 1),
(83, 44, 684, 11, '颍上县', 1),
(84, 44, 684, 11, '界首市', 1),
(86, 44, 684, 12, '墉桥区', 1),
(87, 44, 684, 12, '砀山县', 1),
(88, 44, 684, 12, '萧　县', 1),
(89, 44, 684, 12, '灵璧县', 1),
(90, 44, 684, 12, '泗　县', 1),
(92, 44, 684, 13, '居巢区', 1),
(93, 44, 684, 13, '庐江县', 1),
(94, 44, 684, 13, '无为县', 1),
(95, 44, 684, 13, '含山县', 1),
(96, 44, 684, 13, '和　县', 1),
(98, 44, 684, 14, '金安区', 1),
(99, 44, 684, 14, '裕安区', 1),
(100, 44, 684, 14, '寿　县', 1),
(101, 44, 684, 14, '霍邱县', 1),
(102, 44, 684, 14, '舒城县', 1),
(103, 44, 684, 14, '金寨县', 1),
(104, 44, 684, 14, '霍山县', 1),
(106, 44, 684, 15, '谯城区', 1),
(107, 44, 684, 15, '涡阳县', 1),
(108, 44, 684, 15, '蒙城县', 1),
(109, 44, 684, 15, '利辛县', 1),
(111, 44, 684, 16, '贵池区', 1),
(112, 44, 684, 16, '东至县', 1),
(113, 44, 684, 16, '石台县', 1),
(114, 44, 684, 16, '青阳县', 1),
(116, 44, 684, 17, '宣州区', 1),
(117, 44, 684, 17, '郎溪县', 1),
(118, 44, 684, 17, '广德县', 1),
(119, 44, 684, 17, '泾　县', 1),
(120, 44, 684, 17, '绩溪县', 1),
(121, 44, 684, 17, '旌德县', 1),
(122, 44, 684, 17, '宁国市', 1),
(123, 44, 685, 18, '东城区', 1),
(124, 44, 685, 18, '西城区', 1),
(125, 44, 685, 18, '崇文区', 1),
(126, 44, 685, 18, '宣武区', 1),
(127, 44, 685, 18, '朝阳区', 1),
(128, 44, 685, 18, '丰台区', 1),
(129, 44, 685, 18, '石景山区', 1),
(130, 44, 685, 18, '海淀区', 1),
(131, 44, 685, 18, '门头沟区', 1),
(132, 44, 685, 18, '房山区', 1),
(133, 44, 685, 18, '通州区', 1),
(134, 44, 685, 18, '顺义区', 1),
(135, 44, 685, 18, '昌平区', 1),
(136, 44, 685, 18, '大兴区', 1),
(137, 44, 685, 18, '怀柔区', 1),
(138, 44, 685, 18, '平谷区', 1),
(139, 44, 686, 19, '万州区', 1),
(140, 44, 686, 19, '涪陵区', 1),
(141, 44, 686, 19, '渝中区', 1),
(142, 44, 686, 19, '大渡口区', 1),
(143, 44, 686, 19, '江北区', 1),
(144, 44, 686, 19, '沙坪坝区', 1),
(145, 44, 686, 19, '九龙坡区', 1),
(146, 44, 686, 19, '南岸区', 1),
(147, 44, 686, 19, '北碚区', 1),
(148, 44, 686, 19, '万盛区', 1),
(149, 44, 686, 19, '双桥区', 1),
(150, 44, 686, 19, '渝北区', 1),
(151, 44, 686, 19, '巴南区', 1),
(152, 44, 686, 19, '黔江区', 1),
(153, 44, 686, 19, '长寿区', 1),
(154, 44, 686, 20, '綦江县', 1),
(155, 44, 686, 20, '潼南县', 1),
(156, 44, 686, 20, '铜梁县', 1),
(157, 44, 686, 20, '大足县', 1),
(158, 44, 686, 20, '荣昌县', 1),
(159, 44, 686, 20, '璧山县', 1),
(160, 44, 686, 20, '梁平县', 1),
(161, 44, 686, 20, '城口县', 1),
(162, 44, 686, 20, '丰都县', 1),
(163, 44, 686, 20, '垫江县', 1),
(164, 44, 686, 20, '武隆县', 1),
(165, 44, 686, 20, '忠　县', 1),
(166, 44, 686, 20, '开　县', 1),
(167, 44, 686, 20, '云阳县', 1),
(168, 44, 686, 20, '奉节县', 1),
(169, 44, 686, 20, '巫山县', 1),
(170, 44, 686, 20, '巫溪县', 1),
(171, 44, 686, 20, '石柱土家族自治县', 1),
(172, 44, 686, 20, '秀山土家族苗族自治县', 1),
(173, 44, 686, 20, '酉阳土家族苗族自治县', 1),
(174, 44, 686, 20, '彭水苗族土家族自治县', 1),
(175, 44, 686, 21, '江津市', 1),
(176, 44, 686, 21, '合川市', 1),
(177, 44, 686, 21, '永川市', 1),
(178, 44, 686, 21, '南川市', 1),
(180, 44, 687, 22, '鼓楼区', 1),
(181, 44, 687, 22, '台江区', 1),
(182, 44, 687, 22, '仓山区', 1),
(183, 44, 687, 22, '马尾区', 1),
(184, 44, 687, 22, '晋安区', 1),
(185, 44, 687, 22, '闽侯县', 1),
(186, 44, 687, 22, '连江县', 1),
(187, 44, 687, 22, '罗源县', 1),
(188, 44, 687, 22, '闽清县', 1),
(189, 44, 687, 22, '永泰县', 1),
(190, 44, 687, 22, '平潭县', 1),
(191, 44, 687, 22, '福清市', 1),
(192, 44, 687, 22, '长乐市', 1),
(194, 44, 687, 23, '思明区', 1),
(195, 44, 687, 23, '海沧区', 1),
(196, 44, 687, 23, '湖里区', 1),
(197, 44, 687, 23, '集美区', 1),
(198, 44, 687, 23, '同安区', 1),
(199, 44, 687, 23, '翔安区', 1),
(201, 44, 687, 24, '城厢区', 1),
(202, 44, 687, 24, '涵江区', 1),
(203, 44, 687, 24, '荔城区', 1),
(204, 44, 687, 24, '秀屿区', 1),
(205, 44, 687, 24, '仙游县', 1),
(207, 44, 687, 25, '梅列区', 1),
(208, 44, 687, 25, '三元区', 1),
(209, 44, 687, 25, '明溪县', 1),
(210, 44, 687, 25, '清流县', 1),
(211, 44, 687, 25, '宁化县', 1),
(212, 44, 687, 25, '大田县', 1),
(213, 44, 687, 25, '尤溪县', 1),
(214, 44, 687, 25, '沙　县', 1),
(215, 44, 687, 25, '将乐县', 1),
(216, 44, 687, 25, '泰宁县', 1),
(217, 44, 687, 25, '建宁县', 1),
(218, 44, 687, 25, '永安市', 1),
(220, 44, 687, 26, '鲤城区', 1),
(221, 44, 687, 26, '丰泽区', 1),
(222, 44, 687, 26, '洛江区', 1),
(223, 44, 687, 26, '泉港区', 1),
(224, 44, 687, 26, '惠安县', 1),
(225, 44, 687, 26, '安溪县', 1),
(226, 44, 687, 26, '永春县', 1),
(227, 44, 687, 26, '德化县', 1),
(228, 44, 687, 26, '金门县', 1),
(229, 44, 687, 26, '石狮市', 1),
(230, 44, 687, 26, '晋江市', 1),
(231, 44, 687, 26, '南安市', 1),
(233, 44, 687, 27, '芗城区', 1),
(234, 44, 687, 27, '龙文区', 1),
(235, 44, 687, 27, '云霄县', 1),
(236, 44, 687, 27, '漳浦县', 1),
(237, 44, 687, 27, '诏安县', 1),
(238, 44, 687, 27, '长泰县', 1),
(239, 44, 687, 27, '东山县', 1),
(240, 44, 687, 27, '南靖县', 1),
(241, 44, 687, 27, '平和县', 1),
(242, 44, 687, 27, '华安县', 1),
(243, 44, 687, 27, '龙海市', 1),
(245, 44, 687, 28, '延平区', 1),
(246, 44, 687, 28, '顺昌县', 1),
(247, 44, 687, 28, '浦城县', 1),
(248, 44, 687, 28, '光泽县', 1),
(249, 44, 687, 28, '松溪县', 1),
(250, 44, 687, 28, '政和县', 1),
(251, 44, 687, 28, '邵武市', 1),
(252, 44, 687, 28, '武夷山市', 1),
(253, 44, 687, 28, '建瓯市', 1),
(254, 44, 687, 28, '建阳市', 1),
(256, 44, 687, 29, '新罗区', 1),
(257, 44, 687, 29, '长汀县', 1),
(258, 44, 687, 29, '永定县', 1),
(259, 44, 687, 29, '上杭县', 1),
(260, 44, 687, 29, '武平县', 1),
(261, 44, 687, 29, '连城县', 1),
(262, 44, 687, 29, '漳平市', 1),
(264, 44, 687, 30, '蕉城区', 1),
(265, 44, 687, 30, '霞浦县', 1),
(266, 44, 687, 30, '古田县', 1),
(267, 44, 687, 30, '屏南县', 1),
(268, 44, 687, 30, '寿宁县', 1),
(269, 44, 687, 30, '周宁县', 1),
(270, 44, 687, 30, '柘荣县', 1),
(271, 44, 687, 30, '福安市', 1),
(272, 44, 687, 30, '福鼎市', 1),
(274, 44, 688, 31, '城关区', 1),
(275, 44, 688, 31, '七里河区', 1),
(276, 44, 688, 31, '西固区', 1),
(277, 44, 688, 31, '安宁区', 1),
(278, 44, 688, 31, '红古区', 1),
(279, 44, 688, 31, '永登县', 1),
(280, 44, 688, 31, '皋兰县', 1),
(281, 44, 688, 31, '榆中县', 1),
(284, 44, 688, 33, '金川区', 1),
(285, 44, 688, 33, '永昌县', 1),
(287, 44, 688, 34, '白银区', 1),
(288, 44, 688, 34, '平川区', 1),
(289, 44, 688, 34, '靖远县', 1),
(290, 44, 688, 34, '会宁县', 1),
(291, 44, 688, 34, '景泰县', 1),
(293, 44, 688, 35, '秦城区', 1),
(294, 44, 688, 35, '北道区', 1),
(295, 44, 688, 35, '清水县', 1),
(296, 44, 688, 35, '秦安县', 1),
(297, 44, 688, 35, '甘谷县', 1),
(298, 44, 688, 35, '武山县', 1),
(299, 44, 688, 35, '张家川回族自治县', 1),
(301, 44, 688, 36, '凉州区', 1),
(302, 44, 688, 36, '民勤县', 1),
(303, 44, 688, 36, '古浪县', 1),
(304, 44, 688, 36, '天祝藏族自治县', 1),
(306, 44, 688, 37, '甘州区', 1),
(307, 44, 688, 37, '肃南裕固族自治县', 1),
(308, 44, 688, 37, '民乐县', 1),
(309, 44, 688, 37, '临泽县', 1),
(310, 44, 688, 37, '高台县', 1),
(311, 44, 688, 37, '山丹县', 1),
(313, 44, 688, 38, '崆峒区', 1),
(314, 44, 688, 38, '泾川县', 1),
(315, 44, 688, 38, '灵台县', 1),
(316, 44, 688, 38, '崇信县', 1),
(317, 44, 688, 38, '华亭县', 1),
(318, 44, 688, 38, '庄浪县', 1),
(319, 44, 688, 38, '静宁县', 1),
(321, 44, 688, 39, '肃州区', 1),
(322, 44, 688, 39, '金塔县', 1),
(323, 44, 688, 39, '安西县', 1),
(324, 44, 688, 39, '肃北蒙古族自治县', 1),
(325, 44, 688, 39, '阿克塞哈萨克族自治县', 1),
(326, 44, 688, 39, '玉门市', 1),
(327, 44, 688, 39, '敦煌市', 1),
(329, 44, 688, 40, '西峰区', 1),
(330, 44, 688, 40, '庆城县', 1),
(331, 44, 688, 40, '环　县', 1),
(332, 44, 688, 40, '华池县', 1),
(333, 44, 688, 40, '合水县', 1),
(334, 44, 688, 40, '正宁县', 1),
(335, 44, 688, 40, '宁　县', 1),
(336, 44, 688, 40, '镇原县', 1),
(338, 44, 688, 41, '安定区', 1),
(339, 44, 688, 41, '通渭县', 1),
(340, 44, 688, 41, '陇西县', 1),
(341, 44, 688, 41, '渭源县', 1),
(342, 44, 688, 41, '临洮县', 1),
(343, 44, 688, 41, '漳　县', 1),
(344, 44, 688, 41, '岷　县', 1),
(346, 44, 688, 42, '武都区', 1),
(347, 44, 688, 42, '成　县', 1),
(348, 44, 688, 42, '文　县', 1),
(349, 44, 688, 42, '宕昌县', 1),
(350, 44, 688, 42, '康　县', 1),
(351, 44, 688, 42, '西和县', 1),
(352, 44, 688, 42, '礼　县', 1),
(353, 44, 688, 42, '徽　县', 1),
(354, 44, 688, 42, '两当县', 1),
(355, 44, 688, 43, '临夏市', 1),
(356, 44, 688, 43, '临夏县', 1),
(357, 44, 688, 43, '康乐县', 1),
(358, 44, 688, 43, '永靖县', 1),
(359, 44, 688, 43, '广河县', 1),
(360, 44, 688, 43, '和政县', 1),
(361, 44, 688, 43, '东乡族自治县', 1),
(362, 44, 688, 43, '积石山保安族东乡族撒拉族自治县', 1),
(363, 44, 688, 44, '合作市', 1),
(364, 44, 688, 44, '临潭县', 1),
(365, 44, 688, 44, '卓尼县', 1),
(366, 44, 688, 44, '舟曲县', 1),
(367, 44, 688, 44, '迭部县', 1),
(368, 44, 688, 44, '玛曲县', 1),
(369, 44, 688, 44, '碌曲县', 1),
(370, 44, 688, 44, '夏河县', 1),
(372, 44, 689, 45, '东山区', 1),
(373, 44, 689, 45, '荔湾区', 1),
(374, 44, 689, 45, '越秀区', 1),
(375, 44, 689, 45, '海珠区', 1),
(376, 44, 689, 45, '天河区', 1),
(377, 44, 689, 45, '芳村区', 1),
(378, 44, 689, 45, '白云区', 1),
(379, 44, 689, 45, '黄埔区', 1),
(380, 44, 689, 45, '番禺区', 1),
(381, 44, 689, 45, '花都区', 1),
(382, 44, 689, 45, '增城市', 1),
(383, 44, 689, 45, '从化市', 1),
(385, 44, 689, 46, '武江区', 1),
(386, 44, 689, 46, '浈江区', 1),
(387, 44, 689, 46, '曲江区', 1),
(388, 44, 689, 46, '始兴县', 1),
(389, 44, 689, 46, '仁化县', 1),
(390, 44, 689, 46, '翁源县', 1),
(391, 44, 689, 46, '乳源瑶族自治县', 1),
(392, 44, 689, 46, '新丰县', 1),
(393, 44, 689, 46, '乐昌市', 1),
(394, 44, 689, 46, '南雄市', 1),
(396, 44, 689, 47, '罗湖区', 1),
(397, 44, 689, 47, '福田区', 1),
(398, 44, 689, 47, '南山区', 1),
(399, 44, 689, 47, '宝安区', 1),
(400, 44, 689, 47, '龙岗区', 1),
(401, 44, 689, 47, '盐田区', 1),
(403, 44, 689, 48, '香洲区', 1),
(404, 44, 689, 48, '斗门区', 1),
(405, 44, 689, 48, '金湾区', 1),
(407, 44, 689, 49, '龙湖区', 1),
(408, 44, 689, 49, '金平区', 1),
(409, 44, 689, 49, '濠江区', 1),
(410, 44, 689, 49, '潮阳区', 1),
(411, 44, 689, 49, '潮南区', 1),
(412, 44, 689, 49, '澄海区', 1),
(413, 44, 689, 49, '南澳县', 1),
(415, 44, 689, 50, '禅城区', 1),
(416, 44, 689, 50, '南海区', 1),
(417, 44, 689, 50, '顺德区', 1),
(418, 44, 689, 50, '三水区', 1),
(419, 44, 689, 50, '高明区', 1),
(421, 44, 689, 51, '蓬江区', 1),
(422, 44, 689, 51, '江海区', 1),
(423, 44, 689, 51, '新会区', 1),
(424, 44, 689, 51, '台山市', 1),
(425, 44, 689, 51, '开平市', 1),
(426, 44, 689, 51, '鹤山市', 1),
(427, 44, 689, 51, '恩平市', 1),
(429, 44, 689, 52, '赤坎区', 1),
(430, 44, 689, 52, '霞山区', 1),
(431, 44, 689, 52, '坡头区', 1),
(432, 44, 689, 52, '麻章区', 1),
(433, 44, 689, 52, '遂溪县', 1),
(434, 44, 689, 52, '徐闻县', 1),
(435, 44, 689, 52, '廉江市', 1),
(436, 44, 689, 52, '雷州市', 1),
(437, 44, 689, 52, '吴川市', 1),
(439, 44, 689, 53, '茂南区', 1),
(440, 44, 689, 53, '茂港区', 1),
(441, 44, 689, 53, '电白县', 1),
(442, 44, 689, 53, '高州市', 1),
(443, 44, 689, 53, '化州市', 1),
(444, 44, 689, 53, '信宜市', 1),
(446, 44, 689, 54, '端州区', 1),
(447, 44, 689, 54, '鼎湖区', 1),
(448, 44, 689, 54, '广宁县', 1),
(449, 44, 689, 54, '怀集县', 1),
(450, 44, 689, 54, '封开县', 1),
(451, 44, 689, 54, '德庆县', 1),
(452, 44, 689, 54, '高要市', 1),
(453, 44, 689, 54, '四会市', 1),
(455, 44, 689, 55, '惠城区', 1),
(456, 44, 689, 55, '惠阳区', 1),
(457, 44, 689, 55, '博罗县', 1),
(458, 44, 689, 55, '惠东县', 1),
(459, 44, 689, 55, '龙门县', 1),
(461, 44, 689, 56, '梅江区', 1),
(462, 44, 689, 56, '梅　县', 1),
(463, 44, 689, 56, '大埔县', 1),
(464, 44, 689, 56, '丰顺县', 1),
(465, 44, 689, 56, '五华县', 1),
(466, 44, 689, 56, '平远县', 1),
(467, 44, 689, 56, '蕉岭县', 1),
(468, 44, 689, 56, '兴宁市', 1),
(470, 44, 689, 57, '城　区', 1),
(471, 44, 689, 57, '海丰县', 1),
(472, 44, 689, 57, '陆河县', 1),
(473, 44, 689, 57, '陆丰市', 1),
(475, 44, 689, 58, '源城区', 1),
(476, 44, 689, 58, '紫金县', 1),
(477, 44, 689, 58, '龙川县', 1),
(478, 44, 689, 58, '连平县', 1),
(479, 44, 689, 58, '和平县', 1),
(480, 44, 689, 58, '东源县', 1),
(482, 44, 689, 59, '江城区', 1),
(483, 44, 689, 59, '阳西县', 1),
(484, 44, 689, 59, '阳东县', 1),
(485, 44, 689, 59, '阳春市', 1),
(487, 44, 689, 60, '清城区', 1),
(488, 44, 689, 60, '佛冈县', 1),
(489, 44, 689, 60, '阳山县', 1),
(490, 44, 689, 60, '连山壮族瑶族自治县', 1),
(491, 44, 689, 60, '连南瑶族自治县', 1),
(492, 44, 689, 60, '清新县', 1),
(493, 44, 689, 60, '英德市', 1),
(494, 44, 689, 60, '连州市', 1),
(496, 44, 689, 63, '湘桥区', 1),
(497, 44, 689, 63, '潮安县', 1),
(498, 44, 689, 63, '饶平县', 1),
(500, 44, 689, 64, '榕城区', 1),
(501, 44, 689, 64, '揭东县', 1),
(502, 44, 689, 64, '揭西县', 1),
(503, 44, 689, 64, '惠来县', 1),
(504, 44, 689, 64, '普宁市', 1),
(506, 44, 689, 65, '云城区', 1),
(507, 44, 689, 65, '新兴县', 1),
(508, 44, 689, 65, '郁南县', 1),
(509, 44, 689, 65, '云安县', 1),
(510, 44, 689, 65, '罗定市', 1),
(512, 44, 690, 66, '兴宁区', 1),
(513, 44, 690, 66, '青秀区', 1),
(514, 44, 690, 66, '江南区', 1),
(515, 44, 690, 66, '西乡塘区', 1),
(516, 44, 690, 66, '良庆区', 1),
(517, 44, 690, 66, '邕宁区', 1),
(518, 44, 690, 66, '武鸣县', 1),
(519, 44, 690, 66, '隆安县', 1),
(520, 44, 690, 66, '马山县', 1),
(521, 44, 690, 66, '上林县', 1),
(522, 44, 690, 66, '宾阳县', 1),
(523, 44, 690, 66, '横　县', 1),
(525, 44, 690, 67, '城中区', 1),
(526, 44, 690, 67, '鱼峰区', 1),
(527, 44, 690, 67, '柳南区', 1),
(528, 44, 690, 67, '柳北区', 1),
(529, 44, 690, 67, '柳江县', 1),
(530, 44, 690, 67, '柳城县', 1),
(531, 44, 690, 67, '鹿寨县', 1),
(532, 44, 690, 67, '融安县', 1),
(533, 44, 690, 67, '融水苗族自治县', 1),
(534, 44, 690, 67, '三江侗族自治县', 1),
(536, 44, 690, 68, '秀峰区', 1),
(537, 44, 690, 68, '叠彩区', 1),
(538, 44, 690, 68, '象山区', 1),
(539, 44, 690, 68, '七星区', 1),
(540, 44, 690, 68, '雁山区', 1),
(541, 44, 690, 68, '阳朔县', 1),
(542, 44, 690, 68, '临桂县', 1),
(543, 44, 690, 68, '灵川县', 1),
(544, 44, 690, 68, '全州县', 1),
(545, 44, 690, 68, '兴安县', 1),
(546, 44, 690, 68, '永福县', 1),
(547, 44, 690, 68, '灌阳县', 1),
(548, 44, 690, 68, '龙胜各族自治县', 1),
(549, 44, 690, 68, '资源县', 1),
(550, 44, 690, 68, '平乐县', 1),
(551, 44, 690, 68, '荔蒲县', 1),
(552, 44, 690, 68, '恭城瑶族自治县', 1),
(554, 44, 690, 69, '万秀区', 1),
(555, 44, 690, 69, '蝶山区', 1),
(556, 44, 690, 69, '长洲区', 1),
(557, 44, 690, 69, '苍梧县', 1),
(558, 44, 690, 69, '藤　县', 1),
(559, 44, 690, 69, '蒙山县', 1),
(560, 44, 690, 69, '岑溪市', 1),
(562, 44, 690, 70, '海城区', 1),
(563, 44, 690, 70, '银海区', 1),
(564, 44, 690, 70, '铁山港区', 1),
(565, 44, 690, 70, '合浦县', 1),
(567, 44, 690, 71, '港口区', 1),
(568, 44, 690, 71, '防城区', 1),
(569, 44, 690, 71, '上思县', 1),
(570, 44, 690, 71, '东兴市', 1),
(572, 44, 690, 72, '钦南区', 1),
(573, 44, 690, 72, '钦北区', 1),
(574, 44, 690, 72, '灵山县', 1),
(575, 44, 690, 72, '浦北县', 1),
(577, 44, 690, 73, '港北区', 1),
(578, 44, 690, 73, '港南区', 1),
(579, 44, 690, 73, '覃塘区', 1),
(580, 44, 690, 73, '平南县', 1),
(581, 44, 690, 73, '桂平市', 1),
(583, 44, 690, 74, '玉州区', 1),
(584, 44, 690, 74, '容　县', 1),
(585, 44, 690, 74, '陆川县', 1),
(586, 44, 690, 74, '博白县', 1),
(587, 44, 690, 74, '兴业县', 1),
(588, 44, 690, 74, '北流市', 1),
(590, 44, 690, 75, '右江区', 1),
(591, 44, 690, 75, '田阳县', 1),
(592, 44, 690, 75, '田东县', 1),
(593, 44, 690, 75, '平果县', 1),
(594, 44, 690, 75, '德保县', 1),
(595, 44, 690, 75, '靖西县', 1),
(596, 44, 690, 75, '那坡县', 1),
(597, 44, 690, 75, '凌云县', 1),
(598, 44, 690, 75, '乐业县', 1),
(599, 44, 690, 75, '田林县', 1),
(600, 44, 690, 75, '西林县', 1),
(601, 44, 690, 75, '隆林各族自治县', 1),
(603, 44, 690, 76, '八步区', 1),
(604, 44, 690, 76, '昭平县', 1),
(605, 44, 690, 76, '钟山县', 1),
(606, 44, 690, 76, '富川瑶族自治县', 1),
(608, 44, 690, 77, '金城江区', 1),
(609, 44, 690, 77, '南丹县', 1),
(610, 44, 690, 77, '天峨县', 1),
(611, 44, 690, 77, '凤山县', 1),
(612, 44, 690, 77, '东兰县', 1),
(613, 44, 690, 77, '罗城仫佬族自治县', 1),
(614, 44, 690, 77, '环江毛南族自治县', 1),
(615, 44, 690, 77, '巴马瑶族自治县', 1),
(616, 44, 690, 77, '都安瑶族自治县', 1),
(617, 44, 690, 77, '大化瑶族自治县', 1),
(618, 44, 690, 77, '宜州市', 1),
(620, 44, 690, 78, '兴宾区', 1),
(621, 44, 690, 78, '忻城县', 1),
(622, 44, 690, 78, '象州县', 1),
(623, 44, 690, 78, '武宣县', 1),
(624, 44, 690, 78, '金秀瑶族自治县', 1),
(625, 44, 690, 78, '合山市', 1),
(627, 44, 690, 79, '江洲区', 1),
(628, 44, 690, 79, '扶绥县', 1),
(629, 44, 690, 79, '宁明县', 1),
(630, 44, 690, 79, '龙州县', 1),
(631, 44, 690, 79, '大新县', 1),
(632, 44, 690, 79, '天等县', 1),
(633, 44, 690, 79, '凭祥市', 1),
(635, 44, 691, 80, '南明区', 1),
(636, 44, 691, 80, '云岩区', 1),
(637, 44, 691, 80, '花溪区', 1),
(638, 44, 691, 80, '乌当区', 1),
(639, 44, 691, 80, '白云区', 1),
(640, 44, 691, 80, '小河区', 1),
(641, 44, 691, 80, '开阳县', 1),
(642, 44, 691, 80, '息烽县', 1),
(643, 44, 691, 80, '修文县', 1),
(644, 44, 691, 80, '清镇市', 1),
(645, 44, 691, 81, '钟山区', 1),
(646, 44, 691, 81, '六枝特区', 1),
(647, 44, 691, 81, '水城县', 1),
(648, 44, 691, 81, '盘　县', 1),
(650, 44, 691, 82, '红花岗区', 1),
(651, 44, 691, 82, '汇川区', 1),
(652, 44, 691, 82, '遵义县', 1),
(653, 44, 691, 82, '桐梓县', 1),
(654, 44, 691, 82, '绥阳县', 1),
(655, 44, 691, 82, '正安县', 1),
(656, 44, 691, 82, '道真仡佬族苗族自治县', 1),
(657, 44, 691, 82, '务川仡佬族苗族自治县', 1),
(658, 44, 691, 82, '凤冈县', 1),
(659, 44, 691, 82, '湄潭县', 1),
(660, 44, 691, 82, '余庆县', 1),
(661, 44, 691, 82, '习水县', 1),
(662, 44, 691, 82, '赤水市', 1),
(663, 44, 691, 82, '仁怀市', 1),
(665, 44, 691, 83, '西秀区', 1),
(666, 44, 691, 83, '平坝县', 1),
(667, 44, 691, 83, '普定县', 1),
(668, 44, 691, 83, '镇宁布依族苗族自治县', 1),
(669, 44, 691, 83, '关岭布依族苗族自治县', 1),
(670, 44, 691, 83, '紫云苗族布依族自治县', 1),
(671, 44, 691, 84, '铜仁市', 1),
(672, 44, 691, 84, '江口县', 1),
(673, 44, 691, 84, '玉屏侗族自治县', 1),
(674, 44, 691, 84, '石阡县', 1),
(675, 44, 691, 84, '思南县', 1),
(676, 44, 691, 84, '印江土家族苗族自治县', 1),
(677, 44, 691, 84, '德江县', 1),
(678, 44, 691, 84, '沿河土家族自治县', 1),
(679, 44, 691, 84, '松桃苗族自治县', 1),
(680, 44, 691, 84, '万山特区', 1),
(681, 44, 691, 85, '兴义市', 1),
(682, 44, 691, 85, '兴仁县', 1),
(683, 44, 691, 85, '普安县', 1),
(684, 44, 691, 85, '晴隆县', 1),
(685, 44, 691, 85, '贞丰县', 1),
(686, 44, 691, 85, '望谟县', 1),
(687, 44, 691, 85, '册亨县', 1),
(688, 44, 691, 85, '安龙县', 1),
(689, 44, 691, 86, '毕节市', 1),
(690, 44, 691, 86, '大方县', 1),
(691, 44, 691, 86, '黔西县', 1),
(692, 44, 691, 86, '金沙县', 1),
(693, 44, 691, 86, '织金县', 1),
(694, 44, 691, 86, '纳雍县', 1),
(695, 44, 691, 86, '威宁彝族回族苗族自治县', 1),
(696, 44, 691, 86, '赫章县', 1),
(697, 44, 691, 87, '凯里市', 1),
(698, 44, 691, 87, '黄平县', 1),
(699, 44, 691, 87, '施秉县', 1),
(700, 44, 691, 87, '三穗县', 1),
(701, 44, 691, 87, '镇远县', 1),
(702, 44, 691, 87, '岑巩县', 1),
(703, 44, 691, 87, '天柱县', 1),
(704, 44, 691, 87, '锦屏县', 1),
(705, 44, 691, 87, '剑河县', 1),
(706, 44, 691, 87, '台江县', 1),
(707, 44, 691, 87, '黎平县', 1),
(708, 44, 691, 87, '榕江县', 1),
(709, 44, 691, 87, '从江县', 1),
(710, 44, 691, 87, '雷山县', 1),
(711, 44, 691, 87, '麻江县', 1),
(712, 44, 691, 87, '丹寨县', 1),
(713, 44, 691, 88, '都匀市', 1),
(714, 44, 691, 88, '福泉市', 1),
(715, 44, 691, 88, '荔波县', 1),
(716, 44, 691, 88, '贵定县', 1),
(717, 44, 691, 88, '瓮安县', 1),
(718, 44, 691, 88, '独山县', 1),
(719, 44, 691, 88, '平塘县', 1),
(720, 44, 691, 88, '罗甸县', 1),
(721, 44, 691, 88, '长顺县', 1),
(722, 44, 691, 88, '龙里县', 1),
(723, 44, 691, 88, '惠水县', 1),
(724, 44, 691, 88, '三都水族自治县', 1),
(726, 44, 692, 89, '秀英区', 1),
(727, 44, 692, 89, '龙华区', 1),
(728, 44, 692, 89, '琼山区', 1),
(729, 44, 692, 89, '美兰区', 1),
(731, 44, 692, 91, '五指山市', 1),
(732, 44, 692, 91, '琼海市', 1),
(733, 44, 692, 91, '儋州市', 1),
(734, 44, 692, 91, '文昌市', 1),
(735, 44, 692, 91, '万宁市', 1),
(736, 44, 692, 91, '东方市', 1),
(737, 44, 692, 91, '定安县', 1),
(738, 44, 692, 91, '屯昌县', 1),
(739, 44, 692, 91, '澄迈县', 1),
(740, 44, 692, 91, '临高县', 1),
(741, 44, 692, 91, '白沙黎族自治县', 1),
(742, 44, 692, 91, '昌江黎族自治县', 1),
(743, 44, 692, 91, '乐东黎族自治县', 1),
(744, 44, 692, 91, '陵水黎族自治县', 1),
(745, 44, 692, 91, '保亭黎族苗族自治县', 1),
(746, 44, 692, 91, '琼中黎族苗族自治县', 1),
(747, 44, 692, 91, '西沙群岛', 1),
(748, 44, 692, 91, '南沙群岛', 1),
(749, 44, 692, 91, '中沙群岛的岛礁及其海域', 1),
(751, 44, 693, 92, '长安区', 1),
(752, 44, 693, 92, '桥东区', 1),
(753, 44, 693, 92, '桥西区', 1),
(754, 44, 693, 92, '新华区', 1),
(755, 44, 693, 92, '井陉矿区', 1),
(756, 44, 693, 92, '裕华区', 1),
(757, 44, 693, 92, '井陉县', 1),
(758, 44, 693, 92, '正定县', 1),
(759, 44, 693, 92, '栾城县', 1),
(760, 44, 693, 92, '行唐县', 1),
(761, 44, 693, 92, '灵寿县', 1),
(762, 44, 693, 92, '高邑县', 1),
(763, 44, 693, 92, '深泽县', 1),
(764, 44, 693, 92, '赞皇县', 1),
(765, 44, 693, 92, '无极县', 1),
(766, 44, 693, 92, '平山县', 1),
(767, 44, 693, 92, '元氏县', 1),
(768, 44, 693, 92, '赵　县', 1),
(769, 44, 693, 92, '辛集市', 1),
(770, 44, 693, 92, '藁城市', 1),
(771, 44, 693, 92, '晋州市', 1),
(772, 44, 693, 92, '新乐市', 1),
(773, 44, 693, 92, '鹿泉市', 1),
(775, 44, 693, 93, '路南区', 1),
(776, 44, 693, 93, '路北区', 1),
(777, 44, 693, 93, '古冶区', 1),
(778, 44, 693, 93, '开平区', 1),
(779, 44, 693, 93, '丰南区', 1),
(780, 44, 693, 93, '丰润区', 1),
(781, 44, 693, 93, '滦　县', 1),
(782, 44, 693, 93, '滦南县', 1),
(783, 44, 693, 93, '乐亭县', 1),
(784, 44, 693, 93, '迁西县', 1),
(785, 44, 693, 93, '玉田县', 1),
(786, 44, 693, 93, '唐海县', 1),
(787, 44, 693, 93, '遵化市', 1),
(788, 44, 693, 93, '迁安市', 1),
(790, 44, 693, 94, '海港区', 1),
(791, 44, 693, 94, '山海关区', 1),
(792, 44, 693, 94, '北戴河区', 1),
(793, 44, 693, 94, '青龙满族自治县', 1),
(794, 44, 693, 94, '昌黎县', 1),
(795, 44, 693, 94, '抚宁县', 1),
(796, 44, 693, 94, '卢龙县', 1),
(798, 44, 693, 95, '邯山区', 1),
(799, 44, 693, 95, '丛台区', 1),
(800, 44, 693, 95, '复兴区', 1),
(801, 44, 693, 95, '峰峰矿区', 1),
(802, 44, 693, 95, '邯郸县', 1),
(803, 44, 693, 95, '临漳县', 1),
(804, 44, 693, 95, '成安县', 1),
(805, 44, 693, 95, '大名县', 1),
(806, 44, 693, 95, '涉　县', 1),
(807, 44, 693, 95, '磁　县', 1),
(808, 44, 693, 95, '肥乡县', 1),
(809, 44, 693, 95, '永年县', 1),
(810, 44, 693, 95, '邱　县', 1),
(811, 44, 693, 95, '鸡泽县', 1),
(812, 44, 693, 95, '广平县', 1),
(813, 44, 693, 95, '馆陶县', 1),
(814, 44, 693, 95, '魏　县', 1),
(815, 44, 693, 95, '曲周县', 1),
(816, 44, 693, 95, '武安市', 1),
(818, 44, 693, 96, '桥东区', 1),
(819, 44, 693, 96, '桥西区', 1),
(820, 44, 693, 96, '邢台县', 1),
(821, 44, 693, 96, '临城县', 1),
(822, 44, 693, 96, '内丘县', 1),
(823, 44, 693, 96, '柏乡县', 1),
(824, 44, 693, 96, '隆尧县', 1),
(825, 44, 693, 96, '任　县', 1),
(826, 44, 693, 96, '南和县', 1),
(827, 44, 693, 96, '宁晋县', 1),
(828, 44, 693, 96, '巨鹿县', 1),
(829, 44, 693, 96, '新河县', 1),
(830, 44, 693, 96, '广宗县', 1),
(831, 44, 693, 96, '平乡县', 1),
(832, 44, 693, 96, '威　县', 1),
(833, 44, 693, 96, '清河县', 1),
(834, 44, 693, 96, '临西县', 1),
(835, 44, 693, 96, '南宫市', 1),
(836, 44, 693, 96, '沙河市', 1),
(838, 44, 693, 97, '新市区', 1),
(839, 44, 693, 97, '北市区', 1),
(840, 44, 693, 97, '南市区', 1),
(841, 44, 693, 97, '满城县', 1),
(842, 44, 693, 97, '清苑县', 1),
(843, 44, 693, 97, '涞水县', 1),
(844, 44, 693, 97, '阜平县', 1),
(845, 44, 693, 97, '徐水县', 1),
(846, 44, 693, 97, '定兴县', 1),
(847, 44, 693, 97, '唐　县', 1),
(848, 44, 693, 97, '高阳县', 1),
(849, 44, 693, 97, '容城县', 1),
(850, 44, 693, 97, '涞源县', 1),
(851, 44, 693, 97, '望都县', 1),
(852, 44, 693, 97, '安新县', 1),
(853, 44, 693, 97, '易　县', 1),
(854, 44, 693, 97, '曲阳县', 1),
(855, 44, 693, 97, '蠡　县', 1),
(856, 44, 693, 97, '顺平县', 1),
(857, 44, 693, 97, '博野县', 1),
(858, 44, 693, 97, '雄　县', 1),
(859, 44, 693, 97, '涿州市', 1),
(860, 44, 693, 97, '定州市', 1),
(861, 44, 693, 97, '安国市', 1),
(862, 44, 693, 97, '高碑店市', 1),
(864, 44, 693, 98, '桥东区', 1),
(865, 44, 693, 98, '桥西区', 1),
(866, 44, 693, 98, '宣化区', 1),
(867, 44, 693, 98, '下花园区', 1),
(868, 44, 693, 98, '宣化县', 1),
(869, 44, 693, 98, '张北县', 1),
(870, 44, 693, 98, '康保县', 1),
(871, 44, 693, 98, '沽源县', 1),
(872, 44, 693, 98, '尚义县', 1),
(873, 44, 693, 98, '蔚　县', 1),
(874, 44, 693, 98, '阳原县', 1),
(875, 44, 693, 98, '怀安县', 1),
(876, 44, 693, 98, '万全县', 1),
(877, 44, 693, 98, '怀来县', 1),
(878, 44, 693, 98, '涿鹿县', 1),
(879, 44, 693, 98, '赤城县', 1),
(880, 44, 693, 98, '崇礼县', 1),
(882, 44, 693, 99, '双桥区', 1),
(883, 44, 693, 99, '双滦区', 1),
(884, 44, 693, 99, '鹰手营子矿区', 1),
(885, 44, 693, 99, '承德县', 1),
(886, 44, 693, 99, '兴隆县', 1),
(887, 44, 693, 99, '平泉县', 1),
(888, 44, 693, 99, '滦平县', 1),
(889, 44, 693, 99, '隆化县', 1),
(890, 44, 693, 99, '丰宁满族自治县', 1),
(891, 44, 693, 99, '宽城满族自治县', 1),
(892, 44, 693, 99, '围场满族蒙古族自治县', 1),
(894, 44, 693, 100, '新华区', 1),
(895, 44, 693, 100, '运河区', 1),
(896, 44, 693, 100, '沧　县', 1),
(897, 44, 693, 100, '青　县', 1),
(898, 44, 693, 100, '东光县', 1),
(899, 44, 693, 100, '海兴县', 1),
(900, 44, 693, 100, '盐山县', 1),
(901, 44, 693, 100, '肃宁县', 1),
(902, 44, 693, 100, '南皮县', 1),
(903, 44, 693, 100, '吴桥县', 1),
(904, 44, 693, 100, '献　县', 1),
(905, 44, 693, 100, '孟村回族自治县', 1),
(906, 44, 693, 100, '泊头市', 1),
(907, 44, 693, 100, '任丘市', 1),
(908, 44, 693, 100, '黄骅市', 1),
(909, 44, 693, 100, '河间市', 1),
(911, 44, 693, 101, '安次区', 1),
(912, 44, 693, 101, '广阳区', 1),
(913, 44, 693, 101, '固安县', 1),
(914, 44, 693, 101, '永清县', 1),
(915, 44, 693, 101, '香河县', 1),
(916, 44, 693, 101, '大城县', 1),
(917, 44, 693, 101, '文安县', 1),
(918, 44, 693, 101, '大厂回族自治县', 1),
(919, 44, 693, 101, '霸州市', 1),
(920, 44, 693, 101, '三河市', 1),
(922, 44, 693, 102, '桃城区', 1),
(923, 44, 693, 102, '枣强县', 1),
(924, 44, 693, 102, '武邑县', 1),
(925, 44, 693, 102, '武强县', 1),
(926, 44, 693, 102, '饶阳县', 1),
(927, 44, 693, 102, '安平县', 1),
(928, 44, 693, 102, '故城县', 1),
(929, 44, 693, 102, '景　县', 1),
(930, 44, 693, 102, '阜城县', 1),
(931, 44, 693, 102, '冀州市', 1),
(932, 44, 693, 102, '深州市', 1),
(934, 44, 694, 103, '道里区', 1),
(935, 44, 694, 103, '南岗区', 1),
(936, 44, 694, 103, '道外区', 1),
(937, 44, 694, 103, '香坊区', 1),
(938, 44, 694, 103, '动力区', 1),
(939, 44, 694, 103, '平房区', 1),
(940, 44, 694, 103, '松北区', 1),
(941, 44, 694, 103, '呼兰区', 1),
(942, 44, 694, 103, '依兰县', 1),
(943, 44, 694, 103, '方正县', 1),
(944, 44, 694, 103, '宾　县', 1),
(945, 44, 694, 103, '巴彦县', 1),
(946, 44, 694, 103, '木兰县', 1),
(947, 44, 694, 103, '通河县', 1),
(948, 44, 694, 103, '延寿县', 1),
(949, 44, 694, 103, '阿城市', 1),
(950, 44, 694, 103, '双城市', 1),
(951, 44, 694, 103, '尚志市', 1),
(952, 44, 694, 103, '五常市', 1),
(954, 44, 694, 104, '龙沙区', 1),
(955, 44, 694, 104, '建华区', 1),
(956, 44, 694, 104, '铁锋区', 1),
(957, 44, 694, 104, '昂昂溪区', 1),
(958, 44, 694, 104, '富拉尔基区', 1),
(959, 44, 694, 104, '碾子山区', 1),
(960, 44, 694, 104, '梅里斯达斡尔族区', 1),
(961, 44, 694, 104, '龙江县', 1),
(962, 44, 694, 104, '依安县', 1),
(963, 44, 694, 104, '泰来县', 1),
(964, 44, 694, 104, '甘南县', 1),
(965, 44, 694, 104, '富裕县', 1),
(966, 44, 694, 104, '克山县', 1),
(967, 44, 694, 104, '克东县', 1),
(968, 44, 694, 104, '拜泉县', 1),
(969, 44, 694, 104, '讷河市', 1),
(971, 44, 694, 105, '鸡冠区', 1),
(972, 44, 694, 105, '恒山区', 1),
(973, 44, 694, 105, '滴道区', 1),
(974, 44, 694, 105, '梨树区', 1),
(975, 44, 694, 105, '城子河区', 1),
(976, 44, 694, 105, '麻山区', 1),
(977, 44, 694, 105, '鸡东县', 1),
(978, 44, 694, 105, '虎林市', 1),
(979, 44, 694, 105, '密山市', 1),
(981, 44, 694, 106, '向阳区', 1),
(982, 44, 694, 106, '工农区', 1),
(983, 44, 694, 106, '南山区', 1),
(984, 44, 694, 106, '兴安区', 1),
(985, 44, 694, 106, '东山区', 1),
(986, 44, 694, 106, '兴山区', 1),
(987, 44, 694, 106, '萝北县', 1),
(988, 44, 694, 106, '绥滨县', 1),
(990, 44, 694, 107, '尖山区', 1),
(991, 44, 694, 107, '岭东区', 1),
(992, 44, 694, 107, '四方台区', 1),
(993, 44, 694, 107, '宝山区', 1),
(994, 44, 694, 107, '集贤县', 1),
(995, 44, 694, 107, '友谊县', 1),
(996, 44, 694, 107, '宝清县', 1),
(997, 44, 694, 107, '饶河县', 1),
(999, 44, 694, 108, '萨尔图区', 1),
(1000, 44, 694, 108, '龙凤区', 1),
(1001, 44, 694, 108, '让胡路区', 1),
(1002, 44, 694, 108, '红岗区', 1),
(1003, 44, 694, 108, '大同区', 1),
(1004, 44, 694, 108, '肇州县', 1),
(1005, 44, 694, 108, '肇源县', 1),
(1006, 44, 694, 108, '林甸县', 1),
(1007, 44, 694, 108, '杜尔伯特蒙古族自治县', 1),
(1009, 44, 694, 109, '伊春区', 1),
(1010, 44, 694, 109, '南岔区', 1),
(1011, 44, 694, 109, '友好区', 1),
(1012, 44, 694, 109, '西林区', 1),
(1013, 44, 694, 109, '翠峦区', 1),
(1014, 44, 694, 109, '新青区', 1),
(1015, 44, 694, 109, '美溪区', 1),
(1016, 44, 694, 109, '金山屯区', 1),
(1017, 44, 694, 109, '五营区', 1),
(1018, 44, 694, 109, '乌马河区', 1),
(1019, 44, 694, 109, '汤旺河区', 1),
(1020, 44, 694, 109, '带岭区', 1),
(1021, 44, 694, 109, '乌伊岭区', 1),
(1022, 44, 694, 109, '红星区', 1),
(1023, 44, 694, 109, '上甘岭区', 1),
(1024, 44, 694, 109, '嘉荫县', 1),
(1025, 44, 694, 109, '铁力市', 1),
(1027, 44, 694, 110, '永红区', 1),
(1028, 44, 694, 110, '向阳区', 1),
(1029, 44, 694, 110, '前进区', 1),
(1030, 44, 694, 110, '东风区', 1),
(1031, 44, 694, 110, '郊　区', 1),
(1032, 44, 694, 110, '桦南县', 1),
(1033, 44, 694, 110, '桦川县', 1),
(1034, 44, 694, 110, '汤原县', 1),
(1035, 44, 694, 110, '抚远县', 1),
(1036, 44, 694, 110, '同江市', 1),
(1037, 44, 694, 110, '富锦市', 1),
(1039, 44, 694, 111, '新兴区', 1),
(1040, 44, 694, 111, '桃山区', 1),
(1041, 44, 694, 111, '茄子河区', 1),
(1042, 44, 694, 111, '勃利县', 1),
(1044, 44, 694, 112, '东安区', 1),
(1045, 44, 694, 112, '阳明区', 1),
(1046, 44, 694, 112, '爱民区', 1),
(1047, 44, 694, 112, '西安区', 1),
(1048, 44, 694, 112, '东宁县', 1),
(1049, 44, 694, 112, '林口县', 1),
(1050, 44, 694, 112, '绥芬河市', 1),
(1051, 44, 694, 112, '海林市', 1),
(1052, 44, 694, 112, '宁安市', 1),
(1053, 44, 694, 112, '穆棱市', 1),
(1055, 44, 694, 113, '爱辉区', 1),
(1056, 44, 694, 113, '嫩江县', 1),
(1057, 44, 694, 113, '逊克县', 1),
(1058, 44, 694, 113, '孙吴县', 1),
(1059, 44, 694, 113, '北安市', 1),
(1060, 44, 694, 113, '五大连池市', 1),
(1062, 44, 694, 114, '北林区', 1),
(1063, 44, 694, 114, '望奎县', 1),
(1064, 44, 694, 114, '兰西县', 1),
(1065, 44, 694, 114, '青冈县', 1),
(1066, 44, 694, 114, '庆安县', 1),
(1067, 44, 694, 114, '明水县', 1),
(1068, 44, 694, 114, '绥棱县', 1),
(1069, 44, 694, 114, '安达市', 1),
(1070, 44, 694, 114, '肇东市', 1),
(1071, 44, 694, 114, '海伦市', 1),
(1072, 44, 694, 115, '呼玛县', 1),
(1073, 44, 694, 115, '塔河县', 1),
(1074, 44, 694, 115, '漠河县', 1),
(1076, 44, 695, 116, '中原区', 1),
(1077, 44, 695, 116, '二七区', 1),
(1078, 44, 695, 116, '管城回族区', 1),
(1079, 44, 695, 116, '金水区', 1),
(1080, 44, 695, 116, '上街区', 1),
(1081, 44, 695, 116, '邙山区', 1),
(1082, 44, 695, 116, '中牟县', 1),
(1083, 44, 695, 116, '巩义市', 1),
(1084, 44, 695, 116, '荥阳市', 1),
(1085, 44, 695, 116, '新密市', 1),
(1086, 44, 695, 116, '新郑市', 1),
(1087, 44, 695, 116, '登封市', 1),
(1089, 44, 695, 117, '龙亭区', 1),
(1090, 44, 695, 117, '顺河回族区', 1),
(1091, 44, 695, 117, '鼓楼区', 1),
(1092, 44, 695, 117, '南关区', 1),
(1093, 44, 695, 117, '郊　区', 1),
(1094, 44, 695, 117, '杞　县', 1),
(1095, 44, 695, 117, '通许县', 1),
(1096, 44, 695, 117, '尉氏县', 1),
(1097, 44, 695, 117, '开封县', 1),
(1098, 44, 695, 117, '兰考县', 1),
(1100, 44, 695, 118, '老城区', 1),
(1101, 44, 695, 118, '西工区', 1),
(1102, 44, 695, 118, '廛河回族区', 1),
(1103, 44, 695, 118, '涧西区', 1),
(1104, 44, 695, 118, '吉利区', 1),
(1105, 44, 695, 118, '洛龙区', 1),
(1106, 44, 695, 118, '孟津县', 1),
(1107, 44, 695, 118, '新安县', 1),
(1108, 44, 695, 118, '栾川县', 1),
(1109, 44, 695, 118, '嵩　县', 1),
(1110, 44, 695, 118, '汝阳县', 1),
(1111, 44, 695, 118, '宜阳县', 1),
(1112, 44, 695, 118, '洛宁县', 1),
(1113, 44, 695, 118, '伊川县', 1),
(1114, 44, 695, 118, '偃师市', 1),
(1116, 44, 695, 119, '新华区', 1),
(1117, 44, 695, 119, '卫东区', 1),
(1118, 44, 695, 119, '石龙区', 1),
(1119, 44, 695, 119, '湛河区', 1),
(1120, 44, 695, 119, '宝丰县', 1),
(1121, 44, 695, 119, '叶　县', 1),
(1122, 44, 695, 119, '鲁山县', 1),
(1123, 44, 695, 119, '郏　县', 1),
(1124, 44, 695, 119, '舞钢市', 1),
(1125, 44, 695, 119, '汝州市', 1),
(1127, 44, 695, 120, '文峰区', 1),
(1128, 44, 695, 120, '北关区', 1),
(1129, 44, 695, 120, '殷都区', 1),
(1130, 44, 695, 120, '龙安区', 1),
(1131, 44, 695, 120, '安阳县', 1),
(1132, 44, 695, 120, '汤阴县', 1),
(1133, 44, 695, 120, '滑　县', 1),
(1134, 44, 695, 120, '内黄县', 1),
(1135, 44, 695, 120, '林州市', 1),
(1137, 44, 695, 121, '鹤山区', 1),
(1138, 44, 695, 121, '山城区', 1),
(1139, 44, 695, 121, '淇滨区', 1),
(1140, 44, 695, 121, '浚　县', 1),
(1141, 44, 695, 121, '淇　县', 1),
(1143, 44, 695, 122, '红旗区', 1),
(1144, 44, 695, 122, '卫滨区', 1),
(1145, 44, 695, 122, '凤泉区', 1),
(1146, 44, 695, 122, '牧野区', 1),
(1147, 44, 695, 122, '新乡县', 1),
(1148, 44, 695, 122, '获嘉县', 1),
(1149, 44, 695, 122, '原阳县', 1),
(1150, 44, 695, 122, '延津县', 1),
(1151, 44, 695, 122, '封丘县', 1),
(1152, 44, 695, 122, '长垣县', 1),
(1153, 44, 695, 122, '卫辉市', 1),
(1154, 44, 695, 122, '辉县市', 1),
(1156, 44, 695, 123, '解放区', 1),
(1157, 44, 695, 123, '中站区', 1),
(1158, 44, 695, 123, '马村区', 1),
(1159, 44, 695, 123, '山阳区', 1),
(1160, 44, 695, 123, '修武县', 1),
(1161, 44, 695, 123, '博爱县', 1),
(1162, 44, 695, 123, '武陟县', 1),
(1163, 44, 695, 123, '温　县', 1),
(1164, 44, 695, 123, '济源市', 1),
(1165, 44, 695, 123, '沁阳市', 1),
(1166, 44, 695, 123, '孟州市', 1),
(1168, 44, 695, 124, '华龙区', 1),
(1169, 44, 695, 124, '清丰县', 1),
(1170, 44, 695, 124, '南乐县', 1),
(1171, 44, 695, 124, '范　县', 1),
(1172, 44, 695, 124, '台前县', 1),
(1173, 44, 695, 124, '濮阳县', 1),
(1175, 44, 695, 125, '魏都区', 1),
(1176, 44, 695, 125, '许昌县', 1),
(1177, 44, 695, 125, '鄢陵县', 1),
(1178, 44, 695, 125, '襄城县', 1),
(1179, 44, 695, 125, '禹州市', 1),
(1180, 44, 695, 125, '长葛市', 1),
(1182, 44, 695, 126, '源汇区', 1),
(1183, 44, 695, 126, '郾城区', 1),
(1184, 44, 695, 126, '召陵区', 1),
(1185, 44, 695, 126, '舞阳县', 1),
(1186, 44, 695, 126, '临颍县', 1),
(1188, 44, 695, 127, '湖滨区', 1),
(1189, 44, 695, 127, '渑池县', 1),
(1190, 44, 695, 127, '陕　县', 1),
(1191, 44, 695, 127, '卢氏县', 1),
(1192, 44, 695, 127, '义马市', 1),
(1193, 44, 695, 127, '灵宝市', 1),
(1195, 44, 695, 128, '宛城区', 1),
(1196, 44, 695, 128, '卧龙区', 1),
(1197, 44, 695, 128, '南召县', 1),
(1198, 44, 695, 128, '方城县', 1),
(1199, 44, 695, 128, '西峡县', 1),
(1200, 44, 695, 128, '镇平县', 1),
(1201, 44, 695, 128, '内乡县', 1),
(1202, 44, 695, 128, '淅川县', 1),
(1203, 44, 695, 128, '社旗县', 1),
(1204, 44, 695, 128, '唐河县', 1),
(1205, 44, 695, 128, '新野县', 1),
(1206, 44, 695, 128, '桐柏县', 1),
(1207, 44, 695, 128, '邓州市', 1),
(1209, 44, 695, 129, '梁园区', 1),
(1210, 44, 695, 129, '睢阳区', 1),
(1211, 44, 695, 129, '民权县', 1),
(1212, 44, 695, 129, '睢　县', 1),
(1213, 44, 695, 129, '宁陵县', 1),
(1214, 44, 695, 129, '柘城县', 1),
(1215, 44, 695, 129, '虞城县', 1),
(1216, 44, 695, 129, '夏邑县', 1),
(1217, 44, 695, 129, '永城市', 1),
(1219, 44, 695, 130, '师河区', 1),
(1220, 44, 695, 130, '平桥区', 1),
(1221, 44, 695, 130, '罗山县', 1),
(1222, 44, 695, 130, '光山县', 1),
(1223, 44, 695, 130, '新　县', 1),
(1224, 44, 695, 130, '商城县', 1),
(1225, 44, 695, 130, '固始县', 1),
(1226, 44, 695, 130, '潢川县', 1),
(1227, 44, 695, 130, '淮滨县', 1),
(1228, 44, 695, 130, '息　县', 1),
(1230, 44, 695, 131, '川汇区', 1),
(1231, 44, 695, 131, '扶沟县', 1),
(1232, 44, 695, 131, '西华县', 1),
(1233, 44, 695, 131, '商水县', 1),
(1234, 44, 695, 131, '沈丘县', 1),
(1235, 44, 695, 131, '郸城县', 1),
(1236, 44, 695, 131, '淮阳县', 1),
(1237, 44, 695, 131, '太康县', 1),
(1238, 44, 695, 131, '鹿邑县', 1),
(1239, 44, 695, 131, '项城市', 1),
(1241, 44, 695, 132, '驿城区', 1),
(1242, 44, 695, 132, '西平县', 1),
(1243, 44, 695, 132, '上蔡县', 1),
(1244, 44, 695, 132, '平舆县', 1),
(1245, 44, 695, 132, '正阳县', 1),
(1246, 44, 695, 132, '确山县', 1),
(1247, 44, 695, 132, '泌阳县', 1),
(1248, 44, 695, 132, '汝南县', 1),
(1249, 44, 695, 132, '遂平县', 1),
(1250, 44, 695, 132, '新蔡县', 1),
(1252, 44, 697, 133, '江岸区', 1),
(1253, 44, 697, 133, '江汉区', 1),
(1254, 44, 697, 133, '乔口区', 1),
(1255, 44, 697, 133, '汉阳区', 1),
(1256, 44, 697, 133, '武昌区', 1),
(1257, 44, 697, 133, '青山区', 1),
(1258, 44, 697, 133, '洪山区', 1),
(1259, 44, 697, 133, '东西湖区', 1),
(1260, 44, 697, 133, '汉南区', 1),
(1261, 44, 697, 133, '蔡甸区', 1),
(1262, 44, 697, 133, '江夏区', 1),
(1263, 44, 697, 133, '黄陂区', 1),
(1264, 44, 697, 133, '新洲区', 1),
(1266, 44, 697, 134, '黄石港区', 1),
(1267, 44, 697, 134, '西塞山区', 1),
(1268, 44, 697, 134, '下陆区', 1),
(1269, 44, 697, 134, '铁山区', 1),
(1270, 44, 697, 134, '阳新县', 1),
(1271, 44, 697, 134, '大冶市', 1),
(1273, 44, 697, 135, '茅箭区', 1),
(1274, 44, 697, 135, '张湾区', 1),
(1275, 44, 697, 135, '郧　县', 1),
(1276, 44, 697, 135, '郧西县', 1),
(1277, 44, 697, 135, '竹山县', 1),
(1278, 44, 697, 135, '竹溪县', 1),
(1279, 44, 697, 135, '房　县', 1),
(1280, 44, 697, 135, '丹江口市', 1),
(1282, 44, 697, 136, '西陵区', 1),
(1283, 44, 697, 136, '伍家岗区', 1),
(1284, 44, 697, 136, '点军区', 1),
(1285, 44, 697, 136, '猇亭区', 1),
(1286, 44, 697, 136, '夷陵区', 1),
(1287, 44, 697, 136, '远安县', 1),
(1288, 44, 697, 136, '兴山县', 1),
(1289, 44, 697, 136, '秭归县', 1),
(1290, 44, 697, 136, '长阳土家族自治县', 1),
(1291, 44, 697, 136, '五峰土家族自治县', 1),
(1292, 44, 697, 136, '宜都市', 1),
(1293, 44, 697, 136, '当阳市', 1),
(1294, 44, 697, 136, '枝江市', 1),
(1296, 44, 697, 137, '襄城区', 1),
(1297, 44, 697, 137, '樊城区', 1),
(1298, 44, 697, 137, '襄阳区', 1),
(1299, 44, 697, 137, '南漳县', 1),
(1300, 44, 697, 137, '谷城县', 1),
(1301, 44, 697, 137, '保康县', 1),
(1302, 44, 697, 137, '老河口市', 1),
(1303, 44, 697, 137, '枣阳市', 1),
(1304, 44, 697, 137, '宜城市', 1),
(1306, 44, 697, 138, '梁子湖区', 1),
(1307, 44, 697, 138, '华容区', 1),
(1308, 44, 697, 138, '鄂城区', 1),
(1310, 44, 697, 139, '东宝区', 1),
(1311, 44, 697, 139, '掇刀区', 1),
(1312, 44, 697, 139, '京山县', 1),
(1313, 44, 697, 139, '沙洋县', 1),
(1314, 44, 697, 139, '钟祥市', 1),
(1316, 44, 697, 140, '孝南区', 1),
(1317, 44, 697, 140, '孝昌县', 1),
(1318, 44, 697, 140, '大悟县', 1),
(1319, 44, 697, 140, '云梦县', 1),
(1320, 44, 697, 140, '应城市', 1),
(1321, 44, 697, 140, '安陆市', 1),
(1322, 44, 697, 140, '汉川市', 1),
(1324, 44, 697, 141, '沙市区', 1),
(1325, 44, 697, 141, '荆州区', 1),
(1326, 44, 697, 141, '公安县', 1),
(1327, 44, 697, 141, '监利县', 1),
(1328, 44, 697, 141, '江陵县', 1),
(1329, 44, 697, 141, '石首市', 1),
(1330, 44, 697, 141, '洪湖市', 1),
(1331, 44, 697, 141, '松滋市', 1),
(1333, 44, 697, 142, '黄州区', 1),
(1334, 44, 697, 142, '团风县', 1),
(1335, 44, 697, 142, '红安县', 1),
(1336, 44, 697, 142, '罗田县', 1),
(1337, 44, 697, 142, '英山县', 1),
(1338, 44, 697, 142, '浠水县', 1),
(1339, 44, 697, 142, '蕲春县', 1),
(1340, 44, 697, 142, '黄梅县', 1),
(1341, 44, 697, 142, '麻城市', 1),
(1342, 44, 697, 142, '武穴市', 1),
(1344, 44, 697, 143, '咸安区', 1),
(1345, 44, 697, 143, '嘉鱼县', 1),
(1346, 44, 697, 143, '通城县', 1),
(1347, 44, 697, 143, '崇阳县', 1),
(1348, 44, 697, 143, '通山县', 1),
(1349, 44, 697, 143, '赤壁市', 1),
(1351, 44, 697, 144, '曾都区', 1),
(1352, 44, 697, 144, '广水市', 1),
(1353, 44, 697, 145, '恩施市', 1),
(1354, 44, 697, 145, '利川市', 1),
(1355, 44, 697, 145, '建始县', 1),
(1356, 44, 697, 145, '巴东县', 1),
(1357, 44, 697, 145, '宣恩县', 1),
(1358, 44, 697, 145, '咸丰县', 1),
(1359, 44, 697, 145, '来凤县', 1),
(1360, 44, 697, 145, '鹤峰县', 1),
(1361, 44, 697, 146, '仙桃市', 1),
(1362, 44, 697, 146, '潜江市', 1),
(1363, 44, 697, 146, '天门市', 1),
(1364, 44, 697, 146, '神农架林区', 1),
(1366, 44, 698, 147, '芙蓉区', 1),
(1367, 44, 698, 147, '天心区', 1),
(1368, 44, 698, 147, '岳麓区', 1),
(1369, 44, 698, 147, '开福区', 1),
(1370, 44, 698, 147, '雨花区', 1),
(1371, 44, 698, 147, '长沙县', 1),
(1372, 44, 698, 147, '望城县', 1),
(1373, 44, 698, 147, '宁乡县', 1),
(1374, 44, 698, 147, '浏阳市', 1),
(1376, 44, 698, 148, '荷塘区', 1),
(1377, 44, 698, 148, '芦淞区', 1),
(1378, 44, 698, 148, '石峰区', 1),
(1379, 44, 698, 148, '天元区', 1),
(1380, 44, 698, 148, '株洲县', 1),
(1381, 44, 698, 148, '攸　县', 1),
(1382, 44, 698, 148, '茶陵县', 1),
(1383, 44, 698, 148, '炎陵县', 1),
(1384, 44, 698, 148, '醴陵市', 1),
(1386, 44, 698, 149, '雨湖区', 1),
(1387, 44, 698, 149, '岳塘区', 1),
(1388, 44, 698, 149, '湘潭县', 1),
(1389, 44, 698, 149, '湘乡市', 1),
(1390, 44, 698, 149, '韶山市', 1),
(1392, 44, 698, 150, '珠晖区', 1),
(1393, 44, 698, 150, '雁峰区', 1),
(1394, 44, 698, 150, '石鼓区', 1),
(1395, 44, 698, 150, '蒸湘区', 1),
(1396, 44, 698, 150, '南岳区', 1),
(1397, 44, 698, 150, '衡阳县', 1),
(1398, 44, 698, 150, '衡南县', 1),
(1399, 44, 698, 150, '衡山县', 1),
(1400, 44, 698, 150, '衡东县', 1),
(1401, 44, 698, 150, '祁东县', 1),
(1402, 44, 698, 150, '耒阳市', 1),
(1403, 44, 698, 150, '常宁市', 1),
(1405, 44, 698, 151, '双清区', 1),
(1406, 44, 698, 151, '大祥区', 1),
(1407, 44, 698, 151, '北塔区', 1),
(1408, 44, 698, 151, '邵东县', 1),
(1409, 44, 698, 151, '新邵县', 1),
(1410, 44, 698, 151, '邵阳县', 1),
(1411, 44, 698, 151, '隆回县', 1),
(1412, 44, 698, 151, '洞口县', 1),
(1413, 44, 698, 151, '绥宁县', 1),
(1414, 44, 698, 151, '新宁县', 1),
(1415, 44, 698, 151, '城步苗族自治县', 1),
(1416, 44, 698, 151, '武冈市', 1),
(1418, 44, 698, 152, '岳阳楼区', 1),
(1419, 44, 698, 152, '云溪区', 1),
(1420, 44, 698, 152, '君山区', 1),
(1421, 44, 698, 152, '岳阳县', 1),
(1422, 44, 698, 152, '华容县', 1),
(1423, 44, 698, 152, '湘阴县', 1),
(1424, 44, 698, 152, '平江县', 1),
(1425, 44, 698, 152, '汨罗市', 1),
(1426, 44, 698, 152, '临湘市', 1),
(1428, 44, 698, 153, '武陵区', 1),
(1429, 44, 698, 153, '鼎城区', 1),
(1430, 44, 698, 153, '安乡县', 1),
(1431, 44, 698, 153, '汉寿县', 1),
(1432, 44, 698, 153, '澧　县', 1),
(1433, 44, 698, 153, '临澧县', 1),
(1434, 44, 698, 153, '桃源县', 1),
(1435, 44, 698, 153, '石门县', 1),
(1436, 44, 698, 153, '津市市', 1),
(1438, 44, 698, 154, '永定区', 1),
(1439, 44, 698, 154, '武陵源区', 1),
(1440, 44, 698, 154, '慈利县', 1),
(1441, 44, 698, 154, '桑植县', 1),
(1443, 44, 698, 155, '资阳区', 1),
(1444, 44, 698, 155, '赫山区', 1),
(1445, 44, 698, 155, '南　县', 1),
(1446, 44, 698, 155, '桃江县', 1),
(1447, 44, 698, 155, '安化县', 1),
(1448, 44, 698, 155, '沅江市', 1),
(1450, 44, 698, 156, '北湖区', 1),
(1451, 44, 698, 156, '苏仙区', 1),
(1452, 44, 698, 156, '桂阳县', 1),
(1453, 44, 698, 156, '宜章县', 1),
(1454, 44, 698, 156, '永兴县', 1),
(1455, 44, 698, 156, '嘉禾县', 1),
(1456, 44, 698, 156, '临武县', 1),
(1457, 44, 698, 156, '汝城县', 1),
(1458, 44, 698, 156, '桂东县', 1),
(1459, 44, 698, 156, '安仁县', 1),
(1460, 44, 698, 156, '资兴市', 1),
(1462, 44, 698, 157, '芝山区', 1),
(1463, 44, 698, 157, '冷水滩区', 1),
(1464, 44, 698, 157, '祁阳县', 1),
(1465, 44, 698, 157, '东安县', 1),
(1466, 44, 698, 157, '双牌县', 1),
(1467, 44, 698, 157, '道　县', 1),
(1468, 44, 698, 157, '江永县', 1),
(1469, 44, 698, 157, '宁远县', 1),
(1470, 44, 698, 157, '蓝山县', 1),
(1471, 44, 698, 157, '新田县', 1),
(1472, 44, 698, 157, '江华瑶族自治县', 1),
(1474, 44, 698, 158, '鹤城区', 1),
(1475, 44, 698, 158, '中方县', 1),
(1476, 44, 698, 158, '沅陵县', 1),
(1477, 44, 698, 158, '辰溪县', 1),
(1478, 44, 698, 158, '溆浦县', 1),
(1479, 44, 698, 158, '会同县', 1),
(1480, 44, 698, 158, '麻阳苗族自治县', 1),
(1481, 44, 698, 158, '新晃侗族自治县', 1),
(1482, 44, 698, 158, '芷江侗族自治县', 1),
(1483, 44, 698, 158, '靖州苗族侗族自治县', 1),
(1484, 44, 698, 158, '通道侗族自治县', 1),
(1485, 44, 698, 158, '洪江市', 1),
(1487, 44, 698, 159, '娄星区', 1),
(1488, 44, 698, 159, '双峰县', 1),
(1489, 44, 698, 159, '新化县', 1),
(1490, 44, 698, 159, '冷水江市', 1),
(1491, 44, 698, 159, '涟源市', 1),
(1492, 44, 698, 160, '吉首市', 1),
(1493, 44, 698, 160, '泸溪县', 1),
(1494, 44, 698, 160, '凤凰县', 1),
(1495, 44, 698, 160, '花垣县', 1),
(1496, 44, 698, 160, '保靖县', 1),
(1497, 44, 698, 160, '古丈县', 1),
(1498, 44, 698, 160, '永顺县', 1),
(1499, 44, 698, 160, '龙山县', 1),
(1501, 44, 699, 161, '新城区', 1),
(1502, 44, 699, 161, '回民区', 1),
(1503, 44, 699, 161, '玉泉区', 1),
(1504, 44, 699, 161, '赛罕区', 1),
(1505, 44, 699, 161, '土默特左旗', 1),
(1506, 44, 699, 161, '托克托县', 1),
(1507, 44, 699, 161, '和林格尔县', 1),
(1508, 44, 699, 161, '清水河县', 1),
(1509, 44, 699, 161, '武川县', 1),
(1511, 44, 699, 162, '东河区', 1),
(1512, 44, 699, 162, '昆都仑区', 1),
(1513, 44, 699, 162, '青山区', 1),
(1514, 44, 699, 162, '石拐区', 1),
(1515, 44, 699, 162, '白云矿区', 1),
(1516, 44, 699, 162, '九原区', 1),
(1517, 44, 699, 162, '土默特右旗', 1),
(1518, 44, 699, 162, '固阳县', 1),
(1519, 44, 699, 162, '达尔罕茂明安联合旗', 1),
(1521, 44, 699, 163, '海勃湾区', 1),
(1522, 44, 699, 163, '海南区', 1),
(1523, 44, 699, 163, '乌达区', 1),
(1525, 44, 699, 164, '红山区', 1),
(1526, 44, 699, 164, '元宝山区', 1),
(1527, 44, 699, 164, '松山区', 1),
(1528, 44, 699, 164, '阿鲁科尔沁旗', 1),
(1529, 44, 699, 164, '巴林左旗', 1),
(1530, 44, 699, 164, '巴林右旗', 1),
(1531, 44, 699, 164, '林西县', 1),
(1532, 44, 699, 164, '克什克腾旗', 1),
(1533, 44, 699, 164, '翁牛特旗', 1),
(1534, 44, 699, 164, '喀喇沁旗', 1),
(1535, 44, 699, 164, '宁城县', 1),
(1536, 44, 699, 164, '敖汉旗', 1),
(1538, 44, 699, 165, '科尔沁区', 1),
(1539, 44, 699, 165, '科尔沁左翼中旗', 1),
(1540, 44, 699, 165, '科尔沁左翼后旗', 1),
(1541, 44, 699, 165, '开鲁县', 1),
(1542, 44, 699, 165, '库伦旗', 1),
(1543, 44, 699, 165, '奈曼旗', 1),
(1544, 44, 699, 165, '扎鲁特旗', 1),
(1545, 44, 699, 165, '霍林郭勒市', 1),
(1546, 44, 699, 166, '东胜区', 1),
(1547, 44, 699, 166, '达拉特旗', 1),
(1548, 44, 699, 166, '准格尔旗', 1),
(1549, 44, 699, 166, '鄂托克前旗', 1),
(1550, 44, 699, 166, '鄂托克旗', 1),
(1551, 44, 699, 166, '杭锦旗', 1),
(1552, 44, 699, 166, '乌审旗', 1),
(1553, 44, 699, 166, '伊金霍洛旗', 1),
(1555, 44, 699, 167, '海拉尔区', 1),
(1556, 44, 699, 167, '阿荣旗', 1),
(1557, 44, 699, 167, '莫力达瓦达斡尔族自治旗', 1),
(1558, 44, 699, 167, '鄂伦春自治旗', 1),
(1559, 44, 699, 167, '鄂温克族自治旗', 1),
(1560, 44, 699, 167, '陈巴尔虎旗', 1),
(1561, 44, 699, 167, '新巴尔虎左旗', 1),
(1562, 44, 699, 167, '新巴尔虎右旗', 1),
(1563, 44, 699, 167, '满洲里市', 1),
(1564, 44, 699, 167, '牙克石市', 1),
(1565, 44, 699, 167, '扎兰屯市', 1),
(1566, 44, 699, 167, '额尔古纳市', 1),
(1567, 44, 699, 167, '根河市', 1),
(1569, 44, 699, 168, '临河区', 1),
(1570, 44, 699, 168, '五原县', 1),
(1571, 44, 699, 168, '磴口县', 1),
(1572, 44, 699, 168, '乌拉特前旗', 1),
(1573, 44, 699, 168, '乌拉特中旗', 1),
(1574, 44, 699, 168, '乌拉特后旗', 1),
(1575, 44, 699, 168, '杭锦后旗', 1),
(1577, 44, 699, 169, '集宁区', 1),
(1578, 44, 699, 169, '卓资县', 1),
(1579, 44, 699, 169, '化德县', 1),
(1580, 44, 699, 169, '商都县', 1),
(1581, 44, 699, 169, '兴和县', 1),
(1582, 44, 699, 169, '凉城县', 1),
(1583, 44, 699, 169, '察哈尔右翼前旗', 1),
(1584, 44, 699, 169, '察哈尔右翼中旗', 1),
(1585, 44, 699, 169, '察哈尔右翼后旗', 1),
(1586, 44, 699, 169, '四子王旗', 1),
(1587, 44, 699, 169, '丰镇市', 1),
(1588, 44, 699, 170, '乌兰浩特市', 1),
(1589, 44, 699, 170, '阿尔山市', 1),
(1590, 44, 699, 170, '科尔沁右翼前旗', 1),
(1591, 44, 699, 170, '科尔沁右翼中旗', 1),
(1592, 44, 699, 170, '扎赉特旗', 1),
(1593, 44, 699, 170, '突泉县', 1),
(1594, 44, 699, 171, '二连浩特市', 1),
(1595, 44, 699, 171, '锡林浩特市', 1),
(1596, 44, 699, 171, '阿巴嘎旗', 1),
(1597, 44, 699, 171, '苏尼特左旗', 1),
(1598, 44, 699, 171, '苏尼特右旗', 1),
(1599, 44, 699, 171, '东乌珠穆沁旗', 1),
(1600, 44, 699, 171, '西乌珠穆沁旗', 1),
(1601, 44, 699, 171, '太仆寺旗', 1),
(1602, 44, 699, 171, '镶黄旗', 1),
(1603, 44, 699, 171, '正镶白旗', 1),
(1604, 44, 699, 171, '正蓝旗', 1),
(1605, 44, 699, 171, '多伦县', 1),
(1606, 44, 699, 172, '阿拉善左旗', 1),
(1607, 44, 699, 172, '阿拉善右旗', 1),
(1608, 44, 699, 172, '额济纳旗', 1),
(1610, 44, 700, 173, '玄武区', 1),
(1611, 44, 700, 173, '白下区', 1),
(1612, 44, 700, 173, '秦淮区', 1),
(1613, 44, 700, 173, '建邺区', 1),
(1614, 44, 700, 173, '鼓楼区', 1),
(1615, 44, 700, 173, '下关区', 1),
(1616, 44, 700, 173, '浦口区', 1),
(1617, 44, 700, 173, '栖霞区', 1),
(1618, 44, 700, 173, '雨花台区', 1),
(1619, 44, 700, 173, '江宁区', 1),
(1620, 44, 700, 173, '六合区', 1),
(1621, 44, 700, 173, '溧水县', 1),
(1622, 44, 700, 173, '高淳县', 1),
(1624, 44, 700, 174, '崇安区', 1),
(1625, 44, 700, 174, '南长区', 1),
(1626, 44, 700, 174, '北塘区', 1),
(1627, 44, 700, 174, '锡山区', 1),
(1628, 44, 700, 174, '惠山区', 1),
(1629, 44, 700, 174, '滨湖区', 1),
(1630, 44, 700, 174, '江阴市', 1),
(1631, 44, 700, 174, '宜兴市', 1),
(1633, 44, 700, 175, '鼓楼区', 1),
(1634, 44, 700, 175, '云龙区', 1),
(1635, 44, 700, 175, '九里区', 1),
(1636, 44, 700, 175, '贾汪区', 1),
(1637, 44, 700, 175, '泉山区', 1),
(1638, 44, 700, 175, '丰　县', 1),
(1639, 44, 700, 175, '沛　县', 1),
(1640, 44, 700, 175, '铜山县', 1),
(1641, 44, 700, 175, '睢宁县', 1),
(1642, 44, 700, 175, '新沂市', 1),
(1643, 44, 700, 175, '邳州市', 1),
(1645, 44, 700, 176, '天宁区', 1),
(1646, 44, 700, 176, '钟楼区', 1),
(1647, 44, 700, 176, '戚墅堰区', 1),
(1648, 44, 700, 176, '新北区', 1),
(1649, 44, 700, 176, '武进区', 1),
(1650, 44, 700, 176, '溧阳市', 1),
(1651, 44, 700, 176, '金坛市', 1),
(1653, 44, 700, 177, '沧浪区', 1),
(1654, 44, 700, 177, '平江区', 1),
(1655, 44, 700, 177, '金阊区', 1),
(1656, 44, 700, 177, '虎丘区', 1),
(1657, 44, 700, 177, '吴中区', 1),
(1658, 44, 700, 177, '相城区', 1),
(1659, 44, 700, 177, '常熟市', 1),
(1660, 44, 700, 177, '张家港市', 1),
(1661, 44, 700, 177, '昆山市', 1),
(1662, 44, 700, 177, '吴江市', 1),
(1663, 44, 700, 177, '太仓市', 1),
(1665, 44, 700, 178, '崇川区', 1),
(1666, 44, 700, 178, '港闸区', 1),
(1667, 44, 700, 178, '海安县', 1),
(1668, 44, 700, 178, '如东县', 1),
(1669, 44, 700, 178, '启东市', 1),
(1670, 44, 700, 178, '如皋市', 1),
(1671, 44, 700, 178, '通州市', 1),
(1672, 44, 700, 178, '海门市', 1),
(1674, 44, 700, 179, '连云区', 1),
(1675, 44, 700, 179, '新浦区', 1),
(1676, 44, 700, 179, '海州区', 1),
(1677, 44, 700, 179, '赣榆县', 1),
(1678, 44, 700, 179, '东海县', 1),
(1679, 44, 700, 179, '灌云县', 1),
(1680, 44, 700, 179, '灌南县', 1),
(1682, 44, 700, 180, '清河区', 1),
(1683, 44, 700, 180, '楚州区', 1),
(1684, 44, 700, 180, '淮阴区', 1),
(1685, 44, 700, 180, '清浦区', 1),
(1686, 44, 700, 180, '涟水县', 1),
(1687, 44, 700, 180, '洪泽县', 1),
(1688, 44, 700, 180, '盱眙县', 1),
(1689, 44, 700, 180, '金湖县', 1),
(1691, 44, 700, 181, '亭湖区', 1),
(1692, 44, 700, 181, '盐都区', 1),
(1693, 44, 700, 181, '响水县', 1),
(1694, 44, 700, 181, '滨海县', 1),
(1695, 44, 700, 181, '阜宁县', 1),
(1696, 44, 700, 181, '射阳县', 1),
(1697, 44, 700, 181, '建湖县', 1),
(1698, 44, 700, 181, '东台市', 1),
(1699, 44, 700, 181, '大丰市', 1),
(1701, 44, 700, 182, '广陵区', 1),
(1702, 44, 700, 182, '邗江区', 1),
(1703, 44, 700, 182, '郊　区', 1),
(1704, 44, 700, 182, '宝应县', 1),
(1705, 44, 700, 182, '仪征市', 1),
(1706, 44, 700, 182, '高邮市', 1),
(1707, 44, 700, 182, '江都市', 1),
(1709, 44, 700, 183, '京口区', 1),
(1710, 44, 700, 183, '润州区', 1),
(1711, 44, 700, 183, '丹徒区', 1),
(1712, 44, 700, 183, '丹阳市', 1),
(1713, 44, 700, 183, '扬中市', 1),
(1714, 44, 700, 183, '句容市', 1),
(1716, 44, 700, 184, '海陵区', 1),
(1717, 44, 700, 184, '高港区', 1),
(1718, 44, 700, 184, '兴化市', 1),
(1719, 44, 700, 184, '靖江市', 1),
(1720, 44, 700, 184, '泰兴市', 1),
(1721, 44, 700, 184, '姜堰市', 1),
(1723, 44, 700, 185, '宿城区', 1),
(1724, 44, 700, 185, '宿豫区', 1),
(1725, 44, 700, 185, '沭阳县', 1),
(1726, 44, 700, 185, '泗阳县', 1),
(1727, 44, 700, 185, '泗洪县', 1),
(1729, 44, 701, 186, '东湖区', 1),
(1730, 44, 701, 186, '西湖区', 1),
(1731, 44, 701, 186, '青云谱区', 1),
(1732, 44, 701, 186, '湾里区', 1),
(1733, 44, 701, 186, '青山湖区', 1),
(1734, 44, 701, 186, '南昌县', 1),
(1735, 44, 701, 186, '新建县', 1),
(1736, 44, 701, 186, '安义县', 1),
(1737, 44, 701, 186, '进贤县', 1),
(1739, 44, 701, 187, '昌江区', 1),
(1740, 44, 701, 187, '珠山区', 1),
(1741, 44, 701, 187, '浮梁县', 1),
(1742, 44, 701, 187, '乐平市', 1),
(1744, 44, 701, 188, '安源区', 1),
(1745, 44, 701, 188, '湘东区', 1),
(1746, 44, 701, 188, '莲花县', 1),
(1747, 44, 701, 188, '上栗县', 1),
(1748, 44, 701, 188, '芦溪县', 1),
(1750, 44, 701, 189, '庐山区', 1),
(1751, 44, 701, 189, '浔阳区', 1),
(1752, 44, 701, 189, '九江县', 1),
(1753, 44, 701, 189, '武宁县', 1),
(1754, 44, 701, 189, '修水县', 1),
(1755, 44, 701, 189, '永修县', 1),
(1756, 44, 701, 189, '德安县', 1),
(1757, 44, 701, 189, '星子县', 1),
(1758, 44, 701, 189, '都昌县', 1),
(1759, 44, 701, 189, '湖口县', 1),
(1760, 44, 701, 189, '彭泽县', 1),
(1761, 44, 701, 189, '瑞昌市', 1),
(1763, 44, 701, 190, '渝水区', 1),
(1764, 44, 701, 190, '分宜县', 1),
(1766, 44, 701, 191, '月湖区', 1),
(1767, 44, 701, 191, '余江县', 1),
(1768, 44, 701, 191, '贵溪市', 1),
(1770, 44, 701, 192, '章贡区', 1),
(1771, 44, 701, 192, '赣　县', 1),
(1772, 44, 701, 192, '信丰县', 1),
(1773, 44, 701, 192, '大余县', 1),
(1774, 44, 701, 192, '上犹县', 1),
(1775, 44, 701, 192, '崇义县', 1),
(1776, 44, 701, 192, '安远县', 1),
(1777, 44, 701, 192, '龙南县', 1),
(1778, 44, 701, 192, '定南县', 1),
(1779, 44, 701, 192, '全南县', 1),
(1780, 44, 701, 192, '宁都县', 1),
(1781, 44, 701, 192, '于都县', 1),
(1782, 44, 701, 192, '兴国县', 1),
(1783, 44, 701, 192, '会昌县', 1),
(1784, 44, 701, 192, '寻乌县', 1),
(1785, 44, 701, 192, '石城县', 1),
(1786, 44, 701, 192, '瑞金市', 1),
(1787, 44, 701, 192, '南康市', 1),
(1789, 44, 701, 193, '吉州区', 1),
(1790, 44, 701, 193, '青原区', 1),
(1791, 44, 701, 193, '吉安县', 1),
(1792, 44, 701, 193, '吉水县', 1),
(1793, 44, 701, 193, '峡江县', 1),
(1794, 44, 701, 193, '新干县', 1),
(1795, 44, 701, 193, '永丰县', 1),
(1796, 44, 701, 193, '泰和县', 1),
(1797, 44, 701, 193, '遂川县', 1),
(1798, 44, 701, 193, '万安县', 1),
(1799, 44, 701, 193, '安福县', 1),
(1800, 44, 701, 193, '永新县', 1),
(1801, 44, 701, 193, '井冈山市', 1),
(1803, 44, 701, 194, '袁州区', 1),
(1804, 44, 701, 194, '奉新县', 1),
(1805, 44, 701, 194, '万载县', 1),
(1806, 44, 701, 194, '上高县', 1),
(1807, 44, 701, 194, '宜丰县', 1),
(1808, 44, 701, 194, '靖安县', 1),
(1809, 44, 701, 194, '铜鼓县', 1),
(1810, 44, 701, 194, '丰城市', 1),
(1811, 44, 701, 194, '樟树市', 1),
(1812, 44, 701, 194, '高安市', 1),
(1814, 44, 701, 195, '临川区', 1),
(1815, 44, 701, 195, '南城县', 1),
(1816, 44, 701, 195, '黎川县', 1),
(1817, 44, 701, 195, '南丰县', 1),
(1818, 44, 701, 195, '崇仁县', 1),
(1819, 44, 701, 195, '乐安县', 1),
(1820, 44, 701, 195, '宜黄县', 1),
(1821, 44, 701, 195, '金溪县', 1),
(1822, 44, 701, 195, '资溪县', 1),
(1823, 44, 701, 195, '东乡县', 1),
(1824, 44, 701, 195, '广昌县', 1),
(1826, 44, 701, 196, '信州区', 1),
(1827, 44, 701, 196, '上饶县', 1),
(1828, 44, 701, 196, '广丰县', 1),
(1829, 44, 701, 196, '玉山县', 1),
(1830, 44, 701, 196, '铅山县', 1),
(1831, 44, 701, 196, '横峰县', 1),
(1832, 44, 701, 196, '弋阳县', 1),
(1833, 44, 701, 196, '余干县', 1),
(1834, 44, 701, 196, '鄱阳县', 1),
(1835, 44, 701, 196, '万年县', 1),
(1836, 44, 701, 196, '婺源县', 1),
(1837, 44, 701, 196, '德兴市', 1),
(1839, 44, 702, 197, '南关区', 1),
(1840, 44, 702, 197, '宽城区', 1),
(1841, 44, 702, 197, '朝阳区', 1),
(1842, 44, 702, 197, '二道区', 1),
(1843, 44, 702, 197, '绿园区', 1),
(1844, 44, 702, 197, '双阳区', 1),
(1845, 44, 702, 197, '农安县', 1),
(1846, 44, 702, 197, '九台市', 1),
(1847, 44, 702, 197, '榆树市', 1),
(1848, 44, 702, 197, '德惠市', 1),
(1850, 44, 702, 198, '昌邑区', 1),
(1851, 44, 702, 198, '龙潭区', 1),
(1852, 44, 702, 198, '船营区', 1),
(1853, 44, 702, 198, '丰满区', 1),
(1854, 44, 702, 198, '永吉县', 1),
(1855, 44, 702, 198, '蛟河市', 1),
(1856, 44, 702, 198, '桦甸市', 1),
(1857, 44, 702, 198, '舒兰市', 1),
(1858, 44, 702, 198, '磐石市', 1),
(1860, 44, 702, 199, '铁西区', 1),
(1861, 44, 702, 199, '铁东区', 1),
(1862, 44, 702, 199, '梨树县', 1),
(1863, 44, 702, 199, '伊通满族自治县', 1),
(1864, 44, 702, 199, '公主岭市', 1),
(1865, 44, 702, 199, '双辽市', 1),
(1867, 44, 702, 200, '龙山区', 1),
(1868, 44, 702, 200, '西安区', 1),
(1869, 44, 702, 200, '东丰县', 1),
(1870, 44, 702, 200, '东辽县', 1),
(1872, 44, 702, 201, '东昌区', 1),
(1873, 44, 702, 201, '二道江区', 1),
(1874, 44, 702, 201, '通化县', 1),
(1875, 44, 702, 201, '辉南县', 1),
(1876, 44, 702, 201, '柳河县', 1),
(1877, 44, 702, 201, '梅河口市', 1),
(1878, 44, 702, 201, '集安市', 1),
(1880, 44, 702, 202, '八道江区', 1),
(1881, 44, 702, 202, '抚松县', 1),
(1882, 44, 702, 202, '靖宇县', 1),
(1883, 44, 702, 202, '长白朝鲜族自治县', 1),
(1884, 44, 702, 202, '江源县', 1),
(1885, 44, 702, 202, '临江市', 1),
(1887, 44, 702, 203, '宁江区', 1);
INSERT INTO `mcc_district` (`district_id`, `country_id`, `zone_id`, `city_id`, `name`, `status`) VALUES
(1888, 44, 702, 203, '前郭尔罗斯蒙古族自治县', 1),
(1889, 44, 702, 203, '长岭县', 1),
(1890, 44, 702, 203, '乾安县', 1),
(1891, 44, 702, 203, '扶余县', 1),
(1893, 44, 702, 204, '洮北区', 1),
(1894, 44, 702, 204, '镇赉县', 1),
(1895, 44, 702, 204, '通榆县', 1),
(1896, 44, 702, 204, '洮南市', 1),
(1897, 44, 702, 204, '大安市', 1),
(1898, 44, 702, 205, '延吉市', 1),
(1899, 44, 702, 205, '图们市', 1),
(1900, 44, 702, 205, '敦化市', 1),
(1901, 44, 702, 205, '珲春市', 1),
(1902, 44, 702, 205, '龙井市', 1),
(1903, 44, 702, 205, '和龙市', 1),
(1904, 44, 702, 205, '汪清县', 1),
(1905, 44, 702, 205, '安图县', 1),
(1907, 44, 703, 206, '和平区', 1),
(1908, 44, 703, 206, '沈河区', 1),
(1909, 44, 703, 206, '大东区', 1),
(1910, 44, 703, 206, '皇姑区', 1),
(1911, 44, 703, 206, '铁西区', 1),
(1912, 44, 703, 206, '苏家屯区', 1),
(1913, 44, 703, 206, '东陵区', 1),
(1914, 44, 703, 206, '新城子区', 1),
(1915, 44, 703, 206, '于洪区', 1),
(1916, 44, 703, 206, '辽中县', 1),
(1917, 44, 703, 206, '康平县', 1),
(1918, 44, 703, 206, '法库县', 1),
(1919, 44, 703, 206, '新民市', 1),
(1921, 44, 703, 207, '中山区', 1),
(1922, 44, 703, 207, '西岗区', 1),
(1923, 44, 703, 207, '沙河口区', 1),
(1924, 44, 703, 207, '甘井子区', 1),
(1925, 44, 703, 207, '旅顺口区', 1),
(1926, 44, 703, 207, '金州区', 1),
(1927, 44, 703, 207, '长海县', 1),
(1928, 44, 703, 207, '瓦房店市', 1),
(1929, 44, 703, 207, '普兰店市', 1),
(1930, 44, 703, 207, '庄河市', 1),
(1932, 44, 703, 208, '铁东区', 1),
(1933, 44, 703, 208, '铁西区', 1),
(1934, 44, 703, 208, '立山区', 1),
(1935, 44, 703, 208, '千山区', 1),
(1936, 44, 703, 208, '台安县', 1),
(1937, 44, 703, 208, '岫岩满族自治县', 1),
(1938, 44, 703, 208, '海城市', 1),
(1940, 44, 703, 209, '新抚区', 1),
(1941, 44, 703, 209, '东洲区', 1),
(1942, 44, 703, 209, '望花区', 1),
(1943, 44, 703, 209, '顺城区', 1),
(1944, 44, 703, 209, '抚顺县', 1),
(1945, 44, 703, 209, '新宾满族自治县', 1),
(1946, 44, 703, 209, '清原满族自治县', 1),
(1948, 44, 703, 210, '平山区', 1),
(1949, 44, 703, 210, '溪湖区', 1),
(1950, 44, 703, 210, '明山区', 1),
(1951, 44, 703, 210, '南芬区', 1),
(1952, 44, 703, 210, '本溪满族自治县', 1),
(1953, 44, 703, 210, '桓仁满族自治县', 1),
(1955, 44, 703, 211, '元宝区', 1),
(1956, 44, 703, 211, '振兴区', 1),
(1957, 44, 703, 211, '振安区', 1),
(1958, 44, 703, 211, '宽甸满族自治县', 1),
(1959, 44, 703, 211, '东港市', 1),
(1960, 44, 703, 211, '凤城市', 1),
(1962, 44, 703, 212, '古塔区', 1),
(1963, 44, 703, 212, '凌河区', 1),
(1964, 44, 703, 212, '太和区', 1),
(1965, 44, 703, 212, '黑山县', 1),
(1966, 44, 703, 212, '义　县', 1),
(1967, 44, 703, 212, '凌海市', 1),
(1968, 44, 703, 212, '北宁市', 1),
(1970, 44, 703, 213, '站前区', 1),
(1971, 44, 703, 213, '西市区', 1),
(1972, 44, 703, 213, '鲅鱼圈区', 1),
(1973, 44, 703, 213, '老边区', 1),
(1974, 44, 703, 213, '盖州市', 1),
(1975, 44, 703, 213, '大石桥市', 1),
(1977, 44, 703, 214, '海州区', 1),
(1978, 44, 703, 214, '新邱区', 1),
(1979, 44, 703, 214, '太平区', 1),
(1980, 44, 703, 214, '清河门区', 1),
(1981, 44, 703, 214, '细河区', 1),
(1982, 44, 703, 214, '阜新蒙古族自治县', 1),
(1983, 44, 703, 214, '彰武县', 1),
(1985, 44, 703, 215, '白塔区', 1),
(1986, 44, 703, 215, '文圣区', 1),
(1987, 44, 703, 215, '宏伟区', 1),
(1988, 44, 703, 215, '弓长岭区', 1),
(1989, 44, 703, 215, '太子河区', 1),
(1990, 44, 703, 215, '辽阳县', 1),
(1991, 44, 703, 215, '灯塔市', 1),
(1993, 44, 703, 216, '双台子区', 1),
(1994, 44, 703, 216, '兴隆台区', 1),
(1995, 44, 703, 216, '大洼县', 1),
(1996, 44, 703, 216, '盘山县', 1),
(1998, 44, 703, 217, '银州区', 1),
(1999, 44, 703, 217, '清河区', 1),
(2000, 44, 703, 217, '铁岭县', 1),
(2001, 44, 703, 217, '西丰县', 1),
(2002, 44, 703, 217, '昌图县', 1),
(2003, 44, 703, 217, '调兵山市', 1),
(2004, 44, 703, 217, '开原市', 1),
(2006, 44, 703, 218, '双塔区', 1),
(2007, 44, 703, 218, '龙城区', 1),
(2008, 44, 703, 218, '朝阳县', 1),
(2009, 44, 703, 218, '建平县', 1),
(2010, 44, 703, 218, '喀喇沁左翼蒙古族自治县', 1),
(2011, 44, 703, 218, '北票市', 1),
(2012, 44, 703, 218, '凌源市', 1),
(2014, 44, 703, 219, '连山区', 1),
(2015, 44, 703, 219, '龙港区', 1),
(2016, 44, 703, 219, '南票区', 1),
(2017, 44, 703, 219, '绥中县', 1),
(2018, 44, 703, 219, '建昌县', 1),
(2019, 44, 703, 219, '兴城市', 1),
(2021, 44, 705, 220, '兴庆区', 1),
(2022, 44, 705, 220, '西夏区', 1),
(2023, 44, 705, 220, '金凤区', 1),
(2024, 44, 705, 220, '永宁县', 1),
(2025, 44, 705, 220, '贺兰县', 1),
(2026, 44, 705, 220, '灵武市', 1),
(2028, 44, 705, 221, '大武口区', 1),
(2029, 44, 705, 221, '惠农区', 1),
(2030, 44, 705, 221, '平罗县', 1),
(2032, 44, 705, 222, '利通区', 1),
(2033, 44, 705, 222, '盐池县', 1),
(2034, 44, 705, 222, '同心县', 1),
(2035, 44, 705, 222, '青铜峡市', 1),
(2037, 44, 705, 223, '原州区', 1),
(2038, 44, 705, 223, '西吉县', 1),
(2039, 44, 705, 223, '隆德县', 1),
(2040, 44, 705, 223, '泾源县', 1),
(2041, 44, 705, 223, '彭阳县', 1),
(2043, 44, 705, 224, '沙坡头区', 1),
(2044, 44, 705, 224, '中宁县', 1),
(2045, 44, 705, 224, '海原县', 1),
(2047, 44, 706, 225, '新城区', 1),
(2048, 44, 706, 225, '碑林区', 1),
(2049, 44, 706, 225, '莲湖区', 1),
(2050, 44, 706, 225, '灞桥区', 1),
(2051, 44, 706, 225, '未央区', 1),
(2052, 44, 706, 225, '雁塔区', 1),
(2053, 44, 706, 225, '阎良区', 1),
(2054, 44, 706, 225, '临潼区', 1),
(2055, 44, 706, 225, '长安区', 1),
(2056, 44, 706, 225, '蓝田县', 1),
(2057, 44, 706, 225, '周至县', 1),
(2058, 44, 706, 225, '户　县', 1),
(2059, 44, 706, 225, '高陵县', 1),
(2061, 44, 706, 226, '王益区', 1),
(2062, 44, 706, 226, '印台区', 1),
(2063, 44, 706, 226, '耀州区', 1),
(2064, 44, 706, 226, '宜君县', 1),
(2066, 44, 706, 227, '渭滨区', 1),
(2067, 44, 706, 227, '金台区', 1),
(2068, 44, 706, 227, '陈仓区', 1),
(2069, 44, 706, 227, '凤翔县', 1),
(2070, 44, 706, 227, '岐山县', 1),
(2071, 44, 706, 227, '扶风县', 1),
(2072, 44, 706, 227, '眉　县', 1),
(2073, 44, 706, 227, '陇　县', 1),
(2074, 44, 706, 227, '千阳县', 1),
(2075, 44, 706, 227, '麟游县', 1),
(2076, 44, 706, 227, '凤　县', 1),
(2077, 44, 706, 227, '太白县', 1),
(2079, 44, 706, 228, '秦都区', 1),
(2080, 44, 706, 228, '杨凌区', 1),
(2081, 44, 706, 228, '渭城区', 1),
(2082, 44, 706, 228, '三原县', 1),
(2083, 44, 706, 228, '泾阳县', 1),
(2084, 44, 706, 228, '乾　县', 1),
(2085, 44, 706, 228, '礼泉县', 1),
(2086, 44, 706, 228, '永寿县', 1),
(2087, 44, 706, 228, '彬　县', 1),
(2088, 44, 706, 228, '长武县', 1),
(2089, 44, 706, 228, '旬邑县', 1),
(2090, 44, 706, 228, '淳化县', 1),
(2091, 44, 706, 228, '武功县', 1),
(2092, 44, 706, 228, '兴平市', 1),
(2094, 44, 706, 229, '临渭区', 1),
(2095, 44, 706, 229, '华　县', 1),
(2096, 44, 706, 229, '潼关县', 1),
(2097, 44, 706, 229, '大荔县', 1),
(2098, 44, 706, 229, '合阳县', 1),
(2099, 44, 706, 229, '澄城县', 1),
(2100, 44, 706, 229, '蒲城县', 1),
(2101, 44, 706, 229, '白水县', 1),
(2102, 44, 706, 229, '富平县', 1),
(2103, 44, 706, 229, '韩城市', 1),
(2104, 44, 706, 229, '华阴市', 1),
(2106, 44, 706, 230, '宝塔区', 1),
(2107, 44, 706, 230, '延长县', 1),
(2108, 44, 706, 230, '延川县', 1),
(2109, 44, 706, 230, '子长县', 1),
(2110, 44, 706, 230, '安塞县', 1),
(2111, 44, 706, 230, '志丹县', 1),
(2112, 44, 706, 230, '吴旗县', 1),
(2113, 44, 706, 230, '甘泉县', 1),
(2114, 44, 706, 230, '富　县', 1),
(2115, 44, 706, 230, '洛川县', 1),
(2116, 44, 706, 230, '宜川县', 1),
(2117, 44, 706, 230, '黄龙县', 1),
(2118, 44, 706, 230, '黄陵县', 1),
(2120, 44, 706, 231, '汉台区', 1),
(2121, 44, 706, 231, '南郑县', 1),
(2122, 44, 706, 231, '城固县', 1),
(2123, 44, 706, 231, '洋　县', 1),
(2124, 44, 706, 231, '西乡县', 1),
(2125, 44, 706, 231, '勉　县', 1),
(2126, 44, 706, 231, '宁强县', 1),
(2127, 44, 706, 231, '略阳县', 1),
(2128, 44, 706, 231, '镇巴县', 1),
(2129, 44, 706, 231, '留坝县', 1),
(2130, 44, 706, 231, '佛坪县', 1),
(2132, 44, 706, 232, '榆阳区', 1),
(2133, 44, 706, 232, '神木县', 1),
(2134, 44, 706, 232, '府谷县', 1),
(2135, 44, 706, 232, '横山县', 1),
(2136, 44, 706, 232, '靖边县', 1),
(2137, 44, 706, 232, '定边县', 1),
(2138, 44, 706, 232, '绥德县', 1),
(2139, 44, 706, 232, '米脂县', 1),
(2140, 44, 706, 232, '佳　县', 1),
(2141, 44, 706, 232, '吴堡县', 1),
(2142, 44, 706, 232, '清涧县', 1),
(2143, 44, 706, 232, '子洲县', 1),
(2145, 44, 706, 233, '汉滨区', 1),
(2146, 44, 706, 233, '汉阴县', 1),
(2147, 44, 706, 233, '石泉县', 1),
(2148, 44, 706, 233, '宁陕县', 1),
(2149, 44, 706, 233, '紫阳县', 1),
(2150, 44, 706, 233, '岚皋县', 1),
(2151, 44, 706, 233, '平利县', 1),
(2152, 44, 706, 233, '镇坪县', 1),
(2153, 44, 706, 233, '旬阳县', 1),
(2154, 44, 706, 233, '白河县', 1),
(2156, 44, 706, 234, '商州区', 1),
(2157, 44, 706, 234, '洛南县', 1),
(2158, 44, 706, 234, '丹凤县', 1),
(2159, 44, 706, 234, '商南县', 1),
(2160, 44, 706, 234, '山阳县', 1),
(2161, 44, 706, 234, '镇安县', 1),
(2162, 44, 706, 234, '柞水县', 1),
(2164, 44, 707, 235, '历下区', 1),
(2165, 44, 707, 235, '市中区', 1),
(2166, 44, 707, 235, '槐荫区', 1),
(2167, 44, 707, 235, '天桥区', 1),
(2168, 44, 707, 235, '历城区', 1),
(2169, 44, 707, 235, '长清区', 1),
(2170, 44, 707, 235, '平阴县', 1),
(2171, 44, 707, 235, '济阳县', 1),
(2172, 44, 707, 235, '商河县', 1),
(2173, 44, 707, 235, '章丘市', 1),
(2175, 44, 707, 236, '市南区', 1),
(2176, 44, 707, 236, '市北区', 1),
(2177, 44, 707, 236, '四方区', 1),
(2178, 44, 707, 236, '黄岛区', 1),
(2179, 44, 707, 236, '崂山区', 1),
(2180, 44, 707, 236, '李沧区', 1),
(2181, 44, 707, 236, '城阳区', 1),
(2182, 44, 707, 236, '胶州市', 1),
(2183, 44, 707, 236, '即墨市', 1),
(2184, 44, 707, 236, '平度市', 1),
(2185, 44, 707, 236, '胶南市', 1),
(2186, 44, 707, 236, '莱西市', 1),
(2188, 44, 707, 237, '淄川区', 1),
(2189, 44, 707, 237, '张店区', 1),
(2190, 44, 707, 237, '博山区', 1),
(2191, 44, 707, 237, '临淄区', 1),
(2192, 44, 707, 237, '周村区', 1),
(2193, 44, 707, 237, '桓台县', 1),
(2194, 44, 707, 237, '高青县', 1),
(2195, 44, 707, 237, '沂源县', 1),
(2197, 44, 707, 238, '市中区', 1),
(2198, 44, 707, 238, '薛城区', 1),
(2199, 44, 707, 238, '峄城区', 1),
(2200, 44, 707, 238, '台儿庄区', 1),
(2201, 44, 707, 238, '山亭区', 1),
(2202, 44, 707, 238, '滕州市', 1),
(2204, 44, 707, 239, '东营区', 1),
(2205, 44, 707, 239, '河口区', 1),
(2206, 44, 707, 239, '垦利县', 1),
(2207, 44, 707, 239, '利津县', 1),
(2208, 44, 707, 239, '广饶县', 1),
(2210, 44, 707, 240, '芝罘区', 1),
(2211, 44, 707, 240, '福山区', 1),
(2212, 44, 707, 240, '牟平区', 1),
(2213, 44, 707, 240, '莱山区', 1),
(2214, 44, 707, 240, '长岛县', 1),
(2215, 44, 707, 240, '龙口市', 1),
(2216, 44, 707, 240, '莱阳市', 1),
(2217, 44, 707, 240, '莱州市', 1),
(2218, 44, 707, 240, '蓬莱市', 1),
(2219, 44, 707, 240, '招远市', 1),
(2220, 44, 707, 240, '栖霞市', 1),
(2221, 44, 707, 240, '海阳市', 1),
(2223, 44, 707, 241, '潍城区', 1),
(2224, 44, 707, 241, '寒亭区', 1),
(2225, 44, 707, 241, '坊子区', 1),
(2226, 44, 707, 241, '奎文区', 1),
(2227, 44, 707, 241, '临朐县', 1),
(2228, 44, 707, 241, '昌乐县', 1),
(2229, 44, 707, 241, '青州市', 1),
(2230, 44, 707, 241, '诸城市', 1),
(2231, 44, 707, 241, '寿光市', 1),
(2232, 44, 707, 241, '安丘市', 1),
(2233, 44, 707, 241, '高密市', 1),
(2234, 44, 707, 241, '昌邑市', 1),
(2236, 44, 707, 242, '市中区', 1),
(2237, 44, 707, 242, '任城区', 1),
(2238, 44, 707, 242, '微山县', 1),
(2239, 44, 707, 242, '鱼台县', 1),
(2240, 44, 707, 242, '金乡县', 1),
(2241, 44, 707, 242, '嘉祥县', 1),
(2242, 44, 707, 242, '汶上县', 1),
(2243, 44, 707, 242, '泗水县', 1),
(2244, 44, 707, 242, '梁山县', 1),
(2245, 44, 707, 242, '曲阜市', 1),
(2246, 44, 707, 242, '兖州市', 1),
(2247, 44, 707, 242, '邹城市', 1),
(2249, 44, 707, 243, '泰山区', 1),
(2250, 44, 707, 243, '岱岳区', 1),
(2251, 44, 707, 243, '宁阳县', 1),
(2252, 44, 707, 243, '东平县', 1),
(2253, 44, 707, 243, '新泰市', 1),
(2254, 44, 707, 243, '肥城市', 1),
(2256, 44, 707, 244, '环翠区', 1),
(2257, 44, 707, 244, '文登市', 1),
(2258, 44, 707, 244, '荣成市', 1),
(2259, 44, 707, 244, '乳山市', 1),
(2261, 44, 707, 245, '东港区', 1),
(2262, 44, 707, 245, '岚山区', 1),
(2263, 44, 707, 245, '五莲县', 1),
(2264, 44, 707, 245, '莒　县', 1),
(2266, 44, 707, 246, '莱城区', 1),
(2267, 44, 707, 246, '钢城区', 1),
(2269, 44, 707, 247, '兰山区', 1),
(2270, 44, 707, 247, '罗庄区', 1),
(2271, 44, 707, 247, '河东区', 1),
(2272, 44, 707, 247, '沂南县', 1),
(2273, 44, 707, 247, '郯城县', 1),
(2274, 44, 707, 247, '沂水县', 1),
(2275, 44, 707, 247, '苍山县', 1),
(2276, 44, 707, 247, '费　县', 1),
(2277, 44, 707, 247, '平邑县', 1),
(2278, 44, 707, 247, '莒南县', 1),
(2279, 44, 707, 247, '蒙阴县', 1),
(2280, 44, 707, 247, '临沭县', 1),
(2282, 44, 707, 248, '德城区', 1),
(2283, 44, 707, 248, '陵　县', 1),
(2284, 44, 707, 248, '宁津县', 1),
(2285, 44, 707, 248, '庆云县', 1),
(2286, 44, 707, 248, '临邑县', 1),
(2287, 44, 707, 248, '齐河县', 1),
(2288, 44, 707, 248, '平原县', 1),
(2289, 44, 707, 248, '夏津县', 1),
(2290, 44, 707, 248, '武城县', 1),
(2291, 44, 707, 248, '乐陵市', 1),
(2292, 44, 707, 248, '禹城市', 1),
(2294, 44, 707, 249, '东昌府区', 1),
(2295, 44, 707, 249, '阳谷县', 1),
(2296, 44, 707, 249, '莘　县', 1),
(2297, 44, 707, 249, '茌平县', 1),
(2298, 44, 707, 249, '东阿县', 1),
(2299, 44, 707, 249, '冠　县', 1),
(2300, 44, 707, 249, '高唐县', 1),
(2301, 44, 707, 249, '临清市', 1),
(2303, 44, 707, 250, '滨城区', 1),
(2304, 44, 707, 250, '惠民县', 1),
(2305, 44, 707, 250, '阳信县', 1),
(2306, 44, 707, 250, '无棣县', 1),
(2307, 44, 707, 250, '沾化县', 1),
(2308, 44, 707, 250, '博兴县', 1),
(2309, 44, 707, 250, '邹平县', 1),
(2311, 44, 707, 251, '牡丹区', 1),
(2312, 44, 707, 251, '曹　县', 1),
(2313, 44, 707, 251, '单　县', 1),
(2314, 44, 707, 251, '成武县', 1),
(2315, 44, 707, 251, '巨野县', 1),
(2316, 44, 707, 251, '郓城县', 1),
(2317, 44, 707, 251, '鄄城县', 1),
(2318, 44, 707, 251, '定陶县', 1),
(2319, 44, 707, 251, '东明县', 1),
(2320, 44, 708, 252, '黄浦区', 1),
(2321, 44, 708, 252, '卢湾区', 1),
(2322, 44, 708, 252, '徐汇区', 1),
(2323, 44, 708, 252, '长宁区', 1),
(2324, 44, 708, 252, '静安区', 1),
(2325, 44, 708, 252, '普陀区', 1),
(2326, 44, 708, 252, '闸北区', 1),
(2327, 44, 708, 252, '虹口区', 1),
(2328, 44, 708, 252, '杨浦区', 1),
(2329, 44, 708, 252, '闵行区', 1),
(2330, 44, 708, 252, '宝山区', 1),
(2331, 44, 708, 252, '嘉定区', 1),
(2332, 44, 708, 252, '浦东新区', 1),
(2333, 44, 708, 252, '金山区', 1),
(2334, 44, 708, 252, '松江区', 1),
(2335, 44, 708, 252, '青浦区', 1),
(2336, 44, 708, 252, '南汇区', 1),
(2337, 44, 708, 252, '奉贤区', 1),
(2338, 44, 708, 253, '崇明县', 1),
(2340, 44, 709, 254, '小店区', 1),
(2341, 44, 709, 254, '迎泽区', 1),
(2342, 44, 709, 254, '杏花岭区', 1),
(2343, 44, 709, 254, '尖草坪区', 1),
(2344, 44, 709, 254, '万柏林区', 1),
(2345, 44, 709, 254, '晋源区', 1),
(2346, 44, 709, 254, '清徐县', 1),
(2347, 44, 709, 254, '阳曲县', 1),
(2348, 44, 709, 254, '娄烦县', 1),
(2349, 44, 709, 254, '古交市', 1),
(2351, 44, 709, 255, '城　区', 1),
(2352, 44, 709, 255, '矿　区', 1),
(2353, 44, 709, 255, '南郊区', 1),
(2354, 44, 709, 255, '新荣区', 1),
(2355, 44, 709, 255, '阳高县', 1),
(2356, 44, 709, 255, '天镇县', 1),
(2357, 44, 709, 255, '广灵县', 1),
(2358, 44, 709, 255, '灵丘县', 1),
(2359, 44, 709, 255, '浑源县', 1),
(2360, 44, 709, 255, '左云县', 1),
(2361, 44, 709, 255, '大同县', 1),
(2363, 44, 709, 256, '城　区', 1),
(2364, 44, 709, 256, '矿　区', 1),
(2365, 44, 709, 256, '郊　区', 1),
(2366, 44, 709, 256, '平定县', 1),
(2367, 44, 709, 256, '盂　县', 1),
(2369, 44, 709, 257, '城　区', 1),
(2370, 44, 709, 257, '郊　区', 1),
(2371, 44, 709, 257, '长治县', 1),
(2372, 44, 709, 257, '襄垣县', 1),
(2373, 44, 709, 257, '屯留县', 1),
(2374, 44, 709, 257, '平顺县', 1),
(2375, 44, 709, 257, '黎城县', 1),
(2376, 44, 709, 257, '壶关县', 1),
(2377, 44, 709, 257, '长子县', 1),
(2378, 44, 709, 257, '武乡县', 1),
(2379, 44, 709, 257, '沁　县', 1),
(2380, 44, 709, 257, '沁源县', 1),
(2381, 44, 709, 257, '潞城市', 1),
(2383, 44, 709, 258, '城　区', 1),
(2384, 44, 709, 258, '沁水县', 1),
(2385, 44, 709, 258, '阳城县', 1),
(2386, 44, 709, 258, '陵川县', 1),
(2387, 44, 709, 258, '泽州县', 1),
(2388, 44, 709, 258, '高平市', 1),
(2390, 44, 709, 259, '朔城区', 1),
(2391, 44, 709, 259, '平鲁区', 1),
(2392, 44, 709, 259, '山阴县', 1),
(2393, 44, 709, 259, '应　县', 1),
(2394, 44, 709, 259, '右玉县', 1),
(2395, 44, 709, 259, '怀仁县', 1),
(2397, 44, 709, 260, '榆次区', 1),
(2398, 44, 709, 260, '榆社县', 1),
(2399, 44, 709, 260, '左权县', 1),
(2400, 44, 709, 260, '和顺县', 1),
(2401, 44, 709, 260, '昔阳县', 1),
(2402, 44, 709, 260, '寿阳县', 1),
(2403, 44, 709, 260, '太谷县', 1),
(2404, 44, 709, 260, '祁　县', 1),
(2405, 44, 709, 260, '平遥县', 1),
(2406, 44, 709, 260, '灵石县', 1),
(2407, 44, 709, 260, '介休市', 1),
(2409, 44, 709, 261, '盐湖区', 1),
(2410, 44, 709, 261, '临猗县', 1),
(2411, 44, 709, 261, '万荣县', 1),
(2412, 44, 709, 261, '闻喜县', 1),
(2413, 44, 709, 261, '稷山县', 1),
(2414, 44, 709, 261, '新绛县', 1),
(2415, 44, 709, 261, '绛　县', 1),
(2416, 44, 709, 261, '垣曲县', 1),
(2417, 44, 709, 261, '夏　县', 1),
(2418, 44, 709, 261, '平陆县', 1),
(2419, 44, 709, 261, '芮城县', 1),
(2420, 44, 709, 261, '永济市', 1),
(2421, 44, 709, 261, '河津市', 1),
(2423, 44, 709, 262, '忻府区', 1),
(2424, 44, 709, 262, '定襄县', 1),
(2425, 44, 709, 262, '五台县', 1),
(2426, 44, 709, 262, '代　县', 1),
(2427, 44, 709, 262, '繁峙县', 1),
(2428, 44, 709, 262, '宁武县', 1),
(2429, 44, 709, 262, '静乐县', 1),
(2430, 44, 709, 262, '神池县', 1),
(2431, 44, 709, 262, '五寨县', 1),
(2432, 44, 709, 262, '岢岚县', 1),
(2433, 44, 709, 262, '河曲县', 1),
(2434, 44, 709, 262, '保德县', 1),
(2435, 44, 709, 262, '偏关县', 1),
(2436, 44, 709, 262, '原平市', 1),
(2438, 44, 709, 263, '尧都区', 1),
(2439, 44, 709, 263, '曲沃县', 1),
(2440, 44, 709, 263, '翼城县', 1),
(2441, 44, 709, 263, '襄汾县', 1),
(2442, 44, 709, 263, '洪洞县', 1),
(2443, 44, 709, 263, '古　县', 1),
(2444, 44, 709, 263, '安泽县', 1),
(2445, 44, 709, 263, '浮山县', 1),
(2446, 44, 709, 263, '吉　县', 1),
(2447, 44, 709, 263, '乡宁县', 1),
(2448, 44, 709, 263, '大宁县', 1),
(2449, 44, 709, 263, '隰　县', 1),
(2450, 44, 709, 263, '永和县', 1),
(2451, 44, 709, 263, '蒲　县', 1),
(2452, 44, 709, 263, '汾西县', 1),
(2453, 44, 709, 263, '侯马市', 1),
(2454, 44, 709, 263, '霍州市', 1),
(2456, 44, 709, 264, '离石区', 1),
(2457, 44, 709, 264, '文水县', 1),
(2458, 44, 709, 264, '交城县', 1),
(2459, 44, 709, 264, '兴　县', 1),
(2460, 44, 709, 264, '临　县', 1),
(2461, 44, 709, 264, '柳林县', 1),
(2462, 44, 709, 264, '石楼县', 1),
(2463, 44, 709, 264, '岚　县', 1),
(2464, 44, 709, 264, '方山县', 1),
(2465, 44, 709, 264, '中阳县', 1),
(2466, 44, 709, 264, '交口县', 1),
(2467, 44, 709, 264, '孝义市', 1),
(2468, 44, 709, 264, '汾阳市', 1),
(2470, 44, 710, 265, '锦江区', 1),
(2471, 44, 710, 265, '青羊区', 1),
(2472, 44, 710, 265, '金牛区', 1),
(2473, 44, 710, 265, '武侯区', 1),
(2474, 44, 710, 265, '成华区', 1),
(2475, 44, 710, 265, '龙泉驿区', 1),
(2476, 44, 710, 265, '青白江区', 1),
(2477, 44, 710, 265, '新都区', 1),
(2478, 44, 710, 265, '温江区', 1),
(2479, 44, 710, 265, '金堂县', 1),
(2480, 44, 710, 265, '双流县', 1),
(2481, 44, 710, 265, '郫　县', 1),
(2482, 44, 710, 265, '大邑县', 1),
(2483, 44, 710, 265, '蒲江县', 1),
(2484, 44, 710, 265, '新津县', 1),
(2485, 44, 710, 265, '都江堰市', 1),
(2486, 44, 710, 265, '彭州市', 1),
(2487, 44, 710, 265, '邛崃市', 1),
(2488, 44, 710, 265, '崇州市', 1),
(2490, 44, 710, 266, '自流井区', 1),
(2491, 44, 710, 266, '贡井区', 1),
(2492, 44, 710, 266, '大安区', 1),
(2493, 44, 710, 266, '沿滩区', 1),
(2494, 44, 710, 266, '荣　县', 1),
(2495, 44, 710, 266, '富顺县', 1),
(2497, 44, 710, 267, '东　区', 1),
(2498, 44, 710, 267, '西　区', 1),
(2499, 44, 710, 267, '仁和区', 1),
(2500, 44, 710, 267, '米易县', 1),
(2501, 44, 710, 267, '盐边县', 1),
(2503, 44, 710, 268, '江阳区', 1),
(2504, 44, 710, 268, '纳溪区', 1),
(2505, 44, 710, 268, '龙马潭区', 1),
(2506, 44, 710, 268, '泸　县', 1),
(2507, 44, 710, 268, '合江县', 1),
(2508, 44, 710, 268, '叙永县', 1),
(2509, 44, 710, 268, '古蔺县', 1),
(2511, 44, 710, 269, '旌阳区', 1),
(2512, 44, 710, 269, '中江县', 1),
(2513, 44, 710, 269, '罗江县', 1),
(2514, 44, 710, 269, '广汉市', 1),
(2515, 44, 710, 269, '什邡市', 1),
(2516, 44, 710, 269, '绵竹市', 1),
(2518, 44, 710, 270, '涪城区', 1),
(2519, 44, 710, 270, '游仙区', 1),
(2520, 44, 710, 270, '三台县', 1),
(2521, 44, 710, 270, '盐亭县', 1),
(2522, 44, 710, 270, '安　县', 1),
(2523, 44, 710, 270, '梓潼县', 1),
(2524, 44, 710, 270, '北川羌族自治县', 1),
(2525, 44, 710, 270, '平武县', 1),
(2526, 44, 710, 270, '江油市', 1),
(2528, 44, 710, 271, '市中区', 1),
(2529, 44, 710, 271, '元坝区', 1),
(2530, 44, 710, 271, '朝天区', 1),
(2531, 44, 710, 271, '旺苍县', 1),
(2532, 44, 710, 271, '青川县', 1),
(2533, 44, 710, 271, '剑阁县', 1),
(2534, 44, 710, 271, '苍溪县', 1),
(2536, 44, 710, 272, '船山区', 1),
(2537, 44, 710, 272, '安居区', 1),
(2538, 44, 710, 272, '蓬溪县', 1),
(2539, 44, 710, 272, '射洪县', 1),
(2540, 44, 710, 272, '大英县', 1),
(2542, 44, 710, 273, '市中区', 1),
(2543, 44, 710, 273, '东兴区', 1),
(2544, 44, 710, 273, '威远县', 1),
(2545, 44, 710, 273, '资中县', 1),
(2546, 44, 710, 273, '隆昌县', 1),
(2548, 44, 710, 274, '市中区', 1),
(2549, 44, 710, 274, '沙湾区', 1),
(2550, 44, 710, 274, '五通桥区', 1),
(2551, 44, 710, 274, '金口河区', 1),
(2552, 44, 710, 274, '犍为县', 1),
(2553, 44, 710, 274, '井研县', 1),
(2554, 44, 710, 274, '夹江县', 1),
(2555, 44, 710, 274, '沐川县', 1),
(2556, 44, 710, 274, '峨边彝族自治县', 1),
(2557, 44, 710, 274, '马边彝族自治县', 1),
(2558, 44, 710, 274, '峨眉山市', 1),
(2560, 44, 710, 275, '顺庆区', 1),
(2561, 44, 710, 275, '高坪区', 1),
(2562, 44, 710, 275, '嘉陵区', 1),
(2563, 44, 710, 275, '南部县', 1),
(2564, 44, 710, 275, '营山县', 1),
(2565, 44, 710, 275, '蓬安县', 1),
(2566, 44, 710, 275, '仪陇县', 1),
(2567, 44, 710, 275, '西充县', 1),
(2568, 44, 710, 275, '阆中市', 1),
(2570, 44, 710, 276, '东坡区', 1),
(2571, 44, 710, 276, '仁寿县', 1),
(2572, 44, 710, 276, '彭山县', 1),
(2573, 44, 710, 276, '洪雅县', 1),
(2574, 44, 710, 276, '丹棱县', 1),
(2575, 44, 710, 276, '青神县', 1),
(2577, 44, 710, 277, '翠屏区', 1),
(2578, 44, 710, 277, '宜宾县', 1),
(2579, 44, 710, 277, '南溪县', 1),
(2580, 44, 710, 277, '江安县', 1),
(2581, 44, 710, 277, '长宁县', 1),
(2582, 44, 710, 277, '高　县', 1),
(2583, 44, 710, 277, '珙　县', 1),
(2584, 44, 710, 277, '筠连县', 1),
(2585, 44, 710, 277, '兴文县', 1),
(2586, 44, 710, 277, '屏山县', 1),
(2588, 44, 710, 278, '广安区', 1),
(2589, 44, 710, 278, '岳池县', 1),
(2590, 44, 710, 278, '武胜县', 1),
(2591, 44, 710, 278, '邻水县', 1),
(2592, 44, 710, 278, '华莹市', 1),
(2594, 44, 710, 279, '通川区', 1),
(2595, 44, 710, 279, '达　县', 1),
(2596, 44, 710, 279, '宣汉县', 1),
(2597, 44, 710, 279, '开江县', 1),
(2598, 44, 710, 279, '大竹县', 1),
(2599, 44, 710, 279, '渠　县', 1),
(2600, 44, 710, 279, '万源市', 1),
(2602, 44, 710, 280, '雨城区', 1),
(2603, 44, 710, 280, '名山县', 1),
(2604, 44, 710, 280, '荥经县', 1),
(2605, 44, 710, 280, '汉源县', 1),
(2606, 44, 710, 280, '石棉县', 1),
(2607, 44, 710, 280, '天全县', 1),
(2608, 44, 710, 280, '芦山县', 1),
(2609, 44, 710, 280, '宝兴县', 1),
(2611, 44, 710, 281, '巴州区', 1),
(2612, 44, 710, 281, '通江县', 1),
(2613, 44, 710, 281, '南江县', 1),
(2614, 44, 710, 281, '平昌县', 1),
(2616, 44, 710, 282, '雁江区', 1),
(2617, 44, 710, 282, '安岳县', 1),
(2618, 44, 710, 282, '乐至县', 1),
(2619, 44, 710, 282, '简阳市', 1),
(2620, 44, 710, 283, '汶川县', 1),
(2621, 44, 710, 283, '理　县', 1),
(2622, 44, 710, 283, '茂　县', 1),
(2623, 44, 710, 283, '松潘县', 1),
(2624, 44, 710, 283, '九寨沟县', 1),
(2625, 44, 710, 283, '金川县', 1),
(2626, 44, 710, 283, '小金县', 1),
(2627, 44, 710, 283, '黑水县', 1),
(2628, 44, 710, 283, '马尔康县', 1),
(2629, 44, 710, 283, '壤塘县', 1),
(2630, 44, 710, 283, '阿坝县', 1),
(2631, 44, 710, 283, '若尔盖县', 1),
(2632, 44, 710, 283, '红原县', 1),
(2633, 44, 710, 284, '康定县', 1),
(2634, 44, 710, 284, '泸定县', 1),
(2635, 44, 710, 284, '丹巴县', 1),
(2636, 44, 710, 284, '九龙县', 1),
(2637, 44, 710, 284, '雅江县', 1),
(2638, 44, 710, 284, '道孚县', 1),
(2639, 44, 710, 284, '炉霍县', 1),
(2640, 44, 710, 284, '甘孜县', 1),
(2641, 44, 710, 284, '新龙县', 1),
(2642, 44, 710, 284, '德格县', 1),
(2643, 44, 710, 284, '白玉县', 1),
(2644, 44, 710, 284, '石渠县', 1),
(2645, 44, 710, 284, '色达县', 1),
(2646, 44, 710, 284, '理塘县', 1),
(2647, 44, 710, 284, '巴塘县', 1),
(2648, 44, 710, 284, '乡城县', 1),
(2649, 44, 710, 284, '稻城县', 1),
(2650, 44, 710, 284, '得荣县', 1),
(2651, 44, 710, 285, '西昌市', 1),
(2652, 44, 710, 285, '木里藏族自治县', 1),
(2653, 44, 710, 285, '盐源县', 1),
(2654, 44, 710, 285, '德昌县', 1),
(2655, 44, 710, 285, '会理县', 1),
(2656, 44, 710, 285, '会东县', 1),
(2657, 44, 710, 285, '宁南县', 1),
(2658, 44, 710, 285, '普格县', 1),
(2659, 44, 710, 285, '布拖县', 1),
(2660, 44, 710, 285, '金阳县', 1),
(2661, 44, 710, 285, '昭觉县', 1),
(2662, 44, 710, 285, '喜德县', 1),
(2663, 44, 710, 285, '冕宁县', 1),
(2664, 44, 710, 285, '越西县', 1),
(2665, 44, 710, 285, '甘洛县', 1),
(2666, 44, 710, 285, '美姑县', 1),
(2667, 44, 710, 285, '雷波县', 1),
(2669, 44, 712, 286, '天山区', 1),
(2670, 44, 712, 286, '沙依巴克区', 1),
(2671, 44, 712, 286, '新市区', 1),
(2672, 44, 712, 286, '水磨沟区', 1),
(2673, 44, 712, 286, '头屯河区', 1),
(2674, 44, 712, 286, '达坂城区', 1),
(2675, 44, 712, 286, '东山区', 1),
(2676, 44, 712, 286, '乌鲁木齐县', 1),
(2678, 44, 712, 287, '独山子区', 1),
(2679, 44, 712, 287, '克拉玛依区', 1),
(2680, 44, 712, 287, '白碱滩区', 1),
(2681, 44, 712, 287, '乌尔禾区', 1),
(2682, 44, 712, 288, '吐鲁番市', 1),
(2683, 44, 712, 288, '鄯善县', 1),
(2684, 44, 712, 288, '托克逊县', 1),
(2685, 44, 712, 289, '哈密市', 1),
(2686, 44, 712, 289, '巴里坤哈萨克自治县', 1),
(2687, 44, 712, 289, '伊吾县', 1),
(2688, 44, 712, 290, '昌吉市', 1),
(2689, 44, 712, 290, '阜康市', 1),
(2690, 44, 712, 290, '米泉市', 1),
(2691, 44, 712, 290, '呼图壁县', 1),
(2692, 44, 712, 290, '玛纳斯县', 1),
(2693, 44, 712, 290, '奇台县', 1),
(2694, 44, 712, 290, '吉木萨尔县', 1),
(2695, 44, 712, 290, '木垒哈萨克自治县', 1),
(2696, 44, 712, 291, '博乐市', 1),
(2697, 44, 712, 291, '精河县', 1),
(2698, 44, 712, 291, '温泉县', 1),
(2699, 44, 712, 292, '库尔勒市', 1),
(2700, 44, 712, 292, '轮台县', 1),
(2701, 44, 712, 292, '尉犁县', 1),
(2702, 44, 712, 292, '若羌县', 1),
(2703, 44, 712, 292, '且末县', 1),
(2704, 44, 712, 292, '焉耆回族自治县', 1),
(2705, 44, 712, 292, '和静县', 1),
(2706, 44, 712, 292, '和硕县', 1),
(2707, 44, 712, 292, '博湖县', 1),
(2708, 44, 712, 293, '阿克苏市', 1),
(2709, 44, 712, 293, '温宿县', 1),
(2710, 44, 712, 293, '库车县', 1),
(2711, 44, 712, 293, '沙雅县', 1),
(2712, 44, 712, 293, '新和县', 1),
(2713, 44, 712, 293, '拜城县', 1),
(2714, 44, 712, 293, '乌什县', 1),
(2715, 44, 712, 293, '阿瓦提县', 1),
(2716, 44, 712, 293, '柯坪县', 1),
(2717, 44, 712, 294, '阿图什市', 1),
(2718, 44, 712, 294, '阿克陶县', 1),
(2719, 44, 712, 294, '阿合奇县', 1),
(2720, 44, 712, 294, '乌恰县', 1),
(2721, 44, 712, 295, '喀什市', 1),
(2722, 44, 712, 295, '疏附县', 1),
(2723, 44, 712, 295, '疏勒县', 1),
(2724, 44, 712, 295, '英吉沙县', 1),
(2725, 44, 712, 295, '泽普县', 1),
(2726, 44, 712, 295, '莎车县', 1),
(2727, 44, 712, 295, '叶城县', 1),
(2728, 44, 712, 295, '麦盖提县', 1),
(2729, 44, 712, 295, '岳普湖县', 1),
(2730, 44, 712, 295, '伽师县', 1),
(2731, 44, 712, 295, '巴楚县', 1),
(2732, 44, 712, 295, '塔什库尔干塔吉克自治县', 1),
(2733, 44, 712, 296, '和田市', 1),
(2734, 44, 712, 296, '和田县', 1),
(2735, 44, 712, 296, '墨玉县', 1),
(2736, 44, 712, 296, '皮山县', 1),
(2737, 44, 712, 296, '洛浦县', 1),
(2738, 44, 712, 296, '策勒县', 1),
(2739, 44, 712, 296, '于田县', 1),
(2740, 44, 712, 296, '民丰县', 1),
(2741, 44, 712, 297, '伊宁市', 1),
(2742, 44, 712, 297, '奎屯市', 1),
(2743, 44, 712, 297, '伊宁县', 1),
(2744, 44, 712, 297, '察布查尔锡伯自治县', 1),
(2745, 44, 712, 297, '霍城县', 1),
(2746, 44, 712, 297, '巩留县', 1),
(2747, 44, 712, 297, '新源县', 1),
(2748, 44, 712, 297, '昭苏县', 1),
(2749, 44, 712, 297, '特克斯县', 1),
(2750, 44, 712, 297, '尼勒克县', 1),
(2751, 44, 712, 298, '塔城市', 1),
(2752, 44, 712, 298, '乌苏市', 1),
(2753, 44, 712, 298, '额敏县', 1),
(2754, 44, 712, 298, '沙湾县', 1),
(2755, 44, 712, 298, '托里县', 1),
(2756, 44, 712, 298, '裕民县', 1),
(2757, 44, 712, 298, '和布克赛尔蒙古自治县', 1),
(2758, 44, 712, 299, '阿勒泰市', 1),
(2759, 44, 712, 299, '布尔津县', 1),
(2760, 44, 712, 299, '富蕴县', 1),
(2761, 44, 712, 299, '福海县', 1),
(2762, 44, 712, 299, '哈巴河县', 1),
(2763, 44, 712, 299, '青河县', 1),
(2764, 44, 712, 299, '吉木乃县', 1),
(2765, 44, 712, 300, '石河子市', 1),
(2766, 44, 712, 300, '阿拉尔市', 1),
(2767, 44, 712, 300, '图木舒克市', 1),
(2768, 44, 712, 300, '五家渠市', 1),
(2770, 44, 713, 301, '五华区', 1),
(2771, 44, 713, 301, '盘龙区', 1),
(2772, 44, 713, 301, '官渡区', 1),
(2773, 44, 713, 301, '西山区', 1),
(2774, 44, 713, 301, '东川区', 1),
(2775, 44, 713, 301, '呈贡县', 1),
(2776, 44, 713, 301, '晋宁县', 1),
(2777, 44, 713, 301, '富民县', 1),
(2778, 44, 713, 301, '宜良县', 1),
(2779, 44, 713, 301, '石林彝族自治县', 1),
(2780, 44, 713, 301, '嵩明县', 1),
(2781, 44, 713, 301, '禄劝彝族苗族自治县', 1),
(2782, 44, 713, 301, '寻甸回族彝族自治县', 1),
(2783, 44, 713, 301, '安宁市', 1),
(2785, 44, 713, 302, '麒麟区', 1),
(2786, 44, 713, 302, '马龙县', 1),
(2787, 44, 713, 302, '陆良县', 1),
(2788, 44, 713, 302, '师宗县', 1),
(2789, 44, 713, 302, '罗平县', 1),
(2790, 44, 713, 302, '富源县', 1),
(2791, 44, 713, 302, '会泽县', 1),
(2792, 44, 713, 302, '沾益县', 1),
(2793, 44, 713, 302, '宣威市', 1),
(2795, 44, 713, 303, '红塔区', 1),
(2796, 44, 713, 303, '江川县', 1),
(2797, 44, 713, 303, '澄江县', 1),
(2798, 44, 713, 303, '通海县', 1),
(2799, 44, 713, 303, '华宁县', 1),
(2800, 44, 713, 303, '易门县', 1),
(2801, 44, 713, 303, '峨山彝族自治县', 1),
(2802, 44, 713, 303, '新平彝族傣族自治县', 1),
(2803, 44, 713, 303, '元江哈尼族彝族傣族自治县', 1),
(2805, 44, 713, 304, '隆阳区', 1),
(2806, 44, 713, 304, '施甸县', 1),
(2807, 44, 713, 304, '腾冲县', 1),
(2808, 44, 713, 304, '龙陵县', 1),
(2809, 44, 713, 304, '昌宁县', 1),
(3140, 44, 711, 343, '蓟　县', 1),
(2811, 44, 713, 305, '昭阳区', 1),
(2812, 44, 713, 305, '鲁甸县', 1),
(2813, 44, 713, 305, '巧家县', 1),
(2814, 44, 713, 305, '盐津县', 1),
(2815, 44, 713, 305, '大关县', 1),
(2816, 44, 713, 305, '永善县', 1),
(2817, 44, 713, 305, '绥江县', 1),
(2818, 44, 713, 305, '镇雄县', 1),
(2819, 44, 713, 305, '彝良县', 1),
(2820, 44, 713, 305, '威信县', 1),
(2821, 44, 713, 305, '水富县', 1),
(3139, 44, 711, 343, '静海区', 1),
(2823, 44, 713, 306, '古城区', 1),
(2824, 44, 713, 306, '玉龙纳西族自治县', 1),
(2825, 44, 713, 306, '永胜县', 1),
(2826, 44, 713, 306, '华坪县', 1),
(2827, 44, 713, 306, '宁蒗彝族自治县', 1),
(3138, 44, 711, 343, '宁河区', 1),
(2829, 44, 713, 307, '翠云区', 1),
(2830, 44, 713, 307, '普洱哈尼族彝族自治县', 1),
(2831, 44, 713, 307, '墨江哈尼族自治县', 1),
(2832, 44, 713, 307, '景东彝族自治县', 1),
(2833, 44, 713, 307, '景谷傣族彝族自治县', 1),
(2834, 44, 713, 307, '镇沅彝族哈尼族拉祜族自治县', 1),
(2835, 44, 713, 307, '江城哈尼族彝族自治县', 1),
(2836, 44, 713, 307, '孟连傣族拉祜族佤族自治县', 1),
(2837, 44, 713, 307, '澜沧拉祜族自治县', 1),
(2838, 44, 713, 307, '西盟佤族自治县', 1),
(2840, 44, 713, 308, '临翔区', 1),
(2841, 44, 713, 308, '凤庆县', 1),
(2842, 44, 713, 308, '云　县', 1),
(2843, 44, 713, 308, '永德县', 1),
(2844, 44, 713, 308, '镇康县', 1),
(2845, 44, 713, 308, '双江拉祜族佤族布朗族傣族自治县', 1),
(2846, 44, 713, 308, '耿马傣族佤族自治县', 1),
(2847, 44, 713, 308, '沧源佤族自治县', 1),
(2848, 44, 713, 309, '楚雄市', 1),
(2849, 44, 713, 309, '双柏县', 1),
(2850, 44, 713, 309, '牟定县', 1),
(2851, 44, 713, 309, '南华县', 1),
(2852, 44, 713, 309, '姚安县', 1),
(2853, 44, 713, 309, '大姚县', 1),
(2854, 44, 713, 309, '永仁县', 1),
(2855, 44, 713, 309, '元谋县', 1),
(2856, 44, 713, 309, '武定县', 1),
(2857, 44, 713, 309, '禄丰县', 1),
(2858, 44, 713, 310, '个旧市', 1),
(2859, 44, 713, 310, '开远市', 1),
(2860, 44, 713, 310, '蒙自县', 1),
(2861, 44, 713, 310, '屏边苗族自治县', 1),
(2862, 44, 713, 310, '建水县', 1),
(2863, 44, 713, 310, '石屏县', 1),
(2864, 44, 713, 310, '弥勒县', 1),
(2865, 44, 713, 310, '泸西县', 1),
(2866, 44, 713, 310, '元阳县', 1),
(2867, 44, 713, 310, '红河县', 1),
(2868, 44, 713, 310, '金平苗族瑶族傣族自治县', 1),
(2869, 44, 713, 310, '绿春县', 1),
(2870, 44, 713, 310, '河口瑶族自治县', 1),
(2871, 44, 713, 311, '文山县', 1),
(2872, 44, 713, 311, '砚山县', 1),
(2873, 44, 713, 311, '西畴县', 1),
(2874, 44, 713, 311, '麻栗坡县', 1),
(2875, 44, 713, 311, '马关县', 1),
(2876, 44, 713, 311, '丘北县', 1),
(2877, 44, 713, 311, '广南县', 1),
(2878, 44, 713, 311, '富宁县', 1),
(2879, 44, 713, 312, '景洪市', 1),
(2880, 44, 713, 312, '勐海县', 1),
(2881, 44, 713, 312, '勐腊县', 1),
(2882, 44, 713, 313, '大理市', 1),
(2883, 44, 713, 313, '漾濞彝族自治县', 1),
(2884, 44, 713, 313, '祥云县', 1),
(2885, 44, 713, 313, '宾川县', 1),
(2886, 44, 713, 313, '弥渡县', 1),
(2887, 44, 713, 313, '南涧彝族自治县', 1),
(2888, 44, 713, 313, '巍山彝族回族自治县', 1),
(2889, 44, 713, 313, '永平县', 1),
(2890, 44, 713, 313, '云龙县', 1),
(2891, 44, 713, 313, '洱源县', 1),
(2892, 44, 713, 313, '剑川县', 1),
(2893, 44, 713, 313, '鹤庆县', 1),
(2894, 44, 713, 314, '瑞丽市', 1),
(2895, 44, 713, 314, '潞西市', 1),
(2896, 44, 713, 314, '梁河县', 1),
(2897, 44, 713, 314, '盈江县', 1),
(2898, 44, 713, 314, '陇川县', 1),
(2899, 44, 713, 315, '泸水县', 1),
(2900, 44, 713, 315, '福贡县', 1),
(2901, 44, 713, 315, '贡山独龙族怒族自治县', 1),
(2902, 44, 713, 315, '兰坪白族普米族自治县', 1),
(2903, 44, 713, 316, '香格里拉县', 1),
(2904, 44, 713, 316, '德钦县', 1),
(2905, 44, 713, 316, '维西傈僳族自治县', 1),
(3137, 44, 711, 343, '滨海新区', 1),
(2907, 44, 714, 317, '上城区', 1),
(2908, 44, 714, 317, '下城区', 1),
(2909, 44, 714, 317, '江干区', 1),
(2910, 44, 714, 317, '拱墅区', 1),
(2911, 44, 714, 317, '西湖区', 1),
(2912, 44, 714, 317, '滨江区', 1),
(2913, 44, 714, 317, '萧山区', 1),
(2914, 44, 714, 317, '余杭区', 1),
(2915, 44, 714, 317, '桐庐县', 1),
(2916, 44, 714, 317, '淳安县', 1),
(2917, 44, 714, 317, '建德市', 1),
(2918, 44, 714, 317, '富阳市', 1),
(2919, 44, 714, 317, '临安市', 1),
(3136, 44, 711, 343, '宝坻区', 1),
(2921, 44, 714, 318, '海曙区', 1),
(2922, 44, 714, 318, '江东区', 1),
(2923, 44, 714, 318, '江北区', 1),
(2924, 44, 714, 318, '北仑区', 1),
(2925, 44, 714, 318, '镇海区', 1),
(2926, 44, 714, 318, '鄞州区', 1),
(2927, 44, 714, 318, '象山县', 1),
(2928, 44, 714, 318, '宁海县', 1),
(2929, 44, 714, 318, '余姚市', 1),
(2930, 44, 714, 318, '慈溪市', 1),
(2931, 44, 714, 318, '奉化市', 1),
(3135, 44, 711, 343, '武清区', 1),
(2933, 44, 714, 319, '鹿城区', 1),
(2934, 44, 714, 319, '龙湾区', 1),
(2935, 44, 714, 319, '瓯海区', 1),
(2936, 44, 714, 319, '洞头县', 1),
(2937, 44, 714, 319, '永嘉县', 1),
(2938, 44, 714, 319, '平阳县', 1),
(2939, 44, 714, 319, '苍南县', 1),
(2940, 44, 714, 319, '文成县', 1),
(2941, 44, 714, 319, '泰顺县', 1),
(2942, 44, 714, 319, '瑞安市', 1),
(2943, 44, 714, 319, '乐清市', 1),
(3134, 44, 711, 343, '北辰区', 1),
(2945, 44, 714, 320, '秀城区', 1),
(2946, 44, 714, 320, '秀洲区', 1),
(2947, 44, 714, 320, '嘉善县', 1),
(2948, 44, 714, 320, '海盐县', 1),
(2949, 44, 714, 320, '海宁市', 1),
(2950, 44, 714, 320, '平湖市', 1),
(2951, 44, 714, 320, '桐乡市', 1),
(3133, 44, 711, 343, '津南区', 1),
(2953, 44, 714, 321, '吴兴区', 1),
(2954, 44, 714, 321, '南浔区', 1),
(2955, 44, 714, 321, '德清县', 1),
(2956, 44, 714, 321, '长兴县', 1),
(2957, 44, 714, 321, '安吉县', 1),
(3132, 44, 711, 343, '西青区', 1),
(2959, 44, 714, 322, '越城区', 1),
(2960, 44, 714, 322, '绍兴县', 1),
(2961, 44, 714, 322, '新昌县', 1),
(2962, 44, 714, 322, '诸暨市', 1),
(2963, 44, 714, 322, '上虞市', 1),
(2964, 44, 714, 322, '嵊州市', 1),
(3131, 44, 711, 343, '东丽区', 1),
(2966, 44, 714, 323, '婺城区', 1),
(2967, 44, 714, 323, '金东区', 1),
(2968, 44, 714, 323, '武义县', 1),
(2969, 44, 714, 323, '浦江县', 1),
(2970, 44, 714, 323, '磐安县', 1),
(2971, 44, 714, 323, '兰溪市', 1),
(2972, 44, 714, 323, '义乌市', 1),
(2973, 44, 714, 323, '东阳市', 1),
(2974, 44, 714, 323, '永康市', 1),
(3130, 44, 711, 343, '红桥区', 1),
(2976, 44, 714, 324, '柯城区', 1),
(2977, 44, 714, 324, '衢江区', 1),
(2978, 44, 714, 324, '常山县', 1),
(2979, 44, 714, 324, '开化县', 1),
(2980, 44, 714, 324, '龙游县', 1),
(2981, 44, 714, 324, '江山市', 1),
(3129, 44, 711, 343, '河北区', 1),
(2983, 44, 714, 325, '定海区', 1),
(2984, 44, 714, 325, '普陀区', 1),
(2985, 44, 714, 325, '岱山县', 1),
(2986, 44, 714, 325, '嵊泗县', 1),
(3128, 44, 711, 343, '南开区', 1),
(2988, 44, 714, 326, '椒江区', 1),
(2989, 44, 714, 326, '黄岩区', 1),
(2990, 44, 714, 326, '路桥区', 1),
(2991, 44, 714, 326, '玉环县', 1),
(2992, 44, 714, 326, '三门县', 1),
(2993, 44, 714, 326, '天台县', 1),
(2994, 44, 714, 326, '仙居县', 1),
(2995, 44, 714, 326, '温岭市', 1),
(2996, 44, 714, 326, '临海市', 1),
(3127, 44, 711, 343, '河西区', 1),
(2998, 44, 714, 327, '莲都区', 1),
(2999, 44, 714, 327, '青田县', 1),
(3000, 44, 714, 327, '缙云县', 1),
(3001, 44, 714, 327, '遂昌县', 1),
(3002, 44, 714, 327, '松阳县', 1),
(3003, 44, 714, 327, '云和县', 1),
(3004, 44, 714, 327, '庆元县', 1),
(3005, 44, 714, 327, '景宁畲族自治县', 1),
(3006, 44, 714, 327, '龙泉市', 1),
(3126, 44, 711, 343, '河东区', 1),
(3008, 44, 4225, 328, '城关区', 1),
(3009, 44, 4225, 328, '林周县', 1),
(3010, 44, 4225, 328, '当雄县', 1),
(3011, 44, 4225, 328, '尼木县', 1),
(3012, 44, 4225, 328, '曲水县', 1),
(3013, 44, 4225, 328, '堆龙德庆县', 1),
(3014, 44, 4225, 328, '达孜县', 1),
(3015, 44, 4225, 328, '墨竹工卡县', 1),
(3016, 44, 4225, 329, '昌都县', 1),
(3017, 44, 4225, 329, '江达县', 1),
(3018, 44, 4225, 329, '贡觉县', 1),
(3019, 44, 4225, 329, '类乌齐县', 1),
(3020, 44, 4225, 329, '丁青县', 1),
(3021, 44, 4225, 329, '察雅县', 1),
(3022, 44, 4225, 329, '八宿县', 1),
(3023, 44, 4225, 329, '左贡县', 1),
(3024, 44, 4225, 329, '芒康县', 1),
(3025, 44, 4225, 329, '洛隆县', 1),
(3026, 44, 4225, 329, '边坝县', 1),
(3027, 44, 4225, 330, '乃东县', 1),
(3028, 44, 4225, 330, '扎囊县', 1),
(3029, 44, 4225, 330, '贡嘎县', 1),
(3030, 44, 4225, 330, '桑日县', 1),
(3031, 44, 4225, 330, '琼结县', 1),
(3032, 44, 4225, 330, '曲松县', 1),
(3033, 44, 4225, 330, '措美县', 1),
(3034, 44, 4225, 330, '洛扎县', 1),
(3035, 44, 4225, 330, '加查县', 1),
(3036, 44, 4225, 330, '隆子县', 1),
(3037, 44, 4225, 330, '错那县', 1),
(3038, 44, 4225, 330, '浪卡子县', 1),
(3039, 44, 4225, 331, '日喀则市', 1),
(3040, 44, 4225, 331, '南木林县', 1),
(3041, 44, 4225, 331, '江孜县', 1),
(3042, 44, 4225, 331, '定日县', 1),
(3043, 44, 4225, 331, '萨迦县', 1),
(3044, 44, 4225, 331, '拉孜县', 1),
(3045, 44, 4225, 331, '昂仁县', 1),
(3046, 44, 4225, 331, '谢通门县', 1),
(3047, 44, 4225, 331, '白朗县', 1),
(3048, 44, 4225, 331, '仁布县', 1),
(3049, 44, 4225, 331, '康马县', 1),
(3050, 44, 4225, 331, '定结县', 1),
(3051, 44, 4225, 331, '仲巴县', 1),
(3052, 44, 4225, 331, '亚东县', 1),
(3053, 44, 4225, 331, '吉隆县', 1),
(3054, 44, 4225, 331, '聂拉木县', 1),
(3055, 44, 4225, 331, '萨嘎县', 1),
(3056, 44, 4225, 331, '岗巴县', 1),
(3057, 44, 4225, 332, '那曲县', 1),
(3058, 44, 4225, 332, '嘉黎县', 1),
(3059, 44, 4225, 332, '比如县', 1),
(3060, 44, 4225, 332, '聂荣县', 1),
(3061, 44, 4225, 332, '安多县', 1),
(3062, 44, 4225, 332, '申扎县', 1),
(3063, 44, 4225, 332, '索　县', 1),
(3064, 44, 4225, 332, '班戈县', 1),
(3065, 44, 4225, 332, '巴青县', 1),
(3066, 44, 4225, 332, '尼玛县', 1),
(3067, 44, 4225, 333, '普兰县', 1),
(3068, 44, 4225, 333, '札达县', 1),
(3069, 44, 4225, 333, '噶尔县', 1),
(3070, 44, 4225, 333, '日土县', 1),
(3071, 44, 4225, 333, '革吉县', 1),
(3072, 44, 4225, 333, '改则县', 1),
(3073, 44, 4225, 333, '措勤县', 1),
(3074, 44, 4225, 334, '林芝县', 1),
(3075, 44, 4225, 334, '工布江达县', 1),
(3076, 44, 4225, 334, '米林县', 1),
(3077, 44, 4225, 334, '墨脱县', 1),
(3078, 44, 4225, 334, '波密县', 1),
(3079, 44, 4225, 334, '察隅县', 1),
(3080, 44, 4225, 334, '朗　县', 1),
(3125, 44, 711, 343, '和平区', 1),
(3082, 44, 4227, 335, '城东区', 1),
(3083, 44, 4227, 335, '城中区', 1),
(3084, 44, 4227, 335, '城西区', 1),
(3085, 44, 4227, 335, '城北区', 1),
(3086, 44, 4227, 335, '大通回族土族自治县', 1),
(3087, 44, 4227, 335, '湟中县', 1),
(3088, 44, 4227, 335, '湟源县', 1),
(3089, 44, 4227, 336, '平安县', 1),
(3090, 44, 4227, 336, '民和回族土族自治县', 1),
(3091, 44, 4227, 336, '乐都县', 1),
(3092, 44, 4227, 336, '互助土族自治县', 1),
(3093, 44, 4227, 336, '化隆回族自治县', 1),
(3094, 44, 4227, 336, '循化撒拉族自治县', 1),
(3095, 44, 4227, 337, '门源回族自治县', 1),
(3096, 44, 4227, 337, '祁连县', 1),
(3097, 44, 4227, 337, '海晏县', 1),
(3098, 44, 4227, 337, '刚察县', 1),
(3099, 44, 4227, 338, '同仁县', 1),
(3100, 44, 4227, 338, '尖扎县', 1),
(3101, 44, 4227, 338, '泽库县', 1),
(3102, 44, 4227, 338, '河南蒙古族自治县', 1),
(3103, 44, 4227, 339, '共和县', 1),
(3104, 44, 4227, 339, '同德县', 1),
(3105, 44, 4227, 339, '贵德县', 1),
(3106, 44, 4227, 339, '兴海县', 1),
(3107, 44, 4227, 339, '贵南县', 1),
(3108, 44, 4227, 340, '玛沁县', 1),
(3109, 44, 4227, 340, '班玛县', 1),
(3110, 44, 4227, 340, '甘德县', 1),
(3111, 44, 4227, 340, '达日县', 1),
(3112, 44, 4227, 340, '久治县', 1),
(3113, 44, 4227, 340, '玛多县', 1),
(3114, 44, 4227, 341, '玉树县', 1),
(3115, 44, 4227, 341, '杂多县', 1),
(3116, 44, 4227, 341, '称多县', 1),
(3117, 44, 4227, 341, '治多县', 1),
(3118, 44, 4227, 341, '囊谦县', 1),
(3119, 44, 4227, 341, '曲麻莱县', 1),
(3120, 44, 4227, 342, '格尔木市', 1),
(3121, 44, 4227, 342, '德令哈市', 1),
(3122, 44, 4227, 342, '乌兰县', 1),
(3123, 44, 4227, 342, '都兰县', 1),
(3124, 44, 4227, 342, '天峻县', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_download`
--

DROP TABLE IF EXISTS `mcc_download`;
CREATE TABLE `mcc_download` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(160) NOT NULL,
  `mask` varchar(128) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_download_description`
--

DROP TABLE IF EXISTS `mcc_download_description`;
CREATE TABLE `mcc_download_description` (
  `download_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`download_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_event`
--

DROP TABLE IF EXISTS `mcc_event`;
CREATE TABLE `mcc_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_event`
--

INSERT INTO `mcc_event` (`event_id`, `code`, `trigger`, `action`, `status`, `sort_order`) VALUES
(1, 'activity_customer_add', 'catalog/model/account/customer/addCustomer/after', 'event/activity/addCustomer', 1, 0),
(2, 'activity_customer_edit', 'catalog/model/account/customer/editCustomer/after', 'event/activity/editCustomer', 1, 0),
(3, 'activity_customer_password', 'catalog/model/account/customer/editPassword/after', 'event/activity/editPassword', 1, 0),
(4, 'activity_customer_forgotten', 'catalog/model/account/customer/editCode/after', 'event/activity/forgotten', 1, 0),
(5, 'activity_transaction', 'catalog/model/account/customer/addTransaction/after', 'event/activity/addTransaction', 1, 0),
(6, 'activity_customer_login', 'catalog/model/account/customer/deleteLoginAttempts/after', 'event/activity/login', 1, 0),
(7, 'activity_address_add', 'catalog/model/account/address/addAddress/after', 'event/activity/addAddress', 1, 0),
(8, 'activity_address_edit', 'catalog/model/account/address/editAddress/after', 'event/activity/editAddress', 1, 0),
(9, 'activity_address_delete', 'catalog/model/account/address/deleteAddress/after', 'event/activity/deleteAddress', 1, 0),
(10, 'activity_affiliate_add', 'catalog/model/account/customer/addAffiliate/after', 'event/activity/addAffiliate', 1, 0),
(11, 'activity_affiliate_edit', 'catalog/model/account/customer/editAffiliate/after', 'event/activity/editAffiliate', 1, 0),
(12, 'activity_order_add', 'catalog/model/checkout/order/addOrderHistory/before', 'event/activity/addOrderHistory', 1, 0),
(13, 'activity_return_add', 'catalog/model/account/return/addReturn/after', 'event/activity/addReturn', 1, 0),
(14, 'mail_transaction', 'catalog/model/account/customer/addTransaction/after', 'mail/transaction', 1, 0),
(15, 'mail_forgotten', 'catalog/model/account/customer/editCode/after', 'mail/forgotten', 1, 0),
(16, 'mail_customer_add', 'catalog/model/account/customer/addCustomer/after', 'mail/register', 1, 0),
(17, 'mail_customer_alert', 'catalog/model/account/customer/addCustomer/after', 'mail/register/alert', 1, 0),
(18, 'mail_affiliate_add', 'catalog/model/account/customer/addAffiliate/after', 'mail/affiliate', 1, 0),
(19, 'mail_affiliate_alert', 'catalog/model/account/customer/addAffiliate/after', 'mail/affiliate/alert', 1, 0),
(20, 'mail_voucher', 'catalog/model/checkout/order/addOrderHistory/after', 'extension/total/voucher/send', 1, 0),
(21, 'mail_order_add', 'catalog/model/checkout/order/addOrderHistory/before', 'mail/order', 1, 0),
(22, 'mail_order_alert', 'catalog/model/checkout/order/addOrderHistory/before', 'mail/order/alert', 1, 0),
(23, 'statistics_review_add', 'catalog/model/catalog/review/addReview/after', 'event/statistics/addReview', 1, 0),
(24, 'statistics_return_add', 'catalog/model/account/return/addReturn/after', 'event/statistics/addReturn', 1, 0),
(25, 'statistics_order_history', 'catalog/model/checkout/order/addOrderHistory/after', 'event/statistics/addOrderHistory', 1, 0),
(26, 'admin_mail_affiliate_approve', 'admin/model/customer/customer_approval/approveAffiliate/after', 'mail/affiliate/approve', 1, 0),
(27, 'admin_mail_affiliate_deny', 'admin/model/customer/customer_approval/denyAffiliate/after', 'mail/affiliate/deny', 1, 0),
(28, 'admin_mail_customer_approve', 'admin/model/customer/customer_approval/approveCustomer/after', 'mail/customer/approve', 1, 0),
(29, 'admin_mail_customer_deny', 'admin/model/customer/customer_approval/denyCustomer/after', 'mail/customer/deny', 1, 0),
(30, 'admin_mail_reward', 'admin/model/customer/customer/addReward/after', 'mail/reward', 1, 0),
(31, 'admin_mail_transaction', 'admin/model/customer/customer/addTransaction/after', 'mail/transaction', 1, 0),
(32, 'admin_mail_return', 'admin/model/sale/return/addReturn/after', 'mail/return', 1, 0),
(33, 'admin_mail_forgotten', 'admin/model/user/user/editCode/after', 'mail/forgotten', 1, 0),
(34, 'qq_login', 'catalog/controller/account/logout/after', 'extension/module/qq_login/logout', 1, 0),
(35, 'weibo_login', 'catalog/controller/account/logout/after', 'extension/module/weibo_login/logout', 1, 0),
(36, 'weixin_login', 'catalog/controller/account/logout/after', 'extension/module/weixin_login/logout', 1, 0),
(37, 'qq_login', 'catalog/controller/account/logout/after', 'extension/module/qq_login/logout', 1, 0),
(38, 'weibo_login', 'catalog/controller/account/logout/after', 'extension/module/weibo_login/logout', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_extension`
--

DROP TABLE IF EXISTS `mcc_extension`;
CREATE TABLE `mcc_extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_extension`
--

INSERT INTO `mcc_extension` (`extension_id`, `type`, `code`) VALUES
(1, 'payment', 'cod'),
(2, 'total', 'shipping'),
(3, 'total', 'sub_total'),
(4, 'total', 'tax'),
(5, 'total', 'total'),
(6, 'module', 'banner'),
(7, 'module', 'carousel'),
(8, 'total', 'credit'),
(9, 'shipping', 'flat'),
(10, 'total', 'handling'),
(11, 'total', 'low_order_fee'),
(12, 'total', 'coupon'),
(13, 'module', 'category'),
(14, 'module', 'account'),
(15, 'total', 'reward'),
(16, 'total', 'voucher'),
(17, 'payment', 'free_checkout'),
(18, 'module', 'featured'),
(19, 'module', 'slideshow'),
(20, 'theme', 'default'),
(21, 'dashboard', 'activity'),
(22, 'dashboard', 'sale'),
(23, 'dashboard', 'recent'),
(24, 'dashboard', 'order'),
(25, 'dashboard', 'online'),
(26, 'dashboard', 'map'),
(27, 'dashboard', 'customer'),
(28, 'dashboard', 'chart'),
(29, 'report', 'sale_coupon'),
(31, 'report', 'customer_search'),
(32, 'report', 'customer_transaction'),
(33, 'report', 'product_purchased'),
(34, 'report', 'product_viewed'),
(35, 'report', 'sale_return'),
(36, 'report', 'sale_order'),
(37, 'report', 'sale_shipping'),
(38, 'report', 'sale_tax'),
(39, 'report', 'customer_activity'),
(40, 'report', 'customer_order'),
(41, 'report', 'customer_reward'),
(50, 'captcha', 'basic'),
(52, 'module', 'kefu'),
(67, 'module', 'qq_login'),
(69, 'module', 'blog_comment'),
(68, 'module', 'blog_latest'),
(59, 'module', 'press_category'),
(60, 'module', 'faq_category'),
(63, 'module', 'blog_category'),
(64, 'module', 'blog_search'),
(66, 'module', 'press_latest'),
(71, 'module', 'weibo_login'),
(79, 'analytics', 'google'),
(80, 'feed', 'google_sitemap'),
(82, 'report', 'marketing');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_extension_install`
--

DROP TABLE IF EXISTS `mcc_extension_install`;
CREATE TABLE `mcc_extension_install` (
  `extension_install_id` int(11) NOT NULL AUTO_INCREMENT,
  `extension_download_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`extension_install_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_extension_path`
--

DROP TABLE IF EXISTS `mcc_extension_path`;
CREATE TABLE `mcc_extension_path` (
  `extension_path_id` int(11) NOT NULL AUTO_INCREMENT,
  `extension_install_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`extension_path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq`
--

DROP TABLE IF EXISTS `mcc_faq`;
CREATE TABLE `mcc_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq`
--

INSERT INTO `mcc_faq` (`faq_id`, `image`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(25, NULL, 1, 1, '2016-02-19 14:09:56', '2016-03-13 16:40:19'),
(26, NULL, 1, 1, '2016-02-19 14:10:24', '2016-02-19 14:40:46'),
(27, NULL, 1, 1, '2016-02-19 14:10:56', '2016-02-19 14:40:58'),
(28, NULL, 1, 1, '2016-02-25 10:23:07', '0000-00-00 00:00:00'),
(29, NULL, 1, 1, '2016-02-25 10:23:28', '0000-00-00 00:00:00'),
(30, NULL, 1, 1, '2016-02-25 10:23:49', '0000-00-00 00:00:00'),
(31, NULL, 1, 1, '2016-02-25 10:24:07', '0000-00-00 00:00:00'),
(32, NULL, 1, 1, '2016-02-25 10:24:25', '0000-00-00 00:00:00'),
(33, NULL, 1, 1, '2016-02-25 10:24:41', '0000-00-00 00:00:00'),
(34, NULL, 1, 1, '2016-02-25 10:24:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_category`
--

DROP TABLE IF EXISTS `mcc_faq_category`;
CREATE TABLE `mcc_faq_category` (
  `faq_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`faq_category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_category`
--

INSERT INTO `mcc_faq_category` (`faq_category_id`, `parent_id`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(13, 0, 1, 1, '2016-02-19 14:01:16', '2016-02-19 14:01:16'),
(14, 0, 2, 1, '2016-02-19 14:01:59', '2016-02-19 14:01:59'),
(15, 13, 1, 1, '2016-02-19 14:02:44', '2016-02-19 14:02:44'),
(16, 13, 2, 1, '2016-02-19 14:03:23', '2016-08-22 15:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_category_description`
--

DROP TABLE IF EXISTS `mcc_faq_category_description`;
CREATE TABLE `mcc_faq_category_description` (
  `faq_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_category_description`
--

INSERT INTO `mcc_faq_category_description` (`faq_category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(13, 1, '常见问题分类一', '&lt;p&gt;常见问题分类一&lt;br&gt;&lt;/p&gt;', '常见问题分类一', '常见问题分类一', '常见问题分类一'),
(13, 2, '常见问题分类一', '&lt;p&gt;常见问题分类一&lt;br&gt;&lt;/p&gt;', '常见问题分类一', '常见问题分类一', '常见问题分类一'),
(13, 3, '常见问题分类一', '&lt;p&gt;常见问题分类一&lt;br&gt;&lt;/p&gt;', '常见问题分类一', '常见问题分类一', '常见问题分类一'),
(14, 1, '常见问题分类二', '&lt;p&gt;常见问题分类二&lt;br&gt;&lt;/p&gt;', '常见问题分类二', '常见问题分类二', '常见问题分类二'),
(14, 2, '常见问题分类二', '&lt;p&gt;常见问题分类二&lt;br&gt;&lt;/p&gt;', '常见问题分类二', '常见问题分类二', '常见问题分类二'),
(14, 3, '常见问题分类二', '&lt;p&gt;常见问题分类二&lt;br&gt;&lt;/p&gt;', '常见问题分类二', '常见问题分类二', '常见问题分类二'),
(15, 1, '苹果问题', '&lt;p&gt;苹果问题&lt;br&gt;&lt;/p&gt;', '苹果问题', '苹果问题', '苹果问题'),
(15, 2, '苹果问题', '&lt;p&gt;苹果问题&lt;br&gt;&lt;/p&gt;', '苹果问题', '苹果问题', '苹果问题'),
(15, 3, '苹果问题', '&lt;p&gt;苹果问题&lt;br&gt;&lt;/p&gt;', '苹果问题', '苹果问题', '苹果问题'),
(16, 3, '桔子问题', '&lt;p&gt;桔子问题&lt;br&gt;&lt;/p&gt;', '桔子问题', '桔子问题', '桔子问题'),
(16, 1, '桔子问题', '&lt;p&gt;桔子问题&lt;br&gt;&lt;/p&gt;', '桔子问题', '桔子问题', '桔子问题'),
(16, 2, '桔子问题', '&lt;p&gt;桔子问题&lt;br&gt;&lt;/p&gt;', '桔子问题', '桔子问题', '桔子问题');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_category_path`
--

DROP TABLE IF EXISTS `mcc_faq_category_path`;
CREATE TABLE `mcc_faq_category_path` (
  `faq_category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_category_path`
--

INSERT INTO `mcc_faq_category_path` (`faq_category_id`, `path_id`, `level`) VALUES
(13, 13, 0),
(14, 14, 0),
(15, 13, 0),
(15, 15, 1),
(16, 13, 0),
(16, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_category_to_layout`
--

DROP TABLE IF EXISTS `mcc_faq_category_to_layout`;
CREATE TABLE `mcc_faq_category_to_layout` (
  `faq_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_category_to_layout`
--

INSERT INTO `mcc_faq_category_to_layout` (`faq_category_id`, `store_id`, `layout_id`) VALUES
(13, 0, 0),
(14, 0, 0),
(15, 0, 0),
(16, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_category_to_store`
--

DROP TABLE IF EXISTS `mcc_faq_category_to_store`;
CREATE TABLE `mcc_faq_category_to_store` (
  `faq_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_category_to_store`
--

INSERT INTO `mcc_faq_category_to_store` (`faq_category_id`, `store_id`) VALUES
(13, 0),
(14, 0),
(15, 0),
(16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_description`
--

DROP TABLE IF EXISTS `mcc_faq_description`;
CREATE TABLE `mcc_faq_description` (
  `faq_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`faq_id`,`language_id`),
  KEY `name` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_description`
--

INSERT INTO `mcc_faq_description` (`faq_id`, `language_id`, `title`, `answer`) VALUES
(26, 3, '问题2', '&lt;p&gt;问题2&lt;br&gt;&lt;/p&gt;'),
(26, 2, '问题2', '&lt;p&gt;问题2&lt;br&gt;&lt;/p&gt;'),
(26, 1, '问题2', '&lt;p&gt;问题2&lt;br&gt;&lt;/p&gt;'),
(27, 3, '问题3', '&lt;p&gt;问题3&lt;br&gt;&lt;/p&gt;'),
(27, 2, '问题3', '&lt;p&gt;问题3&lt;br&gt;&lt;/p&gt;'),
(27, 1, '问题3', '&lt;p&gt;问题3&lt;br&gt;&lt;/p&gt;'),
(25, 1, 'MyCnCart系统可以商用吗？', '&lt;p&gt;是的，完全可以！!！&lt;br&gt;&lt;br&gt;mycncart系统遵循GPL3协议，您可以用它来用作商业网站，并且免费使用。&lt;br&gt;&lt;br&gt;你所需要遵循的就是：如果您做了二次开发并且将其销售，则您必须保持所做的二次开发也是开源的，不能做任何加密。&lt;br&gt;&lt;br&gt;mycncart系统本身可以被免费使用，但不能包装起来后被销售。&lt;br&gt;&lt;br&gt;您可以将【技术支持 MyCnCart】移除， 但希望您能够做一捐款， 如此MyCnCart的开发者才能够投入更多的时间精力为大家提供更好的版本服务。&lt;br&gt;&lt;br&gt;请使用支付宝捐款至支付宝账户：tonyspace2010@gmail.com&amp;nbsp; 姓名： 杨兆锋&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;'),
(28, 1, '问题4', '&lt;p&gt;问题4&lt;br&gt;&lt;/p&gt;'),
(28, 2, '问题4', '&lt;p&gt;问题4&lt;br&gt;&lt;/p&gt;'),
(28, 3, '问题4', '&lt;p&gt;问题4&lt;br&gt;&lt;/p&gt;'),
(29, 1, '问题5', '&lt;p&gt;问题5&lt;br&gt;&lt;/p&gt;'),
(29, 2, '问题5', '&lt;p&gt;问题5&lt;br&gt;&lt;/p&gt;'),
(29, 3, '问题5', '&lt;p&gt;问题5&lt;br&gt;&lt;/p&gt;'),
(30, 1, '问题6', '&lt;p&gt;问题6&lt;br&gt;&lt;/p&gt;'),
(30, 2, '问题6', '&lt;p&gt;问题6&lt;br&gt;&lt;/p&gt;'),
(30, 3, '问题6', '&lt;p&gt;问题6&lt;br&gt;&lt;/p&gt;'),
(31, 1, '问题7', '&lt;p&gt;问题7&lt;br&gt;&lt;/p&gt;'),
(31, 2, '问题7', '&lt;p&gt;问题7&lt;br&gt;&lt;/p&gt;'),
(31, 3, '问题7', '&lt;p&gt;问题7&lt;br&gt;&lt;/p&gt;'),
(32, 1, '问题8', '&lt;p&gt;问题8&lt;br&gt;&lt;/p&gt;'),
(32, 2, '问题8', '&lt;p&gt;问题8&lt;br&gt;&lt;/p&gt;'),
(32, 3, '问题8', '&lt;p&gt;问题8&lt;br&gt;&lt;/p&gt;'),
(33, 1, '问题9', '&lt;p&gt;问题9&lt;br&gt;&lt;/p&gt;'),
(33, 2, '问题9', '&lt;p&gt;问题9&lt;br&gt;&lt;/p&gt;'),
(33, 3, '问题9', '&lt;p&gt;问题9&lt;br&gt;&lt;/p&gt;'),
(34, 1, '问题10', '&lt;p&gt;问题10&lt;br&gt;&lt;/p&gt;'),
(34, 2, '问题10', '&lt;p&gt;问题10&lt;br&gt;&lt;/p&gt;'),
(34, 3, '问题10', '&lt;p&gt;问题10&lt;br&gt;&lt;/p&gt;'),
(25, 2, 'MyCnCart系统可以商用吗？', '&lt;p&gt;是的，完全可以！!！&lt;br&gt;&lt;br&gt;mycncart系统遵循GPL3协议，您可以用它来用作商业网站，并且免费使用。&lt;br&gt;&lt;br&gt;你所需要遵循的就是：如果您做了二次开发并且将其销售，则您必须保持所做的二次开发也是开源的，不能做任何加密。&lt;br&gt;&lt;br&gt;mycncart系统本身可以被免费使用，但不能包装起来后被销售。&lt;br&gt;&lt;br&gt;您可以将【技术支持 MyCnCart】移除， 但希望您能够做一捐款， 如此MyCnCart的开发者才能够投入更多的时间精力为大家提供更好的版本服务。&lt;br&gt;&lt;br&gt;请使用支付宝捐款至支付宝账户：tonyspace2010@gmail.com&amp;nbsp; 姓名： 杨兆锋&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;'),
(25, 3, 'MyCnCart系统可以商用吗？', '&lt;p&gt;是的，完全可以！!！&lt;br&gt;&lt;br&gt;mycncart系统遵循GPL3协议，您可以用它来用作商业网站，并且免费使用。&lt;br&gt;&lt;br&gt;你所需要遵循的就是：如果您做了二次开发并且将其销售，则您必须保持所做的二次开发也是开源的，不能做任何加密。&lt;br&gt;&lt;br&gt;mycncart系统本身可以被免费使用，但不能包装起来后被销售。&lt;br&gt;&lt;br&gt;您可以将【技术支持 MyCnCart】移除， 但希望您能够做一捐款， 如此MyCnCart的开发者才能够投入更多的时间精力为大家提供更好的版本服务。&lt;br&gt;&lt;br&gt;请使用支付宝捐款至支付宝账户：tonyspace2010@gmail.com&amp;nbsp; 姓名： 杨兆锋&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_product`
--

DROP TABLE IF EXISTS `mcc_faq_product`;
CREATE TABLE `mcc_faq_product` (
  `faq_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  UNIQUE KEY `faq_id` (`faq_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_product`
--

INSERT INTO `mcc_faq_product` (`faq_id`, `related_id`) VALUES
(25, 28),
(25, 41),
(25, 42),
(25, 47),
(26, 41),
(26, 48),
(27, 28),
(27, 48);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_to_faq_category`
--

DROP TABLE IF EXISTS `mcc_faq_to_faq_category`;
CREATE TABLE `mcc_faq_to_faq_category` (
  `faq_id` int(11) NOT NULL,
  `faq_category_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_id`,`faq_category_id`),
  KEY `faq_category_id` (`faq_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_to_faq_category`
--

INSERT INTO `mcc_faq_to_faq_category` (`faq_id`, `faq_category_id`) VALUES
(25, 13),
(25, 15),
(26, 13),
(26, 16),
(27, 14),
(28, 16),
(29, 16),
(30, 16),
(31, 16),
(32, 16),
(33, 16),
(34, 16);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_to_layout`
--

DROP TABLE IF EXISTS `mcc_faq_to_layout`;
CREATE TABLE `mcc_faq_to_layout` (
  `faq_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_to_layout`
--

INSERT INTO `mcc_faq_to_layout` (`faq_id`, `store_id`, `layout_id`) VALUES
(25, 0, 0),
(26, 0, 0),
(27, 0, 0),
(28, 0, 0),
(29, 0, 0),
(30, 0, 0),
(31, 0, 0),
(32, 0, 0),
(33, 0, 0),
(34, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_faq_to_store`
--

DROP TABLE IF EXISTS `mcc_faq_to_store`;
CREATE TABLE `mcc_faq_to_store` (
  `faq_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`faq_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_faq_to_store`
--

INSERT INTO `mcc_faq_to_store` (`faq_id`, `store_id`) VALUES
(25, 0),
(26, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_filter`
--

DROP TABLE IF EXISTS `mcc_filter`;
CREATE TABLE `mcc_filter` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_group_id` int(11) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_filter_description`
--

DROP TABLE IF EXISTS `mcc_filter_description`;
CREATE TABLE `mcc_filter_description` (
  `filter_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `filter_group_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`filter_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_filter_group`
--

DROP TABLE IF EXISTS `mcc_filter_group`;
CREATE TABLE `mcc_filter_group` (
  `filter_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`filter_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_filter_group_description`
--

DROP TABLE IF EXISTS `mcc_filter_group_description`;
CREATE TABLE `mcc_filter_group_description` (
  `filter_group_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`filter_group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_geo_zone`
--

DROP TABLE IF EXISTS `mcc_geo_zone`;
CREATE TABLE `mcc_geo_zone` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_geo_zone`
--

INSERT INTO `mcc_geo_zone` (`geo_zone_id`, `name`, `description`, `date_added`, `date_modified`) VALUES
(3, '中国普通地区', '中国普通地区', '2009-01-06 23:26:25', '2015-04-01 22:23:18'),
(4, '中国偏远地区配送', '中国偏远地区配送', '2009-06-23 01:14:53', '2015-04-01 22:11:53'),
(5, '中国特别地区', '中国特别地区', '2015-04-01 22:24:09', '0000-00-00 00:00:00'),
(6, '北京重点区域', '北京重点区域', '2016-09-22 11:34:24', '2016-09-29 17:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_information`
--

DROP TABLE IF EXISTS `mcc_information`;
CREATE TABLE `mcc_information` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `bottom` int(1) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`information_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_information`
--

INSERT INTO `mcc_information` (`information_id`, `bottom`, `sort_order`, `status`) VALUES
(3, 1, 3, 1),
(4, 1, 1, 1),
(5, 1, 4, 1),
(6, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_information_description`
--

DROP TABLE IF EXISTS `mcc_information_description`;
CREATE TABLE `mcc_information_description` (
  `information_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` mediumtext NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`information_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_information_description`
--

INSERT INTO `mcc_information_description` (`information_id`, `language_id`, `title`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(6, 2, 'Delivery Information', '&lt;p&gt;\r\n	Delivery Information&lt;/p&gt;\r\n', 'Delivery Information', '', ''),
(4, 2, 'About Us', '&lt;p&gt;\r\n	About Us&lt;/p&gt;\r\n', 'About Us', '', ''),
(3, 2, 'Privacy Policy', '&lt;p&gt;\r\n	Privacy Policy&lt;/p&gt;\r\n', 'Privacy Policy', '', ''),
(5, 2, 'Terms &amp; Conditions', 'Terms &amp;amp; Conditions', 'Terms &amp; Conditions', '', ''),
(4, 1, '关于我们', '&lt;p&gt;\r\n	About Us&lt;/p&gt;\r\n', '关于我们', '', ''),
(3, 1, '隐私政策', '&lt;p&gt;\r\n	隐私政策&lt;/p&gt;\r\n', '隐私政策', '', ''),
(6, 1, '物流配送', '&lt;p&gt;\r\n	物流配送&lt;/p&gt;\r\n', '物流配送', '', ''),
(5, 1, '使用条款', '&lt;p&gt;使用条款&lt;br&gt;&lt;/p&gt;', '使用条款', '', ''),
(6, 3, '物流配送', '&lt;p&gt;\r\n	物流配送&lt;/p&gt;\r\n', '物流配送', '', ''),
(5, 3, '使用條款', '&lt;p&gt;\r\n	使用條款&lt;/p&gt;\r\n', '使用條款', '', ''),
(3, 3, '隱私政策', '&lt;p&gt;\r\n	隱私政策&lt;/p&gt;\r\n', '隱私政策', '', ''),
(4, 3, '关于我们', '&lt;p&gt;\r\n	关于我们&lt;/p&gt;\r\n', '关于我们', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_information_to_layout`
--

DROP TABLE IF EXISTS `mcc_information_to_layout`;
CREATE TABLE `mcc_information_to_layout` (
  `information_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`information_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_information_to_store`
--

DROP TABLE IF EXISTS `mcc_information_to_store`;
CREATE TABLE `mcc_information_to_store` (
  `information_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`information_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_information_to_store`
--

INSERT INTO `mcc_information_to_store` (`information_id`, `store_id`) VALUES
(3, 0),
(4, 0),
(5, 0),
(6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_language`
--

DROP TABLE IF EXISTS `mcc_language`;
CREATE TABLE `mcc_language` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_language`
--

INSERT INTO `mcc_language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `sort_order`, `status`) VALUES
(2, 'English', 'en-gb', 'en-US,en_US.UTF-8,en_US,en-gb,english', 'gb.png', 'english', 1, 1),
(1, '简体中文', 'zh-cn', 'zh-CN,zh-CN.UTF-8,zh-cn', '', '', 1, 1),
(3, '繁體中文', 'zh-hk', 'zh-HK,tchinese,zh-hk,ZH-HK', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_layout`
--

DROP TABLE IF EXISTS `mcc_layout`;
CREATE TABLE `mcc_layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_layout`
--

INSERT INTO `mcc_layout` (`layout_id`, `name`) VALUES
(1, '首页布局'),
(2, '商品详情'),
(3, '分类布局'),
(4, '默认布局'),
(5, '品牌 / 制造商'),
(6, '会员账户'),
(7, '结帐布局'),
(8, '联系我们'),
(9, '网站地图'),
(10, '加盟推广'),
(11, '信息文章'),
(12, '商品比较'),
(13, '检索布局'),
(14, '博客列表'),
(15, '博客詳情'),
(16, '新闻列表'),
(17, '新闻详情'),
(18, '常见问题与解答(FAQs)布局'),
(19, '账号登录布局');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_layout_module`
--

DROP TABLE IF EXISTS `mcc_layout_module`;
CREATE TABLE `mcc_layout_module` (
  `layout_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`layout_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_layout_module`
--

INSERT INTO `mcc_layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
(83, 5, 'account', 'column_left', 2),
(75, 10, 'account', 'column_right', 1),
(119, 6, 'account', 'column_right', 3),
(130, 1, 'carousel.29', 'content_top', 3),
(127, 3, 'banner.30', 'column_left', 2),
(126, 3, 'category', 'column_left', 1),
(129, 1, 'featured.28', 'content_top', 2),
(142, 14, 'blog_latest.36', 'column_left', 2),
(86, 15, 'blog_search', 'column_left', 0),
(143, 14, 'blog_comment.37', 'column_left', 3),
(141, 14, 'blog_category', 'column_left', 1),
(131, 1, 'kefu.35', 'content_bottom', 0),
(140, 14, 'blog_search', 'column_left', 0),
(93, 18, 'faq_category', 'column_left', 0),
(128, 1, 'slideshow.27', 'content_top', 1),
(145, 16, 'press_category', 'column_left', 0),
(146, 16, 'press_latest', 'column_left', 1),
(147, 17, 'press_category', 'column_left', 0),
(152, 19, 'weibo_login', 'content_top', 1),
(151, 19, 'qq_login', 'content_top', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_layout_route`
--

DROP TABLE IF EXISTS `mcc_layout_route`;
CREATE TABLE `mcc_layout_route` (
  `layout_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `route` varchar(64) NOT NULL,
  PRIMARY KEY (`layout_route_id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_layout_route`
--

INSERT INTO `mcc_layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
(86, 6, 0, 'account/%'),
(55, 10, 0, 'affiliate/%'),
(89, 3, 0, 'product/category'),
(90, 1, 0, 'common/home'),
(64, 2, 0, 'product/product'),
(62, 11, 0, 'information/information'),
(106, 7, 0, 'checkout/%'),
(59, 8, 0, 'information/contact'),
(66, 9, 0, 'information/sitemap'),
(67, 4, 0, ''),
(63, 5, 0, 'product/manufacturer'),
(58, 12, 0, 'product/compare'),
(65, 13, 0, 'product/search'),
(100, 14, 0, 'blog/category'),
(70, 15, 0, 'blog/blog'),
(105, 17, 0, 'press/press'),
(77, 18, 0, 'faq/%'),
(99, 14, 0, 'blog/all'),
(103, 16, 0, 'press/category'),
(104, 16, 0, 'press/all'),
(109, 19, 0, 'account/login');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_length_class`
--

DROP TABLE IF EXISTS `mcc_length_class`;
CREATE TABLE `mcc_length_class` (
  `length_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL,
  PRIMARY KEY (`length_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_length_class`
--

INSERT INTO `mcc_length_class` (`length_class_id`, `value`) VALUES
(1, '1.00000000'),
(2, '10.00000000'),
(3, '0.39370000');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_length_class_description`
--

DROP TABLE IF EXISTS `mcc_length_class_description`;
CREATE TABLE `mcc_length_class_description` (
  `length_class_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL,
  PRIMARY KEY (`length_class_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_length_class_description`
--

INSERT INTO `mcc_length_class_description` (`length_class_id`, `language_id`, `title`, `unit`) VALUES
(3, 3, '英寸', 'in'),
(1, 2, 'Centimeter', 'cm'),
(2, 2, 'Millimeter', 'mm'),
(3, 2, 'Inch', 'in'),
(1, 1, '厘米', 'cm'),
(2, 1, '毫米', 'mm'),
(3, 1, '英寸', 'in'),
(1, 3, '厘米', 'cm'),
(2, 3, '毫米', 'mm');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_location`
--

DROP TABLE IF EXISTS `mcc_location`;
CREATE TABLE `mcc_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `geocode` varchar(32) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `open` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_manufacturer`
--

DROP TABLE IF EXISTS `mcc_manufacturer`;
CREATE TABLE `mcc_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_manufacturer`
--

INSERT INTO `mcc_manufacturer` (`manufacturer_id`, `name`, `image`, `sort_order`) VALUES
(5, 'HTC', 'catalog/demo/htc_logo.jpg', 0),
(6, 'Palm', 'catalog/demo/palm_logo.jpg', 0),
(7, 'Hewlett-Packard', 'catalog/demo/hp_logo.jpg', 0),
(8, 'Apple', 'catalog/demo/apple_logo.jpg', 0),
(9, 'Canon', 'catalog/demo/canon_logo.jpg', 0),
(10, 'Sony', 'catalog/demo/sony_logo.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_manufacturer_to_store`
--

DROP TABLE IF EXISTS `mcc_manufacturer_to_store`;
CREATE TABLE `mcc_manufacturer_to_store` (
  `manufacturer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`manufacturer_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_manufacturer_to_store`
--

INSERT INTO `mcc_manufacturer_to_store` (`manufacturer_id`, `store_id`) VALUES
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_marketing`
--

DROP TABLE IF EXISTS `mcc_marketing`;
CREATE TABLE `mcc_marketing` (
  `marketing_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(64) NOT NULL,
  `clicks` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`marketing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_modification`
--

DROP TABLE IF EXISTS `mcc_modification`;
CREATE TABLE `mcc_modification` (
  `modification_id` int(11) NOT NULL AUTO_INCREMENT,
  `extension_install_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `version` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `xml` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`modification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_module`
--

DROP TABLE IF EXISTS `mcc_module`;
CREATE TABLE `mcc_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(32) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_module`
--

INSERT INTO `mcc_module` (`module_id`, `name`, `code`, `setting`) VALUES
(30, 'Category', 'banner', '{"name":"Category","banner_id":"6","width":"182","height":"182","status":"1"}'),
(29, 'Home Page', 'carousel', '{"name":"Home Page","banner_id":"8","width":"130","height":"100","status":"1"}'),
(28, 'Home Page', 'featured', '{"name":"Home Page","product":["43","40","42","30"],"limit":"4","width":"200","height":"200","status":"1"}'),
(27, 'Home Page', 'slideshow', '{"name":"Home Page","banner_id":"7","width":"1140","height":"580","status":"1"}'),
(31, 'Banner 1', 'banner', '{"name":"Banner 1","banner_id":"6","width":"182","height":"182","status":"1"}'),
(36, '博客详情页面', 'blog_latest', '{"name":"\\u535a\\u5ba2\\u8be6\\u60c5\\u9875\\u9762","limit":"4","width":"200","height":"200","status":"1"}'),
(37, '博客列表页面', 'blog_comment', '{"name":"\\u535a\\u5ba2\\u5217\\u8868\\u9875\\u9762","limit":"3","width":"200","height":"200","status":"1"}'),
(35, '首页侧边栏客服', 'kefu', '{"name":"\\u9996\\u9875\\u4fa7\\u8fb9\\u680f\\u5ba2\\u670d","status":"1","telephone":"18561800618","image_title":"\\u5fae\\u4fe1\\u4e8c\\u7ef4\\u7801","image":"catalog\\/demo\\/banners\\/qrcode_for_gh_29f75db0e2c0_430.jpg","service_qq":[{"qq_number":"909835012","qq_name":"\\u9500\\u552e","sort_order":"1"},{"qq_number":"150766998","qq_name":"\\u6280\\u672f\\u652f\\u6301","sort_order":"2"}]}'),
(38, '博客分类页面', 'blog_comment', '{"name":"\\u535a\\u5ba2\\u5206\\u7c7b\\u9875\\u9762","limit":"5","width":"200","height":"200","status":"1"}');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_option`
--

DROP TABLE IF EXISTS `mcc_option`;
CREATE TABLE `mcc_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_option`
--

INSERT INTO `mcc_option` (`option_id`, `type`, `sort_order`) VALUES
(10, 'datetime', 9),
(9, 'time', 8),
(8, 'date', 7),
(7, 'file', 6),
(6, 'textarea', 5),
(5, 'select', 4),
(4, 'text', 3),
(2, 'checkbox', 2),
(1, 'radio', 1),
(11, 'select', 10),
(12, 'date', 11);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_option_description`
--

DROP TABLE IF EXISTS `mcc_option_description`;
CREATE TABLE `mcc_option_description` (
  `option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`option_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_option_description`
--

INSERT INTO `mcc_option_description` (`option_id`, `language_id`, `name`) VALUES
(10, 1, '日期 &amp; 时间'),
(9, 3, '时间'),
(9, 2, 'Time'),
(9, 1, '时间'),
(8, 3, '日期'),
(8, 2, 'Date'),
(8, 1, '日期'),
(7, 3, '文件'),
(7, 2, 'File'),
(7, 1, '文件'),
(6, 3, '文本区块'),
(6, 2, 'Textarea'),
(6, 1, '文本区块'),
(5, 3, '下拉列表'),
(5, 2, 'Select'),
(5, 1, '下拉列表'),
(1, 3, '单选按钮组'),
(2, 1, '复选框'),
(2, 2, 'Checkbox'),
(2, 3, '复选框'),
(4, 1, '文本'),
(4, 2, 'Text'),
(4, 3, '文本'),
(1, 2, 'Radio'),
(1, 1, '单选按钮组'),
(10, 2, 'Date &amp; Time'),
(10, 3, '日期 &amp; 时间'),
(11, 1, '尺寸'),
(11, 2, 'Size'),
(11, 3, '尺寸'),
(12, 1, '配送日期'),
(12, 2, 'Delivery Date'),
(12, 3, '配送日期');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_option_value`
--

DROP TABLE IF EXISTS `mcc_option_value`;
CREATE TABLE `mcc_option_value` (
  `option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`option_value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_option_value`
--

INSERT INTO `mcc_option_value` (`option_value_id`, `option_id`, `image`, `sort_order`) VALUES
(40, 5, '', 2),
(39, 5, '', 1),
(23, 2, '', 1),
(24, 2, '', 2),
(44, 2, '', 3),
(45, 2, '', 4),
(43, 1, '', 3),
(32, 1, '', 1),
(31, 1, '', 2),
(41, 5, '', 3),
(42, 5, '', 4),
(46, 11, '', 1),
(47, 11, '', 2),
(48, 11, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_option_value_description`
--

DROP TABLE IF EXISTS `mcc_option_value_description`;
CREATE TABLE `mcc_option_value_description` (
  `option_value_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`option_value_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_option_value_description`
--

INSERT INTO `mcc_option_value_description` (`option_value_id`, `language_id`, `option_id`, `name`) VALUES
(41, 1, 5, '绿色'),
(40, 3, 5, '蓝色'),
(40, 2, 5, 'Blue'),
(40, 1, 5, '蓝色'),
(39, 3, 5, '红色'),
(39, 2, 5, 'Red'),
(39, 1, 5, '红色'),
(45, 3, 2, '复选框4'),
(24, 3, 2, '复选框2'),
(44, 1, 2, '复选框3'),
(44, 2, 2, '复选框3'),
(44, 3, 2, '复选框3'),
(45, 1, 2, '复选框4'),
(45, 2, 2, '复选框4'),
(24, 2, 2, '复选框2'),
(24, 1, 2, '复选框2'),
(32, 2, 1, 'Small'),
(32, 3, 1, '小'),
(43, 1, 1, '大'),
(43, 2, 1, 'Large'),
(43, 3, 1, '大'),
(23, 1, 2, '复选框1'),
(23, 2, 2, '复选框1'),
(23, 3, 2, '复选框1'),
(32, 1, 1, '小'),
(31, 3, 1, '中'),
(31, 2, 1, 'Medium'),
(31, 1, 1, '中'),
(41, 2, 5, 'Green'),
(41, 3, 5, '绿色'),
(42, 1, 5, '黄色'),
(42, 2, 5, 'Yellow'),
(42, 3, 5, '黄色'),
(46, 1, 11, '小号'),
(46, 2, 11, 'Small'),
(46, 3, 11, '小号'),
(47, 1, 11, '中号'),
(47, 2, 11, 'Medium'),
(47, 3, 11, '中号'),
(48, 1, 11, '大号'),
(48, 2, 11, 'Large'),
(48, 3, 11, '大号');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_order`
--

DROP TABLE IF EXISTS `mcc_order`;
CREATE TABLE `mcc_order` (
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
  `payment_district` varchar(128) NOT NULL,
  `payment_district_id` int(11) NOT NULL,
  `payment_city` varchar(128) NOT NULL,
  `payment_city_id` int(11) NOT NULL,
  `payment_postcode` varchar(10) NOT NULL,
  `payment_country` varchar(128) NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(128) NOT NULL,
  `payment_zone_id` int(11) NOT NULL,
  `payment_address_format` text NOT NULL,
  `payment_custom_field` text NOT NULL,
  `payment_method` varchar(128) NOT NULL,
  `payment_code` varchar(128) NOT NULL,
  `payment_telephone` varchar(32) NOT NULL,
  `shipping_firstname` varchar(32) NOT NULL,
  `shipping_lastname` varchar(32) NOT NULL,
  `shipping_company` varchar(40) NOT NULL,
  `shipping_address_1` varchar(128) NOT NULL,
  `shipping_address_2` varchar(128) NOT NULL,
  `shipping_district` varchar(128) NOT NULL,
  `shipping_district_id` int(11) NOT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_city_id` int(11) NOT NULL,
  `shipping_postcode` varchar(10) NOT NULL,
  `shipping_country` varchar(128) NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_zone` varchar(128) NOT NULL,
  `shipping_zone_id` int(11) NOT NULL,
  `shipping_address_format` text NOT NULL,
  `shipping_custom_field` text NOT NULL,
  `shipping_method` varchar(128) NOT NULL,
  `shipping_code` varchar(128) NOT NULL,
  `shipping_telephone` varchar(32) NOT NULL,
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
-- Table structure for table `mcc_order_history`
--

DROP TABLE IF EXISTS `mcc_order_history`;
CREATE TABLE `mcc_order_history` (
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
-- Table structure for table `mcc_order_option`
--

DROP TABLE IF EXISTS `mcc_order_option`;
CREATE TABLE `mcc_order_option` (
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
-- Table structure for table `mcc_order_product`
--

DROP TABLE IF EXISTS `mcc_order_product`;
CREATE TABLE `mcc_order_product` (
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
  PRIMARY KEY (`order_product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_order_recurring`
--

DROP TABLE IF EXISTS `mcc_order_recurring`;
CREATE TABLE `mcc_order_recurring` (
  `order_recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `recurring_name` varchar(255) NOT NULL,
  `recurring_description` varchar(255) NOT NULL,
  `recurring_frequency` varchar(25) NOT NULL,
  `recurring_cycle` smallint(6) NOT NULL,
  `recurring_duration` smallint(6) NOT NULL,
  `recurring_price` decimal(10,4) NOT NULL,
  `trial` tinyint(1) NOT NULL,
  `trial_frequency` varchar(25) NOT NULL,
  `trial_cycle` smallint(6) NOT NULL,
  `trial_duration` smallint(6) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_recurring_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_order_recurring_transaction`
--

DROP TABLE IF EXISTS `mcc_order_recurring_transaction`;
CREATE TABLE `mcc_order_recurring_transaction` (
  `order_recurring_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_recurring_id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`order_recurring_transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_order_shipment`
--

DROP TABLE IF EXISTS `mcc_order_shipment`;
CREATE TABLE `mcc_order_shipment` (
  `order_shipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `shipping_courier_id` varchar(255) NOT NULL DEFAULT '',
  `tracking_number` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`order_shipment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_order_status`
--

DROP TABLE IF EXISTS `mcc_order_status`;
CREATE TABLE `mcc_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`order_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_order_status`
--

INSERT INTO `mcc_order_status` (`order_status_id`, `language_id`, `name`) VALUES
(2, 3, '处理中'),
(7, 3, '已取消'),
(10, 3, '失败'),
(11, 3, '已退款'),
(3, 3, '已配送'),
(16, 3, '无效'),
(15, 3, '已处理'),
(14, 3, '失效'),
(8, 3, '已拒绝'),
(1, 3, '等待处理'),
(2, 2, 'Processing'),
(3, 2, 'Shipped'),
(7, 2, 'Canceled'),
(5, 2, 'Complete'),
(8, 2, 'Denied'),
(9, 2, 'Canceled Reversal'),
(10, 2, 'Failed'),
(11, 2, 'Refunded'),
(13, 2, 'Chargeback'),
(1, 2, 'Pending '),
(16, 2, 'Voided'),
(15, 2, 'Processed'),
(14, 2, 'Expired'),
(2, 1, '处理中'),
(3, 1, '已配送'),
(7, 1, '已取消'),
(5, 1, '完成'),
(8, 1, '已拒绝'),
(9, 1, '撤销取消'),
(10, 1, '失败'),
(11, 1, '已退款'),
(13, 1, '拒付'),
(1, 1, '等待处理'),
(16, 1, '无效'),
(15, 1, '已处理'),
(14, 1, '失效'),
(9, 3, '撤销取消'),
(13, 3, '拒付'),
(5, 3, '完成');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_order_total`
--

DROP TABLE IF EXISTS `mcc_order_total`;
CREATE TABLE `mcc_order_total` (
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
-- Table structure for table `mcc_order_voucher`
--

DROP TABLE IF EXISTS `mcc_order_voucher`;
CREATE TABLE `mcc_order_voucher` (
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
-- Table structure for table `mcc_press`
--

DROP TABLE IF EXISTS `mcc_press`;
CREATE TABLE `mcc_press` (
  `press_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`press_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press`
--

INSERT INTO `mcc_press` (`press_id`, `image`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(1, '', 1, 1, '2015-12-29 19:27:12', '2017-08-31 07:45:54'),
(2, '', 2, 1, '2016-02-18 14:02:30', '2016-02-18 14:02:51'),
(3, '', 1, 1, '2016-02-18 14:35:34', '2016-08-22 12:06:23'),
(4, '', 1, 1, '2016-02-25 10:35:26', '2016-08-22 12:06:16'),
(5, '', 1, 1, '2016-02-25 10:40:23', '2016-08-22 12:06:23'),
(6, '', 1, 1, '2016-02-25 10:40:51', '2016-08-22 12:06:23'),
(7, '', 1, 1, '2016-02-25 10:41:20', '2016-08-22 12:06:23'),
(8, '', 1, 1, '2016-02-25 10:41:47', '2016-08-22 12:06:23'),
(9, '', 1, 1, '2016-02-25 10:42:17', '2016-08-22 12:06:23'),
(10, '', 1, 1, '2016-02-25 10:42:48', '2016-08-22 12:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_category`
--

DROP TABLE IF EXISTS `mcc_press_category`;
CREATE TABLE `mcc_press_category` (
  `press_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`press_category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_category`
--

INSERT INTO `mcc_press_category` (`press_category_id`, `image`, `parent_id`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(1, '', 0, 0, 1, '2015-12-29 19:20:03', '2017-08-31 14:11:45'),
(2, 'catalog/demo/28_2.jpg', 0, 0, 1, '2015-12-29 19:25:58', '2017-08-31 14:18:41'),
(7, 'catalog/demo/apple_logo.jpg', 0, 0, 1, '2017-08-31 14:24:10', '2017-08-31 14:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_category_description`
--

DROP TABLE IF EXISTS `mcc_press_category_description`;
CREATE TABLE `mcc_press_category_description` (
  `press_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`press_category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_category_description`
--

INSERT INTO `mcc_press_category_description` (`press_category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 2, '新闻分类一', '&lt;p&gt;新闻分类一&lt;br&gt;&lt;/p&gt;', '新闻分类一', '新闻分类一', '新闻分类一'),
(1, 1, '新闻分类一', '&lt;p&gt;新闻分类一&lt;br&gt;&lt;/p&gt;', '新闻分类一', '新闻分类一', '新闻分类一'),
(1, 3, '新闻分类一', '&lt;p&gt;新闻分类一&lt;br&gt;&lt;/p&gt;', '新闻分类一', '新闻分类一', '新闻分类一'),
(2, 3, '新闻分类二', '&lt;p&gt;新闻分类二&lt;br&gt;&lt;/p&gt;', '新闻分类二', '新闻分类二', '新闻分类二'),
(2, 1, '新闻分类二', '&lt;p&gt;新闻分类二&lt;br&gt;&lt;/p&gt;', '新闻分类二', '新闻分类二', '新闻分类二'),
(2, 2, 'Press Category Two', '&lt;p&gt;Press Category Two&lt;br&gt;&lt;/p&gt;', 'Press Category Two', 'Press Category Two', 'Press Category Two'),
(7, 2, 'Press Category Three', '&lt;p&gt;Press Category Three&lt;br&gt;&lt;/p&gt;', 'Press Category Three', 'Press Category Three', 'Press Category Three'),
(7, 1, '新闻分类三', '&lt;p&gt;新闻分类三&lt;br&gt;&lt;/p&gt;', '新闻分类三', '新闻分类三', '新闻分类三'),
(7, 3, '新闻分类三', '&lt;p&gt;新闻分类三&lt;br&gt;&lt;/p&gt;', '新闻分类三', '新闻分类三', '新闻分类三');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_category_path`
--

DROP TABLE IF EXISTS `mcc_press_category_path`;
CREATE TABLE `mcc_press_category_path` (
  `press_category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`press_category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_category_path`
--

INSERT INTO `mcc_press_category_path` (`press_category_id`, `path_id`, `level`) VALUES
(1, 1, 0),
(2, 2, 0),
(7, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_category_to_layout`
--

DROP TABLE IF EXISTS `mcc_press_category_to_layout`;
CREATE TABLE `mcc_press_category_to_layout` (
  `press_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`press_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_category_to_layout`
--

INSERT INTO `mcc_press_category_to_layout` (`press_category_id`, `store_id`, `layout_id`) VALUES
(1, 0, 0),
(2, 0, 0),
(7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_category_to_store`
--

DROP TABLE IF EXISTS `mcc_press_category_to_store`;
CREATE TABLE `mcc_press_category_to_store` (
  `press_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`press_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_category_to_store`
--

INSERT INTO `mcc_press_category_to_store` (`press_category_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_description`
--

DROP TABLE IF EXISTS `mcc_press_description`;
CREATE TABLE `mcc_press_description` (
  `press_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`press_id`,`language_id`),
  KEY `name` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_description`
--

INSERT INTO `mcc_press_description` (`press_id`, `language_id`, `title`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 2, 'press 1', '&lt;p&gt;press 1&lt;br&gt;&lt;/p&gt;', 'press 1', 'press 1', 'press 1'),
(1, 1, '新闻一', '&lt;p&gt;新闻一&lt;br&gt;&lt;/p&gt;', '新闻一', '新闻一', '新闻一'),
(1, 3, '新闻一', '&lt;p&gt;新闻一&lt;br&gt;&lt;/p&gt;', '新闻一', '新闻一', '新闻一'),
(2, 3, '新闻二', '&lt;p&gt;新闻二&lt;br&gt;&lt;/p&gt;', '新闻二', '新闻二', '新闻二'),
(2, 2, '新闻二', '&lt;p&gt;新闻二&lt;br&gt;&lt;/p&gt;', '新闻二', '新闻二', '新闻二'),
(2, 1, '新闻二', '&lt;p&gt;新闻二&lt;br&gt;&lt;/p&gt;', '新闻二', '新闻二', '新闻二'),
(3, 1, '新闻三', '&lt;p&gt;新闻三&lt;br&gt;&lt;/p&gt;', '新闻三', '新闻三', '新闻三'),
(3, 2, '新闻三', '&lt;p&gt;新闻三&lt;br&gt;&lt;/p&gt;', '新闻三', '新闻三', '新闻三'),
(3, 3, '新闻三', '&lt;p&gt;新闻三&lt;br&gt;&lt;/p&gt;', '新闻三', '新闻三', '新闻三'),
(4, 3, '新闻4', '&lt;p&gt;新闻4&lt;br&gt;&lt;/p&gt;', '新闻4', '新闻4', '新闻4'),
(4, 2, '新闻4', '&lt;p&gt;新闻4&lt;br&gt;&lt;/p&gt;', '新闻4', '新闻4', '新闻4'),
(4, 1, '新闻4', '&lt;p&gt;新闻4&lt;br&gt;&lt;/p&gt;', '新闻4', '新闻4', '新闻4'),
(5, 3, '新闻5', '&lt;p&gt;新闻5&lt;br&gt;&lt;/p&gt;', '新闻5', '新闻5', '新闻5'),
(5, 2, '新闻5', '&lt;p&gt;新闻5&lt;br&gt;&lt;/p&gt;', '新闻5', '新闻5', '新闻5'),
(5, 1, '新闻5', '&lt;p&gt;新闻5&lt;br&gt;&lt;/p&gt;', '新闻5', '新闻5', '新闻5'),
(6, 1, '新闻6', '&lt;p&gt;新闻6&lt;br&gt;&lt;/p&gt;', '新闻6', '新闻6', '新闻6'),
(6, 2, '新闻6', '&lt;p&gt;新闻6&lt;br&gt;&lt;/p&gt;', '新闻6', '新闻6', '新闻6'),
(6, 3, '新闻6', '&lt;p&gt;新闻6&lt;br&gt;&lt;/p&gt;', '新闻6', '新闻6', '新闻6'),
(7, 1, '新闻7', '&lt;p&gt;新闻7&lt;br&gt;&lt;/p&gt;', '新闻7', '新闻7', '新闻7'),
(7, 2, '新闻7', '&lt;p&gt;新闻7&lt;br&gt;&lt;/p&gt;', '新闻7', '新闻7', '新闻7'),
(7, 3, '新闻7', '&lt;p&gt;新闻7&lt;br&gt;&lt;/p&gt;', '新闻7', '新闻7', '新闻7'),
(8, 1, '新闻8', '&lt;p&gt;新闻8&lt;br&gt;&lt;/p&gt;', '新闻8', '新闻8', '新闻8'),
(8, 2, '新闻8', '&lt;p&gt;新闻8&lt;br&gt;&lt;/p&gt;', '新闻8', '新闻8', '新闻8'),
(8, 3, '新闻8', '&lt;p&gt;新闻8&lt;br&gt;&lt;/p&gt;', '新闻8', '新闻8', '新闻8'),
(9, 1, '新闻9', '&lt;p&gt;新闻9&lt;br&gt;&lt;/p&gt;', '新闻9', '新闻9', '新闻9'),
(9, 2, '新闻9', '&lt;p&gt;新闻9&lt;br&gt;&lt;/p&gt;', '新闻9', '新闻9', '新闻9'),
(9, 3, '新闻9', '&lt;p&gt;新闻9&lt;br&gt;&lt;/p&gt;', '新闻9', '新闻9', '新闻9'),
(10, 3, '新闻10', '&lt;p&gt;新闻10&lt;br&gt;&lt;/p&gt;', '新闻10', '新闻10', '新闻10'),
(10, 2, '新闻10', '&lt;p&gt;新闻10&lt;br&gt;&lt;/p&gt;', '新闻10', '新闻10', '新闻10'),
(10, 1, '新闻10', '&lt;p&gt;新闻10&lt;br&gt;&lt;/p&gt;', '新闻10', '新闻10', '新闻10');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_product`
--

DROP TABLE IF EXISTS `mcc_press_product`;
CREATE TABLE `mcc_press_product` (
  `press_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  UNIQUE KEY `press_id` (`press_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_product`
--

INSERT INTO `mcc_press_product` (`press_id`, `related_id`) VALUES
(1, 28),
(1, 41),
(1, 42),
(1, 47),
(1, 48),
(2, 41),
(2, 47),
(11, 41);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_to_layout`
--

DROP TABLE IF EXISTS `mcc_press_to_layout`;
CREATE TABLE `mcc_press_to_layout` (
  `press_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`press_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_to_layout`
--

INSERT INTO `mcc_press_to_layout` (`press_id`, `store_id`, `layout_id`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_to_press_category`
--

DROP TABLE IF EXISTS `mcc_press_to_press_category`;
CREATE TABLE `mcc_press_to_press_category` (
  `press_id` int(11) NOT NULL,
  `press_category_id` int(11) NOT NULL,
  PRIMARY KEY (`press_id`,`press_category_id`),
  KEY `press_category_id` (`press_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_to_press_category`
--

INSERT INTO `mcc_press_to_press_category` (`press_id`, `press_category_id`) VALUES
(1, 2),
(2, 2),
(3, 1),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_press_to_store`
--

DROP TABLE IF EXISTS `mcc_press_to_store`;
CREATE TABLE `mcc_press_to_store` (
  `press_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`press_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_press_to_store`
--

INSERT INTO `mcc_press_to_store` (`press_id`, `store_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product`
--

DROP TABLE IF EXISTS `mcc_product`;
CREATE TABLE `mcc_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(64) NOT NULL,
  `sku` varchar(64) NOT NULL,
  `upc` varchar(12) NOT NULL,
  `ean` varchar(14) NOT NULL,
  `jan` varchar(13) NOT NULL,
  `isbn` varchar(17) NOT NULL,
  `mpn` varchar(64) NOT NULL,
  `location` varchar(128) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `shipping` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `points` int(8) NOT NULL DEFAULT '0',
  `tax_class_id` int(11) NOT NULL,
  `date_available` date NOT NULL DEFAULT '0000-00-00',
  `weight` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `weight_class_id` int(11) NOT NULL DEFAULT '0',
  `length` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `width` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `height` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `length_class_id` int(11) NOT NULL DEFAULT '0',
  `subtract` tinyint(1) NOT NULL DEFAULT '1',
  `minimum` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product`
--

INSERT INTO `mcc_product` (`product_id`, `model`, `sku`, `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, `quantity`, `stock_status_id`, `image`, `manufacturer_id`, `shipping`, `price`, `points`, `tax_class_id`, `date_available`, `weight`, `weight_class_id`, `length`, `width`, `height`, `length_class_id`, `subtract`, `minimum`, `sort_order`, `status`, `viewed`, `date_added`, `date_modified`) VALUES
(47, 'Product 7', '', '', '', '', '', '', '', 1000, 5, 'catalog/demo/product/product_2/product2_1.jpg', 7, 1, '1.0000', 400, 0, '2009-02-03', '1.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 0, 1, 0, 1, 46, '2009-02-03 21:08:40', '2016-08-23 08:54:32'),
(46, 'Product 3', '', '', '', '', '', '', '', 1000, 5, 'catalog/demo/product/product16/product16_1.jpg', 10, 1, '1.0000', 0, 0, '2009-02-03', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 27, '2009-02-03 21:08:29', '2016-08-23 09:56:36'),
(45, 'Product 5', '', '', '', '', '', '', '', 998, 5, 'catalog/demo/product/product_11/product11_1.jpg', 8, 1, '2.0000', 0, 0, '2009-02-03', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 29, '2009-02-03 21:08:17', '2016-08-23 08:54:02'),
(44, 'Product 9', '', '', '', '', '', '', '', 1000, 5, 'catalog/demo/product/product_10/product10_1.jpg', 8, 1, '2.0000', 0, 0, '2009-02-03', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 28, '2009-02-03 21:08:00', '2016-08-23 08:55:07'),
(43, 'Product 8', '', '', '', '', '', '', '', 999975, 5, 'catalog/demo/product/product_9/product9_1.jpg', 8, 0, '0.0100', 0, 0, '2009-02-03', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 73, '2009-02-03 21:07:49', '2017-09-03 05:00:16'),
(42, 'Product 1', '', '', '', '', '', '', '', 990, 5, 'catalog/demo/product/product_1/product1_1.jpg', 8, 1, '100.0000', 400, 0, '2009-02-04', '12.50000000', 1, '1.00000000', '2.00000000', '3.00000000', 1, 1, 2, 0, 1, 77, '2009-02-03 21:07:37', '2017-07-16 19:43:42'),
(41, 'Product 4', '', '', '', '', '', '', '', 977, 5, 'catalog/demo/product/product_4/product4_1.jpg', 8, 1, '1.0000', 0, 0, '2009-02-03', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, 41, '2009-02-03 21:07:26', '2016-08-23 08:53:47'),
(40, 'Product 19', '', '', '', '', '', '', '', 956, 5, 'catalog/demo/product/product19/product19_1.jpg', 8, 1, '6.9900', 0, 0, '2009-02-03', '10.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, 111, '2009-02-03 21:07:12', '2016-08-23 08:58:04'),
(36, 'Product 6', '', '', '', '', '', '', '', 994, 6, 'catalog/demo/product/product_6/product6_1.jpg', 8, 0, '1.0000', 100, 0, '2009-02-03', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 42, '2009-02-03 18:09:19', '2016-08-23 08:54:16'),
(35, 'Product 10', '', '', '', '', '', '', '', 1000, 5, 'catalog/demo/product/product_14/product14_1.jpg', 0, 0, '1.0000', 0, 0, '2009-02-03', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, 15, '2009-02-03 18:08:31', '2016-08-23 08:55:32'),
(34, 'Product 15', '', '', '', '', '', '', '', 1000, 6, 'catalog/demo/product/product_7/product7_1.jpg', 8, 1, '1.0000', 0, 0, '2009-02-03', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 54, '2009-02-03 18:07:54', '2016-08-23 08:56:50'),
(33, 'Product 2', '', '', '', '', '', '', '', 1000, 6, 'catalog/demo/product/product17/product17_1.jpg', 0, 1, '1.0000', 0, 0, '2009-02-03', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 20, '2009-02-03 17:08:31', '2016-08-23 09:56:25'),
(32, 'Product 11', '', '', '', '', '', '', '', 999, 6, 'catalog/demo/product/product_8/product8_1.jpg', 8, 1, '1.0000', 0, 9, '2009-02-03', '5.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, 37, '2009-02-03 17:07:26', '2016-08-23 08:55:50'),
(31, 'Product 12', '', '', '', '', '', '', '', 1000, 6, 'catalog/demo/product/product_12/product12_1.jpg', 0, 1, '1.0000', 0, 0, '2009-02-03', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 3, 1, 1, 0, 1, 30, '2009-02-03 17:00:10', '2016-08-23 08:56:07'),
(30, 'Product 13', '', '', '', '', '', '', '', 2, 6, 'catalog/demo/product/product21/product21_1.jpg', 9, 1, '100.0000', 0, 0, '2009-02-03', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, 70, '2009-02-03 16:59:00', '2017-07-16 19:44:40'),
(29, 'Product 14', '', '', '', '', '', '', '', 999, 6, 'catalog/demo/product/product_13/product13_1.jpg', 6, 1, '1.9900', 0, 0, '2009-02-03', '133.00000000', 2, '0.00000000', '0.00000000', '0.00000000', 3, 1, 1, 0, 1, 32, '2009-02-03 16:42:17', '2016-08-23 08:56:28'),
(28, 'Product 17', '', '', '', '', '', '', '', 939, 7, 'catalog/demo/product/product_3/product3_1.jpg', 5, 1, '0.9900', 200, 0, '2009-02-03', '146.40000000', 2, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 0, 1, 30, '2009-02-03 16:06:50', '2016-08-23 08:57:18'),
(48, 'Product 18', 'test 1', '', '', '', '', '', 'test 2', 995, 5, 'catalog/demo/product/product_5/product5_1.jpg', 8, 1, '2.9900', 0, 0, '2009-02-08', '1.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 2, 1, 1, 0, 1, 38, '2009-02-08 17:21:51', '2016-08-23 08:57:42'),
(49, 'Product 16', '', '', '', '', '', '', '', 0, 8, 'catalog/demo/product/product15/product15_1.jpg', 0, 1, '199.9900', 0, 0, '2011-04-25', '0.00000000', 1, '0.00000000', '0.00000000', '0.00000000', 1, 1, 1, 1, 1, 52, '2011-04-26 08:57:34', '2016-08-13 14:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_attribute`
--

DROP TABLE IF EXISTS `mcc_product_attribute`;
CREATE TABLE `mcc_product_attribute` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`product_id`,`attribute_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_attribute`
--

INSERT INTO `mcc_product_attribute` (`product_id`, `attribute_id`, `language_id`, `text`) VALUES
(43, 4, 1, '8gb'),
(43, 4, 2, '8gb'),
(42, 3, 2, '100mhz'),
(42, 3, 1, '100mhz'),
(42, 3, 3, '100mhz'),
(43, 2, 3, '1'),
(47, 4, 2, '16GB'),
(47, 4, 1, '16GB'),
(47, 4, 3, '16GB'),
(47, 2, 3, '4'),
(47, 2, 2, '4'),
(47, 2, 1, '4'),
(43, 2, 1, '1'),
(43, 2, 2, '1'),
(43, 4, 3, '8gb');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_description`
--

DROP TABLE IF EXISTS `mcc_product_description`;
CREATE TABLE `mcc_product_description` (
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_description`
--

INSERT INTO `mcc_product_description` (`product_id`, `language_id`, `name`, `description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(47, 3, '木藝設計', '&lt;p&gt;\n	Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Monitor. This flagship monitor features best-in-class performance and presentation features on a huge wide-aspect screen while letting you work as comfortably as possible - you might even forget you&#039;re at the office&lt;/p&gt;\n', '', 'HP LP3065', '', ''),
(45, 3, '時尚儲物櫃', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		&lt;p&gt;\n			&lt;b&gt;Latest Intel mobile architecture&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Powered by the most advanced mobile processors from Intel, the new Core 2 Duo MacBook Pro is over 50% faster than the original Core Duo MacBook Pro and now supports up to 4GB of RAM.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Leading-edge graphics&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			The NVIDIA GeForce 8600M GT delivers exceptional graphics processing power. For the ultimate creative canvas, you can even configure the 17-inch model with a 1920-by-1200 resolution display.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Designed for life on the road&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Innovations such as a magnetic power connection and an illuminated keyboard with ambient light sensor put the MacBook Pro in a class by itself.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Connect. Create. Communicate.&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Quickly set up a video conference with the built-in iSight camera. Control presentations and media from up to 30 feet away with the included Apple Remote. Connect to high-bandwidth peripherals with FireWire 800 and DVI.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Next-generation wireless&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Featuring 802.11n wireless technology, the MacBook Pro delivers up to five times the performance and up to twice the range of previous-generation technologies.&lt;/p&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', 'MacBook Pro', '', ''),
(46, 1, '复古镂空展厨', '&lt;div&gt;\n	Unprecedented power. The next generation of processing technology has arrived. Built into the newest VAIO notebooks lies Intel&amp;#39;s latest, most powerful innovation yet: Intel&amp;reg; Centrino&amp;reg; 2 processor technology. Boasting incredible speed, expanded wireless connectivity, enhanced multimedia support and greater energy efficiency, all the high-performance essentials are seamlessly combined into a single chip.&lt;/div&gt;\n', '', '复古镂空展厨', '复古镂空展厨', '复古镂空展厨'),
(46, 2, 'Sony VAIO', '&lt;div&gt;\n	Unprecedented power. The next generation of processing technology has arrived. Built into the newest VAIO notebooks lies Intel&amp;#39;s latest, most powerful innovation yet: Intel&amp;reg; Centrino&amp;reg; 2 processor technology. Boasting incredible speed, expanded wireless connectivity, enhanced multimedia support and greater energy efficiency, all the high-performance essentials are seamlessly combined into a single chip.&lt;/div&gt;\n', '', 'Sony VAIO', '', ''),
(46, 3, '復古鏤空展廚', '&lt;div&gt;\n	Unprecedented power. The next generation of processing technology has arrived. Built into the newest VAIO notebooks lies Intel&amp;#39;s latest, most powerful innovation yet: Intel&amp;reg; Centrino&amp;reg; 2 processor technology. Boasting incredible speed, expanded wireless connectivity, enhanced multimedia support and greater energy efficiency, all the high-performance essentials are seamlessly combined into a single chip.&lt;/div&gt;\n', '', 'Sony VAIO', '', ''),
(47, 1, '木艺设计', '&lt;p&gt;\n	Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Monitor. This flagship monitor features best-in-class performance and presentation features on a huge wide-aspect screen while letting you work as comfortably as possible - you might even forget you&#039;re at the office&lt;/p&gt;\n', '', ' 木艺设计', '木艺设计', '木艺设计'),
(47, 2, 'HP LP3065', '&lt;p&gt;\n	Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel Monitor. This flagship monitor features best-in-class performance and presentation features on a huge wide-aspect screen while letting you work as comfortably as possible - you might even forget you&#039;re at the office&lt;/p&gt;\n', '', 'HP LP3065', '', ''),
(42, 3, '包式座椅', '&lt;p&gt;AMD 785G，一个定位于AMD 780G和AMD \n790GX之间的产品，近期成为所有主板厂商推广的重点，同时也是所有DIY用户关注的焦点。抛开其整合DirectX 10.1规格的Radeon \nHD 4200图形显示核心不提，全新升级的UVD2.0高清解码引擎，让AMD \n785G更适合高清应用。诚然，目前在卖场里攒HTPC专用电脑的人并不多，但随着广大民众生活水平的不断提高，这种个性化应用必将是未来大势所趋，故在\nAMD 785G上设计更多的HTPC应用功能，也成为有实力的主板品牌必须做的一件事。&lt;/p&gt;&lt;p&gt;一向以代工著称的富士康在个性化产品上的设计近年来有了很大的改观，除了推出面向超频玩家的&quot;Quantum Force（量子力量）&quot;系列外，还针对高品质家庭用户推出了Digital Life（数字家庭）系列，其在DIY产品线上的用心程度不言而喻。&lt;br&gt;&lt;/p&gt;', '', 'Apple Cinema 30&quot;', '', ''),
(43, 2, 'MacBook', '&lt;div&gt;\r\n	&lt;p&gt;\r\n		&lt;b&gt;Intel Core 2 Duo processor&lt;/b&gt;&lt;/p&gt;\r\n	&lt;p&gt;\r\n		Powered by an Intel Core 2 Duo processor at speeds up to 2.16GHz, the new MacBook is the fastest ever.&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;b&gt;1GB memory, larger hard drives&lt;/b&gt;&lt;/p&gt;\r\n	&lt;p&gt;\r\n		The new MacBook now comes with 1GB of memory standard and larger hard drives for the entire line perfect for running more of your favorite applications and storing growing media collections.&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;b&gt;Sleek, 1.08-inch-thin design&lt;/b&gt;&lt;/p&gt;\r\n	&lt;p&gt;\r\n		MacBook makes it easy to hit the road thanks to its tough polycarbonate case, built-in wireless technologies, and innovative MagSafe Power Adapter that releases automatically if someone accidentally trips on the cord.&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;b&gt;Built-in iSight camera&lt;/b&gt;&lt;/p&gt;\r\n	&lt;p&gt;\r\n		Right out of the box, you can have a video chat with friends or family,2 record a video at your desk, or take fun pictures with Photo Booth&lt;/p&gt;\r\n&lt;/div&gt;\r\n', '', 'MacBook', '', ''),
(43, 1, '玻璃茶几', '&lt;p&gt;在本次3月份苹果春季新品发布会上，除了最为耀眼的新款MacBook外，苹果还对MacBook Air与13英寸的Retina MacBook Pro进行了常规硬件升级。其中13英寸的Retina MacBook Pro更新最受关注，因为其在性能上做出了许多重大升级，包括第五代Intel Broadwell处理器、Iris 6100核心显卡、读写速度翻倍的PCIe SSD固态硬盘、更高频率的内存，同时电池续航还增加了一个小时。除此之外，它还首先搭载了与新款MacBook一样的全新Force Touch触控板。&lt;/p&gt;&lt;p&gt;由于国行版的13英寸的Retina MacBook Pro现在已经全面铺货，笔者也得以体验到这款搭载全新压感触控设计的触控板。苹果电脑的触控板体验一直很优秀，配合OS X系统中的多指手势操作，可以轻松完成拖拽文件、切换应用程序、切换不同桌面等操作。如今压力感应操作的加入可以说在原本多指手势的基础上加入了一个全新的维度，使得在触控板上可以进行更多的操作命令。&lt;/p&gt;&lt;p&gt;苹果如此重视笔记本电脑上触控板的用户体验，使得MacBook用户几乎可以不用鼠标，也提升了用户的便利性。由于其长续航的特性，外出也基本不需要携带电源，只需要带一台笔记本就足够。笔者在体验了一天2015款苹果MacBook Pro后，写下这篇评测文章，希望能给关注这款产品的网友一些参考&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;', '', '玻璃茶几', '玻璃茶几', '玻璃茶几'),
(43, 3, '玻璃茶幾', '&lt;p&gt;在本次3月份苹果春季新品发布会上，除了最为耀眼的新款MacBook外，苹果还对MacBook Air与13英寸的Retina \r\nMacBook Pro进行了常规硬件升级。其中13英寸的Retina MacBook \r\nPro更新最受关注，因为其在性能上做出了许多重大升级，包括第五代Intel Broadwell处理器、Iris \r\n6100核心显卡、读写速度翻倍的PCIe \r\nSSD固态硬盘、更高频率的内存，同时电池续航还增加了一个小时。除此之外，它还首先搭载了与新款MacBook一样的全新Force \r\nTouch触控板。&lt;/p&gt;&lt;p&gt;由于国行版的13英寸的Retina MacBook \r\nPro现在已经全面铺货，笔者也得以体验到这款搭载全新压感触控设计的触控板。苹果电脑的触控板体验一直很优秀，配合OS \r\nX系统中的多指手势操作，可以轻松完成拖拽文件、切换应用程序、切换不同桌面等操作。如今压力感应操作的加入可以说在原本多指手势的基础上加入了一个全新\r\n的维度，使得在触控板上可以进行更多的操作命令。&lt;/p&gt;&lt;p&gt;苹果如此重视笔记本电脑上触控板的用户体验，使得MacBook用户几乎可以不用鼠标，也\r\n提升了用户的便利性。由于其长续航的特性，外出也基本不需要携带电源，只需要带一台笔记本就足够。笔者在体验了一天2015款苹果MacBook \r\nPro后，写下这篇评测文章，希望能给关注这款产品的网友一些参考&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;', '', 'MacBook', '', ''),
(34, 2, 'iPod Shuffle', '&lt;div&gt;\n	&lt;strong&gt;Born to be worn.&lt;/strong&gt;\n	&lt;p&gt;\n		Clip on the worlds most wearable music player and take up to 240 songs with you anywhere. Choose from five colors including four new hues to make your musical fashion statement.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Random meets rhythm.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		With iTunes autofill, iPod shuffle can deliver a new musical experience every time you sync. For more randomness, you can shuffle songs during playback with the slide of a switch.&lt;/p&gt;\n	&lt;strong&gt;Everything is easy.&lt;/strong&gt;\n	&lt;p&gt;\n		Charge and sync with the included USB dock. Operate the iPod shuffle controls with one hand. Enjoy up to 12 hours straight of skip-free music playback.&lt;/p&gt;\n&lt;/div&gt;\n', '', 'iPod Shuffle', '', ''),
(34, 3, '線條式展架', '&lt;div&gt;\n	&lt;strong&gt;Born to be worn.&lt;/strong&gt;\n	&lt;p&gt;\n		Clip on the worlds most wearable music player and take up to 240 songs with you anywhere. Choose from five colors including four new hues to make your musical fashion statement.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Random meets rhythm.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		With iTunes autofill, iPod shuffle can deliver a new musical experience every time you sync. For more randomness, you can shuffle songs during playback with the slide of a switch.&lt;/p&gt;\n	&lt;strong&gt;Everything is easy.&lt;/strong&gt;\n	&lt;p&gt;\n		Charge and sync with the included USB dock. Operate the iPod shuffle controls with one hand. Enjoy up to 12 hours straight of skip-free music playback.&lt;/p&gt;\n&lt;/div&gt;\n', '', 'iPod Shuffle', '', ''),
(35, 1, '真皮座椅', '&lt;p&gt;\n	Product 8&lt;/p&gt;\n', '', '真皮座椅', '真皮座椅', '真皮座椅'),
(35, 2, 'Product 8', '&lt;p&gt;\n	Product 8&lt;/p&gt;\n', '', 'Product 8', '', ''),
(35, 3, '真皮座椅', '&lt;p&gt;\n	Product 8&lt;/p&gt;\n', '', 'Product 8', '', ''),
(36, 1, '时尚简约办公小桌', '&lt;div&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Video in your pocket.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Its the small iPod with one very big idea: video. The worlds most popular music player now lets you enjoy movies, TV shows, and more on a two-inch display thats 65% brighter than before.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Experience a whole new way to browse and view your music and video.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Sleek and colorful.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		With an anodized aluminum and polished stainless steel enclosure and a choice of five colors, iPod nano is dressed to impress.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;iTunes.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Available as a free download, iTunes makes it easy to browse and buy millions of songs, movies, TV shows, audiobooks, and games and download free podcasts all at the iTunes Store. And you can import your own music, manage your whole media library, and sync your iPod or iPhone with ease.&lt;/p&gt;\n&lt;/div&gt;\n', '', '时尚简约办公小桌', '时尚简约办公小桌', '时尚简约办公小桌'),
(36, 2, 'iPod Nano', '&lt;div&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Video in your pocket.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Its the small iPod with one very big idea: video. The worlds most popular music player now lets you enjoy movies, TV shows, and more on a two-inch display thats 65% brighter than before.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Experience a whole new way to browse and view your music and video.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Sleek and colorful.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		With an anodized aluminum and polished stainless steel enclosure and a choice of five colors, iPod nano is dressed to impress.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;iTunes.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Available as a free download, iTunes makes it easy to browse and buy millions of songs, movies, TV shows, audiobooks, and games and download free podcasts all at the iTunes Store. And you can import your own music, manage your whole media library, and sync your iPod or iPhone with ease.&lt;/p&gt;\n&lt;/div&gt;\n', '', 'iPod Nano', '', ''),
(36, 3, '時尚簡約辦公小桌', '&lt;div&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Video in your pocket.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Its the small iPod with one very big idea: video. The worlds most popular music player now lets you enjoy movies, TV shows, and more on a two-inch display thats 65% brighter than before.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Experience a whole new way to browse and view your music and video.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Sleek and colorful.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		With an anodized aluminum and polished stainless steel enclosure and a choice of five colors, iPod nano is dressed to impress.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;iTunes.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		Available as a free download, iTunes makes it easy to browse and buy millions of songs, movies, TV shows, audiobooks, and games and download free podcasts all at the iTunes Store. And you can import your own music, manage your whole media library, and sync your iPod or iPhone with ease.&lt;/p&gt;\n&lt;/div&gt;\n', '', 'iPod Nano', '', ''),
(40, 1, '躺式沙发', '2015年3月6日，苹果iPhone6 Plus（行货）在&quot;拍易得&quot;现货促销，现在在其网上购买苹果iPhone6 Plus仅需95元即可秒杀。这款手机的配件包括：充电器、耳机和数据线等。苹果iPhone6 Plus是一款配置有光学防抖技术的智能手机。', '', '躺式沙发', '躺式沙发', '躺式沙发'),
(40, 2, 'iPhone 6 Plus', 'iPhone is a revolutionary new mobile phone that allows you to make a \ncall by simply tapping a name or number in your address book, a \nfavorites list, or a call log. It also automatically syncs all your \ncontacts from a PC, Mac, or Internet service. And it lets you select and\n listen to voicemail messages in whatever order you want just like \nemail.', '', 'iPhone 6 Plus', '', ''),
(40, 3, '躺式沙發', '2015年3月6日，苹果iPhone6 Plus（行货）在&quot;拍易得&quot;现货促销，现在在其网上购买苹果iPhone6 Plus仅需95元即可秒杀。这款手机的配件包括：充电器、耳机和数据线等。苹果iPhone6 Plus是一款配置有光学防抖技术的智能手机。', '', '苹果iPhone 6 Plus', '', ''),
(41, 1, '布艺沙发', '&lt;div&gt;\n	Just when you thought iMac had everything, now there&acute;s even more. More powerful Intel Core 2 Duo processors. And more memory standard. Combine this with Mac OS X Leopard and iLife &acute;08, and it&acute;s more all-in-one than ever. iMac packs amazing performance into a stunningly slim space.&lt;/div&gt;\n', '', '布艺沙发', '布艺沙发', '布艺沙发'),
(41, 2, 'iMac', '&lt;div&gt;\n	Just when you thought iMac had everything, now there&acute;s even more. More powerful Intel Core 2 Duo processors. And more memory standard. Combine this with Mac OS X Leopard and iLife &acute;08, and it&acute;s more all-in-one than ever. iMac packs amazing performance into a stunningly slim space.&lt;/div&gt;\n', '', 'iMac', '', ''),
(41, 3, '布藝沙發', '&lt;div&gt;\n	Just when you thought iMac had everything, now there&acute;s even more. More powerful Intel Core 2 Duo processors. And more memory standard. Combine this with Mac OS X Leopard and iLife &acute;08, and it&acute;s more all-in-one than ever. iMac packs amazing performance into a stunningly slim space.&lt;/div&gt;\n', '', 'iMac', '', ''),
(42, 1, '包式座椅', '&lt;p&gt;AMD 785G，一个定位于AMD 780G和AMD \n790GX之间的产品，近期成为所有主板厂商推广的重点，同时也是所有DIY用户关注的焦点。抛开其整合DirectX 10.1规格的Radeon \nHD 4200图形显示核心不提，全新升级的UVD2.0高清解码引擎，让AMD \n785G更适合高清应用。诚然，目前在卖场里攒HTPC专用电脑的人并不多，但随着广大民众生活水平的不断提高，这种个性化应用必将是未来大势所趋，故在\nAMD 785G上设计更多的HTPC应用功能，也成为有实力的主板品牌必须做的一件事。&lt;/p&gt;&lt;p&gt;一向以代工著称的富士康在个性化产品上的设计近年来有了很大的改观，除了推出面向超频玩家的&quot;Quantum Force（量子力量）&quot;系列外，还针对高品质家庭用户推出了Digital Life（数字家庭）系列，其在DIY产品线上的用心程度不言而喻。&lt;br&gt;&lt;/p&gt;', '', '包式座椅', '包式座椅', '包式座椅'),
(42, 2, 'Apple Cinema 30&quot;', '&lt;p&gt;\n	&lt;font size=&quot;2&quot; face=&quot;helvetica,geneva,arial&quot;&gt;&lt;font size=&quot;2&quot; face=&quot;Helvetica&quot;&gt;The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed specifically for the creative professional, this display provides more space for easier access to all the tools and palettes needed to edit, format and composite your work. Combine this display with a Mac Pro, MacBook Pro, or PowerMac G5 and there&#039;s no limit to what you can achieve. &lt;br&gt;\n	&lt;br&gt;\n	&lt;/font&gt;&lt;font size=&quot;2&quot; face=&quot;Helvetica&quot;&gt;The Cinema HD features an active-matrix liquid crystal display that produces flicker-free images that deliver twice the brightness, twice the sharpness and twice the contrast ratio of a typical CRT display. Unlike other flat panels, it&#039;s designed with a pure digital interface to deliver distortion-free images that never need adjusting. With over 4 million digital pixels, the display is uniquely suited for scientific and technical applications such as visualizing molecular structures or analyzing geological data. &lt;br&gt;\n	&lt;br&gt;\n	&lt;/font&gt;&lt;font size=&quot;2&quot; face=&quot;Helvetica&quot;&gt;Offering accurate, brilliant color performance, the Cinema HD delivers up to 16.7 million colors across a wide gamut allowing you to see subtle nuances between colors from soft pastels to rich jewel tones. A wide viewing angle ensures uniform color from edge to edge. Apple&#039;s ColorSync technology allows you to create custom profiles to maintain consistent color onscreen and in print. The result: You can confidently use this display in all your color-critical applications. &lt;br&gt;\n	&lt;br&gt;\n	&lt;/font&gt;&lt;font size=&quot;2&quot; face=&quot;Helvetica&quot;&gt;Housed in a new aluminum design, the display has a very thin bezel that enhances visual accuracy. Each display features two FireWire 400 ports and two USB 2.0 ports, making attachment of desktop peripherals, such as iSight, iPod, digital and still cameras, hard drives, printers and scanners, even more accessible and convenient. Taking advantage of the much thinner and lighter footprint of an LCD, the new displays support the VESA (Video Electronics Standards Association) mounting interface standard. Customers with the optional Cinema Display VESA Mount Adapter kit gain the flexibility to mount their display in locations most appropriate for their work environment. &lt;br&gt;\n	&lt;br&gt;\n	&lt;/font&gt;&lt;font size=&quot;2&quot; face=&quot;Helvetica&quot;&gt;The Cinema HD features a single cable design with elegant breakout for the USB 2.0, FireWire 400 and a pure digital connection using the industry standard Digital Video Interface (DVI) interface. The DVI connection allows for a direct pure-digital connection.&lt;br&gt;\n	&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;\n&lt;h3&gt;\n	Features:&lt;/h3&gt;\n&lt;p&gt;\n	Unrivaled display performance&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		30-inch (viewable) active-matrix liquid crystal display provides breathtaking image quality and vivid, richly saturated color.&lt;/li&gt;\n	&lt;li&gt;\n		Support for 2560-by-1600 pixel resolution for display of high definition still and video imagery.&lt;/li&gt;\n	&lt;li&gt;\n		Wide-format design for simultaneous display of two full pages of text and graphics.&lt;/li&gt;\n	&lt;li&gt;\n		Industry standard DVI connector for direct attachment to Mac- and Windows-based desktops and notebooks&lt;/li&gt;\n	&lt;li&gt;\n		Incredibly wide (170 degree) horizontal and vertical viewing angle for maximum visibility and color performance.&lt;/li&gt;\n	&lt;li&gt;\n		Lightning-fast pixel response for full-motion digital video playback.&lt;/li&gt;\n	&lt;li&gt;\n		Support for 16.7 million saturated colors, for use in all graphics-intensive applications.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	Simple setup and operation&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Single cable with elegant breakout for \nconnection to DVI, USB and FireWire ports&lt;/li&gt;\n	&lt;li&gt;\n		Built-in two-port USB 2.0 hub for easy connection of desktop peripheral devices.&lt;/li&gt;\n	&lt;li&gt;\n		Two FireWire 400 ports to support iSight and other desktop peripherals&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	Sleek, elegant design&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Huge virtual workspace, very small footprint.&lt;/li&gt;\n	&lt;li&gt;\n		Narrow Bezel design to minimize visual impact of using dual displays&lt;/li&gt;\n	&lt;li&gt;\n		Unique hinge design for effortless adjustment&lt;/li&gt;\n	&lt;li&gt;\n		Support for VESA mounting solutions (Apple Cinema Display VESA Mount Adapter sold separately)&lt;/li&gt;\n&lt;/ul&gt;\n&lt;h3&gt;\n	Technical specifications&lt;/h3&gt;\n&lt;p&gt;\n	&lt;b&gt;Screen size (diagonal viewable image size)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Apple Cinema HD Display: 30 inches (29.7-inch viewable)&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Screen type&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Thin film transistor (TFT) active-matrix liquid crystal display (AMLCD)&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Resolutions&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		2560 x 1600 pixels (optimum resolution)&lt;/li&gt;\n	&lt;li&gt;\n		2048 x 1280&lt;/li&gt;\n	&lt;li&gt;\n		1920 x 1200&lt;/li&gt;\n	&lt;li&gt;\n		1280 x 800&lt;/li&gt;\n	&lt;li&gt;\n		1024 x 640&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Display colors (maximum)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		16.7 million&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Viewing angle (typical)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		170&deg; horizontal; 170&deg; vertical&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Brightness (typical)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		30-inch Cinema HD Display: 400 cd/m2&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Contrast ratio (typical)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		700:1&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Response time (typical)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		16 ms&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Pixel pitch&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		30-inch Cinema HD Display: 0.250 mm&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Screen treatment&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Antiglare hardcoat&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;User controls (hardware and software)&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Display Power,&lt;/li&gt;\n	&lt;li&gt;\n		System sleep, wake&lt;/li&gt;\n	&lt;li&gt;\n		Brightness&lt;/li&gt;\n	&lt;li&gt;\n		Monitor tilt&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Connectors and cables&lt;/b&gt;&lt;br&gt;\n	Cable&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		DVI (Digital Visual Interface)&lt;/li&gt;\n	&lt;li&gt;\n		FireWire 400&lt;/li&gt;\n	&lt;li&gt;\n		USB 2.0&lt;/li&gt;\n	&lt;li&gt;\n		DC power (24 V)&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	Connectors&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Two-port, self-powered USB 2.0 hub&lt;/li&gt;\n	&lt;li&gt;\n		Two FireWire 400 ports&lt;/li&gt;\n	&lt;li&gt;\n		Kensington security port&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;VESA mount adapter&lt;/b&gt;&lt;br&gt;\n	Requires optional Cinema Display VESA Mount Adapter (M9649G/A)&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Compatible with VESA FDMI (MIS-D, 100, C) compliant mounting solutions&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Electrical requirements&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Input voltage: 100-240 VAC 50-60Hz&lt;/li&gt;\n	&lt;li&gt;\n		Maximum power when operating: 150W&lt;/li&gt;\n	&lt;li&gt;\n		Energy saver mode: 3W or less&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Environmental requirements&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Operating temperature: \n50&deg; to 95&deg; F (10&deg; to 35&deg; C)&lt;/li&gt;\n	&lt;li&gt;\n		Storage temperature: -40&deg; to 116&deg; F (-40&deg; to 47&deg; C)&lt;/li&gt;\n	&lt;li&gt;\n		Operating humidity: 20% to 80% noncondensing&lt;/li&gt;\n	&lt;li&gt;\n		Maximum operating altitude: 10,000 feet&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Agency approvals&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		FCC Part 15 Class B&lt;/li&gt;\n	&lt;li&gt;\n		EN55022 Class B&lt;/li&gt;\n	&lt;li&gt;\n		EN55024&lt;/li&gt;\n	&lt;li&gt;\n		VCCI Class B&lt;/li&gt;\n	&lt;li&gt;\n		AS/NZS 3548 Class B&lt;/li&gt;\n	&lt;li&gt;\n		CNS 13438 Class B&lt;/li&gt;\n	&lt;li&gt;\n		ICES-003 Class B&lt;/li&gt;\n	&lt;li&gt;\n		ISO 13406 part 2&lt;/li&gt;\n	&lt;li&gt;\n		MPR II&lt;/li&gt;\n	&lt;li&gt;\n		IEC 60950&lt;/li&gt;\n	&lt;li&gt;\n		UL 60950&lt;/li&gt;\n	&lt;li&gt;\n		CSA 60950&lt;/li&gt;\n	&lt;li&gt;\n		EN60950&lt;/li&gt;\n	&lt;li&gt;\n		ENERGY STAR&lt;/li&gt;\n	&lt;li&gt;\n		TCO &#039;03&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;Size and weight&lt;/b&gt;&lt;br&gt;\n	30-inch Apple Cinema HD Display&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Height: 21.3 inches (54.3 cm)&lt;/li&gt;\n	&lt;li&gt;\n		Width: 27.2 inches (68.8 cm)&lt;/li&gt;\n	&lt;li&gt;\n		Depth: 8.46 inches (21.5 cm)&lt;/li&gt;\n	&lt;li&gt;\n		Weight: 27.5 pounds (12.5 kg)&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;\n	&lt;b&gt;System Requirements&lt;/b&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Mac Pro, all graphic options&lt;/li&gt;\n	&lt;li&gt;\n		MacBook Pro&lt;/li&gt;\n	&lt;li&gt;\n		Power Mac G5 (PCI-X) with ATI Radeon 9650 or better or NVIDIA GeForce 6800 GT DDL or better&lt;/li&gt;\n	&lt;li&gt;\n		Power Mac G5 (PCI Express), all graphics options&lt;/li&gt;\n	&lt;li&gt;\n		PowerBook G4 with dual-link DVI support&lt;/li&gt;\n	&lt;li&gt;\n		Windows PC and graphics card that supports DVI ports with dual-link digital bandwidth and VESA DDC standard for plug-and-play setup&lt;/li&gt;\n&lt;/ul&gt;\n', '', 'Apple Cinema 30&quot;', '', ''),
(28, 2, 'HTC Touch HD', '&lt;p&gt;\n	HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touch HD provides the next generation of mobile functionality, all at a simple touch. Fully integrated with Windows Mobile Professional 6.1, ultrafast 3.5G, GPS, 5MP camera, plus lots more - all delivered on a breathtakingly crisp 3.8&quot; WVGA touchscreen - you can take control of your mobile world with the HTC Touch HD.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Processor Qualcomm&reg; MSM 7201A&trade; 528 MHz&lt;/li&gt;\n	&lt;li&gt;\n		Windows Mobile&reg; 6.1 Professional Operating System&lt;/li&gt;\n	&lt;li&gt;\n		Memory: 512 MB ROM, 288 MB RAM&lt;/li&gt;\n	&lt;li&gt;\n		Dimensions: 115 mm x 62.8 mm x 12 mm / 146.4 grams&lt;/li&gt;\n	&lt;li&gt;\n		3.8-inch TFT-LCD flat touch-sensitive screen with 480 x 800 WVGA resolution&lt;/li&gt;\n	&lt;li&gt;\n		HSDPA/WCDMA: Europe/Asia: 900/2100 MHz; Up to 2 Mbps up-link and 7.2 Mbps down-link speeds&lt;/li&gt;\n	&lt;li&gt;\n		Quad-band GSM/GPRS/EDGE: Europe/Asia: 850/900/1800/1900 MHz (Band frequency, HSUPA availability, and data speed are operator dependent.)&lt;/li&gt;\n	&lt;li&gt;\n		Device Control via HTC TouchFLO&trade; 3D &amp;amp; Touch-sensitive front panel buttons&lt;/li&gt;\n	&lt;li&gt;\n		GPS and A-GPS ready&lt;/li&gt;\n	&lt;li&gt;\n		Bluetooth&reg; 2.0 with Enhanced Data Rate and A2DP for wireless stereo headsets&lt;/li&gt;\n	&lt;li&gt;\n		Wi-Fi&reg;: IEEE 802.11 b/g&lt;/li&gt;\n	&lt;li&gt;\n		HTC ExtUSB&trade; (11-pin mini-USB 2.0)&lt;/li&gt;\n	&lt;li&gt;\n		5 megapixel color camera with auto focus&lt;/li&gt;\n	&lt;li&gt;\n		VGA CMOS color camera&lt;/li&gt;\n	&lt;li&gt;\n		Built-in 3.5 mm audio jack, microphone, speaker, and FM radio&lt;/li&gt;\n	&lt;li&gt;\n		Ring tone formats: AAC, AAC+, eAAC+, AMR-NB, AMR-WB, QCP, MP3, WMA, WAV&lt;/li&gt;\n	&lt;li&gt;\n		40 polyphonic and standard MIDI format 0 and 1 (SMF)/SP MIDI&lt;/li&gt;\n	&lt;li&gt;\n		Rechargeable Lithium-ion or Lithium-ion polymer 1350 mAh battery&lt;/li&gt;\n	&lt;li&gt;\n		Expansion Slot: microSD&trade; memory card (SD 2.0 compatible)&lt;/li&gt;\n	&lt;li&gt;\n		AC Adapter Voltage range/frequency: 100 ~ 240V AC, 50/60 Hz DC output: 5V and 1A&lt;/li&gt;\n	&lt;li&gt;\n		Special Features: FM Radio, G-Sensor&lt;/li&gt;\n&lt;/ul&gt;\n', '', 'HTC Touch HD', '', ''),
(28, 3, '藝術坐椅', '&lt;p&gt;\n	HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touch HD provides the next generation of mobile functionality, all at a simple touch. Fully integrated with Windows Mobile Professional 6.1, ultrafast 3.5G, GPS, 5MP camera, plus lots more - all delivered on a breathtakingly crisp 3.8&quot; WVGA touchscreen - you can take control of your mobile world with the HTC Touch HD.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Processor Qualcomm&reg; MSM 7201A&trade; 528 MHz&lt;/li&gt;\n	&lt;li&gt;\n		Windows Mobile&reg; 6.1 Professional Operating System&lt;/li&gt;\n	&lt;li&gt;\n		Memory: 512 MB ROM, 288 MB RAM&lt;/li&gt;\n	&lt;li&gt;\n		Dimensions: 115 mm x 62.8 mm x 12 mm / 146.4 grams&lt;/li&gt;\n	&lt;li&gt;\n		3.8-inch TFT-LCD flat touch-sensitive screen with 480 x 800 WVGA resolution&lt;/li&gt;\n	&lt;li&gt;\n		HSDPA/WCDMA: Europe/Asia: 900/2100 MHz; Up to 2 Mbps up-link and 7.2 Mbps down-link speeds&lt;/li&gt;\n	&lt;li&gt;\n		Quad-band GSM/GPRS/EDGE: Europe/Asia: 850/900/1800/1900 MHz (Band frequency, HSUPA availability, and data speed are operator dependent.)&lt;/li&gt;\n	&lt;li&gt;\n		Device Control via HTC TouchFLO&trade; 3D &amp;amp; Touch-sensitive front panel buttons&lt;/li&gt;\n	&lt;li&gt;\n		GPS and A-GPS ready&lt;/li&gt;\n	&lt;li&gt;\n		Bluetooth&reg; 2.0 with Enhanced Data Rate and A2DP for wireless stereo headsets&lt;/li&gt;\n	&lt;li&gt;\n		Wi-Fi&reg;: IEEE 802.11 b/g&lt;/li&gt;\n	&lt;li&gt;\n		HTC ExtUSB&trade; (11-pin mini-USB 2.0)&lt;/li&gt;\n	&lt;li&gt;\n		5 megapixel color camera with auto focus&lt;/li&gt;\n	&lt;li&gt;\n		VGA CMOS color camera&lt;/li&gt;\n	&lt;li&gt;\n		Built-in 3.5 mm audio jack, microphone, speaker, and FM radio&lt;/li&gt;\n	&lt;li&gt;\n		Ring tone formats: AAC, AAC+, eAAC+, AMR-NB, AMR-WB, QCP, MP3, WMA, WAV&lt;/li&gt;\n	&lt;li&gt;\n		40 polyphonic and standard MIDI format 0 and 1 (SMF)/SP MIDI&lt;/li&gt;\n	&lt;li&gt;\n		Rechargeable Lithium-ion or Lithium-ion polymer 1350 mAh battery&lt;/li&gt;\n	&lt;li&gt;\n		Expansion Slot: microSD&trade; memory card (SD 2.0 compatible)&lt;/li&gt;\n	&lt;li&gt;\n		AC Adapter Voltage range/frequency: 100 ~ 240V AC, 50/60 Hz DC output: 5V and 1A&lt;/li&gt;\n	&lt;li&gt;\n		Special Features: FM Radio, G-Sensor&lt;/li&gt;\n&lt;/ul&gt;\n', '', 'HTC Touch HD', '', ''),
(29, 1, '纯香家具', '&lt;p&gt;\n	Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to business and personal email, stay on top of appointments and contacts, and use Wi-Fi or GPS when you&amp;rsquo;re out and about. Then watch a video on YouTube, catch up with news and sports on the web, or listen to a few songs. Balance your work and play the way you like it, with the Palm Treo Pro.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Windows Mobile&amp;reg; 6.1 Professional Edition&lt;/li&gt;\n	&lt;li&gt;\n		Qualcomm&amp;reg; MSM7201 400MHz Processor&lt;/li&gt;\n	&lt;li&gt;\n		320x320 transflective colour TFT touchscreen&lt;/li&gt;\n	&lt;li&gt;\n		HSDPA/UMTS/EDGE/GPRS/GSM radio&lt;/li&gt;\n	&lt;li&gt;\n		Tri-band UMTS &amp;mdash; 850MHz, 1900MHz, 2100MHz&lt;/li&gt;\n	&lt;li&gt;\n		Quad-band GSM &amp;mdash; 850/900/1800/1900&lt;/li&gt;\n	&lt;li&gt;\n		802.11b/g with WPA, WPA2, and 801.1x authentication&lt;/li&gt;\n	&lt;li&gt;\n		Built-in GPS&lt;/li&gt;\n	&lt;li&gt;\n		Bluetooth Version: 2.0 + Enhanced Data Rate&lt;/li&gt;\n	&lt;li&gt;\n		256MB storage (100MB user available), 128MB RAM&lt;/li&gt;\n	&lt;li&gt;\n		2.0 megapixel camera, up to 8x digital zoom and video capture&lt;/li&gt;\n	&lt;li&gt;\n		Removable, rechargeable 1500mAh lithium-ion battery&lt;/li&gt;\n	&lt;li&gt;\n		Up to 5.0 hours talk time and up to 250 hours standby&lt;/li&gt;\n	&lt;li&gt;\n		MicroSDHC card expansion (up to 32GB supported)&lt;/li&gt;\n	&lt;li&gt;\n		MicroUSB 2.0 for synchronization and charging&lt;/li&gt;\n	&lt;li&gt;\n		3.5mm stereo headset jack&lt;/li&gt;\n	&lt;li&gt;\n		60mm (W) x 114mm (L) x 13.5mm (D) / 133g&lt;/li&gt;\n&lt;/ul&gt;\n', '', '纯香家具', '纯香家具', '纯香家具'),
(29, 2, 'Palm Treo Pro', '&lt;p&gt;\n	Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to business and personal email, stay on top of appointments and contacts, and use Wi-Fi or GPS when you&amp;rsquo;re out and about. Then watch a video on YouTube, catch up with news and sports on the web, or listen to a few songs. Balance your work and play the way you like it, with the Palm Treo Pro.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Windows Mobile&amp;reg; 6.1 Professional Edition&lt;/li&gt;\n	&lt;li&gt;\n		Qualcomm&amp;reg; MSM7201 400MHz Processor&lt;/li&gt;\n	&lt;li&gt;\n		320x320 transflective colour TFT touchscreen&lt;/li&gt;\n	&lt;li&gt;\n		HSDPA/UMTS/EDGE/GPRS/GSM radio&lt;/li&gt;\n	&lt;li&gt;\n		Tri-band UMTS &amp;mdash; 850MHz, 1900MHz, 2100MHz&lt;/li&gt;\n	&lt;li&gt;\n		Quad-band GSM &amp;mdash; 850/900/1800/1900&lt;/li&gt;\n	&lt;li&gt;\n		802.11b/g with WPA, WPA2, and 801.1x authentication&lt;/li&gt;\n	&lt;li&gt;\n		Built-in GPS&lt;/li&gt;\n	&lt;li&gt;\n		Bluetooth Version: 2.0 + Enhanced Data Rate&lt;/li&gt;\n	&lt;li&gt;\n		256MB storage (100MB user available), 128MB RAM&lt;/li&gt;\n	&lt;li&gt;\n		2.0 megapixel camera, up to 8x digital zoom and video capture&lt;/li&gt;\n	&lt;li&gt;\n		Removable, rechargeable 1500mAh lithium-ion battery&lt;/li&gt;\n	&lt;li&gt;\n		Up to 5.0 hours talk time and up to 250 hours standby&lt;/li&gt;\n	&lt;li&gt;\n		MicroSDHC card expansion (up to 32GB supported)&lt;/li&gt;\n	&lt;li&gt;\n		MicroUSB 2.0 for synchronization and charging&lt;/li&gt;\n	&lt;li&gt;\n		3.5mm stereo headset jack&lt;/li&gt;\n	&lt;li&gt;\n		60mm (W) x 114mm (L) x 13.5mm (D) / 133g&lt;/li&gt;\n&lt;/ul&gt;\n', '', 'Palm Treo Pro', '', ''),
(29, 3, '純香家具', '&lt;p&gt;\n	Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to business and personal email, stay on top of appointments and contacts, and use Wi-Fi or GPS when you&amp;rsquo;re out and about. Then watch a video on YouTube, catch up with news and sports on the web, or listen to a few songs. Balance your work and play the way you like it, with the Palm Treo Pro.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Windows Mobile&amp;reg; 6.1 Professional Edition&lt;/li&gt;\n	&lt;li&gt;\n		Qualcomm&amp;reg; MSM7201 400MHz Processor&lt;/li&gt;\n	&lt;li&gt;\n		320x320 transflective colour TFT touchscreen&lt;/li&gt;\n	&lt;li&gt;\n		HSDPA/UMTS/EDGE/GPRS/GSM radio&lt;/li&gt;\n	&lt;li&gt;\n		Tri-band UMTS &amp;mdash; 850MHz, 1900MHz, 2100MHz&lt;/li&gt;\n	&lt;li&gt;\n		Quad-band GSM &amp;mdash; 850/900/1800/1900&lt;/li&gt;\n	&lt;li&gt;\n		802.11b/g with WPA, WPA2, and 801.1x authentication&lt;/li&gt;\n	&lt;li&gt;\n		Built-in GPS&lt;/li&gt;\n	&lt;li&gt;\n		Bluetooth Version: 2.0 + Enhanced Data Rate&lt;/li&gt;\n	&lt;li&gt;\n		256MB storage (100MB user available), 128MB RAM&lt;/li&gt;\n	&lt;li&gt;\n		2.0 megapixel camera, up to 8x digital zoom and video capture&lt;/li&gt;\n	&lt;li&gt;\n		Removable, rechargeable 1500mAh lithium-ion battery&lt;/li&gt;\n	&lt;li&gt;\n		Up to 5.0 hours talk time and up to 250 hours standby&lt;/li&gt;\n	&lt;li&gt;\n		MicroSDHC card expansion (up to 32GB supported)&lt;/li&gt;\n	&lt;li&gt;\n		MicroUSB 2.0 for synchronization and charging&lt;/li&gt;\n	&lt;li&gt;\n		3.5mm stereo headset jack&lt;/li&gt;\n	&lt;li&gt;\n		60mm (W) x 114mm (L) x 13.5mm (D) / 133g&lt;/li&gt;\n&lt;/ul&gt;\n', '', 'Palm Treo Pro', '', ''),
(30, 1, '简约座椅', '&lt;p&gt;佳能EOS-5D终于揭开了其神秘的面纱，相信大家都对佳能EOS-5D的性能感到满意，但是佳能EOS-5D拍出来的片子如何呢？为此，我们特地从佳能网站上找到几张原尺寸的佳能EOS-5D实拍样张。&lt;/p&gt;', '', '简约座椅', '简约座椅', '简约座椅'),
(30, 2, 'Canon EOS 5D', '&lt;p&gt;\n	Canon&#039;s press material for the EOS 5D states that it &#039;defines (a) new D-SLR category&#039;, while we&#039;re not typically too concerned with marketing talk this particular statement is clearly pretty accurate. The EOS 5D is unlike any previous digital SLR in that it combines a full-frame (35 mm sized) high resolution sensor (12.8 megapixels) with a relatively compact body (slightly larger than the EOS 20D, although in your hand it feels noticeably &#039;chunkier&#039;). The EOS 5D is aimed to slot in between the EOS 20D and the EOS-1D professional digital SLR&#039;s, an important difference when compared to the latter is that the EOS 5D doesn&#039;t have any environmental seals. While Canon don&#039;t specifically refer to the EOS 5D as a &#039;professional&#039; digital SLR it will have obvious appeal to professionals who want a high quality digital SLR in a body lighter than the EOS-1D. It will also no doubt appeal to current EOS 20D owners (although lets hope they&#039;ve not bought too many EF-S lenses...) &auml;&euml;&lt;/p&gt;\n', '', 'Canon EOS 5D', '', ''),
(30, 3, '簡約座椅', '&lt;p&gt;佳能EOS-5D终于揭开了其神秘的面纱，相信大家都对佳能EOS-5D的性能感到满意，但是佳能EOS-5D拍出来的片子如何呢？为此，我们特地从佳能网站上找到几张原尺寸的佳能EOS-5D实拍样张。&lt;/p&gt;', '', '佳能EOS-5D', '', ''),
(31, 1, '简约小桌', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		Engineered with pro-level features and performance, the 12.3-effective-megapixel D300 combines brand new technologies with advanced features inherited from Nikon&amp;#39;s newly announced D3 professional digital SLR camera to offer serious photographers remarkable performance combined with agility.&lt;br /&gt;\n		&lt;br /&gt;\n		Similar to the D3, the D300 features Nikon&amp;#39;s exclusive EXPEED Image Processing System that is central to driving the speed and processing power needed for many of the camera&amp;#39;s new features. The D300 features a new 51-point autofocus system with Nikon&amp;#39;s 3D Focus Tracking feature and two new LiveView shooting modes that allow users to frame a photograph using the camera&amp;#39;s high-resolution LCD monitor. The D300 shares a similar Scene Recognition System as is found in the D3; it promises to greatly enhance the accuracy of autofocus, autoexposure, and auto white balance by recognizing the subject or scene being photographed and applying this information to the calculations for the three functions.&lt;br /&gt;\n		&lt;br /&gt;\n		The D300 reacts with lightning speed, powering up in a mere 0.13 seconds and shooting with an imperceptible 45-millisecond shutter release lag time. The D300 is capable of shooting at a rapid six frames per second and can go as fast as eight frames per second when using the optional MB-D10 multi-power battery pack. In continuous bursts, the D300 can shoot up to 100 shots at full 12.3-megapixel resolution. (NORMAL-LARGE image setting, using a SanDisk Extreme IV 1GB CompactFlash card.)&lt;br /&gt;\n		&lt;br /&gt;\n		The D300 incorporates a range of innovative technologies and features that will significantly improve the accuracy, control, and performance photographers can get from their equipment. Its new Scene Recognition System advances the use of Nikon&amp;#39;s acclaimed 1,005-segment sensor to recognize colors and light patterns that help the camera determine the subject and the type of scene being photographed before a picture is taken. This information is used to improve the accuracy of autofocus, autoexposure, and auto white balance functions in the D300. For example, the camera can track moving subjects better and by identifying them, it can also automatically select focus points faster and with greater accuracy. It can also analyze highlights and more accurately determine exposure, as well as infer light sources to deliver more accurate white balance detection.&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', '简约小桌', '简约小桌', '简约小桌'),
(31, 2, 'Nikon D300', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		Engineered with pro-level features and performance, the 12.3-effective-megapixel D300 combines brand new technologies with advanced features inherited from Nikon&amp;#39;s newly announced D3 professional digital SLR camera to offer serious photographers remarkable performance combined with agility.&lt;br /&gt;\n		&lt;br /&gt;\n		Similar to the D3, the D300 features Nikon&amp;#39;s exclusive EXPEED Image Processing System that is central to driving the speed and processing power needed for many of the camera&amp;#39;s new features. The D300 features a new 51-point autofocus system with Nikon&amp;#39;s 3D Focus Tracking feature and two new LiveView shooting modes that allow users to frame a photograph using the camera&amp;#39;s high-resolution LCD monitor. The D300 shares a similar Scene Recognition System as is found in the D3; it promises to greatly enhance the accuracy of autofocus, autoexposure, and auto white balance by recognizing the subject or scene being photographed and applying this information to the calculations for the three functions.&lt;br /&gt;\n		&lt;br /&gt;\n		The D300 reacts with lightning speed, powering up in a mere 0.13 seconds and shooting with an imperceptible 45-millisecond shutter release lag time. The D300 is capable of shooting at a rapid six frames per second and can go as fast as eight frames per second when using the optional MB-D10 multi-power battery pack. In continuous bursts, the D300 can shoot up to 100 shots at full 12.3-megapixel resolution. (NORMAL-LARGE image setting, using a SanDisk Extreme IV 1GB CompactFlash card.)&lt;br /&gt;\n		&lt;br /&gt;\n		The D300 incorporates a range of innovative technologies and features that will significantly improve the accuracy, control, and performance photographers can get from their equipment. Its new Scene Recognition System advances the use of Nikon&amp;#39;s acclaimed 1,005-segment sensor to recognize colors and light patterns that help the camera determine the subject and the type of scene being photographed before a picture is taken. This information is used to improve the accuracy of autofocus, autoexposure, and auto white balance functions in the D300. For example, the camera can track moving subjects better and by identifying them, it can also automatically select focus points faster and with greater accuracy. It can also analyze highlights and more accurately determine exposure, as well as infer light sources to deliver more accurate white balance detection.&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', 'Nikon D300', '', ''),
(31, 3, '簡約小桌', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		Engineered with pro-level features and performance, the 12.3-effective-megapixel D300 combines brand new technologies with advanced features inherited from Nikon&amp;#39;s newly announced D3 professional digital SLR camera to offer serious photographers remarkable performance combined with agility.&lt;br /&gt;\n		&lt;br /&gt;\n		Similar to the D3, the D300 features Nikon&amp;#39;s exclusive EXPEED Image Processing System that is central to driving the speed and processing power needed for many of the camera&amp;#39;s new features. The D300 features a new 51-point autofocus system with Nikon&amp;#39;s 3D Focus Tracking feature and two new LiveView shooting modes that allow users to frame a photograph using the camera&amp;#39;s high-resolution LCD monitor. The D300 shares a similar Scene Recognition System as is found in the D3; it promises to greatly enhance the accuracy of autofocus, autoexposure, and auto white balance by recognizing the subject or scene being photographed and applying this information to the calculations for the three functions.&lt;br /&gt;\n		&lt;br /&gt;\n		The D300 reacts with lightning speed, powering up in a mere 0.13 seconds and shooting with an imperceptible 45-millisecond shutter release lag time. The D300 is capable of shooting at a rapid six frames per second and can go as fast as eight frames per second when using the optional MB-D10 multi-power battery pack. In continuous bursts, the D300 can shoot up to 100 shots at full 12.3-megapixel resolution. (NORMAL-LARGE image setting, using a SanDisk Extreme IV 1GB CompactFlash card.)&lt;br /&gt;\n		&lt;br /&gt;\n		The D300 incorporates a range of innovative technologies and features that will significantly improve the accuracy, control, and performance photographers can get from their equipment. Its new Scene Recognition System advances the use of Nikon&amp;#39;s acclaimed 1,005-segment sensor to recognize colors and light patterns that help the camera determine the subject and the type of scene being photographed before a picture is taken. This information is used to improve the accuracy of autofocus, autoexposure, and auto white balance functions in the D300. For example, the camera can track moving subjects better and by identifying them, it can also automatically select focus points faster and with greater accuracy. It can also analyze highlights and more accurately determine exposure, as well as infer light sources to deliver more accurate white balance detection.&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', 'Nikon D300', '', ''),
(32, 1, '立式书架', '&lt;p&gt;\n	&lt;strong&gt;Revolutionary multi-touch interface.&lt;/strong&gt;&lt;br&gt;\n	iPod touch features the same multi-touch screen technology as iPhone. Pinch to zoom in on a photo. Scroll through your songs and videos with a flick. Flip through your library by album artwork with Cover Flow.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Gorgeous 3.5-inch widescreen display.&lt;/strong&gt;&lt;br&gt;\n	Watch your movies, TV shows, and photos come alive with bright, vivid color on the 320-by-480-pixel display.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Music downloads straight from iTunes.&lt;/strong&gt;&lt;br&gt;\n	Shop the iTunes Wi-Fi Music Store from anywhere with Wi-Fi.1 Browse or search to find the music youre looking for, preview it, and buy it with just a tap.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Surf the web with Wi-Fi.&lt;/strong&gt;&lt;br&gt;\n	Browse the web using Safari and watch YouTube videos on the first iPod with Wi-Fi built in&lt;br&gt;\n	&amp;nbsp;&lt;/p&gt;\n', '', '立式书架', '立式书架', '立式书架'),
(32, 2, 'iPod Touch', '&lt;p&gt;\n	&lt;strong&gt;Revolutionary multi-touch interface.&lt;/strong&gt;&lt;br&gt;\n	iPod touch features the same multi-touch screen technology as iPhone. Pinch to zoom in on a photo. Scroll through your songs and videos with a flick. Flip through your library by album artwork with Cover Flow.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Gorgeous 3.5-inch widescreen display.&lt;/strong&gt;&lt;br&gt;\n	Watch your movies, TV shows, and photos come alive with bright, vivid color on the 320-by-480-pixel display.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Music downloads straight from iTunes.&lt;/strong&gt;&lt;br&gt;\n	Shop the iTunes Wi-Fi Music Store from anywhere with Wi-Fi.1 Browse or search to find the music youre looking for, preview it, and buy it with just a tap.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Surf the web with Wi-Fi.&lt;/strong&gt;&lt;br&gt;\n	Browse the web using Safari and watch YouTube videos on the first iPod with Wi-Fi built in&lt;br&gt;\n	&amp;nbsp;&lt;/p&gt;\n', '', 'iPod Touch', '', ''),
(32, 3, '立式書架', '&lt;p&gt;\n	&lt;strong&gt;Revolutionary multi-touch interface.&lt;/strong&gt;&lt;br&gt;\n	iPod touch features the same multi-touch screen technology as iPhone. Pinch to zoom in on a photo. Scroll through your songs and videos with a flick. Flip through your library by album artwork with Cover Flow.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Gorgeous 3.5-inch widescreen display.&lt;/strong&gt;&lt;br&gt;\n	Watch your movies, TV shows, and photos come alive with bright, vivid color on the 320-by-480-pixel display.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Music downloads straight from iTunes.&lt;/strong&gt;&lt;br&gt;\n	Shop the iTunes Wi-Fi Music Store from anywhere with Wi-Fi.1 Browse or search to find the music youre looking for, preview it, and buy it with just a tap.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Surf the web with Wi-Fi.&lt;/strong&gt;&lt;br&gt;\n	Browse the web using Safari and watch YouTube videos on the first iPod with Wi-Fi built in&lt;br&gt;\n	&amp;nbsp;&lt;/p&gt;\n', '', 'iPod Touch', '', ''),
(33, 1, '古色展厨', '是一款19英寸，拥有16:10黄金屏幕比例的产品。这款产品在外观上采用了黑色烤漆工艺，底边框位置我们看到了其印有品牌LOGO，非常精致。而我们在其它边框位置看到了产品信息，方便了用户购买时挑选。\n', '', '古色展厨', '古色展厨', '古色展厨'),
(33, 2, 'Samsung SyncMaster 941BW', '&lt;div&gt;\n	Imagine the advantages of going big without slowing down. The big 19&quot; 941BW monitor combines wide aspect ratio with fast pixel response time, for bigger images, more room to work and crisp motion. In addition, the exclusive MagicBright 2, MagicColor and MagicTune technologies help deliver the ideal image in every situation, while sleek, narrow bezels and adjustable stands deliver style just the way you want it. With the Samsung 941BW widescreen analog/digital LCD monitor, it&#039;s not hard to imagine.&lt;/div&gt;\n', '', 'Samsung SyncMaster 941BW', '', ''),
(33, 3, '古色展廚', '是一款19英寸，拥有16:10黄金屏幕比例的产品。这款产品在外观上采用了黑色烤漆工艺，底边框位置我们看到了其印有品牌LOGO，非常精致。而我们在其它边框位置看到了产品信息，方便了用户购买时挑选。\n', '', '三星 941BW', '', '');
INSERT INTO `mcc_product_description` (`product_id`, `language_id`, `name`, `description`, `tag`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(34, 1, '线条式展架', '&lt;div&gt;\n	&lt;strong&gt;Born to be worn.&lt;/strong&gt;\n	&lt;p&gt;\n		Clip on the worlds most wearable music player and take up to 240 songs with you anywhere. Choose from five colors including four new hues to make your musical fashion statement.&lt;/p&gt;\n	&lt;p&gt;\n		&lt;strong&gt;Random meets rhythm.&lt;/strong&gt;&lt;/p&gt;\n	&lt;p&gt;\n		With iTunes autofill, iPod shuffle can deliver a new musical experience every time you sync. For more randomness, you can shuffle songs during playback with the slide of a switch.&lt;/p&gt;\n	&lt;strong&gt;Everything is easy.&lt;/strong&gt;\n	&lt;p&gt;\n		Charge and sync with the included USB dock. Operate the iPod shuffle controls with one hand. Enjoy up to 12 hours straight of skip-free music playback.&lt;/p&gt;\n&lt;/div&gt;\n', '', '线条式展架', '线条式展架', '线条式展架'),
(28, 1, '艺术坐椅', '&lt;p&gt;\n	HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touch HD provides the next generation of mobile functionality, all at a simple touch. Fully integrated with Windows Mobile Professional 6.1, ultrafast 3.5G, GPS, 5MP camera, plus lots more - all delivered on a breathtakingly crisp 3.8&quot; WVGA touchscreen - you can take control of your mobile world with the HTC Touch HD.&lt;/p&gt;\n&lt;p&gt;\n	&lt;strong&gt;Features&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n	&lt;li&gt;\n		Processor Qualcomm&reg; MSM 7201A&trade; 528 MHz&lt;/li&gt;\n	&lt;li&gt;\n		Windows Mobile&reg; 6.1 Professional Operating System&lt;/li&gt;\n	&lt;li&gt;\n		Memory: 512 MB ROM, 288 MB RAM&lt;/li&gt;\n	&lt;li&gt;\n		Dimensions: 115 mm x 62.8 mm x 12 mm / 146.4 grams&lt;/li&gt;\n	&lt;li&gt;\n		3.8-inch TFT-LCD flat touch-sensitive screen with 480 x 800 WVGA resolution&lt;/li&gt;\n	&lt;li&gt;\n		HSDPA/WCDMA: Europe/Asia: 900/2100 MHz; Up to 2 Mbps up-link and 7.2 Mbps down-link speeds&lt;/li&gt;\n	&lt;li&gt;\n		Quad-band GSM/GPRS/EDGE: Europe/Asia: 850/900/1800/1900 MHz (Band frequency, HSUPA availability, and data speed are operator dependent.)&lt;/li&gt;\n	&lt;li&gt;\n		Device Control via HTC TouchFLO&trade; 3D &amp;amp; Touch-sensitive front panel buttons&lt;/li&gt;\n	&lt;li&gt;\n		GPS and A-GPS ready&lt;/li&gt;\n	&lt;li&gt;\n		Bluetooth&reg; 2.0 with Enhanced Data Rate and A2DP for wireless stereo headsets&lt;/li&gt;\n	&lt;li&gt;\n		Wi-Fi&reg;: IEEE 802.11 b/g&lt;/li&gt;\n	&lt;li&gt;\n		HTC ExtUSB&trade; (11-pin mini-USB 2.0)&lt;/li&gt;\n	&lt;li&gt;\n		5 megapixel color camera with auto focus&lt;/li&gt;\n	&lt;li&gt;\n		VGA CMOS color camera&lt;/li&gt;\n	&lt;li&gt;\n		Built-in 3.5 mm audio jack, microphone, speaker, and FM radio&lt;/li&gt;\n	&lt;li&gt;\n		Ring tone formats: AAC, AAC+, eAAC+, AMR-NB, AMR-WB, QCP, MP3, WMA, WAV&lt;/li&gt;\n	&lt;li&gt;\n		40 polyphonic and standard MIDI format 0 and 1 (SMF)/SP MIDI&lt;/li&gt;\n	&lt;li&gt;\n		Rechargeable Lithium-ion or Lithium-ion polymer 1350 mAh battery&lt;/li&gt;\n	&lt;li&gt;\n		Expansion Slot: microSD&trade; memory card (SD 2.0 compatible)&lt;/li&gt;\n	&lt;li&gt;\n		AC Adapter Voltage range/frequency: 100 ~ 240V AC, 50/60 Hz DC output: 5V and 1A&lt;/li&gt;\n	&lt;li&gt;\n		Special Features: FM Radio, G-Sensor&lt;/li&gt;\n&lt;/ul&gt;\n', '', '艺术坐椅', '艺术坐椅', '艺术坐椅'),
(49, 3, '緣木立櫃', '&lt;p&gt;\n	Samsung Galaxy Tab 10.1, is the world&rsquo;s thinnest tablet, measuring 8.6 mm thickness, running with Android 3.0 Honeycomb OS on a 1GHz dual-core Tegra 2 processor, similar to its younger brother Samsung Galaxy Tab 8.9.&lt;/p&gt;\n&lt;p&gt;\n	Samsung Galaxy Tab 10.1 gives pure Android 3.0 experience, adding its new TouchWiz UX or TouchWiz 4.0 &ndash; includes a live panel, which lets you to customize with different content, such as your pictures, bookmarks, and social feeds, sporting a 10.1 inches WXGA capacitive touch screen with 1280 x 800 pixels of resolution, equipped with 3 megapixel rear camera with LED flash and a 2 megapixel front camera, HSPA+ connectivity up to 21Mbps, 720p HD video recording capability, 1080p HD playback, DLNA support, Bluetooth 2.1, USB 2.0, gyroscope, Wi-Fi 802.11 a/b/g/n, micro-SD slot, 3.5mm headphone jack, and SIM slot, including the Samsung Stick &ndash; a Bluetooth microphone that can be carried in a pocket like a pen and sound dock with powered subwoofer.&lt;/p&gt;\n&lt;p&gt;\n	Samsung Galaxy Tab 10.1 will come in 16GB / 32GB / 64GB verities and pre-loaded with Social Hub, Reader&rsquo;s Hub, Music Hub and Samsung Mini Apps Tray &ndash; which gives you access to more commonly used apps to help ease multitasking and it is capable of Adobe Flash Player 10.2, powered by 6860mAh battery that gives you 10hours of video-playback time.&amp;nbsp;&auml;&ouml;&lt;/p&gt;\n', '', 'Samsung Galaxy Tab 10.1', '', ''),
(48, 1, '莲式木几', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		&lt;p&gt;\n			&lt;strong&gt;More room to move.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Experience a whole new way to browse and view your music and video.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Sleeker design.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Beautiful, durable, and sleeker than ever, iPod classic now features an anodized aluminum and polished stainless steel enclosure with rounded edges.&lt;/p&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', '莲式木几', '莲式木几', '莲式木几'),
(48, 2, 'iPod Classic', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		&lt;p&gt;\n			&lt;strong&gt;More room to move.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Experience a whole new way to browse and view your music and video.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Sleeker design.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Beautiful, durable, and sleeker than ever, iPod classic now features an anodized aluminum and polished stainless steel enclosure with rounded edges.&lt;/p&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', 'iPod Classic', '', ''),
(48, 3, '蓮式木幾', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		&lt;p&gt;\n			&lt;strong&gt;More room to move.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Cover Flow.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Browse through your music collection by flipping through album art. Select an album to turn it over and see the track list.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Enhanced interface.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Experience a whole new way to browse and view your music and video.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;strong&gt;Sleeker design.&lt;/strong&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Beautiful, durable, and sleeker than ever, iPod classic now features an anodized aluminum and polished stainless steel enclosure with rounded edges.&lt;/p&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', 'iPod Classic', '', ''),
(49, 1, '缘木立柜', '&lt;p&gt;\n	Samsung Galaxy Tab 10.1, is the world&rsquo;s thinnest tablet, measuring 8.6 mm thickness, running with Android 3.0 Honeycomb OS on a 1GHz dual-core Tegra 2 processor, similar to its younger brother Samsung Galaxy Tab 8.9.&lt;/p&gt;\n&lt;p&gt;\n	Samsung Galaxy Tab 10.1 gives pure Android 3.0 experience, adding its new TouchWiz UX or TouchWiz 4.0 &ndash; includes a live panel, which lets you to customize with different content, such as your pictures, bookmarks, and social feeds, sporting a 10.1 inches WXGA capacitive touch screen with 1280 x 800 pixels of resolution, equipped with 3 megapixel rear camera with LED flash and a 2 megapixel front camera, HSPA+ connectivity up to 21Mbps, 720p HD video recording capability, 1080p HD playback, DLNA support, Bluetooth 2.1, USB 2.0, gyroscope, Wi-Fi 802.11 a/b/g/n, micro-SD slot, 3.5mm headphone jack, and SIM slot, including the Samsung Stick &ndash; a Bluetooth microphone that can be carried in a pocket like a pen and sound dock with powered subwoofer.&lt;/p&gt;\n&lt;p&gt;\n	Samsung Galaxy Tab 10.1 will come in 16GB / 32GB / 64GB verities and pre-loaded with Social Hub, Reader&rsquo;s Hub, Music Hub and Samsung Mini Apps Tray &ndash; which gives you access to more commonly used apps to help ease multitasking and it is capable of Adobe Flash Player 10.2, powered by 6860mAh battery that gives you 10hours of video-playback time.&amp;nbsp;&auml;&ouml;&lt;/p&gt;\n', '', '缘木立柜', '缘木立柜', '缘木立柜'),
(44, 1, '田方格书架', '&lt;div&gt;\n	MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don&amp;rsquo;t lose inches and pounds overnight. It&amp;rsquo;s the result of rethinking conventions. Of multiple wireless innovations. And of breakthrough design. With MacBook Air, mobile computing suddenly has a new standard.&lt;/div&gt;\n', '', '田方格书架', '田方格书架', '田方格书架'),
(44, 2, 'MacBook Air', '&lt;div&gt;\n	MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don&amp;rsquo;t lose inches and pounds overnight. It&amp;rsquo;s the result of rethinking conventions. Of multiple wireless innovations. And of breakthrough design. With MacBook Air, mobile computing suddenly has a new standard.&lt;/div&gt;\n', '', 'MacBook Air', '', ''),
(44, 3, '田方格書架', '&lt;div&gt;\n	MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don&amp;rsquo;t lose inches and pounds overnight. It&amp;rsquo;s the result of rethinking conventions. Of multiple wireless innovations. And of breakthrough design. With MacBook Air, mobile computing suddenly has a new standard.&lt;/div&gt;\n', '', 'MacBook Air', '', ''),
(45, 1, '时尚储物柜', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		&lt;p&gt;\n			&lt;b&gt;Latest Intel mobile architecture&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Powered by the most advanced mobile processors from Intel, the new Core 2 Duo MacBook Pro is over 50% faster than the original Core Duo MacBook Pro and now supports up to 4GB of RAM.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Leading-edge graphics&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			The NVIDIA GeForce 8600M GT delivers exceptional graphics processing power. For the ultimate creative canvas, you can even configure the 17-inch model with a 1920-by-1200 resolution display.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Designed for life on the road&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Innovations such as a magnetic power connection and an illuminated keyboard with ambient light sensor put the MacBook Pro in a class by itself.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Connect. Create. Communicate.&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Quickly set up a video conference with the built-in iSight camera. Control presentations and media from up to 30 feet away with the included Apple Remote. Connect to high-bandwidth peripherals with FireWire 800 and DVI.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Next-generation wireless&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Featuring 802.11n wireless technology, the MacBook Pro delivers up to five times the performance and up to twice the range of previous-generation technologies.&lt;/p&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', '时尚储物柜', '时尚储物柜', '时尚储物柜'),
(45, 2, 'MacBook Pro', '&lt;div class=&quot;cpt_product_description &quot;&gt;\n	&lt;div&gt;\n		&lt;p&gt;\n			&lt;b&gt;Latest Intel mobile architecture&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Powered by the most advanced mobile processors from Intel, the new Core 2 Duo MacBook Pro is over 50% faster than the original Core Duo MacBook Pro and now supports up to 4GB of RAM.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Leading-edge graphics&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			The NVIDIA GeForce 8600M GT delivers exceptional graphics processing power. For the ultimate creative canvas, you can even configure the 17-inch model with a 1920-by-1200 resolution display.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Designed for life on the road&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Innovations such as a magnetic power connection and an illuminated keyboard with ambient light sensor put the MacBook Pro in a class by itself.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Connect. Create. Communicate.&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Quickly set up a video conference with the built-in iSight camera. Control presentations and media from up to 30 feet away with the included Apple Remote. Connect to high-bandwidth peripherals with FireWire 800 and DVI.&lt;/p&gt;\n		&lt;p&gt;\n			&lt;b&gt;Next-generation wireless&lt;/b&gt;&lt;/p&gt;\n		&lt;p&gt;\n			Featuring 802.11n wireless technology, the MacBook Pro delivers up to five times the performance and up to twice the range of previous-generation technologies.&lt;/p&gt;\n	&lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- cpt_container_end --&gt;', '', 'MacBook Pro', '', ''),
(49, 2, 'Samsung Galaxy Tab 10.1', '&lt;p&gt;\n	Samsung Galaxy Tab 10.1, is the world&rsquo;s thinnest tablet, measuring 8.6 mm thickness, running with Android 3.0 Honeycomb OS on a 1GHz dual-core Tegra 2 processor, similar to its younger brother Samsung Galaxy Tab 8.9.&lt;/p&gt;\n&lt;p&gt;\n	Samsung Galaxy Tab 10.1 gives pure Android 3.0 experience, adding its new TouchWiz UX or TouchWiz 4.0 &ndash; includes a live panel, which lets you to customize with different content, such as your pictures, bookmarks, and social feeds, sporting a 10.1 inches WXGA capacitive touch screen with 1280 x 800 pixels of resolution, equipped with 3 megapixel rear camera with LED flash and a 2 megapixel front camera, HSPA+ connectivity up to 21Mbps, 720p HD video recording capability, 1080p HD playback, DLNA support, Bluetooth 2.1, USB 2.0, gyroscope, Wi-Fi 802.11 a/b/g/n, micro-SD slot, 3.5mm headphone jack, and SIM slot, including the Samsung Stick &ndash; a Bluetooth microphone that can be carried in a pocket like a pen and sound dock with powered subwoofer.&lt;/p&gt;\n&lt;p&gt;\n	Samsung Galaxy Tab 10.1 will come in 16GB / 32GB / 64GB verities and pre-loaded with Social Hub, Reader&rsquo;s Hub, Music Hub and Samsung Mini Apps Tray &ndash; which gives you access to more commonly used apps to help ease multitasking and it is capable of Adobe Flash Player 10.2, powered by 6860mAh battery that gives you 10hours of video-playback time.&amp;nbsp;&auml;&ouml;&lt;/p&gt;\n', '', 'Samsung Galaxy Tab 10.1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_discount`
--

DROP TABLE IF EXISTS `mcc_product_discount`;
CREATE TABLE `mcc_product_discount` (
  `product_discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`product_discount_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_discount`
--

INSERT INTO `mcc_product_discount` (`product_discount_id`, `product_id`, `customer_group_id`, `quantity`, `priority`, `price`, `date_start`, `date_end`) VALUES
(3, 42, 1, 10, 1, '88.0000', '2015-01-01', '2055-12-31'),
(2, 42, 1, 20, 1, '77.0000', '2015-01-01', '2055-12-31'),
(1, 42, 1, 30, 1, '66.0000', '2015-01-01', '2055-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_filter`
--

DROP TABLE IF EXISTS `mcc_product_filter`;
CREATE TABLE `mcc_product_filter` (
  `product_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_image`
--

DROP TABLE IF EXISTS `mcc_product_image`;
CREATE TABLE `mcc_product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_image`
--

INSERT INTO `mcc_product_image` (`product_image_id`, `product_id`, `image`, `sort_order`) VALUES
(47, 43, 'catalog/demo/product/product_9/product9_2.jpg', 0),
(28, 44, 'catalog/demo/product/product_10/product10_2.jpg', 0),
(15, 35, 'catalog/demo/product/product_14/product14_7.jpg', 0),
(16, 36, 'catalog/demo/product/product_6/product6_3.jpg', 0),
(17, 36, 'catalog/demo/product/product_6/product6_4.jpg', 0),
(18, 36, 'catalog/demo/product/product_6/product6_5.jpg', 0),
(19, 36, 'catalog/demo/product/product_6/product6_6.jpg', 0),
(20, 41, 'catalog/demo/product/product_4/product4_2.jpg', 0),
(21, 41, 'catalog/demo/product/product_4/product4_3.jpg', 0),
(22, 41, 'catalog/demo/product/product_4/product4_7.jpg', 0),
(23, 42, 'catalog/demo/product/product_1/product1_2.jpg', 0),
(13, 35, 'catalog/demo/product/product_14/product14_4.jpg', 0),
(14, 35, 'catalog/demo/product/product_14/product14_6.jpg', 0),
(46, 43, 'catalog/demo/product/product_9/product9_4.jpg', 0),
(24, 42, 'catalog/demo/product/product_1/product1_3.jpg', 0),
(45, 43, 'catalog/demo/product/product_9/product9_5.jpg', 0),
(30, 45, 'catalog/demo/product/product_11/product11_2.jpg', 0),
(29, 44, 'catalog/demo/product/product_10/product10_3.jpg', 0),
(1, 28, 'catalog/demo/product/product_3/product3_2.jpg', 0),
(2, 28, 'catalog/demo/product/product_3/product3_4.jpg', 0),
(3, 28, 'catalog/demo/product/product_3/product3_5.jpg', 0),
(4, 29, 'catalog/demo/product/product_13/product13_2.jpg', 0),
(5, 29, 'catalog/demo/product/product_13/product13_2.jpg', 0),
(6, 31, 'catalog/demo/product/product_12/product12_3.jpg', 0),
(7, 31, 'catalog/demo/product/product_12/product12_5.jpg', 0),
(8, 32, 'catalog/demo/product/product_8/product8_2.jpg', 0),
(9, 32, 'catalog/demo/product/product_8/product8_4.jpg', 0),
(10, 34, 'catalog/demo/product/product_7/product7_2.jpg', 0),
(11, 34, 'catalog/demo/product/product_7/product7_4.jpg', 0),
(12, 34, 'catalog/demo/product/product_7/product7_5.jpg', 0),
(31, 45, 'catalog/demo/product/product_11/product11_4.jpg', 0),
(32, 47, 'catalog/demo/product/product_2/product2_3.jpg', 0),
(33, 47, 'catalog/demo/product/product_2/product2_4.jpg', 0),
(34, 47, 'catalog/demo/product/product_2/product2_5.jpg', 0),
(35, 47, 'catalog/demo/product/product_2/product2_6.jpg', 0),
(36, 48, 'catalog/demo/product/product_5/product5_4.jpg', 0),
(37, 48, 'catalog/demo/product/product_5/product5_5.jpg', 0),
(38, 48, 'catalog/demo/product/product_5/product5_7.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_option`
--

DROP TABLE IF EXISTS `mcc_product_option`;
CREATE TABLE `mcc_product_option` (
  `product_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_option`
--

INSERT INTO `mcc_product_option` (`product_option_id`, `product_id`, `option_id`, `value`, `required`) VALUES
(1, 30, 5, '', 1),
(2, 35, 11, '', 1),
(3, 42, 1, '', 1),
(4, 42, 2, '', 1),
(10, 42, 9, '22:25', 1),
(8, 42, 7, '', 1),
(9, 42, 8, '2011-02-20', 1),
(7, 42, 6, '', 1),
(6, 42, 5, '', 1),
(5, 42, 4, 'test', 1),
(11, 42, 10, '2011-02-20 22:25', 1),
(12, 47, 12, '2011-04-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_option_value`
--

DROP TABLE IF EXISTS `mcc_product_option_value`;
CREATE TABLE `mcc_product_option_value` (
  `product_option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `price_prefix` varchar(1) NOT NULL,
  `points` int(8) NOT NULL,
  `points_prefix` varchar(1) NOT NULL,
  `weight` decimal(15,8) NOT NULL,
  `weight_prefix` varchar(1) NOT NULL,
  PRIMARY KEY (`product_option_value_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_option_value`
--

INSERT INTO `mcc_product_option_value` (`product_option_value_id`, `product_option_id`, `product_id`, `option_id`, `option_value_id`, `quantity`, `subtract`, `price`, `price_prefix`, `points`, `points_prefix`, `weight`, `weight_prefix`) VALUES
(12, 4, 42, 2, 45, 3998, 1, '40.0000', '+', 0, '+', '40.00000000', '+'),
(13, 6, 42, 5, 39, 92, 1, '4.0000', '+', 0, '+', '4.00000000', '+'),
(8, 3, 42, 1, 43, 300, 1, '30.0000', '+', 3, '+', '30.00000000', '+'),
(9, 4, 42, 2, 23, 48, 1, '10.0000', '+', 0, '+', '10.00000000', '+'),
(10, 4, 42, 2, 24, 194, 1, '20.0000', '+', 0, '+', '20.00000000', '+'),
(11, 4, 42, 2, 44, 2696, 1, '30.0000', '+', 0, '+', '30.00000000', '+'),
(6, 3, 42, 1, 31, 146, 1, '20.0000', '+', 2, '-', '20.00000000', '+'),
(7, 3, 42, 1, 32, 96, 1, '10.0000', '+', 1, '+', '10.00000000', '+'),
(5, 2, 35, 11, 48, 15, 1, '15.0000', '+', 0, '+', '0.00000000', '+'),
(4, 2, 35, 11, 47, 10, 1, '10.0000', '+', 0, '+', '0.00000000', '+'),
(3, 2, 35, 11, 46, 0, 1, '5.0000', '+', 0, '+', '0.00000000', '+'),
(2, 1, 30, 5, 40, 2, 1, '0.0000', '+', 0, '+', '0.00000000', '+'),
(1, 1, 30, 5, 39, 0, 1, '0.0000', '+', 0, '+', '0.00000000', '+'),
(14, 6, 42, 5, 40, 300, 0, '3.0000', '+', 0, '+', '3.00000000', '+'),
(15, 6, 42, 5, 41, 100, 0, '1.0000', '+', 0, '+', '1.00000000', '+'),
(16, 6, 42, 5, 42, 200, 1, '2.0000', '+', 0, '+', '2.00000000', '+');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_recurring`
--

DROP TABLE IF EXISTS `mcc_product_recurring`;
CREATE TABLE `mcc_product_recurring` (
  `product_id` int(11) NOT NULL,
  `recurring_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`recurring_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_related`
--

DROP TABLE IF EXISTS `mcc_product_related`;
CREATE TABLE `mcc_product_related` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_related`
--

INSERT INTO `mcc_product_related` (`product_id`, `related_id`) VALUES
(40, 42),
(41, 42),
(42, 40),
(42, 41);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_reward`
--

DROP TABLE IF EXISTS `mcc_product_reward`;
CREATE TABLE `mcc_product_reward` (
  `product_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) NOT NULL DEFAULT '0',
  `points` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_reward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_reward`
--

INSERT INTO `mcc_product_reward` (`product_reward_id`, `product_id`, `customer_group_id`, `points`) VALUES
(6, 45, 1, 800),
(2, 30, 1, 200),
(8, 49, 1, 1000),
(5, 44, 1, 700),
(7, 47, 1, 300),
(11, 43, 1, 600),
(3, 42, 1, 100),
(1, 28, 1, 400);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_special`
--

DROP TABLE IF EXISTS `mcc_product_special`;
CREATE TABLE `mcc_product_special` (
  `product_special_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`product_special_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_special`
--

INSERT INTO `mcc_product_special` (`product_special_id`, `product_id`, `customer_group_id`, `priority`, `price`, `date_start`, `date_end`) VALUES
(1, 30, 1, 2, '90.0000', '2015-01-01', '2055-12-31'),
(3, 42, 1, 1, '90.0000', '2015-01-01', '2055-12-31'),
(2, 30, 1, 1, '80.0000', '2015-01-01', '2055-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_to_category`
--

DROP TABLE IF EXISTS `mcc_product_to_category`;
CREATE TABLE `mcc_product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_to_category`
--

INSERT INTO `mcc_product_to_category` (`product_id`, `category_id`) VALUES
(28, 20),
(28, 26),
(29, 25),
(29, 28),
(29, 36),
(30, 25),
(30, 28),
(30, 57),
(31, 25),
(31, 28),
(31, 36),
(32, 34),
(32, 43),
(33, 25),
(33, 28),
(33, 35),
(34, 34),
(34, 43),
(35, 20),
(35, 27),
(36, 34),
(36, 44),
(40, 20),
(40, 27),
(41, 25),
(41, 29),
(41, 32),
(42, 28),
(42, 36),
(43, 25),
(43, 28),
(43, 36),
(44, 25),
(44, 30),
(44, 32),
(45, 17),
(46, 20),
(46, 27),
(47, 20),
(47, 26),
(48, 34),
(48, 52),
(48, 58),
(49, 25),
(49, 28),
(49, 57);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_to_download`
--

DROP TABLE IF EXISTS `mcc_product_to_download`;
CREATE TABLE `mcc_product_to_download` (
  `product_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_to_layout`
--

DROP TABLE IF EXISTS `mcc_product_to_layout`;
CREATE TABLE `mcc_product_to_layout` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_to_layout`
--

INSERT INTO `mcc_product_to_layout` (`product_id`, `store_id`, `layout_id`) VALUES
(43, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_product_to_store`
--

DROP TABLE IF EXISTS `mcc_product_to_store`;
CREATE TABLE `mcc_product_to_store` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_product_to_store`
--

INSERT INTO `mcc_product_to_store` (`product_id`, `store_id`) VALUES
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(40, 0),
(41, 0),
(42, 0),
(43, 0),
(44, 0),
(45, 0),
(46, 0),
(47, 0),
(48, 0),
(49, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_pushurl`
--

DROP TABLE IF EXISTS `mcc_pushurl`;
CREATE TABLE `mcc_pushurl` (
  `pushurl_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `pushed` tinyint(1) NOT NULL,
  `push_date` datetime NOT NULL,
  PRIMARY KEY (`pushurl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_recurring`
--

DROP TABLE IF EXISTS `mcc_recurring`;
CREATE TABLE `mcc_recurring` (
  `recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,4) NOT NULL,
  `frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL,
  `cycle` int(10) UNSIGNED NOT NULL,
  `trial_status` tinyint(4) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `trial_frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `trial_duration` int(10) UNSIGNED NOT NULL,
  `trial_cycle` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`recurring_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_recurring_description`
--

DROP TABLE IF EXISTS `mcc_recurring_description`;
CREATE TABLE `mcc_recurring_description` (
  `recurring_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`recurring_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_return`
--

DROP TABLE IF EXISTS `mcc_return`;
CREATE TABLE `mcc_return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `product` varchar(255) NOT NULL,
  `model` varchar(64) NOT NULL,
  `quantity` int(4) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `return_reason_id` int(11) NOT NULL,
  `return_action_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `comment` text,
  `date_ordered` date NOT NULL DEFAULT '0000-00-00',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_return_action`
--

DROP TABLE IF EXISTS `mcc_return_action`;
CREATE TABLE `mcc_return_action` (
  `return_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`return_action_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_return_action`
--

INSERT INTO `mcc_return_action` (`return_action_id`, `language_id`, `name`) VALUES
(1, 3, '已退款'),
(2, 3, '退款至账户余额'),
(1, 2, 'Refunded'),
(2, 2, 'Credit Issued'),
(3, 2, 'Replacement Sent'),
(1, 1, '已退款'),
(2, 1, '退款至账户余额'),
(3, 1, '已换货配送'),
(3, 3, '已换货配送');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_return_history`
--

DROP TABLE IF EXISTS `mcc_return_history`;
CREATE TABLE `mcc_return_history` (
  `return_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`return_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_return_reason`
--

DROP TABLE IF EXISTS `mcc_return_reason`;
CREATE TABLE `mcc_return_reason` (
  `return_reason_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`return_reason_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_return_reason`
--

INSERT INTO `mcc_return_reason` (`return_reason_id`, `language_id`, `name`) VALUES
(2, 3, '收到错误物品'),
(5, 3, '其他，请提供详细信息'),
(1, 3, '收到货物时已使用不上'),
(4, 3, '有瑕疵，请提供详细信息'),
(3, 3, '订单错误'),
(1, 2, 'Dead On Arrival'),
(2, 2, 'Received Wrong Item'),
(3, 2, 'Order Error'),
(4, 2, 'Faulty, please supply details'),
(5, 2, 'Other, please supply details'),
(1, 1, '收到货物时已使用不上'),
(2, 1, '收到错误物品'),
(3, 1, '订单错误'),
(4, 1, '有瑕疵，请提供详细信息'),
(5, 1, '其他，请提供详细信息');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_return_status`
--

DROP TABLE IF EXISTS `mcc_return_status`;
CREATE TABLE `mcc_return_status` (
  `return_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`return_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_return_status`
--

INSERT INTO `mcc_return_status` (`return_status_id`, `language_id`, `name`) VALUES
(2, 3, '等待商品退回'),
(1, 3, '等待处理'),
(1, 2, 'Pending'),
(3, 2, 'Complete'),
(2, 2, 'Awaiting Products'),
(1, 1, '等待处理'),
(3, 1, '完成'),
(2, 1, '等待商品退回'),
(3, 3, '完成');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_review`
--

DROP TABLE IF EXISTS `mcc_review`;
CREATE TABLE `mcc_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_seo_url`
--

DROP TABLE IF EXISTS `mcc_seo_url`;
CREATE TABLE `mcc_seo_url` (
  `seo_url_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`seo_url_id`),
  KEY `query` (`query`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_seo_url`
--

INSERT INTO `mcc_seo_url` (`seo_url_id`, `store_id`, `language_id`, `query`, `keyword`) VALUES
(941, 0, 0, 'product_id=34', 'ipod-shuffle'),
(929, 0, 0, 'category_id=52', 'test20'),
(926, 0, 0, 'category_id=49', 'test17'),
(925, 0, 0, 'category_id=48', 'test16'),
(730, 0, 1, 'manufacturer_id=8', 'apple'),
(772, 0, 1, 'information_id=4', 'about_us'),
(948, 0, 0, 'product_id=44', 'macbook-air'),
(927, 0, 0, 'category_id=50', 'test18'),
(923, 0, 0, 'category_id=44', 'test12'),
(774, 0, 1, 'category_id=18', 'laptop-notebook'),
(775, 0, 1, 'category_id=46', 'macs'),
(776, 0, 1, 'category_id=45', 'windows'),
(928, 0, 0, 'category_id=51', 'test19'),
(922, 0, 0, 'category_id=43', 'test11'),
(924, 0, 0, 'category_id=47', 'test15'),
(921, 0, 0, 'category_id=42', 'test9'),
(918, 0, 0, 'category_id=39', 'test6'),
(919, 0, 0, 'category_id=40', 'test7'),
(920, 0, 0, 'category_id=41', 'test8'),
(787, 0, 1, 'category_id=24', 'smartphone'),
(788, 0, 1, 'category_id=33', 'camera'),
(916, 0, 0, 'category_id=37', 'test5'),
(915, 0, 0, 'category_id=31', 'scanner'),
(914, 0, 0, 'category_id=30', 'printer'),
(913, 0, 0, 'category_id=29', 'mouse'),
(912, 0, 0, 'category_id=57', 'tablet'),
(911, 0, 0, 'category_id=36', 'test2'),
(910, 0, 0, 'category_id=35', 'test1'),
(909, 0, 0, 'category_id=32', 'web-camera'),
(902, 0, 0, 'category_id=20', 'desktops'),
(908, 0, 0, 'category_id=28', 'monitor'),
(907, 0, 0, 'category_id=27', 'mac'),
(903, 0, 0, 'category_id=25', 'component'),
(904, 0, 0, 'category_id=17', 'software'),
(905, 0, 0, 'category_id=34', 'mp3-players'),
(906, 0, 0, 'category_id=26', 'pc'),
(917, 0, 0, 'category_id=38', 'test4'),
(942, 0, 0, 'product_id=35', 'product-8'),
(946, 0, 0, 'product_id=42', 'test'),
(943, 0, 0, 'product_id=36', 'ipod-nano'),
(944, 0, 0, 'product_id=40', 'iphone'),
(945, 0, 0, 'product_id=41', 'imac'),
(935, 0, 0, 'product_id=28', 'htc-touch-hd'),
(936, 0, 0, 'product_id=29', 'palm-treo-pro'),
(937, 0, 0, 'product_id=30', 'canon-eos-5d'),
(938, 0, 0, 'product_id=31', 'nikon-d300'),
(939, 0, 0, 'product_id=32', 'ipod-touch'),
(940, 0, 0, 'product_id=33', 'samsung-syncmaster-941bw'),
(828, 0, 1, 'manufacturer_id=9', 'canon'),
(829, 0, 1, 'manufacturer_id=5', 'htc'),
(830, 0, 1, 'manufacturer_id=7', 'hewlett-packard'),
(831, 0, 1, 'manufacturer_id=6', 'palm'),
(832, 0, 1, 'manufacturer_id=10', 'sony'),
(841, 0, 1, 'information_id=6', 'delivery'),
(842, 0, 1, 'information_id=3', 'privacy'),
(843, 0, 1, 'information_id=5', 'terms'),
(1012, 0, 3, 'blog_category_id=8', '唤-醒-人-类'),
(1003, 0, 3, 'blog_category_id=10', '与-神-合-一'),
(1015, 0, 3, 'blog_id=16', '测-试-文-章'),
(1014, 0, 1, 'blog_id=16', '测试文章'),
(1013, 0, 2, 'blog_id=16', 'Testing-Article'),
(887, 0, 2, 'blog_id=2', 'blog-2'),
(888, 0, 1, 'blog_id=2', '你对自己的意愿也即是神对你的意愿每件事都是神圣的存在'),
(889, 0, 3, 'blog_id=2', '你对自己的意愿也即是神对你的意愿-每件事都是神圣的存在'),
(956, 0, 3, 'press_category_id=1', '新-闻-分-类-一'),
(955, 0, 1, 'press_category_id=1', '新闻分类一'),
(954, 0, 2, 'press_category_id=1', 'Press Category One'),
(893, 0, 2, 'press_id=10', 'Press One'),
(894, 0, 1, 'press_id=10', '新闻1'),
(895, 0, 3, 'press_id=10', '新-闻-一'),
(896, 0, 2, 'faq_category_id=13', 'Faq-One'),
(897, 0, 1, 'faq_category_id=13', '常见问题分类一'),
(898, 0, 3, 'faq_category_id=13', '常-见-问-题-分-类-一'),
(930, 0, 0, 'category_id=53', 'test21'),
(931, 0, 0, 'category_id=54', 'test22'),
(932, 0, 0, 'category_id=55', 'test23'),
(933, 0, 0, 'category_id=56', 'test24'),
(934, 0, 0, 'category_id=58', 'test25'),
(949, 0, 0, 'product_id=45', 'macbook-pro'),
(950, 0, 0, 'product_id=46', 'sony-vaio'),
(951, 0, 0, 'product_id=47', 'hp-lp3065'),
(952, 0, 0, 'product_id=48', 'ipod-classic'),
(953, 0, 0, 'product_id=49', 'samsung-galaxy-tab-10-1'),
(957, 0, 2, 'press_category_id=2', 'press-category-two'),
(958, 0, 1, 'press_category_id=2', '新闻分类二'),
(959, 0, 3, 'press_category_id=2', '新-闻-分-类-二'),
(962, 0, 2, 'press_category_id=7', 'press-category-three'),
(963, 0, 1, 'press_category_id=7', '新闻分类三'),
(964, 0, 3, 'press_category_id=7', '新-闻-分-类-三'),
(993, 0, 1, 'blog_category_id=1', '与神对话1'),
(992, 0, 2, 'blog_category_id=1', 'conversation-with-god-1'),
(968, 0, 2, 'blog_category_id=2', 'conversation-with-god-2'),
(969, 0, 1, 'blog_category_id=2', '与神对话2'),
(970, 0, 3, 'blog_category_id=2', '与-神-对-话-2'),
(996, 0, 1, 'blog_category_id=6', '与神对话3'),
(995, 0, 2, 'blog_category_id=6', 'conversation-with-god-3'),
(1010, 0, 2, 'blog_category_id=8', 'awaken-the-species'),
(1011, 0, 1, 'blog_category_id=8', '唤醒人类'),
(1000, 0, 3, 'blog_category_id=9', '与-神-为-友'),
(999, 0, 1, 'blog_category_id=9', '与神为友'),
(980, 0, 2, 'press_id=1', 'press-1'),
(981, 0, 1, 'press_id=1', '新闻1'),
(982, 0, 3, 'press_id=1', '新-闻-1'),
(998, 0, 2, 'blog_category_id=9', 'be-friend-with-god'),
(1002, 0, 1, 'blog_category_id=10', '与神合一'),
(1001, 0, 2, 'blog_category_id=10', 'oneness-with-god'),
(1006, 0, 3, 'blog_category_id=11', '与-神-回-家'),
(1005, 0, 1, 'blog_category_id=11', '与神回家'),
(1004, 0, 2, 'blog_category_id=11', 'home-with-god'),
(994, 0, 3, 'blog_category_id=1', '与-神-对-话-1'),
(997, 0, 3, 'blog_category_id=6', '与-神-对-话-3');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_session`
--

DROP TABLE IF EXISTS `mcc_session`;
CREATE TABLE `mcc_session` (
  `session_id` varchar(32) NOT NULL,
  `data` text NOT NULL,
  `expire` datetime NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_setting`
--

DROP TABLE IF EXISTS `mcc_setting`;
CREATE TABLE `mcc_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(128) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5026 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_setting`
--

INSERT INTO `mcc_setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(5019, 0, 'config', 'config_file_max_size', '300000', 0),
(5020, 0, 'config', 'config_file_ext_allowed', 'zip\r\ntxt\r\npng\r\njpe\r\njpeg\r\njpg\r\ngif\r\nbmp\r\nico\r\ntiff\r\ntif\r\nsvg\r\nsvgz\r\nzip\r\nrar\r\nmsi\r\ncab\r\nmp3\r\nqt\r\nmov\r\npdf\r\npsd\r\nai\r\neps\r\nps\r\ndoc', 0),
(5021, 0, 'config', 'config_file_mime_allowed', 'text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/tiff\r\nimage/svg+xml\r\napplication/zip\r\n&quot;application/zip&quot;\r\napplication/x-zip\r\n&quot;application/x-zip&quot;\r\napplication/x-zip-compressed\r\n&quot;application/x-zip-compressed&quot;\r\napplication/rar\r\n&quot;application/rar&quot;\r\napplication/x-rar\r\n&quot;application/x-rar&quot;\r\napplication/x-rar-compressed\r\n&quot;application/x-rar-compressed&quot;\r\napplication/octet-stream\r\n&quot;application/octet-stream&quot;\r\naudio/mpeg\r\nvideo/quicktime\r\napplication/pdf', 0),
(5003, 0, 'config', 'config_mail_parameter', '', 0),
(5004, 0, 'config', 'config_mail_smtp_hostname', '', 0),
(5005, 0, 'config', 'config_mail_smtp_username', '', 0),
(5006, 0, 'config', 'config_mail_smtp_password', '', 0),
(5007, 0, 'config', 'config_mail_smtp_port', '25', 0),
(5008, 0, 'config', 'config_mail_smtp_timeout', '5', 0),
(5009, 0, 'config', 'config_mail_alert', '["account","affiliate","order","review"]', 1),
(5010, 0, 'config', 'config_mail_alert_email', '', 0),
(5011, 0, 'config', 'config_maintenance', '0', 0),
(5012, 0, 'config', 'config_seo_url', '0', 0),
(5013, 0, 'config', 'config_robots', 'abot\r\ndbot\r\nebot\r\nhbot\r\nkbot\r\nlbot\r\nmbot\r\nnbot\r\nobot\r\npbot\r\nrbot\r\nsbot\r\ntbot\r\nvbot\r\nybot\r\nzbot\r\nbot.\r\nbot/\r\n_bot\r\n.bot\r\n/bot\r\n-bot\r\n:bot\r\n(bot\r\ncrawl\r\nslurp\r\nspider\r\nseek\r\naccoona\r\nacoon\r\nadressendeutschland\r\nah-ha.com\r\nahoy\r\naltavista\r\nananzi\r\nanthill\r\nappie\r\narachnophilia\r\narale\r\naraneo\r\naranha\r\narchitext\r\naretha\r\narks\r\nasterias\r\natlocal\r\natn\r\natomz\r\naugurfind\r\nbackrub\r\nbannana_bot\r\nbaypup\r\nbdfetch\r\nbig brother\r\nbiglotron\r\nbjaaland\r\nblackwidow\r\nblaiz\r\nblog\r\nblo.\r\nbloodhound\r\nboitho\r\nbooch\r\nbradley\r\nbutterfly\r\ncalif\r\ncassandra\r\nccubee\r\ncfetch\r\ncharlotte\r\nchurl\r\ncienciaficcion\r\ncmc\r\ncollective\r\ncomagent\r\ncombine\r\ncomputingsite\r\ncsci\r\ncurl\r\ncusco\r\ndaumoa\r\ndeepindex\r\ndelorie\r\ndepspid\r\ndeweb\r\ndie blinde kuh\r\ndigger\r\nditto\r\ndmoz\r\ndocomo\r\ndownload express\r\ndtaagent\r\ndwcp\r\nebiness\r\nebingbong\r\ne-collector\r\nejupiter\r\nemacs-w3 search engine\r\nesther\r\nevliya celebi\r\nezresult\r\nfalcon\r\nfelix ide\r\nferret\r\nfetchrover\r\nfido\r\nfindlinks\r\nfireball\r\nfish search\r\nfouineur\r\nfunnelweb\r\ngazz\r\ngcreep\r\ngenieknows\r\ngetterroboplus\r\ngeturl\r\nglx\r\ngoforit\r\ngolem\r\ngrabber\r\ngrapnel\r\ngralon\r\ngriffon\r\ngromit\r\ngrub\r\ngulliver\r\nhamahakki\r\nharvest\r\nhavindex\r\nhelix\r\nheritrix\r\nhku www octopus\r\nhomerweb\r\nhtdig\r\nhtml index\r\nhtml_analyzer\r\nhtmlgobble\r\nhubater\r\nhyper-decontextualizer\r\nia_archiver\r\nibm_planetwide\r\nichiro\r\niconsurf\r\niltrovatore\r\nimage.kapsi.net\r\nimagelock\r\nincywincy\r\nindexer\r\ninfobee\r\ninformant\r\ningrid\r\ninktomisearch.com\r\ninspector web\r\nintelliagent\r\ninternet shinchakubin\r\nip3000\r\niron33\r\nisraeli-search\r\nivia\r\njack\r\njakarta\r\njavabee\r\njetbot\r\njumpstation\r\nkatipo\r\nkdd-explorer\r\nkilroy\r\nknowledge\r\nkototoi\r\nkretrieve\r\nlabelgrabber\r\nlachesis\r\nlarbin\r\nlegs\r\nlibwww\r\nlinkalarm\r\nlink validator\r\nlinkscan\r\nlockon\r\nlwp\r\nlycos\r\nmagpie\r\nmantraagent\r\nmapoftheinternet\r\nmarvin/\r\nmattie\r\nmediafox\r\nmediapartners\r\nmercator\r\nmerzscope\r\nmicrosoft url control\r\nminirank\r\nmiva\r\nmj12\r\nmnogosearch\r\nmoget\r\nmonster\r\nmoose\r\nmotor\r\nmultitext\r\nmuncher\r\nmuscatferret\r\nmwd.search\r\nmyweb\r\nnajdi\r\nnameprotect\r\nnationaldirectory\r\nnazilla\r\nncsa beta\r\nnec-meshexplorer\r\nnederland.zoek\r\nnetcarta webmap engine\r\nnetmechanic\r\nnetresearchserver\r\nnetscoop\r\nnewscan-online\r\nnhse\r\nnokia6682/\r\nnomad\r\nnoyona\r\nnutch\r\nnzexplorer\r\nobjectssearch\r\noccam\r\nomni\r\nopen text\r\nopenfind\r\nopenintelligencedata\r\norb search\r\nosis-project\r\npack rat\r\npageboy\r\npagebull\r\npage_verifier\r\npanscient\r\nparasite\r\npartnersite\r\npatric\r\npear.\r\npegasus\r\nperegrinator\r\npgp key agent\r\nphantom\r\nphpdig\r\npicosearch\r\npiltdownman\r\npimptrain\r\npinpoint\r\npioneer\r\npiranha\r\nplumtreewebaccessor\r\npogodak\r\npoirot\r\npompos\r\npoppelsdorf\r\npoppi\r\npopular iconoclast\r\npsycheclone\r\npublisher\r\npython\r\nrambler\r\nraven search\r\nroach\r\nroad runner\r\nroadhouse\r\nrobbie\r\nrobofox\r\nrobozilla\r\nrules\r\nsalty\r\nsbider\r\nscooter\r\nscoutjet\r\nscrubby\r\nsearch.\r\nsearchprocess\r\nsemanticdiscovery\r\nsenrigan\r\nsg-scout\r\nshai\'hulud\r\nshark\r\nshopwiki\r\nsidewinder\r\nsift\r\nsilk\r\nsimmany\r\nsite searcher\r\nsite valet\r\nsitetech-rover\r\nskymob.com\r\nsleek\r\nsmartwit\r\nsna-\r\nsnappy\r\nsnooper\r\nsohu\r\nspeedfind\r\nsphere\r\nsphider\r\nspinner\r\nspyder\r\nsteeler/\r\nsuke\r\nsuntek\r\nsupersnooper\r\nsurfnomore\r\nsven\r\nsygol\r\nszukacz\r\ntach black widow\r\ntarantula\r\ntempleton\r\n/teoma\r\nt-h-u-n-d-e-r-s-t-o-n-e\r\ntheophrastus\r\ntitan\r\ntitin\r\ntkwww\r\ntoutatis\r\nt-rex\r\ntutorgig\r\ntwiceler\r\ntwisted\r\nucsd\r\nudmsearch\r\nurl check\r\nupdated\r\nvagabondo\r\nvalkyrie\r\nverticrawl\r\nvictoria\r\nvision-search\r\nvolcano\r\nvoyager/\r\nvoyager-hc\r\nw3c_validator\r\nw3m2\r\nw3mir\r\nwalker\r\nwallpaper\r\nwanderer\r\nwauuu\r\nwavefire\r\nweb core\r\nweb hopper\r\nweb wombat\r\nwebbandit\r\nwebcatcher\r\nwebcopy\r\nwebfoot\r\nweblayers\r\nweblinker\r\nweblog monitor\r\nwebmirror\r\nwebmonkey\r\nwebquest\r\nwebreaper\r\nwebsitepulse\r\nwebsnarf\r\nwebstolperer\r\nwebvac\r\nwebwalk\r\nwebwatch\r\nwebwombat\r\nwebzinger\r\nwhizbang\r\nwhowhere\r\nwild ferret\r\nworldlight\r\nwwwc\r\nwwwster\r\nxenu\r\nxget\r\nxift\r\nxirq\r\nyandex\r\nyanga\r\nyeti\r\nyodao\r\nzao\r\nzippp\r\nzyborg', 0),
(5018, 0, 'config', 'config_encryption', 'FYiHkimGLh3RxV9KyNvIWUiqH7sKof4nQQv6Or1dIgABteLeRFj9q6wVyjnEal42ArXnyl6XU2o4Br58BPJMB5XVy5DUPKthrAC6L5PWE0kbnQjeTRGhyLu13BgvXSel5xOs7oEwN6BtyChnYtb5DuqC30a2kLkAVt9lsMl54T9oMWwYn6vhjtCymPwKhGiiMJDdAkObvd8N606RGACyWw6ZhGP3TrGh8m6WIY3qyRPEFCepHJqcgB9oWaJEDBOl1d9CRFoa9UF2aYyowgFn50wQhXoSezth2XbjmzZ6CPsQ7QD5Z6T1l5K53dVI3eZF3v2dbEiS2Af3iBvVSCOpVWtlR3PINITRDHF1ZmC2NpEFgjFNqvRAhqYxKIndHo3VHulMppoF27v3TZyDbIGqsKa5kaP336Rm0I7OZ7YeefvqeQGvskyTyVl2ogLJ7mZVVu0MJebvGr0jDMdcKLJMbGptbYTnJRriKHOlem6diYDznSpplVldGISiI7thBwoAO3fkKEJgmws1DPazHb0WC0L4y1hhYiDfYMSVTic3VNhVScd3HjqGbEpBPmsA3YqlgGrESxoJMbA64ObFNhz2z1jKYaCqKg5UNI2D0Betpqw7YmuqTEau5m49KkoQIVRur3KtUa26jnS7eZu1bjeY50e9Yd8Sv0doI6NPoXATJe5FgRRGa2QvPVzxAKxzTHNmBl1mydG9wYUcLq7MNcSzMtVjEBEqpkyBAuQCNVYruOvSQEDQ6TyNQpOU3rGZQgzuR66LkmU1dD0kHpoY9YUJbca6JZmBGb5vWw4GjlKbR3Wumenb1hrEcJeU0c0O5BiqCK75dPNZM2XsVnTlMN1MsZBDckNKYJMrcG0k3mNWwACZco53p5nqT2KEEm9G7AoiLUiYtrwip6h9ZUrtjMgdncxGmxgr3T53BCeXvgJD1LGNBFikMelm5Bv1uo0zTP2PDrwzN9Tr9rPCRR19439GVUgkAlJCGiCKJcKBRK8izuikZpMSVb6MTa3NVpuAXOtg', 0),
(5014, 0, 'config', 'config_compression', '0', 0),
(5015, 0, 'config', 'config_secure', '0', 0),
(5016, 0, 'config', 'config_password', '1', 0),
(5017, 0, 'config', 'config_shared', '0', 0),
(5002, 0, 'config', 'config_mail_engine', 'mail', 0),
(5000, 0, 'config', 'config_logo', 'catalog/logo.png', 0),
(5001, 0, 'config', 'config_icon', 'catalog/cart.png', 0),
(4999, 0, 'config', 'config_limit_autocomplete', '50', 0),
(4998, 0, 'config', 'config_sms_page', '["register","edit_account","order_admin","order_customer"]', 1),
(670, 0, 'voucher', 'voucher_sort_order', '8', 0),
(669, 0, 'voucher', 'voucher_status', '1', 0),
(95, 0, 'free_checkout', 'free_checkout_status', '1', 0),
(96, 0, 'free_checkout', 'free_checkout_order_status_id', '1', 0),
(97, 0, 'shipping', 'shipping_sort_order', '3', 0),
(98, 0, 'sub_total', 'sub_total_sort_order', '1', 0),
(99, 0, 'sub_total', 'sub_total_status', '1', 0),
(100, 0, 'tax', 'tax_status', '1', 0),
(101, 0, 'total', 'total_sort_order', '9', 0),
(102, 0, 'total', 'total_status', '1', 0),
(103, 0, 'tax', 'tax_sort_order', '5', 0),
(104, 0, 'free_checkout', 'free_checkout_sort_order', '1', 0),
(105, 0, 'cod', 'cod_sort_order', '5', 0),
(106, 0, 'cod', 'cod_total', '0.01', 0),
(107, 0, 'cod', 'cod_order_status_id', '1', 0),
(108, 0, 'cod', 'cod_geo_zone_id', '0', 0),
(109, 0, 'cod', 'cod_status', '1', 0),
(110, 0, 'shipping', 'shipping_status', '1', 0),
(111, 0, 'shipping', 'shipping_estimator', '1', 0),
(112, 0, 'coupon', 'coupon_sort_order', '4', 0),
(113, 0, 'coupon', 'coupon_status', '1', 0),
(114, 0, 'flat', 'flat_sort_order', '1', 0),
(115, 0, 'flat', 'flat_status', '1', 0),
(116, 0, 'flat', 'flat_geo_zone_id', '0', 0),
(117, 0, 'flat', 'flat_tax_class_id', '9', 0),
(118, 0, 'flat', 'flat_cost', '5.00', 0),
(119, 0, 'credit', 'credit_sort_order', '7', 0),
(120, 0, 'credit', 'credit_status', '1', 0),
(121, 0, 'reward', 'reward_sort_order', '2', 0),
(122, 0, 'reward', 'reward_status', '1', 0),
(123, 0, 'category', 'category_status', '1', 0),
(124, 0, 'account', 'account_status', '1', 0),
(125, 0, 'affiliate', 'affiliate_status', '1', 0),
(665, 0, 'theme_default', 'theme_default_image_cart_width', '47', 0),
(664, 0, 'theme_default', 'theme_default_image_wishlist_height', '47', 0),
(663, 0, 'theme_default', 'theme_default_image_wishlist_width', '47', 0),
(662, 0, 'theme_default', 'theme_default_image_compare_height', '90', 0),
(661, 0, 'theme_default', 'theme_default_image_compare_width', '90', 0),
(660, 0, 'theme_default', 'theme_default_image_related_height', '200', 0),
(659, 0, 'theme_default', 'theme_default_image_related_width', '200', 0),
(658, 0, 'theme_default', 'theme_default_image_additional_height', '74', 0),
(657, 0, 'theme_default', 'theme_default_image_additional_width', '74', 0),
(656, 0, 'theme_default', 'theme_default_image_product_height', '228', 0),
(655, 0, 'theme_default', 'theme_default_image_product_width', '228', 0),
(654, 0, 'theme_default', 'theme_default_image_popup_height', '500', 0),
(653, 0, 'theme_default', 'theme_default_image_popup_width', '500', 0),
(652, 0, 'theme_default', 'theme_default_image_thumb_height', '228', 0),
(651, 0, 'theme_default', 'theme_default_image_thumb_width', '228', 0),
(650, 0, 'theme_default', 'theme_default_image_category_height', '80', 0),
(649, 0, 'theme_default', 'theme_default_image_category_width', '80', 0),
(648, 0, 'theme_default', 'theme_default_product_description_length', '100', 0),
(647, 0, 'theme_default', 'theme_default_product_limit', '15', 0),
(646, 0, 'theme_default', 'theme_default_status', '1', 0),
(645, 0, 'theme_default', 'theme_default_directory', 'default', 0),
(636, 0, 'dashboard_activity', 'dashboard_activity_sort_order', '7', 0),
(635, 0, 'dashboard_activity', 'dashboard_activity_status', '1', 0),
(152, 0, 'dashboard_sale', 'dashboard_sale_status', '1', 0),
(153, 0, 'dashboard_sale', 'dashboard_sale_width', '3', 0),
(154, 0, 'dashboard_chart', 'dashboard_chart_status', '1', 0),
(155, 0, 'dashboard_chart', 'dashboard_chart_width', '6', 0),
(156, 0, 'dashboard_customer', 'dashboard_customer_status', '1', 0),
(157, 0, 'dashboard_customer', 'dashboard_customer_width', '3', 0),
(158, 0, 'dashboard_map', 'dashboard_map_status', '1', 0),
(159, 0, 'dashboard_map', 'dashboard_map_width', '6', 0),
(160, 0, 'dashboard_online', 'dashboard_online_status', '1', 0),
(161, 0, 'dashboard_online', 'dashboard_online_width', '3', 0),
(162, 0, 'dashboard_order', 'dashboard_order_sort_order', '1', 0),
(163, 0, 'dashboard_order', 'dashboard_order_status', '1', 0),
(164, 0, 'dashboard_order', 'dashboard_order_width', '3', 0),
(165, 0, 'dashboard_sale', 'dashboard_sale_sort_order', '2', 0),
(166, 0, 'dashboard_customer', 'dashboard_customer_sort_order', '3', 0),
(167, 0, 'dashboard_online', 'dashboard_online_sort_order', '4', 0),
(168, 0, 'dashboard_map', 'dashboard_map_sort_order', '5', 0),
(169, 0, 'dashboard_chart', 'dashboard_chart_sort_order', '6', 0),
(170, 0, 'dashboard_recent', 'dashboard_recent_status', '1', 0),
(171, 0, 'dashboard_recent', 'dashboard_recent_sort_order', '8', 0),
(634, 0, 'dashboard_activity', 'dashboard_activity_width', '4', 0),
(173, 0, 'dashboard_recent', 'dashboard_recent_width', '8', 0),
(633, 0, 'basic_captcha', 'basic_captcha_status', '1', 0),
(668, 0, 'theme_default', 'theme_default_image_location_height', '50', 0),
(667, 0, 'theme_default', 'theme_default_image_location_width', '268', 0),
(666, 0, 'theme_default', 'theme_default_image_cart_height', '47', 0),
(4997, 0, 'config', 'config_sms', 'chuanglan', 0),
(4996, 0, 'config', 'config_captcha_page', '["register","guest","review","return","contact"]', 1),
(4994, 0, 'config', 'config_return_status_id', '2', 0),
(4995, 0, 'config', 'config_captcha', 'basic', 0),
(4993, 0, 'config', 'config_return_id', '0', 0),
(4992, 0, 'config', 'config_affiliate_id', '4', 0),
(4991, 0, 'config', 'config_affiliate_commission', '5', 0),
(4990, 0, 'config', 'config_affiliate_auto', '0', 0),
(4989, 0, 'config', 'config_affiliate_approval', '0', 0),
(4988, 0, 'config', 'config_affiliate_group_id', '2', 0),
(4987, 0, 'config', 'config_stock_checkout', '0', 0),
(4985, 0, 'config', 'config_stock_display', '1', 0),
(4986, 0, 'config', 'config_stock_warning', '0', 0),
(4984, 0, 'config', 'config_api_id', '1', 0),
(4983, 0, 'config', 'config_fraud_status_id', '7', 0),
(4727, 0, 'cms_press', 'cms_press_items_per_page', '20', 0),
(4726, 0, 'cms_press', 'cms_press_brief_length', '200', 0),
(4762, 0, 'cms_blog', 'cms_blog_show_blog_related', '1', 0),
(4761, 0, 'cms_blog', 'cms_blog_product_related_per_row', '3', 0),
(4760, 0, 'cms_blog', 'cms_blog_product_scroll_related', '0', 0),
(4759, 0, 'cms_blog', 'cms_blog_show_product_related', '1', 0),
(4758, 0, 'cms_blog', 'cms_blog_show_category', '1', 0),
(4757, 0, 'cms_blog', 'cms_blog_show_author', '1', 0),
(4756, 0, 'cms_blog', 'cms_blog_show_image', '1', 0),
(4755, 0, 'cms_blog', 'cms_blog_show_title', '1', 0),
(4754, 0, 'cms_blog', 'cms_blog_image_type', 'l', 0),
(4753, 0, 'cms_blog', 'cms_blog_category_page_show_comment_counter', '1', 0),
(4752, 0, 'cms_blog', 'cms_blog_category_page_show_hits', '1', 0),
(4751, 0, 'cms_blog', 'cms_blog_category_page_show_created_date', '1', 0),
(4750, 0, 'cms_blog', 'cms_blog_category_page_show_category', '1', 0),
(4749, 0, 'cms_blog', 'cms_blog_category_page_show_author', '1', 0),
(4748, 0, 'cms_blog', 'cms_blog_category_page_show_image', '1', 0),
(4747, 0, 'cms_blog', 'cms_blog_category_page_show_readmore', '1', 0),
(4746, 0, 'cms_blog', 'cms_blog_category_page_show_brief', '1', 0),
(4745, 0, 'cms_blog', 'cms_blog_category_page_show_title', '1', 0),
(4744, 0, 'cms_blog', 'cms_blog_category_columns_secondary_blogs', '  ', 0),
(4743, 0, 'cms_blog', 'cms_blog_category_columns_leading_blog', '  ', 0),
(4742, 0, 'cms_blog', 'cms_blog_category_secondary_image_type', 's', 0),
(4776, 0, 'cms_faq', 'cms_faq_items_per_page', '20', 0),
(1663, 0, 'blog_search', 'blog_search_status', '1', 0),
(4359, 0, 'module_blog_category', 'module_blog_category_status', '1', 0),
(4741, 0, 'cms_blog', 'cms_blog_category_leading_image_type', 'l', 0),
(4740, 0, 'cms_blog', 'cms_blog_category_limit_secondary_blog', '', 0),
(1761, 0, 'press_latest', 'press_latest_status', '1', 0),
(4357, 0, 'module_press_category', 'module_press_category_status', '1', 0),
(1763, 0, 'faq_category', 'faq_category_status', '1', 0),
(4725, 0, 'cms_press', 'cms_press_description', '{"2":{"title":"MyCnCart News","meta_title":"MyCnCart News","meta_description":"MyCnCart News","meta_keyword":"MyCnCart, News"},"1":{"title":"MyCnCart \\u65b0\\u95fb","meta_title":"MyCnCart \\u65b0\\u95fb","meta_description":"MyCnCart \\u65b0\\u95fb","meta_keyword":"MyCnCart, \\u65b0\\u95fb"},"3":{"title":"MyCnCart \\u65b0\\u805e","meta_title":"MyCnCart \\u65b0\\u805e","meta_description":"MyCnCart \\u65b0\\u805e","meta_keyword":"MyCnCart, \\u65b0\\u805e"}}', 1),
(4775, 0, 'cms_faq', 'cms_faq_description', '{"2":{"title":"FAQs","meta_title":"FAQs","meta_description":"FAQs","meta_keyword":"FAQs"},"1":{"title":"\\u5e38\\u89c1\\u95ee\\u9898\\u4e0e\\u89e3\\u7b54(FAQs)","meta_title":"\\u5e38\\u89c1\\u95ee\\u9898\\u4e0e\\u89e3\\u7b54(FAQs)","meta_description":"\\u5e38\\u89c1\\u95ee\\u9898\\u4e0e\\u89e3\\u7b54(FAQs)","meta_keyword":"\\u5e38\\u89c1\\u95ee\\u9898\\u4e0e\\u89e3\\u7b54(FAQs)"},"3":{"title":"\\u5e38\\u898b\\u554f\\u984c\\u8207\\u89e3\\u7b54(FAQs)","meta_title":"\\u5e38\\u898b\\u554f\\u984c\\u8207\\u89e3\\u7b54(FAQs)","meta_description":"\\u5e38\\u898b\\u554f\\u984c\\u8207\\u89e3\\u7b54(FAQs)","meta_keyword":"\\u5e38\\u898b\\u554f\\u984c\\u8207\\u89e3\\u7b54(FAQs)"}}', 1),
(2571, 0, 'free', 'free_total', '0.01', 0),
(2572, 0, 'free', 'free_geo_zone_id', '0', 0),
(2573, 0, 'free', 'free_status', '1', 0),
(2574, 0, 'free', 'free_sort_order', '2', 0),
(4931, 0, 'chuanglan', 'chuanglan_password', '4sdAckaJeV39bc', 0),
(4982, 0, 'config', 'config_complete_status', '["5","3"]', 1),
(4981, 0, 'config', 'config_processing_status', '["2","5","3","1"]', 1),
(4980, 0, 'config', 'config_order_status_id', '1', 0),
(4979, 0, 'config', 'config_checkout_id', '5', 0),
(4978, 0, 'config', 'config_checkout_guest', '1', 0),
(4977, 0, 'config', 'config_cart_weight', '1', 0),
(4976, 0, 'config', 'config_invoice_prefix', 'INV-2016-00', 0),
(4975, 0, 'config', 'config_account_id', '3', 0),
(4974, 0, 'config', 'config_login_attempts', '5', 0),
(4973, 0, 'config', 'config_customer_price', '0', 0),
(4972, 0, 'config', 'config_customer_group_display', '["1"]', 1),
(4971, 0, 'config', 'config_customer_group_id', '1', 0),
(4970, 0, 'config', 'config_customer_search', '0', 0),
(4969, 0, 'config', 'config_customer_activity', '0', 0),
(4968, 0, 'config', 'config_customer_online', '0', 0),
(4967, 0, 'config', 'config_tax_customer', '', 0),
(4966, 0, 'config', 'config_tax_default', '', 0),
(4965, 0, 'config', 'config_tax', '0', 0),
(4964, 0, 'config', 'config_voucher_max', '1000', 0),
(4963, 0, 'config', 'config_voucher_min', '1', 0),
(3949, 0, 'shipping_flat', 'shipping_flat_cost', '5', 0),
(3950, 0, 'shipping_flat', 'shipping_flat_tax_class_id', '0', 0),
(3951, 0, 'shipping_flat', 'shipping_flat_geo_zone_id', '0', 0),
(3952, 0, 'shipping_flat', 'shipping_flat_status', '1', 0),
(3953, 0, 'shipping_flat', 'shipping_flat_sort_order', '', 0),
(3954, 0, 'payment_free_checkout', 'payment_free_checkout_status', '1', 0),
(3955, 0, 'payment_free_checkout', 'payment_free_checkout_sort_order', '', 0),
(3956, 0, 'payment_cod', 'payment_cod_total', '0.01', 0),
(3957, 0, 'payment_cod', 'payment_cod_order_status_id', '2', 0),
(3958, 0, 'payment_cod', 'payment_cod_geo_zone_id', '0', 0),
(3959, 0, 'payment_cod', 'payment_cod_status', '1', 0),
(3960, 0, 'payment_cod', 'payment_cod_sort_order', '', 0),
(3961, 0, 'total_coupon', 'total_coupon_status', '1', 0),
(3962, 0, 'total_coupon', 'total_coupon_sort_order', '4', 0),
(3963, 0, 'total_credit', 'total_credit_status', '1', 0),
(3964, 0, 'total_credit', 'total_credit_sort_order', '7', 0),
(3965, 0, 'total_sub_total', 'total_sub_total_status', '1', 0),
(94, 0, 'total_sub_total', 'total_sub_total_sort_order', '1', 0),
(3966, 0, 'total_total', 'total_total_status', '1', 0),
(3967, 0, 'total_total', 'total_total_sort_order', '9', 0),
(3968, 0, 'total_shipping', 'total_shipping_estimator', '1', 0),
(3969, 0, 'total_shipping', 'total_shipping_status', '1', 0),
(3970, 0, 'total_shipping', 'total_shipping_sort_order', '3', 0),
(3971, 0, 'total_tax', 'total_tax_status', '1', 0),
(3972, 0, 'total_tax', 'total_tax_sort_order', '5', 0),
(3973, 0, 'total_voucher', 'total_voucher_status', '1', 0),
(3974, 0, 'total_voucher', 'total_voucher_sort_order', '8', 0),
(3975, 0, 'total_reward', 'total_reward_status', '1', 0),
(3976, 0, 'total_reward', 'total_reward_sort_order', '2', 0),
(4739, 0, 'cms_blog', 'cms_blog_category_limit_leading_blog', '', 0),
(4738, 0, 'cms_blog', 'cms_blog_general_cheight', '', 0),
(4737, 0, 'cms_blog', 'cms_blog_general_cwidth', '', 0),
(4736, 0, 'cms_blog', 'cms_blog_children_columns', '', 0),
(4735, 0, 'cms_blog', 'cms_blog_items_per_page', '20', 0),
(4734, 0, 'cms_blog', 'cms_blog_small_image_height', '300', 0),
(4733, 0, 'cms_blog', 'cms_blog_small_image_width', '620', 0),
(4694, 0, 'captcha_basic', 'captcha_basic_status', '1', 0),
(4962, 0, 'config', 'config_review_guest', '1', 0),
(4307, 0, 'module_category', 'module_category_status', '1', 0),
(4729, 0, 'cms_blog', 'cms_blog_large_image_width', '845', 0),
(4730, 0, 'cms_blog', 'cms_blog_large_image_height', '300', 0),
(4731, 0, 'cms_blog', 'cms_blog_middle_image_width', '620', 0),
(4732, 0, 'cms_blog', 'cms_blog_middle_image_height', '300', 0),
(4358, 0, 'module_faq_category', 'module_faq_category_status', '1', 0),
(4360, 0, 'module_blog_search', 'module_blog_search_status', '1', 0),
(4361, 0, 'module_press_latest', 'module_press_latest_status', '1', 0),
(4728, 0, 'cms_blog', 'cms_blog_description', '{"2":{"title":"MyCnCart Blog","meta_title":"MyCnCart Blog","meta_description":"MyCnCart Blog","meta_keyword":"MyCnCart, Blog"},"1":{"title":"MyCnCart \\u535a\\u5ba2","meta_title":"MyCnCart \\u535a\\u5ba2","meta_description":"MyCnCart \\u535a\\u5ba2","meta_keyword":"MyCnCart, \\u535a\\u5ba2"},"3":{"title":"MyCnCart \\u535a\\u5ba2","meta_title":"MyCnCart \\u535a\\u5ba2","meta_description":"MyCnCart \\u535a\\u5ba2","meta_keyword":"MyCnCart, \\u535a\\u5ba2"}}', 1),
(4409, 0, 'module_qq_login', 'module_qq_login_appid', '101348698', 0),
(4410, 0, 'module_qq_login', 'module_qq_login_appkey', '1b711c4b7ece8135eba5288a6bbedfb5', 0),
(4411, 0, 'module_qq_login', 'module_qq_login_status', '1', 0),
(4961, 0, 'config', 'config_review_status', '1', 0),
(4960, 0, 'config', 'config_limit_admin', '20', 0),
(4959, 0, 'config', 'config_product_count', '1', 0),
(4958, 0, 'config', 'config_weight_class_id', '1', 0),
(4956, 0, 'config', 'config_currency_auto', '0', 0),
(4957, 0, 'config', 'config_length_class_id', '1', 0),
(4955, 0, 'config', 'config_currency', 'CNY', 0),
(4953, 0, 'config', 'config_language', 'zh-cn', 0),
(4954, 0, 'config', 'config_admin_language', 'zh-cn', 0),
(4952, 0, 'config', 'config_zone_id', '707', 0),
(4950, 0, 'config', 'config_comment', '', 0),
(4951, 0, 'config', 'config_country_id', '44', 0),
(4947, 0, 'config', 'config_fax', '', 0),
(4505, 0, 'module_weibo_login', 'module_weibo_login_appkey', '1726168132', 0),
(4506, 0, 'module_weibo_login', 'module_weibo_login_appsecret', '0b7ce985553131d49b5ee37db8df18da', 0),
(4507, 0, 'module_weibo_login', 'module_weibo_login_status', '1', 0),
(4948, 0, 'config', 'config_image', '', 0),
(4949, 0, 'config', 'config_open', '', 0),
(4946, 0, 'config', 'config_sms_telephone', '18561800618', 0),
(4692, 0, 'developer', 'developer_theme', '1', 0),
(4693, 0, 'developer', 'developer_sass', '1', 0),
(4695, 0, 'feed_google_sitemap', 'feed_google_sitemap_status', '1', 0),
(4696, 0, 'report_customer_activity', 'report_customer_activity_status', '1', 0),
(4697, 0, 'report_customer_activity', 'report_customer_activity_sort_order', '', 0),
(4698, 0, 'report_customer_order', 'report_customer_order_status', '1', 0),
(4699, 0, 'report_customer_order', 'report_customer_order_sort_order', '', 0),
(4700, 0, 'report_customer_reward', 'report_customer_reward_status', '1', 0),
(4701, 0, 'report_customer_reward', 'report_customer_reward_sort_order', '', 0),
(4702, 0, 'report_customer_search', 'report_customer_search_status', '1', 0),
(4703, 0, 'report_customer_search', 'report_customer_search_sort_order', '', 0),
(4704, 0, 'report_customer_transaction', 'report_customer_transaction_status', '1', 0),
(4705, 0, 'report_customer_transaction', 'report_customer_transaction_sort_order', '', 0),
(4706, 0, 'report_marketing', 'report_marketing_status', '1', 0),
(4707, 0, 'report_marketing', 'report_marketing_sort_order', '', 0),
(4708, 0, 'report_product_purchased', 'report_product_purchased_status', '1', 0),
(4709, 0, 'report_product_purchased', 'report_product_purchased_sort_order', '', 0),
(4710, 0, 'report_product_viewed', 'report_product_viewed_status', '1', 0),
(4711, 0, 'report_product_viewed', 'report_product_viewed_sort_order', '', 0),
(4712, 0, 'report_sale_coupon', 'report_sale_coupon_status', '1', 0),
(4713, 0, 'report_sale_coupon', 'report_sale_coupon_sort_order', '', 0),
(4714, 0, 'report_sale_order', 'report_sale_order_status', '1', 0),
(4715, 0, 'report_sale_order', 'report_sale_order_sort_order', '', 0),
(4716, 0, 'report_sale_return', 'report_sale_return_status', '1', 0),
(4717, 0, 'report_sale_return', 'report_sale_return_sort_order', '', 0),
(4718, 0, 'report_sale_shipping', 'report_sale_shipping_status', '1', 0),
(4719, 0, 'report_sale_shipping', 'report_sale_shipping_sort_order', '', 0),
(4720, 0, 'report_sale_tax', 'report_sale_tax_status', '1', 0),
(4721, 0, 'report_sale_tax', 'report_sale_tax_sort_order', '', 0),
(4763, 0, 'cms_blog', 'cms_blog_article_scroll_related', '0', 0),
(4764, 0, 'cms_blog', 'cms_blog_article_related_per_row', '6', 0),
(4765, 0, 'cms_blog', 'cms_blog_show_created_date', '1', 0),
(4766, 0, 'cms_blog', 'cms_blog_show_hits', '1', 0),
(4767, 0, 'cms_blog', 'cms_blog_show_comment_counter', '1', 0),
(4768, 0, 'cms_blog', 'cms_blog_show_comment_form', '1', 0),
(4769, 0, 'cms_blog', 'cms_blog_show_auto_publish_comment', '1', 0),
(4770, 0, 'cms_blog', 'cms_blog_comment_email', '1', 0),
(4771, 0, 'cms_blog', 'cms_blog_show_recaptcha', '1', 0),
(4772, 0, 'cms_blog', 'cms_blog_show_need_login_to_comment', '1', 0),
(4773, 0, 'cms_blog', 'cms_blog_brief_length', '200', 0),
(4774, 0, 'cms_blog', 'cms_blog_comment_length', '200', 0),
(4945, 0, 'config', 'config_telephone', '18561800618', 0),
(4943, 0, 'config', 'config_geocode', '120.191457,35.959145', 0),
(4944, 0, 'config', 'config_email', 'opencart@qq.com', 0),
(4935, 0, 'config', 'config_meta_keyword', 'MyCnCart, 我的B2C中国网店', 0),
(4936, 0, 'config', 'config_theme', 'default', 0),
(4937, 0, 'config', 'config_layout_id', '4', 0),
(4938, 0, 'config', 'config_name', '我的B2C中国网店', 0),
(4939, 0, 'config', 'config_owner', '青岛万物一体网络科技有限公司', 0),
(4940, 0, 'config', 'config_address', '中国山东省青岛市长江中路汇商国际大厦', 0),
(4941, 0, 'config', 'config_miit', '鲁ICP备16025901号', 0),
(4942, 0, 'config', 'config_map_select', 'baidu', 0),
(4934, 0, 'config', 'config_meta_description', 'MyCnCart - 我的B2C中国网店', 0),
(4933, 0, 'config', 'config_meta_title', 'MyCnCart - 我的B2C中国网店', 0),
(5022, 0, 'config', 'config_error_display', '1', 0),
(5023, 0, 'config', 'config_error_log', '1', 0),
(5024, 0, 'config', 'config_error_filename', 'error.log', 0),
(5025, 0, 'config', 'config_baidu_api', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_shipping_courier`
--

DROP TABLE IF EXISTS `mcc_shipping_courier`;
CREATE TABLE `mcc_shipping_courier` (
  `shipping_courier_id` int(11) NOT NULL,
  `shipping_courier_code` varchar(255) NOT NULL DEFAULT '',
  `shipping_courier_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`shipping_courier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_shipping_courier`
--

INSERT INTO `mcc_shipping_courier` (`shipping_courier_id`, `shipping_courier_code`, `shipping_courier_name`) VALUES
(1, 'dhl', 'DHL'),
(2, 'fedex', 'Fedex'),
(3, 'ups', 'UPS'),
(4, 'royal-mail', 'Royal Mail'),
(5, 'usps', 'United States Postal Service'),
(6, 'auspost', 'Australia Post'),
(7, 'citylink', 'Citylink');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_sms_mobile`
--

DROP TABLE IF EXISTS `mcc_sms_mobile`;
CREATE TABLE `mcc_sms_mobile` (
  `sms_mobile_id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_mobile` varchar(15) CHARACTER SET utf8 NOT NULL,
  `verify_code` varchar(6) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`sms_mobile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_statistics`
--

DROP TABLE IF EXISTS `mcc_statistics`;
CREATE TABLE `mcc_statistics` (
  `statistics_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `value` decimal(15,4) NOT NULL,
  PRIMARY KEY (`statistics_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_statistics`
--

INSERT INTO `mcc_statistics` (`statistics_id`, `code`, `value`) VALUES
(1, 'order_sale', '345.3000'),
(2, 'order_processing', '0.0000'),
(3, 'order_complete', '0.0000'),
(4, 'order_other', '0.0000'),
(5, 'returns', '0.0000'),
(6, 'product', '0.0000'),
(7, 'review', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_stock_status`
--

DROP TABLE IF EXISTS `mcc_stock_status`;
CREATE TABLE `mcc_stock_status` (
  `stock_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`stock_status_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_stock_status`
--

INSERT INTO `mcc_stock_status` (`stock_status_id`, `language_id`, `name`) VALUES
(7, 3, '有库存'),
(5, 3, '库存不足'),
(6, 3, '等待 2 -3 天'),
(8, 3, '需要预订'),
(7, 2, 'In Stock'),
(8, 2, 'Pre-Order'),
(5, 2, 'Out Of Stock'),
(6, 2, '2-3 Days'),
(7, 1, '有库存'),
(8, 1, '需要预订'),
(5, 1, '库存不足'),
(6, 1, '等待 2 -3 天');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_store`
--

DROP TABLE IF EXISTS `mcc_store`;
CREATE TABLE `mcc_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ssl` varchar(255) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_tax_class`
--

DROP TABLE IF EXISTS `mcc_tax_class`;
CREATE TABLE `mcc_tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_tax_class`
--

INSERT INTO `mcc_tax_class` (`tax_class_id`, `title`, `description`, `date_added`, `date_modified`) VALUES
(9, '应税商品', '应税商品', '2009-01-06 23:21:53', '2015-04-01 22:30:09'),
(10, '下载类商品', '下载类', '2011-09-21 22:19:39', '2015-04-01 22:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_tax_rate`
--

DROP TABLE IF EXISTS `mcc_tax_rate`;
CREATE TABLE `mcc_tax_rate` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` char(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_tax_rate`
--

INSERT INTO `mcc_tax_rate` (`tax_rate_id`, `geo_zone_id`, `name`, `rate`, `type`, `date_added`, `date_modified`) VALUES
(86, 3, '增值税 (20%)', '20.0000', 'P', '2011-03-09 21:17:10', '2015-04-01 22:33:10'),
(87, 3, '生态税(-2.00)', '2.0000', 'F', '2011-09-21 21:49:23', '2015-04-01 22:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_tax_rate_to_customer_group`
--

DROP TABLE IF EXISTS `mcc_tax_rate_to_customer_group`;
CREATE TABLE `mcc_tax_rate_to_customer_group` (
  `tax_rate_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  PRIMARY KEY (`tax_rate_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_tax_rate_to_customer_group`
--

INSERT INTO `mcc_tax_rate_to_customer_group` (`tax_rate_id`, `customer_group_id`) VALUES
(86, 1),
(87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_tax_rule`
--

DROP TABLE IF EXISTS `mcc_tax_rule`;
CREATE TABLE `mcc_tax_rule` (
  `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tax_rule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_tax_rule`
--

INSERT INTO `mcc_tax_rule` (`tax_rule_id`, `tax_class_id`, `tax_rate_id`, `based`, `priority`) VALUES
(121, 10, 86, 'payment', 1),
(120, 10, 87, 'store', 0),
(128, 9, 86, 'shipping', 1),
(127, 9, 87, 'shipping', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_theme`
--

DROP TABLE IF EXISTS `mcc_theme`;
CREATE TABLE `mcc_theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `theme` varchar(64) NOT NULL,
  `route` varchar(64) NOT NULL,
  `code` mediumtext NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_translation`
--

DROP TABLE IF EXISTS `mcc_translation`;
CREATE TABLE `mcc_translation` (
  `translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `route` varchar(64) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`translation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_upload`
--

DROP TABLE IF EXISTS `mcc_upload`;
CREATE TABLE `mcc_upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_user`
--

DROP TABLE IF EXISTS `mcc_user`;
CREATE TABLE `mcc_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_user_group`
--

DROP TABLE IF EXISTS `mcc_user_group`;
CREATE TABLE `mcc_user_group` (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_user_group`
--

INSERT INTO `mcc_user_group` (`user_group_id`, `name`, `permission`) VALUES
(1, 'Administrator', '{"access":["catalog\\/attribute","catalog\\/attribute_group","catalog\\/category","catalog\\/download","catalog\\/filter","catalog\\/information","catalog\\/manufacturer","catalog\\/option","catalog\\/product","catalog\\/recurring","catalog\\/review","cms\\/blog","cms\\/blog_category","cms\\/blog_comment","cms\\/blog_config","cms\\/faq","cms\\/faq_category","cms\\/faq_config","cms\\/press","cms\\/press_category","cms\\/press_config","common\\/column_left","common\\/developer","common\\/filemanager","common\\/profile","common\\/security","customer\\/custom_field","customer\\/customer","customer\\/customer_approval","customer\\/customer_group","design\\/banner","design\\/layout","design\\/seo_url","design\\/theme","design\\/translation","event\\/language","event\\/statistics","event\\/theme","extension\\/analytics\\/google","extension\\/captcha\\/basic","extension\\/captcha\\/google","extension\\/dashboard\\/activity","extension\\/dashboard\\/chart","extension\\/dashboard\\/customer","extension\\/dashboard\\/map","extension\\/dashboard\\/online","extension\\/dashboard\\/order","extension\\/dashboard\\/recent","extension\\/dashboard\\/sale","extension\\/extension\\/analytics","extension\\/extension\\/captcha","extension\\/extension\\/dashboard","extension\\/extension\\/feed","extension\\/extension\\/fraud","extension\\/extension\\/menu","extension\\/extension\\/module","extension\\/extension\\/payment","extension\\/extension\\/report","extension\\/extension\\/shipping","extension\\/extension\\/sms","extension\\/extension\\/theme","extension\\/extension\\/total","extension\\/feed\\/google_base","extension\\/feed\\/google_sitemap","extension\\/feed\\/openbaypro","extension\\/fraud\\/fraudlabspro","extension\\/fraud\\/ip","extension\\/fraud\\/maxmind","extension\\/module\\/account","extension\\/module\\/amazon_login","extension\\/module\\/amazon_pay","extension\\/module\\/banner","extension\\/module\\/bestseller","extension\\/module\\/blog_category","extension\\/module\\/blog_comment","extension\\/module\\/blog_latest","extension\\/module\\/blog_popular","extension\\/module\\/blog_search","extension\\/module\\/carousel","extension\\/module\\/category","extension\\/module\\/divido_calculator","extension\\/module\\/ebay_listing","extension\\/module\\/faq_category","extension\\/module\\/featured","extension\\/module\\/filter","extension\\/module\\/google_hangouts","extension\\/module\\/html","extension\\/module\\/information","extension\\/module\\/kefu","extension\\/module\\/klarna_checkout_module","extension\\/module\\/latest","extension\\/module\\/laybuy_layout","extension\\/module\\/pilibaba_button","extension\\/module\\/pp_braintree_button","extension\\/module\\/pp_button","extension\\/module\\/pp_login","extension\\/module\\/press_category","extension\\/module\\/press_latest","extension\\/module\\/qq_login","extension\\/module\\/sagepay_direct_cards","extension\\/module\\/sagepay_server_cards","extension\\/module\\/slideshow","extension\\/module\\/special","extension\\/module\\/store","extension\\/module\\/weibo_login","extension\\/module\\/weixin_login","extension\\/openbay\\/amazon","extension\\/openbay\\/amazon_listing","extension\\/openbay\\/amazon_product","extension\\/openbay\\/amazonus","extension\\/openbay\\/amazonus_listing","extension\\/openbay\\/amazonus_product","extension\\/openbay\\/ebay","extension\\/openbay\\/ebay_profile","extension\\/openbay\\/ebay_template","extension\\/openbay\\/etsy","extension\\/openbay\\/etsy_product","extension\\/openbay\\/etsy_shipping","extension\\/openbay\\/etsy_shop","extension\\/openbay\\/fba","extension\\/payment\\/alipay_cross","extension\\/payment\\/alipay_direct","extension\\/payment\\/alipay_wap","extension\\/payment\\/amazon_login_pay","extension\\/payment\\/authorizenet_aim","extension\\/payment\\/authorizenet_sim","extension\\/payment\\/bank_transfer","extension\\/payment\\/bluepay_hosted","extension\\/payment\\/bluepay_redirect","extension\\/payment\\/cardconnect","extension\\/payment\\/cardinity","extension\\/payment\\/cheque","extension\\/payment\\/cod","extension\\/payment\\/divido","extension\\/payment\\/eway","extension\\/payment\\/firstdata","extension\\/payment\\/firstdata_remote","extension\\/payment\\/free_checkout","extension\\/payment\\/g2apay","extension\\/payment\\/globalpay","extension\\/payment\\/globalpay_remote","extension\\/payment\\/klarna_account","extension\\/payment\\/klarna_checkout","extension\\/payment\\/klarna_invoice","extension\\/payment\\/laybuy","extension\\/payment\\/liqpay","extension\\/payment\\/nochex","extension\\/payment\\/paymate","extension\\/payment\\/paypoint","extension\\/payment\\/payza","extension\\/payment\\/perpetual_payments","extension\\/payment\\/pilibaba","extension\\/payment\\/pp_braintree","extension\\/payment\\/pp_express","extension\\/payment\\/pp_payflow","extension\\/payment\\/pp_payflow_iframe","extension\\/payment\\/pp_pro","extension\\/payment\\/pp_pro_iframe","extension\\/payment\\/pp_standard","extension\\/payment\\/qrcode_wxpay","extension\\/payment\\/realex","extension\\/payment\\/realex_remote","extension\\/payment\\/sagepay_direct","extension\\/payment\\/sagepay_server","extension\\/payment\\/sagepay_us","extension\\/payment\\/securetrading_pp","extension\\/payment\\/securetrading_ws","extension\\/payment\\/skrill","extension\\/payment\\/squareup","extension\\/payment\\/twocheckout","extension\\/payment\\/web_payment_software","extension\\/payment\\/wechat_pay","extension\\/payment\\/worldpay","extension\\/payment\\/wxpay","extension\\/payment\\/wxpay_web","extension\\/report\\/customer_activity","extension\\/report\\/customer_order","extension\\/report\\/customer_reward","extension\\/report\\/customer_search","extension\\/report\\/customer_transaction","extension\\/report\\/marketing","extension\\/report\\/product_purchased","extension\\/report\\/product_viewed","extension\\/report\\/sale_coupon","extension\\/report\\/sale_order","extension\\/report\\/sale_return","extension\\/report\\/sale_shipping","extension\\/report\\/sale_tax","extension\\/shipping\\/auspost","extension\\/shipping\\/citylink","extension\\/shipping\\/ec_ship","extension\\/shipping\\/fedex","extension\\/shipping\\/flat","extension\\/shipping\\/free","extension\\/shipping\\/item","extension\\/shipping\\/parcelforce_48","extension\\/shipping\\/pickup","extension\\/shipping\\/royal_mail","extension\\/shipping\\/ups","extension\\/shipping\\/usps","extension\\/shipping\\/weight","extension\\/sms\\/chuanglan","extension\\/theme\\/default","extension\\/total\\/coupon","extension\\/total\\/credit","extension\\/total\\/handling","extension\\/total\\/klarna_fee","extension\\/total\\/low_order_fee","extension\\/total\\/reward","extension\\/total\\/shipping","extension\\/total\\/sub_total","extension\\/total\\/tax","extension\\/total\\/total","extension\\/total\\/voucher","localisation\\/city","localisation\\/country","localisation\\/currency","localisation\\/district","localisation\\/geo_zone","localisation\\/language","localisation\\/length_class","localisation\\/location","localisation\\/order_status","localisation\\/return_action","localisation\\/return_reason","localisation\\/return_status","localisation\\/stock_status","localisation\\/tax_class","localisation\\/tax_rate","localisation\\/weight_class","localisation\\/zone","mail\\/affiliate","mail\\/customer","mail\\/forgotten","mail\\/return","mail\\/reward","mail\\/transaction","marketing\\/contact","marketing\\/coupon","marketing\\/marketing","marketplace\\/api","marketplace\\/event","marketplace\\/extension","marketplace\\/install","marketplace\\/installer","marketplace\\/marketplace","marketplace\\/modification","marketplace\\/openbay","report\\/online","report\\/report","report\\/statistics","sale\\/order","sale\\/recurring","sale\\/return","sale\\/voucher","sale\\/voucher_theme","setting\\/setting","setting\\/store","startup\\/error","startup\\/event","startup\\/login","startup\\/permission","startup\\/router","startup\\/sass","startup\\/startup","tool\\/backup","tool\\/excelexportimport","tool\\/log","tool\\/upload","user\\/api","user\\/user","user\\/user_permission","extension\\/feed\\/google_base"],"modify":["catalog\\/attribute","catalog\\/attribute_group","catalog\\/category","catalog\\/download","catalog\\/filter","catalog\\/information","catalog\\/manufacturer","catalog\\/option","catalog\\/product","catalog\\/recurring","catalog\\/review","cms\\/blog","cms\\/blog_category","cms\\/blog_comment","cms\\/blog_config","cms\\/faq","cms\\/faq_category","cms\\/faq_config","cms\\/press","cms\\/press_category","cms\\/press_config","common\\/column_left","common\\/developer","common\\/filemanager","common\\/profile","common\\/security","customer\\/custom_field","customer\\/customer","customer\\/customer_approval","customer\\/customer_group","design\\/banner","design\\/layout","design\\/seo_url","design\\/theme","design\\/translation","event\\/language","event\\/statistics","event\\/theme","extension\\/analytics\\/google","extension\\/captcha\\/basic","extension\\/captcha\\/google","extension\\/dashboard\\/activity","extension\\/dashboard\\/chart","extension\\/dashboard\\/customer","extension\\/dashboard\\/map","extension\\/dashboard\\/online","extension\\/dashboard\\/order","extension\\/dashboard\\/recent","extension\\/dashboard\\/sale","extension\\/extension\\/analytics","extension\\/extension\\/captcha","extension\\/extension\\/dashboard","extension\\/extension\\/feed","extension\\/extension\\/fraud","extension\\/extension\\/menu","extension\\/extension\\/module","extension\\/extension\\/payment","extension\\/extension\\/report","extension\\/extension\\/shipping","extension\\/extension\\/sms","extension\\/extension\\/theme","extension\\/extension\\/total","extension\\/feed\\/google_base","extension\\/feed\\/google_sitemap","extension\\/feed\\/openbaypro","extension\\/fraud\\/fraudlabspro","extension\\/fraud\\/ip","extension\\/fraud\\/maxmind","extension\\/module\\/account","extension\\/module\\/amazon_login","extension\\/module\\/amazon_pay","extension\\/module\\/banner","extension\\/module\\/bestseller","extension\\/module\\/blog_category","extension\\/module\\/blog_comment","extension\\/module\\/blog_latest","extension\\/module\\/blog_popular","extension\\/module\\/blog_search","extension\\/module\\/carousel","extension\\/module\\/category","extension\\/module\\/divido_calculator","extension\\/module\\/ebay_listing","extension\\/module\\/faq_category","extension\\/module\\/featured","extension\\/module\\/filter","extension\\/module\\/google_hangouts","extension\\/module\\/html","extension\\/module\\/information","extension\\/module\\/kefu","extension\\/module\\/klarna_checkout_module","extension\\/module\\/latest","extension\\/module\\/laybuy_layout","extension\\/module\\/pilibaba_button","extension\\/module\\/pp_braintree_button","extension\\/module\\/pp_button","extension\\/module\\/pp_login","extension\\/module\\/press_category","extension\\/module\\/press_latest","extension\\/module\\/qq_login","extension\\/module\\/sagepay_direct_cards","extension\\/module\\/sagepay_server_cards","extension\\/module\\/slideshow","extension\\/module\\/special","extension\\/module\\/store","extension\\/module\\/weibo_login","extension\\/module\\/weixin_login","extension\\/openbay\\/amazon","extension\\/openbay\\/amazon_listing","extension\\/openbay\\/amazon_product","extension\\/openbay\\/amazonus","extension\\/openbay\\/amazonus_listing","extension\\/openbay\\/amazonus_product","extension\\/openbay\\/ebay","extension\\/openbay\\/ebay_profile","extension\\/openbay\\/ebay_template","extension\\/openbay\\/etsy","extension\\/openbay\\/etsy_product","extension\\/openbay\\/etsy_shipping","extension\\/openbay\\/etsy_shop","extension\\/openbay\\/fba","extension\\/payment\\/alipay_cross","extension\\/payment\\/alipay_direct","extension\\/payment\\/alipay_wap","extension\\/payment\\/amazon_login_pay","extension\\/payment\\/authorizenet_aim","extension\\/payment\\/authorizenet_sim","extension\\/payment\\/bank_transfer","extension\\/payment\\/bluepay_hosted","extension\\/payment\\/bluepay_redirect","extension\\/payment\\/cardconnect","extension\\/payment\\/cardinity","extension\\/payment\\/cheque","extension\\/payment\\/cod","extension\\/payment\\/divido","extension\\/payment\\/eway","extension\\/payment\\/firstdata","extension\\/payment\\/firstdata_remote","extension\\/payment\\/free_checkout","extension\\/payment\\/g2apay","extension\\/payment\\/globalpay","extension\\/payment\\/globalpay_remote","extension\\/payment\\/klarna_account","extension\\/payment\\/klarna_checkout","extension\\/payment\\/klarna_invoice","extension\\/payment\\/laybuy","extension\\/payment\\/liqpay","extension\\/payment\\/nochex","extension\\/payment\\/paymate","extension\\/payment\\/paypoint","extension\\/payment\\/payza","extension\\/payment\\/perpetual_payments","extension\\/payment\\/pilibaba","extension\\/payment\\/pp_braintree","extension\\/payment\\/pp_express","extension\\/payment\\/pp_payflow","extension\\/payment\\/pp_payflow_iframe","extension\\/payment\\/pp_pro","extension\\/payment\\/pp_pro_iframe","extension\\/payment\\/pp_standard","extension\\/payment\\/qrcode_wxpay","extension\\/payment\\/realex","extension\\/payment\\/realex_remote","extension\\/payment\\/sagepay_direct","extension\\/payment\\/sagepay_server","extension\\/payment\\/sagepay_us","extension\\/payment\\/securetrading_pp","extension\\/payment\\/securetrading_ws","extension\\/payment\\/skrill","extension\\/payment\\/squareup","extension\\/payment\\/twocheckout","extension\\/payment\\/web_payment_software","extension\\/payment\\/wechat_pay","extension\\/payment\\/worldpay","extension\\/payment\\/wxpay","extension\\/payment\\/wxpay_web","extension\\/report\\/customer_activity","extension\\/report\\/customer_order","extension\\/report\\/customer_reward","extension\\/report\\/customer_search","extension\\/report\\/customer_transaction","extension\\/report\\/marketing","extension\\/report\\/product_purchased","extension\\/report\\/product_viewed","extension\\/report\\/sale_coupon","extension\\/report\\/sale_order","extension\\/report\\/sale_return","extension\\/report\\/sale_shipping","extension\\/report\\/sale_tax","extension\\/shipping\\/auspost","extension\\/shipping\\/citylink","extension\\/shipping\\/ec_ship","extension\\/shipping\\/fedex","extension\\/shipping\\/flat","extension\\/shipping\\/free","extension\\/shipping\\/item","extension\\/shipping\\/parcelforce_48","extension\\/shipping\\/pickup","extension\\/shipping\\/royal_mail","extension\\/shipping\\/ups","extension\\/shipping\\/usps","extension\\/shipping\\/weight","extension\\/sms\\/chuanglan","extension\\/theme\\/default","extension\\/total\\/coupon","extension\\/total\\/credit","extension\\/total\\/handling","extension\\/total\\/klarna_fee","extension\\/total\\/low_order_fee","extension\\/total\\/reward","extension\\/total\\/shipping","extension\\/total\\/sub_total","extension\\/total\\/tax","extension\\/total\\/total","extension\\/total\\/voucher","localisation\\/city","localisation\\/country","localisation\\/currency","localisation\\/district","localisation\\/geo_zone","localisation\\/language","localisation\\/length_class","localisation\\/location","localisation\\/order_status","localisation\\/return_action","localisation\\/return_reason","localisation\\/return_status","localisation\\/stock_status","localisation\\/tax_class","localisation\\/tax_rate","localisation\\/weight_class","localisation\\/zone","mail\\/affiliate","mail\\/customer","mail\\/forgotten","mail\\/return","mail\\/reward","mail\\/transaction","marketing\\/contact","marketing\\/coupon","marketing\\/marketing","marketplace\\/api","marketplace\\/event","marketplace\\/extension","marketplace\\/install","marketplace\\/installer","marketplace\\/marketplace","marketplace\\/modification","marketplace\\/openbay","report\\/online","report\\/report","report\\/statistics","sale\\/order","sale\\/recurring","sale\\/return","sale\\/voucher","sale\\/voucher_theme","setting\\/setting","setting\\/store","startup\\/error","startup\\/event","startup\\/login","startup\\/permission","startup\\/router","startup\\/sass","startup\\/startup","tool\\/backup","tool\\/excelexportimport","tool\\/log","tool\\/upload","user\\/api","user\\/user","user\\/user_permission","extension\\/feed\\/google_base"]}'),
(10, 'Demonstration', '');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_voucher`
--

DROP TABLE IF EXISTS `mcc_voucher`;
CREATE TABLE `mcc_voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `from_name` varchar(64) NOT NULL,
  `from_email` varchar(96) NOT NULL,
  `to_name` varchar(64) NOT NULL,
  `to_email` varchar(96) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_voucher_history`
--

DROP TABLE IF EXISTS `mcc_voucher_history`;
CREATE TABLE `mcc_voucher_history` (
  `voucher_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`voucher_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mcc_voucher_theme`
--

DROP TABLE IF EXISTS `mcc_voucher_theme`;
CREATE TABLE `mcc_voucher_theme` (
  `voucher_theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`voucher_theme_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_voucher_theme`
--

INSERT INTO `mcc_voucher_theme` (`voucher_theme_id`, `image`) VALUES
(8, 'catalog/demo/canon_eos_5d_2.jpg'),
(7, 'catalog/demo/gift-voucher-birthday.jpg'),
(6, 'catalog/demo/apple_logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_voucher_theme_description`
--

DROP TABLE IF EXISTS `mcc_voucher_theme_description`;
CREATE TABLE `mcc_voucher_theme_description` (
  `voucher_theme_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`voucher_theme_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_voucher_theme_description`
--

INSERT INTO `mcc_voucher_theme_description` (`voucher_theme_id`, `language_id`, `name`) VALUES
(6, 2, 'Spring Festival'),
(8, 3, '通用'),
(7, 2, 'Birthday'),
(8, 2, 'General'),
(6, 3, '春节'),
(7, 1, '生日'),
(8, 1, '通用'),
(6, 1, '春节'),
(7, 3, '生日');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_weight_class`
--

DROP TABLE IF EXISTS `mcc_weight_class`;
CREATE TABLE `mcc_weight_class` (
  `weight_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  PRIMARY KEY (`weight_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_weight_class`
--

INSERT INTO `mcc_weight_class` (`weight_class_id`, `value`) VALUES
(1, '1.00000000'),
(2, '1000.00000000'),
(5, '2.20460000'),
(6, '35.27400000');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_weight_class_description`
--

DROP TABLE IF EXISTS `mcc_weight_class_description`;
CREATE TABLE `mcc_weight_class_description` (
  `weight_class_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL,
  PRIMARY KEY (`weight_class_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_weight_class_description`
--

INSERT INTO `mcc_weight_class_description` (`weight_class_id`, `language_id`, `title`, `unit`) VALUES
(1, 3, '公斤', 'kg'),
(2, 3, '克', 'g'),
(6, 3, '盎司', 'oz'),
(1, 2, 'Kilogram', 'kg'),
(2, 2, 'Gram', 'g'),
(5, 2, 'Pound', 'lb'),
(6, 2, 'Ounce', 'oz'),
(1, 1, '公斤', 'kg'),
(2, 1, '克', 'g'),
(5, 1, '磅', 'lb'),
(6, 1, '盎司', 'oz'),
(5, 3, '磅', 'lb');

-- --------------------------------------------------------

--
-- Table structure for table `mcc_zone`
--

DROP TABLE IF EXISTS `mcc_zone`;
CREATE TABLE `mcc_zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4228 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_zone`
--

INSERT INTO `mcc_zone` (`zone_id`, `country_id`, `name`, `code`, `status`) VALUES
(1, 1, 'Badakhshan', 'BDS', 1),
(2, 1, 'Badghis', 'BDG', 1),
(3, 1, 'Baghlan', 'BGL', 1),
(4, 1, 'Balkh', 'BAL', 1),
(5, 1, 'Bamian', 'BAM', 1),
(6, 1, 'Farah', 'FRA', 1),
(7, 1, 'Faryab', 'FYB', 1),
(8, 1, 'Ghazni', 'GHA', 1),
(9, 1, 'Ghowr', 'GHO', 1),
(10, 1, 'Helmand', 'HEL', 1),
(11, 1, 'Herat', 'HER', 1),
(12, 1, 'Jowzjan', 'JOW', 1),
(13, 1, 'Kabul', 'KAB', 1),
(14, 1, 'Kandahar', 'KAN', 1),
(15, 1, 'Kapisa', 'KAP', 1),
(16, 1, 'Khost', 'KHO', 1),
(17, 1, 'Konar', 'KNR', 1),
(18, 1, 'Kondoz', 'KDZ', 1),
(19, 1, 'Laghman', 'LAG', 1),
(20, 1, 'Lowgar', 'LOW', 1),
(21, 1, 'Nangrahar', 'NAN', 1),
(22, 1, 'Nimruz', 'NIM', 1),
(23, 1, 'Nurestan', 'NUR', 1),
(24, 1, 'Oruzgan', 'ORU', 1),
(25, 1, 'Paktia', 'PIA', 1),
(26, 1, 'Paktika', 'PKA', 1),
(27, 1, 'Parwan', 'PAR', 1),
(28, 1, 'Samangan', 'SAM', 1),
(29, 1, 'Sar-e Pol', 'SAR', 1),
(30, 1, 'Takhar', 'TAK', 1),
(31, 1, 'Wardak', 'WAR', 1),
(32, 1, 'Zabol', 'ZAB', 1),
(33, 2, 'Berat', 'BR', 1),
(34, 2, 'Bulqize', 'BU', 1),
(35, 2, 'Delvine', 'DL', 1),
(36, 2, 'Devoll', 'DV', 1),
(37, 2, 'Diber', 'DI', 1),
(38, 2, 'Durres', 'DR', 1),
(39, 2, 'Elbasan', 'EL', 1),
(40, 2, 'Kolonje', 'ER', 1),
(41, 2, 'Fier', 'FR', 1),
(42, 2, 'Gjirokaster', 'GJ', 1),
(43, 2, 'Gramsh', 'GR', 1),
(44, 2, 'Has', 'HA', 1),
(45, 2, 'Kavaje', 'KA', 1),
(46, 2, 'Kurbin', 'KB', 1),
(47, 2, 'Kucove', 'KC', 1),
(48, 2, 'Korce', 'KO', 1),
(49, 2, 'Kruje', 'KR', 1),
(50, 2, 'Kukes', 'KU', 1),
(51, 2, 'Librazhd', 'LB', 1),
(52, 2, 'Lezhe', 'LE', 1),
(53, 2, 'Lushnje', 'LU', 1),
(54, 2, 'Malesi e Madhe', 'MM', 1),
(55, 2, 'Mallakaster', 'MK', 1),
(56, 2, 'Mat', 'MT', 1),
(57, 2, 'Mirdite', 'MR', 1),
(58, 2, 'Peqin', 'PQ', 1),
(59, 2, 'Permet', 'PR', 1),
(60, 2, 'Pogradec', 'PG', 1),
(61, 2, 'Puke', 'PU', 1),
(62, 2, 'Shkoder', 'SH', 1),
(63, 2, 'Skrapar', 'SK', 1),
(64, 2, 'Sarande', 'SR', 1),
(65, 2, 'Tepelene', 'TE', 1),
(66, 2, 'Tropoje', 'TP', 1),
(67, 2, 'Tirane', 'TR', 1),
(68, 2, 'Vlore', 'VL', 1),
(69, 3, 'Adrar', 'ADR', 1),
(70, 3, 'Ain Defla', 'ADE', 1),
(71, 3, 'Ain Temouchent', 'ATE', 1),
(72, 3, 'Alger', 'ALG', 1),
(73, 3, 'Annaba', 'ANN', 1),
(74, 3, 'Batna', 'BAT', 1),
(75, 3, 'Bechar', 'BEC', 1),
(76, 3, 'Bejaia', 'BEJ', 1),
(77, 3, 'Biskra', 'BIS', 1),
(78, 3, 'Blida', 'BLI', 1),
(79, 3, 'Bordj Bou Arreridj', 'BBA', 1),
(80, 3, 'Bouira', 'BOA', 1),
(81, 3, 'Boumerdes', 'BMD', 1),
(82, 3, 'Chlef', 'CHL', 1),
(83, 3, 'Constantine', 'CON', 1),
(84, 3, 'Djelfa', 'DJE', 1),
(85, 3, 'El Bayadh', 'EBA', 1),
(86, 3, 'El Oued', 'EOU', 1),
(87, 3, 'El Tarf', 'ETA', 1),
(88, 3, 'Ghardaia', 'GHA', 1),
(89, 3, 'Guelma', 'GUE', 1),
(90, 3, 'Illizi', 'ILL', 1),
(91, 3, 'Jijel', 'JIJ', 1),
(92, 3, 'Khenchela', 'KHE', 1),
(93, 3, 'Laghouat', 'LAG', 1),
(94, 3, 'Muaskar', 'MUA', 1),
(95, 3, 'Medea', 'MED', 1),
(96, 3, 'Mila', 'MIL', 1),
(97, 3, 'Mostaganem', 'MOS', 1),
(98, 3, 'M\'Sila', 'MSI', 1),
(99, 3, 'Naama', 'NAA', 1),
(100, 3, 'Oran', 'ORA', 1),
(101, 3, 'Ouargla', 'OUA', 1),
(102, 3, 'Oum el-Bouaghi', 'OEB', 1),
(103, 3, 'Relizane', 'REL', 1),
(104, 3, 'Saida', 'SAI', 1),
(105, 3, 'Setif', 'SET', 1),
(106, 3, 'Sidi Bel Abbes', 'SBA', 1),
(107, 3, 'Skikda', 'SKI', 1),
(108, 3, 'Souk Ahras', 'SAH', 1),
(109, 3, 'Tamanghasset', 'TAM', 1),
(110, 3, 'Tebessa', 'TEB', 1),
(111, 3, 'Tiaret', 'TIA', 1),
(112, 3, 'Tindouf', 'TIN', 1),
(113, 3, 'Tipaza', 'TIP', 1),
(114, 3, 'Tissemsilt', 'TIS', 1),
(115, 3, 'Tizi Ouzou', 'TOU', 1),
(116, 3, 'Tlemcen', 'TLE', 1),
(117, 4, 'Eastern', 'E', 1),
(118, 4, 'Manu\'a', 'M', 1),
(119, 4, 'Rose Island', 'R', 1),
(120, 4, 'Swains Island', 'S', 1),
(121, 4, 'Western', 'W', 1),
(122, 5, 'Andorra la Vella', 'ALV', 1),
(123, 5, 'Canillo', 'CAN', 1),
(124, 5, 'Encamp', 'ENC', 1),
(125, 5, 'Escaldes-Engordany', 'ESE', 1),
(126, 5, 'La Massana', 'LMA', 1),
(127, 5, 'Ordino', 'ORD', 1),
(128, 5, 'Sant Julia de Loria', 'SJL', 1),
(129, 6, 'Bengo', 'BGO', 1),
(130, 6, 'Benguela', 'BGU', 1),
(131, 6, 'Bie', 'BIE', 1),
(132, 6, 'Cabinda', 'CAB', 1),
(133, 6, 'Cuando-Cubango', 'CCU', 1),
(134, 6, 'Cuanza Norte', 'CNO', 1),
(135, 6, 'Cuanza Sul', 'CUS', 1),
(136, 6, 'Cunene', 'CNN', 1),
(137, 6, 'Huambo', 'HUA', 1),
(138, 6, 'Huila', 'HUI', 1),
(139, 6, 'Luanda', 'LUA', 1),
(140, 6, 'Lunda Norte', 'LNO', 1),
(141, 6, 'Lunda Sul', 'LSU', 1),
(142, 6, 'Malange', 'MAL', 1),
(143, 6, 'Moxico', 'MOX', 1),
(144, 6, 'Namibe', 'NAM', 1),
(145, 6, 'Uige', 'UIG', 1),
(146, 6, 'Zaire', 'ZAI', 1),
(147, 9, 'Saint George', 'ASG', 1),
(148, 9, 'Saint John', 'ASJ', 1),
(149, 9, 'Saint Mary', 'ASM', 1),
(150, 9, 'Saint Paul', 'ASL', 1),
(151, 9, 'Saint Peter', 'ASR', 1),
(152, 9, 'Saint Philip', 'ASH', 1),
(153, 9, 'Barbuda', 'BAR', 1),
(154, 9, 'Redonda', 'RED', 1),
(155, 10, 'Antartida e Islas del Atlantico', 'AN', 1),
(156, 10, 'Buenos Aires', 'BA', 1),
(157, 10, 'Catamarca', 'CA', 1),
(158, 10, 'Chaco', 'CH', 1),
(159, 10, 'Chubut', 'CU', 1),
(160, 10, 'Cordoba', 'CO', 1),
(161, 10, 'Corrientes', 'CR', 1),
(162, 10, 'Distrito Federal', 'DF', 1),
(163, 10, 'Entre Rios', 'ER', 1),
(164, 10, 'Formosa', 'FO', 1),
(165, 10, 'Jujuy', 'JU', 1),
(166, 10, 'La Pampa', 'LP', 1),
(167, 10, 'La Rioja', 'LR', 1),

(168, 10, 'Mendoza', 'ME', 1),
(169, 10, 'Misiones', 'MI', 1),
(170, 10, 'Neuquen', 'NE', 1),
(171, 10, 'Rio Negro', 'RN', 1),
(172, 10, 'Salta', 'SA', 1),
(173, 10, 'San Juan', 'SJ', 1),
(174, 10, 'San Luis', 'SL', 1),
(175, 10, 'Santa Cruz', 'SC', 1),
(176, 10, 'Santa Fe', 'SF', 1),
(177, 10, 'Santiago del Estero', 'SD', 1),
(178, 10, 'Tierra del Fuego', 'TF', 1),
(179, 10, 'Tucuman', 'TU', 1),
(180, 11, 'Aragatsotn', 'AGT', 1),
(181, 11, 'Ararat', 'ARR', 1),
(182, 11, 'Armavir', 'ARM', 1),
(183, 11, 'Geghark\'unik\'', 'GEG', 1),
(184, 11, 'Kotayk\'', 'KOT', 1),
(185, 11, 'Lorri', 'LOR', 1),
(186, 11, 'Shirak', 'SHI', 1),
(187, 11, 'Syunik\'', 'SYU', 1),
(188, 11, 'Tavush', 'TAV', 1),
(189, 11, 'Vayots\' Dzor', 'VAY', 1),
(190, 11, 'Yerevan', 'YER', 1),
(191, 13, 'Australian Capital Territory', 'ACT', 1),
(192, 13, 'New South Wales', 'NSW', 1),
(193, 13, 'Northern Territory', 'NT', 1),
(194, 13, 'Queensland', 'QLD', 1),
(195, 13, 'South Australia', 'SA', 1),
(196, 13, 'Tasmania', 'TAS', 1),
(197, 13, 'Victoria', 'VIC', 1),
(198, 13, 'Western Australia', 'WA', 1),
(199, 14, 'Burgenland', 'BUR', 1),
(200, 14, 'Kärnten', 'KAR', 1),
(201, 14, 'Nieder&ouml;sterreich', 'NOS', 1),
(202, 14, 'Ober&ouml;sterreich', 'OOS', 1),
(203, 14, 'Salzburg', 'SAL', 1),
(204, 14, 'Steiermark', 'STE', 1),
(205, 14, 'Tirol', 'TIR', 1),
(206, 14, 'Vorarlberg', 'VOR', 1),
(207, 14, 'Wien', 'WIE', 1),
(208, 15, 'Ali Bayramli', 'AB', 1),
(209, 15, 'Abseron', 'ABS', 1),
(210, 15, 'AgcabAdi', 'AGC', 1),
(211, 15, 'Agdam', 'AGM', 1),
(212, 15, 'Agdas', 'AGS', 1),
(213, 15, 'Agstafa', 'AGA', 1),
(214, 15, 'Agsu', 'AGU', 1),
(215, 15, 'Astara', 'AST', 1),
(216, 15, 'Baki', 'BA', 1),
(217, 15, 'BabAk', 'BAB', 1),
(218, 15, 'BalakAn', 'BAL', 1),
(219, 15, 'BArdA', 'BAR', 1),
(220, 15, 'Beylaqan', 'BEY', 1),
(221, 15, 'Bilasuvar', 'BIL', 1),
(222, 15, 'Cabrayil', 'CAB', 1),
(223, 15, 'Calilabab', 'CAL', 1),
(224, 15, 'Culfa', 'CUL', 1),
(225, 15, 'Daskasan', 'DAS', 1),
(226, 15, 'Davaci', 'DAV', 1),
(227, 15, 'Fuzuli', 'FUZ', 1),
(228, 15, 'Ganca', 'GA', 1),
(229, 15, 'Gadabay', 'GAD', 1),
(230, 15, 'Goranboy', 'GOR', 1),
(231, 15, 'Goycay', 'GOY', 1),
(232, 15, 'Haciqabul', 'HAC', 1),
(233, 15, 'Imisli', 'IMI', 1),
(234, 15, 'Ismayilli', 'ISM', 1),
(235, 15, 'Kalbacar', 'KAL', 1),
(236, 15, 'Kurdamir', 'KUR', 1),
(237, 15, 'Lankaran', 'LA', 1),
(238, 15, 'Lacin', 'LAC', 1),
(239, 15, 'Lankaran', 'LAN', 1),
(240, 15, 'Lerik', 'LER', 1),
(241, 15, 'Masalli', 'MAS', 1),
(242, 15, 'Mingacevir', 'MI', 1),
(243, 15, 'Naftalan', 'NA', 1),
(244, 15, 'Neftcala', 'NEF', 1),
(245, 15, 'Oguz', 'OGU', 1),
(246, 15, 'Ordubad', 'ORD', 1),
(247, 15, 'Qabala', 'QAB', 1),
(248, 15, 'Qax', 'QAX', 1),
(249, 15, 'Qazax', 'QAZ', 1),
(250, 15, 'Qobustan', 'QOB', 1),
(251, 15, 'Quba', 'QBA', 1),
(252, 15, 'Qubadli', 'QBI', 1),
(253, 15, 'Qusar', 'QUS', 1),
(254, 15, 'Saki', 'SA', 1),
(255, 15, 'Saatli', 'SAT', 1),
(256, 15, 'Sabirabad', 'SAB', 1),
(257, 15, 'Sadarak', 'SAD', 1),
(258, 15, 'Sahbuz', 'SAH', 1),
(259, 15, 'Saki', 'SAK', 1),
(260, 15, 'Salyan', 'SAL', 1),
(261, 15, 'Sumqayit', 'SM', 1),
(262, 15, 'Samaxi', 'SMI', 1),
(263, 15, 'Samkir', 'SKR', 1),
(264, 15, 'Samux', 'SMX', 1),
(265, 15, 'Sarur', 'SAR', 1),
(266, 15, 'Siyazan', 'SIY', 1),
(267, 15, 'Susa', 'SS', 1),
(268, 15, 'Susa', 'SUS', 1),
(269, 15, 'Tartar', 'TAR', 1),
(270, 15, 'Tovuz', 'TOV', 1),
(271, 15, 'Ucar', 'UCA', 1),
(272, 15, 'Xankandi', 'XA', 1),
(273, 15, 'Xacmaz', 'XAC', 1),
(274, 15, 'Xanlar', 'XAN', 1),
(275, 15, 'Xizi', 'XIZ', 1),
(276, 15, 'Xocali', 'XCI', 1),
(277, 15, 'Xocavand', 'XVD', 1),
(278, 15, 'Yardimli', 'YAR', 1),
(279, 15, 'Yevlax', 'YEV', 1),
(280, 15, 'Zangilan', 'ZAN', 1),
(281, 15, 'Zaqatala', 'ZAQ', 1),
(282, 15, 'Zardab', 'ZAR', 1),
(283, 15, 'Naxcivan', 'NX', 1),
(284, 16, 'Acklins', 'ACK', 1),
(285, 16, 'Berry Islands', 'BER', 1),
(286, 16, 'Bimini', 'BIM', 1),
(287, 16, 'Black Point', 'BLK', 1),
(288, 16, 'Cat Island', 'CAT', 1),
(289, 16, 'Central Abaco', 'CAB', 1),
(290, 16, 'Central Andros', 'CAN', 1),
(291, 16, 'Central Eleuthera', 'CEL', 1),
(292, 16, 'City of Freeport', 'FRE', 1),
(293, 16, 'Crooked Island', 'CRO', 1),
(294, 16, 'East Grand Bahama', 'EGB', 1),
(295, 16, 'Exuma', 'EXU', 1),
(296, 16, 'Grand Cay', 'GRD', 1),
(297, 16, 'Harbour Island', 'HAR', 1),
(298, 16, 'Hope Town', 'HOP', 1),
(299, 16, 'Inagua', 'INA', 1),
(300, 16, 'Long Island', 'LNG', 1),
(301, 16, 'Mangrove Cay', 'MAN', 1),
(302, 16, 'Mayaguana', 'MAY', 1),
(303, 16, 'Moore\'s Island', 'MOO', 1),
(304, 16, 'North Abaco', 'NAB', 1),
(305, 16, 'North Andros', 'NAN', 1),
(306, 16, 'North Eleuthera', 'NEL', 1),
(307, 16, 'Ragged Island', 'RAG', 1),
(308, 16, 'Rum Cay', 'RUM', 1),
(309, 16, 'San Salvador', 'SAL', 1),
(310, 16, 'South Abaco', 'SAB', 1),
(311, 16, 'South Andros', 'SAN', 1),
(312, 16, 'South Eleuthera', 'SEL', 1),
(313, 16, 'Spanish Wells', 'SWE', 1),
(314, 16, 'West Grand Bahama', 'WGB', 1),
(315, 17, 'Capital', 'CAP', 1),
(316, 17, 'Central', 'CEN', 1),
(317, 17, 'Muharraq', 'MUH', 1),
(318, 17, 'Northern', 'NOR', 1),
(319, 17, 'Southern', 'SOU', 1),
(320, 18, 'Barisal', 'BAR', 1),
(321, 18, 'Chittagong', 'CHI', 1),
(322, 18, 'Dhaka', 'DHA', 1),
(323, 18, 'Khulna', 'KHU', 1),
(324, 18, 'Rajshahi', 'RAJ', 1),
(325, 18, 'Sylhet', 'SYL', 1),
(326, 19, 'Christ Church', 'CC', 1),
(327, 19, 'Saint Andrew', 'AND', 1),
(328, 19, 'Saint George', 'GEO', 1),
(329, 19, 'Saint James', 'JAM', 1),
(330, 19, 'Saint John', 'JOH', 1),
(331, 19, 'Saint Joseph', 'JOS', 1),
(332, 19, 'Saint Lucy', 'LUC', 1),
(333, 19, 'Saint Michael', 'MIC', 1),
(334, 19, 'Saint Peter', 'PET', 1),
(335, 19, 'Saint Philip', 'PHI', 1),
(336, 19, 'Saint Thomas', 'THO', 1),
(337, 20, 'Brestskaya (Brest)', 'BR', 1),
(338, 20, 'Homyel\'skaya (Homyel\')', 'HO', 1),
(339, 20, 'Horad Minsk', 'HM', 1),
(340, 20, 'Hrodzyenskaya (Hrodna)', 'HR', 1),
(341, 20, 'Mahilyowskaya (Mahilyow)', 'MA', 1),
(342, 20, 'Minskaya', 'MI', 1),
(343, 20, 'Vitsyebskaya (Vitsyebsk)', 'VI', 1),
(344, 21, 'Antwerpen', 'VAN', 1),
(345, 21, 'Brabant Wallon', 'WBR', 1),
(346, 21, 'Hainaut', 'WHT', 1),
(347, 21, 'Liège', 'WLG', 1),
(348, 21, 'Limburg', 'VLI', 1),
(349, 21, 'Luxembourg', 'WLX', 1),
(350, 21, 'Namur', 'WNA', 1),
(351, 21, 'Oost-Vlaanderen', 'VOV', 1),
(352, 21, 'Vlaams Brabant', 'VBR', 1),
(353, 21, 'West-Vlaanderen', 'VWV', 1),
(354, 22, 'Belize', 'BZ', 1),
(355, 22, 'Cayo', 'CY', 1),
(356, 22, 'Corozal', 'CR', 1),
(357, 22, 'Orange Walk', 'OW', 1),
(358, 22, 'Stann Creek', 'SC', 1),
(359, 22, 'Toledo', 'TO', 1),
(360, 23, 'Alibori', 'AL', 1),
(361, 23, 'Atakora', 'AK', 1),
(362, 23, 'Atlantique', 'AQ', 1),
(363, 23, 'Borgou', 'BO', 1),
(364, 23, 'Collines', 'CO', 1),
(365, 23, 'Donga', 'DO', 1),
(366, 23, 'Kouffo', 'KO', 1),
(367, 23, 'Littoral', 'LI', 1),
(368, 23, 'Mono', 'MO', 1),
(369, 23, 'Oueme', 'OU', 1),
(370, 23, 'Plateau', 'PL', 1),
(371, 23, 'Zou', 'ZO', 1),
(372, 24, 'Devonshire', 'DS', 1),
(373, 24, 'Hamilton City', 'HC', 1),
(374, 24, 'Hamilton', 'HA', 1),
(375, 24, 'Paget', 'PG', 1),
(376, 24, 'Pembroke', 'PB', 1),
(377, 24, 'Saint George City', 'GC', 1),
(378, 24, 'Saint George\'s', 'SG', 1),
(379, 24, 'Sandys', 'SA', 1),
(380, 24, 'Smith\'s', 'SM', 1),
(381, 24, 'Southampton', 'SH', 1),
(382, 24, 'Warwick', 'WA', 1),
(383, 25, 'Bumthang', 'BUM', 1),
(384, 25, 'Chukha', 'CHU', 1),
(385, 25, 'Dagana', 'DAG', 1),
(386, 25, 'Gasa', 'GAS', 1),
(387, 25, 'Haa', 'HAA', 1),
(388, 25, 'Lhuntse', 'LHU', 1),
(389, 25, 'Mongar', 'MON', 1),
(390, 25, 'Paro', 'PAR', 1),
(391, 25, 'Pemagatshel', 'PEM', 1),
(392, 25, 'Punakha', 'PUN', 1),
(393, 25, 'Samdrup Jongkhar', 'SJO', 1),
(394, 25, 'Samtse', 'SAT', 1),
(395, 25, 'Sarpang', 'SAR', 1),
(396, 25, 'Thimphu', 'THI', 1),
(397, 25, 'Trashigang', 'TRG', 1),
(398, 25, 'Trashiyangste', 'TRY', 1),
(399, 25, 'Trongsa', 'TRO', 1),
(400, 25, 'Tsirang', 'TSI', 1),
(401, 25, 'Wangdue Phodrang', 'WPH', 1),
(402, 25, 'Zhemgang', 'ZHE', 1),
(403, 26, 'Beni', 'BEN', 1),
(404, 26, 'Chuquisaca', 'CHU', 1),
(405, 26, 'Cochabamba', 'COC', 1),
(406, 26, 'La Paz', 'LPZ', 1),
(407, 26, 'Oruro', 'ORU', 1),
(408, 26, 'Pando', 'PAN', 1),
(409, 26, 'Potosi', 'POT', 1),
(410, 26, 'Santa Cruz', 'SCZ', 1),
(411, 26, 'Tarija', 'TAR', 1),
(412, 27, 'Brcko district', 'BRO', 1),
(413, 27, 'Unsko-Sanski Kanton', 'FUS', 1),
(414, 27, 'Posavski Kanton', 'FPO', 1),
(415, 27, 'Tuzlanski Kanton', 'FTU', 1),
(416, 27, 'Zenicko-Dobojski Kanton', 'FZE', 1),
(417, 27, 'Bosanskopodrinjski Kanton', 'FBP', 1),
(418, 27, 'Srednjebosanski Kanton', 'FSB', 1),
(419, 27, 'Hercegovacko-neretvanski Kanton', 'FHN', 1),
(420, 27, 'Zapadnohercegovacka Zupanija', 'FZH', 1),
(421, 27, 'Kanton Sarajevo', 'FSA', 1),
(422, 27, 'Zapadnobosanska', 'FZA', 1),
(423, 27, 'Banja Luka', 'SBL', 1),
(424, 27, 'Doboj', 'SDO', 1),
(425, 27, 'Bijeljina', 'SBI', 1),
(426, 27, 'Vlasenica', 'SVL', 1),
(427, 27, 'Sarajevo-Romanija or Sokolac', 'SSR', 1),
(428, 27, 'Foca', 'SFO', 1),
(429, 27, 'Trebinje', 'STR', 1),
(430, 28, 'Central', 'CE', 1),
(431, 28, 'Ghanzi', 'GH', 1),
(432, 28, 'Kgalagadi', 'KD', 1),
(433, 28, 'Kgatleng', 'KT', 1),
(434, 28, 'Kweneng', 'KW', 1),
(435, 28, 'Ngamiland', 'NG', 1),
(436, 28, 'North East', 'NE', 1),
(437, 28, 'North West', 'NW', 1),
(438, 28, 'South East', 'SE', 1),
(439, 28, 'Southern', 'SO', 1),
(440, 30, 'Acre', 'AC', 1),
(441, 30, 'Alagoas', 'AL', 1),
(442, 30, 'Amapá', 'AP', 1),
(443, 30, 'Amazonas', 'AM', 1),
(444, 30, 'Bahia', 'BA', 1),
(445, 30, 'Ceará', 'CE', 1),
(446, 30, 'Distrito Federal', 'DF', 1),
(447, 30, 'Espírito Santo', 'ES', 1),
(448, 30, 'Goiás', 'GO', 1),
(449, 30, 'Maranhão', 'MA', 1),
(450, 30, 'Mato Grosso', 'MT', 1),
(451, 30, 'Mato Grosso do Sul', 'MS', 1),
(452, 30, 'Minas Gerais', 'MG', 1),
(453, 30, 'Pará', 'PA', 1),
(454, 30, 'Paraíba', 'PB', 1),
(455, 30, 'Paraná', 'PR', 1),
(456, 30, 'Pernambuco', 'PE', 1),
(457, 30, 'Piauí', 'PI', 1),
(458, 30, 'Rio de Janeiro', 'RJ', 1),
(459, 30, 'Rio Grande do Norte', 'RN', 1),
(460, 30, 'Rio Grande do Sul', 'RS', 1),
(461, 30, 'Rondônia', 'RO', 1),
(462, 30, 'Roraima', 'RR', 1),
(463, 30, 'Santa Catarina', 'SC', 1),
(464, 30, 'São Paulo', 'SP', 1),
(465, 30, 'Sergipe', 'SE', 1),
(466, 30, 'Tocantins', 'TO', 1),
(467, 31, 'Peros Banhos', 'PB', 1),
(468, 31, 'Salomon Islands', 'SI', 1),
(469, 31, 'Nelsons Island', 'NI', 1),
(470, 31, 'Three Brothers', 'TB', 1),
(471, 31, 'Eagle Islands', 'EA', 1),
(472, 31, 'Danger Island', 'DI', 1),
(473, 31, 'Egmont Islands', 'EG', 1),
(474, 31, 'Diego Garcia', 'DG', 1),
(475, 32, 'Belait', 'BEL', 1),
(476, 32, 'Brunei and Muara', 'BRM', 1),
(477, 32, 'Temburong', 'TEM', 1),
(478, 32, 'Tutong', 'TUT', 1),
(479, 33, 'Blagoevgrad', '', 1),
(480, 33, 'Burgas', '', 1),
(481, 33, 'Dobrich', '', 1),
(482, 33, 'Gabrovo', '', 1),
(483, 33, 'Haskovo', '', 1),
(484, 33, 'Kardjali', '', 1),
(485, 33, 'Kyustendil', '', 1),
(486, 33, 'Lovech', '', 1),
(487, 33, 'Montana', '', 1),
(488, 33, 'Pazardjik', '', 1),
(489, 33, 'Pernik', '', 1),
(490, 33, 'Pleven', '', 1),
(491, 33, 'Plovdiv', '', 1),
(492, 33, 'Razgrad', '', 1),
(493, 33, 'Shumen', '', 1),
(494, 33, 'Silistra', '', 1),
(495, 33, 'Sliven', '', 1),
(496, 33, 'Smolyan', '', 1),
(497, 33, 'Sofia', '', 1),
(498, 33, 'Sofia - town', '', 1),
(499, 33, 'Stara Zagora', '', 1),
(500, 33, 'Targovishte', '', 1),
(501, 33, 'Varna', '', 1),
(502, 33, 'Veliko Tarnovo', '', 1),
(503, 33, 'Vidin', '', 1),
(504, 33, 'Vratza', '', 1),
(505, 33, 'Yambol', '', 1),
(506, 34, 'Bale', 'BAL', 1),
(507, 34, 'Bam', 'BAM', 1),
(508, 34, 'Banwa', 'BAN', 1),
(509, 34, 'Bazega', 'BAZ', 1),
(510, 34, 'Bougouriba', 'BOR', 1),
(511, 34, 'Boulgou', 'BLG', 1),
(512, 34, 'Boulkiemde', 'BOK', 1),
(513, 34, 'Comoe', 'COM', 1),
(514, 34, 'Ganzourgou', 'GAN', 1),
(515, 34, 'Gnagna', 'GNA', 1),
(516, 34, 'Gourma', 'GOU', 1),
(517, 34, 'Houet', 'HOU', 1),
(518, 34, 'Ioba', 'IOA', 1),
(519, 34, 'Kadiogo', 'KAD', 1),
(520, 34, 'Kenedougou', 'KEN', 1),
(521, 34, 'Komondjari', 'KOD', 1),
(522, 34, 'Kompienga', 'KOP', 1),
(523, 34, 'Kossi', 'KOS', 1),
(524, 34, 'Koulpelogo', 'KOL', 1),
(525, 34, 'Kouritenga', 'KOT', 1),
(526, 34, 'Kourweogo', 'KOW', 1),
(527, 34, 'Leraba', 'LER', 1),
(528, 34, 'Loroum', 'LOR', 1),
(529, 34, 'Mouhoun', 'MOU', 1),
(530, 34, 'Nahouri', 'NAH', 1),
(531, 34, 'Namentenga', 'NAM', 1),
(532, 34, 'Nayala', 'NAY', 1),
(533, 34, 'Noumbiel', 'NOU', 1),
(534, 34, 'Oubritenga', 'OUB', 1),
(535, 34, 'Oudalan', 'OUD', 1),
(536, 34, 'Passore', 'PAS', 1),
(537, 34, 'Poni', 'PON', 1),
(538, 34, 'Sanguie', 'SAG', 1),
(539, 34, 'Sanmatenga', 'SAM', 1),
(540, 34, 'Seno', 'SEN', 1),
(541, 34, 'Sissili', 'SIS', 1),
(542, 34, 'Soum', 'SOM', 1),
(543, 34, 'Sourou', 'SOR', 1),
(544, 34, 'Tapoa', 'TAP', 1),
(545, 34, 'Tuy', 'TUY', 1),
(546, 34, 'Yagha', 'YAG', 1),
(547, 34, 'Yatenga', 'YAT', 1),
(548, 34, 'Ziro', 'ZIR', 1),
(549, 34, 'Zondoma', 'ZOD', 1),
(550, 34, 'Zoundweogo', 'ZOW', 1),
(551, 35, 'Bubanza', 'BB', 1),
(552, 35, 'Bujumbura', 'BJ', 1),
(553, 35, 'Bururi', 'BR', 1),
(554, 35, 'Cankuzo', 'CA', 1),
(555, 35, 'Cibitoke', 'CI', 1),
(556, 35, 'Gitega', 'GI', 1),
(557, 35, 'Karuzi', 'KR', 1),
(558, 35, 'Kayanza', 'KY', 1),
(559, 35, 'Kirundo', 'KI', 1),
(560, 35, 'Makamba', 'MA', 1),
(561, 35, 'Muramvya', 'MU', 1),
(562, 35, 'Muyinga', 'MY', 1),
(563, 35, 'Mwaro', 'MW', 1),
(564, 35, 'Ngozi', 'NG', 1),
(565, 35, 'Rutana', 'RT', 1),
(566, 35, 'Ruyigi', 'RY', 1),
(567, 36, 'Phnom Penh', 'PP', 1),
(568, 36, 'Preah Seihanu (Kompong Som or Sihanoukville)', 'PS', 1),
(569, 36, 'Pailin', 'PA', 1),
(570, 36, 'Keb', 'KB', 1),
(571, 36, 'Banteay Meanchey', 'BM', 1),
(572, 36, 'Battambang', 'BA', 1),
(573, 36, 'Kampong Cham', 'KM', 1),
(574, 36, 'Kampong Chhnang', 'KN', 1),
(575, 36, 'Kampong Speu', 'KU', 1),
(576, 36, 'Kampong Som', 'KO', 1),
(577, 36, 'Kampong Thom', 'KT', 1),
(578, 36, 'Kampot', 'KP', 1),
(579, 36, 'Kandal', 'KL', 1),
(580, 36, 'Kaoh Kong', 'KK', 1),
(581, 36, 'Kratie', 'KR', 1),
(582, 36, 'Mondul Kiri', 'MK', 1),
(583, 36, 'Oddar Meancheay', 'OM', 1),
(584, 36, 'Pursat', 'PU', 1),
(585, 36, 'Preah Vihear', 'PR', 1),
(586, 36, 'Prey Veng', 'PG', 1),
(587, 36, 'Ratanak Kiri', 'RK', 1),
(588, 36, 'Siemreap', 'SI', 1),
(589, 36, 'Stung Treng', 'ST', 1),
(590, 36, 'Svay Rieng', 'SR', 1),
(591, 36, 'Takeo', 'TK', 1),
(592, 37, 'Adamawa (Adamaoua)', 'ADA', 1),
(593, 37, 'Centre', 'CEN', 1),
(594, 37, 'East (Est)', 'EST', 1),
(595, 37, 'Extreme North (Extreme-Nord)', 'EXN', 1),
(596, 37, 'Littoral', 'LIT', 1),
(597, 37, 'North (Nord)', 'NOR', 1),
(598, 37, 'Northwest (Nord-Ouest)', 'NOT', 1),
(599, 37, 'West (Ouest)', 'OUE', 1),
(600, 37, 'South (Sud)', 'SUD', 1),
(601, 37, 'Southwest (Sud-Ouest).', 'SOU', 1),
(602, 38, 'Alberta', 'AB', 1),
(603, 38, 'British Columbia', 'BC', 1),
(604, 38, 'Manitoba', 'MB', 1),
(605, 38, 'New Brunswick', 'NB', 1),
(606, 38, 'Newfoundland and Labrador', 'NL', 1),
(607, 38, 'Northwest Territories', 'NT', 1),
(608, 38, 'Nova Scotia', 'NS', 1),
(609, 38, 'Nunavut', 'NU', 1),
(610, 38, 'Ontario', 'ON', 1),
(611, 38, 'Prince Edward Island', 'PE', 1),
(612, 38, 'Qu&eacute;bec', 'QC', 1),
(613, 38, 'Saskatchewan', 'SK', 1),
(614, 38, 'Yukon Territory', 'YT', 1),
(615, 39, 'Boa Vista', 'BV', 1),
(616, 39, 'Brava', 'BR', 1),
(617, 39, 'Calheta de Sao Miguel', 'CS', 1),
(618, 39, 'Maio', 'MA', 1),
(619, 39, 'Mosteiros', 'MO', 1),
(620, 39, 'Paul', 'PA', 1),
(621, 39, 'Porto Novo', 'PN', 1),
(622, 39, 'Praia', 'PR', 1),
(623, 39, 'Ribeira Grande', 'RG', 1),
(624, 39, 'Sal', 'SL', 1),
(625, 39, 'Santa Catarina', 'CA', 1),
(626, 39, 'Santa Cruz', 'CR', 1),
(627, 39, 'Sao Domingos', 'SD', 1),
(628, 39, 'Sao Filipe', 'SF', 1),
(629, 39, 'Sao Nicolau', 'SN', 1),
(630, 39, 'Sao Vicente', 'SV', 1),
(631, 39, 'Tarrafal', 'TA', 1),
(632, 40, 'Creek', 'CR', 1),
(633, 40, 'Eastern', 'EA', 1),
(634, 40, 'Midland', 'ML', 1),
(635, 40, 'South Town', 'ST', 1),
(636, 40, 'Spot Bay', 'SP', 1),
(637, 40, 'Stake Bay', 'SK', 1),
(638, 40, 'West End', 'WD', 1),
(639, 40, 'Western', 'WN', 1),
(640, 41, 'Bamingui-Bangoran', 'BBA', 1),
(641, 41, 'Basse-Kotto', 'BKO', 1),
(642, 41, 'Haute-Kotto', 'HKO', 1),
(643, 41, 'Haut-Mbomou', 'HMB', 1),
(644, 41, 'Kemo', 'KEM', 1),
(645, 41, 'Lobaye', 'LOB', 1),
(646, 41, 'Mambere-KadeÔ', 'MKD', 1),
(647, 41, 'Mbomou', 'MBO', 1),
(648, 41, 'Nana-Mambere', 'NMM', 1),
(649, 41, 'Ombella-M\'Poko', 'OMP', 1),
(650, 41, 'Ouaka', 'OUK', 1),
(651, 41, 'Ouham', 'OUH', 1),
(652, 41, 'Ouham-Pende', 'OPE', 1),
(653, 41, 'Vakaga', 'VAK', 1),
(654, 41, 'Nana-Grebizi', 'NGR', 1),
(655, 41, 'Sangha-Mbaere', 'SMB', 1),
(656, 41, 'Bangui', 'BAN', 1),
(657, 42, 'Batha', 'BA', 1),
(658, 42, 'Biltine', 'BI', 1),
(659, 42, 'Borkou-Ennedi-Tibesti', 'BE', 1),
(660, 42, 'Chari-Baguirmi', 'CB', 1),
(661, 42, 'Guera', 'GU', 1),
(662, 42, 'Kanem', 'KA', 1),
(663, 42, 'Lac', 'LA', 1),
(664, 42, 'Logone Occidental', 'LC', 1),
(665, 42, 'Logone Oriental', 'LR', 1),
(666, 42, 'Mayo-Kebbi', 'MK', 1),
(667, 42, 'Moyen-Chari', 'MC', 1),
(668, 42, 'Ouaddai', 'OU', 1),
(669, 42, 'Salamat', 'SA', 1),
(670, 42, 'Tandjile', 'TA', 1),
(671, 43, 'Aisen del General Carlos Ibanez', 'AI', 1),
(672, 43, 'Antofagasta', 'AN', 1),
(673, 43, 'Araucania', 'AR', 1),
(674, 43, 'Atacama', 'AT', 1),
(675, 43, 'Bio-Bio', 'BI', 1),
(676, 43, 'Coquimbo', 'CO', 1),
(677, 43, 'Libertador General Bernardo O\'Higgins', 'LI', 1),
(678, 43, 'Los Lagos', 'LL', 1),
(679, 43, 'Magallanes y de la Antartica Chilena', 'MA', 1),
(680, 43, 'Maule', 'ML', 1),
(681, 43, 'Region Metropolitana', 'RM', 1),
(682, 43, 'Tarapaca', 'TA', 1),
(683, 43, 'Valparaiso', 'VS', 1),
(684, 44, '安徽省', 'AN', 1),
(685, 44, '北京市', 'BE', 1),
(686, 44, '重庆', 'CH', 1),
(687, 44, '福建省', 'FU', 1),
(688, 44, '甘肃省', 'GA', 1),
(689, 44, '广东省', 'GU', 1),
(690, 44, '广西壮族自治区', 'GX', 1),
(691, 44, '贵州省', 'GZ', 1),
(692, 44, '海南省', 'HA', 1),
(693, 44, '河北省', 'HB', 1),
(694, 44, '黑龙江省', 'HL', 1),
(695, 44, '河南省', 'HE', 1),
(696, 44, '香港特别行政区', 'HK', 1),
(697, 44, '湖北省', 'HU', 1),
(698, 44, '湖南省', 'HN', 1),
(699, 44, '内蒙古自治区', 'IM', 1),
(700, 44, '江苏省', 'JI', 1),
(701, 44, '江西省', 'JX', 1),
(702, 44, '吉林省', 'JL', 1),
(703, 44, '辽宁省', 'LI', 1),
(704, 44, '澳门特别行政区', 'MA', 1),
(705, 44, '宁夏回族自治区', 'NI', 1),
(706, 44, '陕西省', 'SH', 1),
(707, 44, '山东省', 'SA', 1),
(708, 44, '上海市', 'SG', 1),
(709, 44, '山西省', 'SX', 1),
(710, 44, '四川省', 'SI', 1),
(711, 44, '天津市', 'TI', 1),
(712, 44, '新疆维吾尔自治区', 'XI', 1),
(713, 44, '云南省', 'YU', 1),
(714, 44, '浙江省', 'ZH', 1),
(715, 46, 'Direction Island', 'D', 1),
(716, 46, 'Home Island', 'H', 1),
(717, 46, 'Horsburgh Island', 'O', 1),
(718, 46, 'South Island', 'S', 1),
(719, 46, 'West Island', 'W', 1),
(720, 47, 'Amazonas', 'AMZ', 1),
(721, 47, 'Antioquia', 'ANT', 1),
(722, 47, 'Arauca', 'ARA', 1),
(723, 47, 'Atlantico', 'ATL', 1),
(724, 47, 'Bogota D.C.', 'BDC', 1),
(725, 47, 'Bolivar', 'BOL', 1),
(726, 47, 'Boyaca', 'BOY', 1),
(727, 47, 'Caldas', 'CAL', 1),
(728, 47, 'Caqueta', 'CAQ', 1),
(729, 47, 'Casanare', 'CAS', 1),
(730, 47, 'Cauca', 'CAU', 1),
(731, 47, 'Cesar', 'CES', 1),
(732, 47, 'Choco', 'CHO', 1),
(733, 47, 'Cordoba', 'COR', 1),
(734, 47, 'Cundinamarca', 'CAM', 1),
(735, 47, 'Guainia', 'GNA', 1),
(736, 47, 'Guajira', 'GJR', 1),
(737, 47, 'Guaviare', 'GVR', 1),
(738, 47, 'Huila', 'HUI', 1),
(739, 47, 'Magdalena', 'MAG', 1),
(740, 47, 'Meta', 'MET', 1),
(741, 47, 'Narino', 'NAR', 1),
(742, 47, 'Norte de Santander', 'NDS', 1),
(743, 47, 'Putumayo', 'PUT', 1),
(744, 47, 'Quindio', 'QUI', 1),
(745, 47, 'Risaralda', 'RIS', 1),
(746, 47, 'San Andres y Providencia', 'SAP', 1),
(747, 47, 'Santander', 'SAN', 1),
(748, 47, 'Sucre', 'SUC', 1),
(749, 47, 'Tolima', 'TOL', 1),
(750, 47, 'Valle del Cauca', 'VDC', 1),
(751, 47, 'Vaupes', 'VAU', 1),
(752, 47, 'Vichada', 'VIC', 1),
(753, 48, 'Grande Comore', 'G', 1),
(754, 48, 'Anjouan', 'A', 1),
(755, 48, 'Moheli', 'M', 1),
(756, 49, 'Bouenza', 'BO', 1),
(757, 49, 'Brazzaville', 'BR', 1),
(758, 49, 'Cuvette', 'CU', 1),
(759, 49, 'Cuvette-Ouest', 'CO', 1),
(760, 49, 'Kouilou', 'KO', 1),

(761, 49, 'Lekoumou', 'LE', 1),
(762, 49, 'Likouala', 'LI', 1),
(763, 49, 'Niari', 'NI', 1),
(764, 49, 'Plateaux', 'PL', 1),
(765, 49, 'Pool', 'PO', 1),
(766, 49, 'Sangha', 'SA', 1),
(767, 50, 'Pukapuka', 'PU', 1),
(768, 50, 'Rakahanga', 'RK', 1),
(769, 50, 'Manihiki', 'MK', 1),
(770, 50, 'Penrhyn', 'PE', 1),
(771, 50, 'Nassau Island', 'NI', 1),
(772, 50, 'Surwarrow', 'SU', 1),
(773, 50, 'Palmerston', 'PA', 1),
(774, 50, 'Aitutaki', 'AI', 1),
(775, 50, 'Manuae', 'MA', 1),
(776, 50, 'Takutea', 'TA', 1),
(777, 50, 'Mitiaro', 'MT', 1),
(778, 50, 'Atiu', 'AT', 1),
(779, 50, 'Mauke', 'MU', 1),
(780, 50, 'Rarotonga', 'RR', 1),
(781, 50, 'Mangaia', 'MG', 1),
(782, 51, 'Alajuela', 'AL', 1),
(783, 51, 'Cartago', 'CA', 1),
(784, 51, 'Guanacaste', 'GU', 1),
(785, 51, 'Heredia', 'HE', 1),
(786, 51, 'Limon', 'LI', 1),
(787, 51, 'Puntarenas', 'PU', 1),
(788, 51, 'San Jose', 'SJ', 1),
(789, 52, 'Abengourou', 'ABE', 1),
(790, 52, 'Abidjan', 'ABI', 1),
(791, 52, 'Aboisso', 'ABO', 1),
(792, 52, 'Adiake', 'ADI', 1),
(793, 52, 'Adzope', 'ADZ', 1),
(794, 52, 'Agboville', 'AGB', 1),
(795, 52, 'Agnibilekrou', 'AGN', 1),
(796, 52, 'Alepe', 'ALE', 1),
(797, 52, 'Bocanda', 'BOC', 1),
(798, 52, 'Bangolo', 'BAN', 1),
(799, 52, 'Beoumi', 'BEO', 1),
(800, 52, 'Biankouma', 'BIA', 1),
(801, 52, 'Bondoukou', 'BDK', 1),
(802, 52, 'Bongouanou', 'BGN', 1),
(803, 52, 'Bouafle', 'BFL', 1),
(804, 52, 'Bouake', 'BKE', 1),
(805, 52, 'Bouna', 'BNA', 1),
(806, 52, 'Boundiali', 'BDL', 1),
(807, 52, 'Dabakala', 'DKL', 1),
(808, 52, 'Dabou', 'DBU', 1),
(809, 52, 'Daloa', 'DAL', 1),
(810, 52, 'Danane', 'DAN', 1),
(811, 52, 'Daoukro', 'DAO', 1),
(812, 52, 'Dimbokro', 'DIM', 1),
(813, 52, 'Divo', 'DIV', 1),
(814, 52, 'Duekoue', 'DUE', 1),
(815, 52, 'Ferkessedougou', 'FER', 1),
(816, 52, 'Gagnoa', 'GAG', 1),
(817, 52, 'Grand-Bassam', 'GBA', 1),
(818, 52, 'Grand-Lahou', 'GLA', 1),
(819, 52, 'Guiglo', 'GUI', 1),
(820, 52, 'Issia', 'ISS', 1),
(821, 52, 'Jacqueville', 'JAC', 1),
(822, 52, 'Katiola', 'KAT', 1),
(823, 52, 'Korhogo', 'KOR', 1),
(824, 52, 'Lakota', 'LAK', 1),
(825, 52, 'Man', 'MAN', 1),
(826, 52, 'Mankono', 'MKN', 1),
(827, 52, 'Mbahiakro', 'MBA', 1),
(828, 52, 'Odienne', 'ODI', 1),
(829, 52, 'Oume', 'OUM', 1),
(830, 52, 'Sakassou', 'SAK', 1),
(831, 52, 'San-Pedro', 'SPE', 1),
(832, 52, 'Sassandra', 'SAS', 1),
(833, 52, 'Seguela', 'SEG', 1),
(834, 52, 'Sinfra', 'SIN', 1),
(835, 52, 'Soubre', 'SOU', 1),
(836, 52, 'Tabou', 'TAB', 1),
(837, 52, 'Tanda', 'TAN', 1),
(838, 52, 'Tiebissou', 'TIE', 1),
(839, 52, 'Tingrela', 'TIN', 1),
(840, 52, 'Tiassale', 'TIA', 1),
(841, 52, 'Touba', 'TBA', 1),
(842, 52, 'Toulepleu', 'TLP', 1),
(843, 52, 'Toumodi', 'TMD', 1),
(844, 52, 'Vavoua', 'VAV', 1),
(845, 52, 'Yamoussoukro', 'YAM', 1),
(846, 52, 'Zuenoula', 'ZUE', 1),
(847, 53, 'Bjelovarsko-bilogorska', 'BB', 1),
(848, 53, 'Grad Zagreb', 'GZ', 1),
(849, 53, 'Dubrovačko-neretvanska', 'DN', 1),
(850, 53, 'Istarska', 'IS', 1),
(851, 53, 'Karlovačka', 'KA', 1),
(852, 53, 'Koprivničko-križevačka', 'KK', 1),
(853, 53, 'Krapinsko-zagorska', 'KZ', 1),
(854, 53, 'Ličko-senjska', 'LS', 1),
(855, 53, 'Međimurska', 'ME', 1),
(856, 53, 'Osječko-baranjska', 'OB', 1),
(857, 53, 'Požeško-slavonska', 'PS', 1),
(858, 53, 'Primorsko-goranska', 'PG', 1),
(859, 53, 'Šibensko-kninska', 'SK', 1),
(860, 53, 'Sisačko-moslavačka', 'SM', 1),
(861, 53, 'Brodsko-posavska', 'BP', 1),
(862, 53, 'Splitsko-dalmatinska', 'SD', 1),
(863, 53, 'Varaždinska', 'VA', 1),
(864, 53, 'Virovitičko-podravska', 'VP', 1),
(865, 53, 'Vukovarsko-srijemska', 'VS', 1),
(866, 53, 'Zadarska', 'ZA', 1),
(867, 53, 'Zagrebačka', 'ZG', 1),
(868, 54, 'Camaguey', 'CA', 1),
(869, 54, 'Ciego de Avila', 'CD', 1),
(870, 54, 'Cienfuegos', 'CI', 1),
(871, 54, 'Ciudad de La Habana', 'CH', 1),
(872, 54, 'Granma', 'GR', 1),
(873, 54, 'Guantanamo', 'GU', 1),
(874, 54, 'Holguin', 'HO', 1),
(875, 54, 'Isla de la Juventud', 'IJ', 1),
(876, 54, 'La Habana', 'LH', 1),
(877, 54, 'Las Tunas', 'LT', 1),
(878, 54, 'Matanzas', 'MA', 1),
(879, 54, 'Pinar del Rio', 'PR', 1),
(880, 54, 'Sancti Spiritus', 'SS', 1),
(881, 54, 'Santiago de Cuba', 'SC', 1),
(882, 54, 'Villa Clara', 'VC', 1),
(883, 55, 'Famagusta', 'F', 1),
(884, 55, 'Kyrenia', 'K', 1),
(885, 55, 'Larnaca', 'A', 1),
(886, 55, 'Limassol', 'I', 1),
(887, 55, 'Nicosia', 'N', 1),
(888, 55, 'Paphos', 'P', 1),
(889, 56, 'Ústecký', 'U', 1),
(890, 56, 'Jihočeský', 'C', 1),
(891, 56, 'Jihomoravský', 'B', 1),
(892, 56, 'Karlovarský', 'K', 1),
(893, 56, 'Královehradecký', 'H', 1),
(894, 56, 'Liberecký', 'L', 1),
(895, 56, 'Moravskoslezský', 'T', 1),
(896, 56, 'Olomoucký', 'M', 1),
(897, 56, 'Pardubický', 'E', 1),
(898, 56, 'Plzeňský', 'P', 1),
(899, 56, 'Praha', 'A', 1),
(900, 56, 'Středočeský', 'S', 1),
(901, 56, 'Vysočina', 'J', 1),
(902, 56, 'Zlínský', 'Z', 1),
(903, 57, 'Arhus', 'AR', 1),
(904, 57, 'Bornholm', 'BH', 1),
(905, 57, 'Copenhagen', 'CO', 1),
(906, 57, 'Faroe Islands', 'FO', 1),
(907, 57, 'Frederiksborg', 'FR', 1),
(908, 57, 'Fyn', 'FY', 1),
(909, 57, 'Kobenhavn', 'KO', 1),
(910, 57, 'Nordjylland', 'NO', 1),
(911, 57, 'Ribe', 'RI', 1),
(912, 57, 'Ringkobing', 'RK', 1),
(913, 57, 'Roskilde', 'RO', 1),
(914, 57, 'Sonderjylland', 'SO', 1),
(915, 57, 'Storstrom', 'ST', 1),
(916, 57, 'Vejle', 'VK', 1),
(917, 57, 'Vestj&aelig;lland', 'VJ', 1),
(918, 57, 'Viborg', 'VB', 1),
(919, 58, '\'Ali Sabih', 'S', 1),
(920, 58, 'Dikhil', 'K', 1),
(921, 58, 'Djibouti', 'J', 1),
(922, 58, 'Obock', 'O', 1),
(923, 58, 'Tadjoura', 'T', 1),
(924, 59, 'Saint Andrew Parish', 'AND', 1),
(925, 59, 'Saint David Parish', 'DAV', 1),
(926, 59, 'Saint George Parish', 'GEO', 1),
(927, 59, 'Saint John Parish', 'JOH', 1),
(928, 59, 'Saint Joseph Parish', 'JOS', 1),
(929, 59, 'Saint Luke Parish', 'LUK', 1),
(930, 59, 'Saint Mark Parish', 'MAR', 1),
(931, 59, 'Saint Patrick Parish', 'PAT', 1),
(932, 59, 'Saint Paul Parish', 'PAU', 1),
(933, 59, 'Saint Peter Parish', 'PET', 1),
(934, 60, 'Distrito Nacional', 'DN', 1),
(935, 60, 'Azua', 'AZ', 1),
(936, 60, 'Baoruco', 'BC', 1),
(937, 60, 'Barahona', 'BH', 1),
(938, 60, 'Dajabon', 'DJ', 1),
(939, 60, 'Duarte', 'DU', 1),
(940, 60, 'Elias Pina', 'EL', 1),
(941, 60, 'El Seybo', 'SY', 1),
(942, 60, 'Espaillat', 'ET', 1),
(943, 60, 'Hato Mayor', 'HM', 1),
(944, 60, 'Independencia', 'IN', 1),
(945, 60, 'La Altagracia', 'AL', 1),
(946, 60, 'La Romana', 'RO', 1),
(947, 60, 'La Vega', 'VE', 1),
(948, 60, 'Maria Trinidad Sanchez', 'MT', 1),
(949, 60, 'Monsenor Nouel', 'MN', 1),
(950, 60, 'Monte Cristi', 'MC', 1),
(951, 60, 'Monte Plata', 'MP', 1),
(952, 60, 'Pedernales', 'PD', 1),
(953, 60, 'Peravia (Bani)', 'PR', 1),
(954, 60, 'Puerto Plata', 'PP', 1),
(955, 60, 'Salcedo', 'SL', 1),
(956, 60, 'Samana', 'SM', 1),
(957, 60, 'Sanchez Ramirez', 'SH', 1),
(958, 60, 'San Cristobal', 'SC', 1),
(959, 60, 'San Jose de Ocoa', 'JO', 1),
(960, 60, 'San Juan', 'SJ', 1),
(961, 60, 'San Pedro de Macoris', 'PM', 1),
(962, 60, 'Santiago', 'SA', 1),
(963, 60, 'Santiago Rodriguez', 'ST', 1),
(964, 60, 'Santo Domingo', 'SD', 1),
(965, 60, 'Valverde', 'VA', 1),
(966, 61, 'Aileu', 'AL', 1),
(967, 61, 'Ainaro', 'AN', 1),
(968, 61, 'Baucau', 'BA', 1),
(969, 61, 'Bobonaro', 'BO', 1),
(970, 61, 'Cova Lima', 'CO', 1),
(971, 61, 'Dili', 'DI', 1),
(972, 61, 'Ermera', 'ER', 1),
(973, 61, 'Lautem', 'LA', 1),
(974, 61, 'Liquica', 'LI', 1),
(975, 61, 'Manatuto', 'MT', 1),
(976, 61, 'Manufahi', 'MF', 1),
(977, 61, 'Oecussi', 'OE', 1),
(978, 61, 'Viqueque', 'VI', 1),
(979, 62, 'Azuay', 'AZU', 1),
(980, 62, 'Bolivar', 'BOL', 1),
(981, 62, 'Ca&ntilde;ar', 'CAN', 1),
(982, 62, 'Carchi', 'CAR', 1),
(983, 62, 'Chimborazo', 'CHI', 1),
(984, 62, 'Cotopaxi', 'COT', 1),
(985, 62, 'El Oro', 'EOR', 1),
(986, 62, 'Esmeraldas', 'ESM', 1),
(987, 62, 'Gal&aacute;pagos', 'GPS', 1),
(988, 62, 'Guayas', 'GUA', 1),
(989, 62, 'Imbabura', 'IMB', 1),
(990, 62, 'Loja', 'LOJ', 1),
(991, 62, 'Los Rios', 'LRO', 1),
(992, 62, 'Manab&iacute;', 'MAN', 1),
(993, 62, 'Morona Santiago', 'MSA', 1),
(994, 62, 'Napo', 'NAP', 1),
(995, 62, 'Orellana', 'ORE', 1),
(996, 62, 'Pastaza', 'PAS', 1),
(997, 62, 'Pichincha', 'PIC', 1),
(998, 62, 'Sucumb&iacute;os', 'SUC', 1),
(999, 62, 'Tungurahua', 'TUN', 1),
(1000, 62, 'Zamora Chinchipe', 'ZCH', 1),
(1001, 63, 'Ad Daqahliyah', 'DHY', 1),
(1002, 63, 'Al Bahr al Ahmar', 'BAM', 1),
(1003, 63, 'Al Buhayrah', 'BHY', 1),
(1004, 63, 'Al Fayyum', 'FYM', 1),
(1005, 63, 'Al Gharbiyah', 'GBY', 1),
(1006, 63, 'Al Iskandariyah', 'IDR', 1),
(1007, 63, 'Al Isma\'iliyah', 'IML', 1),
(1008, 63, 'Al Jizah', 'JZH', 1),
(1009, 63, 'Al Minufiyah', 'MFY', 1),
(1010, 63, 'Al Minya', 'MNY', 1),
(1011, 63, 'Al Qahirah', 'QHR', 1),
(1012, 63, 'Al Qalyubiyah', 'QLY', 1),
(1013, 63, 'Al Wadi al Jadid', 'WJD', 1),
(1014, 63, 'Ash Sharqiyah', 'SHQ', 1),
(1015, 63, 'As Suways', 'SWY', 1),
(1016, 63, 'Aswan', 'ASW', 1),
(1017, 63, 'Asyut', 'ASY', 1),
(1018, 63, 'Bani Suwayf', 'BSW', 1),
(1019, 63, 'Bur Sa\'id', 'BSD', 1),
(1020, 63, 'Dumyat', 'DMY', 1),
(1021, 63, 'Janub Sina\'', 'JNS', 1),
(1022, 63, 'Kafr ash Shaykh', 'KSH', 1),
(1023, 63, 'Matruh', 'MAT', 1),
(1024, 63, 'Qina', 'QIN', 1),
(1025, 63, 'Shamal Sina\'', 'SHS', 1),
(1026, 63, 'Suhaj', 'SUH', 1),
(1027, 64, 'Ahuachapan', 'AH', 1),
(1028, 64, 'Cabanas', 'CA', 1),
(1029, 64, 'Chalatenango', 'CH', 1),
(1030, 64, 'Cuscatlan', 'CU', 1),
(1031, 64, 'La Libertad', 'LB', 1),
(1032, 64, 'La Paz', 'PZ', 1),
(1033, 64, 'La Union', 'UN', 1),
(1034, 64, 'Morazan', 'MO', 1),
(1035, 64, 'San Miguel', 'SM', 1),
(1036, 64, 'San Salvador', 'SS', 1),
(1037, 64, 'San Vicente', 'SV', 1),
(1038, 64, 'Santa Ana', 'SA', 1),
(1039, 64, 'Sonsonate', 'SO', 1),
(1040, 64, 'Usulutan', 'US', 1),
(1041, 65, 'Provincia Annobon', 'AN', 1),
(1042, 65, 'Provincia Bioko Norte', 'BN', 1),
(1043, 65, 'Provincia Bioko Sur', 'BS', 1),
(1044, 65, 'Provincia Centro Sur', 'CS', 1),
(1045, 65, 'Provincia Kie-Ntem', 'KN', 1),
(1046, 65, 'Provincia Litoral', 'LI', 1),
(1047, 65, 'Provincia Wele-Nzas', 'WN', 1),
(1048, 66, 'Central (Maekel)', 'MA', 1),
(1049, 66, 'Anseba (Keren)', 'KE', 1),
(1050, 66, 'Southern Red Sea (Debub-Keih-Bahri)', 'DK', 1),
(1051, 66, 'Northern Red Sea (Semien-Keih-Bahri)', 'SK', 1),
(1052, 66, 'Southern (Debub)', 'DE', 1),
(1053, 66, 'Gash-Barka (Barentu)', 'BR', 1),
(1054, 67, 'Harjumaa (Tallinn)', 'HA', 1),
(1055, 67, 'Hiiumaa (Kardla)', 'HI', 1),
(1056, 67, 'Ida-Virumaa (Johvi)', 'IV', 1),
(1057, 67, 'Jarvamaa (Paide)', 'JA', 1),
(1058, 67, 'Jogevamaa (Jogeva)', 'JO', 1),
(1059, 67, 'Laane-Virumaa (Rakvere)', 'LV', 1),
(1060, 67, 'Laanemaa (Haapsalu)', 'LA', 1),
(1061, 67, 'Parnumaa (Parnu)', 'PA', 1),
(1062, 67, 'Polvamaa (Polva)', 'PO', 1),
(1063, 67, 'Raplamaa (Rapla)', 'RA', 1),
(1064, 67, 'Saaremaa (Kuessaare)', 'SA', 1),
(1065, 67, 'Tartumaa (Tartu)', 'TA', 1),
(1066, 67, 'Valgamaa (Valga)', 'VA', 1),
(1067, 67, 'Viljandimaa (Viljandi)', 'VI', 1),
(1068, 67, 'Vorumaa (Voru)', 'VO', 1),
(1069, 68, 'Afar', 'AF', 1),
(1070, 68, 'Amhara', 'AH', 1),
(1071, 68, 'Benishangul-Gumaz', 'BG', 1),
(1072, 68, 'Gambela', 'GB', 1),
(1073, 68, 'Hariai', 'HR', 1),
(1074, 68, 'Oromia', 'OR', 1),
(1075, 68, 'Somali', 'SM', 1),
(1076, 68, 'Southern Nations - Nationalities and Peoples Region', 'SN', 1),
(1077, 68, 'Tigray', 'TG', 1),
(1078, 68, 'Addis Ababa', 'AA', 1),
(1079, 68, 'Dire Dawa', 'DD', 1),
(1080, 71, 'Central Division', 'C', 1),
(1081, 71, 'Northern Division', 'N', 1),
(1082, 71, 'Eastern Division', 'E', 1),
(1083, 71, 'Western Division', 'W', 1),
(1084, 71, 'Rotuma', 'R', 1),
(1085, 72, 'Ahvenanmaan lääni', 'AL', 1),
(1086, 72, 'Etelä-Suomen lääni', 'ES', 1),
(1087, 72, 'Itä-Suomen lääni', 'IS', 1),
(1088, 72, 'Länsi-Suomen lääni', 'LS', 1),
(1089, 72, 'Lapin lääni', 'LA', 1),
(1090, 72, 'Oulun lääni', 'OU', 1),
(1114, 74, 'Ain', '01', 1),
(1115, 74, 'Aisne', '02', 1),
(1116, 74, 'Allier', '03', 1),
(1117, 74, 'Alpes de Haute Provence', '04', 1),
(1118, 74, 'Hautes-Alpes', '05', 1),
(1119, 74, 'Alpes Maritimes', '06', 1),
(1120, 74, 'Ard&egrave;che', '07', 1),
(1121, 74, 'Ardennes', '08', 1),
(1122, 74, 'Ari&egrave;ge', '09', 1),
(1123, 74, 'Aube', '10', 1),
(1124, 74, 'Aude', '11', 1),
(1125, 74, 'Aveyron', '12', 1),
(1126, 74, 'Bouches du Rh&ocirc;ne', '13', 1),
(1127, 74, 'Calvados', '14', 1),
(1128, 74, 'Cantal', '15', 1),
(1129, 74, 'Charente', '16', 1),
(1130, 74, 'Charente Maritime', '17', 1),
(1131, 74, 'Cher', '18', 1),
(1132, 74, 'Corr&egrave;ze', '19', 1),
(1133, 74, 'Corse du Sud', '2A', 1),
(1134, 74, 'Haute Corse', '2B', 1),
(1135, 74, 'C&ocirc;te d&#039;or', '21', 1),
(1136, 74, 'C&ocirc;tes d&#039;Armor', '22', 1),
(1137, 74, 'Creuse', '23', 1),
(1138, 74, 'Dordogne', '24', 1),
(1139, 74, 'Doubs', '25', 1),
(1140, 74, 'Dr&ocirc;me', '26', 1),
(1141, 74, 'Eure', '27', 1),
(1142, 74, 'Eure et Loir', '28', 1),
(1143, 74, 'Finist&egrave;re', '29', 1),
(1144, 74, 'Gard', '30', 1),
(1145, 74, 'Haute Garonne', '31', 1),
(1146, 74, 'Gers', '32', 1),
(1147, 74, 'Gironde', '33', 1),
(1148, 74, 'H&eacute;rault', '34', 1),
(1149, 74, 'Ille et Vilaine', '35', 1),
(1150, 74, 'Indre', '36', 1),
(1151, 74, 'Indre et Loire', '37', 1),
(1152, 74, 'Is&eacute;re', '38', 1),
(1153, 74, 'Jura', '39', 1),
(1154, 74, 'Landes', '40', 1),
(1155, 74, 'Loir et Cher', '41', 1),
(1156, 74, 'Loire', '42', 1),
(1157, 74, 'Haute Loire', '43', 1),
(1158, 74, 'Loire Atlantique', '44', 1),
(1159, 74, 'Loiret', '45', 1),
(1160, 74, 'Lot', '46', 1),
(1161, 74, 'Lot et Garonne', '47', 1),
(1162, 74, 'Loz&egrave;re', '48', 1),
(1163, 74, 'Maine et Loire', '49', 1),
(1164, 74, 'Manche', '50', 1),
(1165, 74, 'Marne', '51', 1),
(1166, 74, 'Haute Marne', '52', 1),
(1167, 74, 'Mayenne', '53', 1),
(1168, 74, 'Meurthe et Moselle', '54', 1),
(1169, 74, 'Meuse', '55', 1),
(1170, 74, 'Morbihan', '56', 1),
(1171, 74, 'Moselle', '57', 1),
(1172, 74, 'Ni&egrave;vre', '58', 1),
(1173, 74, 'Nord', '59', 1),
(1174, 74, 'Oise', '60', 1),
(1175, 74, 'Orne', '61', 1),
(1176, 74, 'Pas de Calais', '62', 1),
(1177, 74, 'Puy de D&ocirc;me', '63', 1),
(1178, 74, 'Pyr&eacute;n&eacute;es Atlantiques', '64', 1),
(1179, 74, 'Hautes Pyr&eacute;n&eacute;es', '65', 1),
(1180, 74, 'Pyr&eacute;n&eacute;es Orientales', '66', 1),
(1181, 74, 'Bas Rhin', '67', 1),
(1182, 74, 'Haut Rhin', '68', 1),
(1183, 74, 'Rh&ocirc;ne', '69', 1),
(1184, 74, 'Haute Sa&ocirc;ne', '70', 1),
(1185, 74, 'Sa&ocirc;ne et Loire', '71', 1),
(1186, 74, 'Sarthe', '72', 1),
(1187, 74, 'Savoie', '73', 1),
(1188, 74, 'Haute Savoie', '74', 1),
(1189, 74, 'Paris', '75', 1),
(1190, 74, 'Seine Maritime', '76', 1),
(1191, 74, 'Seine et Marne', '77', 1),
(1192, 74, 'Yvelines', '78', 1),
(1193, 74, 'Deux S&egrave;vres', '79', 1),
(1194, 74, 'Somme', '80', 1),
(1195, 74, 'Tarn', '81', 1),
(1196, 74, 'Tarn et Garonne', '82', 1),
(1197, 74, 'Var', '83', 1),
(1198, 74, 'Vaucluse', '84', 1),
(1199, 74, 'Vend&eacute;e', '85', 1),
(1200, 74, 'Vienne', '86', 1),
(1201, 74, 'Haute Vienne', '87', 1),
(1202, 74, 'Vosges', '88', 1),
(1203, 74, 'Yonne', '89', 1),
(1204, 74, 'Territoire de Belfort', '90', 1),
(1205, 74, 'Essonne', '91', 1),
(1206, 74, 'Hauts de Seine', '92', 1),
(1207, 74, 'Seine St-Denis', '93', 1),
(1208, 74, 'Val de Marne', '94', 1),
(1209, 74, 'Val d\'Oise', '95', 1),
(1210, 76, 'Archipel des Marquises', 'M', 1),
(1211, 76, 'Archipel des Tuamotu', 'T', 1),
(1212, 76, 'Archipel des Tubuai', 'I', 1),
(1213, 76, 'Iles du Vent', 'V', 1),
(1214, 76, 'Iles Sous-le-Vent', 'S', 1),
(1215, 77, 'Iles Crozet', 'C', 1),
(1216, 77, 'Iles Kerguelen', 'K', 1),
(1217, 77, 'Ile Amsterdam', 'A', 1),
(1218, 77, 'Ile Saint-Paul', 'P', 1),
(1219, 77, 'Adelie Land', 'D', 1),
(1220, 78, 'Estuaire', 'ES', 1),
(1221, 78, 'Haut-Ogooue', 'HO', 1),
(1222, 78, 'Moyen-Ogooue', 'MO', 1),
(1223, 78, 'Ngounie', 'NG', 1),
(1224, 78, 'Nyanga', 'NY', 1),
(1225, 78, 'Ogooue-Ivindo', 'OI', 1),
(1226, 78, 'Ogooue-Lolo', 'OL', 1),
(1227, 78, 'Ogooue-Maritime', 'OM', 1),
(1228, 78, 'Woleu-Ntem', 'WN', 1),
(1229, 79, 'Banjul', 'BJ', 1),
(1230, 79, 'Basse', 'BS', 1),
(1231, 79, 'Brikama', 'BR', 1),
(1232, 79, 'Janjangbure', 'JA', 1),
(1233, 79, 'Kanifeng', 'KA', 1),
(1234, 79, 'Kerewan', 'KE', 1),
(1235, 79, 'Kuntaur', 'KU', 1),
(1236, 79, 'Mansakonko', 'MA', 1),
(1237, 79, 'Lower River', 'LR', 1),
(1238, 79, 'Central River', 'CR', 1),
(1239, 79, 'North Bank', 'NB', 1),
(1240, 79, 'Upper River', 'UR', 1),
(1241, 79, 'Western', 'WE', 1),
(1242, 80, 'Abkhazia', 'AB', 1),
(1243, 80, 'Ajaria', 'AJ', 1),
(1244, 80, 'Tbilisi', 'TB', 1),
(1245, 80, 'Guria', 'GU', 1),
(1246, 80, 'Imereti', 'IM', 1),
(1247, 80, 'Kakheti', 'KA', 1),
(1248, 80, 'Kvemo Kartli', 'KK', 1),
(1249, 80, 'Mtskheta-Mtianeti', 'MM', 1),
(1250, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', 1),
(1251, 80, 'Samegrelo-Zemo Svaneti', 'SZ', 1),
(1252, 80, 'Samtskhe-Javakheti', 'SJ', 1),
(1253, 80, 'Shida Kartli', 'SK', 1),
(1254, 81, 'Baden-W&uuml;rttemberg', 'BAW', 1),
(1255, 81, 'Bayern', 'BAY', 1),
(1256, 81, 'Berlin', 'BER', 1),
(1257, 81, 'Brandenburg', 'BRG', 1),
(1258, 81, 'Bremen', 'BRE', 1),
(1259, 81, 'Hamburg', 'HAM', 1),
(1260, 81, 'Hessen', 'HES', 1),
(1261, 81, 'Mecklenburg-Vorpommern', 'MEC', 1),
(1262, 81, 'Niedersachsen', 'NDS', 1),
(1263, 81, 'Nordrhein-Westfalen', 'NRW', 1),
(1264, 81, 'Rheinland-Pfalz', 'RHE', 1),
(1265, 81, 'Saarland', 'SAR', 1),
(1266, 81, 'Sachsen', 'SAS', 1),
(1267, 81, 'Sachsen-Anhalt', 'SAC', 1),
(1268, 81, 'Schleswig-Holstein', 'SCN', 1),
(1269, 81, 'Th&uuml;ringen', 'THE', 1),
(1270, 82, 'Ashanti Region', 'AS', 1),
(1271, 82, 'Brong-Ahafo Region', 'BA', 1),
(1272, 82, 'Central Region', 'CE', 1),
(1273, 82, 'Eastern Region', 'EA', 1),
(1274, 82, 'Greater Accra Region', 'GA', 1),
(1275, 82, 'Northern Region', 'NO', 1),
(1276, 82, 'Upper East Region', 'UE', 1),
(1277, 82, 'Upper West Region', 'UW', 1),
(1278, 82, 'Volta Region', 'VO', 1),
(1279, 82, 'Western Region', 'WE', 1),
(1280, 84, 'Attica', 'AT', 1),
(1281, 84, 'Central Greece', 'CN', 1),
(1282, 84, 'Central Macedonia', 'CM', 1),
(1283, 84, 'Crete', 'CR', 1),
(1284, 84, 'East Macedonia and Thrace', 'EM', 1),
(1285, 84, 'Epirus', 'EP', 1),
(1286, 84, 'Ionian Islands', 'II', 1),
(1287, 84, 'North Aegean', 'NA', 1),
(1288, 84, 'Peloponnesos', 'PP', 1),
(1289, 84, 'South Aegean', 'SA', 1),
(1290, 84, 'Thessaly', 'TH', 1),
(1291, 84, 'West Greece', 'WG', 1),
(1292, 84, 'West Macedonia', 'WM', 1),
(1293, 85, 'Avannaa', 'A', 1),
(1294, 85, 'Tunu', 'T', 1),
(1295, 85, 'Kitaa', 'K', 1),
(1296, 86, 'Saint Andrew', 'A', 1),
(1297, 86, 'Saint David', 'D', 1),
(1298, 86, 'Saint George', 'G', 1),
(1299, 86, 'Saint John', 'J', 1),
(1300, 86, 'Saint Mark', 'M', 1),
(1301, 86, 'Saint Patrick', 'P', 1),
(1302, 86, 'Carriacou', 'C', 1),
(1303, 86, 'Petit Martinique', 'Q', 1),
(1304, 89, 'Alta Verapaz', 'AV', 1),
(1305, 89, 'Baja Verapaz', 'BV', 1),
(1306, 89, 'Chimaltenango', 'CM', 1),
(1307, 89, 'Chiquimula', 'CQ', 1),
(1308, 89, 'El Peten', 'PE', 1),
(1309, 89, 'El Progreso', 'PR', 1),
(1310, 89, 'El Quiche', 'QC', 1),
(1311, 89, 'Escuintla', 'ES', 1),
(1312, 89, 'Guatemala', 'GU', 1),
(1313, 89, 'Huehuetenango', 'HU', 1),
(1314, 89, 'Izabal', 'IZ', 1),
(1315, 89, 'Jalapa', 'JA', 1),
(1316, 89, 'Jutiapa', 'JU', 1),
(1317, 89, 'Quetzaltenango', 'QZ', 1),
(1318, 89, 'Retalhuleu', 'RE', 1),
(1319, 89, 'Sacatepequez', 'ST', 1),
(1320, 89, 'San Marcos', 'SM', 1),
(1321, 89, 'Santa Rosa', 'SR', 1),
(1322, 89, 'Solola', 'SO', 1),
(1323, 89, 'Suchitepequez', 'SU', 1),
(1324, 89, 'Totonicapan', 'TO', 1),
(1325, 89, 'Zacapa', 'ZA', 1),
(1326, 90, 'Conakry', 'CNK', 1),
(1327, 90, 'Beyla', 'BYL', 1),
(1328, 90, 'Boffa', 'BFA', 1),
(1329, 90, 'Boke', 'BOK', 1),
(1330, 90, 'Coyah', 'COY', 1),
(1331, 90, 'Dabola', 'DBL', 1),
(1332, 90, 'Dalaba', 'DLB', 1),
(1333, 90, 'Dinguiraye', 'DGR', 1),
(1334, 90, 'Dubreka', 'DBR', 1),
(1335, 90, 'Faranah', 'FRN', 1),
(1336, 90, 'Forecariah', 'FRC', 1),
(1337, 90, 'Fria', 'FRI', 1),
(1338, 90, 'Gaoual', 'GAO', 1),
(1339, 90, 'Gueckedou', 'GCD', 1),
(1340, 90, 'Kankan', 'KNK', 1),
(1341, 90, 'Kerouane', 'KRN', 1),
(1342, 90, 'Kindia', 'KND', 1),
(1343, 90, 'Kissidougou', 'KSD', 1),
(1344, 90, 'Koubia', 'KBA', 1),
(1345, 90, 'Koundara', 'KDA', 1),
(1346, 90, 'Kouroussa', 'KRA', 1),
(1347, 90, 'Labe', 'LAB', 1),
(1348, 90, 'Lelouma', 'LLM', 1),
(1349, 90, 'Lola', 'LOL', 1),
(1350, 90, 'Macenta', 'MCT', 1),
(1351, 90, 'Mali', 'MAL', 1),
(1352, 90, 'Mamou', 'MAM', 1),
(1353, 90, 'Mandiana', 'MAN', 1),
(1354, 90, 'Nzerekore', 'NZR', 1),
(1355, 90, 'Pita', 'PIT', 1),
(1356, 90, 'Siguiri', 'SIG', 1),
(1357, 90, 'Telimele', 'TLM', 1),
(1358, 90, 'Tougue', 'TOG', 1),
(1359, 90, 'Yomou', 'YOM', 1),
(1360, 91, 'Bafata Region', 'BF', 1),
(1361, 91, 'Biombo Region', 'BB', 1),
(1362, 91, 'Bissau Region', 'BS', 1),
(1363, 91, 'Bolama Region', 'BL', 1),
(1364, 91, 'Cacheu Region', 'CA', 1),
(1365, 91, 'Gabu Region', 'GA', 1),
(1366, 91, 'Oio Region', 'OI', 1),
(1367, 91, 'Quinara Region', 'QU', 1),
(1368, 91, 'Tombali Region', 'TO', 1),
(1369, 92, 'Barima-Waini', 'BW', 1),
(1370, 92, 'Cuyuni-Mazaruni', 'CM', 1),
(1371, 92, 'Demerara-Mahaica', 'DM', 1),
(1372, 92, 'East Berbice-Corentyne', 'EC', 1),
(1373, 92, 'Essequibo Islands-West Demerara', 'EW', 1),
(1374, 92, 'Mahaica-Berbice', 'MB', 1),
(1375, 92, 'Pomeroon-Supenaam', 'PM', 1),
(1376, 92, 'Potaro-Siparuni', 'PI', 1),
(1377, 92, 'Upper Demerara-Berbice', 'UD', 1),
(1378, 92, 'Upper Takutu-Upper Essequibo', 'UT', 1),
(1379, 93, 'Artibonite', 'AR', 1),
(1380, 93, 'Centre', 'CE', 1),
(1381, 93, 'Grand\'Anse', 'GA', 1),
(1382, 93, 'Nord', 'ND', 1),
(1383, 93, 'Nord-Est', 'NE', 1),
(1384, 93, 'Nord-Ouest', 'NO', 1),
(1385, 93, 'Ouest', 'OU', 1),
(1386, 93, 'Sud', 'SD', 1),
(1387, 93, 'Sud-Est', 'SE', 1),
(1388, 94, 'Flat Island', 'F', 1),
(1389, 94, 'McDonald Island', 'M', 1),
(1390, 94, 'Shag Island', 'S', 1),
(1391, 94, 'Heard Island', 'H', 1),
(1392, 95, 'Atlantida', 'AT', 1),
(1393, 95, 'Choluteca', 'CH', 1),
(1394, 95, 'Colon', 'CL', 1),
(1395, 95, 'Comayagua', 'CM', 1),
(1396, 95, 'Copan', 'CP', 1),
(1397, 95, 'Cortes', 'CR', 1),
(1398, 95, 'El Paraiso', 'PA', 1),
(1399, 95, 'Francisco Morazan', 'FM', 1),
(1400, 95, 'Gracias a Dios', 'GD', 1),
(1401, 95, 'Intibuca', 'IN', 1),
(1402, 95, 'Islas de la Bahia (Bay Islands)', 'IB', 1),
(1403, 95, 'La Paz', 'PZ', 1),
(1404, 95, 'Lempira', 'LE', 1),
(1405, 95, 'Ocotepeque', 'OC', 1),
(1406, 95, 'Olancho', 'OL', 1),
(1407, 95, 'Santa Barbara', 'SB', 1),
(1408, 95, 'Valle', 'VA', 1),
(1409, 95, 'Yoro', 'YO', 1),
(1410, 96, 'Central and Western Hong Kong Island', 'HCW', 1),
(1411, 96, 'Eastern Hong Kong Island', 'HEA', 1),
(1412, 96, 'Southern Hong Kong Island', 'HSO', 1),
(1413, 96, 'Wan Chai Hong Kong Island', 'HWC', 1),
(1414, 96, 'Kowloon City Kowloon', 'KKC', 1),
(1415, 96, 'Kwun Tong Kowloon', 'KKT', 1),
(1416, 96, 'Sham Shui Po Kowloon', 'KSS', 1),
(1417, 96, 'Wong Tai Sin Kowloon', 'KWT', 1),
(1418, 96, 'Yau Tsim Mong Kowloon', 'KYT', 1),
(1419, 96, 'Islands New Territories', 'NIS', 1),
(1420, 96, 'Kwai Tsing New Territories', 'NKT', 1),
(1421, 96, 'North New Territories', 'NNO', 1),
(1422, 96, 'Sai Kung New Territories', 'NSK', 1),
(1423, 96, 'Sha Tin New Territories', 'NST', 1),
(1424, 96, 'Tai Po New Territories', 'NTP', 1),
(1425, 96, 'Tsuen Wan New Territories', 'NTW', 1),
(1426, 96, 'Tuen Mun New Territories', 'NTM', 1),
(1427, 96, 'Yuen Long New Territories', 'NYL', 1),
(1467, 98, 'Austurland', 'AL', 1),
(1468, 98, 'Hofuoborgarsvaeoi', 'HF', 1),
(1469, 98, 'Norourland eystra', 'NE', 1),
(1470, 98, 'Norourland vestra', 'NV', 1),
(1471, 98, 'Suourland', 'SL', 1),
(1472, 98, 'Suournes', 'SN', 1),
(1473, 98, 'Vestfiroir', 'VF', 1),
(1474, 98, 'Vesturland', 'VL', 1),
(1475, 99, 'Andaman and Nicobar Islands', 'AN', 1),
(1476, 99, 'Andhra Pradesh', 'AP', 1),
(1477, 99, 'Arunachal Pradesh', 'AR', 1),
(1478, 99, 'Assam', 'AS', 1),
(1479, 99, 'Bihar', 'BI', 1),
(1480, 99, 'Chandigarh', 'CH', 1),
(1481, 99, 'Dadra and Nagar Haveli', 'DA', 1),
(1482, 99, 'Daman and Diu', 'DM', 1),
(1483, 99, 'Delhi', 'DE', 1),
(1484, 99, 'Goa', 'GO', 1),
(1485, 99, 'Gujarat', 'GU', 1),
(1486, 99, 'Haryana', 'HA', 1),
(1487, 99, 'Himachal Pradesh', 'HP', 1),
(1488, 99, 'Jammu and Kashmir', 'JA', 1),
(1489, 99, 'Karnataka', 'KA', 1),
(1490, 99, 'Kerala', 'KE', 1),
(1491, 99, 'Lakshadweep Islands', 'LI', 1),
(1492, 99, 'Madhya Pradesh', 'MP', 1),
(1493, 99, 'Maharashtra', 'MA', 1),
(1494, 99, 'Manipur', 'MN', 1),
(1495, 99, 'Meghalaya', 'ME', 1),
(1496, 99, 'Mizoram', 'MI', 1),
(1497, 99, 'Nagaland', 'NA', 1),
(1498, 99, 'Orissa', 'OR', 1),
(1499, 99, 'Pondicherry', 'PO', 1),
(1500, 99, 'Punjab', 'PU', 1),
(1501, 99, 'Rajasthan', 'RA', 1),
(1502, 99, 'Sikkim', 'SI', 1),
(1503, 99, 'Tamil Nadu', 'TN', 1),
(1504, 99, 'Tripura', 'TR', 1),
(1505, 99, 'Uttar Pradesh', 'UP', 1),
(1506, 99, 'West Bengal', 'WB', 1),
(1507, 100, 'Aceh', 'AC', 1),
(1508, 100, 'Bali', 'BA', 1),
(1509, 100, 'Banten', 'BT', 1),
(1510, 100, 'Bengkulu', 'BE', 1),
(1511, 100, 'BoDeTaBek', 'BD', 1),
(1512, 100, 'Gorontalo', 'GO', 1),
(1513, 100, 'Jakarta Raya', 'JK', 1),
(1514, 100, 'Jambi', 'JA', 1),
(1515, 100, 'Jawa Barat', 'JB', 1),
(1516, 100, 'Jawa Tengah', 'JT', 1),
(1517, 100, 'Jawa Timur', 'JI', 1),
(1518, 100, 'Kalimantan Barat', 'KB', 1),
(1519, 100, 'Kalimantan Selatan', 'KS', 1),
(1520, 100, 'Kalimantan Tengah', 'KT', 1),
(1521, 100, 'Kalimantan Timur', 'KI', 1),
(1522, 100, 'Kepulauan Bangka Belitung', 'BB', 1),
(1523, 100, 'Lampung', 'LA', 1),
(1524, 100, 'Maluku', 'MA', 1),
(1525, 100, 'Maluku Utara', 'MU', 1),
(1526, 100, 'Nusa Tenggara Barat', 'NB', 1),
(1527, 100, 'Nusa Tenggara Timur', 'NT', 1),
(1528, 100, 'Papua', 'PA', 1),
(1529, 100, 'Riau', 'RI', 1),
(1530, 100, 'Sulawesi Selatan', 'SN', 1),
(1531, 100, 'Sulawesi Tengah', 'ST', 1),
(1532, 100, 'Sulawesi Tenggara', 'SG', 1),
(1533, 100, 'Sulawesi Utara', 'SA', 1),
(1534, 100, 'Sumatera Barat', 'SB', 1),
(1535, 100, 'Sumatera Selatan', 'SS', 1),
(1536, 100, 'Sumatera Utara', 'SU', 1),
(1537, 100, 'Yogyakarta', 'YO', 1),
(1538, 101, 'Tehran', 'TEH', 1),
(1539, 101, 'Qom', 'QOM', 1),
(1540, 101, 'Markazi', 'MKZ', 1),
(1541, 101, 'Qazvin', 'QAZ', 1),
(1542, 101, 'Gilan', 'GIL', 1),
(1543, 101, 'Ardabil', 'ARD', 1),
(1544, 101, 'Zanjan', 'ZAN', 1),
(1545, 101, 'East Azarbaijan', 'EAZ', 1),
(1546, 101, 'West Azarbaijan', 'WEZ', 1),
(1547, 101, 'Kurdistan', 'KRD', 1),
(1548, 101, 'Hamadan', 'HMD', 1),
(1549, 101, 'Kermanshah', 'KRM', 1),
(1550, 101, 'Ilam', 'ILM', 1),
(1551, 101, 'Lorestan', 'LRS', 1),
(1552, 101, 'Khuzestan', 'KZT', 1),
(1553, 101, 'Chahar Mahaal and Bakhtiari', 'CMB', 1),
(1554, 101, 'Kohkiluyeh and Buyer Ahmad', 'KBA', 1),
(1555, 101, 'Bushehr', 'BSH', 1),
(1556, 101, 'Fars', 'FAR', 1),
(1557, 101, 'Hormozgan', 'HRM', 1),
(1558, 101, 'Sistan and Baluchistan', 'SBL', 1),
(1559, 101, 'Kerman', 'KRB', 1),
(1560, 101, 'Yazd', 'YZD', 1),
(1561, 101, 'Esfahan', 'EFH', 1),
(1562, 101, 'Semnan', 'SMN', 1),
(1563, 101, 'Mazandaran', 'MZD', 1),
(1564, 101, 'Golestan', 'GLS', 1),
(1565, 101, 'North Khorasan', 'NKH', 1),
(1566, 101, 'Razavi Khorasan', 'RKH', 1),
(1567, 101, 'South Khorasan', 'SKH', 1),
(1568, 102, 'Baghdad', 'BD', 1),
(1569, 102, 'Salah ad Din', 'SD', 1),
(1570, 102, 'Diyala', 'DY', 1),
(1571, 102, 'Wasit', 'WS', 1),
(1572, 102, 'Maysan', 'MY', 1),
(1573, 102, 'Al Basrah', 'BA', 1),
(1574, 102, 'Dhi Qar', 'DQ', 1),
(1575, 102, 'Al Muthanna', 'MU', 1),
(1576, 102, 'Al Qadisyah', 'QA', 1),
(1577, 102, 'Babil', 'BB', 1),
(1578, 102, 'Al Karbala', 'KB', 1),
(1579, 102, 'An Najaf', 'NJ', 1),
(1580, 102, 'Al Anbar', 'AB', 1),
(1581, 102, 'Ninawa', 'NN', 1),
(1582, 102, 'Dahuk', 'DH', 1),
(1583, 102, 'Arbil', 'AL', 1),
(1584, 102, 'At Ta\'mim', 'TM', 1),
(1585, 102, 'As Sulaymaniyah', 'SL', 1),
(1586, 103, 'Carlow', 'CA', 1),
(1587, 103, 'Cavan', 'CV', 1),
(1588, 103, 'Clare', 'CL', 1),
(1589, 103, 'Cork', 'CO', 1),
(1590, 103, 'Donegal', 'DO', 1),
(1591, 103, 'Dublin', 'DU', 1),
(1592, 103, 'Galway', 'GA', 1),
(1593, 103, 'Kerry', 'KE', 1),
(1594, 103, 'Kildare', 'KI', 1),
(1595, 103, 'Kilkenny', 'KL', 1),
(1596, 103, 'Laois', 'LA', 1),
(1597, 103, 'Leitrim', 'LE', 1),
(1598, 103, 'Limerick', 'LI', 1),
(1599, 103, 'Longford', 'LO', 1),
(1600, 103, 'Louth', 'LU', 1);
INSERT INTO `mcc_zone` (`zone_id`, `country_id`, `name`, `code`, `status`) VALUES
(1601, 103, 'Mayo', 'MA', 1),
(1602, 103, 'Meath', 'ME', 1),
(1603, 103, 'Monaghan', 'MO', 1),
(1604, 103, 'Offaly', 'OF', 1),
(1605, 103, 'Roscommon', 'RO', 1),
(1606, 103, 'Sligo', 'SL', 1),
(1607, 103, 'Tipperary', 'TI', 1),
(1608, 103, 'Waterford', 'WA', 1),
(1609, 103, 'Westmeath', 'WE', 1),
(1610, 103, 'Wexford', 'WX', 1),
(1611, 103, 'Wicklow', 'WI', 1),
(1612, 104, 'Be\'er Sheva', 'BS', 1),
(1613, 104, 'Bika\'at Hayarden', 'BH', 1),
(1614, 104, 'Eilat and Arava', 'EA', 1),
(1615, 104, 'Galil', 'GA', 1),
(1616, 104, 'Haifa', 'HA', 1),
(1617, 104, 'Jehuda Mountains', 'JM', 1),
(1618, 104, 'Jerusalem', 'JE', 1),
(1619, 104, 'Negev', 'NE', 1),
(1620, 104, 'Semaria', 'SE', 1),
(1621, 104, 'Sharon', 'SH', 1),
(1622, 104, 'Tel Aviv (Gosh Dan)', 'TA', 1),
(3860, 105, 'Caltanissetta', 'CL', 1),
(3842, 105, 'Agrigento', 'AG', 1),
(3843, 105, 'Alessandria', 'AL', 1),
(3844, 105, 'Ancona', 'AN', 1),
(3845, 105, 'Aosta', 'AO', 1),
(3846, 105, 'Arezzo', 'AR', 1),
(3847, 105, 'Ascoli Piceno', 'AP', 1),
(3848, 105, 'Asti', 'AT', 1),
(3849, 105, 'Avellino', 'AV', 1),
(3850, 105, 'Bari', 'BA', 1),
(3851, 105, 'Belluno', 'BL', 1),
(3852, 105, 'Benevento', 'BN', 1),
(3853, 105, 'Bergamo', 'BG', 1),
(3854, 105, 'Biella', 'BI', 1),
(3855, 105, 'Bologna', 'BO', 1),
(3856, 105, 'Bolzano', 'BZ', 1),
(3857, 105, 'Brescia', 'BS', 1),
(3858, 105, 'Brindisi', 'BR', 1),
(3859, 105, 'Cagliari', 'CA', 1),
(1643, 106, 'Clarendon Parish', 'CLA', 1),
(1644, 106, 'Hanover Parish', 'HAN', 1),
(1645, 106, 'Kingston Parish', 'KIN', 1),
(1646, 106, 'Manchester Parish', 'MAN', 1),
(1647, 106, 'Portland Parish', 'POR', 1),
(1648, 106, 'Saint Andrew Parish', 'AND', 1),
(1649, 106, 'Saint Ann Parish', 'ANN', 1),
(1650, 106, 'Saint Catherine Parish', 'CAT', 1),
(1651, 106, 'Saint Elizabeth Parish', 'ELI', 1),
(1652, 106, 'Saint James Parish', 'JAM', 1),
(1653, 106, 'Saint Mary Parish', 'MAR', 1),
(1654, 106, 'Saint Thomas Parish', 'THO', 1),
(1655, 106, 'Trelawny Parish', 'TRL', 1),
(1656, 106, 'Westmoreland Parish', 'WML', 1),
(1657, 107, 'Aichi', 'AI', 1),
(1658, 107, 'Akita', 'AK', 1),
(1659, 107, 'Aomori', 'AO', 1),
(1660, 107, 'Chiba', 'CH', 1),
(1661, 107, 'Ehime', 'EH', 1),
(1662, 107, 'Fukui', 'FK', 1),
(1663, 107, 'Fukuoka', 'FU', 1),
(1664, 107, 'Fukushima', 'FS', 1),
(1665, 107, 'Gifu', 'GI', 1),
(1666, 107, 'Gumma', 'GU', 1),
(1667, 107, 'Hiroshima', 'HI', 1),
(1668, 107, 'Hokkaido', 'HO', 1),
(1669, 107, 'Hyogo', 'HY', 1),
(1670, 107, 'Ibaraki', 'IB', 1),
(1671, 107, 'Ishikawa', 'IS', 1),
(1672, 107, 'Iwate', 'IW', 1),
(1673, 107, 'Kagawa', 'KA', 1),
(1674, 107, 'Kagoshima', 'KG', 1),
(1675, 107, 'Kanagawa', 'KN', 1),
(1676, 107, 'Kochi', 'KO', 1),
(1677, 107, 'Kumamoto', 'KU', 1),
(1678, 107, 'Kyoto', 'KY', 1),
(1679, 107, 'Mie', 'MI', 1),
(1680, 107, 'Miyagi', 'MY', 1),
(1681, 107, 'Miyazaki', 'MZ', 1),
(1682, 107, 'Nagano', 'NA', 1),
(1683, 107, 'Nagasaki', 'NG', 1),
(1684, 107, 'Nara', 'NR', 1),
(1685, 107, 'Niigata', 'NI', 1),
(1686, 107, 'Oita', 'OI', 1),
(1687, 107, 'Okayama', 'OK', 1),
(1688, 107, 'Okinawa', 'ON', 1),
(1689, 107, 'Osaka', 'OS', 1),
(1690, 107, 'Saga', 'SA', 1),
(1691, 107, 'Saitama', 'SI', 1),
(1692, 107, 'Shiga', 'SH', 1),
(1693, 107, 'Shimane', 'SM', 1),
(1694, 107, 'Shizuoka', 'SZ', 1),
(1695, 107, 'Tochigi', 'TO', 1),
(1696, 107, 'Tokushima', 'TS', 1),
(1697, 107, 'Tokyo', 'TK', 1),
(1698, 107, 'Tottori', 'TT', 1),
(1699, 107, 'Toyama', 'TY', 1),
(1700, 107, 'Wakayama', 'WA', 1),
(1701, 107, 'Yamagata', 'YA', 1),
(1702, 107, 'Yamaguchi', 'YM', 1),
(1703, 107, 'Yamanashi', 'YN', 1),
(1704, 108, '\'Amman', 'AM', 1),
(1705, 108, 'Ajlun', 'AJ', 1),
(1706, 108, 'Al \'Aqabah', 'AA', 1),
(1707, 108, 'Al Balqa\'', 'AB', 1),
(1708, 108, 'Al Karak', 'AK', 1),
(1709, 108, 'Al Mafraq', 'AL', 1),
(1710, 108, 'At Tafilah', 'AT', 1),
(1711, 108, 'Az Zarqa\'', 'AZ', 1),
(1712, 108, 'Irbid', 'IR', 1),
(1713, 108, 'Jarash', 'JA', 1),
(1714, 108, 'Ma\'an', 'MA', 1),
(1715, 108, 'Madaba', 'MD', 1),
(1716, 109, 'Almaty', 'AL', 1),
(1717, 109, 'Almaty City', 'AC', 1),
(1718, 109, 'Aqmola', 'AM', 1),
(1719, 109, 'Aqtobe', 'AQ', 1),
(1720, 109, 'Astana City', 'AS', 1),
(1721, 109, 'Atyrau', 'AT', 1),
(1722, 109, 'Batys Qazaqstan', 'BA', 1),
(1723, 109, 'Bayqongyr City', 'BY', 1),
(1724, 109, 'Mangghystau', 'MA', 1),
(1725, 109, 'Ongtustik Qazaqstan', 'ON', 1),
(1726, 109, 'Pavlodar', 'PA', 1),
(1727, 109, 'Qaraghandy', 'QA', 1),
(1728, 109, 'Qostanay', 'QO', 1),
(1729, 109, 'Qyzylorda', 'QY', 1),
(1730, 109, 'Shyghys Qazaqstan', 'SH', 1),
(1731, 109, 'Soltustik Qazaqstan', 'SO', 1),
(1732, 109, 'Zhambyl', 'ZH', 1),
(1733, 110, 'Central', 'CE', 1),
(1734, 110, 'Coast', 'CO', 1),
(1735, 110, 'Eastern', 'EA', 1),
(1736, 110, 'Nairobi Area', 'NA', 1),
(1737, 110, 'North Eastern', 'NE', 1),
(1738, 110, 'Nyanza', 'NY', 1),
(1739, 110, 'Rift Valley', 'RV', 1),
(1740, 110, 'Western', 'WE', 1),
(1741, 111, 'Abaiang', 'AG', 1),
(1742, 111, 'Abemama', 'AM', 1),
(1743, 111, 'Aranuka', 'AK', 1),
(1744, 111, 'Arorae', 'AO', 1),
(1745, 111, 'Banaba', 'BA', 1),
(1746, 111, 'Beru', 'BE', 1),
(1747, 111, 'Butaritari', 'bT', 1),
(1748, 111, 'Kanton', 'KA', 1),
(1749, 111, 'Kiritimati', 'KR', 1),
(1750, 111, 'Kuria', 'KU', 1),
(1751, 111, 'Maiana', 'MI', 1),
(1752, 111, 'Makin', 'MN', 1),
(1753, 111, 'Marakei', 'ME', 1),
(1754, 111, 'Nikunau', 'NI', 1),
(1755, 111, 'Nonouti', 'NO', 1),
(1756, 111, 'Onotoa', 'ON', 1),
(1757, 111, 'Tabiteuea', 'TT', 1),
(1758, 111, 'Tabuaeran', 'TR', 1),
(1759, 111, 'Tamana', 'TM', 1),
(1760, 111, 'Tarawa', 'TW', 1),
(1761, 111, 'Teraina', 'TE', 1),
(1762, 112, 'Chagang-do', 'CHA', 1),
(1763, 112, 'Hamgyong-bukto', 'HAB', 1),
(1764, 112, 'Hamgyong-namdo', 'HAN', 1),
(1765, 112, 'Hwanghae-bukto', 'HWB', 1),
(1766, 112, 'Hwanghae-namdo', 'HWN', 1),
(1767, 112, 'Kangwon-do', 'KAN', 1),
(1768, 112, 'P\'yongan-bukto', 'PYB', 1),
(1769, 112, 'P\'yongan-namdo', 'PYN', 1),
(1770, 112, 'Ryanggang-do (Yanggang-do)', 'YAN', 1),
(1771, 112, 'Rason Directly Governed City', 'NAJ', 1),
(1772, 112, 'P\'yongyang Special City', 'PYO', 1),
(1773, 113, 'Ch\'ungch\'ong-bukto', 'CO', 1),
(1774, 113, 'Ch\'ungch\'ong-namdo', 'CH', 1),
(1775, 113, 'Cheju-do', 'CD', 1),
(1776, 113, 'Cholla-bukto', 'CB', 1),
(1777, 113, 'Cholla-namdo', 'CN', 1),
(1778, 113, 'Inch\'on-gwangyoksi', 'IG', 1),
(1779, 113, 'Kangwon-do', 'KA', 1),
(1780, 113, 'Kwangju-gwangyoksi', 'KG', 1),
(1781, 113, 'Kyonggi-do', 'KD', 1),
(1782, 113, 'Kyongsang-bukto', 'KB', 1),
(1783, 113, 'Kyongsang-namdo', 'KN', 1),
(1784, 113, 'Pusan-gwangyoksi', 'PG', 1),
(1785, 113, 'Soul-t\'ukpyolsi', 'SO', 1),
(1786, 113, 'Taegu-gwangyoksi', 'TA', 1),
(1787, 113, 'Taejon-gwangyoksi', 'TG', 1),
(1788, 114, 'Al \'Asimah', 'AL', 1),
(1789, 114, 'Al Ahmadi', 'AA', 1),
(1790, 114, 'Al Farwaniyah', 'AF', 1),
(1791, 114, 'Al Jahra\'', 'AJ', 1),
(1792, 114, 'Hawalli', 'HA', 1),
(1793, 115, 'Bishkek', 'GB', 1),
(1794, 115, 'Batken', 'B', 1),
(1795, 115, 'Chu', 'C', 1),
(1796, 115, 'Jalal-Abad', 'J', 1),
(1797, 115, 'Naryn', 'N', 1),
(1798, 115, 'Osh', 'O', 1),
(1799, 115, 'Talas', 'T', 1),
(1800, 115, 'Ysyk-Kol', 'Y', 1),
(1801, 116, 'Vientiane', 'VT', 1),
(1802, 116, 'Attapu', 'AT', 1),
(1803, 116, 'Bokeo', 'BK', 1),
(1804, 116, 'Bolikhamxai', 'BL', 1),
(1805, 116, 'Champasak', 'CH', 1),
(1806, 116, 'Houaphan', 'HO', 1),
(1807, 116, 'Khammouan', 'KH', 1),
(1808, 116, 'Louang Namtha', 'LM', 1),
(1809, 116, 'Louangphabang', 'LP', 1),
(1810, 116, 'Oudomxai', 'OU', 1),
(1811, 116, 'Phongsali', 'PH', 1),
(1812, 116, 'Salavan', 'SL', 1),
(1813, 116, 'Savannakhet', 'SV', 1),
(1814, 116, 'Vientiane', 'VI', 1),
(1815, 116, 'Xaignabouli', 'XA', 1),
(1816, 116, 'Xekong', 'XE', 1),
(1817, 116, 'Xiangkhoang', 'XI', 1),
(1818, 116, 'Xaisomboun', 'XN', 1),
(1852, 119, 'Berea', 'BE', 1),
(1853, 119, 'Butha-Buthe', 'BB', 1),
(1854, 119, 'Leribe', 'LE', 1),
(1855, 119, 'Mafeteng', 'MF', 1),
(1856, 119, 'Maseru', 'MS', 1),
(1857, 119, 'Mohale\'s Hoek', 'MH', 1),
(1858, 119, 'Mokhotlong', 'MK', 1),
(1859, 119, 'Qacha\'s Nek', 'QN', 1),
(1860, 119, 'Quthing', 'QT', 1),
(1861, 119, 'Thaba-Tseka', 'TT', 1),
(1862, 120, 'Bomi', 'BI', 1),
(1863, 120, 'Bong', 'BG', 1),
(1864, 120, 'Grand Bassa', 'GB', 1),
(1865, 120, 'Grand Cape Mount', 'CM', 1),
(1866, 120, 'Grand Gedeh', 'GG', 1),
(1867, 120, 'Grand Kru', 'GK', 1),
(1868, 120, 'Lofa', 'LO', 1),
(1869, 120, 'Margibi', 'MG', 1),
(1870, 120, 'Maryland', 'ML', 1),
(1871, 120, 'Montserrado', 'MS', 1),
(1872, 120, 'Nimba', 'NB', 1),
(1873, 120, 'River Cess', 'RC', 1),
(1874, 120, 'Sinoe', 'SN', 1),
(1875, 121, 'Ajdabiya', 'AJ', 1),
(1876, 121, 'Al \'Aziziyah', 'AZ', 1),
(1877, 121, 'Al Fatih', 'FA', 1),
(1878, 121, 'Al Jabal al Akhdar', 'JA', 1),
(1879, 121, 'Al Jufrah', 'JU', 1),
(1880, 121, 'Al Khums', 'KH', 1),
(1881, 121, 'Al Kufrah', 'KU', 1),
(1882, 121, 'An Nuqat al Khams', 'NK', 1),
(1883, 121, 'Ash Shati\'', 'AS', 1),
(1884, 121, 'Awbari', 'AW', 1),
(1885, 121, 'Az Zawiyah', 'ZA', 1),
(1886, 121, 'Banghazi', 'BA', 1),
(1887, 121, 'Darnah', 'DA', 1),
(1888, 121, 'Ghadamis', 'GD', 1),
(1889, 121, 'Gharyan', 'GY', 1),
(1890, 121, 'Misratah', 'MI', 1),
(1891, 121, 'Murzuq', 'MZ', 1),
(1892, 121, 'Sabha', 'SB', 1),
(1893, 121, 'Sawfajjin', 'SW', 1),
(1894, 121, 'Surt', 'SU', 1),
(1895, 121, 'Tarabulus (Tripoli)', 'TL', 1),
(1896, 121, 'Tarhunah', 'TH', 1),
(1897, 121, 'Tubruq', 'TU', 1),
(1898, 121, 'Yafran', 'YA', 1),
(1899, 121, 'Zlitan', 'ZL', 1),
(1900, 122, 'Vaduz', 'V', 1),
(1901, 122, 'Schaan', 'A', 1),
(1902, 122, 'Balzers', 'B', 1),
(1903, 122, 'Triesen', 'N', 1),
(1904, 122, 'Eschen', 'E', 1),
(1905, 122, 'Mauren', 'M', 1),
(1906, 122, 'Triesenberg', 'T', 1),
(1907, 122, 'Ruggell', 'R', 1),
(1908, 122, 'Gamprin', 'G', 1),
(1909, 122, 'Schellenberg', 'L', 1),
(1910, 122, 'Planken', 'P', 1),
(1911, 123, 'Alytus', 'AL', 1),
(1912, 123, 'Kaunas', 'KA', 1),
(1913, 123, 'Klaipeda', 'KL', 1),
(1914, 123, 'Marijampole', 'MA', 1),
(1915, 123, 'Panevezys', 'PA', 1),
(1916, 123, 'Siauliai', 'SI', 1),
(1917, 123, 'Taurage', 'TA', 1),
(1918, 123, 'Telsiai', 'TE', 1),
(1919, 123, 'Utena', 'UT', 1),
(1920, 123, 'Vilnius', 'VI', 1),
(1921, 124, 'Diekirch', 'DD', 1),
(1922, 124, 'Clervaux', 'DC', 1),
(1923, 124, 'Redange', 'DR', 1),
(1924, 124, 'Vianden', 'DV', 1),
(1925, 124, 'Wiltz', 'DW', 1),
(1926, 124, 'Grevenmacher', 'GG', 1),
(1927, 124, 'Echternach', 'GE', 1),
(1928, 124, 'Remich', 'GR', 1),
(1929, 124, 'Luxembourg', 'LL', 1),
(1930, 124, 'Capellen', 'LC', 1),
(1931, 124, 'Esch-sur-Alzette', 'LE', 1),
(1932, 124, 'Mersch', 'LM', 1),
(1933, 125, 'Our Lady Fatima Parish', 'OLF', 1),
(1934, 125, 'St. Anthony Parish', 'ANT', 1),
(1935, 125, 'St. Lazarus Parish', 'LAZ', 1),
(1936, 125, 'Cathedral Parish', 'CAT', 1),
(1937, 125, 'St. Lawrence Parish', 'LAW', 1),
(1938, 127, 'Antananarivo', 'AN', 1),
(1939, 127, 'Antsiranana', 'AS', 1),
(1940, 127, 'Fianarantsoa', 'FN', 1),
(1941, 127, 'Mahajanga', 'MJ', 1),
(1942, 127, 'Toamasina', 'TM', 1),
(1943, 127, 'Toliara', 'TL', 1),
(1944, 128, 'Balaka', 'BLK', 1),
(1945, 128, 'Blantyre', 'BLT', 1),
(1946, 128, 'Chikwawa', 'CKW', 1),
(1947, 128, 'Chiradzulu', 'CRD', 1),
(1948, 128, 'Chitipa', 'CTP', 1),
(1949, 128, 'Dedza', 'DDZ', 1),
(1950, 128, 'Dowa', 'DWA', 1),
(1951, 128, 'Karonga', 'KRG', 1),
(1952, 128, 'Kasungu', 'KSG', 1),
(1953, 128, 'Likoma', 'LKM', 1),
(1954, 128, 'Lilongwe', 'LLG', 1),
(1955, 128, 'Machinga', 'MCG', 1),
(1956, 128, 'Mangochi', 'MGC', 1),
(1957, 128, 'Mchinji', 'MCH', 1),
(1958, 128, 'Mulanje', 'MLJ', 1),
(1959, 128, 'Mwanza', 'MWZ', 1),
(1960, 128, 'Mzimba', 'MZM', 1),
(1961, 128, 'Ntcheu', 'NTU', 1),
(1962, 128, 'Nkhata Bay', 'NKB', 1),
(1963, 128, 'Nkhotakota', 'NKH', 1),
(1964, 128, 'Nsanje', 'NSJ', 1),
(1965, 128, 'Ntchisi', 'NTI', 1),
(1966, 128, 'Phalombe', 'PHL', 1),
(1967, 128, 'Rumphi', 'RMP', 1),
(1968, 128, 'Salima', 'SLM', 1),
(1969, 128, 'Thyolo', 'THY', 1),
(1970, 128, 'Zomba', 'ZBA', 1),
(1971, 129, 'Johor', 'MY-01', 1),
(1972, 129, 'Kedah', 'MY-02', 1),
(1973, 129, 'Kelantan', 'MY-03', 1),
(1974, 129, 'Labuan', 'MY-15', 1),
(1975, 129, 'Melaka', 'MY-04', 1),
(1976, 129, 'Negeri Sembilan', 'MY-05', 1),
(1977, 129, 'Pahang', 'MY-06', 1),
(1978, 129, 'Perak', 'MY-08', 1),
(1979, 129, 'Perlis', 'MY-09', 1),
(1980, 129, 'Pulau Pinang', 'MY-07', 1),
(1981, 129, 'Sabah', 'MY-12', 1),
(1982, 129, 'Sarawak', 'MY-13', 1),
(1983, 129, 'Selangor', 'MY-10', 1),
(1984, 129, 'Terengganu', 'MY-11', 1),
(1985, 129, 'Kuala Lumpur', 'MY-14', 1),
(4035, 129, 'Putrajaya', 'MY-16', 1),
(1986, 130, 'Thiladhunmathi Uthuru', 'THU', 1),
(1987, 130, 'Thiladhunmathi Dhekunu', 'THD', 1),
(1988, 130, 'Miladhunmadulu Uthuru', 'MLU', 1),
(1989, 130, 'Miladhunmadulu Dhekunu', 'MLD', 1),
(1990, 130, 'Maalhosmadulu Uthuru', 'MAU', 1),
(1991, 130, 'Maalhosmadulu Dhekunu', 'MAD', 1),
(1992, 130, 'Faadhippolhu', 'FAA', 1),
(1993, 130, 'Male Atoll', 'MAA', 1),
(1994, 130, 'Ari Atoll Uthuru', 'AAU', 1),
(1995, 130, 'Ari Atoll Dheknu', 'AAD', 1),
(1996, 130, 'Felidhe Atoll', 'FEA', 1),
(1997, 130, 'Mulaku Atoll', 'MUA', 1),
(1998, 130, 'Nilandhe Atoll Uthuru', 'NAU', 1),
(1999, 130, 'Nilandhe Atoll Dhekunu', 'NAD', 1),
(2000, 130, 'Kolhumadulu', 'KLH', 1),
(2001, 130, 'Hadhdhunmathi', 'HDH', 1),
(2002, 130, 'Huvadhu Atoll Uthuru', 'HAU', 1),
(2003, 130, 'Huvadhu Atoll Dhekunu', 'HAD', 1),
(2004, 130, 'Fua Mulaku', 'FMU', 1),
(2005, 130, 'Addu', 'ADD', 1),
(2006, 131, 'Gao', 'GA', 1),
(2007, 131, 'Kayes', 'KY', 1),
(2008, 131, 'Kidal', 'KD', 1),
(2009, 131, 'Koulikoro', 'KL', 1),
(2010, 131, 'Mopti', 'MP', 1),
(2011, 131, 'Segou', 'SG', 1),
(2012, 131, 'Sikasso', 'SK', 1),
(2013, 131, 'Tombouctou', 'TB', 1),
(2014, 131, 'Bamako Capital District', 'CD', 1),
(2015, 132, 'Attard', 'ATT', 1),
(2016, 132, 'Balzan', 'BAL', 1),
(2017, 132, 'Birgu', 'BGU', 1),
(2018, 132, 'Birkirkara', 'BKK', 1),
(2019, 132, 'Birzebbuga', 'BRZ', 1),
(2020, 132, 'Bormla', 'BOR', 1),
(2021, 132, 'Dingli', 'DIN', 1),
(2022, 132, 'Fgura', 'FGU', 1),
(2023, 132, 'Floriana', 'FLO', 1),
(2024, 132, 'Gudja', 'GDJ', 1),
(2025, 132, 'Gzira', 'GZR', 1),
(2026, 132, 'Gargur', 'GRG', 1),
(2027, 132, 'Gaxaq', 'GXQ', 1),
(2028, 132, 'Hamrun', 'HMR', 1),
(2029, 132, 'Iklin', 'IKL', 1),
(2030, 132, 'Isla', 'ISL', 1),
(2031, 132, 'Kalkara', 'KLK', 1),
(2032, 132, 'Kirkop', 'KRK', 1),
(2033, 132, 'Lija', 'LIJ', 1),
(2034, 132, 'Luqa', 'LUQ', 1),
(2035, 132, 'Marsa', 'MRS', 1),
(2036, 132, 'Marsaskala', 'MKL', 1),
(2037, 132, 'Marsaxlokk', 'MXL', 1),
(2038, 132, 'Mdina', 'MDN', 1),
(2039, 132, 'Melliea', 'MEL', 1),
(2040, 132, 'Mgarr', 'MGR', 1),
(2041, 132, 'Mosta', 'MST', 1),
(2042, 132, 'Mqabba', 'MQA', 1),
(2043, 132, 'Msida', 'MSI', 1),
(2044, 132, 'Mtarfa', 'MTF', 1),
(2045, 132, 'Naxxar', 'NAX', 1),
(2046, 132, 'Paola', 'PAO', 1),
(2047, 132, 'Pembroke', 'PEM', 1),
(2048, 132, 'Pieta', 'PIE', 1),
(2049, 132, 'Qormi', 'QOR', 1),
(2050, 132, 'Qrendi', 'QRE', 1),
(2051, 132, 'Rabat', 'RAB', 1),
(2052, 132, 'Safi', 'SAF', 1),
(2053, 132, 'San Giljan', 'SGI', 1),
(2054, 132, 'Santa Lucija', 'SLU', 1),
(2055, 132, 'San Pawl il-Bahar', 'SPB', 1),
(2056, 132, 'San Gwann', 'SGW', 1),
(2057, 132, 'Santa Venera', 'SVE', 1),
(2058, 132, 'Siggiewi', 'SIG', 1),
(2059, 132, 'Sliema', 'SLM', 1),
(2060, 132, 'Swieqi', 'SWQ', 1),
(2061, 132, 'Ta Xbiex', 'TXB', 1),
(2062, 132, 'Tarxien', 'TRX', 1),
(2063, 132, 'Valletta', 'VLT', 1),
(2064, 132, 'Xgajra', 'XGJ', 1),
(2065, 132, 'Zabbar', 'ZBR', 1),
(2066, 132, 'Zebbug', 'ZBG', 1),
(2067, 132, 'Zejtun', 'ZJT', 1),
(2068, 132, 'Zurrieq', 'ZRQ', 1),
(2069, 132, 'Fontana', 'FNT', 1),
(2070, 132, 'Ghajnsielem', 'GHJ', 1),
(2071, 132, 'Gharb', 'GHR', 1),
(2072, 132, 'Ghasri', 'GHS', 1),
(2073, 132, 'Kercem', 'KRC', 1),
(2074, 132, 'Munxar', 'MUN', 1),
(2075, 132, 'Nadur', 'NAD', 1),
(2076, 132, 'Qala', 'QAL', 1),
(2077, 132, 'Victoria', 'VIC', 1),
(2078, 132, 'San Lawrenz', 'SLA', 1),
(2079, 132, 'Sannat', 'SNT', 1),
(2080, 132, 'Xagra', 'ZAG', 1),
(2081, 132, 'Xewkija', 'XEW', 1),
(2082, 132, 'Zebbug', 'ZEB', 1),
(2083, 133, 'Ailinginae', 'ALG', 1),
(2084, 133, 'Ailinglaplap', 'ALL', 1),
(2085, 133, 'Ailuk', 'ALK', 1),
(2086, 133, 'Arno', 'ARN', 1),
(2087, 133, 'Aur', 'AUR', 1),
(2088, 133, 'Bikar', 'BKR', 1),
(2089, 133, 'Bikini', 'BKN', 1),
(2090, 133, 'Bokak', 'BKK', 1),
(2091, 133, 'Ebon', 'EBN', 1),
(2092, 133, 'Enewetak', 'ENT', 1),
(2093, 133, 'Erikub', 'EKB', 1),
(2094, 133, 'Jabat', 'JBT', 1),
(2095, 133, 'Jaluit', 'JLT', 1),
(2096, 133, 'Jemo', 'JEM', 1),
(2097, 133, 'Kili', 'KIL', 1),
(2098, 133, 'Kwajalein', 'KWJ', 1),
(2099, 133, 'Lae', 'LAE', 1),
(2100, 133, 'Lib', 'LIB', 1),
(2101, 133, 'Likiep', 'LKP', 1),
(2102, 133, 'Majuro', 'MJR', 1),
(2103, 133, 'Maloelap', 'MLP', 1),
(2104, 133, 'Mejit', 'MJT', 1),
(2105, 133, 'Mili', 'MIL', 1),
(2106, 133, 'Namorik', 'NMK', 1),
(2107, 133, 'Namu', 'NAM', 1),
(2108, 133, 'Rongelap', 'RGL', 1),
(2109, 133, 'Rongrik', 'RGK', 1),
(2110, 133, 'Toke', 'TOK', 1),
(2111, 133, 'Ujae', 'UJA', 1),
(2112, 133, 'Ujelang', 'UJL', 1),
(2113, 133, 'Utirik', 'UTK', 1),
(2114, 133, 'Wotho', 'WTH', 1),
(2115, 133, 'Wotje', 'WTJ', 1),
(2116, 135, 'Adrar', 'AD', 1),
(2117, 135, 'Assaba', 'AS', 1),
(2118, 135, 'Brakna', 'BR', 1),
(2119, 135, 'Dakhlet Nouadhibou', 'DN', 1),
(2120, 135, 'Gorgol', 'GO', 1),
(2121, 135, 'Guidimaka', 'GM', 1),
(2122, 135, 'Hodh Ech Chargui', 'HC', 1),
(2123, 135, 'Hodh El Gharbi', 'HG', 1),
(2124, 135, 'Inchiri', 'IN', 1),
(2125, 135, 'Tagant', 'TA', 1),
(2126, 135, 'Tiris Zemmour', 'TZ', 1),
(2127, 135, 'Trarza', 'TR', 1),
(2128, 135, 'Nouakchott', 'NO', 1),
(2129, 136, 'Beau Bassin-Rose Hill', 'BR', 1),
(2130, 136, 'Curepipe', 'CU', 1),
(2131, 136, 'Port Louis', 'PU', 1),
(2132, 136, 'Quatre Bornes', 'QB', 1),
(2133, 136, 'Vacoas-Phoenix', 'VP', 1),
(2134, 136, 'Agalega Islands', 'AG', 1),
(2135, 136, 'Cargados Carajos Shoals (Saint Brandon Islands)', 'CC', 1),
(2136, 136, 'Rodrigues', 'RO', 1),
(2137, 136, 'Black River', 'BL', 1),
(2138, 136, 'Flacq', 'FL', 1),
(2139, 136, 'Grand Port', 'GP', 1),
(2140, 136, 'Moka', 'MO', 1),
(2141, 136, 'Pamplemousses', 'PA', 1),
(2142, 136, 'Plaines Wilhems', 'PW', 1),
(2143, 136, 'Port Louis', 'PL', 1),
(2144, 136, 'Riviere du Rempart', 'RR', 1),
(2145, 136, 'Savanne', 'SA', 1),
(2146, 138, 'Baja California Norte', 'BN', 1),
(2147, 138, 'Baja California Sur', 'BS', 1),
(2148, 138, 'Campeche', 'CA', 1),
(2149, 138, 'Chiapas', 'CI', 1),
(2150, 138, 'Chihuahua', 'CH', 1),
(2151, 138, 'Coahuila de Zaragoza', 'CZ', 1),
(2152, 138, 'Colima', 'CL', 1),
(2153, 138, 'Distrito Federal', 'DF', 1),
(2154, 138, 'Durango', 'DU', 1),
(2155, 138, 'Guanajuato', 'GA', 1),
(2156, 138, 'Guerrero', 'GE', 1),
(2157, 138, 'Hidalgo', 'HI', 1),
(2158, 138, 'Jalisco', 'JA', 1),
(2159, 138, 'Mexico', 'ME', 1),
(2160, 138, 'Michoacan de Ocampo', 'MI', 1),
(2161, 138, 'Morelos', 'MO', 1),
(2162, 138, 'Nayarit', 'NA', 1),
(2163, 138, 'Nuevo Leon', 'NL', 1),
(2164, 138, 'Oaxaca', 'OA', 1),
(2165, 138, 'Puebla', 'PU', 1),
(2166, 138, 'Queretaro de Arteaga', 'QA', 1),
(2167, 138, 'Quintana Roo', 'QR', 1),
(2168, 138, 'San Luis Potosi', 'SA', 1),
(2169, 138, 'Sinaloa', 'SI', 1),
(2170, 138, 'Sonora', 'SO', 1),
(2171, 138, 'Tabasco', 'TB', 1),
(2172, 138, 'Tamaulipas', 'TM', 1),
(2173, 138, 'Tlaxcala', 'TL', 1),
(2174, 138, 'Veracruz-Llave', 'VE', 1),
(2175, 138, 'Yucatan', 'YU', 1),
(2176, 138, 'Zacatecas', 'ZA', 1),
(2177, 139, 'Chuuk', 'C', 1),
(2178, 139, 'Kosrae', 'K', 1),
(2179, 139, 'Pohnpei', 'P', 1),
(2180, 139, 'Yap', 'Y', 1),
(2181, 140, 'Gagauzia', 'GA', 1),
(2182, 140, 'Chisinau', 'CU', 1),
(2183, 140, 'Balti', 'BA', 1),
(2184, 140, 'Cahul', 'CA', 1),
(2185, 140, 'Edinet', 'ED', 1),
(2186, 140, 'Lapusna', 'LA', 1),
(2187, 140, 'Orhei', 'OR', 1),
(2188, 140, 'Soroca', 'SO', 1),
(2189, 140, 'Tighina', 'TI', 1),
(2190, 140, 'Ungheni', 'UN', 1),
(2191, 140, 'St‚nga Nistrului', 'SN', 1),
(2192, 141, 'Fontvieille', 'FV', 1),
(2193, 141, 'La Condamine', 'LC', 1),
(2194, 141, 'Monaco-Ville', 'MV', 1),
(2195, 141, 'Monte-Carlo', 'MC', 1),
(2196, 142, 'Ulanbaatar', '1', 1),
(2197, 142, 'Orhon', '035', 1),
(2198, 142, 'Darhan uul', '037', 1),
(2199, 142, 'Hentiy', '039', 1),
(2200, 142, 'Hovsgol', '041', 1),
(2201, 142, 'Hovd', '043', 1),
(2202, 142, 'Uvs', '046', 1),
(2203, 142, 'Tov', '047', 1),
(2204, 142, 'Selenge', '049', 1),
(2205, 142, 'Suhbaatar', '051', 1),
(2206, 142, 'Omnogovi', '053', 1),
(2207, 142, 'Ovorhangay', '055', 1),
(2208, 142, 'Dzavhan', '057', 1),
(2209, 142, 'DundgovL', '059', 1),
(2210, 142, 'Dornod', '061', 1),
(2211, 142, 'Dornogov', '063', 1),
(2212, 142, 'Govi-Sumber', '064', 1),
(2213, 142, 'Govi-Altay', '065', 1),
(2214, 142, 'Bulgan', '067', 1),
(2215, 142, 'Bayanhongor', '069', 1),
(2216, 142, 'Bayan-Olgiy', '071', 1),
(2217, 142, 'Arhangay', '073', 1),
(2218, 143, 'Saint Anthony', 'A', 1),
(2219, 143, 'Saint Georges', 'G', 1),
(2220, 143, 'Saint Peter', 'P', 1),
(2221, 144, 'Agadir', 'AGD', 1),
(2222, 144, 'Al Hoceima', 'HOC', 1),
(2223, 144, 'Azilal', 'AZI', 1),
(2224, 144, 'Beni Mellal', 'BME', 1),
(2225, 144, 'Ben Slimane', 'BSL', 1),
(2226, 144, 'Boulemane', 'BLM', 1),
(2227, 144, 'Casablanca', 'CBL', 1),
(2228, 144, 'Chaouen', 'CHA', 1),
(2229, 144, 'El Jadida', 'EJA', 1),
(2230, 144, 'El Kelaa des Sraghna', 'EKS', 1),
(2231, 144, 'Er Rachidia', 'ERA', 1),
(2232, 144, 'Essaouira', 'ESS', 1),
(2233, 144, 'Fes', 'FES', 1),
(2234, 144, 'Figuig', 'FIG', 1),
(2235, 144, 'Guelmim', 'GLM', 1),
(2236, 144, 'Ifrane', 'IFR', 1),
(2237, 144, 'Kenitra', 'KEN', 1),
(2238, 144, 'Khemisset', 'KHM', 1),
(2239, 144, 'Khenifra', 'KHN', 1),
(2240, 144, 'Khouribga', 'KHO', 1),
(2241, 144, 'Laayoune', 'LYN', 1),
(2242, 144, 'Larache', 'LAR', 1),
(2243, 144, 'Marrakech', 'MRK', 1),
(2244, 144, 'Meknes', 'MKN', 1),
(2245, 144, 'Nador', 'NAD', 1),
(2246, 144, 'Ouarzazate', 'ORZ', 1),
(2247, 144, 'Oujda', 'OUJ', 1),
(2248, 144, 'Rabat-Sale', 'RSA', 1),
(2249, 144, 'Safi', 'SAF', 1),
(2250, 144, 'Settat', 'SET', 1),
(2251, 144, 'Sidi Kacem', 'SKA', 1),
(2252, 144, 'Tangier', 'TGR', 1),
(2253, 144, 'Tan-Tan', 'TAN', 1),
(2254, 144, 'Taounate', 'TAO', 1),
(2255, 144, 'Taroudannt', 'TRD', 1),
(2256, 144, 'Tata', 'TAT', 1),
(2257, 144, 'Taza', 'TAZ', 1),
(2258, 144, 'Tetouan', 'TET', 1),
(2259, 144, 'Tiznit', 'TIZ', 1),
(2260, 144, 'Ad Dakhla', 'ADK', 1),
(2261, 144, 'Boujdour', 'BJD', 1),
(2262, 144, 'Es Smara', 'ESM', 1),
(2263, 145, 'Cabo Delgado', 'CD', 1),
(2264, 145, 'Gaza', 'GZ', 1),
(2265, 145, 'Inhambane', 'IN', 1),
(2266, 145, 'Manica', 'MN', 1),
(2267, 145, 'Maputo (city)', 'MC', 1),
(2268, 145, 'Maputo', 'MP', 1),
(2269, 145, 'Nampula', 'NA', 1),
(2270, 145, 'Niassa', 'NI', 1),
(2271, 145, 'Sofala', 'SO', 1),
(2272, 145, 'Tete', 'TE', 1),
(2273, 145, 'Zambezia', 'ZA', 1),
(2274, 146, 'Ayeyarwady', 'AY', 1),
(2275, 146, 'Bago', 'BG', 1),
(2276, 146, 'Magway', 'MG', 1),
(2277, 146, 'Mandalay', 'MD', 1),
(2278, 146, 'Sagaing', 'SG', 1),
(2279, 146, 'Tanintharyi', 'TN', 1),
(2280, 146, 'Yangon', 'YG', 1),
(2281, 146, 'Chin State', 'CH', 1),
(2282, 146, 'Kachin State', 'KC', 1),
(2283, 146, 'Kayah State', 'KH', 1),
(2284, 146, 'Kayin State', 'KN', 1),
(2285, 146, 'Mon State', 'MN', 1),
(2286, 146, 'Rakhine State', 'RK', 1),
(2287, 146, 'Shan State', 'SH', 1),
(2288, 147, 'Caprivi', 'CA', 1),
(2289, 147, 'Erongo', 'ER', 1),
(2290, 147, 'Hardap', 'HA', 1),
(2291, 147, 'Karas', 'KR', 1),
(2292, 147, 'Kavango', 'KV', 1),
(2293, 147, 'Khomas', 'KH', 1),
(2294, 147, 'Kunene', 'KU', 1),
(2295, 147, 'Ohangwena', 'OW', 1),
(2296, 147, 'Omaheke', 'OK', 1),
(2297, 147, 'Omusati', 'OT', 1),
(2298, 147, 'Oshana', 'ON', 1),
(2299, 147, 'Oshikoto', 'OO', 1),
(2300, 147, 'Otjozondjupa', 'OJ', 1),
(2301, 148, 'Aiwo', 'AO', 1),
(2302, 148, 'Anabar', 'AA', 1),
(2303, 148, 'Anetan', 'AT', 1),
(2304, 148, 'Anibare', 'AI', 1),
(2305, 148, 'Baiti', 'BA', 1),
(2306, 148, 'Boe', 'BO', 1),
(2307, 148, 'Buada', 'BU', 1),
(2308, 148, 'Denigomodu', 'DE', 1),
(2309, 148, 'Ewa', 'EW', 1),
(2310, 148, 'Ijuw', 'IJ', 1),
(2311, 148, 'Meneng', 'ME', 1),
(2312, 148, 'Nibok', 'NI', 1),
(2313, 148, 'Uaboe', 'UA', 1),
(2314, 148, 'Yaren', 'YA', 1),
(2315, 149, 'Bagmati', 'BA', 1),
(2316, 149, 'Bheri', 'BH', 1),
(2317, 149, 'Dhawalagiri', 'DH', 1),
(2318, 149, 'Gandaki', 'GA', 1),
(2319, 149, 'Janakpur', 'JA', 1),
(2320, 149, 'Karnali', 'KA', 1),
(2321, 149, 'Kosi', 'KO', 1),
(2322, 149, 'Lumbini', 'LU', 1),
(2323, 149, 'Mahakali', 'MA', 1),
(2324, 149, 'Mechi', 'ME', 1),
(2325, 149, 'Narayani', 'NA', 1),
(2326, 149, 'Rapti', 'RA', 1),
(2327, 149, 'Sagarmatha', 'SA', 1),
(2328, 149, 'Seti', 'SE', 1),
(2329, 150, 'Drenthe', 'DR', 1),
(2330, 150, 'Flevoland', 'FL', 1),
(2331, 150, 'Friesland', 'FR', 1),
(2332, 150, 'Gelderland', 'GE', 1),
(2333, 150, 'Groningen', 'GR', 1),
(2334, 150, 'Limburg', 'LI', 1),
(2335, 150, 'Noord Brabant', 'NB', 1),
(2336, 150, 'Noord Holland', 'NH', 1),
(2337, 150, 'Overijssel', 'OV', 1),
(2338, 150, 'Utrecht', 'UT', 1),
(2339, 150, 'Zeeland', 'ZE', 1),
(2340, 150, 'Zuid Holland', 'ZH', 1),
(2341, 152, 'Iles Loyaute', 'L', 1),
(2342, 152, 'Nord', 'N', 1),
(2343, 152, 'Sud', 'S', 1),
(2344, 153, 'Auckland', 'AUK', 1),
(2345, 153, 'Bay of Plenty', 'BOP', 1),
(2346, 153, 'Canterbury', 'CAN', 1),
(2347, 153, 'Coromandel', 'COR', 1),
(2348, 153, 'Gisborne', 'GIS', 1),
(2349, 153, 'Fiordland', 'FIO', 1),
(2350, 153, 'Hawke\'s Bay', 'HKB', 1),
(2351, 153, 'Marlborough', 'MBH', 1),
(2352, 153, 'Manawatu-Wanganui', 'MWT', 1),
(2353, 153, 'Mt Cook-Mackenzie', 'MCM', 1),
(2354, 153, 'Nelson', 'NSN', 1),
(2355, 153, 'Northland', 'NTL', 1),
(2356, 153, 'Otago', 'OTA', 1),
(2357, 153, 'Southland', 'STL', 1),
(2358, 153, 'Taranaki', 'TKI', 1),
(2359, 153, 'Wellington', 'WGN', 1),
(2360, 153, 'Waikato', 'WKO', 1),
(2361, 153, 'Wairarapa', 'WAI', 1),
(2362, 153, 'West Coast', 'WTC', 1),
(2363, 154, 'Atlantico Norte', 'AN', 1),
(2364, 154, 'Atlantico Sur', 'AS', 1),
(2365, 154, 'Boaco', 'BO', 1),
(2366, 154, 'Carazo', 'CA', 1),
(2367, 154, 'Chinandega', 'CI', 1),
(2368, 154, 'Chontales', 'CO', 1),
(2369, 154, 'Esteli', 'ES', 1),
(2370, 154, 'Granada', 'GR', 1),
(2371, 154, 'Jinotega', 'JI', 1),
(2372, 154, 'Leon', 'LE', 1),
(2373, 154, 'Madriz', 'MD', 1),
(2374, 154, 'Managua', 'MN', 1),
(2375, 154, 'Masaya', 'MS', 1),
(2376, 154, 'Matagalpa', 'MT', 1),
(2377, 154, 'Nuevo Segovia', 'NS', 1),
(2378, 154, 'Rio San Juan', 'RS', 1),
(2379, 154, 'Rivas', 'RI', 1),
(2380, 155, 'Agadez', 'AG', 1),
(2381, 155, 'Diffa', 'DF', 1),
(2382, 155, 'Dosso', 'DS', 1),
(2383, 155, 'Maradi', 'MA', 1),
(2384, 155, 'Niamey', 'NM', 1),
(2385, 155, 'Tahoua', 'TH', 1),
(2386, 155, 'Tillaberi', 'TL', 1),
(2387, 155, 'Zinder', 'ZD', 1),
(2388, 156, 'Abia', 'AB', 1),
(2389, 156, 'Abuja Federal Capital Territory', 'CT', 1),
(2390, 156, 'Adamawa', 'AD', 1),
(2391, 156, 'Akwa Ibom', 'AK', 1),
(2392, 156, 'Anambra', 'AN', 1),
(2393, 156, 'Bauchi', 'BC', 1),
(2394, 156, 'Bayelsa', 'BY', 1),
(2395, 156, 'Benue', 'BN', 1),
(2396, 156, 'Borno', 'BO', 1),
(2397, 156, 'Cross River', 'CR', 1),
(2398, 156, 'Delta', 'DE', 1),
(2399, 156, 'Ebonyi', 'EB', 1),
(2400, 156, 'Edo', 'ED', 1),
(2401, 156, 'Ekiti', 'EK', 1),
(2402, 156, 'Enugu', 'EN', 1),
(2403, 156, 'Gombe', 'GO', 1),
(2404, 156, 'Imo', 'IM', 1),
(2405, 156, 'Jigawa', 'JI', 1),
(2406, 156, 'Kaduna', 'KD', 1),
(2407, 156, 'Kano', 'KN', 1),
(2408, 156, 'Katsina', 'KT', 1),
(2409, 156, 'Kebbi', 'KE', 1),
(2410, 156, 'Kogi', 'KO', 1),
(2411, 156, 'Kwara', 'KW', 1),
(2412, 156, 'Lagos', 'LA', 1),
(2413, 156, 'Nassarawa', 'NA', 1),
(2414, 156, 'Niger', 'NI', 1),
(2415, 156, 'Ogun', 'OG', 1),
(2416, 156, 'Ondo', 'ONG', 1),
(2417, 156, 'Osun', 'OS', 1),
(2418, 156, 'Oyo', 'OY', 1),
(2419, 156, 'Plateau', 'PL', 1),
(2420, 156, 'Rivers', 'RI', 1),
(2421, 156, 'Sokoto', 'SO', 1),
(2422, 156, 'Taraba', 'TA', 1),
(2423, 156, 'Yobe', 'YO', 1),
(2424, 156, 'Zamfara', 'ZA', 1),
(2425, 159, 'Northern Islands', 'N', 1),
(2426, 159, 'Rota', 'R', 1),
(2427, 159, 'Saipan', 'S', 1),
(2428, 159, 'Tinian', 'T', 1),
(2429, 160, 'Akershus', 'AK', 1),
(2430, 160, 'Aust-Agder', 'AA', 1),
(2431, 160, 'Buskerud', 'BU', 1),
(2432, 160, 'Finnmark', 'FM', 1),
(2433, 160, 'Hedmark', 'HM', 1),
(2434, 160, 'Hordaland', 'HL', 1),
(2435, 160, 'More og Romdal', 'MR', 1),
(2436, 160, 'Nord-Trondelag', 'NT', 1),
(2437, 160, 'Nordland', 'NL', 1),
(2438, 160, 'Ostfold', 'OF', 1),
(2439, 160, 'Oppland', 'OP', 1),
(2440, 160, 'Oslo', 'OL', 1),
(2441, 160, 'Rogaland', 'RL', 1),
(2442, 160, 'Sor-Trondelag', 'ST', 1),
(2443, 160, 'Sogn og Fjordane', 'SJ', 1),
(2444, 160, 'Svalbard', 'SV', 1),
(2445, 160, 'Telemark', 'TM', 1),
(2446, 160, 'Troms', 'TR', 1),
(2447, 160, 'Vest-Agder', 'VA', 1),
(2448, 160, 'Vestfold', 'VF', 1),
(2449, 161, 'Ad Dakhiliyah', 'DA', 1),
(2450, 161, 'Al Batinah', 'BA', 1),
(2451, 161, 'Al Wusta', 'WU', 1),
(2452, 161, 'Ash Sharqiyah', 'SH', 1),
(2453, 161, 'Az Zahirah', 'ZA', 1),
(2454, 161, 'Masqat', 'MA', 1),
(2455, 161, 'Musandam', 'MU', 1),
(2456, 161, 'Zufar', 'ZU', 1),
(2457, 162, 'Balochistan', 'B', 1),
(2458, 162, 'Federally Administered Tribal Areas', 'T', 1),
(2459, 162, 'Islamabad Capital Territory', 'I', 1),
(2460, 162, 'North-West Frontier', 'N', 1),
(2461, 162, 'Punjab', 'P', 1),
(2462, 162, 'Sindh', 'S', 1),
(2463, 163, 'Aimeliik', 'AM', 1),
(2464, 163, 'Airai', 'AR', 1),
(2465, 163, 'Angaur', 'AN', 1),
(2466, 163, 'Hatohobei', 'HA', 1),
(2467, 163, 'Kayangel', 'KA', 1),
(2468, 163, 'Koror', 'KO', 1),
(2469, 163, 'Melekeok', 'ME', 1),
(2470, 163, 'Ngaraard', 'NA', 1),
(2471, 163, 'Ngarchelong', 'NG', 1),
(2472, 163, 'Ngardmau', 'ND', 1),
(2473, 163, 'Ngatpang', 'NT', 1),
(2474, 163, 'Ngchesar', 'NC', 1),
(2475, 163, 'Ngeremlengui', 'NR', 1),
(2476, 163, 'Ngiwal', 'NW', 1),
(2477, 163, 'Peleliu', 'PE', 1),
(2478, 163, 'Sonsorol', 'SO', 1),
(2479, 164, 'Bocas del Toro', 'BT', 1),
(2480, 164, 'Chiriqui', 'CH', 1),
(2481, 164, 'Cocle', 'CC', 1),
(2482, 164, 'Colon', 'CL', 1),
(2483, 164, 'Darien', 'DA', 1),
(2484, 164, 'Herrera', 'HE', 1),
(2485, 164, 'Los Santos', 'LS', 1),
(2486, 164, 'Panama', 'PA', 1),
(2487, 164, 'San Blas', 'SB', 1),
(2488, 164, 'Veraguas', 'VG', 1),
(2489, 165, 'Bougainville', 'BV', 1),
(2490, 165, 'Central', 'CE', 1),
(2491, 165, 'Chimbu', 'CH', 1),
(2492, 165, 'Eastern Highlands', 'EH', 1),
(2493, 165, 'East New Britain', 'EB', 1),
(2494, 165, 'East Sepik', 'ES', 1),
(2495, 165, 'Enga', 'EN', 1),
(2496, 165, 'Gulf', 'GU', 1),
(2497, 165, 'Madang', 'MD', 1),
(2498, 165, 'Manus', 'MN', 1),
(2499, 165, 'Milne Bay', 'MB', 1),
(2500, 165, 'Morobe', 'MR', 1),
(2501, 165, 'National Capital', 'NC', 1),
(2502, 165, 'New Ireland', 'NI', 1),
(2503, 165, 'Northern', 'NO', 1),
(2504, 165, 'Sandaun', 'SA', 1),
(2505, 165, 'Southern Highlands', 'SH', 1),
(2506, 165, 'Western', 'WE', 1),
(2507, 165, 'Western Highlands', 'WH', 1),
(2508, 165, 'West New Britain', 'WB', 1),
(2509, 166, 'Alto Paraguay', 'AG', 1),
(2510, 166, 'Alto Parana', 'AN', 1),
(2511, 166, 'Amambay', 'AM', 1),
(2512, 166, 'Asuncion', 'AS', 1),
(2513, 166, 'Boqueron', 'BO', 1),
(2514, 166, 'Caaguazu', 'CG', 1),
(2515, 166, 'Caazapa', 'CZ', 1),
(2516, 166, 'Canindeyu', 'CN', 1),
(2517, 166, 'Central', 'CE', 1),
(2518, 166, 'Concepcion', 'CC', 1),
(2519, 166, 'Cordillera', 'CD', 1),
(2520, 166, 'Guaira', 'GU', 1),
(2521, 166, 'Itapua', 'IT', 1),
(2522, 166, 'Misiones', 'MI', 1),
(2523, 166, 'Neembucu', 'NE', 1),
(2524, 166, 'Paraguari', 'PA', 1),
(2525, 166, 'Presidente Hayes', 'PH', 1),
(2526, 166, 'San Pedro', 'SP', 1),
(2527, 167, 'Amazonas', 'AM', 1),
(2528, 167, 'Ancash', 'AN', 1),
(2529, 167, 'Apurimac', 'AP', 1),
(2530, 167, 'Arequipa', 'AR', 1),
(2531, 167, 'Ayacucho', 'AY', 1),
(2532, 167, 'Cajamarca', 'CJ', 1),
(2533, 167, 'Callao', 'CL', 1),
(2534, 167, 'Cusco', 'CU', 1),
(2535, 167, 'Huancavelica', 'HV', 1),
(2536, 167, 'Huanuco', 'HO', 1),
(2537, 167, 'Ica', 'IC', 1),
(2538, 167, 'Junin', 'JU', 1),
(2539, 167, 'La Libertad', 'LD', 1),
(2540, 167, 'Lambayeque', 'LY', 1),
(2541, 167, 'Lima', 'LI', 1),
(2542, 167, 'Loreto', 'LO', 1),
(2543, 167, 'Madre de Dios', 'MD', 1),
(2544, 167, 'Moquegua', 'MO', 1),
(2545, 167, 'Pasco', 'PA', 1),
(2546, 167, 'Piura', 'PI', 1),
(2547, 167, 'Puno', 'PU', 1),
(2548, 167, 'San Martin', 'SM', 1),
(2549, 167, 'Tacna', 'TA', 1),
(2550, 167, 'Tumbes', 'TU', 1),
(2551, 167, 'Ucayali', 'UC', 1),
(2552, 168, 'Abra', 'ABR', 1),
(2553, 168, 'Agusan del Norte', 'ANO', 1),
(2554, 168, 'Agusan del Sur', 'ASU', 1),
(2555, 168, 'Aklan', 'AKL', 1),
(2556, 168, 'Albay', 'ALB', 1),
(2557, 168, 'Antique', 'ANT', 1),
(2558, 168, 'Apayao', 'APY', 1),
(2559, 168, 'Aurora', 'AUR', 1),
(2560, 168, 'Basilan', 'BAS', 1),
(2561, 168, 'Bataan', 'BTA', 1),
(2562, 168, 'Batanes', 'BTE', 1),
(2563, 168, 'Batangas', 'BTG', 1),
(2564, 168, 'Biliran', 'BLR', 1),
(2565, 168, 'Benguet', 'BEN', 1),
(2566, 168, 'Bohol', 'BOL', 1),
(2567, 168, 'Bukidnon', 'BUK', 1),
(2568, 168, 'Bulacan', 'BUL', 1),
(2569, 168, 'Cagayan', 'CAG', 1),
(2570, 168, 'Camarines Norte', 'CNO', 1),
(2571, 168, 'Camarines Sur', 'CSU', 1),
(2572, 168, 'Camiguin', 'CAM', 1),
(2573, 168, 'Capiz', 'CAP', 1),
(2574, 168, 'Catanduanes', 'CAT', 1),
(2575, 168, 'Cavite', 'CAV', 1),
(2576, 168, 'Cebu', 'CEB', 1),
(2577, 168, 'Compostela', 'CMP', 1),
(2578, 168, 'Davao del Norte', 'DNO', 1),
(2579, 168, 'Davao del Sur', 'DSU', 1),
(2580, 168, 'Davao Oriental', 'DOR', 1),
(2581, 168, 'Eastern Samar', 'ESA', 1),
(2582, 168, 'Guimaras', 'GUI', 1),
(2583, 168, 'Ifugao', 'IFU', 1),
(2584, 168, 'Ilocos Norte', 'INO', 1),
(2585, 168, 'Ilocos Sur', 'ISU', 1),
(2586, 168, 'Iloilo', 'ILO', 1),
(2587, 168, 'Isabela', 'ISA', 1),
(2588, 168, 'Kalinga', 'KAL', 1),
(2589, 168, 'Laguna', 'LAG', 1),
(2590, 168, 'Lanao del Norte', 'LNO', 1),
(2591, 168, 'Lanao del Sur', 'LSU', 1),
(2592, 168, 'La Union', 'UNI', 1),
(2593, 168, 'Leyte', 'LEY', 1),
(2594, 168, 'Maguindanao', 'MAG', 1),
(2595, 168, 'Marinduque', 'MRN', 1),
(2596, 168, 'Masbate', 'MSB', 1),
(2597, 168, 'Mindoro Occidental', 'MIC', 1),
(2598, 168, 'Mindoro Oriental', 'MIR', 1),
(2599, 168, 'Misamis Occidental', 'MSC', 1),
(2600, 168, 'Misamis Oriental', 'MOR', 1),
(2601, 168, 'Mountain', 'MOP', 1),
(2602, 168, 'Negros Occidental', 'NOC', 1),
(2603, 168, 'Negros Oriental', 'NOR', 1),
(2604, 168, 'North Cotabato', 'NCT', 1),
(2605, 168, 'Northern Samar', 'NSM', 1),
(2606, 168, 'Nueva Ecija', 'NEC', 1),
(2607, 168, 'Nueva Vizcaya', 'NVZ', 1),
(2608, 168, 'Palawan', 'PLW', 1),
(2609, 168, 'Pampanga', 'PMP', 1),
(2610, 168, 'Pangasinan', 'PNG', 1),
(2611, 168, 'Quezon', 'QZN', 1),
(2612, 168, 'Quirino', 'QRN', 1),
(2613, 168, 'Rizal', 'RIZ', 1),
(2614, 168, 'Romblon', 'ROM', 1),
(2615, 168, 'Samar', 'SMR', 1),
(2616, 168, 'Sarangani', 'SRG', 1),
(2617, 168, 'Siquijor', 'SQJ', 1),
(2618, 168, 'Sorsogon', 'SRS', 1),
(2619, 168, 'South Cotabato', 'SCO', 1),
(2620, 168, 'Southern Leyte', 'SLE', 1),
(2621, 168, 'Sultan Kudarat', 'SKU', 1),
(2622, 168, 'Sulu', 'SLU', 1),
(2623, 168, 'Surigao del Norte', 'SNO', 1),
(2624, 168, 'Surigao del Sur', 'SSU', 1),
(2625, 168, 'Tarlac', 'TAR', 1),
(2626, 168, 'Tawi-Tawi', 'TAW', 1),
(2627, 168, 'Zambales', 'ZBL', 1),
(2628, 168, 'Zamboanga del Norte', 'ZNO', 1),
(2629, 168, 'Zamboanga del Sur', 'ZSU', 1),
(2630, 168, 'Zamboanga Sibugay', 'ZSI', 1),
(2631, 170, 'Dolnoslaskie', 'DO', 1),
(2632, 170, 'Kujawsko-Pomorskie', 'KP', 1),
(2633, 170, 'Lodzkie', 'LO', 1),
(2634, 170, 'Lubelskie', 'LL', 1),
(2635, 170, 'Lubuskie', 'LU', 1),
(2636, 170, 'Malopolskie', 'ML', 1),
(2637, 170, 'Mazowieckie', 'MZ', 1),
(2638, 170, 'Opolskie', 'OP', 1),
(2639, 170, 'Podkarpackie', 'PP', 1),
(2640, 170, 'Podlaskie', 'PL', 1),
(2641, 170, 'Pomorskie', 'PM', 1),
(2642, 170, 'Slaskie', 'SL', 1),
(2643, 170, 'Swietokrzyskie', 'SW', 1),
(2644, 170, 'Warminsko-Mazurskie', 'WM', 1),
(2645, 170, 'Wielkopolskie', 'WP', 1),
(2646, 170, 'Zachodniopomorskie', 'ZA', 1),
(2647, 198, 'Saint Pierre', 'P', 1),
(2648, 198, 'Miquelon', 'M', 1),
(2649, 171, 'A&ccedil;ores', 'AC', 1),
(2650, 171, 'Aveiro', 'AV', 1),
(2651, 171, 'Beja', 'BE', 1),
(2652, 171, 'Braga', 'BR', 1),
(2653, 171, 'Bragan&ccedil;a', 'BA', 1),
(2654, 171, 'Castelo Branco', 'CB', 1),
(2655, 171, 'Coimbra', 'CO', 1),
(2656, 171, '&Eacute;vora', 'EV', 1),
(2657, 171, 'Faro', 'FA', 1),
(2658, 171, 'Guarda', 'GU', 1),
(2659, 171, 'Leiria', 'LE', 1),
(2660, 171, 'Lisboa', 'LI', 1),
(2661, 171, 'Madeira', 'ME', 1),
(2662, 171, 'Portalegre', 'PO', 1),
(2663, 171, 'Porto', 'PR', 1),
(2664, 171, 'Santar&eacute;m', 'SA', 1),
(2665, 171, 'Set&uacute;bal', 'SE', 1),
(2666, 171, 'Viana do Castelo', 'VC', 1),
(2667, 171, 'Vila Real', 'VR', 1),
(2668, 171, 'Viseu', 'VI', 1),
(2669, 173, 'Ad Dawhah', 'DW', 1),
(2670, 173, 'Al Ghuwayriyah', 'GW', 1),
(2671, 173, 'Al Jumayliyah', 'JM', 1),
(2672, 173, 'Al Khawr', 'KR', 1),
(2673, 173, 'Al Wakrah', 'WK', 1),
(2674, 173, 'Ar Rayyan', 'RN', 1),
(2675, 173, 'Jarayan al Batinah', 'JB', 1),
(2676, 173, 'Madinat ash Shamal', 'MS', 1),
(2677, 173, 'Umm Sa\'id', 'UD', 1),
(2678, 173, 'Umm Salal', 'UL', 1),
(2679, 175, 'Alba', 'AB', 1),
(2680, 175, 'Arad', 'AR', 1),
(2681, 175, 'Arges', 'AG', 1),
(2682, 175, 'Bacau', 'BC', 1),
(2683, 175, 'Bihor', 'BH', 1),
(2684, 175, 'Bistrita-Nasaud', 'BN', 1),
(2685, 175, 'Botosani', 'BT', 1),
(2686, 175, 'Brasov', 'BV', 1),
(2687, 175, 'Braila', 'BR', 1),
(2688, 175, 'Bucuresti', 'B', 1),
(2689, 175, 'Buzau', 'BZ', 1),
(2690, 175, 'Caras-Severin', 'CS', 1),
(2691, 175, 'Calarasi', 'CL', 1),
(2692, 175, 'Cluj', 'CJ', 1),
(2693, 175, 'Constanta', 'CT', 1),
(2694, 175, 'Covasna', 'CV', 1),
(2695, 175, 'Dimbovita', 'DB', 1),
(2696, 175, 'Dolj', 'DJ', 1),
(2697, 175, 'Galati', 'GL', 1),
(2698, 175, 'Giurgiu', 'GR', 1),
(2699, 175, 'Gorj', 'GJ', 1),
(2700, 175, 'Harghita', 'HR', 1),
(2701, 175, 'Hunedoara', 'HD', 1),
(2702, 175, 'Ialomita', 'IL', 1),
(2703, 175, 'Iasi', 'IS', 1),
(2704, 175, 'Ilfov', 'IF', 1),
(2705, 175, 'Maramures', 'MM', 1),
(2706, 175, 'Mehedinti', 'MH', 1),
(2707, 175, 'Mures', 'MS', 1),
(2708, 175, 'Neamt', 'NT', 1),
(2709, 175, 'Olt', 'OT', 1),
(2710, 175, 'Prahova', 'PH', 1),
(2711, 175, 'Satu-Mare', 'SM', 1),
(2712, 175, 'Salaj', 'SJ', 1),
(2713, 175, 'Sibiu', 'SB', 1),
(2714, 175, 'Suceava', 'SV', 1),
(2715, 175, 'Teleorman', 'TR', 1),
(2716, 175, 'Timis', 'TM', 1),
(2717, 175, 'Tulcea', 'TL', 1),
(2718, 175, 'Vaslui', 'VS', 1),
(2719, 175, 'Valcea', 'VL', 1),
(2720, 175, 'Vrancea', 'VN', 1),
(2721, 176, 'Abakan', 'AB', 1),
(2722, 176, 'Aginskoye', 'AG', 1),
(2723, 176, 'Anadyr', 'AN', 1),
(2724, 176, 'Arkahangelsk', 'AR', 1),
(2725, 176, 'Astrakhan', 'AS', 1),
(2726, 176, 'Barnaul', 'BA', 1),
(2727, 176, 'Belgorod', 'BE', 1),
(2728, 176, 'Birobidzhan', 'BI', 1),
(2729, 176, 'Blagoveshchensk', 'BL', 1),
(2730, 176, 'Bryansk', 'BR', 1),
(2731, 176, 'Cheboksary', 'CH', 1),
(2732, 176, 'Chelyabinsk', 'CL', 1),
(2733, 176, 'Cherkessk', 'CR', 1),
(2734, 176, 'Chita', 'CI', 1),
(2735, 176, 'Dudinka', 'DU', 1),
(2736, 176, 'Elista', 'EL', 1),
(2737, 176, 'Gomo-Altaysk', 'GO', 1),
(2738, 176, 'Gorno-Altaysk', 'GA', 1),
(2739, 176, 'Groznyy', 'GR', 1),
(2740, 176, 'Irkutsk', 'IR', 1),
(2741, 176, 'Ivanovo', 'IV', 1),
(2742, 176, 'Izhevsk', 'IZ', 1),
(2743, 176, 'Kalinigrad', 'KA', 1),
(2744, 176, 'Kaluga', 'KL', 1),
(2745, 176, 'Kasnodar', 'KS', 1),
(2746, 176, 'Kazan', 'KZ', 1),
(2747, 176, 'Kemerovo', 'KE', 1),
(2748, 176, 'Khabarovsk', 'KH', 1),
(2749, 176, 'Khanty-Mansiysk', 'KM', 1),
(2750, 176, 'Kostroma', 'KO', 1),
(2751, 176, 'Krasnodar', 'KR', 1),
(2752, 176, 'Krasnoyarsk', 'KN', 1),
(2753, 176, 'Kudymkar', 'KU', 1),
(2754, 176, 'Kurgan', 'KG', 1),
(2755, 176, 'Kursk', 'KK', 1),
(2756, 176, 'Kyzyl', 'KY', 1),
(2757, 176, 'Lipetsk', 'LI', 1),
(2758, 176, 'Magadan', 'MA', 1),
(2759, 176, 'Makhachkala', 'MK', 1),
(2760, 176, 'Maykop', 'MY', 1),
(2761, 176, 'Moscow', 'MO', 1),
(2762, 176, 'Murmansk', 'MU', 1),
(2763, 176, 'Nalchik', 'NA', 1),
(2764, 176, 'Naryan Mar', 'NR', 1),
(2765, 176, 'Nazran', 'NZ', 1),
(2766, 176, 'Nizhniy Novgorod', 'NI', 1),
(2767, 176, 'Novgorod', 'NO', 1),
(2768, 176, 'Novosibirsk', 'NV', 1),
(2769, 176, 'Omsk', 'OM', 1),
(2770, 176, 'Orel', 'OR', 1),
(2771, 176, 'Orenburg', 'OE', 1),
(2772, 176, 'Palana', 'PA', 1),
(2773, 176, 'Penza', 'PE', 1),
(2774, 176, 'Perm', 'PR', 1),
(2775, 176, 'Petropavlovsk-Kamchatskiy', 'PK', 1),
(2776, 176, 'Petrozavodsk', 'PT', 1),
(2777, 176, 'Pskov', 'PS', 1),
(2778, 176, 'Rostov-na-Donu', 'RO', 1),
(2779, 176, 'Ryazan', 'RY', 1),
(2780, 176, 'Salekhard', 'SL', 1),
(2781, 176, 'Samara', 'SA', 1),
(2782, 176, 'Saransk', 'SR', 1),
(2783, 176, 'Saratov', 'SV', 1),
(2784, 176, 'Smolensk', 'SM', 1),
(2785, 176, 'St. Petersburg', 'SP', 1),
(2786, 176, 'Stavropol', 'ST', 1),
(2787, 176, 'Syktyvkar', 'SY', 1),
(2788, 176, 'Tambov', 'TA', 1),
(2789, 176, 'Tomsk', 'TO', 1),
(2790, 176, 'Tula', 'TU', 1),
(2791, 176, 'Tura', 'TR', 1),
(2792, 176, 'Tver', 'TV', 1),
(2793, 176, 'Tyumen', 'TY', 1),
(2794, 176, 'Ufa', 'UF', 1),
(2795, 176, 'Ul\'yanovsk', 'UL', 1),
(2796, 176, 'Ulan-Ude', 'UU', 1),
(2797, 176, 'Ust\'-Ordynskiy', 'US', 1),
(2798, 176, 'Vladikavkaz', 'VL', 1),
(2799, 176, 'Vladimir', 'VA', 1),
(2800, 176, 'Vladivostok', 'VV', 1),
(2801, 176, 'Volgograd', 'VG', 1),
(2802, 176, 'Vologda', 'VD', 1),
(2803, 176, 'Voronezh', 'VO', 1),
(2804, 176, 'Vyatka', 'VY', 1),
(2805, 176, 'Yakutsk', 'YA', 1),
(2806, 176, 'Yaroslavl', 'YR', 1),
(2807, 176, 'Yekaterinburg', 'YE', 1),
(2808, 176, 'Yoshkar-Ola', 'YO', 1),
(2809, 177, 'Butare', 'BU', 1),
(2810, 177, 'Byumba', 'BY', 1),
(2811, 177, 'Cyangugu', 'CY', 1),
(2812, 177, 'Gikongoro', 'GK', 1),
(2813, 177, 'Gisenyi', 'GS', 1),
(2814, 177, 'Gitarama', 'GT', 1),
(2815, 177, 'Kibungo', 'KG', 1),
(2816, 177, 'Kibuye', 'KY', 1),
(2817, 177, 'Kigali Rurale', 'KR', 1),
(2818, 177, 'Kigali-ville', 'KV', 1),
(2819, 177, 'Ruhengeri', 'RU', 1),
(2820, 177, 'Umutara', 'UM', 1),
(2821, 178, 'Christ Church Nichola Town', 'CCN', 1),
(2822, 178, 'Saint Anne Sandy Point', 'SAS', 1),
(2823, 178, 'Saint George Basseterre', 'SGB', 1),
(2824, 178, 'Saint George Gingerland', 'SGG', 1),
(2825, 178, 'Saint James Windward', 'SJW', 1),
(2826, 178, 'Saint John Capesterre', 'SJC', 1),
(2827, 178, 'Saint John Figtree', 'SJF', 1),
(2828, 178, 'Saint Mary Cayon', 'SMC', 1),
(2829, 178, 'Saint Paul Capesterre', 'CAP', 1),
(2830, 178, 'Saint Paul Charlestown', 'CHA', 1),
(2831, 178, 'Saint Peter Basseterre', 'SPB', 1),
(2832, 178, 'Saint Thomas Lowland', 'STL', 1),
(2833, 178, 'Saint Thomas Middle Island', 'STM', 1),
(2834, 178, 'Trinity Palmetto Point', 'TPP', 1),
(2835, 179, 'Anse-la-Raye', 'AR', 1),
(2836, 179, 'Castries', 'CA', 1),
(2837, 179, 'Choiseul', 'CH', 1),
(2838, 179, 'Dauphin', 'DA', 1),
(2839, 179, 'Dennery', 'DE', 1),
(2840, 179, 'Gros-Islet', 'GI', 1),
(2841, 179, 'Laborie', 'LA', 1),
(2842, 179, 'Micoud', 'MI', 1),
(2843, 179, 'Praslin', 'PR', 1),
(2844, 179, 'Soufriere', 'SO', 1),
(2845, 179, 'Vieux-Fort', 'VF', 1),
(2846, 180, 'Charlotte', 'C', 1),
(2847, 180, 'Grenadines', 'R', 1),
(2848, 180, 'Saint Andrew', 'A', 1),
(2849, 180, 'Saint David', 'D', 1),
(2850, 180, 'Saint George', 'G', 1),
(2851, 180, 'Saint Patrick', 'P', 1),
(2852, 181, 'A\'ana', 'AN', 1),
(2853, 181, 'Aiga-i-le-Tai', 'AI', 1),
(2854, 181, 'Atua', 'AT', 1),
(2855, 181, 'Fa\'asaleleaga', 'FA', 1),
(2856, 181, 'Gaga\'emauga', 'GE', 1),
(2857, 181, 'Gagaifomauga', 'GF', 1),
(2858, 181, 'Palauli', 'PA', 1),
(2859, 181, 'Satupa\'itea', 'SA', 1),
(2860, 181, 'Tuamasaga', 'TU', 1),
(2861, 181, 'Va\'a-o-Fonoti', 'VF', 1),
(2862, 181, 'Vaisigano', 'VS', 1),
(2863, 182, 'Acquaviva', 'AC', 1),
(2864, 182, 'Borgo Maggiore', 'BM', 1),
(2865, 182, 'Chiesanuova', 'CH', 1),
(2866, 182, 'Domagnano', 'DO', 1),
(2867, 182, 'Faetano', 'FA', 1),
(2868, 182, 'Fiorentino', 'FI', 1),
(2869, 182, 'Montegiardino', 'MO', 1),
(2870, 182, 'Citta di San Marino', 'SM', 1),
(2871, 182, 'Serravalle', 'SE', 1),
(2872, 183, 'Sao Tome', 'S', 1),
(2873, 183, 'Principe', 'P', 1),
(2874, 184, 'Al Bahah', 'BH', 1),
(2875, 184, 'Al Hudud ash Shamaliyah', 'HS', 1),
(2876, 184, 'Al Jawf', 'JF', 1),
(2877, 184, 'Al Madinah', 'MD', 1),
(2878, 184, 'Al Qasim', 'QS', 1),
(2879, 184, 'Ar Riyad', 'RD', 1),
(2880, 184, 'Ash Sharqiyah (Eastern)', 'AQ', 1),
(2881, 184, '\'Asir', 'AS', 1),
(2882, 184, 'Ha\'il', 'HL', 1),
(2883, 184, 'Jizan', 'JZ', 1),
(2884, 184, 'Makkah', 'ML', 1),
(2885, 184, 'Najran', 'NR', 1),
(2886, 184, 'Tabuk', 'TB', 1),
(2887, 185, 'Dakar', 'DA', 1),
(2888, 185, 'Diourbel', 'DI', 1),
(2889, 185, 'Fatick', 'FA', 1),
(2890, 185, 'Kaolack', 'KA', 1),
(2891, 185, 'Kolda', 'KO', 1),
(2892, 185, 'Louga', 'LO', 1),
(2893, 185, 'Matam', 'MA', 1),
(2894, 185, 'Saint-Louis', 'SL', 1),
(2895, 185, 'Tambacounda', 'TA', 1),
(2896, 185, 'Thies', 'TH', 1),
(2897, 185, 'Ziguinchor', 'ZI', 1),
(2898, 186, 'Anse aux Pins', 'AP', 1),
(2899, 186, 'Anse Boileau', 'AB', 1),
(2900, 186, 'Anse Etoile', 'AE', 1),
(2901, 186, 'Anse Louis', 'AL', 1),
(2902, 186, 'Anse Royale', 'AR', 1),
(2903, 186, 'Baie Lazare', 'BL', 1),
(2904, 186, 'Baie Sainte Anne', 'BS', 1),
(2905, 186, 'Beau Vallon', 'BV', 1),
(2906, 186, 'Bel Air', 'BA', 1),
(2907, 186, 'Bel Ombre', 'BO', 1),
(2908, 186, 'Cascade', 'CA', 1),
(2909, 186, 'Glacis', 'GL', 1),
(2910, 186, 'Grand\' Anse (on Mahe)', 'GM', 1),
(2911, 186, 'Grand\' Anse (on Praslin)', 'GP', 1),
(2912, 186, 'La Digue', 'DG', 1),
(2913, 186, 'La Riviere Anglaise', 'RA', 1),
(2914, 186, 'Mont Buxton', 'MB', 1),
(2915, 186, 'Mont Fleuri', 'MF', 1),
(2916, 186, 'Plaisance', 'PL', 1),
(2917, 186, 'Pointe La Rue', 'PR', 1),
(2918, 186, 'Port Glaud', 'PG', 1),
(2919, 186, 'Saint Louis', 'SL', 1),
(2920, 186, 'Takamaka', 'TA', 1),
(2921, 187, 'Eastern', 'E', 1),
(2922, 187, 'Northern', 'N', 1),
(2923, 187, 'Southern', 'S', 1),
(2924, 187, 'Western', 'W', 1),
(2925, 189, 'Banskobystrický', 'BA', 1),
(2926, 189, 'Bratislavský', 'BR', 1),
(2927, 189, 'Košický', 'KO', 1),
(2928, 189, 'Nitriansky', 'NI', 1),
(2929, 189, 'Prešovský', 'PR', 1),
(2930, 189, 'Trenčiansky', 'TC', 1),
(2931, 189, 'Trnavský', 'TV', 1),
(2932, 189, 'Žilinský', 'ZI', 1),
(2933, 191, 'Central', 'CE', 1),
(2934, 191, 'Choiseul', 'CH', 1),
(2935, 191, 'Guadalcanal', 'GC', 1),
(2936, 191, 'Honiara', 'HO', 1),
(2937, 191, 'Isabel', 'IS', 1),
(2938, 191, 'Makira', 'MK', 1),
(2939, 191, 'Malaita', 'ML', 1),
(2940, 191, 'Rennell and Bellona', 'RB', 1),
(2941, 191, 'Temotu', 'TM', 1),
(2942, 191, 'Western', 'WE', 1),
(2943, 192, 'Awdal', 'AW', 1),
(2944, 192, 'Bakool', 'BK', 1),
(2945, 192, 'Banaadir', 'BN', 1),
(2946, 192, 'Bari', 'BR', 1),
(2947, 192, 'Bay', 'BY', 1),
(2948, 192, 'Galguduud', 'GA', 1),
(2949, 192, 'Gedo', 'GE', 1),
(2950, 192, 'Hiiraan', 'HI', 1),
(2951, 192, 'Jubbada Dhexe', 'JD', 1),
(2952, 192, 'Jubbada Hoose', 'JH', 1),
(2953, 192, 'Mudug', 'MU', 1),
(2954, 192, 'Nugaal', 'NU', 1),
(2955, 192, 'Sanaag', 'SA', 1),
(2956, 192, 'Shabeellaha Dhexe', 'SD', 1),
(2957, 192, 'Shabeellaha Hoose', 'SH', 1),
(2958, 192, 'Sool', 'SL', 1),
(2959, 192, 'Togdheer', 'TO', 1),
(2960, 192, 'Woqooyi Galbeed', 'WG', 1),
(2961, 193, 'Eastern Cape', 'EC', 1),
(2962, 193, 'Free State', 'FS', 1),
(2963, 193, 'Gauteng', 'GT', 1),
(2964, 193, 'KwaZulu-Natal', 'KN', 1),
(2965, 193, 'Limpopo', 'LP', 1),
(2966, 193, 'Mpumalanga', 'MP', 1),
(2967, 193, 'North West', 'NW', 1),
(2968, 193, 'Northern Cape', 'NC', 1),
(2969, 193, 'Western Cape', 'WC', 1),
(2970, 195, 'La Coru&ntilde;a', 'CA', 1),
(2971, 195, '&Aacute;lava', 'AL', 1),
(2972, 195, 'Albacete', 'AB', 1),
(2973, 195, 'Alicante', 'AC', 1),
(2974, 195, 'Almeria', 'AM', 1),
(2975, 195, 'Asturias', 'AS', 1),
(2976, 195, '&Aacute;vila', 'AV', 1),
(2977, 195, 'Badajoz', 'BJ', 1),
(2978, 195, 'Baleares', 'IB', 1),
(2979, 195, 'Barcelona', 'BA', 1),
(2980, 195, 'Burgos', 'BU', 1),
(2981, 195, 'C&aacute;ceres', 'CC', 1),
(2982, 195, 'C&aacute;diz', 'CZ', 1),
(2983, 195, 'Cantabria', 'CT', 1),
(2984, 195, 'Castell&oacute;n', 'CL', 1),
(2985, 195, 'Ceuta', 'CE', 1),
(2986, 195, 'Ciudad Real', 'CR', 1),
(2987, 195, 'C&oacute;rdoba', 'CD', 1),
(2988, 195, 'Cuenca', 'CU', 1),
(2989, 195, 'Girona', 'GI', 1),
(2990, 195, 'Granada', 'GD', 1),
(2991, 195, 'Guadalajara', 'GJ', 1),
(2992, 195, 'Guip&uacute;zcoa', 'GP', 1),
(2993, 195, 'Huelva', 'HL', 1),
(2994, 195, 'Huesca', 'HS', 1),
(2995, 195, 'Ja&eacute;n', 'JN', 1),
(2996, 195, 'La Rioja', 'RJ', 1),
(2997, 195, 'Las Palmas', 'PM', 1),
(2998, 195, 'Leon', 'LE', 1),
(2999, 195, 'Lleida', 'LL', 1),
(3000, 195, 'Lugo', 'LG', 1),
(3001, 195, 'Madrid', 'MD', 1),
(3002, 195, 'Malaga', 'MA', 1),
(3003, 195, 'Melilla', 'ML', 1),
(3004, 195, 'Murcia', 'MU', 1),
(3005, 195, 'Navarra', 'NV', 1),
(3006, 195, 'Ourense', 'OU', 1),
(3007, 195, 'Palencia', 'PL', 1),
(3008, 195, 'Pontevedra', 'PO', 1),
(3009, 195, 'Salamanca', 'SL', 1),
(3010, 195, 'Santa Cruz de Tenerife', 'SC', 1),
(3011, 195, 'Segovia', 'SG', 1),
(3012, 195, 'Sevilla', 'SV', 1),
(3013, 195, 'Soria', 'SO', 1),
(3014, 195, 'Tarragona', 'TA', 1),
(3015, 195, 'Teruel', 'TE', 1),
(3016, 195, 'Toledo', 'TO', 1),
(3017, 195, 'Valencia', 'VC', 1),
(3018, 195, 'Valladolid', 'VD', 1),
(3019, 195, 'Vizcaya', 'VZ', 1),
(3020, 195, 'Zamora', 'ZM', 1),
(3021, 195, 'Zaragoza', 'ZR', 1),
(3022, 196, 'Central', 'CE', 1),
(3023, 196, 'Eastern', 'EA', 1),
(3024, 196, 'North Central', 'NC', 1),
(3025, 196, 'Northern', 'NO', 1),
(3026, 196, 'North Western', 'NW', 1),
(3027, 196, 'Sabaragamuwa', 'SA', 1),
(3028, 196, 'Southern', 'SO', 1),
(3029, 196, 'Uva', 'UV', 1),
(3030, 196, 'Western', 'WE', 1),
(3032, 197, 'Saint Helena', 'S', 1),
(3034, 199, 'A\'ali an Nil', 'ANL', 1),
(3035, 199, 'Al Bahr al Ahmar', 'BAM', 1),
(3036, 199, 'Al Buhayrat', 'BRT', 1),
(3037, 199, 'Al Jazirah', 'JZR', 1),
(3038, 199, 'Al Khartum', 'KRT', 1),
(3039, 199, 'Al Qadarif', 'QDR', 1),
(3040, 199, 'Al Wahdah', 'WDH', 1),
(3041, 199, 'An Nil al Abyad', 'ANB', 1),
(3042, 199, 'An Nil al Azraq', 'ANZ', 1),
(3043, 199, 'Ash Shamaliyah', 'ASH', 1),
(3044, 199, 'Bahr al Jabal', 'BJA', 1),
(3045, 199, 'Gharb al Istiwa\'iyah', 'GIS', 1),
(3046, 199, 'Gharb Bahr al Ghazal', 'GBG', 1),
(3047, 199, 'Gharb Darfur', 'GDA', 1),
(3048, 199, 'Gharb Kurdufan', 'GKU', 1),
(3049, 199, 'Janub Darfur', 'JDA', 1),
(3050, 199, 'Janub Kurdufan', 'JKU', 1),
(3051, 199, 'Junqali', 'JQL', 1),
(3052, 199, 'Kassala', 'KSL', 1),
(3053, 199, 'Nahr an Nil', 'NNL', 1),
(3054, 199, 'Shamal Bahr al Ghazal', 'SBG', 1),
(3055, 199, 'Shamal Darfur', 'SDA', 1),
(3056, 199, 'Shamal Kurdufan', 'SKU', 1),
(3057, 199, 'Sharq al Istiwa\'iyah', 'SIS', 1),
(3058, 199, 'Sinnar', 'SNR', 1),
(3059, 199, 'Warab', 'WRB', 1),
(3060, 200, 'Brokopondo', 'BR', 1),
(3061, 200, 'Commewijne', 'CM', 1),
(3062, 200, 'Coronie', 'CR', 1),
(3063, 200, 'Marowijne', 'MA', 1),
(3064, 200, 'Nickerie', 'NI', 1),
(3065, 200, 'Para', 'PA', 1),
(3066, 200, 'Paramaribo', 'PM', 1),
(3067, 200, 'Saramacca', 'SA', 1),
(3068, 200, 'Sipaliwini', 'SI', 1),
(3069, 200, 'Wanica', 'WA', 1),
(3070, 202, 'Hhohho', 'H', 1),
(3071, 202, 'Lubombo', 'L', 1),
(3072, 202, 'Manzini', 'M', 1),
(3073, 202, 'Shishelweni', 'S', 1),
(3074, 203, 'Blekinge', 'K', 1),
(3075, 203, 'Dalarna', 'W', 1),
(3076, 203, 'G&auml;vleborg', 'X', 1),
(3077, 203, 'Gotland', 'I', 1),
(3078, 203, 'Halland', 'N', 1),
(3079, 203, 'J&auml;mtland', 'Z', 1),
(3080, 203, 'J&ouml;nk&ouml;ping', 'F', 1),
(3081, 203, 'Kalmar', 'H', 1),
(3082, 203, 'Kronoberg', 'G', 1),
(3083, 203, 'Norrbotten', 'BD', 1),
(3084, 203, '&Ouml;rebro', 'T', 1),
(3085, 203, '&Ouml;sterg&ouml;tland', 'E', 1),
(3086, 203, 'Sk&aring;ne', 'M', 1),
(3087, 203, 'S&ouml;dermanland', 'D', 1),
(3088, 203, 'Stockholm', 'AB', 1),
(3089, 203, 'Uppsala', 'C', 1),
(3090, 203, 'V&auml;rmland', 'S', 1),
(3091, 203, 'V&auml;sterbotten', 'AC', 1),
(3092, 203, 'V&auml;sternorrland', 'Y', 1),
(3093, 203, 'V&auml;stmanland', 'U', 1),
(3094, 203, 'V&auml;stra G&ouml;taland', 'O', 1),
(3095, 204, 'Aargau', 'AG', 1),
(3096, 204, 'Appenzell Ausserrhoden', 'AR', 1),
(3097, 204, 'Appenzell Innerrhoden', 'AI', 1),
(3098, 204, 'Basel-Stadt', 'BS', 1),
(3099, 204, 'Basel-Landschaft', 'BL', 1),
(3100, 204, 'Bern', 'BE', 1),
(3101, 204, 'Fribourg', 'FR', 1),
(3102, 204, 'Gen&egrave;ve', 'GE', 1),
(3103, 204, 'Glarus', 'GL', 1),
(3104, 204, 'Graub&uuml;nden', 'GR', 1),
(3105, 204, 'Jura', 'JU', 1),
(3106, 204, 'Luzern', 'LU', 1),
(3107, 204, 'Neuch&acirc;tel', 'NE', 1),
(3108, 204, 'Nidwald', 'NW', 1),
(3109, 204, 'Obwald', 'OW', 1),
(3110, 204, 'St. Gallen', 'SG', 1),
(3111, 204, 'Schaffhausen', 'SH', 1),
(3112, 204, 'Schwyz', 'SZ', 1),
(3113, 204, 'Solothurn', 'SO', 1),
(3114, 204, 'Thurgau', 'TG', 1),
(3115, 204, 'Ticino', 'TI', 1),
(3116, 204, 'Uri', 'UR', 1),
(3117, 204, 'Valais', 'VS', 1),
(3118, 204, 'Vaud', 'VD', 1),
(3119, 204, 'Zug', 'ZG', 1),
(3120, 204, 'Z&uuml;rich', 'ZH', 1),
(3121, 205, 'Al Hasakah', 'HA', 1),
(3122, 205, 'Al Ladhiqiyah', 'LA', 1),
(3123, 205, 'Al Qunaytirah', 'QU', 1),
(3124, 205, 'Ar Raqqah', 'RQ', 1),
(3125, 205, 'As Suwayda', 'SU', 1),
(3126, 205, 'Dara', 'DA', 1),
(3127, 205, 'Dayr az Zawr', 'DZ', 1),
(3128, 205, 'Dimashq', 'DI', 1),
(3129, 205, 'Halab', 'HL', 1),
(3130, 205, 'Hamah', 'HM', 1),
(3131, 205, 'Hims', 'HI', 1),
(3132, 205, 'Idlib', 'ID', 1),
(3133, 205, 'Rif Dimashq', 'RD', 1),
(3134, 205, 'Tartus', 'TA', 1),
(3135, 206, 'Chang-hua', 'CH', 1);
INSERT INTO `mcc_zone` (`zone_id`, `country_id`, `name`, `code`, `status`) VALUES
(3136, 206, 'Chia-i', 'CI', 1),
(3137, 206, 'Hsin-chu', 'HS', 1),
(3138, 206, 'Hua-lien', 'HL', 1),
(3139, 206, 'I-lan', 'IL', 1),
(3140, 206, 'Kao-hsiung county', 'KH', 1),
(3141, 206, 'Kin-men', 'KM', 1),
(3142, 206, 'Lien-chiang', 'LC', 1),
(3143, 206, 'Miao-li', 'ML', 1),
(3144, 206, 'Nan-t\'ou', 'NT', 1),
(3145, 206, 'P\'eng-hu', 'PH', 1),
(3146, 206, 'P\'ing-tung', 'PT', 1),
(3147, 206, 'T\'ai-chung', 'TG', 1),
(3148, 206, 'T\'ai-nan', 'TA', 1),
(3149, 206, 'T\'ai-pei county', 'TP', 1),
(3150, 206, 'T\'ai-tung', 'TT', 1),
(3151, 206, 'T\'ao-yuan', 'TY', 1),
(3152, 206, 'Yun-lin', 'YL', 1),
(3153, 206, 'Chia-i city', 'CC', 1),
(3154, 206, 'Chi-lung', 'CL', 1),
(3155, 206, 'Hsin-chu', 'HC', 1),
(3156, 206, 'T\'ai-chung', 'TH', 1),
(3157, 206, 'T\'ai-nan', 'TN', 1),
(3158, 206, 'Kao-hsiung city', 'KC', 1),
(3159, 206, 'T\'ai-pei city', 'TC', 1),
(3160, 207, 'Gorno-Badakhstan', 'GB', 1),
(3161, 207, 'Khatlon', 'KT', 1),
(3162, 207, 'Sughd', 'SU', 1),
(3163, 208, 'Arusha', 'AR', 1),
(3164, 208, 'Dar es Salaam', 'DS', 1),
(3165, 208, 'Dodoma', 'DO', 1),
(3166, 208, 'Iringa', 'IR', 1),
(3167, 208, 'Kagera', 'KA', 1),
(3168, 208, 'Kigoma', 'KI', 1),
(3169, 208, 'Kilimanjaro', 'KJ', 1),
(3170, 208, 'Lindi', 'LN', 1),
(3171, 208, 'Manyara', 'MY', 1),
(3172, 208, 'Mara', 'MR', 1),
(3173, 208, 'Mbeya', 'MB', 1),
(3174, 208, 'Morogoro', 'MO', 1),
(3175, 208, 'Mtwara', 'MT', 1),
(3176, 208, 'Mwanza', 'MW', 1),
(3177, 208, 'Pemba North', 'PN', 1),
(3178, 208, 'Pemba South', 'PS', 1),
(3179, 208, 'Pwani', 'PW', 1),
(3180, 208, 'Rukwa', 'RK', 1),
(3181, 208, 'Ruvuma', 'RV', 1),
(3182, 208, 'Shinyanga', 'SH', 1),
(3183, 208, 'Singida', 'SI', 1),
(3184, 208, 'Tabora', 'TB', 1),
(3185, 208, 'Tanga', 'TN', 1),
(3186, 208, 'Zanzibar Central/South', 'ZC', 1),
(3187, 208, 'Zanzibar North', 'ZN', 1),
(3188, 208, 'Zanzibar Urban/West', 'ZU', 1),
(3189, 209, 'Amnat Charoen', 'Amnat Charoen', 1),
(3190, 209, 'Ang Thong', 'Ang Thong', 1),
(3191, 209, 'Ayutthaya', 'Ayutthaya', 1),
(3192, 209, 'Bangkok', 'Bangkok', 1),
(3193, 209, 'Buriram', 'Buriram', 1),
(3194, 209, 'Chachoengsao', 'Chachoengsao', 1),
(3195, 209, 'Chai Nat', 'Chai Nat', 1),
(3196, 209, 'Chaiyaphum', 'Chaiyaphum', 1),
(3197, 209, 'Chanthaburi', 'Chanthaburi', 1),
(3198, 209, 'Chiang Mai', 'Chiang Mai', 1),
(3199, 209, 'Chiang Rai', 'Chiang Rai', 1),
(3200, 209, 'Chon Buri', 'Chon Buri', 1),
(3201, 209, 'Chumphon', 'Chumphon', 1),
(3202, 209, 'Kalasin', 'Kalasin', 1),
(3203, 209, 'Kamphaeng Phet', 'Kamphaeng Phet', 1),
(3204, 209, 'Kanchanaburi', 'Kanchanaburi', 1),
(3205, 209, 'Khon Kaen', 'Khon Kaen', 1),
(3206, 209, 'Krabi', 'Krabi', 1),
(3207, 209, 'Lampang', 'Lampang', 1),
(3208, 209, 'Lamphun', 'Lamphun', 1),
(3209, 209, 'Loei', 'Loei', 1),
(3210, 209, 'Lop Buri', 'Lop Buri', 1),
(3211, 209, 'Mae Hong Son', 'Mae Hong Son', 1),
(3212, 209, 'Maha Sarakham', 'Maha Sarakham', 1),
(3213, 209, 'Mukdahan', 'Mukdahan', 1),
(3214, 209, 'Nakhon Nayok', 'Nakhon Nayok', 1),
(3215, 209, 'Nakhon Pathom', 'Nakhon Pathom', 1),
(3216, 209, 'Nakhon Phanom', 'Nakhon Phanom', 1),
(3217, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima', 1),
(3218, 209, 'Nakhon Sawan', 'Nakhon Sawan', 1),
(3219, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat', 1),
(3220, 209, 'Nan', 'Nan', 1),
(3221, 209, 'Narathiwat', 'Narathiwat', 1),
(3222, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu', 1),
(3223, 209, 'Nong Khai', 'Nong Khai', 1),
(3224, 209, 'Nonthaburi', 'Nonthaburi', 1),
(3225, 209, 'Pathum Thani', 'Pathum Thani', 1),
(3226, 209, 'Pattani', 'Pattani', 1),
(3227, 209, 'Phangnga', 'Phangnga', 1),
(3228, 209, 'Phatthalung', 'Phatthalung', 1),
(3229, 209, 'Phayao', 'Phayao', 1),
(3230, 209, 'Phetchabun', 'Phetchabun', 1),
(3231, 209, 'Phetchaburi', 'Phetchaburi', 1),
(3232, 209, 'Phichit', 'Phichit', 1),
(3233, 209, 'Phitsanulok', 'Phitsanulok', 1),
(3234, 209, 'Phrae', 'Phrae', 1),
(3235, 209, 'Phuket', 'Phuket', 1),
(3236, 209, 'Prachin Buri', 'Prachin Buri', 1),
(3237, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan', 1),
(3238, 209, 'Ranong', 'Ranong', 1),
(3239, 209, 'Ratchaburi', 'Ratchaburi', 1),
(3240, 209, 'Rayong', 'Rayong', 1),
(3241, 209, 'Roi Et', 'Roi Et', 1),
(3242, 209, 'Sa Kaeo', 'Sa Kaeo', 1),
(3243, 209, 'Sakon Nakhon', 'Sakon Nakhon', 1),
(3244, 209, 'Samut Prakan', 'Samut Prakan', 1),
(3245, 209, 'Samut Sakhon', 'Samut Sakhon', 1),
(3246, 209, 'Samut Songkhram', 'Samut Songkhram', 1),
(3247, 209, 'Sara Buri', 'Sara Buri', 1),
(3248, 209, 'Satun', 'Satun', 1),
(3249, 209, 'Sing Buri', 'Sing Buri', 1),
(3250, 209, 'Sisaket', 'Sisaket', 1),
(3251, 209, 'Songkhla', 'Songkhla', 1),
(3252, 209, 'Sukhothai', 'Sukhothai', 1),
(3253, 209, 'Suphan Buri', 'Suphan Buri', 1),
(3254, 209, 'Surat Thani', 'Surat Thani', 1),
(3255, 209, 'Surin', 'Surin', 1),
(3256, 209, 'Tak', 'Tak', 1),
(3257, 209, 'Trang', 'Trang', 1),
(3258, 209, 'Trat', 'Trat', 1),
(3259, 209, 'Ubon Ratchathani', 'Ubon Ratchathani', 1),
(3260, 209, 'Udon Thani', 'Udon Thani', 1),
(3261, 209, 'Uthai Thani', 'Uthai Thani', 1),
(3262, 209, 'Uttaradit', 'Uttaradit', 1),
(3263, 209, 'Yala', 'Yala', 1),
(3264, 209, 'Yasothon', 'Yasothon', 1),
(3265, 210, 'Kara', 'K', 1),
(3266, 210, 'Plateaux', 'P', 1),
(3267, 210, 'Savanes', 'S', 1),
(3268, 210, 'Centrale', 'C', 1),
(3269, 210, 'Maritime', 'M', 1),
(3270, 211, 'Atafu', 'A', 1),
(3271, 211, 'Fakaofo', 'F', 1),
(3272, 211, 'Nukunonu', 'N', 1),
(3273, 212, 'Ha\'apai', 'H', 1),
(3274, 212, 'Tongatapu', 'T', 1),
(3275, 212, 'Vava\'u', 'V', 1),
(3276, 213, 'Couva/Tabaquite/Talparo', 'CT', 1),
(3277, 213, 'Diego Martin', 'DM', 1),
(3278, 213, 'Mayaro/Rio Claro', 'MR', 1),
(3279, 213, 'Penal/Debe', 'PD', 1),
(3280, 213, 'Princes Town', 'PT', 1),
(3281, 213, 'Sangre Grande', 'SG', 1),
(3282, 213, 'San Juan/Laventille', 'SL', 1),
(3283, 213, 'Siparia', 'SI', 1),
(3284, 213, 'Tunapuna/Piarco', 'TP', 1),
(3285, 213, 'Port of Spain', 'PS', 1),
(3286, 213, 'San Fernando', 'SF', 1),
(3287, 213, 'Arima', 'AR', 1),
(3288, 213, 'Point Fortin', 'PF', 1),
(3289, 213, 'Chaguanas', 'CH', 1),
(3290, 213, 'Tobago', 'TO', 1),
(3291, 214, 'Ariana', 'AR', 1),
(3292, 214, 'Beja', 'BJ', 1),
(3293, 214, 'Ben Arous', 'BA', 1),
(3294, 214, 'Bizerte', 'BI', 1),
(3295, 214, 'Gabes', 'GB', 1),
(3296, 214, 'Gafsa', 'GF', 1),
(3297, 214, 'Jendouba', 'JE', 1),
(3298, 214, 'Kairouan', 'KR', 1),
(3299, 214, 'Kasserine', 'KS', 1),
(3300, 214, 'Kebili', 'KB', 1),
(3301, 214, 'Kef', 'KF', 1),
(3302, 214, 'Mahdia', 'MH', 1),
(3303, 214, 'Manouba', 'MN', 1),
(3304, 214, 'Medenine', 'ME', 1),
(3305, 214, 'Monastir', 'MO', 1),
(3306, 214, 'Nabeul', 'NA', 1),
(3307, 214, 'Sfax', 'SF', 1),
(3308, 214, 'Sidi', 'SD', 1),
(3309, 214, 'Siliana', 'SL', 1),
(3310, 214, 'Sousse', 'SO', 1),
(3311, 214, 'Tataouine', 'TA', 1),
(3312, 214, 'Tozeur', 'TO', 1),
(3313, 214, 'Tunis', 'TU', 1),
(3314, 214, 'Zaghouan', 'ZA', 1),
(3315, 215, 'Adana', 'ADA', 1),
(3316, 215, 'Adıyaman', 'ADI', 1),
(3317, 215, 'Afyonkarahisar', 'AFY', 1),
(3318, 215, 'Ağrı', 'AGR', 1),
(3319, 215, 'Aksaray', 'AKS', 1),
(3320, 215, 'Amasya', 'AMA', 1),
(3321, 215, 'Ankara', 'ANK', 1),
(3322, 215, 'Antalya', 'ANT', 1),
(3323, 215, 'Ardahan', 'ARD', 1),
(3324, 215, 'Artvin', 'ART', 1),
(3325, 215, 'Aydın', 'AYI', 1),
(3326, 215, 'Balıkesir', 'BAL', 1),
(3327, 215, 'Bartın', 'BAR', 1),
(3328, 215, 'Batman', 'BAT', 1),
(3329, 215, 'Bayburt', 'BAY', 1),
(3330, 215, 'Bilecik', 'BIL', 1),
(3331, 215, 'Bingöl', 'BIN', 1),
(3332, 215, 'Bitlis', 'BIT', 1),
(3333, 215, 'Bolu', 'BOL', 1),
(3334, 215, 'Burdur', 'BRD', 1),
(3335, 215, 'Bursa', 'BRS', 1),
(3336, 215, 'Çanakkale', 'CKL', 1),
(3337, 215, 'Çankırı', 'CKR', 1),
(3338, 215, 'Çorum', 'COR', 1),
(3339, 215, 'Denizli', 'DEN', 1),
(3340, 215, 'Diyarbakır', 'DIY', 1),
(3341, 215, 'Düzce', 'DUZ', 1),
(3342, 215, 'Edirne', 'EDI', 1),
(3343, 215, 'Elazığ', 'ELA', 1),
(3344, 215, 'Erzincan', 'EZC', 1),
(3345, 215, 'Erzurum', 'EZR', 1),
(3346, 215, 'Eskişehir', 'ESK', 1),
(3347, 215, 'Gaziantep', 'GAZ', 1),
(3348, 215, 'Giresun', 'GIR', 1),
(3349, 215, 'Gümüşhane', 'GMS', 1),
(3350, 215, 'Hakkari', 'HKR', 1),
(3351, 215, 'Hatay', 'HTY', 1),
(3352, 215, 'Iğdır', 'IGD', 1),
(3353, 215, 'Isparta', 'ISP', 1),
(3354, 215, 'İstanbul', 'IST', 1),
(3355, 215, 'İzmir', 'IZM', 1),
(3356, 215, 'Kahramanmaraş', 'KAH', 1),
(3357, 215, 'Karabük', 'KRB', 1),
(3358, 215, 'Karaman', 'KRM', 1),
(3359, 215, 'Kars', 'KRS', 1),
(3360, 215, 'Kastamonu', 'KAS', 1),
(3361, 215, 'Kayseri', 'KAY', 1),
(3362, 215, 'Kilis', 'KLS', 1),
(3363, 215, 'Kırıkkale', 'KRK', 1),
(3364, 215, 'Kırklareli', 'KLR', 1),
(3365, 215, 'Kırşehir', 'KRH', 1),
(3366, 215, 'Kocaeli', 'KOC', 1),
(3367, 215, 'Konya', 'KON', 1),
(3368, 215, 'Kütahya', 'KUT', 1),
(3369, 215, 'Malatya', 'MAL', 1),
(3370, 215, 'Manisa', 'MAN', 1),
(3371, 215, 'Mardin', 'MAR', 1),
(3372, 215, 'Mersin', 'MER', 1),
(3373, 215, 'Muğla', 'MUG', 1),
(3374, 215, 'Muş', 'MUS', 1),
(3375, 215, 'Nevşehir', 'NEV', 1),
(3376, 215, 'Niğde', 'NIG', 1),
(3377, 215, 'Ordu', 'ORD', 1),
(3378, 215, 'Osmaniye', 'OSM', 1),
(3379, 215, 'Rize', 'RIZ', 1),
(3380, 215, 'Sakarya', 'SAK', 1),
(3381, 215, 'Samsun', 'SAM', 1),
(3382, 215, 'Şanlıurfa', 'SAN', 1),
(3383, 215, 'Siirt', 'SII', 1),
(3384, 215, 'Sinop', 'SIN', 1),
(3385, 215, 'Şırnak', 'SIR', 1),
(3386, 215, 'Sivas', 'SIV', 1),
(3387, 215, 'Tekirdağ', 'TEL', 1),
(3388, 215, 'Tokat', 'TOK', 1),
(3389, 215, 'Trabzon', 'TRA', 1),
(3390, 215, 'Tunceli', 'TUN', 1),
(3391, 215, 'Uşak', 'USK', 1),
(3392, 215, 'Van', 'VAN', 1),
(3393, 215, 'Yalova', 'YAL', 1),
(3394, 215, 'Yozgat', 'YOZ', 1),
(3395, 215, 'Zonguldak', 'ZON', 1),
(3396, 216, 'Ahal Welayaty', 'A', 1),
(3397, 216, 'Balkan Welayaty', 'B', 1),
(3398, 216, 'Dashhowuz Welayaty', 'D', 1),
(3399, 216, 'Lebap Welayaty', 'L', 1),
(3400, 216, 'Mary Welayaty', 'M', 1),
(3401, 217, 'Ambergris Cays', 'AC', 1),
(3402, 217, 'Dellis Cay', 'DC', 1),
(3403, 217, 'French Cay', 'FC', 1),
(3404, 217, 'Little Water Cay', 'LW', 1),
(3405, 217, 'Parrot Cay', 'RC', 1),
(3406, 217, 'Pine Cay', 'PN', 1),
(3407, 217, 'Salt Cay', 'SL', 1),
(3408, 217, 'Grand Turk', 'GT', 1),
(3409, 217, 'South Caicos', 'SC', 1),
(3410, 217, 'East Caicos', 'EC', 1),
(3411, 217, 'Middle Caicos', 'MC', 1),
(3412, 217, 'North Caicos', 'NC', 1),
(3413, 217, 'Providenciales', 'PR', 1),
(3414, 217, 'West Caicos', 'WC', 1),
(3415, 218, 'Nanumanga', 'NMG', 1),
(3416, 218, 'Niulakita', 'NLK', 1),
(3417, 218, 'Niutao', 'NTO', 1),
(3418, 218, 'Funafuti', 'FUN', 1),
(3419, 218, 'Nanumea', 'NME', 1),
(3420, 218, 'Nui', 'NUI', 1),
(3421, 218, 'Nukufetau', 'NFT', 1),
(3422, 218, 'Nukulaelae', 'NLL', 1),
(3423, 218, 'Vaitupu', 'VAI', 1),
(3424, 219, 'Kalangala', 'KAL', 1),
(3425, 219, 'Kampala', 'KMP', 1),
(3426, 219, 'Kayunga', 'KAY', 1),
(3427, 219, 'Kiboga', 'KIB', 1),
(3428, 219, 'Luwero', 'LUW', 1),
(3429, 219, 'Masaka', 'MAS', 1),
(3430, 219, 'Mpigi', 'MPI', 1),
(3431, 219, 'Mubende', 'MUB', 1),
(3432, 219, 'Mukono', 'MUK', 1),
(3433, 219, 'Nakasongola', 'NKS', 1),
(3434, 219, 'Rakai', 'RAK', 1),
(3435, 219, 'Sembabule', 'SEM', 1),
(3436, 219, 'Wakiso', 'WAK', 1),
(3437, 219, 'Bugiri', 'BUG', 1),
(3438, 219, 'Busia', 'BUS', 1),
(3439, 219, 'Iganga', 'IGA', 1),
(3440, 219, 'Jinja', 'JIN', 1),
(3441, 219, 'Kaberamaido', 'KAB', 1),
(3442, 219, 'Kamuli', 'KML', 1),
(3443, 219, 'Kapchorwa', 'KPC', 1),
(3444, 219, 'Katakwi', 'KTK', 1),
(3445, 219, 'Kumi', 'KUM', 1),
(3446, 219, 'Mayuge', 'MAY', 1),
(3447, 219, 'Mbale', 'MBA', 1),
(3448, 219, 'Pallisa', 'PAL', 1),
(3449, 219, 'Sironko', 'SIR', 1),
(3450, 219, 'Soroti', 'SOR', 1),
(3451, 219, 'Tororo', 'TOR', 1),
(3452, 219, 'Adjumani', 'ADJ', 1),
(3453, 219, 'Apac', 'APC', 1),
(3454, 219, 'Arua', 'ARU', 1),
(3455, 219, 'Gulu', 'GUL', 1),
(3456, 219, 'Kitgum', 'KIT', 1),
(3457, 219, 'Kotido', 'KOT', 1),
(3458, 219, 'Lira', 'LIR', 1),
(3459, 219, 'Moroto', 'MRT', 1),
(3460, 219, 'Moyo', 'MOY', 1),
(3461, 219, 'Nakapiripirit', 'NAK', 1),
(3462, 219, 'Nebbi', 'NEB', 1),
(3463, 219, 'Pader', 'PAD', 1),
(3464, 219, 'Yumbe', 'YUM', 1),
(3465, 219, 'Bundibugyo', 'BUN', 1),
(3466, 219, 'Bushenyi', 'BSH', 1),
(3467, 219, 'Hoima', 'HOI', 1),
(3468, 219, 'Kabale', 'KBL', 1),
(3469, 219, 'Kabarole', 'KAR', 1),
(3470, 219, 'Kamwenge', 'KAM', 1),
(3471, 219, 'Kanungu', 'KAN', 1),
(3472, 219, 'Kasese', 'KAS', 1),
(3473, 219, 'Kibaale', 'KBA', 1),
(3474, 219, 'Kisoro', 'KIS', 1),
(3475, 219, 'Kyenjojo', 'KYE', 1),
(3476, 219, 'Masindi', 'MSN', 1),
(3477, 219, 'Mbarara', 'MBR', 1),
(3478, 219, 'Ntungamo', 'NTU', 1),
(3479, 219, 'Rukungiri', 'RUK', 1),
(3480, 220, 'Cherkas\'ka Oblast\'', '71', 1),
(3481, 220, 'Chernihivs\'ka Oblast\'', '74', 1),
(3482, 220, 'Chernivets\'ka Oblast\'', '77', 1),
(3483, 220, 'Crimea', '43', 1),
(3484, 220, 'Dnipropetrovs\'ka Oblast\'', '12', 1),
(3485, 220, 'Donets\'ka Oblast\'', '14', 1),
(3486, 220, 'Ivano-Frankivs\'ka Oblast\'', '26', 1),
(3487, 220, 'Khersons\'ka Oblast\'', '65', 1),
(3488, 220, 'Khmel\'nyts\'ka Oblast\'', '68', 1),
(3489, 220, 'Kirovohrads\'ka Oblast\'', '35', 1),
(3490, 220, 'Kyiv', '30', 1),
(3491, 220, 'Kyivs\'ka Oblast\'', '32', 1),
(3492, 220, 'Luhans\'ka Oblast\'', '09', 1),
(3493, 220, 'L\'vivs\'ka Oblast\'', '46', 1),
(3494, 220, 'Mykolayivs\'ka Oblast\'', '48', 1),
(3495, 220, 'Odes\'ka Oblast\'', '51', 1),
(3496, 220, 'Poltavs\'ka Oblast\'', '53', 1),
(3497, 220, 'Rivnens\'ka Oblast\'', '56', 1),
(3498, 220, 'Sevastopol\'', '40', 1),
(3499, 220, 'Sums\'ka Oblast\'', '59', 1),
(3500, 220, 'Ternopil\'s\'ka Oblast\'', '61', 1),
(3501, 220, 'Vinnyts\'ka Oblast\'', '05', 1),
(3502, 220, 'Volyns\'ka Oblast\'', '07', 1),
(3503, 220, 'Zakarpats\'ka Oblast\'', '21', 1),
(3504, 220, 'Zaporiz\'ka Oblast\'', '23', 1),
(3505, 220, 'Zhytomyrs\'ka oblast\'', '18', 1),
(3506, 221, 'Abu Zaby', 'AZ', 1),
(3507, 221, '\'Ajman', 'AJ', 1),
(3508, 221, 'Al Fujayrah', 'FU', 1),
(3509, 221, 'Ash Shariqah', 'SH', 1),
(3510, 221, 'Dubayy', 'DU', 1),
(3511, 221, 'R\'as al Khaymah', 'RK', 1),
(3512, 221, 'Umm al Qaywayn', 'UQ', 1),
(3513, 222, 'Aberdeen', 'ABN', 1),
(3514, 222, 'Aberdeenshire', 'ABNS', 1),
(3515, 222, 'Anglesey', 'ANG', 1),
(3516, 222, 'Angus', 'AGS', 1),
(3517, 222, 'Argyll and Bute', 'ARY', 1),
(3518, 222, 'Bedfordshire', 'BEDS', 1),
(3519, 222, 'Berkshire', 'BERKS', 1),
(3520, 222, 'Blaenau Gwent', 'BLA', 1),
(3521, 222, 'Bridgend', 'BRI', 1),
(3522, 222, 'Bristol', 'BSTL', 1),
(3523, 222, 'Buckinghamshire', 'BUCKS', 1),
(3524, 222, 'Caerphilly', 'CAE', 1),
(3525, 222, 'Cambridgeshire', 'CAMBS', 1),
(3526, 222, 'Cardiff', 'CDF', 1),
(3527, 222, 'Carmarthenshire', 'CARM', 1),
(3528, 222, 'Ceredigion', 'CDGN', 1),
(3529, 222, 'Cheshire', 'CHES', 1),
(3530, 222, 'Clackmannanshire', 'CLACK', 1),
(3531, 222, 'Conwy', 'CON', 1),
(3532, 222, 'Cornwall', 'CORN', 1),
(3533, 222, 'Denbighshire', 'DNBG', 1),
(3534, 222, 'Derbyshire', 'DERBY', 1),
(3535, 222, 'Devon', 'DVN', 1),
(3536, 222, 'Dorset', 'DOR', 1),
(3537, 222, 'Dumfries and Galloway', 'DGL', 1),
(3538, 222, 'Dundee', 'DUND', 1),
(3539, 222, 'Durham', 'DHM', 1),
(3540, 222, 'East Ayrshire', 'ARYE', 1),
(3541, 222, 'East Dunbartonshire', 'DUNBE', 1),
(3542, 222, 'East Lothian', 'LOTE', 1),
(3543, 222, 'East Renfrewshire', 'RENE', 1),
(3544, 222, 'East Riding of Yorkshire', 'ERYS', 1),
(3545, 222, 'East Sussex', 'SXE', 1),
(3546, 222, 'Edinburgh', 'EDIN', 1),
(3547, 222, 'Essex', 'ESX', 1),
(3548, 222, 'Falkirk', 'FALK', 1),
(3549, 222, 'Fife', 'FFE', 1),
(3550, 222, 'Flintshire', 'FLINT', 1),
(3551, 222, 'Glasgow', 'GLAS', 1),
(3552, 222, 'Gloucestershire', 'GLOS', 1),
(3553, 222, 'Greater London', 'LDN', 1),
(3554, 222, 'Greater Manchester', 'MCH', 1),
(3555, 222, 'Gwynedd', 'GDD', 1),
(3556, 222, 'Hampshire', 'HANTS', 1),
(3557, 222, 'Herefordshire', 'HWR', 1),
(3558, 222, 'Hertfordshire', 'HERTS', 1),
(3559, 222, 'Highlands', 'HLD', 1),
(3560, 222, 'Inverclyde', 'IVER', 1),
(3561, 222, 'Isle of Wight', 'IOW', 1),
(3562, 222, 'Kent', 'KNT', 1),
(3563, 222, 'Lancashire', 'LANCS', 1),
(3564, 222, 'Leicestershire', 'LEICS', 1),
(3565, 222, 'Lincolnshire', 'LINCS', 1),
(3566, 222, 'Merseyside', 'MSY', 1),
(3567, 222, 'Merthyr Tydfil', 'MERT', 1),
(3568, 222, 'Midlothian', 'MLOT', 1),
(3569, 222, 'Monmouthshire', 'MMOUTH', 1),
(3570, 222, 'Moray', 'MORAY', 1),
(3571, 222, 'Neath Port Talbot', 'NPRTAL', 1),
(3572, 222, 'Newport', 'NEWPT', 1),
(3573, 222, 'Norfolk', 'NOR', 1),
(3574, 222, 'North Ayrshire', 'ARYN', 1),
(3575, 222, 'North Lanarkshire', 'LANN', 1),
(3576, 222, 'North Yorkshire', 'YSN', 1),
(3577, 222, 'Northamptonshire', 'NHM', 1),
(3578, 222, 'Northumberland', 'NLD', 1),
(3579, 222, 'Nottinghamshire', 'NOT', 1),
(3580, 222, 'Orkney Islands', 'ORK', 1),
(3581, 222, 'Oxfordshire', 'OFE', 1),
(3582, 222, 'Pembrokeshire', 'PEM', 1),
(3583, 222, 'Perth and Kinross', 'PERTH', 1),
(3584, 222, 'Powys', 'PWS', 1),
(3585, 222, 'Renfrewshire', 'REN', 1),
(3586, 222, 'Rhondda Cynon Taff', 'RHON', 1),
(3587, 222, 'Rutland', 'RUT', 1),
(3588, 222, 'Scottish Borders', 'BOR', 1),
(3589, 222, 'Shetland Islands', 'SHET', 1),
(3590, 222, 'Shropshire', 'SPE', 1),
(3591, 222, 'Somerset', 'SOM', 1),
(3592, 222, 'South Ayrshire', 'ARYS', 1),
(3593, 222, 'South Lanarkshire', 'LANS', 1),
(3594, 222, 'South Yorkshire', 'YSS', 1),
(3595, 222, 'Staffordshire', 'SFD', 1),
(3596, 222, 'Stirling', 'STIR', 1),
(3597, 222, 'Suffolk', 'SFK', 1),
(3598, 222, 'Surrey', 'SRY', 1),
(3599, 222, 'Swansea', 'SWAN', 1),
(3600, 222, 'Torfaen', 'TORF', 1),
(3601, 222, 'Tyne and Wear', 'TWR', 1),
(3602, 222, 'Vale of Glamorgan', 'VGLAM', 1),
(3603, 222, 'Warwickshire', 'WARKS', 1),
(3604, 222, 'West Dunbartonshire', 'WDUN', 1),
(3605, 222, 'West Lothian', 'WLOT', 1),
(3606, 222, 'West Midlands', 'WMD', 1),
(3607, 222, 'West Sussex', 'SXW', 1),
(3608, 222, 'West Yorkshire', 'YSW', 1),
(3609, 222, 'Western Isles', 'WIL', 1),
(3610, 222, 'Wiltshire', 'WLT', 1),
(3611, 222, 'Worcestershire', 'WORCS', 1),
(3612, 222, 'Wrexham', 'WRX', 1),
(3613, 223, 'Alabama', 'AL', 1),
(3614, 223, 'Alaska', 'AK', 1),
(3615, 223, 'American Samoa', 'AS', 1),
(3616, 223, 'Arizona', 'AZ', 1),
(3617, 223, 'Arkansas', 'AR', 1),
(3618, 223, 'Armed Forces Africa', 'AF', 1),
(3619, 223, 'Armed Forces Americas', 'AA', 1),
(3620, 223, 'Armed Forces Canada', 'AC', 1),
(3621, 223, 'Armed Forces Europe', 'AE', 1),
(3622, 223, 'Armed Forces Middle East', 'AM', 1),
(3623, 223, 'Armed Forces Pacific', 'AP', 1),
(3624, 223, 'California', 'CA', 1),
(3625, 223, 'Colorado', 'CO', 1),
(3626, 223, 'Connecticut', 'CT', 1),
(3627, 223, 'Delaware', 'DE', 1),
(3628, 223, 'District of Columbia', 'DC', 1),
(3629, 223, 'Federated States Of Micronesia', 'FM', 1),
(3630, 223, 'Florida', 'FL', 1),
(3631, 223, 'Georgia', 'GA', 1),
(3632, 223, 'Guam', 'GU', 1),
(3633, 223, 'Hawaii', 'HI', 1),
(3634, 223, 'Idaho', 'ID', 1),
(3635, 223, 'Illinois', 'IL', 1),
(3636, 223, 'Indiana', 'IN', 1),
(3637, 223, 'Iowa', 'IA', 1),
(3638, 223, 'Kansas', 'KS', 1),
(3639, 223, 'Kentucky', 'KY', 1),
(3640, 223, 'Louisiana', 'LA', 1),
(3641, 223, 'Maine', 'ME', 1),
(3642, 223, 'Marshall Islands', 'MH', 1),
(3643, 223, 'Maryland', 'MD', 1),
(3644, 223, 'Massachusetts', 'MA', 1),
(3645, 223, 'Michigan', 'MI', 1),
(3646, 223, 'Minnesota', 'MN', 1),
(3647, 223, 'Mississippi', 'MS', 1),
(3648, 223, 'Missouri', 'MO', 1),
(3649, 223, 'Montana', 'MT', 1),
(3650, 223, 'Nebraska', 'NE', 1),
(3651, 223, 'Nevada', 'NV', 1),
(3652, 223, 'New Hampshire', 'NH', 1),
(3653, 223, 'New Jersey', 'NJ', 1),
(3654, 223, 'New Mexico', 'NM', 1),
(3655, 223, 'New York', 'NY', 1),
(3656, 223, 'North Carolina', 'NC', 1),
(3657, 223, 'North Dakota', 'ND', 1),
(3658, 223, 'Northern Mariana Islands', 'MP', 1),
(3659, 223, 'Ohio', 'OH', 1),
(3660, 223, 'Oklahoma', 'OK', 1),
(3661, 223, 'Oregon', 'OR', 1),
(3662, 223, 'Palau', 'PW', 1),
(3663, 223, 'Pennsylvania', 'PA', 1),
(3664, 223, 'Puerto Rico', 'PR', 1),
(3665, 223, 'Rhode Island', 'RI', 1),
(3666, 223, 'South Carolina', 'SC', 1),
(3667, 223, 'South Dakota', 'SD', 1),
(3668, 223, 'Tennessee', 'TN', 1),
(3669, 223, 'Texas', 'TX', 1),
(3670, 223, 'Utah', 'UT', 1),
(3671, 223, 'Vermont', 'VT', 1),
(3672, 223, 'Virgin Islands', 'VI', 1),
(3673, 223, 'Virginia', 'VA', 1),
(3674, 223, 'Washington', 'WA', 1),
(3675, 223, 'West Virginia', 'WV', 1),
(3676, 223, 'Wisconsin', 'WI', 1),
(3677, 223, 'Wyoming', 'WY', 1),
(3678, 224, 'Baker Island', 'BI', 1),
(3679, 224, 'Howland Island', 'HI', 1),
(3680, 224, 'Jarvis Island', 'JI', 1),
(3681, 224, 'Johnston Atoll', 'JA', 1),
(3682, 224, 'Kingman Reef', 'KR', 1),
(3683, 224, 'Midway Atoll', 'MA', 1),
(3684, 224, 'Navassa Island', 'NI', 1),
(3685, 224, 'Palmyra Atoll', 'PA', 1),
(3686, 224, 'Wake Island', 'WI', 1),
(3687, 225, 'Artigas', 'AR', 1),
(3688, 225, 'Canelones', 'CA', 1),
(3689, 225, 'Cerro Largo', 'CL', 1),
(3690, 225, 'Colonia', 'CO', 1),
(3691, 225, 'Durazno', 'DU', 1),
(3692, 225, 'Flores', 'FS', 1),
(3693, 225, 'Florida', 'FA', 1),
(3694, 225, 'Lavalleja', 'LA', 1),
(3695, 225, 'Maldonado', 'MA', 1),
(3696, 225, 'Montevideo', 'MO', 1),
(3697, 225, 'Paysandu', 'PA', 1),
(3698, 225, 'Rio Negro', 'RN', 1),
(3699, 225, 'Rivera', 'RV', 1),
(3700, 225, 'Rocha', 'RO', 1),
(3701, 225, 'Salto', 'SL', 1),
(3702, 225, 'San Jose', 'SJ', 1),
(3703, 225, 'Soriano', 'SO', 1),
(3704, 225, 'Tacuarembo', 'TA', 1),
(3705, 225, 'Treinta y Tres', 'TT', 1),
(3706, 226, 'Andijon', 'AN', 1),
(3707, 226, 'Buxoro', 'BU', 1),
(3708, 226, 'Farg\'ona', 'FA', 1),
(3709, 226, 'Jizzax', 'JI', 1),
(3710, 226, 'Namangan', 'NG', 1),
(3711, 226, 'Navoiy', 'NW', 1),
(3712, 226, 'Qashqadaryo', 'QA', 1),
(3713, 226, 'Qoraqalpog\'iston Republikasi', 'QR', 1),
(3714, 226, 'Samarqand', 'SA', 1),
(3715, 226, 'Sirdaryo', 'SI', 1),
(3716, 226, 'Surxondaryo', 'SU', 1),
(3717, 226, 'Toshkent City', 'TK', 1),
(3718, 226, 'Toshkent Region', 'TO', 1),
(3719, 226, 'Xorazm', 'XO', 1),
(3720, 227, 'Malampa', 'MA', 1),
(3721, 227, 'Penama', 'PE', 1),
(3722, 227, 'Sanma', 'SA', 1),
(3723, 227, 'Shefa', 'SH', 1),
(3724, 227, 'Tafea', 'TA', 1),
(3725, 227, 'Torba', 'TO', 1),
(3726, 229, 'Amazonas', 'AM', 1),
(3727, 229, 'Anzoategui', 'AN', 1),
(3728, 229, 'Apure', 'AP', 1),
(3729, 229, 'Aragua', 'AR', 1),
(3730, 229, 'Barinas', 'BA', 1),
(3731, 229, 'Bolivar', 'BO', 1),
(3732, 229, 'Carabobo', 'CA', 1),
(3733, 229, 'Cojedes', 'CO', 1),
(3734, 229, 'Delta Amacuro', 'DA', 1),
(3735, 229, 'Dependencias Federales', 'DF', 1),
(3736, 229, 'Distrito Federal', 'DI', 1),
(3737, 229, 'Falcon', 'FA', 1),
(3738, 229, 'Guarico', 'GU', 1),
(3739, 229, 'Lara', 'LA', 1),
(3740, 229, 'Merida', 'ME', 1),
(3741, 229, 'Miranda', 'MI', 1),
(3742, 229, 'Monagas', 'MO', 1),
(3743, 229, 'Nueva Esparta', 'NE', 1),
(3744, 229, 'Portuguesa', 'PO', 1),
(3745, 229, 'Sucre', 'SU', 1),
(3746, 229, 'Tachira', 'TA', 1),
(3747, 229, 'Trujillo', 'TR', 1),
(3748, 229, 'Vargas', 'VA', 1),
(3749, 229, 'Yaracuy', 'YA', 1),
(3750, 229, 'Zulia', 'ZU', 1),
(3751, 230, 'An Giang', 'AG', 1),
(3752, 230, 'Bac Giang', 'BG', 1),
(3753, 230, 'Bac Kan', 'BK', 1),
(3754, 230, 'Bac Lieu', 'BL', 1),
(3755, 230, 'Bac Ninh', 'BC', 1),
(3756, 230, 'Ba Ria-Vung Tau', 'BR', 1),
(3757, 230, 'Ben Tre', 'BN', 1),
(3758, 230, 'Binh Dinh', 'BH', 1),
(3759, 230, 'Binh Duong', 'BU', 1),
(3760, 230, 'Binh Phuoc', 'BP', 1),
(3761, 230, 'Binh Thuan', 'BT', 1),
(3762, 230, 'Ca Mau', 'CM', 1),
(3763, 230, 'Can Tho', 'CT', 1),
(3764, 230, 'Cao Bang', 'CB', 1),
(3765, 230, 'Dak Lak', 'DL', 1),
(3766, 230, 'Dak Nong', 'DG', 1),
(3767, 230, 'Da Nang', 'DN', 1),
(3768, 230, 'Dien Bien', 'DB', 1),
(3769, 230, 'Dong Nai', 'DI', 1),
(3770, 230, 'Dong Thap', 'DT', 1),
(3771, 230, 'Gia Lai', 'GL', 1),
(3772, 230, 'Ha Giang', 'HG', 1),
(3773, 230, 'Hai Duong', 'HD', 1),
(3774, 230, 'Hai Phong', 'HP', 1),
(3775, 230, 'Ha Nam', 'HM', 1),
(3776, 230, 'Ha Noi', 'HI', 1),
(3777, 230, 'Ha Tay', 'HT', 1),
(3778, 230, 'Ha Tinh', 'HH', 1),
(3779, 230, 'Hoa Binh', 'HB', 1),
(3780, 230, 'Ho Chi Minh City', 'HC', 1),
(3781, 230, 'Hau Giang', 'HU', 1),
(3782, 230, 'Hung Yen', 'HY', 1),
(3783, 232, 'Saint Croix', 'C', 1),
(3784, 232, 'Saint John', 'J', 1),
(3785, 232, 'Saint Thomas', 'T', 1),
(3786, 233, 'Alo', 'A', 1),
(3787, 233, 'Sigave', 'S', 1),
(3788, 233, 'Wallis', 'W', 1),
(3789, 235, 'Abyan', 'AB', 1),
(3790, 235, 'Adan', 'AD', 1),
(3791, 235, 'Amran', 'AM', 1),
(3792, 235, 'Al Bayda', 'BA', 1),
(3793, 235, 'Ad Dali', 'DA', 1),
(3794, 235, 'Dhamar', 'DH', 1),
(3795, 235, 'Hadramawt', 'HD', 1),
(3796, 235, 'Hajjah', 'HJ', 1),
(3797, 235, 'Al Hudaydah', 'HU', 1),
(3798, 235, 'Ibb', 'IB', 1),
(3799, 235, 'Al Jawf', 'JA', 1),
(3800, 235, 'Lahij', 'LA', 1),
(3801, 235, 'Ma\'rib', 'MA', 1),
(3802, 235, 'Al Mahrah', 'MR', 1),
(3803, 235, 'Al Mahwit', 'MW', 1),
(3804, 235, 'Sa\'dah', 'SD', 1),
(3805, 235, 'San\'a', 'SN', 1),
(3806, 235, 'Shabwah', 'SH', 1),
(3807, 235, 'Ta\'izz', 'TA', 1),
(3812, 237, 'Bas-Congo', 'BC', 1),
(3813, 237, 'Bandundu', 'BN', 1),
(3814, 237, 'Equateur', 'EQ', 1),
(3815, 237, 'Katanga', 'KA', 1),
(3816, 237, 'Kasai-Oriental', 'KE', 1),
(3817, 237, 'Kinshasa', 'KN', 1),
(3818, 237, 'Kasai-Occidental', 'KW', 1),
(3819, 237, 'Maniema', 'MA', 1),
(3820, 237, 'Nord-Kivu', 'NK', 1),
(3821, 237, 'Orientale', 'OR', 1),
(3822, 237, 'Sud-Kivu', 'SK', 1),
(3823, 238, 'Central', 'CE', 1),
(3824, 238, 'Copperbelt', 'CB', 1),
(3825, 238, 'Eastern', 'EA', 1),
(3826, 238, 'Luapula', 'LP', 1),
(3827, 238, 'Lusaka', 'LK', 1),
(3828, 238, 'Northern', 'NO', 1),
(3829, 238, 'North-Western', 'NW', 1),
(3830, 238, 'Southern', 'SO', 1),
(3831, 238, 'Western', 'WE', 1),
(3832, 239, 'Bulawayo', 'BU', 1),
(3833, 239, 'Harare', 'HA', 1),
(3834, 239, 'Manicaland', 'ML', 1),
(3835, 239, 'Mashonaland Central', 'MC', 1),
(3836, 239, 'Mashonaland East', 'ME', 1),
(3837, 239, 'Mashonaland West', 'MW', 1),
(3838, 239, 'Masvingo', 'MV', 1),
(3839, 239, 'Matabeleland North', 'MN', 1),
(3840, 239, 'Matabeleland South', 'MS', 1),
(3841, 239, 'Midlands', 'MD', 1),
(3861, 105, 'Campobasso', 'CB', 1),
(3862, 105, 'Carbonia-Iglesias', 'CI', 1),
(3863, 105, 'Caserta', 'CE', 1),
(3864, 105, 'Catania', 'CT', 1),
(3865, 105, 'Catanzaro', 'CZ', 1),
(3866, 105, 'Chieti', 'CH', 1),
(3867, 105, 'Como', 'CO', 1),
(3868, 105, 'Cosenza', 'CS', 1),
(3869, 105, 'Cremona', 'CR', 1),
(3870, 105, 'Crotone', 'KR', 1),
(3871, 105, 'Cuneo', 'CN', 1),
(3872, 105, 'Enna', 'EN', 1),
(3873, 105, 'Ferrara', 'FE', 1),
(3874, 105, 'Firenze', 'FI', 1),
(3875, 105, 'Foggia', 'FG', 1),
(3876, 105, 'Forli-Cesena', 'FC', 1),
(3877, 105, 'Frosinone', 'FR', 1),
(3878, 105, 'Genova', 'GE', 1),
(3879, 105, 'Gorizia', 'GO', 1),
(3880, 105, 'Grosseto', 'GR', 1),
(3881, 105, 'Imperia', 'IM', 1),
(3882, 105, 'Isernia', 'IS', 1),
(3883, 105, 'L&#39;Aquila', 'AQ', 1),
(3884, 105, 'La Spezia', 'SP', 1),
(3885, 105, 'Latina', 'LT', 1),
(3886, 105, 'Lecce', 'LE', 1),
(3887, 105, 'Lecco', 'LC', 1),
(3888, 105, 'Livorno', 'LI', 1),
(3889, 105, 'Lodi', 'LO', 1),
(3890, 105, 'Lucca', 'LU', 1),
(3891, 105, 'Macerata', 'MC', 1),
(3892, 105, 'Mantova', 'MN', 1),
(3893, 105, 'Massa-Carrara', 'MS', 1),
(3894, 105, 'Matera', 'MT', 1),
(3895, 105, 'Medio Campidano', 'VS', 1),
(3896, 105, 'Messina', 'ME', 1),
(3897, 105, 'Milano', 'MI', 1),
(3898, 105, 'Modena', 'MO', 1),
(3899, 105, 'Napoli', 'NA', 1),
(3900, 105, 'Novara', 'NO', 1),
(3901, 105, 'Nuoro', 'NU', 1),
(3902, 105, 'Ogliastra', 'OG', 1),
(3903, 105, 'Olbia-Tempio', 'OT', 1),
(3904, 105, 'Oristano', 'OR', 1),
(3905, 105, 'Padova', 'PD', 1),
(3906, 105, 'Palermo', 'PA', 1),
(3907, 105, 'Parma', 'PR', 1),
(3908, 105, 'Pavia', 'PV', 1),
(3909, 105, 'Perugia', 'PG', 1),
(3910, 105, 'Pesaro e Urbino', 'PU', 1),
(3911, 105, 'Pescara', 'PE', 1),
(3912, 105, 'Piacenza', 'PC', 1),
(3913, 105, 'Pisa', 'PI', 1),
(3914, 105, 'Pistoia', 'PT', 1),
(3915, 105, 'Pordenone', 'PN', 1),
(3916, 105, 'Potenza', 'PZ', 1),
(3917, 105, 'Prato', 'PO', 1),
(3918, 105, 'Ragusa', 'RG', 1),
(3919, 105, 'Ravenna', 'RA', 1),
(3920, 105, 'Reggio Calabria', 'RC', 1),
(3921, 105, 'Reggio Emilia', 'RE', 1),
(3922, 105, 'Rieti', 'RI', 1),
(3923, 105, 'Rimini', 'RN', 1),
(3924, 105, 'Roma', 'RM', 1),
(3925, 105, 'Rovigo', 'RO', 1),
(3926, 105, 'Salerno', 'SA', 1),
(3927, 105, 'Sassari', 'SS', 1),
(3928, 105, 'Savona', 'SV', 1),
(3929, 105, 'Siena', 'SI', 1),
(3930, 105, 'Siracusa', 'SR', 1),
(3931, 105, 'Sondrio', 'SO', 1),
(3932, 105, 'Taranto', 'TA', 1),
(3933, 105, 'Teramo', 'TE', 1),
(3934, 105, 'Terni', 'TR', 1),
(3935, 105, 'Torino', 'TO', 1),
(3936, 105, 'Trapani', 'TP', 1),
(3937, 105, 'Trento', 'TN', 1),
(3938, 105, 'Treviso', 'TV', 1),
(3939, 105, 'Trieste', 'TS', 1),
(3940, 105, 'Udine', 'UD', 1),
(3941, 105, 'Varese', 'VA', 1),
(3942, 105, 'Venezia', 'VE', 1),
(3943, 105, 'Verbano-Cusio-Ossola', 'VB', 1),
(3944, 105, 'Vercelli', 'VC', 1),
(3945, 105, 'Verona', 'VR', 1),
(3946, 105, 'Vibo Valentia', 'VV', 1),
(3947, 105, 'Vicenza', 'VI', 1),
(3948, 105, 'Viterbo', 'VT', 1),
(3949, 222, 'County Antrim', 'ANT', 1),
(3950, 222, 'County Armagh', 'ARM', 1),
(3951, 222, 'County Down', 'DOW', 1),
(3952, 222, 'County Fermanagh', 'FER', 1),
(3953, 222, 'County Londonderry', 'LDY', 1),
(3954, 222, 'County Tyrone', 'TYR', 1),
(3955, 222, 'Cumbria', 'CMA', 1),
(3956, 190, 'Pomurska', '1', 1),
(3957, 190, 'Podravska', '2', 1),
(3958, 190, 'Koroška', '3', 1),
(3959, 190, 'Savinjska', '4', 1),
(3960, 190, 'Zasavska', '5', 1),
(3961, 190, 'Spodnjeposavska', '6', 1),
(3962, 190, 'Jugovzhodna Slovenija', '7', 1),
(3963, 190, 'Osrednjeslovenska', '8', 1),
(3964, 190, 'Gorenjska', '9', 1),
(3965, 190, 'Notranjsko-kraška', '10', 1),
(3966, 190, 'Goriška', '11', 1),
(3967, 190, 'Obalno-kraška', '12', 1),
(3968, 33, 'Ruse', '', 1),
(3969, 101, 'Alborz', 'ALB', 1),
(3970, 21, 'Brussels-Capital Region', 'BRU', 1),
(3971, 138, 'Aguascalientes', 'AG', 1),
(3973, 242, 'Andrijevica', '01', 1),
(3974, 242, 'Bar', '02', 1),
(3975, 242, 'Berane', '03', 1),
(3976, 242, 'Bijelo Polje', '04', 1),
(3977, 242, 'Budva', '05', 1),
(3978, 242, 'Cetinje', '06', 1),
(3979, 242, 'Danilovgrad', '07', 1),
(3980, 242, 'Herceg-Novi', '08', 1),
(3981, 242, 'Kolašin', '09', 1),
(3982, 242, 'Kotor', '10', 1),
(3983, 242, 'Mojkovac', '11', 1),
(3984, 242, 'Nikšić', '12', 1),
(3985, 242, 'Plav', '13', 1),
(3986, 242, 'Pljevlja', '14', 1),
(3987, 242, 'Plužine', '15', 1),
(3988, 242, 'Podgorica', '16', 1),
(3989, 242, 'Rožaje', '17', 1),
(3990, 242, 'Šavnik', '18', 1),
(3991, 242, 'Tivat', '19', 1),
(3992, 242, 'Ulcinj', '20', 1),
(3993, 242, 'Žabljak', '21', 1),
(3994, 243, 'Belgrade', '00', 1),
(3995, 243, 'North Bačka', '01', 1),
(3996, 243, 'Central Banat', '02', 1),
(3997, 243, 'North Banat', '03', 1),
(3998, 243, 'South Banat', '04', 1),
(3999, 243, 'West Bačka', '05', 1),
(4000, 243, 'South Bačka', '06', 1),
(4001, 243, 'Srem', '07', 1),
(4002, 243, 'Mačva', '08', 1),
(4003, 243, 'Kolubara', '09', 1),
(4004, 243, 'Podunavlje', '10', 1),
(4005, 243, 'Braničevo', '11', 1),
(4006, 243, 'Šumadija', '12', 1),
(4007, 243, 'Pomoravlje', '13', 1),
(4008, 243, 'Bor', '14', 1),
(4009, 243, 'Zaječar', '15', 1),
(4010, 243, 'Zlatibor', '16', 1),
(4011, 243, 'Moravica', '17', 1),
(4012, 243, 'Raška', '18', 1),
(4013, 243, 'Rasina', '19', 1),
(4014, 243, 'Nišava', '20', 1),
(4015, 243, 'Toplica', '21', 1),
(4016, 243, 'Pirot', '22', 1),
(4017, 243, 'Jablanica', '23', 1),
(4018, 243, 'Pčinja', '24', 1),
(4020, 245, 'Bonaire', 'BO', 1),
(4021, 245, 'Saba', 'SA', 1),
(4022, 245, 'Sint Eustatius', 'SE', 1),
(4023, 248, 'Central Equatoria', 'EC', 1),
(4024, 248, 'Eastern Equatoria', 'EE', 1),
(4025, 248, 'Jonglei', 'JG', 1),
(4026, 248, 'Lakes', 'LK', 1),
(4027, 248, 'Northern Bahr el-Ghazal', 'BN', 1),
(4028, 248, 'Unity', 'UY', 1),
(4029, 248, 'Upper Nile', 'NU', 1),
(4030, 248, 'Warrap', 'WR', 1),
(4031, 248, 'Western Bahr el-Ghazal', 'BW', 1),
(4032, 248, 'Western Equatoria', 'EW', 1),
(4036, 117, 'Ainaži, Salacgrīvas novads', '0661405', 1),
(4037, 117, 'Aizkraukle, Aizkraukles novads', '0320201', 1),
(4038, 117, 'Aizkraukles novads', '0320200', 1),
(4039, 117, 'Aizpute, Aizputes novads', '0640605', 1),
(4040, 117, 'Aizputes novads', '0640600', 1),
(4041, 117, 'Aknīste, Aknīstes novads', '0560805', 1),
(4042, 117, 'Aknīstes novads', '0560800', 1),
(4043, 117, 'Aloja, Alojas novads', '0661007', 1),
(4044, 117, 'Alojas novads', '0661000', 1),
(4045, 117, 'Alsungas novads', '0624200', 1),
(4046, 117, 'Alūksne, Alūksnes novads', '0360201', 1),
(4047, 117, 'Alūksnes novads', '0360200', 1),
(4048, 117, 'Amatas novads', '0424701', 1),
(4049, 117, 'Ape, Apes novads', '0360805', 1),
(4050, 117, 'Apes novads', '0360800', 1),
(4051, 117, 'Auce, Auces novads', '0460805', 1),
(4052, 117, 'Auces novads', '0460800', 1),
(4053, 117, 'Ādažu novads', '0804400', 1),
(4054, 117, 'Babītes novads', '0804900', 1),
(4055, 117, 'Baldone, Baldones novads', '0800605', 1),
(4056, 117, 'Baldones novads', '0800600', 1),
(4057, 117, 'Baloži, Ķekavas novads', '0800807', 1),
(4058, 117, 'Baltinavas novads', '0384400', 1),
(4059, 117, 'Balvi, Balvu novads', '0380201', 1),
(4060, 117, 'Balvu novads', '0380200', 1),
(4061, 117, 'Bauska, Bauskas novads', '0400201', 1),
(4062, 117, 'Bauskas novads', '0400200', 1),
(4063, 117, 'Beverīnas novads', '0964700', 1),
(4064, 117, 'Brocēni, Brocēnu novads', '0840605', 1),
(4065, 117, 'Brocēnu novads', '0840601', 1),
(4066, 117, 'Burtnieku novads', '0967101', 1),
(4067, 117, 'Carnikavas novads', '0805200', 1),
(4068, 117, 'Cesvaine, Cesvaines novads', '0700807', 1),
(4069, 117, 'Cesvaines novads', '0700800', 1),
(4070, 117, 'Cēsis, Cēsu novads', '0420201', 1),
(4071, 117, 'Cēsu novads', '0420200', 1),
(4072, 117, 'Ciblas novads', '0684901', 1),
(4073, 117, 'Dagda, Dagdas novads', '0601009', 1),
(4074, 117, 'Dagdas novads', '0601000', 1),
(4075, 117, 'Daugavpils', '0050000', 1),
(4076, 117, 'Daugavpils novads', '0440200', 1),
(4077, 117, 'Dobele, Dobeles novads', '0460201', 1),
(4078, 117, 'Dobeles novads', '0460200', 1),
(4079, 117, 'Dundagas novads', '0885100', 1),
(4080, 117, 'Durbe, Durbes novads', '0640807', 1),
(4081, 117, 'Durbes novads', '0640801', 1),
(4082, 117, 'Engures novads', '0905100', 1),
(4083, 117, 'Ērgļu novads', '0705500', 1),
(4084, 117, 'Garkalnes novads', '0806000', 1),
(4085, 117, 'Grobiņa, Grobiņas novads', '0641009', 1),
(4086, 117, 'Grobiņas novads', '0641000', 1),
(4087, 117, 'Gulbene, Gulbenes novads', '0500201', 1),
(4088, 117, 'Gulbenes novads', '0500200', 1),
(4089, 117, 'Iecavas novads', '0406400', 1),
(4090, 117, 'Ikšķile, Ikšķiles novads', '0740605', 1),
(4091, 117, 'Ikšķiles novads', '0740600', 1),
(4092, 117, 'Ilūkste, Ilūkstes novads', '0440807', 1),
(4093, 117, 'Ilūkstes novads', '0440801', 1),
(4094, 117, 'Inčukalna novads', '0801800', 1),
(4095, 117, 'Jaunjelgava, Jaunjelgavas novads', '0321007', 1),
(4096, 117, 'Jaunjelgavas novads', '0321000', 1),
(4097, 117, 'Jaunpiebalgas novads', '0425700', 1),
(4098, 117, 'Jaunpils novads', '0905700', 1),
(4099, 117, 'Jelgava', '0090000', 1),
(4100, 117, 'Jelgavas novads', '0540200', 1),
(4101, 117, 'Jēkabpils', '0110000', 1),
(4102, 117, 'Jēkabpils novads', '0560200', 1),
(4103, 117, 'Jūrmala', '0130000', 1),
(4104, 117, 'Kalnciems, Jelgavas novads', '0540211', 1),
(4105, 117, 'Kandava, Kandavas novads', '0901211', 1),
(4106, 117, 'Kandavas novads', '0901201', 1),
(4107, 117, 'Kārsava, Kārsavas novads', '0681009', 1),
(4108, 117, 'Kārsavas novads', '0681000', 1),
(4109, 117, 'Kocēnu novads ,bij. Valmieras)', '0960200', 1),
(4110, 117, 'Kokneses novads', '0326100', 1),
(4111, 117, 'Krāslava, Krāslavas novads', '0600201', 1),
(4112, 117, 'Krāslavas novads', '0600202', 1),
(4113, 117, 'Krimuldas novads', '0806900', 1),
(4114, 117, 'Krustpils novads', '0566900', 1),
(4115, 117, 'Kuldīga, Kuldīgas novads', '0620201', 1),
(4116, 117, 'Kuldīgas novads', '0620200', 1),
(4117, 117, 'Ķeguma novads', '0741001', 1),
(4118, 117, 'Ķegums, Ķeguma novads', '0741009', 1),
(4119, 117, 'Ķekavas novads', '0800800', 1),
(4120, 117, 'Lielvārde, Lielvārdes novads', '0741413', 1),
(4121, 117, 'Lielvārdes novads', '0741401', 1),
(4122, 117, 'Liepāja', '0170000', 1),
(4123, 117, 'Limbaži, Limbažu novads', '0660201', 1),
(4124, 117, 'Limbažu novads', '0660200', 1),
(4125, 117, 'Līgatne, Līgatnes novads', '0421211', 1),
(4126, 117, 'Līgatnes novads', '0421200', 1),
(4127, 117, 'Līvāni, Līvānu novads', '0761211', 1),
(4128, 117, 'Līvānu novads', '0761201', 1),
(4129, 117, 'Lubāna, Lubānas novads', '0701413', 1),
(4130, 117, 'Lubānas novads', '0701400', 1),
(4131, 117, 'Ludza, Ludzas novads', '0680201', 1),
(4132, 117, 'Ludzas novads', '0680200', 1),
(4133, 117, 'Madona, Madonas novads', '0700201', 1),
(4134, 117, 'Madonas novads', '0700200', 1),
(4135, 117, 'Mazsalaca, Mazsalacas novads', '0961011', 1),
(4136, 117, 'Mazsalacas novads', '0961000', 1),
(4137, 117, 'Mālpils novads', '0807400', 1),
(4138, 117, 'Mārupes novads', '0807600', 1),
(4139, 117, 'Mērsraga novads', '0887600', 1),
(4140, 117, 'Naukšēnu novads', '0967300', 1),
(4141, 117, 'Neretas novads', '0327100', 1),
(4142, 117, 'Nīcas novads', '0647900', 1),
(4143, 117, 'Ogre, Ogres novads', '0740201', 1),
(4144, 117, 'Ogres novads', '0740202', 1),
(4145, 117, 'Olaine, Olaines novads', '0801009', 1),
(4146, 117, 'Olaines novads', '0801000', 1),
(4147, 117, 'Ozolnieku novads', '0546701', 1),
(4148, 117, 'Pārgaujas novads', '0427500', 1),
(4149, 117, 'Pāvilosta, Pāvilostas novads', '0641413', 1),
(4150, 117, 'Pāvilostas novads', '0641401', 1),
(4151, 117, 'Piltene, Ventspils novads', '0980213', 1),
(4152, 117, 'Pļaviņas, Pļaviņu novads', '0321413', 1),
(4153, 117, 'Pļaviņu novads', '0321400', 1),
(4154, 117, 'Preiļi, Preiļu novads', '0760201', 1),
(4155, 117, 'Preiļu novads', '0760202', 1),
(4156, 117, 'Priekule, Priekules novads', '0641615', 1),
(4157, 117, 'Priekules novads', '0641600', 1),
(4158, 117, 'Priekuļu novads', '0427300', 1),
(4159, 117, 'Raunas novads', '0427700', 1),
(4160, 117, 'Rēzekne', '0210000', 1),
(4161, 117, 'Rēzeknes novads', '0780200', 1),
(4162, 117, 'Riebiņu novads', '0766300', 1),
(4163, 117, 'Rīga', '0010000', 1),
(4164, 117, 'Rojas novads', '0888300', 1),
(4165, 117, 'Ropažu novads', '0808400', 1),
(4166, 117, 'Rucavas novads', '0648500', 1),
(4167, 117, 'Rugāju novads', '0387500', 1),
(4168, 117, 'Rundāles novads', '0407700', 1),
(4169, 117, 'Rūjiena, Rūjienas novads', '0961615', 1),
(4170, 117, 'Rūjienas novads', '0961600', 1),
(4171, 117, 'Sabile, Talsu novads', '0880213', 1),
(4172, 117, 'Salacgrīva, Salacgrīvas novads', '0661415', 1),
(4173, 117, 'Salacgrīvas novads', '0661400', 1),
(4174, 117, 'Salas novads', '0568700', 1),
(4175, 117, 'Salaspils novads', '0801200', 1),
(4176, 117, 'Salaspils, Salaspils novads', '0801211', 1),
(4177, 117, 'Saldus novads', '0840200', 1),
(4178, 117, 'Saldus, Saldus novads', '0840201', 1),
(4179, 117, 'Saulkrasti, Saulkrastu novads', '0801413', 1),
(4180, 117, 'Saulkrastu novads', '0801400', 1),
(4181, 117, 'Seda, Strenču novads', '0941813', 1),
(4182, 117, 'Sējas novads', '0809200', 1),
(4183, 117, 'Sigulda, Siguldas novads', '0801615', 1),
(4184, 117, 'Siguldas novads', '0801601', 1),
(4185, 117, 'Skrīveru novads', '0328200', 1),
(4186, 117, 'Skrunda, Skrundas novads', '0621209', 1),
(4187, 117, 'Skrundas novads', '0621200', 1),
(4188, 117, 'Smiltene, Smiltenes novads', '0941615', 1),
(4189, 117, 'Smiltenes novads', '0941600', 1),
(4190, 117, 'Staicele, Alojas novads', '0661017', 1),
(4191, 117, 'Stende, Talsu novads', '0880215', 1),
(4192, 117, 'Stopiņu novads', '0809600', 1),
(4193, 117, 'Strenči, Strenču novads', '0941817', 1),
(4194, 117, 'Strenču novads', '0941800', 1),
(4195, 117, 'Subate, Ilūkstes novads', '0440815', 1),
(4196, 117, 'Talsi, Talsu novads', '0880201', 1),
(4197, 117, 'Talsu novads', '0880200', 1),
(4198, 117, 'Tērvetes novads', '0468900', 1),
(4199, 117, 'Tukuma novads', '0900200', 1),
(4200, 117, 'Tukums, Tukuma novads', '0900201', 1),
(4201, 117, 'Vaiņodes novads', '0649300', 1),
(4202, 117, 'Valdemārpils, Talsu novads', '0880217', 1),
(4203, 117, 'Valka, Valkas novads', '0940201', 1),
(4204, 117, 'Valkas novads', '0940200', 1),
(4205, 117, 'Valmiera', '0250000', 1),
(4206, 117, 'Vangaži, Inčukalna novads', '0801817', 1),
(4207, 117, 'Varakļāni, Varakļānu novads', '0701817', 1),
(4208, 117, 'Varakļānu novads', '0701800', 1),
(4209, 117, 'Vārkavas novads', '0769101', 1),
(4210, 117, 'Vecpiebalgas novads', '0429300', 1),
(4211, 117, 'Vecumnieku novads', '0409500', 1),
(4212, 117, 'Ventspils', '0270000', 1),
(4213, 117, 'Ventspils novads', '0980200', 1),
(4214, 117, 'Viesīte, Viesītes novads', '0561815', 1),
(4215, 117, 'Viesītes novads', '0561800', 1),
(4216, 117, 'Viļaka, Viļakas novads', '0381615', 1),
(4217, 117, 'Viļakas novads', '0381600', 1),
(4218, 117, 'Viļāni, Viļānu novads', '0781817', 1),
(4219, 117, 'Viļānu novads', '0781800', 1),
(4220, 117, 'Zilupe, Zilupes novads', '0681817', 1),
(4221, 117, 'Zilupes novads', '0681801', 1),
(4222, 43, 'Arica y Parinacota', 'AP', 1),
(4223, 43, 'Los Rios', 'LR', 1),
(4224, 220, 'Kharkivs\'ka Oblast\'', '63', 1),
(4225, 44, '西藏自治区', 'TB', 1),
(4226, 44, '台湾省', 'TW', 1),
(4227, 44, '青海省', 'QH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mcc_zone_to_geo_zone`
--

DROP TABLE IF EXISTS `mcc_zone_to_geo_zone`;
CREATE TABLE `mcc_zone_to_geo_zone` (
  `zone_to_geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `geo_zone_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`zone_to_geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcc_zone_to_geo_zone`
--

INSERT INTO `mcc_zone_to_geo_zone` (`zone_to_geo_zone_id`, `country_id`, `zone_id`, `city_id`, `district_id`, `geo_zone_id`, `date_added`, `date_modified`) VALUES
(110, 44, 712, 0, 0, 4, '2015-04-01 22:11:53', '2015-04-01 22:23:18'),
(141, 44, 4226, 0, 0, 5, '2015-04-01 22:24:09', '2015-04-01 22:23:18'),
(140, 44, 696, 0, 0, 5, '2015-04-01 22:24:09', '2015-04-01 22:23:18'),
(139, 44, 704, 0, 0, 5, '2015-04-01 22:24:09', '2015-04-01 22:23:18'),
(138, 44, 694, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(137, 44, 706, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(136, 44, 686, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(135, 44, 703, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(134, 44, 691, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(133, 44, 687, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(132, 44, 688, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(131, 44, 698, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(130, 44, 697, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(129, 44, 692, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(128, 44, 714, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(127, 44, 695, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(126, 44, 693, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(125, 44, 701, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(124, 44, 700, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(123, 44, 690, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(122, 44, 689, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(121, 44, 709, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(120, 44, 707, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(119, 44, 684, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(118, 44, 711, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(117, 44, 710, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(116, 44, 702, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(115, 44, 685, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(114, 44, 713, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(113, 44, 708, 0, 0, 3, '2015-04-01 22:23:18', '2015-04-01 22:23:18'),
(111, 44, 4225, 0, 0, 4, '2015-04-01 22:11:53', '2015-04-01 22:23:18'),
(112, 44, 705, 0, 0, 4, '2015-04-01 22:11:53', '2015-04-01 22:23:18'),
(174, 44, 685, 18, 127, 6, '2017-08-19 15:58:20', '0000-00-00 00:00:00'),
(173, 44, 685, 18, 124, 6, '2017-08-19 15:58:20', '0000-00-00 00:00:00'),
(172, 44, 685, 18, 123, 6, '2017-08-19 15:58:20', '0000-00-00 00:00:00');
