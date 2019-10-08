<?php echo $header; 

$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); 
$page_direction = $theme_options->get( 'page_direction' );
include('catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/wrapper_top.tpl');

$product_detail = $theme_options->getDataProduct( $product_id );
$text_new = 'New';
if($theme_options->get( 'latest_text', $config->get( 'config_language_id' ) ) != '') {
    $text_new = $theme_options->get( 'latest_text', $config->get( 'config_language_id' ) );
} ?>

<div itemscope itemtype="http://schema.org/Product">


<!-- bread-crumb start here -->
<div class="bread-crumb">

	
		
		
			<ul class="list-inline">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
	

</div>
<!-- bread-crumb end here -->


  
  <div class="product-info">
  
  
  
  	<div class="row">
  	     <?php $product_custom_block = $modules_old_opencart->getModules('product_custom_block'); ?>
  		<div class="col-sm-<?php if($theme_options->get( 'custom_block', 'product_page', $config->get( 'config_language_id' ), 'status' ) == 1 || count($product_custom_block)) { echo 9; } else { echo 12; } ?>">
  			<div class="row" id="quickview_product">
			    <?php if($theme_options->get( 'product_image_zoom' ) != 2) { ?>
			    <script>
			    	$(document).ready(function(){
			    	     if($(window).width() > 992) {
     			    		<?php if($theme_options->get( 'product_image_zoom' ) == 1) { ?>
     			    			$('#image').elevateZoom({
     			    				zoomType: "inner",
     			    				cursor: "pointer",
     			    				zoomWindowFadeIn: 500,
     			    				zoomWindowFadeOut: 750
     			    			});
     			    		<?php } else { ?>
     				    		$('#image').elevateZoom({
     								zoomWindowFadeIn: 500,
     								zoomWindowFadeOut: 500,
     								zoomWindowOffetx: 20,
     								zoomWindowOffety: -1,
     								cursor: "pointer",
     								lensFadeIn: 500,
     								lensFadeOut: 500,
     				    		});
     			    		<?php } ?>
     			    		
     			    		var z_index = 0;
     			    		
     			    		$(document).on('click', '.open-popup-image', function () {
     			    		  $('.popup-gallery').magnificPopup('open', z_index);
     			    		  return false;
     			    		});
			    		
     			    		$('.thumbnails a, .thumbnails-carousel a').click(function() {
     			    			var smallImage = $(this).attr('data-image');
     			    			var largeImage = $(this).attr('data-zoom-image');
     			    			var ez =   $('#image').data('elevateZoom');	
     			    			$('#ex1').attr('href', largeImage);  
     			    			ez.swaptheimage(smallImage, largeImage); 
     			    			z_index = $(this).index('.thumbnails a, .thumbnails-carousel a');
     			    			return false;
     			    		});
			    		} else {
			    			$(document).on('click', '.open-popup-image', function () {
			    			  $('.popup-gallery').magnificPopup('open', 0);
			    			  return false;
			    			});
			    		}
			    	});
			    </script>
				
			    <?php } ?>
			    <?php $image_grid = 6; $product_center_grid = 6; 
			    if ($theme_options->get( 'product_image_size' ) == 1) {
			    	$image_grid = 4; $product_center_grid = 8;
			    }
			    
			    if ($theme_options->get( 'product_image_size' ) == 3) {
			    	$image_grid = 8; $product_center_grid = 4;
			    }
			    ?>
			    <div class="col-sm-<?php echo $image_grid; ?> popup-gallery">
			      <?php 
			      $product_image_top = $modules_old_opencart->getModules('product_image_top');
			      if( count($product_image_top) ) { 
			      	foreach ($product_image_top as $module) {
			      		echo $module;
			      	}
			      } ?>
			         
			      <div class="row">
			      	  <?php if (($images || $theme_options->get( 'product_image_zoom' ) != 2) && $theme_options->get( 'position_image_additional' ) == 2) { ?>
			      	  <div class="col-sm-2">
						<div class="thumbnails thumbnails-left clearfix">
							<ul>
							  <?php if($theme_options->get( 'product_image_zoom' ) != 2 && $thumb) { ?>
						      <li><p><a href="<?php echo $popup; ?>" class="popup-image" data-image="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>"><img src="<?php echo $theme_options->productImageThumb($product_id, $config->get($config->get('config_theme') . '_image_additional_width'), $config->get($config->get('config_theme') . '_image_additional_height')); ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></p></li>
							  <?php } ?>
						      <?php foreach ($images as $image) { ?>
						      <li><p><a href="<?php echo $image['popup']; ?>" class="popup-image" data-image="<?php echo $image['popup']; ?>" data-zoom-image="<?php echo $image['popup']; ?>"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></p></li>
						      <?php } ?>
						  </ul>
						</div>
			      	  </div>
			      	  <?php } ?>
			      	  
				      <div class="col-sm-<?php if($theme_options->get( 'position_image_additional' ) == 2) { echo 10; } else { echo 12; } ?>">
				      	<?php if ($thumb) { ?>
					      <div class="product-image <?php if($theme_options->get( 'product_image_zoom' ) != 2) { if($theme_options->get( 'product_image_zoom' ) == 1) { echo 'inner-cloud-zoom'; } else { echo 'cloud-zoom'; } } ?>">
					      	 <?php if($special && $theme_options->get( 'display_text_sale' ) != '0') { ?>
					      	 	<?php $text_sale = 'Sale';
					      	 	if($theme_options->get( 'sale_text', $config->get( 'config_language_id' ) ) != '') {
					      	 		$text_sale = $theme_options->get( 'sale_text', $config->get( 'config_language_id' ) );
					      	 	} ?>
					      	 	<?php if($theme_options->get( 'type_sale' ) == '1') { ?>
					      	 	<?php $product_detail = $theme_options->getDataProduct( $product_id );
					      	 	$roznica_ceny = $product_detail['price']-$product_detail['special'];
					      	 	$procent = ($roznica_ceny*100)/$product_detail['price']; ?>
					      	 	
								
					      	 	<?php } else { ?>
					      	 
					      	 	<?php } ?>
					      	 <?php } ?>
					      	 
					      	 <?php if($product_detail['is_latest'] && $theme_options->get( 'display_text_latest' ) != '0'):?>
					      	     <div class="new-label"><span><?php echo $text_new; ?></span></div>
					      	 <?php endif; ?>
					      	 
					     	 <a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" id="ex1" <?php if($theme_options->get( 'product_image_zoom' ) == 2) { ?>class="popup-image"<?php } else { echo 'class="open-popup-image"'; } ?>><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" itemprop="image" data-zoom-image="<?php echo $popup; ?>" /></a>
					      </div>
						  
						  
						  
					  	 <?php } else { ?>
					  	 <div class="product-image">
					  	 	 <img src="image/no_image.jpg" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" itemprop="image" />
					  	 </div>
					  	 <?php } ?>
				      </div>
				      
				      <?php if (($images || $theme_options->get( 'product_image_zoom' ) != 2) && $theme_options->get( 'position_image_additional' ) != 2) { ?>
				      <div class="col-sm-12">
				           <div class="overflow-thumbnails-carousel">
     					      <div class="thumbnails-carousel owl-carousel">
     					      	<?php if($theme_options->get( 'product_image_zoom' ) != 2 && $thumb) { ?>
     					      	     <div class="item"><a href="<?php echo $popup; ?>" class="popup-image" data-image="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>"><img src="<?php echo $theme_options->productImageThumb($product_id, $config->get($config->get('config_theme') . '_image_additional_width'), $config->get($config->get('config_theme') . '_image_additional_height')); ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
     					      	<?php } ?>
     						     <?php foreach ($images as $image) { ?>
     						         <div class="item"><a href="<?php echo $image['popup']; ?>" class="popup-image" data-image="<?php echo $image['popup']; ?>" data-zoom-image="<?php echo $image['popup']; ?>"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
     						     <?php } ?>
     					      </div>
					      </div>
					      
					      <script type="text/javascript">
					           $(document).ready(function() {
					             $(".thumbnails-carousel").owlCarousel({
					                 autoPlay: 6000, //Set AutoPlay to 3 seconds
					                 navigation: true,
					                 navigationText: ['', ''],
					                 itemsCustom : [
					                   [0, 4],
					                   [450, 5],
					                   [550, 6],
					                   [768, 3],
					                   [1200, 4]
					                 ],
					                 <?php if($page_direction[$config->get( 'config_language_id' )] == 'RTL'): ?>
					                 direction: 'rtl'
					                 <?php endif; ?>
					             });
					           });
					      </script>
				      </div>
				      <?php } ?>
			      </div>
			      
			      <?php 
			      $product_image_bottom = $modules_old_opencart->getModules('product_image_bottom');
			      if( count($product_image_bottom) ) { 
			      	foreach ($product_image_bottom as $module) {
			      		echo $module;
			      	}
			      } ?>
			    </div>

			    <div class="col-sm-<?php echo $product_center_grid; ?> product-center clearfix">
				<div itemprop="offerDetails" itemscope itemtype="http://schema.org/Offer">
					<h2 class="product-name">
						<?php echo $heading_title; ?>
					</h2>
					<?php if ($price) { ?>
						<div class="price">
							<div class="main-price">
								<?php if (!$special) { ?>
									<span class="price-new">
										<span itemprop="price" id="price-old">
										<?php echo $price; ?>
										</span>
									</span>
								<?php } else { ?>
									<span class="price-old" id="price-old"><?php echo $price; ?></span>
									<span class="price-new">
									<span itemprop="price" id="price-special"><?php echo $special; ?></span>
									</span> 
								<?php } ?>
							</div>
								
							<div class="other-price">
								<?php if ($tax) { ?>
									<span class="price-tax"><?php echo $text_tax; ?> <span id="price-tax"><?php echo $tax; ?></span></span><br />
								<?php } ?>
								<?php if ($points) { ?>
									<span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span><br />
								<?php } ?>
								<?php if ($discounts) { ?>
									<br />
									<div class="discount">
										<?php foreach ($discounts as $discount) { ?>
											<?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?><br />
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>					
				<div class="modelo"><?php echo $text_model; ?> <?php echo $model; ?> </div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Description">
								<?php echo $tab_description; ?>
							</a>
						</h4>
					</div>
					<div id="Description" class="panel-collapse collapse in">
						<div class="descrip">
							<span itemprop="description">
								<?php echo $description; ?>
							</span>
						</div>
					</div>
	  			</div>
			      <?php 
			      $product_options_top = $modules_old_opencart->getModules('product_options_top');
			      if( count($product_options_top) ) {
			      	foreach ($product_options_top as $module) {
			      		echo $module;
			      	}
			      } ?>
				</div>			      
				<div class="description">
					<span><?php echo $text_stock; ?></span> <strong <?php if($stock == 'In Stock') { echo 'style="color: #99cc00;"'; } ?>><?php echo $stock; ?></strong></div>
			     
			     <div id="product">
					<?php 
					$product_options_center = $modules_old_opencart->getModules('product_options_center');
					if( count($product_options_center) ) { 
						foreach ($product_options_center as $module) {
							echo $module;
						}
					} ?>
			      	<?php if ($options) { ?>
			      	<div class="options">
			        	<?php foreach ($options as $option) { ?>
			        	<?php if ($option['type'] == 'select') { ?>
			        	<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          		<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
							<select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
								<option value=""><?php echo $text_select; ?></option>
								<?php foreach ($option['product_option_value'] as $option_value) { ?>
								<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
								<?php if ($option_value['price']) { ?>
								(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
								<?php } ?>
								</option>
								<?php } ?>
							</select>
			        	</div>
			        <?php } ?>
			        <?php if ($option['type'] == 'radio') { ?>
			        <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          <label class="control-label"><?php echo $option['name']; ?></label>
			          <div id="input-option<?php echo $option['product_option_id']; ?>">
			            <?php foreach ($option['product_option_value'] as $option_value) { ?>
			            <div class="radio <?php if($theme_options->get( 'product_page_radio_style' ) == 1) { echo 'radio-type-button2'; } ?>">
			              <label>
			                <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
			                <span><?php echo $option_value['name']; ?>
			                <?php if ($option_value['image']) { ?>
			                <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
			                <?php } ?> 
			                <?php if($theme_options->get( 'product_page_radio_style' ) != 1) { ?><?php if ($option_value['price']) { ?>
			                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
			                <?php } ?><?php } ?></span>
			              </label>
			            </div>
			            <?php } ?>
			            
			            <?php if($theme_options->get( 'product_page_radio_style' ) == 1) { ?>
			            <script type="text/javascript">
			                 $(document).ready(function(){
			                      $('#input-option<?php echo $option['product_option_id']; ?>').on('click', 'span', function () {
			                           $('#input-option<?php echo $option['product_option_id']; ?> span').removeClass("active");
			                           $(this).addClass("active");
			                      });
			                 });
			            </script>
			            <?php } ?>
			          </div>
			        </div>
			        <?php } ?>
			        <?php if ($option['type'] == 'checkbox') { ?>
			        <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          <label class="control-label"><?php echo $option['name']; ?></label>
			          <div id="input-option<?php echo $option['product_option_id']; ?>">
			            <?php foreach ($option['product_option_value'] as $option_value) { ?>
			            <div class="checkbox <?php if($theme_options->get( 'product_page_checkbox_style' ) == 1) { echo 'radio-type-button2'; } ?>">
			              <label>
			                <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
			                <span><?php echo $option_value['name']; ?>
			                <?php if($theme_options->get( 'product_page_checkbox_style' ) != 1) { ?><?php if ($option_value['price']) { ?>
			                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
			                <?php } ?><?php } ?></span>
			              </label>
			            </div>
			            <?php } ?>
			            
			            <?php if($theme_options->get( 'product_page_checkbox_style' ) == 1) { ?>
			            <script type="text/javascript">
			                 $(document).ready(function(){
			                      $('#input-option<?php echo $option['product_option_id']; ?>').on('click', 'span', function () {
			                           if($(this).hasClass("active") == true) {
			                                $(this).removeClass("active");
			                           } else {
			                                $(this).addClass("active");
			                           }
			                      });
			                 });
			            </script>
			            <?php } ?>
			          </div>
			        </div>
			        <?php } ?>
			        <?php if ($option['type'] == 'image') { ?>
			        <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          <label class="control-label"><?php echo $option['name']; ?></label>
			          <div id="input-option<?php echo $option['product_option_id']; ?>">
			            <?php foreach ($option['product_option_value'] as $option_value) { ?>
			            <div class="radio <?php if($theme_options->get( 'product_page_radio_style' ) == 1) { echo 'radio-type-button'; } ?>">
			              <label>
			                <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
			                <span <?php if($theme_options->get( 'product_page_radio_style' ) == 1) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo $option_value['name']; ?> <?php if ($option_value['price']) { ?>(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)<?php } ?>"<?php } ?>><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" <?php if($theme_options->get( 'product_page_radio_style' ) == 1) { ?>width="<?php if($theme_options->get( 'product_page_radio_image_width' ) > 0) { echo $theme_options->get( 'product_page_radio_image_width' ); } else { echo 25; } ?>px" height="<?php if($theme_options->get( 'product_page_radio_image_height' ) > 0) { echo $theme_options->get( 'product_page_radio_image_height' ); } else { echo 25; } ?>px"<?php } ?> /> <?php if($theme_options->get( 'product_page_radio_style' ) != 1) { ?><?php echo $option_value['name']; ?>
			                <?php if ($option_value['price']) { ?>
			                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
			                <?php } ?><?php } ?></span>
			              </label>
			            </div>
			            <?php } ?>
			            <?php if($theme_options->get( 'product_page_radio_style' ) == 1) { ?>
			            <script type="text/javascript">
			                 $(document).ready(function(){
			                      $('#input-option<?php echo $option['product_option_id']; ?>').on('click', 'span', function () {
			                           $('#input-option<?php echo $option['product_option_id']; ?> span').removeClass("active");
			                           $(this).addClass("active");
			                      });
			                 });
			            </script>
			            <?php } ?>
			          </div>
					  
			        </div>
			        <?php } ?>
			        <?php if ($option['type'] == 'text') { ?>
			        <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
			          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
			        </div>
			        <?php } ?>
			        <?php if ($option['type'] == 'textarea') { ?>
			        <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
			          <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
			        </div>
			        <?php } ?>
			        <?php if ($option['type'] == 'file') { ?>
			        <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			          <label class="control-label"><?php echo $option['name']; ?></label>
			          <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" class="btn btn-default btn-block" style="margin-top: 7px"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
			          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
			        </div>
			        <?php } ?>
			       	<?php if ($option['type'] == 'date') { ?>
			       	<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			       	  <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
			       	  <div class="input-group date">
			       	    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
			       	    <span class="input-group-btn">
			       	    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
			       	    </span></div>
			       	</div>
			       	<?php } ?>
			       	<?php if ($option['type'] == 'datetime') { ?>
			       	<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			       	  <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
			       	  <div class="input-group datetime">
			       	    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
			       	    <span class="input-group-btn">
			       	    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
			       	    </span></div>
			       	</div>
			       	<?php } ?>
			       	<?php if ($option['type'] == 'time') { ?>
			       	<div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
			       	  <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
			       	  <div class="input-group time">
			       	    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
			       	    <span class="input-group-btn">
			       	    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
			       	    </span></div>
			       	</div>
			       	<?php } ?>
			        <?php } ?>
			      </div>
			      <?php } ?>
			      

			<!-- Ci Size Chart Starts -->
            <?php if(!empty($sizecharts)) { ?>
            <div class="sizechart-buttons">
            <?php foreach($sizecharts as $sizechart) { ?>
            <?php if($sizechart['display_layout'] == 'popup') { ?>
            <?php if($sizechart['popup_type'] == 'icon') { ?>
            <div class="sizechart-button"><a href="<?php echo $sizechart['popup_href']; ?>"><img src="<?php echo $sizechart['icon']; ?>" /></a></div>
            <?php } else { ?>
            <div class="sizechart-button"><a href="<?php echo $sizechart['popup_href']; ?>" class="btn btn-primary btn-sm button"><?php echo $sizechart['button']; ?></a></div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <br>
            </div>
            <?php } ?>
            <!-- Ci Size Chart Ends -->
			
			      <?php if ($recurrings) { ?>
			      <div class="options">
			          <h2><?php echo $text_payment_recurring ?></h2>
			          <div class="form-group required">
			            <select name="recurring_id" class="form-control">
			              <option value=""><?php echo $text_select; ?></option>
			              <?php foreach ($recurrings as $recurring) { ?>
			              <option value="<?php echo $recurring['recurring_id'] ?>"><?php echo $recurring['name'] ?></option>
			              <?php } ?>
			            </select>
			            <div class="help-block" id="recurring-description"></div>
			          </div>
			      </div>
			      <?php } ?>
			      
			      <div class="cart">
			        <div class="add-to-cart clearfix">
			          <?php 
			          $product_enquiry = $modules_old_opencart->getModules('product_enquiry');
			          if( count($product_enquiry) ) { 
			          	foreach ($product_enquiry as $module) {
			          		echo $module;
			          	}
			          } else { ?>
     			          <div class="quantity">
     				          <input type="text" name="quantity" id="quantity_wanted" size="2" value="<?php echo $minimum; ?>" />
     				          <a href="#" id="q_up"><i aria-hidden="true" class="icon_plus"></i></a>
     				          <a href="#" id="q_down"><i aria-hidden="true" class="icon_minus-06"></i></a>
     			          </div>
     			          <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
     			          <input type="button" value="<?php echo $button_cart; ?>" id="button-cart" rel="<?php echo $product_id; ?>" data-loading-text="<?php echo $text_loading; ?>" class="carrito" />
     			          
     			          <?php 
     			          $product_question = $modules_old_opencart->getModules('product_question');
     			          if( count($product_question) ) { 
     			          	foreach ($product_question as $module) {
     			          		echo $module;
     			          	}
     			          } ?>
			          <?php } ?>
			        
			        
					<div class="wishlinks">
			        	<a onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="icon-heart icons"></i></a>
			        	
			        </div></div>
					
		
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#informacion_de_envio">
						INFORMACIÓN DE ENVÍO
						</a>
					</h4>
				</div>
			
				<div id="informacion_de_envio" class="panel-collapse collapse">
					<div class="panel-body">
						ENTREGA EN DOMICILIO:<br/>
						CABA - GBA: $000<br/>
						INTERIOR DEL PAÍS: $000 <br/><br/>

						ENTREGA EN SUCURSAL OCA:<br/>

						PODRÁS RECIBIR TU PEDIDO EN LA SUCURSAL DE OCA MAS CERCANA A TU DOMICILIO.<br/><br/>

						CABA-GBA: $000<br/>
						INTERIOR DEL PAÍS: $000<br/><br/>

						CONSULTÁ LAS SUCURSALES AQUÍ<br/>
						ACTUALMENTE NO CONTAMOS CON ENVÍOS FUERA DE ARGENTINA. SUSCRIBITE A NUESTRO NEWSLETTER PARA ENTERARTE CUANDO COMENCEMOS A REALIZAR ENVÍOS AL EXTERIOR. TODOS NUESTROS ENVÍOS DENTRO DE ARGENTINA LOS REALIZAMOS A TRAVÉS DE OCA, CON UNA DEMORA DE ENTRE 48 A 96 HORAS HÁBILES DESPUÉS DE HABER REALIZADO EL PEDIDO Y CONFIRMADO EL PAGO.<br/><br/>

						ENTREGAS:<br/>
						LAS ENTREGAS DE PEDIDOS A DOMICILIO SE REALIZAN DE LUNES A VIERNES DE 9 A 18HS. LOS PEDIDOS ENVIADOS A SUCURSAL OCA SE ENTREGAN DE LUNES A VIERNES DE 9 A 18HS Y SÁBADOS DE 9 A 13 HS. NO SE ENTREGAN PEDIDOS DOMINGOS NI FERIADOS.<br/>
						LA ENTREGA PUEDE SER RECIBIDA POR CUALQUIER PERSONA MAYOR DE 18 AÑOS QUE SE ENCUENTRE EN TU DOMICILIO, PRESENTANDO SU DNI. SI NO TE ENCONTRÁS EN TU DOMICILIO PARA RECIBIR LA ENTREGA DE TU PAQUETE, EL TRANSPORTISTA DARÁ AVISO VÍA ONLINE CARGANDO TODO LO SUCEDIDO EN EL SEGUIMIENTO Y SE REALIZARÁ UN SEGUNDO INTENTO DE VISITA EL SIGUIENTE DÍA HÁBIL. ES POR ESO QUE EL CLIENTE DEBE REALIZAR EL SEGUIMIENTO ONLINE DEL PAQUETE PARA ESTAR INFORMADO DEL MISMO.<br/>
						SI TANTO EN EL 1ER COMO EN EL 2DO INTENTO NO SE COMPLETA LA ENTREGA, EL PAQUETE VOLVERÁ A LA SUCURSAL OCA, Y SE MANTENDRÁ ALLÍ DURANTE 7 DÍAS PARA QUE PUEDAS RETIRARLO. SI NO ES RETIRADO, EL PEDIDO SERÁ DEVUELTO A NUESTRAS OFICINAS Y TE CONTACTAREMOS PARA COORDINAR UNA NUEVA ENTREGA ABONANDO UN NUEVO COSTO DE ENVÍO. DE NO REALIZARSE EL PAGO PARA EL NUEVO ENVÍO DENTRO DE LOS 90 DÍAS SIGUIENTES, WINNA LOVE SE RESERVA EL DERECHO DE ANULAR EL PEDIDO.<br/>
						DURANTE EL PERÍODO DE HOT SALE TODOS LOS ENVÍOS POR OCA PUEDEN CONTAR CON UNA DEMORA DE HASTA 15 DÍAS POR LA ALTA DEMANDA.<br/><br/>

						ATENCIÓN AL CLIENTE: <br/>
						EL HORARIO DE ATENCIÓN AL CLIENTE Y RECEPCIÓN DE PEDIDOS DE LA TIENDA ES DE 10 A 17HS DE LUNES A VIERNES. SI CONFIRMASTE TU PEDIDO FUERA DE ESTE HORARIO SERÁ PROCESADO AL SIGUIENTE DÍA HÁBIL. LO MISMO PARA AQUELLOS QUE SE REALICEN LOS SÁBADOS, DOMINGOS Y FERIADOS. TENÉ EN CUENTA QUE CADA PEDIDO SOLO PUEDE SER ENTREGADO EN UN SOLO LUGAR Y, UNA VEZ DESPACHADO, EL PEDIDO NO PODRÁ SER REDIRECCIONADO.<br/><br/>

						SEGUIMIENTO:<br/>
						PODÉS CHEQUEAR DENTRO DE TU CUENTA LA SECCIÓN MIS PEDIDOS PARA CONOCER EL ESTADO DE TU COMPRA.<br/>
						EL NÚMERO DE GUÍA QUE TE ENVIAMOS POR MAIL TE PERMITIRÁ REALIZAR EL SEGUIMIENTO ONLINE DE TU PEDIDO UNA VEZ QUE EL MISMO FUE DESPACHADO. PODRÁS HACERLO A TRAVÉS DE WWW1.OCA.COM<br/><br/>

						SI TU PEDIDO SE RETRASA:<br/>
						ENVIANOS UN MAIL A INFO@WINNALOVE.COM CON EL NÚMERO DE PEDIDO PARA QUE PODAMOS SOLUCIONARLO.<br/>						
						<?php echo $details; ?>
					</div>
				</div>				
	  		</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#formas_de_pago">FORMAS DE PAGO</a>
					</h4>
				</div>
			
				<div id="formas_de_pago" class="panel-collapse collapse">
					<div class="panel-body">
						PODRÁS ABONAR TUS COMPRAS EN NUESTRO SITIO CON MERCADO PAGO - TARJETAS DE CRÉDITO: VISA, MASTERCARD, AMERICAN EXPRESS, TARJETA NARANJA, ARGENCARD, TARJETA SHOPPING, NATIVA, CENCOSUD Y CABAL. <br/><br/>

						MERCADO PAGO -CUPON DE PAGO: PARA ABONAR EN SUCURSALES DE RAPIPAGO, PAGOFÁCIL, LINK Y PROVINCIA NET. ABONANDO MEDIANTE EL SERVICIO DE MERCADOPAGO CONTAS CON 5 DÍAS HÁBILES PARA REALIZAR EL PAGO DE TU PEDIDO. CUMPLIDO ESE PLAZO TU COMPRA SERÁ CANCELADA Y LOS PRODUCTOS NO SERÁN ENVIADOS.GARANTIZAMOS UN NIVEL DE SEGURIDAD PARA TODAS LAS COMPRAS UTILIZANDO LA TECNOLOGÍA SPS QUE GARANTIZA UNA TRANSACCIÓN 100% SEGURA.<br/><br/>

						NO ALMACENAREMOS NINGÚN DATO DE TU TARJETA EN NUESTRO SITIO.
					</div>
				</div>				
	  		</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#cambios_y_devoluciones">CAMBIOS Y DEVOLUCIONES</a>
					</h4>
				</div>
			
				<div id="cambios_y_devoluciones" class="panel-collapse collapse">
					<div class="panel-body">
						CAMBIOS:<br/><br/>
						TODOS LOS PRODUCTOS TIENEN CAMBIO, A EXCEPCIÓN DE LA CATEGORÍA ACCESORIOS, DENTRO DE LOS 30 DÍAS DE EFECTUADA LA COMPRA, CON LA ETIQUETA CORRESPONDIENTE Y EL TICKET ORIGINAL O DE CAMBIO, EN CUALQUIERA DE NUESTROS LOCALES EXCLUSIVOS O ENVIÁNDOLAS POR CORREO AL REMITENTE DE NUESTRO ENVÍO. EL COSTO DE ENVÍO Y REENVÍO ESTARÁN A CARGO DEL CLIENTE, EXCEPTO CUANDO SE TRATE DE UN CAMBIO POR UN DEFECTO DE LA PRENDA.<br/>
						LOS PRODUCTOS DE LA CATEGORÍA “VINTAGE” SOLO SE PODRÁN CAMBIAR POR PRODUCTOS DE LA MISMA CATEGORÍA EN LOS LOCALES CON SELECCIÓN DE PRENDAS DISCONTINUAS.<br/>
						EN LA SECCIÓN “STORE” ENCONTRÁS LAS DIRECCIONES DE LOS LOCALES EXCLUSIVOS Y SUS COLECCIONES DISPONIBLES.<br/><br/><br/>

						DEVOLUCIONES:<br/><br/>
						SI EL PRODUCTO QUE RECIBISTE TIENE ALGUNA FALLA O NO SE CORRESPONDE CON EL PRODUCTO QUE SELECCIONASTE, COMUNICATE CON NOSOTROS DENTRO DE LAS 48 HORAS HÁBILES DE RECIBIDA TU COMPRA AL 5411 4613-9691 O POR MAIL A INFO@WINNALOVE . CONSERVÁ SIEMPRE LAS ETIQUETAS ORIGINALES Y EL TICKET DE COMPRA.
					</div>
				</div>				
	  		</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#talles">TALLES</a>
					</h4>
				</div>
			
				<div id="talles" class="panel-collapse collapse">
					<div class="panel-body">
						<img src="http://www.tulocalonline.com/edit/image/catalog/BANNERS/talles/jeans_690.jpg" style="width: 690px;"><br/>
						<img src="http://www.tulocalonline.com/edit/image/catalog/BANNERS/talles/sup_690.jpg" style="width: 690px;"><br/>
						<img src="http://www.tulocalonline.com/edit/image/catalog/BANNERS/talles/inf_690.jpg" style="width: 690px;">
					</div>
				</div>				
	  		</div>
			
			<?php if($theme_options->get( 'custom_block', 'product_page', $config->get( 'config_language_id' ), 'status' ) == 1 || count($product_custom_block)) { ?>
					<div id="product_custom_block">
						<?php if($theme_options->get( 'custom_block', 'product_page', $config->get( 'config_language_id' ), 'status' ) == 1) { ?>
						<div class="product-block">
							<?php if($theme_options->get( 'custom_block', 'product_page', $config->get( 'config_language_id' ), 'heading' ) != '') { ?>
							<h4 class="title-block"><?php echo $theme_options->get( 'custom_block', 'product_page', $config->get( 'config_language_id' ), 'heading' ); ?></h4>
							<div class="strip-line"></div>
							<?php } ?>
							<div class="block-content">
								<?php echo html_entity_decode($theme_options->get( 'custom_block', 'product_page', $config->get( 'config_language_id' ), 'text' )); ?>
							</div>
						</div>
						<?php } ?>
						
						<?php foreach ($product_custom_block as $module) { echo $module; } ?>
					</div>
				<?php } ?>
			
			         
			        <?php if ($minimum > 1) { ?>
			        <div class="minimum"><?php echo $text_minimum; ?></div>
			        <?php } ?>
			      </div>
			     </div>
				 
				 
				 
<!-- End #product -->
			     
			     <?php if($theme_options->get( 'product_social_share' ) != '0') { ?>
			     <div class="share">
			     	<!-- AddThis Button BEGIN -->
			     	<div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
			     	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
			     	<!-- AddThis Button END --> 
			     </div>
			     <?php } ?>
			      
			      <?php 
			      $product_options_bottom = $modules_old_opencart->getModules('product_options_bottom');
			      if( count($product_options_bottom) ) { 
			      	foreach ($product_options_bottom as $module) {
			      		echo $module;
			      	}
			      } ?>
		    	</div>
		    </div>
    	</div>
    	
    	
    </div>
  </div>
  
  <?php 
  $product_over_tabs = $modules_old_opencart->getModules('product_over_tabs');
  if( count($product_over_tabs) ) { 
  	foreach ($product_over_tabs as $module) {
  		echo $module;
  	}
  } ?>
  
  <?php 
  	  $language_id = $config->get( 'config_language_id' );
	  $tabs = array();
	  
	  $tabs[] = array(
	  	'heading' => $tab_description,
	  	'content' => 'description',
	  	'sort' => 1
	  );
	  
	  if ($attribute_groups) { 
		  $tabs[] = array(
		  	'heading' => $tab_attribute,
		  	'content' => 'attribute',
		  	'sort' => 3
		  );
	  }
	  
	  if ($review_status) { 
	  	  $tabs[] = array(
	  	  	'heading' => $tab_review,
	  	  	'content' => 'review',
	  	  	'sort' => 5
	  	  );
	  }
	  	  	  
	  if(is_array($config->get('product_tabs'))) {
		  foreach($config->get('product_tabs') as $tab) {
		  	if($tab['status'] == 1 || $tab['product_id'] == $product_id) {
		  		foreach($tab['tabs'] as $zakladka) {
		  			if($zakladka['status'] == 1) {
		  				$heading = false; $content = false;
		  				if(isset($zakladka[$language_id])) {
		  					$heading = $zakladka[$language_id]['name'];
		  					$content = html_entity_decode($zakladka[$language_id]['html']);
		  				}
		  				$tabs[] = array(
		  					'heading' => $heading,
		  					'content' => $content,
		  					'sort' => $zakladka['sort_order']
		  				);
		  			}
		  		}
		  	}
		  }
	  }
	  
	  usort($tabs, "cmp_by_optionNumber");
  ?>
  
  

  
 
  
  <?php if ($products && $theme_options->get( 'product_related_status' ) != '0') { ?>
  <?php 
  $class = 3; 
  $id = rand(0, 5000)*rand(0, 5000); 
  $all = 4; 
  $row = 4; 
  
  if($theme_options->get( 'product_per_pow' ) == 6) { $class = 2; }
  if($theme_options->get( 'product_per_pow' ) == 5) { $class = 25; }
  if($theme_options->get( 'product_per_pow' ) == 3) { $class = 4; }
  
  if($theme_options->get( 'product_per_pow' ) > 1) { $row = $theme_options->get( 'product_per_pow' ); $all = $theme_options->get( 'product_per_pow' ); } 
  ?>
  <div class="box clearfix <?php if($theme_options->get( 'product_scroll_related' ) != '0') { echo 'with-scroll'; } ?>">
    <?php if($theme_options->get( 'product_scroll_related' ) != '0') { ?>
 
 <!-- Carousel nav -->
    <a class="next" href="#myCarousel<?php echo $id; ?>" id="myCarousel<?php echo $id; ?>_next"><span></span></a>
    <a class="prev" href="#myCarousel<?php echo $id; ?>" id="myCarousel<?php echo $id; ?>_prev"><span></span></a>
    <?php } ?>
  	
    <div class="box-heading"><?php echo $text_related; ?></div>
    <div class="strip-line"></div>
    <div class="box-content products related-products">
      <div class="box-product">
      	<div id="myCarousel<?php echo $id; ?>" <?php if($theme_options->get( 'product_scroll_related' ) != '0') { ?>class="carousel slide"<?php } ?>>
      	

		<!-- Carousel items -->
      		<div class="carousel-inner">
      			<?php $i = 0; $row_fluid = 0; $item = 0; foreach ($products as $product) { $row_fluid++; ?>
  	    			<?php if($i == 0) { $item++; echo '<div class="active item"><div class="product-grid"><div class="row">'; } ?>
  	    			<?php $r=$row_fluid-floor($row_fluid/$all)*$all; if($row_fluid>$all && $r == 1) { if($theme_options->get( 'product_scroll_related' ) != '0') { echo '</div></div></div><div class="item"><div class="product-grid"><div class="row">'; $item++; } else { echo '</div><div class="row">'; } } else { $r=$row_fluid-floor($row_fluid/$row)*$row; if($row_fluid>$row && $r == 1) { echo '</div><div class="row">'; } } ?>
  	    			<div class="col-sm-<?php echo $class; ?> col-xs-6">
  	    				<?php include('catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/product.tpl'); ?>
  	    			</div>
      			<?php $i++; } ?>
      			<?php if($i > 0) { echo '</div></div></div>'; } ?>
      		</div>
  	  </div>
      </div>
    </div>
  </div>
  
  <?php if($theme_options->get( 'product_scroll_related' ) != '0') { ?>
  <script type="text/javascript">
  $(document).ready(function() {
    var owl<?php echo $id; ?> = $(".box #myCarousel<?php echo $id; ?> .carousel-inner");
  	
    $("#myCarousel<?php echo $id; ?>_next").click(function(){
        owl<?php echo $id; ?>.trigger('owl.next');
        return false;
      })
    $("#myCarousel<?php echo $id; ?>_prev").click(function(){
        owl<?php echo $id; ?>.trigger('owl.prev');
        return false;
    });
      
    owl<?php echo $id; ?>.owlCarousel({
    	  slideSpeed : 500,
        singleItem:true,
        <?php if($page_direction[$config->get( 'config_language_id' )] == 'RTL'): ?>
        direction: 'rtl'
        <?php endif; ?>
     });
  });
  </script>
  <?php } ?>
  <?php } ?>
  
</div>







<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			
			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//-->

</script> 
<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));
						
						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}
				
				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}
				
				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}
			
			if (json['success']) {
				$.notify({
					message: json['success'],
					target: '_blank'
				},{
					// settings
					element: 'body',
					position: null,
					type: "info",
					allow_dismiss: true,
					newest_on_top: false,
					placement: {
						from: "top",
						align: "right"
					},
					offset: 20,
					spacing: 10,
					z_index: 2031,
					delay: 5000,
					timer: 1000,
					url_target: '_blank',
					mouse_over: null,
					animate: {
						enter: 'animated fadeInDown',
						exit: 'animated fadeOutUp'
					},
					onShow: null,
					onShown: null,
					onClose: null,
					onClosed: null,
					icon_type: 'class',
					template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-success" role="alert">' +
						'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
						'<span data-notify="message"><i class="fa fa-check-circle"></i>&nbsp; {2}</span>' +
						'<div class="progress" data-notify="progressbar">' +
							'<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
						'</div>' +
						'<a href="{3}" target="{4}" data-notify="url"></a>' +
					'</div>' 
				});
				
				$('#cart_block #cart_content').load('index.php?route=common/cart/info #cart_content_ajax');
				$('#cart_block #total_price_ajax').load('index.php?route=common/cart/info #total_price');
				$('#cart_block #total_item_ajax').load('index.php?route=common/cart/info #total_item');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});
		
$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;
	
	$('#form-upload').remove();
	
	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
	
	$('#form-upload input[name=\'file\']').trigger('click');
	
	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);
			
			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();
					
					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}
					
					if (json['success']) {
						alert(json['success']);
						
						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script> 
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();
	
    $('#review').fadeOut('slow');
        
    $('#review').load(this.href);
    
    $('#review').fadeIn('slow');
});         

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
    $.ajax({
        url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
        type: 'post',
        dataType: 'json',
        data: $("#form-review").serialize(),
        beforeSend: function() {
            $('#button-review').button('loading');
        },
        complete: function() {
            $('#button-review').button('reset');
        },
        success: function(json) {
			$('.alert-success, .alert-danger').remove();
            
			if (json['error']) {
                $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }
            
            if (json['success']) {
                $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                                
                $('input[name=\'name\']').val('');
                $('textarea[name=\'text\']').val('');
                $('input[name=\'rating\']:checked').prop('checked', false);
            }
        }
    });
});
</script>

<script type="text/javascript"><!--
$(document).ready(function() {     
	$('.popup-gallery').magnificPopup({
		delegate: 'a.popup-image',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-with-zoom',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
});
//--></script> 

<script type="text/javascript">
var ajax_price = function() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=product/liveprice/index',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
			success: function(json) {
			if (json.success) {
				change_price('#price-special', json.new_price.special);
				change_price('#price-tax', json.new_price.tax);
				change_price('#price-old', json.new_price.price);
			}
		}
	});
}

var change_price = function(id, new_price) {
	$(id).html(new_price);
}

$('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\'], .product-info input[type=\'checkbox\'], .product-info select, .product-info textarea, .product-info input[name=\'quantity\']').on('change', function() {
	ajax_price();
});
</script>

<script type="text/javascript">
$.fn.tabs = function() {
	var selector = this;
	
	this.each(function() {
		var obj = $(this); 
		
		$(obj.attr('href')).hide();
		
		$(obj).click(function() {
			$(selector).removeClass('selected');
			
			$(selector).each(function(i, element) {
				$($(element).attr('href')).hide();
			});
			
			$(this).addClass('selected');
			
			$($(this).attr('href')).show();
			
			return false;
		});
	});

	$(this).show();
	
	$(this).first().click();
};
</script>

<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 

<?php if($theme_options->get( 'product_image_zoom' ) != 2) { 
echo '<script type="text/javascript" src="catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/js/jquery.elevateZoom-3.0.3.min.js"></script>';
} ?>

<?php include('catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/wrapper_bottom.tpl'); ?>

<script type="text/javascript"><!--
$(document).delegate('.sizechart-button a', 'click', function(e) {
  e.preventDefault();

  $('#modal-cisizechart').remove();

  var element = this;

  $.ajax({
    url: $(element).attr('href'),
    type: 'get',
    dataType: 'json',
    beforeSend: function() {
	    if($(element).hasClass('button')) {
	      $(element).button('loading');
	    }
    },
    complete: function() {
    	if($(element).hasClass('button')) {
      		$(element).button('reset');
      	}
    },
    success: function(json) {
      html  = '<div id="modal-cisizechart" class="modal">';
      html += '  <div class="modal-dialog">';
      html += '    <div class="modal-content">';

      if(json['title']) {
        html += '      <div class="modal-header">';
        html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        html += '        <h4 class="modal-title">' + json['title'] + '</h4>';
        html += '      </div>';
      }

      if(json['description']) {
        html += '      <div class="modal-body">' + json['description'] + '</div>';
      }
      html += '    </div';
      html += '  </div>';
      html += '</div>';

      $('body').append(html);

      $('#modal-cisizechart').modal('show');
    }
  });
});
//--></script>
			
<?php echo $footer; ?>