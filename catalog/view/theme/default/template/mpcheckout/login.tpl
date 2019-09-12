<div class="panel panel-default login-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-sign-in"></i> <?php echo $panel_login; ?> </h4>
  </div>
  <div class="panel-body">
  	<div class="form-group required">
  		<label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
  		<input type="email" name="email" value="" class="form-control" placeholder="<?php echo $hold_email; ?>" />
  	</div>
	  <div class="form-group required">
  		<label class="control-label" for="input-email"><?php echo $entry_password; ?></label>
  		<input type="password" name="password" value="" class="form-control" placeholder="<?php echo $hold_password; ?>" />
  	</div>
  	<button type="button" class="btn btn-primary" id="button-login"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $button_login; ?></button>
  </div>
</div>