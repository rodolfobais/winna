<?php
set_time_limit(0);

ini_set('memory_limit', '999M');
ini_set('set_time_limit', '0');
class ControllertoolMmexport extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tool/mmexport');
 
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tool/mmexport');
		$this->load->model('catalog/product');		
		
		$data['heading_title'] = $this->language->get('heading_title');

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
		$data['text_xls'] = $this->language->get('text_xls');
		$data['text_xlsx'] = $this->language->get('text_xlsx');
		$data['text_csv'] = $this->language->get('text_csv');
		$data['text_xml'] = $this->language->get('text_xml');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_extrafld'] = $this->language->get('entry_extrafld');
		$data['entry_pimages'] = $this->language->get('entry_pimages');
		$data['entry_imgfullurl'] = $this->language->get('entry_imgfullurl');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_format'] = $this->language->get('entry_format');
		$data['entry_product_id'] = $this->language->get('entry_product_id');
		$data['entry_product_start'] = $this->language->get('entry_product_start');
		$data['entry_language'] = $this->language->get('entry_language');
		$data['text_allstock'] = $this->language->get('text_allstock');
		$data['text_allstatus'] = $this->language->get('text_allstatus');
		$data['text_allstore'] = $this->language->get('text_allstore');
		$data['text_noofproduct'] = $this->language->get('text_noofproduct');
		$data['text_start'] = $this->language->get('text_start');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');

		$data['help_keyword'] = $this->language->get('help_keyword');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_export'] = $this->language->get('button_export');
		
		$data['tab_export'] = $this->language->get('tab_export');
		$data['tab_import'] = $this->language->get('tab_import');
		$data['tab_support'] = $this->language->get('tab_support');
		$data['tab_howtouse'] = $this->language->get('tab_howtouse');
		
		
		$data['allcustom_columns'] = $this->model_tool_mmexport->getCustomColumn();
	
		$data['Total_products'] = $this->model_catalog_product->getTotalProducts(array());
		$data['token'] = $this->session->data['token'];
		
		$data['loadingimg'] = 'view/image/mmloading4.gif';	
	

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
			'href' => $this->url->link('tool/mmexport', 'token=' . $this->session->data['token'], true)
		);

		// Fetching Form-data
		
			$this->load->model('setting/store');
			$this->load->model('localisation/language');
			$this->load->model('localisation/stock_status');
			
			
			$data['stores'] = $this->model_setting_store->getStores();			
			$data['languages'] = $this->model_localisation_language->getLanguages();
			$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
			
		
		// Fetching Form-data
		
		$data['exportlink'] =$this->url->link('tool/mmexport/export', 'token=' . $this->session->data['token'], true); 		
		
		$data['importsss'] =	$this->load->controller('tool/mmimport');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tool/mmexport.tpl', $data));




	}
	
	public function export(){
	
			$this->load->language('tool/mmexport');		
			$this->load->model('tool/mmexport');
			$this->load->model('setting/store');
		
			
		require_once(DIR_SYSTEM.'PHPExcel/classes/PHPExcel.php');
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
	
//	Filter Data	
		if(isset($this->request->post['filter_store_id']) && $this->request->post['filter_store_id'] != '') {
			$filter_store_id = $this->request->post['filter_store_id'];
		}else{
			$filter_store_id = null;
		}
		
		if(isset($this->request->post['filter_language_id']) && $this->request->post['filter_language_id'] != '') {
			$filter_language_id = $this->request->post['filter_language_id'];
		}else{
			$filter_language_id = null;
		}
		
		if(isset($this->request->post['filter_quantity_start']) && $this->request->post['filter_quantity_start'] != '') {
			$filter_quantity_start = $this->request->post['filter_quantity_start'];
		}else{
			$filter_quantity_start = '';
		}
		
		if(isset($this->request->post['filter_quantity_limit']) && $this->request->post['filter_quantity_limit'] != '') {
			$filter_quantity_limit = $this->request->post['filter_quantity_limit'];
		}else{
			$filter_quantity_limit = '';
		}
		
		if(isset($this->request->post['filter_product_ids']) && $this->request->post['filter_product_ids'] != '') {
			$filter_product_ids = $this->request->post['filter_product_ids'];
		}else{
			$filter_product_ids = '';
		}
		
		if(isset($this->request->post['filter_product_idl']) && $this->request->post['filter_product_idl'] != '') {
			$filter_product_idl = $this->request->post['filter_product_idl'];
		}else{
			$filter_product_idl = '';
		}
		
		if(isset($this->request->post['filter_price_start']) && $this->request->post['filter_price_start'] != '') {
			$filter_price_start = $this->request->post['filter_price_start'];
		}else{
			$filter_price_start = '';
		}
		
		if(isset($this->request->post['filter_price_limit']) && $this->request->post['filter_price_limit'] != '') {
			$filter_price_limit = $this->request->post['filter_price_limit'];
		}else{
			$filter_price_limit = '';
		}
		
		if(isset($this->request->post['filter_product_start']) && $this->request->post['filter_product_start'] != '') {
			$filter_product_start = $this->request->post['filter_product_start'];
		}else{
			$filter_product_start = '';
		}
		
		if(isset($this->request->post['filter_product_limit']) && $this->request->post['filter_product_limit'] != '') {
			$filter_product_limit = $this->request->post['filter_product_limit'];
		}else{
			$filter_product_limit = '';
		}
		
		
		
		if(isset($this->request->post['filter_status']) && $this->request->post['filter_status'] != '') {
			$filter_status = $this->request->post['filter_status'];
		}else{
			$filter_status = null;
		}
		
		if(isset($this->request->post['filter_stock_status_id']) && $this->request->post['filter_stock_status_id'] != '') {
			$filter_stock_status_id = $this->request->post['filter_stock_status_id'];
		}else{
			$filter_stock_status_id = null;
		}
		
		
		if(isset($this->request->post['filter_model']) && $this->request->post['filter_model'] != '') {
			$filter_model = $this->request->post['filter_model'];
		}else{
			$filter_model = null;
		}
		
		if(isset($this->request->post['filter_product']) && $this->request->post['filter_product'] != '') {
			$filter_product = $this->request->post['filter_product'];
		}else{
			$filter_product = null;
		}
		
		if(isset($this->request->post['filter_manufacturer']) && $this->request->post['filter_manufacturer'] != '') {
			$filter_manufacturer = $this->request->post['filter_manufacturer'];
		}else{
			$filter_manufacturer = null;
		}
		
		if(isset($this->request->post['filter_category']) && $this->request->post['filter_category'] != '') {
			$filter_category = $this->request->post['filter_category'];
		}else{
			$filter_category = null;
		}
		
		if(isset($this->request->post['custom_columns']) && $this->request->post['custom_columns'] != '') {
			$custom_columns = $this->request->post['custom_columns'];
		}else{
			$custom_columns = array();
		}
		
		if(isset($this->request->post['filter_image']) && $this->request->post['filter_image'] != '') {
			$filter_image = $this->request->post['filter_image'];
		}else{
			$filter_image = null;
		}
		
		if(isset($this->request->post['filter_review']) && $this->request->post['filter_review'] != '') {
			$filter_review = $this->request->post['filter_review'];
		}else{
			$filter_review = null;
		}
		
		if(isset($this->request->post['imgfullurl']) && $this->request->post['imgfullurl'] != '') {
			$imgfullurl = $this->request->post['imgfullurl'];
		}else{
			$imgfullurl = null;
		}
		
		if(isset($this->request->post['file_format']) && $this->request->post['file_format'] != '') {
			$file_format = $this->request->post['file_format'];
		}else{
			$file_format = null;
		}
		
				
		$filter_extrafields = array();
		$allcustom_columns = $this->model_tool_mmexport->getCustomColumn();
		
		
		foreach ($allcustom_columns as $allcustom_column) {
			
			if(in_array($allcustom_column,$custom_columns)){
				$filter_extrafields[] = $allcustom_column;
			}
			
		}
		
	//	print_r($filter_extrafields);die();
	
		$filter_data = array(
		
			 'filter_store_id'				=> $filter_store_id,
			 'filter_language_id'			=> $filter_language_id,
			 'filter_model'					=> $filter_model,
			 'filter_status'				=> $filter_status,
			 'filter_quantity_start'		=> $filter_quantity_start,
			 'filter_quantity_limit'		=> $filter_quantity_limit,
			 'filter_price_start'			=> $filter_price_start,
			 'filter_price_limit'			=> $filter_price_limit,
			 'filter_product_start'			=> $filter_product_start,
			 'filter_product_limit'			=> $filter_product_limit,
			 'filter_stock_status_id'		=> $filter_stock_status_id,
			 'filter_product'				=> $filter_product,
			 'filter_manufacturer'			=> $filter_manufacturer,
			 'filter_category'				=> $filter_category,	
			 'filter_product_ids'			=> $filter_product_ids,	
			 'filter_product_idl'			=> $filter_product_idl,	
		);	
		
	
			
		
		$rowCount = 1;
		
		$charhead = 'A';
		
				 
		 $styleArray = array(
		
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),
				'size'  => 12,
				
			)); 
			
	
	// Column Rows	

		$objPHPExcel->getActiveSheet()->getStyle('1')->applyFromArray($styleArray);
		
		 $objPHPExcel
		->getActiveSheet()
		->getStyle('1')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('f89f30'); 
		
		
		
		// Top Column Values
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_product_id'))->getColumnDimension($charhead)->setAutoSize(true);$objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_name'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_model'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_language'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_status'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_store'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_sku'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_upc'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_ean'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_jan'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_isbn'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_mpn'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_location'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_manufacturer_id'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_points'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_date_available'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_language_id'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_description'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_tag'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_meta_title'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_meta_description'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_meta_keyword'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_image'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_price'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_minimum'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_quantity'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_sort_order'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_tax_class_id'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_tax_class'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_subtract'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_stock_status_id'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_stock_status'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_shipping'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_seo_url'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_length'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_length_class_id'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_length_class'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_width'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_height'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_weight'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_weight_class_id'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_weight_class'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_manufacturer'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_categories_ids'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_category_names'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_filter_names'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_download_names'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_related_products'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_attribute_names'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_options_data'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_discounts_offers'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_rewards_data'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_viewed'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_specials_offers'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_additional_images'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_reviews_data'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		
		
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_date_added'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $this->language->get('export_date_modified'))->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
	
		
		
		
		//Extra Fields
		
		if(!empty($filter_extrafields)) {
			foreach($filter_extrafields as $filter_extrafield) {	
			
				$objPHPExcel->getActiveSheet()->setCellValue($charhead .$rowCount, $filter_extrafield)->getColumnDimension($charhead)->setAutoSize(true); $objPHPExcel->getActiveSheet()->getStyle($charhead++ .$rowCount)->getAlignment()->setWrapText(true);
				
			}
		}
		
		//Extra Fields
	
		
		// Top Column Values
		
		
		//Worksheet title
		$objPHPExcel->getActiveSheet()->setTitle($this->language->get('export_sheettitle'));		
		
		
		
		$results = $this->model_tool_mmexport->getProducts($filter_data);			
		
		
		foreach($results as $result){
			
			$rowCount++;
			// Language
				$language_info = $this->model_tool_mmexport->getLanguage($result['language_id']);
				$result['language'] = ($language_info) ? $language_info['code']: '';
							
				// Store
				if (isset($filter_store_id) && $filter_store_id != '') {
					$stores = $this->model_tool_mmexport->getProductStores($result['product_id'], $filter_store_id);
				}else{
					$stores = $this->model_tool_mmexport->getProductStores($result['product_id']);
				}
				
				$export_stores = array();
				foreach($stores as $store_id) {
					if($store_id == '0') {
						$export_stores[] = $this->language->get('text_default');
					}else{
						$store_info = $this->model_setting_store->getStore($store_id);
						$export_stores[] = ($store_info) ? $store_info['name'] : '';
					}
				}			
				$result['store'] = implode(';;', $export_stores);	
			
			
				// Tax Class
				$tax_class_info = $this->model_tool_mmexport->getTaxClass($result['tax_class_id']);
				$result['tax_class'] = ($tax_class_info) ? $tax_class_info['title'] : '';
				
				// Stock Status
				$stock_status_info = $this->model_tool_mmexport->getStockStatus($result['stock_status_id'], $result['language_id']);			
				$result['stock_status'] = ($stock_status_info) ? $stock_status_info['name'] : '';
				
				// Keyword
				$keyword_info = $this->model_tool_mmexport->getKeyword($result['product_id']);			
				$result['seo_url'] = ($keyword_info) ? $keyword_info['keyword'] : '';
				
				// Length Class
				$length_class_info = $this->model_tool_mmexport->getLengthClass($result['length_class_id'], $result['language_id']);
				$result['length_class'] = ($length_class_info) ? $length_class_info['title'] : '';
				
				// Weight Class
				$weight_class_info = $this->model_tool_mmexport->getWeightClass($result['weight_class_id'], $result['language_id']);
				
				$result['weight_class'] = ($weight_class_info) ? $weight_class_info['title'] : '';
				
				// Manufacturer
				$manufacturer_info = $this->model_tool_mmexport->getManufacturer($result['manufacturer_id']);
				$result['manufacturer'] = ($manufacturer_info) ? $manufacturer_info['name'] : '';
				
				// Categories
				$categories_ids = $this->model_tool_mmexport->getProductCategories($result['product_id']);
				$result['categories_ids'] = ($categories_ids) ? implode(',', $categories_ids) : '';
				
				
				// Category Names
				$category_names = array();
				foreach($categories_ids as $category_id) {
					$category_info = $this->model_tool_mmexport->getCategory($category_id, $result['language_id']);
					if($category_info) {
						$category_names[] = $category_info['name'];
					}
				}
				$result['category_names'] = ($category_names) ? implode(' ; ', $category_names) : '';
				
				// Filters
				$filter_ids = $this->model_tool_mmexport->getProductFilters($result['product_id']);
				$filter_names = array();
				foreach($filter_ids as $filter_id) {
					$filter_info = $this->model_tool_mmexport->getFilter($filter_id, $result['language_id']);
					if($filter_info) {
						$filter_names[] = $filter_info['group'] .' ~ '. $filter_info['name'];
					}
				}
				
				$result['filter_names'] = ($filter_names) ? implode(' ;; ', $filter_names) : '';
				
				// Downloads
				$downloads = $this->model_tool_mmexport->getProductDownloads($result['product_id']);
				$download_names = array();
				foreach($downloads as $download_id) {
					$download_info = $this->model_tool_mmexport->getDownload($download_id, $result['language_id']);
					if($download_info) {
						$download_names[] = $download_info['name'];
					}
				}
				$result['download_names'] = ($download_names) ? implode(' ;; ', $download_names) : '';
				
				// Related Products
				$product_ids = $this->model_tool_mmexport->getProductRelated($result['product_id']);
				$result['related_products'] = ($product_ids) ? implode(',', $product_ids) : '';
				
				// Attribute
				$attributes = $this->model_tool_mmexport->getProductAttributes($result['product_id']);
				$attribute_names = array();
				foreach($attributes as $attribute) {
					$attribute_info = $this->model_tool_mmexport->getAttribute($attribute['attribute_id'], $result['language_id']);
					if($attribute_info) {
						$attribute_group_info = $this->model_tool_mmexport->getAttributeGroup($attribute_info['attribute_group_id'], $result['language_id']);
						if($attribute_group_info) {
							$attribute_names[] = $attribute_group_info['name'].'!!'.$attribute_info['name'].'!!'.$attribute['product_attribute_description'][$result['language_id']]['text'];
						}
					}
				}
				
				$result['attribute_names'] = ($attribute_names) ? implode('; ', $attribute_names) : '';
				
								
				// Images
				
					if($imgfullurl){
				
					if($result['image']!=""){
							if ($this->request->server['HTTPS']) {
								$Pimage = HTTPS_CATALOG . 'image/' . $result['image'];
								
							} else {
								$Pimage = HTTP_CATALOG . 'image/' . $result['image'];
								
							}
							$result['image'] = $Pimage;
					}
					}
				
				$result['additional_images'] = '';
				if($filter_image) {
					
				
							
					$images = $this->model_tool_mmexport->getProductImages($result['product_id']);
					$additional_images = array();
					foreach($images as $image) {
						
							if ($this->request->server['HTTPS']) {
								$additional_images[] = HTTPS_CATALOG . 'image/' . $image['image'];
								
							} else {
								$additional_images[] = HTTP_CATALOG . 'image/' . $image['image'];
								
							}
						
					}
					$result['additional_images'] = ($additional_images) ? implode(' !! ', $additional_images) : '';
						
							
					} else {
					
					$images = $this->model_tool_mmexport->getProductImages($result['product_id']);
					$additional_images = array();
					foreach($images as $image) {
						$additional_images[] = $image['image'];
					}
					$result['additional_images'] = ($additional_images) ? implode(' !! ', $additional_images) : '';
					
					}
				
				
				// Specials
				$specials = $this->model_tool_mmexport->getProductSpecials($result['product_id']);
				$specials_offers = array();
				foreach($specials as $special) {
					$specials_offers[] = $special['customer_group_id']. '!!' .$special['priority'] .'!!'. $special['price'] .'!!'. $special['date_start'] .'!!'. $special['date_end'];
				}
				$result['specials_offers'] = ($specials_offers) ? implode('; ', $specials_offers) : '';
				
				// Discount Offer
				$discounts = $this->model_tool_mmexport->getProductDiscounts($result['product_id']);
				$discounts_offers = array();
				foreach($discounts as $discount) {
					$discounts_offers[] = $discount['customer_group_id']. '!!' .$discount['quantity'] .'!!' .$discount['priority'] .'!!'. $discount['price'] .'!!'. $discount['date_start'] .'!!'. $discount['date_end'];
				}
				$result['discounts_offers'] = ($discounts_offers) ? implode('; ', $discounts_offers) : '';
				
				// Rewards
				$rewards = $this->model_tool_mmexport->getProductRewards($result['product_id']);
				$rewards_data = array();
				foreach($rewards as $customer_group_id => $reward) {
					$rewards_data[] = $customer_group_id .'!!'. $reward['points'];
				}
				$result['rewards_data'] = ($rewards_data) ? implode('; ', $rewards_data) : '';
				
				// Options
				$options = $this->model_tool_mmexport->getProductOptions($result['product_id'], $result['language_id']);
				$options_data = array();
				foreach($options as $option) {
					$options_string = html_entity_decode($option['name'], ENT_QUOTES, 'UTF-8') .' ;; '.$option['type'].' ;; '.$option['required'] .' ;; ';
					if($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox') {
						$option_value_row = 1;
						foreach($option['product_option_value'] as $option_value_key => $product_option_value) {
							$options_string .= $product_option_value['name'] .' !! '.$product_option_value['quantity'] .' !! '. $product_option_value['subtract'].' !! '. $product_option_value['price'] .' !! '. $product_option_value['price_prefix'] .' !! '. $product_option_value['points'] .' !! '. $product_option_value['points_prefix'] .' !! '. $product_option_value['weight'] .' !! '. $product_option_value['weight_prefix'];
							
							if(count($option['product_option_value']) != $option_value_row) {
								$options_string .= ' || ';
							}
							
							$option_value_row++; 
						}
					}else if($option['type'] == 'file') {
						// No Value for type file;
					}else {
						$options_string .= $option['value'];
					}
					
					$options_data[] = $options_string;
				}
				
				$result['options_data'] = ($options_data) ? implode(': ', $options_data) : '';
				
				// Reviews
				$result['reviews_data'] = '';
				if($filter_review) {
					$reviews = $this->model_tool_mmexport->getReviews($result['product_id'], $result['language_id']);
					$reviews_data = array();
					foreach($reviews as $review) {
						$reviews_data[] = $review['customer_id'] .' :: '. $review['author'] .' :: '. $review['text'] .' :: '. $review['rating'] .' :: '. $review['status'] .' :: '. $review['date_added'] .' :: '. $review['date_modified'];
					}
					$result['reviews_data'] = ($reviews_data) ? implode('!! ', $reviews_data) : '';
				}
		
		$rowAlpha = 'A';

		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['product_id']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['name']);					
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['model']);	
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['language']);		
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['status']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['store']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['sku']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['upc']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['ean']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['jan']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['isbn']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['mpn']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['location']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['manufacturer_id']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['points']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['date_available']);	
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['language_id']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['description']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['tag']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['meta_title']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['meta_description']);
		$objPHPExcel->getActiveSheet()->SetCellValue($rowAlpha++ .$rowCount, $result['meta_keyword']);		
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['image']);		
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['price']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['minimum']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['quantity']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['sort_order']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['tax_class_id']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['tax_class']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['subtract']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['stock_status_id']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['stock_status']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['shipping']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['seo_url']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['length']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['length_class_id']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['length_class']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['width']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['height']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['weight']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['weight_class_id']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['weight_class']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['manufacturer']);			
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['categories_ids']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, html_entity_decode($result['category_names'], ENT_QUOTES, 'UTF-8'));
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['filter_names']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['download_names']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['related_products']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['attribute_names']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['options_data']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['discounts_offers']);		
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['rewards_data']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['viewed']);		
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['specials_offers']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['additional_images']);		
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['reviews_data']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['date_added']);
		$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, $result['date_modified']);
	
		
		
			if(!empty($filter_extrafields)) {
				foreach($filter_extrafields as $filter_extrafield) {			
				
						$objPHPExcel->getActiveSheet()->setCellValue($rowAlpha++ .$rowCount, html_entity_decode($result[$filter_extrafield], ENT_QUOTES, 'UTF-8'));
				
				}
			}
		
		
		}
	// Rename worksheet
		//	$objPHPExcel->getActiveSheet()->setTitle('Simple');


		//	ob_end_clean();

		//	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	// Find Format
			if($file_format == 'xls') {
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				$file_name = 'product.xls';
			}else if($file_format == 'xlsx') {
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
				$file_name = 'product.xlsx';
			}else if($file_format == 'csv') {
				$file_name = 'product.csv';
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
			}else{
				$file_name = 'product.xml';
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2003XML');
			}



	// Redirect output to a client’s web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'. $file_name .'"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter->save('php://output');
		
		
		
	}
	
}