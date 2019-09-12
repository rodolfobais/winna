<div class="panel panel-default voucher-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-voucher" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle"><?php echo $heading_title; ?> <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-voucher" class="panel-collapse collapse">
    <div class="panel-body">
      <label class="col-sm-12 xl-100 xs-100 padding-less control-label" for="input-voucher"><?php echo $entry_voucher; ?></label>
      <div class="input-group">
        <input type="text" name="voucher" value="<?php echo $voucher; ?>" placeholder="<?php echo $entry_voucher; ?>" id="input-voucher" class="form-control" />
        <span class="input-group-btn">
        <input type="submit" value="<?php echo $button_voucher; ?>" id="button-voucher" data-loading-text="<?php echo $text_loading; ?>"  class="btn btn-primary" />
        </span> </div>
      <script type="text/javascript"><!--
      $('.voucher-panel #button-voucher').on('click', function() {
        $.ajax({
          url: 'index.php?route=mpcheckout/mptotal/voucher/voucher',
          type: 'post',
          data: 'voucher=' + encodeURIComponent($('input[name=\'voucher\']').val()),
          dataType: 'json',
          beforeSend: function() {
            $('.voucher-panel #button-voucher').button('loading');
          },
          complete: function() {
            $('.voucher-panel #button-voucher').button('reset');
          },
          success: function(json) {
            $('.voucher-panel .alert').remove();

            if (json['error']) {
              $('.voucher-panel .panel-body').prepend('<div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }

            if (json['refresh_cart']) {
              MPSHOPPINGCART.refresh();
            }
          }
        });
      });
      //--></script>
    </div>
  </div>
</div>
