<?php
$opencart_version = (int)str_replace('.','',VERSION);
if (!defined('NICO_THEME_NAME')) define('NICO_THEME_NAME', 'Nico');

// Heading
$_['heading_title']       = '<span class="fa-stack fa-lg" style="color:#104da1"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-map-marker fa-stack-1x fa-inverse"></i></span> ' .  NICO_THEME_NAME . '&nbsp; Google Maps';
$_['entry_name']       = 'Module Name';

// Text
$_['text_module']         = 'Modules';
$_['text_success']        = 'Success: You have modified module nicogooglemaps!';
if ($opencart_version > 1564)
$_['text_edit']         = 'Edit '. NICO_THEME_NAME.' Mega Menu';
else
$_['text_edit']         = 'Edit';


// Error 
$_['error_permission']    = 'Warning: You do not have permission to modify module nicogooglemaps!';
$_['error_image']         = 'Image width &amp; height dimensions required!';
