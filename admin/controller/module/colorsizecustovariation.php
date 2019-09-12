<?php
class ControllerModulecolorsizecustovariation extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/colorsizecustovariation');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->createTable();
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			
			$this->model_setting_setting->editSetting('colorsizecustomvariation', $this->request->post);		
			
			$this->cache->delete('product');
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
				
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = array();
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		
		$data['action'] = $this->url->link('module/colorsizecustovariation', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['modules'] = array();
		
		if (isset($this->request->post['colorsizecustomvariation'])) {
			$data['modules'] = $this->request->post['colorsizecustomvariation'];
		} elseif ($this->config->get('colorsizecustomvariation')) { 
			$data['modules'] = $this->config->get('colorsizecustomvariation');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('module/colorsizecv.tpl', $data));
	}
	
	public function createTable(){
	  $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "custom_variation (
	  `cvid` int(11) NOT NULL AUTO_INCREMENT,
	  `color_id` int(11) NOT NULL,
	  `image` varchar(500) CHARACTER SET utf8 NOT NULL,
	  `product_id` int(11) NOT NULL,
	  `color_option_id` int(11) NOT NULL,
	  `size_option_id` int(11) NOT NULL,
	  `required` int(1) NOT NULL DEFAULT '1',
	  PRIMARY KEY (`cvid`))");
	   
	  
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "custom_variation_child (
  `cvid` int(11) NOT NULL,
   `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `subtract` int(1) NOT NULL DEFAULT '1',
  `price_prefix` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '+',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  KEY `cvid` (`cvid`))");
	  
	}
}
?>