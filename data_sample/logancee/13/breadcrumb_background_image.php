<?php 

$language_id = 2;
foreach($data['languages'] as $language) {
	if($language['language_id'] != 1) {
		$language_id = $language['language_id'];
	}
}

$output = array();
$output["breadcrumb_background_image_module"] = array (
  1 => 
  array (
    'background_color' => '',
    'background_image' => 'catalog/home13-bg-category.jpg',
    'background_image_position' => 'top center',
    'background_image_repeat' => 'no-repeat',
    'layout_id' => '3',
    'position' => 'breadcrumb',
    'status' => '1',
    'sort_order' => '0',
  ),
  2 => 
  array (
    'background_color' => '',
    'background_image' => 'catalog/home13-bg-category.jpg',
    'background_image_position' => 'top center',
    'background_image_repeat' => 'no-repeat',
    'layout_id' => '2',
    'position' => 'breadcrumb',
    'status' => '1',
    'sort_order' => '0',
  ),
  3 => 
  array (
    'background_color' => '',
    'background_image' => 'catalog/image-blog.jpg',
    'background_image_position' => 'top center',
    'background_image_repeat' => 'no-repeat',
    'layout_id' => '17',
    'position' => 'breadcrumb',
    'status' => '1',
    'sort_order' => '0',
  ),
  4 => 
  array (
    'background_color' => '',
    'background_image' => 'catalog/image-about.jpg',
    'background_image_position' => 'top center',
    'background_image_repeat' => 'no-repeat',
    'layout_id' => '11',
    'position' => 'breadcrumb',
    'status' => '1',
    'sort_order' => '0',
  ),
  5 => 
  array (
    'background_color' => '',
    'background_image' => 'catalog/image-contact.jpg',
    'background_image_position' => 'top center',
    'background_image_repeat' => 'no-repeat',
    'layout_id' => '8',
    'position' => 'breadcrumb',
    'status' => '1',
    'sort_order' => '0',
  ),
); 

$this->model_setting_setting->editSetting( "breadcrumb_background_image", $output );	

?>