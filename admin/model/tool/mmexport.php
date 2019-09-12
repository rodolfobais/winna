<?php
class ModelToolMmexport extends Model {
		
	public function getCustomColumn() {
	$extra_fieldarray = array();
	
	$default = array('product_id', 'model', 'sku', 'upc', 'ean', 'jan', 'isbn', 'mpn', 'location', 'quantity', 'stock_status_id', 'image', 'manufacturer_id', 'shipping', 'price', 'points', 'tax_class_id', 'date_available', 'weight', 'weight_class_id', 'length', 'width', 'height', 'length_class_id', 'subtract', 'minimum', 'sort_order', 'status', 'viewed', 'date_added', 'date_modified');
	$query = $this->db->query("SHOW COLUMNS FROM ". DB_PREFIX ."product ");
	$all_fields = array();

	foreach($query->rows as $product) {
		$all_fields[] = $product['Field'];
	}


	$extra_fields = $this->flip_isset_diff($all_fields,$default);
	
	if($extra_fields) {
		foreach($extra_fields as $extra_field){
			
			$extra_fieldarray[] = $extra_field;			
			
		}
	}	

	return $extra_fieldarray;
	}
	
	function flip_isset_diff($b, $a) {
		$at = array_flip($a);
		$d = array();
		$c=-1;
		foreach ($b as $i):
		$c++;
			if (!isset($at[$i])) :
			
				$d[$c] = $i;
			endif;
			endforeach;

		return $d;
	}

	public function getProducts($data = array()) {
		
		// filter Product Data
		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

		// filter Store Left Join
		if (isset($data['filter_store_id']) && $data['filter_store_id'] != '') {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) ";
		}
		
		// filter Category Left Join
		if (isset($data['filter_category']) && $data['filter_category'] != '') {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) ";
		}
		
		// filter Language
		$sql .= " WHERE pd.language_id = '" . (int)$data['filter_language_id'] . "'";
		
		// filter Store
		if (isset($data['filter_store_id']) && $data['filter_store_id'] != '') {
			$sql .= " AND p2s.store_id = '" . (int)$data['filter_store_id'] . "'";
		}
		
		// filter Model
		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		// filter Status
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		// filter Quantity Range
		if ((isset($data['filter_quantity_start']) && $data['filter_quantity_start'] != '') && (isset($data['filter_quantity_limit']) && $data['filter_quantity_limit'] != '')) {
			
			$sql .= " AND p.quantity BETWEEN '" . (int)$data['filter_quantity_start'] . "' AND '" . (int)$data['filter_quantity_limit'] . "'";
		}else if((isset($data['filter_quantity_start']) && $data['filter_quantity_start'] != '') && (isset($data['filter_quantity_limit']) && $data['filter_quantity_limit'] == '')) {
			// Start FROM
			$sql .= " AND p.quantity >= '" . (int)$data['filter_quantity_start'] . "'";
		}else if((isset($data['filter_quantity_start']) && $data['filter_quantity_start'] == '') && (isset($data['filter_quantity_limit']) && $data['filter_quantity_limit'] != '')) {
			// Start TO
			$sql .= " AND p.quantity <= '" . (int)$data['filter_quantity_limit'] . "'";
		}
				
		// filter Price Range
		if ((isset($data['filter_price_start']) && $data['filter_price_start'] != '') && (isset($data['filter_price_limit']) && $data['filter_price_limit'] != '')) {
			
			$sql .= " AND p.price BETWEEN '" . $this->db->escape($data['filter_price_start']) . "' AND '" . $this->db->escape($data['filter_price_limit']) . "'";
		}else if((isset($data['filter_price_start']) && $data['filter_price_start'] != '') && (isset($data['filter_price_limit']) && $data['filter_price_limit'] == '')) {
			// Start FROM 
			$sql .= " AND p.price >= '" . $this->db->escape($data['filter_price_start']) . "'";
		}else if((isset($data['filter_price_start']) && $data['filter_price_start'] == '') && (isset($data['filter_price_limit']) && $data['filter_price_limit'] != '')) {
			// Start  TO
			$sql .= " AND p.price <= '" . $this->db->escape($data['filter_price_limit']) . "'";
		}		
		// filter Product id Range
		if ((isset($data['filter_product_ids']) && $data['filter_product_ids'] != '') && (isset($data['filter_product_idl']) && $data['filter_product_idl'] != '')) {
			
			$sql .= " AND p.product_id BETWEEN '" . $this->db->escape($data['filter_product_ids']) . "' AND '" . $this->db->escape($data['filter_product_idl']) . "'";
		}else if((isset($data['filter_product_ids']) && $data['filter_product_ids'] != '') && (isset($data['filter_product_idl']) && $data['filter_product_idl'] == '')) {
			// Start FROM 
			$sql .= " AND p.product_id >= '" . $this->db->escape($data['filter_product_ids']) . "'";
		}else if((isset($data['filter_product_ids']) && $data['filter_product_ids'] == '') && (isset($data['filter_product_idl']) && $data['filter_product_idl'] != '')) {
			// Start TO
			$sql .= " AND p.product_id <= '" . $this->db->escape($data['filter_product_idl']) . "'";
		}
		
		// filter Stock Status
		if (isset($data['filter_stock_status_id']) && !is_null($data['filter_stock_status_id'])) {
			$sql .= " AND p.stock_status_id = '" . (int)$data['filter_stock_status_id'] . "'";
		}
		
		// filter Products
		if (!empty($data['filter_product'])) {
			$sql .= " AND p.product_id IN('". implode("','", $data['filter_product']) ."')";
		}
		
		// filter Manufacturer
		if (!empty($data['filter_manufacturer'])) {
			$sql .= " AND p.manufacturer_id IN('". implode("','", $data['filter_manufacturer']) ."')";
		}
		
		// filter Category
		if (isset($data['filter_category']) && $data['filter_category'] != '') {
			$sql .= " AND p2c.category_id IN('". implode("','", $data['filter_category']) ."')";
		}
		
		
				
		// Group Product Id
		$sql .= " GROUP BY p.product_id";

		// Sort ORDER
		$sql .= " ORDER BY pd.name ASC";

		// filter Limit Range
		if ((isset($data['filter_product_start']) && $data['filter_product_start'] != '') && (isset($data['filter_product_limit']) && $data['filter_product_limit'] != '')) {
			// Limit 0, 100;
			$sql .= " LIMIT " . (int)$data['filter_product_start'] . "," . (int)$data['filter_product_limit'];
		}
		

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	// Custom Setups
	
	//  Product Model	
	public function getProductAttributes($product_id) {
		$product_attribute_data = array();

		$product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' GROUP BY attribute_id");

		foreach ($product_attribute_query->rows as $product_attribute) {
			$product_attribute_description_data = array();

			$product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

			foreach ($product_attribute_description_query->rows as $product_attribute_description) {
				$product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
			}

			$product_attribute_data[] = array(
				'attribute_id'                  => $product_attribute['attribute_id'],
				'product_attribute_description' => $product_attribute_description_data
			);
		}

		return $product_attribute_data;
	}
	
	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");

		return $query->rows;
	}
	
	
	public function getProductFilters($product_id) {
		$product_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_filter_data[] = $result['filter_id'];
		}

		return $product_filter_data;
	}
	
		
	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	
	public function getProductOptions($product_id, $language_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$language_id . "'");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON(pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON(ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$language_id . "' ORDER BY ov.sort_order ASC");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'name' 					  => $product_option_value['name'],
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
	
	public function getProductRelated($product_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}

		return $product_related_data;
	}
	
	public function getProductRewards($product_id) {
		$product_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $product_reward_data;
	}
	
		public function getProductSpecials($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

		return $query->rows;
	}
	
	
	public function getProductCategories($product_id) {
		$product_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}

		return $product_category_data;
	}
	
	
	public function getProductDownloads($product_id) {
		$product_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_download_data[] = $result['download_id'];
		}

		return $product_download_data;
	}
	
	
	public function getProductStores($product_id, $store_id = '') {
		$product_store_data = array();

		$sql = "SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'";

		if (!empty($store_id) || $store_id == '0') {
			$sql .= " AND store_id = '" . (int)$store_id . "'";
		}
		
		$query = $this->db->query($sql);
		
		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}

		return $product_store_data;
	}
	
	public function getKeyword($product_id) {
		$sql = "SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "'";
		
		$query = $this->db->query($sql);		
		
		return $query->row;
	}
	
	
	// Download Model
	public function getDownload($download_id, $language_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "download d LEFT JOIN " . DB_PREFIX . "download_description dd ON (d.download_id = dd.download_id) WHERE d.download_id = '" . (int)$download_id . "' AND dd.language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
	
	// Manufacturer Model
	public function getManufacturer($manufacturer_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'manufacturer_id=" . (int)$manufacturer_id . "') AS keyword FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row;
	}
	
	// Custom Setups
				
	// import module
	
	public function getLanguage($language_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "language WHERE language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
	
	public function getTaxClass($tax_class_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tax_class WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row;
	}
	
	public function getStockStatus($stock_status_id, $language_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "stock_status WHERE stock_status_id = '" . (int)$stock_status_id . "' AND language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
	
	public function getLengthClass($length_class_id, $language_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "length_class lc LEFT JOIN " . DB_PREFIX . "length_class_description lcd ON (lc.length_class_id = lcd.length_class_id) WHERE lc.length_class_id = '" . (int)$length_class_id . "' AND lcd.language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
	
	public function getWeightClass($weight_class_id, $language_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "weight_class wc LEFT JOIN " . DB_PREFIX . "weight_class_description wcd ON (wc.weight_class_id = wcd.weight_class_id) WHERE wc.weight_class_id = '" . (int)$weight_class_id . "' AND wcd.language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
		
	public function getCategory($category_id, $language_id) {
		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int)$language_id . "' AND cd2.language_id = '" . (int)$language_id . "' AND c1.category_id = '". (int)$category_id ."'";

		$sql .= " GROUP BY cp.category_id";

		$sql .= " ORDER BY c1.sort_order, name ASC ";

		$query = $this->db->query($sql);

		return $query->row;
	}
		
	public function getAttribute($attribute_id, $language_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute a LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE a.attribute_id = '" . (int)$attribute_id . "' AND ad.language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
	
	public function getAttributeGroup($attribute_group_id, $language_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_group ag LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON(ag.attribute_group_id = agd.attribute_group_id) WHERE ag.attribute_group_id = '" . (int)$attribute_group_id . "' AND agd.language_id = '". (int)$language_id ."'");

		return $query->row;
	}	
	
	public function getFilter($filter_id, $language_id) {
		$query = $this->db->query("SELECT *, (SELECT name FROM " . DB_PREFIX . "filter_group_description fgd WHERE f.filter_group_id = fgd.filter_group_id AND fgd.language_id = '" . (int)$language_id . "') AS `group` FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id = '" . (int)$filter_id . "' AND fd.language_id = '" . (int)$language_id . "'");

		return $query->row;
	}
	
	
	
	public function getReviews($product_id, $language_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "review  WHERE product_id = '". (int)$product_id ."'";

		$sql .= " ORDER BY date_added DESC";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	
	
	// import module

	
}