<?php 
class YT_Data{
	/**
	 * Shortcode columns
	 */
	public static function columns() {
		return array(
			 '1' => "1",
			 '2' => "2",
			 '3' => "3",
			 '4' => "4",
			 '5' => "5",
			 '6' => "6",
		 );
	}
	
	/**
	 * Shortcode button type
	 */
	public static function buttons_type($language) {
		return array(
			 'none'   				=> 'None',
			 'social-blogger' 		=> 'Social Blogger',
			 'social-pinterest' 	=> 'Social Pinterest',
			 'social-spotify' 		=> 'Social Spotify',
			 "social-dribbble" 		=> 'Social Dribbble',
			 'social-myspace' 		=> 'Social Myspace',
			 'social-path' 			=> 'Social Path',
			 'social-facebook' 		=> 'Social Facebook',
			 'social-twitter' 		=> 'Social Twitter',
			 'social-linkedin' 		=> 'Social Linkedin',
			 'social-googleplus' 	=> 'Social Googleplus',
			 'social-stumbleupon' 	=> 'Social Stumbleupon',
			 'social-vimeo' 		=> 'Social Vimeo',
			 'social-behance'		=> 'Social Behance',
			 'social-youtube' 		=> 'Social Youtube',
			 'social-skype' 		=> 'Social skype',
			 'primary' 				=> 'Primary',
			 'info' 				=> 'Info',
			 'success' 				=> 'Success',
			 'warning' 				=> 'Warning',
			 'danger' 				=> 'Danger',
			 'link' 				=> 'Link'
		 );
	}
	
	/**
	 * Shortcode button style
	 */
	public static function style_buttons($language) {
		return array(
			'default' 			=> $language->get('shortcode_default'),
			'soft'    			=> $language->get('shortcode_soft'),
			'glass'   			=> $language->get('shortcode_glass'),
			'bubbles' 			=> $language->get('shortcode_bubbles'),
			'noise'   			=> $language->get('shortcode_noise'),
			'stroked' 			=> $language->get('shortcode_stroked'),
			'border' 			=> $language->get('shortcode_border'),
			'3d'     			=> $language->get('shortcode_3d'),
			'bottom_line'    	=> $language->get('shortcode_bottom_line'),
			'dropshadow' 		=> $language->get('shortcode_dropshadow'),
			'dot' 				=> $language->get('shortcode_dot'),
			'insetshadow' 		=> $language->get('shortcode_insetshadow'),
			'transparent' 		=> $language->get('shortcode_transparent'),
			'gradient' 			=> $language->get('shortcode_gradient')
		 );
	}
	
	/**
	 * Shortcode groups
	 */
	public static function groups($language) {
		return array(
			'all' 				=> $language->get('group_all'),
			'content' 			=> $language->get('group_content'),
			'box' 				=> $language->get('group_box'),
			//'media' 			=> $language->get('group_media'),
			'gallery' 			=> $language->get('group_gallery'),
			//'other' 			=> $language->get('group_other'),
		 );
	}
	
	/**
	 * Shortcode style accordion
	 */
	public static function style_accordion($language) {
		return array(
			'basic' => $language->get('shortcode_basic'),
			'line'  => $language->get('shortcode_line'),
			'border'=> $language->get('shortcode_border'), 
		 );
	}
	
	/**
	 * Shortcode type carousel
	 */
	public static function type_carousel($language) {
		return array(
			'horizontal' => $language->get('shortcode_horizontal'),
			'vertical'  => $language->get('shortcode_vertical')
		 );
	}
	
	/**
	 * Shortcode style box
	 */
	public static function style_box($language) {
		return array(
			'default' => $language->get('shortcode_default'),
			'soft'    => $language->get('shortcode_soft'),
			'glass'   => $language->get('shortcode_glass'),
			'bubbles' => $language->get('shortcode_bubbles'),
			'noise'   => $language->get('shortcode_noise')
		 );
	}
	
	/**
	 * Shortcode style feature box
	 */
	public static function style_feature_box($language) {
		return array(
			'style1' => $language->get('shortcode_style1'),
			'style2' => $language->get('shortcode_style2')
		 );
	}
	
	/**
	 * Shortcode type contact form
	 */
	public static function type_contact($language) {
		return array(
			'border'=> $language->get('shortcode_contact_border'),
			'line'  => $language->get('shortcode_contact_line'),
			'dot1'  => $language->get('shortcode_contact_dot1'),
			'dot2'  => $language->get('shortcode_contact_dot2')
		 );
	}
	
	/**
	 * Shortcode type btn reset
	 */
	public static function btn_contact($language) {
		return array(
			'default' => $language->get('shortcode_default'),
			'primary' => $language->get('shortcode_primary'),
			'success' => $language->get('shortcode_success'),
			'info'    => $language->get('shortcode_info'),
			'warning' => $language->get('shortcode_warning'),
			'danger'  => $language->get('shortcode_danger'),
			'border'  => $language->get('shortcode_border')
		 );
	}
	
	/**
	 * Shortcode style content slider
	 */
	public static function style_content_slider($language) {
		return array(
			'default' => $language->get('shortcode_default'),
			'dark'    => $language->get('shortcode_dark'),
			'light'   => $language->get('shortcode_light')
		 );
	}
	
	/**
	 * Shortcode type change content slider
	 */
	public static function type_change_content_slider($language) {
		return array(
			'fade'	=> $language->get('shortcode_fade'),
			'slide' => $language->get('shortcode_slide')
		 );
	}
	
	/**
	 * Shortcode arrow position
	 */
	public static function arrow_position($language) {
		return array(
			'arrow-default'      => $language->get('shortcode_default'),
			'arrow-top-left'     => $language->get('shortcode_top_left'),
			'arrow-top-right'    => $language->get('shortcode_top_right'),
			'arrow-bottom-left'  => $language->get('shortcode_bottom_left'),
			'arrow-bottom-right' => $language->get('shortcode_bottom_right')
		 );
	}
	
	/**
	 * Shortcode size social_icons
	 */
	public static function size_social_icons($language) {
		return array(
			'small' 	=> $language->get('shortcode_small'),
			'default' 	=> $language->get('shortcode_default'),
			'large' 	=> $language->get('shortcode_large'),
		 );
	}
	
	
	
	/**
	 * Shortcode align
	 */
	public static function aligns($language) {
		return array(
			'left'	=> $language->get('shortcode_left'),
			'right' => $language->get('shortcode_right'),
			'none' 	=> $language->get('shortcode_none')
		 );
	}
	
	/**
	 * Shortcode align center
	 */
	public static function aligns_center($language) {
		return array(
			'left'    	=> $language->get('shortcode_left'),
			'right'   	=> $language->get('shortcode_right'),
			'center' 	=> $language->get('shortcode_center'),
		 );
	}
	
	/**
	 * Shortcode text_align
	 */
	public static function text_align($language) {
		return array(
			'right'    	=> $language->get('shortcode_default'),
			'bottom' 	=> $language->get('shortcode_bottom'),
		 );
	}
	
	/**
	 * Shortcode type lightbox
	 */
	public static function type_lightbox($language) {
		return array(
			'none' 		=> $language->get('shortcode_none'),
			'inline' 	=> $language->get('shortcode_inline')
		 );
	}
	
	/**
	 * Shortcode style lightbox
	 */
	public static function style_lightbox($language) {
		return array(
			'none' 			=> $language->get('shortcode_none'),
			'borderInner' 	=> $language->get('shortcode_inline'),
			'shadow' 		=> $language->get('shortcode_shadow'),
			'border' 		=> $language->get('shortcode_border'),
			'reflect' 		=> $language->get('shortcode_reflect')
		 );
	}
	
	/**
	 * Shortcode type pricing table
	 */
	public static function type_pricing_tables($language) {
		return array(
			'style1' => $language->get('shortcode_style1'),
			'style2' => $language->get('shortcode_style2'),
			'style3' => $language->get('shortcode_style3')	
		 );
	}
	
	/**
	 * Shortcode divider
	 */
	public static function dividers($language) {
		return array(
			'none' 				=> $language->get('shortcode_none'),
			'spacer' 			=> $language->get('shortcode_spacer'),
			'dot'    			=> $language->get('shortcode_dot'),
			'comma'    			=> $language->get('shortcode_comma'),
			'colon'    			=> $language->get('shortcode_colon'),
			'vertical_line'   	=> $language->get('shortcode_vertical_line'),
			'horizontal_line'   => $language->get('shortcode_horizontal_line')
		 );
	}
	
	/**
	 * Shortcode product_sort
	 */
	public static function product_sorts($language) {
		return array(
			'pd_name'  		=> $language->get('shortcode_value_name'),
			'p_model'  		=> $language->get('shortcode_value_model'),
			'p_price'  		=> $language->get('shortcode_value_price'),
			'p_quantity' 	=> $language->get('shortcode_value_quantity'),
			'rating' 		=> $language->get('shortcode_value_rating'),
			'p_sort_order' 	=> $language->get('shortcode_value_sort_order'),
			'p_date_added' 	=> $language->get('shortcode_value_date_added'),
			'sell' 			=> $language->get('shortcode_value_sell')
		 );
	}
	
	/**
	 * Shortcode product_order
	 */
	public static function product_orders($language) {
		return array(
			'ASC'  		=> $language->get('shortcode_value_asc'),
			'DESC'  	=> $language->get('shortcode_value_desc')
		 );
	}
	
	/**
	 * Shortcode social_icons_style
	 */
	public static function social_icons_style($language) {
		return array(
			'default' 	=> $language->get('shortcode_default'),
			'min' 		=> $language->get('shortcode_min'),
			'circle' 	=> $language->get('shortcode_circle'),
			'flat' 		=> $language->get('shortcode_flat')
		 );
	}
	
	/**
	 * Shortcode type_tabs
	 */
	public static function type_tabs($language) {
		return array(
			'basic' 			=> $language->get('shortcode_basic'),
			'vertical'			=> $language->get('shortcode_vertical'),
			'vertical-right' 	=> $language->get('shortcode_vertical_right'),
			'boxed'   			=> $language->get('shortcode_boxed'),
			'underline' 		=> $language->get('shortcode_underline'),
			'curved' 			=> $language->get('shortcode_curved'),
			'curved-opened' 	=> $language->get('shortcode_curved_opened')
		 );
	}
	
	/**
	 * Shortcode map_type
	 */
	public static function map_types($language) {
		return array(
			'' 				=> $language->get('shortcode_default'),
			'map_style_1' 	=> $language->get('shortcode_subtle_grayscale'),
			'map_style_2' 	=> $language->get('shortcode_turquoise_water'),
			'map_style_3' 	=> $language->get('shortcode_blue_cyan'),
			'map_style_4' 	=> $language->get('shortcode_propia_effect'),
			'map_style_5' 	=> $language->get('shortcode_midnight_commander'),
			'map_style_6' 	=> $language->get('shortcode_lunar_landscape'),
			'map_style_7' 	=> $language->get('shortcode_mikiwat')
		 );
	}
	
	/**
	 * Shortcode zoom_control_style
	 */
	public static function zoom_control_styles($language) {
		return array(
			'SMALL' => $language->get('shortcode_small'),
			'LARGE' => $language->get('shortcode_large')
		 );
	}
	
	/**
	 * Shortcode style carousel
	 */
	public static function style_carousels($language) {
		return array(
			'1' => $language->get('shortcode_style1'),
			'2' => $language->get('shortcode_style2'),
			'3' => $language->get('shortcode_style3'),
			'4' => $language->get('shortcode_style4'),
			'5' => $language->get('shortcode_style5'),
		 );
	}
	
	/**
	 * Shortcode caption gallery
	 */
	public static function caption_gallery($language) {
		return array(
			'0'  	=> $language->get('shortcode_default'),
			'1'  	=> $language->get('shortcode_caption_1'),
			'2'  	=> $language->get('shortcode_caption_2')
		 );
	}
	
	/**
	 * Shortcode hover gallery
	 */
	public static function hover_gallery($language) {
		return array(
			'1' 	=> $language->get('shortcode_hover_1'),
			'2' 	=> $language->get('shortcode_hover_2')
		 );
	}
	
	
	/**
	 * Shortcode style_tabs
	 */
	public static function style_tabs($language) {
		return array(
			'' 			=> $language->get('shortcode_default'),
			'green' 	=> $language->get('shortcode_green'),
			'blue'  	=> $language->get('shortcode_blue'),
			'black' 	=> $language->get('shortcode_black'),
			'red'   	=> $language->get('shortcode_red'),
			'oranges' 	=> $language->get('shortcode_oranges'),
			'darkblue' 	=> $language->get('shortcode_darkblue'),
			'pink' 		=> $language->get('shortcode_pink'),
			'darkred' 	=> $language->get('shortcode_darkred'),
			'brown' 	=> $language->get('shortcode_brown'),
			'purple' 	=> $language->get('shortcode_purple'),
			'cyan' 		=> $language->get('shortcode_cyan')
		 );
	}
	
	/**
	 * Shortcode social_icons
	 */
	public static function social_icons($language) {
		return array(
			'facebook' 		=> $language->get('shortcode_facebook'),
			'twitter' 		=> $language->get('shortcode_twitter'),
			'google-plus' 	=> $language->get('shortcode_google_plus'),
			'pinterest' 	=> $language->get('shortcode_pinterest'),
			'dribbble' 		=> $language->get('shortcode_dribbble'),
			'flickr' 		=> $language->get('shortcode_flickr'),
			'linkedin' 		=> $language->get('shortcode_linkedin'),
			'rss' 			=> $language->get('shortcode_rss'),
			'skype' 		=> $language->get('shortcode_skype'),
			'youtube' 		=> $language->get('shortcode_youtube')
		 );
	}
	
	/**
	 * Shortcode target
	 */
	public static function target($language) {
		return array(
			'_self' 		=> $language->get('shortcode_self'),
			'_blank' 		=> $language->get('shortcode_blank'),
		 );
	}
	
	/**
	 * Shortcode Position
	 */
	public static function position($language) {
		return array(
			'left' 			=> $language->get('shortcode_left'),
			'right' 		=> $language->get('shortcode_right'),
		 );
	}
	
	/**
	 * Shortcode Size
	 */
	public static function size($language) {
		return array(
			'xs' 			=> $language->get('shortcode_size_xs'),
			'sm' 			=> $language->get('shortcode_size_sm'),
			'default' 		=> $language->get('shortcode_size_default'),
			'lg' 			=> $language->get('shortcode_size_lg'),
			'huge' 			=> $language->get('shortcode_size_huge')
		 );
	}
	
	/**
	 * Shortcode borders style
	 */
	public static function borders_style($language) {
		return array(
			'none' 		=> $language->get('shortcode_none'),
			'solid' 	=> $language->get('shortcode_solid'),
			'dotted' 	=> $language->get('shortcode_dotted'),
			'dashed' 	=> $language->get('shortcode_dashed'),
			'double' 	=> $language->get('shortcode_double'),
			'groove' 	=> $language->get('shortcode_groove'),
			'ridge' 	=> $language->get('shortcode_ridge'),
		 );
	}
	
	/**
	 * Font-Awesome icons
	 */
	public static function icons() {
		return array('glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'remove', 'close', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook-f', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-buoy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'rebel', 'ge', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'genderless', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'soccer-ball-o', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'shekel', 'sheqel', 'ils', 'meanpath', 'buysellads', 'connectdevelop', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'hotel', 'bed', 'viacoin', 'train', 'subway', 'medium');
	}

	/**
	 * Liv icons
	 */
	public static function livicons() {
		return array('at','balloons','bank','bomb','calculator','folders','ice-cream','medkit','paper-plane','wine','address-book','adjust','alarm','albums','align-center','align-justify','align-left','align-right','anchor','android','angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','angle-wide-down','angle-wide-left','angle-wide-right','angle-wide-up','apple','apple-logo','archive-add','archive-extract','arrow-circle-down','arrow-circle-left','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','asterisk','balance','ban','barchart','barcode','battery','beer','bell','bing','biohazard','bitbucket','blogger','bluetooth','bold','bolt','bookmark','bootstrap','briefcase','brightness-down','brightness-up','brush','bug','calendar','camcoder','camera','camera-alt','car','caret-down','caret-left','caret-right','caret-up','cellphone','certificate','check','check-circle','check-circle-alt','checked-off','checked-on','chevron-down','chevron-left','chevron-right','chevron-up','chrome','circle','circle-alt','clapboard','clip','clock','cloud','cloud-bolts','cloud-down','cloud-rain','cloud-snow','cloud-sun','cloud-up','code','collapse-down','collapse-up','columns','comment','comments','compass','concrete5','connect','credit-card','crop','css3','dashboard','desktop','deviantart','disconnect','doc-landscape','doc-portrait','download','download-alt','dribbble','drop','dropbox','edit','exchange','expand-left','expand-right','external-link','eye-close','eye-open','eyedropper','facebook','facebook-alt','file-export','file-import','film','filter','fire','firefox','flag','flickr','flickr-alt','folder-add','folder-flag','folder-lock','folder-new','folder-open','folder-remove','font','gear','gears','ghost','gift','github','github-alt','glass','globe','google-plus','google-plus-alt','hammer','hand-down','hand-left','hand-right','hand-up','heart','heart-alt','help','home','html5','ie','image','inbox','inbox-empty','inbox-in','inbox-out','indent-left','indent-right','info','instagram','ios','italic','jquery','key','lab','laptop','leaf','legal','linechart','link','linkedin','linkedin-alt','list','list-ol','list-ul','livicon','location','lock','magic','magic-alt','magnet','mail','mail-alt','map','medal','message-add','message-flag','message-in','message-lock','message-new','message-out','message-remove','microphone','minus','minus-alt','money','moon','more','morph-c-o','morph-c-s','morph-c-t-down','morph-c-t-left','morph-c-t-right','morph-c-t-up','morph-o-c','morph-o-s','morph-o-t-down','morph-o-t-left','morph-o-t-right','morph-o-t-up','morph-s-c','morph-s-o','morph-s-t-down','morph-s-t-left','morph-s-t-right','morph-s-t-up','morph-t-down-c','morph-t-down-o','morph-t-down-s','morph-t-left-c','morph-t-left-o','morph-t-left-s','morph-t-right-c','morph-t-right-o','morph-t-right-s','morph-t-up-c','morph-t-up-o','morph-t-up-s','move','music','myspace','new-window','notebook','opera','pacman','paypal','pen','pencil','phone','piechart','piggybank','pin-off','pin-on','pinterest','pinterest-alt','plane-down','plane-up','playlist','plus','plus-alt','presentation','printer','qrcode','question','quote-left','quote-right','raphael','recycled','reddit','redo','refresh','remove','remove-alt','remove-circle','resize-big','resize-big-alt','resize-horizontal','resize-horizontal-alt','resize-small','resize-small-alt','resize-vertical','resize-vertical-alt','responsive','responsive-menu','retweet','rocket','rotate-left','rotate-right','rss','safari','sandglass','save','scissors','screen-full','screen-full-alt','screen-small','screen-small-alt','screenshot','search','servers','settings','share','shield','shopping-cart','shopping-cart-in','shopping-cart-out','shuffle','sign-in','sign-out','signal','sitemap','sky-dish','skype','sort','sort-down','sort-up','soundcloud','speaker','spinner-five','spinner-four','spinner-one','spinner-seven','spinner-six','spinner-three','spinner-two','star-empty','star-full','star-half','stopwatch','striked','stumbleupon','stumbleupon-alt','sun','table','tablet','tag','tags','tasks','text-decrease','text-height','text-increase','text-size','text-width','thermo-down','thermo-up','thumbnails-big','thumbnails-small','thumbs-down','thumbs-up','timer','trash','tree','trophy','truck','tumblr','twitter','twitter-alt','umbrella','underline','undo','unlink','unlock','upload','upload-alt','user','user-add','user-ban','user-flag','user-remove','users','users-add','users-ban','users-remove','vector-circle','vector-curve','vector-line','vector-polygon','vector-square','video-backward','video-eject','video-fast-backward','video-fast-forward','video-forward','video-pause','video-play','video-play-alt','video-step-backward','video-step-forward','video-stop','vimeo','vk','warning','warning-alt','webcam','wifi','wifi-alt','windows','windows8','wordpress','wordpress-alt','wrench','xing','yahoo','youtube','zoom-in','zoom-out');
	}

	/**
	 * Animate.css animations
	 */
	public static function animations() {
		return array('bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp', 'bounceOut', 'bounceOutDown', 'bounceOutLeft', 'bounceOutRight', 'bounceOutUp', 'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig', 'fadeOut', 'fadeOutDown', 'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig', 'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig', 'flip', 'flipInX', 'flipInY', 'flipOutX', 'flipOutY', 'lightSpeedIn', 'lightSpeedOut', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight', 'hinge', 'rollIn', 'rollOut', 'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp', 'zoomOut', 'zoomOutDown', 'zoomOutLeft', 'zoomOutRight', 'zoomOutUp', 'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble');
	}

	public static function animations_in() {
			return array('bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp', 'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig', 'flipInX', 'flipInY', 'lightSpeedIn', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'rollIn', 'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp');
		}
		
	public static function animations_out() {
			return array('bounceOut', 'bounceOutDown', 'bounceOutLeft', 'bounceOutRight', 'bounceOutUp', 'fadeOut', 'fadeOutDown', 'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig', 'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig', 'flipOutX', 'flipOutY', 'lightSpeedOut', 'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight', 'rollOut', 'zoomOut', 'zoomOutDown', 'zoomOutLeft', 'zoomOutRight', 'zoomOutUp');
		}

	/**
	 * Easing script animations
	 */
	public static function easings() {
		return array('linear', 'swing', 'jswing', 'easeInQuad', 'easeInCubic', 'easeInQuart', 'easeInQuint', 'easeInSine', 'easeInExpo', 'easeInCirc', 'easeInElastic', 'easeInBack', 'easeInBounce', 'easeOutQuad', 'easeOutCubic', 'easeOutQuart', 'easeOutQuint', 'easeOutSine', 'easeOutExpo', 'easeOutCirc', 'easeOutElastic', 'easeOutBack', 'easeOutBounce', 'easeInOutQuad', 'easeInOutCubic', 'easeInOutQuart', 'easeInOutQuint', 'easeInOutSine', 'easeInOutExpo', 'easeInOutCirc', 'easeInOutElastic', 'easeInOutBack', 'easeInOutBounce');
	}
}
?>