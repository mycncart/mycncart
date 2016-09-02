<?php
class ControllerExtensionAnalyticsBaiDuAnalytics extends Controller {
    public function index() {
		return html_entity_decode($this->config->get('baidu_analytics_code'), ENT_QUOTES, 'UTF-8');
	}
}
