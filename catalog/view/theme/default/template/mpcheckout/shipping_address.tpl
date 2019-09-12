<div class="panel panel-default shipping-address-panel" <?php echo $logged_display_ship_not_required ? 'style="display:none"' : ''; ?>>
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-map-marker"></i> <?php echo $panel_shipping_details; ?> </h4>
  </div>
  <div class="panel-body">
    <?php if ($addresses) { ?>
    <div class="radio">
      <label>
        <input type="radio" name="shipping_address[shipping_address]" value="existing" checked="checked" />
        <?php echo $text_address_existing; ?></label>
    </div>
    <div id="shipping-existing">
      <select name="shipping_address[address_id]" class="form-control">
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
        <input type="radio" name="shipping_address[shipping_address]" value="new" />
        <?php echo $text_address_new; ?></label>
    </div>
    <br />
    <?php } ?>
    <div id="shipping-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
      <div class="row">
        <?php foreach($address_fields as $key => $address_field) { ?>
        <?php if($key == 'firstname' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-firstname"><?php echo $entry_firstname; ?></label>
          <input type="text" name="shipping_address[firstname]" value="" placeholder="<?php echo $hold_firstname; ?>" class="form-control" id="input-shipping-firstname" />
        </div>
        <?php } ?>

        <?php if($key == 'lastname' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100  xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-lastname"><?php echo $entry_lastname; ?></label>
          <input type="text" name="shipping_address[lastname]" value="" placeholder="<?php echo $hold_lastname; ?>" class="form-control" id="input-shipping-lastname">
        </div>
        <?php } ?>

        <?php if($key == 'company' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-company"><?php echo $entry_company; ?></label>
          <input type="text" name="shipping_address[company]" value="" placeholder="<?php echo $hold_company; ?>" class="form-control" id="input-shipping-company">
        </div>
        <?php } ?>

        <?php if($key == 'address_1' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-address-1"><?php echo $entry_address_1; ?></label>
          <input type="text" name="shipping_address[address_1]" value="" placeholder="<?php echo $hold_address_1; ?>" class="form-control" id="input-shipping-address-1">
        </div>
        <?php } ?>

        <?php if($key == 'address_2' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-address-2"><?php echo $entry_address_2; ?></label>
          <input type="text" name="shipping_address[address_2]" value="" placeholder="<?php echo $hold_address_2; ?>" class="form-control" id="input-shipping-address-2">
        </div>
        <?php } ?>

        <?php if($key == 'city' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-city"><?php echo $entry_city; ?></label>
          <input type="text" name="shipping_address[city]" value="" placeholder="<?php echo $hold_city; ?>" class="form-control" id="input-shipping-city">
        </div>
        <?php } ?>

        <?php if($key == 'postcode' && $address_field) { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-postcode"><?php echo $entry_postcode; ?></label>
          <input type="text" name="shipping_address[postcode]" value="" placeholder="<?php echo $hold_postcode; ?>" class="form-control" id="input-shipping-postcode">
        </div>
        <?php } ?>

        <?php if($key == 'country') { ?>
        <div class="form-group col-sm-6 xl-50 sm-100 xs-100 <?php echo !$address_field ? 'hide' : ''; ?> <?php echo $address_field == 1 ? 'required' : ''; ?>">
          <label class="control-label" for="input-shipping-country"><?php echo $entry_country; ?></label>
          <select name="shipping_address[country_id]" id="input-shipping-country" class="form-control"  data-zone="<?php echo $zone_id; ?>" data-select="<?php echo $text_select; ?>" data-none="<?php echo $text_none; ?>">
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
          <label class="control-label" for="input-shipping-zone"><?php echo $entry_zone; ?></label>
          <select name="shipping_address[zone_id]" id="input-shipping-zone" class="form-control">
          </select>
        </div>
        <?php } ?>
        <?php } ?>

        <?php foreach ($custom_fields as $custom_field) { ?>
        <?php if ($custom_field['location'] == 'address') { ?>
        <?php if ($custom_field['type'] == 'select') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <select name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'radio') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-12 xl-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label"><?php echo $custom_field['name']; ?></label>
          <div id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>">
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="radio">
              <label>
                <input type="radio" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                <?php echo $custom_field_value['name']; ?></label>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'checkbox') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-12 xl-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label"><?php echo $custom_field['name']; ?></label>
          <div id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>">
            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                <?php echo $custom_field_value['name']; ?></label>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'text') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <input type="text" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'textarea') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <textarea name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo $custom_field['value']; ?></textarea>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'file') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label"><?php echo $custom_field['name']; ?></label>
          <br />
          <button type="button" id="button-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
          <input type="hidden" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'date') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <div class="input-group date">
            <input type="text" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
            <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
            </span></div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'time') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <div class="input-group time">
            <input type="text" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
            <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
            </span></div>
        </div>
        <?php } ?>
        <?php if ($custom_field['type'] == 'datetime') { ?>
        <div id="shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-group<?php echo ($custom_field['required'] ? ' required' : ''); ?> custom-field col-sm-6 xl-50 sm-100 xs-100" data-sort="<?php echo $custom_field['sort_order']; ?>">
          <label class="control-label" for="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
          <div class="input-group datetime">
            <input type="text" name="shipping_address[custom_field][<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-shipping-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
            <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
            </span></div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
    <div class="shippingaddress-loader"></div>
  </div>
</div>
<script type="text/javascript"><!--
$('.date').datetimepicker({
  pickTime: false
});

$('.time').datetimepicker({
  pickDate: false
});

$('.datetime').datetimepicker({
  pickDate: true,
  pickTime: true
});

$('.shipping-address-panel .form-group[data-sort]').detach().each(function() {
  if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('.shipping-address-panel .form-group').length) {
    $('.shipping-address-panel .form-group').eq($(this).attr('data-sort')).before(this);
  }

  if ($(this).attr('data-sort') > $('.shipping-address-panel .form-group').length) {
    $('.shipping-address-panel .form-group:last').after(this);
  }

  if ($(this).attr('data-sort') == $('.shipping-address-panel .form-group').length) {
    $('.shipping-address-panel .form-group:last').after(this);
  }

  if ($(this).attr('data-sort') < -$('.shipping-address-panel .form-group').length) {
    $('.shipping-address-panel .form-group:first').before(this);
  }
});
//--></script>