<?php 

$language_id = 2;
foreach($data['languages'] as $language) {
	if($language['language_id'] != 1) {
		$language_id = $language['language_id'];
	}
}

$output = array();
$output["custom_module_module"] = array (
  1 => 
  array (
    'type' => '2',
    'block_heading' => 
    array (
      $language_id => '',
      1 => '',
    ),
    'block_content' => 
    array (
      $language_id => '<p><br></p>',
      1 => '<p><br></p>',
    ),
    'html' => 
    array (
      $language_id => '<div class="home2-block-phone-email"><span class="icon_phone">&nbsp;&nbsp;</span>Call Us: <strong>+84 987 654 321</strong> &nbsp;&nbsp;|&nbsp;&nbsp; <span class="icon_mail">&nbsp;&nbsp;</span> Email: support@yourdomain.com</div>',
      1 => '<div class="home2-block-phone-email"><span class="icon_phone">&nbsp;&nbsp;</span>Call Us: <strong>+84 987 654 321</strong> &nbsp;&nbsp;|&nbsp;&nbsp; <span class="icon_mail">&nbsp;&nbsp;</span> Email: support@yourdomain.com</div>',
    ),
    'layout_id' => '99999',
    'position' => 'top_block',
    'status' => '1',
    'sort_order' => '',
  ),
  2 => 
  array (
    'type' => '2',
    'block_heading' => 
    array (
      $language_id => '',
      1 => '',
    ),
    'block_content' => 
    array (
      $language_id => '<p><br></p>',
      1 => '<p><br></p>',
    ),
    'html' => 
    array (
      $language_id => '<div class="main-slide-inner">
     <div class="main-carousel">
                         <div id="main-slider" class="owl-carousel">
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel1.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Accesories</div>
                                             <div class="text-large h3">Best collections<br />for autumn</div>
                                             <div class="text-normal">Sunglasses is the best design of Artist Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Discover Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel2.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Men&rsquo;s Clothing</div>
                                             <div class="text-large h3">Giordanor<br />shirt</div>
                                             <div class="text-normal">Giordanr Shirt is the best design of Artist Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Shop Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel3.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Men&rsquo;s Shoes</div>
                                             <div class="text-large h3">Alexsandro luigi<br />shoes</div>
                                             <div class="text-normal">Alexsandro Luigi shoes is the best design of Artist Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Explore Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel4.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Women&rsquo;s clothing</div>
                                             <div class="text-large h3">Mega sale up to 50% off for all</div>
                                             <div class="text-normal">Logancee will open mega sale up to 50% off for all women&rsquo;s clothing in 3 days</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Explore Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel5.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Accesories</div>
                                             <div class="text-large h3">Black sunglasses<br />for men</div>
                                             <div class="text-normal">Rayban Black Sunglasses is the best design of Art Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Explore Now</span></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
     </div>
</div>

<script type="text/javascript">
     $(document).ready(function() {
       var owl = $("#main-slider");
       owl.owlCarousel({
            items: 4,
itemsDesktop : [1199,3],
           navigation : true,
direction: \'rtl\',
           navigationText: [\'<i class="fa fa-angle-left"></i>\', \'<i class="fa fa-angle-right"></i>\']
       });
     });
</script>',
      1 => '<div class="main-slide-inner">
     <div class="main-carousel">
                         <div id="main-slider" class="owl-carousel">
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel1.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Accesories</div>
                                             <div class="text-large h3">Best collections<br />for autumn</div>
                                             <div class="text-normal">Sunglasses is the best design of Artist Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Discover Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel2.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Men&rsquo;s Clothing</div>
                                             <div class="text-large h3">Giordanor<br />shirt</div>
                                             <div class="text-normal">Giordanr Shirt is the best design of Artist Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Shop Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel3.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Men&rsquo;s Shoes</div>
                                             <div class="text-large h3">Alexsandro luigi<br />shoes</div>
                                             <div class="text-normal">Alexsandro Luigi shoes is the best design of Artist Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Explore Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel4.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Women&rsquo;s clothing</div>
                                             <div class="text-large h3">Mega sale up to 50% off for all</div>
                                             <div class="text-normal">Logancee will open mega sale up to 50% off for all women&rsquo;s clothing in 3 days</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Explore Now</span></a>
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="block-content clearfix">
                                   <div class="slide-carousel">
                                        <img class="img-responsive" alt="" src="image/catalog/slider_carousel5.jpg" />
                                        <div class="carousel-content block-center">
                                             <div class="text-small h3">Accesories</div>
                                             <div class="text-large h3">Black sunglasses<br />for men</div>
                                             <div class="text-normal">Rayban Black Sunglasses is the best design of Art Alex Goot. You should got it for your style</div>
                                             <a class="btn-ex hover-effect02" href="#"><span>Explore Now</span></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
     </div>
</div>

<script type="text/javascript">
     $(document).ready(function() {
       var owl = $("#main-slider");
       owl.owlCarousel({
            items: 4,
itemsDesktop : [1199,3],
           navigation : true,
           navigationText: [\'<i class="fa fa-angle-left"></i>\', \'<i class="fa fa-angle-right"></i>\']
       });
     });
</script>',
    ),
    'layout_id' => '1',
    'position' => 'slideshow',
    'status' => '1',
    'sort_order' => '',
  ),
  3 => 
  array (
    'type' => '2',
    'block_heading' => 
    array (
      $language_id => '',
      1 => '',
    ),
    'block_content' => 
    array (
      $language_id => '<p><br></p>',
      1 => '<p><br></p>',
    ),
    'html' => 
    array (
      $language_id => '<div style="height: 50px"></div>',
      1 => '<div style="height: 50px"></div>',
    ),
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '14',
  ),
  4 => 
  array (
    'type' => '2',
    'block_heading' => 
    array (
      $language_id => '',
      1 => '',
    ),
    'block_content' => 
    array (
      $language_id => '<p><br></p>',
      1 => '<p><br></p>',
    ),
    'html' => 
    array (
      $language_id => '<div class="block-welcome">
     <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="main-heading">
                    <div class="heading-title">
                         <h2 class="title-block"><span>Welcome to logancee store</span></h2>
                    </div>
               </div>
               
               <div class="text-block"><span>We’re a team of creative and make amazing site in ecommerce from Unite States. We love colour pastel, highlight and simple, its make our design look so awesome</span></div>
          </div>
          
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <div class="block-icon">
                    <div class="block-center">
                         <span class="icon_pin_alt"><span class="text-hidden">&nbsp;</span></span>
                         <h3 class="title">Free Shipping</h3>
                         <div class="text">Free for all over oder $99.00</div>
                    </div>
               </div>
          </div>
          
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <div class="block-icon block-icon2">
                    <div class="block-center">
                         <span class="icon_currency"><span class="text-hidden">&nbsp;</span></span>
                         <h3 class="title">Money back</h3>
                         <div class="text">100% Money Back - 30 days</div>
                    </div>
               </div>
          </div>
          
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <div class="block-icon">
                    <div class="block-center">
                         <span class="icon_comment_alt"><span class="text-hidden">&nbsp;</span></span>
                         <h3 class="title">24h support</h3>
                         <div class="text">Service support fast 24/7</div>
                    </div>
               </div>
          </div>
     </div>
</div>',
      1 => '<div class="block-welcome">
     <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="main-heading">
                    <div class="heading-title">
                         <h2 class="title-block"><span>Welcome to logancee store</span></h2>
                    </div>
               </div>
               
               <div class="text-block"><span>We’re a team of creative and make amazing site in ecommerce from Unite States. We love colour pastel, highlight and simple, its make our design look so awesome</span></div>
          </div>
          
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <div class="block-icon">
                    <div class="block-center">
                         <span class="icon_pin_alt"><span class="text-hidden">&nbsp;</span></span>
                         <h3 class="title">Free Shipping</h3>
                         <div class="text">Free for all over oder $99.00</div>
                    </div>
               </div>
          </div>
          
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <div class="block-icon block-icon2">
                    <div class="block-center">
                         <span class="icon_currency"><span class="text-hidden">&nbsp;</span></span>
                         <h3 class="title">Money back</h3>
                         <div class="text">100% Money Back - 30 days</div>
                    </div>
               </div>
          </div>
          
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <div class="block-icon">
                    <div class="block-center">
                         <span class="icon_comment_alt"><span class="text-hidden">&nbsp;</span></span>
                         <h3 class="title">24h support</h3>
                         <div class="text">Service support fast 24/7</div>
                    </div>
               </div>
          </div>
     </div>
</div>',
    ),
    'layout_id' => '1',
    'position' => 'preface_fullwidth',
    'status' => '1',
    'sort_order' => '0',
  ),
); 

$this->model_setting_setting->editSetting( "custom_module", $output );	

?>