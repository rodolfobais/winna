<?php if($theme_options->get( 'fixed_header' ) == 1) { ?>
<div class="sticky-header is-sticky background2">
     <div class="wrap">
          <div class="standard-body">
               <div class="full-width">
                    <div class="container"><div style="position: relative">
                         <div class="logo-sticky">
                  
                              <?php if ($logo) { ?>
                              <a href="<?php echo $home; ?>"><span><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></span></a>
                              <?php } ?>
                         </div>
                         
                         <div class="sticky-icon-group">
                              <div class="sticky-search">
                                   <i class="icon-magnifier"></i>
                                   <div class="quick-search">
                                        <div class="form-search">
                                             <input id="search2" type="text" name="q" value="" class="input-text" maxlength="128" placeholder="<?php echo $search; ?>" autocomplete="off">
                                             <button type="submit" title="Search" class="button-search"><span><i aria-hidden="true" class="icon_search"></i></span></button>
                                        </div>
                                        <i aria-hidden="true" class="icon_close"></i>
                                   </div>
                              </div>
                              
                              <div class="sticky-cart">
                                   <?php echo $cart; ?>
                              </div>
                              
                              <div class="settings">
                                    <i class="icon-plus"></i>
                                    <div class="settings-inner">
                                         <div class="setting-content">
                                              <?php if($language != '') { ?>
                                              <div class="setting-language">
                                                   <div class="title"><?php if($theme_options->get( 'select_language_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'select_language_text', $config->get( 'config_language_id' ) )); } else { echo 'Select language'; } ?></div>
                                                   <?php echo $language; ?>
                                              </div>
                                              <?php } ?>
                                              
                                              <?php if($currency != '') { ?>
                                              <div class="setting-currency">
                                                   <div class="title"><?php if($theme_options->get( 'select_currency_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'select_currency_text', $config->get( 'config_language_id' ) )); } else { echo 'Select currency'; } ?></div>
                                                   <?php echo $currency; ?>
                                              </div>
                                              <?php } ?>
                                              
                                              <div class="setting-option">
                                                   <ul>
                                                        <li><a href="<?php echo $login; ?>"><i class="icon-lock-open icons"></i><span><?php echo $text_login; ?> / <?php echo $text_register; ?></span></a></li>
                                                        <li><a href="<?php echo $account; ?>"><i class="icon-user icons"></i><span><?php echo $text_account; ?></span></a></li>
                                                        <li><a href="<?php echo $wishlist; ?>"><i class="icon-heart icons"></i><span><?php echo $text_wishlist; ?></span></a></li>
                                                        <li><a href="<?php echo $shopping_cart; ?>"><i class="icon-bag"></i><span><?php echo $text_shopping_cart; ?></span></a></li>
                                                        <li><a href="<?php echo $checkout; ?>"><i class="icon-note icons"></i><span><?php echo $text_checkout; ?></span></a></li>
                                                   </ul>
                                              </div>
                                         </div>
                                    </div>
                               </div>
                          </div>
                         
                         <div class="main-menu">
                              <?php 
                              $menu = $modules->getModules('menu');
                              if( count($menu) ) {
                              	foreach ($menu as $module) {
                              		echo $module;
                              	}
                              } elseif($categories) {
                              ?>
                              <div class="container-megamenu container horizontal">
                              	<div class="megaMenuToggle">
                              		<div class="megamenuToogle-wrapper">
                              			<div class="megamenuToogle-pattern">
                              				<div class="container">
                              					<div><span></span><span></span><span></span></div>
                              					MENU
                              				</div>
                              			</div>
                              		</div>
                              	</div>
                              	
                              	<div class="megamenu-wrapper">
                              		<div class="megamenu-pattern">
                              			<div class="container">
                              				<ul class="megamenu shift-up linea-86">
                              					<?php foreach ($categories as $category) { ?>
                              					<?php if ($category['children']) { ?>
                              					<li class="with-sub-menu hover"><p class="close-menu"></p><p class="open-menu"></p>
                              						<a href="<?php echo $category['href'];?>"><span><strong><?php echo $category['name']; ?> 90</strong></span></a>
                              					<?php } else { ?>
                              					<li>
                              						<a href="<?php echo $category['href']; ?>"><span><strong><?php echo $category['name']; ?> 93</strong></span></a>
                              					<?php } ?>
                              						<?php if ($category['children']) { ?>
                              						<?php 
                              							$width = '100%';
                              							$row_fluid = 3;
                              							if($category['column'] == 1) { $width = '270px'; $row_fluid = 12; }
                              							if($category['column'] == 2) { $width = '500px'; $row_fluid = 6; }
                              							if($category['column'] == 3) { $width = '700px'; $row_fluid = 4; }
                              						?>
                              						<div class="sub-menu" style="width: <?php echo $width; ?>">
                              							<div class="content">
                              								<p class="arrow"></p>
                              								<div class="row hover-menu">
                              									<?php for ($i = 0; $i < count($category['children']);) { ?>
                              									<div class="col-sm-<?php echo $row_fluid; ?> mobile-enabled">
                              										<div class="menu">
                              											<ul>
                              											  <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                              											  <?php for (; $i < $j; $i++) { ?>
                              											  <?php if (isset($category['children'][$i])) { ?>
                              											  <li><a href="<?php echo $category['children'][$i]['href']; ?>" onclick="window.location = '<?php echo $category['children'][$i]['href']; ?>';"><?php echo $category['children'][$i]['name']; ?></a></li>
                              											  <?php } ?>
                              											  <?php } ?>
                              											</ul>
                              										</div>
                              									</div>
                              									<?php } ?>
                              								</div>
                              							</div>
                              						</div>
                              						<?php } ?>
                              					</li>
                              					<?php } ?>
                              				</ul>
                              			</div>
                              		</div>
                              	</div>
                              </div>
                              <?php
                              }
                              ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<?php } ?>

<!-- HEADER
	================================================== -->
<header class="header header-layout-2">
	<div class="background-header"></div>
	<div class="slider-header">
		<!-- Top Bar -->
		<div id="top-bar" class="<?php if($theme_options->get( 'top_bar_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>">
			<div class="background-top-bar"></div>
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern">
					<div class="container">
						<div class="header-top-inner">
						     <div class="row">
						          <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
						               <?php $top_blocks = $modules->getModules('top_block'); ?>
						               <?php  if(count($top_blocks)) { ?>
						                    <?php foreach($top_blocks as $module) { ?>
						               	<?php echo $module; ?>
						               	<?php } ?>
						               <?php } ?>
						          </div>
						          
						          <div class="hidden-xs hidden-sm col-xs-12 col-sm-12 col-md-6 col-lg-6">
						              
						          </div>
						          <!--
						          <div class="settings-topbar visible-sm-block hidden-xs col-xs-2">
						               <div class="settings">
						                    <i class="icon-plus"></i>
						                    <div class="settings-inner">
						                         <div class="setting-content">
						                              <?php if($language != '') { ?>
						                              <div class="setting-language">
						                                   <div class="title"><?php if($theme_options->get( 'select_language_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'select_language_text', $config->get( 'config_language_id' ) )); } else { echo 'Select language'; } ?></div>
						                                   <?php echo $language; ?>
						                              </div>
						                              <?php } ?>
						                              
						                              <?php if($currency != '') { ?>
						                              <div class="setting-currency">
						                                   <div class="title"><?php if($theme_options->get( 'select_currency_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'select_currency_text', $config->get( 'config_language_id' ) )); } else { echo 'Select currency'; } ?></div>
						                                   <?php echo $currency; ?>
						                              </div>
						                              <?php } ?>
						                              
						                              <div class="setting-option">
						                                   <ul>
						                                        <li><a href="<?php echo $login; ?>"><i class="icon-lock-open icons"></i><span><?php echo $text_login; ?> / <?php echo $text_register; ?></span></a></li>
						                                        <li><a href="<?php echo $account; ?>"><i class="icon-user icons"></i><span><?php echo $text_account; ?></span></a></li>
						                                        <li><a href="<?php echo $wishlist; ?>"><i class="icon-heart icons"></i><span><?php echo $text_wishlist; ?></span></a></li>
						                                        <li><a href="<?php echo $shopping_cart; ?>"><i class="icon-bag"></i><span><?php echo $text_shopping_cart; ?></span></a></li>
						                                        <li><a href="<?php echo $checkout; ?>"><i class="icon-note icons"></i><span><?php echo $text_checkout; ?></span></a></li>
						                                   </ul>
						                              </div>
						                         </div>
						                    </div>
						               </div>
						          </div>
								  -->
						     </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Top of pages desktop-->
		<div id="top" class="menu-desktop <?php if($theme_options->get( 'header_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>">
			<div class="background-top"></div>
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern">
					<div class="container">
					     <div class="sticky-header is-sticky">
						 	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						 
								<div class="logo-home">
									<?php if ($logo) { ?>
										<a href="<?php echo $home; ?>"><span><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></span></a>
									<?php } ?>
								</div>
							</div>					       
							<div class="sticky-icon-group">
								<div class="sticky-search">
					                    <i class="icon-magnifier"></i>
					                    <div class="quick-search">
					                         <div class="form-search">
					                              <input id="search2" type="text" name="search" value="" class="input-text" maxlength="128" placeholder="<?php echo $search; ?>" autocomplete="off">
					                              <button type="submit" title="Search" class="button-search"><span><i aria-hidden="true" class="icon_search"></i></span></button>
					                         </div>
					                         <i aria-hidden="true" class="icon_close"></i>
					                    </div>
					               </div>
					               
					               <div class="sticky-cart">
					                    <?php echo $cart; ?>
					               </div>
					               
					               <div class="settings">
										<i class="icon-plus"></i>
										<div class="settings-inner">
											<div class="setting-content">
												<?php if($language != '') { ?>
													<div class="setting-language">
														<div class="title"><?php if($theme_options->get( 'select_language_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'select_language_text', $config->get( 'config_language_id' ) )); } else { echo 'Select language'; } ?></div>
														<?php echo $language; ?>
													</div>
												<?php } ?>
					                               
												<?php if($currency != '') { ?>
													<div class="setting-currency">
														<div class="title"><?php if($theme_options->get( 'select_currency_text', $config->get( 'config_language_id' ) ) != '') { echo html_entity_decode($theme_options->get( 'select_currency_text', $config->get( 'config_language_id' ) )); } else { echo 'Select currency'; } ?></div>
														<?php echo $currency; ?>
													</div>
												<?php } ?>
					                               
												<div class="setting-option">
													<ul>
														<li><a href="#" onclick="openLoginPopUp(event)"><i class="icon-lock-open icons"></i><span><?php echo $text_login; ?> / <?php echo $text_register; ?></span></a></li>
														<li><a href="<?php echo $wishlist; ?>"><i class="icon-heart icons"></i><span><?php echo $text_wishlist; ?></span></a></li>
														<li><a href="<?php echo $checkout; ?>"><i class="icon-note icons"></i><span><?php echo $text_checkout; ?></span></a></li>
													</ul>
												</div>
											</div>
										</div>
					                </div>
								</div>
					          
					          	<div class="main-menu">
									<?php 
									$menu = $modules->getModules('menu');
									if( count($menu) ) {
										foreach ($menu as $module) { echo $module; }
									} elseif($categories) {
									?>
										<div class="container-megamenu container horizontal">
											<div class="megaMenuToggle">
												<div class="megamenuToogle-wrapper">
													<div class="megamenuToogle-pattern">
														<div class="container">
															<div>
																<span></span><span></span><span></span>
															</div>
															MENU
														</div>
													</div>
												</div>
											</div>
					               	
					               			<div class="megamenu-wrapper">
					               				<div class="megamenu-pattern">
					               					<div class="container">
					               						<ul class="megamenu shift-uplinea-297">
					               							<?php foreach ($categories as $category) { ?>
					               								<?php if ($category['children']) { ?>
					               									<li class="with-sub-menu hover"><p class="close-menu"></p><p class="open-menu"></p>
					               										<a href="<?php echo $category['href'];?>"><span><strong><?php echo $category['name']; ?> 301</strong></span></a>
					               								<?php } else { ?>
																	<li>
					               										<a href="<?php echo $category['href']; ?>"><span><strong><?php echo $category['name']; ?> 304</strong></span></a>
					               								<?php } ?>
					               								<?php if ($category['children']) { ?>
																	<?php 
																		$width = '100%';
																		$row_fluid = 3;
																		if($category['column'] == 1) { $width = '270px'; $row_fluid = 12; }
																		if($category['column'] == 2) { $width = '500px'; $row_fluid = 6; }
																		if($category['column'] == 3) { $width = '700px'; $row_fluid = 4; }
																	?>
																	<div class="sub-menu" style="width: <?php echo $width; ?>">
																		<div class="content">
																			<p class="arrow"></p>
																			<div class="row hover-menu">
																				<?php for ($i = 0; $i < count($category['children']);) { ?>
																				<div class="col-sm-<?php echo $row_fluid; ?> mobile-enabled">
																					<div class="menu">
																						<ul>
																						<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
																						<?php for (; $i < $j; $i++) { ?>
																						<?php if (isset($category['children'][$i])) { ?>
																						<li><a href="<?php echo $category['children'][$i]['href']; ?>" onclick="window.location = '<?php echo $category['children'][$i]['href']; ?>';"><?php echo $category['children'][$i]['name']; ?></a></li>
																						<?php } ?>
																						<?php } ?>
																						</ul>
																					</div>
																				</div>
																				<?php } ?>
																			</div>
																		</div>
																	</div>
					               								<?php } ?>
					               							</li>
					               						<?php } ?>
					               					</ul>
					               				</div>
					               			</div>
					               		</div>
					               </div>
					               <?php
					               }
					               ?>
					          </div>
					     </div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Top of pages -->

		<!-- Top of pages mobile-->
		<div id="top" class="menu-mobile <?php if($theme_options->get( 'header_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>" style="display: none;">
			<div class="background-top"></div>
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern">
					<div class="container">
					     <div class="sticky-header is-sticky">
						 	<div class="col-xs-1 menu-principal">
								<div class="main-menu">
									<?php 
									$menu = $modules->getModules('menu');
									if( count($menu) ) {
										foreach ($menu as $module) { echo $module; }
									} elseif($categories) {
									?>
										<div class="container-megamenu container horizontal">
											<div class="megaMenuToggle">
												<div class="megamenuToogle-wrapper">
													<div class="megamenuToogle-pattern">
														<div class="container">
															<div>
																<span></span><span></span><span></span>
															</div>
															MENU
														</div>
													</div>
												</div>
											</div>
					               	
					               			<div class="megamenu-wrapper">
					               				<div class="megamenu-pattern">
					               					<div class="container">
					               						<ul class="megamenu shift-up linea-387">
					               							<?php foreach ($categories as $category) { ?>
					               								<?php if ($category['children']) { ?>
					               									<li class="with-sub-menu hover"><p class="close-menu"></p><p class="open-menu"></p>
					               										<a href="<?php echo $category['href'];?>" style="border-bottom: 1px solid grey;"><span><strong><?php echo $category['name']; ?> 391</strong></span></a>
					               								<?php } else { ?>
																	<li>
					               										<a href="<?php echo $category['href']; ?>" style="border-bottom: 1px solid grey;"><span><strong><?php echo $category['name']; ?> 394</strong></span></a>
					               								<?php } ?>
					               								<?php if ($category['children']) { ?>
																	<?php 
																		$width = '100%';
																		$row_fluid = 3;
																		if($category['column'] == 1) { $width = '270px'; $row_fluid = 12; }
																		if($category['column'] == 2) { $width = '500px'; $row_fluid = 6; }
																		if($category['column'] == 3) { $width = '700px'; $row_fluid = 4; }
																	?>
																	<div class="sub-menu" style="width: <?php echo $width; ?>">
																		<div class="content">
																			<p class="arrow"></p>
																			<div class="row hover-menu">
																				<?php for ($i = 0; $i < count($category['children']);) { ?>
																				<div class="col-sm-<?php echo $row_fluid; ?> mobile-enabled">
																					<div class="menu">
																						<ul>
																						<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
																						<?php for (; $i < $j; $i++) { ?>
																						<?php if (isset($category['children'][$i])) { ?>
																						<li><a href="<?php echo $category['children'][$i]['href']; ?>" onclick="window.location = '<?php echo $category['children'][$i]['href']; ?>';"><?php echo $category['children'][$i]['name']; ?></a></li>
																						<?php } ?>
																						<?php } ?>
																						</ul>
																					</div>
																				</div>
																				<?php } ?>
																			</div>
																		</div>
																	</div>
					               								<?php } ?>
					               							</li>
					               						<?php } ?>
														<li>
															<a href="#" >
																<span><strong>NEWSLETTER</strong></span>
															</a>
														</li>
					               					</ul>
					               				</div>
					               			</div>
					               		</div>
					               </div>
					               <?php
					               }
					               ?>
					          </div>
							</div>
						 	<div class="col-xs-8 imagen-del-logo">
								<div class="logo-home" style="margin-top: 15px;">
									<?php if ($logo) { ?>
										<a href="<?php echo $home; ?>"><span><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></span></a>
									<?php } ?>
								</div>
							</div>		

							<div class="col-xs-1 imagen-corazon">
								<a href="http://www.argentina.tulocalonline.com/edit/index.php?route=account/wishlist">
									<span class="icon-cart"><i class="icon-heart icons"></i></span>
								</a>
							</div>

							<div class="col-xs-1 imagen-bolsa">
								<div class="sticky-cart">
									<?php echo $cart; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- END Top of pages -->
	</div>
	
	<?php $slideshow = $modules->getModules('slideshow'); ?>
	<?php  if(count($slideshow)) { ?>
	<!-- Slider -->
	<div id="slider" class="<?php if($theme_options->get( 'slideshow_layout' ) == 2) { echo 'fixed'; } else { echo 'full-width'; } ?>">
		<div class="background-slider"></div>
		<div class="background">
			<div class="shadow"></div>
			<div class="pattern">
				<?php foreach($slideshow as $module) { ?>
				<?php echo $module; ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<script>
		$(window).load(function() {    
			cambiarImagen();			
			$(window).resize(function () {
				cambiarImagen()
			});
		});
		function cambiarImagen(){
			//return;
			var viewportWidth = $(window).width();
			var imagen = "image/catalog/BANNERS/2019/WL_Web_Banner_Shop.jpg";
			if (viewportWidth < 768) {
				imagen = "image/catalog/BANNERS/2019/WL_WebMobile_Home_Banner_Carrusel_1080x1272.png";
				$(".menu-desktop").hide();
				$(".menu-mobile").show();
			}else{
				$(".menu-desktop").show();
				$(".menu-mobile").hide();
			}
			//$("#slider .camera_slider .owl-item img").attr("src",imagen);
		}
	</script>
</header>


<!-- POP UP LOGIN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script>
function openLoginPopUp(event) {
	event.preventDefault();
	$("#dialog-login").modal({ closeClass: 'icon-remove', closeText: 'X' });
}
</script>

<div id="dialog-login" class="" title="Login" style="display:none">
	<form action="index.php?route=account/login" method="post" enctype="multipart/form-data">
		<div class="titulo">Acced&eacute; a tu cuenta</div>
		<div class="text-box-email">
			<input name="email" type="text" id="mail-text" placeholder="Inges&aacute; tu email"  class="input-text email required-entry validate-email">
		</div>
		<div class="text-box-password">
			<input name="password" type="password" id="mail-password" placeholder="Inges&aacute; tu email"  class="input-text email required-entry validate-email">
		</div>
		<div class="olvidaste-contrasenia"><u>¿Olvidaste tu contrase&ntilde;a?</u></div>
		<div class="button-box">
			<button class="hover-effect07 subscribebutton" type="submit" title="Ingresar"><span>Ingresar</span></button>
		</div>
		<div class="pie">
			<b>¿Aún no ten&eacute;s tu usuario?</b>
			<a href="index.php?route=account/register"><u>Registrate ahora</u></a>
		</div>
	</form>
</div>



<style>
	#dialog-login .button-box button{
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
    	width: 150px;
	}
	#dialog-login .texto1{
		padding-top: 10px;
		color: aliceblue;
		font-size: 30px;
	}
	#dialog-login .titulo, #dialog-login .texto1, #dialog-login .texto2, #dialog-login .text-box, #dialog-login .button-box{
		padding-left: 30px;
		font-family: auto;
	}
     #dialog-login .imagen img{
         width: 500px;
     }
	#dialog-login .titulo{
		font-size: 25px;
		font-style: italic;
    	padding-top: 55px;
	}
	#dialog-login{
		max-width: 500px;
		background-color: #f1e9e7;
		z-index: 15;
		height: inherit;
		overflow: initial;
		padding: 0px;
		text-align: center;
	}
	.blocker{ z-index: 10; }
	#dialog-login a.close-modal[class*="icon-"] {
		top: -2px;
		right: 22px;
		width: 20px;
		height: 20px;
		color: #df7d5c;
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
</style>