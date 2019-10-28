<?php 
echo $header; 
$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); 
include('catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/template/new_elements/wrapper_top.tpl'); ?>
<style>
.how-to-contact .titulo, .titulo-representantes {
    border-top: 2px solid;
    border-bottom: 1px solid;    
    padding-bottom: 5px;
    padding-top: 5px;
}
.inner-contact{
     width: 100%;
    text-align: left !important;
}

.how-to-contact .pais-tienda {
     color: #bf8673;
    font-size: 25px;
    font-family: Merriweather;
    font-style: italic;
    padding-top: 5px;
    padding-bottom: 8px;
}

.representantes p{
     color: #999;
}
.representantes p b{
     color: black;
}

.contact-map {
    filter: grayscale(100%);
    -webkit-filter: grayscale(100%);
}
</style>

<div class="contact-page">
     <div class="row">
          <div class="how-to-contact col-xs-2">
               <div class="row">               
                    <div class="contact-way col-xs-12">
                         <div class="inner-contact">
                              <div class="titulo">EXCLUSIVOS</div>
                              <div class="pais-tienda">Argentina</div>
                              <div class="localidad-tienda"><b>PALERMO SOHO</b></div>
                              <div class="texto">El salvador 4719, CABA</div>
                              <div class="texto">Tel: 0054 11 4613-9691</div>
                              <div class="texto">WApp: +53 9 11 3818-2602</div>
                              <div class="texto">Lun a Sáb: 10.30 a 20.00 hs</div>
                              <div class="texto">Dom: 14.00 a 20.00 hs</div>
                              <div class="texto">Feriados: 14.00 a 20.00 hs</div>

                              <div class="pais-tienda">Uruguay</div>
                              <div class="localidad-tienda"><b>PUNTA CARRETAS</b></div>
                              <div class="texto">21 de Septiembre 2895 bis, Montevideo</div>
                              <div class="texto">Tel: 00598 2605-1692</div>
                              <div class="texto">WApp: +598 9500-0079</div>
                              <div class="texto">Lun a Sáb: 10.00 a 19.00 hs</div>
                              <div class="texto">Dom: Cerrado</div>
                         </div>
                    </div>
               </div>
          </div>
          
          
          <div class="col-xs-10">
               <?php if ($geocode) { ?>
               <div class="contact-map"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="1170" height="470" src="https://maps.google.com/maps?q=<?php echo urlencode($geocode); ?>&hl=<?php echo $geocode_hl; ?>&ie=UTF8&t=roadmap&z=16&iwloc=B&output=embed"></iframe></div>
               <?php } ?>
          </div>
     </div>
     <div class="row representantes">
          <div class="col-xs-12">
               <div class="col-xs-12 titulo-representantes">Representantes</div>

               <div class="col-xs-3">
                    <p><b>Ciudad de Buenos Aires</b></p>
                    <p>Xxxxxx, Local 7<br> Av. Rivadavia 4975, Caballito</p>
                    <p>Xxxxxx, Local 3<br> Av. Rivadavia 5040, Caballito</p>
               </div>
               <div class="col-xs-3">
                    <p><b>Gran Buenos Aires</b></p>
                    <p>Xxxxxx<br> Int. Bonifacini 1934, San Martin</p>
                    <p>Xxxxxx<br> Alvear 515, Quilmes</p>
                    <p>Xxxxxx<br> Italia 1289, San Antonio de Padua</p>
               </div>
               <div class="col-xs-2">
                    <p><b>C&oacute;rdoba</b></p>
                    <p>Xxxxxx<br> R. Nu&ntilde;ez 4084, Cerro de las Rosas</p>
                    <p>Xxxxxx<br> Alvear 737, R&iacute;o Cuarto</p>
                    <p>Xxxxxx<br> V&eacute;lez Sarsfield 114, R&iacute;o Tercero</p>
               </div>
               <div class="col-xs-2">
                    <p><b>Entre Ríos</b></p>
                    <p>Xxxxxx, local 8<br> Gral. J. J. de Urquiza 1086, Paran&aacute;</p>
               </div>
               <div class="col-xs-2">
                    <p><b>Neuqu&eacute;n</b></p>
                    <p>Xxxxxx<br> Julio A. Roca 166, Xxxxxx</p>
               </div>
          </div>
     </div>
</div>
  
<?php include('catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/template/new_elements/wrapper_bottom.tpl'); ?>
<?php echo $footer; ?>