<?php echo $header; ?>
<div class="container">
   <!--<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>-->
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    
    <?php echo $content_top; ?>
    
    <div class="<?php echo $class; ?>">
 	      <div class="container">
	      	<div class="row about_content">
	      		<div class="col-sm-4 about_title">
	      			<h1><?php echo $heading_title; ?></h1>
	      		</div>
	      		<div class="col-sm-8 about_text">
	      			<?php echo $description; ?>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-sm-12">
	      			<?php echo $content_bottom; ?>
	      		</div>
	      	</div> 
	      </div>	
      </div>
  </div>
</div>
<?php echo $footer; ?>