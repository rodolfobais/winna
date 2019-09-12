<style>
.toggle.btn{
	width:80px !important;
}
.hceckstyle{
	    background: rgba(243, 135, 51, 0.77) !important;
	height: 25px !important;
	width:25px !important;
	border: 2px solid #1e91cf !important;
	border-radius: 8px !important;
}
.hceckstyle::after{
	top:0px !important;
	left:-2px !important;
}
.hceckstyle:checked{
	background:rgba(91, 192, 222, 0.58) !important;
	border: 2px solid rgba(243, 135, 51, 0.77) !important;
}
.checkbox-inline{
	font-weight:bold
}
</style>
        <form action="<?php echo $importlink ?>" method="post" enctype="multipart/form-data" id="form-productexport" class="form-horizontal">
       
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-language"><?php echo $entry_language; ?></label>
            <div class="col-sm-4">
			 <select name="filter_language_id" id="input-language" class="form-control">			 
				<?php foreach ($languages as $language) { ?>
						<option value="<?php echo $language['language_id']; ?>"><?php echo $language['name']; ?></option>
				<?php } ?>                   
            </select>			
            </div>
        
            <label class="col-sm-2 control-label" for="input-reviews"><span data-toggle="tooltip" title="" data-original-title="(Export product reviews [ Yes / No ])"><?php echo $entry_review; ?></span></label>
            <div class="col-sm-4">
			 <select name="filter_reviews" id="input-reviews" class="form-control">
			 
					<option value="0"><?php echo $text_no ?></option>                            
                    <option value="1" ><?php echo $text_yes; ?></option> 
               
            </select>		
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-images"><?php echo $entry_image; ?></label>
            <div class="col-sm-4">
			 <select name="filter_images" id="input-images" class="form-control">			 
					<option value="0"><?php echo $text_no ?></option>                            
					<option value="1" ><?php echo $text_yes; ?></option>           
            </select>			
            </div>
        
            <label class="col-sm-2 control-label" for="input-custcolumn"><span data-toggle="tooltip" title="" data-original-title="(Custom added Columns From Product table)"><?php echo $entry_custcolumn; ?></span></label>
            <div class="col-sm-4">
			 <select name="filter_custcolumn" id="input-custcolumn" class="form-control">
			 
					<option value="0"><?php echo $text_no ?></option>                            
                    <option value="1" ><?php echo $text_yes; ?></option> 
               
            </select>		
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-store"><span data-toggle="tooltip" title="" data-original-title="(Select atleast one store, you can also select no. of Stores)"><?php echo $entry_store; ?></span></label>
            <div class="col-sm-4">	
			
				<div class="checkbox">
					<label> <input name="filter_store[]" type="checkbox" value="0" checked ><?php echo $text_default; ?></label>
				</div>
				
				<?php foreach ($stores as $store) { ?>
				<div class="checkbox">
                    <label><input name="filter_store[]" type="checkbox" value="<?php echo $store['store_id']; ?>" ><?php echo $store['name']; ?> </label>
                </div>  
                <?php } ?>
            </div>
			
			 <label class="col-sm-2 control-label" for="input-importby"><?php echo $entry_importby; ?></label>
            <div class="col-sm-4">
			 <select name="filter_importby" id="input-importby" class="form-control">
			 
					<option value="product_id"><?php echo $text_pro_id ?></option>                            
                    <option value="model" ><?php echo $text_model; ?></option> 
               
            </select>		
            </div>
         
            
          </div>
		  
         
			
		    <div class="form-group">
			
				<label class="col-sm-2 control-label" for="input-productfile"><?php echo $entry_productfile; ?></label>
				<div class="col-sm-4">						
					<input type="file" name="productfile" id="input-productfile" class="form-control">
				</div>						
            </div>
			         
        
		  <div class="col-sm-12"><label>Choose fields</label>
		  
          <div class="form-group">
            <button type="button" class="btn btn-info" onclick="$(this).parent().find('input[type=checkbox]').prop('checked', true);"><?php echo $button_selectall ?></button>
			
			<button type="button" class="btn btn-warning" onclick="$(this).parent().find('input[type=checkbox]').prop('checked', false);"><?php echo $button_deselectall ?></button>
			
		            
			<div class="col-sm-12" style="padding:10px;">
			<div class="row">
				
			<div class="col-sm-2">
				<label class="checkbox-inline">
					<input name="checkfield[product_name]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;">
					Product Name </span>
				</label> 
			</div>
			<div class="col-sm-2">
				<label class="checkbox-inline">
					<input name="checkfield[model]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Model</span>
				</label>	
			</div>
			<div class="col-sm-2">			
				<label class="checkbox-inline">
					<input name="checkfield[status]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Status</span>
				</label>
			</div>		
			<div class="col-sm-2">
				<label class="checkbox-inline">
					<input name="checkfield[store]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Store</span>
				</label>
			</div>		
			<div class="col-sm-2">				
				<label class="checkbox-inline">
					<input name="checkfield[sku]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> SKU</span>
				</label>
			</div>		
			<div class="col-sm-2">
				<label class="checkbox-inline">
					<input name="checkfield[upc]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> UPC</span>
				</label>
			</div>		
			<div class="col-sm-2">
				<label class="checkbox-inline">
					<input name="checkfield[ean]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> EAN</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[jan]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> JAN</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[isbn]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> ISBN</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[mpn]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> MPN</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[location]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Location</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[manufacturer_id]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Manufacturer Id</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[reward_points]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Reward Points</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[date_available]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Date Available</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[description]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Description</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[meta_tag]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Meta Tag</span>
				</label>
			</div>		
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[meta_title]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Meta Title</span>
				</label>
			</div>	
			<div class="col-sm-2">	
				<label class="checkbox-inline">
					<input name="checkfield[meta_description]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Meta Description</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[meta_keyword]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Meta Keyword</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[product_image]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Product Image</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				
				<label class="checkbox-inline">
					<input name="checkfield[price]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Price</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[minimum]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Minimum</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[quantity]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Quantity</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[sort_orer]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Sort Order</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[tax_class_id]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Tax Class Id</span>
				</label>
			</div>	
			<div class="col-sm-2">				
				<label class="checkbox-inline">
					<input name="checkfield[subtract]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Subtract</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[stock_status_id]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Stock Status Id</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[shipping]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Shipping</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[seo_keyword]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> keyword</span>
				</label>
			</div>	
			<div class="col-sm-2">			
				<label class="checkbox-inline">
					<input name="checkfield[length]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Length</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[length_class_id]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Length Class Id</span>
				</label>
			</div>	
			<div class="col-sm-2">				
				<label class="checkbox-inline">
					<input name="checkfield[width]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Width</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[height]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Height</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[weight]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Weight</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[weight_class_id]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Weight Class Id</span>
				</label>
			</div>	
			<div class="col-sm-2">				
				<label class="checkbox-inline">
					<input name="checkfield[category_ids]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Category Ids</span>
				</label>
			</div>	
			<div class="col-sm-2">				
				<label class="checkbox-inline">
					<input name="checkfield[filter_names]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Filter Names</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[download]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Download Names</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[related_products]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Related Product</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[attribute_names]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Attribute Names</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[options]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Options</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[discount_offers]" type="checkbox" class="hceckstyle" value="1" checked> <span style="position:relative; bottom:9px;"> Discount Offer</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[special]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Special Offer</span>
				</label>
			</div>	
			<div class="col-sm-2">				
				<label class="checkbox-inline">
					<input name="checkfield[reward]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Reward Data</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[viewed]" type="checkbox" value="1" class="hceckstyle" checked> <span style="position:relative; bottom:9px;"> Viewed</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[date_added]" type="checkbox" class="hceckstyle" value="1" checked> <span style="position:relative; bottom:9px;"> Date Added</span>
				</label>
			</div>	
			<div class="col-sm-2">		
				<label class="checkbox-inline">
					<input name="checkfield[date_modified]" type="checkbox" class="hceckstyle" value="1" checked> <span style="position:relative; bottom:9px;"> Date Modified</span>
				</label>
			</div>	
					
				
            </div>
            </div>
			
			
						
          
          </div>
          </div>
		  
          <div class="form-group pull-right">
            
            <div class="col-sm-12">
				<button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $button_import ?></button>
            </div>
          </div>
       
        
        </form>
 