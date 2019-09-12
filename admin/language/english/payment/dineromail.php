<?php
/**
 * Gateway de Dineromail para Opencart
 * 
 * @author Raúl Salamanca
 * @version 1.0
 * @package dineromail.opencart
 */
?>
<?php
$_['heading_title']             = 'Dineromail';
$_['text_payment']              = 'Pago';
$_['text_success']              = 'Correcto: Ha modificado los detalles de Dineromail!';
$_['text_dineromail']	        = '<a onclick="window.open(\'https://www.dineromail.com/\');"><img src="view/image/payment/dineromail.png" alt="Dineromail" title="Dineromail" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_left']                 = 'A la izquierda';
$_['text_center']               = 'En el centro';
$_['text_image_manager']        = 'Administrador de imágenes';
$_['text_additional_var']       = '<h3>Campos adicionales</h3>En esta opción podrá agregar campos adicionales en el proceso de pago de Dineromail, para así poder recaudar información relevante para la compra de los productos';
$_['text_config']               = '<h3>Configuración básica</h3>Aquí podrá configurar las atributos básicos del gateway de Dineromail';
$_['text_design']               = '<h3>Diseño y customización</h3>Podrá customizar y manipular a su gusto los colores pertenecientes al proceso de pago de Dineromail';
$_['text_help']                 = '<h3>Ayuda</h3>¿Tienes alguna consulta respecto a como configurar el gateway? aquí están las respuestas a las preguntas más básicas respecto a la configuración del mismo';
$_['button_add']                = 'Agregar campo';
$_['button_remove']             = 'Borrar campo';
$_['tab_config']                = 'Configuración';
$_['tab_design']                = 'Diseño';
$_['tab_additional_var']        = 'Campos adicionales';
$_['tab_help']                  = 'Ayuda';
$_['entry_pending_status_id']   = 'Estado de la orden "Pendiente"<br /><span class="help">Estado de orden que se asignará cuando Dineromail informe que el pago está pendiente</span>';
$_['entry_completed_status_id'] = 'Estado de la orden "Completada"<br /><span class="help">Estado de orden que se asignará cuando Dineromail informe que el pago ha sido concretado o completado</span>';
$_['entry_canceled_status_id']  = 'Estado de la orden "Cancelada"<br /><span class="help">Estado de la orden que se asignará cuando Dineromail informe que el pago ha sido cancelado</span>';
$_['entry_ipn_password']        = 'Contraseña del IPN<br /><span class="help">Recuerda que esta contraseña debes generarla en tu panel de Dineromail</span>';
$_['entry_order_status']        = 'Estado del pedido:';
$_['entry_geo_zone']            = 'Geozona:';
$_['entry_buyer_message']       = 'Permitir mensajes:<br /><span class="help">Permite que los usuarios dejen un mensaje/comentario en el pago desde dineromail (no en nuestra tienda! el mensaje quedará en dineromail solamente).</span>';
$_['entry_status']              = 'Estado:';
$_['entry_total']               = 'Total:<br /><span class="help">Ingrese aquí el monto total que debe superar el usuario para tener la posibilidad de pagar mediante este medio.</span>';
$_['entry_sort_order']          = 'Orden:';
$_['entry_merchant']  	        = 'ID Comercio<br /><span class="help">(Ej: 0<b style="color:#FF0000"><i>333222</i></b>/1)</span>';
$_['entry_country']  	        = 'País del comercio:';
$_['entry_language']  	        = 'Lenguaje de Dineromail:<br /><span class="help">Utilizado para el lenguaje de la interface de Dineromail.</span>';
$_['entry_payment']  	        = 'Medios de Pagos:<br /><span class="help">Seleccione de la lista los medios de pago que desea habilitar.';
$_['entry_image']  	        = 'Imágen:<br /><span class="help">Usted puede ingresar aquí una imagen (puede ser su logo) a mostrar en el proceso de pago reemplazando al logo de dineromail.<br /> Si utiliza un banner para todo el ancho del header, recuerde que el mismo no puede ser superior a <b>760px de ancho!</b></span>';
$_['entry_header_width']        = 'Posición:<br /><span class="help">Selecciona aquí la posición a donde quieres mostrar tu logo/imagen dentro de dineromail. Te recomiendo que si tu imagen ocupa todo el ancho del header utilices mostrarla en el centro!</b></span>';
$_['entry_PM']                  = 'Medio de pago:<br /><span class="help">Mostrar el paso de los Medios de Pago desplegado.</span>';
$_['entry_AD']                  = 'Campos/Variables Adicionales:<br /><span class="help">Mostrar el paso de las variables adicionales desplegado.</span>';
$_['entry_sale_detail']         = 'Detalle de la compra:<br /><span class="help">Mostrar el detalle de la compra desplegado.</span>';
$_['entry_step_color']          = 'Color del pasos:<sup>1</sup><br /><span class="help">Color del fondo de <b>PASOS inactivos</b> y fondo del título del detalle.</span>';
$_['entry_hover_step_color']    = 'Color del paso inactivo:<br /><span class="help">Color del fondo de <b>PASO activo</b> (en estado hover).</span>';
$_['entry_button_color']        = 'Color de fondo botón:<br /><span class="help">Color del fondo de los botones.</span>';
$_['entry_links_color']         = 'Color de los link:<br /><span class="help">Color de los Links, Total, Subtotal de Descuento y flechas de títulos.</span>';
$_['entry_font_color']          = 'Color de la letra:<br /><span class="help">Color de fuente (letra) de la página.</span>';
$_['entry_border_color']        = 'Color del borde:<br /><span class="help">Color de bordes de tablas y borde de los botones.</span>';
$_['entry_var_description']     = 'Descripción';
$_['entry_var_value']           = 'Valor';
$_['entry_var_visible']         = 'Ocultar';
$_['entry_var_required']        = 'Oligatório';
$_['error_permission']          = 'ADVERTENCIA: No tiene permisos para modificar los datos de Dineromail';
$_['error_image_left']          = 'ERROR: Imagen demasiado grande, recuerde que la imagen alineada sobre la izquierda deberá medir <b>200px de ancho</b> como máximo y <b>100px de alto</b> como máximo y la que intenta subir usted, mide <b>%spx</b> de ancho y <b>%spx</b> de alto!';
$_['error_image_center']        = 'ERROR: Imagen demasiado grande, recuerde que la imagen alineada en el centro deberá medir <b>760px de ancho</b> como máximo y <b>100px de alto</b> como máximo y la que intenta subir usted, mide <b>%spx</b> de ancho y <b>%spx</b> de alto!';
$_['error_image_mime']          = 'ERROR: Usted está intentado subir un formato de imagen que no esta soportado por Dineromail, recuerde que solo podrá mostrar imagenes del tipo <b>JPG o GIF</b>!';
?>