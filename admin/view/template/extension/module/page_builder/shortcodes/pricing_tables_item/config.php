<?php 
class YT_Shortcode_pricing_tables_item_config {
	static function get_config($language,$value) {
		$multiLanguage = explode(',',$value['language']);
		$title_arr = array();
		$button_label_arr = array();
		$yt_text_arr = array();
		$content_arr = array();
		$yt_title = (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Pricing Tables');
		$button_label = (is_array($value) && isset($value['button_label']) ? $value['button_label'] : 'Pringcing button label');
		$yt_text = (is_array($value) && isset($value['yt_text']) ? $value['yt_text'] : 'Sales');
		$content = (is_array($value) && isset($value['content']) ? $value['content'] : "<ul class='pricing-list'>
								<li> Disk Space <strong>10 GB</strong> </li>
								<li> Bandwidth <strong>Unlimited </strong>  </li>
								<li> Setup Free <a class='boxtip' rel='tooltip' data-original-title='TEXT_TOOLTIP' href='#' >(?) </a></li>
								<li> <strong>1 </strong> Free Email Accounts <a class='boxtip' rel='tooltip' data-original-title='TEXT_TOOLTIP' href='#' >(?) </a></li>
								<li> <strong>1 </strong> FTP Accounts</li>
								<li> Half Privacy</li>
							</ul>");
		foreach($multiLanguage as $language_)
		{
			$title_arr['yt_title_'.$language_] = (is_array($value) && isset($value['yt_title_'.$language_]) ? $value['yt_title_'.$language_] : $yt_title);
			$button_label_arr['button_label_'.$language_] = (is_array($value) && isset($value['button_label_'.$language_]) ? $value['button_label_'.$language_] : $button_label);
			$yt_text_arr['yt_text_'.$language_] = (is_array($value) && isset($value['yt_text_'.$language_]) ? $value['yt_text_'.$language_] : $yt_text);
			$content_arr['content_'.$language_] = (is_array($value) && isset($value['content_'.$language_]) ? $value['content_'.$language_] : $content);
		}
		return array(
			'yt_title' 		=> array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value['yt_title']) ? $value['yt_title'] : 'Pricing Tables'),
				'values'	=> $title_arr,
				'name' 		=> $language->get('shortcode_pricing_table_title'),
				'desc' 		=> $language->get('shortcode_pricing_table_title_desc'),
				'child' 	=> array(
					'icon_name' 	=> array(
						'type' 		=> 'icon',
						'default' 	=> (is_array($value) && isset($value['icon_name']) ? $value['icon_name'] : 'icon:plus'),
						'name' 		=> $language->get('shortcode_icon'),
						'desc' 		=> $language->get('shortcode_icon_desc')
					),
				),
			),
			'button_link'	=> array(
				'default' 	=> (is_array($value) && isset($value['button_link']) ? $value['button_link'] : 'http://'),
				'name' 		=> $language->get('shortcode_pricing_table_button_link'),
				'desc' 		=> $language->get('shortcode_pricing_table_button_link_desc'),
				'child' 	=> array(
					'button_label' 	=> array(
						'type' 		=> 'textLanguage',
						'default' 	=> (is_array($value) && isset($value['button_label']) ? $value['button_label'] : 'Pringcing button label'),
						'values'	=> $button_label_arr,
						'name' 		=> $language->get('shortcode_pricing_table_button_label'),
						'desc' 		=> $language->get('shortcode_pricing_table_button_label_desc'),
					),
				),
			),
			'price' => array(
				'default' 	=> (is_array($value) && isset($value['price']) ? $value['price'] : ''),
				'name' 		=> $language->get('shortcode_pricing_table_price'),
				'desc' 		=> $language->get('shortcode_pricing_table_price_desc'),
				'child' => array(
					'featured' => array(
						'type' 		=> 'bool',
						'default' 	=> (is_array($value) && isset($value['featured']) ? $value['featured'] : 'no'),
						'name' 		=> $language->get('shortcode_pricing_table_featured'),
						'desc' 		=> $language->get('shortcode_pricing_table_featured_desc'),
					),
				),
			),
			'yt_text' => array(
				'type' 		=> 'textLanguage',
				'default' 	=> (is_array($value) && isset($value['yt_text']) ? $value['yt_text'] : 'Sales'),
				'values'	=> $yt_text_arr,
				'name' 		=> $language->get('shortcode_pricing_table_text'),
				'desc' 		=> $language->get('shortcode_pricing_table_text_desc')
			),
			'background' => array(
				'type' 		=> 'color',
				'default' 	=> (is_array($value) && isset($value['background']) ? $value['background'] : '#4e9e41'),
				'name' 		=> $language->get('shortcode_background'),
				'desc' 		=> $language->get('shortcode_background_desc'),
				'child' => array(
					'color'=> array(
						'type' 		=> 'color',
						'default' 	=> (is_array($value) && isset($value['color']) ? $value['color'] : '#ffffff'),
						'name' 		=> $language->get('shortcode_color'),
						'desc'	 	=> $language->get('shortcode_color_desc')
					),
				),	
			),
			'content' => array(
				'type' 		=> 'textareaEditorLanguage',
				'default' 	=> (is_array($value) && isset($value['text_content']) ? $value['text_content'] : "<ul class='pricing-list'>
								<li> Disk Space <strong>10 GB</strong> </li>
								<li> Bandwidth <strong>Unlimited </strong>  </li>
								<li> Setup Free <a class='boxtip' rel='tooltip' data-original-title='TEXT_TOOLTIP' href='#' >(?) </a></li>
								<li> <strong>1 </strong> Free Email Accounts <a class='boxtip' rel='tooltip' data-original-title='TEXT_TOOLTIP' href='#' >(?) </a></li>
								<li> <strong>1 </strong> FTP Accounts</li>
								<li> Half Privacy</li>
							</ul>"),
				'values'	=> $content_arr,
				'name' 		=> $language->get('shortcode_content'),
			),
		);
	}
}

?>