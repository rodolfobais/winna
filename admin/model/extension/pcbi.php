<?php
//use Symfony\Component\Validator\Constraints\Null;

//admin/model/pcbi/pcbi.php

class ModelExtensionPcbi extends Model {
    
    public function deleteHsquare_configTable() {
        $this->db->query("DELETE FROM " . DB_PREFIX . "hsquare_config");
    }
    
    public function getoption() {
        $data['option'] = array();
        $sql = "SELECT * FROM " . DB_PREFIX . "option_description";
        $option=$this->db->query($sql);
        
        return $option;
        
    }
    public function getFilter_value() {
        $data['option'] = array();
        $sql = "SELECT * FROM " . DB_PREFIX . "filter_description";
        $filter_value=$this->db->query($sql);
        //echo"<pre>";print_r($filter_value);echo"<pre>";die;
        return $filter_value;
        
    }
    public function getProduct_option_value_id() {
        $data['option'] = array();
        $product_option_value=$this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description");
        
        return $product_option_value;
        
    }
    public function getoptionFromhsquare_config() {
        $data['option'] = array();
        $sql = "SELECT * FROM " . DB_PREFIX . "hsquare_config";
        $option=$this->db->query($sql);
        
        return $option;
        
    }
    public function getMapColor() {
        for($i=1; $i<=10; $i++)
        {
            $map_color= $this->db->query("SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'MP_FILTER_COLOR_OPTION_$i' AND hc_module_code='pcbi' AND hc_value = '" .$this->request->post["map_filter_color_option_$i"]. "'");
            
        }
        
    }
    
    public function getMapFilter() {
        for($i=1; $i<=10; $i++)
        {
            $map_filter= $this->db->query("SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'MP_FILTER_OPTION_$i' AND hc_module_code='pcbi' AND hc_value = '" .$this->request->post["map_filter_option_$i"]. "'");
            
        }
        
    }
    
    public function alterTableproduct_image() {
        
        $hasModelChoiceField = FALSE;
        $result = $this->db->query( "DESCRIBE `".DB_PREFIX."product_image`;" );
        
        foreach ($result->rows as $row) {
            if ($row['Field'] == 'pi_pcbi_color') {
                $hasModelChoiceField = TRUE;
                break;
            }
        }
        if (!$hasModelChoiceField) {
            $sql = "ALTER TABLE `".DB_PREFIX."product_image` ADD pi_pcbi_color varchar(10)";
            $this->db->query( $sql );
        }
        
    }
    
    public function CreateHsquare_configTable() {
        $query = $this->db->query("CREATE TABLE IF NOT EXISTS
                                                             `" . DB_PREFIX . "hsquare_config` (
                                                            `hsquare_config_id` int(11) NOT NULL AUTO_INCREMENT,
                                                            `hc_module_id` varchar(255) NOT NULL,
                                                            `hc_module_code` varchar(255) NOT NULL,
                                                            `hc_key` varchar(30) NOT NULL,
                                                            `hc_value` varchar(100) NOT NULL,
                                                            `hc_status` tinyint(4) NOT NULL,
                                                            `hc_sort_order` int(11) NOT NULL,
                                                            `hc_date_added` date NOT NULL,
                                                            `hc_date_modified` datetime NOT NULL,
                                                            PRIMARY KEY (`hsquare_config_id`))
                                                             ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0");
    }
    
    public function insertQuery()
    {
        
        for($i=1; $i<=10; $i++)
        {
            if(empty($this->request->post["map_filter_color_option_$i"])) return;

            $result_color = $this->db->query( "SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'MP_FILTER_COLOR_OPTION_$i' AND hc_module_code='pcbi' ");
            $result_filter = $this->db->query( "SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'MP_FILTER_OPTION_$i' AND hc_module_code='pcbi' ");
            //echo "<pre>";print_r($result_color);echo "</pre>";die;
            $numrows_color = $result_color->num_rows;
            $numrows_filter = $result_filter->num_rows;
            // echo "MP_COLOR_$i<br>".$numrows_color."<br>i :".$i."<br>Filter<br>".$numrows_filter."<br>i :".$i;die;
            if( $numrows_color == 0 && $numrows_filter == 0 )
            {
                //echo "if :".$i;die;
                $this->db->query("INSERT INTO `" . DB_PREFIX . "hsquare_config`
                                                    SET
                                                        hc_module_id ='' ,
                                                        hc_module_code = 'pcbi',
                                                        hc_key = 'MP_FILTER_COLOR_OPTION_$i',
                                                        hc_value = '" .$this->request->post["map_filter_color_option_$i"]. "',
                                                        hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                        hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                        hc_date_added = NOW()");
                
                
                //echo "if insert after :".$i;die;
            }
            else
            {
                // echo "else :".$i;die;
                $this->db->query("UPDATE `" . DB_PREFIX . "hsquare_config`
                                            SET
                                                hc_module_id ='' ,
                                                hc_module_code = 'pcbi',
                                                hc_key = 'MP_FILTER_COLOR_OPTION_$i',
                                                hc_value = '" .$this->request->post["map_filter_color_option_$i"]. "',
                                                hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                hc_date_modified = NOW() where hc_key = 'MP_FILTER_COLOR_OPTION_$i' AND hc_module_code='pcbi'");
                //echo "else insert:".$i;die;
                
                
                //echo "else insert after:".$i;die;
            }
            
            if($numrows_filter == 0 && $numrows_filter == 0)
            {
                
                $this->db->query("INSERT INTO `" . DB_PREFIX . "hsquare_config`
                                                    SET
                                                        hc_module_id ='' ,
                                                        hc_module_code = 'pcbi',
                                                        hc_key = 'MP_FILTER_OPTION_$i',
                                                        hc_value = '" .$this->request->post["map_filter_option_$i"]. "',
                                                        hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                        hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                        hc_date_added = NOW()");
                // echo   "hc_key = 'MP_FILTER_OPTION_$i'";die;
            }
            else
            {
                $this->db->query("UPDATE `" . DB_PREFIX . "hsquare_config`
                                            SET
                                                hc_module_id ='' ,
                                                hc_module_code = 'pcbi',
                                                hc_key = 'MP_FILTER_OPTION_$i',
                                                hc_value = '" .$this->request->post["map_filter_option_$i"]. "',
                                                hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                hc_date_modified = NOW() where hc_key = 'MP_FILTER_OPTION_$i' AND hc_module_code='pcbi'");
            }
            
            $result_prod_opt_val_id_color = $this->db->query( "SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'MP_PROD_OPT_VAL_ID_COLOR_$i' AND hc_module_code='pcbi' ");
            $result_prod_opt_val_id = $this->db->query( "SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'MP_PROD_OPT_VAL_ID_$i' AND hc_module_code='pcbi' ");
            if( $result_prod_opt_val_id_color->num_rows == 0 && $result_prod_opt_val_id->num_rows == 0 )
            {
                
                $this->db->query("INSERT INTO `" . DB_PREFIX . "hsquare_config`
                                                    SET
                                                        hc_module_id ='' ,
                                                        hc_module_code = 'pcbi',
                                                        hc_key = 'MP_PROD_OPT_VAL_ID_COLOR_$i',
                                                        hc_value = '" .$this->request->post["map_option_value_ids_color_option_$i"]. "',
                                                        hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                        hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                        hc_date_added = NOW()");
            }
            /// echo "if insert :".$i;die;
            else
            {
                $this->db->query("UPDATE `" . DB_PREFIX . "hsquare_config`
                                            SET
                                                hc_module_id ='' ,
                                                hc_module_code = 'pcbi',
                                                hc_key = 'MP_PROD_OPT_VAL_ID_COLOR_$i',
                                                hc_value = '" .$this->request->post["map_option_value_ids_color_option_$i"]. "',
                                                hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                hc_date_modified = NOW() where hc_key = 'MP_PROD_OPT_VAL_ID_COLOR_$i' AND hc_module_code='pcbi'");
            }
            if($result_prod_opt_val_id->num_rows == 0)
            {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "hsquare_config`
                                                    SET
                                                        hc_module_id ='' ,
                                                        hc_module_code = 'pcbi',
                                                        hc_key = 'MP_PROD_OPT_VAL_ID_$i',
                                                        hc_value = '" .$this->request->post["map_option_value_ids_option_$i"]. "',
                                                        hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                        hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                        hc_date_added = NOW()");
            }
            else
            {
                $this->db->query("UPDATE `" . DB_PREFIX . "hsquare_config`
                                            SET
                                                hc_module_id ='' ,
                                                hc_module_code = 'pcbi',
                                                hc_key = 'MP_PROD_OPT_VAL_ID_$i',
                                                hc_value = '" .$this->request->post["map_option_value_ids_option_$i"]. "',
                                                hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                                hc_sort_order = '" . $this->request->post['sort_order']. "',
                                                hc_date_modified = NOW() where hc_key = 'MP_PROD_OPT_VAL_ID_$i' AND hc_module_code='pcbi'");
            }
            
            //echo "if insert after :".$i;die;
            // echo "hc_value = '" .$this->request->post["map_option_value_ids_option_$i"]. "'";die;
        }
        
        
        
    }
    
    public function insertHsquare_configTable() {
        
        //check and insert/update filter 1
        $result = $this->db->query( "SELECT * FROM `" . DB_PREFIX . "hsquare_config` where hc_key = 'OPTION_COLOR' AND hc_module_code='pcbi'");
        
        $numrows = $result->num_rows;
        
        if ($numrows==0)
        {
            
            $this->db->query("INSERT INTO `" . DB_PREFIX . "hsquare_config`
                                         SET
                                             hc_module_id ='' ,
                                             hc_module_code = 'pcbi',
                                             hc_key = 'OPTION_COLOR',
                                             hc_value = '" .$this->request->post["add_color"]. "',
                                             hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                             hc_sort_order = '" . $this->request->post['sort_order']. "',
                                             hc_date_modified = NOW()");
            
        }
        else
        {
            //
            $this->db->query("UPDATE `" . DB_PREFIX . "hsquare_config`
                                         SET
                                             hc_module_id ='' ,
                                             hc_module_code = 'pcbi',
                                             hc_key = 'OPTION_COLOR',
                                             hc_value = '" .$this->request->post["add_color"]. "',
                                             hc_status = '" . (!empty($this->request->post['module_productcolorbasedimages_status'])?$this->request->post['module_productcolorbasedimages_status']:false) . "',
                                             hc_sort_order = '" . $this->request->post['sort_order']. "',
                                             hc_date_modified = NOW()where hc_key = 'OPTION_COLOR' AND hc_module_code='pcbi' ");
        }
        $this->insertQuery();
    }
    
}