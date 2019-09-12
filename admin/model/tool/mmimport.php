<?php
class ModelToolMmimport extends Model {	
		
	public function getProductExistByName($data){		
	
		$query = $this->db->query("SELECT product_id, name FROM " . DB_PREFIX . "product_description  WHERE name = '" . $this->db->escape($data['name']) . "' AND language_id = '". (int)$data['language_id'] ."'");		
		return $query->row;		
	}
	
	public function getProductExistById($product_id) {
		$query = $this->db->query("SELECT product_id, model FROM " . DB_PREFIX . "product p WHERE p.product_id = '" . (int)$product_id . "'");

		return $query->row;
	}
	
	public function getProductExistByModel($model) {
		$query = $this->db->query("SELECT product_id, model FROM " . DB_PREFIX . "product p WHERE p.model = '" . $this->db->escape($model) . "'");
		
		return $query->row;
	}
		
	//Get new columns
	
	public function getNewColumns($field_name) {
		return $this->db->query("SHOW COLUMNS FROM ". DB_PREFIX . "product WHERE `Field` = '". $this->db->escape($field_name) ."'")->row;
	}
	
	//Get new columns
	
			
	public function updateProduct($id,$data,$filters){
		
				
		$sql = "UPDATE " . DB_PREFIX . "product SET product_id = '". (int)$id ."'";

		$implode = array();

		if(!empty($filters['checkfield']['model'])) {
			$implode[] = " model = '" . $this->db->escape($data['model']) . "'";
		}

		if(!empty($filters['checkfield']['sku'])) {
			$implode[] = " sku = '" . $this->db->escape($data['sku']) . "'";
		}

		if(!empty($filters['checkfield']['upc'])) {
			$implode[] = " upc = '" . $this->db->escape($data['upc']) . "'";
		}
		if(!empty($filters['checkfield']['ean'])) {
			$implode[] = " ean = '" . $this->db->escape($data['ean']) . "'";
		}
		if(!empty($filters['checkfield']['jan'])) {
			$implode[] = " jan = '" . $this->db->escape($data['jan']) . "'";
		}
		if(!empty($filters['checkfield']['isbn'])) {
			$implode[] = " isbn = '" . $this->db->escape($data['isbn']) . "'";
		}
		if(!empty($filters['checkfield']['mpn'])) {
			$implode[] = " mpn = '" . $this->db->escape($data['mpn']) . "'";
		}
		if(!empty($filters['checkfield']['location'])) {
			$implode[] = " location = '" . $this->db->escape($data['location']) . "'";
		}
		if(!empty($filters['checkfield']['product_image'])) {
			$implode[] = " image = '" . $this->db->escape(($data['image'])) . "'";
		}
		if(!empty($filters['checkfield']['quantity'])) {
			$implode[] = " quantity = '" . (int)$data['quantity'] . "'";
		}
		if(!empty($filters['checkfield']['minimum'])) {
			$implode[] = " minimum = '" . (int)$data['minimum'] . "'";
		}
		if(!empty($filters['checkfield']['subtract'])) {
			$implode[] = " subtract = '" . (int)$data['subtract'] . "'";
		}
		if(!empty($filters['checkfield']['stock_status_id'])) {
			$implode[] = " stock_status_id = '" . (int)$data['stock_status_id'] . "'";
		}
		if(!empty($filters['checkfield']['date_available'])) {
			$implode[] = " date_available = '" . $this->db->escape($data['date_available']) . "'";
		}

		if(!empty($filters['checkfield']['manufacturer_id'])) {
			if(!empty($data['manufacturer_id'])) {
				$implode[] = " manufacturer_id = '" . (int)$data['manufacturer_id'] . "'";
			} else if(!empty($data['manufacturer'])) {
				$manufacturer_info = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer WHERE name = '" . $this->db->escape($data['manufacturer']) . "'")->row;

				if($manufacturer_info) {
					$implode[] = " manufacturer_id = '" . (int)$manufacturer_info['manufacturer_id'] . "'";
				}
			}
		}

		if(!empty($filters['checkfield']['shipping'])) {
			$implode[] = " shipping = '" . (int)$data['shipping'] . "'";
		}
		if(!empty($filters['checkfield']['price'])) {
			$implode[] = " price = '" . (float)str_replace(',', '', $data['price']) . "'";
		}
		if(!empty($filters['checkfield']['reward_points'])) {
			$implode[] = " points = '" . (int)$data['reward_points'] . "'";
		}
		if(!empty($filters['checkfield']['weight'])) {
			$implode[] = " weight = '" . (float)str_replace(',', '', $data['weight']) . "'";
		}
		if(!empty($filters['checkfield']['weight_class_id'])) {
			$implode[] = " weight_class_id = '" . (int)$data['weight_class_id'] . "'";
		}
		if(!empty($filters['checkfield']['length'])) {
			$implode[] = " length = '" . (float)str_replace(',', '', $data['length']) . "'";
		}
		if(!empty($filters['checkfield']['width'])) {
			$implode[] = " width = '" . (float)str_replace(',', '', $data['width']) . "'";
		}
		if(!empty($filters['checkfield']['height'])) {
			$implode[] = " height = '" . (float)str_replace(',', '', $data['height']) . "'";
		}
		if(!empty($filters['checkfield']['length_class_id'])) {
			$implode[] = " length_class_id = '" . (int)$data['length_class_id'] . "'";
		}
		if(!empty($filters['checkfield']['status'])) {
			$implode[] = " status = '" . (int)$data['status'] . "'";
		}
		if(!empty($filters['checkfield']['tax_class_id'])) {
			$implode[] = " tax_class_id = '" . (int)$data['tax_class_id'] . "'";
		}
		if(!empty($filters['checkfield']['sort_order'])) {
			$implode[] = " sort_order = '" . (int)$data['sort_order'] . "'";
		}
		if(!empty($filters['checkfield']['viewed'])) {
			$implode[] = " viewed = '". $this->db->escape($data['viewed']) ."'";
		}
		if(!empty($filters['checkfield']['date_added'])) {
			$implode[] = " date_added = '". $this->db->escape($data['date_added']) ."'";
		}
		if(!empty($filters['checkfield']['date_modified'])) {
			$implode[] = " date_modified = '". $this->db->escape($data['date_modified']) ."'";
		}

		if($implode) {
			$sql .= ", ";
		}

		$sql .= implode(', ', $implode);

	 	$sql .= " WHERE product_id = '". (int)$id ."'";
		
		$this->db->query($sql);

	//	Product Description
		
		$product_description_query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$id . "' AND language_id = '" . (int)$filters['language_id'] . "'");
		
		if($product_description_query->num_rows) {
			// Product Description
		
			$sql = "UPDATE " . DB_PREFIX . "product_description SET product_id = '" . (int)$id . "', language_id = '" . (int)$filters['language_id']. "'";

			$implode = array();
			if(!empty($filters['checkfield']['product_name'])) {
				$implode[] = " name = '" . $this->db->escape(($data['product_name'])) . "'";
			}

			if(!empty($filters['checkfield']['description'])) {
				$implode[] = " description = '" . $this->db->escape(($data['description'])) . "'";
			}

			if(!empty($filters['checkfield']['tag'])) {				
				$implode[] = " tag = '" . $this->db->escape(($data['tag'])) . "'";
			}
			
			if(!empty($filters['checkfield']['meta_title'])) {
				$implode[] = " meta_title = '" . $this->db->escape(($data['meta_title'])) . "'";
			}

			if(!empty($filters['checkfield']['meta_description'])) {
				$implode[] = " meta_description = '" . $this->db->escape(($data['meta_description'])) . "'";
			}
			if(!empty($filters['checkfield']['meta_keyword'])) {
				$implode[] = " meta_keyword = '" . $this->db->escape(($data['meta_keyword'])) . "'";
			}

			if($implode) {
				$sql .= ", ";
			}

			$sql .= implode(', ', $implode);

			$sql .= " WHERE product_id = '" . (int)$id . "' AND language_id = '" . (int)$filters['language_id']. "'";

			$this->db->query($sql);
		} else {
			// Product Description
			$sql = "INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$filters['language_id']. "'";

			$implode = array();
			if(!empty($filters['checkfield']['product_name'])) {
				$implode[] = " name = '" . $this->db->escape(($data['product_name'])) . "'";
			}

			if(!empty($filters['checkfield']['description'])) {
				$implode[] = " description = '" . $this->db->escape(($data['description'])) . "'";
			}

			if(!empty($filters['checkfield']['meta_tag'])) {
				$implode[] = " tag = '" . $this->db->escape(($data['meta_tag'])) . "'";
			}
			
			if(!empty($filters['checkfield']['meta_title'])) {
				$implode[] = " meta_title = '" . $this->db->escape(($data['meta_title'])) . "'";
			}

			if(!empty($filters['checkfield']['meta_description'])) {
				$implode[] = " meta_description = '" . $this->db->escape(($data['meta_description'])) . "'";
			}
			if(!empty($filters['checkfield']['meta_keyword'])) {
				$implode[] = " meta_keyword = '" . $this->db->escape(($data['meta_keyword'])) . "'";
			}

			if($implode) {
				$sql .= ", ";
			}

			$sql .= implode(', ', $implode);
			$this->db->query($sql);
		}
	//	Product Description end
	
	// Product keyword
		if(!empty($filters['checkfield']['seo_keyword'])) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$id . "'");
		//	echo $filters['checkfield']['seo_keyword'];
			if (!empty($data['seo_keyword'])) {
							
				$i = 0;
				$this->load->model('catalog/url_alias');
				$seo_keyword = $data['seo_keyword'];
				do {
					$exists = false;
					$url_alias_info = $this->model_catalog_url_alias->getUrlAlias(($data['seo_keyword']));
					if (!empty($url_alias_info) && $url_alias_info['query'] != 'product_id=' . $id) {
						$data['seo_keyword'] = $seo_keyword.'-'. $i;
						
						$exists = true;
						$i++;
					}
				} while($exists);
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$id . "', keyword = '" . $this->db->escape(($data['seo_keyword'])) . "'");
			}
		}
		
		// Product keyword end
		
		// Product Store
		if(!empty($filters['checkfield']['store'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$id . "'");

			if (isset($filters['store'])) {
				foreach ($filters['store'] as $store_id) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$id . "', store_id = '" . (int)$store_id . "'");
				}
			}
		}		
		// Product Store End
		
		
		// Product Attribute 26-9-18 modify
		
		if(!empty($filters['checkfield']['attribute_names'])) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$id . "' AND language_id = '" . (int)$filters['language_id'] . "'");
			
			
			if (!empty($data['attribute_names'])) {
				foreach ($data['attribute_names'] as $product_attribute) {
					$product_attribute = (explode('!!', $product_attribute)); 
					$product_attribute = array_map('trim', $product_attribute);
					
					if(count($product_attribute) == 3) {	
						
						$fetch_attribute_group = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_group_description  WHERE language_id = '" . (int)$filters['language_id'] . "' AND name = '". $product_attribute[0] ."'")->row;
						
						if(!empty($fetch_attribute_group)){
							$attribute_group_id = $fetch_attribute_group['attribute_group_id'];
						}
						
						if(empty($fetch_attribute_group)){
						
							$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_group SET sort_order = 0");

							$attribute_group_id = $this->db->getLastId();
							
								$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_group_description SET attribute_group_id = '" . (int)$attribute_group_id . "', language_id = '" . (int)$filters['language_id'] . "', name = '" . $this->db->escape( $product_attribute[0]) . "'");
						
						}
						
						$attribute_info = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "attribute_description WHERE name = '" . $this->db->escape(($product_attribute[1])) . "'")->row;
						if(!empty($attribute_info)){
							$attribute_id = $attribute_info['attribute_id'];
						}
						
						$fetch_attribute = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description  WHERE language_id = '" . (int)$filters['language_id'] . "' AND name = '". $product_attribute[1] ."'")->rows;
						
							
						if(empty($fetch_attribute)){
							
								$this->db->query("INSERT INTO " . DB_PREFIX . "attribute SET attribute_group_id = '" . (int)$attribute_group_id . "', sort_order = 0");

								$attribute_id = $this->db->getLastId();
								
								$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . (int)$filters['language_id'] . "', name = '" . $this->db->escape($product_attribute[1]) . "'");
						}	
						
						$attribute_info = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "attribute_description WHERE name = '" . $this->db->escape(($product_attribute[1])) . "'")->row;
						
						if (!empty($attribute_info)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$id . "', attribute_id = '" . (int)$attribute_info['attribute_id'] . "', language_id = '" . (int)$filters['language_id'] . "', text = '" .  $this->db->escape($product_attribute[2]) . "'");
						}
					}
				}
			}
			
		}
		
		
		// Product Attribute end
	
		// Product Discount
		if(!empty($filters['checkfield']['discount_offers'])) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$id . "'");
		
			if (!empty($data['discount_offers'])) {
				foreach ($data['discount_offers'] as $product_discount) {
					$product_discount = (explode('!!', $product_discount)); 
					$product_discount = array_map('trim', $product_discount);
					
					if(count($product_discount) == 6) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$id . "', customer_group_id = '" . (int)$product_discount[0] . "', quantity = '" . (int)$product_discount[1] . "', priority = '" . (int)$product_discount[2] . "', price = '" . (float)str_replace(',', '', $product_discount[3]) . "', date_start = '" . $this->db->escape($product_discount[4]) . "', date_end = '" . $this->db->escape($product_discount[5]) . "'");
					}
				}
			}
		}
		// Product Discount end
		
		
		// Product Special	
		if(!empty($filters['checkfield']['special'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$id . "'");
			
			if (!empty($data['special_offers'])) {
				foreach ($data['special_offers'] as $product_special) {
					$product_special = (explode('!!', $product_special)); 
					$product_special = array_map('trim', $product_special);
					
					if(count($product_special) == 5) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$id . "', customer_group_id = '" . (int)$product_special[0] . "', priority = '" . (int)$product_special[1] . "', price = '" . (float)str_replace(',', '', $product_special[2]) . "', date_start = '" . $this->db->escape($product_special[3]) . "', date_end = '" . $this->db->escape($product_special[4]) . "'");
					}
				}
			}
		}
		// Product Special end
		
		// Product Image
		if(!empty($filters['checkfield']['product_image'])) {
				
			if(!empty($filters['images'])) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$id . "'");
				
				if (!empty($data['additional_images'])) {
					$product_image_sort_order = 0;
					foreach ($data['additional_images'] as $product_image) {
						$product_image = trim($product_image);
						if($product_image) {
							if((substr($product_image, 0, 7) == "http://" || substr($product_image, 0, 8) == "https://") && $this->file_contents_exist($product_image)) {
								
								$imageString = file_get_contents($product_image);
								
								$dir_name = 'catalog/saveimage/';
								$folder_name = DIR_IMAGE. $dir_name;
								
								$this->makeFolder($folder_name);
						
								$filename = basename(html_entity_decode($product_image, ENT_QUOTES, 'UTF-8'));

								$filename = str_replace(array(' ', '&nbsp;', '%20'), '_', $filename);

								if(file_exists($folder_name . $filename)) {
									$pathinfo_file = pathinfo($folder_name . $filename);
									if($pathinfo_file) {
										$final_file = $pathinfo_file['filename'] .'_'. time().rand(0,1000) .'.'.$pathinfo_file['extension'];
									} else{
										$final_file = $filename;
									}
								} else{
									$final_file = $filename;
								}

								$save = file_put_contents($folder_name . $final_file, $imageString);
								$product_image = $dir_name . $final_file;
							}

							$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$id . "', image = '" . $this->db->escape($product_image) . "', sort_order = '" . (int)$product_image_sort_order . "'");
						}
						
						$product_image_sort_order++; 
					}
				}
			}
		}
		// Product Image
		
		// Product Downloads
		if(!empty($filters['checkfield']['download'])) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$id . "'");
			
			if (!empty($data['download_names'])) {
				foreach ($data['download_names'] as $product_download) {
					$product_download = trim($product_download);
					if($product_download) {
						
						$download_info = $this->db->query("SELECT download_id FROM " . DB_PREFIX . "download_description WHERE name = '" . $this->db->escape(($product_download)) . "'")->row;
						if($download_info) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$id . "', download_id = '" . (int)$download_info['download_id'] . "'");
						}
					}
				}
			}
		}
		// Product Downloads end
		
		// Product Category
		if(!empty($filters['checkfield']['category_ids'])) {
				
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$id . "'");
			
			if (!empty($data['categories_ids'])) {
				foreach ($data['categories_ids'] as $category_id) {
					$category_id = trim($category_id);
					if($category_id) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$id . "', category_id = '" . (int)$category_id . "'");
					}
				}
			} else if (!empty($data['category_name'])) {
				foreach ($data['category_name'] as $category_name) {
					$category_name = explode('&gt;', $category_name);
					$category_name = end($category_name);
					$category_name = trim(str_replace('&nbsp;',' ', htmlentities($category_name)));
					
					$category_info = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category_description WHERE name = '" . $this->db->escape($category_name) . "' AND language_id = '" . (int)$filters['language_id'] . "'")->row;

					if($category_info) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$id . "', category_id = '" . (int)$category_info['category_id'] . "'");
					}
				}				
			}
		}
		// Product Category end
		
		// Product Filter		
		if(!empty($filters['checkfield']['filter_names'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$id . "'");
			
			if (!empty($data['filter_names'])) {
				foreach ($data['filter_names'] as $filter) {
					$filter = trim($filter);
					if($filter) {
						$filter_data = (explode('~', $filter)); 
						$filter_data = array_map('trim', $filter_data);
						if(count($filter_data) == 2) {
							
							$filter_group_info = $this->db->query("SELECT filter_group_id FROM " . DB_PREFIX . "filter_group_description WHERE name = '" . $this->db->escape(($filter_data[0])) . "'")->row;
							if($filter_group_info) {
								
								$filter_info = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "filter_description WHERE name = '" . $this->db->escape(($filter_data[1])) . "' AND filter_group_id = '". (int)$filter_group_info['filter_group_id'] ."'")->row;
								if($filter_info) {
									$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$id . "', filter_id = '" . (int)$filter_info['filter_id'] . "'");
								}
							}
						}
					}
				}
			}
		}
		// Product Filter end
		
		// Product Related		
		if(!empty($filters['checkfield']['related_products'])) {
						
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$id . "'");
			
				if (!empty($data['related_products'])) {
				foreach ($data['related_products'] as $related_id) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$id . "', related_id = '" . (int)$related_id . "'");
				}
			}
		}
		// Product Related end
		
		// Product Option 
		
		if(!empty($filters['checkfield']['options'])) {
						
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$id . "'");
			
			if (!empty($data['options_data'])) {
				foreach ($data['options_data'] as $product_option) {
					$product_option = (explode(';;', $product_option)); 
					$product_option = array_map('trim', $product_option);
					
					
					if(count($product_option) >= 3) {
						$option_info = $this->db->query("SELECT o.option_id FROM " . DB_PREFIX . "option o left JOIN ". DB_PREFIX ."option_description od ON (o.option_id=od.option_id) WHERE od.name = '" . $this->db->escape(($product_option[0])) . "' AND o.type = '" . $this->db->escape($product_option[1]) . "'")->row;
						
						if(!$option_info) {
							// new option add code 25-9-18
							
							$this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = '" . $this->db->escape($product_option[1]) . "'");

							$option_id = $this->db->getLastId();
							
							$this->db->query("INSERT INTO " . DB_PREFIX . "option_description SET option_id = '" . (int)$option_id . "', language_id = '" . (int)$filters['language_id'] . "', name = '" . $this->db->escape($product_option[0]) . "'");
								
							// new option add code 25-9-18
							
							$option_info = $this->db->query("SELECT o.option_id FROM " . DB_PREFIX . "option o left JOIN ". DB_PREFIX ."option_description od ON (o.option_id=od.option_id) WHERE od.name = '" . $this->db->escape(($product_option[0])) . "' AND o.type = '" . $this->db->escape($product_option[1]) . "'")->row;
						}
						
						if($option_info) {					
							
							if ($product_option[1] == 'select' || $product_option[1] == 'radio' || $product_option[1] == 'checkbox' || $product_option[1] == 'image') {
								if (isset($product_option[3])) {
									$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$id . "', option_id = '" . (int)$option_info['option_id'] . "', required = '" . (isset($product_option[2]) ? (int)$product_option[2] : '') . "'");

									$product_option_id = $this->db->getLastId();

									$product_option_values = (explode('||', $product_option[3])); 
									$product_option_values = array_map('trim', $product_option_values);
									
									foreach ($product_option_values as $product_option_value) {
										$product_option_value = (explode('!!', $product_option_value)); 
										$product_option_value = array_map('trim', $product_option_value);	

										$excel_option_value_name = (isset($product_option_value[0]) ? $product_option_value[0] : '');
										
										if($excel_option_value_name!="") {
											$fetch_option_value_description = $this->db->query("SELECT option_value_id, name FROM " . DB_PREFIX . "option_value_description WHERE option_id = '" . (int)$option_info['option_id'] . "' AND name = '" . $this->db->escape($excel_option_value_name) . "' AND language_id = '" . (int)$filters['language_id'] . "'")->row;
											
										}
										
										if(empty($fetch_option_value_description)){
											// new option add code 25-9-18											
											$fetch_option_value_description = array();
												
												$this->db->query("INSERT INTO " . DB_PREFIX . "option_value SET option_id = '" . (int)$option_info['option_id'] . "'");

												$option_value_id = $this->db->getLastId();
												
												$this->db->query("INSERT INTO " . DB_PREFIX . "option_value_description SET option_value_id = '" . (int)$option_value_id . "', language_id = '" . (int)$filters['language_id']  . "', option_id = '" .(int)$option_info['option_id'] . "', name = '" . $this->db->escape($excel_option_value_name) . "'");											
											
											// new option add code 25-9-18
											
											$fetch_option_value_description = $this->db->query("SELECT option_value_id, name FROM " . DB_PREFIX . "option_value_description WHERE option_id = '" . (int)$option_info['option_id'] . "' AND name = '" . $this->db->escape($excel_option_value_name) . "' AND language_id = '" . (int)$filters['language_id'] . "'")->row;
										}
										print_r($fetch_option_value_description);
										
										$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$id . "', option_id = '" . (int)$option_info['option_id'] . "', option_value_id = '" . (isset($fetch_option_value_description['option_value_id']) ? (int)$fetch_option_value_description['option_value_id'] : '') . "', quantity = '" . (isset($product_option_value[1]) ? (int)$product_option_value[1] : '') . "', subtract = '" . (isset($product_option_value[2]) ? (int)$product_option_value[2] : '') . "', price = '" . (isset($product_option_value[3]) ? (float)str_replace(',', '', $product_option_value[3]) : '') . "', price_prefix = '" . (isset($product_option_value[4]) ? $this->db->escape($product_option_value[4]) : '') . "', points = '" . (isset($product_option_value[5]) ? (int)$product_option_value[5] : '') . "', points_prefix = '" . (isset($product_option_value[6]) ? $this->db->escape($product_option_value[6]) : '') . "', weight = '" . (isset($product_option_value[7]) ? (float)str_replace(',', '', $product_option_value[7]) : '') . "', weight_prefix = '" . (isset($product_option_value[8]) ? $this->db->escape($product_option_value[8]) : '') . "'");
									}
								}
							}else {
								$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$id . "', option_id = '" . (int)$option_info['option_id'] . "', value = '" . (isset($product_option[3]) ? $this->db->escape($product_option[3]) : '') . "', required = '" . (isset($product_option[2]) ? (int)$product_option[2] : '') . "'");
							}
						}
						
					}
				}
			}
		}
		
		
		
		// Product Option end
		
		// Product Reward
		if(!empty($filters['checkfield']['reward'])) {
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$id . "'");

			if (!empty($data['reward_data']) && count($data['reward_data']) == 2) {
				if ((int)$data['reward_data'][1] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$id . "', customer_group_id = '" . (int)$data['reward_data'][0] . "', points = '" . (int)$data['reward_data'][1] . "'");
				}
			}
		}
		// Product Reward end
		
		// Product Reviews
		
		if(!empty($filters['review'])) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$id . "'");
			
			if (!empty($data['reviews'])) {
				foreach ($data['reviews'] as $review) { 
					$review = (explode('::', $review)); 
					$review = array_map('trim', $review);
					if (count($review) >= 5) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "review SET product_id = '" . (int)$id . "', customer_id = '" . (int)$review[0] . "', author = '" . $this->db->escape($review[1]) . "', text = '" . $this->db->escape($review[2]) . "', rating = '" . (int)$review[3] . "', status = '" . (int)$review[4] . "', date_added = '" . $this->db->escape($review[5]) . "', date_modified = '" . (isset($review[6]) ? $this->db->escape($review[6]) : '') . "'");
					}
				}
			}
		}
		
		// Product Reviews end
		
		// Product Custom Columns
		
		
		//	print_r($data['custom_columns_data']);
		if (!empty($data['custom_columns_data']) && !empty($filters['custom_columns'])) {		
			
			foreach ($data['custom_columns_data'] as $custom_column_data) {				
			// create columns
			$checkfieldsexist = $this->getNewColumns($custom_column_data['colname']);
								
			if(!$checkfieldsexist):
			
			$colquery=  "ALTER TABLE " . DB_PREFIX . "product ADD ". $custom_column_data['colname']."  TINYTEXT NOT NULL";
			
			$this->db->query($colquery);
			
			endif;	
		
			// create columns
			//			
				if(count($custom_column_data) >= 2):
					
						$this->db->query("UPDATE " . DB_PREFIX . "product SET ". $custom_column_data['colname'] ." = '" . (isset($custom_column_data['value']) ? $this->db->escape(($custom_column_data['value'])) : '') . "' WHERE product_id = '" . (int)$id . "'");
					
				endif;
			}
		}
		// Product Custom Columns end				
	}
	
	public function addProduct($data,$filters){				
		
		$sql = "INSERT INTO " . DB_PREFIX . "product SET ";

		$implode = array();

		if(!empty($filters['checkfield']['model'])) {
			$implode[] = " model = '" . $this->db->escape($data['model']) . "'";
		}

		if(!empty($filters['checkfield']['sku'])) {
			$implode[] = " sku = '" . $this->db->escape($data['sku']) . "'";
		}

		if(!empty($filters['checkfield']['upc'])) {
			$implode[] = " upc = '" . $this->db->escape($data['upc']) . "'";
		}
		if(!empty($filters['checkfield']['ean'])) {
			$implode[] = " ean = '" . $this->db->escape($data['ean']) . "'";
		}
		if(!empty($filters['checkfield']['jan'])) {
			$implode[] = " jan = '" . $this->db->escape($data['jan']) . "'";
		}
		if(!empty($filters['checkfield']['isbn'])) {
			$implode[] = " isbn = '" . $this->db->escape($data['isbn']) . "'";
		}
		if(!empty($filters['checkfield']['mpn'])) {
			$implode[] = " mpn = '" . $this->db->escape($data['mpn']) . "'";
		}
		if(!empty($filters['checkfield']['location'])) {
			$implode[] = " location = '" . $this->db->escape($data['location']) . "'";
		}
		if(!empty($filters['checkfield']['product_image'])) {
			$implode[] = " image = '" . $this->db->escape(($data['image'])) . "'";
		} 
		if(!empty($filters['checkfield']['quantity'])) {
			$implode[] = " quantity = '" . (int)$data['quantity'] . "'";
		}
		if(!empty($filters['checkfield']['minimum'])) {
			$implode[] = " minimum = '" . (int)$data['minimum'] . "'";
		}
		if(!empty($filters['checkfield']['subtract'])) {
			$implode[] = " subtract = '" . (int)$data['subtract'] . "'";
		}
		if(!empty($filters['checkfield']['stock_status_id'])) {
			$implode[] = " stock_status_id = '" . (int)$data['stock_status_id'] . "'";
		}
		if(!empty($filters['checkfield']['date_available'])) {
			$implode[] = " date_available = '" . $this->db->escape($data['date_available']) . "'";
		}

		if(!empty($filters['checkfield']['manufacturer_id'])) {
			if(!empty($data['manufacturer_id'])) {
				$implode[] = " manufacturer_id = '" . (int)$data['manufacturer_id'] . "'";
			} else if(!empty($data['manufacturer'])) {
				$manufacturer_info = $this->db->query("SELECT manufacturer_id FROM " . DB_PREFIX . "manufacturer WHERE name = '" . $this->db->escape($data['manufacturer']) . "'")->row;

				if($manufacturer_info) {
					$implode[] = " manufacturer_id = '" . (int)$manufacturer_info['manufacturer_id'] . "'";
				}

			}
		}

		if(!empty($filters['checkfield']['shipping'])) {
			$implode[] = " shipping = '" . (int)$data['shipping'] . "'";
		}
		if(!empty($filters['checkfield']['price'])) {
			$implode[] = " price = '" . (float)str_replace(',', '', $data['price']) . "'";
		}
		if(!empty($filters['checkfield']['reward_points'])) {
			$implode[] = " points = '" . (int)$data['reward_points'] . "'";
		}
		if(!empty($filters['checkfield']['weight'])) {
			$implode[] = " weight = '" . (float)str_replace(',', '', $data['weight']) . "'";
		}
		if(!empty($filters['checkfield']['weight_class_id'])) {
			$implode[] = " weight_class_id = '" . (int)$data['weight_class_id'] . "'";
		}
		if(!empty($filters['checkfield']['length'])) {
			$implode[] = " length = '" . (float)str_replace(',', '', $data['length']) . "'";
		}
		if(!empty($filters['checkfield']['width'])) {
			$implode[] = " width = '" . (float)str_replace(',', '', $data['width']) . "'";
		}
		if(!empty($filters['checkfield']['height'])) {
			$implode[] = " height = '" . (float)str_replace(',', '', $data['height']) . "'";
		}
		if(!empty($filters['checkfield']['length_class_id'])) {
			$implode[] = " length_class_id = '" . (int)$data['length_class_id'] . "'";
		}
		if(!empty($filters['checkfield']['status'])) {
			$implode[] = " status = '" . (int)$data['status'] . "'";
		}
		if(!empty($filters['checkfield']['tax_class_id'])) {
			$implode[] = " tax_class_id = '" . (int)$data['tax_class_id'] . "'";
		}
		if(!empty($filters['checkfield']['sort_order'])) {
			$implode[] = " sort_order = '" . (int)$data['sort_order'] . "'";
		}
		if(!empty($filters['checkfield']['viewed'])) {
			$implode[] = " viewed = '". $this->db->escape($data['viewed']) ."'";
		}
		if(!empty($filters['checkfield']['date_added'])) {
			$implode[] = " date_added = '". $this->db->escape($data['date_added']) ."'";
		}
		if(!empty($filters['checkfield']['date_modified'])) {
			$implode[] = " date_modified = '". $this->db->escape($data['date_modified']) ."'";
		}

		if(!$implode) {
			$implode[] = " date_modified = NOW() ";
		}

		if($implode) {			
			$sql .= implode(', ', $implode);
		}

		$this->db->query($sql);
		$id = $this->db->getLastId();

			
	// Product Description
			$sql = "INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$id . "', language_id = '" . (int)$filters['language_id']. "'";

			$implode = array();
			if(!empty($filters['checkfield']['product_name'])) {
				$implode[] = " name = '" . $this->db->escape(($data['product_name'])) . "'";
			}

			if(!empty($filters['checkfield']['description'])) {
				$implode[] = " description = '" . $this->db->escape(($data['description'])) . "'";
			}

			if(!empty($filters['checkfield']['meta_tag'])) {
				$implode[] = " tag = '" . $this->db->escape(($data['meta_tag'])) . "'";
			}
			
			if(!empty($filters['checkfield']['meta_title'])) {
				$implode[] = " meta_title = '" . $this->db->escape(($data['meta_title'])) . "'";
			}

			if(!empty($filters['checkfield']['meta_description'])) {
				$implode[] = " meta_description = '" . $this->db->escape(($data['meta_description'])) . "'";
			}
			if(!empty($filters['checkfield']['meta_keyword'])) {
				$implode[] = " meta_keyword = '" . $this->db->escape(($data['meta_keyword'])) . "'";
			}

			if($implode) {
				$sql .= ", ";
			}

			$sql .= implode(', ', $implode);
			$this->db->query($sql);
		
	//	Product Description end
	
	// Product keyword
				
		if (!empty($data['seo_keyword'])) {
			
				$i = 0;
				$this->load->model('catalog/url_alias');
				$seo_keyword = $data['seo_keyword'];
				do {
					$exists = false;
					$url_alias_info = $this->model_catalog_url_alias->getUrlAlias(($data['seo_keyword']));
					if (!empty($url_alias_info) && $url_alias_info['query'] != 'product_id=' . $id) {
						$data['seo_keyword'] = $seo_keyword.'-'. $i;
						
						$exists = true;
						$i++;
					}
				} while($exists);
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int)$id . "', keyword = '" . $this->db->escape(($data['seo_keyword'])) . "'");
			
		}
		
		// Product keyword end
		
		// Product Store	
		
			if (isset($filters['store']) && !empty($filters['checkfield']['store'])) {
				foreach ($filters['store'] as $store_id) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$id . "', store_id = '" . (int)$store_id . "'");
				}
			}		
		// Product Store End
				
		// Product Attribute
		
		if(!empty($filters['checkfield']['attribute_names'])) {
						
			if (!empty($data['attribute_names'])) {
				foreach ($data['attribute_names'] as $product_attribute) {
					$product_attribute = (explode('!!', $product_attribute)); 
					$product_attribute = array_map('trim', $product_attribute);
					
					if(count($product_attribute) == 3) {	
						
						$fetch_attribute_group = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_group_description  WHERE language_id = '" . (int)$filters['language_id'] . "' AND name = '". $product_attribute[0] ."'")->row;
						
						if(!empty($fetch_attribute_group)){
							$attribute_group_id = $fetch_attribute_group['attribute_group_id'];
						}
						
						if(empty($fetch_attribute_group)){
						
							$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_group SET sort_order = 0");

							$attribute_group_id = $this->db->getLastId();
							
								$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_group_description SET attribute_group_id = '" . (int)$attribute_group_id . "', language_id = '" . (int)$filters['language_id'] . "', name = '" . $this->db->escape( $product_attribute[0]) . "'");
						
						}
						
						$attribute_info = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "attribute_description WHERE name = '" . $this->db->escape(($product_attribute[1])) . "'")->row;
						if(!empty($attribute_info)){
							$attribute_id = $attribute_info['attribute_id'];
						}
						
						$fetch_attribute = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description  WHERE language_id = '" . (int)$filters['language_id'] . "' AND name = '". $product_attribute[1] ."'")->rows;
						
							
						if(empty($fetch_attribute)){
							
								$this->db->query("INSERT INTO " . DB_PREFIX . "attribute SET attribute_group_id = '" . (int)$attribute_group_id . "', sort_order = 0");

								$attribute_id = $this->db->getLastId();
								
								$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . (int)$filters['language_id'] . "', name = '" . $this->db->escape($product_attribute[1]) . "'");
						}	
						
						$attribute_info = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "attribute_description WHERE name = '" . $this->db->escape(($product_attribute[1])) . "'")->row;
						
						if (!empty($attribute_info)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$id . "', attribute_id = '" . (int)$attribute_info['attribute_id'] . "', language_id = '" . (int)$filters['language_id'] . "', text = '" .  $this->db->escape($product_attribute[2]) . "'");
						}
					}
				}
			}
			
		}
		
		// Product Attribute end
	
		// Product Discount		
		
		if (!empty($data['discount_offers']) && !empty($filters['checkfield']['discount_offers'])) {
			foreach ($data['discount_offers'] as $product_discount) {
				$product_discount = (explode('!!', $product_discount)); 
				$product_discount = array_map('trim', $product_discount);
				
				if(count($product_discount) == 6) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$id . "', customer_group_id = '" . (int)$product_discount[0] . "', quantity = '" . (int)$product_discount[1] . "', priority = '" . (int)$product_discount[2] . "', price = '" . (float)str_replace(',', '', $product_discount[3]) . "', date_start = '" . $this->db->escape($product_discount[4]) . "', date_end = '" . $this->db->escape($product_discount[5]) . "'");
				}
			}
		}
		
		// Product Discount end
		
		
		// Product Special	
		if (!empty($data['special_offers']) && !empty($filters['checkfield']['special'])) {
			foreach ($data['special_offers'] as $product_special) {
				$product_special = (explode('!!', $product_special)); 
				$product_special = array_map('trim', $product_special);
				
				if(count($product_special) == 5) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$id . "', customer_group_id = '" . (int)$product_special[0] . "', priority = '" . (int)$product_special[1] . "', price = '" . (float)str_replace(',', '', $product_special[2]) . "', date_start = '" . $this->db->escape($product_special[3]) . "', date_end = '" . $this->db->escape($product_special[4]) . "'");
				}
			}
		}
		// Product Special end
		
		// Product Image
		if(!empty($filters['images'])) {
			if (!empty($data['additional_images'])) {
				$product_image_sort_order = 0;
				foreach ($data['additional_images'] as $product_image) {
					$product_image = trim($product_image);
					if($product_image) {
						if((substr($product_image, 0, 7) == "http://" || substr($product_image, 0, 8) == "https://") && $this->file_contents_exist($product_image)) {
							
							$imageString = file_get_contents($product_image);
							
							$dir_name = 'catalog/saveimage/';
							$folder_name = DIR_IMAGE. $dir_name;
							
							$this->makeFolder($folder_name);

							$filename = basename(html_entity_decode($product_image, ENT_QUOTES, 'UTF-8'));

							$filename = str_replace(array(' ', '&nbsp;', '%20'), '_', $filename);

							if(file_exists($folder_name . $filename)) {
								$pathinfo_file = pathinfo($folder_name . $filename);
								if($pathinfo_file) {
									$final_file = $pathinfo_file['filename'] .'_'. time().rand(0,1000) .'.'.$pathinfo_file['extension'];
								} else{
									$final_file = $filename;
								}
							} else{
								$final_file = $filename;
							}

							$save = file_put_contents($folder_name . $final_file, $imageString);
							$product_image = $dir_name . $final_file;
						}
						
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$id . "', image = '" . $this->db->escape($product_image) . "', sort_order = '" . (int)$product_image_sort_order . "'");
					}
					
					$product_image_sort_order++; 
				}
			}
		}
		// Product Image
		
		// Product Downloads
		if (!empty($data['download_names']) && !empty($filters['checkfield']['download'])) {
			foreach ($data['download_names'] as $product_download) {
				$product_download = trim($product_download);
				if($product_download) {
					
					$download_info = $this->db->query("SELECT download_id FROM " . DB_PREFIX . "download_description WHERE name = '" . $this->db->escape(($product_download)) . "'")->row;
					if($download_info) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$id . "', download_id = '" . (int)$download_info['download_id'] . "'");
					}
				}
			}
		}
		// Product Downloads end
		
		// Product Category
		if(!empty($filters['checkfield']['category_ids'])) {						
			if (!empty($data['categories_ids'])) {
				foreach ($data['categories_ids'] as $category_id) {
					$category_id = trim($category_id);
					if($category_id) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$id . "', category_id = '" . (int)$category_id . "'");
					}
				}
			} else if (!empty($data['category_name'])) {
				foreach ($data['category_name'] as $category_name) {
					$category_name = explode('&gt;', $category_name);
					$category_name = end($category_name);
					$category_name = trim(str_replace('&nbsp;',' ', htmlentities($category_name)));
					
					$category_info = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category_description WHERE name = '" . $this->db->escape($category_name) . "' AND language_id = '" . (int)$filters['language_id'] . "'")->row;

					if($category_info) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$id . "', category_id = '" . (int)$category_info['category_id'] . "'");
					}
				}				
			}
		}
		// Product Category end
		
		// Product Filter		
		if(!empty($filters['checkfield']['filter_names']) && !empty($data['filter_names'])) {
			
						
			foreach ($data['filter_names'] as $filter) {
				$filter = trim($filter);
				if($filter) {
					$filter_data = (explode('~', $filter)); 
					$filter_data = array_map('trim', $filter_data);
					if(count($filter_data) == 2) {						
						$filter_group_info = $this->db->query("SELECT filter_group_id FROM " . DB_PREFIX . "filter_group_description WHERE name = '" . $this->db->escape(($filter_data[0])) . "'")->row;
						if($filter_group_info) {							
							$filter_info = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "filter_description WHERE name = '" . $this->db->escape(($filter_data[1])) . "' AND filter_group_id = '". (int)$filter_group_info['filter_group_id'] ."'")->row;
							if($filter_info) {
								$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$id . "', filter_id = '" . (int)$filter_info['filter_id'] . "'");
							}
						}
					}
				}
			}			
		}
		// Product Filter end
		
		// Product Related		
		if(!empty($filters['checkfield']['related_products']) && !empty($data['related_products'])) {
			// Product Related
				foreach ($data['related_products'] as $related_id) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$id . "', related_id = '" . (int)$related_id . "'");
				}
			
		}
		// Product Related end
		
		// Product Option 
		
		if(!empty($filters['checkfield']['options'])) {
						
			if (!empty($data['options_data'])) {
				foreach ($data['options_data'] as $product_option) {
					$product_option = (explode(';;', $product_option)); 
					$product_option = array_map('trim', $product_option);
					
					
					if(count($product_option) >= 3) {
						$option_info = $this->db->query("SELECT o.option_id FROM " . DB_PREFIX . "option o left JOIN ". DB_PREFIX ."option_description od ON (o.option_id=od.option_id) WHERE od.name = '" . $this->db->escape(($product_option[0])) . "' AND o.type = '" . $this->db->escape($product_option[1]) . "'")->row;
						
						if(!$option_info) {
							// new option add code 25-9-18
							
							$this->db->query("INSERT INTO `" . DB_PREFIX . "option` SET type = '" . $this->db->escape($product_option[1]) . "'");

							$option_id = $this->db->getLastId();
							
							$this->db->query("INSERT INTO " . DB_PREFIX . "option_description SET option_id = '" . (int)$option_id . "', language_id = '" . (int)$filters['language_id'] . "', name = '" . $this->db->escape($product_option[0]) . "'");
								
							// new option add code 25-9-18
							
							$option_info = $this->db->query("SELECT o.option_id FROM " . DB_PREFIX . "option o left JOIN ". DB_PREFIX ."option_description od ON (o.option_id=od.option_id) WHERE od.name = '" . $this->db->escape(($product_option[0])) . "' AND o.type = '" . $this->db->escape($product_option[1]) . "'")->row;
						}
						
						if($option_info) {					
							
							if ($product_option[1] == 'select' || $product_option[1] == 'radio' || $product_option[1] == 'checkbox' || $product_option[1] == 'image') {
								if (isset($product_option[3])) {
									$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$id . "', option_id = '" . (int)$option_info['option_id'] . "', required = '" . (isset($product_option[2]) ? (int)$product_option[2] : '') . "'");

									$product_option_id = $this->db->getLastId();

									$product_option_values = (explode('||', $product_option[3])); 
									$product_option_values = array_map('trim', $product_option_values);
									
									foreach ($product_option_values as $product_option_value) {
										$product_option_value = (explode('!!', $product_option_value)); 
										$product_option_value = array_map('trim', $product_option_value);	

										$excel_option_value_name = (isset($product_option_value[0]) ? $product_option_value[0] : '');
										
										if($excel_option_value_name!="") {
											$fetch_option_value_description = $this->db->query("SELECT option_value_id, name FROM " . DB_PREFIX . "option_value_description WHERE option_id = '" . (int)$option_info['option_id'] . "' AND name = '" . $this->db->escape($excel_option_value_name) . "' AND language_id = '" . (int)$filters['language_id'] . "'")->row;
											
										}
										
										if(empty($fetch_option_value_description)){
											// new option add code 25-9-18											
											$fetch_option_value_description = array();
												
												$this->db->query("INSERT INTO " . DB_PREFIX . "option_value SET option_id = '" . (int)$option_info['option_id'] . "'");

												$option_value_id = $this->db->getLastId();
												
												$this->db->query("INSERT INTO " . DB_PREFIX . "option_value_description SET option_value_id = '" . (int)$option_value_id . "', language_id = '" . (int)$filters['language_id']  . "', option_id = '" .(int)$option_info['option_id'] . "', name = '" . $this->db->escape($excel_option_value_name) . "'");											
											
											// new option add code 25-9-18
											
											$fetch_option_value_description = $this->db->query("SELECT option_value_id, name FROM " . DB_PREFIX . "option_value_description WHERE option_id = '" . (int)$option_info['option_id'] . "' AND name = '" . $this->db->escape($excel_option_value_name) . "' AND language_id = '" . (int)$filters['language_id'] . "'")->row;
										}
										print_r($fetch_option_value_description);
										
										$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$id . "', option_id = '" . (int)$option_info['option_id'] . "', option_value_id = '" . (isset($fetch_option_value_description['option_value_id']) ? (int)$fetch_option_value_description['option_value_id'] : '') . "', quantity = '" . (isset($product_option_value[1]) ? (int)$product_option_value[1] : '') . "', subtract = '" . (isset($product_option_value[2]) ? (int)$product_option_value[2] : '') . "', price = '" . (isset($product_option_value[3]) ? (float)str_replace(',', '', $product_option_value[3]) : '') . "', price_prefix = '" . (isset($product_option_value[4]) ? $this->db->escape($product_option_value[4]) : '') . "', points = '" . (isset($product_option_value[5]) ? (int)$product_option_value[5] : '') . "', points_prefix = '" . (isset($product_option_value[6]) ? $this->db->escape($product_option_value[6]) : '') . "', weight = '" . (isset($product_option_value[7]) ? (float)str_replace(',', '', $product_option_value[7]) : '') . "', weight_prefix = '" . (isset($product_option_value[8]) ? $this->db->escape($product_option_value[8]) : '') . "'");
									}
								}
							}else {
								$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$id . "', option_id = '" . (int)$option_info['option_id'] . "', value = '" . (isset($product_option[3]) ? $this->db->escape($product_option[3]) : '') . "', required = '" . (isset($product_option[2]) ? (int)$product_option[2] : '') . "'");
							}
						}
						
					}
				}
			}
		}
		
		// Product Option end
		
		// Product Reward
	 if (!empty($data['reward_data']) && count($data['reward_data']) == 2 && !empty($filters['checkfield']['reward'])) {
									
			if ((int)$data['reward_data'][1] > 0) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$id . "', customer_group_id = '" . (int)$data['reward_data'][0] . "', points = '" . (int)$data['reward_data'][1] . "'");
			}
			
		}
		// Product Reward end
		
		// Product Reviews
		
		if(!empty($filters['review'])) {			
			if (!empty($data['reviews'])) {
				foreach ($data['reviews'] as $review) { 
					$review = (explode('::', $review)); 
					$review = array_map('trim', $review);
					if (count($review) >= 5) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "review SET product_id = '" . (int)$id . "', customer_id = '" . (int)$review[0] . "', author = '" . $this->db->escape($review[1]) . "', text = '" . $this->db->escape($review[2]) . "', rating = '" . (int)$review[3] . "', status = '" . (int)$review[4] . "', date_added = '" . $this->db->escape($review[5]) . "', date_modified = '" . (isset($review[6]) ? $this->db->escape($review[6]) : '') . "'");
					}
				}
			}
		}
		
		// Product Reviews end
		
		// Product Custom Columns
		
		
		//	print_r($data['custom_columns_data']);
		if (!empty($data['custom_columns_data']) && !empty($filters['custom_columns'])) {		
			
			foreach ($data['custom_columns_data'] as $custom_column_data) {
				
			// create columns
			$checkfieldsexist = $this->getNewColumns($custom_column_data['colname']);
			
		
			
			if(!$checkfieldsexist):
			
			$colquery=  "ALTER TABLE " . DB_PREFIX . "product ADD ". $custom_column_data['colname']."  TINYTEXT NOT NULL";
			
			$this->db->query($colquery);
			
			endif;
			
		
			// create columns
			//
			
				if(count($custom_column_data) >= 2) {
					
						$this->db->query("UPDATE " . DB_PREFIX . "product SET ". $custom_column_data['colname'] ." = '" . (isset($custom_column_data['value']) ? $this->db->escape(($custom_column_data['value'])) : '') . "' WHERE product_id = '" . (int)$id . "'");
					
				}
			}
		}
		// Product Custom Columns end				
	}	
	
	// 2-JULY category addition
	public function getCategoryByName($categoryname,$languge_id) {
				
		$category_info = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "category_description WHERE name = '" . $this->db->escape($categoryname) . "' AND language_id = '" . (int)$languge_id . "'")->row;
		
		if(!$category_info){
			return 0;
		} else {
			return $category_info['category_id'];
		}
		//echo "no";
		
	}
	
		public function addCategory($data) {
			
			print_r($data);
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$category_id = $this->db->getLastId();

		

		foreach ($data['category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "category_path` WHERE category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', `level` = '" . (int)$level . "'");

		

		if (isset($data['category_store'])) {
			foreach ($data['category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "category_to_store SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}	

		return $category_id;
	}
	
	// 2-JULY category addition
	
	// file function setting
		 public function file_contents_exist($url) {

        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($httpCode >= 200 && $httpCode <= 400) {
            return true;
        } else {
            return false;
        }

        curl_close($handle);
    }
	// file function setting
	
	public function makeFolder($dir,$permission=0777) {
		if(!is_dir($dir)) {
			$oldmask = umask(0);
			mkdir($dir, $permission);
			umask($oldmask);
		}
	}

	public function file_contents_exist_old($url, $response_code = 200) {
		  $headers = get_headers($url);
	    if (substr($headers[0], 9, 3) == $response_code)
	    {
	    	return true;
	    }
	    else
	    {
	        return false;
	    }
	}
	
}