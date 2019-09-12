<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
   	  <div class="pull-right">
	     
	  </div>

      <div class="pull-right" style="margin-right:2px;">
	      <form style="" action="<?php echo $stock_report; ?>" method="post" target="_blank" id="form-report"><?php echo $text_stock_report_limit; ?>
	    	<input class="form-control" style="width:50px;display:inline;text-align:right;" name="stock_module_report_limit" type="text" size="2" value="<?php echo $stock_report_limit;?>"/>
	        <button style="margin-top:-3px;" type="submit" form="form-report" formaction="<?php echo $stock_report; ?>" data-toggle="tooltip" data-original-title="<?php echo $button_stock_report; ?>" class="btn btn-primary"><i class="fa fa-bar-chart"></i></button>
	        <a style="margin-top:-3px;" href="<?php echo $stock_combinations; ?>" data-original-title="<?php echo $button_stock_combinations;?>" data-toggle="tooltip" type="button" class="btn btn-primary">
	         <i class="fa fa-table"></i>
	     	</a>
	      </form>
	  </div>
			
			
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $column_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $column_name; ?>" id="input-name" class="form-control" />
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" for="input-model"><?php echo $column_model; ?></label>
                <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $column_model; ?>" id="input-model" class="form-control" />
              </div>
            	<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>

          </div>
        </div>
				<div class="table-responsive">
		      <table class="table table-bordered table-hover">
		        <thead>
		          <tr>
		            <td class="text-center"><?php echo $column_image; ?></td>
		            <td class="text-left"><?php if ($sort == 'pd.name') { ?>
		              <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
		              <?php } else { ?>
		              <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
		              <?php } ?></td>
		            <td class="text-left"><?php if ($sort == 'p.model') { ?>
		              <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
		              <?php } else { ?>
		              <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
		              <?php } ?></td>
		            <td class="text-right"><?php if ($sort == 'p.quantity') { ?>
		            	<a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
		            <?php } else { ?>
		              <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
		            <?php } ?></td>
		            <td class="text-right"><?php echo $column_status; ?></td>
		            <td class="text-right"><?php echo $column_action; ?></td>
		          </tr>
		        </thead>
		        <tbody>
		          <?php if ($products) { ?>
		          <?php foreach ($products as $product) { ?>
		          <tr>
		            <td class="text-center"><?php if ($product['image']) { ?>
		              <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" />
		              <?php } else { ?>
		              <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
		              <?php } ?></td>
		            <td class="text-left"><?php echo $product['name']; ?></td>
		            <td class="text-left"><?php echo $product['model']; ?></td>
		            <td class="text-right"><?php if ($product['quantity'] <= 0) { ?>
		              <span class="label label-warning"><?php echo $product['quantity']; ?></span>
		              <?php } elseif ($product['quantity'] <= 5) { ?>
		              <span class="label label-danger"><?php echo $product['quantity']; ?></span>
		              <?php } else { ?>
		              <span class="label label-success"><?php echo $product['quantity']; ?></span>
		              <?php } ?></td>
		            <td class="text-right"><?php echo $product['status']; ?></td>
		            <td class="text-right"><a href="<?php echo $product['action']; ?>" data-toggle="tooltip" title="<?php echo $button_edit?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
		          </tr>
		          <?php } ?>
		          <?php } else { ?>
		          <tr>
		            <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
		          </tr>
		          <?php } ?>
		        </tbody>
		      </table>
		    </div>
		    <div class="row">
		      <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
		      <div class="col-sm-6 text-right"><?php echo $results; ?></div>
		    </div>
		  </div>
  	</div>
  </div>

<script type="text/javascript">
	$('#report_button').click(function() {
		var value = $('input[name="stock_module_report_limit"]').val();
		var isNumber = $.isNumeric(value);
		if (!isNumber) {
			alert('<?php echo $error_stock_limit_not_numeric;?>');
		} else if (value < 0) {
			alert('<?php echo $error_stock_limit_not_numeric;?>');
		} else {
			$('#form').submit();
		}
	});
</script>

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/stock&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_model = $('input[name=\'filter_model\']').val();
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
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
//--></script></div>
<?php echo $footer; ?>