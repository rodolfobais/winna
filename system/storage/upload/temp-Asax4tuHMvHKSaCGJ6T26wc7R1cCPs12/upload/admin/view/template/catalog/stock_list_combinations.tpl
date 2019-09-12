<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
	<style type = "text/css" scoped>
    	.product-row {
    		background-color: #1e91cf; color: #fff; font-weight: bold;	
    	}
    	.browse-icon {
    		border: 1px solid #1978ab; border-radius: 3px; padding:1px 5px; margin: 0px 3px; color:#fff;	
    	}
    	.save-icon {
			border: 1px solid #d6bfa9; border-radius: 3px; background-color:#ffa54d; display:none; padding:0px 5px; color:#fff; margin-right: 5px;
    	}
    	.cancel-icon {
    		border: 1px solid #d6bfa9; border-radius: 3px; background-color:#ffa54d; display:none; padding:0px 4px; color:#fff; margin-right: 5px;
    	}
    	.edit-icon {
    		padding:0px 5px; color:#fff;
    	}
    	.load-icon {
    		color:#fff; font-size: 14px;
    	}
    	.combinations-td {
    		padding: 5px; /*10px;*/
    	}
    	.combinations-table > thead > tr {
    		background-color: #e2f2f9 !important;
    	}

    	.combinations-table {
    		/*border:0px; padding:0px; margin:0px;*/
    		margin-bottom: 0px;
    	}
    	.combinations-table td {
    		/*padding:4px !important;*/
    	}
    	.combinations-table input[type="text"] {
    		/*border: 1px solid #ddd;
    		padding: 1px 2px;
    		margin: 2px 2px;*/
    		padding: 0px 13px;
    		width: 70%;
    		display: inline-block;
    		height:26px;
    	}
    	.ibold { font-weight: bold;}
    	.right {
    		text-align: right;	
    	}
    	.text-error { color: #ff0000; }
    	.text-warning { color: #ff7f00; }
    	.text-success { color: #00cc00; }
    	.save-success {
    		background-color: #00cc00;
    		border: 1px solid #00cc00;
    	}
    	.alert-small {
    		/*margin-bottom: 10px;
    		padding: 5px 10px;	*/
    	}
    </style>

  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_combinations_title; ?></h1>
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
    <?php if ($attention) { ?>
    <div class="alert alert-warning"><i class="fa fa fa-warning"></i> <?php echo $attention; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_combinations_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
			<div class="col-sm-4">
			  <div class="form-group">
			    <label class="control-label" for="input-name"><?php echo $column_name; ?></label>
			    <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $column_name; ?>" id="input-name" class="form-control" />
			  </div>
              <div class="form-group">
                <label class="control-label" for="input-option-value"><?php echo $column_option_value; ?></label>
                <input type="text" name="filter_option" value="<?php echo $filter_option; ?>" placeholder="<?php echo $column_option_value; ?>" id="input-option-value" class="form-control" />
              </div>
			</div>
			<div class="col-sm-4">
			  <div class="form-group">
			    <label class="control-label" for="input-model"><?php echo $column_product_model; ?></label>
			    <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $column_product_model; ?>" id="input-model" class="form-control" />
			  </div>
			  <div class="form-group">
			    <label class="control-label" for="input-comb-quantity"><?php echo $column_comb_quantity ?> (&le;)</label>
			    <input type="text" name="filter_comb_quantity" value="<?php echo $filter_comb_quantity; ?>" placeholder="<?php echo $column_comb_quantity; ?>" id="input-comb-quantity" class="form-control" />
              </div>
			</div>
			<div class="col-sm-4">
			  <div class="form-group">
			    <label class="control-label" for="input-quantity"><?php echo $column_product_quantity ?> (&le;)</label>
			    <input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" placeholder="<?php echo $column_product_quantity; ?>" id="input-quantity" class="form-control" />
			  </div>
			  <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
			</div>
          </div>
        </div>
      </div>
      <div >
	      <table class="table table-bordered">
	        <thead>
	          <tr>
	            <td width="35%" class="text-left"><?php if ($sort == 'pd.name') { ?>
	              <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
	              <?php } else { ?>
	              <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
	              <?php } ?></td>
	            <td width="35%" class="text-left"><?php if ($sort == 'p.model') { ?>
	              <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
	              <?php } else { ?>
	              <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
	              <?php } ?></td>
	            <td width="15%" class="text-left"><?php if ($sort == 'p.quantity') { ?>
	              <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
	              <?php } else { ?>
	              <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
	              <?php } ?></td>
	            <td width="15%" class="text-right"><?php echo $column_action; ?></td>
	          </tr>
	        </thead>
	        <tbody>
	          <?php if ( !empty($products) ) { ?>
	          	
	          <?php foreach ($products as $product) { ?>
	          <tr id="product-<?php echo $product['product_id'];?>" class="product-row">
	            <td class="text-left">
	            	<a class="browse-icon" href="#" data-original-title="<?php echo $button_collapse; ?>" data-toggle="tooltip"><i class="ibold fa fa-angle-down"></i></a>
	            	<?php echo $product['name']; ?>
	            </td>
	            <td class="text-left"><?php echo $product['model']; ?></td>
	            <td class="text-center"><?php echo $product['quantity']; ?></td>
	            <td class="text-right" nowrap>
	            	<i style="display:none;" class="fa fa-spinner"></i>
	            	<a class="cancel-icon" href="#" data-original-title="<?php echo $button_cancel; ?>" data-toggle="tooltip"><i class="fa fa-reply"></i></a>
	            	<a class="save-icon" href="#" data-original-title="<?php echo $button_save; ?>" data-toggle="tooltip"><i class="fa fa-save"></i></a>
	            	<a class="edit-icon" href="#" data-original-title="<?php echo $button_edit; ?>" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
	            </td>
	          </tr>
	          <?php $combinations = $product['combinations']; ?>
	          <tr id="product-<?php echo $product['product_id'];?>-combinations"><td colspan="4" class="text-left combinations-td">
	          	<table class="combinations-table table table-striped table-bordered">
	          	<thead>
	          	    <?php $options = $product['options']; ?>
	          		<tr>
	          		  <td style="display:none"><input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>"/></td>
	          		  <td width="70%" class="left"><?php echo implode(' / ', $options); ?></td>
	          		  <td width="15%" class="text-left"><?php echo $column_quantity; ?></td>
	          		  <td width="15%" class="text-left"><?php echo $column_sku; ?></td>
	          		</tr>
	          	</thead>
	          	<tbody>
				<?php $row = 0; foreach ($combinations as $combination) { ?>
	        		<tr id="<?php echo $combination['combination_id']; ?>">
	        			<td style="display:none"><input type="hidden" name='<?php echo "product_combinations[$row][combination_id]";?>' value="<?php echo $combination['combination_id'];?>"/></td>
		        	    <td class="left"><?php echo implode(' - ', $combination['option_value_names']); ?></td>
						<td class="text-left">
						   <?php $class = ""; /*($combination['quantity'] <= 0) ? 'text-error' : ($combination['quantity'] <= 5 ? 'text-warning' : 'text-success');*/ ?>
						   <span class="text-field <?php echo $class;?>"><?php echo $combination['quantity'];?></span>
						   <input style="display:none;" class="right input-field form-control" type="text" name='<?php echo "product_combinations[$row][quantity]";?>' value="<?php echo $combination['quantity'];?>"/>
						</td>  
						<td class="text-left">
		        		   <span class="text-field"><?php echo $combination['sku'];?></span>
		        		   <input style="display:none;" class="right input-field form-control" type="text" name='<?php echo "product_combinations[$row][sku]";?>' value="<?php echo $combination['sku'];?>"/>
		        		</td>  						
					</tr>
	        	<?php $row++; } ?>
	        	</tbody>
	        	</table>
	          </td></tr>
	          <?php } // foreach ?>
	          <?php } else { ?>
	          <tr>
	            <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
	          </tr>
	          <?php } ?>
	        </tbody>
	      </table>
	  </div> <!-- table-responsive -->
	  <div class="row">
	    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
		<div class="col-sm-6 text-right"><?php echo $results; ?></div>
	  </div>
	</div> <!-- panel -->
  </div>   <!-- container-fluid -->
</div>     <!-- content -->

<script type="text/javascript">
  function showError(e, error) {
  	e.before('<div class="alert alert-danger alert-small"><i class="fa fa-exclamation-circle"></i> ' + 
  	error + 
  	'<button data-dismiss="alert" class="close" type="button">&times;</button></div>');
  }
  
  function combinationsFromIcon(icon) {
  	var tr = icon.closest('tr');
  	var combsId = tr.attr('id') + '-combinations';
	return $('#' + combsId);
  }

  function switchFields(combinations, showText, copyValues) {
    var textFields = combinations.find('.text-field');
    var inputFields = combinations.find('.input-field');
    
    if (showText) {
    	if (copyValues) {
    		inputFields.each(function(index) {
    			var value = $(this).val();
    			$(this).prev().html(value);
    		});
    	}
    	
    	textFields.show();
    	inputFields.hide();	
    } else {
    	if (copyValues) {
    		textFields.each(function(index) {
    			var value = $(this).html();
    			$(this).next().val(value);
    		});
    	}
    	
    	textFields.hide();
    	inputFields.show();	
    }
  }
  
  //$('.text-field, .input-field').show();

  $('.browse-icon').click(function(e) {
  	e.preventDefault();
  	var icon = $(this);
  	icon.blur();
  	var i = icon.find('i:first');
  	
	var expanded = i.hasClass('fa-angle-down');
	if (expanded) {
  		icon.attr('data-original-title', '<?php echo $button_expand; ?>');
  		combinationsFromIcon(icon).hide();
  	} else {
  		icon.attr('data-original-title', '<?php echo $button_collapse; ?>');
  		combinationsFromIcon(icon).show();
  	}
	
	i.toggleClass('fa-angle-down');
	i.toggleClass('fa-angle-right');

  	return false;
  });
  
  $('.cancel-icon').click(function(e) {
  	e.preventDefault();
  	
  	var icon = $(this);
  	icon.blur();
  	icon.hide();
  	
  	$('.alert').hide();
  	$('.text-error').hide();
  	icon.parent().find('.save-icon').hide();
  	icon.parent().find('.edit-icon').removeClass('open');
	
  	var combs = combinationsFromIcon(icon);
  	
  	switchFields(combs, true, false); // show text and hide edit (don't copy values)
  	return false;
  });
  
  $('.edit-icon').click(function(e) {
  	e.preventDefault();
  	var icon = $(this);
  	icon.blur();
  	if (icon.hasClass('open')) {
  		return false;	
  	}
  	
  	var saveIcon = icon.parent().find('.save-icon');
  	saveIcon.removeClass('save-success');
  	saveIcon.stop().animate({'opacity': '100'});
  	saveIcon.show();
  	
  	icon.parent().find('.cancel-icon').show();
  	
  	var combs = combinationsFromIcon(icon);
  	
  	switchFields(combs, false, true); // show edit and hide text. copy values from text to edit fields
  	
  	icon.addClass('open');
  	
  	return false;
  });
  
  $('.save-icon').click(function(e) {
  	e.preventDefault();
  	var icon = $(this);
  	icon.blur();
  	
  	var loadingIcon = icon.parent().find('i:first');
  	var combs = combinationsFromIcon(icon);
 	
  	$.ajax({
		url: 'index.php?route=catalog/stock/update_combinations&token=<?php echo $token; ?>',
		dataType: 'json',
		data: combs.find('input'),
		type: 'post',
		beforeSend: function() {
			loadingIcon.toggleClass("fa-spin"); // start spinning loading icon
			loadingIcon.show();
		},
		complete: function() {
			loadingIcon.hide();
			loadingIcon.toggleClass("fa-spin");		// remove loading icon
		},
		success: function(json) {
			combs.find('.text-error').remove(); // remove red asterisks beside text fields if any
			combs.find('.alert').remove();		// remove error message if any
			if (json['error']) { 
				showError(combs.find('table'), json['error']); // add error message
				
				// loop to display asterisks beside the correct field
				if (json['error_quantity']) {
					var inputs = combs.find('table input[name*="quantity"]');
					inputs.each( function(index) {
						var exists = $.inArray(index, json['error_quantity']) != -1;
						if (exists) {
							$(this).after('<span class="text-error">***</span>');
						}
					});
				}
			} else {
				switchFields(combs, true, true); // show text and hide edit. copy values from edit to text fields
				icon.parent().find('.cancel-icon').hide();
				icon.parent().find('.edit-icon').removeClass('open');
  				icon.toggleClass('save-success');
  				icon.fadeOut(1500, function() {icon.toggleClass('save-success');} );
  				var quantity = icon.parent().prev()
  				quantity.html(json['product_quantity']);
  			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			combs.find('.alert').remove();
			var error = 'Unexpected error (tr): ' + thrownError + " Status:" + xhr.statusText + " Response:" + xhr.responseText;
			showError(combs.find('table'), error);
		}
	});
  	
  	return false;
  });
</script>

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/stock/combinations&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_model = $('input[name=\'filter_model\']').val();
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}

	var filter_quantity = $('input[name=\'filter_quantity\']').val();
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}

	var filter_comb_quantity = $('input[name=\'filter_comb_quantity\']').val();
	if (filter_comb_quantity) {
		url += '&filter_comb_quantity=' + encodeURIComponent(filter_comb_quantity);
	}
	
	var filter_option = $('input[name=\'filter_option\']').val();
	if (filter_option) {
		url += '&filter_option=' + encodeURIComponent(filter_option);
	}

	location = url;
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/stock/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/stock/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['model'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});

$('input[name=\'filter_option\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/stock/autocomplete_options&token=<?php echo $token; ?>&filter_option=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['name']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_option\']').val(item['label']);
	}
});
//--></script></div>
<?php echo $footer; ?>