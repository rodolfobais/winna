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

    /* PRODUCT UPDATE */

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

    public function updateOptionProduct($product_option_id, $price, $stock, $prefix="+"){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='".(float)$price."',  price_prefix='".$prefix."', quantity='".(int)$stock."' WHERE `product_option_value_id`=".(int)$product_option_id);
    }

    public function updateOptionProductPrice($product_option_id, $price, $prefix="+"){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='".(float)$price."',  price_prefix='".$prefix."', WHERE `product_option_value_id`=".(int)$product_option_id);
    }

    public function updateOptionProductStock($product_option_id, $stock){
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET quantity='".(int)$stock."' WHERE `product_option_value_id`=".(int)$product_option_id);
    }

    public function getPriceParentProduct($option_id){
        $price = 0;
        if($this->haveOptionSku()){
            $query = $this->db->query("SELECT DISTINCT p.price FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "product p ON (pov.product_id = p.product_id) WHERE pov.product_option_value_id = '" . (string)$option_id . "'");

            if(isset($query->row["price"])){
                $price = $query->row["price"];
            }
        }
        return $price;
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
        if($this->haveOptionSku()){
            $query = $this->db->query("SELECT DISTINCT pov.product_option_value_id FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.option_sku = '" . (string)$sku . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

            if(isset($query->row["product_option_value_id"])){
                $id = $query->row["product_option_value_id"];
            }
        }
        return $id;
    }
}