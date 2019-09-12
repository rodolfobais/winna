<?php
class ModelExtensionModuleContabilium extends Model
{
    public function getStatus($lang)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status where language_id = " . $lang . " ORDER BY name ASC");

        return $query->rows;
    }

    /**
     * Checks if sku exists
     * @return integer $id_product
     */
    public function existsSku($sku)
    {
        $id = false;

        $query = $this->db->query("SELECT DISTINCT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.sku = '" . (string) $sku . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        if (isset($query->row["product_id"])) {
            $id = $query->row["product_id"];
        }

        return $id;
    }

    /* PRODUCT UPDATE */

    public function updateProduct($product_id, $price, $stock)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product` SET price='" . (float) $price . "',  quantity='" . (int) $stock . "' WHERE `product_id`=" . (int) $product_id);
    }

    public function updateProductPrice($product_id, $price)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product` SET price='" . (float) $price . "' WHERE `product_id`=" . (int) $product_id);
    }

    public function updateProductStock($product_id, $stock)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product` SET quantity='" . (int) $stock . "' WHERE `product_id`=" . (int) $product_id);
    }

    /* OPTIONS UPDATE */

    public function updateOptionProduct($product_option_id, $price, $stock, $prefix = "+")
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='" . (float) $price . "',  price_prefix='" . $prefix . "', quantity='" . (int) $stock . "' WHERE `product_option_value_id`=" . (int) $product_option_id);
    }

    public function updateOptionProductPrice($product_option_id, $price, $prefix = "+")
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='" . (float) $price . "',  price_prefix='" . $prefix . "', WHERE `product_option_value_id`=" . (int) $product_option_id);
    }

    public function updateOptionProductStock($product_option_id, $stock)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET quantity='" . (int) $stock . "' WHERE `product_option_value_id`=" . (int) $product_option_id);
    }

    /* COMBINATION UPDATE STOCK MODULE */

    public function updateCombinationProduct($id_combination, $price, $stock, $prefix = "+", $arrPS = [])
    {
        $process = false;
        $update_stock = $this->db->query("UPDATE `" . DB_PREFIX . "stock` SET quantity='" . (int) $stock . "' WHERE `combination_id`=" . (int) $id_combination);
        if ($update_stock) {
            $query = $this->db->query("SELECT DISTINCT pov.product_id FROM " . DB_PREFIX . "stock pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.combination_id = '" . (string) $id_combination . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

            if (isset($query->row["product_id"])) {
                $id = $query->row["product_id"];
                $globalStock = isset($arrPS["P" . $id]) ? $arrPS["P" . $id] : $stock;
                $process = $this->db->query("UPDATE `" . DB_PREFIX . "product` SET price='" . (float) $price . "',  quantity='" . (int) $globalStock . "' WHERE `product_id`=" . (int) $id);
            }
        }
        return $process;
    }

    public function updateCombinationProductPrice($id_combination, $price, $prefix = "+")
    {
        $process = false;
        $query = $this->db->query("SELECT DISTINCT pov.product_id FROM " . DB_PREFIX . "stock pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.combination_id = '" . (string) $id_combination . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        if (isset($query->row["product_id"])) {
            $id = $query->row["product_id"];
            $process = $this->db->query("UPDATE `" . DB_PREFIX . "product` SET price='" . (float) $price . "' WHERE `product_id`=" . (int) $id);
        }
        return $process;
    }

    public function updateCombinationProductStock($id_combination, $stock, $arrPS = [])
    {
        $process = false;
        $query = $this->db->query("SELECT DISTINCT pov.product_id FROM " . DB_PREFIX . "stock pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.combination_id = '" . (string) $id_combination . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        if (isset($query->row["product_id"])) {
            $id = $query->row["product_id"];
            $globalStock = isset($arrPS["P" . $id]) ? $arrPS["P" . $id] : $stock;
            $process = $this->db->query("UPDATE `" . DB_PREFIX . "product` SET quantity='" . (int) $globalStock . "' WHERE `product_id`=" . (int) $id);
        }
        return $process;
    }


    public function getPriceParentProduct($option_id)
    {
        $price = 0;
        if ($this->haveOptionSku()) {
            $query = $this->db->query("SELECT DISTINCT p.price FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "product p ON (pov.product_id = p.product_id) WHERE pov.product_option_value_id = '" . (string) $option_id . "'");

            if (isset($query->row["price"])) {
                $price = $query->row["price"];
            }
        }
        return $price;
    }

    public function haveOptionSku()
    {
        $have = false;
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product_option_value` LIKE 'option_sku'");

        if (isset($query->num_rows) && $query->num_rows > 0) {
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
        if ($this->haveOptionSku()) {
            $query = $this->db->query("SELECT DISTINCT pov.product_option_value_id FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.option_sku = '" . (string) $sku . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

            if (isset($query->row["product_option_value_id"])) {
                $id = $query->row["product_option_value_id"];
            }
        }
        return $id;
    }


    public function haveCombinationSku()
    {
        $have = false;
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "stock` LIKE 'sku'");

        if (isset($query->num_rows) && $query->num_rows > 0) {
            $have = true;
        }

        return $have;
    }
    /**
     * Checks if sku exists in Stock table
     * 
     * @param string $sku valor de SKU
     * 
     * @return integer $id_product
     */
    public function existsCombinationSku($sku = '', $store_id = 0)
    {
        $id = false;
        if ($this->haveCombinationSku()) {
            $query = $this->db->query("SELECT DISTINCT pov.combination_id FROM " . DB_PREFIX . "stock pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) LEFT JOIN oc_stock_option sp ON sp.combination_id = pov.combination_id  WHERE pov.sku = '" . (string) $sku . "' AND pov.store_id ='" . (int) $store_id . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

            if (isset($query->row["combination_id"])) {
                $id = $query->row["combination_id"];
            }
        }
        return $id;
    }

    /**
     * Sumamos el stock de las diferentes combinaciones
     * 
     * @param integer $id_combination valor la convinacion
     * @param string  $stock          valor de stock de la convinacion
     * @param array   $arrPS          array de stock para el producto
     * 
     * @return array $arrPS
     */
    public function sumCombinationStock($id_combination = 0, $stock = 0, $arrPS = [])
    {
        $query = $this->db->query("SELECT DISTINCT pov.product_id FROM " . DB_PREFIX . "stock pov LEFT JOIN " . DB_PREFIX . "product_description pd ON (pov.product_id = pd.product_id) WHERE pov.combination_id = '" . (string) $id_combination . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        if (isset($query->row["product_id"])) {
            $id = $query->row["product_id"];
            if (isset($arrPS["P" . $id])) {
                $arrPS["P" . $id] = $arrPS["P" . $id] + $stock;
            } else {
                $arrPS["P" . $id] = $stock;
            }

            return $arrPS;
        }
    }
}
