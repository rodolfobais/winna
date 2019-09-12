<?php
class ModelExtensionModuleNoticeupmultistore extends Model {
	public function install() {
		//Создание тоблицы - product_to_multistore
		$query_table = $this->db->query("SHOW tables like '" . DB_PREFIX . "product_to_multistore'");
		if (!$query_table->num_rows) {
		    $this->db->query("
				CREATE TABLE `" . DB_PREFIX . "product_to_multistore` (
					`product_id` INT(11) NOT NULL,
					`store_id` INT(11) NOT NULL DEFAULT '0',
					`price` DECIMAL(15,4) NOT NULL DEFAULT '0.0000',
					`quantity` INT(11) NULL DEFAULT NULL,
					`stock_status_id` INT(11) NOT NULL,
					`date_added` DATETIME NOT NULL,
					`date_modified` DATETIME NOT NULL,
					PRIMARY KEY (`product_id`, `store_id`),
					INDEX `store_id` (`store_id`)
				)
				COMMENT='костыль для мультимагазина'
				COLLATE='utf8_general_ci'
				ENGINE=InnoDB
				;
				");
		}

		//Создание тоблицы - product_special_multistore
		$query_table_special = $this->db->query("SHOW tables like '" . DB_PREFIX . "product_special_multistore' ");
		if(!$query_table_special->num_rows){
			$this->db->query("
			CREATE TABLE `" . DB_PREFIX . "product_special_multistore` (
				`product_special_id` INT(11) NOT NULL AUTO_INCREMENT,
				`product_id` INT(11) NOT NULL,
				`store_id` INT(11) NOT NULL,
				`customer_group_id` INT(11) NOT NULL,
				`priority` INT(5) NOT NULL DEFAULT '1',
				`price` DECIMAL(15,4) NOT NULL DEFAULT '0.0000',
				`date_start` DATE NOT NULL DEFAULT '0000-00-00',
				`date_end` DATE NOT NULL DEFAULT '0000-00-00',
				PRIMARY KEY (`product_special_id`),
				INDEX `product_id` (`product_id`)
			)
			COMMENT='костыль для мультимагазина, специальная цена'
			COLLATE='utf8_general_ci'
			ENGINE=InnoDB;
			");

			//Добавляем специальные товары из таблицы - product_special
			$specials = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special");
			foreach ($specials->rows as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special_multistore SET product_id = '" . (int) $product_special['product_id'] . "', store_id = 0, customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		//Создание тоблицы - product_option_value_multistore
		$query_table = $this->db->query("SHOW tables like '" . DB_PREFIX . "product_option_value_multistore'");
		if (!$query_table->num_rows) {
			$this->db->query("
			CREATE TABLE `" . DB_PREFIX . "product_option_value_multistore` (
				`product_option_value_id` INT(11) NOT NULL AUTO_INCREMENT,
				`product_option_id` INT(11) NOT NULL,
				`product_id` INT(11) NOT NULL,
				`store_id` INT(11) NOT NULL,
				`option_id` INT(11) NOT NULL,
				`option_value_id` INT(11) NOT NULL,
				`quantity` INT(3) NOT NULL,
				`subtract` TINYINT(1) NOT NULL,
				`price` DECIMAL(15,4) NOT NULL,
				`price_prefix` VARCHAR(1) NOT NULL,
				`points` INT(8) NOT NULL,
				`points_prefix` VARCHAR(1) NOT NULL,
				`weight` DECIMAL(15,8) NOT NULL,
				`weight_prefix` VARCHAR(1) NOT NULL,
				PRIMARY KEY (`product_option_value_id`)
			)
			COLLATE='utf8_general_ci'
			ENGINE=MyISAM
			;
			");

			$option_value = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value");
			foreach ($option_value->rows as $product_option_value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value_multistore SET product_option_id = '" . (int)$product_option_value['product_option_id'] . "', store_id = '0', product_id = '" . (int)$product_option_value['product_id'] . "', option_id = '" . (int)$product_option_value['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
			}
		}
	}

	public function uninstall(){
		$query_table = $this->db->query("SHOW tables like '" . DB_PREFIX . "product_to_multistore'");
		if ($query_table->num_rows) {
		    $this->db->query("DROP TABLE `" . DB_PREFIX . "product_to_multistore`");
		}

		$query_table_special = $this->db->query("SHOW tables like '" . DB_PREFIX . "product_special_multistore' ");
		if($query_table_special->num_rows){
				$this->db->query("DROP TABLE `" . DB_PREFIX . "product_special_multistore` ");
		}

		$query_table = $this->db->query("SHOW tables like '" . DB_PREFIX . "product_option_value_multistore'");
		if ($query_table->num_rows) {
		    $this->db->query("DROP TABLE `" . DB_PREFIX . "product_option_value_multistore`");
		}
	}

	public function getProductSpecialsMultistore($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special_multistore WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");
		return $query->rows;
	}

	public function getStoresProduct($data = array()) {
		$store_data = array();

		$store_data[] = array(
			'store_id' => 0,
			'name'     => $this->config->get('config_name'),
			'price'    => $data['price'],
			'quantity' => $data['quantity']
		);

		$query = $this->db->query("SELECT '".$this->config->get('config_name')."' as name,store_id,product_id,price,quantity,stock_status_id FROM " . DB_PREFIX . "product_to_multistore WHERE product_id = ".(int)$data['product_id']." and store_id = 0 UNION ALL SELECT s.name,s.store_id,m.product_id,m.price,m.quantity,m.stock_status_id FROM " . DB_PREFIX . "store s Left JOIN " . DB_PREFIX . "product_to_multistore m on m.product_id = ".(int)$data['product_id']." and ( m.store_id = s.store_id )");
		//$store_data = $query->rows;
		foreach ($query->rows as $result) {
			if($result['store_id'] == 0){
				$store_data[0] = array(
					'store_id' => 0,
					'name'     => $this->config->get('config_name'),
					'price'    => $result['price'],
					'quantity' => $result['quantity'],
					'stock_status_id' => $result['stock_status_id']
				);
			}else{
				$store_data[] = array(
					'store_id' => $result['store_id'],
					'name'     => $result['name'],
					'price'    => $result['price'],
					'quantity' => $result['quantity'],
					'stock_status_id' => $result['stock_status_id']
				);
			}
		}

		return $store_data;
	}

	public function updateProductMultistore($data = array()){
		$product_id = $data['product_id'];

		//product_to_multistore
		$i = 0;
		$sql = "INSERT INTO " . DB_PREFIX . "product_to_multistore (store_id,product_id,quantity,price,stock_status_id,date_added,date_modified) VALUES ";
		foreach($data['noticeupmultistore_module'] as $product_multistore){
				if($product_multistore['price'] == ""){$product_multistore['price'] = 0;}
				if(($product_multistore['quantity'] == "")){$product_multistore['quantity'] = 0;}

				if( count($product_multistore) == 1 || count($data['noticeupmultistore_module']) == ($i+1) ){
					$sql.= "(".(int)$product_multistore['store_id'].",".(int)$product_multistore['product_id'].",".(int)$product_multistore['quantity'].",".(float)$product_multistore['price'].",".(int)$product_multistore['stock_status_id'].",NOW(),NOW())";
				}else{
					$sql.= "(".(int)$product_multistore['store_id'].",".(int)$product_multistore['product_id'].",".(int)$product_multistore['quantity'].",".(float)$product_multistore['price'].",".(int)$product_multistore['stock_status_id'].",NOW(),NOW()),";
				}
		$i++;
		}
		$sql.=" ON DUPLICATE KEY UPDATE quantity=VALUES(quantity),price = VALUES(price),stock_status_id = VALUES(stock_status_id),date_modified = NOW();";

		$this->db->query($sql);

		//product_special_multistore
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special_multistore WHERE product_id = '" . (int) $product_id . "' ");
		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special_multistore SET product_id = '" . (int) $product_id . "', store_id = '". (int)$product_special['store_id'] ."', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		//product_option_value_multistore
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value_multistore WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");
						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
							if(isset($product_option_value['store_id'])){
									$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value_multistore SET product_option_id = '" . (int)$product_option_id . "', store_id = '" . (int)$product_option_value['store_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
							}
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}
  }

	//Multistore Option
	public function getProductOptionsMultistore($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value_multistore pov LEFT JOIN " . DB_PREFIX . "option_value ov ON(pov.option_value_id = ov.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' ORDER BY ov.sort_order ASC");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'store_id'         				=> $product_option_value['store_id'],
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

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}
}
?>
