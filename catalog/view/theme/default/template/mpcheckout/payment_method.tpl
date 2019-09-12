<div class="panel panel-default payment-method-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-credit-card"></i> <?php echo $panel_payment_method; ?> </h4>
  </div>
  <div class="panel-body">
    <?php if ($payment_methods) { ?>
      <?php $pay_counts = 1; foreach ($payment_methods as $payment_method) { ?>
      <div class="radio">
        <label>
          <?php $pay_class = $pay_counts == 1 ? 'pay_one' : ''; ?>
          <?php if ($payment_method['code'] == $code || !$code) { ?>
          <?php $code = $payment_method['code']; ?>
          <input type="radio" class="<?php echo $pay_class; ?>" name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
          <?php } else { ?>
          <input type="radio" class="<?php echo $pay_class; ?>" name="payment_method" value="<?php echo $payment_method['code']; ?>" />
          <?php } ?>
          
          <?php if(!empty($mpcheckout_payment_method_tables[$payment_method['code']]['thumb'])) { ?>
          <img src="<?php echo $mpcheckout_payment_method_tables[$payment_method['code']]['thumb']; ?>"> &nbsp;
          <?php } ?>

          <?php echo $payment_method['title']; ?>
          <?php if ($payment_method['terms']) { ?>
          (<?php echo $payment_method['terms']; ?>)
          <?php } ?>
        </label>
      </div>
      <?php $pay_counts++; } ?>
    <?php } ?>
    <div class="paymentmethod-loader"></div>
  </div>
</div>