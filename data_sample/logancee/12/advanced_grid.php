<?php 

$language_id = 2;
foreach($data['languages'] as $language) {
	if($language['language_id'] != 1) {
		$language_id = $language['language_id'];
	}
}

$output = array();
$output["advanced_grid_module"] = array (
  1 => 
  array (
    'custom_class' => '',
    'margin_top' => '0',
    'margin_right' => '0',
    'margin_bottom' => '0',
    'margin_left' => '0',
    'padding_top' => '0',
    'padding_right' => '0',
    'padding_bottom' => '0',
    'padding_left' => '0',
    'force_full_width' => '0',
    'background_color' => '#f5f5f5',
    'background_image_type' => '0',
    'background_image' => '',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'scroll',
    'layout_id' => '1',
    'position' => 'preface_fullwidth',
    'status' => '1',
    'sort_order' => '4',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      1 => 
      array (
        'status' => '1',
        'width' => '12',
        'disable_on_mobile' => '0',
        'width_xs' => '1',
        'width_sm' => '1',
        'width_md' => '1',
        'width_lg' => '1',
        'sort' => '1',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'products_tabs',
            'products_tabs' => 
            array (
              'module_layout' => 'home_shoes.tpl',
              'title' => 
              array (
                $language_id => '<span>Best our products</span><span class="bg-word">B</span>',
                1 => '<span>Best our products</span><span class="bg-word">B</span>',
              ),
              'description' => 
              array (
                $language_id => '',
                1 => '',
              ),
              'width' => '540',
              'height' => '714',
              'limit' => '8',
              'products' => 
              array (
                1 => 
                array (
                  'title' => 
                  array (
                    $language_id => 'Best seller',
                    1 => 'Best seller',
                  ),
                  'get_products_from' => 'products',
                  'product' => 's',
                  'products' => '30,28,42,41,43,45,44,46',
                  'category' => '',
                  'categories' => '',
                ),
                2 => 
                array (
                  'title' => 
                  array (
                    $language_id => 'New arrival',
                    1 => 'New arrival',
                  ),
                  'get_products_from' => 'latest',
                  'product' => '',
                  'products' => '',
                  'category' => '',
                  'categories' => '',
                ),
                3 => 
                array (
                  'title' => 
                  array (
                    $language_id => 'Most wanted',
                    1 => 'Most wanted',
                  ),
                  'get_products_from' => 'random',
                  'product' => '',
                  'products' => '',
                  'category' => '',
                  'categories' => '',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  2 => 
  array (
    'custom_class' => 'home-shoes-newsletter',
    'margin_top' => '0',
    'margin_right' => '0',
    'margin_bottom' => '0',
    'margin_left' => '0',
    'padding_top' => '0',
    'padding_right' => '0',
    'padding_bottom' => '0',
    'padding_left' => '0',
    'force_full_width' => '0',
    'background_color' => '#f3f3f3',
    'background_image_type' => '0',
    'background_image' => '',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'scroll',
    'layout_id' => '1',
    'position' => 'customfooter',
    'status' => '1',
    'sort_order' => '1',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      2 => 
      array (
        'status' => '1',
        'width' => '12',
        'disable_on_mobile' => '0',
        'width_xs' => '1',
        'width_sm' => '1',
        'width_md' => '1',
        'width_lg' => '1',
        'sort' => '1',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'newsletter',
            'newsletter' => 
            array (
              'module_layout' => 'default.tpl',
              'title' => 
              array (
                $language_id => 'GET THE LATEST FROM LOGANCEE',
                1 => 'GET THE LATEST FROM LOGANCEE',
              ),
              'text' => 
              array (
                $language_id => 'Sign up for our newsletter !',
                1 => 'Sign up for our newsletter !',
              ),
              'input_placeholder' => 
              array (
                $language_id => 'youremail@domain.com',
                1 => 'youremail@domain.com',
              ),
              'subscribe_text' => 
              array (
                $language_id => 'Subscribe',
                1 => 'Subscribe',
              ),
              'unsubscribe_text' => 
              array (
                $language_id => '',
                1 => '',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  3 => 
  array (
    'custom_class' => '',
    'margin_top' => '0',
    'margin_right' => '0',
    'margin_bottom' => '0',
    'margin_left' => '0',
    'padding_top' => '0',
    'padding_right' => '0',
    'padding_bottom' => '0',
    'padding_left' => '0',
    'force_full_width' => '0',
    'background_color' => '#f0f0f0',
    'background_image_type' => '0',
    'background_image' => '',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'scroll',
    'layout_id' => '1',
    'position' => 'preface_fullwidth',
    'status' => '1',
    'sort_order' => '0',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      3 => 
      array (
        'status' => '1',
        'width' => '12',
        'disable_on_mobile' => '0',
        'width_xs' => '1',
        'width_sm' => '1',
        'width_md' => '1',
        'width_lg' => '1',
        'sort' => '1',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'html',
            'html' => 
            array (
              $language_id => '<div class="widget-block">
     <div class="block-static row">
          <div class="block-wrap">
               <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12  ">
                    <div class="block-welcome block-welcome2">
                         <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                   <div class="main-heading">
                                        <div class="heading-title">
                                             <h2 class="title-block"><span>Welcome to logancee</span></h2>
                                             <span class="bg-word">W</span>
                                        </div>
                                   </div>
                                   
                                   <div class="text-block"><span>We’re a team of creative and make amazing site in ecommerce from Unite States. We love colour pastel, highlight and simple, its make our design look so awesome</span></div>
                              </div>
                              
                              <div class="container">
                                   <div class="row">
                                        <div class="col-xs-12 col-lg-10 col-lg-push-1">
                                             <div class="col-tiny col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                  <div class="block-icon">
                                                       <img alt="Free Shipping" src="image/catalog/bg-block1.jpg">
                                                       <div class="block-center">
                                                            <span class="icon_pin_alt"><span class="text-hidden">&nbsp;</span></span>
                                                            <h3 class="title">Free Shipping</h3>
                                                            <div class="text">Free for all over oder $99.00</div>
                                                       </div>
                                                  </div>
                                             </div>
                                             
                                             <div class="col-tiny col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                  <div class="block-icon">
                                                       <img alt="Money back" src="image/catalog/bg-block2.jpg">
                                                       <div class="block-center">
                                                            <span class="icon_currency"><span class="text-hidden">&nbsp;</span></span>
                                                            <h3 class="title">Money back</h3>
                                                            <div class="text">100% Money Back - 30 days</div>
                                                       </div>
                                                  </div>
                                             </div>
                                             
                                             <div class="col-tiny col-xs-6 col-xs-push-3 col-md-push-0 col-sm-6 col-md-4 col-lg-4">
                                                  <div class="block-icon">
                                                       <img alt="24h support" src="image/catalog/bg-block3.jpg">
                                                       <div class="block-center">
                                                            <span class="icon_comment_alt"><span class="text-hidden">&nbsp;</span></span>
                                                            <h3 class="title">24h support</h3>
                                                            <div class="text">Service support fast 24/7</div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
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
                    <div class="block-welcome block-welcome2">
                         <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                   <div class="main-heading">
                                        <div class="heading-title">
                                             <h2 class="title-block"><span>Welcome to logancee</span></h2>
                                             <span class="bg-word">W</span>
                                        </div>
                                   </div>
                                   
                                   <div class="text-block"><span>We’re a team of creative and make amazing site in ecommerce from Unite States. We love colour pastel, highlight and simple, its make our design look so awesome</span></div>
                              </div>
                              
                              <div class="container">
                                   <div class="row">
                                        <div class="col-xs-12 col-lg-10 col-lg-push-1">
                                             <div class="col-tiny col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                  <div class="block-icon">
                                                       <img alt="Free Shipping" src="image/catalog/bg-block1.jpg">
                                                       <div class="block-center">
                                                            <span class="icon_pin_alt"><span class="text-hidden">&nbsp;</span></span>
                                                            <h3 class="title">Free Shipping</h3>
                                                            <div class="text">Free for all over oder $99.00</div>
                                                       </div>
                                                  </div>
                                             </div>
                                             
                                             <div class="col-tiny col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                  <div class="block-icon">
                                                       <img alt="Money back" src="image/catalog/bg-block2.jpg">
                                                       <div class="block-center">
                                                            <span class="icon_currency"><span class="text-hidden">&nbsp;</span></span>
                                                            <h3 class="title">Money back</h3>
                                                            <div class="text">100% Money Back - 30 days</div>
                                                       </div>
                                                  </div>
                                             </div>
                                             
                                             <div class="col-tiny col-xs-6 col-xs-push-3 col-md-push-0 col-sm-6 col-md-4 col-lg-4">
                                                  <div class="block-icon">
                                                       <img alt="24h support" src="image/catalog/bg-block3.jpg">
                                                       <div class="block-center">
                                                            <span class="icon_comment_alt"><span class="text-hidden">&nbsp;</span></span>
                                                            <h3 class="title">24h support</h3>
                                                            <div class="text">Service support fast 24/7</div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>',
            ),
          ),
        ),
      ),
    ),
  ),
  4 => 
  array (
    'custom_class' => '',
    'margin_top' => '0',
    'margin_right' => '0',
    'margin_bottom' => '0',
    'margin_left' => '0',
    'padding_top' => '0',
    'padding_right' => '0',
    'padding_bottom' => '0',
    'padding_left' => '0',
    'force_full_width' => '0',
    'background_color' => '',
    'background_image_type' => '0',
    'background_image' => '',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'scroll',
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '15',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      4 => 
      array (
        'status' => '1',
        'width' => '12',
        'disable_on_mobile' => '0',
        'width_xs' => '1',
        'width_sm' => '1',
        'width_md' => '1',
        'width_lg' => '1',
        'sort' => '1',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'latest_blogs',
            'latest_blogs' => 
            array (
              'module_layout' => 'home_shoes_posts.tpl',
              'title' => 
              array (
                $language_id => '<span>Our blog</span><span class="bg-word">O</span><p>Share your latest posts or best articles will post here.</p>',
                1 => '<span>Our blog</span><span class="bg-word">O</span><p>Share your latest posts or best articles will post here.</p>',
              ),
              'width' => '80',
              'height' => '80',
              'limit' => '3',
            ),
          ),
        ),
      ),
    ),
  ),
); 

$this->model_setting_setting->editSetting( "advanced_grid", $output );	

?>