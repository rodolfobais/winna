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
      $language_id => '',
      1 => '<p><br></p>',
    ),
    'html' => 
    array (
      $language_id => '<div class="home2-block-phone-email"><span class="icon_phone">  </span>Call Us: <strong>+84 987 654 321</strong>   |   <span class="icon_mail">  </span> Email: support@yourdomain.com</div>',
      1 => '<div class="home2-block-phone-email"><span class="icon_phone">  </span>Call Us: <strong>+84 987 654 321</strong>   |   <span class="icon_mail">  </span> Email: support@yourdomain.com</div>',
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
      $language_id => '',
      1 => '',
    ),
    'html' => 
    array (
      $language_id => '<div class="sunglasses-footer">
     <div class="full-width">
          <div class="container">
               <div class="row panels">
                    <div class="col-sm-4">
                         <h4>About us</h4>
                         <div class="panel-content">
                              Logancee is a Premium OpenCart Template.<br />Best choice for your online store. Let<br />purchase it to enjoy now.
                         </div>
                    </div>
                    
                    <div class="col-sm-4">
                         <h4>Opening times</h4>
                         <div class="panel-content">
                              Monday - Friday<br />8:00 - 18:00<br />Saturday - closed
                         </div>
                    </div>
                    
                    <div class="col-sm-4">
                         <h4>Contact</h4>
                         <div class="panel-content">
                              123 New Design Str, Melbourne, Australia<br />(0044) 8647 1234 587<br />contact@eprotheme.com
                         </div>
                    </div>
               </div>
               
               <div class="share">
                    <h4>Follow us on</h4>
                    <ul>
                         <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li class="face"><a href="#"><i class="fa fa-facebook"></i></a></li>
                         <li class="google"><a href="#"><i class="fa fa-google"></i></a></li>
                         <li class="star"><a href="#"><i class="fa fa-instagram"></i></a></li>
                         <li class="printer"><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
               </div>
          </div>
     </div>
     
     <div class="copyright text-center">© 2016 <a href="#">LOGANCEE</a>. All Rights Reserved</div>
</div>',
      1 => '<div class="sunglasses-footer">
     <div class="full-width">
          <div class="container">
               <div class="row panels">
                    <div class="col-sm-4">
                         <h4>About us</h4>
                         <div class="panel-content">
                              Logancee is a Premium OpenCart Template.<br />Best choice for your online store. Let<br />purchase it to enjoy now.
                         </div>
                    </div>
                    
                    <div class="col-sm-4">
                         <h4>Opening times</h4>
                         <div class="panel-content">
                              Monday - Friday<br />8:00 - 18:00<br />Saturday - closed
                         </div>
                    </div>
                    
                    <div class="col-sm-4">
                         <h4>Contact</h4>
                         <div class="panel-content">
                              123 New Design Str, Melbourne, Australia<br />(0044) 8647 1234 587<br />contact@eprotheme.com
                         </div>
                    </div>
               </div>
               
               <div class="share">
                    <h4>Follow us on</h4>
                    <ul>
                         <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li class="face"><a href="#"><i class="fa fa-facebook"></i></a></li>
                         <li class="google"><a href="#"><i class="fa fa-google"></i></a></li>
                         <li class="star"><a href="#"><i class="fa fa-instagram"></i></a></li>
                         <li class="printer"><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
               </div>
          </div>
     </div>
     
     <div class="copyright text-center">© 2016 <a href="#">LOGANCEE</a>. All Rights Reserved</div>
</div>',
    ),
    'layout_id' => '99999',
    'position' => 'footer2',
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
      $language_id => '',
      1 => '',
    ),
    'html' => 
    array (
      $language_id => '<div class="bike-brands">
 <div id="bike-brands" class="owl-carousel">
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-5.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-2.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-3.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-4.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-1.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-5.png" alt=""></a></div>
 </div>
</div>

<script>
$(document).ready(function() {
     var owl = $("#bike-brands");
     owl.owlCarousel({
          itemsCustom : [
               [0, 1],
               [450, 2],
               [600, 3],
               [850, 4],
               [1100, 5]
         ],
direction: rtl
    });
});
</script>',
      1 => '<div class="bike-brands">
 <div id="bike-brands" class="owl-carousel">
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-5.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-2.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-3.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-4.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-1.png" alt=""></a></div>
     <div class="item"><a href="#"><img src="image/catalog/bike-brand-5.png" alt=""></a></div>
 </div>
</div>

<script>
$(document).ready(function() {
     var owl = $("#bike-brands");
     owl.owlCarousel({
          itemsCustom : [
               [0, 1],
               [450, 2],
               [600, 3],
               [850, 4],
               [1100, 5]
         ]
    });
});
</script>',
    ),
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '10',
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
      $language_id => '',
      1 => '',
    ),
    'html' => 
    array (
      $language_id => '<div class="welcome-block">
     <div class="main-heading">
          <div class="heading-title">
               <h2 class="title-block"><span class="grey-text">Welcome to</span><span> logancee</span></h2>
          </div>
          <div class="text-block"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nunc sem, luctus et enim sit amet, ultrices<br>Nam non fringilla mauris. Aenean dictum nisi ut tellus porta viverra</span></div>
          <div class="row">
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 hidden-xs">
                    <div class="left-welcome">
                         <img class="img-responsive" alt="" src="image/catalog/left-welcome.jpg">
                         <div class="welcome-content">
                              <h4 class="wtitle">New Arrival</h4>
                              <div class="wcontent">Shaving <br>Equiment <br>Wood</div>
                         </div>
                    </div>
               </div>
               
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="center-welcome">
                         <img class="img-responsive" alt="" src="image/catalog/center-welcome.jpg">
                         <div class="welcome-content">
                              <h4 class="wtitle">Hot Promotion</h4>
                              <div class="wcontent2">Save Up To<br><span class="cyan-text">20%</span> off</div>
                              <div class="sub-wcontent">
                                   <p class="hidden-xs hidden-sm">Louis Hairstylist Academy<br>sale up to <span class="black-text">20%</span> off for barber<br>course. Your receive:</p>
                                   <ul>
                                        <li>Baber Certification</li>
                                        <li>01 Set Baber Tool</li>
                                        <li>Voucher 10% Off</li>
                                   </ul>
                                   <a class="h5 button btn-continue" href="#"><span><span class="text-btn">buy now</span></span></a>
                              </div>
                         </div>
                    </div>
               </div>
               
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 hidden-xs">
                    <div class="right-welcome">
                         <img class="img-responsive" alt="" src="image/catalog/right-welcome.jpg">
                         <div class="welcome-content">
                              <h4 class="wtitle">Hot Product</h4>
                              <div class="wcontent">Wax Box<br>Superiority<br>Of Barber.</div>
                              <div class="wlink"><a href="#">Shop Now<span class="arrow_right">&nbsp;</span></a></div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>',
      1 => '<div class="welcome-block">
     <div class="main-heading">
          <div class="heading-title">
               <h2 class="title-block"><span class="grey-text">Welcome to</span><span> logancee</span></h2>
          </div>
          <div class="text-block"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nunc sem, luctus et enim sit amet, ultrices<br>Nam non fringilla mauris. Aenean dictum nisi ut tellus porta viverra</span></div>
          <div class="row">
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 hidden-xs">
                    <div class="left-welcome">
                         <img class="img-responsive" alt="" src="image/catalog/left-welcome.jpg">
                         <div class="welcome-content">
                              <h4 class="wtitle">New Arrival</h4>
                              <div class="wcontent">Shaving <br>Equiment <br>Wood</div>
                         </div>
                    </div>
               </div>
               
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="center-welcome">
                         <img class="img-responsive" alt="" src="image/catalog/center-welcome.jpg">
                         <div class="welcome-content">
                              <h4 class="wtitle">Hot Promotion</h4>
                              <div class="wcontent2">Save Up To<br><span class="cyan-text">20%</span> off</div>
                              <div class="sub-wcontent">
                                   <p class="hidden-xs hidden-sm">Louis Hairstylist Academy<br>sale up to <span class="black-text">20%</span> off for barber<br>course. Your receive:</p>
                                   <ul>
                                        <li>Baber Certification</li>
                                        <li>01 Set Baber Tool</li>
                                        <li>Voucher 10% Off</li>
                                   </ul>
                                   <a class="h5 button btn-continue" href="#"><span><span class="text-btn">buy now</span></span></a>
                              </div>
                         </div>
                    </div>
               </div>
               
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 hidden-xs">
                    <div class="right-welcome">
                         <img class="img-responsive" alt="" src="image/catalog/right-welcome.jpg">
                         <div class="welcome-content">
                              <h4 class="wtitle">Hot Product</h4>
                              <div class="wcontent">Wax Box<br>Superiority<br>Of Barber.</div>
                              <div class="wlink"><a href="#">Shop Now<span class="arrow_right">&nbsp;</span></a></div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>',
    ),
    'layout_id' => '1',
    'position' => 'preface_fullwidth',
    'status' => '1',
    'sort_order' => '1',
  ),
); 

$this->model_setting_setting->editSetting( "custom_module", $output );	

?>