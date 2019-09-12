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

    public function updateOptionProduct($product_option_id, $price, $stock)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='" . (float) $price . "',  quantity='" . (int) $stock . "' WHERE `product_option_value_id`=" . (int) $product_option_id);
    }

    public function updateOptionProductPrice($product_option_id, $price)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET price='" . (float) $price . "' WHERE `product_option_value_id`=" . (int) $product_option_id);
    }

    public function updateOptionProductStock($product_option_id, $stock)
    {
        return $this->db->query("UPDATE `" . DB_PREFIX . "product_option_value` SET quantity='" . (int) $stock . "' WHERE `product_option_value_id`=" . (int) $product_option_id);
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


    public function getSettingValue($key, $store_id = 0)
    {
        $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int) $store_id . "' AND `key` = '" . $this->db->escape($key) . "'");

        if ($query->num_rows) {
            return $query->row['value'];
        } else {
            return null;
        }
    }

    public function editSettingValue($code = '', $key = '', $value = '', $store_id = 0)
    {
        if (!is_array($value)) {
            $this->db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $this->db->escape($value) . "', serialized = '0'  WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '" . $this->db->escape($key) . "' AND store_id = '" . (int) $store_id . "'");
        } else {
            $this->db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $this->db->escape(json_encode($value)) . "', serialized = '1' WHERE `code` = '" . $this->db->escape($code) . "' AND `key` = '" . $this->db->escape($key) . "' AND store_id = '" . (int) $store_id . "'");
        }
    }

    public function getOrderProducts($order_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int) $order_id . "'");

        return $query->rows;
    }

    public function getSkuCombinationProduct($order_id, $product_id)
    {
        $value = null;
        $query1 = $this->db->query("SELECT oo.product_option_value_id FROM " . DB_PREFIX . "order_option oo INNER JOIN " . DB_PREFIX . "order_product op ON op.order_product_id = oo.order_product_id WHERE oo.order_id = " . (int) $order_id . " AND op.product_id = " . (int) $product_id . "");
        if ($query1->num_rows) {
            $query = $this->db->query("SELECT s.combination_id, s.sku FROM " . DB_PREFIX . "stock s INNER JOIN " . DB_PREFIX . "stock_option so ON so.combination_id = s.combination_id WHERE s.store_id = 0 AND s.product_id = " . (int) $product_id . " AND so.product_option_value_id IN (" . implode(', ', array_column($query1->rows, 'product_option_value_id')) . ")");
            if ($query->num_rows) {
                $count = [];
                foreach ($query->rows as $row) {
                    $count[$row["combination_id"]]["sku"] = $row["sku"];
                    $count[$row["combination_id"]]["cont"] = isset($count[$row["combination_id"]]["cont"]) ? $count[$row["combination_id"]]["cont"] + 1 : 1;
                }
                $value = "";
                foreach ($count as $sku) {
                    if (!empty($sku["sku"]) && $sku["cont"] > 1) {
                        $value = $sku["sku"];
                    }
                }
            }
        }

        return $value;
    }

    public function getOrderTotals($order_id)
    {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int) $order_id . "' ORDER BY sort_order ASC");

        return $query->rows;
    }
}
