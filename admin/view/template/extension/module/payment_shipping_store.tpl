<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
		<button onclick="$('.stay').val(1);" type="submit" form="form-payment_shipping_store" data-toggle="tooltip" title="<?php echo $button_save; ?> & stay" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $button_save; ?> & stay </button>
        <button type="submit" form="form-payment_shipping_store" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
	<?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
	  </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-payment_shipping_store" class="form-horizontal">
		<input type="hidden" name="stay" class="stay" value="0"/>
		  <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><i class="fa fa-cogs" aria-hidden="true"></i> <?php echo $tab_general; ?></a></li>
            <li><a href="#tab-payment" data-toggle="tab"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $tab_payment; ?></a></li>
            <li><a href="#tab-shipping" data-toggle="tab"><i class="fa fa-truck" aria-hidden="true"></i> <?php echo $tab_shipping; ?></a></li>
            <li><a href="#tab-support" data-toggle="tab"><i class="fa fa-life-ring" aria-hidden="true"></i> <?php echo $tab_support; ?></a></li>
          </ul>
		  <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status">Module <?php echo $entry_status; ?></label>
				<div class="col-sm-5">
				  <select name="module_payment_shipping_store_status" id="input-status" class="form-control">
					<?php if ($module_payment_shipping_store_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status">Shipping <?php echo $entry_status; ?></label>
				<div class="col-sm-5">
				  <select name="module_payment_shipping_store_shipping_status" id="input-status" class="form-control">
					<?php if ($module_payment_shipping_store_shipping_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status">Payment <?php echo $entry_status; ?></label>
				<div class="col-sm-5">
				  <select name="module_payment_shipping_store_payment_status" id="input-status" class="form-control">
					<?php if ($module_payment_shipping_store_payment_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>
			</div>
			<div class="tab-pane" id="tab-payment">
			   <div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
						  <thead>
							<tr>
							 <td>Store Name</td>
							 <td>Restrict Payment Methods</td>
							</tr>
						  </thead>
						  <?php foreach($allstores as $store): ?>
						  <tr>
							 <td><?php echo $store['name']; ?></td>
							 <td>
							 <div class="well">
								<?php foreach($payments as $payment){ 
									if (isset($module_payment_shipping_store_payments_array[$store['store_id']]) && in_array($payment['code'], $module_payment_shipping_store_payments_array[$store['store_id']])){ ?>
									<div class="checkbox">
									  <label><input checked="checked" type="checkbox" name="module_payment_shipping_store_payments_array[<?php echo $store['store_id'] ?>][]" value="<?php echo $payment['code']; ?>"/> <?php echo $payment['name']; ?></label>
									</div>
								<?php }else{ ?>
									<div class="checkbox">
									  <label><input type="checkbox" name="module_payment_shipping_store_payments_array[<?php echo $store['store_id'] ?>][]" value="<?php echo $payment['code']; ?>"/> <?php echo $payment['name']; ?></label>
									</div>
								<?php } ?>
								<?php } ?>
							 </div>
							 </td>
						  </tr>
						  <?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-shipping">
				<div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
						  <thead>
							<tr>
							 <td>Store Name</td>
							 <td>Restrict Shipping Methods</td>
							</tr>
						  </thead>
						  <?php foreach($allstores as $store): ?>
						  <tr>
							 <td><?php echo $store['name']; ?></td>
							 <td>
							 <div class="well">
								<?php foreach($shippings as $shipping){ 
									if (isset($module_payment_shipping_store_shippings_array[$store['store_id']]) && in_array($shipping['code'], $module_payment_shipping_store_shippings_array[$store['store_id']])){ ?>
									<div class="checkbox">
									  <label><input checked="checked" type="checkbox" name="module_payment_shipping_store_shippings_array[<?php echo $store['store_id'] ?>][]" value="<?php echo $shipping['code']; ?>"/> <?php echo $shipping['name']; ?></label>
									</div>
								<?php }else{ ?>
									<div class="checkbox">
									  <label><input type="checkbox" name="module_payment_shipping_store_shippings_array[<?php echo $store['store_id'] ?>][]" value="<?php echo $shipping['code']; ?>"/> <?php echo $shipping['name']; ?></label>
									</div>
								<?php } ?>
								<?php } ?>
							 </div>
							 </td>
						  </tr>
						  <?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-support">
				<p class="text-center">For Support and Query Feel Free to contact:<br /><strong>extensionsbazaar@gmail.com</strong></p>
			</div>
		   </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>