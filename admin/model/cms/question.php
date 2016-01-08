<?php
class ModelCocQuestion extends Model {
	public function addQuestion($data) {
		$this->event->trigger('pre.admin.question.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "question SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$question_id = $this->db->getLastId();

		foreach ($data['question_description'] as $language_id => $value) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', answer = '" . $this->db->escape($value['answer']) . "'");
		}

		if (isset($data['question_store'])) {
			foreach ($data['question_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "question_to_store SET question_id = '" . (int)$question_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['question_faq_category'])) {
			foreach ($data['question_faq_category'] as $faq_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "question_to_faq_category SET question_id = '" . (int)$question_id . "', faq_category_id = '" . (int)$faq_category_id . "'");
			}
		}


		if (isset($data['question_layout'])) {
			foreach ($data['question_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "question_to_layout SET question_id = '" . (int)$question_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('question');

		$this->event->trigger('post.admin.question.add', $question_id);

		return $question_id;
	}

	public function editQuestion($question_id, $data) {
		$this->event->trigger('pre.admin.question.edit', $data);
		
	

		$this->db->query("UPDATE " . DB_PREFIX . "question SET status = '" . (int)$data['status'] . "',  sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE question_id = '" . (int)$question_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "question_description WHERE question_id = '" . (int)$question_id . "'");

		foreach ($data['question_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "question_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', answer = '" . $this->db->escape($value['answer']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_store WHERE question_id = '" . (int)$question_id . "'");

		if (isset($data['question_store'])) {
			foreach ($data['question_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "question_to_store SET question_id = '" . (int)$question_id . "', store_id = '" . (int)$store_id . "'");
			}
		}



		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_faq_category WHERE question_id = '" . (int)$question_id . "'");

		if (isset($data['question_faq_category'])) {
			foreach ($data['question_faq_category'] as $faq_category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "question_to_faq_category SET question_id = '" . (int)$question_id . "', faq_category_id = '" . (int)$faq_category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_layout WHERE question_id = '" . (int)$question_id . "'");

		if (isset($data['question_layout'])) {
			foreach ($data['question_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "question_to_layout SET question_id = '" . (int)$question_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}


		$this->cache->delete('question');

		$this->event->trigger('post.admin.question.edit', $question_id);
	}

	public function deleteQuestion($question_id) {
		$this->event->trigger('pre.admin.question.delete', $question_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "question WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "question_description WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_faq_category WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_layout WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "question_to_store WHERE question_id = '" . (int)$question_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'question_id=" . (int)$question_id . "'");

		$this->cache->delete('question');

		$this->event->trigger('post.admin.question.delete', $question_id);
	}

	public function getQuestion($question_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'question_id=" . (int)$question_id . "') AS keyword FROM " . DB_PREFIX . "question p LEFT JOIN " . DB_PREFIX . "question_description pd ON (p.question_id = pd.question_id) WHERE p.question_id = '" . (int)$question_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getQuestions($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "question p LEFT JOIN " . DB_PREFIX . "question_description pd ON (p.question_id = pd.question_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND pd.title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
		}


		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.question_id";

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

	public function getQuestionsByFaqCategoryId($faq_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question p LEFT JOIN " . DB_PREFIX . "question_description pd ON (p.question_id = pd.question_id) LEFT JOIN " . DB_PREFIX . "question_to_faq_category p2c ON (p.question_id = p2c.question_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.faq_category_id = '" . (int)$faq_category_id . "' ORDER BY pd.title ASC");

		return $query->rows;
	}

	public function getQuestionDescription($question_id) {
		$question_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question_description WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'answer'      		=> $result['answer'],
			);
		}

		return $question_description_data;
	}

	public function getQuestionFaqCategories($question_id) {
		$question_faq_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question_to_faq_category WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_faq_category_data[] = $result['faq_category_id'];
		}

		return $question_faq_category_data;
	}

	public function getQuestionStores($question_id) {
		$question_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question_to_store WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_store_data[] = $result['store_id'];
		}

		return $question_store_data;
	}

	public function getQuestionLayouts($question_id) {
		$question_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question_to_layout WHERE question_id = '" . (int)$question_id . "'");

		foreach ($query->rows as $result) {
			$question_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $question_layout_data;
	}

	public function getTotalQuestions($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.question_id) AS total FROM " . DB_PREFIX . "question p LEFT JOIN " . DB_PREFIX . "question_description pd ON (p.question_id = pd.question_id)";

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

	public function getTotalQuestionsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "question_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}