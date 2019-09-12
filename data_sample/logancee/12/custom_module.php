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
      $language_id => '<footer class="footer-container fluid-width-footer home-shoes-footer">
     <div class="container">
          <div class="footer-inner">
               <div class="footer-top">
                    <div class="footer-top-inner clearfix">
                         <div class="widget-block">
                              <div class="block-static row">
                                   <div class="block-wrap">
                                        <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                                             <div class="home03-footer">
                                                  <div class="footer-logo"><img alt="" src="image/catalog/logo_1.png"></div>
                                                  <ul class="social-icons h4">
                                                       <li class="facebook"><a href="http://www.facebook.com/" target="_blank"><span>Facebook</span></a></li>
                                                       <li class="twitter"><a href="http://www.twitter.com/" target="_blank"><span>Twitter</span></a></li>
                                                       <li class="pinterest"><a href="https://www.pinterest.com/" target="_blank"><span>pinterest square</span></a></li>
                                                       <li class="gplus"><a href="https://plus.google.com/" target="_blank"><span>Google +</span></a></li>
                                                       <li class="instagram"><a href="https://instagram.com/" target="_blank"><span>Instagram</span></a></li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               
               <div class="footer-copyright">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">© 2016 <a href="#">Logancee</a>. All Rights Reserved.</div>
                    </div>
               </div>
          </div
     </div>
</footer>',
      1 => '<footer class="footer-container fluid-width-footer home-shoes-footer">
     <div class="container">
          <div class="footer-inner">
               <div class="footer-top">
                    <div class="footer-top-inner clearfix">
                         <div class="widget-block">
                              <div class="block-static row">
                                   <div class="block-wrap">
                                        <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                                             <div class="home03-footer">
                                                  <div class="footer-logo"><img alt="" src="image/catalog/logo_1.png"></div>
                                                  <ul class="social-icons h4">
                                                       <li class="facebook"><a href="http://www.facebook.com/" target="_blank"><span>Facebook</span></a></li>
                                                       <li class="twitter"><a href="http://www.twitter.com/" target="_blank"><span>Twitter</span></a></li>
                                                       <li class="pinterest"><a href="https://www.pinterest.com/" target="_blank"><span>pinterest square</span></a></li>
                                                       <li class="gplus"><a href="https://plus.google.com/" target="_blank"><span>Google +</span></a></li>
                                                       <li class="instagram"><a href="https://instagram.com/" target="_blank"><span>Instagram</span></a></li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               
               <div class="footer-copyright">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">© 2016 <a href="#">Logancee</a>. All Rights Reserved.</div>
                    </div>
               </div>
          </div
     </div>
</footer>',
    ),
    'layout_id' => '99999',
    'position' => 'footer2',
    'status' => '1',
    'sort_order' => '2',
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
      $language_id => '<div class="widget-block">
     <div class="block-static row">
          <div class="block-wrap">
               <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                    <div class="block-top-01 block-cd">
                         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                              <div class="content-block">
                                   <h2><span>super sale up to <span class="price" style="color: #cc0000;font-family: Lato">50%</span> off for shoes</span></h2>
                                   <p class="desc std">Logancee Store glad to show that we’ll open <strong>super sale up to 50% off</strong> for shoes to welcome the Valentine\'s Day.</p>
                                   <a class="h5 button btn-continue" href="#"><span><span class="text-btn">grab it now</span></span></a>
                              </div>
                         </div>
                         
                         <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding"><img alt="" src="image/catalog/home12-img-block1.jpg"></div>
                    </div>
               </div>
          
               <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                    <div class="block-top-02 block-cd">
                         <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                              <img alt="" src="image/catalog/home12-img-block2.jpg">
                              <div class="content-block">
                                   <h2><a href="#">RED WING</a></h2>
                                   <div class="desc std"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam facilisis diam sed tellus cursus, quis dictum erat pellentesque.</strong></div>
                              </div>
                         </div>
                         
                         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                              <div class="content-block">
                                   <h2>buy red wing shoes just <span class="price" style="color: #cc0000;font-family: Lato">$99</span></h2>
                                   <p class="desc std">Today we glad to notice that you can buy cigarette pipe with price <strong>just $99. Grab it now !</strong></p>
                                   <a class="h5 button btn-continue" href="#"><span><span class="text-btn">shop now</span></span></a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>',
      1 => '<div class="widget-block">
     <div class="block-static row">
          <div class="block-wrap">
               <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                    <div class="block-top-01 block-cd">
                         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                              <div class="content-block">
                                   <h2><span>super sale up to <span class="price" style="color: #cc0000;font-family: Lato">50%</span> off for shoes</span></h2>
                                   <p class="desc std">Logancee Store glad to show that we’ll open <strong>super sale up to 50% off</strong> for shoes to welcome the Valentine\'s Day.</p>
                                   <a class="h5 button btn-continue" href="#"><span><span class="text-btn">grab it now</span></span></a>
                              </div>
                         </div>
                         
                         <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding"><img alt="" src="image/catalog/home12-img-block1.jpg"></div>
                    </div>
               </div>
          
               <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                    <div class="block-top-02 block-cd">
                         <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                              <img alt="" src="image/catalog/home12-img-block2.jpg">
                              <div class="content-block">
                                   <h2><a href="#">RED WING</a></h2>
                                   <div class="desc std"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam facilisis diam sed tellus cursus, quis dictum erat pellentesque.</strong></div>
                              </div>
                         </div>
                         
                         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                              <div class="content-block">
                                   <h2>buy red wing shoes just <span class="price" style="color: #cc0000;font-family: Lato">$99</span></h2>
                                   <p class="desc std">Today we glad to notice that you can buy cigarette pipe with price <strong>just $99. Grab it now !</strong></p>
                                   <a class="h5 button btn-continue" href="#"><span><span class="text-btn">shop now</span></span></a>
                              </div>
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
    'sort_order' => '2',
  ),
); 

$this->model_setting_setting->editSetting( "custom_module", $output );	

?>