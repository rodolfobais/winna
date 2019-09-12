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
	      	<div class="row info_content stockists" style="min-height:600px;">
	      		<div class="col-sm-2 info_title">
	      			<h1><?php echo $heading_title; ?></h1>
	      				<ul class="nav nav-tabs tabs-left">
				        	<?php foreach ($informations as $information) { ?>
								<?php if ($information['information_id'] == "12" || $information['information_id'] == "13" || $information['information_id'] == "14" || $information['information_id'] == "15" || $information['information_id'] == "16" || $information['information_id'] == "17" || $information['information_id'] == "18" || $information['information_id'] == "30") { ?>
							    	<?php if ($information['information_id'] == "30") { ?>
							        	<li class="active"><a href="#<?php echo $information['information_id']; ?>" data-toggle="tab"><?php echo $information['title']; ?></a></li>
							        <?php } else { ?>
							          	<li><a href="#<?php echo $information['information_id']; ?>" data-toggle="tab"><?php echo $information['title']; ?></a></li>
							        <?php } ?>
							    <?php } ?>
							<?php } ?>
				        </ul>
	      		</div>
	      		<div class="col-sm-2 info_title">
	      		</div>
	      		<div class="col-sm-8 info_text">
	      			<div class="tab-content">
			            <?php foreach ($informations as $information) { ?>
						          		<?php if ($information['information_id'] == "12" || $information['information_id'] == "13" || $information['information_id'] == "14" || $information['information_id'] == "15" || $information['information_id'] == "16" || $information['information_id'] == "17" || $information['information_id'] == "18" || $information['information_id'] == "30") { ?>
						          			<!-- Tab panes -->
			      							
			      								<?php if ($information['information_id'] == "30") { ?>
			      									<div class="tab-pane active" id="<?php echo $information['information_id']; ?>">
			      										<?php echo html_entity_decode($information['description']); ?>
			      									</div>
						          				<?php } else { ?>
							          				<div class="tab-pane" id="<?php echo $information['information_id']; ?>">
							          					<?php echo html_entity_decode($information['description']); ?>
							          				</div>
							          			<?php } ?>
			      							
						          		<?php } ?>
						 <?php } ?>
          			</div>	
	      		</div>
	      		<div class="clearfix"></div>
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