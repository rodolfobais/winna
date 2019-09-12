<?php
class ControllerExtensionModuleNoticeupmultistore extends Controller {
	public function install() {
	    $this->load->model('extension/module/noticeupmultistore');
		$this->model_extension_module_noticeupmultistore->install();
	}
	public function uninstall(){
		$this->load->model('extension/module/noticeupmultistore');
		$this->model_extension_module_noticeupmultistore->uninstall();
	}

	private $error = array();

	public function index() {
		$this->load->language('extension/module/noticeupmultistore');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/product');

		$this->getList();
	}

	protected function getList() {
		$language_array = $this->load->language('extension/module/noticeupmultistore');

		foreach ($language_array as $language_key => $language_value) {
		    $data[$language_key] = $language_value;
		}

		//Укороченные get параметры
		$get_params = array('filter_name'=>null,'filter_category'=>null,'filter_model'=>null,'filter_price'=>null,'filter_quantity'=>null,'filter_status'=>null,'sort'=>'pd.name','order'=>'ASC','page'=>1);

		$url = '';

		foreach ($get_params as $key => $value) {
		    if (isset($this->request->get[$key])) {
		        $data[$key] = $this->request->get[$key];
						$$key = $this->request->get[$key];
						if('filter_name' == $key || 'filter_model' == $key || 'filter_category' == $key){
							$url .= '&'.$key.'=' . urlencode(html_entity_decode($this->request->get[$key], ENT_QUOTES, 'UTF-8'));
						}else{
							$url .= '&'.$key.'=' . $this->request->get[$key];
						}
		    } else {
		        $data[$key] = $value;
						$$key = $value;
		    }
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $data['filter_name'],
			'filter_category' => $data['filter_category'],
			'filter_model'	  => $data['filter_model'],
			'filter_price'	  => $data['filter_price'],
			'filter_quantity' => $data['filter_quantity'],
			'filter_status'   => $data['filter_status'],
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');
		$this->load->model('extension/module/noticeupmultistore');

		$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

		$results = $this->model_catalog_product->getProducts($filter_data);

		$this->load->model('catalog/category');

		$filter_data = array(
			'sort'        => 'name',
			'order'       => 'ASC'
		);

		$data['categories'] = $this->model_catalog_category->getCategories($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$multistores = $this->model_extension_module_noticeupmultistore->getStoresProduct($result);

			$stores = array();
			foreach($multistores as $multistore){

				$product_specials = $this->model_extension_module_noticeupmultistore->getProductSpecialsMultistore($result['product_id']);
				foreach ($product_specials  as $product_special) {
					if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
						if($multistore['store_id'] == $product_special['store_id']){
							$multistore['special'] = $product_special['price'];
							break;
						}
					}
				}

				$stores[] = $multistore;
			}

			$data['products'][] = array(
				'product_id' => $result['product_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'stores'	 => $stores,
				'model'      => $result['model'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('extension/module/noticeupmultistore/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
		}

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

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$data['action'] = $this->url->link('extension/module/noticeupmultistore/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['setting'] = $this->url->link('extension/module/noticeupmultistore/setting', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
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

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/noticeupmultistore', $data));
	}

	public function update() {
		$this->language->load('extension/module/noticeupmultistore');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');
		$this->load->model('setting/store');
		$this->load->model('extension/module/noticeupmultistore');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_extension_module_noticeupmultistore->updateProductMultistore($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$get_params = array('filter_name'=>null,'filter_category'=>null,'filter_model'=>null,'filter_price'=>null,'filter_quantity'=>null,'filter_status'=>null,'sort'=>'pd.name','order'=>'ASC','page'=>1,'product_id'=>null);

			//Ссылки
			$url = '';
			foreach ($get_params as $key => $value) {
			    if (isset($this->request->get[$key])) {
					if('filter_name' == $key || 'filter_model' == $key){
						$url .= '&'.$key.'=' . urlencode(html_entity_decode($this->request->get[$key], ENT_QUOTES, 'UTF-8'));
					}else{
						$url .= '&'.$key.'=' . $this->request->get[$key];
					}
			    }
			}

			$this->response->redirect($this->url->link('extension/module/noticeupmultistore/update', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	protected function getForm() {
		$language_array = $this->language->load('extension/module/noticeupmultistore_form');

		foreach ($language_array as $language_key => $language_value) {
		    $data[$language_key] = $language_value;
		}

		$this->load->model('setting/store');
		$this->load->model('extension/module/noticeupmultistore');

		$this->load->model('customer/customer_group');
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();


		$this->document->setTitle($this->language->get('heading_title'));

		$data['product'] = array();
		$data['product'] = $this->model_catalog_product->getProduct($this->request->get['product_id']);

		$data['multistores'] = $this->model_extension_module_noticeupmultistore->getStoresProduct($data['product']);



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

		//stores
		$this->load->model('setting/store');

		$data['stores'] = array();

		$data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->config->get('config_name'),
			'url'      => HTTP_CATALOG
		);

		$store_total = $this->model_setting_store->getTotalStores();

		$results = $this->model_setting_store->getStores();

		foreach ($results as $result) {
			$data['stores'][] = array(
				'store_id' => $result['store_id'],
				'name'     => $result['name'],
				'url'      => $result['url']
			);
		}

		// Options
		$this->load->model('catalog/option');
		$this->load->model('extension/module/noticeupmultistore');

		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_extension_module_noticeupmultistore->getProductOptionsMultistore($this->request->get['product_id']);
		} else {
			$product_options = array();
		}

		$data['product_options'] = array();

		foreach ($product_options as $product_option) {
			$product_option_value_data = array();

			if (isset($product_option['product_option_value'])) {
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'store_id'				        => $product_option_value['store_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']
					);
				}
			}

			$data['product_options'][] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => isset($product_option['value']) ? $product_option['value'] : '',
				'required'             => $product_option['required']
			);
		}

		$data['option_values'] = array();

		foreach ($data['product_options'] as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($data['option_values'][$product_option['option_id']])) {
					$data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}


		// Specials
		if (isset($this->request->post['product_special'])) {
			$data['product_specials'] = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_specials'] = $this->model_extension_module_noticeupmultistore->getProductSpecialsMultistore($this->request->get['product_id']);
		} else {
			$data['product_specials'] = array();
		}

		//Stock statuses
		$this->load->model('localisation/stock_status');
		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();


		$get_params = array('filter_name'=>null,'filter_category'=>null,'filter_model'=>null,'filter_price'=>null,'filter_quantity'=>null,'filter_status'=>null,'sort'=>'pd.name','order'=>'ASC','page'=>1,'product_id'=>null);

		//Ссылки
		$url = '';
		foreach ($get_params as $key => $value) {
			if (isset($this->request->get[$key])) {
				if('filter_name' == $key || 'filter_model' == $key || 'filter_category' == $key){
					$url .= '&'.$key.'=' . urlencode(html_entity_decode($this->request->get[$key], ENT_QUOTES, 'UTF-8'));
				}else{
					$url .= '&'.$key.'=' . $this->request->get[$key];
				}
			}
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $data['product']['name'],
			//'href'      => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$data['action'] = $this->url->link('extension/module/noticeupmultistore/update', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['cancel'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/noticeupmultistore_form.tpl', $data));
	}

	public function setting(){
		$language_array = $this->language->load('extension/module/noticeupmultistore_setting');
		foreach ($language_array as $language_key => $language_value) {
		    $data[$language_key] = $language_value;
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('noticeupmultistore', $this->request->post);
			//print_r($this->request->post['noticeupmultistore']['stores']);die();
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['noticeupmultistore'])) {
			$data['noticeupmultistore_store'] = $this->request->post['noticeupmultistore']['stores'];
		} elseif ( isset($this->model_setting_setting->getSetting('noticeupmultistore')['noticeupmultistore']['stores']) ){
			$data['noticeupmultistore_store'] = $this->model_setting_setting->getSetting('noticeupmultistore')['noticeupmultistore']['stores'];
		} else {
			$data['noticeupmultistore_store'] = array(0);
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => 'Setting',
			//'href'      => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$data['action'] = $this->url->link('extension/module/noticeupmultistore/setting', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module/noticeupmultistore', 'token=' . $this->session->data['token'], 'SSL');


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/noticeupmultistore_setting', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/noticeupmultistore')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
