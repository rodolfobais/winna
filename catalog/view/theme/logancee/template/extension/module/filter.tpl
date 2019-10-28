<?php
//echo "breadcrumbs<pre>"; print_r($breadcrumbs); echo "</pre>";
?>
<div class="col-md-12" id="cuadro-filtros-desktop" style="height: 65px; border-top: 2px solid; border-bottom: 1px solid;">
  <div class="col-md-3" style="top: 50%;transform: translateY(-50%);border-right: 1px solid;height: 40px;">
    <div style=" top: 10px; position: absolute;">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <a href="<?php echo $breadcrumb['href']; ?>">
          <?php 
            if($breadcrumb['text'] != '<i class="fa fa-home"></i>') { 
              echo $breadcrumb['text']; 
            } else { 
              if($theme_options->get( 'home_text', $config->get( 'config_language_id' ) ) != '') { 
                echo $theme_options->get( 'home_text', $config->get( 'config_language_id' ) ); 
              } else { 
                echo 'Home'; 
              } 
            } 
          ?>
        </a>
      <?php } ?>
    </div>
  </div>
  <?php foreach ($filter_groups as $filter_group) { ?>
    <div class="col-md-2" style="top: 10px; border-right: 1px solid;">
      <select id="filter-group<?php echo $filter_group['filter_group_id']; ?>" class="filtro_producto" 
        style=" width: 100%; padding: 0px; height: 40px; margin: 0px; margin-top: 0px; " onchange="aplicarFiltros()">
        <option value=""><?php echo $filter_group['name']; ?></option>
        <?php foreach ($filter_group['filter'] as $filter) { ?>
          <option value="<?php echo $filter['filter_id']; ?>" id="filter<?php echo $filter['filter_id']; ?>" 
            <?php echo (in_array($filter['filter_id'], $filter_category) ? "selected" : "") ?>>
            <?php echo $filter['name']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
  <?php } ?>
  <div class="col-md-3 text-right" style="top: 50%; transform: translateY(-50%);">VER <b><a href="#"  onclick="setearColumnas(event, 2);">2</a> | <a href="#"  onclick="setearColumnas(event, 4);">4</a></b></div>
</div>
<script type="text/javascript"><!--
$('#button-filter').bind('click', function() {
	filter = [];
	
	$('.box-filter input[type=\'checkbox\']:checked').each(function(element) {
		filter.push(this.value);
	});
	
	location = '<?php echo $action; ?>&filter=' + filter.join(',');
});
function setearColumnas(event, cols){
  event.preventDefault();
  var url = document.location.href;
  url = url.replace("&product_per_pow=4", "");
  url = url.replace("&product_per_pow=2", "");
  document.location.href = url + "&product_per_pow="+cols
  //console.log(parser.search);
}
function aplicarFiltros(){
  filter = [];
  $('.filtro_producto').each(function(element) {
    if(this.value != ""){
  		filter.push(this.value);
    }
  });
  location = '<?php echo $action; ?>&filter=' + filter.join(',');
}
//--></script> 
