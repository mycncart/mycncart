<?php
class ControllerCmsBlogConfig extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('cms/blog_config');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('cms_blog', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('cms/blog_config', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_edit');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_large'] = $this->language->get('text_large');
		$data['text_middle'] = $this->language->get('text_middle');
		$data['text_small'] = $this->language->get('text_small');
		
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_cms_blog_seo_keyword'] = $this->language->get('entry_cms_blog_seo_keyword');
		$data['entry_cms_blog_large_image'] = $this->language->get('entry_cms_blog_large_image');
		$data['entry_cms_blog_large_image_width'] = $this->language->get('entry_cms_blog_large_image_width');
		$data['entry_cms_blog_large_image_height'] = $this->language->get('entry_cms_blog_large_image_height');
		$data['entry_cms_blog_middle_image'] = $this->language->get('entry_cms_blog_middle_image');
		$data['entry_cms_blog_middle_image_width'] = $this->language->get('entry_cms_blog_middle_image_width');
		$data['entry_cms_blog_middle_image_height'] = $this->language->get('entry_cms_blog_middle_image_height');
		$data['entry_cms_blog_small_image'] = $this->language->get('entry_cms_blog_small_image');
		$data['entry_cms_blog_small_image_width'] = $this->language->get('entry_cms_blog_small_image_width');
		$data['entry_cms_blog_small_image_height'] = $this->language->get('entry_cms_blog_small_image_height');
		$data['entry_cms_blog_items_per_page'] = $this->language->get('entry_cms_blog_items_per_page');
		
		$data['entry_cms_blog_category_page_blog_image_type'] = $this->language->get('entry_cms_blog_category_page_blog_image_type');
		$data['entry_cms_blog_children_columns'] = $this->language->get('entry_cms_blog_children_columns');
		$data['entry_cms_blog_category_image_demension'] = $this->language->get('entry_cms_blog_category_image_demension');
		$data['entry_cms_blog_general_cwidth'] = $this->language->get('entry_cms_blog_general_cwidth');
		$data['entry_cms_blog_general_cheight'] = $this->language->get('entry_cms_blog_general_cheight');
		$data['entry_cms_blog_category_limit_leading_blog'] = $this->language->get('entry_cms_blog_category_limit_leading_blog');
		$data['entry_cms_blog_category_limit_secondary_blog'] = $this->language->get('entry_cms_blog_category_limit_secondary_blog');
		$data['entry_cms_blog_category_leading_image_type'] = $this->language->get('entry_cms_blog_category_leading_image_type');
		$data['entry_cms_blog_category_secondary_image_type'] = $this->language->get('entry_cms_blog_category_secondary_image_type');
		$data['entry_cms_blog_category_columns_leading_blog'] = $this->language->get('entry_cms_blog_category_columns_leading_blog');
		$data['entry_cms_blog_category_columns_secondary_blogs'] = $this->language->get('entry_cms_blog_category_columns_secondary_blogs');
		$data['entry_cms_blog_category_page_show_title'] = $this->language->get('entry_cms_blog_category_page_show_title');
		$data['entry_cms_blog_category_page_show_brief'] = $this->language->get('entry_cms_blog_category_page_show_brief');
		$data['entry_cms_blog_category_page_show_readmore'] = $this->language->get('entry_cms_blog_category_page_show_readmore');
		$data['entry_cms_blog_category_page_show_image'] = $this->language->get('entry_cms_blog_category_page_show_image');
		$data['entry_cms_blog_category_page_show_author'] = $this->language->get('entry_cms_blog_category_page_show_author');
		$data['entry_cms_blog_category_page_show_category'] = $this->language->get('entry_cms_blog_category_page_show_category');
		$data['entry_cms_blog_category_page_show_created_date'] = $this->language->get('entry_cms_blog_category_page_show_created_date');
		$data['entry_cms_blog_category_page_show_hits'] = $this->language->get('entry_cms_blog_category_page_show_hits');
		$data['entry_cms_blog_category_page_show_comment_counter'] = $this->language->get('entry_cms_blog_category_page_show_comment_counter');
		
		$data['entry_cms_blog_image_type'] = $this->language->get('entry_cms_blog_image_type');
		$data['entry_cms_blog_show_title'] = $this->language->get('entry_cms_blog_show_title');
		$data['entry_cms_blog_show_image'] = $this->language->get('entry_cms_blog_show_image');
		$data['entry_cms_blog_show_author'] = $this->language->get('entry_cms_blog_show_author');
		$data['entry_cms_blog_show_category'] = $this->language->get('entry_cms_blog_show_category');
		$data['entry_cms_blog_show_product_related'] = $this->language->get('entry_cms_blog_show_product_related');
		$data['entry_cms_blog_product_scroll_related'] = $this->language->get('entry_cms_blog_product_scroll_related');
		$data['entry_cms_blog_product_related_per_row'] = $this->language->get('entry_cms_blog_product_related_per_row');
		
		$data['entry_cms_blog_show_blog_related'] = $this->language->get('entry_cms_blog_show_blog_related');
		$data['entry_cms_blog_article_scroll_related'] = $this->language->get('entry_cms_blog_article_scroll_related');
		$data['entry_cms_blog_article_related_per_row'] = $this->language->get('entry_cms_blog_article_related_per_row');
		$data['entry_cms_blog_show_created_date'] = $this->language->get('entry_cms_blog_show_created_date');
		$data['entry_cms_blog_show_hits'] = $this->language->get('entry_cms_blog_show_hits');
		$data['entry_cms_blog_show_comment_counter'] = $this->language->get('entry_cms_blog_show_comment_counter');
		$data['entry_cms_blog_show_comment_form'] = $this->language->get('entry_cms_blog_show_comment_form');
		$data['entry_cms_blog_show_auto_publish_comment'] = $this->language->get('entry_cms_blog_show_auto_publish_comment');
		$data['entry_cms_blog_show_recaptcha'] = $this->language->get('entry_cms_blog_show_recaptcha');
		$data['entry_cms_blog_show_need_login_to_comment'] = $this->language->get('entry_cms_blog_show_need_login_to_comment');
		
		$data['entry_cms_blog_comment_email'] = $this->language->get('entry_cms_blog_comment_email');
		$data['entry_cms_blog_brief_length'] = $this->language->get('entry_cms_blog_brief_length');
		$data['entry_cms_blog_comment_length'] = $this->language->get('entry_cms_blog_comment_length');

		$data['help_cms_blog_seo_keyword'] = $this->language->get('help_cms_blog_seo_keyword');
		$data['help_cms_blog_brief_length'] = $this->language->get('help_cms_blog_brief_length');
		$data['help_cms_blog_comment_length'] = $this->language->get('help_cms_blog_comment_length');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_category'] = $this->language->get('tab_category');
		$data['tab_blog'] = $this->language->get('tab_blog');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['cms_blog_seo_keyword'])) {
			$data['error_cms_blog_seo_keyword'] = $this->error['cms_blog_seo_keyword'];
		} else {
			$data['error_cms_blog_seo_keyword'] = '';
		}
		
		if (isset($this->error['cms_blog_large_image'])) {
			$data['error_cms_blog_large_image'] = $this->error['cms_blog_large_image'];
		} else {
			$data['error_cms_blog_large_image'] = '';
		}
		
		if (isset($this->error['cms_blog_middle_image'])) {
			$data['error_cms_blog_middle_image'] = $this->error['cms_blog_middle_image'];
		} else {
			$data['error_cms_blog_middle_image'] = '';
		}
		
		if (isset($this->error['cms_blog_small_image'])) {
			$data['error_cms_blog_small_image'] = $this->error['cms_blog_small_image'];
		} else {
			$data['error_cms_blog_small_image'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('cms/blog_config', 'token=' . $this->session->data['token'], true)
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('cms/blog_config', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['cms_blog_description'])) {
			$data['cms_blog_description'] = $this->request->post['cms_blog_description'];
		} elseif ($this->config->get('cms_blog_description')) {
			$data['cms_blog_description'] = $this->config->get('cms_blog_description');
		} else {
			$data['cms_blog_description'] = array();
		}
		
		if (isset($this->request->post['cms_blog_seo_keyword'])) {
			$data['cms_blog_seo_keyword'] = $this->request->post['cms_blog_seo_keyword'];
		} else {
			$data['cms_blog_seo_keyword'] = $this->config->get('cms_blog_seo_keyword');
		}
		
		
		if (isset($this->request->post['cms_blog_large_image_width'])) {
			$data['cms_blog_large_image_width'] = $this->request->post['cms_blog_large_image_width'];
		} else {
			$data['cms_blog_large_image_width'] = $this->config->get('cms_blog_large_image_width');
		}
		
		if (isset($this->request->post['cms_blog_large_image_height'])) {
			$data['cms_blog_large_image_height'] = $this->request->post['cms_blog_large_image_height'];
		} else {
			$data['cms_blog_large_image_height'] = $this->config->get('cms_blog_large_image_height');
		}
		
		if (isset($this->request->post['cms_blog_middle_image_width'])) {
			$data['cms_blog_middle_image_width'] = $this->request->post['cms_blog_middle_image_width'];
		} else {
			$data['cms_blog_middle_image_width'] = $this->config->get('cms_blog_middle_image_width');
		}
		
		if (isset($this->request->post['cms_blog_middle_image_height'])) {
			$data['cms_blog_middle_image_height'] = $this->request->post['cms_blog_middle_image_height'];
		} else {
			$data['cms_blog_middle_image_height'] = $this->config->get('cms_blog_middle_image_height');
		}
		
		if (isset($this->request->post['cms_blog_small_image_width'])) {
			$data['cms_blog_small_image_width'] = $this->request->post['cms_blog_small_image_width'];
		} else {
			$data['cms_blog_small_image_width'] = $this->config->get('cms_blog_small_image_width');
		}
		
		if (isset($this->request->post['cms_blog_small_image_height'])) {
			$data['cms_blog_small_image_height'] = $this->request->post['cms_blog_small_image_height'];
		} else {
			$data['cms_blog_small_image_height'] = $this->config->get('cms_blog_small_image_height');
		}
		
		if (isset($this->request->post['cms_blog_items_per_page'])) {
			$data['cms_blog_items_per_page'] = $this->request->post['cms_blog_items_per_page'];
		} else {
			$data['cms_blog_items_per_page'] = $this->config->get('cms_blog_items_per_page');
		}
		
		if (isset($this->request->post['cms_blog_children_columns'])) {
			$data['cms_blog_children_columns'] = $this->request->post['cms_blog_children_columns'];
		} else {
			$data['cms_blog_children_columns'] = $this->config->get('cms_blog_children_columns');
		}
		
		if (isset($this->request->post['cms_blog_general_cwidth'])) {
			$data['cms_blog_general_cwidth'] = $this->request->post['cms_blog_general_cwidth'];
		} else {
			$data['cms_blog_general_cwidth'] = $this->config->get('cms_blog_general_cwidth');
		}
		
		if (isset($this->request->post['cms_blog_general_cheight'])) {
			$data['cms_blog_general_cheight'] = $this->request->post['cms_blog_general_cheight'];
		} else {
			$data['cms_blog_general_cheight'] = $this->config->get('cms_blog_general_cheight');
		}
		
		if (isset($this->request->post['cms_blog_category_limit_leading_blog'])) {
			$data['cms_blog_category_limit_leading_blog'] = $this->request->post['cms_blog_category_limit_leading_blog'];
		} else {
			$data['cms_blog_category_limit_leading_blog'] = $this->config->get('cms_blog_category_limit_leading_blog');
		}
		
		if (isset($this->request->post['cms_blog_category_limit_secondary_blog'])) {
			$data['cms_blog_category_limit_secondary_blog'] = $this->request->post['cms_blog_category_limit_secondary_blog'];
		} else {
			$data['cms_blog_category_limit_secondary_blog'] = $this->config->get('cms_blog_category_limit_secondary_blog');
		}
		
		if (isset($this->request->post['cms_blog_category_leading_image_type'])) {
			$data['cms_blog_category_leading_image_type'] = $this->request->post['cms_blog_category_leading_image_type'];
		} else {
			$data['cms_blog_category_leading_image_type'] = $this->config->get('cms_blog_category_leading_image_type');
		}
		
		if (isset($this->request->post['cms_blog_category_secondary_image_type'])) {
			$data['cms_blog_category_secondary_image_type'] = $this->request->post['cms_blog_category_secondary_image_type'];
		} else {
			$data['cms_blog_category_secondary_image_type'] = $this->config->get('cms_blog_category_secondary_image_type');
		}
		
		if (isset($this->request->post['cms_blog_category_columns_leading_blog'])) {
			$data['cms_blog_category_columns_leading_blog'] = $this->request->post['cms_blog_category_columns_leading_blog'];
		} else {
			$data['cms_blog_category_columns_leading_blog'] = $this->config->get('cms_blog_category_columns_leading_blog');
		}
		
		if (isset($this->request->post['cms_blog_category_columns_secondary_blogs'])) {
			$data['cms_blog_category_columns_secondary_blogs'] = $this->request->post['cms_blog_category_columns_secondary_blogs'];
		} else {
			$data['cms_blog_category_columns_secondary_blogs'] = $this->config->get('cms_blog_category_columns_secondary_blogs');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_title'])) {
			$data['cms_blog_category_page_show_title'] = $this->request->post['cms_blog_category_page_show_title'];
		} else {
			$data['cms_blog_category_page_show_title'] = $this->config->get('cms_blog_category_page_show_title');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_brief'])) {
			$data['cms_blog_category_page_show_brief'] = $this->request->post['cms_blog_category_page_show_brief'];
		} else {
			$data['cms_blog_category_page_show_brief'] = $this->config->get('cms_blog_category_page_show_brief');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_readmore'])) {
			$data['cms_blog_category_page_show_readmore'] = $this->request->post['cms_blog_category_page_show_readmore'];
		} else {
			$data['cms_blog_category_page_show_readmore'] = $this->config->get('cms_blog_category_page_show_readmore');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_image'])) {
			$data['cms_blog_category_page_show_image'] = $this->request->post['cms_blog_category_page_show_image'];
		} else {
			$data['cms_blog_category_page_show_image'] = $this->config->get('cms_blog_category_page_show_image');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_author'])) {
			$data['cms_blog_category_page_show_author'] = $this->request->post['cms_blog_category_page_show_author'];
		} else {
			$data['cms_blog_category_page_show_author'] = $this->config->get('cms_blog_category_page_show_author');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_category'])) {
			$data['cms_blog_category_page_show_category'] = $this->request->post['cms_blog_category_page_show_category'];
		} else {
			$data['cms_blog_category_page_show_category'] = $this->config->get('cms_blog_category_page_show_category');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_created_date'])) {
			$data['cms_blog_category_page_show_created_date'] = $this->request->post['cms_blog_category_page_show_created_date'];
		} else {
			$data['cms_blog_category_page_show_created_date'] = $this->config->get('cms_blog_category_page_show_created_date');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_hits'])) {
			$data['cms_blog_category_page_show_hits'] = $this->request->post['cms_blog_category_page_show_hits'];
		} else {
			$data['cms_blog_category_page_show_hits'] = $this->config->get('cms_blog_category_page_show_hits');
		}
		
		if (isset($this->request->post['cms_blog_category_page_show_comment_counter'])) {
			$data['cms_blog_category_page_show_comment_counter'] = $this->request->post['cms_blog_category_page_show_comment_counter'];
		} else {
			$data['cms_blog_category_page_show_comment_counter'] = $this->config->get('cms_blog_category_page_show_comment_counter');
		}
		
		if (isset($this->request->post['cms_blog_image_type'])) {
			$data['cms_blog_image_type'] = $this->request->post['cms_blog_image_type'];
		} else {
			$data['cms_blog_image_type'] = $this->config->get('cms_blog_image_type');
		}
		
		if (isset($this->request->post['cms_blog_show_title'])) {
			$data['cms_blog_show_title'] = $this->request->post['cms_blog_show_title'];
		} else {
			$data['cms_blog_show_title'] = $this->config->get('cms_blog_show_title');
		}
		
		if (isset($this->request->post['cms_blog_show_image'])) {
			$data['cms_blog_show_image'] = $this->request->post['cms_blog_show_image'];
		} else {
			$data['cms_blog_show_image'] = $this->config->get('cms_blog_show_image');
		}
		
		if (isset($this->request->post['cms_blog_show_author'])) {
			$data['cms_blog_show_author'] = $this->request->post['cms_blog_show_author'];
		} else {
			$data['cms_blog_show_author'] = $this->config->get('cms_blog_show_author');
		}
		
		if (isset($this->request->post['cms_blog_show_category'])) {
			$data['cms_blog_show_category'] = $this->request->post['cms_blog_show_category'];
		} else {
			$data['cms_blog_show_category'] = $this->config->get('cms_blog_show_category');
		}
		
		if (isset($this->request->post['cms_blog_show_product_related'])) {
			$data['cms_blog_show_product_related'] = $this->request->post['cms_blog_show_product_related'];
		} else {
			$data['cms_blog_show_product_related'] = $this->config->get('cms_blog_show_product_related');
		}
		
		if (isset($this->request->post['cms_blog_product_scroll_related'])) {
			$data['cms_blog_product_scroll_related'] = $this->request->post['cms_blog_product_scroll_related'];
		} else {
			$data['cms_blog_product_scroll_related'] = $this->config->get('cms_blog_product_scroll_related');
		}

		if (isset($this->request->post['cms_blog_product_related_per_row'])) {
			$data['cms_blog_product_related_per_row'] = $this->request->post['cms_blog_product_related_per_row'];
		} else {
			$data['cms_blog_product_related_per_row'] = $this->config->get('cms_blog_product_related_per_row');
		}
		
		
		if (isset($this->request->post['cms_blog_show_blog_related'])) {
			$data['cms_blog_show_blog_related'] = $this->request->post['cms_blog_show_blog_related'];
		} else {
			$data['cms_blog_show_blog_related'] = $this->config->get('cms_blog_show_blog_related');
		}
		
		if (isset($this->request->post['cms_blog_article_scroll_related'])) {
			$data['cms_blog_article_scroll_related'] = $this->request->post['cms_blog_article_scroll_related'];
		} else {
			$data['cms_blog_article_scroll_related'] = $this->config->get('cms_blog_article_scroll_related');
		}

		if (isset($this->request->post['cms_blog_article_related_per_row'])) {
			$data['cms_blog_article_related_per_row'] = $this->request->post['cms_blog_article_related_per_row'];
		} else {
			$data['cms_blog_article_related_per_row'] = $this->config->get('cms_blog_article_related_per_row');
		}
		
		if (isset($this->request->post['cms_blog_show_created_date'])) {
			$data['cms_blog_show_created_date'] = $this->request->post['cms_blog_show_created_date'];
		} else {
			$data['cms_blog_show_created_date'] = $this->config->get('cms_blog_show_created_date');
		}
		
		if (isset($this->request->post['cms_blog_show_hits'])) {
			$data['cms_blog_show_hits'] = $this->request->post['cms_blog_show_hits'];
		} else {
			$data['cms_blog_show_hits'] = $this->config->get('cms_blog_show_hits');
		}
		
		if (isset($this->request->post['cms_blog_show_comment_counter'])) {
			$data['cms_blog_show_comment_counter'] = $this->request->post['cms_blog_show_comment_counter'];
		} else {
			$data['cms_blog_show_comment_counter'] = $this->config->get('cms_blog_show_comment_counter');
		}
		
		if (isset($this->request->post['cms_blog_show_comment_form'])) {
			$data['cms_blog_show_comment_form'] = $this->request->post['cms_blog_show_comment_form'];
		} else {
			$data['cms_blog_show_comment_form'] = $this->config->get('cms_blog_show_comment_form');
		}
		
		if (isset($this->request->post['cms_blog_show_auto_publish_comment'])) {
			$data['cms_blog_show_auto_publish_comment'] = $this->request->post['cms_blog_show_auto_publish_comment'];
		} else {
			$data['cms_blog_show_auto_publish_comment'] = $this->config->get('cms_blog_show_auto_publish_comment');
		}
		
		if (isset($this->request->post['cms_blog_comment_email'])) {
			$data['cms_blog_comment_email'] = $this->request->post['cms_blog_comment_email'];
		} else {
			$data['cms_blog_comment_email'] = $this->config->get('cms_blog_comment_email');
		}
		
		if (isset($this->request->post['cms_blog_show_recaptcha'])) {
			$data['cms_blog_show_recaptcha'] = $this->request->post['cms_blog_show_recaptcha'];
		} else {
			$data['cms_blog_show_recaptcha'] = $this->config->get('cms_blog_show_recaptcha');
		}
		
		if (isset($this->request->post['cms_blog_show_need_login_to_comment'])) {
			$data['cms_blog_show_need_login_to_comment'] = $this->request->post['cms_blog_show_need_login_to_comment'];
		} else {
			$data['cms_blog_show_need_login_to_comment'] = $this->config->get('cms_blog_show_need_login_to_comment');
		}
		
		if (isset($this->request->post['cms_blog_brief_length'])) {
			$data['cms_blog_brief_length'] = $this->request->post['cms_blog_brief_length'];
		} else {
			$data['cms_blog_brief_length'] = $this->config->get('cms_blog_brief_length');
		}
		
		if (isset($this->request->post['cms_blog_comment_length'])) {
			$data['cms_blog_comment_length'] = $this->request->post['cms_blog_comment_length'];
		} else {
			$data['cms_blog_comment_length'] = $this->config->get('cms_blog_comment_length');
		}
		

		


		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('cms/blog_config', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'cms/blog_config')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['cms_blog_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if (utf8_strlen($this->request->post['cms_blog_seo_keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['cms_blog_seo_keyword']);

			if ($url_alias_info) {
				$this->error['cms_blog_seo_keyword'] = sprintf($this->language->get('error_cms_blog_seo_keyword'));
			}

		}
		
		if (((int)$this->request->post['cms_blog_large_image_width'] == 0) || ((int)$this->request->post['cms_blog_large_image_height'] == 0)) {
			$this->error['cms_blog_large_image'] = $this->language->get('error_cms_blog_large_image');
		}
		
		if (((int)$this->request->post['cms_blog_middle_image_width'] == 0) || ((int)$this->request->post['cms_blog_middle_image_width'] == 0)) {
			$this->error['cms_blog_middle_image'] = $this->language->get('error_cms_blog_middle_image');
		}
		
		if (((int)$this->request->post['cms_blog_small_image_width'] == 0) || ((int)$this->request->post['cms_blog_small_image_height'] == 0)) {
			$this->error['cms_blog_small_image'] = $this->language->get('error_cms_blog_small_image');
		}


		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

}