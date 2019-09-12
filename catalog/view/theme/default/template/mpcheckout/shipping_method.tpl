<div class="panel panel-default shipping-method-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-truck fa-flip-horizontal"></i> <?php echo $panel_shipping_method; ?> </h4>
  </div>
  <div class="panel-body">
    <?php if ($shipping_required) { ?>
    <?php if ($shipping_methods) { ?>
      <?php $ship_counts = 1; foreach ($shipping_methods as $key => $shipping_method) { ?>
      <p><strong><?php echo $shipping_method['title']; ?></strong></p>
      <?php if (!$shipping_method['error']) { ?>
      <?php foreach ($shipping_method['quote'] as $quote) { ?>
      <div class="radio">
        <label>
          <?php $ship_class = $ship_counts == 1 ? 'ship_one' : ''; ?>
          <?php if ($quote['code'] == $code || !$code) { ?>
          <?php $code = $quote['code']; ?>
          <input type="radio" class="<?php echo $ship_class; ?>" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" />
          <?php } else { ?>
          <input type="radio" class="<?php echo $ship_class; ?>" name="shipping_method" value="<?php echo $quote['code']; ?>" />
          <?php } ?>
          
          <?php if(!empty($mpcheckout_shipping_method_tables[$key]['thumb'])) { ?>
          <img src="<?php echo $mpcheckout_shipping_method_tables[$key]['thumb']; ?>"> &nbsp;
          <?php } ?>

          <?php echo $quote['title']; ?> - <?php echo $quote['text']; ?></label>
      </div>
      <?php } ?>
      <?php } else { ?>
      <div class="alert alert-danger warning"><?php echo $shipping_method['error']; ?></div>
      <?php } ?>
      <?php $ship_counts++; } ?>
    <?php } ?>
    <?php } else { ?>
      <div class="mp-alert">
        <i class="fa fa-bell-o" aria-hidden="true"></i>
        <div class="malert-text"><?php echo $text_norequire_smethod; ?></div>
      </div>
    <?php } ?>
    <div class="shippingmethod-loader"></div>
  </div>
</div>