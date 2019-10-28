<?php 
echo $header; 
if(isset($mfilter_json)) {
	if(!empty($mfilter_json)) { 
		echo '<div id="mfilter-json" style="display:none">' . base64_encode( $mfilter_json ) . '</div>'; 
	} 
}



$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); 
//echo 'catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/wrapper_top.tpl';
include('catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/wrapper_top.tpl'); 

//echo "<pre>data: ".print_r($data, true)."</pre>";
//echo "<pre>filter_groups: ".print_r($filter_groups, true)."</pre>";die;

?>
<script>
	$(window).load(function() {    
		ocultarMostrarFiltrosOrdenamientos();			
		$(window).resize(function () {
			ocultarMostrarFiltrosOrdenamientos()
		});
	});
	function ocultarMostrarFiltrosOrdenamientos(){
		//return;
		var viewportWidth = $(window).width();
		if (viewportWidth < 768) {
			$('#cuadro-filtros-desktop').hide();
			$('#cuadro-ordenamientos-desktop').hide();
			//cuadro-ordenamientos-filtros-mobile
			$('#cuadro-ordenamientos-filtros-mobile').show();
		}else{
			$('#cuadro-filtros-desktop').show();
			$('#cuadro-ordenamientos-desktop').show();
			$('#cuadro-ordenamientos-filtros-mobile').hide();
		}
	}

	function ocultarMostrarFilOrdMob(acc){
		if(acc == "mostrar"){//mostrar-ordenamientos-filtros-mobile
			$('#cuadro-ordenamientos-filtros-mobile .item').show();
			$('#cuadro-ordenamientos-filtros-mobile #mostrar-ordenamientos-filtros-mobile').hide();
			$('#cuadro-ordenamientos-filtros-mobile #ocultar-ordenamientos-filtros-mobile').show();
		}else{
			$('#cuadro-ordenamientos-filtros-mobile .item').hide();
			$('#cuadro-ordenamientos-filtros-mobile #mostrar-ordenamientos-filtros-mobile').show();
			$('#cuadro-ordenamientos-filtros-mobile #ocultar-ordenamientos-filtros-mobile').hide();
		}
	}
</script>
<div id="mfilter-content-container">
  <?php if ($thumb || $description) { ?>
	<div class="category-info clearfix">
		<?php if ($thumb) { ?>
		<div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /> </div>
		<?php } ?>
		<?php if ($description) { ?>
		<?php echo $description; ?>
		<?php } ?>
	</div>
  <?php } ?>
  <?php if ($categories && $theme_options->get('refine_search_style') != '2') { ?>  
  <h2 class="refine_search"><?php echo $text_refine; ?></h2>
  <div class="category-list<?php if ($theme_options->get('refine_search_style') == '1') { echo ' category-list-text-only'; } ?>">
  	<div class="row">
  	  <?php 
  	  $class = 3; 
  	  $row = 4; 
  	  
  	  if($theme_options->get( 'refine_search_number' ) == 2) { $class = 62; }
  	  if($theme_options->get( 'refine_search_number' ) == 5) { $class = 25; }
  	  if($theme_options->get( 'refine_search_number' ) == 3) { $class = 4; }
  	  if($theme_options->get( 'refine_search_number' ) == 6) { $class = 2; }
  	  
  	  if($theme_options->get( 'refine_search_number' ) > 1) { $row = $theme_options->get( 'refine_search_number' ); } 
  	  ?>
	  <?php $row_fluid = 0; foreach ($theme_options->refineSearch() as $category) { $row_fluid++; ?>
	  	<?php 
	  	if ($theme_options->get('refine_search_style') != '1') {
	  		$width = 250;
	  		$height = 250;
	  		if($theme_options->get( 'refine_image_width' ) > 20) $width = $theme_options->get( 'refine_image_width' );
	  		if($theme_options->get( 'refine_image_height' ) > 20) $height = $theme_options->get( 'refine_image_height' );
	  		$model_tool_image = $registry->get('model_tool_image');
		  	if($category['thumb'] != '') { 
		  		$image = $model_tool_image->resize($category['thumb'], $width, $height); 
		  	} else { 
		  		$image = $model_tool_image->resize('no_image.jpg', $width, $height); 
		  	} 
	  	}
	  	?>
	  	<?php $r=$row_fluid-floor($row_fluid/$row)*$row; if($row_fluid>$row && $r == 1) { echo '</div><div class="row">'; } ?>
	  	<div class="col-sm-<?php echo $class; ?> col-xs-6">
	  		<?php if ($theme_options->get('refine_search_style') != '1') { ?>
		  	<a href="<?php echo $category['href']; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $category['name']; ?>" /></a>
		  	<?php } ?>
		  	<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
	  	</div>
	  <?php } ?>
	</div>
  </div>
  <?php } ?>
  <?php if ($products) { ?>
  
  <!-- Filter -->
  	
	<!--
	<div class="product-filter clearfix">
		<div class="options">
			
			<div class="button-group display" data-toggle="buttons-radio">
			</div>
		</div>

		<div class="list-options">
			<div class="sort">
				<?php echo $text_sort; ?>
				<select onchange="location = this.value;">
					<?php foreach ($sorts as $sorts) { ?>
						<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
							<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
						<?php } else { ?>
							<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	-->
	<!-- bread-crumb start here -->
<div class="fall">
	<?php echo $heading_title; ?>	
</div>

<!-- bread-crumb end here -->
	<!-- Ordenamientos-->
	<div class="product-filter clearfix" id="cuadro-ordenamientos-desktop">	
		<a href="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.date_available&order=DESC">Lo nuevo</a> | 
		<a href="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.price&order=DESC">Mayor a Menor</a> | 
		<a href="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.price&order=ASC">Menor a Mayor</a>
	</div> 

	<!-- Ordenamientos y filtros mobile-->
	<div class="product-filter clearfix" id="cuadro-ordenamientos-filtros-mobile">	
		<div class="titulo">
			FILTRAR Y CLASIFICAR 
			<i class="fa fa-sliders" onclick="ocultarMostrarFilOrdMob('mostrar')" id="mostrar-ordenamientos-filtros-mobile"></i>
			<i class="fa fa-close" onclick="ocultarMostrarFilOrdMob('ocultar')" id="ocultar-ordenamientos-filtros-mobile" style="display:none"></i>
		</div>
		<div class="item"  style="display:none">
			ORDENAR POR
			<select onchange="location=this.value;">
				<option value="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.sort_order&;order=ASC">Defecto</option>
				<option value="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.date_available&order=DESC">Lo nuevo</option>
				<option value="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.price&order=DESC">Mayor a Menor</option>
				<option value="index.php?route=product/category&path=<?php echo $_GET['path']; ?>&sort=p.price&order=ASC">Menor a Mayor</option>
			</select>
		</div>
		<?php foreach ($filter_groups as $filter_group) { ?>
			<div class="item"  style="display:none">
				<?php echo $filter_group['name']; ?>
				<select id="filter-group<?php echo $filter_group['filter_group_id']; ?>" onchange="aplicarFiltros()" class="filtro_producto" >
					<option value=""></option>
					<?php foreach ($filter_group['filter'] as $filter) { ?>
					<option value="<?php echo $filter['filter_id']; ?>" id="filter<?php echo $filter['filter_id']; ?>" 
						<?php echo (in_array($filter['filter_id'], $filter_category) ? "selected" : "") ?>>
						<?php echo $filter['name']; ?>
					</option>
					<?php } ?>
				</select>
			</div>
		<?php } ?>
	</div> 
  <!-- Products grid -->
  <?php 
  $class = 3; 
  $row = 4; 
  
  if($theme_options->get( 'product_per_pow2' ) == 6) { $class = 2; }
  if($theme_options->get( 'product_per_pow2' ) == 5) { $class = 25; }
  if($theme_options->get( 'product_per_pow2' ) == 3) { $class = 4; }  
  if($theme_options->get( 'product_per_pow2' ) > 1) { $row = $theme_options->get( 'product_per_pow2' ); } 

  if($_GET['product_per_pow'] == 2) { $class = 6; }
  ?>
  <div class="product-grid"<?php if($theme_options->get('default_list_grid') == '1') { echo ' class="active"'; } ?>>
  	<div class="row">
	  	<?php $row_fluid = 0; foreach ($products as $product) { $row_fluid++; ?>
		  	<?php $r=$row_fluid-floor($row_fluid/$row)*$row; if($row_fluid>$row && $r == 1) { echo '</div><div class="row">'; } ?>
		  	<div class="col-sm-<?php echo $class; ?> col-xs-6">
		  	    <?php include('catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/product.tpl'); ?>
		  	</div>
	    <?php } ?>
    </div>
  </div>
  
  <div class="row pagination-results">
    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
  </div>
  <?php } ?>
  <?php if (!$categories && !$products) { ?>
  <p style="padding-top: 6px"><?php echo $text_empty; ?></p>
  <div class="buttons">
    <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
<script type="text/javascript"><!--
function display(view) {

	if (view == 'list') {
		$('.product-grid').removeClass("active");
		$('.product-list').addClass("active");

		$('.display').html('<button id="grid" rel="tooltip" title="Grid" onclick="display(\'grid\');"><i class="fa fa-th-large"></i></button> <button class="active" id="list" rel="tooltip" title="List" onclick="display(\'list\');"><i class="fa fa-th-list"></i></button>');
		
		localStorage.setItem('display', 'list');
	} else {
	
		$('.product-grid').addClass("active");
		$('.product-list').removeClass("active");
					
		$('.display').html('<button class="active" id="grid" rel="tooltip" title="Grid" onclick="display(\'grid\');"><i class="fa fa-th-large"></i></button> <button id="list" rel="tooltip" title="List" onclick="display(\'list\');"><i class="fa fa-th-list"></i></button>');
		
		localStorage.setItem('display', 'grid');
	}
}

if (localStorage.getItem('display') == 'list') {
	display('list');
} else if (localStorage.getItem('display') == 'grid') {
	display('grid');
} else {
	display('<?php if($theme_options->get('default_list_grid') == '1') { echo 'grid'; } else { echo 'list'; } ?>');
}
//--></script> 
<script>
	$(window).load(function() {    
		cambiarImagenCategory();			
		$(window).resize(function () {
			cambiarImagenCategory()
		});
	});
	function cambiarImagenCategory(){
		//return;
		var viewportWidth = $(window).width();
		var desde = "";
		var hasta = "";
		if (viewportWidth < 768) {
			desde = "_Web_";
			hasta = "_Mobile_";
		}else{
			hasta = "_Web_";
			desde = "_Mobile_";
		}
		$( ".camera_slider .owl-item img" ).each(function( index ) {
			var src = $(this).attr("src");
			src = src.replace(desde, hasta);
			$(this).attr("src", src);
		});
	}
</script>
</div>
<?php include('catalog/view/theme/'.$config->get($config->get('config_theme') . '_directory').'/template/new_elements/wrapper_bottom.tpl'); ?>
<?php echo $footer; ?>