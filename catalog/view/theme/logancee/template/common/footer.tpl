<?php 
if($registry->has('theme_options') == true) { 
	$theme_options = $registry->get('theme_options');
	$config = $registry->get('config');
	
	require_once( DIR_TEMPLATE.$config->get($config->get('config_theme') . '_directory')."/lib/module.php" );
	$modules = new Modules($registry);
	
	// Pobranie zmiennych
	$language_id = $config->get( 'config_language_id' );
	$customfooter = $theme_options->get( 'customfooter' );
	if(!isset($customfooter[$language_id])) {
		$customfooter[$language_id] = array(
			'aboutus_status' => 0,
			'twitter_status' => 0,
			'facebook_status' => 0,
			'contact_status' => 0,
			'customblock_status' => 0
		);
	}
	
	if(!isset($customfooter[$language_id]['customblock_status'])) $customfooter[$language_id]['customblock_status'] = 0;
	
	$customfooter_top = $modules->getModules('customfooter_top');
	$customfooter_bottom = $modules->getModules('customfooter_bottom');
	$customfooter_center = $modules->getModules('customfooter');
	$footer_center = $modules->getModules('footer');
	
	// Sprawdzanie czy panele są włączone
	if(isset($customfooter[$language_id]) || count($customfooter_top) || count($customfooter_bottom) || count($customfooter_center)) { 
		if($customfooter[$language_id]['twitter_status'] == '1' || $customfooter[$language_id]['contact_status'] == '1' || $customfooter[$language_id]['aboutus_status'] == '1' || $customfooter[$language_id]['facebook_status'] == '1' || count($customfooter_top) || count($customfooter_bottom) || count($customfooter_center)) { 
			
			// Ustalanie szerokości paneli
			$grids = 12; $test = 0;  
			if($customfooter[$language_id]['aboutus_status'] == '1') { $test++; } 
			if($customfooter[$language_id]['twitter_status'] == '1') { $test++; } 
			if($customfooter[$language_id]['facebook_status'] == '1') { $test++; } 
			if($customfooter[$language_id]['contact_status'] == '1') { $test++; } 
			if($customfooter[$language_id]['customblock_status'] == '1') { $test++; } 
			if($test == 0) { $test = 1; }
			$grids = 12/$test; 
			if($test == 5) $grids = 25;
	
	?>
	<!-- CUSTOM FOOTER
		================================================== -->
	<div class="custom-footer <?php if($theme_options->get( 'custom_footer_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>">
		<div class="background-custom-footer"></div>
		<div class="background">
			<div class="shadow"></div>
			<div class="pattern">
				<div class="container">
					<?php 
					if( count($customfooter_top) ) { 
						foreach ($customfooter_top as $module) {
							echo $module;
						}
					} ?>
					
					<?php 
					if( count($customfooter_center) ) { 
						foreach ($customfooter_center as $module) {
							echo $module;
						}
					} else { ?>
     					<div class="row">
     						<?php if($customfooter[$language_id]['aboutus_status'] == '1') { ?>
     						<!-- About us -->
     						<div class="col-sm-<?php echo $grids; ?>">
     							<?php if($customfooter[$language_id]['aboutus_title'] != '') { ?>
     							<h4><i class="fa fa-info-circle"></i> <?php echo $customfooter[$language_id]['aboutus_title']; ?></h4>
     							<?php } ?>
     							<div class="custom-footer-text"><?php echo html_entity_decode($customfooter[$language_id]['aboutus_text']); ?></div>
     						</div>
     						<?php } ?>
     						
     						<?php if($customfooter[$language_id]['contact_status'] == '1') { ?>
     						<!-- Contact -->
     						<div class="col-sm-<?php echo $grids; ?>">
     							<?php if($customfooter[$language_id]['contact_title'] != '') { ?>
     							<h4><i class="fa fa-envelope"></i> <?php echo $customfooter[$language_id]['contact_title']; ?></h4>
     							<?php } ?>
     							<ul class="contact-us clearfix">
     								<?php if($customfooter[$language_id]['contact_phone'] != '' || $customfooter[$language_id]['contact_phone2'] != '') { ?>
     								<!-- Phone -->
     								<li>
     									<i class="fa fa-mobile-phone"></i>
     									<p>
     										<?php if($customfooter[$language_id]['contact_phone'] != '') { ?>
     											<?php echo $customfooter[$language_id]['contact_phone']; ?><br>
     										<?php } ?>
     										<?php if($customfooter[$language_id]['contact_phone2'] != '') { ?>
     											<?php echo $customfooter[$language_id]['contact_phone2']; ?>
     										<?php } ?>
     									</p>
     								</li>
     								<?php } ?>
     								<?php if($customfooter[$language_id]['contact_email'] != '' || $customfooter[$language_id]['contact_email2'] != '') { ?>
     								<!-- Email -->
     								<li>
     									<i class="fa fa-envelope"></i>
     									<p>
     										<?php if($customfooter[$language_id]['contact_email'] != '') { ?>
     											<span><?php echo $customfooter[$language_id]['contact_email']; ?></span><br>
     										<?php } ?>
     										<?php if($customfooter[$language_id]['contact_email2'] != '') { ?>
     											<span><?php echo $customfooter[$language_id]['contact_email2']; ?></span>
     										<?php } ?>
     									</p>
     								</li>
     								<?php } ?>
     								<?php if($customfooter[$language_id]['contact_skype'] != '' || $customfooter[$language_id]['contact_skype2'] != '') { ?>
     								<!-- Phone -->
     								<li>
     									<i class="fa fa-skype"></i>
     									<p>
     										<?php if($customfooter[$language_id]['contact_skype'] != '') { ?>
     											<?php echo $customfooter[$language_id]['contact_skype']; ?><br>
     										<?php } ?>
     										<?php if($customfooter[$language_id]['contact_skype2'] != '') { ?>
     											<?php echo $customfooter[$language_id]['contact_skype2']; ?>
     										<?php } ?>
     									</p>
     								</li>
     								<?php } ?>
     							</ul>
     						</div>
     						<?php } ?>
     						
     						<?php if($customfooter[$language_id]['twitter_status'] == '1') { ?>
     						<!-- Twitter -->
     						<div class="col-sm-<?php echo $grids; ?>">
     							<?php if($customfooter[$language_id]['twitter_title'] != '') { ?>
     							<h4><i class="fa fa-twitter"></i> <?php echo $customfooter[$language_id]['twitter_title']; ?></h4>
     							<?php } ?>
     							
     							<div class="twitter-feed">
     							    <div class="twitter-wrapper"><div class="tweets clearfix" id="twitterFeed"><small>Please wait whilst our latest tweets load.</small></div></div>
     							    <script type="text/javascript">
     							        $(window).load(function(){
     							            twitterFetcher.fetch('<?php echo $customfooter[$language_id]['twitter_widget_id'] ; ?>', 'twitterFeed', 2, true, false);
     							        });
     							    </script>
     							</div>  
     						</div>
     						<?php } ?>
     						
     						<?php if($customfooter[$language_id]['facebook_status'] == '1') { ?>
     						<!-- Facebook -->
     						<div class="col-sm-<?php echo $grids; ?>">
     							<?php if($customfooter[$language_id]['facebook_title'] != '') { ?>
     							<h4><i class="fa fa-facebook"></i> <?php echo $customfooter[$language_id]['facebook_title']; ?></h4>
     							<?php } ?>
     							
     							<div id="fb-root"></div>
     							<script>(function(d, s, id) {
     							  var js, fjs = d.getElementsByTagName(s)[0];
     							  if (d.getElementById(id)) return;
     							  js = d.createElement(s); js.id = id;
     							  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
     							  fjs.parentNode.insertBefore(js, fjs);
     							}(document, 'script', 'facebook-jssdk'));</script>
     														
     							<div id="facebook">
     								<?php if(!isset($customfooter[$language_id]['color_scheme'])) { $customfooter[$language_id]['color_scheme'] = false; } ?>
     								<div class="fb-like-box fb_iframe_widget" profile_id="<?php echo $customfooter[$language_id]['facebook_id']; ?>" data-show-border="false"
     								 data-width="260" data-height="<?php if($customfooter[$language_id]['facebook_height'] > 0) { echo $customfooter[$language_id]['facebook_height']; } else { echo '210'; } ?>" <?php if($customfooter[$language_id]['show_faces'] != '1') { ?>data-connections="<?php if($customfooter[$language_id]['facebook_faces'] > 0) { echo $customfooter[$language_id]['facebook_faces']; } else { echo '8'; } ?>"<?php } ?> data-colorscheme="<?php if($customfooter[$language_id]['color_scheme'] != '1') { echo 'light'; } else { echo 'dark'; } ?>" data-stream="false" data-header="false" data-show-faces="<?php if($customfooter[$language_id]['show_faces'] == '1') { echo 'false'; } else { echo 'true'; } ?>" fb-xfbml-state="rendered"></div>
     							</div>
     						</div>
     						<?php } ?>
     						
     						<?php if($customfooter[$language_id]['customblock_status'] == '1') { ?>
     						<!-- Custom block -->
     						<div class="col-sm-<?php echo $grids; ?>">
     							<?php if($customfooter[$language_id]['customblock_title'] != '') { ?>
     							<h4><?php echo $customfooter[$language_id]['customblock_title']; ?></h4>
     							<?php } ?>
     							<div class="custom-footer-text"><?php echo html_entity_decode($customfooter[$language_id]['customblock_text']); ?></div>
     						</div>
     						<?php } ?>
     					</div>
					<?php } ?>
					
					<?php 
					if( count($customfooter_bottom) ) { 
						foreach ($customfooter_bottom as $module) {
							echo $module;
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
	<?php } } ?>
	
	<?php 
	$footer2 = $modules->getModules('footer2');
	if( count($footer2) ) { 
		foreach ($footer2 as $module) {
			echo $module;
		}
	} else { ?>
	
	<!-- FOOTER
		================================================== -->
	<div class="footer <?php if($theme_options->get( 'footer_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>">
		<div class="background-footer"></div>
		<div class="background">
			<div class="shadow"></div>
			<div class="pattern">
				<div class="container">
					<?php 
					$footer_top = $modules->getModules('footer_top');
					if( count($footer_top) ) { 
						foreach ($footer_top as $module) {
							echo $module;
						}
					} ?>
					
					<?php 
					if( count($footer_center) ) { 
						foreach ($footer_center as $module) {
							echo $module;
						}
					} else { ?>
     					<div class="row">
     						<?php 
     						$footer_left = $modules->getModules('footer_left');
     						$footer_right = $modules->getModules('footer_right');
     						
     						$span = 3;
     						if( count($footer_left) && count($footer_right) ) {
     							$span = 2;
     						} elseif( count($footer_left) || count($footer_right) ) {
     							$span = 25;
     						} ?>
     						
     						<?php if( count($footer_left) ) { ?>
     						<div class="col-sm-<?php echo $span; ?>">
     						<?php foreach ($footer_left as $module) {
     								echo $module;
     							} ?>
     						</div>
     						<?php } ?>
     						
     						<!-- Information -->
     						<div class="col-sm-<?php echo $span; ?>">
     							<h4><?php echo $text_information; ?></h4>
     							<div class="strip-line"></div>
     							<ul>
     								<?php foreach ($informations as $information) { ?>
     								<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
     								<?php } ?>
     							</ul>
     						</div>
							
							<!-- Extras -->
     						<div class="col-sm-<?php echo $span; ?>">
     							<h4><?php echo $text_contact; ?></h4>
     							<div class="strip-line"></div>
     							<ul>
								<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
     						<li><a class="facebook" href="https://www.facebook.com/LECOLTallesReales/">Facebook</a></li>
     						    <li><a class="instagram" href="https://www.instagram.com/lecoltallesreales/">Instagram</a></li>
     						    <li class="item"><a><span class="icon_mail_alt"> </span>info@tallesreales.com.ar</a></li>
		                    </ul>
     						</div>
     						
     						<!-- Customer Service -->
     						<div class="col-sm-<?php echo $span; ?>">
     							<h4><?php echo $text_account; ?></h4>
     							<div class="strip-line"></div>
     							<ul>
     								<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
									<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
									<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
									
				
								</ul> 
     						</div>
							
							<!-- Customer Service -->
     						<div class="col-sm-<?php echo $span; ?>">
     							<h4><?php echo $text_service; ?></h4>
     							<div class="strip-line"></div>
     							<ul>
     								<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
     							   <li><a class="Mercadopago" href="https://www.mercadopago.com.ar/cuotas">Cuotas Sin Interés</a></li>
     						   
     							</ul> 
     						</div>
							
							
     						
     						
     						
     						
     						
     						<?php if( count($footer_right) ) { ?>
     						<div class="col-sm-<?php echo $span; ?>">
     						<?php foreach ($footer_right as $module) {
     								echo $module;
     							} ?>
     						</div>
     						<?php } ?>
     					</div>
					<?php } ?>
					
					<?php 
					$footer_bottom = $modules->getModules('footer_bottom');
					if( count($footer_bottom) ) { 
						foreach ($footer_bottom as $module) {
							echo $module;
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- COPYRIGHT
		================================================== -->
	<div class="copyright <?php if($theme_options->get( 'footer_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>">
		<div class="background-copyright"></div>
		<div class="background">
			<div class="shadow"></div>
			<div class="pattern">
				<div class="container">
					<div class="line"></div>
					<?php if(is_array($theme_options->get( 'payment' ))) { if($theme_options->get( 'payment_status' ) != '0') { ?>
					<ul>
						<?php foreach($theme_options->get( 'payment' ) as $payment) { 
							echo '<li>';
							if($payment['link'] != '') {
								$new_tab = false;
								if($payment['new_tab'] == 1) {
									$new_tab = ' target="_blank"';
								}
								echo '<a href="' .$payment['link']. '"'.$new_tab.'>';
							}
							echo '<img src="image/' .$payment['img']. '" alt="' .$payment['name']. '">';
							if($payment['link'] != '') {
								echo '</a>';
							}
							echo '</li>'; 
						} ?>
					</ul>
					<?php } } ?>
			
					
					<p><?php echo $powered; ?></p>
					<div>
		
 </div>
				
					
					<?php 
					$bottom = $modules->getModules('bottom');
					if( count($bottom) ) { 
						foreach ($bottom as $module) {
							echo $module;
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<script type="text/javascript" src="catalog/view/theme/<?php echo $config->get($config->get('config_theme') . '_directory'); ?>/js/megamenu.js"></script>
	<script>
		///index.php?route=information/information&information_id=23
		$('a[href$="link-modal-mayoristas"]').click(function(event){
			event.preventDefault();
			$("#dialog-mayoristas").modal({ closeClass: 'icon-remove', closeText: 'X' });
		});
		$('a[href$="link-modal-franquicias"]').click(function(event){
			event.preventDefault();
			$("#dialog-franquicias").modal({ closeClass: 'icon-remove', closeText: 'X' });
		});
	</script>
</div>

<div id="dialog-mayoristas" class="modal" title="Suscribete" role="dialog">
     <div class="titulo" onclick='$(".blocker").click();'>Ventas por mayor</div>
     <div class="imagen">
          <img src='image/catalog/BANNERS/2019/WL_Web_Home_Mayorista_Image_690x210.jpg' /> 
    </div>
     <div class="texto1">CONTACTO</div>
     <div class="texto2">
		<b>INFO@WINNALOVE.COM</b>
     </div>
     <div class="texto3">
		Escribinos para recibir toda la informaci&oacute;n y el cat&aacute;logo.<br>
		Vendemos &uacute;nicamente a comerciantes con CUIT y local o showroom.
     </div>
</div>


<div id="dialog-franquicias" class="modal" title="Suscribete" role="dialog">
	<form action="http://www.argentina.tulocalonline.com/edit/index.php?route=information/contact" method="post" enctype="multipart/form-data">
		<div class="titulo" onclick='$(".blocker").click();'>Evianos un mail</div>
		<div class="texto2"> <b>INFO@WINNALOVE.COM</b> </div>
		<div class="texto3">Atención al cliente: Lunes a Viernes de 10 a 17hs</div>
		<div class="row">
			<div class="field col-md-6">
				<div class="input-box">
					<input name="name" id="name" title="Name" value=""  type="text" placeholder="Tu Nombre">
				</div>
			</div>
			<div class="field col-md-6">
				<div class="input-box">
					<input name="email" id="email" title="Email" value="" class="validate-email" type="text" placeholder="Correo Electrónico">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-box col-md-12 textarea-container">
				<textarea name="enquiry" id="comment" title="Comentario" rows="5" placeholder="Comentario"></textarea>
			</div>
		</div>		
		<div class="row button-box">
			<button type="submit" title="Enviar" class="button"><span><span>Enviar</span></span></button>
		</div>
	</form>
</div>


<style>

     #dialog-franquicias .titulo{
		font-size: 25px;
		font-style: italic;
		font-family: Merriweather;
		background-color: #f2e3de;
		color: #bf8673
     }

	 #dialog-franquicias input, #dialog-franquicias textarea{
		border: 1px solid;
     }

	 #dialog-franquicias textarea{
		width: 100%;
     }

	 #dialog-franquicias .titulo, #dialog-franquicias .row, #dialog-franquicias .texto2, #dialog-franquicias .texto3{
		padding-left: 30px;
		font-family: Roboto;
     }

	 #dialog-franquicias .texto2{
    	padding-top: 20px;
	 }

	 #dialog-franquicias .texto3{
    	padding-bottom: 15px;
	 }

	 #dialog-franquicias .button-box{
		text-align: right;
    	padding-right: 35px;
    	padding-bottom: 25px;
	 }

	 #dialog-franquicias .textarea-container{
    	padding-right: 35px;
	 }



     
     #dialog-mayoristas .texto1{
          padding-top: 10px;
          font-size: 30px;
     }
     #dialog-mayoristas .titulo, #dialog-mayoristas .texto1, #dialog-mayoristas .texto2, #dialog-mayoristas .texto3, #dialog-mayoristas .text-box, #dialog-mayoristas .button-box{
          padding-left: 30px;
          font-family: Roboto;
     }
     #dialog-mayoristas .imagen img{
         width: 500px;
		 border-bottom: 5px solid #eac0b2;
     }
     #dialog-mayoristas .titulo{
         font-size: 25px;
         font-style: italic;
          font-family: Merriweather;
     }
     #dialog-mayoristas{
          max-width: 500px;
          background-color: #fff;
          z-index: 15;
          height: 360px;
         overflow: initial;
         padding: 0px;
     }
     .blocker{
          z-index: 10;
     }
     .modal a.close-modal[class*="icon-"] {
         top: -2px;
         right: 22px;
         width: 20px;
         height: 20px;
         color: #eac0b2;
         font-size: 30px;
         text-align: center;
         text-decoration: none;
         text-indent: 0;
         -moz-border-radius: 26px;
          -o-border-radius: 26px;
         -ms-border-radius: 26px;
         -moz-box-shadow: 1px 1px 5px rgba(0,0,0,0.5);
         background: none;
     }

	 .modal{
		padding: 0px;
		border-radius: unset;
    	overflow: hidden;
	 }
	 .modal .button-box button{
          height: 40px;
          line-height: 40px;
          top: 0;
          right: 0;
          margin: 0;
          padding: 0 8px;
          background-color: darksalmon;
          color: aliceblue;
          font-family: auto;
          font-size: larger;
          font-weight: bolder;
     }
</style>


<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
</div>
<?php } ?>
</body>
</html>