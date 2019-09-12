<?php 

$language_id = 2;
foreach($data['languages'] as $language) {
	if($language['language_id'] != 1) {
		$language_id = $language['language_id'];
	}
}

$output = array();
$output["filter_product_module"] = array (
  1 => 
  array (
    'tabs' => 
    array (
      1 => 
      array (
        'heading' => 
        array (
          $language_id => 'Best Seller',
          1 => 'Best Seller',
        ),
        'title' => 'products',
        'product' => '',
        'products' => '43,40,42,30,46,44,45,29',
        'category' => '',
        'categories' => '',
      ),
      2 => 
      array (
        'heading' => 
        array (
          $language_id => 'New arrival',
          1 => 'New arrival',
        ),
        'title' => 'latest',
        'product' => '',
        'products' => '',
        'category' => '',
        'categories' => '',
      ),
      3 => 
      array (
        'heading' => 
        array (
          $language_id => 'Most wanted',
          1 => 'Most wanted',
        ),
        'title' => 'most_viewed',
        'product' => '',
        'products' => '',
        'category' => '',
        'categories' => '',
      ),
    ),
    'carousel' => '1',
    'width' => '540',
    'height' => '720',
    'itemsperpage' => '3',
    'cols' => '1',
    'limit' => '6',
    'layout_id' => '1',
    'position' => 'content_big_column',
    'status' => '1',
    'sort_order' => '6',
  ),
  2 => 
  array (
    'tabs' => 
    array (
      4 => 
      array (
        'heading' => 
        array (
          $language_id => 'Featured products',
          1 => 'Featured products',
        ),
        'title' => 'products',
        'product' => '',
        'products' => '30,28,47,42',
        'category' => '',
        'categories' => '',
      ),
    ),
    'carousel' => '0',
    'width' => '77',
    'height' => '103',
    'itemsperpage' => '2',
    'cols' => '1',
    'limit' => '2',
    'layout_id' => '3',
    'position' => 'column_left',
    'status' => '1',
    'sort_order' => '5',
  ),
); 

$this->model_setting_setting->editSetting( "filter_product", $output );	

?>