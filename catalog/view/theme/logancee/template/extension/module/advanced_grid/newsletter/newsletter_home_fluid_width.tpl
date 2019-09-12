<div class="subscribe home03 clearfix" id="newsletter<?php echo $id; ?>">
     <h2 class="title"><span><?php echo $module['content']['title']; ?></span></h2>
     <div class="text"><?php echo $module['content']['text']; ?></div>
          <div class="block-content">
               <div class="input-box">
                    <input name="email" type="text" id="newsletter" value="youremail@domain.com" onclick="this.value=='<?php echo $module['content']['input_placeholder']; ?>'?this.value='':''" onblur="this.value==''?this.value='<?php echo $module['content']['input_placeholder']; ?>':''"  class="input-text email required-entry validate-email">
                    <button class="hover-effect07 subscribebutton" type="submit" title="Subscribe"><span>Subscribe</span></button>
               </div>
          </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	function Unsubscribe() {
		$.post('<?php echo $module['content']['unsubscribe_url']; ?>', 
			{ 
				email: $('#newsletter<?php echo $id; ?> .email').val() 
			}, function (e) {
				$('#newsletter<?php echo $id; ?> .email').val('');
				alert(e.message);
			}
		, 'json');
	}
	
	function Subscribe() {
		$.post('<?php echo $module['content']['subscribe_url']; ?>', 
			{ 
				email: $('#newsletter<?php echo $id; ?> .email').val() 
			}, function (e) {
				if(e.error === 1) {
					var r = confirm(e.message);
					if (r == true) {
					    $.post('<?php echo $module['content']['unsubscribe_url']; ?>', { 
					    	email: $('#newsletter<?php echo $id; ?> .email').val() 
					    }, function (e) {
					    	$('#newsletter<?php echo $id; ?> .email').val('');
					    	alert(e.message);
					    }, 'json');
					}
				} else {
					$('#newsletter<?php echo $id; ?> .email').val('');
					alert(e.message);
				}
			}
		, 'json');
	}
	
	$('#newsletter<?php echo $id; ?> .subscribebutton').click(Subscribe);
	$('#newsletter<?php echo $id; ?> .unsubscribe').click(Unsubscribe);
	$('#newsletter<?php echo $id; ?> .email').keypress(function (e) {
	    if (e.which == 13) {
	        Subscribe();
	    }
	});
});
</script>