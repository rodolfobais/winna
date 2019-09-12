<?php
// Heading
$_['heading_title']             = 'MercadoPago'; //IMPORTANTE NO MODIFICAR ESTE NOMBRE!!!!

// Column
$_['column_order_id']           = 'ID Orden';
$_['column_date_added']         = 'Fecha Ingreso';
$_['column_currency_code']      = 'Divisa';
$_['column_total']              = 'Total Orden';
$_['column_customer']	        = 'Cliente';
$_['column_order_status']       = 'Estado';
$_['column_action'] 	        = 'Acción';

// Text
$_['text_payment']              = 'Payment';
$_['text_success']              = 'Éxito: Has modificado MercadoPago exitosamente!';
$_['text_description_payment']  = 'Si tienes configurado tu clave secreta IPN (sonda_key). Desde aquí puedes ver todas tus transacciones que se han realizado por medio de MercadoPago, el estado de las mismas y hasta puedes hacer una consulta en tiempo real para conocer la situación de cada transacción.';
$_['text_mercadopago']          = '<img src="view/image/payment/mercadopago.jpg" alt="MercadoPago" title="MercadoPago" style="border: 1px solid #EEEEEE;" />';
$_['text_argentina']	        = 'Argentina';
$_['text_brasil']		        = 'Brasil';
$_['text_colombia']		        = 'Colombia';
$_['text_chile']		        = 'Chile';
$_['text_mexico']		        = 'México';
$_['text_venezuela']	        = 'Venezuela';

// Tab
$_['tab_general']               = 'Configuración General';
$_['tab_transaction']           = 'Transacciones';

// Entry
$_['entry_country']             = 'País:<br /><span class="help">País donde tiene registrada su cuenta.</span>';
$_['entry_acc_id']              = 'Número de cuenta (acc_id):';
$_['entry_enc']                 = 'Código validador de seguridad (enc):';
$_['entry_sonda_key']           = 'Token (sonda_key):';
$_['entry_ipn']                 = 'IPN URL:<br /><span class="help">Esta es la url que deberá ingresar en su cuenta de MercadoPago para habilitar el sistema de IPN (Notificación de pago instantánea).</span>';
$_['entry_total']               = 'Total:<br /><span class="help">El total que debe tener el carrito de compras para que el modulo se active.</span>';
$_['entry_aprobado_status']     = 'Estado de las ordenes Aprobadas:';
$_['entry_pendiente_status']    = 'Estado de las ordenes Pendientes:';
$_['entry_cancelado_status']    = 'Estado de las ordenes Canceladas:';
$_['entry_geo_zone']            = 'Geo Zona:';
$_['entry_status']              = 'Estado:';
$_['entry_sort_order']          = 'Orden:';
$_['entry_debug']               = 'Debug:';

// Error
$_['error_permission']          = 'Atención: Usted no tiene permisos para modificar MercadoPago!';
$_['error_acc_id']              = 'El número de cuenta (acc_id) es obligatorio!';
$_['error_enc']                 = 'El código validador de seguridad (enc) es obligatorio!';
$_['error_sonda_key']           = 'El Token (sonda_key) es obligatorio para el correcto funcionamiento del sistema IPN!';
$_['error_simplexml']           = 'La función simplexml de PHP debe estar habilitada, puede obtener más información ingresando a: http://www.php.net/manual/es/book.simplexml.php';
?>