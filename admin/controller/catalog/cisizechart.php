<?php
class ControllerCatalogCisizechart extends Controller {
	private $error = array();

	private $module_token = '';
	private $ci_token = '';

	public function __construct($registry) {
		parent :: __construct($registry);

		if(VERSION <= '2.3.0.2') {
			$this->module_token = 'token';
			$this->ci_token = $this->session->data['token'];
		} else {
			$this->module_token = 'user_token';
			$this->ci_token = $this->session->data['user_token'];
		}
	}

	public function index() {
		$this->load->language('catalog/cisizechart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/cisizechart');

		$this->model_catalog_cisizechart->Buildtable();

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/cisizechart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/cisizechart');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_cisizechart->addCiSizeChart($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/cisizechart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/cisizechart');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_cisizechart->editCiSizeChart($this->request->get['cisizechart_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/cisizechart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/cisizechart');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $cisizechart_id) {
				$this->model_catalog_cisizechart->deleteCiSizeChart($cisizechart_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'id.title';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

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
			'href' => $this->url->link('common/dashboard', $this->module_token .'=' . $this->ci_token, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url, true)
		);

		$data['add'] = $this->url->link('catalog/cisizechart/add', $this->module_token .'=' . $this->ci_token . $url, true);
		$data['delete'] = $this->url->link('catalog/cisizechart/delete', $this->module_token .'=' . $this->ci_token . $url, true);

		$data['cisizecharts'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$cisizechart_total = $this->model_catalog_cisizechart->getTotalCiSizeCharts();

		$results = $this->model_catalog_cisizechart->getCiSizeCharts($filter_data);

		foreach ($results as $result) {
			$data['cisizecharts'][] = array(
				'cisizechart_id' => $result['cisizechart_id'],
				'title'          => $result['title'],
				'status'     	 => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'           => $this->url->link('catalog/cisizechart/edit', $this->module_token .'=' . $this->ci_token . '&cisizechart_id=' . $result['cisizechart_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_title'] = $this->language->get('column_title');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_title'] = $this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . '&sort=id.title' . $url, true);
		$data['sort_status'] = $this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . '&sort=i.sort_status' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $cisizechart_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($cisizechart_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($cisizechart_total - $this->config->get('config_limit_admin'))) ? $cisizechart_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $cisizechart_total, ceil($cisizechart_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		if(VERSION <= '2.3.0.2') {
			$this->response->setOutput($this->load->view('catalog/cisizechart_list.tpl', $data));
		} else {
			$file_variable = 'template_engine';
			$file_type = 'template';
			$this->config->set($file_variable, $file_type);		
			$this->response->setOutput($this->load->view('catalog/cisizechart_list', $data));
		}
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['cisizechart_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_tab'] = $this->language->get('text_tab');
		$data['text_popup'] = $this->language->get('text_popup');
		$data['text_icon'] = $this->language->get('text_icon');
		$data['text_button'] = $this->language->get('text_button');

		$data['help_product'] = $this->language->get('help_product');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_button'] = $this->language->get('entry_button');
		$data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_display_layout'] = $this->language->get('entry_display_layout');
		$data['entry_popup_type'] = $this->language->get('entry_popup_type');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_tab_text'] = $this->language->get('entry_tab_text');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_lang'] = $this->language->get('tab_lang');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_link'] = $this->language->get('tab_link');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
		}

		if (isset($this->error['button'])) {
			$data['error_button'] = $this->error['button'];
		} else {
			$data['error_button'] = array();
		}

		if (isset($this->error['tab_text'])) {
			$data['error_tab_text'] = $this->error['tab_text'];
		} else {
			$data['error_tab_text'] = array();
		}


		$url = '';

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
			'href' => $this->url->link('common/dashboard', $this->module_token .'=' . $this->ci_token, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url, true)
		);

		if (!isset($this->request->get['cisizechart_id'])) {
			$data['action'] = $this->url->link('catalog/cisizechart/add', $this->module_token .'=' . $this->ci_token . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/cisizechart/edit', $this->module_token .'=' . $this->ci_token . '&cisizechart_id=' . $this->request->get['cisizechart_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/cisizechart', $this->module_token .'=' . $this->ci_token . $url, true);

		if (isset($this->request->get['cisizechart_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$cisizechart_info = $this->model_catalog_cisizechart->getCiSizeChart($this->request->get['cisizechart_id']);
		}

		$data['ci_token'] = $this->ci_token;
		$data['module_token'] = $this->module_token;

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['cisizechart_description'])) {
			$data['cisizechart_description'] = $this->request->post['cisizechart_description'];
		} elseif (isset($this->request->get['cisizechart_id'])) {
			$data['cisizechart_description'] = $this->model_catalog_cisizechart->getCiSizeChartDescriptions($this->request->get['cisizechart_id']);
		} else {
			$data['cisizechart_description'] = array();
		}

		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($cisizechart_info)) {
			$data['status'] = $cisizechart_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['display_layout'])) {
			$data['display_layout'] = $this->request->post['display_layout'];
		} elseif (!empty($cisizechart_info)) {
			$data['display_layout'] = $cisizechart_info['display_layout'];
		} else {
			$data['display_layout'] = 'popup';
		}

		if (isset($this->request->post['popup_type'])) {
			$data['popup_type'] = $this->request->post['popup_type'];
		} elseif (!empty($cisizechart_info)) {
			$data['popup_type'] = $cisizechart_info['popup_type'];
		} else {
			$data['popup_type'] = 'button';
		}

		if (isset($this->request->post['icon'])) {
			$data['icon'] = $this->request->post['icon'];
		} elseif (!empty($cisizechart_info)) {
			$data['icon'] = $cisizechart_info['icon'];
		} else {
			$data['icon'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['icon']) && is_file(DIR_IMAGE . $this->request->post['icon'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['icon'], 70, 70);
		} elseif (!empty($cisizechart_info) && is_file(DIR_IMAGE . $cisizechart_info['icon'])) {
			$data['thumb'] = $this->model_tool_image->resize($cisizechart_info['icon'], 70, 70);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 70, 70);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 70, 70);

		// Categories
		$this->load->model('catalog/product');
		if (isset($this->request->post['cisizechart_product'])) {
			$products = $this->request->post['cisizechart_product'];
		} elseif (isset($this->request->get['cisizechart_id'])) {
			$products = $this->model_catalog_cisizechart->getCiSizeChartProducts($this->request->get['cisizechart_id']);
		} else {
			$products = array();
		}


		$data['sizechart_products'] = array();
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			if ($product_info) {
				$data['sizechart_products'][] = array(
					'product_id' 	=> $product_info['product_id'],
					'name'        	=> $product_info['name'],
				);
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		if(VERSION <= '2.3.0.2') {
			$this->response->setOutput($this->load->view('catalog/cisizechart_form.tpl', $data));
		} else {
			$file_variable = 'template_engine';
			$file_type = 'template';
			$this->config->set($file_variable, $file_type);		
			$this->response->setOutput($this->load->view('catalog/cisizechart_form', $data));
		}
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/cisizechart')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['cisizechart_description'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			}

			if ((utf8_strlen($value['button']) < 1) || (utf8_strlen($value['button']) > 255)) {
				$this->error['button'][$language_id] = $this->language->get('error_button');
			}

			if ((utf8_strlen($value['tab_text']) < 1) || (utf8_strlen($value['tab_text']) > 255)) {
				$this->error['tab_text'][$language_id] = $this->language->get('error_tab_text');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/cisizechart')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}