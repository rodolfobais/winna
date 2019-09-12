<?php

define('STOCK_MODULE_ROUTE', 'extension/module/stock');
define('MODULES_ROUTE', 'extension/extension&type=module');

define('OCMOD_CODE', 'open4dev_stock_module');
define('REQUIRED_VQMOD_CODE', '2.6.1');

class ControllerExtensionModuleStock extends Controller {
	private $error = array(); 
	
	protected function writeCssFile($cssFile, $adata) {
		$change_product_color = isset($adata['stock_module_change_product_css']) && $adata['stock_module_change_product_css'];
		$change_combination_color = isset($adata['stock_module_update_stock_display']) && $adata['stock_module_update_stock_display'];
		if ($change_product_color || $change_combination_color) {
			$css = "" ;
			if (isset($adata['stock_module_product_color_instock'])) {
				$css .= ".sm-product-instock { color: #" . $adata['stock_module_product_color_instock'] . "; }\n";
			}
			if (isset($adata['stock_module_product_color_outofstock'])) {
				$css .= ".sm-product-outofstock { color: #" . $adata['stock_module_product_color_outofstock'] . "; }\n";
			}
			if (isset($adata['stock_module_combination_color_instock'])) {
				$css .= ".sm-comb-instock { color: #" . $adata['stock_module_combination_color_instock'] . "; }\n";
			}
			if (isset($adata['stock_module_combination_color_outofstock'])) {
				$css .= ".sm-comb-outofstock { color: #" . $adata['stock_module_combination_color_outofstock'] . "; }\n" ;
			}
			$handle = fopen($cssFile, "w");
			fwrite($handle, $css);
			fclose($handle);
		}
	}
	
	protected function setFieldValue(&$data, $field_name, $default_value = 0) {
		if (isset($this->request->post[$field_name])) {
			$data[$field_name] = $this->request->post[$field_name];
		} elseif (!is_null($this->config->get($field_name))) { 
			$data[$field_name] = $this->config->get($field_name);
		}	else {
			$data[$field_name] = $default_value;
		}
	}

	protected function slink($url, $token = true, $secure = true) {
		$arg = '';
		if ( $token ) {
			$arg = 'token=' . $this->session->data['token']; 
		}
		return $this->url->link($url, $arg, $secure);
	}
	
	protected function createBreadcrumb($texts = array()) {
		$breadcrumb = array();
		
		foreach($texts as $text => $link) {
			$breadcrumb[] = array('text' => $this->language->get($text), 'href' => $this->slink($link) );
		}
		return $breadcrumb;
	}
		
	private function isTableColumnExist($table_name, $table_column) {
		$query = $this->db->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME = '" . DB_PREFIX . $table_name . "' AND COLUMN_NAME = '" . $table_column . "'");
		if ($query->num_rows) {
			return true;	
		}
		return false;
	}
	
	private function needsDatabaseUpdate() {
		return !$this->isTableColumnExist('product', 'allow_preorder') || ( !$this->isTableColumnExist('stock', 'sku') );
	}
	
	public function index() {   
		$lang = $this->language->load(STOCK_MODULE_ROUTE);

		$this->document->setTitle($lang['heading_title']);
		$this->document->addScript('view/javascript/jscolor/jscolor.js');
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('stock', $this->request->post);		
					
			$this->writeCssFile(DIR_CATALOG . "view/theme/default/stylesheet/stock-module.css", $this->request->post);
			$this->session->data['success'] = $lang['text_success'];
			$this->response->redirect($this->slink(MODULES_ROUTE));
		}
				
		$data = array();
		
		// make all language keys available in data
		$data = array_merge($data, $lang);	
		
		$data['token'] = $this->session->data['token'];
		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['error_attention'] = $this->needsDatabaseUpdate() ? $lang['text_needs_db_update'] : '';

		$data['breadcrumbs'] = $this->createBreadcrumb(array('text_home' => 'common/dashboard', 'text_module' => MODULES_ROUTE, 'heading_title' => STOCK_MODULE_ROUTE) );
		$data['action'] = $this->slink(STOCK_MODULE_ROUTE);
		$data['cancel'] = $this->slink(MODULES_ROUTE);

		$this->setFieldValue($data, 'stock_module_enabled', 0);
		$this->setFieldValue($data, 'stock_module_report_limit', 5);
		$this->setFieldValue($data, 'stock_module_show_cart_quantities', 0);
		$this->setFieldValue($data, 'stock_module_check_cart_quantities', 0);

		$this->setFieldValue($data, 'stock_module_change_product_css', 0);
		$this->setFieldValue($data, 'stock_module_product_color_instock', '339965');
		$this->setFieldValue($data, 'stock_module_product_color_outofstock', 'FF0000');

		$this->setFieldValue($data, 'stock_module_update_stock_display', 0);
		$this->setFieldValue($data, 'stock_module_update_stock_display_behaviour', 0);
		$this->setFieldValue($data, 'stock_module_combination_color_instock', '00dd00');
		$this->setFieldValue($data, 'stock_module_combination_color_outofstock', 'FF0000');
		$this->setFieldValue($data, 'stock_module_replace_expression', htmlentities('//li[contains(., "%text_stock%")]'));
		$this->setFieldValue($data, 'stock_module_decorate_expression', htmlentities('<li>%text_stock% <div id="stock" style="display:inline;">%stock%</div></li>'));
		$this->setFieldValue($data, 'stock_module_remove_expression', '');
		$this->setFieldValue($data, 'stock_module_stock_expression', htmlentities('%stock% (%stock_value%)'));
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view(STOCK_MODULE_ROUTE . '.tpl', $data));
	}
	
	public function updatedb() {
		
		$this->language->load(STOCK_MODULE_ROUTE);
		
		$json = array();
		
		if (!$this->isTableColumnExist('product', 'allow_preorder')) {
			$sql = "ALTER TABLE `" . DB_PREFIX . "product` ADD COLUMN `allow_preorder` TINYINT(1) NOT NULL DEFAULT '0' AFTER `stock_status_id`";
			$this->db->query($sql);
		}
		
		if (!$this->isTableColumnExist('stock', 'sku')) {
			$sql = "ALTER TABLE `" . DB_PREFIX . "stock` ADD COLUMN `sku` VARCHAR(64) AFTER `quantity`";
			$this->db->query($sql);
		}
		
		$json['success'] = $this->language->get('text_db_update_success');
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput( json_encode($json) );
	}
	
	private function checkVqmod(& $json) {
		
		if ( ! class_exists('VQMod') ) {
			$json['error'] = $this->language->get('error_vqmod_install');
			return false;
		}
		if ( !isset(VQMod::$_vqversion) ) {
			$json['error'] = $this->language->get('error_vqmod_install');
			return false;
		}
		
		$vqmod_version = VQMod::$_vqversion;
		$oc_version = VERSION;
		$required_vqmod_version = REQUIRED_VQMOD_CODE;
		
		if ( version_compare($vqmod_version, $required_vqmod_version, '<') ) {
			$json['error'] = sprintf($this->language->get('error_vqmod_version'), $oc_version, $vqmod_version, $required_vqmod_version);
		}
		return true;
	}
	
	private function checkPermissions(& $json) {
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user_group`");
		
		$access_found = false;
		$modify_found = false;
		
		if ($query->num_rows) {
			
			foreach($query->rows as $row) {
				$access_found = false;
				$modify_found = false;
				
				$permissions = $row['permission'];
				if ($permissions[0] === "{") { 
					// we have json (after 2.1 opencart stores permissions as json encoded). In this case an object is returned with fields named access, modify that hold arrays of string
					$permission = json_decode($permissions);

					if ( isset($permission->access) && in_array('catalog/stock', $permission->access) ) {
						$access_found = true;
					}
					if ( isset($permission->modify) && in_array('catalog/stock', $permission->modify) ) {
						$modify_found = true;
					}
				} else {  
					// standard PHP serialization. In this case an array with sub-arrays is returned
					$permission = unserialize($permissions);
					
					if ( isset($permission['access']) && in_array('catalog/stock', $permission['access']) ) {
						$access_found = true;
					}
					if ( isset($permission['modify']) && in_array('catalog/stock', $permission['modify']) ) {
						$modify_found = true;
					}
				}
				if ( ($access_found === true) && ($modify_found === true) ) {
					break;	
				}
			}
		}
		
		$result = ($access_found === true) && ($modify_found === true);
		if (!$result) {
			$json['error'] = $this->language->get('error_permissions_missing');
		}
		return $result;
	}
	
	private function isOcmod() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "modification` WHERE code = '" . OCMOD_CODE . "'");
		return $query->num_rows ? true : false;
	}
	
	public function check() {
		$this->language->load(STOCK_MODULE_ROUTE);
		
		$json = array();

		if ( !$this->isOcmod() ) { 
		$this->checkVqmod($json);
		} 
		
		$this->checkPermissions($json);

		if (!isset($json['error']) ) {
			$json['success'] = $this->language->get('text_validate_success');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput( json_encode($json) );
	}
	
	public function install() {
		$query = "ALTER TABLE `" . DB_PREFIX . "product_option` ADD COLUMN `stock_enabled` tinyint(1) NOT NULL DEFAULT 0 AFTER `required`;";
		$this->db->query($query);

		$query = "ALTER TABLE `" . DB_PREFIX . "product` ADD COLUMN `allow_preorder` tinyint(1) NOT NULL DEFAULT 0 AFTER `stock_status_id`;";
		$this->db->query($query);
		
		$query = "CREATE TABLE `" . DB_PREFIX . "stock` ( " .
  					 "	`combination_id` int(11) NOT NULL AUTO_INCREMENT, " .
  					 "	`product_id` int(11) NOT NULL, " .
  					 " 	`quantity` int(4) DEFAULT NULL, " .
  					 " 	`sku` varchar(64) DEFAULT NULL, " .
  					 "	PRIMARY KEY (`combination_id`) " .
						 ") ENGINE=MyISAM;";
		$this->db->query($query);

		$query = "CREATE TABLE `" . DB_PREFIX . "stock_option` ( " .
  					 "	`combination_id` int(11) NOT NULL, " .
  					 "	`product_option_value_id` int(11) NOT NULL, " .
  					 "	PRIMARY KEY (`combination_id`, `product_option_value_id`) " .
						 ") ENGINE=MyISAM;";
		$this->db->query($query);
	}
	
	
	public function uninstall() {
		$query = "ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `allow_preorder`;";
		$this->db->query($query);
		
		$query = "ALTER TABLE `" . DB_PREFIX . "product_option` DROP COLUMN `stock_enabled`;";
		$this->db->query($query);
		
		$query = "DROP TABLE IF EXISTS `" . DB_PREFIX . "stock_option`;";
		$this->db->query($query);

		$query = "DROP TABLE IF EXISTS `" . DB_PREFIX . "stock`;";
		$this->db->query($query);
	}
	
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', STOCK_MODULE_ROUTE)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!isset($this->request->post['stock_module_report_limit']) || empty($this->request->post['stock_module_report_limit'])) {
			$this->error['warning'] = $this->language->get('error_limit_required');
		} else if ( !is_numeric( $this->request->post['stock_module_report_limit']) || $this->request->post['stock_module_report_limit'] <= 0 ) {
			$this->error['warning'] = $this->language->get('error_limit_positive');
		}
		return !$this->error;
	}
}