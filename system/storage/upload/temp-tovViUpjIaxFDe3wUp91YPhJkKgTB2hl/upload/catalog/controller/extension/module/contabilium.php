<?php
/**
* 2018 Contabilium.com
*
* Modulo para la conexion de Opencart con Contabilium
*
*  @author    David Suarez <info@davidsuarez.com.ar>
*  @copyright Contabilium S.A.
*/
class ControllerExtensionModuleContabilium extends Controller {
    private $api_base = 'https://rest.contabilium.com/';
    private $error = array(); 

    private function getSingleProduct($id)
    {
        $data = false;
        
        $this->load->library('contabilium');
        $obj_curl = Contabilium::get_instance($this->registry);
        
        if ($id) { //= filter_var($id, FILTER_VALIDATE_INT)
            try {
                $data = $obj_curl->get($this->api_base . 'api/conceptos/getByCodigo?codigo=' . $id);
                if (isset($data->Message)) {
                    $this->log($data->Message);
                    throw new Exception($data->Message);
                }
            } catch(Exception $e) {
                 $this->log("Error al optener los datos desde la Contabilium API [" . $e->getMessage() . "]");
                throw new Exception("Error getting product from Contabilium API [" . $e->getMessage() . ']');
            }
        }

        return $data;
    }

    private function updateProduct($product_id, $price = null, $stock = null) {
        $this->load->model('extension/module/contabilium');

		$updatePrices = $this->config->get('module_contabilium_prices');
        $updateStock = $this->config->get('module_contabilium_stock');

		if($updatePrices["0"] && $updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateProduct($product_id, $price, $stock);
		} else if($updatePrices["0"]) {
			$update = $this->model_extension_module_contabilium->updateProductPrice($product_id, $price);
		} else if($updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateProductStock($product_id, $stock);
		}
		
		return $update;
    }
    
    private function updateOptionProduct($product_option_id, $price = null, $stock = null) {

		$this->load->model('extension/module/contabilium');

		$updatePrices = $this->config->get('module_contabilium_prices');
        $updateStock = $this->config->get('module_contabilium_stock');
		$update = false;

		if($updatePrices["0"] && $updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateOptionProduct($product_option_id, $price, $stock);
		} else if($updatePrices["0"]) {
			$update = $this->model_extension_module_contabilium->updateOptionProductPrice($product_option_id, $price);
		} else if($updateStock["0"]){
			$update = $this->model_extension_module_contabilium->updateOptionProductStock($product_option_id, $stock);
		}
		
		return $update;
	}

	public function index() {
        //Load settings model
        $this->load->model('setting/setting');
        $this->load->model('extension/module/contabilium');
        
        $active = $this->config->get('module_contabilium_active');

        if($active["0"] && $this->request->get['token']===$this->config->get('module_contabilium_token') && !empty($this->request->get['codigo'])){

            $this->load->library('contabilium');
            $obj_curl = Contabilium::get_instance($this->registry);
            $credentials = $obj_curl->token();
            if( $credentials ) {
                $item = $this->getSingleProduct($this->request->get['codigo']);

                if ($item && $id_product = $this->model_extension_module_contabilium->existsSku($item->Codigo)) {
                    if ($this->updateProduct($id_product, $item->Precio, $item->Stock)) { //// / (1 + $item->Iva / 100)
                        $this->log("Se actualizo el producto:".$id_product);
                        print "OK";
                    }
                } else if($item && $id_option_product = $this->model_extension_module_contabilium->existsOptionSku($item->Codigo)) {
                    if ($this->updateOptionProduct($id_option_product, $item->Precio, $item->Stock)) { //// / (1 + $item->Iva / 100)
                        $this->log("Se actualizo la opción de producto:".$id_option_product);
                        print "OK";
                    }
                } else {
                    print('ERROR-C003');
                }

                die();
            } else {
                die('ERROR-C002');
            }
        } 

        header('HTTP/1.0 404 not found');
        die('ERROR-C001');
    }

    public function sendorder(&$route, &$args) {
        try {
            $procesado = false;
            $order_id = false;

            if(is_array($args)){
                $order_id = $args[0];
                $order_status_id = $args[1];
            }
            
            $active = $this->config->get('module_contabilium_active');

            if($active[0] && $order_id){

                $accepted = $this->config->get('module_contabilium_accepted');
                $canceled = $this->config->get('module_contabilium_canceled');
                $contabilium_id = $this->config->get('module_contabilium_id');

                $this->load->model('checkout/order');
                $this->load->model('account/custom_field');
                $this->load->model('catalog/product');

                $dni = $this->model_account_custom_field->getCustomFields(["filter_name"=>"DNI"]);
                $ID = $this->model_account_custom_field->getCustomFields(["filter_name"=>"ID"]);
                
                $dni_field_id = 0;

                if(!empty($dni)) {
                    $dni_field_id = $dni[0]["custom_field_id"];
                } else if(!empty($ID)) {
                    $dni_field_id = $ID[0]["custom_field_id"];
                }

                if(in_array($order_status_id, $accepted) || in_array($order_status_id, $canceled)) {
                    
                    $v = explode('.', VERSION);

                    $orderInfo = $this->model_checkout_order->getOrder($order_id);
                    
                    if((int)$v[0]===3){
                        $orderProducts = $this->model_checkout_order->getOrderProducts($order_id);
                        $orderTotals = $this->model_checkout_order->getOrderTotals($order_id);
                    }

                    /* como en la version 2 el modelo de checkout/order no tiene dos metodos los agregamos */
                    if((int)$v[0]===2){
                        $this->load->model('extension/module/contabilium');
                        $orderProducts = $this->model_extension_module_contabilium->getOrderProducts($order_id);
                        $orderTotals = $this->model_extension_module_contabilium->getOrderTotals($order_id);
                    }
                    
                    if(in_array($order_status_id, $accepted)){
                        $orderStatus = "Aceptado";
                    } elseif(in_array($order_status_id, $canceled)) {
                        $orderStatus = "Cancelada";
                    }

                    $opencart = [
                        "Cliente" => [
                            "Nombre"=>  $orderInfo["payment_firstname"],
                            "Apellido"=> $orderInfo["payment_lastname"],
                            "TipoDocumento"=> "DNI",
                            "Documento"=> $orderInfo["custom_field"][$dni_field_id],
                            "Email"=> $orderInfo["email"],
                            "Telefono"=> $orderInfo["telephone"],
                            "LineaDireccion1"=> $orderInfo["payment_address_1"],
                            "LineaDireccion2"=> $orderInfo["payment_address_2"],
                            "Ciudad"=> $orderInfo["payment_city"],
                            "Provincia"=> $orderInfo["payment_zone"],
                            "Pais"=> $orderInfo["payment_country"],
                            "CodigoPostal"=> $orderInfo["payment_postcode"]
                        ],
                        "IDVentaIntegracion"=> $orderInfo["order_id"],  //Nro de la venta en el ecommerce 
                        "IDEstadoIntegracion"=> $orderStatus,
                        "IDIntegracion"=> $contabilium_id,
                        "CondicionVenta"=> $orderInfo["payment_method"],
                        "FechaEmision"=> date("Y-m-d", strtotime($orderInfo["date_added"])),
                        "Observaciones"=> sprintf("Referencia del Pedido: %s\nForma de Pago: %s", $order_id, $orderInfo["payment_method"]),   
                    ];
                    
                    $opencart['Items'] = array();
                    foreach ($orderProducts as $product) {
                        $productData = $this->model_catalog_product->getProduct($product["product_id"]);

                        $opencart['Items'][] = array(
                            'Cantidad' => $product['quantity'],
                            'Codigo' => $productData['sku'],
                            'Concepto' => $product['name'],
                            'PrecioUnitario' => $product['price'],
                            'Iva' => round($product['tax']*100/$product['price']),
                            'Bonificacion' => round($productData['price'] - $product['price']),
                        );
                    }

                    //// CALCULO DE ENVIO
                    if (!empty($orderInfo["shipping_code"]) && sizeof($orderTotals)>0) {
                        foreach($orderTotals as $total){
                            if($total["code"] === "shipping"){
                                $opencart['Items'][] = array(
                                    'Cantidad' => 1,
                                    'Codigo' => '',
                                    'Concepto' => sprintf('Envío (%s)', $total["title"]),
                                    'PrecioUnitario' => $total["value"],
                                    'Iva' => 21,
                                    'Bonificacion' => 0,
                                );
                            }
                        }  
                    }

                    $this->log("Procesar la orden: ".$order_id." estado:".$orderStatus);

                    $this->load->library('contabilium');
                    $obj_curl = Contabilium::get_instance($this->registry);

                    $error_count = 0;
                    do {
                        $result = $obj_curl->post($this->api_base . 'notificador/opencart', $opencart, false, false);
                        $error_count+=1;
                    } while ($result<0 && $error_count<3);

                    if($result > 0) {
                        $this->log($result);
                        $procesado = true;
                    } else {
                        $this->log("Se produjo un error al procesar la orden: ".$order_id." Contabilium respondio: ".$result);
                        $this->log($this->config->get('module_contabilium_error'));
                        $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('module_contabilium_error'), date('d/m/Y h:i') . ' - Error:' . $result, false, false);
                        $procesado = false;
                    }
                }
            }
        }
        
        catch(Exception $e) {
            $this->log($e->getMessage());
        }
		return $procesado;
    } 
    
    private function log($data=""){
		$log = new Log('contabilium.log');
		$log->write($data);
	}

}

