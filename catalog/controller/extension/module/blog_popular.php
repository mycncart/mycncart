<?php  
class ControllerExtensionModuleBlogPopular extends Controller {
	public function index($setting) {
		
		$this->load->language('extension/module/blog_popular');

		$this->load->model('blog/blog');
                                
        $data['heading_title'] = $this->language->get('heading_title');
		
        
        $data['button_read_more'] = $this->language->get('button_read_more');
	
        $data['blogs'] = array();

        $results = $this->model_blog_blog->getPopularBlogs($setting['limit']);

        foreach ($results as $result) {
            
            if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
			}
			
			$tags_array = array();
		
			if ($result['tag']) {
				 $tags = explode(',', $result['tag']);
				 foreach ($tags as $tag) {
					  $tags_array[] = array(
						   'tag'  => trim($tag),
						   'href' => $this->url->link('blog/blog', 'tag=' . trim(urlencode($tag)))
					  );
				 }
			}
            
            $data['blogs'][] = array(
                'blog_id'  => $result['blog_id'],
                'title'        => $result['title'],
				'brief' 	  	=> utf8_substr(strip_tags(html_entity_decode($result['brief'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('cms_blog_brief_length')) . '..',
                'description' => strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')),
                'date_added'   =>  $result['date_added'],
                'thumb'     => $image,
                'tags' => $tags_array,
                'href'        	=> $this->url->link('blog/blog', 'blog_id=' . $result['blog_id'])
            );
        }
	
		return $this->load->view('extension/module/blog_popular/default', $data);
	}
}
