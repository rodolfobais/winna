	<?php
	class ControllerExtensionModuleNoticeupmultistore extends Controller {

		public function index($product_info) {

			$language_array = $this->language->load('extension/module/noticeupmultistore');
			foreach ($language_array as $language_key => $language_value) {
			    $data[$language_key] = $language_value;
			}

			$data['heading_title'] = $this->language->get('heading_title');

			//Noticeup Multistore
			if( $this->config->get('noticeupmultistore', 'noticeupmultistore') ){
				$store_list = $this->config->get('noticeupmultistore', 'noticeupmultistore')['stores'];
				$store_list = implode(',',$store_list);

				$query = $this->db->query("SELECT m.store_id, (SELECT s.value from " . DB_PREFIX . "setting s where s.code = 'config' and s.`key` = 'config_name' and s.store_id = 0) as name,m.product_id,m.price,m.quantity,(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = m.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, '".HTTP_SERVER."' as url, (SELECT price FROM " . DB_PREFIX . "product_special_multistore ps WHERE ps.product_id = ".(int)$product_info['product_id']." AND ps.store_id = m.store_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) as special FROM " . DB_PREFIX . "product_to_multistore m WHERE product_id = ".(int)$product_info['product_id']." and store_id = 0 and store_id in (".$store_list.") AND store_id <> '".$this->config->get('config_store_id')."' UNION ALL SELECT s.store_id, s.name,m.product_id,m.price,m.quantity,(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = m.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status,s.url, (SELECT price FROM " . DB_PREFIX . "product_special_multistore ps WHERE ps.product_id = ".(int)$product_info['product_id']." AND ps.store_id = m.store_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) as special FROM " . DB_PREFIX . "store s JOIN " . DB_PREFIX . "product_to_multistore m on m.product_id = ".(int)$product_info['product_id']." and ( m.store_id = s.store_id ) and m.store_id in (".$store_list.")  AND m.store_id <> '".$this->config->get('config_store_id')."'");

				$query_address = $this->db->query("SELECT s.store_id, s.value as address from " . DB_PREFIX . "setting s where s.code = 'config' and s.`key` = 'config_address'");

				$stores = array();
				$stores = $query->rows;
				foreach ($query->rows as $result) {
					foreach ($query_address->rows as $address) {
						if($address['store_id'] == $result['store_id']){

							//config_customer_price and config_tax for all stores
							$config_customer_price = $this->db->query("SELECT s.`value` from " . DB_PREFIX . "setting s where s.code = 'config' and s.store_id = '".$result['store_id']."' and s.`key` = 'config_customer_price' ")->row['value'];
							//$config_tax = $this->db->query("SELECT s.`value` from " . DB_PREFIX . "setting s where s.code = 'config' and s.store_id = '".$result['store_id']."' and s.`key` = 'config_tax' ")->row['value'];

							if ($this->customer->isLogged() || !$config_customer_price) {
								//$price = $this->currency->format($this->tax->calculate($result['price'], $product_info['tax_class_id'], $config_tax), $this->session->data['currency']);
								$price = $this->currency->format($this->tax->calculate($result['price'], $product_info['tax_class_id'], 0), $this->session->data['currency']);
							} else {
								$price = false;
							}

							if ((float)$result['special']) {
								//$special = $this->currency->format($this->tax->calculate($result['special'], $product_info['tax_class_id'], $config_tax), $this->session->data['currency']);
								$special = $this->currency->format($this->tax->calculate($result['special'], $product_info['tax_class_id'], 0), $this->session->data['currency']);
							} else {
								$special = false;
							}

							$data['stores'][] = array(
								'store_id' => $result['store_id'],
								'name'     => $result['name'],
								'price'    => $price,
								'special'  => $special,
								'quantity' => $result['quantity'],
								'address'  => $address['address'],
								'url'  		 => $result['url'].substr( $_SERVER['REQUEST_URI'], 1),
								'stock_status' => $result['stock_status']
							);
						}
					}
				}

				return $this->load->view('extension/module/noticeupmultistore', $data);
			}else{
				return false;
			}
		}
	}
