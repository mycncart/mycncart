<?php  
class Controllermodulepavbloglatest extends Controller {
	
	private $mdata = array();

	public function index($setting) {
		static $module = 0;
		$this->load->model('pavblog/blog');
		$this->load->model('catalog/product'); 
		$this->load->model('tool/image');
		$this->language->load('module/pavblog');
		
		$this->mdata['button_cart'] = $this->language->get('button_cart');
		
		$this->mdata['objlang'] = $this->language;
		$this->mdata['objurl'] = $this->url;
		
		if( !defined("_PAVBLOG_MEDIA_") ){
			if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pavblog.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pavblog.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/pavblog.css');
			}
			define("_PAVBLOG_MEDIA_",true);
		}
			
		$default = array(
			'latest' => 1,
			'limit' => 9
		);
	 
		$this->mdata['toolimg'] = $this->model_tool_image;

		$this->mdata['width'] = $setting['width'];
		$this->mdata['height'] = $setting['height'];
		$this->mdata['cols']   = (int)$setting['cols'];  
		$this->mdata['prefixclass']   = isset($setting['prefixclass'])?$setting['prefixclass']:'';

		$this->mdata['tabs'] = array();
		
		$data = array(
			'sort'  => 'b.`created`',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);
		
		if( $setting['tabs'] == 'featured' ){			
			$data['featured'] = 1;
			$blogs = $this->model_pavblog_blog->getListBlogs( $data );
			$this->mdata['heading_title'] = $this->language->get('text_featured');
		}elseif( $setting['tabs'] == 'mostviewed' ){	
			$data['sort'] = 'b.`hits`';
			$blogs = $this->model_pavblog_blog->getListBlogs( $data );
			$this->mdata['heading_title'] = $this->language->get('text_mostviewed');
		}else {
			$blogs = $this->model_pavblog_blog->getListBlogs( $data );
			$this->mdata['heading_title'] = $this->language->get('text_latest');
		}
		
		
		$this->load->model('pavblog/category'); 
		$users = $this->model_pavblog_category->getUsers();
		
		foreach( $blogs as $key => $blog ){
			if( $blogs[$key]['image'] ){	
				$blogs[$key]['thumb'] = $this->model_tool_image->resize($blog['image'], $setting['width'], $setting['height'] );
			}else {
				$blogs[$key]['thumb'] = '';
			}					
			
			$blogs[$key]['description'] = html_entity_decode($blog['description'], ENT_QUOTES, 'UTF-8');
			$blogs[$key]['author'] = isset($users[$blog['user_id']])?$users[$blog['user_id']]:$this->language->get('text_none_author');
			$blogs[$key]['category_link'] =  $this->url->link( 'pavblog/category', "path=".$blog['category_id'] );
			$blogs[$key]['comment_count'] =  10;
			$blogs[$key]['link'] =  $this->url->link( 'pavblog/blog','blog_id='.$blog['blog_id'] );
		}

		
		if( isset( $setting['description'][$this->config->get('config_language_id')] ) ) {	
			$this->mdata['message'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
	 	}else {
			$this->mdata['message'] = '';
		}
		
		

		$this->mdata['blogs'] = $blogs;
		$this->mdata['module'] = $module++;
						
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/pavbloglatest.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/pavbloglatest.tpl', $this->mdata);
		} else {
			return $this->load->view('default/template/module/pavbloglatest.tpl', $this->mdata);
		}
	}
	
}
?>