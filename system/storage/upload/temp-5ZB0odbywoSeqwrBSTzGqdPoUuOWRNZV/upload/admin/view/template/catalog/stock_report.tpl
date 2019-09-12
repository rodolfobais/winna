<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $language; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link href="view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
</head>

<body>
<div class="container" style="margin-top: 10px;">

<?php if (count($products) > 0) { ?>	
<form id="form" action="<?php echo $stock_module_report_xl_link; ?>" method="post">
<input type="hidden" name="stock_module_report_limit" value="<?php echo $stock_module_report_limit; ?>"/>	
</form>
<button id="xl_report_button" class="btn btn-primary pull-right"><i class="fa fa-file-excel-o"> </i><?php echo " ". $button_stock_report_xl; ?></button>
<?php } ?>	


<h1><?php echo $text_stock_available; ?></h1>
<?php if (count($products)  <= 0) {?>
	<table class="table table-bordered">
			<tr><td align="center"><?php echo $text_no_results; ?></td></tr>
	</table>
<?php } else { ?>
	
	<?php foreach ($products as $product) { ?>
			<table class="table table-bordered">
			<tr class="heading">
				<td width="60%"><strong><?php echo $product['product_id'] . " - " . $product['name'] . " - " . $product['model']; ?></strong></td>
				<td width="20%" align="center"><strong><?php echo $text_sku;?></strong></td>  
				<td width="20%" align="center"><strong><?php echo $text_quantity;?></strong></td>  
			</tr>
			<?php foreach ($product['combinations'] as $combination) { ?>
				<tr>
					<td width="60%">
						<?php 
						$combination_name = implode('-', $combination['option_value_names']); 
						echo $combination_name; 
						?>
					</td>
					<td width="20%" align="center"><?php echo $combination['sku'];?></td>  
					<td width="20%" align="center"><?php echo $combination['quantity'];?></td>  
				</tr>
			<?php } ?>
			</table>
	<?php } ?>
	
<?php } ?>
<script type="text/javascript">
	$('#xl_report_button').click(function() {
		$('#form').submit();
	});
</script>

</body>
</html>