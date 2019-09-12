<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="mp-content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" name="savetype" value="savechanges" form="form-mpcheckout" data-toggle="tooltip" title="<?php echo $button_savechanges; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i> <?php echo $button_savechanges; ?></button>        
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $text_edit; ?></h3>
        <div class="pull-right">
          <span><?php echo $text_store; ?></span>
          <button type="button" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle"><span><?php echo $store_name; ?> &nbsp; &nbsp; </span> <i class="fa fa-angle-down"></i></button>
          <ul class="dropdown-menu pull-right">
            <li><a href="index.php?route=mpcheckout/mpcheckout&token=<?php echo $token; ?>&store_id=0"><?php echo $text_default; ?></a></li>
            <?php foreach($stores as $store) { ?>
            <li><a href="index.php?route=mpcheckout/mpcheckout&token=<?php echo $token; ?>&store_id=<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="panel-body">
        <div class="bs-callout bs-callout-info"> 
          <h4>ModulePoints Quick Checkout</h4> 
          <p><center><strong>MP-QC Version 1.0 </strong></center> <br/> 
          ModulePoints Team Offer excellent quick checkout solution for your online business. Most appealing feature of this extension is that Panels on checkout page is not flickers or jump in-out while selected checkout options by customers. Enjoy all its benefits right now.
           </p> 
        </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mpcheckout" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo $tab_general; ?></a></li>
            <li><a href="#tab-panel" data-toggle="tab"><i class="fa fa-bolt" aria-hidden="true"></i> <?php echo $tab_panel; ?></a></li>
            <li><a href="#tab-langsetting" data-toggle="tab"><i class="fa fa-language" aria-hidden="true"></i> <?php echo $tab_langsetting; ?></a></li>
            <li><a href="#tab-mpdesign" data-toggle="tab"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $tab_mpdesign; ?></a></li>
            <li><a href="#tab-theme" data-toggle="tab"><i class="fa fa-desktop" aria-hidden="true"></i> <?php echo $tab_theme; ?></a></li>
            <li><a href="#tab-successpage" data-toggle="tab"><i class="fa fa-file" aria-hidden="true"></i> <?php echo $tab_successpage; ?></a></li>
            <li><a href="#tab-support" data-toggle="tab"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?php echo $tab_modulepoints; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="mpcheckout_status" id="input-status" class="form-control">
                    <?php if ($mpcheckout_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-country"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_country; ?>"><?php echo $entry_country; ?></span></label>
                <div class="col-sm-10">
                  <select name="mpcheckout_country_id" id="input-country" class="form-control">
                    <?php foreach ($countries as $country) { ?>
                    <?php if ($country['country_id'] == $mpcheckout_country_id) { ?>
                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                  <?php if($error_country) { ?>
                  <div class="text-danger"><?php $error_country; ?></div>
                  <?php } ?>
                </div>
              </div>              
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-zone"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_zone; ?>"><?php echo $entry_zone; ?></span></label>
                <div class="col-sm-10">
                  <select name="mpcheckout_zone_id" id="input-zone" class="form-control"></select>
                  <?php if($error_zone) { ?>
                  <div class="text-danger"><?php echo $error_zone; ?></div>
                  <?php } ?>
                </div>
              </div>             
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-postcode"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_postcode; ?>"><?php echo $entry_postcode; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="mpcheckout_postcode" id="input-postcode" class="form-control" value="<?php echo $mpcheckout_postcode; ?>" />
                </div>
              </div>
              <div class="form-group mp-buttons">
                <label class="col-sm-2 control-label"><?php echo $entry_stopcartpage; ?></label>
                <div class="col-sm-3">
                  <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary <?php echo !empty($mpcheckout_stopcartpage) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_stopcartpage" value="1" <?php echo (!empty($mpcheckout_stopcartpage)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_yes; ?>                            
                    </label>
                    <label class="btn btn-primary <?php echo empty($mpcheckout_stopcartpage) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_stopcartpage" value="0" <?php echo (empty($mpcheckout_stopcartpage)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_no; ?>                            
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-panel">
              <div class="row">
                <div class="col-sm-3">
                  <ul class="nav nav-pills nav-stacked ostab" id="panels">
                    <li><a class="text-left" href="#navtab-account-buttons" data-toggle="tab"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <?php echo $navtabs_account_buttons; ?></a></li>
                    <li><a class="text-left" href="#navtab-account-panel" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $navtabs_account_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-social-panel" data-toggle="tab"><i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $navtabs_social_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-payment-address" data-toggle="tab"><i class="fa fa-location-arrow" aria-hidden="true"></i> <?php echo $navtabs_payment_address; ?></a></li>
                    <li><a class="text-left" href="#navtab-shipping-address" data-toggle="tab"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $navtabs_shipping_address; ?></a></li>
                    <li><a class="text-left" href="#navtab-payment-methods" data-toggle="tab"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $navtabs_payment_methods; ?></a></li>
                    <li><a class="text-left" href="#navtab-shipping-methods" data-toggle="tab"><i class="fa fa-truck" aria-hidden="true"></i> <?php echo $navtabs_shipping_methods; ?></a></li>
                    <li><a class="text-left" href="#navtab-date-panel" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $navtabs_date_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-shoppingcart" data-toggle="tab"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo $navtabs_shoppingcart; ?></a></li>
                    <li><a class="text-left" href="#navtab-checkout-order" data-toggle="tab"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $navtabs_checkout_order; ?></a></li>
                  </ul>
                </div>
                <div class="col-sm-9">
                  <div class="tab-content">
                    <div class="tab-pane" id="navtab-account-buttons">
                      <div class="bs-callout bs-callout-info"> 
                        <h4><?php echo $info_accountbutton; ?></h4> 
                        <p><?php echo $info_accountbutton_info; ?></p> 
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_account_buttons; ?>"><?php echo $entry_account_buttons; ?></span></label>
                        <div class="col-sm-5">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo (!empty($mpcheckout_account_button['account_buttons_status']) && in_array('register', $mpcheckout_account_button['account_buttons_status'])) ? 'active' : '';  ?>">
                              <input type="checkbox" name="mpcheckout_account_button[account_buttons_status][]" value="register" <?php echo (!empty($mpcheckout_account_button['account_buttons_status']) && in_array('register', $mpcheckout_account_button['account_buttons_status'])) ? 'checked="checked"' : '';  ?> />
                              <i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $text_register; ?>
                            </label>
                            <label class="btn btn-primary <?php echo (!empty($mpcheckout_account_button['account_buttons_status']) && in_array('guest', $mpcheckout_account_button['account_buttons_status'])) ? 'active' : '';  ?>">                            
                              <input type="checkbox" name="mpcheckout_account_button[account_buttons_status][]" value="guest" <?php echo (!empty($mpcheckout_account_button['account_buttons_status']) && in_array('guest', $mpcheckout_account_button['account_buttons_status'])) ? 'checked="checked"' : '';  ?> /> <i class="fa fa-user-secret" aria-hidden="true"></i> <?php echo $text_guest; ?>
                            </label>
                            <label class="btn btn-primary <?php echo (!empty($mpcheckout_account_button['account_buttons_status']) && in_array('login', $mpcheckout_account_button['account_buttons_status'])) ? 'active' : '';  ?>">                            
                              <input type="checkbox" name="mpcheckout_account_button[account_buttons_status][]" value="login" <?php echo (!empty($mpcheckout_account_button['account_buttons_status']) && in_array('login', $mpcheckout_account_button['account_buttons_status'])) ? 'checked="checked"' : '';  ?>  /> <i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $text_login; ?>
                            </label>
                          </div>
                          <?php if($error_account_buttons_status) { ?>
                          <br/>
                          <div class="text-danger"><?php echo $error_account_buttons_status; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_default_account_button; ?>"><?php echo $entry_default_account_button; ?></span></label>
                        <div class="col-sm-5">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo (!empty($mpcheckout_account_button['default_account_button']) && $mpcheckout_account_button['default_account_button'] == 'register') ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_button[default_account_button]" value="register" <?php echo (!empty($mpcheckout_account_button['default_account_button']) && $mpcheckout_account_button['default_account_button'] == 'register') ? 'checked="checked"' : '';  ?> />
                              <i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $text_register; ?>
                            </label>
                            <label class="btn btn-primary <?php echo (!empty($mpcheckout_account_button['default_account_button']) && $mpcheckout_account_button['default_account_button'] == 'guest') ? 'active' : '';  ?>">                            
                              <input type="radio" name="mpcheckout_account_button[default_account_button]" value="guest" <?php echo (!empty($mpcheckout_account_button['default_account_button']) && $mpcheckout_account_button['default_account_button'] == 'guest') ? 'checked="checked"' : '';  ?> /> <i class="fa fa-user-secret" aria-hidden="true"></i> <?php echo $text_guest; ?>
                            </label>
                            <label class="btn btn-primary <?php echo (!empty($mpcheckout_account_button['default_account_button']) && $mpcheckout_account_button['default_account_button'] == 'login') ? 'active' : '';  ?>">                            
                              <input type="radio" name="mpcheckout_account_button[default_account_button]" value="login" <?php echo (!empty($mpcheckout_account_button['default_account_button']) && $mpcheckout_account_button['default_account_button'] == 'login') ? 'checked="checked"' : '';  ?> /> <i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $text_login; ?>
                            </label>
                          </div>
                          <?php if($error_default_account_button) { ?>
                          <br/>
                          <div class="text-danger"><?php echo $error_default_account_button; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-account-panel">
                      <div class="form-group">
                        <label class="col-sm-12 control-label" for="input-customer-group"><span data-toggle="tooltip" title="<?php echo $help_customer_group; ?>"><?php echo $entry_customer_group; ?></span></label>
                        <div class="col-sm-12">
                          <select name="mpcheckout_account_panel[customer_group_id]" id="input-customer-group" class="form-control">
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if (!empty($mpcheckout_account_panel['customer_group_id']) && $customer_group['customer_group_id'] == $mpcheckout_account_panel['customer_group_id']) { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><span data-toggle="tooltip" title="<?php echo $help_account_terms; ?>"><?php echo $entry_account_terms; ?></span></label>
                        <div class="col-sm-12">
                          <select name="mpcheckout_account_panel[account_id]" class="form-control">
                            <option value="0"><?php echo $text_none; ?></option>
                            <?php foreach ($informations as $information) { ?>
                            <?php if (!empty($mpcheckout_account_panel['account_id']) && $information['information_id'] == $mpcheckout_account_panel['account_id']) { ?>
                            <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_default_account_id; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_account_panel['default_account_id']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[default_account_id]" value="1" <?php echo (!empty($mpcheckout_account_panel['default_account_id'])) ? 'checked="checked"' : '';  ?> />
                            <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_account_panel['default_account_id']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[default_account_id]" value="0" <?php echo (empty($mpcheckout_account_panel['default_account_id'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_newsletter_subscribe; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_account_panel['newsletter_subscribe']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[newsletter_subscribe]" value="1" <?php echo (!empty($mpcheckout_account_panel['newsletter_subscribe'])) ? 'checked="checked"' : '';  ?> />
                            <?php echo $text_enabled; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_account_panel['newsletter_subscribe']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[newsletter_subscribe]" value="0" <?php echo (empty($mpcheckout_account_panel['newsletter_subscribe'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_disabled; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_newsletter_subscribe_check; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_account_panel['newsletter_subscribe_check']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[newsletter_subscribe_check]" value="1" <?php echo (!empty($mpcheckout_account_panel['newsletter_subscribe_check'])) ? 'checked="checked"' : '';  ?> />
                            <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_account_panel['newsletter_subscribe_check']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[newsletter_subscribe_check]" value="0" <?php echo (empty($mpcheckout_account_panel['newsletter_subscribe_check'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                    	<label class="col-sm-12 control-label"><?php echo $entry_delivery_address_check; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_account_panel['delivery_address_check']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[delivery_address_check]" value="1" <?php echo (!empty($mpcheckout_account_panel['delivery_address_check'])) ? 'checked="checked"' : '';  ?> />
                            <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_account_panel['delivery_address_check']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_account_panel[delivery_address_check]" value="0" <?php echo (empty($mpcheckout_account_panel['delivery_address_check'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <br/>
                      <fieldset>
                        <legend><?php echo $legend_account_fields ?></legend>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td class="text-left"><?php echo $column_field_name; ?></td>
                              <td class="text-right"><?php echo $column_status; ?></td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($account_fields as $field) { ?>
                            <?php 
                            if($field['code'] == 'email' || $field['code'] == 'password') { 
                              $hide_class = 'hide';
                            } else {
                              $hide_class = '';
                            }
                            ?>
                            <tr class="<?php echo $hide_class; ?>">
                              <td class="text-left"><?php echo $field['title']; ?></td>
                              <td class="text-right">
                                <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-primary <?php echo (isset($mpcheckout_account_panel['fields'][$field['code']]) && $mpcheckout_account_panel['fields'][$field['code']] == 1) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_account_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="1" <?php echo (isset($mpcheckout_account_panel['fields'][$field['code']]) && $mpcheckout_account_panel['fields'][$field['code']] == 1) ? 'checked' : ''; ?> /><?php echo $text_display_yes_required; ?>
                                  </label>
                                  <label class="btn btn-primary <?php echo (isset($mpcheckout_account_panel['fields'][$field['code']]) && $mpcheckout_account_panel['fields'][$field['code']] == 2) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_account_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="2" <?php echo (isset($mpcheckout_account_panel['fields'][$field['code']]) && $mpcheckout_account_panel['fields'][$field['code']] == 2) ? 'checked' : ''; ?> /><?php echo $text_display_yes; ?>
                                  </label>
                                  <label class="btn btn-primary <?php echo (empty($mpcheckout_account_panel['fields'][$field['code']])) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_account_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="0" <?php echo (empty($mpcheckout_account_panel['fields'][$field['code']])) ? 'checked' : ''; ?> /><?php echo $text_display_no; ?>
                                  </label>
                                </div>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </fieldset>
                      <fieldset>
                        <div class="form-group mp-buttons">
                          <label class="col-sm-12 control-label"><?php echo $entry_captcha; ?></label>
                          <div class="col-sm-4">
                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                              <label class="btn btn-primary <?php echo !empty($mpcheckout_captcha) ? 'active' : '';  ?>">
                                <input type="radio" name="mpcheckout_captcha" value="1" <?php echo (!empty($mpcheckout_captcha)) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_enabled; ?>                            
                              </label>
                              <label class="btn btn-primary <?php echo empty($mpcheckout_captcha) ? 'active' : '';  ?>">
                                <input type="radio" name="mpcheckout_captcha" value="0" <?php echo (empty($mpcheckout_captcha)) ? 'checked="checked"' : '';  ?> />
                                <?php echo $text_disabled; ?>                            
                              </label>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                    <div class="tab-pane" id="navtab-social-panel">
                     <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-google" data-toggle="tab"><i class="fa fa-google" aria-hidden="true"></i> <?php echo $tab_google; ?></a></li>
                        <li><a href="#tab-facebook" data-toggle="tab"><i class="fa fa-facebook" aria-hidden="true"></i> <?php echo $tab_facebook; ?></a></li>
                        <li><a href="#tab-linkedin" data-toggle="tab"><i class="fa fa-linkedin" aria-hidden="true"></i> <?php echo $tab_linkedin; ?></a></li>
                        <!-- /*new updates 28032018 starts*/ --><li><a href="#tab-instagram" data-toggle="tab"><i class="fa fa-instagram"></i> <?php echo $tab_instagram; ?></a></li>
                        <li><a href="#tab-twitter" data-toggle="tab"><i class="fa fa-twitter"></i> <?php echo $tab_twitter; ?></a></li><!-- /*new updates 28032018 ends*/ -->
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab-google">
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                              <select name="mpcheckout_social_panel[google][status]"class="form-control">
                                <?php if (!empty($mpcheckout_social_panel['google']['status'])) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_appid; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[google][appid]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['google']['appid']) ? $mpcheckout_social_panel['google']['appid'] : ''; ?>" />
                              <?php if($error_google_appid) { ?>
                              <div class="text-danger"><?php echo $error_google_appid; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_secret; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[google][secret]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['google']['secret']) ? $mpcheckout_social_panel['google']['secret'] : ''; ?>" />
                              <?php if($error_google_secret) { ?>
                              <div class="text-danger"><?php echo $error_google_secret; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_redirect; ?></label>
                            <div class="col-sm-10">
                              <div class="alert alert-info"><b><?php echo $link_google_uri; ?></b></div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab-facebook">
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                              <select name="mpcheckout_social_panel[facebook][status]"class="form-control">
                                <?php if (!empty($mpcheckout_social_panel['facebook']['status'])) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_appid; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[facebook][appid]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['facebook']['appid']) ? $mpcheckout_social_panel['facebook']['appid'] : ''; ?>" />
                              <?php if($error_facebook_appid) { ?>
                              <div class="text-danger"><?php echo $error_facebook_appid; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_secret; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[facebook][secret]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['facebook']['secret']) ? $mpcheckout_social_panel['facebook']['secret'] : ''; ?>" />
                              <?php if($error_facebook_secret) { ?>
                              <div class="text-danger"><?php echo $error_facebook_secret; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_redirect; ?></label>
                            <div class="col-sm-10">
                              <div class="alert alert-info"><b><?php echo $link_facebook_uri; ?></b></div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab-linkedin">
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                              <select name="mpcheckout_social_panel[linkedin][status]"class="form-control">
                                <?php if (!empty($mpcheckout_social_panel['linkedin']['status'])) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_appid; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[linkedin][appid]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['linkedin']['appid']) ? $mpcheckout_social_panel['linkedin']['appid'] : ''; ?>" />
                              <?php if($error_linkedin_appid) { ?>
                              <div class="text-danger"><?php echo $error_linkedin_appid; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_secret; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[linkedin][secret]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['linkedin']['secret']) ? $mpcheckout_social_panel['linkedin']['secret'] : ''; ?>" />
                              <?php if($error_linkedin_secret) { ?>
                              <div class="text-danger"><?php echo $error_linkedin_secret; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_redirect; ?></label>
                            <div class="col-sm-10">
                              <div class="alert alert-info"><b><?php echo $link_linkedin_uri; ?></b></div>
                            </div>
                          </div>
                        </div>
                        <!-- /*new updates 28032018 starts*/ -->
                        <div id="tab-instagram" class="tab-pane">
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                              <select name="mpcheckout_social_panel[instagram][status]"class="form-control">
                                <?php if (!empty($mpcheckout_social_panel['instagram']['status'])) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_appid; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[instagram][appid]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['instagram']['appid']) ? $mpcheckout_social_panel['instagram']['appid'] : ''; ?>" />
                              <?php if($error_instagram_appid) { ?>
                              <div class="text-danger"><?php echo $error_instagram_appid; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_secret; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[instagram][secret]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['instagram']['secret']) ? $mpcheckout_social_panel['instagram']['secret'] : ''; ?>" />
                              <?php if($error_instagram_secret) { ?>
                              <div class="text-danger"><?php echo $error_instagram_secret; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_redirect; ?></label>
                            <div class="col-sm-10">
                              <div class="alert alert-info"><b><?php echo $link_instagram_uri; ?></b></div>
                            </div>
                          </div>
                        </div>
                        <div id="tab-twitter" class="tab-pane">
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                              <select name="mpcheckout_social_panel[twitter][status]"class="form-control">
                                <?php if (!empty($mpcheckout_social_panel['twitter']['status'])) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_appid; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[twitter][appid]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['twitter']['appid']) ? $mpcheckout_social_panel['twitter']['appid'] : ''; ?>" />
                              <?php if($error_twitter_appid) { ?>
                              <div class="text-danger"><?php echo $error_twitter_appid; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group required">
                            <label class="col-sm-2 control-label"><?php echo $entry_secret; ?></label>
                            <div class="col-sm-10">
                              <input type="text" name="mpcheckout_social_panel[twitter][secret]" class="form-control" value="<?php echo !empty($mpcheckout_social_panel['twitter']['secret']) ? $mpcheckout_social_panel['twitter']['secret'] : ''; ?>" />
                              <?php if($error_twitter_secret) { ?>
                              <div class="text-danger"><?php echo $error_twitter_secret; ?></div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $entry_redirect; ?></label>
                            <div class="col-sm-10">
                              <div class="alert alert-info"><b><?php echo $link_twitter_uri; ?></b></div>
                            </div>
                          </div>
                        </div>
                        <!-- /*new updates 28032018 ends*/ -->
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-date-panel">
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_date_status; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_date_panel['status']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_date_panel[status]" value="1" <?php echo (!empty($mpcheckout_date_panel['status'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_date_panel['status']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_date_panel[status]" value="0" <?php echo (empty($mpcheckout_date_panel['status'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_date_required; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_date_panel['required']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_date_panel[required]" value="1" <?php echo (!empty($mpcheckout_date_panel['required'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_date_panel['required']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_date_panel[required]" value="0" <?php echo (empty($mpcheckout_date_panel['required'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-12 control-label" for="input-minimum-days"><?php echo $entry_minimum_maximum_days; ?></label>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input-group">
                                <input type="text" name="mpcheckout_date_panel[minimum_days]" value="<?php echo (isset($mpcheckout_date_panel['minimum_days'])) ? $mpcheckout_date_panel['minimum_days'] : ''; ?>" id="input-minimum-days" class="form-control" />
                                <span class="input-group-addon"><?php echo $text_minimum; ?></span>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input-group">
                              <input type="text" name="mpcheckout_date_panel[maximum_days]" value="<?php echo (isset($mpcheckout_date_panel['maximum_days'])) ? $mpcheckout_date_panel['maximum_days'] : ''; ?>" class="form-control" />
                              <span class="input-group-addon"><?php echo $text_maximum; ?></span>
                              </div>
                            </div>
                          </div>                          
                          <?php if($error_days) { ?>
                          <div class="text-danger"><?php echo $error_days; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <br/>

                      <fieldset>
                        <legend><?php echo $legend_disabled_dates ?></legend>
                        <div class="form-group">
                          <label class="col-sm-12 control-label" for="input-disables-dates"><?php echo $entry_disabled_dates; ?></label>
                          <div class="col-sm-12">
                              <textarea rows="8" name="mpcheckout_date_panel[disabled_dates]" id="input-minimum-days" class="form-control font-size16"><?php echo (isset($mpcheckout_date_panel['disabled_dates'])) ? $mpcheckout_date_panel['disabled_dates'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-12 control-label"><?php echo $entry_disables_weeks; ?></label>
                          <div class="col-sm-12">
                            <select name="mpcheckout_date_panel[disables_weeks][]" class="form-control font-size16" multiple size="10">
                              <?php foreach ($weeks as $week) { ?>
                              <?php if (!empty($mpcheckout_date_panel['disables_weeks']) && in_array($week['week_number'], $mpcheckout_date_panel['disables_weeks'])) { ?>
                              <option value="<?php echo $week['week_number']; ?>" selected="selected"><?php echo $week['week_title']; ?></option>
                              <?php } else { ?>
                              <option value="<?php echo $week['week_number']; ?>"><?php echo $week['week_title']; ?></option>
                              <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                    <div class="tab-pane" id="navtab-payment-address">
                      <br/>
                      <fieldset>
                        <legend><?php echo $legend_payment_fields ?></legend>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td class="text-left"><?php echo $column_field_name; ?></td>
                              <td class="text-right"><?php echo $column_status; ?></td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($address_fields as $field) { ?>
                            <tr>
                              <td class="text-left"><?php echo $field['title']; ?></td>
                              <td class="text-right">
                                <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-primary <?php echo (isset($mpcheckout_payment_address_panel['fields'][$field['code']]) && $mpcheckout_payment_address_panel['fields'][$field['code']] == 1) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_payment_address_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="1" <?php echo (isset($mpcheckout_payment_address_panel['fields'][$field['code']]) && $mpcheckout_payment_address_panel['fields'][$field['code']] == 1) ? 'checked' : ''; ?> /><?php echo $text_display_yes_required; ?>
                                  </label>
                                  <label class="btn btn-primary <?php echo (isset($mpcheckout_payment_address_panel['fields'][$field['code']]) && $mpcheckout_payment_address_panel['fields'][$field['code']] == 2) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_payment_address_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="2" <?php echo (isset($mpcheckout_payment_address_panel['fields'][$field['code']]) && $mpcheckout_payment_address_panel['fields'][$field['code']] == 2) ? 'checked' : ''; ?> /><?php echo $text_display_yes; ?>
                                  </label>
                                  <label class="btn btn-primary <?php echo (empty($mpcheckout_payment_address_panel['fields'][$field['code']])) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_payment_address_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="0" <?php echo (empty($mpcheckout_payment_address_panel['fields'][$field['code']])) ? 'checked' : ''; ?> /><?php echo $text_display_no; ?>
                                  </label>
                                </div>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </fieldset>
                    </div>
                    <div class="tab-pane" id="navtab-shipping-address">
                      <br/>
                      <fieldset>
                        <legend><?php echo $legend_shipping_fields ?></legend>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td class="text-left"><?php echo $column_field_name; ?></td>
                              <td class="text-right"><?php echo $column_status; ?></td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($address_fields as $field) { ?>
                            <tr>
                              <td class="text-left"><?php echo $field['title']; ?></td>
                              <td class="text-right">
                                <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-primary <?php echo (isset($mpcheckout_shipping_address_panel['fields'][$field['code']]) && $mpcheckout_shipping_address_panel['fields'][$field['code']] == 1) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_shipping_address_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="1" <?php echo (isset($mpcheckout_shipping_address_panel['fields'][$field['code']]) && $mpcheckout_shipping_address_panel['fields'][$field['code']] == 1) ? 'checked' : ''; ?> /><?php echo $text_display_yes_required; ?>
                                  </label>
                                  <label class="btn btn-primary <?php echo (isset($mpcheckout_shipping_address_panel['fields'][$field['code']]) && $mpcheckout_shipping_address_panel['fields'][$field['code']] == 2) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_shipping_address_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="2" <?php echo (isset($mpcheckout_shipping_address_panel['fields'][$field['code']]) && $mpcheckout_shipping_address_panel['fields'][$field['code']] == 2) ? 'checked' : ''; ?> /><?php echo $text_display_yes; ?>
                                  </label>
                                  <label class="btn btn-primary <?php echo (empty($mpcheckout_shipping_address_panel['fields'][$field['code']])) ? 'active' : ''; ?>">
                                    <input type="radio" name="mpcheckout_shipping_address_panel[fields][<?php echo $field['code']; ?>]" autocomplete="off" value="0" <?php echo (empty($mpcheckout_shipping_address_panel['fields'][$field['code']])) ? 'checked' : ''; ?> /><?php echo $text_display_no; ?>
                                  </label>
                                </div>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </fieldset>
                    </div>
                    <div class="tab-pane" id="navtab-payment-methods">
                      <?php if($payment_methods) { ?>
                      <br/>
                      <fieldset>
                        <legend><?php echo $legend_paymentmethod_image; ?></legend>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td class="text-left"><?php echo $column_icon; ?></td>
                              <td class="text-left"><?php echo $column_payment_method; ?></td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($payment_methods as $payment_method) { ?>
                            <tr>
                              <td class="text-left">
                                  <a href="" id="thumb-icon-<?php echo $payment_method['code']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo !empty($mpcheckout_payment_method_tables[$payment_method['code']]['thumb']) ? $mpcheckout_payment_method_tables[$payment_method['code']]['thumb'] : $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="mpcheckout_payment_method_table[<?php echo $payment_method['code']; ?>][image]" value="<?php echo !empty($mpcheckout_payment_method_tables[$payment_method['code']]['image']) ? $mpcheckout_payment_method_tables[$payment_method['code']]['image'] : ''; ?>" id="input-icon-<?php echo $payment_method['code']; ?>" />
                              </td>
                              <td class="text-left"><?php echo $payment_method['name']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </fieldset>
                      <?php } ?>
                    </div>
                    <div class="tab-pane" id="navtab-shipping-methods">
                      <?php if($shipping_methods) { ?>
                      <br/>
                      <fieldset>
                        <legend><?php echo $legend_shippingmethod_image; ?></legend>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td class="text-left"><?php echo $column_icon; ?></td>
                              <td class="text-left"><?php echo $column_shipping_method; ?></td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($shipping_methods as $shipping_method) { ?>
                            <tr>
                              <td class="text-left">
                                  <a href="" id="thumb-icon-<?php echo $shipping_method['code']; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo !empty($mpcheckout_shipping_method_tables[$shipping_method['code']]['thumb']) ? $mpcheckout_shipping_method_tables[$shipping_method['code']]['thumb'] : $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden" name="mpcheckout_shipping_method_table[<?php echo $shipping_method['code']; ?>][image]" value="<?php echo !empty($mpcheckout_shipping_method_tables[$shipping_method['code']]['image']) ? $mpcheckout_shipping_method_tables[$shipping_method['code']]['image'] : ''; ?>" id="input-icon-<?php echo $shipping_method['code']; ?>" />
                              </td>
                              <td class="text-left"><?php echo $shipping_method['name']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </fieldset>
                      <?php } ?>
                    </div>
                    <div class="tab-pane" id="navtab-shoppingcart">
                      <div class="bs-callout bs-callout-info"> 
                        <h4><?php echo $info_shoppingcart; ?></h4> 
                        <p><?php echo $info_shoppingcart_info; ?></p> 
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_cart_status; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_shoppingcart_panel['cart_status']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[cart_status]" value="1" <?php echo (!empty($mpcheckout_shoppingcart_panel['cart_status'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_shoppingcart_panel['cart_status']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[cart_status]" value="0" <?php echo (empty($mpcheckout_shoppingcart_panel['cart_status'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_show_weight; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_shoppingcart_panel['show_weight']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[show_weight]" value="1" <?php echo (!empty($mpcheckout_shoppingcart_panel['show_weight'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_shoppingcart_panel['show_weight']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[show_weight]" value="0" <?php echo (empty($mpcheckout_shoppingcart_panel['show_weight'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_qty_update; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_shoppingcart_panel['qty_update']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[qty_update]" value="1" <?php echo (!empty($mpcheckout_shoppingcart_panel['qty_update'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_shoppingcart_panel['qty_update']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[qty_update]" value="0" <?php echo (empty($mpcheckout_shoppingcart_panel['qty_update'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_show_product_image; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_shoppingcart_panel['show_product_image']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[show_product_image]" value="1" <?php echo (!empty($mpcheckout_shoppingcart_panel['show_product_image'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_shoppingcart_panel['show_product_image']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_shoppingcart_panel[show_product_image]" value="0" <?php echo (empty($mpcheckout_shoppingcart_panel['show_product_image'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-12 control-label" for="input-image-category-width"><?php echo $entry_product_image_size; ?></label>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="input-group">
                                <input type="text" name="mpcheckout_shoppingcart_panel[product_image_width]" value="<?php echo (isset($mpcheckout_shoppingcart_panel['product_image_width'])) ? $mpcheckout_shoppingcart_panel['product_image_width'] : ''; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-category-width" class="form-control" />
                                <span class="input-group-addon"><?php echo $text_width; ?></span>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="input-group">
                              <input type="text" name="mpcheckout_shoppingcart_panel[product_image_height]" value="<?php echo (isset($mpcheckout_shoppingcart_panel['product_image_height'])) ? $mpcheckout_shoppingcart_panel['product_image_height'] : ''; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                              <span class="input-group-addon"><?php echo $text_height; ?></span>
                              </div>
                            </div>
                          </div>
                          <?php if($error_image_cart) { ?>
                          <div class="text-danger"><?php echo $error_image_cart; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-checkout-order">
                      <div class="bs-callout bs-callout-info"> 
                        <h4><?php echo $info_autotrigger; ?></h4> 
                        <p><?php echo $info_autotrigger_info; ?></p> 
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_confirm_autotrigger_order; ?>"><?php echo $entry_confirm_autotrigger_order; ?></span></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_confirm_panel['autotrigger_order']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[autotrigger_order]" value="1" <?php echo (!empty($mpcheckout_confirm_panel['autotrigger_order'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_confirm_panel['autotrigger_order']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[autotrigger_order]" value="0" <?php echo (empty($mpcheckout_confirm_panel['autotrigger_order'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><span data-toggle="tooltip" data-container="#tab-general" title="<?php echo $help_auto_trigger_payment_method; ?>"><?php echo $entry_auto_trigger_payment_method; ?></span></label>
                        <div class="col-sm-12">
                          <?php
                          /*
                            if(empty($mpcheckout_confirm_panel['autotrigger_payments'])) { 
                              foreach ($payment_methods as $payment_method) {
                                $mpcheckout_confirm_panel['autotrigger_payments'][] = $payment_method['code'];
                              }
                            }
                           */ 
                          ?>
                          <select multiple name="mpcheckout_confirm_panel[autotrigger_payments][]" class="form-control font-size16" size="10">
                            <?php foreach ($payment_methods as $payment_method) { ?>
                            <?php if (!empty($mpcheckout_confirm_panel['autotrigger_payments']) && in_array($payment_method['code'], $mpcheckout_confirm_panel['autotrigger_payments'])) { ?>
                            <option value="<?php echo $payment_method['code']; ?>" selected="selected"><?php echo $payment_method['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><span data-toggle="tooltip" title="<?php echo $help_chekout_terms; ?>"><?php echo $entry_chekout_terms; ?></span></label>
                        <div class="col-sm-12">
                          <select name="mpcheckout_confirm_panel[checkout_id]" class="form-control">
                            <option value="0"><?php echo $text_none; ?></option>
                            <?php foreach ($informations as $information) { ?>
                            <?php if (!empty($mpcheckout_confirm_panel['checkout_id']) && $information['information_id'] == $mpcheckout_confirm_panel['checkout_id']) { ?>
                            <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_default_checkout_id; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_confirm_panel['default_checkout_id']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[default_checkout_id]" value="1" <?php echo (!empty($mpcheckout_confirm_panel['default_checkout_id'])) ? 'checked="checked"' : '';  ?> />
                            <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_confirm_panel['default_checkout_id']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[default_checkout_id]" value="0" <?php echo (empty($mpcheckout_confirm_panel['default_checkout_id'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_continue_shopping; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_confirm_panel['continue_shopping_button']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[continue_shopping_button]" value="1" <?php echo (!empty($mpcheckout_confirm_panel['continue_shopping_button'])) ? 'checked="checked"' : '';  ?> />
                                <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_confirm_panel['continue_shopping_button']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[continue_shopping_button]" value="0" <?php echo (empty($mpcheckout_confirm_panel['continue_shopping_button'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_show_comment; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_confirm_panel['show_comment']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[show_comment]" value="1" <?php echo (!empty($mpcheckout_confirm_panel['show_comment'])) ? 'checked="checked"' : '';  ?> />
                                <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_confirm_panel['show_comment']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[show_comment]" value="0" <?php echo (empty($mpcheckout_confirm_panel['show_comment'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group mp-buttons">
                        <label class="col-sm-12 control-label"><?php echo $entry_overlay; ?></label>
                        <div class="col-sm-4">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-primary <?php echo !empty($mpcheckout_confirm_panel['overlay']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[overlay]" value="1" <?php echo (!empty($mpcheckout_confirm_panel['overlay'])) ? 'checked="checked"' : '';  ?> />
                                <?php echo $text_yes; ?>                            
                            </label>
                            <label class="btn btn-primary <?php echo empty($mpcheckout_confirm_panel['overlay']) ? 'active' : '';  ?>">
                              <input type="radio" name="mpcheckout_confirm_panel[overlay]" value="0" <?php echo (empty($mpcheckout_confirm_panel['overlay'])) ? 'checked="checked"' : '';  ?> />
                              <?php echo $text_no; ?>                            
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-langsetting">
              <div class="row">
                <div class="col-sm-3">
                  <ul class="nav nav-pills nav-stacked ostab" id="lang-panels">
                    <li><a class="text-left" href="#navtab-lang-page" data-toggle="tab"><i class="fa fa-file-o" aria-hidden="true"></i> <?php echo $navtabs_lang_page; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-account-buttons" data-toggle="tab"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <?php echo $navtabs_lang_account_buttons; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-account-panel" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $navtabs_lang_account_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-login-panel" data-toggle="tab"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $navtabs_lang_login_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-social-panel" data-toggle="tab"><i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $navtabs_social_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-payment-address" data-toggle="tab"><i class="fa fa-location-arrow" aria-hidden="true"></i> <?php echo $navtabs_lang_payment_address; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-shipping-address" data-toggle="tab"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $navtabs_lang_shipping_address; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-payment-method" data-toggle="tab"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $navtabs_lang_payment_methods; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-shipping-method" data-toggle="tab"><i class="fa fa-truck" aria-hidden="true"></i> <?php echo $navtabs_lang_shipping_methods; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-date-panel" data-toggle="tab"><i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $navtabs_date_panel; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-cart" data-toggle="tab"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo $navtabs_lang_shoppingcart; ?></a></li>
                    <li><a class="text-left" href="#navtab-lang-confirm-order" data-toggle="tab"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $navtabs_lang_checkout_order; ?></a></li>
                  </ul>
                </div>
                <div class="col-sm-9">
                  <div class="tab-content">
                      <div class="tab-pane" id="navtab-lang-page">
                        <div class="bs-callout bs-callout-info"> 
                          <h4><?php echo $info_checkoutpage; ?></h4> 
                          <p><?php echo $info_checkoutpage_info; ?></p> 
                        </div>
                        <ul class="nav nav-tabs" id="language-page">
                          <?php foreach ($languages as $language) { ?>
                            <li><a href="#language-page<?php echo $language['language_id']; ?>" data-toggle="tab">
                            <?php if(VERSION >= '2.2.0.0') { ?>
                            <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                            <?php } else{ ?>
                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                            <?php } ?> <?php echo $language['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-page<?php echo $language['language_id']; ?>">
                            <div class="form-group required">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_heading_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_page_description[<?php echo $language['language_id']; ?>][heading_title]" value="<?php echo isset($mpcheckout_page_description[$language['language_id']]) ? $mpcheckout_page_description[$language['language_id']]['heading_title'] : ''; ?>" placeholder="<?php echo $entry_lang_heading_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label" for="input-message_register<?php echo $language['language_id']; ?>"><?php echo $entry_lang_message_register; ?></label>
                              <div class="col-sm-12">
                                <textarea name="mpcheckout_page_description[<?php echo $language['language_id']; ?>][message_register]" placeholder="<?php echo $entry_lang_message_register; ?>" id="input-message_register<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($mpcheckout_page_description[$language['language_id']]) ? $mpcheckout_page_description[$language['language_id']]['message_register'] : ''; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label" for="input-message_logged<?php echo $language['language_id']; ?>"><?php echo $entry_lang_message_logged; ?></label>
                              <div class="col-sm-12">
                                <textarea name="mpcheckout_page_description[<?php echo $language['language_id']; ?>][message_logged]" placeholder="<?php echo $entry_lang_message_logged; ?>" id="input-message_logged<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($mpcheckout_page_description[$language['language_id']]) ? $mpcheckout_page_description[$language['language_id']]['message_logged'] : ''; ?></textarea>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-account-buttons">
                        <ul class="nav nav-tabs" id="language-account-buttons">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-account-buttons<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-account-buttons<?php echo $language['language_id']; ?>">
                            <div class="form-group required">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_register_panel; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_button_description[<?php echo $language['language_id']; ?>][register_panel]" value="<?php echo isset($mpcheckout_account_button_description[$language['language_id']]) ? $mpcheckout_account_button_description[$language['language_id']]['register_panel'] : ''; ?>" placeholder="<?php echo $entry_lang_register_panel; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_guest_panel; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_button_description[<?php echo $language['language_id']; ?>][guest_panel]" value="<?php echo isset($mpcheckout_account_button_description[$language['language_id']]) ? $mpcheckout_account_button_description[$language['language_id']]['guest_panel'] : ''; ?>" placeholder="<?php echo $entry_lang_guest_panel; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group required">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_login_panel; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_button_description[<?php echo $language['language_id']; ?>][login_panel]" value="<?php echo isset($mpcheckout_account_button_description[$language['language_id']]) ? $mpcheckout_account_button_description[$language['language_id']]['login_panel'] : ''; ?>" placeholder="<?php echo $entry_lang_login_panel; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-account-panel">
                        <ul class="nav nav-tabs" id="language-account-panel">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-account-panel<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-account-panel<?php echo $language['language_id']; ?>">
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_personal_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_panel_description[<?php echo $language['language_id']; ?>][personal_title]" value="<?php echo isset($mpcheckout_account_panel_description[$language['language_id']]) ? $mpcheckout_account_panel_description[$language['language_id']]['personal_title'] : ''; ?>" placeholder="<?php echo $entry_lang_personal_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_personal_guest_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_panel_description[<?php echo $language['language_id']; ?>][personal_guest_title]" value="<?php echo isset($mpcheckout_account_panel_description[$language['language_id']]) ? $mpcheckout_account_panel_description[$language['language_id']]['personal_guest_title'] : ''; ?>" placeholder="<?php echo $entry_lang_personal_guest_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_password; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_panel_description[<?php echo $language['language_id']; ?>][password]" value="<?php echo isset($mpcheckout_account_panel_description[$language['language_id']]) ? $mpcheckout_account_panel_description[$language['language_id']]['password'] : ''; ?>" placeholder="<?php echo $entry_lang_password; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_more_details; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_account_panel_description[<?php echo $language['language_id']; ?>][more_details]" value="<?php echo isset($mpcheckout_account_panel_description[$language['language_id']]) ? $mpcheckout_account_panel_description[$language['language_id']]['more_details'] : ''; ?>" placeholder="<?php echo $entry_lang_more_details; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-login-panel">
                        <ul class="nav nav-tabs" id="language-login-panel">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-login-panel<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-login-panel<?php echo $language['language_id']; ?>">
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_login_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_login_panel_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_login_panel_description[$language['language_id']]) ? $mpcheckout_login_panel_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_login_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_login_button; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_login_panel_description[<?php echo $language['language_id']; ?>][login_button]" value="<?php echo isset($mpcheckout_login_panel_description[$language['language_id']]) ? $mpcheckout_login_panel_description[$language['language_id']]['login_button'] : ''; ?>" placeholder="<?php echo $entry_lang_login_button; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>                      
                      <div class="tab-pane" id="navtab-lang-payment-address">
                        <ul class="nav nav-tabs" id="language-payment-address">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-payment-address<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-payment-address<?php echo $language['language_id']; ?>">
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_payment_address_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_payment_address_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_payment_address_description[$language['language_id']]) ? $mpcheckout_payment_address_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_payment_address_title; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>                    
                      <div class="tab-pane" id="navtab-lang-shipping-address">
                        <ul class="nav nav-tabs" id="language-shipping-address">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-shipping-address<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-shipping-address<?php echo $language['language_id']; ?>">                            
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_shipping_address_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_shipping_address_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_shipping_address_description[$language['language_id']]) ? $mpcheckout_shipping_address_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_shipping_address_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_address_not_required; ?></label>
                              <div class="col-sm-12">
                                <textarea name="mpcheckout_shipping_address_description[<?php echo $language['language_id']; ?>][address_not_required]" placeholder="<?php echo $entry_lang_address_not_required; ?>" class="form-control"><?php echo isset($mpcheckout_shipping_address_description[$language['language_id']]) ? $mpcheckout_shipping_address_description[$language['language_id']]['address_not_required'] : ''; ?></textarea>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-payment-method">
                        <ul class="nav nav-tabs" id="language-payment-method">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-payment-method<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-payment-method<?php echo $language['language_id']; ?>">                            
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_payment_method_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_payment_method_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_payment_method_description[$language['language_id']]) ? $mpcheckout_payment_method_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_payment_method_title; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>                      
                      <div class="tab-pane" id="navtab-lang-shipping-method">
                        <ul class="nav nav-tabs" id="language-shipping-method">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-shipping-method<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-shipping-method<?php echo $language['language_id']; ?>">                            
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_shipping_method_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_shipping_method_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_shipping_method_description[$language['language_id']]) ? $mpcheckout_shipping_method_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_shipping_method_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_method_not_required; ?></label>
                              <div class="col-sm-12">
                                <textarea name="mpcheckout_shipping_method_description[<?php echo $language['language_id']; ?>][method_not_required]" placeholder="<?php echo $entry_lang_method_not_required; ?>" class="form-control"><?php echo isset($mpcheckout_shipping_method_description[$language['language_id']]) ? $mpcheckout_shipping_method_description[$language['language_id']]['method_not_required'] : ''; ?></textarea>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-social-panel">
                        <ul class="nav nav-tabs" id="language-social">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-social<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-social<?php echo $language['language_id']; ?>">                            
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_social_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_social_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_social_description[$language['language_id']]) ? $mpcheckout_social_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_social_title; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-date-panel">
                        <ul class="nav nav-tabs" id="language-date">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-date<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-date<?php echo $language['language_id']; ?>">   
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_date_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_date_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_date_description[$language['language_id']]) ? $mpcheckout_date_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_date_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_date_field; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_date_description[<?php echo $language['language_id']; ?>][field_title]" value="<?php echo isset($mpcheckout_date_description[$language['language_id']]) ? $mpcheckout_date_description[$language['language_id']]['field_title'] : ''; ?>" placeholder="<?php echo $entry_lang_date_field; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-cart">
                        <ul class="nav nav-tabs" id="language-cart">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-cart<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-cart<?php echo $language['language_id']; ?>">                            
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_cart_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_cart_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_cart_description[$language['language_id']]) ? $mpcheckout_cart_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_cart_title; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="navtab-lang-confirm-order">
                        <ul class="nav nav-tabs" id="language-confirm-order">
                          <?php foreach ($languages as $language) { ?>
                          <li><a href="#language-confirm-order<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                          <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                          <?php } else{ ?>
                          <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                          <?php } ?> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language-confirm-order<?php echo $language['language_id']; ?>">
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_confirm_order_title; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_confirm_order_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_confirm_order_description[$language['language_id']]) ? $mpcheckout_confirm_order_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_lang_confirm_order_title; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_confirm_order_comment; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_confirm_order_description[<?php echo $language['language_id']; ?>][comment_placeholder]" value="<?php echo isset($mpcheckout_confirm_order_description[$language['language_id']]) ? $mpcheckout_confirm_order_description[$language['language_id']]['comment_placeholder'] : ''; ?>" placeholder="<?php echo $entry_lang_confirm_order_comment; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_confirm_order_continue_button; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_confirm_order_description[<?php echo $language['language_id']; ?>][continue_button]" value="<?php echo isset($mpcheckout_confirm_order_description[$language['language_id']]) ? $mpcheckout_confirm_order_description[$language['language_id']]['continue_button'] : ''; ?>" placeholder="<?php echo $entry_lang_confirm_order_continue_button; ?>" class="form-control" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-12 control-label"><?php echo $entry_lang_confirm_order_button; ?></label>
                              <div class="col-sm-12">
                                <input type="text" name="mpcheckout_confirm_order_description[<?php echo $language['language_id']; ?>][button]" value="<?php echo isset($mpcheckout_confirm_order_description[$language['language_id']]) ? $mpcheckout_confirm_order_description[$language['language_id']]['button'] : ''; ?>" placeholder="<?php echo $entry_lang_confirm_order_button; ?>" class="form-control" />
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-successpage">
              <div class="bs-callout bs-callout-info"> 
                <h4><?php echo $info_success_page; ?></h4> 
                <p><?php echo $info_success_page_info; ?></p> 
              </div>
              <div class="form-group mp-buttons">
                <label class="col-sm-2 control-label"><?php echo $entry_success_status; ?></label>
                <div class="col-sm-3">
                  <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary <?php echo !empty($mpcheckout_success_status) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_success_status" value="1" <?php echo (!empty($mpcheckout_success_status)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_yes; ?>                            
                    </label>
                    <label class="btn btn-primary <?php echo empty($mpcheckout_success_status) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_success_status" value="0" <?php echo (empty($mpcheckout_success_status)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_no; ?>                            
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12 codes">
                  <div class="buttons text-right">
                  <a data-toggle="collapse" class="btn btn-primary" href="#collapse" aria-expanded="false" aria-controls="collapse">Short Codes</a>
                  </div>
                  <div class="collapse" id="collapse" style="background: #eee;">
                    <div class="card card-block">
                    <ul class="list-unstyled">
                      <li>{firstname} - Firstname</li>
                      <li>{lastname} - Lastname</li>
                      <li>{order_id} - Order ID        </li>
                      <li>{order_status} - Order Status        </li>
                      <li>{order_details} - Order Details with products</li>
                      <li>{order_total_amount} - Order Total Amount</li>
                    </ul> 
                    </div>
                  </div>    
                </div>
              </div>

              <ul class="nav nav-tabs" id="language-success">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language-success<?php echo $language['language_id']; ?>" data-toggle="tab"><?php if(VERSION >= '2.2.0.0') { ?>
                <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                <?php } else{ ?>
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                <?php } ?> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                  <div class="tab-pane" id="language-success<?php echo $language['language_id']; ?>">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $entry_success_title; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="mpcheckout_success_description[<?php echo $language['language_id']; ?>][heading_title]" value="<?php echo isset($mpcheckout_success_description[$language['language_id']]) ? $mpcheckout_success_description[$language['language_id']]['heading_title'] : ''; ?>" placeholder="<?php echo $entry_success_title; ?>" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $entry_success_customer_message; ?></label>
                      <div class="col-sm-10">
                        <textarea name="mpcheckout_success_description[<?php echo $language['language_id']; ?>][customer_message]" placeholder="<?php echo $entry_success_customer_message; ?>" class="form-control summernote" id="input-success-customer<?php echo $language['language_id']; ?>"><?php echo isset($mpcheckout_success_description[$language['language_id']]) ? $mpcheckout_success_description[$language['language_id']]['customer_message'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $entry_success_guest_message; ?></label>
                      <div class="col-sm-10">
                        <textarea name="mpcheckout_success_description[<?php echo $language['language_id']; ?>][guest_message]" placeholder="<?php echo $entry_success_guest_message; ?>" class="form-control summernote" id="input-success-guest<?php echo $language['language_id']; ?>"><?php echo isset($mpcheckout_success_description[$language['language_id']]) ? $mpcheckout_success_description[$language['language_id']]['guest_message'] : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $entry_success_continue_button; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="mpcheckout_success_description[<?php echo $language['language_id']; ?>][continue_button]" value="<?php echo isset($mpcheckout_success_description[$language['language_id']]) ? $mpcheckout_success_description[$language['language_id']]['continue_button'] : ''; ?>" placeholder="<?php echo $entry_success_continue_button; ?>" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $entry_success_print_button; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="mpcheckout_success_description[<?php echo $language['language_id']; ?>][print_button]" value="<?php echo isset($mpcheckout_success_description[$language['language_id']]) ? $mpcheckout_success_description[$language['language_id']]['print_button'] : ''; ?>" placeholder="<?php echo $entry_success_print_button; ?>" class="form-control" />
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="form-group mp-buttons">
                <label class="col-sm-2 control-label"><?php echo $entry_print_status; ?></label>
                <div class="col-sm-3">
                  <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary <?php echo !empty($mpcheckout_print_status) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_print_status" value="1" <?php echo (!empty($mpcheckout_print_status)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_yes; ?>                            
                    </label>
                    <label class="btn btn-primary <?php echo empty($mpcheckout_print_status) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_print_status" value="0" <?php echo (empty($mpcheckout_print_status)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_no; ?>                            
                    </label>
                  </div>
                </div>
              </div>
              <div class="bs-callout bs-callout-info"> 
                <h4><?php echo $info_success_promote; ?></h4> 
                <p><?php echo $info_success_promote_info; ?></p> 
              </div>
              <div class="form-group mp-buttons">
                <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_success_promote; ?>"><?php echo $entry_success_promote; ?></span></label>
                <div class="col-sm-3">
                  <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary <?php echo !empty($mpcheckout_success_promote) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_success_promote" value="1" <?php echo (!empty($mpcheckout_success_promote)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_yes; ?>                            
                    </label>
                    <label class="btn btn-primary <?php echo empty($mpcheckout_success_promote) ? 'active' : '';  ?>">
                      <input type="radio" name="mpcheckout_success_promote" value="0" <?php echo (empty($mpcheckout_success_promote)) ? 'checked="checked"' : '';  ?> />
                      <?php echo $text_no; ?>                            
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_success_promote_title; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                    <div class="input-group">
                      <span class="input-group-addon">
                      <?php if(VERSION >= '2.2.0.0') { ?>
                      <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                      <?php } else{ ?>
                      <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                      <?php } ?>
                      </span>
                      <input type="text" name="mpcheckout_success_promote_title[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($mpcheckout_success_promote_title[$language['language_id']]) ? $mpcheckout_success_promote_title[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_success_promote_title; ?>" class="form-control" />
                    </div>
                    <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_success_product; ?>"><?php echo $entry_success_product; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="product" value="" placeholder="<?php echo $entry_success_product; ?>" id="input-product" class="form-control" />
                  <div id="product-product" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($product_products as $product_product) { ?>
                    <div id="product-product<?php echo $product_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_product['name']; ?>
                      <input type="hidden" name="mpcheckout_success_product[]" value="<?php echo $product_product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-length"><?php echo $entry_succees_image_size; ?></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="input-group">
                      <input type="text" name="mpcheckout_success_width" value="<?php echo $mpcheckout_success_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-mpcheckout-width" class="form-control" />
                      <span class="input-group-addon"><?php echo $text_width; ?></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group">
                      <input type="text" name="mpcheckout_success_height" value="<?php echo $mpcheckout_success_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-mpcheckout-height" class="form-control" />
                      <span class="input-group-addon"><?php echo $text_height; ?></span>
                      </div>
                    </div>
                  </div>
                  <?php if($error_success_image_size) { ?>
                  <div class="text-danger"><?php echo $error_success_image_size; ?></div>
                  <?php } ?>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_background_success_table; ?></label>
                <div class="col-sm-10">
                  <div class="input-group colorpicker colorpicker-component"> 
                    <input type="text" name="mpcheckout_color[background_success_table]" value="<?php echo !empty($mpcheckout_color['background_success_table']) ? $mpcheckout_color['background_success_table'] : ''; ?>" class="form-control" /> 
                    <span class="input-group-addon"><i></i></span> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_font_success_table; ?></label>
                <div class="col-sm-10">
                  <div class="input-group colorpicker colorpicker-component"> 
                    <input type="text" name="mpcheckout_color[font_success_table]" value="<?php echo !empty($mpcheckout_color['font_success_table']) ? $mpcheckout_color['font_success_table'] : ''; ?>" class="form-control" /> 
                    <span class="input-group-addon"><i></i></span> 
                  </div>
                </div>
              </div>
              <div class="bs-callout bs-callout-info"> 
                <h4><?php echo $info_googleanalytics; ?></h4>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_googleanalytics; ?></label>
                <div class="col-sm-10">
                  <textarea name="mpcheckout_googleanalytics" class="form-control" rows="8"><?php echo $mpcheckout_googleanalytics; ?></textarea>
                </div>
              </div>          
            </div>
            <div class="tab-pane" id="tab-theme">
            	<div class="form-group mp-buttons">
	                <label class="col-sm-2 control-label"><?php echo $entry_template; ?></label>
	                <div class="col-sm-5">
	                  <div class="btn-group btn-group-justified" data-toggle="buttons">
	                    <label class="btn btn-primary <?php echo (!empty($mpcheckout_template) && $mpcheckout_template == 'checkout_1') ? 'active' : '';  ?>">
	                      <input type="radio" name="mpcheckout_template" value="checkout_1" <?php echo (!empty($mpcheckout_template) && $mpcheckout_template == 'checkout_1') ? 'checked="checked"' : '';  ?> />
	                       <?php echo $text_checkout_1; ?>
	                    </label>
	                    <label class="btn btn-primary <?php echo (!empty($mpcheckout_template) && $mpcheckout_template == 'checkout_2') ? 'active' : '';  ?>">
	                      <input type="radio" name="mpcheckout_template" value="checkout_2" <?php echo (!empty($mpcheckout_template) && $mpcheckout_template == 'checkout_2') ? 'checked="checked"' : '';  ?> />
	                       <?php echo $text_checkout_2; ?>
	                    </label>
	                  </div>
	                </div>
	              </div>
            </div>
            <div class="tab-pane" id="tab-mpdesign">
              <div class="bs-callout bs-callout-info"> 
                <h4><?php echo $info_color_heading; ?></h4> 
                <p><?php echo $info_color_description; ?></p> 
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <ul class="nav nav-pills nav-stacked ostab" id="color-tabs">                      
                    <li><a class="text-left" href="#navtab-color-container" data-toggle="tab"><i class="fa fa-bolt" aria-hidden="true"></i> <?php echo $navtabs_color_container; ?></a></li>                      
                    <li><a class="text-left" href="#navtab-color-account" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $navtabs_color_account; ?></a></li>                      
                    <li><a class="text-left" href="#navtab-color-panels" data-toggle="tab"><i class="fa fa-cube" aria-hidden="true"></i> <?php echo $navtabs_color_panels; ?></a></li>
                    <li><a class="text-left" href="#navtab-color-tables" data-toggle="tab"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo $navtabs_color_tables; ?></a></li>
                    <li><a class="text-left" href="#navtab-color-buttons" data-toggle="tab"><i class="fa fa-key" aria-hidden="true"></i> <?php echo $navtabs_color_buttons; ?></a></li>
                  </ul>
                </div>
                <div class="col-sm-8">
                  <div class="tab-content">
                    <div class="tab-pane" id="navtab-color-container">
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_container; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_container]" value="<?php echo !empty($mpcheckout_color['background_container']) ? $mpcheckout_color['background_container'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_container_heading; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_container_heading]" value="<?php echo !empty($mpcheckout_color['background_container_heading']) ? $mpcheckout_color['background_container_heading'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_container_heading; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_container_heading]" value="<?php echo !empty($mpcheckout_color['font_container_heading']) ? $mpcheckout_color['font_container_heading'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-color-account">
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_account_panel; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_account_panel]" value="<?php echo !empty($mpcheckout_color['background_account_panel']) ? $mpcheckout_color['background_account_panel'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_account_panel; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_account_panel]" value="<?php echo !empty($mpcheckout_color['font_account_panel']) ? $mpcheckout_color['font_account_panel'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_hover_account_panel; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_hover_account_panel]" value="<?php echo !empty($mpcheckout_color['background_hover_account_panel']) ? $mpcheckout_color['background_hover_account_panel'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_hover_account_panel; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_hover_account_panel]" value="<?php echo !empty($mpcheckout_color['font_hover_account_panel']) ? $mpcheckout_color['font_hover_account_panel'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-color-panels">
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_panel; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_panel]" value="<?php echo !empty($mpcheckout_color['background_panel']) ? $mpcheckout_color['background_panel'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_panel_default; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_panel_default]" value="<?php echo !empty($mpcheckout_color['border_panel_default']) ? $mpcheckout_color['border_panel_default'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_panel; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_panel]" value="<?php echo !empty($mpcheckout_color['font_panel']) ? $mpcheckout_color['font_panel'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_panel_heading; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_panel_heading]" value="<?php echo !empty($mpcheckout_color['background_panel_heading']) ? $mpcheckout_color['background_panel_heading'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_panel_body; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_panel_body]" value="<?php echo !empty($mpcheckout_color['font_panel_body']) ? $mpcheckout_color['font_panel_body'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_panel_body; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_panel_body]" value="<?php echo !empty($mpcheckout_color['border_panel_body']) ? $mpcheckout_color['border_panel_body'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_panel_icon; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_panel_icon]" value="<?php echo !empty($mpcheckout_color['background_panel_icon']) ? $mpcheckout_color['background_panel_icon'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_panel_icon; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_panel_icon]" value="<?php echo !empty($mpcheckout_color['font_panel_icon']) ? $mpcheckout_color['font_panel_icon'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_panel_confirm; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_panel_confirm]" value="<?php echo !empty($mpcheckout_color['border_panel_confirm']) ? $mpcheckout_color['border_panel_confirm'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-color-tables">                      
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_table; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_table]" value="<?php echo !empty($mpcheckout_color['background_table']) ? $mpcheckout_color['background_table'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_table_data; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_table_data]" value="<?php echo !empty($mpcheckout_color['font_table_data']) ? $mpcheckout_color['font_table_data'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_top_table_data; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_top_table_data]" value="<?php echo !empty($mpcheckout_color['border_top_table_data']) ? $mpcheckout_color['border_top_table_data'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_table_data; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_table_data]" value="<?php echo !empty($mpcheckout_color['border_table_data']) ? $mpcheckout_color['border_table_data'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_order_total_color; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[order_total_color]" value="<?php echo !empty($mpcheckout_color['order_total_color']) ? $mpcheckout_color['order_total_color'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_order_total_color; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_order_total_color]" value="<?php echo !empty($mpcheckout_color['font_order_total_color']) ? $mpcheckout_color['font_order_total_color'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="navtab-color-buttons">
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_button; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_button]" value="<?php echo !empty($mpcheckout_color['background_button']) ? $mpcheckout_color['background_button'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_background_hover_button; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[background_hover_button]" value="<?php echo !empty($mpcheckout_color['background_hover_button']) ? $mpcheckout_color['background_hover_button'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_button; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_button]" value="<?php echo !empty($mpcheckout_color['font_button']) ? $mpcheckout_color['font_button'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_font_hover_button; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[font_hover_button]" value="<?php echo !empty($mpcheckout_color['font_hover_button']) ? $mpcheckout_color['font_hover_button'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_button; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_button]" value="<?php echo !empty($mpcheckout_color['border_button']) ? $mpcheckout_color['border_button'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12 control-label"><?php echo $entry_border_hover_button; ?></label>
                        <div class="col-sm-5">
                          <div class="input-group colorpicker colorpicker-component"> 
                            <input type="text" name="mpcheckout_color[border_hover_button]" value="<?php echo !empty($mpcheckout_color['border_hover_button']) ? $mpcheckout_color['border_hover_button'] : ''; ?>" class="form-control" /> 
                            <span class="input-group-addon"><i></i></span> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bs-callout bs-callout-info"> 
                <h4><?php echo $info_css_heading; ?></h4> 
                <p><?php echo $info_css_description; ?></p> 
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_css; ?></label>
                <div class="col-sm-10">
                  <textarea name="mpcheckout_css" class="form-control" rows="8"><?php echo $mpcheckout_css; ?></textarea>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-support">
              <fieldset>
                <div class="form-group">
                  <div class="col-md-12 col-xs-12">
                    <h4 class="text-mpsuccess text-center"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Thanks For Choosing Our Extension</h4>
                     <ul class="list-group">
                      <li class="list-group-item clearfix">Installed Version <span class="badge"><i class="fa fa-gg" aria-hidden="true"></i> V.1.0</span></li>
                    </ul>
                    <h4 class="text-mpsuccess text-center"><i class="fa fa-phone" aria-hidden="true"></i> Please Contact Us In Case Any Issue OR Give Feedback!</h4>
                    <ul class="list-group">
                      <li class="list-group-item clearfix">support@modulepoints.com <span class="badge"><a href="mailto:support@modulepoints.com?Subject=Request Support: Quick Checkout Extension"><i class="fa fa-envelope"></i> Contact Us</a></span></li> 
                    </ul>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
  $('select[name=\'mpcheckout_country_id\']').on('change', function() {
    $.ajax({
      url: 'index.php?route=mpcheckout/mpcheckout/country&token=<?php echo $token; ?>&country_id=' + this.value,
      dataType: 'json',
      beforeSend: function() {
        $('select[name=\'mpcheckout_country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
      },
      complete: function() {
        $('.fa-spin').remove();
      },
      success: function(json) {
        html = '<option value=""><?php echo $text_select; ?></option>';

        if (json['zone'] && json['zone'] != '') {
          for (i = 0; i < json['zone'].length; i++) {
                  html += '<option value="' + json['zone'][i]['zone_id'] + '"';

            if (json['zone'][i]['zone_id'] == '<?php echo $mpcheckout_zone_id; ?>') {
                    html += ' selected="selected"';
            }

            html += '>' + json['zone'][i]['name'] + '</option>';
          }
        } else {
          html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
        }

        $('select[name=\'mpcheckout_zone_id\']').html(html);
        
        $('#button-save').prop('disabled', false);
      }
    });
  });

  $('select[name=\'mpcheckout_country_id\']').trigger('change');
  //--></script>  
  <script type="text/javascript"><!--
  $('#panels a:first').tab('show');
  $('#lang-panels a:first').tab('show');
  $('#color-tabs a:first').tab('show');

  $('#language-page a:first').tab('show');
  $('#language-account-buttons a:first').tab('show');
  $('#language-account-panel a:first').tab('show');
  $('#language-login-panel a:first').tab('show');
  $('#language-payment-address a:first').tab('show');
  $('#language-shipping-address a:first').tab('show');
  $('#language-payment-method a:first').tab('show');
  $('#language-shipping-method a:first').tab('show');
  $('#language-social a:first').tab('show');
  $('#language-cart a:first').tab('show');
  $('#language-confirm-order a:first').tab('show');
  $('#language-success a:first').tab('show');
  $('#language-date a:first').tab('show');
  //--></script>
<script type="text/javascript"><!--
// Category
$('input[name=\'product\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'product\']').val('');

    $('#product-product' + item['value']).remove();

    $('#product-product').append('<div id="product-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="mpcheckout_success_product[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-product').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
//--></script>
<script type="text/javascript"><!--
// Color Picker
$(function() { $('.colorpicker').colorpicker(); }); 
//--></script>

  <?php if(VERSION <= '2.2.0.0') { ?>
    <?php foreach ($languages as $language) { ?>
    <script type="text/javascript"><!--
      $('#input-message_register<?php echo $language['language_id']; ?>').summernote({ height: 300 });
      $('#input-message_logged<?php echo $language['language_id']; ?>').summernote({ height: 300 });
      $('#input-success-customer<?php echo $language['language_id']; ?>').summernote({ height: 300 });
      $('#input-success-guest<?php echo $language['language_id']; ?>').summernote({ height: 300 });
    //--></script>
   <?php } ?>
  <?php } else { ?>
    <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
    <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
    <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
  <?php } ?>
</div>
<?php echo $footer; ?>