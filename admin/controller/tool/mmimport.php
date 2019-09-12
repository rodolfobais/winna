<?php
class ControllertoolMmimport extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tool/mmimport');
 
	//	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tool/mmimport');
		$this->load->model('catalog/product');		
		
	//	$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_form');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_pro_id'] = $this->language->get('text_pro_id');
		$data['text_model'] = $this->language->get('text_model');
	

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_store'] = $this->language->get('entry_store');	
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_format'] = $this->language->get('entry_format');
		$data['entry_product_id'] = $this->language->get('entry_product_id');
		$data['entry_productfile'] = $this->language->get('entry_productfile');
		$data['entry_product_start'] = $this->language->get('entry_product_start');
		$data['entry_language'] = $this->language->get('entry_language');
		$data['text_allstock'] = $this->language->get('text_allstock');
		$data['text_allstatus'] = $this->language->get('text_allstatus');
		$data['text_allstore'] = $this->language->get('text_allstore');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');

		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_custcolumn'] = $this->language->get('entry_custcolumn');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_importby'] = $this->language->get('entry_importby');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');

		$data['help_keyword'] = $this->language->get('help_keyword');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_import'] = $this->language->get('button_import');
		$data['button_selectall'] = $this->language->get('button_selectall');
		$data['button_deselectall'] = $this->language->get('button_deselectall');
		
		
		$data['token'] = $this->session->data['token'];
		
		$data['importlink'] =$this->url->link('tool/mmimport/import', 'token=' . $this->session->data['token'], true);
		

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		
		$url = '';		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tool/mmimport', 'token=' . $this->session->data['token'], true)
		);

		// Fetching Form-data
		
			$this->load->model('setting/store');
			$this->load->model('localisation/language');
			$this->load->model('localisation/stock_status');
			
			
			$data['stores'] = $this->model_setting_store->getStores();			
			$data['languages'] = $this->model_localisation_language->getLanguages();
			$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
			
		
		// Fetching Form-data
		
		 				
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

	//	$this->response->setOutput($this->load->view('tool/mmimport.tpl', $data));
		return $this->load->view('tool/mmimport.tpl', $data);

	}
	
	public function import(){				
				
		require_once(DIR_SYSTEM.'PHPExcel/classes/PHPExcel.php');
			
			
		$this->load->language('tool/mmimport');		
		$this->load->model('tool/mmimport');
		$this->load->model('setting/store');
	
	
	//file validation
	
	if($this->request->files['productfile']['error']!=0):	
		$this->response->redirect($this->url->link('tool/mmexport', 'token=' . $this->session->data['token'] ,true));
		
	endif;	
	
		$path =  $this->request->files['productfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		
		if(!in_array($ext, array('xls','xlsx','csv'))) {
				$this->response->redirect($this->url->link('tool/mmexport', 'token=' . $this->session->data['token'] ,true));
			}
	
		//print_r($this->request->files);
	
	//file validation
		

	
		if($this->request->files){
			$file = $this->request->files['productfile']['name'];
			
			
			//
			
			move_uploaded_file($this->request->files['productfile']['tmp_name'], $file);
		}
		
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		
		$extension = strtolower(strtoupper($extension));
		
		if($extension=='xlsx' || $extension=='xls' || $extension=='csv') {
			
			if($extension=='csv') {
				$objReader  = PHPExcel_IOFactory::createReader('CSV');
				$objPHPExcel = $objReader->load($file);
			}else{
				$objPHPExcel = PHPExcel_IOFactory::load($file);
			}
						
		}
				
		// Columns Filters 
		
		if(isset($this->request->post['checkfield'])){
			$Excelcellsimport = $this->request->post['checkfield'];
		}else{
			$Excelcellsimport = "";
			$this->response->redirect($this->url->link('tool/mmexport', 'token=' . $this->session->data['token'] ,true));
		}	
		
				
		// Columns Filters 
	
		
			
		if(isset($this->request->post['filter_store'])){
			$filter_store = $this->request->post['filter_store'];
		}else{
			$filter_store = array();
		}	
		
		if(isset($this->request->post['filter_language_id'])){
			$filter_language_id = $this->request->post['filter_language_id'];
		}else{
			$filter_language_id = "";
		}
		
		if(isset($this->request->post['filter_reviews'])){
			$filter_reviews = $this->request->post['filter_reviews'];
		}else{
			$filter_reviews = "";
		}
		
		if(isset($this->request->post['filter_images'])){
			$filter_images = $this->request->post['filter_images'];
		}else{
			$filter_images = "";
		}
		
		if(isset($this->request->post['filter_custcolumn'])){
			$filter_custcolumn = $this->request->post['filter_custcolumn'];
		}else{
			$filter_custcolumn = "";
		}
		
		if(isset($this->request->post['filter_importby'])){
			$filter_importby = $this->request->post['filter_importby'];
		}else{
			$filter_importby = "";
		}
	
		
		
			
		$fitler_data = array(		
			
			'store'				=> $filter_store,
			'language_id' 		=> $filter_language_id,
			'review'			=> $filter_reviews,			
			'checkfield' 		=> $Excelcellsimport,			
			'images'			=> $filter_images,
			'custom_columns'	=> $filter_custcolumn,
		
		);
		

		
		$filter_custom_columns = 1;
		$static_columns = 58;
		
		$FullSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		//echo "<pre>";
		//print_r($FullSheet);die();
		
		$k=0;
			
		
		if(count($FullSheet)>1):
			foreach($FullSheet as $record):	
				
			// custom columns name
				
				if(count($FullSheet)>1):

				if($k == '0' && $filter_custom_columns) {
					
					$custom_columns_keys = array();
					$custom_fields_columns = array();
				
					$total_colmns = count($record);
					
					
					if($total_colmns > $static_columns) {					
						
						$custom_fields_columnss  = array_slice($record, $static_columns, $total_colmns);
						
						foreach($custom_fields_columnss as $columnkey => $custom_fields_column_field) {
							
							$fieldnames = $custom_fields_column_field;
							
							if(!empty($fieldnames)) {
								$columns_info = $this->model_tool_mmimport->getNewColumns($fieldnames);	
						
							
								if(isset($columns_info)) {
									$custom_fields_columns[$columnkey] = $fieldnames;
								}
							}
						}
						
						$custom_columns_keys = array_keys($custom_fields_columns);							
					}
				}

			
				endif;
				
			// Custom Columns name
		

				if($k!=0):
				
				$importrow['product_id'] = $record['A'];
				$importrow['product_name'] = $record['B'];
				$importrow['model'] = $record['C'];
				$importrow['language'] = $record['D'];
				$importrow['status'] = $record['E'];
				$importrow['store'] =(isset($record['F']) ? explode(';;', $record['F']) : '');
				$importrow['sku'] = $record['G'];
				$importrow['upc'] = $record['H'];
				$importrow['ean'] = $record['I'];
				$importrow['jan'] = $record['J'];
				$importrow['isbn'] = $record['K'];
				$importrow['mpn'] = $record['L'];
				$importrow['location'] = $record['M'];
				$importrow['manufacturer_id'] = $record['N'];
				$importrow['reward_points'] = $record['O'];
				
				$importrow['date_available'] = (!empty($record['P']) ?  date('Y-m-d', strtotime($record['P'])) : '');	
				
				$importrow['language_id'] = $record['Q'];
				$importrow['description'] = $record['R'];
				$importrow['meta_tag'] = $record['S'];
				$importrow['meta_title'] = $record['T'];
				$importrow['meta_description'] = $record['U'];
				$importrow['meta_keyword'] = $record['V'];
				$importrow['image'] = $record['W'];
				
				 if($importrow['image']!="") {
					if((substr($importrow['image'], 0, 7) == "http://" || substr($importrow['image'], 0, 8) == "https://") && $this->model_tool_mmimport->file_contents_exist($importrow['image'])) {
						  $imageString = file_get_contents($importrow['image']);
						
						$dir_name = 'catalog/saveimage/';
						$folder_name = DIR_IMAGE. $dir_name;
						
						$this->model_tool_mmimport->makeFolder($folder_name);
						
						$filename = basename(html_entity_decode($importrow['image'], ENT_QUOTES, 'UTF-8'));

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
						$importrow['image'] = $dir_name . $final_file;
					}
				}
			
						
				$importrow['price'] = $record['X'];
				$importrow['minimum'] = $record['Y'];
				$importrow['quantity'] = $record['Z'];
				$importrow['sort_order'] = $record['AA'];
				$importrow['tax_class_id'] = $record['AB'];
				$importrow['tax class'] = $record['AC'];
				$importrow['subtract'] = $record['AD'];
				$importrow['stock_status_id'] = $record['AE'];
				$importrow['stock_status'] = $record['AF'];
				$importrow['shipping'] = $record['AG'];
				$importrow['seo_keyword'] = $record['AH'];
				$importrow['length'] = $record['AI'];
				$importrow['length_class_id'] = $record['AJ'];
				$importrow['length_class'] = $record['AK'];
				$importrow['width'] = $record['AL'];
				$importrow['height'] = $record['AM'];
				$importrow['weight'] = $record['AN'];
				$importrow['weight_class_id'] = $record['AO'];
				$importrow['weight_class'] = $record['AP'];
				$importrow['manufacturer'] = $record['AQ'];
				$importrow['categories_ids'] = (!empty($record['AR']) ? explode(',', $record['AR']) : '');
				$importrow['category_name'] = (isset($record['AS']) ? explode(';', $record['AS']) : '');
				$importrow['filter_names'] = (isset($record['AT']) ? explode(';;', $record['AT']) : '');
				$importrow['download_names'] = (isset($record['AU']) ? explode(';;', $record['AU']) : '');
				$importrow['related_products'] = (isset($record['AV']) ? explode(',', $record['AV']) : '');
				$importrow['attribute_names'] = (isset($record['AW']) ? explode(';', $record['AW']) : '');
				$importrow['options_data'] = (isset($record['AX']) ? explode(':', $record['AX']) : '');
				$importrow['discount_offers'] = (isset($record['AY']) ? explode(';', $record['AY']) : '');
				$importrow['reward_data'] =  (isset($record['AZ']) ? explode('!!', $record['AZ']) : '');
				$importrow['viewed'] = $record['BA'];				
				$importrow['special_offers'] = (isset($record['BB']) ? explode(';', $record['BB']) : '');		
				$importrow['additional_images'] = (isset($record['BC']) ? explode('!!', $record['BC']) : '');
				$importrow['reviews'] = (isset($record['BD']) ? explode('!!', $record['BD']) : '');
				$importrow['date_added'] = (!empty($record['BE']) ?  date('Y-m-d H:i:s', strtotime($record['BE'])) : date('Y-m-d H:i:s'));				
				$importrow['date_modified'] =  (!empty($record['BF']) ?  date('Y-m-d H:i:s', strtotime($record['BF'])) : date('Y-m-d H:i:s'));
				
				
				// Category insertion 2-july-18 start
				
				
				//print_r($importrow['category_name']);
				
				//$importrow['categories_ids'] =  array();
					
					if(!empty($importrow['category_name'])){
						foreach($importrow['category_name'] as $cname){
							
							$cname = explode('>', $cname);
							
							$ccount = count($cname);
							$c=1;
							$parent = 0;
							
							
							foreach($cname as $catname){
								
								$catname = trim(str_replace('&nbsp;',' ', htmlentities($catname)));
								$cexist = $this->model_tool_mmimport->getCategoryByName(trim($catname),$filter_language_id);
								$lastelement = trim(str_replace('&nbsp;',' ', htmlentities(end($cname))));
								if($cexist==0){
									echo "reach";
									$category_description[$filter_language_id] = array(
									
										'name' => $catname,
										'description' => $catname,
										'meta_title' => $catname,
										'meta_description' => $catname,
										'meta_keyword' => $catname,
									
									);
									
									$add_data = array(
										
										'parent_id' => $parent,
										'column' =>	0,
										'sort_order' =>	0,
										'status' =>	1,
										'category_store' =>	$filter_store,
										'category_description' =>	$category_description,										
										
									);
									
									$cid = $this->model_tool_mmimport->addCategory($add_data);
									$parent=$cid;
									
									if($lastelement==$catname){
										echo "ok";
										array_push($importrow['categories_ids'],$cid);									
									}
									
								} else{
									
									$parent = $cexist;
									echo $cexist."cc";
									if($lastelement==$catname){
										if (!in_array($cexist, $importrow['categories_ids'])){
											array_push($importrow['categories_ids'],$cexist);
										}
									}
									
								}
								
							}
							
						}
					}
				
				//die();
				if(!empty($importrow['categories_ids'])){
					$importrow['categories_ids'] = array_unique($importrow['categories_ids']);
				}
				// Category insertion 2-july-18 end
				
		
				// Custom Fields
					$importrow['custom_columns_data'] = array();
					if(!empty($custom_columns_keys) && $filter_custom_columns) {
						foreach($custom_columns_keys as $custom_columns_key) {
							$colname = $custom_fields_columns[$custom_columns_key];
							
							if(!empty($colname)) {
								$importrow['custom_columns_data'][] = array(
									
									'colname'		=> $colname,
									'value'			=> $record[$custom_columns_key],
								);
							}
						}
					}
				
					
					
			// product existence
				$filter_pedata =  array(
					'name' => $importrow['product_name'], 
					//'language_id' => $language_id	
					'language_id' => $filter_language_id
	
				);
			
			if($filter_importby=="product_id"){
				$product_existence = $this->model_tool_mmimport->getProductExistById($importrow['product_id']);
			}
			
			if($filter_importby=="model"){
				$product_existence = $this->model_tool_mmimport->getProductExistByModel($importrow['model']);
			}
					
			//	$product_existence = $this->model_tool_mmimport->getProductExistByName($filter_pedata);
				
		
				// product existance
				
				if($product_existence):
					
						$this->model_tool_mmimport->updateProduct($product_existence['product_id'],$importrow,$fitler_data);
				else:
				
					if($filter_importby == 'model') {
								
								$product_check_excelid = $this->model_tool_mmimport->getProductExistById($importrow['product_id']);
								if($product_check_excelid) {
									$importrow['product_id'] = '';
								}
							}
						$this->model_tool_mmimport->addProduct($importrow, $fitler_data);
					endif;
				
				endif;
				$k++;
			endforeach;			
			
		endif;
		//success link
		$this->response->redirect($this->url->link('tool/mmexport', 'token=' . $this->session->data['token'] ,true));
		//success link
	}	
	
}