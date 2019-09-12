<div class="panel panel-default shipping-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-shipping" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $heading_title; ?> <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-shipping" class="panel-collapse collapse">
    <div class="panel-body">
      <p><?php echo $text_shipping; ?></p>
      <div class="form-horizontal">
        <div class="form-group required">
          <label class="col-sm-12 xl-100 xs-100 text-left control-label" for="input-country"><?php echo $entry_country; ?></label>
          <div class="col-sm-12 xl-100 xs-100">
            <select name="country_id" id="input-country" class="form-control">
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
        </div>
        <div class="form-group required">
          <label class="col-sm-12 xl-100 xs-100 text-left control-label" for="input-zone"><?php echo $entry_zone; ?></label>
          <div class="col-sm-12 xl-100 xs-100">
            <select name="zone_id" id="input-zone" class="form-control">
            </select>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-12 xl-100 xs-100 text-left control-label" for="input-postcode"><?php echo $entry_postcode; ?></label>
          <div class="col-sm-12 xl-100 xs-100">
            <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode" class="form-control" />
          </div>
        </div>
        <button type="button" id="button-quote" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_quote; ?></button>
      </div>
      <script type="text/javascript"><!--
	$('#button-quote').on('click', function() {
		$.ajax({
			url: 'index.php?route=mpcheckout/mptotal/shipping/quote',
			type: 'post',
			data: 'country_id=' + $('select[name=\'country_id\']').val() + '&zone_id=' + $('select[name=\'zone_id\']').val() + '&postcode=' + encodeURIComponent($('input[name=\'postcode\']').val()),
			dataType: 'json',
			beforeSend: function() {
				$('#button-quote').button('loading');
			},
			complete: function() {
				$('#button-quote').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['error']) {
					if (json['error']['warning']) {
						$('.shipping-panel .panel-body').prepend('<div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					}

					if (json['error']['country']) {
						$('.shipping-panel select[name=\'country_id\']').after('<div class="text-danger">' + json['error']['country'] + '</div>');
					}

					if (json['error']['zone']) {
						$('.shipping-panel select[name=\'zone_id\']').after('<div class="text-danger">' + json['error']['zone'] + '</div>');
					}

					if (json['error']['postcode']) {
						$('input[name=\'postcode\']').after('<div class="text-danger">' + json['error']['postcode'] + '</div>');
					}
				}

				if (json['shipping_method']) {
					$('#modal-shipping').remove();

					html  = '<div id="modal-shipping" class="modal">';
					html += '  <div class="modal-dialog">';
					html += '    <div class="modal-content">';
					html += '      <div class="modal-header">';
					html += '        <h4 class="modal-title"><?php echo $text_shipping_method; ?></h4>';
					html += '      </div>';
					html += '      <div class="modal-body">';

					for (i in json['shipping_method']) {
						html += '<p><strong>' + json['shipping_method'][i]['title'] + '</strong></p>';

						if (!json['shipping_method'][i]['error']) {
							for (j in json['shipping_method'][i]['quote']) {
								html += '<div class="radio">';
								html += '  <label>';

								if (json['shipping_method'][i]['quote'][j]['code'] == '<?php echo $shipping_method; ?>') {
									html += '<input type="radio" name="shipping_method_cart" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" checked="checked" />';
								} else {
									html += '<input type="radio" name="shipping_method_cart" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" />';
								}

								html += json['shipping_method'][i]['quote'][j]['title'] + ' - ' + json['shipping_method'][i]['quote'][j]['text'] + '</label></div>';
							}
						} else {
							html += '<div class="alert alert-danger warning">' + json['shipping_method'][i]['error'] + '</div>';
						}
					}

					html += '      </div>';
					html += '      <div class="modal-footer">';
					html += '        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_cancel; ?></button>';

					<?php if ($shipping_method) { ?>
					html += '        <input type="button" value="<?php echo $button_shipping; ?>" id="button-shipping" onclick="ButtonShipping();" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />';
					<?php } else { ?>
					html += '        <input type="button" value="<?php echo $button_shipping; ?>" id="button-shipping" onclick="ButtonShipping();" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" disabled="disabled" />';
					<?php } ?>

					html += '      </div>';
					html += '    </div>';
					html += '  </div>';
					html += '</div> ';

					$('body').append(html);

					$('#modal-shipping').modal('show');

					$('input[name=\'shipping_method_cart\']').on('change', function() {
						$('#button-shipping').prop('disabled', false);
					});
				}
			}
		});
	});

	function ButtonShipping() {
		$.ajax({
			url: 'index.php?route=mpcheckout/mptotal/shipping/shipping',
			type: 'post',
			data: 'shipping_method=' + encodeURIComponent($('input[name=\'shipping_method_cart\']:checked').val()),
			dataType: 'json',
			beforeSend: function() {
				$('#button-shipping').button('loading');
			},
			complete: function() {
				$('#button-shipping').button('reset');
			},
			success: function(json) {
				$('.shipping-panel .alert').remove();

				if (json['error']) {
					$('.shipping-panel .panel-body').prepend('<div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				if (json['refresh_cart']) {
					$('#modal-shipping').modal('hide');

					MPSHOPPINGCART.refresh();
				}
			}
		});
	}
	//--></script>
	<script type="text/javascript"><!--
	$('.shipping-panel select[name=\'country_id\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=mpcheckout/mptotal/shipping/country&country_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('.shipping-panel select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
			},
			complete: function() {
				$('.fa-spin').remove();
			},
			success: function(json) {
				if (json['postcode_required'] == '1') {
					$('input[name=\'postcode\']').parent().parent().addClass('required');
				} else {
					$('input[name=\'postcode\']').parent().parent().removeClass('required');
				}

				html = '<option value=""><?php echo $text_select; ?></option>';

				if (json['zone'] && json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';

						if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
							html += ' selected="selected"';
						}

						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
				}

				$('.shipping-panel select[name=\'zone_id\']').html(html);
			}
		});
	});

	$('.shipping-panel select[name=\'country_id\']').trigger('change');
	//--></script>
    </div>
  </div>
</div>