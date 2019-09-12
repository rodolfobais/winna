<?php
/**
* 2018 Contabilium.com
*
* Modulo para la conexion de Opencart con Contabilium
*
*  @author    David Suarez <info@davidsuarez.com.ar>
*  @copyright Contabilium S.A.
*/
class ControllerExtensionModuleContabilium extends Controller {
	
	private $error = array();
	private $api_base = 'https://rest.contabilium.com/';

	public function install() {
		$code = "contabilium_order_history";
		$action = "extension/module/contabilium/sendorder";

		$v = explode('.', VERSION);

		if((int)$v[0]===3){
			$this->load->model('setting/event');
			$trigger = "controller/sale/order/history/after";
			$this->model_setting_event->addEvent($code, $trigger, $action);
			
			$code = "contabilium__order_addOrderHistory";
			$trigger = "catalog/model/checkout/order/addOrderHistory/after";
			$this->model_setting_event->addEvent($code, $trigger, $action);
		}

		if((int)$v[0]===2){
			$this->load->model('extension/event');
			$trigger = "controller/sale/order/history/after";
			$this->model_extension_event->addEvent($code, $trigger, $action);
			
			$code = "contabilium__order_addOrderHistory";
			$trigger = "catalog/model/checkout/order/addOrderHistory/after";
			$this->model_extension_event->addEvent($code, $trigger, $action);
		}

		/* CREAMOS EL CAMPO PARA EL DNI SI NO EXISTE*/
		$this->load->model('customer/custom_field');
		$this->load->model('localisation/language');

		$dni = $this->model_customer_custom_field->getCustomFields(["filter_name"=>"DNI"]);
		$ID = $this->model_customer_custom_field->getCustomFields(["filter_name"=>"ID"]);

		if(empty($dni) && empty($ID)){

			$this->load->model('customer/customer_group');

			$customLang = [];
			$langs  = $this->model_localisation_language->getLanguages();
			foreach ($langs as $lang){
				switch($lang["code"]){
					case "en-en":
					case "en-gb":
						$customLang[$lang["language_id"]]["name"] =  "ID";break;
					case "es-es":
					case "es-ar":
						$customLang[$lang["language_id"]]["name"] =  "DNI";break;
				}
			}

			$customgroups = $this->model_customer_customer_group->getCustomerGroups(['sort'=>'customer_group_id', 'limit'=>1]);

			$custongroup = [];

			foreach($customgroups as $cg){
				$custongroup[] = ["customer_group_id" => $cg["customer_group_id"], "required" => 1];
			}

			$Newfield = [
				'type'=>"text",
				'location'=>"account",
				'value'=>"",
				'validation'=>"",
				'status'=>"1",
				'sort_order'=>"0",
				'custom_field_description'=> $customLang,
				'custom_field_customer_group' => $custongroup
			];

			$this->log("DNI FIELD ID ".$this->model_customer_custom_field->addCustomField($Newfield));
		}

		/* CREAMOS EL ESTADO DE ERROR CONTABILIUM para las ordenes */
		$this->load->model('localisation/order_status');
		$orderStatus = $this->model_localisation_order_status->getOrderStatuses();
		$createStatus = true;
		foreach($orderStatus as $status){
			if($status["name"]==="Contabilium Error") { $createStatus = false; $contabiliumErrorStatus = $status["order_status_id"];  }
		}

		if($createStatus) {
			$this->load->model('localisation/language');
			$langs  = $this->model_localisation_language->getLanguages();
			$newStatus = [];
			foreach ($langs as $lang){
				$newStatus[$lang["language_id"]]["name"] =  "Contabilium Error";
			}

			$contabiliumErrorStatus = $this->model_localisation_order_status->addOrderStatus(["order_status"=>$newStatus]);
		}
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('module_contabilium', ['module_contabilium_error'=> $contabiliumErrorStatus]);

		///// VERIFICAMOS SI TIENE SKU por opcion
		$this->load->model('extension/module/contabilium');
		$this->model_setting_setting->editSetting('module_contabilium', ['module_contabilium_skuoption'=> $this->model_extension_module_contabilium->haveOptionSku()]);
		
		$this->log("Modulo Contabilium instalado");
	}
	
	public function uninstall() {

		$v = explode('.', VERSION);

		if((int)$v[0]===3){
			$this->load->model('setting/event');
			$this->model_setting_event->deleteEventByCode('contabilium_order_history'); 
			$this->model_setting_event->deleteEventByCode('contabilium_order_addOrderHistory'); 
			$this->model_setting_event->uninstall('module', 'module_contabilium');
		}

		if((int)$v[0]===2){
			$this->load->model('extension/event');
			$this->model_extension_event->deleteEvent('contabilium_order_history'); 
			$this->model_extension_event->deleteEvent('contabilium_order_addOrderHistory'); 
			$this->model_extension_event->uninstall('module', 'module_contabilium');
		}

		$this->log("Modulo Contabilium desinstalado");
	}
	
	public function index() {
	
		//Load language file
		$this->load->language('extension/module/contabilium');

		//Set title from language file
		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('view/javascript/contabilium/spin.min.js');
		$this->document->addScript('view/javascript/contabilium/ladda.min.js');
		$this->document->addScript('view/javascript/contabilium/ladda.jquery.min.js');
		$this->document->addScript('view/javascript/contabilium/contabilium.js');
		$this->document->addStyle('view/stylesheet/contabilium/contabilium.css');
		$this->document->addStyle('view/stylesheet/contabilium/ladda.min.css');
		
		//Load contabilium model
		$this->load->model('extension/module/contabilium');

		//Load settings model
		$this->load->model('setting/setting');

		if(isset($this->session->data['token'])){
			$token = 'token';
			$sessionToken = $this->session->data['token'];
			$market = 'extension/extension';
		}

		if(isset($this->session->data['user_token'])){
			$token = 'user_token';
			$sessionToken = $this->session->data['user_token'];
			$market = 'marketplace/extension';
		}
		
		//Save settings
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_contabilium', $this->request->post);	
						
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link($market, $token.'='.$sessionToken . '&type=module', true));
		}

		$this->load->model('localisation/order_status');

		$data['orderstatus'] = $this->model_localisation_order_status->getOrderStatuses();
		
		$text_strings = array(
				'heading_title',
				'button_save',
				'button_cancel',
				'button_add_module',
				'button_remove',
				'placeholder',
				'text_active',
				'text_active_description',
				'text_email',
				'text_apikey',
				'text_id',
				'text_prices',
				'text_stock',
				'text_on',
				'text_off',
				'text_order_accepted',
				'text_order_canceled',
				'text_callback',
				'text_update',
				'text_status',
				'text_log',
				'text_log_btn',
				'text_sinc',
				'text_modulo',
				'text_modulo_ok',
		);
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
		
		//error handling
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', $token.'='.$sessionToken, 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link($market, $token.'='.$sessionToken . '&type=module', 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/contabilium', $token.'='.$sessionToken, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('extension/module/contabilium', $token.'='.$sessionToken, 'SSL');
		
		$data['cancel'] = $this->url->link($market, $token.'='.$sessionToken . '&type=module', true);

		if (isset($this->request->post['module_contabilium_active'])) {
			$data['module_contabilium_active'] = $this->request->post['module_contabilium_active'];
			$data['module_contabilium_status'] = $this->request->post['module_contabilium_active'][0];
		} else {
			$data['module_contabilium_active'] = $this->config->get('module_contabilium_active');
			$active = $this->config->get('module_contabilium_active');
			$data['module_contabilium_status'] = $active[0];
		}

		if (isset($this->request->post['module_contabilium_email'])) {
			$data['module_contabilium_email'] = $this->request->post['module_contabilium_email'];
		} else {
			$data['module_contabilium_email'] = $this->config->get('module_contabilium_email');
		}

		if (isset($this->request->post['module_contabilium_apikey'])) {
			$data['module_contabilium_apikey'] = $this->request->post['module_contabilium_apikey'];
		} else {
			$data['module_contabilium_apikey'] = $this->config->get('module_contabilium_apikey');
		}

		if (isset($this->request->post['module_contabilium_id'])) {
			$data['module_contabilium_id'] = $this->request->post['module_contabilium_id'];
		} else {
			$data['module_contabilium_id'] = $this->config->get('module_contabilium_id');
		}

		if (isset($this->request->post['module_contabilium_prices'])) {
			$data['module_contabilium_prices'] = $this->request->post['module_contabilium_prices'];
		} else {
			$data['module_contabilium_prices'] = $this->config->get('module_contabilium_prices');
		}

		if (isset($this->request->post['module_contabilium_stock'])) {
			$data['module_contabilium_stock'] = $this->request->post['module_contabilium_stock'];
		} else {
			$data['module_contabilium_stock'] = $this->config->get('module_contabilium_stock');
		}

		if (isset($this->request->post['module_contabilium_accepted'])) {
			$data['module_contabilium_accepted'] = $this->request->post['module_contabilium_accepted'];
		} else {
			$data['module_contabilium_accepted'] = ($this->config->get('module_contabilium_accepted') ? $this->config->get('module_contabilium_accepted'): [] );
		}

		if (isset($this->request->post['module_contabilium_canceled'])) {
			$data['module_contabilium_canceled'] = $this->request->post['module_contabilium_canceled'];
		} else {
			$data['module_contabilium_canceled'] = ($this->config->get('module_contabilium_canceled') ? $this->config->get('module_contabilium_canceled'): [] );
		}
		
		if (isset($this->request->post['module_contabilium_token'])) {
			$data['module_contabilium_token'] = $this->request->post['module_contabilium_token'];
		} else if(empty($this->config->get('module_contabilium_token'))){
			$data['module_contabilium_token'] = $this->generateRandomString(25);
		} else {
			$data['module_contabilium_token'] = $this->config->get('module_contabilium_token');
		}

		if (isset($this->request->post['module_contabilium_error'])) {
			$data['module_contabilium_error'] = $this->request->post['module_contabilium_error'];
		} else {
			$data['module_contabilium_error'] = $this->config->get('module_contabilium_error');
		}

		if (isset($this->request->post['module_contabilium_skuoption'])) {
			$data['module_contabilium_skuoption'] = $this->request->post['module_contabilium_skuoption'];
		} else {
			$data['module_contabilium_skuoption'] = $this->model_extension_module_contabilium->haveOptionSku();
		}

		if (isset($this->error['contabilium_email'])) {
			$data['error_email'] = $this->error['contabilium_email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['contabilium_apikey'])) {
			$data['error_apikey'] = $this->error['contabilium_apikey'];
		} else {
			$data['error_apikey'] = '';
		}

		if (isset($this->error['contabilium_id'])) {
			$data['error_id'] = $this->error['contabilium_id'];
		} else {
			$data['error_id'] = '';
		}

		if (isset($this->error['contabilium_accepted'])) {
			$data['error_accepted'] = $this->error['contabilium_accepted'];
		} else {
			$data['error_accepted'] = '';
		}

		if (isset($this->error['contabilium_canceled'])) {
			$data['error_canceled'] = $this->error['contabilium_canceled'];
		} else {
			$data['error_canceled'] = '';
		}

		$data['contabilium_callback'] = HTTP_CATALOG . 'index.php?route=extension/module/contabilium&token=' . $data['module_contabilium_token'];
		$data['contabilium_update'] = $this->url->link('extension/module/contabilium/update	', $token.'='.$sessionToken. '&action=update', 'SSL');
		 
		$data['contabilium_log'] = $this->url->link('extension/module/contabilium/downloadlog', $token.'='.$sessionToken, 'SSL');

		
		if($this->connect()){
			$data['contabilium_online'] = "label-success";
			$data['online_text'] = $this->language->get('text_status_online');
			$data['contabilium_nosync'] = false;
		} else {
			$data['contabilium_online'] = "label-default";
			$data['online_text'] = $this->language->get('text_status_offline');
			$data['contabilium_nosync'] = true;
		}

		//Prepare for display
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->load->model('setting/store');
		$stores = $this->model_setting_store->getStores();

		$data['allstores'] = array();

		$data['allstores'][] = array(
			'name' => $this->config->get('config_name') . '<b>' . $this->language->get('text_default') . '</b>',
			'store_id' => 0,
		);

		foreach ($stores as $store) {
			$data['allstores'][] = array(
				'name' => $store['name'],
				'store_id' => $store['store_id'],
			);
		}

		//Send the output
		$this->response->setOutput($this->load->view('extension/module/contabilium', $data));
	}
	
	private function connect() {

		$this->load->library('contabilium');
		$obj_curl = Contabilium::get_instance($this->registry);

		$credentials = $obj_curl->token();

		return $credentials;
	}

	private function getAllProducts() {
		$this->load->library('contabilium');
		$obj_curl = Contabilium::get_instance($this->registry);

        $products = array();

        // me traigo la primer página
		$data = $obj_curl->get($this->api_base . 'api/conceptos/search?filtro=&page=1');
		
		if (isset($data->Message)) {
			throw new Exception($data->Message);
		}
		// guardo los productos
		$products = array_merge($products, $data->Items);

		$totalPages = (int)ceil($data->TotalItems / $data->TotalPage);

		// ahora hago lo mismo de antes pero para el resto de las páginas ($totalPages)
		for($p = 2; $p <= $totalPages; $p++) {
			$data = $obj_curl->get($this->api_base . 'api/conceptos/search?filtro=&page='.$p);
			if (isset($data->Message)) {
				throw new Exception($data->Message);
			}
			$products = array_merge($products, $data->Items);
		};

        return $products;
	}

	private function updateProduct($product_id, $price = null, $stock = null) {

		$this->load->model('extension/module/contabilium');

		$updatePrices = $this->config->get('module_contabilium_prices');
        $updateStock = $this->config->get('module_contabilium_stock');
		$update = false;

		if($updatePrices["0"] && $updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateProduct($product_id, $price, $stock);
		} else if($updatePrices["0"]) {
			$update = $this->model_extension_module_contabilium->updateProductPrice($product_id, $price);
		} else if($updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateProductStock($product_id, $stock);
		}
		
		return $update;
	}

	private function updateOptionProduct($product_option_id, $price = null, $stock = null) {

		$this->load->model('extension/module/contabilium');

		$updatePrices = $this->config->get('module_contabilium_prices');
        $updateStock = $this->config->get('module_contabilium_stock');
		$update = false;
		$prefix = "+";
		/* SI HA QUE SUMAR Y RESTAR AL PRECIO BASE.

		$productParentPrice = $this->model_extension_module_contabilium->getPriceParentProduct($product_option_id);
		
		if($productParentPrice>0){
			if($productParentPrice >= $price){
				$price = $productParentPrice - $price;
				$prefix = "+";
			} else {
				$price = $price - $productParentPrice;
				$prefix = "-";
			}
		}
		*/

		if($updatePrices["0"] && $updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateOptionProduct($product_option_id, $price, $stock, $prefix);
		} else if($updatePrices["0"]) {
			$update = $this->model_extension_module_contabilium->updateOptionProductPrice($product_option_id, $price, $prefix);
		} else if($updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateOptionProductStock($product_option_id, $stock);
		}
		
		return $update;
	}

	public function update() {
		$this->load->model('setting/setting');
		$this->load->model('extension/module/contabilium');
		$this->load->language('extension/module/contabilium');

		$error = false;
		$warning = false;
		$message = "";

		$active = $this->config->get('module_contabilium_active');

		if($active["0"]){
			$error = false;
			$message = "";
			$allProducts = $this->getAllProducts();
			$updatedProducts = [];

			foreach( $allProducts as $item) {
				if ($id_product = $this->model_extension_module_contabilium->existsSku($item->Codigo)) {
					if ($this->updateProduct($id_product, $item->Precio, $item->Stock)) { //round($item->Precio / (1 + $item->Iva / 100), 2)
						$updatedProducts[] = $id_product;
					}
				} else if($id_option_product = $this->model_extension_module_contabilium->existsOptionSku($item->Codigo)){
					if ($this->updateOptionProduct($id_option_product, $item->Precio, $item->Stock)) { //round($item->Precio / (1 + $item->Iva / 100), 2)
						$updatedProducts[] = $id_product;
					}
				}
			}

			if(count($allProducts)>0){
				if(count($updatedProducts)>0){
					$message = $this->language->get("text_update_ok");
				} else {
					$message = $this->language->get("text_update_error_noproduct");
					$error = true;
				}
			} else {
				$message = $this->language->get("text_update_error");
				$error = true;
			}
		} else {
			$message = $this->language->get("text_update_warning");
			$warning = true;
		}
		// text_update_ok
		// text_update_error

		echo json_encode(["error"=> $error, "warning"=> $warning, "message"=> $message]);
		die();
	}

	public function downloadlog() {
		header('Content-Type:text/plain');
		header('Content-Disposition: attachment; filename=contabilium'.date('YmdHi').'.txt');
		header('Pragma: no-cache');
		readfile(DIR_LOGS . "contabilium.log");
	}

	/*
	 * 
	 * Check that user actions are authorized
	 * 
	 */
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/contabilium')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['module_contabilium_email']) {
			$this->error['contabilium_email'] = $this->language->get('error_email');
		}

		if (!$this->request->post['module_contabilium_apikey']) {
			$this->error['contabilium_apikey'] = $this->language->get('error_apikey');
		}

		if (!$this->request->post['module_contabilium_id']) {
			$this->error['contabilium_id'] = $this->language->get('error_id');
		}

		if (!$this->request->post['module_contabilium_accepted']) {
			$this->error['contabilium_accepted'] = $this->language->get('error_accepted');
		}

		if (!$this->request->post['module_contabilium_canceled']) {
			$this->error['contabilium_canceled'] = $this->language->get('error_canceled');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	private function log($data="") {
		$log = new Log('contabilium.log');
		$log->write($data);
	}

	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
?>