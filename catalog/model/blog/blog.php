<?php 	
class ModelBlogBlog extends Model {
	
	public function getUsers(){
        $sql = "SELECT * FROM `" . DB_PREFIX . "user`";
        $query = $this->db->query( $sql );
        $users = $query->rows;
        $output = array();
        foreach( $users as $user ){
            $output[$user['user_id']] = $user['username'];
        }
        return $output;
    }
	
	public function getBlog($blog_id) {
		
		$query = ' SELECT b.*,bd.title, bd.tag, bd.description,cd.name as category_title,bd.content  FROM '
								. DB_PREFIX . "pavblog_blog b LEFT JOIN "
								. DB_PREFIX . "pavblog_blog_description bd ON b.blog_id=bd.blog_id LEFT JOIN "
								. DB_PREFIX . 'pavblog_category c ON c.blog_category_id=b.blog_category_id  LEFT JOIN ' 
								. DB_PREFIX . 'pavblog_category_description cd ON (c.blog_category_id=cd.blog_category_id AND cd.language_id='.(int)$this->config->get('config_language_id').')' ;
				
		$query .=" WHERE bd.language_id=".(int)$this->config->get('config_language_id');
		$query .= " AND b.blog_id=".(int)$id;
		
		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return array(
				'product_id'       => $query->row['product_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'rating'           => round($query->row['rating']),
				'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}
	
	public function getBlogs($data = array()) {
		
		$sql = ' SELECT b.*,bd.title, bd.brief, bd.tag, bd.description,cd.name as category_title FROM '
								. DB_PREFIX . "blog b LEFT JOIN "
								. DB_PREFIX . "blog_description bd ON b.blog_id=bd.blog_id  and bd.language_id=".(int)$this->config->get('config_language_id')." LEFT JOIN "
								. DB_PREFIX . 'blog_category c ON c.blog_category_id=b.blog_category_id  LEFT JOIN ' 
								. DB_PREFIX . 'blog_category_description cd ON c.blog_category_id=cd.blog_category_id  and cd.language_id='.(int)$this->config->get('config_language_id') ;
				
		$sql .=" WHERE b.status = '1' AND bd.language_id=".(int)$this->config->get('config_language_id');
		
		if( isset($data['filter_blog_category_id']) && $data['filter_blog_category_id'] ){
			$sql .= " AND b.blog_category_id=".(int)$data['filter_blog_category_id'];
		}
		
		
		if( isset($data['filter_tag']) && $data['filter_tag'] ){
			$tmp = explode (",",$data['filter_tag'] );
			
			if( count($tmp) > 1  ){
				
				$t = array();
				foreach( $tmp as $tag ){
					$t[] = 'b.tags LIKE "%'.$this->db->escape( $tag ).'%"';
					
				}
				$sql .= ' AND  '.implode(" OR ", $t ).' ';	

			}else {
				$sql .= ' AND b.tags LIKE "%'.$this->db->escape( $data['filter_tag'] ).'%"';
			}
		}
		
		if( isset($data['featured']) ){
			$sql .= ' AND featured=1 '; 
		}
		
		if( isset($data['not_in']) && $data['not_in'] ){
			$sql .= ' AND b.blog_id NOT IN('.$data['not_in'].')';
		}
		$sort_data = array(
			'bd.title',
			
			'b.hits',
			'b.`created`',
			'b.created'
		);	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			}else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY b.`date_added`";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(bd.title) DESC";
		} else {
			$sql .= " ASC, LCASE(bd.title) ASC";
		} 
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
	
		$query = $this->db->query( $sql );
		$blogs = $query->rows;
		return $blogs; 
	}
	
	public function getTotalBlogs($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.blog_id) AS total FROM " . DB_PREFIX . "blog p LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND pd.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getInfo( $id ){
		
		$query = ' SELECT b.*,bd.title,bd.description,cd.name as category_title,bd.content  FROM '
								. DB_PREFIX . "pavblog_blog b LEFT JOIN "
								. DB_PREFIX . "pavblog_blog_description bd ON b.blog_id=bd.blog_id LEFT JOIN "
								. DB_PREFIX . 'pavblog_category c ON c.blog_category_id=b.blog_category_id  LEFT JOIN ' 
								. DB_PREFIX . 'pavblog_category_description cd ON (c.blog_category_id=cd.blog_category_id AND cd.language_id='.(int)$this->config->get('config_language_id').')' ;
				
		$query .=" WHERE bd.language_id=".(int)$this->config->get('config_language_id');
		$query .= " AND b.blog_id=".(int)$id;
		
		
		$query = $this->db->query( $query );
		$blog = $query->row;
		return $blog; 
	}
	
	/**
	 * update hit time after read
	 */
	public function updateHits( $id ){
		$sql = ' UPDATE '.DB_PREFIX.'pavblog_blog SET hits=hits+1 WHERE blog_id='.(int)$id;
		$this->db->query( $sql );
	}
	
	/**
	 * get list of blogs in same category of current
	 */
	public function getSameCategory( $blog_category_id, $blog_id, $limit=10 ){
		$data = array(
			'filter_blog_category_id' => $blog_category_id,

			'not_in'           => $blog_id,
			'sort'               => 'created',
			'order'              => 'DESC',
			'start'              => 0,
			'limit'              => $limit
		);

		return $this->getListBlogs( $data );
	}
	
	/**
	 * get total blog
	 */
	public function getTotal( $data ){
		$sql = ' SELECT count(b.blog_id) as total FROM '
								. DB_PREFIX . "pavblog_blog b LEFT JOIN "
								. DB_PREFIX . "pavblog_blog_description bd ON b.blog_id=bd.blog_id  and bd.language_id=".(int)$this->config->get('config_language_id')." LEFT JOIN "
								. DB_PREFIX . 'pavblog_category c ON c.blog_category_id=b.blog_category_id  LEFT JOIN ' 
								. DB_PREFIX . 'pavblog_category_description cd ON c.blog_category_id=cd.blog_category_id  and cd.language_id='.(int)$this->config->get('config_language_id') ;
				
		$sql .=" WHERE bd.language_id=".(int)$this->config->get('config_language_id');
		
		if( isset($data['filter_blog_category_id']) && $data['filter_blog_category_id'] ){
			$sql .= " AND b.blog_category_id=".(int)$data['filter_blog_category_id'];
		}
		if( isset($data['filter_tag']) && $data['filter_tag'] ){
			$tmp = explode (",",$data['filter_tag'] );
			
			if( count($tmp) > 1  ){
				
				$t = array();
				foreach( $tmp as $tag ){
					$t[] = 'b.tags LIKE "%'.$this->db->escape( $tag ).'%"';
					
				}
				$sql .= ' AND  '.implode(" OR ", $t ).' ';	

			}else {
				$sql .= ' AND b.tags LIKE "%'.$this->db->escape( $data['filter_tag'] ).'%"';
			}
		}
	
		$query = $this->db->query( $sql );
		return $query->row['total'];

	}
	
	/**
	 *  get list blogs 
	 */
	public function getListBlogs( $data ){
		
		$sql = ' SELECT b.*,bd.title, bd.brief, bd.description,cd.name as category_title FROM '
								. DB_PREFIX . "pavblog_blog b LEFT JOIN "
								. DB_PREFIX . "pavblog_blog_description bd ON b.blog_id=bd.blog_id  and bd.language_id=".(int)$this->config->get('config_language_id')." LEFT JOIN "
								. DB_PREFIX . 'pavblog_category c ON c.blog_category_id=b.blog_category_id  LEFT JOIN ' 
								. DB_PREFIX . 'pavblog_category_description cd ON c.blog_category_id=cd.blog_category_id  and cd.language_id='.(int)$this->config->get('config_language_id') ;
				
		$sql .=" WHERE b.status = '1' AND bd.language_id=".(int)$this->config->get('config_language_id');
		
		if( isset($data['filter_blog_category_id']) && $data['filter_blog_category_id'] ){
			$sql .= " AND b.blog_category_id=".(int)$data['filter_blog_category_id'];
		}
		
		
		if( isset($data['filter_tag']) && $data['filter_tag'] ){
			$tmp = explode (",",$data['filter_tag'] );
			
			if( count($tmp) > 1  ){
				
				$t = array();
				foreach( $tmp as $tag ){
					$t[] = 'b.tags LIKE "%'.$this->db->escape( $tag ).'%"';
					
				}
				$sql .= ' AND  '.implode(" OR ", $t ).' ';	

			}else {
				$sql .= ' AND b.tags LIKE "%'.$this->db->escape( $data['filter_tag'] ).'%"';
			}
		}
		
		if( isset($data['featured']) ){
			$sql .= ' AND featured=1 '; 
		}
		
		if( isset($data['not_in']) && $data['not_in'] ){
			$sql .= ' AND b.blog_id NOT IN('.$data['not_in'].')';
		}
		$sort_data = array(
			'bd.title',
			
			'b.hits',
			'b.`created`',
			'b.created'
		);	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			}else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY b.`date_added`";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(bd.title) DESC";
		} else {
			$sql .= " ASC, LCASE(bd.title) ASC";
		} 
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
	
		$query = $this->db->query( $sql );
		$blogs = $query->rows;
		return $blogs; 
	}

	public function getBlogTotalComments($blog_id){

		$query = $this->db->query('SELECT COUNT(blog_comment_id) AS total FROM '.DB_PREFIX.'blog_comment WHERE status = 1 AND blog_id = '.(int)$blog_id );
		
		return $query->row['total'];
	
	}
	
	
	
}
