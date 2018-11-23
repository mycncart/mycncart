<?php
require_once dirname(DIR_APPLICATION).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'extension'.DIRECTORY_SEPARATOR.'module'.DIRECTORY_SEPARATOR.'page_builder'.DIRECTORY_SEPARATOR.'shortcodes-func.php';
class ControllerExtensionModulePageBuilder extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/page_builder');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('extension/module/page_builder');
		$this->load->model('tool/image');
		$this->load->model('setting/module');
		
		/* Config */
		$this->urlWeb = $this->config->get('config_secure') ? $this->config->get('config_ssl') : $this->config->get('config_url');
		
		/* Get data */ 
		$page_builder = json_decode( $setting['page_builder'] );
	
		$data['font_ends'] 	= $this->_showPagebuilder($page_builder);
		$data['moduleid']	= $setting['moduleid'];
		$data['level']		= "1";
		$data['direction'] 	= $this->language->get('direction');
		$data['id_row_video'] = uniqid('row_').rand().time();
		$data['id_col_video'] = uniqid('col_').rand().time();
		$data['id_sec_video'] = uniqid('sec_').rand().time();
		
		/* Add Style */
		$this->document->addStyle('catalog/view/javascript/page_builder/css/style_render_'.$setting['moduleid'].'.css');	
		$this->document->addScript('catalog/view/javascript/page_builder/js/section.js');
		$this->document->addScript('catalog/view/javascript/page_builder/js/modernizr.video.js');
		$this->document->addScript('catalog/view/javascript/page_builder/js/swfobject.js');
		$this->document->addScript('catalog/view/javascript/page_builder/js/video_background.js');
		$this->document->addStyle('catalog/view/javascript/page_builder/css/style.css');	
		
		$template = 'extension/module/page_builder/default';
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/page_builder/default.twig')) {
			$template_ 		= $this->config->get('config_template') . '/template/extension/module/page_builder/default.twig';
			$template_row 	= $this->config->get('config_template') . '/template/extension/module/page_builder/default_row.twig';
		} else {
			$template_ 		= 'default/template/extension/module/page_builder/default.twig';
			$template_row 	= 'default/template/extension/module/page_builder/default_row.twig';
		}
		
		$data['template'] 		= $template_;
		$data['template_row'] 	= $template_row;			
		
		return $this->load->view($template, $data);
	}
    
	/* Show pagebuilder*/
	public function _showPagebuilder( $rows){ 
        $pagebuilder = array();
		
        foreach( $rows as $rkey =>  $row ){
			
            foreach( $row->cols as $ckey => $col ){
                foreach( $col->widgets as  $wkey => $w ){
					
                   if( isset($w->module) ){
	               		if( isset($w->type) && $w->type == "shortcode" && isset($w->content)){
							$w->content = $this->_callShortcode($w);
	               		}else {
							
	               			$w->content = $this->_callModule($w->module);	
							
	               		}
                   }
                }
                if( isset($col->rows) ){
                    $col->rows = $this->_showPagebuilder( $col->rows);     
                }
                $row->cols[$ckey] = $col;
			
            }
            $pagebuilder[$rkey] = $row;
        }
        return $pagebuilder;
    }
	
	/* Call module */
	protected function _callModule( $module  ){
		$part = explode('.', $module);
		
		if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
			return $this->load->controller('extension/module/' . $part[0]);
		}
	
		if (isset($part[1])) {
			$setting_info = $this->model_setting_module->getModule($part[1]);
			
			if ($setting_info && $setting_info['status']) {
				return $this->load->controller('extension/module/' . $part[0], $setting_info);
			}
		}
		return ;
	}
	
	/* Shortcode Attr*/
	function ytshortcode_atts($pairs, $atts) {
		$atts =(array)$atts;
		$out  = array();
		
		foreach($pairs as $name => $default) {
			if(array_key_exists($name, $atts))
				$out[$name] = $atts[$name];
			else
				$out[$name] = $default;
		}
		return $out;
	}
	
	/* Call Shortcode */
	protected function _callShortcode( $shortcode  ){
		$nameShortcode = $shortcode->shortcode;
		$content =  json_decode(html_entity_decode($shortcode->content));
		
		$contentP = $content->cparent;
		$contentC = $content->cchild;
		$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/shortcodes.css');
		$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/shortcodes.js');
		$func_shortcode = $nameShortcode.'YTShortcode';
		add_ytshortcode($nameShortcode);
		if(is_callable($func_shortcode)){
			$this->_addStyleAndScript($nameShortcode,$contentP);
			$database = $this->_getDatabase($shortcode);
			return $func_shortcode($contentP[0],$contentC,0,$shortcode->module,$database);
		}
		return ;
	}
	
	/* Add style with javascript of shortcode to Header*/
	private function _addStyleAndScript($nameShortcode,$data){
		switch($nameShortcode){
			case 'accordion' :
				if (!defined ('accordion_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/accordion/css/accordion.css');
					define( 'accordion_style', 1 );
				}
			break;
			case 'box' :
				if (!defined ('box_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/box/css/box.css');
					define( 'box_style', 1 );
				}
			break;
			case 'image_carousel' :
				if (!defined ('carousel_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/carousel.css');
					define( 'carousel_style', 1 );
				}
				if (!defined ('magnific_popup')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/magnific-popup.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/magnific-popup.js');
					define( 'magnific_popup', 1 );
				}
				if (!defined ('OWL_CAROUSEL')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/owl.carousel.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/owl.carousel.js');
					define( 'OWL_CAROUSEL', 1 );
				}
			break;
			case 'product_carousel' :
				if($data[0]->type_change == "vertical"){
					if (!defined ('slick_style')){
						$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/slick_pagebuilder.css');
						define( 'slick_style', 1 );
					}
					if (!defined ('SLICK_JS')){
						$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/slick.css');
						$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/slick.min.js');
						define( 'SLICK_JS', 1 );
					}
				}else{
					if (!defined ('carousel_style')){
						$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/carousel.css');
						define( 'carousel_style', 1 );
					}
					if (!defined ('OWL_CAROUSEL')){
						$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/owl.carousel.css');
						$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/owl.carousel.js');
						define( 'OWL_CAROUSEL', 1 );
					}
				}
				if (!defined ('magnific_popup')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/magnific-popup.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/magnific-popup.js');
					define( 'magnific_popup', 1 );
				}
				
			break;
			case 'contact_form' :
				if (!defined ('contact_form_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/contact_form/css/contact_form.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/contact_form/js/contact_form.js');
					define( 'contact_form_style', 1 );
				}
			break;
			case 'content_slider' :
				if (!defined ('content_slider_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/content_slider/css/content_slider.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/content_slider/js/content_slider.js');
					define( 'content_slider_style', 1 );
				}
				if (!defined ('OWL_CAROUSEL')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/animate.css');
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/owl.carousel.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/owl.carousel.js');
					define( 'OWL_CAROUSEL', 1 );
				}
			break;
			case 'countdown' :
				if (!defined ('countdown_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/countdown/css/countdown.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/countdown/js/jquery.countdown.js');
					define( 'countdown_style', 1 );
				}
			break;
			case 'counter' :
				if (!defined ('counter_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/counter/css/counter.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/jquery.appear.js');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/counter/js/countUp.js');
					define( 'counter_style', 1 );
				}
			break;
			case 'fancy_text' :
				if (!defined ('fancy_text_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/fancy_text/css/fancy_text.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/fancy_text/js/fancy_text.js');
					define( 'fancy_text_style', 1 );
				}
			break;
			case 'flickr' :
				if (!defined ('flickr_style')){
					if($data[0]->lightbox == "yes"){
						if (!defined ('magnific_popup')){
							$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/magnific-popup.css');
							$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/magnific-popup.js');
							define( 'magnific_popup', 1 );
						}
						$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/flickr/js/flickr-lightbox.js');
					}
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/flickr/css/flickr.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/flickr/js/flickr.js');
					define( 'flickr_style', 1 );
				}
			break;
			case 'gallery' :
				if (!defined ('gallery_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/gallery/css/gallery.css');
					if (!defined ('prettyPhoto')){
						$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/jquery.prettyPhoto.js');
						define( 'prettyPhoto', 1 );
					}
					define( 'gallery_style', 1 );
				}
			break;
			case 'google_map' :
				if (!defined ('google_map_style')){
					$this->document->addScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key='.$data[0]->key_text.'');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/google_map/js/gmap-styles.js');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/google_map/js/gmaps.js');
					define( 'google_map_style', 1 );
				}
			break;
			case 'lightbox' :
				if (!defined ('prettyPhoto')){
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/jquery.prettyPhoto.js');
					define( 'prettyPhoto', 1 );
				}
			break;
			case 'livicon' :
				if (!defined ('livicon_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/livicon/css/livicon.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/livicon/js/raphael.min.js');$this->document->addScript('admin/view/template/extension/module/page_builder/shortcodes/livicon/js/livicons.min.js');
					define( 'livicon_style', 1 );
				}
			break;
			case 'points' :
				if (!defined ('points_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/points/css/points.css');
					define( 'points_style', 1 );
				}
			break;
			case 'pricing_tables' :
				if (!defined ('pricing_tables_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/pricing_tables/css/pricingtable.css');
					define( 'pricing_tables_style', 1 );
				}
			case 'promotion_box' :
				if (!defined ('promotion_box_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/promotion_box/css/promotion.css');
					define( 'promotion_box_style', 1 );
				}
			break;
			case 'skills' :
				if (!defined ('skills_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/skills/css/skills.css');
					define( 'skills_style', 1 );
				}
			break;
			case 'social_icon' :
				if (!defined ('social_icon_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/social_icon/css/social_icon.css');
					define( 'social_icon_style', 1 );
				}
			break;
			case 'tabs' :
				if (!defined ('tabs_style')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/tabs/css/tabs.css');
					define( 'tabs_style', 1 );
				}
			break;
			case 'testimonial' :
				if (!defined ('OWL_CAROUSEL')){
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/animate.css');
					$this->document->addStyle('admin/view/template/extension/module/page_builder/assets/css/owl.carousel.css');
					$this->document->addScript('admin/view/template/extension/module/page_builder/assets/js/owl.carousel.js');
					define( 'OWL_CAROUSEL', 1 );
				}
				if (!defined ('testimonial_style'))	{
					$this->document->addStyle('admin/view/template/extension/module/page_builder/shortcodes/testimonial/css/style.css');
					define( 'testimonial_style', 1 );
				}
			break;
		}
		return;
	}
	
	/* Get database for element use data in Model */
	private function _getDatabase($shortcode){
		$nameShortcode = $shortcode->shortcode;
		$database = array();
		if (defined("HTTPS_CATALOG")) {
			$database['url'] = defined(HTTPS_CATALOG) ? HTTPS_CATALOG : HTTP_CATALOG;
		} else {
			$database['url'] = HTTPS_SERVER;
		}
		$database['language'] 		= $this->language;
		$database['language_id'] 	= $this->config->get('config_language_id') ;
		switch($nameShortcode){
			case 'product_carousel' :
				$content 			= json_decode(html_entity_decode($shortcode->content));
				$contentP 			= $content->cparent;
				$source  			= $contentP[0]->source;
				$limit				= $contentP[0]->limit;
				$product_sort		= $contentP[0]->product_sort;
				$product_order		= $contentP[0]->product_order;
				$database['list_image'] = array();
				foreach (array('media', 'category') as $type)
					if (strpos(trim($source), $type . ':') === 0) {
						$source = array(
							'type' => $type,
							'val' => (string) trim(str_replace(array($type . ':', ' '), '', $source), ',')
						);
						break;
				}
				
				if (isset($source['type']) && $source['type'] == 'category') {
					$category_id = (array) explode(',', $source['val']);
					/* check status category*/
					foreach($category_id as $category_item)
					{
						$checkCategory = $this->model_extension_module_page_builder->checkCategory($category_item);
						
						if(isset($checkCategory) && $checkCategory[0]['status'] == 1 && $checkCategory != null)
						{
							$category_list[] =  $category_item;
						}
					}
					$filter_data = array(
						'filter_category_id'  	=> implode(",",array_map('intval',$category_list)),
						'sort'         			=> $product_sort,
						'order'        			=> $product_order,
						'limit'        			=> $limit,
						'start' 	   			=> '0'
					);
					$product_list_id = $this->model_extension_module_page_builder->getProducts($filter_data);
					if($product_list_id != '' && count($product_list_id) != 0)
					{
						$dem = 0;
						foreach($product_list_id as $product_id)
						{
							if($dem == $limit) continue;
							$product_info = $this->model_catalog_product->getProduct($product_id);
							// get image
							$product_image = $this->model_extension_module_page_builder->getImageProduct($product_list_id);
							$product_image_first = array_shift($product_image);
							if ($product_info['image']) {
								$image = $product_info['image'];
							}elseif($product_image_first['image']){
								$image = $product_image_first['image'];
							} else {
								$image_name = "no_image.png";
								$image = $image_name;
							}
							// Check Version
							if(version_compare(VERSION, '2.1.0.2', '>')) {
								if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
									$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
								} else {
									$price = false;
								}

								if ((float)$product_info['special']) {
									$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
								} else {
									$special = false;
								}

								if ($this->config->get('config_tax')) {
									$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
								} else {
									$tax = false;
								}

								if ($this->config->get('config_review_status')) {
									$rating = $product_info['rating'];
								} else {
									$rating = false;
								}
							} else {
								if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
									$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
								} else {
									$price = false;
								}

								if ((float)$product_info['special']) {
									$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
								} else {
									$special = false;
								}

								if ($this->config->get('config_tax')) {
									$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
								} else {
									$tax = false;
								}

								if ($this->config->get('config_review_status')) {
									$rating = $product_info['rating'];
								} else {
									$rating = false;
								}
							}
							$database['list_image'][] = array(
								'product_id'  		=> $product_info['product_id'],
								'thumb'       		=> $image,
								'name'        		=> $product_info['name'],
								'description' 		=> $product_info['description'],
								'price'       		=> $price,
								'special'     		=> $special,
								'tax'         		=> $tax,
								'rating'      		=> $rating,
								'href'        		=> $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
							$dem++;
						}
					}
				}
			break;
			case 'contact_form':
				$database['config_mail_protocol'] 		= $this->config->get('config_mail_protocol');
				$database['config_mail_parameter'] 		= $this->config->get('config_mail_parameter');
				$database['config_mail_smtp_hostname'] 	= $this->config->get('config_mail_smtp_hostname');
				$database['config_mail_smtp_username'] 	= $this->config->get('config_mail_smtp_username');
				$database['config_mail_smtp_password'] 	= $this->config->get('config_mail_smtp_password');
				$database['config_mail_smtp_port'] 		= $this->config->get('config_mail_smtp_port');
				$database['config_mail_smtp_timeout'] 	= $this->config->get('config_mail_smtp_timeout');
				$database['config_email'] 				= $this->config->get('config_email');
				$database['config_name'] 				= $this->config->get('config_name');
			break;
		}
		return $database;
	}
}