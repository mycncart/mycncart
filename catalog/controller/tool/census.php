<?php
class ControllerToolCensus extends Controller {
	public function index() {
		if (isset($this->request->get['dtime']) && isset($this->request->get['visit_token'])) {

			if (isset($this->request->get['product_id'])) {
	 			$product_id = $this->request->get['product_id'];
	 		} else {
	 			$product_id = 0;
	 		}

	 		$dtime = (int)($this->request->get['dtime']/1000);
	 		$visit_token = $this->request->get['visit_token'];

	 		$this->load->model('catalog/visitor');

	 		$this->model_catalog_visitor->updateVisitor($product_id, $dtime, $visit_token);

	 	}
	}
}