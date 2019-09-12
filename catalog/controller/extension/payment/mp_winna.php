<?php

require_once "lib/mercadopago.php";
require_once "lib/mp_util.php";

class ControllerExtensionPaymentMPWinna extends Controller {

	private $error;
	public $sucess = true;
	private $order_info;
	private $message;
	private static $mp_util;
	private static $mp;

	function get_instance_mp_util() {
		if ($this->mp_util == null) 
			$this->mp_util = new MPOpencartUtil();

		return $this->mp_util;
	}

	function get_instance_mp() {
		if ($this->mp == null) {
			$client_id = $this->config->get('mp_winna_client_id');
			$client_secret = $this->config->get('mp_winna_client_secret');
			$this->mp = new MP($client_id, $client_secret);
		}
		return $this->mp;
	}

	public function index() {

		$data['customer_email'] = $this->customer->getEmail();
		$data['button_confirm'] = $this->language->get('button_confirm');
		$data['button_back'] = $this->language->get('button_back');
		$data['terms'] = 'Teste de termos';
		$data['public_key'] = $this->config->get('mp_winna_public_key');

		if ($this->config->get('mp_winna_country')) {
			$data['action'] = $this->config->get('mp_winna_country');
		}

		$this->load->model('checkout/order');

		$this->language->load('extension/payment/mp_winna');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		//Cambio el código ISO-3 de la moneda por el que se les ocurrio poner a los de mp_winna!!!
		$accepted_currencies = array('ARS' => 'ARS', 'ARG' => 'ARS', 'VEF' => 'VEF',
			'BRA' => 'BRL', 'BRL' => 'BRL', 'REA' => 'BRL', 'MXN' => 'MEX',
			'CLP' => 'CHI', 'COP' => 'COP', 'PEN' => 'PEN', 'US' => 'US', 'USD' => 'USD', 'UYU' => 'UYU');

		$currency = $accepted_currencies[$order_info['currency_code']];
		$currencies = array('ARS', 'BRL', 'MEX', 'CHI', 'PEN', 'VEF', 'COP', 'UYU');
		if (!in_array($currency, $currencies)) {
			$currency = '';
			$data['error'] = $this->language->get('currency_no_support');
		}

		$totalprice = $order_info['total'] * $order_info['currency_value'];
		$products = '';
		$all_products = $this->cart->getProducts();
		$items = array();

		foreach ($all_products as $product) {
			$product_price = round($product['price'] * $order_info['currency_value'], 2);
			if($this->config->get('mp_winna_country') == 'MCO'){
				$product_price = $this->currency->format($product['price'], $order_info['currency_code'], false, false);
			}

			$products .= $product['quantity'] . ' x ' . $product['name'] . ', ';
			$items[] = array(
				"id" => $product['product_id'],
				"title" => $product['name'],
				"description" => $product['quantity'] . ' x ' . $product['name'], // string
				"quantity" => intval($product['quantity']),
				"unit_price" => $product_price,
				//"unit_price" => round(floatval($product['price']) * $order_info['currency_code'], 2), //decimal
				"currency_id" => $currency,
				"picture_url" => HTTP_SERVER . 'image/' . $product['image'],
				"category_id" => $this->config->get('mp_winna_category_id'),
			);
		}

		$total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);

		if ($total > 0) {
			$items[] = array(
				"id" => 99,
				"title" => '',
				"description" => $this->language->get('text_total'),
				"quantity" => 1,
				"unit_price" => $total,
				"currency_id" => $currency,
				"category_id" => $this->config->get('mp_winna_category_id')
			);
		}

		$this->id = 'payment';

		$data['server'] = $_SERVER;
		$data['debug'] = 1;

		$client_id = $this->config->get('mp_winna_client_id');
		$client_secret = $this->config->get('mp_winna_client_secret');
		$url = $order_info['store_url'];
		$installments = (int) $this->config->get('mp_winna_installments');

		$cust = $this->db->query("SELECT * FROM `" .
			DB_PREFIX . "customer` WHERE customer_id = " .
			$order_info['customer_id'] . " ");
		$date_created = "";
		$date_creation_user = "";

		if ($cust->num_rows > 0):
			foreach ($cust->rows as $customer):
				$date_created = $customer['date_added'];
			endforeach;
			$date_creation_user = date('Y-m-d', strtotime($date_created)) . "T" . date('H:i:s', strtotime($date_created));
		endif;

		$payer = array(
			"name" => $order_info['payment_firstname'],
			"surname" => $order_info['payment_lastname'],
			"email" => $order_info['email'],
			"date_created" => $date_creation_user,
			"phone" => array(
				"area_code" => "-",
				"number" => $order_info['telephone'],
			),
			"address" => array(
				"zip_code" => $order_info['payment_postcode'],
				"street_name" => $order_info['payment_address_1'] . " - " .
				$order_info['payment_address_2'] . " - " .
				$order_info['payment_city'] . " - " .
				$order_info['payment_zone'] . " - " .
				$order_info['payment_country'],
				"street_number" => "-",
			),
			"identification" => array(
				"number" => "null",
				"type" => "null",
			),
		);

		$exclude = $this->config->get('mp_winna_methods');
		$country_id = $this->config->get('mp_winna_country') == null ? 'MLA' : $this->config->get('mp_winna_country');

		$installments = (int) $installments;
		if ($exclude != '') {

			$accepted_methods = preg_split("/[\s,]+/", $exclude);
			$all_payment_methods = $this->get_instance_mp()->getPaymentMethods($country_id);
			$excluded_payments = array();
			foreach ($all_payment_methods as $method) {
				if (!in_array($method['id'], $accepted_methods) && $method['id'] != 'account_money') {
					$excluded_payments[] = array('id' => $method['id']);
				}
			}

			$payment_methods = array(
				"installments" => $installments,
				"excluded_payment_methods" => $excluded_payments,
			);
		} else {
			$payment_methods = array("installments" => $installments);
		}

		$back_urls = array(
			"pending" => $url . 'index.php?route=extension/payment/mp_winna/callback',
			"success" => $url . 'index.php?route=extension/payment/mp_winna/callback',
			"failure" => $url . 'index.php?route=extension/payment/mp_winna/callback',
		);

		$pref = array();
		$pref['external_reference'] = $order_info['order_id'];
		$pref['items'] = $items;

		$pref['auto_return'] = $this->config->get('mp_winna_enable_return');
		$pref['back_urls'] = $back_urls;
		$pref['payment_methods'] = $payment_methods;
		$pref['payer'] = $payer;

	    if (!strrpos($url, 'localhost')) {
	    	$pref['notification_url'] = $url . 'index.php?route=extension/payment/mp_winna/notifications';
	    }
		$sandbox = (bool) $this->config->get('mp_winna_sandbox');
		$is_test_user = strpos($order_info['email'], '@testuser.com');

		if (!$is_test_user) {
			$pref["sponsor_id"] = $this->get_instance_mp_util()->sponsors[$this->config->get('mp_winna_country')];
		}

		$preferenceResult = $this->get_instance_mp()->create_preference($pref);

		if ($preferenceResult['status'] == 201):
			$data['type_checkout'] = $this->config->get('mp_winna_type_checkout');
			if ($sandbox):
				$data['redirect_link'] = $preferenceResult['response']['sandbox_init_point'];
			else:
				$data['redirect_link'] = $preferenceResult['response']['init_point'];
			endif;
		else:
			$data['error'] = "Error: " . $preferenceResult['status'];
		endif;
		$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('order_status_id_pending'), date('d/m/Y h:i'));
		$view = floatval(VERSION) < 2.2 ? 'default/template/extension/payment/mp_winna.tpl' : 'extension/payment/mp_winna.tpl';

		$data['analytics'] = $this->setPreModuleAnalytics();

		return $this->load->view($view, $data);
	}

	public function callback() {
		if ($this->request->get['collection_status'] == "null") {
			$this->response->redirect($this->url->link('checkout/checkout'));
		} elseif (isset($this->request->get['preference_id'])) {
			$order_id = $this->request->get['collection_id'];

			$this->load->model('checkout/order');
			$order = $this->model_checkout_order->getOrder($order_id);
			$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mercadopago_order_status_id'), date('d/m/Y h:i'));
			$dados = $this->updateOrder();

			$data['footer'] = array();
			$data['continue'] = $this->url->link('checkout/success');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$data['token']  = $this->config->get('mp_winna_client_id');
			$data['paymentId']  =  $dados['response']['id'];
			$data['paymentType']  =  $dados['response']['payment_type_id'];
			$data['checkoutType']  = "winna";

			$this->response->setOutput($this->load->view('extension/payment/mp_winna_success', $data));
		}
	}

	public function notifications() {
		if (isset($this->request->get['topic'])) {
			$this->request->get['collection_id'] = $this->request->get['id'];
			$this->updateOrder();
			echo json_encode(200);
		}
	}

	private function updateOrder() {
		$sandbox = $this->config->get('mp_winna_sandbox') == 1 ? true : null;
		$ids = explode(',', $this->request->get['collection_id']);
		$payment_return;
		$this->get_instance_mp()->sandbox_mode($sandbox);	
		$this->load->model('checkout/order');

		foreach ($ids as $id) {
			$payment = $this->get_instance_mp()->getPayment($id);
			$payment["pay_type_mp"] = "winna";
			$this->get_instance_mp_util()->updateOrder($payment, $this->model_checkout_order, $this->config, $this->db);	
			$payment_return = $payment;
		}
		return $payment_return;
	}

	private function setPreModuleAnalytics() {

		$query = $this->db->query("SELECT code FROM " . DB_PREFIX . "extension WHERE type = 'payment'");

        $resultModules = array();
		$token = $this->config->get('mp_winna_client_id');
		$customerEmail = $this->customer->getEmail();
		$userLogged = $this->customer->isLogged() ? 1 : 0;

		foreach ($query->rows as $result) {
			array_push($resultModules, $result['code']);
		}

		return $this->get_instance_mp_util()->createAnalytics($resultModules, $token, $customerEmail, $userLogged); 
    }
}
