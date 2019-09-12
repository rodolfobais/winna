<div class="panel-group accountoption-panel">
  <div data-toggle="buttons" class="clearfix">
    <?php if($account_buttons_status && in_array('register', $account_buttons_status)) { ?>
    <label class="btn btn-default accountoption-button <?php echo $default_account_button == 'register' ? 'active' : ''; ?>">
      <input type="radio" name="accountoption" value="register" <?php echo $default_account_button == 'register' ? 'checked="checked"' : ''; ?>><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $panel_register; ?>
    </label>
    <?php } ?>
    <?php if($account_buttons_status && in_array('guest', $account_buttons_status)) { ?>
    <label class="btn btn-default accountoption-button <?php echo $default_account_button == 'guest' ? 'active' : ''; ?>">
      <input type="radio" name="accountoption" value="guest" <?php echo $default_account_button == 'guest' ? 'checked="checked"' : ''; ?>><i class="fa fa-user-secret" aria-hidden="true"></i> <?php echo $panel_guest; ?> 
    </label>
    <?php } ?>
    <?php if($account_buttons_status && in_array('login', $account_buttons_status)) { ?>
    <label class="btn btn-default accountoption-button <?php echo $default_account_button == 'login' ? 'active' : ''; ?>">
      <input type="radio" name="accountoption" value="login" <?php echo $default_account_button == 'login' ? 'checked="checked"' : ''; ?>><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo $panel_login; ?>  
    </label>
    <?php } ?>
  </div>
</div>

<?php if(!empty($social_google_status) || !empty($social_facebook_status) || !empty($social_linkedin_status) || !empty($social_instagram_status)|| !empty($social_twitter_status)) { ?>
<div class="panel panel-default mp-social-logins <?php echo $default_account_button == 'guest' ? 'hide' : ''; ?>">
	<div class="panel-heading">
	    <h4 class="panel-title"><i class="fa fa-external-link"></i> <?php echo $panel_sociallogin; ?> </h4>
	 </div>
	 <div class="panel-body">
		<div class="row">
			<?php if(!empty($social_facebook_status)) { ?>
			<div class="col-sm-6">
				<a href="<?php echo $facebook_href; ?>"><img src="catalog/view/theme/default/image/mpcheckout/fb-login.png" class="img-responsive" alt="" /></a>
			</div>	
			<?php } ?>

			<?php if(!empty($social_google_status)) { ?>
			<div class="col-sm-6">
				<a href="<?php echo $google_href; ?>"><img src="catalog/view/theme/default/image/mpcheckout/google-login.png" class="img-responsive" alt="" /></a>
			</div>	
			<?php } ?>

			<?php if(!empty($social_linkedin_status)) { ?>
			<div class="col-sm-6">
				<a href="<?php echo $linkedin_href; ?>"><img src="catalog/view/theme/default/image/mpcheckout/linkedin-login.png" class="img-responsive" alt="" /></a>
			</div>	
			<?php } ?>
			<!-- /*new updates 28032018 starts*/ --><?php if(!empty($social_instagram_status)) { ?>
			<div class="col-sm-6">
			<a href="<?php echo $instagram_href; ?>"><img src="catalog/view/theme/default/image/mpcheckout/instagram-login.png" class="img-responsive" alt="" /></a>
			</div>
			<?php } ?>
			<?php if(!empty($social_twitter_status)) { ?>
			<div class="col-sm-6">
			<a href="<?php echo $twitter_href; ?>"><img src="catalog/view/theme/default/image/mpcheckout/twitter-login.png" class="img-responsive" alt="" /></a>
			</div>
			<?php } ?><!-- /*new updates 28032018 ends*/ -->
		</div>	
	</div>
</div>
<?php } ?>
<!-- /*new updates 28032018 starts*/ -->
<?php if($email_prompt) { ?>
<div id="modal-mpqchkemail_prompt" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $text_mpemail_title; ?></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label" for="input-mpqchkemail"><?php echo $entry_mpemail; ?></label>
          <input type="text" name="mpcemail" value="" placeholder="<?php echo $entry_mpemail; ?>" id="input-mpqchkemail" class="form-control" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary mpqchksubmit" data-loading-text="<?php echo $text_loading; ?>"><?php echo $button_mpsubmit; ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $button_mpcancel; ?></button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var modal = '#modal-mpqchkemail_prompt';
  $(modal).modal('show');
  $(modal).find('.alert, .text-danger').remove();

  $('.mpqchksubmit').on('click', function() {
    var $this = $(this);
    var data = $(modal+' input[type="text"]').serialize();
    $('.alert, .text-danger').remove();

    $.ajax({
      url: 'index.php?route=mpcheckout/account_option_button/mpquickcheckoutGetCustomerEmail',
      type: 'post',
      data: data,
      dataType: 'json',
      beforeSend: function() {
        $this.button('loading');
      },
      complete: function() {
        $this.button('reset');
      },
      success: function(json) {
        $(modal).find('.alert, .text-danger').remove();

        if (json['error']) {
          if(typeof json['error']['email'] != 'undefined') {
            $('#input-mpqchkemail').after('<span class="text-danger">'+ json['error']['email']  +'</span>');
          }
          if(typeof json['error']['exists'] != 'undefined') {
            $('#input-mpqchkemail').after('<span class="text-danger">'+ json['error']['exists']  +'</span>');
          }
          if(typeof json['error']['warning'] != 'undefined') {
            $(modal).find('.modal-header').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> ' + json['error']['warning'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }
        }

        if (json['success']) {
          $(modal).modal('hide');
          location = json['redirect'];
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
</script>
<?php } ?>
<!-- /*new updates 28032018 ends*/ -->