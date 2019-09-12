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
      $language_id => '<p><br></p>',
      1 => '<p><br></p>',
    ),
    'html' => 
    array (
      $language_id => '<div style="height: 42px"></div>',
      1 => '<div style="height: 42px"></div>',
    ),
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '25',
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
      $language_id => '<div class="row">
     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="block-static-top">
               <div class="block-img" style="background-image: url(\'image/catalog/bann_01.jpg\');">&nbsp;</div>
               <div class="text-wrap">
                    <h2 class="title">BEST<br>FOR <br>GIRL</h2>
                    <a class="h4" href="#">Shop Now <span class="arrow_right">&nbsp;</span></a>
               </div>
          </div>
     </div>
     
     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="block-static-top">
               <div class="block-img" style="background-image: url(\'image/catalog/bann_02.jpg\');">&nbsp;</div>
               <div class="text-wrap">
                    <h2 class="title">BEST <br> FOR <br> BOYS</h2>
                    <a class="h4" href="#">Shop Now <span class="arrow_right">&nbsp;</span></a>
               </div>
          </div>
     </div>
     
     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="block-static-top">
               <div class="block-img" style="background-image: url(\'image/catalog/bann_03.jpg\');">&nbsp;</div>
               <div class="text-wrap">
                    <h2 class="title">BIG <br> SALE <br> 50%</h2>
                    <a class="h4" href="#">Shop Now <span class="arrow_right">&nbsp;</span></a>
               </div>
          </div>
     </div>
</div>',
      1 => '<div class="row">
     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="block-static-top">
               <div class="block-img" style="background-image: url(\'image/catalog/bann_01.jpg\');">&nbsp;</div>
               <div class="text-wrap">
                    <h2 class="title">BEST<br>FOR <br>GIRL</h2>
                    <a class="h4" href="#">Shop Now <span class="arrow_right">&nbsp;</span></a>
               </div>
          </div>
     </div>
     
     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="block-static-top">
               <div class="block-img" style="background-image: url(\'image/catalog/bann_02.jpg\');">&nbsp;</div>
               <div class="text-wrap">
                    <h2 class="title">BEST <br> FOR <br> BOYS</h2>
                    <a class="h4" href="#">Shop Now <span class="arrow_right">&nbsp;</span></a>
               </div>
          </div>
     </div>
     
     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="block-static-top">
               <div class="block-img" style="background-image: url(\'image/catalog/bann_03.jpg\');">&nbsp;</div>
               <div class="text-wrap">
                    <h2 class="title">BIG <br> SALE <br> 50%</h2>
                    <a class="h4" href="#">Shop Now <span class="arrow_right">&nbsp;</span></a>
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