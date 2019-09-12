<?php
// Heading
$_['heading_title'] = 'Mercado Pago';

// Text
$_['text_extension'] = 'Pago';
$_['text_success'] = '¡Has modificado el modulo de Mercado Pago correctamente!';
$_['text_mp_standard'] = '<a onclick="window.open(\'https://www.mercadopago.com\');" target="_blank"><img src="view/image/payment/mp_standard.png" alt="Mercado Pago" title="Mercado Pago" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_argentina'] = 'Argentina';
$_['text_brasil'] = 'Brasil';
$_['text_colombia'] = 'Colombia';
$_['text_chile'] = 'Chile';
$_['text_mexico'] = 'México';
$_['text_peru'] = 'Perú';
$_['text_venezuela'] = 'Venezuela';
$_['text_edit'] = 'Editar MercadoPago';

// Entry
$_['entry_notification_url'] = 'Tu URL de notificación es: ';
$_['entry_notification_url_tooltip'] = '<span class="help"> Esta URL se utilizará para notificar los cambios de estados de los pagos. Copie la URL y haga clic ' .
	'<a href="https://www.mercadopago.com/mco/herramientas/notificaciones" target="_blank">aquí</a>para configurarla en su cuenta Mercado Pago.</span>';
$_['entry_autoreturn'] = 'Regreso automático';
$_['entry_autoreturn_tooltip'] = '<span class="help"> Habilitar regreso automático a su tienda después del pago.</span>';
$_['entry_client_id'] = 'Client ID : ';
$_['entry_client_id_tooltip'] = 'Para obtener estos datos: <a href="https://www.mercadopago.com/mla/herramientas/aplicaciones" target="_blank">Argentina</a>, <a href="https://www.mercadopago.com/mlb/ferramentas/aplicacoes" target="_blank">Brasil</a>, <a href="https://www.mercadopago.com/mlc/herramientas/aplicaciones" target="_blank">Chile</a>, <a href="https://www.mercadopago.com/mco/herramientas/aplicaciones" target="_blank">Colombia</a>, <a href="https://www.mercadopago.com/mlm/herramientas/aplicaciones" target="_blank">México</a>, <a href="https://www.mercadopago.com/mpe/herramientas/aplicaciones" target="_blank">Perú</a>, o <a href="https://www.mercadopago.com/mlv/herramientas/aplicaciones" target="_blank">Venezuela</a>.';

$_['entry_client_secret'] = 'Client Secret : ';
$_['entry_client_secret_tooltip'] = 'Para obtener estos datos: <a href="https://www.mercadopago.com/mla/herramientas/aplicaciones" target="_blank">Argentina</a>, <a href="https://www.mercadopago.com/mlb/ferramentas/aplicacoes" target="_blank">Brasil</a>, <a href="https://www.mercadopago.com/mlc/herramientas/aplicaciones" target="_blank">Chile</a>, <a href="https://www.mercadopago.com/mco/herramientas/aplicaciones" target="_blank">Colombia</a>, <a href="https://www.mercadopago.com/mlm/herramientas/aplicaciones" target="_blank">México</a>, <a href="https://www.mercadopago.com/mpe/herramientas/aplicaciones" target="_blank">Perú</a>, o <a href="https://www.mercadopago.com/mlv/herramientas/aplicaciones" target="_blank">Venezuela</a>.';

$_['entry_installments'] = 'Cantidad Máxima de Cuotas';
$_['entry_payments_not_accept'] = 'Seleccione los medios de pagos:';
$_['entry_payments_not_accept_tooltip'] = '<b>Importante:</b> Si cambia el país de venta, espere que carguen de los nuevos medios de pago y después seleccione los medios que va a aceptar.</span>';
$_['entry_status'] = 'Estado:';
$_['entry_country'] = 'País de venta:';
$_['entry_sort_order'] = 'Posición:';

$_['entry_url'] = 'URL de la tienda: ';
$_['entry_url_tooltip'] = '<span class="help"> Inserte la URL de instalación de tu tienda<br /> (Siempre escriba la URL con <b>http://</b> o <b>https://</b> )<br/><i>Ejemplo: http://www.mitienda.com/tienda/</i><br /></span>';
$_['entry_debug'] = 'Modo Debug:';
$_['entry_debug_tooltip'] = '<span class="help">Habilita para exhibir los errores de checkout en el log de OpenCart</span>';

$_['entry_sandbox'] = 'Modo Sandbox: ';
$_['entry_sandbox_tooltip'] = '<span class="help">Sandbox es utilizado para hacer pruebas con Checkout e IPN sin necesitar de una tarjeta de credito real para hacer los pagos.</span>';
$_['entry_type_checkout'] = 'Tipo de Checkout: ';
$_['entry_category'] = 'Categoría:';
$_['entry_category_tooltip'] = '<span class="help">La categoría de su tienda</span>';

$_['entry_order_status'] = 'Estado estándar de ventas: ';
$_['entry_order_status_general'] = 'Elige los estado exhibidos cuando las ventas estuvieren: ';
$_['entry_order_status_tooltip'] = '<span class="help">Elije los estado estándar de tus ventas.</span>';
$_['entry_order_status_completed'] = 'Completa:';
$_['entry_order_status_completed_tooltip'] = '<span class="help"> Elije el estado cuando el pago es <b>aprobado</b></span>';
$_['entry_order_status_pending'] = 'Pendiente:';
$_['entry_order_status_pending_tooltip'] = '<span class="help">Elije el estado cuando el pago es <b>pendiente</b></span>';
$_['entry_order_status_canceled'] = 'Canceleda:';
$_['entry_order_status_canceled_tooltip'] = '<span class="help">Elije el estado cuando el pago es <b>cancelado</b> </span>';
$_['entry_order_status_in_process'] = 'En Progreso:';
$_['entry_order_status_in_process_tooltip'] = '<span class="help">Elije el estado cuando el pago esta <b>en análisis</b></span>';
$_['entry_order_status_rejected'] = 'Rechazada:';
$_['entry_order_status_rejected_tooltip'] = '<span class="help">Elije el estado cuando el pago es <b>rechazado</b></span>';
$_['entry_order_status_refunded'] = 'Reembolsado:';
$_['entry_order_status_refunded_tooltip'] = '<span class="help">Elije el estado cuando el pago es <b>devuelto</b></span>';
$_['entry_order_status_in_mediation'] = 'Mediación:';
$_['entry_order_status_in_mediation_tooltip'] = '<span class="help">Elije el estado cuando el pago esta en <b>mediación</b></span>';
$_['entry_order_status_chargeback'] = 'En Camino:';
$_['entry_order_status_chargeback_tooltip'] = '<span class="help">Elije el estado cuando el pago esta <b>contracargado</b></span>';
$_['entry_public_key'] = 'Public key:';
$_['entry_public_key_tooltip'] = '<span class="help">Public key para utilizar el checkout personalizado. Para obtenerla, haga click <a target="_blank" href="https://www.mercadopago.com/mco/account/credentials">aquí</a></span>';
$_['entry_access_token'] = 'Access Token:';
$_['entry_access_token_tooltip'] = '<span class="help">Access Token para utilizar el checkout personalizado. Para obtenerlo, haga click <a target="_blank" href="https://www.mercadopago.com/mco/account/credentials">aquí</a></span>';

// Error
$_['error_permission'] = 'Lo siento, no tienes permiso para modificar Mercado Pago';
$_['error_client_id'] = 'Lo siento, el <b>Client Id</b> es obligatorio.';
$_['error_client_secret'] = 'Lo siento, el <b>Client Secret</b> es obligatorio.';

// installments
$_['36'] = '36';
$_['24'] = '24';
$_['18'] = '18';
$_['15'] = '15';
$_['12'] = '12';
$_['11'] = '11';
$_['10'] = '10';
$_['9'] = '9';
$_['8'] = '8';
$_['7'] = '7';
$_['6'] = '6';
$_['5'] = '5';
$_['4'] = '4';
$_['3'] = '3';
$_['2'] = '2';
$_['1'] = '1';
?>