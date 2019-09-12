<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
      
    
    <div class="<?php echo $class; ?>">
 	      <div class="container">
	      	<div class="row info_content stockists lookbook" style="min-height:600px;">
	      		<div class="col-sm-2 info_title">
	      			<h1><?php echo $heading_title; ?></h1>
	      				<ul class="nav nav-tabs tabs-left">
				        	<?php foreach ($informations as $information) { ?>
								<?php if ($information['information_id'] == "22" || $information['information_id'] == "23" || $information['information_id'] == "24" || $information['information_id'] == "25" || $information['information_id'] == "27" || $information['information_id'] == "28" || $information['information_id'] == "29") { ?>
							    	<?php if ($information['information_id'] == "27") { ?>
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
	      		<div class="col-sm-10 info_text">
	      			<div class="tab-content">
			            <?php foreach ($informations as $information) { ?>
						          		<?php if ($information['information_id'] == "22" || $information['information_id'] == "23" || $information['information_id'] == "24" || $information['information_id'] == "25" || $information['information_id'] == "27" || $information['information_id'] == "28" || $information['information_id'] == "29") { ?>
			      							
			      								<?php if ($information['information_id'] == "27") { ?>
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