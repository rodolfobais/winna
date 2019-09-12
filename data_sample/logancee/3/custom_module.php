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
      $language_id => '<footer class="footer-container fluid-width-footer">
     <div class="container">
          <div class="footer-inner">
               <div class="footer-top">
                    <div class="footer-top-inner clearfix">
                         <div class="widget-block">
                              <div class="block-static row">
                                   <div class="block-wrap">
                                        <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                                             <div class="home03-footer">
                                                  <div class="footer-logo"><img alt="" src="image/catalog/logo-logancee.png"></div>
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
      1 => '<footer class="footer-container fluid-width-footer">
     <div class="container">
          <div class="footer-inner">
               <div class="footer-top">
                    <div class="footer-top-inner clearfix">
                         <div class="widget-block">
                              <div class="block-static row">
                                   <div class="block-wrap">
                                        <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                                             <div class="home03-footer">
                                                  <div class="footer-logo"><img alt="" src="image/catalog/logo-logancee.png"></div>
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
      $language_id => '<div class="block-static row" style="margin-top: 30px">
     <div class="block-wrap">
          <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
               <div class="block-top-01">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <div class="content-block">
                              <h2><span> welcome to <br>logancee store</span></h2>
                              <p class="desc std">We’re a team of creative and make amazing site in ecommerce from Unite States.<br>We love colour pastel, its make our designlook so awesome.<br> Now ! come here and create fashion trending with us</p>
                         </div>
                    </div>
                    
                    <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <img alt="" src="image/catalog/block_01.jpg">
                    </div>
               </div>
          </div>
          
          <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
               <div class="block-top-02">
                    <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <img alt="" src="image/catalog/block_02.jpg">
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <div class="content-block">
                              <h2><span> leather bags <br>collection for men</span></h2>
                              <p class="desc std">Collection leather bags by designer C-Knightz brought a new fashion trend for men elegance and courtesy. Combined with material from the leather luxury category and also meticulous in every detail of the product, this collection deserves a perfect choice for fashionable gentlemen..</p>
                              <div class="bottom"><a class="hover-effect07" href="#"><span>explore now</span></a></div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>',
      1 => '<div class="block-static row" style="margin-top: 30px">
     <div class="block-wrap">
          <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
               <div class="block-top-01">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <div class="content-block">
                              <h2><span> welcome to <br>logancee store</span></h2>
                              <p class="desc std">We’re a team of creative and make amazing site in ecommerce from Unite States.<br>We love colour pastel, its make our designlook so awesome.<br> Now ! come here and create fashion trending with us</p>
                         </div>
                    </div>
                    
                    <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <img alt="" src="image/catalog/block_01.jpg">
                    </div>
               </div>
          </div>
          
          <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
               <div class="block-top-02">
                    <div class="images col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <img alt="" src="image/catalog/block_02.jpg">
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                         <div class="content-block">
                              <h2><span> leather bags <br>collection for men</span></h2>
                              <p class="desc std">Collection leather bags by designer C-Knightz brought a new fashion trend for men elegance and courtesy. Combined with material from the leather luxury category and also meticulous in every detail of the product, this collection deserves a perfect choice for fashionable gentlemen..</p>
                              <div class="bottom"><a class="hover-effect07" href="#"><span>explore now</span></a></div>
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
    'sort_order' => '0',
  ),
); 

$this->model_setting_setting->editSetting( "custom_module", $output );	

?>