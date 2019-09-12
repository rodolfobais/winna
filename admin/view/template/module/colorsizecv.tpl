<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-colrosize" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-colrosize">
          <table class="table table-striped table-bordered table-hover">
			<tr>
				<td><label class="col-sm-6 control-label"><span title="" data-toggle="tooltip" data-original-title="This option Must be Dropdownlist(select) Option">Add Color Option Id:</span></label></td>
				<td><input class="form-control" type="text" name="colorsizecustomvariation[color_option_id]" value="<?php if(isset($modules['color_option_id'])){echo $modules['color_option_id'];}?>" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span title="" data-toggle="tooltip" data-original-title="This option Must be Radiobutton(radio) Option">Add Size Option Id:</span></label></td>
				<td><input type="text" class="form-control" name="colorsizecustomvariation[size_option_id]" value="<?php if(isset($modules['size_option_id'])){echo $modules['size_option_id'];}?>" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span title="" data-toggle="tooltip" data-original-title="That will be visible into Front End">Color Text:</span></label></td>
				<td><input type="text" name="colorsizecustomvariation[color_text]" value="<?php if(isset($modules['color_text'])){echo $modules['color_text'];}?>" class="form-control" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span title="" data-toggle="tooltip" data-original-title="That will be visisble into Front End">Size Text:</span></label></td>
				<td><input type="text" name="colorsizecustomvariation[size_text]" value="<?php if(isset($modules['size_text'])){echo $modules['size_text'];}?>" class="form-control" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span title="" data-toggle="tooltip" data-original-title="If disable then dropdownlist show default style">Design Color Dropdownlist?:</span></label></td>
				<td><select class="form-control" name="colorsizecustomvariation[enable_select]">
                  <?php if ($modules['enable_select']) { ?>
                  <option value="1" selected="selected">Enable</option>
                  <option value="0">Disable</option>
                  <?php } else { ?>
                  <option value="1">Enable</option>
                  <option value="0" selected="selected">Disable</option>
                  <?php } ?>
                </select></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span data-toggle="tooltip" data-original-title="If disable then Radiobutton show default style">Design Size Radiobutton?:</span></label></td>
				<td><select class="form-control" name="colorsizecustomvariation[enable_radio]">
                  <?php if ($modules['enable_radio']) { ?>
                  <option value="1" selected="selected">Enable</option>
                  <option value="0">Disable</option>
                  <?php } else { ?>
                  <option value="1">Enable</option>
                  <option value="0" selected="selected">Disable</option>
                  <?php } ?>
                </select></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label">Color Image Select Border Color:</label></td>
				<td><input class="form-control color" type="text" name="colorsizecustomvariation[color_border_color]" value="<?php if(isset($modules['color_border_color'])){echo $modules['color_border_color'];}?>" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label">Color Image Size:</label></td>
				<td><input type="text" name="colorsizecustomvariation[image_size]" value="<?php if(isset($modules['image_size'])){echo $modules['image_size'];}?>" class="form-control" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span data-toggle="tooltip" data-original-title="This color for unselect stat">Size Select Background Color(unselect):</span></label></td>
				<td><input type="text" class="form-control color" name="colorsizecustomvariation[sizeusbg]" value="<?php if(isset($modules['sizeusbg'])){echo $modules['sizeusbg'];}?>" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label"><span data-toggle="tooltip" data-original-title="This color for select state">Size Select Background Color(select):</span></label></td>
				<td><input type="text" class="form-control color" name="colorsizecustomvariation[sizesbg]" value="<?php if(isset($modules['sizesbg'])){echo $modules['sizesbg'];}?>" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label">Size Select Text Color(unselect):</label></td>
				<td><input type="text" class="form-control color" name="colorsizecustomvariation[sizetextcolor]" value="<?php if(isset($modules['sizetextcolor'])){echo $modules['sizetextcolor'];}?>" /></td>
			</tr>
			<tr>
				<td><label class="col-sm-6 control-label">Size Select Text Color(select):</label></td>
				<td><input type="text" class="form-control color" name="colorsizecustomvariation[sizetextselectcolor]" value="<?php if(isset($modules['sizetextselectcolor'])){echo $modules['sizetextselectcolor'];}?>" /></td>
			</tr>
            
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/sizecolor/jscolor.js"></script>
<?php echo $footer; ?>