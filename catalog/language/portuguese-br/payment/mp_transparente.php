<?php
// Text
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$admin = strpos($url, 'admin') !== FALSE ? '' : './admin/';
$_['text_title'] = '<img src="' . $admin . 'view/image/payment/mp_transparente.png" alt="Mercadopago" title="Mercadopago" style="border: 1px solid #EEEEEE; background-color: white;"> - Cartão de Crédito';
$_['currency_no_support'] = 'A moeda selecionada não é aceita pelo Mercadopago';
$_['ccnum_placeholder'] = 'Número do cartão';
$_['expiration_date_placeholder'] = 'Data de expiração';
$_['name_placeholder'] = 'Nome (como escrito no cartão)';
$_['doctype_placeholder'] = 'Tipo de documento';
$_['docnumber_placeholder'] = 'Número do documento';
$_['expiration_month_placeholder'] = 'Mês de expiração';
$_['expiration_year_placeholder'] = 'Ano de expiração';
$_['installments_placeholder'] = 'Parcelas';
$_['issuer_placeholder'] = 'Banco Emissor';
$_['cardType_placeholder'] = 'Tipo de cartão';
$_['error_invalid_payment_type'] = 'Este meio de pagamento não é aceito';

$_['habilitar_cupom_desconto'] = 'Habilitar Cupom de Desconto:';
$_['aplicar'] = 'Aplicar';
$_['aguarde'] = 'Aguarde';
$_['cupom_obrigatorio'] = 'Cupom é obrigatório.';
$_['campanha_nao_encontrado'] = 'Não foi encontrado uma campanha com o cupom informado.';
$_['cupom_nao_pode_ser_aplicado'] = 'O cupom não pode ser aplicado para esse valor.';
$_['remover'] = 'Remover';

$_['cupom_utilizado'] = 'Cupom já utilizado.';
$_['cupom_invalido'] = 'Por favor entre com um cupom válido.';
$_['valor_minimo_invalido'] = 'Sua compra não atingiu o valor mínimo ou o montante máximo.';
$_['erro_validacao_cupom'] = 'Um erro ocorreu durante a validação do cupom. Tente novamente.';

$_['payment_processing'] = "Processando o pagamento.";
$_['payment_title'] = "Pagamento";
$_['payment_button'] = "Pagar";
$_['other_card_option'] = "Outro Cartão";
$_['S200'] = 'Pagamento aprovado!';
$_['S201'] = $_['S200'];
$_['S2000'] = 'Pagamento não encontrado';
$_['S4'] = 'Caller não autorizado a acessar este recurso.';
$_['S2041'] = 'Apenas adminstradores podem executar a ação requisitada.';
$_['S3002'] = 'Caller não autorizado a  executar esta ação. ';
$_['S1'] = 'Erro nos parâmetros';
$_['S3'] = 'Token deve ser de teste';
$_['S5'] = ' É necessário prover o seu token de acesso para prosseguir.';
$_['S1000'] = 'Número de linhas excede o limite.';
$_['S1001'] = "Formato de data deve ser yyyy-MM-dd'T'HH:mm:ss.SSSZ.";
$_['S2001'] = ' Requisição já enviada no minuto anterior.';
$_['S2004'] = 'POST para a API de Gateway Transactions falhou.';
$_['S2002'] = 'Customer não encontrado.';
$_['S2006'] = 'Card Token não encontrado.';
$_['S2007'] = 'Conexãocom a API de Card Token falhou.';
$_['S2009'] = "Card token issuer não pode ser nulo.";
$_['S2010'] = 'Cartão não encontrado.';
$_['S2013'] = 'profileId inválido';
$_['S2014'] = 'reference_id inválido';
$_['S2015'] = 'Escopo inválido';
$_['S2016'] = 'Status inválido para atualização';
$_['S2017'] = 'transaction_amount inválido para atualização';
$_['S2018'] = 'A ação requisitada não é válida para o estado atual de pagamento.';
$_['S2020'] = 'Customer não tem permissão de operar.';
$_['S2021'] = 'Collector não tem permissão de operar.';
$_['S2022'] = 'Você excedeu o número máximo de estornos para esse pagamento.';
$_['S2024'] = 'Pagamento fora do período de estorno.';
$_['S2025'] = 'Operation type não permitido para estorno.';
$_['S2027'] = 'A ação requisitada não é válida para esse tipo de pagamento.';
$_['S2029'] = 'Pagamento sem movimentação.';
$_['S2030'] = "Collector não tem saldo disponível.";
$_['S2031'] = "Collector não tem saldo suficiente disponível.";
$_['S2034'] = 'Usuários inválidos envolvidos.';
$_['S2035'] = 'Parâmetros inválidos para a API de preferências.';
$_['S2036'] = 'Contexto inválido.';
$_['S2038'] = 'campaign_id inválido.';
$_['S2039'] = 'coupon_code inválido.';
$_['S2040'] = "Email do usuário não existe.";
$_['S2060'] = "Vendedor e comprador não podem ser o mesmo usuário.";
$_['S3000'] = 'Você deve preencher o campo "Nome" igual ao que está no seu cartão.';
$_['S3001'] = 'Você deve prover o cardissuer_id com os dados do seu cartão';
$_['S3003'] = 'card_token_id inválido';
$_['S3004'] = 'site_id inválido';
$_['S3005'] = ' Ação inválida, o rescurso encontra-se em um estado que não permite esse operação. Para maiores informações, veja o estado em que está o recurso.';
$_['S3006'] = 'cardtoken_id inválido.';
$_['S3007'] = ' O parâmetro client_id não pode ser nulo ou vazio.';
$_['S3008'] = 'Cardtoken não encontrado.';
$_['S3009'] = 'client_id não autorizado.';
$_['S3010'] = 'Cartão não encontrado na white list.';
$_['S3011'] = 'payment_method não encontrado.';
$_['S3012'] = 'security_code_length inválido.';
$_['S3013'] = 'O parâmetro security_code  é um campo obrigatório e não pode ser nulo ou vazio.';
$_['S3014'] = 'payment_method inválido';
$_['S3015'] = 'Quantidade de dígitos do cartão inválida.';
$_['S3016'] = 'Número de cartão inválido.';
$_['S3017'] = 'O parâmetro card_number_id não pode ser nulo ou vazio.';
$_['S3018'] = 'O parâmetro expiration_month não pode ser nulo ou vazio.';
$_['S3019'] = 'O parâmetro expiration_year não pode ser nulo ou vazio.';
$_['S3020'] = 'O parâmetro cardholder.name não pode ser nulo ou vazio.';
$_['S3021'] = 'O parâmetro cardholder.document.number não pode ser nulo ou vazio.';
$_['S3022'] = 'O parâmetro cardholder.document.type não pode ser nulo ou vazio.';
$_['S3023'] = 'O parâmetro cardholder.document.subtype não pode ser nulo ou vazio.';
$_['S3024'] = 'Ação inválida - estorno parcial não suportado para essa transação.';
$_['S3025'] = 'Auth Code inválido.';
$_['S3026'] = 'card_id inválido para este payment_method_id';
$_['S3027'] = 'payment_type_id inválido.';
$_['S3028'] = 'payment_method_id inválido.';
$_['S3029'] = 'Mês de expiração do cartão inválido.';
$_['S3030'] = 'Ano de expiração do cartão inválido.';
$_['S4000'] = "Atributo do cartão não pode ser nulo.";
$_['S4001'] = "payment_method_id não pode ser nulo.";
$_['S4002'] = "transaction_amount não pode ser nulo.";
$_['S4003'] = 'transaction_amount deve ser numérico.';
$_['S4004'] = "installments não pode ser nulo.";
$_['S4005'] = 'installments deve ser numérico.';
$_['S4006'] = 'payer em formato incorreto';
$_['S4007'] = "site_id não pode ser nulo.";
$_['S4012'] = "payer.id não pode ser nulo.";
$_['S4013'] = "payer.type não pode ser nulo.";
$_['S4015'] = "payment_method_reference_id não pode ser nulo.";
$_['S4016'] = "payment_method_reference_id deve ser numérico.";
$_['S4017'] = "status não pode ser nulo.";
$_['S4018'] = "payment_id não pode ser nulo.";
$_['S4019'] = "payment_id deve ser numérico.";
$_['S4020'] = "notificaction_url deve ser uma URL válida.";
$_['S4021'] = "notificaction_url deve ter menos de 500 caracteres.";
$_['S4022'] = "metadata deve ser um JSON válido.";
$_['S4023'] = "transaction_amount não pode ser nulo.";
$_['S4024'] = "transaction_amount deve ser numérico.";
$_['S4025'] = "refund_id não pode ser nulo.";
$_['S4026'] = "coupon_amount inválido.";
$_['S4027'] = "campaign_id deve ser numérico.";
$_['S4028'] = "coupon_amount deve ser numérico.";
$_['S4029'] = "payer type inválido.";
$_['S4037'] = "transaction_amount inválido.";
$_['S4038'] = "application_fee não pode ser maior do que transaction_amount.";
$_['S4039'] = "application_fee não pode ser um valor negativo.";
$_['S4050'] = "payer.email deve ser um email válido.";
$_['S4051'] = "payer.email deve ter menos de 254 caracteres.";

$_['T310'] = "Parâmetro inválido:  'internal_client_id'";
$_['T200'] = "O parâmetro 'public_key' precisa ter um valor válido";
$_['T302'] = "Parâmetro inválido:  'public_key'";
$_['T219'] = "O parâmetro 'client_id' precisa ter um valor válido";
$_['T315'] = "Parâmetro inválido:  'site_id'";
$_['T222'] = "O parâmetro 'site_id'é um campo obrigatório";
$_['T318'] = "Parâmetro inválido:  'card_number_id'";
$_['T304'] = "Parâmetro inválido:  'card_number_length'";
$_['T703'] = "Tamanho inválido do campo 'card_number_length'";
$_['T319'] = "Parâmetro inválido:  'trunc_card_number'";
$_['T701'] = "Tamanho inválido do campo 'trunc_card_number'";
$_['T321'] = "Parâmetro inválido:  'security_code_id'";
$_['T700'] = "Tamanho inválido do campo 'security_code_id'";
$_['T307'] = "Parâmetro inválido:  'security_code_length'";
$_['T704'] = "Tamanho inválido do campo 'security_code_length'";
$_['T305'] = "Dados do dono do cartão inválido.";
$_['T210'] = "O valor 'cardholder' não pode ser nulo";
$_['T316'] = "Parâmetro inválido:  'cardholder.name'";
$_['T211'] = "O valor 'cardholder.identification' não pode ser nulo";
$_['T322'] = "Parâmetro inválido:  'cardholder.identification.type'";
$_['T323'] = "Parâmetro inválido:  'cardholder.identification.subtype'";
$_['T213'] = "O parâmetro 'cardholder.identification.subtype' precisa ter um valor válido";
$_['T324'] = "Parâmetro inválido:  'cardholder.identification.number'";
$_['T325'] = "Parâmetro inválido:  'expiration_month'";
$_['T326'] = "Parâmetro inválido:  'cardExpirationYear'";
$_['T702'] = "Parâmetro inválido:  'expiration_year'";
$_['T301'] = "Data de expiração do cartão inválida";
$_['T317'] = "Parâmetro inválido:  'card_id'";
$_['T320'] = "Parâmetro inválido:  'luhn_validation'";
$_['TE111'] = "JSON inválido";
$_['TE114'] = "O Parâmetro cardholderName não pode ser nulo/empty";
$_['TE115'] = "O Parâmetro public_key não pode ser nulo/empty";
$_['TE202'] = "Parâmetro inválido:  cardNumber";
$_['TE203'] = "Parâmetro inválido:  securityCode";
$_['TE213'] = "Parâmetro inválido:  card_present";
$_['TE301'] = "invalid length O Parâmetro cardNumber";
$_['TE302'] = "invalid length O Parâmetro securityCode";
$_['TE305'] = "invalid length O Parâmetro docType";
$_['TE501'] = "public_key não encontrada";

$_['T205'] = "Digite o número do seu cartão.";
$_['T208'] = "Selecione um mês.";
$_['T209'] = "Selecione um ano.";
$_['T212'] = "Selecione um tipo de documento.";
$_['T213'] = "Enter your identification subtype.";
$_['T214'] = "Digite o número do seu documento";
$_['T220'] = "Selecione o banco emissor";
$_['T221'] = "Digite seu nome completo";
$_['T224'] = "Digite o código de segurança do cartão";
$_['TE301'] = "Há algo de errado com o número do seu cartão. Por favor, digite novamente.";
$_['TE302'] = "Cheque o código de segurança";
$_['T316'] = "Digite um nome válido";
$_['T322'] = "Verifique o tipo de documento.";
$_['T323'] = "Verifique o tipo de documento.";
$_['T324'] = "Verifique o número do documento.";
$_['T325'] = "Mês de expiração inválido.";
$_['T326'] = "Ano de expiração inválido.";

$_['S106'] = "Não é possível efetuar compras em outros países.";
$_['S109'] = "Escolha outro cartão.";
$_['S126'] = "Não foi possível processar seu pagamento.";
$_['S129'] = "Escolha outro cartão.";
$_['S145'] = "Não foi possível processar seu pagamento.";
$_['S150'] = "Você não pode efetuar pagamentos.";
$_['S151'] = "Você não pode efetuar pagamentos.";
$_['S160'] = "Não foi possível processar seu pagamento.";
$_['S204'] = "Método de pagamento indisponível. Escolha outro cartão.";
$_['S801'] = "Tente novamente em alguns minutos.";

// Credit Card messages
$_['accredited'] = "Seu pagamento foi recebido com sucesso!";
$_['pending_contingency'] = "Estamos processando o pagamento. Em menos de uma hora você receberá um e-mail com o resultado.";
$_['pending_review_manual'] = "Estamos processando o pagamento. Em até dois dias úteis enviaremos um email informado o sucesso da operação ou se precisamos de mais informações.";
$_['cc_rejected_bad_filled_card_number'] = "Verifique o número do cartão.";
$_['cc_rejected_bad_filled_date'] = "Verifique a data de expiração do cartão.";
$_['cc_rejected_bad_filled_other'] = "Verifique suas informações.";
$_['cc_rejected_bad_filled_security_code'] = "Verifique o código de segurança do cartão.";
$_['cc_rejected_blacklist'] = "Não foi possível processar seu pagamento.";
$_['cc_rejected_call_for_authorize'] = "Você deve solicitar a autorização do pagamento ao Mercado Pago à sua operadora de cartão";
$_['cc_rejected_card_disabled'] = "Ligue para sua operadora de cartão e ative seu cartão.";
$_['cc_rejected_card_error'] = "Não foi possível processar seu pagamento.";
$_['cc_rejected_duplicated_payment'] = "Você já escolheu um meio de pagamento para essa transação. Caso precise efetuar um novo pagamento, utilize outro cartão.";
$_['cc_rejected_high_risk'] = 'Seu pagamento foi rejeitado. Por favor, utilize outro cartão.';
$_['cc_rejected_insufficient_amount'] = "Seu cartão não possui saldo suficiente.";
$_['cc_rejected_invalid_installments'] = "Esta bandeira de cartão não permite parcelamento na quantidade de vezes escolhida.";
$_['cc_rejected_max_attempts'] = "Você atingiu o limite de tentativas. Escolha outro cartão.";
$_['cc_rejected_other_reason'] = "Sua operadora de cartão não processou o pagamento.";
