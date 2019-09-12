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
      $language_id => '<div style="height: 65px"></div>',
      1 => '<div style="height: 65px"></div>',
    ),
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '222',
  ),
); 

$this->model_setting_setting->editSetting( "custom_module", $output );	

?>