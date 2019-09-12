<div class="panel panel-default payment-address-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-location-arrow"></i> <?php echo $panel_billing_details; ?></h4>
  </div>
  <div class="panel-body">
    <?php if ($addresses) { ?>
    <div class="radio">
      <label>
        <input type="radio" name="payment_address[payment_address]" value="existing" checked="checked" />
        <?php echo $text_address_existing; ?></label>
    </div>
    <div id="payment-existing">
      <select name="payment_address[address_id]" class="form-control">
        <?php foreach ($addresses as $address) { ?>
        <?php if ($address['address_id'] == $address_id) { ?>
        <option value="<?php echo $address['address_id']; ?>" selected="selected"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="payment_address[payment_address]" value="new" />
        <?php echo $text_address_new; ?></label>
    </div>
    <?php } ?>
    <div id="payment-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
      <div class="row">
        <?php foreach($address_fields as $key => $address_field) { ?>
        <?php if($key == 'firstname' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-firstname"><?php echo $entry_firstname; ?></label>
          <input type="text" name="payment_address[firstname]" value="" id="input-payment-firstname" placeholder="<?php echo $hold_firstname; ?>" class="form-control" />
        </div>
        <?php } ?>

        <?php if($key == 'lastname' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-lastname"><?php echo $entry_lastname; ?></label>
          <input type="text" name="payment_address[lastname]" value="" id="input-payment-lastname" placeholder="<?php echo $hold_lastname; ?>" class="form-control" />
        </div>
        <?php } ?>

        <?php if($key == 'company' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-company"><?php echo $entry_company; ?></label>
          <input type="text" name="payment_address[company]" value="" id="input-payment-company" placeholder="<?php echo $hold_company; ?>" class="form-control" />
        </div>
        <?php } ?>

        <?php if($key == 'address_1' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-address-1"><?php echo $entry_address_1; ?></label>
          <input type="text" name="payment_address[address_1]" value="" id="input-payment-address-1" placeholder="<?php echo $hold_address_1; ?>" class="form-control" />
        </div>
        <?php } ?>

        <?php if($key == 'address_2' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-address-2"><?php echo $entry_address_2; ?></label>
          <input type="text" name="payment_address[address_2]" value="" id="input-payment-address-2" placeholder="<?php echo $hold_address_2; ?>" class="form-control" />
        </div>
        <?php } ?>

        <?php if($key == 'city' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-city"><?php echo $entry_city; ?></label>
          <input type="text" name="payment_address[city]" value="" id="input-payment-city" placeholder="<?php echo $hold_city; ?>" class="form-control" />
        </div>
        <?php } ?>

        <?php if($key == 'postcode' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-postcode"><?php echo $entry_postcode; ?></label>
          <input type="text" name="payment_address[postcode]" id="input-payment-postcode" value="" placeholder="<?php echo $hold_postcode; ?>" class="form-control"/>
        </div>
        <?php } ?>

        <?php if($key == 'country') { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo !$address_field ? 'hide' : ''; ?> <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-country"><?php echo $entry_country; ?></label>
          <select name="payment_address[country_id]" id="input-payment-country" class="form-control" data-zone="<?php echo $zone_id; ?>" data-select="<?php echo $text_select; ?>" data-none="<?php echo $text_none; ?>">
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
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo !$address_field ? 'hide' : ''; ?> <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-payment-zone"><?php echo $entry_zone; ?></label>
          <select name="payment_address[zone_id]" id="input-payment-zone" class="form-control">
          </select>
        </div>
        <?php } ?>
        <?php } ?>

        <?php foreach ($custom_fields as $custom_field) { ?>
        <?php if ($custom_field['location'] == 'address') { ?>
        <?php if ($custom_field['type'] == 'select') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <select name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'radio') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-12 xl-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label"><?php echo $custom_field['name']; ?></label>
          <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="radio">
              <label>
                <input type="radio" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                <?php echo $custom_field_value['name']; ?></label>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'checkbox') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-12 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label"><?php echo $custom_field['name']; ?></label>
          <div id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>">
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                <?php echo $custom_field_value['name']; ?></label>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'text') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <input type="text" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'textarea') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <textarea name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo $custom_field['value']; ?></textarea>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'file') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label"><?php echo $custom_field['name']; ?></label>
          <br />
          <button type="button" id="button-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
          <input type="hidden" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'date') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <div class="input-group date">
            <input type="text" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
            <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
            </span></div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'time') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <div class="input-group time">
            <input type="text" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
            <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
            </span></div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'datetime') { ?>
        <div id="payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <div class="input-group datetime">
            <input type="text" name="payment_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-payment-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
            <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
            </span></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php } ?>
      </div>
    </div>

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