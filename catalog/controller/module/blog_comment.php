<?php
class Controllermodulepavblogcomment extends Controller {
	
	private $mdata = array();

	public function index($setting) {
		static $module = 0;
		
		$this->load->model('pavblog/comment');
		$this->load->model('catalog/product'); 
		$this->load->model('tool/image');
		$this->load->language('module/pavblog');

		$this->mdata['objlang'] = $this->language;
		$this->mdata['objurl'] = $this->url;
		
		$this->mdata['button_cart'] = $this->language->get('button_cart');
		
		if( !defined("_PAVBLOG_MEDIA_") ){
			if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pavblog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pavblog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/pavblog.css');
			}
			define("_PAVBLOG_MEDIA_",true);
		}
		 
		$this->mdata['heading_title'] = $this->language->get('blogcomment_heading_title');
		
		$comments = $this->model_pavblog_comment->getLatest( (int)$setting['limit'] );
		foreach( $comments as $k => $comment ){
			$comments[$k]['link'] = $this->url->link( 'pavblog/blog',"blog_id=".$comment['blog_id']."#comment".$comment['comment_id'] );
		}
		$this->mdata['comments'] = $comments;
	
	
		$this->mdata['module'] = $module++;


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/pavblogcomment.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/pavblogcomment.tpl', $this->mdata);
		} else {
			return $this->load->view('default/template/module/pavblogcomment.tpl', $this->mdata);
		}

	}
	
}
?>