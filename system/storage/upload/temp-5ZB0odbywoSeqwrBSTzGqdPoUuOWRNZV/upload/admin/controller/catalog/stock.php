<?php 
class ControllerCatalogStock extends Controller {
	private $error = array();
	 
	public function index() {
		$this->language->load('catalog/stock');
		 
		$this->document->setTitle($this->language->get('sm_heading_title'));

		$this->load->model('catalog/stock');

		$this->getList();
	}

	private function setupMessages(&$data) {
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

		if (isset($this->session->data['attention'])) {
			$data['attention'] = $this->session->data['attention'];
				
			unset($this->session->data['attention']);
		} else {
			$data['attention'] = '';
		}
	}
	
	private function createLink($link, $additional_url = '') {
		return $this->url->link($link, 'token=' . $this->session->data['token'] . $additional_url, 'SSL');
	}

	private function get($field, $default = '') {
		$result = $default;
		if (isset($this->request->get[$field])) {
			$result = $this->request->get[$field];
		}
		return $result;
	}
	private function createPagination($total, $page, $link, &$data) { // data is used by reference
		$url = $this->createUrl('', FALSE);
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->createLink($link, $url . '&page={page}');
		
		$rpp = $this->config->get('config_limit_admin');
		
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $rpp) + 1 : 0, ((($page - 1) * $rpp) > ($total - $rpp)) ? $total : ((($page - 1) * $rpp) + $rpp), $total, ceil($total / $rpp));
	}

    // Helper function to create the current url that includes filter related fields, and sort/page fields
	private function createUrl($url = '', $include_page = TRUE, $adjust_sort_order = FALSE) {
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
			
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . urlencode(html_entity_decode($this->request->get['filter_quantity'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_option'])) {
			$url .= '&filter_option=' . urlencode(html_entity_decode($this->request->get['filter_option'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_comb_quantity'])) {
			$url .= '&filter_comb_quantity=' . urlencode(html_entity_decode($this->request->get['filter_comb_quantity'], ENT_QUOTES, 'UTF-8'));
		}

		if ($adjust_sort_order) {
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
			if ($order == 'ASC') {
				$url .= '&order=DESC';
			} else {
				$url .= '&order=ASC';
			}
		} else {
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
		}

        if ($include_page) {
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
		}
		return $url;		
	}

	public function update() {
		if (! $this->config->get('stock_module_enabled') ) {
			$this->response->redirect( $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'));
			return;
		}
			
		$this->language->load('catalog/stock');

		$this->document->setTitle($this->language->get('sm_heading_title'));

		$this->load->model('catalog/stock');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$product_disabled = $this->model_catalog_stock->editStock($this->request->get['product_id'], $this->request->post);

			if ($product_disabled) {
				$this->session->data['attention'] = $this->language->get('sm_information_product_disabled');
			} else {
				$this->session->data['success'] = $this->language->get('sm_text_success');
			}
				
			$url = $this->createUrl('');

			$this->response->redirect($this->url->link('catalog/stock', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		} else {
			$this->getForm();
		}
	}

	public function combinations() {
		if (! $this->config->get('stock_module_enabled')) {
			$this->response->redirect( $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->language->load('catalog/stock');
		$this->load->model('catalog/stock');
		
		$data = array();
		
		$this->document->setTitle($this->language->get('sm_heading_combinations_title'));
		$data['heading_combinations_title'] = $this->language->get('sm_heading_combinations_title');
		$data['text_combinations_list'] = $this->language->get('sm_text_combinations_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['column_name'] = $this->language->get('sm_column_name');
		$data['column_model'] = $this->language->get('sm_column_model');
		$data['column_quantity'] = $this->language->get('sm_column_quantity');
		$data['column_product_quantity'] = $this->language->get('sm_column_product_quantity');
		$data['column_product_model'] = $this->language->get('sm_column_product_model');
		$data['column_comb_quantity'] = $this->language->get('sm_column_comb_quantity');
		$data['column_sku'] = $this->language->get('sm_column_sku');
		$data['column_action'] = $this->language->get('sm_column_action');
		$data['column_option_value'] = $this->language->get('sm_column_option_value');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_collapse'] = $this->language->get('sm_button_collapse');
		$data['button_expand'] = $this->language->get('sm_button_expand');
		$data['button_filter'] = $this->language->get('button_filter');
		
		$data['token'] = $this->session->data['token'];
		
		$url = $this->createUrl('');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->createLink('common/dashboard'));
		$data['breadcrumbs'][] = array('text' => $this->language->get('sm_heading_title'), 'href' => $this->createLink('catalog/stock'));
		$data['breadcrumbs'][] = array('text' => $this->language->get('sm_heading_combinations_title'), 'href' => $this->createLink('catalog/stock/combinations', $url));

		$filter_name = $this->get('filter_name', null);
		$filter_model = $this->get('filter_model', null);
		$filter_quantity = $this->get('filter_quantity', null);
		$filter_comb_quantity = $this->get('filter_comb_quantity', null);
		$filter_option = $this->get('filter_option', null);
		
		$page = $this->get('page', 1);	
		$sort = $this->get('sort', 'pd.name');
		$order = $this->get('order', 'ASC');
			
		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'filter_quantity' => $filter_quantity,
			'filter_comb_quantity' => $filter_comb_quantity,
			'filter_option'	  => $filter_option,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);
		
		$total = $this->model_catalog_stock->getTotalCombinations($filter_data);
		$data['products'] = $this->model_catalog_stock->getCombinations($filter_data);
		
		// setup attention/error/success messages
		$this->setupMessages($data);
		
		$url = $this->createUrl('', TRUE, TRUE); // add page, add new sort order
		$data['sort_name'] = $this->createLink('catalog/stock/combinations', '&sort=pd.name' . $url);
		$data['sort_model'] = $this->createLink('catalog/stock/combinations', '&sort=p.model' . $url);
		$data['sort_quantity'] = $this->createLink('catalog/stock/combinations', '&sort=p.quantity' . $url);
		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_comb_quantity'] = $filter_comb_quantity;
		$data['filter_option'] = $filter_option;
		$data['sort'] = $sort;
		$data['order'] = $order;
		
		// add pagination info to $data (data is used by reference)
		$this->createPagination($total, $page, 'catalog/stock/combinations', $data);

		// process header, left and footer controllers
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/stock_list_combinations.tpl', $data));
	}

	// this function is meant to be called via ajax
	public function update_combinations() {
		$data = array();
		$this->language->load('catalog/stock');
		$this->load->model('catalog/stock');
		
		$product_id = $this->request->post['product_id'];
		
		// check if user has permission to access this page
		if (!$this->user->hasPermission('modify', 'catalog/stock')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
			
		// check that the quantity values are valid numbers
		if (!$this->error && isset($this->request->post['product_combinations'])) {
			$combinations = $this->request->post['product_combinations'];
			
			$row = 0;
			foreach ($combinations as $combination) {
				$quantity = $combination['quantity'];
				if (!is_numeric($quantity)) {
					$this->error['quantity'][$row] = true; 
				}	else if ($quantity < 0) {
					$this->error['quantity'][$row] = true; 
				}
				$row++;
			}
			if (isset($this->error['quantity'])) {
				$this->error['warning'] = $this->language->get('sm_error_quantity');
			}
		}
		if (!$this->error && !$this->model_catalog_stock->isProductStockEnabled($product_id)) {
			$this->error['warning'] = $this->language->get('sm_error_stale_data');
		}
		
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
			if (isset($this->error['quantity'])) {
				$data['error_quantity'] = array();
				foreach($this->error['quantity'] as $key => $value) {
					$data['error_quantity'][] = $key;
				}
			}
		} else {
			if (isset($this->request->post['product_combinations']) && isset($this->request->post['product_id']) && count($this->request->post['product_combinations']) > 0) { 
				$combinations = $this->request->post['product_combinations'];
				$total_quantity = $this->model_catalog_stock->editStockCombinations($product_id, $combinations);
				
				if ($total_quantity == -1) {
					$data['error'] = $this->language->get('sm_error_stale_data');
				} else {
					$data['product_quantity'] = $total_quantity;
				}
			}
		}		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput( json_encode($data) );
	}

	protected function getForm() {

		$data['heading_title'] = $this->language->get('sm_heading_title');
		$data['text_edit'] = $this->language->get('sm_text_edit');
		$data['text_notfound'] = $this->language->get('sm_text_notfound');
		$data['column_quantity'] = $this->language->get('sm_column_quantity');
		$data['column_sku'] = $this->language->get('sm_column_sku');
		$data['column_action'] = $this->language->get('sm_column_action');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_combination'] = $this->language->get('sm_button_add_combination');
		$data['button_add_all_combinations'] = $this->language->get('sm_button_add_all_combinations');
		$data['button_filter'] = $this->language->get('button_filter');

		$product_info = $this->model_catalog_stock->getStockEnabledProduct($this->request->get['product_id']);
			
		$data['product_info'] = $product_info;
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['quantity'])) {
			$data['error_quantity'] = $this->error['quantity'];
		} else {
			$data['error_name'] = array();
		}

		$url = $this->createUrl('');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
		);

		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('sm_heading_title'),
				'href'      => $this->url->link('catalog/stock', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
			
		$data['action'] = $this->url->link('catalog/stock/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		$data['cancel'] = $this->url->link('catalog/stock', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_stock->getProductOptions($this->request->get['product_id']);
		} else {
			$product_options = array();
		}

		if (isset($this->request->post['product_combinations'])) {
			$product_combinations = $this->request->post['product_combinations'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_combinations = $this->model_catalog_stock->getProductStockCombinations($this->request->get['product_id']);
		} else {
			$product_combinations = array();
		}
			
		$data['product_combinations'] = $product_combinations;
			
		$data['product_options'] = array();

		foreach ($product_options as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
					
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
							'product_option_value_id' => $product_option_value['product_option_value_id'],
							//'option_value_id'         => $product_option_value['option_value_id'],
							'name'         						=> $product_option_value['name']
					);
				}
					
				$data['product_options'][] = array(
						'product_option_id'    => $product_option['product_option_id'],
						'product_option_value' => $product_option_value_data,
						//'option_id'            => $product_option['option_id'],
						'name'                 => $product_option['name']
				);
			}
		}
			
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/stock_form.tpl', $data));			
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/stock')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
			
		// check that the quantity values are valid numbers
		if (!$this->error && isset($this->request->post['product_combinations'])) {
			$combinations = $this->request->post['product_combinations'];
			
			$row = 0;
			foreach ($combinations as $combination) {
				$quantity = $combination['quantity'];
				if (!is_numeric($quantity)) {
					$this->error['quantity'][$row] = true; 
				}	else if ($quantity < 0) {
					$this->error['quantity'][$row] = true; 
				}
				$row++;
			}
		}
		if (isset($this->error['quantity'])) {
			$this->error['warning'] = $this->language->get('sm_error_quantity');
		}
			
		// check that no combination is repeated. If such combinations exist, return the name of the first one
		if (!$this->error && isset($this->request->post['product_combinations'])) {
			$duplicates = $this->model_catalog_stock->getDuplicateCombinationNames($this->request->post['product_combinations'], TRUE, TRUE, "-");
			if (count($duplicates) > 0) {
				$this->error['warning'] = sprintf($this->language->get('sm_error_combination'), $duplicates[0]);
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function xl_report() {
		$this->report(TRUE);
	}
	
	public function report($xls = FALSE) {
		if (! $this->config->get('stock_module_enabled')) {
			$this->response->redirect( $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->language->load('catalog/stock'); 
		$this->load->model('catalog/stock');

		$limit = $this->config->get('stock_module_report_limit');
		if (isset($this->request->post['stock_module_report_limit'])) {
			$stock_limit = $this->request->post['stock_module_report_limit'];
			if (is_numeric($stock_limit)) {
				$limit = $stock_limit;
			}
		} 
		if (!isset($limit)) {
			$limit = 10;
		}


		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['language'] = $this->language->get('code');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_stock_available'] = sprintf($this->language->get('sm_text_stock_available'), $limit);
		$data['title'] = $this->language->get('sm_heading_report_title');
		$data['text_quantity'] = $this->language->get('sm_column_quantity');
		$data['text_sku'] = $this->language->get('sm_column_sku');
		$data['button_stock_report_xl'] = $this->language->get('sm_button_stock_report_xl');
		$data['stock_module_report_limit'] = $limit;
		$data['stock_module_report_xl_link'] = $this->url->link('catalog/stock/xl_report', 'token=' . $this->session->data['token'], 'SSL');			
			
		$products = $this->model_catalog_stock->getStockReport($limit);
		
		$data['products'] = $products;

		if ($xls) {
			require_once(DIR_SYSTEM . "helper/php-excel.class.php");
			$xl = new Excel_XML('UTF-8', true, 'Stock report');
			
			$xl_array = array();
			
			foreach ($data['products'] as $p) {
				$xl_array[] = array('combination' => $p['product_id'] . " - " . $p['name'] . " - " . $p['model'], 'sku' => $data['text_sku'], 'quantity' => $data['text_quantity']);
				$combinations = $p['combinations'];
				foreach ($combinations as $combination) {
					$combination_name = implode('-', $combination['option_value_names']); 
					//$xl_array[] = array($combination_name, $combination['quantity']);
					$xl_array[] = array(
						'combination' 	=> $combination_name,
						'sku' 			=> $combination['sku'],
						'quantity'		=> $combination['quantity']
					);
				}
				//$xl_array[] = array("", "");
				$xl_array[] = array(
					'combination' 	=> '',
					'sku' 			=> '',
					'quantity'		=> ''
				);
				
			}
			
			$xl->addArray($xl_array);
			$xl->generateXML(date('Y-m-d_H-i-s', time()) . '-stock-report-less-than-' . $limit);
		} else {
			$this->response->setOutput($this->load->view('catalog/stock_report.tpl', $data));
		}

		
		
	} 

	protected function getList() {

		if (! $this->config->get('stock_module_enabled')) {
			$this->response->redirect( $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$filter_name = $this->get('filter_name', null);
		$filter_model = $this->get('filter_model', null);
		$sort = $this->get('sort', 'pd.name');
		$order = $this->get('order', 'ASC');
		$page = $this->get('page', 1);
			
		$url = $this->createUrl('');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->createLink('common/dashboard') );
		$data['breadcrumbs'][] = array('text' => $this->language->get('sm_heading_title'), 'href' => $this->createLink('catalog/stock', $url) );

		$data['stock_report'] = $this->createLink('catalog/stock/report', $url);
		$data['stock_combinations'] = $this->createLink('catalog/stock/combinations', $url);

		$data['products'] = array();
		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');
			
		$product_total = $this->model_catalog_stock->getTotalStockEnabledProducts($filter_data);
		$results = $this->model_catalog_stock->getStockEnabledProducts($filter_data);

		foreach ($results as $result) {
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
				
			$data['products'][] = array(
					'product_id' => $result['product_id'],
					'name'       => $result['name'],
					'model'      => $result['model'],
					'quantity'   => $result['quantity'],
					'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
					'image'      => $image,
					'action'     => $this->createLink('catalog/stock/update', '&product_id=' . $result['product_id'] . $url)
			);
		}

		$data['heading_title'] = $this->language->get('sm_heading_title');
		$data['text_list'] = $this->language->get('sm_text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_image_manager'] = $this->language->get('text_image_manager');

		$data['column_image'] = $this->language->get('sm_column_image');
		$data['column_name'] = $this->language->get('sm_column_name');
		$data['column_model'] = $this->language->get('sm_column_model');
		$data['column_quantity'] = $this->language->get('sm_column_quantity');
		$data['column_status'] = $this->language->get('sm_column_status');
		$data['column_action'] = $this->language->get('sm_column_action');
			
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_edit'] = $this->language->get('button_edit');

    	$data['text_stock_report_limit'] = $this->language->get('sm_text_stock_report_limit');
		$data['button_stock_report'] = $this->language->get('sm_button_stock_report');
		$data['button_stock_combinations'] = $this->language->get('sm_button_stock_combinations');
		$data['error_stock_limit_not_numeric'] = $this->language->get('sm_error_stock_limit_not_numeric');
		
		$data['token'] = $this->session->data['token'];
			
		if (isset($this->request->post['stock_report_limit'])) {
			$data['stock_report_limit'] = $this->request->post['stock_report_limit'];
		} else if ($this->config->get('stock_module_report_limit')) {
			$data['stock_report_limit'] = $this->config->get('stock_module_report_limit');
		} else {
			$data['stock_report_limit'] = 5;
		}
			
		$this->setupMessages($data);

		$url = $this->createUrl('', TRUE, TRUE); // add page, add new sort order

		$data['sort_name'] = $this->createLink('catalog/stock', '&sort=pd.name' . $url);
		$data['sort_model'] = $this->createLink('catalog/stock', '&sort=p.model' . $url);
		$data['sort_quantity'] = $this->createLink('catalog/stock', '&sort=p.quantity' . $url);
			
		$this->createPagination($product_total, $page, 'catalog/stock', $data);

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/stock_list.tpl', $data));
	}

	public function autocomplete_options() {
		$json = array();
			
		if (isset($this->request->get['filter_option']) ) {
			$this->load->model('catalog/stock');

			$filter_option = $this->get('filter_option', '');
			$limit = $this->get('limit', 20);
				
			$data = array(
					'filter_option'  => $filter_option,
					'start'        => 0,
					'limit'        => $limit
			);

			$results = $this->model_catalog_stock->getCombinationOptionValueNames($data);
			
			foreach ($results as $name) {
				$json[] = array(
						'name' => strip_tags(html_entity_decode($name, ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	public function autocomplete() {
		$json = array();
			
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) ) {
			$this->load->model('catalog/stock');

			$filter_name = $this->get('filter_name', '');
			$filter_model = $this->get('filter_model', '');
			$limit = $this->get('limit', 20);
				
			$data = array(
					'filter_name'  => $filter_name,
					'filter_model' => $filter_model,
					'start'        => 0,
					'limit'        => $limit
			);

			$results = $this->model_catalog_stock->getStockEnabledProducts($data);
			
			foreach ($results as $result) {

				$json[] = array(
						'product_id' => $result['product_id'],
						'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
						'model'      => $result['model'],
						'price'      => $result['price']
				);
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}