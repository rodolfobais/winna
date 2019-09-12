<div class="panel panel-default reward-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-reward" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $heading_title; ?> <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-reward" class="panel-collapse collapse">
    <div class="panel-body">
      <label class="col-sm-12 xl-100 xs-100 padding-less control-label" for="input-reward"><?php echo $entry_reward; ?></label>
  	<div class="input-group">
        <input type="text" name="reward" value="<?php echo $reward; ?>" placeholder="<?php echo $entry_reward; ?>" id="input-reward" class="form-control" />
        <span class="input-group-btn">
        <input type="submit" value="<?php echo $button_reward; ?>" id="button-reward" data-loading-text="<?php echo $text_loading; ?>"  class="btn btn-primary" />
        </span>
    </div>
  	<script type="text/javascript"><!--
	$('#button-reward').on('click', function() {
		$.ajax({
			url: 'index.php?route=mpcheckout/mptotal/reward/reward',
			type: 'post',
			data: 'reward=' + encodeURIComponent($('input[name=\'reward\']').val()),
			dataType: 'json',
			beforeSend: function() {
				$('#button-reward').button('loading');
			},
			complete: function() {
				$('#button-reward').button('reset');
			},
			success: function(json) {
				$('.reward-panel .alert').remove();

				if (json['error']) {
					$('.reward-panel .panel-body').prepend('<div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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