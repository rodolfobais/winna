<div class="panel panel-default signup-panel">
  <div class="panel-heading">
    <h4 class="panel-title signup-click-me <?php echo $default_account_button == 'register' ? '' : 'hide'; ?>"><i class="fa fa-user-plus"></i> <?php echo $panel_signup_details; ?></h4>

    <h4 class="panel-title guest-click-me <?php echo $default_account_button == 'register' ? 'hide' : ''; ?>"><i class="fa fa-user-secret"></i> <?php echo $panel_guest_details; ?></h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12 xl-100 form-group" style="display: <?php echo (count($customer_groups) > 1 ? 'block' : 'none'); ?>;">
        <label class="control-label"><?php echo $entry_customer_group; ?></label>
        <?php foreach ($customer_groups as $customer_group) { ?>
        <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
        <div class="radio">
          <label>
            <input type="radio" name="signup[customer_group_id]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
            <?php echo $customer_group['name']; ?></label>
        </div>
        <?php } else { ?>
        <div class="radio">
          <label>
            <input type="radio" name="signup[customer_group_id]" value="<?php echo $customer_group['customer_group_id']; ?>" />
            <?php echo $customer_group['name']; ?></label>
        </div>
        <?php } ?>
        <?php } ?>
      </div>
      
      <?php foreach($account_fields as $key => $account_field) { ?>
      <?php if($key == 'firstname' && $account_field) { ?>
      <div class="col-sm-6 xl-50 sm-100 x-100 form-group <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-firstname"><?php echo $entry_firstname; ?></label>
        <input type="text" name="signup[firstname]" value="" class="form-control" placeholder="<?php echo $hold_firstname; ?>" id="input-signup-firstname" />
      </div>
      <?php } ?>

      <?php if($key == 'lastname' && $account_field) { ?>
      <div class="col-sm-6 xl-50 sm-100 x-100 form-group <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-lastname"><?php echo $entry_lastname; ?></label>
        <input type="text" name="signup[lastname]" value="" class="form-control" placeholder="<?php echo $hold_lastname; ?>" id="input-signup-lastname" />
      </div>
      <?php } ?>

      <?php if($key == 'email' && $account_field) { ?>
      <div class="col-sm-6 xl-50 sm-100 x-100 form-group <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-email"><?php echo $entry_email; ?></label>
        <input type="text" name="signup[email]" id="input-signup-email" value="" class="form-control" placeholder="<?php echo $hold_email; ?>" />
      </div>
      <?php } ?>

      <?php if($key == 'telephone' && $account_field) { ?>
      <div class="col-sm-6 xl-50 sm-100 x-100 form-group <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-telephone"><?php echo $entry_telephone; ?></label>
        <input type="text" name="signup[telephone]" value="" class="form-control" placeholder="<?php echo $hold_telephone; ?>" id="input-signup-telephone" />
      </div>
      <?php } ?>

      <?php if($key == 'fax' && $account_field) { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-fax"><?php echo $entry_fax; ?></label>
        <input type="text" name="signup[fax]" value="" id="input-signup-fax" class="form-control" placeholder="<?php echo $hold_fax; ?>">
      </div>
      <?php } ?>

      <?php if($key == 'company' && $account_field) { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-company"><?php echo $entry_company; ?></label>
        <input type="text" name="signup[company]" value="" id="input-signup-company" class="form-control" placeholder="<?php echo $hold_company; ?>" />
      </div>
      <?php } ?>

      <?php if($key == 'address_1' && $account_field) { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-address-1"><?php echo $entry_address_1; ?></label>
        <input type="text" name="signup[address_1]" value="" id="input-signup-address-1" class="form-control" placeholder="<?php echo $hold_address_1; ?>" />
      </div>
      <?php } ?>

      <?php if($key == 'address_2' && $account_field) { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-address-2"><?php echo $entry_address_2; ?></label>
        <input type="text" name="signup[address_2]" value="" id="input-signup-address-2" class="form-control" placeholder="<?php echo $hold_address_2; ?>" />
      </div>
      <?php } ?>

      <?php if($key == 'city' && $account_field) { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-city"><?php echo $entry_city; ?></label>
        <input type="text" name="signup[city]" value="" id="input-signup-city" class="form-control" placeholder="<?php echo $hold_city; ?>" />
      </div>
      <?php } ?>

      <?php if($key == 'postcode' && $account_field) { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-postcode"><?php echo $entry_postcode; ?></label>
        <input type="text" name="signup[postcode]" value="<?php echo $postcode; ?>" id="input-signup-postcode" class="form-control" placeholder="<?php echo $hold_postcode; ?>" />
      </div>
      <?php } ?>

      <?php if($key == 'country') { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo !$account_field ? 'hide' : ''; ?> <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-country"><?php echo $entry_country; ?></label>
        <select name="signup[country_id]" id="input-signup-country" class="form-control" data-zone="<?php echo $zone_id; ?>" data-select="<?php echo $text_select; ?>" data-none="<?php echo $text_none; ?>">
          <option value=""><?php echo $text_select; ?></option>
          <?php foreach ($countries as $country) { ?>
          <?php if ($country['country_id'] == $country_id) { ?>
          <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
      <?php } ?>

      <?php if($key == 'zone') { ?>
      <div class="form-group col-sm-6 xl-50 sm-100 x-100 <?php echo !$account_field ? 'hide' : ''; ?> <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-signup-zone"><?php echo $entry_zone; ?></label>
        <select name="signup[zone_id]" id="input-signup-zone" class="form-control">
        </select>
      </div>
      <?php } ?>
      <?php } ?>

      <?php foreach ($custom_fields as $custom_field) { ?>
      <?php if ($custom_field['type'] == 'select') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label" for="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
        <select name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]]" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
          <option value=""><?php echo $text_select; ?></option>
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
          <?php } ?>
        </select>
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'radio') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-12 xl-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label"><?php echo $custom_field['name']; ?></label>
        <div id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>">
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <div class="radio" style="display: inline-block; margin-top: 5px">
            <label>
              <input type="radio" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
              <?php echo $custom_field_value['name']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'checkbox') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-12 xl-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label"><?php echo $custom_field['name']; ?></label>
        <div class="clearfix" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>">
          <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
          <div class="checkbox" style="float: left;margin-bottom: 7px;margin-top: 7px;margin-right: 10px;">
            <label>
              <input type="checkbox" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
              <?php echo $custom_field_value['name']; ?></label>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'text') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label" for="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
        <input type="text" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'textarea') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label" for="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
        <textarea name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo $custom_field['value']; ?></textarea>
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'file') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label"><?php echo $custom_field['name']; ?></label>
        <br />
        <button type="button" id="button-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
        <input type="hidden" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'date') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label" for="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
        <div class="input-group date">
          <input type="text" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'time') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label" for="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
        <div class="input-group time">
          <input type="text" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
      <?php } ?>
      <?php if ($custom_field['type'] == 'datetime') { ?>
      <div id="signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group custom-field col-sm-6 xl-50 sm-100 x-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
        <label class="control-label" for="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
        <div class="input-group datetime">
          <input type="text" name="signup[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-signup-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span></div>
      </div>
      <?php } ?>
      <?php } ?>
      
      <?php foreach($account_fields as $key => $account_field) { ?>
      <?php if($key == 'password' && $account_field) { ?>
      <div class="password-panel signup-click-me <?php echo $default_account_button == 'guest' ? 'hide' : ''; ?> form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-pass-password"><?php echo $entry_password; ?></label>
        <input type="password" name="signup[password]" value="" class="form-control" placeholder="<?php echo $hold_password; ?>" id="input-pass-password" />
      </div>
      <?php } ?>

      <?php if($key == 'confirm_password' && $account_field) { ?>
      <div class="password-panel signup-click-me <?php echo $default_account_button == 'guest' ? 'hide' : ''; ?> form-group col-sm-6 xl-50 sm-100 x-100 <?php echo $account_field == 1 ? 'required' : ''; ?>">
        <label class="control-label" for="input-pass-confirm-password"><?php echo $entry_confirm_password; ?></label>
        <input type="password" name="signup[confirm_password]" id="input-pass-confirm-password" value="" class="form-control" placeholder="<?php echo $hold_confirm_password; ?>"/>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
    <div class="row">
    	<div class="col-sm-12">
  		<?php echo $captcha; ?>
  		</div>
  	</div>
  </div>
</div>
<div class="panel panel-default privacy-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-info" aria-hidden="true"></i> <?php echo $panel_others; ?></h4>
  </div>
  <div class="panel-body">
    <?php if($newsletter_subscribe_status) { ?>
    <div class="checkbox signup-click-me <?php echo $default_account_button == 'guest' ? 'hide' : ''; ?>">
      <label>
        <input type="checkbox" name="signup[newsletter]" value="1" <?php echo $newsletter_subscribe_check ? 'checked="checked"' : ''; ?> />
        <?php echo $text_newsletter; ?>
      </label>
    </div>
    <?php } ?>

    <?php if ($text_agree) { ?>
    <div class="checkbox signup-click-me <?php echo $default_account_button == 'guest' ? 'hide' : ''; ?>">
      <label>
        <?php if($default_terms) { ?>
        <input type="checkbox" name="signup[agree]" value="1" checked="checked" /> 
        <?php } else{ ?>
        <input type="checkbox" name="signup[agree]" value="1" /> 
        <?php } ?>
        <?php echo $text_agree; ?>
      </label>
    </div>
    <?php } ?>

    <?php if($shipping_required) {
      $style_class = '';
    } else {
      $style_class = 'hide';
    } ?>
    <div class="checkbox sameasaddress <?php echo $style_class; ?>">
      <label>
        <input type="checkbox" name="same_address" value="1" <?php echo $delivery_address_check ? 'checked="checked"' : ''; ?> /> 
        <?php echo $text_same_address; ?>
      </label>
    </div>

    <?php if(!$shipping_required) { ?>
      <p class="norequire_saddress"><i class="fa fa-bell-o" aria-hidden="true"></i> <strong><?php echo $text_norequire_saddress; ?></strong></p>
    <?php } ?>
  </div>
</div>  