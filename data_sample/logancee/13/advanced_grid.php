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
    'background_color' => '',
    'background_image_type' => '0',
    'background_image' => '',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'scroll',
    'layout_id' => '99999',
    'position' => 'footer',
    'status' => '1',
    'sort_order' => '',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      1 => 
      array (
        'status' => '1',
        'width' => 'advanced',
        'disable_on_mobile' => '0',
        'width_xs' => '12',
        'width_sm' => '12',
        'width_md' => '3',
        'width_lg' => '3',
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
              $language_id => '<div class="information-logo text-center">
     <div class="footer-static">
          <a class="logo-bottom" href="#"><img class="img-responsive" alt="Logo" src="image/catalog/logo-footer.png"></a>
          <p style="font-size: 0.98em;">Logancee is a premium opencart theme. Best choice for your online store. Let purchase it to enjoy now</p>
     </div>
</div>',
              1 => '<div class="information-logo text-center">
     <div class="footer-static">
          <a class="logo-bottom" href="#"><img class="img-responsive" alt="Logo" src="image/catalog/logo-footer.png"></a>
          <p style="font-size: 0.98em;">Logancee is a premium opencart theme. Best choice for your online store. Let purchase it to enjoy now</p>
     </div>
</div>',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'status' => '1',
        'width' => 'advanced',
        'disable_on_mobile' => '0',
        'width_xs' => '12',
        'width_sm' => '4',
        'width_md' => '3',
        'width_lg' => '3',
        'sort' => '2',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'links',
            'links' => 
            array (
              'module_layout' => 'information_links.tpl',
              'title' => 
              array (
                $language_id => 'Information',
                1 => 'Information',
              ),
              'limit' => '5',
              'array' => 
              array (
                1 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'About us',
                    1 => 'About us',
                  ),
                  'url' => 'index.php?route=information/information&information_id=4',
                  'sort' => '1',
                ),
                2 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'Delivery Information',
                    1 => 'Delivery Information',
                  ),
                  'url' => 'index.php?route=information/information&information_id=6',
                  'sort' => '2',
                ),
                3 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'Faq',
                    1 => 'Faq',
                  ),
                  'url' => 'index.php?route=extension/module/faq',
                  'sort' => '3',
                ),
                4 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'Terms & Conditions',
                    1 => 'Terms & Conditions',
                  ),
                  'url' => 'index.php?route=information/information&information_id=5',
                  'sort' => '4',
                ),
              ),
            ),
          ),
        ),
      ),
      3 => 
      array (
        'status' => '1',
        'width' => 'advanced',
        'disable_on_mobile' => '0',
        'width_xs' => '12',
        'width_sm' => '4',
        'width_md' => '3',
        'width_lg' => '3',
        'sort' => '3',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'links',
            'links' => 
            array (
              'module_layout' => 'default.tpl',
              'title' => 
              array (
                $language_id => 'My account',
                1 => 'My account',
              ),
              'limit' => '5',
              'array' => 
              array (
                5 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'My Account',
                    1 => 'My Account',
                  ),
                  'url' => 'index.php?route=account/login',
                  'sort' => '1',
                ),
                6 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'Order History',
                    1 => 'Order History',
                  ),
                  'url' => 'index.php?route=account/order',
                  'sort' => '2',
                ),
                7 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'Wish LIst',
                    1 => 'Wish LIst',
                  ),
                  'url' => 'index.php?route=account/wishlist',
                  'sort' => '3',
                ),
                8 => 
                array (
                  'name' => 
                  array (
                    $language_id => 'Newsletter',
                    1 => 'Newsletter',
                  ),
                  'url' => 'index.php?route=account/newsletter',
                  'sort' => '4',
                ),
              ),
            ),
          ),
        ),
      ),
      4 => 
      array (
        'status' => '1',
        'width' => 'advanced',
        'disable_on_mobile' => '0',
        'width_xs' => '12',
        'width_sm' => '4',
        'width_md' => '3',
        'width_lg' => '3',
        'sort' => '4',
        'module' => 
        array (
          1 => 
          array (
            'status' => '1',
            'sort' => '1',
            'type' => 'box',
            'module' => 
            array (
              'title' => 
              array (
                $language_id => 'Contact us',
                1 => 'Contact us',
              ),
              'text' => 
              array (
                $language_id => '<ul class="clearfix address-footer">
     <li class="item"><a><span class="icon_house_alt"> </span>123 New Design St, ABC Building, Melbourne, Australia</a></li>
     <li class="item"><a><span class="icon_mobile"> </span>(0044) 123 456 789</a></li>
     <li class="item"><a><span class="icon_mail_alt"> </span>hello@yourdomain.com</a></li>
</ul>',
                1 => '<ul class="clearfix address-footer">
     <li class="item"><a><span class="icon_house_alt"> </span>123 New Design St, ABC Building, Melbourne, Australia</a></li>
     <li class="item"><a><span class="icon_mobile"> </span>(0044) 123 456 789</a></li>
     <li class="item"><a><span class="icon_mail_alt"> </span>hello@yourdomain.com</a></li>
</ul>',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  2 => 
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
    'sort_order' => '0',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      5 => 
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
              'module_layout' => 'default.tpl',
              'title' => 
              array (
                $language_id => 'Check our products',
                1 => 'Check our products',
              ),
              'description' => 
              array (
                $language_id => '',
                1 => '',
              ),
              'width' => '540',
              'height' => '720',
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
                  'get_products_from' => 'most_viewed',
                  'product' => '',
                  'products' => '',
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
  3 => 
  array (
    'custom_class' => '',
    'margin_top' => '95',
    'margin_right' => '0',
    'margin_bottom' => '0',
    'margin_left' => '0',
    'padding_top' => '0',
    'padding_right' => '0',
    'padding_bottom' => '0',
    'padding_left' => '0',
    'force_full_width' => '1',
    'background_color' => '#f5f5f5',
    'background_image_type' => '0',
    'background_image' => '',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'scroll',
    'layout_id' => '1',
    'position' => 'content_bottom',
    'status' => '1',
    'sort_order' => '5',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      6 => 
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
              'module_layout' => 'home_barber_posts.tpl',
              'title' => 
              array (
                $language_id => 'From our blog <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nunc sem. Nam non fringilla mauris. Aenean dictum nisi ut.</p>',
                1 => 'From our blog <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nunc sem. Nam non fringilla mauris. Aenean dictum nisi ut.</p>',
              ),
              'width' => '390',
              'height' => '390',
              'limit' => '3',
            ),
          ),
        ),
      ),
    ),
  ),
  4 => 
  array (
    'custom_class' => '',
    'margin_top' => '118',
    'margin_right' => '0',
    'margin_bottom' => '0',
    'margin_left' => '0',
    'padding_top' => '0',
    'padding_right' => '0',
    'padding_bottom' => '0',
    'padding_left' => '0',
    'force_full_width' => '1',
    'background_color' => '#f5f5f5',
    'background_image_type' => '1',
    'background_image' => 'catalog/bg-hotdeal.jpg',
    'background_image_position' => 'top center',
    'background_image_repeat' => 'no-repeat',
    'background_image_attachment' => 'fixed',
    'layout_id' => '1',
    'position' => 'preface_fullwidth',
    'status' => '1',
    'sort_order' => '5',
    'disable_on_mobile' => '0',
    'column' => 
    array (
      7 => 
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
              $language_id => '<div class="sunglasses-hot-deal">
     <div class="image" style="left: 518px;top: 146px"><img src="image/catalog/barber-product.png" alt=""></div>
     <div class="first-heading">Wow ! super deal <strong style="color: #000">only today</strong></div>
     <div class="second-heading">Mega sale off up to <span style="color: #94754c">70%</span></div>
     <div class="description">For our anniversary 3 years. We’re glad to notice with you that we have open mega sale off up to <span style="color: #000">70% only today</span> for all our producton store. <span style="color: #000">Grab it now !</span></div>
     
     <div class="countdown-special">
          <p>Expires in</p>
          <script>
          $(function () {
          	var austDay = new Date();
          	austDay = new Date(2015, 12 - 1, 22);
          	var date = new Date();
          	date.setDate(date.getDate() + 10 /*days*/);    
          	$(\'#sunglasses-countdown\').countdown({until: date});
          });
          </script>
          <div id="sunglasses-countdown" class="clearfix"></div>
     </div>
     
     <a href="#" class="theme-btn">Discover Now</a>
</div>',
              1 => '<div class="sunglasses-hot-deal">
     <div class="image" style="left: 518px;top: 146px"><img src="image/catalog/barber-product.png" alt=""></div>
     <div class="first-heading">Wow ! super deal <strong style="color: #000">only today</strong></div>
     <div class="second-heading">Mega sale off up to <span style="color: #94754c">70%</span></div>
     <div class="description">For our anniversary 3 years. We’re glad to notice with you that we have open mega sale off up to <span style="color: #000">70% only today</span> for all our producton store. <span style="color: #000">Grab it now !</span></div>
     
     <div class="countdown-special">
          <p>Expires in</p>
          <script>
          $(function () {
          	var austDay = new Date();
          	austDay = new Date(2015, 12 - 1, 22);
          	var date = new Date();
          	date.setDate(date.getDate() + 10 /*days*/);    
          	$(\'#sunglasses-countdown\').countdown({until: date});
          });
          </script>
          <div id="sunglasses-countdown" class="clearfix"></div>
     </div>
     
     <a href="#" class="theme-btn">Discover Now</a>
</div>',
            ),
          ),
        ),
      ),
    ),
  ),
); 

$this->model_setting_setting->editSetting( "advanced_grid", $output );	

?>