<?php
class ControllerCommonLanguage extends Controller {
	public function index() {
		$this->load->language('common/language');
		
		$url_data = $this->request->get;

		if (isset($url_data['route'])) {
			$route = $url_data['route'];
		} else {
			$route = $this->config->get('action_default');
		}

		unset($url_data['_route_']);
		unset($url_data['route']);
		unset($url_data['language']);

		$url = '';

		if ($url_data) {
			$url = '&' . urldecode(http_build_query($url_data));
		}

		$data['languages'] = array();

		$this->load->model('localisation/language');

		$results = $this->model_localisation_language->getLanguages();

		foreach ($results as $result) {
			if ($result['status']) {
				$data['languages'][] = array(
					'name' => $result['name'],
					'code' => $result['code'],
					'href' => $this->url->link('common/language/language', 'user_token=' . $this->session->data['user_token'] . '&code=' . $result['code'] . '&redirect=' . urlencode(str_replace('&amp;', '&', $this->url->link($route, $url))))
				);
			}
		}
		
		$language_codes = array_column($results, 'language_id', 'code');
		
		if (isset($this->request->cookie['admin_language']) && array_key_exists($this->request->cookie['admin_language'], $language_codes)) {
			$data['code'] = $this->request->cookie['admin_language'];
		} else {
			$data['code'] = $this->config->get('config_admin_language');
		}

		return $this->load->view('common/language', $data);
	}

	public function language() {
		if (isset($this->request->get['code'])) {
			$code = $this->request->get['code'];
		} else {
			$code = $this->config->get('config_admin_language');
		}

		if (isset($this->request->get['redirect'])) {
			$redirect = $this->request->get['redirect'];
		} else {
			$redirect = '';
		}

		setcookie('admin_language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);

		if ($redirect && substr($redirect, 0, strlen($this->config->get('config_url'))) == $this->config->get('config_url')) {
			$this->response->redirect($redirect);
		} else {
			$this->response->redirect($this->url->link($this->config->get('action_default'), 'user_token=' . $this->session->data['user_token']));
		}
	}
}