<?php
class ControllerMpCheckoutShippingMethod extends Controller {
	public function __construct($registry) {
		parent::__construct($registry);
		require_once(DIR_SYSTEM .'library/mpcheckout/manager.php');
	}
	
	public function index() {
		$data = array();

		$this->content($data);
		
		if(VERSION < '2.2.0.0') {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mpcheckout/shipping_method.tpl')) {
		    	return $this->load->view($this->config->get('config_template') . '/template/mpcheckout/shipping_method.tpl', $data);
		   } else {
		   		return $this->load->view('default/template/mpcheckout/shipping_method.tpl', $data);
		   }
	  	} else{
		   return $this->load->view('mpcheckout/shipping_method', $data);
		}
	}
	
	public function ajax() {
		$data = array();

		// Add Shipping Address When Change Country Or Zone
		if ($this->customer->isLogged()) {
			if(!empty($this->request->post['same_address']) && isset($this->request->post['payment_address']['payment_address']) && $this->request->post['payment_address']['payment_address'] == 'existing') {
				$address_id = isset($this->request->post['payment_address']['address_id']) ? $this->request->post['payment_address']['address_id'] : '';
				
				$this->load->model('account/address');
				$this->session->data['shipping_address'] = $this->model_account_address->getAddress($address_id);
			} else if(empty($this->request->post['same_address']) && isset($this->request->post['shipping_address']['shipping_address']) && $this->request->post['shipping_address']['shipping_address'] == 'existing') {
				$address_id = isset($this->request->post['shipping_address']['address_id']) ? $this->request->post['shipping_address']['address_id'] : '';
				
				$this->load->model('account/address');
				$this->session->data['shipping_address'] = $this->model_account_address->getAddress($address_id);
			} else {
				if(isset($this->request->post['same_address']) && $this->request->post['same_address'] == '1') {
					$this->session->data['shipping_address']['country_id'] = isset($this->request->post['payment_address']['country_id']) ? $this->request->post['payment_address']['country_id'] : '';				
					$this->session->data['shipping_address']['zone_id'] = isset($this->request->post['payment_address']['zone_id']) ? $this->request->post['payment_address']['zone_id'] : '';

					$this->session->data['shipping_address']['firstname'] = isset($this->request->post['payment_address']['firstname']) ? $this->request->post['payment_address']['firstname'] : '';
					$this->session->data['shipping_address']['lastname'] = isset($this->request->post['payment_address']['lastname']) ? $this->request->post['payment_address']['lastname'] : '';
					$this->session->data['shipping_address']['company'] = isset($this->request->post['payment_address']['company']) ? $this->request->post['payment_address']['company'] : '';
					$this->session->data['shipping_address']['address_1'] = isset($this->request->post['payment_address']['address_1']) ? $this->request->post['payment_address']['address_1'] : '';
					$this->session->data['shipping_address']['address_2'] = isset($this->request->post['payment_address']['address_2']) ? $this->request->post['payment_address']['address_2'] : '';
					$this->session->data['shipping_address']['postcode'] = isset($this->request->post['payment_address']['postcode']) ? $this->request->post['payment_address']['postcode'] : '';
					$this->session->data['shipping_address']['city'] = isset($this->request->post['payment_address']['city']) ? $this->request->post['payment_address']['city'] : '';

					$this->load->model('localisation/country');
					$country_info = $this->model_localisation_country->getCountry($this->session->data['shipping_address']['country_id']);
					if ($country_info) {
						$this->session->data['shipping_address']['country'] = $country_info['name'];
						$this->session->data['shipping_address']['iso_code_2'] = $country_info['iso_code_2'];
						$this->session->data['shipping_address']['iso_code_3'] = $country_info['iso_code_3'];
						$this->session->data['shipping_address']['address_format'] = $country_info['address_format'];
					} else {
						$this->session->data['shipping_address']['country'] = '';
						$this->session->data['shipping_address']['iso_code_2'] = '';
						$this->session->data['shipping_address']['iso_code_3'] = '';
						$this->session->data['shipping_address']['address_format'] = '';
					}

					$this->load->model('localisation/zone');
					$zone_info = $this->model_localisation_zone->getZone($this->session->data['shipping_address']['zone_id']);
					if ($zone_info) {
						$this->session->data['shipping_address']['zone'] = $zone_info['name'];
						$this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
					} else {
						$this->session->data['shipping_address']['zone'] = '';
						$this->session->data['shipping_address']['zone_code'] = '';
					}

					if (isset($this->request->post['payment_address']['custom_field']['address'])) {
						$this->session->data['shipping_address']['custom_field'] = $this->request->post['payment_address']['custom_field']['address'];
					} else {
						$this->session->data['shipping_address']['custom_field'] = array();
					}
				} else {
					$this->session->data['shipping_address']['country_id'] = isset($this->request->post['shipping_address']['country_id']) ? $this->request->post['shipping_address']['country_id'] : '';				
					$this->session->data['shipping_address']['zone_id'] = isset($this->request->post['shipping_address']['zone_id']) ? $this->request->post['shipping_address']['zone_id'] : '';

					$this->session->data['shipping_address']['firstname'] = isset($this->request->post['shipping_address']['firstname']) ? $this->request->post['shipping_address']['firstname'] : '';
					$this->session->data['shipping_address']['lastname'] = isset($this->request->post['shipping_address']['lastname']) ? $this->request->post['shipping_address']['lastname'] : '';
					$this->session->data['shipping_address']['company'] = isset($this->request->post['shipping_address']['company']) ? $this->request->post['shipping_address']['company'] : '';
					$this->session->data['shipping_address']['address_1'] = isset($this->request->post['shipping_address']['address_1']) ? $this->request->post['shipping_address']['address_1'] : '';
					$this->session->data['shipping_address']['address_2'] = isset($this->request->post['shipping_address']['address_2']) ? $this->request->post['shipping_address']['address_2'] : '';
					$this->session->data['shipping_address']['postcode'] = isset($this->request->post['shipping_address']['postcode']) ? $this->request->post['shipping_address']['postcode'] : '';
					$this->session->data['shipping_address']['city'] = isset($this->request->post['shipping_address']['city']) ? $this->request->post['shipping_address']['city'] : '';

					$this->load->model('localisation/country');
					$country_info = $this->model_localisation_country->getCountry($this->session->data['shipping_address']['country_id']);
					if ($country_info) {
						$this->session->data['shipping_address']['country'] = $country_info['name'];
						$this->session->data['shipping_address']['iso_code_2'] = $country_info['iso_code_2'];
						$this->session->data['shipping_address']['iso_code_3'] = $country_info['iso_code_3'];
						$this->session->data['shipping_address']['address_format'] = $country_info['address_format'];
					} else {
						$this->session->data['shipping_address']['country'] = '';
						$this->session->data['shipping_address']['iso_code_2'] = '';
						$this->session->data['shipping_address']['iso_code_3'] = '';
						$this->session->data['shipping_address']['address_format'] = '';
					}

					$this->load->model('localisation/zone');
					$zone_info = $this->model_localisation_zone->getZone($this->session->data['shipping_address']['zone_id']);
					if ($zone_info) {
						$this->session->data['shipping_address']['zone'] = $zone_info['name'];
						$this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
					} else {
						$this->session->data['shipping_address']['zone'] = '';
						$this->session->data['shipping_address']['zone_code'] = '';
					}

					if (isset($this->request->post['shipping_address']['custom_field']['address'])) {
						$this->session->data['shipping_address']['custom_field'] = $this->request->post['shipping_address']['custom_field']['address'];
					} else {
						$this->session->data['shipping_address']['custom_field'] = array();
					}
				}
			}
		} else{
			if(isset($this->request->post['same_address']) && $this->request->post['same_address'] == '1') {		
				$this->session->data['shipping_address']['country_id'] = isset($this->request->post['signup']['country_id']) ? $this->request->post['signup']['country_id'] : '';
				$this->session->data['shipping_address']['zone_id'] = isset($this->request->post['signup']['zone_id']) ? $this->request->post['signup']['zone_id'] : '';
				$this->session->data['shipping_address']['firstname'] = isset($this->request->post['signup']['firstname']) ? $this->request->post['signup']['firstname'] : '';
				$this->session->data['shipping_address']['lastname'] = isset($this->request->post['signup']['lastname']) ? $this->request->post['signup']['lastname'] : '';
				$this->session->data['shipping_address']['company'] = isset($this->request->post['signup']['company']) ? $this->request->post['signup']['company'] : '';
				$this->session->data['shipping_address']['address_1'] = isset($this->request->post['signup']['address_1']) ? $this->request->post['signup']['address_1'] : '';
				$this->session->data['shipping_address']['address_2'] = isset($this->request->post['signup']['address_2']) ? $this->request->post['signup']['address_2'] : '';
				$this->session->data['shipping_address']['postcode'] = isset($this->request->post['signup']['postcode']) ? $this->request->post['signup']['postcode'] : '';
				$this->session->data['shipping_address']['city'] = isset($this->request->post['signup']['city']) ? $this->request->post['signup']['city'] : '';

				$this->load->model('localisation/country');
				$country_info = $this->model_localisation_country->getCountry($this->session->data['shipping_address']['country_id']);
				if ($country_info) {
					$this->session->data['shipping_address']['country'] = $country_info['name'];
					$this->session->data['shipping_address']['iso_code_2'] = $country_info['iso_code_2'];
					$this->session->data['shipping_address']['iso_code_3'] = $country_info['iso_code_3'];
					$this->session->data['shipping_address']['address_format'] = $country_info['address_format'];
				} else {
					$this->session->data['shipping_address']['country'] = '';
					$this->session->data['shipping_address']['iso_code_2'] = '';
					$this->session->data['shipping_address']['iso_code_3'] = '';
					$this->session->data['shipping_address']['address_format'] = '';
				}

				$this->load->model('localisation/zone');
				$zone_info = $this->model_localisation_zone->getZone($this->session->data['shipping_address']['zone_id']);
				if ($zone_info) {
					$this->session->data['shipping_address']['zone'] = $zone_info['name'];
					$this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
				} else {
					$this->session->data['shipping_address']['zone'] = '';
					$this->session->data['shipping_address']['zone_code'] = '';
				}

				if (isset($this->request->post['signup']['custom_field']['address'])) {
					$this->session->data['shipping_address']['custom_field'] = $this->request->post['signup']['custom_field']['address'];
				} else {
					$this->session->data['shipping_address']['custom_field'] = array();
				}
			} else{
				$this->session->data['shipping_address']['country_id'] = isset($this->request->post['shipping_address']['country_id']) ? $this->request->post['shipping_address']['country_id'] : '';
				$this->session->data['shipping_address']['zone_id'] = isset($this->request->post['shipping_address']['zone_id']) ? $this->request->post['shipping_address']['zone_id'] : '';

				$this->session->data['shipping_address']['firstname'] = isset($this->request->post['shipping_address']['firstname']) ? $this->request->post['shipping_address']['firstname'] : '';
				$this->session->data['shipping_address']['lastname'] = isset($this->request->post['shipping_address']['lastname']) ? $this->request->post['shipping_address']['lastname'] : '';
				$this->session->data['shipping_address']['company'] = isset($this->request->post['shipping_address']['company']) ? $this->request->post['shipping_address']['company'] : '';
				$this->session->data['shipping_address']['address_1'] = isset($this->request->post['shipping_address']['address_1']) ? $this->request->post['shipping_address']['address_1'] : '';
				$this->session->data['shipping_address']['address_2'] = isset($this->request->post['shipping_address']['address_2']) ? $this->request->post['shipping_address']['address_2'] : '';
				$this->session->data['shipping_address']['postcode'] = isset($this->request->post['shipping_address']['postcode']) ? $this->request->post['shipping_address']['postcode'] : '';
				$this->session->data['shipping_address']['city'] = isset($this->request->post['shipping_address']['city']) ? $this->request->post['shipping_address']['city'] : '';

				$this->load->model('localisation/country');
				$country_info = $this->model_localisation_country->getCountry($this->session->data['shipping_address']['country_id']);
				if ($country_info) {
					$this->session->data['shipping_address']['country'] = $country_info['name'];
					$this->session->data['shipping_address']['iso_code_2'] = $country_info['iso_code_2'];
					$this->session->data['shipping_address']['iso_code_3'] = $country_info['iso_code_3'];
					$this->session->data['shipping_address']['address_format'] = $country_info['address_format'];
				} else {
					$this->session->data['shipping_address']['country'] = '';
					$this->session->data['shipping_address']['iso_code_2'] = '';
					$this->session->data['shipping_address']['iso_code_3'] = '';
					$this->session->data['shipping_address']['address_format'] = '';
				}

				$this->load->model('localisation/zone');
				$zone_info = $this->model_localisation_zone->getZone($this->session->data['shipping_address']['zone_id']);
				if ($zone_info) {
					$this->session->data['shipping_address']['zone'] = $zone_info['name'];
					$this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
				} else {
					$this->session->data['shipping_address']['zone'] = '';
					$this->session->data['shipping_address']['zone_code'] = '';
				}

				if (isset($this->request->post['shipping_address']['custom_field']['address'])) {
					$this->session->data['shipping_address']['custom_field'] = $this->request->post['shipping_address']['custom_field']['address'];
				} else {
					$this->session->data['shipping_address']['custom_field'] = array();
				}
			}
		}
		
		$this->content($data);
		
		if(VERSION < '2.2.0.0') {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mpcheckout/shipping_method.tpl')) {
		    	$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/mpcheckout/shipping_method.tpl', $data));
		   } else {
		   		$this->response->setOutput($this->load->view('default/template/mpcheckout/shipping_method.tpl', $data));
		   }
	  	} else{
		   $this->response->setOutput($this->load->view('mpcheckout/shipping_method', $data));
		}
	}

	protected function content(&$data) {
		$this->load->language('mpcheckout/checkout');

		$mpcheckout_shipping_method_description = $this->config->get('mpcheckout_shipping_method_description');
		if(!empty($mpcheckout_shipping_method_description[$this->config->get('config_language_id')]['title'])) {
			 $this->language->setmpcheckoutlanguage('panel_shipping_method', $mpcheckout_shipping_method_description[$this->config->get('config_language_id')]['title']);
		}

		if(!empty($mpcheckout_shipping_method_description[$this->config->get('config_language_id')]['method_not_required'])) {
			 $this->language->setmpcheckoutlanguage('text_norequire_smethod', $mpcheckout_shipping_method_description[$this->config->get('config_language_id')]['method_not_required']);
		}
		
		if (isset($this->session->data['shipping_address'])) {
			// Shipping Methods
			$method_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('shipping');

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					if( VERSION > '2.2.0.0')  {
						$this->load->model('extension/shipping/' . $result['code']);
						$quote = $this->{'model_extension_shipping_' . $result['code']}->getQuote($this->session->data['shipping_address']);
					} else{
						$this->load->model('shipping/' . $result['code']);
						$quote = $this->{'model_shipping_' . $result['code']}->getQuote($this->session->data['shipping_address']);
					}

					if ($quote) {						
						$method_data[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error']
						);
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			$this->session->data['shipping_methods'] = $method_data;
		}

		$data['panel_shipping_method'] = $this->language->get('panel_shipping_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_comments'] = $this->language->get('text_comments');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_norequire_smethod'] = $this->language->get('text_norequire_smethod');

		$data['button_continue'] = $this->language->get('button_continue');

		if (empty($this->session->data['shipping_methods'])) {
			$data['error_warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact', '', Mpcheckout\Manager::mpssl()));
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['shipping_methods'])) {
			$data['shipping_methods'] = $this->session->data['shipping_methods'];
		} else {
			$data['shipping_methods'] = array();
		}

		if (isset($this->session->data['shipping_method']['code'])) {
			$data['code'] = $this->session->data['shipping_method']['code'];
		} else {
			$data['code'] = '';
		}

		$data['shipping_required'] = $this->cart->hasShipping();

		$data['mpcheckout_shipping_method_tables'] = array();
		$this->load->model('tool/image');
		$mpcheckout_shipping_method_tables = (array)$this->config->get('mpcheckout_shipping_method_table');
		if($mpcheckout_shipping_method_tables) {
			foreach ($mpcheckout_shipping_method_tables as $key => $mpcheckout_shipping_method_table) {
				if (!empty($mpcheckout_shipping_method_table['image']) && is_file(DIR_IMAGE . $mpcheckout_shipping_method_table['image'])) {
					$thumb = $this->model_tool_image->resize($mpcheckout_shipping_method_table['image'], 40, 40);
				} else {
					$thumb = '';
				}

				$data['mpcheckout_shipping_method_tables'][$key] = array(
					'thumb'			=> $thumb,
				);
			}
		}
	}

	public function save() {
		$this->load->language('mpcheckout/checkout');

		$json = array();

		if ($this->cart->hasShipping()) {
			if (!isset($this->request->post['shipping_method'])) {
				$json['error']['warning'] = $this->language->get('error_shipping');
			} else {
				$shipping = explode('.', $this->request->post['shipping_method']);

				if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
					$json['error']['warning'] = $this->language->get('error_shipping');
				}
			}

			if (!$json) {
				$this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];

				$json['success'] = true;
			}
		}

		if(isset($json['error'])) {
			unset($this->session->data['shipping_method']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}