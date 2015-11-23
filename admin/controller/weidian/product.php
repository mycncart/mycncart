<?php
class ControllerWeidianProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('weidian/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('weidian/product');

		$this->getList();
	}

	//增加商品
	public function push() {
		
		$this->load->language('weidian/product');
		
		$product_id = $this->request->get['product_id'];
		
		$this->load->model('weidian/product');
		
		$appkey = $this->config->get('weidian_appkey');
		
		
		
		$secret = $this->config->get('weidian_secret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appkey='.trim($appkey).'&secret='.trim($secret);
		
		$return_json = file_get_contents($url);
		
		//echo $return_json;
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		
		$token_status_reason = $return_info->status->status_reason;
		
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			$access_token = $return_info->result->access_token;
			
			$product_info = $this->model_weidian_product->getProduct($product_id);
			
			//获取并上传图片
			$main_image = $product_info['image'];		
			
			$upload_result = $this->uploadImage($main_image,$access_token);
			
			if($upload_result) {
				
				//添加商品
				
				//获取该商品的已经推送到微店的分类开始
				
				$wd_categories = '';
				
				$categories = $this->model_weidian_product->getCategoresByProductId($product_id);
				if($categories) {
					
					$i = count($categories);
					
					$k = 0;
					
					foreach($categories as $category) {
						if($k == ($i - 1)) {
							$wd_categories .= $category['weidian_category_id'];
						}else{
							$wd_categories .= $category['weidian_category_id'].',';
						}
						
						$k++;
					}
				}
				
				
				//获取该商品的已经推送到微店的分类结束
				
				//获取价格start
				$special = 0;

				$product_specials = $this->model_weidian_product->getProductSpecials($product_id);
	
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
				
				
				
				$product_option_values = $this->model_weidian_product->getProductOptionValues($product_id);
				
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
					
					$this->model_weidian_product->updateSent($product_id,  $submit_info['result']['itemid']);
					
					
					foreach($submit_info['result']['skus'] as $skuinfo) {
						
						echo $skuinfo['title'].': '.$skuinfo['id'].'<br>';
						
						$option_info = $this->model_weidian_product->getOptionValueId($skuinfo, $product_id);
						
						if($option_info) {
							$this->model_weidian_product->updateSkus($option_info['option_value_id'], $product_id, $skuinfo['id']);
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
					
					
		
					$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		
					$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}
	
	//更新微店商品
	public function update() {
		
		$this->load->language('weidian/product');
		
		$product_id = $this->request->get['product_id'];
		
		$this->load->model('weidian/product');
		
		$appkey = $this->config->get('weidian_appkey');
		
		
		
		$secret = $this->config->get('weidian_secret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appkey='.trim($appkey).'&secret='.trim($secret);
		
		$return_json = file_get_contents($url);
		
		//echo $return_json;
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		
		$token_status_reason = $return_info->status->status_reason;
		
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			$access_token = $return_info->result->access_token;
			
			$product_info = $this->model_weidian_product->getProduct($product_id);
			
			//获取并上传图片
			$main_image = $product_info['image'];		
			
			$upload_result = $this->uploadImage($main_image,$access_token);
			
			if($upload_result) {
				
				//添加商品
				
				//获取该商品的已经推送到微店的分类开始
				
				$wd_categories = '';
				
				$categories = $this->model_weidian_product->getCategoresByProductId($product_id);
				if($categories) {
					
					$i = count($categories);
					
					$k = 0;
					
					foreach($categories as $category) {
						if($k == ($i - 1)) {
							$wd_categories .= $category['weidian_category_id'];
						}else{
							$wd_categories .= $category['weidian_category_id'].',';
						}
						
						$k++;
					}
				}
				
				
				//获取该商品的已经推送到微店的分类结束
				
				//获取价格start
				$special = 0;

				$product_specials = $this->model_weidian_product->getProductSpecials($product_id);
	
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
				
				
				
				$product_option_values = $this->model_weidian_product->getProductOptionValues($product_id);
				
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
						
						
						$skus .= '{"id":"'.$value['weidian_sku_id'].'","title":"'.urlencode($value["name"]).'","price":"'.$option_price.'","stock":"'.$quantity.'","sku_merchant_code":""}';
						
					}
					
					
					$submit_url = 'http://api.vdian.com/api?public={"method":"vdian.item.update","access_token":"'.$access_token.'","version":"1.0","format":"json"}&param={"stock":"60","price":"'.$price.'","cate_ids":['.$wd_categories.'],"item_name":"'.urlencode($product_info['name']).'","fx_fee_rate":"1","itemid":"'.$product_info['weidian_product_id'].'","skus":['.$skus.'],"merchant_code":"'.urlencode($product_info['model']).'"}';
					
					
					
				}else{
				
					
					$submit_url = 'http://api.vdian.com/api?public={"method":"vdian.item.update","access_token":"'.$access_token.'","version":"1.0","format":"json"}&param={"stock":"60","price":"'.$price.'","cate_ids":['.$wd_categories.'],"item_name":"'.urlencode($product_info['name']).'","fx_fee_rate":"1","itemid":"'.$product_info['weidian_product_id'].'","skus":[],"merchant_code":"'.urlencode($product_info['model']).'"}';
				
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
					
					
		
					$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
		
					$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
		}

		
	}
	
	//删除微店商品
	public function unpush() {
		
		$this->load->language('weidian/product');
		
		$product_id = $this->request->get['product_id'];
		
		$this->load->model('weidian/product');
		
		$appkey = $this->config->get('weidian_appkey');
		
		
		
		$secret = $this->config->get('weidian_secret');
		
		
		
		$url = 'https://api.vdian.com/token?grant_type=client_credential&appkey='.trim($appkey).'&secret='.trim($secret);
		
		$return_json = file_get_contents($url);
		
		$return_info = json_decode($return_json);
		
		$token_status_code = $return_info->status->status_code;
		$token_status_reason = $return_info->status->status_reason;
		
		if(($token_status_code == 0) && ($token_status_reason == 'success')) {
		
			
			$access_token = $return_info->result->access_token;
			
			$product_info = $this->model_weidian_product->getProduct($product_id);
			
			
			$submit_url = 'http://api.vdian.com/api?param={"itemid":"'.$product_info['weidian_product_id'].'"}
&public={"method":"vdian.item.delete","access_token":"'.$access_token.'",
"version":"1.0","format":"json"}';
			
			$submit_return_json = file_get_contents($submit_url);
			
			
			$submit_info = json_decode($submit_return_json);
			
			
			
			$status_code = $submit_info->status->status_code;
			$status_reason = $submit_info->status->status_reason;
			
			if(($status_code == 0) && ($status_reason == 'success')) {
				
				$this->model_weidian_product->deleteSent($product_id);
				
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
	
				$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
	
				$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->response->redirect($this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));	
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
			'href' => $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('weidian/product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy'] = $this->url->link('weidian/product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('weidian/product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		$product_total = $this->model_weidian_product->getTotalProducts($filter_data);

		$results = $this->model_weidian_product->getProducts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$product_specials = $this->model_weidian_product->getProductSpecials($result['product_id']);

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
				'edit'       => $this->url->link('weidian/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'push'        => $this->url->link('weidian/product/push', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'update'        => $this->url->link('weidian/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'unpush'      => $this->url->link('weidian/product/unpush', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
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

		$data['sort_name'] = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

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
		$pagination->url = $this->url->link('weidian/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

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

		$this->response->setOutput($this->load->view('weidian/product_list.tpl', $data));
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('weidian/product');
			$this->load->model('weidian/option');

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

			$results = $this->model_weidian_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_weidian_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_weidian_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_weidian_option->getOptionValue($product_option_value['option_value_id']);

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
		//echo $file;
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
        
}


