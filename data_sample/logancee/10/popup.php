<?php 

$language_id = 2;
foreach($data['languages'] as $language) {
	if($language['language_id'] != 1) {
		$language_id = $language['language_id'];
	}
}

$output = array();
$output["popup_id_module"] = 11;
$output["popup_module"] = array (
  1 => 
  array (
    'type' => '1',
    'newsletter_popup_title' => 
    array (
      1 => 'Newsletter',
      $language_id => 'Newsletter',
    ),
    'newsletter_popup_text' => 
    array (
      1 => 'Subscribe to the Logancee mailing list to receive updates on new arrivals, special offers and other discount information.',
      $language_id => 'Subscribe to the Logancee mailing list to receive updates on new arrivals, special offers and other discount information.',
    ),
    'newsletter_input_placeholder' => 
    array (
      1 => 'Enter your email address',
      $language_id => 'Enter your email address',
    ),
    'newsletter_subscribe_button_text' => 
    array (
      1 => 'Subscribe',
      $language_id => 'Subscribe',
    ),
    'custom_popup_title' => 
    array (
      1 => '',
      $language_id => '',
    ),
    'custom_popup_text' => 
    array (
      1 => '',
      $language_id => '',
    ),
    'contact_form_popup_title' => 
    array (
      1 => '',
      $language_id => '',
    ),
    'module_id' => '1',
    'show_only_once' => '1',
    'display_text_dont_show_again' => '0',
    'text_dont_show_again' => 
    array (
      1 => 'Don’t show this popup',
      $language_id => 'Don’t show this popup',
    ),
    'display_buttons_yes_no' => '1',
    'no' => 
    array (
      1 => '',
      $language_id => '',
    ),
    'yes' => 
    array (
      1 => '',
      $language_id => '',
    ),
    'content_width' => '830',
    'background_color' => '#fff',
    'background_image' => 'catalog/popup_newsletter.jpg',
    'background_image_position' => 'top left',
    'background_image_repeat' => 'repeat',
    'show_after' => '750',
    'autoclose_after' => '',
    'disable_on_desktop' => '1',
    'layout_id' => '1',
    'position' => 'popup',
    'status' => '1',
    'sort_order' => '0',
  ),
); 

$this->model_setting_setting->editSetting( "popup", $output );	

?>