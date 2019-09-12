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
      $language_id => '<div class="home-bags-footer">
     (0884) 906 39456 <span>|</span> 123 New Design St, Melbourne, Australia <span>|</span> support.logancee@gmail.com
</div>',
      1 => '<div class="home-bags-footer">
     (0884) 906 39456 <span>|</span> 123 New Design St, Melbourne, Australia <span>|</span> support.logancee@gmail.com
</div>',
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
      $language_id => '<div style="height: 125px"></div>',
      1 => '<div style="height: 125px"></div>',
    ),
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '222',
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
      $language_id => '<div class="sidebar-footer">
     <ul class="social-icons hide-text">
          <li class="twitter"><a href="http://www.twitter.com/" target="_blank"><i class="fa fa-twitter"><span>Twitter</span></i></a></li>
          <li class="facebook"><a href="http://www.facebook.com/" target="_blank"><i class="fa fa-facebook"><span>Facebook</span></i></a></li>
          <li class="gplus"><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"><span>Google plus</span></i></a></li>
          <li class="instagram"><a href="https://instagram.com/" target="_blank"><i class="fa fa-instagram"><span>Instagram</span></i></a></li>
          <li class="pinterest"><a href="https://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest-p"><span>pinterest square</span></i></a></li>
     </ul>
     <div class="sidebar-footer-content visible-lg">© By LOGANCEE. All Rights Reserved</div>
</div>',
      1 => '<div class="sidebar-footer">
     <ul class="social-icons hide-text">
          <li class="twitter"><a href="http://www.twitter.com/" target="_blank"><i class="fa fa-twitter"><span>Twitter</span></i></a></li>
          <li class="facebook"><a href="http://www.facebook.com/" target="_blank"><i class="fa fa-facebook"><span>Facebook</span></i></a></li>
          <li class="gplus"><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"><span>Google plus</span></i></a></li>
          <li class="instagram"><a href="https://instagram.com/" target="_blank"><i class="fa fa-instagram"><span>Instagram</span></i></a></li>
          <li class="pinterest"><a href="https://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest-p"><span>pinterest square</span></i></a></li>
     </ul>
     <div class="sidebar-footer-content visible-lg">© By LOGANCEE. All Rights Reserved</div>
</div>',
    ),
    'layout_id' => '99999',
    'position' => 'top_block',
    'status' => '1',
    'sort_order' => '3',
  ),
); 

$this->model_setting_setting->editSetting( "custom_module", $output );	

?>