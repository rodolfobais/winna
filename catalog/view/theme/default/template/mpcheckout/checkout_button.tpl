    <?php if(!empty($show_comment)) { ?>
    <div class="form-group">
      <textarea name="comment" class="form-control" placeholder="<?php echo $comment_placeholder; ?>" rows="6"><?php echo $comment; ?></textarea>
    </div>
    <?php } ?>

    <?php if ($text_agree) { ?>
    <div class="checkbox">
      <label>
      <?php if ($agree) { ?>
      <input type="checkbox" name="agree" value="1" checked="checked" /> 
      <?php } else { ?>
      <input type="checkbox" name="agree" value="1" /> 
      <?php } ?>
      <?php echo $text_agree; ?>
      </label>
    </div>
    <?php } ?>

    <?php if(!empty($payment)) { ?>
    <?php echo $payment; ?>
    <?php } else{ ?>
    <div class="buttons">
      
      <?php if($continue_shopping_button) { ?>
      <a href="<?php echo $continue_shopping; ?>" class="btn btn-primary pull-left"><i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i> &nbsp;<?php echo $button_continue_shopping; ?></a> 
      <?php } ?>

      <button type="button" id="button-checkout" class="btn btn-primary pull-right"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $button_checkout; ?></button>
    </div>
    <?php } ?>
<?php if(!empty($autotrigger_order)) { ?>
<script type="text/javascript"><!--
$('#button-confirm').trigger('click');
$('.checkout-button-position input[type="submit"]').trigger('click');
//--></script>
<?php } ?>