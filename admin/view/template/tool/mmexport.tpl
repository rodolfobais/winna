<?php echo $header; ?>
<style>
.loadspinner{
	width: 100%;
    height: 100%;
    position: fixed;
    z-index: 9999;
    background: rgba(48, 51, 51, 0.38);
	 display:none; 
	top:0;
	left:0;
}
.sloadspinner{
	z-index:9999;
	position: fixed;
    left: 50%;
    top: 50%;
    transform: translateX(-50%) translateY(-50%);
    	
}
.spinfaicon{
	font-size:100px !important;
	color:rgba(255, 165, 1, 0.49);
	background-image: url("<?php echo $loadingimg ?>");
	background-repeat:no-repeat;
	height: 200px;
    width: 200px;
	background-size: 200px 200px;
	opacity:0.6;
	
}

</style>
<div class="loadspinner"><div class="sloadspinner"><i class="fa spinfaicon" style=""></i></div></div>
<?php echo $column_left; ?> 

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      
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
         <h3 class="panel-title"><i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
       
		
		  <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-export" data-toggle="tab"><i class="fa fa-upload" aria-hidden="true"></i> <?php echo $tab_export; ?></a></li>
            <li><a href="#tab-import" data-toggle="tab"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $tab_import; ?></a></li>
            <li><a href="#tab-support" data-toggle="tab"><i class="fa fa-headphones" aria-hidden="true"></i> <?php echo $tab_support; ?></a></li>
        <!--    <li><a href="#tab-howtouse" data-toggle="tab"><?php echo $tab_howtouse; ?></a></li> -->
            
          </ul>
		
       <div class="tab-content">
        <div class="tab-pane active" id="tab-export">
        <form action="<?php echo $exportlink ?>" method="post" enctype="multipart/form-data" id="form-productexport" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-language"><?php echo $entry_language; ?></label>
            <div class="col-sm-4">
			 <select name="filter_language_id" id="input-language" class="form-control">			 
				<?php foreach ($languages as $language) { ?>
						<option value="<?php echo $language['language_id']; ?>"><?php echo $language['name']; ?></option>
				<?php } ?>                   
            </select>			
            </div>
        
            <label class="col-sm-2 control-label" for="input-stock-status"><?php echo $entry_stock_status; ?></label>
            <div class="col-sm-4">
			 <select name="filter_stock_status_id" id="input-stock-status" class="form-control">
				 <option value=""><?php echo $text_allstock ?></option>			 
                <?php foreach ($stock_statuses as $stock_status) { ?>                   
                    <option value="<?php echo $stock_status['stock_status_id']; ?>" ><?php echo $stock_status['name']; ?></option> 
                <?php } ?>
            </select>		
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-store"><?php echo $entry_store; ?></label>
            <div class="col-sm-4">
			 <select name="filter_store_id" id="input-store" class="form-control">
				 <option value=""><?php echo $text_allstore ?></option>			 
				 <option value="0"><?php echo $text_default; ?></option>			 
                 <?php foreach ($stores as $store) { ?>					
                    <option value="<?php echo $store['store_id']; ?>" ><?php echo $store['name']; ?></option> 
                <?php } ?>
            </select>		
            </div>
         
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-4">
			 <select name="filter_status" id="input-status" class="form-control">
				 <option value=""><?php echo $text_allstatus ?></option>			 
				 <option value="1"><?php echo $text_enabled; ?></option>               			
                 <option value="0" ><?php echo $text_disabled; ?></option> 
               
            </select>		
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="" data-original-title="(Autocomplete)"><?php echo $entry_product; ?></span></label>
            <div class="col-sm-4">
			 <input type="text" name="product" id="input-product" value="" placeholder="<?php echo $entry_product; ?>" class="form-control">   
				
			<div id="export-product" class="well well-sm" style="height: 135px; overflow: auto;">			
            </div>
            </div>
         
            <label class="col-sm-2 control-label" for="input-model"><span data-toggle="tooltip" title="" data-original-title="(Autocomplete)"><?php echo $entry_model; ?></span></label>
            <div class="col-sm-4">
			 <input type="text" name="model" id="input-model" value="" placeholder="<?php echo $entry_model; ?>" class="form-control">      			 
			 <input type="hidden" name="filter_model" value="" />     	
            </div>
                    
          </div> 
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-manufacturer"><span data-toggle="tooltip" title="" data-original-title="(Autocomplete)"><?php echo $entry_manufacturer; ?></span></label>
            <div class="col-sm-4">
				<input type="text" name="manufacturer" id="input-manufacturer" value="" placeholder="<?php echo $entry_manufacturer; ?>" class="form-control">   
					
				<div id="export-manufacturer" class="well well-sm" style="height: 135px; overflow: auto;">			
				</div>
            </div>
			
			<label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="" data-original-title="(Autocomplete)"><?php echo $entry_category; ?></span></label>
            <div class="col-sm-4">
				<input type="text" name="category" id="input-category" value="" placeholder="<?php echo $entry_category; ?>" class="form-control">   
					
				<div id="export-category" class="well well-sm" style="height: 135px; overflow: auto;">			
				</div>
            </div>
           
          </div>
		 
          <div class="form-group">	
		  
            <label class="col-sm-2 control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
            <div class="col-sm-2">
				<input type="text" name="filter_quantity_start" id="input-quantitys" value="" placeholder="<?php echo $text_from; ?>" class="form-control">
			</div>
			<div class="col-sm-2">		
				<input type="text" name="filter_quantity_limit" id="input-quantityl" value="" placeholder="<?php echo $text_to; ?>" class="form-control">	
            </div>
			
			
			
            <label class="col-sm-2 control-label" for="input-price"><?php echo $entry_price; ?></label>
            <div class="col-sm-2">
				<input type="text" name="filter_price_start" id="input-price" value="" placeholder="<?php echo $text_from; ?>" class="form-control">
			</div>
			<div class="col-sm-2">		
				<input type="text" name="filter_price_limit" id="input-price" value="" placeholder="<?php echo $text_to; ?>" class="form-control">	
            </div>
			
           
          </div>
		  
		<div class="form-group">	
		  
            <label class="col-sm-2 control-label" for="input-product_bulkdata"><span data-toggle="tooltip" title="" data-original-title="(If You have large data that troubles server, export limited products using this Feature)"><?php echo $entry_product_start; ?></span></label>
            <div class="col-sm-2">
			<b><?php echo $text_start; ?>	</b>
				<input type="text" name="filter_product_start" id="input-product_start" value="" placeholder="<?php echo $text_start; ?>" class="form-control">
			</div>
			<div class="col-sm-2">	
				<b><?php echo $text_noofproduct; ?>	</b>		
				<input type="text" name="filter_product_limit" id="input-product_limit" value="<?php echo $Total_products; ?>" placeholder="<?php echo $text_noofproduct; ?>" class="form-control">	
            </div>
			
			
            <label class="col-sm-2 control-label" for="input-product_ids"><?php echo $entry_product_id; ?></label>
            <div class="col-sm-2">
				<input type="text" name="filter_product_ids" id="input-product_ids" value="" placeholder="<?php echo $text_from; ?>" class="form-control">
			</div>
			<div class="col-sm-2">		
				<input type="text" name="filter_product_idl" id="input-product_idl" value="" placeholder="<?php echo $text_to; ?>" class="form-control">	
            </div>
			
        </div>
		
		    <div class="form-group">	
		  
            <label class="col-sm-2 control-label" for="input-pimages"><?php echo $entry_pimages; ?></label>
            <div class="col-sm-4">
				<select name="filter_image" id="input-filter_image" class="form-control">
					<option value="1"><?php echo $text_yes ?></option>
					<option value="0" ><?php echo $text_no ?></option>
				</select>
			</div>
			
            <label class="col-sm-2 control-label" for="input-imgfullurl"><span data-toggle="tooltip" title="" data-original-title="(Export Images with full Url?)"><?php echo $entry_imgfullurl; ?></span></label>
            <div class="col-sm-4">
				<select name="imgfullurl" id="input-imgfullurl" class="form-control">
					<option value="1"><?php echo $text_yes ?></option>
					<option value="0" ><?php echo $text_no ?></option>
				</select>
			</div>
			
			
            </div>
			
		    <div class="form-group">	
		  
            <label class="col-sm-2 control-label" for="input-review"><span data-toggle="tooltip" title="" data-original-title="Export Product Reviews.?"><?php echo $entry_review; ?></span></label>
            <div class="col-sm-4">
				<select name="filter_review" id="input-review" class="form-control">
					<option value="1"><?php echo $text_yes ?></option>
					<option value="0" ><?php echo $text_no ?></option>
				</select>
			</div>
            </div>
			
		    <div class="form-group">	
		  
            <label class="col-sm-2 control-label" for="input-review"><?php echo $entry_extrafld; ?></label>
            <div class="col-sm-4">
				<?php  if(!empty($allcustom_columns)){ ?>
				<?php foreach($allcustom_columns as $customcolumn){ ?>			
				
				<div class="checkbox">
					<label><input name="custom_columns[]" type="checkbox" value="<?php echo $customcolumn; ?>"> <?php echo $customcolumn; ?></label>
				</div>
					
				<?php } ?> 
				<?php } ?> 
			</div>
					
            <label class="col-sm-2 control-label" for="input-format"><?php echo $entry_format; ?></label>
            <div class="col-sm-4">				
					
				<select name="file_format" class="form-control" id="input-format">
				
					<option value="xls"><?php echo $text_xls; ?></option>														
					<option value="xlsx"><?php echo $text_xlsx; ?></option>														
					<option value="csv"><?php echo $text_csv; ?></option>														
				<!-- 	<option value="xml"><?php echo $text_xml; ?></option> 	-->													
				</select>				
				
			</div>
						
            </div>
					  
          <div class="form-group pull-right">
            
            <div class="col-sm-12">
				<button id="exportbutton" type="button" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> <?php echo $button_export ?></button>
            </div>
          </div>
		  </form>
		</div>
		
		
		<div class="tab-pane" id="tab-import">
		 <?php  echo $importsss; ?>
		</div>
		
		<div class="tab-pane" id="tab-support">
			<h2> Free Support:</h2>
			<h2>support@modulemarket.in</h2>
		</div>
		
		<div class="tab-pane" id="tab-howtouse">
			<h1> How to use Import Export Tool</h1>
		</div>
		
		
	  </div>
       
        
        
      </div>
    </div>
  </div>
</div>



<script>
$("#exportbutton").click(function() {		
	
//	$("#form-productexport").submit();
	$(".loadspinner").show();

     $.ajax({
            type: "POST",
            url: '<?php echo $exportlink ?>',
            data: $('#form-productexport input[type=\'text\'], #form-productexport input[type=\'hidden\'], #form-productexport select, #form-productexport input[type=\'checkbox\']:checked, #form-productexport input[type=\'radio\']:checked'),
		    beforeSend: function() {
			
		$("#form-productexport").submit();			
		},
		complete: function() {
			jQuery(".loadspinner").delay(500).fadeOut("slow");
		},
		success: function(data)
		{
		 
			
	    }
		});
		 

});
</script>

  <script type="text/javascript">
$('input[name=\'model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
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
		$('input[name=\'model\']').val(item['label']);
		$('input[name=\'filter_model\']').val(item['label']);
	}
});

// Product
$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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
	select: function(item) {
		$('input[name=\'product\']').val('');
		
		$('#export-product' + item['value']).remove();
		
		$('#export-product').append('<div id="export-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_product[]" value="' + item['value'] + '" /></div>');	
	}
});
$('#export-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>
 <script type="text/javascript"><!--
$('input[name=\'manufacturer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['manufacturer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'manufacturer\']').val('');

		$('#export-manufacturer' + item['value']).remove();

		$('#export-manufacturer').append('<div id="export-manufacturer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_manufacturer[]" value="' + item['value'] + '" /></div>');
	}
});

$('#export-manufacturer').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>

 <script type="text/javascript"><!--
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');

		$('#export-category' + item['value']).remove();

		$('#export-category').append('<div id="export-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_category[]" value="' + item['value'] + '" /></div>');
	}
});

$('#export-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
<?php echo $footer; ?>