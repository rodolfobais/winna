<?php
class ControllerExtensionModulePaymentShippingStore extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/payment_shipping_store');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('setting/setting');
		
		if(isset($this->request->get['store_id'])) {
			$data['store_id'] = $this->request->get['store_id'];
		}else{
			$data['store_id']	= 0;
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_payment_shipping_store', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			if($this->request->post['stay']==1){
				$this->response->redirect($this->url->link('extension/module/payment_shipping_store', '&store_id='.$data['store_id'].'&token=' . $this->session->data['token'] , true));
			}else{
				$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
			}
		}

		$data['heading_title'] = strip_tags($this->language->get('heading_title'));

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_payment'] = $this->language->get('tab_payment');
		$data['tab_shipping'] = $this->language->get('tab_shipping');
		$data['tab_support'] = $this->language->get('tab_support');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => strip_tags($this->language->get('heading_title')),
			'href' => $this->url->link('extension/module/payment_shipping_store', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/payment_shipping_store', 'token=' . $this->session->data['token'], true);
		

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		$store_info = $this->model_setting_setting->getSetting('module_payment_shipping_store', $data['store_id']);

		if (isset($this->request->post['module_payment_shipping_store_status'])) {
			$data['module_payment_shipping_store_status'] = $this->request->post['module_payment_shipping_store_status'];
		}elseif(isset($store_info['module_payment_shipping_store_status'])){
		    $data['module_payment_shipping_store_status'] = $store_info['module_payment_shipping_store_status'];
		} else {
			$data['module_payment_shipping_store_status'] = $this->config->get('module_payment_shipping_store_status');
		}
		
		if (isset($this->request->post['module_payment_shipping_store_payment_status'])) {
			$data['module_payment_shipping_store_payment_status'] = $this->request->post['module_payment_shipping_store_payment_status'];
		}elseif(isset($store_info['module_payment_shipping_store_payment_status'])){
		    $data['module_payment_shipping_store_payment_status'] = $store_info['module_payment_shipping_store_payment_status'];
		} else {
			$data['module_payment_shipping_store_payment_status'] = $this->config->get('module_payment_shipping_store_payment_status');
		}
		
		if (isset($this->request->post['module_payment_shipping_store_shipping_status'])) {
			$data['module_payment_shipping_store_shipping_status'] = $this->request->post['module_payment_shipping_store_shipping_status'];
		}elseif(isset($store_info['module_payment_shipping_store_shipping_status'])){
		    $data['module_payment_shipping_store_shipping_status'] = $store_info['module_payment_shipping_store_shipping_status'];
		} else {
			$data['module_payment_shipping_store_shipping_status'] = $this->config->get('module_payment_shipping_store_shipping_status');
		}
		
		if (isset($this->request->post['module_payment_shipping_store_payments_array'])) {
			$data['module_payment_shipping_store_payments_array'] = $this->request->post['module_payment_shipping_store_payments_array'];
		}elseif(isset($store_info['module_payment_shipping_store_payments_array'])){
		    $data['module_payment_shipping_store_payments_array'] = $store_info['module_payment_shipping_store_payments_array'];
		} else {
			$data['module_payment_shipping_store_payments_array'] = array();
		}
		
		if (isset($this->request->post['module_payment_shipping_store_shippings_array'])) {
			$data['module_payment_shipping_store_shippings_array'] = $this->request->post['module_payment_shipping_store_shippings_array'];
		}elseif(isset($store_info['module_payment_shipping_store_shippings_array'])){
		    $data['module_payment_shipping_store_shippings_array'] = $store_info['module_payment_shipping_store_shippings_array'];
		} else {
			$data['module_payment_shipping_store_shippings_array'] = array();
		}
		
		
		$this->load->model('setting/store');
		$stores = $this->model_setting_store->getStores();
		
		$data['allstores']=array();
		
		$data['allstores'][]=array(
		  'name' => $this->config->get('config_name').'<b>'.$this->language->get('text_default').'</b>',
		  'store_id' => 0,
		);
		
		foreach($stores as $store){
			$data['allstores'][]=array(
			  'name' => $store['name'],
			  'store_id' => $store['store_id'],
			);
		}
		
		
		$this->load->model('extension/extension');
		$data['shippings'] = array();
		$shippings = $this->model_extension_extension->getInstalled('shipping');
		foreach($shippings as $shipping):
			if($this->config->get($shipping . '_status')):
				$this->load->language('extension/shipping/' . $shipping);
				$data['shippings'][] = array(
					'name'       => $this->language->get('heading_title'),
					'code'		=> $shipping,
				);
			endif;
		endforeach;
		
		$this->load->model('extension/extension');
		$data['payments'] = array();
		$payments = $this->model_extension_extension->getInstalled('payment');
		foreach($payments as $payment):
			if($this->config->get($payment . '_status')):
				$this->load->language('extension/payment/' . $payment);
				$data['payments'][] = array(
					'name'       => $this->language->get('heading_title'),
					'code'		=> $payment,
				);
			endif;
		endforeach;
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/payment_shipping_store', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/payment_shipping_store')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}