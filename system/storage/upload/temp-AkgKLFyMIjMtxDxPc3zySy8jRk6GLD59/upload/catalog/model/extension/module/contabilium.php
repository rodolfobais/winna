<?php
class ModelExtensionModuleContabilium extends Model {
    public function getStatus($lang){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status where language_id = ".$lang." ORDER BY name ASC");

        return $query->rows;
    }

    /**
     * Checks if sku exists
     * @return integer $id_product
     */
    public function existsSku($sku)
    {
        $id = false;

        $query = $this->db->query("SELECT DISTINCT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.sku = '" . (string)$sku . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        if(isset($query->row["product_id"])){
            $id = $query->row["product_id"];
        }

        return $id;
    }

    public function updateProduct($product_id, $price, $stock){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product` SET price='".(float)$price."',  quantity='".(int)$stock."' WHERE `product_id`=".(int)$product_id);
    }

    public function updateProductPrice($product_id, $price){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product` SET price='".(float)$price."' WHERE `product_id`=".(int)$product_id);
    }

    public function updateProductStock($product_id, $stock){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product` SET quantity='".(int)$stock."' WHERE `product_id`=".(int)$product_id);
    }

    /* OPTIONS UPDATE */

    public function updateOptionProduct($product_option_id, $price, $stock){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='".(float)$price."',  quantity='".(int)$stock."' WHERE `product_option_value_id`=".(int)$product_option_id);
    }

    public function updateOptionProductPrice($product_option_id, $price){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='".(float)$price."' WHERE `product_option_value_id`=".(int)$product_option_id);
    }

    public function updateOptionProductStock($product_option_id, $stock){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET quantity='".(int)$stock."' WHERE `product_option_value_id`=".(int)$product_option_id);
    }


    public function haveOptionSku(){
        $have = false;
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product_option_value` LIKE 'option_sku'");

        if(isset($query->num_rows) && $query->num_rows > 0){
            $have = true;
        }

        return $have;
    }

    /**
     * Checks if sku exists in option
     * @return integer $id_product
     */
    public function existsOptionSku($sku)
    {
        $id = false;
        if($this->haveOptionSku()) {
            $query = $this->db->query("SELECT DISTINCT pov.product_option_value_id FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.option_sku = '" . (string)$sku . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

            if(isset($query->row["product_option_value_id"])){
                $id = $query->row["product_option_value_id"];
            }
        }
        return $id;
    }


    public function getSettingValue($key, $store_id = 0) {
		$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `key` = '" . $this->db->escape($key) . "'");

		if ($query->num_rows) {
			return $query->row['value'];
		} else {
			return null;	
		}
	}

    public function editSettingValue($code = '', $key = '', $value = '', $store_id = 0) {
		if (!is_array($value)) {
			$this->db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $this->db->escape($value) . "', serialized = '0'  WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '" . $this->db->escape($key) . "' AND store_id = '" . (int)$store_id . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $this->db->escape(json_encode($value)) . "', serialized = '1' WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '" . $this->db->escape($key) . "' AND store_id = '" . (int)$store_id . "'");
		}
    }
    
    public function getOrderProducts($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
		
		return $query->rows;
    }
    
    public function getOrderTotals($order_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");
		
		return $query->rows;
	}

}