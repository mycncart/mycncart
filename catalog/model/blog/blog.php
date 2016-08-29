<?php 	
class ModelBlogBlog extends Model {
	
	public function getUsers(){
		
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user`");
        $users = $query->rows;
        $output = array();
		
        foreach( $users as $user ){
            $output[$user['user_id']] = $user['username'];
        }
		
        return $output;
    }
	
	public function getBlog($blog_id) {
		
		$cache = md5($blog_id);
		
		$blog_data = $this->cache->get('blog.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_customer_group_id') . '.' . $cache);
		
		if(!$blog_data) {
			
			$query = $this->db->query("SELECT DISTINCT *, pd.title AS name, p.image, p.sort_order FROM " . DB_PREFIX . "blog p LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store p2s ON (p.blog_id = p2s.blog_id) WHERE p.blog_id = '" . (int)$blog_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
			
			if ($query->num_rows) {
				$blog_data = array(
					'blog_id'       => $query->row['blog_id'],
					'title'             => $query->row['name'],
					'brief'      => $query->row['brief'],
					'user_id'      => $query->row['user_id'],
					'image'      => $query->row['image'],
					'tags'       => $query->row['tag'],
					'blog_category_id' => $query->row['blog_category_id'],
					'created'              => $query->row['created'],
					'status'            => $query->row['status'],
					'hits'              => $query->row['hits'],
					'video_code'              => $query->row['video_code'],
					'featured'              => $query->row['featured'],
					'sort_order'             => $query->row['sort_order'],
					'date_added'              => $query->row['date_added'],
					'date_modified'         => $query->row['date_modified'],
					'brief'         	=> $query->row['brief'],
					'meta_title'         => $query->row['meta_title'],
					'meta_keyword'         => $query->row['meta_keyword'],
					'meta_description'         => $query->row['meta_description'],
					'description'         => $query->row['description'],
					
				);
			}
			
			$this->cache->set('blog.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_customer_group_id') . '.' . $cache, $blog_data);
			 
		}
		
		return $blog_data;
		
	}
	
	public function getBlogs($data = array()) {
		
		$cache = md5(http_build_query($data));
		
		$blog_data = $this->cache->get('blog.filter.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache);
		
		if (!$blog_data) {
			
			$sql = "SELECT p.blog_id, p.image ";
	
			if (!empty($data['filter_blog_category_id'])) {
				if (!empty($data['filter_sub_blog_category'])) {
					$sql .= " FROM " . DB_PREFIX . "blog_category_path cp LEFT JOIN " . DB_PREFIX . "blog_to_blog_category p2c ON (cp.blog_category_id = p2c.blog_category_id)";
				} else {
					$sql .= " FROM " . DB_PREFIX . "blog_to_blog_category p2c";
				}
	
					$sql .= " LEFT JOIN " . DB_PREFIX . "blog p ON (p2c.blog_id = p.blog_id)";
				
			} else {
				$sql .= " FROM " . DB_PREFIX . "blog p";
			}
	
			$sql .= " LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store p2s ON (p.blog_id = p2s.blog_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
			if (!empty($data['filter_blog_category_id'])) {
				if (!empty($data['filter_sub_blog_category'])) {
					$sql .= " AND cp.path_id = '" . (int)$data['filter_blog_category_id'] . "'";
				} else {
					$sql .= " AND p2c.blog_category_id = '" . (int)$data['filter_blog_category_id'] . "'";
				}
	
			}
	
			if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
				$sql .= " AND (";
	
				if (!empty($data['filter_name'])) {
					$implode = array();
	
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
	
					foreach ($words as $word) {
						$implode[] = "pd.title LIKE '%" . $this->db->escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
	
					
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
					
				}
	
				if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
				}
	
				if (!empty($data['filter_tag'])) {
					$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
				}
	
				$sql .= ")";
			}
	
			$sql .= " GROUP BY p.blog_id";
	
			$sql .= " ORDER BY p.date_added";
			
			$sql .= " DESC";
	
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
	
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
	
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
	
			$blog_data = array();
	
			$query = $this->db->query($sql);
			
	
			foreach ($query->rows as $result) {
				$blog_data[$result['blog_id']] = $this->getBlog($result['blog_id']);
			}
			
			$this->cache->set('blog.filter.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache, $blog_data);
		
		}

		return $blog_data;
	}
	
	
	public function getTotalBlogs($data = array()) {
			
			$sql = "SELECT COUNT(DISTINCT p.blog_id) AS total";
	
			if (!empty($data['filter_blog_category_id'])) {
				if (!empty($data['filter_sub_blog_category'])) {
					$sql .= " FROM " . DB_PREFIX . "blog_category_path cp LEFT JOIN " . DB_PREFIX . "blog_to_blog_category p2c ON (cp.blog_category_id = p2c.blog_category_id)";
				} else {
					$sql .= " FROM " . DB_PREFIX . "blog_to_blog_category p2c";
				}
	
					$sql .= " LEFT JOIN " . DB_PREFIX . "blog p ON (p2c.blog_id = p.blog_id)";
				
			} else {
				$sql .= " FROM " . DB_PREFIX . "blog p";
			}
	
			$sql .= " LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store p2s ON (p.blog_id = p2s.blog_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
	
			if (!empty($data['filter_blog_category_id'])) {
				if (!empty($data['filter_sub_blog_category'])) {
					$sql .= " AND cp.path_id = '" . (int)$data['filter_blog_category_id'] . "'";
				} else {
					$sql .= " AND p2c.blog_category_id = '" . (int)$data['filter_blog_category_id'] . "'";
				}
	
				if (!empty($data['filter_filter'])) {
					$implode = array();
	
					$filters = explode(',', $data['filter_filter']);
	
					foreach ($filters as $filter_id) {
						$implode[] = (int)$filter_id;
					}
	
					$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
				}
			}
	
			if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
				$sql .= " AND (";
	
				if (!empty($data['filter_name'])) {
					$implode = array();
	
					$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));
	
					foreach ($words as $word) {
						$implode[] = "pd.title LIKE '%" . $this->db->escape($word) . "%'";
					}
	
					if ($implode) {
						$sql .= " " . implode(" AND ", $implode) . "";
					}
	
					
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
					
				}
	
				if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
				}
	
				if (!empty($data['filter_tag'])) {
					$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
				}
	
				$sql .= ")";
			}
	
			$query = $this->db->query($sql);
	
			return $query->row['total'];
	}
	
	public function getBlogProductRelated($blog_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_product pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.blog_id = '" . (int)$blog_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");


		return $query->rows;
	}
	
	public function getBlogRelated($blog_id) {
		$blog_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_related pr LEFT JOIN " . DB_PREFIX . "blog p ON (pr.related_id = p.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_store p2s ON (p.blog_id = p2s.blog_id) WHERE pr.blog_id = '" . (int)$blog_id . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) {
			$blog_data[$result['related_id']] = $this->getBlog($result['related_id']);
		}

		return $blog_data;
	}
	
	public function updateViewed($blog_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "blog SET hits = (hits + 1) WHERE blog_id = '" . (int)$blog_id . "'");
	}
	
	public function getBlogCategoriesByBlogId($blog_id) {

		$query = $this->db->query("SELECT bcd.name, bcd.blog_category_id, bcd.language_id FROM " . DB_PREFIX . "blog_to_blog_category btbc LEFT JOIN " . DB_PREFIX . "blog_category_description bcd ON (btbc.blog_category_id = bcd.blog_category_id) WHERE btbc.blog_id = '" . (int)$blog_id . "' AND bcd.language_id = '" . (int)$this->config->get('config_language_id') . "'");


		return $query->rows;
	}
	
	private function prepareImage($path, $width, $height)
    {
        if(!$width) $width = 1000;
        if(!$height) $height = 400;
        $path = $this->model_tool_image->resize($path, $width, $height);
        return  '<img src="'. $path . '" alt="media" />';

    }
    
    private function prepareYoutube($path, $width, $height)
    {
        if(!$width) $width = '100%';
        if(!$height) $height = 400;
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $path, $matches);
        $id = isset($matches[1]) ? $matches[1] : 0;
        $path = "https://www.youtube.com/embed/". $id ."?rel=0&showinfo=0&color=white&iv_load_policy=3";
    
        return '<iframe id="ytplayer" type="text/html" width="'.$width.'" height="'.$height.'"
                                src="'. $path.'"
                                frameborder="0" allowfullscreen></iframe> ';
    }
    
    private function prepareSoundCloud($path, $width, $height)
    {
        if(!$width) $width = '100%';
        if(!$height) $height = 170;
        
        if(!@file_get_contents('http://soundcloud.com/oembed?format=js&url='.$path.'&iframe=true')) return false;
        $getValues=file_get_contents('http://soundcloud.com/oembed?format=js&url='.$path.'&iframe=true');
        $decodeiFrame=substr($getValues, 1, -2);
        $jsonObj = json_decode($decodeiFrame);
        return str_replace(array( 'height="400"', 'width="100%"'),array('height="'.$height.'"', 'width="'.$width.'"'), $jsonObj->html);
        
    }
	
	public function getPopularBlogs($limit) {
		$sql = "SELECT *, ba.blog_id FROM " . DB_PREFIX . "blog ba
                LEFT JOIN " . DB_PREFIX . "blog_description bad ON (ba.blog_id = bad.blog_id)
                LEFT JOIN " . DB_PREFIX . "blog_to_blog_category bctc ON bctc.blog_id = ba.blog_id
                LEFT JOIN " . DB_PREFIX . "blog_to_store ba2s ON (ba.blog_id = ba2s.blog_id)
                WHERE bad.language_id = '" . (int)$this->config->get('config_language_id') . "'
                    AND ba.status = 1 AND ba2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ba.date_added < NOW()
                GROUP BY ba.blog_id
                ORDER BY (SELECT count(*) FROM " . DB_PREFIX . "blog_comment bc WHERE bc.blog_id = ba.blog_id) DESC, ba.date_added  DESC
                LIMIT " . (int)$limit . "
                ";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
}
