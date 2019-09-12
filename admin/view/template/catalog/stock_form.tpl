<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-stock" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit . (isset($product_info['name']) ? ': '.$product_info['name'] : ''); ?></h3>
      </div>
      <div class="panel-body">
      <?php $combination_row = 0; ?>
    	<?php if (!empty($product_info)) { ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-stock">
      	<table class="table table-striped table-bordered table-hover">
      		<thead>
      			<tr>
    				<?php foreach ($product_options as $product_option) { ?>
    				<td class="center"><?php echo $product_option['name']; ?></td>
    				<?php } ?>
      				<td class="left"><?php echo $column_store; ?></td>
      				<td class="left"><?php echo $column_quantity; ?></td>
      				<td class="left"><?php echo $column_sku; ?></td>
      				<td><?php echo $column_action; ?></td>
      			</tr>
      		</thead>
      		<tbody id="combinations">
    			<?php if (isset($product_combinations) && count($product_combinations) > 0) { ?>
	      			<?php foreach ($product_combinations as $combination) { ?>
	      			<tr id="combination-row-<?php echo $combination_row; ?>">
	      				<?php foreach ($product_options as $product_option) { ?>
		      				<td class="text-left">
			      				<select class="form-control" name="product_combinations[<?php echo $combination_row; ?>][product_option_values][<?php echo $product_option['product_option_id']; ?>]">
		      					<?php $selected_option = ( isset($combination['product_option_values'][$product_option['product_option_id']]) ? $combination['product_option_values'][$product_option['product_option_id']] : "" ); ?>
		      					<?php foreach ($product_option['product_option_value'] as $option_value) { ?>
		      						<?php if ($option_value['product_option_value_id'] == $selected_option) { ?>
		      							<option selected="selected" value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']?></option>
		      						<?php } else { ?>
		      							<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']?></option>
		      						<?php } ?>
		      					<?php } ?>
			      				</select>
		      				</td>
	      				<?php } ?>
						<td class="text-left" style="width: 180px;">
							<select class="form-control" name="product_combinations[<?php echo $combination_row;?>][store_id]">
								<?php foreach($allstores as $store): ?>
								<option value="<?php echo $store["store_id"]; ?>" <?php if($combination['store_id']==="1") { echo "selected"; } ?>><?php echo $store["name"]; ?></option>
								<?php endforeach; ?>
							</select>
	      				</td>
	      				<td class="text-left">
	      				  	<input class="form-control" style="text-align: right; width:75%; display:inline;" type="text" size="2" value="<?php echo $combination['quantity']; ?>" name="product_combinations[<?php echo $combination_row;?>][quantity]"/>
							<?php if (isset($error_quantity[$combination_row])) {
	      				  		echo "<span style='color:#ff0000;'>***</span>";
	      				  	} ?>	      				  
	      				</td>
	      				<td class="text-left">
	      				  <input class="form-control" style="text-align: right;" type="text" value="<?php echo $combination['sku']; ?>" name="product_combinations[<?php echo $combination_row;?>][sku]"/>
	      				</td>
	      				<td>
	      					<input type="hidden" value="<?php if (isset($combination['combination_id'])) echo $combination['combination_id']?>" name="product_combinations[<?php echo $combination_row;?>][combination_id]"/>
	      					<button class="btn btn-danger" title="" data-toggle="tooltip" onclick="removeCombination('#combination-row-<?php echo $combination_row; ?>');" type="button" data-original-title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button>
	      				</td>
	      			</tr>
	      			<?php $combination_row ++; ?>
	      			<?php } ?>
    			<?php } else { ?>
    				<tr></tr>
    			<?php } ?>
      		</tbody>
      		<tfoot>
						<tr>
							<?php $option_count = 0; if (isset($product_options)) { $option_count = 3 + count($product_options); } ?>
      				<td colspan="<?php echo $option_count; ?>"></td>
      				<td class="text-left">
      					<button type="button" onclick="addCombination();" data-toggle="tooltip" title="<?php echo $button_add_combination; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
      					<button type="button" onclick="addAllCombinations();" data-toggle="tooltip" title="<?php echo $button_add_all_combinations; ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i></button>
      				</td>
						</tr>      		
      		</tfoot>
      	</table>
      </form>
			<?php } else { ?>
				<table class="table table-striped table-bordered table-hover">
					<tfoot><tr><td colspan="3" class="text-center"><?php echo $text_notfound; ?></td></tr></tfoot>
				</table>
			<?php } ?>
    	</div>
  	</div>
	</div>
<script type="text/javascript"><!--		

var combination_row = <?php echo $combination_row; ?>;
var html = '';

function removeCombination(id) {	
	$(id).remove();
	if ( $('#combinations').children().length == 0 ) {
		$('#combinations').append('<tr></tr>');
	}
}

function addCombination() {	
	
	html = '<tr id="combination-row-' + combination_row + '">';
	
	<?php foreach ($product_options as $product_option) { ?>
		html += '	<td class="text-left">';
		html += '	<select class="form-control" name="product_combinations[' + combination_row + '][product_option_values][<?php echo $product_option['product_option_id']; ?>]">';
		<?php foreach ($product_option['product_option_value'] as $option_value) { ?>
			html +=	'		<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo addSlashes($option_value['name']);?></option>';
		<?php } ?>
		html +=	'	</select>';
		html +=	'	</td>';
	<?php } ?>
	html += '	<td class="text-left">';
	html += '	<select class="form-control" name="product_combinations[' + combination_row + '][store_id]">';
		<?php foreach ($allstores as $store) { ?>
			html +=	'		<option value="<?php echo $store['store_id']; ?>"><?php echo addSlashes($store['name']);?></option>';
		<?php } ?>
	html +=	'	</select>';
	html +=	'	</td>';
	html +=	'<td class="text-left"><input class="form-control" style="text-align: right; width:75%; display:inline;" type="text" size="2" value="0" name="product_combinations[' + combination_row + '][quantity]"/></td>';
	html +=	'<td class="text-left"><input class="form-control" style="text-align: right;" type="text" name="product_combinations[' + combination_row + '][sku]"/></td>';
	
	html +=	'<td><input type="hidden" value="" name="combination[' + combination_row + '][combination_id]"/><button class="btn btn-danger" title="" data-toggle="tooltip" onclick="removeCombination(\'#combination-row-' + combination_row + '\');" type="button" data-original-title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button></td>';
	html +=	'</tr>';
	
	$('#combinations').append(html);

	combination_row++;
}

function OptionValue(id, name) {
	this.id = id;
	this.name = name;
}

OptionValue.prototype.getId = function() { return this.id; };
OptionValue.prototype.getName = function() { return this.name; };

function OptionList(optionId, optionValues) {
	this.index = 0;
	this.optionId = optionId;
	this.values = optionValues;
}

OptionList.prototype.getId = function() { return this.optionId; };

OptionList.prototype.getValues = function() { return this.values; };

OptionList.prototype.next = function() { this.index++; };

OptionList.prototype.first = function() { this.index = 0; };

OptionList.prototype.finished = function() { return (this.index == this.values.length - 1); };

OptionList.prototype.value = function() { return this.values[this.index]; };

function Combination(optionLists) { 
	this.lists = optionLists; 
}

Combination.prototype.hasNext = function() {
	var result = false;
	for (var i = 0; i < this.lists.length; i++) {
		var e = this.lists[i];
		if (!e.finished()) {
			result = true;
			break;
		}
	}
	return result;
};

Combination.prototype.next = function() {
	var i = this.lists.length - 1;
	var done = false;
	while (!done && i >= 0) {
		var e = this.lists[i];
		var finished = e.finished();
		
		if (finished) {
			e.first();
		} else {
			e.next();
			done = true;
		}
		i--;
	}
	return this;
};

Combination.prototype.getKey = function() {
	var values = [];
	for (var i = 0; i < this.lists.length; i++) {
		var selected = this.lists[i].value();
		values[i] = selected.getId();
	}
	return values.join('-');
};

Combination.prototype.asHtml = function(rowIndex) {
	
	var html = '<tr id="combination-row-' + rowIndex + '">';

	for (var i = 0; i < this.lists.length; i++) {
		var option = this.lists[i];
		html += '	<td class="text-left">';
		html += '	<select class="form-control" name="product_combinations[' + rowIndex + '][product_option_values][' + option.getId() + ']">';
		var values = option.getValues();
		var selected = option.value();
		for (var j = 0; j < values.length; j++) {
			var v = values[j];
			html +=	'  <option value="' + v.getId() + '"' + (selected.getId() == v.getId() ? ' selected="selected" ' : '') + '>' + v.getName() + '</option>';
		}
		html +=	'	</select>';
		html +=	'	</td>';
	}
	html +=	'<td class="text-left"><input class="form-control" style="text-align: right; width:75%; display:inline;" type="text" size="2" value="0" name="product_combinations[' + rowIndex + '][quantity]"/></td>';
	html +=	'<td class="text-left"><input class="form-control" style="text-align: right;" type="text" name="product_combinations[' + rowIndex + '][sku]"/></td>';
	html +=	'<td><input type="hidden" value="" name="combination[' + rowIndex + '][combination_id]"/><button class="btn btn-danger" title="" data-toggle="tooltip" onclick="removeCombination(\'#combination-row-' + rowIndex + '\');" type="button" data-original-title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i></button></td>';
	html +=	'</tr>';
	return html;
};

Combination.prototype.toString = function() {
	var values = [];
	for (var i = 0; i < this.lists.length; i++) {
		var option = this.lists[i];
		var v = option.value();
		values[i] = option.getId() + ':' + v.getId() + '-' + v.getName();
	}
	return values.toString();
};

function addAllCombinations() {
  // all options and their values as a constant
  var options = [
<?php $option_count = 0; $options = count($product_options);?> 
<?php foreach ($product_options as $product_option) { $option_value_count = 0; $option_values = count($product_option['product_option_value']);?>
	new OptionList(<?php echo $product_option['product_option_id'];?>, [   
	<?php foreach ($product_option['product_option_value'] as $option_value) {?>
	<?php if ($option_value_count == $option_values - 1) {?>
	new OptionValue(<?php echo $option_value['product_option_value_id'];?>, "<?php echo $option_value['name']?>")
	<?php } else {?>
	new OptionValue(<?php echo $option_value['product_option_value_id'];?>, "<?php echo $option_value['name']?>"),
	<?php } ?>
	<?php $option_value_count++; } ?>
  <?php if ($option_count == $options - 1) {?>])<?php } else {?>]),<?php } ?>
  <?php $option_count++;?> 
<?php } ?>
  ];

	// get the values that are currently selected so to not include them again
	var existed = {};
	$("#combinations > tr").each(function () {
		
		var selected = [];
		$(this).find('td select :selected').each(function() {
			selected.push( $(this).val() );
			//console.log('Selected: ' + $(this).val());
		}); 
		var key = selected.join('-');
		existed[key] = key;
		
		//console.log('Row: ' + $(this).html());
		//console.log('Key: ' + key);
	});
  	
  	// generate all available combinations of the option values and add them to the table
  	
  	var combination = new Combination(options);
  	var hasNext = combination.hasNext();
  	if (hasNext) {
		do {
			
			//console.log('Combination: ' + combination.toString());
			var key = combination.getKey();
			if (existed[key]) {
				// ignoring this value because already exists
				//console.log('Key: ' + key + ' already exists. Not adding it...');
			} else {
				//console.log('Added key: ' + key);
				var html = combination.asHtml(combination_row++);
				$('#combinations').append(html);
			}

			hasNext = combination.hasNext();
			if (hasNext) { 
				combination.next();
			};
		} while (hasNext);
  	};	
};
	
//--></script></div> 

<?php echo $footer; ?>