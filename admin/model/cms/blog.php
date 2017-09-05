<?php
class ModelCmsBlog extends Model {
	public function addBlog($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "blog SET featured = '" . (int)$data['featured'] . "', hits = '" . (int)$data['hits'] . "', created = '" . $this->db->escape($data['created']) . "', video_code = '" . $this->db->escape($data['video_code']) . "', user_id = '" . (int)$data['user_id'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$blog_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_id = '" . (int)$blog_id . "'");
		}

		foreach ($data['blog_description'] as $language_id => $value) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_description SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		if (isset($data['blog_store'])) {
			foreach ($data['blog_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_store SET blog_id = '" . (int)$blog_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if (isset($data['blog_category'])) {
			foreach ($data['blog_category'] as $blog_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_blog_category SET blog_id = '" . (int)$blog_id . "', blog_category_id = '" . (int)$blog_category_id . "'");
			}
		}

		
		if (isset($data['product_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product WHERE blog_id = " . (int)$blog_id);
			
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_product SET blog_id = '" . (int)$blog_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		
		if (isset($data['blog_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = " . (int)$blog_id);
			
			foreach ($data['blog_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_related SET blog_id = '" . (int)$blog_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		
		// SEO URL
		if (isset($data['blog_seo_url'])) {
			foreach ($data['blog_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (trim($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'blog_id=" . (int)$blog_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		

		if (isset($data['blog_layout'])) {
			foreach ($data['blog_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_layout SET blog_id = '" . (int)$blog_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('blog');


		return $blog_id;
	}

	public function editBlog($blog_id, $data) {
		
		$this->db->query("UPDATE " . DB_PREFIX . "blog SET featured = '" . (int)$data['featured'] . "', hits = '" . (int)$data['hits'] . "', created = '" . $this->db->escape($data['created']) . "', user_id = '" . (int)$data['user_id'] . "', video_code = '" . $this->db->escape($data['video_code']) . "', status = '" . (int)$data['status'] . "',  sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE blog_id = '" . (int)$blog_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_id = '" . (int)$blog_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($data['blog_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_description SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_store'])) {
			foreach ($data['blog_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_store SET blog_id = '" . (int)$blog_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_blog_category WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_category'])) {
			foreach ($data['blog_category'] as $blog_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_blog_category SET blog_id = '" . (int)$blog_id . "', blog_category_id = '" . (int)$blog_category_id . "'");
			}
		}

		if (isset($data['product_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product WHERE blog_id = " . (int)$blog_id);
			
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_product SET blog_id = '" . (int)$blog_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		
		if (isset($data['blog_related'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = " . (int)$blog_id);
			
			foreach ($data['blog_related'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_related SET blog_id = '" . (int)$blog_id . "', related_id = '" . (int)$related_id . "'");
				
			}
			
		}
		
		// SEO URL
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'blog_id=" . (int)$blog_id . "'");
		
		if (isset($data['blog_seo_url'])) {
			foreach ($data['blog_seo_url']as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (trim($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'blog_id=" . (int)$blog_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}


		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_layout WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_layout'])) {
			foreach ($data['blog_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_layout SET blog_id = '" . (int)$blog_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}


		$this->cache->delete('blog');

	}

	public function deleteBlog($blog_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_blog_category WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_product WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_layout WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'blog_id=" . (int)$blog_id . "'");

		$this->cache->delete('blog');

	}

	public function getBlog($blog_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "blog p LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) WHERE p.blog_id = '" . (int)$blog_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getBlogs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "blog p LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND pd.title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
		}


		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.blog_id";

		$sort_data = array(
			'pd.title',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.title";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getBlogsByBlogCategoryId($blog_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog p LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_to_blog_category p2c ON (p.blog_id = p2c.blog_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.blog_category_id = '" . (int)$blog_category_id . "' ORDER BY pd.title ASC");

		return $query->rows;
	}

	public function getBlogDescription($blog_id) {
		$blog_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'brief'             => $result['brief'],
				'description'       => $result['description'],
				'meta_title'      	=> $result['meta_title'],
				'meta_description'  => $result['meta_description'],
				'meta_keyword'      => $result['meta_keyword'],
				'tag'      			=> $result['tag'],
			);
		}

		return $blog_description_data;
	}

	public function getBlogBlogCategories($blog_id) {
		$blog_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_blog_category WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_category_data[] = $result['blog_category_id'];
		}

		return $blog_category_data;
	}

	public function getBlogStores($blog_id) {
		$blog_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_store_data[] = $result['store_id'];
		}

		return $blog_store_data;
	}

	public function getBlogLayouts($blog_id) {
		$blog_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_layout WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $blog_layout_data;
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

	public function getTotalBlogsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
	public function getProductRelated($blog_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_product WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}
		
		return $product_related_data;
	}
	
	public function getBlogRelated($blog_id) {
		$blog_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_related WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_related_data[] = $result['related_id'];
		}
		
		return $blog_related_data;
	}
	
	public function getBlogSeoUrls($blog_id) {
		$blog_seo_url_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'blog_id=" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
		}

		return $blog_seo_url_data;
	}
	
}