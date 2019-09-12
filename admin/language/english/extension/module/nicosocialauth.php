<?php
$opencart_version = (int)str_replace('.','',VERSION);
if (!defined('NICO_THEME_NAME')) define('NICO_THEME_NAME', 'Nico');


// Heading
$_['heading_title']       = '<span class="fa-stack fa-lg" style="color:#104da1"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span> ' .  NICO_THEME_NAME . ' &nbsp;Social Auth&nbsp;';

// Text
$_['text_module']         = 'Modules';
$_['text_success']        = 'Success: You have modified module Social Auth!';
$_['entry_name']       = 'Module Name';

if ($opencart_version > 1564)
$_['text_edit']         = 'Edit '. NICO_THEME_NAME.' Social Auth';
else
$_['text_edit']         = 'Edit';

// Error 
$_['error_permission']    = 'Warning: You do not have permission to modify module Social Auth!';
$_['error_image']         = 'Image width &amp; height dimensions required!';

$_['entry_status']      = 'Status';
$_['entry_heading']     = 'Heading Title';
$_['entry_description'] = 'Content';


// Text
$_['text_module']         = 'Modules';
$_['text_success']        = 'Success: You have modified module Social Auth!';

// Entry
$_['entry_status']        = 'Status';
$_['entry_debug']         = 'Debug Mode';

$_['entry_provider']      = 'Provider';
$_['entry_key']           = 'Key';
$_['entry_secret']        = 'Secret';
$_['entry_scope']         = 'Flags (optional)';
$_['entry_sort_order']    = 'Sort Order';

// Button
$_['button_add_row']      = 'Add Provider';

// Error
$_['error_permission']    = 'Warning: You do not have permission to modify module Social Auth!';
