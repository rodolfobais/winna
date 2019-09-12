<?php
// Heading
$_['heading_title']             = 'MercadoPago'; //IMPORTANTE NO MODIFICAR ESTE NOMBRE!!!!

// Column
$_['column_order_id']           = 'ID ordem';
$_['column_date_added']         = 'Data Entrada';
$_['column_currency_code']      = 'Moeda';
$_['column_total']              = 'Total Ordem';
$_['column_customer']	        = 'Cliente';
$_['column_order_status']       = 'Estado';
$_['column_action'] 	        = 'Ação';

// Text
$_['text_payment']              = 'Payment';
$_['text_success']              = 'Sucesso: Você modificado com sucesso MercadoPago!';
$_['text_description_payment']  = 'Se você configurou sua senha IPN (sonda_key). A partir daqui você pode ver todas as suas transações foram feitas através do MercadoPago, o estado do mesmo e você ainda pode ver em tempo real de saber o estado de cada transação.';
$_['text_mercadopago']          = '<img src="view/image/payment/mercadopago.jpg" alt="MercadoPago" title="MercadoPago" style="border: 1px solid #EEEEEE;" />';
$_['text_argentina']	        = 'Argentina';
$_['text_brasil']		        = 'Brasil';
$_['text_colombia']		        = 'Colombia';
$_['text_chile']		        = 'Chile';
$_['text_mexico']		        = 'México';
$_['text_venezuela']	        = 'Venezuela';

// Tab
$_['tab_general']               = 'Configuração Geral';
$_['tab_transaction']           = 'Transações';

// Entry
$_['entry_country']             = 'País:<br /><span class="help">País onde se registou a sua conta (mercadolibre).</span>';
$_['entry_acc_id']              = 'Número de Conta (acc_id):';
$_['entry_enc']                 = 'Código validador de segurança (enc):';
$_['entry_sonda_key']           = 'Token (sonda_key):';
$_['entry_ipn']                 = 'IPN URL:<br /><span class="help">Esta é a url ser inscritas em sua conta do MercadoPago para permitir o sistema IPN.</span>';
$_['entry_total']               = 'Total:<br /><span class="help">O total deve ter o carrinho de compras, para ativar o módulo.</span>';
$_['entry_aprobado_status']     = 'Pedidos estado aprovado:';
$_['entry_pendiente_status']    = 'Pedidos estado pendente:';
$_['entry_cancelado_status']    = 'Pedidos estado cancelado:';
$_['entry_geo_zone']            = 'Geo Zona:';
$_['entry_status']              = 'Estado:';
$_['entry_sort_order']          = 'Ordem:';
$_['entry_debug']               = 'Debug:';

// Error
$_['error_permission']          = 'Atenção: Você não tem permissão para modificar MercadoPago!';
$_['error_acc_id']              = 'O número da conta (acc_id) é necessária';
$_['error_enc']                 = 'O código validador de segurança (enc) é necessário';
$_['error_sonda_key']           = 'O token (sonda_key) é necessário para o funcionamento adequado do IPN!';
$_['error_simplexml']           = 'A função simplexml do PHP deve ser ativado em seu servidor, você pode obter mais informações: http://www.php.net/manual/es/book.simplexml.php';
?>