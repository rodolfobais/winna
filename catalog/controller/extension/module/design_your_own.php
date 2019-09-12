<?php
//use DIR_APPLICATION.'Composer\Autoload\includeFile';

class ControllerExtensionModuleDesignYourOwn extends Controller {
	
	public function __construct($registry)
	{ 
		parent::__construct( $registry );
		
		//load DYO PLUGIN IF NOT LOADED YET
		if( !defined("IS_DYO_LOADED") )
		{
		   
			require_once DIR_APPLICATION.'controller/extension/module/productcolorbasedimages/config.php';
			loadDesignYourOwnCommons();
		}
	}
	
	
	public function index() {
	   
		$this->load->language('extension/module/productcolorbasedimages');
		$this->load->model("setting/setting");
		$this->load->model("extension/pcbi");
		$this->load->model('catalog/product');
		$this->load->model('setting/module');
		
		//
		//$this->installModule();
		
		$module_info = oc_hlp_getModuleSetting($this, 'design_your_own');
		//pr($module_info); die;
		//$this->bread_cumb($module_info);
// 		if( method_exists( $this, $module_info["name"]) )
// 		{
// 			return $this->{$module_info["name"]}( $module_info );
// 		}
// 		else 
// 		{
// 			//log error
			
// 			//handle error 
			
// 			//exit process if function is important to be processed
// 		}

		return $this->home_design_your_own_section($module_info);
	}
	
	public function home_design_your_own_section($config)
	{
		if ( isset( $this->request->server['HTTPS'] ) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1')))
		{
			$data['base'] = $this->config->get('config_ssl');
		}
		else
		{
			$data['base'] = $this->config->get('config_url');
		}
		
		//$data['heading_title'] = $this->language->get('heading_title');
		//pr($config); die;
		
		//url setting
		$data["setting_url_part"] = "route=product/category&is_dyo=1&dyo_bgs=1&dyo_bfs=S&path=".dyo_cnf_mountSettingMainCategoryId();
		$data["diamond_url_part"] = "route=product/category&is_dyo=1&dyo_bgs=1&dyo_bfs=D&path=".dyo_cnf_diamondMainCategoryId();
		
		if($config['status'] == 1)
		{
		    if ( file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/design_your_own_home_section'))
			{
				return $this->load->view($this->config->get('config_template') . '/template/extension/module/design_your_own_home_section', $data);
			}
			else
			{
				return $this->load->view('/extension/module/design_your_own_home_section', $data);
			}
		}
	}
	
	public function bread_cumb($config)
	{
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1')))
		{
			$data['base'] = $this->config->get('config_ssl');
		}
		else
		{
			$data['base'] = $this->config->get('config_url');
		}
		
		//$data['heading_title'] = $this->language->get('heading_title');
		//pr($config); die;
		
		if( $config['status'] == 1)
		{
			if ( file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/module/design_your_own_bread_cumb'))
			{
				return $this->load->view($this->config->get('config_template') . '/template/extension/module/design_your_own_bread_cumb', $data);
			}
			else
			{
				return $this->load->view('/extension/module/design_your_own_bread_cumb', $data);
			}
		}
	}
	
	
	/********************************** custom functions ***************************************/
	
	public function select_this()
	{
		//http://192.168.1.28/sand_gold_theme/index.php?route=extension/module/design_your_own/select_this&dyo_bfs=S&path=20
	   
// 	    if ($category_info) {
// 	        if(true) {
// 	            $this->load->controller('extension/module/design_your_own/product_list_override', array( $data ) );
// 	        }
// 	        else {
// 	            $this->response->setOutput($this->load->view('product/category', $data));
// 	        }
// 	    }
		
		//check if diamond
		$is_diamond = false; 
		if( isset( $_GET['dyo_bfsd'] ) && (int)$_GET['dyo_bfsd'] == 1 )
		{
			$is_diamond = true; 
		}
		
		//check if setting 
			//nothing to do 
				
		
		//do save selection in vars as used in cart_checkout helper
		if( $is_diamond )
		{
			//set session variable
			$this->session->data["dyo_diamond_p_id"] = $_GET["product_id"];
			$this->session->data["dyo_diamond_cart"] = $this->request->post;
		}
		else //if( isset( $_GET['dyo_bfss'] ) && (int)$_GET['dyo_bfss'] == 1 )
		{
			//set session variable
			$this->session->data["dyo_setting_p_id"] = $_GET["product_id"];
			$this->session->data["dyo_setting_cart"] = $this->request->post;
		}
// 		pr($this->session->data["dyo_diamond_cart"]); 
// 		pr($this->session->data["dyo_setting_cart"]);
// 		die; 
		
		
		//redirect to either next selction(means listng page which will take to detail page) page or preview page
		$currStep = cc_hlp_breadcumbCurrentStep($this);
		
				
		$json = array();
		if( $currStep== 1 )
		{
			//set applicable search filters based onfilters of firt selected products CAN BE SET WITH FILTER
			$query = $this->db->query(" SELECT * FROM oc_product_filter WHERE product_id=".(int)$_GET["product_id"]." ");
			$filter_query = "";
			$can_be_set_with_filter_ids = can_be_set_with_filter_ids();
			foreach($query->rows as $result)
			{
				if( in_array($result["filter_id"], $can_be_set_with_filter_ids) )
				{
					$filter_query .= $result["filter_id"].",";
				}
			}
			if( strlen($filter_query) > 0 )
			{
				$filter_query = substr($filter_query, 0, -1);
			}
			
			
		    //redirect to second step
		    $url_params = "";
			if( $is_diamond )
			{
				$url_params = "is_dyo=1&dyo_bgs=2&path=".dyo_cnf_mountSettingMainCategoryId()."&filter=".$filter_query;
			}
			else 
			{
				$url_params = "is_dyo=1&dyo_bgs=2&path=".dyo_cnf_diamondMainCategoryId()."&filter=".$filter_query;
			}
			//$this->response->redirect($this->url->link('product/category', $url_params, IS_HTTPS ? 'SSL' : ''));
			$json['redirect'] = $this->url->link('product/category', $url_params, IS_HTTPS ? 'SSL' : '');
		}
		else 
		{
			//need to do dummy call here on detail page 
			//$this->dyo_preview();
			//$json['redirect'] = $this->url->link('extension/module/design_your_own/dyo_preview', 'is_dyo=1', IS_HTTPS ? 'SSL' : '');
			$json['redirect'] = $this->url->link('product/product', 'dyo_bgs=3&is_dyo=1&is_dyo_preview=1&product_id='.(int)$_GET["product_id"].'&pbci_option='.oc_pcbi_hlp_getSettingColorParams($this), IS_HTTPS ? 'SSL' : '');
		}
		
		echo json_encode($json); 
		exit(1);
	}
	
	public function dyo_preview($data=array())
	{
	    $this->load->model('catalog/product');
	    
	    
	    //get both product details 
	    $data['setting'] = $this->getSettingDiamondProductDetails( 'dyo_setting_p_id' );
	    $data['diamond'] = $this->getSettingDiamondProductDetails( 'dyo_diamond_p_id' );

	    
// 	    header('Content-Type: application/json');
//     	echo "setting ";	pr($data["setting"]);
//     	echo "diamond ";	pr($data["diamond"]);
//     	die;
    	
	    //TODO make item total perfact
	    $total = 0;
	    if( !empty( $data['setting']['special'] ) )
	    {
	        $total += str_replace( "$", "", $data['setting']['special'] );
	    }
	    else 
	    {
	        $total += str_replace( "$", "", $data['setting']['price'] );
	    }
	    
	    if( !empty( $data['diamond']['special'] ) )
	    {
	        $total += str_replace( "$", "", $data['diamond']['special'] );
	    }
	    else 
	    {
	        $total += str_replace( "$", "", $data['diamond']['price'] );
	    }
	    
	    $data['total'] = "$".$total;
	    
	    //load menubar
	    $this->load->model('setting/module');
	    
	    $data['modules'] = array();
	    $part = explode('.', 'boss_newmegamenu.122');
	    
	    if (isset($part[0]) && $this->config->get('module_' . $part[0] . '_status')) {
	    	$module_data = $this->load->controller('extension/module/' . $part[0]);
	    	
	    	if ($module_data) {
	    		$data['modules'][] = $module_data;
	    	}
	    }
	    
	    if (isset($part[1])) {
	    	$setting_info = $this->model_setting_module->getModule($part[1]);
	    	
	    	if ($setting_info && $setting_info['status']) {
	    		$output = $this->load->controller('extension/module/' . $part[0], $setting_info);
	    		
	    		if ($output) {
	    			$data['modules'][] = $output;
	    		}
	    	}
	    }
	    
	    $data['custom_menubar'] =  (!empty($data['modules'][0]) ? $data['modules'][0] : '');
	    
// 	    header('Content-Type: application/json');
// 		echo "setting ";	pr($data["setting"]); 
// 		echo "diamond ";	pr($data["diamond"]);
// 		pr($data["content_top"]);
// 		die;
		
	    //override zoom with a simple trick
	    $data["content_top"] = str_replace("bt-product-zoom", "_unknown_", $data["content_top"]);
	    
		//load preview layout
		$this->response->setOutput($this->load->view('extension/module/design_your_own_preview', $data));
	}

	/**
	 * get diamond and setting product details by product id from session 
	 */
	public function getSettingDiamondProductDetails( $dyo='dyo_setting_p_id' )
	{
	    $data = array();
	    
	    if ( isset( $this->session->data[ $dyo ] ) ) 
	    {
	        $product_id = (int)$this->session->data[ $dyo ];
	    } 
	    else 
	    {
	        $product_id = 0;
	    }
	    
	    if( $product_id )
	    {
	        $product_info = $this->model_catalog_product->getProduct( $product_id );
	        
	        $this->document->setTitle($product_info['meta_title']);
	        $this->document->setDescription($product_info['meta_description']);
	        $this->document->setKeywords($product_info['meta_keyword']);
	        $this->document->addLink($this->url->link('product/product', 'product_id=' . $product_id), 'canonical');
	        
	        $this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
	        $this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
	        $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js');
	        $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js');
	        $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
	        $this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
	        
	        $data['heading_title'] = $product_info['name'];
	        
	        $data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
	        $data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));
	        
	        $this->load->model('catalog/review');
	        
	        $data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);
	        
	        $data['product_id'] = $product_id;
	        $data['manufacturer'] = $product_info['manufacturer'];
	        $data['manufacturers'] = $this->url->link( 'product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id'] );
	        $data['model'] = $product_info['model'];
	        $data['reward'] = $product_info['reward'];
	        $data['points'] = $product_info['points'];
	        $data['description'] = html_entity_decode( $product_info['description'], ENT_QUOTES, 'UTF-8' );
	        
	        if ($product_info['quantity'] <= 0) {
	            $data['stock'] = $product_info['stock_status'];
	        } elseif ($this->config->get('config_stock_display')) {
	            $data['stock'] = $product_info['quantity'];
	        } else {
	            $data['stock'] = $this->language->get('text_instock');
	        }
	        
	        $this->load->model( 'tool/image' );
	        
	        if ($product_info['image']) {
	            $data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height'));
	        } else {
	            $data['popup'] = '';
	        }
	        
	        if ($product_info['image']) {
	            $data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height'));
	        } else {
	            $data['thumb'] = '';
	        }
	        
	        $data['images'] = array();
	        
	        $results = $this->model_catalog_product->getProductImages1( $product_id );
	        
	        foreach ($results as $result) {
	            $data['images'][] = array(
	                'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height')),
	                'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height'))
	            );
	        }
	        
	        if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
	            $data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
	        } else {
	            $data['price'] = false;
	        }
	        
	        if ((float)$product_info['special']) {
	            $data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
	        } else {
	            $data['special'] = false;
	        }
	        
	        if ($this->config->get('config_tax')) {
	            $data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
	        } else {
	            $data['tax'] = false;
	        }
	        
	        $discounts = $this->model_catalog_product->getProductDiscounts($product_id);
	        
	        $data['discounts'] = array();
	        
	        foreach ($discounts as $discount) {
	            $data['discounts'][] = array(
	                'quantity' => $discount['quantity'],
	                'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
	            );
	        }
	        
	        $data['options'] = array();
	        
	        foreach ($this->model_catalog_product->getProductOptions($product_id) as $option) {
	            $product_option_value_data = array();
	            
	            foreach ($option['product_option_value'] as $option_value) {
	                if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
	                    if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
	                        $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
	                    } else {
	                        $price = false;
	                    }
	                    
	                    $product_option_value_data[] = array(
	                        'product_option_value_id' => $option_value['product_option_value_id'],
	                        'option_value_id'         => $option_value['option_value_id'],
	                        'name'                    => $option_value['name'],
	                        'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
	                        'price'                   => $price,
	                        'price_prefix'            => $option_value['price_prefix']
	                    );
	                }
	            }
	            
	            $data['options'][] = array(
	                'product_option_id'    => $option['product_option_id'],
	                'product_option_value' => $product_option_value_data,
	                'option_id'            => $option['option_id'],
	                'name'                 => $option['name'],
	                'type'                 => $option['type'],
	                'value'                => $option['value'],
	                'required'             => $option['required']
	            );
	        }
	        
	        if ($product_info['minimum']) {
	            $data['minimum'] = $product_info['minimum'];
	        } else {
	            $data['minimum'] = 1;
	        }
	        
	        $data['review_status'] = $this->config->get('config_review_status');
	        
	        if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
	            $data['review_guest'] = true;
	        } else {
	            $data['review_guest'] = false;
	        }
	        
	        if ($this->customer->isLogged()) {
	            $data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
	        } else {
	            $data['customer_name'] = '';
	        }
	        
	        $data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
	        $data['rating'] = (int)$product_info['rating'];
	        
	        // Captcha
	        if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
	            $data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
	        } else {
	            $data['captcha'] = '';
	        }
	        
	        $data['share'] = $this->url->link('product/product', 'product_id=' . (int)$product_id);
	        
	        $data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($product_id);
	        
	        $data['products'] = array();
	        
	        $results = $this->model_catalog_product->getProductRelated($product_id);
	        
	        foreach ($results as $result) {
	            if ($result['image']) {
	                $image = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height'));
	            } else {
	                $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height'));
	            }
	            
	            if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
	                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
	            } else {
	                $price = false;
	            }
	            
	            if ((float)$result['special']) {
	                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
	            } else {
	                $special = false;
	            }
	            
	            if ($this->config->get('config_tax')) {
	                $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
	            } else {
	                $tax = false;
	            }
	            
	            if ($this->config->get('config_review_status')) {
	                $rating = (int)$result['rating'];
	            } else {
	                $rating = false;
	            }
	            
	            $data['products'][] = array(
	                'product_id'  => $result['product_id'],
	                'thumb'       => $image,
	                'name'        => $result['name'],
	                'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
	                'price'       => $price,
	                'special'     => $special,
	                'tax'         => $tax,
	                'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
	                'rating'      => $rating,
	                'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
	            );
	        }
	        
	        $data['tags'] = array();
	        
	        if ($product_info['tag']) {
	            $tags = explode(',', $product_info['tag']);
	            
	            foreach ($tags as $tag) {
	                $data['tags'][] = array(
	                    'tag'  => trim($tag),
	                    'href' => $this->url->link('product/search', 'tag=' . trim($tag))
	                );
	            }
	        }
	        
	        $data['recurrings'] = $this->model_catalog_product->getProfiles($product_id);
	        
	        $data['continue'] = $this->url->link('common/home');
	        
	        $this->model_catalog_product->updateViewed($product_id);
	        
	        $this->commonLoadFile( $data );
	    }
	    
	    return $data;
	}
	
	public function dyo_add_to_cart()
	{
		//add to legacy cart from dyo selection session but save a mapping reference dyo as well
	    //added to legacy cart from detail page so just save mapping 
	    
		//save mapping in session
		if( !isset($this->session->data["dyo_maps"]) )
		{
			$this->session->data["dyo_maps"] = array();
		}
		//here key should include option selection also to allow multiple maps of same sets of products, or even better do it with cart id
		$this->session->data["dyo_maps"]["dyo_s_d_".$this->session->data["dyo_setting_p_id"]."_".$this->session->data["dyo_diamond_p_id"]] = 1;
		
	    
		//redirect to cart page
// 		$data = $this->load->controller('common/cart', true);
// 	    $this->cart_override( array( $data ) );
	    $this->response->redirect($this->url->link('checkout/cart', '', IS_HTTPS ? 'SSL' : ''));
	}
	
	public function pcbi_get_images()
	{
		$json = array();
		$json["type"] = "invalid";
		$json["msg"] = "";

		
		//get color option value id 
		$option_id = 0;
		$option_value_id = 0; 
		$product_option_id = fetchSubStr($this->request->get["changed_opt_name"], "option[", "]");
		
		//pr($this->request->get);
		$query = $this->db->query("	SELECT option_id, option_value_id FROM oc_product_option_value WHERE product_option_value_id=".(int)$this->request->get["option"][$product_option_id]." ");
		
		foreach($query->rows as $result){
			$option_id = $result["option_id"];
			$option_value_id = $result["option_value_id"];
			
		}
		
		
		//check if its parent of color options, if not than return type=invalid response 
		if( pcbi_is_color_option_id($option_id,$this) )	
		{
		   // echo "hi";
		  //  echo "<pre>";print_r(pcbi_is_color_option_id($option_id,$this));echo "</pre>";
			//get images
			$_GET["pbci_option"] = $option_value_id;
			oc_pcbi_hlp_setSettingColorParams($this, $option_value_id);
			
			$this->load->model('catalog/product');
			$this->load->model('tool/image');
			
			$images = $this->model_catalog_product->getProductImages1($this->request->get['product_id'], null, true);
			//echo"<pre>";print_r($result);echo "</pre>";
			foreach ($images as $k=>$image)
			{
				$popup = $this->model_tool_image->resize($image["image"], 800, 800);	//$this->model_tool_image->resize($image["image"], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height'));
				$thumb = $this->model_tool_image->resize($image["image"], 575, 575);

				$icons = $this->model_tool_image->resize($image["image"], 74,74);	//$this->model_tool_image->resize($image["image"], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height'));
				//echo"<pre>";print_r($popup) ;echo "</pre>";
				if($k == 0)
				{
					$json["thumb"] = $thumb;
					$json["popup"] = $popup;					
				}
				
				if( !empty($popup) && !empty($thumb) )
				{
					$json["type"] = "success";
					
					$json['images'][] = array( "popup" => $popup, "thumb" => $thumb ,"icon" => $icons);
				}
			}
		}
		
		
		//return json response 
		echo json_encode($json);
		exit(1);
	}
	
	/********************************** END custom functions ***************************************/
	
	
	/********************************** custom overrides ***************************************/
	
	/**
	 * override only if came from dyo action
	 * @param unknown $data
	 */
	public function product_list_override($data)
	{
		$data = $this->productListNameLimit( $data[0] );
		
		//override links if its dyo action
		if( isset( $_GET['is_dyo'] ) && (int)$_GET['is_dyo'] == 1 )
		{
			$data[0]['is_dyo_get'] = 1;
		    $data = $this->productListHrefAppend( $data[0], "listing" );
		    $data[0]['dyo_atc_class'] = 'hide';
		    $this->response->setOutput($this->load->view('extension/module/design_your_own_category', $data[0]));
		}
		else
		{
			//set common variable
			$data[0]['is_dyo_get'] = 0;
			$data[0]['is_dyo'] = true;	//TODO is this used anywhere otherwise get rid of it
			$data[0]['dyo_atc_class'] = '';
		    $this->response->setOutput($this->load->view('extension/module/design_your_own_category', $data[0]));
		}
// 		echo "here p l iiiiiiiiiiiiiiiiiiiiiiiiiii";
// 		pr($data[0]); die;
	}
	
	/**
	 *
	 */
	public function productListNameLimit( $data )
	{
		foreach ( $data['products'] as $k=>$product )
		{
			$data['products'][$k]['name'] = char_limit($product['name'], 50);
		}
		
		return array( $data );
	}
	
	/**
	 * 
	 */
	public function productListHrefAppend( $data, $type )
	{
// 		header('Content-Type: application/json');
// 		pr($data); die; 
	    $productArr = array();
	    $curr_step = cc_hlp_breadcumbCurrentStep($this);
	    
	    //
	    foreach ( $data['products'] as $k=>$product )
	    {
	        $productArr[$k]['product_id'] = $product['product_id'];
	        $productArr[$k]['thumb'] = $product['thumb'];
	        $productArr[$k]['name'] = $product['name'];
	        $productArr[$k]['description'] = $product['description'];
	        $productArr[$k]['price'] = $product['price'];
	        $productArr[$k]['special'] = $product['special'];
	        $productArr[$k]['tax'] = $product['tax'];
	        $productArr[$k]['minimum'] = $product['minimum'];
	        $productArr[$k]['rating'] = $product['rating'];
	        $productArr[$k]['href'] = $product['href']."&dyo_bgs=".$curr_step."&is_dyo=".$_GET['is_dyo'];	//."&dyo_bfs=".$_GET['dyo_bfs'];
	    }
	    
	    $data['products'] = $productArr;
	    
	    
	    if( $type == "listing" )
	    {
		    //
		    foreach ( $data['sorts'] as $k=>$product )
		    {
		    	$data['sorts'][$k]['href'] = $product['href']."&dyo_bgs=".$curr_step."&is_dyo=".$_GET['is_dyo'];	
		    }
		    
	
		    //
		    foreach ( $data['limits'] as $k=>$product )
		    {
		    	$data['limits'][$k]['href'] = $product['href']."&dyo_bgs=".$curr_step."&is_dyo=".$_GET['is_dyo'];
		    }
		    
		    
		    //
		    $data["column_left"] = str_replace("index.php?route=product/category&", "index.php?route=product/category&"."dyo_bgs=".$curr_step."&is_dyo=".$_GET['is_dyo']."&", $data["column_left"]);
	    }
	    
	    
	    return array( $data );
	}
	

	/**
	 * override only if came from dyo action
	 * @param unknown $data
	 */
	public function product_detail_override($data)
	{
// 		//
// 		if( isset($_GET["is_test"]) && $_GET["is_test"] == 1 )
// 		{
// 			echo "here product_detail_override";
// 			pr($data[0]["images"]);
// 			pr($data[0]["thumb"]);
// 			die;
// 		}
		
		//add additional data if its dyo action
	    if( isset( $_GET['is_dyo'] ) && (int)$_GET['is_dyo'] == 1 )
	    {
	    	if( isset( $_GET['is_dyo_preview'] ) && (int)$_GET['is_dyo_preview'] == 1 )
	    	{
	    		$this->dyo_preview($data[0]);
	    	}
	    	else 
	    	{
	    	    $data = $this->productListHrefAppend( $data[0], "detail" );
		        
		        $breadcumbIsCurrentStepSetting = cc_hlp_breadcumbIsCurrentStepSetting($this);
		        
		        $select = ( $breadcumbIsCurrentStepSetting ) ? "Setting" : "Diamond";
		        	        
		        $data[0]['cart_select_button'] = '<div class="button-select-this">
	                                                <button type="button" class="btn btn-primary btn-block" id="button-select-this"
	                                                        data-loading-text="loading..."> Select This '.$select.'</button>
	                                            </div>';
		        //set common variable
		        $data[0]['is_dyo'] = true;
		        $data[0]['dyo_qty_class'] = '<div class="qty hide">
	                            				<label class="control-label" for="input-quantity">Qty:</label>
	                            					<input type="number" name="quantity" value="'.$data[0]["minimum"].'" size="5" id="input-quantity" class="form-control"/>
	                            					<input type="hidden" name="product_id" value="'.$data[0]["product_id"].'"/>
	                        				</div>';
		        //$data['dyo_bfs'] = $_GET['dyo_bfs'];
		        $data[0]['dyo_bfsd'] = ( $breadcumbIsCurrentStepSetting ) ? 0 : 1;
		        $data[0]['dyo_bfss'] = ( $breadcumbIsCurrentStepSetting ) ? 1 : 0;
	// 	        $data['path'] = $_GET['path'];
		        $data[0]['product_id'] = $_GET['product_id'];
		        $data[0]["dyo_bgs"] = cc_hlp_breadcumbCurrentStep($this);
		        
		        
// 		        header('Content-Type: application/json');
// 		        pr($data[0]); die; 
		        $this->response->setOutput($this->load->view('extension/module/design_your_own_product_detail', $data[0]));
	    	}
	    }
	    else
	    {
	    	$data[0]['is_dyo'] = false;
	    	$data[0]['dyo_qty_class'] = '<div class="qty">
                            				<label class="control-label" for="input-quantity">Qty:</label>
                            					<input type="number" name="quantity" value="'.$data[0]["minimum"].'" size="5" id="input-quantity" class="form-control"/>
                            					<input type="hidden" name="product_id" value="'.$data[0]["product_id"].'"/>
                        				</div>';
	    	
	        $data[0]['cart_select_button'] = '<div class="button-cart">
                                                <button type="button" class="btn btn-primary btn-block" id="button-cart"
                                                        data-loading-text="loading..."> Add To Cart </button>
                                            </div>';
	        $this->response->setOutput($this->load->view('extension/module/design_your_own_product_detail', $data[0]));
	    }
	    
		//echo "here p l iiiiiiiiiiiiiiiiiiiiiiiiiii";
		//pr($data);
		
	}
	
	public function cart_override($data)
	{
		oc_pcbi_hlp_updateCartImagesAsPerColor($this, $data[0]);
		
		//merge rows of cart if cart has dyo mapped products
		oc_hlp_doMappingAndMergeCartItem($this, $data[0]);
		
		//echo "here p l iiiiiiiiiiiiiiiiiiiiiiiiiii";
		$this->commonLoadFile( $data[0] );
		$this->response->setOutput( $this->load->view('extension/module/design_your_own_cart', $data[0]) );
	}
	
	public function checkout_summary_override($data)
	{
		//merge rows of cart if cart has dyo mapped products
		oc_hlp_doMappingAndMergeCartItem($this, $data[0], "checkout");
		
		//echo "here p l iiiiiiiiiiiiiiiiiiiiiiiiiii";
		//pr($data);
		$this->response->setOutput($this->load->view('extension/module/design_your_own_checkout_summary', $data[0]));
	}
	
	public function place_order_override($data)
	{
		//save order info of mapping between setting and diamond in dyo tables 
	    if(isset($this->session->data["dyo_maps"]))
	    {
		      foreach ($this->session->data["dyo_maps"] as $key=>$val)
		      {
			             $tmpA = explode("_", $key);
			             $this->db->query("	INSERT INTO dyo_order_items_map(oim_key, order_id, oim_setting_p_id, oim_diamond_p_id) 
								VALUES('".$key."', ".(int)$data[0]["order_id"].", ".(int)$tmpA[3].", ".(int)$tmpA[4].") 	
							 ");
		      }
	    }
		
		//unset checkout sessions 
		cc_hlp_uncheckCheckoutSession($this);
	}
	
	public function order_info_override($data)
	{
		//merge rows of order items if order items has dyo mapped products
		oc_hlp_doMappingAndMergeCartItem($this, $data[0], "account_order_info", $data[0]["order_id"]);
		
		//echo "here p l iiiiiiiiiiiiiiiiiiiiiiiiiii";
		//pr($data); die; 
		$this->response->setOutput($this->load->view('extension/module/design_your_own_order_info', $data[0]));
	}
	
	public function order_cart_popup_override($data)
	{
// 		header('Content-Type: application/json');
// 		pr($data[0]); die; 
		
		//
		oc_pcbi_hlp_updateCartImagesAsPerColor($this, $data[0]);

		//merge rows of cart if cart has dyo mapped products
		oc_hlp_doMappingAndMergeCartItem($this, $data[0], "cart_popup");
		
// 		echo "here cart popup";
// 		pr($data); die; 
		
		return $this->load->view('extension/module/design_your_own_cart_popup', $data[0]);
	}
	
	public function commonLoadFile( &$data )
	{
	    $data['column_left'] = $this->load->controller('common/column_left');
	    $data['column_right'] = $this->load->controller('common/column_right');
	    $data['content_top'] = $this->load->controller('common/content_top');
	    $data['content_bottom'] = $this->load->controller('common/content_bottom');
	    $data['footer'] = $this->load->controller('common/footer');
	    $data['header'] = $this->load->controller('common/header');
	    
	}
	/********************************** END custom overrides ***************************************/
	
	
	/********************************** event override system ***************************************/
	
	private $codename = 'design_your_own';
	private $route = 'extension/module/design_your_own';
	private $config_file = 'design_your_own';
	private $extension = array();
	private $error = array();
	
	public function installModule() 
	{
		$this->load->model('extension/event');
		$this->load->model('extension/extension');
		
		$this->model_extension_event->deleteEvent($this->codename);
		$this->model_extension_event->addEvent($this->codename, 'catalog/controller/product/category/index/before', 'extension/module/design_your_own/category_after');
	}
	
	public function category_after($route, $data, $output) 
	{
		echo "here c e e"; die;
		$this->load->model($this->route);
		
		$data = $data[0];
		
		$data['language_id'] = $output;
		
		$seo_extensions = $this->{'model_extension_module_' . $this->codename}->getSEOExtensions();
		
		foreach ($seo_extensions as $seo_extension) {
			$this->load->controller($this->codename . '/' . $seo_extension . '/language_add', $data);
		}
	}
	/********************************** END event override system ************************************/
	
}