<?php echo $header; ?>
<div id="container" class="container mp-container <?php echo $themeclass; ?> mp-temp2">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($attention) { ?>
  <div class="alert alert-info info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($customer_message) { ?>
    <div class="customer-message">
    <?php echo $customer_message; ?>
    </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <?php if($background_container_heading) { ?>
        <h1 class="q-heading"><?php echo $heading_title; ?></h1>
      <?php } else { ?>
        <h1><?php echo $heading_title; ?></h1>
      <?php } ?>
      <div class="mp-checkout" id="mp-checkout">
        <div class="content-tab">
          <div class="row">
            <div class="col-sm-4 xl-40 xs-100 sm-100 register-panel">
              <?php if(!$logged) { ?>
                 <div class="register-panel">
                    <div class="account-option-buttons">
                      <?php echo $account_option_button_controller; ?>
                    </div>
                  </div>
              <?php } ?>
              <div class="<?php echo !$logged ? 'account-option-form' : ''; ?>">
                <?php if(!$logged) { ?>
                <div class="account-login <?php echo $default_account_button == 'login' ? '' : 'hide'; ?>"><?php echo $login_controller; ?></div>
                <?php } ?>

                <div class="account-signup <?php echo (!$logged && $default_account_button == 'login') ? 'hide' : ''; ?>">
                  <?php if(!$logged) { ?>
                  <?php echo $signup_controller; ?>
                  <?php } ?>

                  <?php if($logged) { ?>
                  <?php echo $payment_address_controller; ?>
                  <?php } ?>

                  <?php if($logged) {
                    if($delivery_address_check) {
                      $style_attr = 'style="display: none;"';
                    } else {
                      $style_attr = '';
                    }
                  } else {
                    if($delivery_address_check) {
                      $style_attr = 'style="display: none;"';
                    } else {
                      $style_attr = '';
                    }
                  } ?>
                  <div class="shipping-addresses" <?php echo $style_attr; ?>>
                  <?php echo $shipping_address_controller; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 xl-60 xs-100 sm-100 journal-mleft">
              <div class="row">
                <div class="col-sm-12 col-md-12 xl-50 md-50 sm-100 xs-100 payment_methods">
                  <?php echo $payment_method_controller; ?>
                </div>
                <div class="col-sm-12 col-md-12 xl-50 md-50 sm-100 xs-100 shipping_methods">
                  <?php echo $shipping_method_controller; ?>
                </div>
              </div>
              <?php if($delivery_date_status) { ?>
              <?php 
              if($shipping_required) {
                $delivery_date_class = '';
              } else{
                $delivery_date_class = 'hide';
              }
              ?>
              <div class="row delivery_date_status <?php echo $delivery_date_class; ?>">
                <div class="col-sm-12 xl-100 xs-100 delivery_date">
                <?php echo $delivery_date_controller; ?>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="col-sm-4">
              <?php if($cart_status) { ?>
                <div class="shoppingcart"><?php echo $shoppingcart_controller; ?></div>
              <?php } ?>
              <div class="checkout-button-position">
                  <div class="panel panel-default mp-comments comment-panel blur">
                    <div class="panel-heading <?php echo empty($show_comment) ? 'hide' : ''; ?>">
                      <h4 class="panel-title">
                        <i class="fa fa-comments" aria-hidden="true"></i> 
                        <span><?php echo $panel_confirm_order ?></span>
                      </h4>
                    </div>
                    <div class="panel-body <?php echo empty($show_comment) ? 'border-top' : ''; ?>">
                      <?php echo $checkout_button_controller; ?>
                    </div>
                    <div class="mpdisable"></div>
                  </div>
                </div> 
            </div>
          </div>
        </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
    <?php echo $checkout_style_controller; ?>
</div>
<?php echo $footer; ?>