<?php 
class ControllerToolExcelExportImport extends Controller { 
	private $error = array();
	
	public function index() {
		$this->load->language('tool/excelexportimport');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('tool/excelexportimport');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			
			if ((isset( $this->request->files['upload'] )) && (is_uploaded_file($this->request->files['upload']['tmp_name']))) {
				
				$file = $this->request->files['upload']['tmp_name'];
				if ($this->model_tool_excelexportimport->upload($file)===TRUE) {
					
					$this->session->data['success'] = $this->language->get('text_success');
					$this->response->redirect($this->url->link('tool/excelexportimport', 'user_token=' . $this->session->data['user_token'], true));
				} else {
					$this->error['warning'] = $this->language->get('error_upload');
				}
				
			}
			
		}

		if (!empty($this->session->data['export_error']['errstr'])) {
			
			$this->error['warning'] = $this->session->data['export_error']['errstr'];
			
			if (!empty($this->session->data['export_nochange'])) {
				
				$this->error['warning'] .= '<br />'.$this->language->get( 'text_nochange' );
				
			}
			
			$this->error['warning'] .= '<br />'.$this->language->get( 'text_log_details' );
			
		}
		
		unset($this->session->data['export_error']);
		unset($this->session->data['export_nochange']);
		
		$minProductId = $this->model_tool_excelexportimport->getMinproduct_id();
		$maxProductId = $this->model_tool_excelexportimport->getMaxproduct_id();
		$countProduct = $this->model_tool_excelexportimport->getCountproduct();
		
		$data['min_product_id'] = $minProductId;
		$data['max_product_id'] = $maxProductId;
		$data['count_product'] = $countProduct;

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_select_file_to_import'] = $this->language->get('text_select_file_to_import');
		$data['text_select_type_to_export'] = $this->language->get('text_select_type_to_export');
		
		
		$data['entry_restore'] = $this->language->get('entry_restore');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_exportway_sel'] = $this->language->get('entry_exportway_sel');
		$data['entry_start_id'] = $this->language->get('entry_start_id');
		$data['entry_end_id'] = $this->language->get('entry_end_id');
		$data['entry_start_index'] = $this->language->get('entry_start_index');
		$data['entry_end_index'] = $this->language->get('entry_end_index');
		
		$data['button_import'] = $this->language->get('button_import');
		$data['button_export'] = $this->language->get('button_export');
		$data['button_export_pid'] = $this->language->get('button_export_pid');
		$data['button_export_page'] = $this->language->get('button_export_page');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['error_select_file'] = $this->language->get('error_select_file');
		$data['error_post_max_size'] = str_replace( '%1', ini_get('post_max_size'), $this->language->get('error_post_max_size') );
		$data['error_upload_max_filesize'] = str_replace( '%1', ini_get('upload_max_filesize'), $this->language->get('error_upload_max_filesize') );
		$data['error_pid_no_data'] = $this->language->get('error_pid_no_data');
		$data['error_page_no_data'] = $this->language->get('error_page_no_data');
		$data['error_param_not_number'] = $this->language->get('error_param_not_number');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
			
		} else {
			
			$data['success'] = '';
			
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], true),
			'separator' => FALSE
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/excelexportimport', 'user_token=' . $this->session->data['user_token'], true),
			'separator' => ' :: '
		);
		
		$data['action'] = $this->url->link('tool/excelexportimport', 'user_token=' . $this->session->data['user_token'], true);
		$data['export'] = $this->url->link('tool/excelexportimport/download', 'user_token=' . $this->session->data['user_token'], true);
		$data['post_max_size'] = $this->return_bytes( ini_get('post_max_size') );
		$data['upload_max_filesize'] = $this->return_bytes( ini_get('upload_max_filesize') );

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('tool/excelexportimport', $data));
	}


	function return_bytes($val)
	{
		$val = trim($val);
	
		switch (strtolower(substr($val, -1)))
		{
			case 'm': $val = (int)substr($val, 0, -1) * 1048576; break;
			case 'k': $val = (int)substr($val, 0, -1) * 1024; break;
			case 'g': $val = (int)substr($val, 0, -1) * 1073741824; break;
			case 'b':
				switch (strtolower(substr($val, -2, 1)))
				{
					case 'm': $val = (int)substr($val, 0, -2) * 1048576; break;
					case 'k': $val = (int)substr($val, 0, -2) * 1024; break;
					case 'g': $val = (int)substr($val, 0, -2) * 1073741824; break;
					default : break;
				} break;
			default: break;
		}
		
		return $val;
	}


	public function download() {
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			
			if (isset( $this->request->post['exportway'] )) {
				$exportway = $this->request->post['exportway'];
			}
			
			if (isset( $this->request->post['min'] )) {
				$min = $this->request->post['min'];
			}
			
			if (isset( $this->request->post['max'] )) {
				$max = $this->request->post['max'];
			}
			
			// send the categories, products and options as a spreadsheet file
			$this->load->model('tool/excelexportimport');
			switch($exportway) {
				case 'pid':
					$this->model_tool_excelexportimport->download(NULL, NULL, $min, $max);
					break;
				case 'page':
					$this->model_tool_excelexportimport->download($min*($max-1-1), $min, NULL, NULL); 
					break;
				default:
					break;
			}
			$this->response->redirect($this->url->link('tool/excelexportimport', 'user_token=' . $this->session->data['user_token'], true));

		} else {

			
			return $this->forward('error/permission');
		}
	}


	private function validate() {
		if (!$this->user->hasPermission('modify', 'tool/excelexportimport')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
