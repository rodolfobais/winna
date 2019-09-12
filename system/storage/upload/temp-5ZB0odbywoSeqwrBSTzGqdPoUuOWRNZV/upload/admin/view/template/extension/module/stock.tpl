<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">

  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-account" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        </div>
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
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
    <?php } ?>
    <?php if ($error_attention) { ?>
    <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_attention; ?><a class="update-db" style="float: right;" href="#"><?php echo $text_fix; ?></a></div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3></div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-stock" class="form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-settings" data-toggle="tab"><?php echo $tab_settings; ?></a></li>
                    <li><a href="#tab-theme" data-toggle="tab"><?php echo $tab_theme; ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-settings">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-9">
			      	<select name="stock_module_enabled" id="input-status" class="form-control">
			        	<option value="1" <?php echo ($stock_module_enabled == 1 ? "selected='selected'" : "")?>><?php echo $text_enabled ?></option>
			          <option value="0" <?php echo ($stock_module_enabled == 0 ? "selected='selected'" : "")?>><?php echo $text_disabled ?></option>
			        </select>
            </div>
          </div>
          <div class="form-group required">
                            <label class="col-sm-3 control-label" for="input-limit"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_limit_help ?>"><?php echo $entry_limit; ?></span></label>
            <div class="col-sm-9">
            	<input id="input-limit" class="form-control" type="text" size="2" name="stock_module_report_limit" value="<?php echo $stock_module_report_limit; ?>"/> 
            </div>
          </div>
          <div class="form-group">
						<label class="col-sm-3 control-label" for="input-show-cart-quantities"><?php echo $entry_show_cart_quantities; ?></label>
            <div class="col-sm-9">
			      	<select name="stock_module_show_cart_quantities" id="input-show-cart-quantities" class="form-control">
			        	<option value="1" <?php echo ($stock_module_show_cart_quantities == 1 ? "selected='selected'" : "")?>><?php echo $text_yes ?></option>
			          <option value="0" <?php echo ($stock_module_show_cart_quantities == 0 ? "selected='selected'" : "")?>><?php echo $text_no ?></option>
			        </select>
            </div>
          </div>
          <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-check-cart-quantities"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_check_cart_quantities_help ?>"><?php echo $entry_check_cart_quantities; ?></span></label>
            <div class="col-sm-9">
			      	<select name="stock_module_check_cart_quantities" id="input-check-cart-quantities" class="form-control">
								<option value="0" <?php echo ($stock_module_check_cart_quantities == 0 ? "selected='selected'" : "")?>><?php echo $text_no ?></option>
			        	<option value="1" <?php echo ($stock_module_check_cart_quantities == 1 ? "selected='selected'" : "")?>><?php echo $text_yes ?></option>
			        </select>
            </div>
          </div>
          <div class="form-group">
			<label class="col-sm-3 control-label" for="product-color-flag"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_colorize_product_help ?>"><?php echo $entry_colorize_product; ?></span></label>
            <div class="col-sm-9">
			      	<select id="product-color-flag" name="stock_module_change_product_css" class="form-control">
								<option value="0" <?php echo ($stock_module_change_product_css == 0 ? "selected='selected'" : "")?>><?php echo $text_no ?></option>
			        	<option value="1" <?php echo ($stock_module_change_product_css == 1 ? "selected='selected'" : "")?>><?php echo $text_yes ?></option>
			        </select>
            </div>
          </div>
          <div class="form-group">
          	<label class="col-sm-3 control-label" for="product-colors"></label>
          	<div class="col-sm-9">
							<div id="product-colors" style="display: <?php echo ($stock_module_change_product_css ? 'block' : 'none'); ?>">
									<em><?php echo $text_colorize_tip; ?></em><br/>
				        	<input readonly="readonly" class="color {valueElement:'pci'}" size="1"/>&nbsp;<input id="pci" type="text" size="4" name="stock_module_product_color_instock" value="<?php echo $stock_module_product_color_instock;?>"/>&nbsp;<?php echo $text_colorize_instock; ?><br/>
				        	<input readonly="readonly" class="color {valueElement:'pco'}" size="1"/>&nbsp;<input id="pco" type="text" size="4" name="stock_module_product_color_outofstock" value="<?php echo $stock_module_product_color_outofstock;?>"/>&nbsp;<?php echo $text_colorize_outofstock; ?>
		        	</div>
	        	</div>
					</div>
          <div class="form-group">
                            <label class="col-sm-3 control-label" for="radio-select"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_update_stock_display_help ?>"><?php echo $entry_update_stock_display; ?></span></label>
            <div class="col-sm-9">
			      	<select id="radio-select" name="stock_module_update_stock_display" class="form-control">
								<option value="0" <?php echo ($stock_module_update_stock_display == 0 ? "selected='selected'" : "")?>><?php echo $text_no ?></option>
			        	<option value="1" <?php echo ($stock_module_update_stock_display == 1 ? "selected='selected'" : "")?>><?php echo $text_yes ?></option>
			        </select>
            </div>
          </div>
          <div class="form-group">
          		<label class="col-sm-3 control-label" for="stock-colors"></label>
          		<div class="col-sm-4">
	 							<div id="stock-colors" style="display: <?php echo ($stock_module_update_stock_display ? 'block' : 'none'); ?>">
				      		<em><?php echo $text_colorize_tip; ?></em><br/>
				        	<input readonly="readonly" class="color {valueElement:'cci'}" size="1"/>&nbsp;<input id="cci" type="text" size="4" name="stock_module_combination_color_instock" value="<?php echo $stock_module_combination_color_instock;?>"/>&nbsp;<?php echo $text_combination_instock; ?><br/>
				        	<input readonly="readonly" class="color {valueElement:'cco'}" size="1"/>&nbsp;<input id="cco" type="text" size="4" name="stock_module_combination_color_outofstock" value="<?php echo $stock_module_combination_color_outofstock;?>"/>&nbsp;<?php echo $text_combination_outofstock; ?>
				        </div>			      
							</div>
							<div class="col-sm-5">
								<div id="radios" style="display: <?php echo ($stock_module_update_stock_display ? 'block' : 'none'); ?>">
                                    <strong><?php echo $entry_update_stock_display_behaviour; ?></strong><br/>
									<input type="radio" name="stock_module_update_stock_display_behaviour" value="0" <?php echo ($stock_module_update_stock_display_behaviour == 0 ? "checked='checked'" : "")?>><?php echo $entry_behavior_default;?><br/>
			        		<input type="radio" name="stock_module_update_stock_display_behaviour" value="1" <?php echo ($stock_module_update_stock_display_behaviour == 1 ? "checked='checked'" : "")?>><?php echo $entry_behavior_quantities;?>
			        	</div>
			        </div>
					</div>
                        <div class="form-group">
                          <div style="padding: 0px 13px;">
                              <button id="check_button" data-loading-text="<?php echo $text_validating; ?>" data-original-title="<?php echo $text_validate;?>" class="btn btn-primary"><?php echo $text_validate;?></button>
                              <i style="padding-left:5px;"><?php echo $text_validate_info; ?></i>
                              <div id="check_messages" style="width:100%; margin-top: 5px;"></div>
                          </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-theme">       
                        <div class="form-group">
                        	<div style="padding: 0px 13px;">
	                        	<div class="alert alert-info">
	                        		<i class="fa fa-info-circle"> </i>
	                        		<?php echo $text_theme_customization_warning; ?>
	                        		<button data-dismiss="alert" class="close" type="button">&times;</button>
	                        	</div>
	                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-replace_expression"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_replace_xpath_help ?>"><?php echo $text_replace_xpath; ?></span></label>
                            <div class="col-sm-9">
                                <input id="input-replace_expression" class="form-control" type="text" name="stock_module_replace_expression" value="<?php echo $stock_module_replace_expression; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-decorate-expression"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_decorate_html_help ?>"><?php echo $text_decorate_html; ?></span></label>
                            <div class="col-sm-9">
                                <input id="input-decorate-expression" class="form-control" type="text" name="stock_module_decorate_expression" value="<?php echo $stock_module_decorate_expression; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-remove_expression"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_remove_jquery_help ?>"><?php echo $text_remove_jquery; ?></span></label>
                            <div class="col-sm-9">
                                <input id="input-remove_expression" class="form-control" type="text" name="stock_module_remove_expression" value="<?php echo $stock_module_remove_expression; ?>"/> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-stock_expression"><span title="" data-toggle="tooltip" data-original-title="<?php echo $text_stock_html_help ?>"><?php echo $text_stock_html; ?></span></label>
                            <div class="col-sm-9">
                                <input id="input-stock_expression" class="form-control" type="text" name="stock_module_stock_expression" value="<?php echo $stock_module_stock_expression; ?>"/> 
                            </div>
                        </div>
                    </div>   
                </div>     
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">

	$('#radio-select').change(function() {
		var selected = $(this).val();
		if (selected === "0") {
			$('#radios').hide();
			$('#stock-colors').hide();
		} else {
			$('#radios').show();
			$('#stock-colors').show();
		}
	});
	$('#product-color-flag').change(function() {
		var selected = $(this).val();
		if (selected === "0") {
			$('#product-colors').hide();
		} else {
			$('#product-colors').show();
		}
	});
	
	var moduleRoute = '<?php echo STOCK_MODULE_ROUTE;?>';
	
	$('.update-db').bind('click', function() {
		$.ajax({
			url: 'index.php?route=' + moduleRoute + '/updatedb',
			type: 'GET',
			data: 'token=<?php echo $token;?>',
			dataType: 'json',
			beforeSend: function() {
				$('.update-db').html('<?php echo $text_fixing?>');
			},
			success: function(data) {
				$('.alert, .alert-success, .alert-warning').remove();
				if (data['success']) {
					$('.breadcrumb').after('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' + data['success'] + '<button data-dismiss="alert" class="close" type="button">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				$('.alert, .alert-success, .alert-warning').remove();
				$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText + '<button data-dismiss="alert" class="close" type="button">&times;</button></div>');
			}
		});
		return false;
	});
	
	$('#check_button').bind('click', function() {
		$.ajax({
			url: 'index.php?route=' + moduleRoute + '/check',
			type: 'GET',
			data: 'token=<?php echo $token;?>',
			dataType: 'json',
			beforeSend: function() {
				$('#check_messages').html('');
				$('#check_button').button('loading');
			},
			success: function(data) {
				$('#check_button').button('reset');
				if (data['error']) {
					$('#check_messages').append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + data['error'] + '<button data-dismiss="alert" class="close" type="button">&times;</button></div>');
				} else {
					$('#check_messages').append('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + data['success'] + '<button data-dismiss="alert" class="close" type="button">&times;</button></div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				$('#check_button').button('reset');
				$('#check_messages').append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText + '<button data-dismiss="alert" class="close" type="button">&times;</button></div>');
			}
		});
		return false;
	});
</script></div>
<?php echo $footer; ?>