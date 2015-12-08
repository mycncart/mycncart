<?php
class ControllerYouzanProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('youzan/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('youzan/product');

		$this->getList();
	}
	
	public function edit() {
		$this->language->load('youzan/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('youzan/product');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->addYouZanProduct($this->request->get['product_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function push() {
		
		$this->load->language('youzan/product');
		
		$product_id = $this->request->get['product_id'];
		
		$this->load->model('youzan/product');
		
		$appid = $this->config->get('youzan_appid');
		
		
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appid='.trim($appid).'&appsecret='.trim($appsecret);
		
		$return_json = file_get_contents($url);
		
		//echo $return_json;
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		
		$token_status_reason = $return_info->status->status_reason;
		
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			$access_token = $return_info->result->access_token;
			
			$product_info = $this->model_youzan_product->getProduct($product_id);
			
			//获取并上传图片
			$main_image = $product_info['image'];		
			
			$upload_result = $this->uploadImage($main_image,$access_token);
			
			if($upload_result) {
				
				//添加商品
				
				//获取该商品的已经推送到微店的分类开始
				
				$wd_categories = '';
				
				$categories = $this->model_youzan_product->getCategoresByProductId($product_id);
				if($categories) {
					
					$i = count($categories);
					
					$k = 0;
					
					foreach($categories as $category) {
						if($k == ($i - 1)) {
							$wd_categories .= $category['youzan_category_id'];
						}else{
							$wd_categories .= $category['youzan_category_id'].',';
						}
						
						$k++;
					}
				}
				
				
				//获取该商品的已经推送到微店的分类结束
				
				//获取价格start
				$special = 0;

				$product_specials = $this->model_youzan_product->getProductSpecials($product_id);
	
				foreach ($product_specials  as $product_special) {
					if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
						$special = $product_special['price'];
	
						break;
					}
				}
			
				if($special) {
					$price = round($special, 2);
				}else{
					$price = round($product_info['price'], 2);
				}
				//获取价格end
				
				
				
				$product_option_values = $this->model_youzan_product->getProductOptionValues($product_id);
				
				$skus = '';
				
				if($product_option_values) {
					
					
					foreach($product_option_values as $value) {
						
						if($value['quantity']) {
							$quantity = (int)$value['quantity'];	
						}else{
							$quantity = (int)$product_info['quantity'];
						}
						
						if($value['price_prefix'] == '+') {
							$option_price = round(($price + $value['price']), 2);
						}else{
							$option_price = round(($price - $value['price']), 2);
						}
						
						
						$skus .= '{"title":"'.urlencode($value["name"]).'","price":"'.$option_price.'","stock":"'.$quantity.'","sku_merchant_code":""}';
						
					}
					
					$submit_url = 'http://api.vdian.com/api?public={"method":"vdian.item.add","access_token":"'.$access_token.'","version":"1.0","format":"json"}&param={"imgs":["'.urlencode($upload_result['result']).'"],"stock":"60","price":"'.$price.'","cate_ids":['.$wd_categories.'],"item_name":"'.urlencode($product_info['name']).'","fx_fee_rate":"1","skus":['.$skus.'],"merchant_code":"'.urlencode($product_info['model']).'"}';
					
					
					
				}else{
				
					$submit_url = 'http://api.vdian.com/api?public={"method":"vdian.item.add","access_token":"'.$access_token.'","version":"1.0","format":"json"}&param={"imgs":["'.urlencode($upload_result['result']).'"],"stock":"60","price":"'.$price.'","cate_ids":['.$wd_categories.'],"item_name":"'.urlencode($product_info['name']).'","fx_fee_rate":"1","skus":[],"merchant_code":"'.urlencode($product_info['model']).'"}';
				
				}
				
				
			
				$submit_return_json = file_get_contents($submit_url);
				
				$submit_info = json_decode($submit_return_json, true);
				
				
				$status_code = $submit_info['status']['status_code'];
				
				$status_reason = $submit_info['status']['status_reason'];
				
				
				
				if(($status_code == 0) && ($status_reason == 'success')) {
					
					$this->model_youzan_product->updateSent($product_id,  $submit_info['result']['itemid']);
					
					
					foreach($submit_info['result']['skus'] as $skuinfo) {
						
						echo $skuinfo['title'].': '.$skuinfo['id'].'<br>';
						
						$option_info = $this->model_youzan_product->getOptionValueId($skuinfo, $product_id);
						
						if($option_info) {
							$this->model_youzan_product->updateSkus($option_info['option_value_id'], $product_id, $skuinfo['id']);
						}
						
					}
					
					$this->session->data['success'] = $this->language->get('text_success');
		
					$url = '';
					
					if (isset($this->request->get['filter_name'])) {
						$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_model'])) {
						$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_price'])) {
						$url .= '&filter_price=' . $this->request->get['filter_price'];
					}
			
					if (isset($this->request->get['filter_quantity'])) {
						$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
					}
					
					if (isset($this->request->get['filter_product_id'])) {
						$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
					}
			
					if (isset($this->request->get['filter_status'])) {
						$url .= '&filter_status=' . $this->request->get['filter_status'];
					}

					if (isset($this->request->get['filter_sent'])) {
						$url .= '&filter_sent=' . $this->request->get['filter_sent'];
					}
		
					if (isset($this->request->get['sort'])) {
						$url .= '&sort=' . $this->request->get['sort'];
					}
		
					if (isset($this->request->get['order'])) {
						$url .= '&order=' . $this->request->get['order'];
					}
		
					if (isset($this->request->get['page'])) {
						$url .= '&page=' . $this->request->get['page'];
					}
					
					
		
					$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
				}else{
					$this->session->data['warning'] = $this->language->get('text_warning');
		
					$url = '';
					
					if (isset($this->request->get['filter_name'])) {
						$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_model'])) {
						$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_price'])) {
						$url .= '&filter_price=' . $this->request->get['filter_price'];
					}
			
					if (isset($this->request->get['filter_quantity'])) {
						$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
					}
					
					if (isset($this->request->get['filter_product_id'])) {
						$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
					}
			
					if (isset($this->request->get['filter_status'])) {
						$url .= '&filter_status=' . $this->request->get['filter_status'];
					}
					
					if (isset($this->request->get['filter_sent'])) {
						$url .= '&filter_sent=' . $this->request->get['filter_sent'];
					}
		
					if (isset($this->request->get['sort'])) {
						$url .= '&sort=' . $this->request->get['sort'];
					}
		
					if (isset($this->request->get['order'])) {
						$url .= '&order=' . $this->request->get['order'];
					}
		
					if (isset($this->request->get['page'])) {
						$url .= '&page=' . $this->request->get['page'];
					}
		
					$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
				}
			
			
			}
		
		}else{
			
			$this->session->data['warning'] = $this->language->get('text_warning');
	
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}
	
	//更新微店商品
	public function update() {
		
		$this->load->language('youzan/product');
		
		$product_id = $this->request->get['product_id'];
		
		$this->load->model('youzan/product');
		
		$appid = $this->config->get('youzan_appid');
		
		
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appid='.trim($appid).'&appsecret='.trim($appsecret);
		
		$return_json = file_get_contents($url);
		
		//echo $return_json;
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		
		$token_status_reason = $return_info->status->status_reason;
		
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			$access_token = $return_info->result->access_token;
			
			$product_info = $this->model_youzan_product->getProduct($product_id);
			
			//获取并上传图片
			$main_image = $product_info['image'];		
			
			$upload_result = $this->uploadImage($main_image,$access_token);
			
			if($upload_result) {
				
				//添加商品
				
				//获取该商品的已经推送到微店的分类开始
				
				$wd_categories = '';
				
				$categories = $this->model_youzan_product->getCategoresByProductId($product_id);
				if($categories) {
					
					$i = count($categories);
					
					$k = 0;
					
					foreach($categories as $category) {
						if($k == ($i - 1)) {
							$wd_categories .= $category['youzan_category_id'];
						}else{
							$wd_categories .= $category['youzan_category_id'].',';
						}
						
						$k++;
					}
				}
				
				
				//获取该商品的已经推送到微店的分类结束
				
				//获取价格start
				$special = 0;

				$product_specials = $this->model_youzan_product->getProductSpecials($product_id);
	
				foreach ($product_specials  as $product_special) {
					if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
						$special = $product_special['price'];
	
						break;
					}
				}
			
				if($special) {
					$price = round($special, 2);
				}else{
					$price = round($product_info['price'], 2);
				}
				//获取价格end
				
				
				
				$product_option_values = $this->model_youzan_product->getProductOptionValues($product_id);
				
				$skus = '';
				
				if($product_option_values) {
					
					
					foreach($product_option_values as $value) {
						
						if($value['quantity']) {
							$quantity = (int)$value['quantity'];	
						}else{
							$quantity = (int)$product_info['quantity'];
						}
						
						if($value['price_prefix'] == '+') {
							$option_price = round(($price + $value['price']), 2);
						}else{
							$option_price = round(($price - $value['price']), 2);
						}
						
						
						$skus .= '{"id":"'.$value['youzan_sku_id'].'","title":"'.urlencode($value["name"]).'","price":"'.$option_price.'","stock":"'.$quantity.'","sku_merchant_code":""}';
						
					}
					
					
					$submit_url = 'http://api.vdian.com/api?public={"method":"vdian.item.update","access_token":"'.$access_token.'","version":"1.0","format":"json"}&param={"stock":"60","price":"'.$price.'","cate_ids":['.$wd_categories.'],"item_name":"'.urlencode($product_info['name']).'","fx_fee_rate":"1","itemid":"'.$product_info['youzan_product_id'].'","skus":['.$skus.'],"merchant_code":"'.urlencode($product_info['model']).'"}';
					
					
					
				}else{
				
					
					$submit_url = 'http://api.vdian.com/api?public={"method":"vdian.item.update","access_token":"'.$access_token.'","version":"1.0","format":"json"}&param={"stock":"60","price":"'.$price.'","cate_ids":['.$wd_categories.'],"item_name":"'.urlencode($product_info['name']).'","fx_fee_rate":"1","itemid":"'.$product_info['youzan_product_id'].'","skus":[],"merchant_code":"'.urlencode($product_info['model']).'"}';
				
				}
				
				
			
				$submit_return_json = file_get_contents($submit_url);
				
				$submit_info = json_decode($submit_return_json, true);
				
				
				

				$status_code = $submit_info['status']['status_code'];
				
				$status_reason = $submit_info['status']['status_reason'];
				
				
				
				if(($status_code == 0) && ($status_reason == 'success')) {
					
					
					
					
					$this->session->data['success'] = $this->language->get('text_success');
		
					$url = '';
					
					if (isset($this->request->get['filter_name'])) {
						$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_model'])) {
						$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_price'])) {
						$url .= '&filter_price=' . $this->request->get['filter_price'];
					}
			
					if (isset($this->request->get['filter_quantity'])) {
						$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
					}
					
					if (isset($this->request->get['filter_product_id'])) {
						$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
					}
			
					if (isset($this->request->get['filter_status'])) {
						$url .= '&filter_status=' . $this->request->get['filter_status'];
					}
					
					if (isset($this->request->get['filter_sent'])) {
						$url .= '&filter_sent=' . $this->request->get['filter_sent'];
					}
		
					if (isset($this->request->get['sort'])) {
						$url .= '&sort=' . $this->request->get['sort'];
					}
		
					if (isset($this->request->get['order'])) {
						$url .= '&order=' . $this->request->get['order'];
					}
		
					if (isset($this->request->get['page'])) {
						$url .= '&page=' . $this->request->get['page'];
					}
					
					
		
					$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
				}else{
					$this->session->data['warning'] = $this->language->get('text_warning');
		
					$url = '';
					
					if (isset($this->request->get['filter_name'])) {
						$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_model'])) {
						$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
					}
			
					if (isset($this->request->get['filter_price'])) {
						$url .= '&filter_price=' . $this->request->get['filter_price'];
					}
			
					if (isset($this->request->get['filter_quantity'])) {
						$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
					}
					
					if (isset($this->request->get['filter_product_id'])) {
						$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
					}
			
					if (isset($this->request->get['filter_status'])) {
						$url .= '&filter_status=' . $this->request->get['filter_status'];
					}
					
					if (isset($this->request->get['filter_sent'])) {
						$url .= '&filter_sent=' . $this->request->get['filter_sent'];
					}
		
					if (isset($this->request->get['sort'])) {
						$url .= '&sort=' . $this->request->get['sort'];
					}
		
					if (isset($this->request->get['order'])) {
						$url .= '&order=' . $this->request->get['order'];
					}
		
					if (isset($this->request->get['page'])) {
						$url .= '&page=' . $this->request->get['page'];
					}
		
					$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
				}
			
			
			}
		
		}else{
			
			$this->session->data['warning'] = $this->language->get('text_warning');
	
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}
	
	//删除微店商品
	public function unpush() {
		
		$this->load->language('youzan/product');
		
		$product_id = $this->request->get['product_id'];
		
		$this->load->model('youzan/product');
		
		$appid = $this->config->get('youzan_appid');
		
		
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appid='.trim($appid).'&appsecret='.trim($appsecret);
		
		$return_json = file_get_contents($url);
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		$token_status_reason = $return_info->status->status_reason;
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			
			$access_token = $return_info->result->access_token;
			
			$product_info = $this->model_youzan_product->getProduct($product_id);
			
			
			$submit_url = 'http://api.vdian.com/api?param={"itemid":"'.$product_info['youzan_product_id'].'"}
&public={"method":"vdian.item.delete","access_token":"'.$access_token.'",
"version":"1.0","format":"json"}';
			
			$submit_return_json = file_get_contents($submit_url);
			
			
			$submit_info = json_decode($submit_return_json);
			
			
			
			$status_code = $submit_info->status->status_code;
			$status_reason = $submit_info->status->status_reason;
			
			if(($status_code == 0) && ($status_reason == 'success')) {
				
				$this->model_youzan_product->deleteSent($product_id);
				
				$this->session->data['success'] = $this->language->get('text_delete_success');
	
				$url = '';
				
				if (isset($this->request->get['filter_name'])) {
					$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
				}
		
				if (isset($this->request->get['filter_model'])) {
					$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
				}
		
				if (isset($this->request->get['filter_price'])) {
					$url .= '&filter_price=' . $this->request->get['filter_price'];
				}
		
				if (isset($this->request->get['filter_quantity'])) {
					$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
				}
				
				if (isset($this->request->get['filter_product_id'])) {
					$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
				}
		
				if (isset($this->request->get['filter_status'])) {
					$url .= '&filter_status=' . $this->request->get['filter_status'];
				}
				
				if (isset($this->request->get['filter_sent'])) {
					$url .= '&filter_sent=' . $this->request->get['filter_sent'];
				}
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}else{
				$this->session->data['warning'] = $this->language->get('text_warning');
	
				$url = '';
				
				if (isset($this->request->get['filter_name'])) {
					$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
				}
		
				if (isset($this->request->get['filter_model'])) {
					$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
				}
		
				if (isset($this->request->get['filter_price'])) {
					$url .= '&filter_price=' . $this->request->get['filter_price'];
				}
		
				if (isset($this->request->get['filter_quantity'])) {
					$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
				}
				
				if (isset($this->request->get['filter_product_id'])) {
					$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
				}
		
				if (isset($this->request->get['filter_status'])) {
					$url .= '&filter_status=' . $this->request->get['filter_status'];
				}
				
				if (isset($this->request->get['filter_sent'])) {
					$url .= '&filter_sent=' . $this->request->get['filter_sent'];
				}
	
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
	
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
	
				$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		
		}else{
			
			$this->session->data['warning'] = $this->language->get('text_warning');
	
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
	
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}
			
			if (isset($this->request->get['filter_product_id'])) {
				$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
			}
	
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if (isset($this->request->get['filter_sent'])) {
				$url .= '&filter_sent=' . $this->request->get['filter_sent'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$filter_sent = $this->request->get['filter_sent'];
		} else {
			$filter_sent = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.product_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('youzan/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy'] = $this->url->link('youzan/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('youzan/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_product_id' => $filter_product_id,
			'filter_status'   => $filter_status,
			'filter_sent'     => $filter_sent,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$product_total = $this->model_youzan_product->getTotalProducts($filter_data);

		$results = $this->model_youzan_product->getProducts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$product_specials = $this->model_youzan_product->getProductSpecials($result['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];

					break;
				}
			}

			$data['products'][] = array(
				'product_id' => $result['product_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'special'    => $special,
				'quantity'   => $result['quantity'],
				'sent'   => $result['sent'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('youzan/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'push'        => $this->url->link('youzan/product/push', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'update'        => $this->url->link('youzan/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'unpush'      => $this->url->link('youzan/product/unpush', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_push'] = $this->language->get('text_push');
		$data['text_unpush'] = $this->language->get('text_unpush');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_id'] = $this->language->get('column_id');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_product_id'] = $this->language->get('entry_product_id');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sent'] = $this->language->get('entry_sent');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_push'] = $this->language->get('button_push');
		$data['button_unpush'] = $this->language->get('button_unpush');
		$data['button_update'] = $this->language->get('button_update');

		$data['token'] = $this->session->data['token'];

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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sent'])) {
			$url .= '&filter_sent=' . $this->request->get['filter_sent'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('youzan/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin'))). '&nbsp;&nbsp;<input type="text" value="" name="pnum" size="2">&nbsp;&nbsp;<button type="button" id="button-jump" class="btn btn-primary pull-right"><i class="fa fa-arrow-right"></i>'.$this->language->get("button_jump").'</button>';

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_price'] = $filter_price;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_product_id'] = $filter_product_id;
		$data['filter_status'] = $filter_status;
		$data['filter_sent'] = $filter_sent;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('youzan/product_list.tpl', $data));
	}
	
	
	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_upc'] = $this->language->get('entry_upc');
		$data['entry_ean'] = $this->language->get('entry_ean');
		$data['entry_jan'] = $this->language->get('entry_jan');
		$data['entry_isbn'] = $this->language->get('entry_isbn');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_date_available'] = $this->language->get('entry_date_available');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_download'] = $this->language->get('entry_download');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_option_value'] = $this->language->get('entry_option_value');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_recurring'] = $this->language->get('entry_recurring');
		$data['entry_youzan_category'] = $this->language->get('entry_youzan_category');
		$data['entry_youzan_promotion'] = $this->language->get('entry_youzan_promotion');
		$data['entry_youzan_tag'] = $this->language->get('entry_youzan_tag');
		$data['entry_youzan_is_virtual'] = $this->language->get('entry_youzan_is_virtual');
		$data['entry_youzan_post_fee'] = $this->language->get('entry_youzan_post_fee');
		$data['entry_youzan_price'] = $this->language->get('entry_youzan_price');
		$data['entry_youzan_origin_price'] = $this->language->get('entry_youzan_origin_price');
		$data['entry_youzan_buy_url'] = $this->language->get('entry_youzan_buy_url');
		$data['entry_youzan_outer_id'] = $this->language->get('entry_youzan_outer_id');
		$data['entry_youzan_buy_quota'] = $this->language->get('entry_youzan_buy_quota');
		$data['entry_youzan_quantity'] = $this->language->get('entry_youzan_quantity');
		$data['entry_youzan_hide_quantity'] = $this->language->get('entry_youzan_hide_quantity');
		$data['entry_youzan_is_display'] = $this->language->get('entry_youzan_is_display');
		$data['entry_youzan_join_level_discount'] = $this->language->get('entry_youzan_join_level_discount');
		

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_sku'] = $this->language->get('help_sku');
		$data['help_upc'] = $this->language->get('help_upc');
		$data['help_ean'] = $this->language->get('help_ean');
		$data['help_jan'] = $this->language->get('help_jan');
		$data['help_isbn'] = $this->language->get('help_isbn');
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_category'] = $this->language->get('help_category');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_option'] = $this->language->get('tab_option');
		$data['tab_recurring'] = $this->language->get('tab_recurring');
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_special'] = $this->language->get('tab_special');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_openbay'] = $this->language->get('tab_openbay');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['model'])) {
			$data['error_model'] = $this->error['model'];
		} else {
			$data['error_model'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['product_id'])) {
			$data['action'] = $this->url->link('catalog/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			
			$product_info = $this->model_youzan_product->getProduct($this->request->get['product_id']);
			
		}

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['product_description'])) {
			$data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_description'] = $this->model_youzan_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$data['product_description'] = array();
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$data['image'] = $product_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && is_file(DIR_IMAGE . $product_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		$data['youzan_categories'] = $this->getYouZanCategories();
		
		$data['youzan_promotions'] = $this->getYouZanPromotionCids();
		
		$data['youzan_tags'] = $this->getYouZanTags();
		
		if (isset($this->request->post['youzan_category_id'])) {
			$data['youzan_category_id'] = $this->request->post['youzan_category_id'];
		} else {
			$data['youzan_category_id'] = 0;
		}
		
		if (isset($this->request->post['youzan_promotion_id'])) {
			$data['youzan_promotion_id'] = $this->request->post['youzan_promotion_id'];
		} else {
			$data['youzan_promotion_id'] = 0;
		}
		
		if (isset($this->request->post['youzan_tag_id'])) {
			$data['youzan_tag_id'] = $this->request->post['youzan_tag_id'];
		} else {
			$data['youzan_tag_id'] = 0;
		}
		
		if (isset($this->request->post['post_fee'])) {
			$data['post_fee'] = $this->request->post['post_fee'];
		} else {
			$data['post_fee'] = '';
		}

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$data['price'] = $product_info['price'];
		} else {
			$data['price'] = '';
		}
		
		if (isset($this->request->post['origin_price'])) {
			$data['origin_price'] = $this->request->post['origin_price'];
		} elseif (!empty($product_info)) {
			$data['origin_price'] = $product_info['price'];
		} else {
			$data['origin_price'] = '';
		}

		if (isset($this->request->post['buy_url'])) {
			$data['buy_url'] = $this->request->post['buy_url'];
		} else {
			$data['buy_url'] = HTTP_CATALOG.'index.php?route=product/product&product_id='.$this->request->get['product_id'];
		}

		if (isset($this->request->post['outer_id'])) {
			$data['outer_id'] = $this->request->post['outer_id'];
		} elseif (!empty($product_info)) {
			$data['outer_id'] = $product_info['model'];
		} else {
			$data['outer_id'] = '';
		}

		if (isset($this->request->post['buy_quota'])) {
			$data['buy_quota'] = $this->request->post['buy_quota'];
		} else {
			$data['buy_quota'] = '';
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = '';
		}

		if (isset($this->request->post['hide_quantity'])) {
			$data['hide_quantity'] = $this->request->post['hide_quantity'];
		} else {
			$data['hide_quantity'] = '';
		}

		if (isset($this->request->post['is_display'])) {
			$data['is_display'] = $this->request->post['is_display'];
		} else {
			$data['is_display'] = 1;
		}
		
		if (isset($this->request->post['join_level_discount'])) {
			$data['join_level_discount'] = $this->request->post['join_level_discount'];
		} else {
			$data['join_level_discount'] = 1;
		}

		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('youzan/product_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'youzan/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['description']) < 10) || (utf8_strlen($value['description']) > 25000)) {
				$this->error['description'][$language_id] = $this->language->get('error_description');
			}
		}

		if ($this->request->post['post_fee'] <= 0) {
			$this->error['post_fee'] = $this->language->get('error_post_fee');
		}
		
		if ($this->request->post['price'] <= 0) {
			$this->error['price'] = $this->language->get('error_price');
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('youzan/product');
			$this->load->model('youzan/option');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 50;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_youzan_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_youzan_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_youzan_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_youzan_option->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'shipping_origin_id'      => $result['shipping_origin_id'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	protected function uploadImage($image, $access_token) {
		
		$response = array();
	
		$file = DIR_IMAGE.$image;
		
		$post_data = array(
		   "title"=>"PIC！！！",
		   
		   "media"=>'@'.$file
		);
		
		$url  = "http://api.vdian.com/media/upload?access_token=".$access_token; 
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_POST, 1 );
		curl_setopt($ch, CURLOPT_HEADER, false );
		curl_setopt($ch, CURLOPT_NOBODY, true );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data );
		
		
		$json = curl_exec($ch);
		
		if (!$json) {
			echo curl_error($ch), curl_errno($ch);
		} else {
			$response = json_decode($json, true);
		}
		
		return $response;
		
	}
	
	protected function getYouZanCategories() {
		$appid = $this->config->get('youzan_appid');
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method='kdt.itemcategories.get';
		$timestamp=date("Y-m-d H:i:s");
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$category_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&sign_method=md5&format=json';
		
		$result = file_get_contents($category_url);
		
		$youzan_categories = array();
		
		$news = json_decode($result, true);
		
		foreach($news as $category) {
	
			foreach($category['categories'] as $one) {
				
				if($one['is_parent']) {
					$youzan_categories[] = array(
						'cid'	=> $one['cid'],
						'name'	=> $one['name'],
						
					);
				}
				
				if(count($one['sub_categories']) > 1) {
					foreach($one['sub_categories'] as $two) {
						
						$youzan_categories[] = array(
							'cid'	=> $two['cid'],
							'name'	=> $one['name'].'-->'.$two['name'],
							
						);
						
					}
				}
				
			}
			
		}
		
		return $youzan_categories;
	}
	
	protected function getYouZanPromotionCids() {
		$appid = $this->config->get('youzan_appid');
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method='kdt.itemcategories.promotions.get';
		$timestamp=date("Y-m-d H:i:s");
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$promotion_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&sign_method=md5&format=json';
		
		$result = file_get_contents($promotion_url);
		
		$youzan_promotions = json_decode($result, true);
		
		return $youzan_promotions['response']['categories'];
	}
	
	protected function getYouZanTags() {
		$appid = $this->config->get('youzan_appid');
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method='kdt.itemcategories.tags.get';
		$timestamp=date("Y-m-d H:i:s");
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$tag_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&sign_method=md5&format=json';
		
		$result = file_get_contents($tag_url);
		
		$youzan_tags = json_decode($result, true);
		
		return $youzan_tags['response']['tags'];
	}
	
	protected function getProductFromYouZan($youzan_id) {
		$appid = $this->config->get('youzan_appid');
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		date_default_timezone_set('PRC');
		
		$method = 'kdt.item.get';
		
		$num_iid = $youzan_id;
		
		$timestamp = date("Y-m-d H:i:s");
		
		$v='1.0';
		
		$md5_before = $appsecret.'app_id'.$appid.'formatjsonmethod'.$method.'num_iid'.$num_iid.'sign_methodmd5timestamp'.$timestamp.'v'.$v.$appsecret;
		
		$md5_after = md5($md5_before);
		
		$youzan_url = 'https://open.koudaitong.com/api/entry?sign='.$md5_after.'&timestamp='.urlencode($timestamp).'&v='.$v.'&app_id='.$appid.'&method='.$method.'&num_iid='.$num_iid.'&sign_method=md5&format=json';
		
		$result = file_get_contents($youzan_url);
		
		$youzan_info = json_decode($result, true);
		
		return $youzan_info;
	}
	
	public function addYouZanProduct() {
		$appid = $this->config->get('youzan_appid');
		
		$appsecret = $this->config->get('youzan_appsecret');
		
		$this->load->library('youzan/kdtapiprotocol');
		
		$this->load->library('youzan/simplehttpclient');
		
		$this->load->library('youzan/kdtapiclient');
		
		
		date_default_timezone_set('PRC');
		
		$client = new KdtApiClient($appid, $appsecret);

		$method = 'kdt.item.add';
		$params = array('title' => '测试商品来自于舒优派', 'desc' => 'description here', 'post_fee' => 0.2,	'price'	=>100.85);
		
		$files = '';
		
		
		echo '<pre>';
		var_dump( 
			$client->post($method, $params, $files)
		);
		echo '</pre>';
		
		
	}
	
}


