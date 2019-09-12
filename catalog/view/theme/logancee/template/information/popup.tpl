<?php echo $header; ?>

<style>
	body {
	    padding-top: 0px !important;
	}
	
	.navbar-fixed-bottom, .navbar-fixed-top {
	    display: none !important;
	}
	
</style>

<div class="container pop-up-page">
  <div class="row">
    
    <?php //echo $content_top; ?>
    
    <div class="col-sm-12'">
 	      <div class="container">
	      	<div class="row about_content">
	      		<div class="col-sm-4 about_title">
	      			<h1><?php echo $heading_title; ?></h1>
	      		</div>
	      		<div class="col-sm-8 about_text">
	      			<?php echo $description; ?>
	      		</div>
	      	</div>
	      </div>	
      </div>
  </div>
</div>
<?php //echo $footer; ?>