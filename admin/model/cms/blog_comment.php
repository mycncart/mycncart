<?php
class ModelCmsBlogComment extends Model {
	public function editBlogComment($blog_comment_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "blog_comment SET text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE blog_comment_id = '" . (int)$blog_comment_id . "'");

		$this->cache->delete('blog');

	}

	public function deleteBlogComment($blog_comment_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_comment WHERE blog_comment_id = '" . (int)$blog_comment_id . "'");

		$this->cache->delete('blog');

	}

	public function getBlogComment($blog_comment_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT bd.title FROM " . DB_PREFIX . "blog_description bd WHERE bd.blog_id = bc.blog_id AND bd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS blog FROM " . DB_PREFIX . "blog_comment bc WHERE bc.blog_comment_id = '" . (int)$blog_comment_id . "'");

		return $query->row;
	}

	public function getBlogComments($data = array()) {
		$sql = "SELECT bc.blog_comment_id, bd.title, bc.author, bc.status, bc.date_added FROM " . DB_PREFIX . "blog_comment bc LEFT JOIN " . DB_PREFIX . "blog_description bd ON (bc.blog_id = bd.blog_id) WHERE bd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_blog'])) {
			$sql .= " AND bd.title LIKE '%" . $this->db->escape($data['filter_blog']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND bc.author LIKE '%" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND bc.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(bc.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'bd.title',
			'bc.author',
			'bc.status',
			'bc.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bc.date_added";
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

	public function getTotalBlogComments($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_comment bc LEFT JOIN " . DB_PREFIX . "blog_description bd ON (bc.blog_id = bd.blog_id) WHERE bd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_blog'])) {
			$sql .= " AND bd.title LIKE '%" . $this->db->escape($data['filter_blog']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND bc.author LIKE '%" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND bc.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(bc.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalBlogCommentsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_comment WHERE status = '0'");

		return $query->row['total'];
	}
}