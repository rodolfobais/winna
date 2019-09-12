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
            <div class="row contact_page" style="min-height:600px;">
                <div class="col-sm-6 info_title">
                    <?php echo $description; ?>
                </div>
                <div class="col-sm-6 info_text">
                	<?php echo $content_top; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
            
          </div>    
      </div>
  </div>
</div>
<?php echo $footer; ?>