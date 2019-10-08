<?php echo $header; 
$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); 
include('catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/template/new_elements/wrapper_top.tpl'); ?>

<style>
.titulo-mi-cuenta{
  border-style: solid; 
  border-width: 1px 0px;
}
.subtitulo-mi-cuenta{
  border-style: solid; 
  border-width: 0px 0px 2px 0px; 
  border-color: grey; 
  padding-top: 15px; 
  margin-bottom: 15px; 
  text-align: center;
  font-family: auto;
}

.titulo-links-informacion-de-la-cuenta{
  font-family: auto;
}
.links-informacion-de-la-cuenta{
  background-color: #e8ddcf;
  font-family: auto;
  height: 100px;
}
</style>


<h2 class="titulo-mi-cuenta"><?php echo $text_my_account; ?> </h2>

<div class="subtitulo-mi-cuenta" style="">
  <b>NECESIT&Aacute;S AYUDA?</b> ESCRIBINOS POR MAIL | INFORMACIÓN DE ENVÍO | CAMBIOS Y DEVOLUCIONES | 5411 4613 9691
</div>

<div class="col-sm-6">
  <div class="titulo-links-informacion-de-la-cuenta"><b>INFORMACIÓN DE LA CUENTA</b></div>
  <div class="links-informacion-de-la-cuenta">
    <ul class="list-unstyled">
      <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
      <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
      <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
      <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
    </ul>
  </div>
</div>

<?php if ($credit_cards) { ?>
  <div class="col-sm-6">
    <div class="titulo-links-informacion-de-la-cuenta"><b><?php echo $text_credit_card; ?></b></div>
    <div class="links-informacion-de-la-cuenta">
      <ul class="list-unstyled">
        <?php foreach ($credit_cards as $credit_card) { ?>
        <li><a href="<?php echo $credit_card['href']; ?>"><?php echo $credit_card['name']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
<?php } ?>

<div class="col-sm-6">
  <div class="titulo-links-informacion-de-la-cuenta"><b><?php echo $text_my_orders; ?></b></div>
  <div class="links-informacion-de-la-cuenta">
    <ul class="list-unstyled">
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
      <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
      <?php if ($reward) { ?>
      <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
      <?php } ?>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
      <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
    </ul>
  </div>
</div>

<div class="col-sm-6">
  <div class="titulo-links-informacion-de-la-cuenta"><b><?php echo $text_my_newsletter; ?></b></div>
  <div class="links-informacion-de-la-cuenta">
    <ul class="list-unstyled">
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
</div>
  
<?php include('catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/template/new_elements/wrapper_bottom.tpl'); ?>
<?php echo $footer; ?>