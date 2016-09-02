<?php 
class ModelBlogComment extends Model {		
	
	public function addComment($blog_id, $data) {
		$this->event->trigger('pre.comment.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "blog_comment SET author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', blog_id = '" . (int)$blog_id . "', text = '" . $this->db->escape($data['text']) . "', status = '" . (int)$this->config->get('cms_blog_show_auto_publish_comment') . "', date_added = NOW()");

		$comment_id = $this->db->getLastId();

		if ($this->config->get('cms_blog_comment_email')) {
			$this->load->language('mail/comment');
			$this->load->model('blog/blog');
			$blog_info = $this->model_blog_blog->getBlog($blog_id);

			$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

			$message  = $this->language->get('text_waiting') . "\n";
			$message .= sprintf($this->language->get('text_blog'), html_entity_decode($blog_info['title'], ENT_QUOTES, 'UTF-8')) . "\n";
			$message .= sprintf($this->language->get('text_commenter'), html_entity_decode($data['name'], ENT_QUOTES, 'UTF-8')) . "\n";
			$message .= $this->language->get('text_comment') . "\n";
			$message .= html_entity_decode($data['text'], ENT_QUOTES, 'UTF-8') . "\n\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_alert_email'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

	}
	
	public function getCommentsByBlogId($blog_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT r.text, r.author, r.text, p.blog_id, pd.title, r.date_added FROM " . DB_PREFIX . "blog_comment r LEFT JOIN " . DB_PREFIX . "blog p ON (r.blog_id = p.blog_id) LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) WHERE p.blog_id = '" . (int)$blog_id . "' AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalCommentsByBlogId($blog_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog_comment r LEFT JOIN " . DB_PREFIX . "blog p ON (r.blog_id = p.blog_id) LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) WHERE p.blog_id = '" . (int)$blog_id . "' AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
	
	public function getComments($data = array()) {
		
		$sql = "SELECT r.blog_comment_id, r.author, r.text, p.blog_id, pd.title, r.date_added FROM " . DB_PREFIX . "blog_comment r LEFT JOIN " . DB_PREFIX . "blog p ON (r.blog_id = p.blog_id) LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) WHERE p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";


			$sql .= " ORDER BY r.date_added";
		

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


		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
}
