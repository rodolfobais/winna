<?php 

$language_id = 2;
foreach($data['languages'] as $language) {
	if($language['language_id'] != 1) {
		$language_id = $language['language_id'];
	}
}

$output = array();
$output["megamenu_module"] = array (
  0 => 
  array (
    'module_id' => 0,
    'layout_id' => '99999',
    'position' => 'menu',
    'status' => '1',
    'display_on_mobile' => '0',
    'sort_order' => 0,
    'orientation' => '0',
    'search_bar' => 0,
    'navigation_text' => 
    array (
      1 => '',
      2 => '',
    ),
    'home_text' => 
    array (
      1 => 'Home',
      $language_id => 'Home',
    ),
    'full_width' => '0',
    'home_item' => 'text',
    'animation' => 'shift-up',
    'animation_time' => 200,
    'status_cache' => 0,
    'cache_time' => 1,
  ),
  1 => 
  array (
    'module_id' => '1',
    'layout_id' => '1',
    'position' => 'column_left',
    'status' => '1',
    'display_on_mobile' => '0',
    'sort_order' => 0,
    'orientation' => '1',
    'search_bar' => 0,
    'navigation_text' => 
    array (
      $language_id => 'Categories',
      1 => 'Categories',
    ),
    'home_text' => 
    array (
      123456 => '',
      1 => '',
    ),
    'full_width' => '0',
    'home_item' => 'disabled',
    'animation' => 'shift-left',
    'animation_time' => 200,
    'status_cache' => 0,
    'cache_time' => 1,
  ),
);
 
$this->model_setting_setting->editSetting( "megamenu", $output );

$query = $this->db->query("
	DROP TABLE IF EXISTS `".DB_PREFIX ."mega_menu`
");

$query = $this->db->query("
	DROP TABLE IF EXISTS `".DB_PREFIX ."mega_menu_modules`
");

$query = $this->db->query("
	DROP TABLE IF EXISTS `".DB_PREFIX ."mega_menu_links`
");

$query = $this->db->query("
	CREATE TABLE IF NOT EXISTS `".DB_PREFIX."mega_menu` (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`module_id` int(11) NOT NULL DEFAULT '0',
		`parent_id` int(11) NOT NULL,
		`rang` int(11) NOT NULL,
		`icon` varchar(255) NOT NULL DEFAULT '',
		`name` text,
		`link` text,
		`description` text,
		`label` text,
		`label_text_color` text,
		`label_background_color` text,
		`custom_class` text,
		`new_window` int(11) NOT NULL DEFAULT '0',
		`status` int(11) NOT NULL DEFAULT '0',
		`display_on_mobile` int(11) NOT NULL DEFAULT '0',
		`position` int(11) NOT NULL DEFAULT '0',
		`submenu_width` text,
		`submenu_type` int(11) NOT NULL DEFAULT '0',
		`submenu_background` text,
		`submenu_background_position` text,
		`submenu_background_repeat` text,
		`content_width` int(11) NOT NULL DEFAULT '12',
		`content_type` int(11) NOT NULL DEFAULT '0',
		`content` text,
		PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
");

$query = $this->db->query("
	CREATE TABLE IF NOT EXISTS `".DB_PREFIX."mega_menu_modules` (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`name` text,
		PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
");

$query = $this->db->query("
	CREATE TABLE IF NOT EXISTS `".DB_PREFIX."mega_menu_links` (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`name` text,
		`name_for_autocomplete` text,
		`url` text,
		`label` text,
		`label_text` text,
		`label_background` text,
		`image` text,
		PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
");

$query = $this->db->query("
     INSERT INTO `".DB_PREFIX."mega_menu_modules` (`id`, `name`) VALUES
     (1, 'Vertical MegaMenu')
");

$query = $this->db->query("
     INSERT INTO `".DB_PREFIX."mega_menu_links` (`id`, `name`, `name_for_autocomplete`, `url`, `label`, `label_text`, `label_background`, `image`) VALUES
     (1, 'a:2:{i:1;s:11:\"Suggestions\";i:" . $language_id . ";s:11:\"Suggestions\";}', 'Suggestions', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', 'catalog/megamenu-block-top-sub1.jpg'),
     (2, 'a:2:{i:1;s:12:\"New Products\";i:" . $language_id . ";s:12:\"New Products\";}', 'New Products', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (3, 'a:2:{i:1;s:14:\"Back To School\";i:" . $language_id . ";s:14:\"Back To School\";}', 'Back To School', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (4, 'a:2:{i:1;s:9:\"Must Have\";i:" . $language_id . ";s:9:\"Must Have\";}', 'Must Have', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (5, 'a:2:{i:1;s:16:\"Denim Collection\";i:" . $language_id . ";s:16:\"Denim Collection\";}', 'Denim Collection', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (6, 'a:2:{i:1;s:15:\"Daily Standards\";i:" . $language_id . ";s:15:\"Daily Standards\";}', 'Daily Standards', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (7, 'a:2:{i:1;s:11:\"Black Label\";i:" . $language_id . ";s:11:\"Black Label\";}', 'Black Label', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (8, 'a:2:{i:1;s:11:\"Collections\";i:" . $language_id . ";s:11:\"Collections\";}', 'Collections', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:4:\"HOT!\";i:" . $language_id . ";s:4:\"HOT!\";}', '#fff', '#cc0000', 'catalog/megamenu-block-top-sub2.jpg'),
     (9, 'a:2:{i:1;s:6:\"Basics\";i:" . $language_id . ";s:6:\"Basics\";}', 'Basics', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (10, 'a:2:{i:1;s:15:\"Coat And Parkas\";i:" . $language_id . ";s:15:\"Coat And Parkas\";}', 'Coat And Parkas', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (11, 'a:2:{i:1;s:6:\"Shorts\";i:" . $language_id . ";s:6:\"Shorts\";}', 'Shorts', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (12, 'a:2:{i:1;s:8:\"T-Shirts\";i:" . $language_id . ";s:8:\"T-Shirts\";}', 'T-Shirts', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (13, 'a:2:{i:1;s:7:\"Jackets\";i:" . $language_id . ";s:7:\"Jackets\";}', 'Jackets', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (14, 'a:2:{i:1;s:8:\"Trousers\";i:" . $language_id . ";s:8:\"Trousers\";}', 'Trousers', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (15, 'a:2:{i:1;s:11:\"Accessories\";i:" . $language_id . ";s:11:\"Accessories\";}', 'Accessories', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', 'catalog/megamenu-block-top-sub3.jpg'),
     (16, 'a:2:{i:1;s:7:\"Glasses\";i:" . $language_id . ";s:7:\"Glasses\";}', 'Glasses', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (17, 'a:2:{i:1;s:16:\"Bags And Wallets\";i:" . $language_id . ";s:16:\"Bags And Wallets\";}', 'Bags And Wallets', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (18, 'a:2:{i:1;s:10:\"Fragrances\";i:" . $language_id . ";s:10:\"Fragrances\";}', 'Fragrances', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (19, 'a:2:{i:1;s:15:\"Caps &amp; Hats\";i:" . $language_id . ";s:15:\"Caps &amp; Hats\";}', 'Caps &amp; Hats', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (20, 'a:2:{i:1;s:9:\"Underwear\";i:" . $language_id . ";s:9:\"Underwear\";}', 'Underwear', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (21, 'a:2:{i:1;s:12:\"Men Footwear\";i:" . $language_id . ";s:12:\"Men Footwear\";}', 'Men Footwear', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (22, 'a:2:{i:1;s:12:\"Home Layouts\";i:" . $language_id . ";s:12:\"Home Layouts\";}', 'Home Layouts', '#', 'a:2:{i:1;s:4:\"HOT!\";i:" . $language_id . ";s:4:\"HOT!\";}', '#fff', '#cc0000', ''),
     (23, 'a:2:{i:1;s:16:\"Category Layouts\";i:" . $language_id . ";s:16:\"Category Layouts\";}', 'Category Layouts', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (24, 'a:2:{i:1;s:13:\"Product Types\";i:" . $language_id . ";s:13:\"Product Types\";}', 'Product Types', '#', 'a:2:{i:1;s:4:\"HOT!\";i:" . $language_id . ";s:4:\"HOT!\";}', '#fff', '#cc0000', ''),
     (25, 'a:2:{i:1;s:16:\"Product Features\";i:" . $language_id . ";s:16:\"Product Features\";}', 'Product Features', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (26, 'a:2:{i:1;s:16:\"Home 01 - Simple\";i:" . $language_id . ";s:16:\"Home 01 - Simple\";}', 'Home 01 - Simple', '#', 'a:2:{i:1;s:4:\"HOT!\";i:" . $language_id . ";s:4:\"HOT!\";}', '#fff', '#cc0000', ''),
     (27, 'a:2:{i:1;s:18:\"Home 02 - Carousel\";i:" . $language_id . ";s:18:\"Home 02 - Carousel\";}', 'Home 02 - Carousel', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (28, 'a:2:{i:1;s:21:\"Home 03 - Fluid Width\";i:" . $language_id . ";s:21:\"Home 03 - Fluid Width\";}', 'Home 03 - Fluid Width', '#fff', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (29, 'a:2:{i:1;s:18:\"Home 04 - Parallax\";i:" . $language_id . ";s:18:\"Home 04 - Parallax\";}', 'Home 04 - Parallax', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (30, 'a:2:{i:1;s:22:\"Home 05 - Presentation\";i:" . $language_id . ";s:22:\"Home 05 - Presentation\";}', 'Home 05 - Presentation', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (31, 'a:2:{i:1;s:23:\"Home 06 - Boxed Sidebar\";i:" . $language_id . ";s:23:\"Home 06 - Boxed Sidebar\";}', 'Home 06 - Boxed Sidebar', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (32, 'a:2:{i:1;s:18:\"Home 07 - Interior\";i:" . $language_id . ";s:18:\"Home 07 - Interior\";}', 'Home 07 - Interior', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (33, 'a:2:{i:1;s:20:\"Home 08 - Sunglasses\";i:" . $language_id . ";s:20:\"Home 08 - Sunglasses\";}', 'Home 08 - Sunglasses', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (34, 'a:2:{i:1;s:17:\"Home 09 - Jewelry\";i:" . $language_id . ";s:17:\"Home 09 - Jewelry\";}', 'Home 09 - Jewelry', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (35, 'a:2:{i:1;s:25:\"Home 10 - Sidebar Variant\";i:" . $language_id . ";s:25:\"Home 10 - Sidebar Variant\";}', 'Home 10 - Sidebar Variant', '#', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', ''),
     (36, 'a:2:{i:1;s:17:\"Category 1 Column\";i:" . $language_id . ";s:17:\"Category 1 Column\";}', 'Category 1 Column', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (37, 'a:2:{i:1;s:18:\"Category 2 Columns\";i:" . $language_id . ";s:18:\"Category 2 Columns\";}', 'Category 2 Columns', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (38, 'a:2:{i:1;s:18:\"Category 3 Columns\";i:" . $language_id . ";s:18:\"Category 3 Columns\";}', 'Category 3 Columns', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (39, 'a:2:{i:1;s:29:\"Category - 6 Products Per Row\";i:" . $language_id . ";s:29:\"Category - 6 Products Per Row\";}', 'Category - 6 Products Per Row', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (40, 'a:2:{i:1;s:29:\"Category - 4 Products Per Row\";i:" . $language_id . ";s:29:\"Category - 4 Products Per Row\";}', 'Category - 4 Products Per Row', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (41, 'a:2:{i:1;s:29:\"Category - 3 Products Per Row\";i:" . $language_id . ";s:29:\"Category - 3 Products Per Row\";}', 'Category - 3 Products Per Row', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (42, 'a:2:{i:1;s:14:\"Simple Product\";i:" . $language_id . ";s:14:\"Simple Product\";}', 'Simple Product', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (43, 'a:2:{i:1;s:19:\"Configuable Product\";i:" . $language_id . ";s:19:\"Configuable Product\";}', 'Configuable Product', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (44, 'a:2:{i:1;s:13:\"Group Product\";i:" . $language_id . ";s:13:\"Group Product\";}', 'Group Product', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (45, 'a:2:{i:1;s:14:\"Bundle Product\";i:" . $language_id . ";s:14:\"Bundle Product\";}', 'Bundle Product', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (46, 'a:2:{i:1;s:15:\"Virtual Product\";i:" . $language_id . ";s:15:\"Virtual Product\";}', 'Virtual Product', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (47, 'a:2:{i:1;s:20:\"Downloadable Product\";i:" . $language_id . ";s:20:\"Downloadable Product\";}', 'Downloadable Product', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (48, 'a:2:{i:1;s:28:\"Product With Lens Zoom Round\";i:" . $language_id . ";s:28:\"Product With Lens Zoom Round\";}', 'Product With Lens Zoom Round', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (49, 'a:2:{i:1;s:29:\"Product With Lens Zoom Square\";i:" . $language_id . ";s:29:\"Product With Lens Zoom Square\";}', 'Product With Lens Zoom Square', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (50, 'a:2:{i:1;s:23:\"Product With Inner Zoom\";i:" . $language_id . ";s:23:\"Product With Inner Zoom\";}', 'Product With Inner Zoom', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (51, 'a:2:{i:1;s:19:\"Product With Upsell\";i:" . $language_id . ";s:19:\"Product With Upsell\";}', 'Product With Upsell', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', ''),
     (52, 'a:2:{i:1;s:20:\"Product With Related\";i:" . $language_id . ";s:20:\"Product With Related\";}', 'Product With Related', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '')
");

$query = $this->db->query("
     INSERT INTO `".DB_PREFIX."mega_menu` (`id`, `module_id`, `parent_id`, `rang`, `icon`, `name`, `link`, `description`, `label`, `label_text_color`, `label_background_color`, `custom_class`, `new_window`, `status`, `display_on_mobile`, `position`, `submenu_width`, `submenu_type`, `submenu_background`, `submenu_background_position`, `submenu_background_repeat`, `content_width`, `content_type`, `content`) VALUES
     (1, 0, 0, 0, '', 'a:2:{i:1;s:4:\"Shop\";i:" . $language_id . ";s:4:\"Shop\";}', 'index.php?route=product/category&amp;path=20', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (2, 0, 0, 3, '', 'a:2:{i:1;s:8:\"Features\";i:" . $language_id . ";s:8:\"Features\";}', '#', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:4:\"HOT!\";i:" . $language_id . ";s:4:\"HOT!\";}', '#fff', '#cc0000', '', 0, 0, 0, 0, '270px', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (3, 0, 0, 5, '', 'a:2:{i:1;s:5:\"About\";i:" . $language_id . ";s:5:\"About\";}', 'index.php?route=information/information&amp;information_id=4', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (4, 0, 0, 6, '', 'a:2:{i:1;s:4:\"Blog\";i:2;s:4:\"Blog\";}', 'index.php?route=blog/blog', 'a:2:{i:1;s:0:\"\";i:2;s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:2;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:2;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:2;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (5, 0, 0, 7, '', 'a:2:{i:1;s:7:\"Contact\";i:" . $language_id . ";s:7:\"Contact\";}', 'index.php?route=information/contact', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (6, 0, 0, 8, '', 'a:2:{i:1;s:9:\"Buy theme\";i:" . $language_id . ";s:9:\"Buy theme\";}', '', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:3:\"NEW\";i:" . $language_id . ";s:3:\"NEW\";}', '#fff', '#3689C3', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (7, 0, 2, 4, '', 'a:2:{i:1;s:5:\"Links\";i:" . $language_id . ";s:5:\"Links\";}', '', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 12, 2, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:4:{i:0;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:12:\"Home Layouts\";s:2:\"id\";i:22;s:8:\"children\";a:10:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:16:\"Home 01 - Simple\";s:2:\"id\";i:26;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:18:\"Home 02 - Carousel\";s:2:\"id\";i:27;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:21:\"Home 03 - Fluid Width\";s:2:\"id\";i:28;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:18:\"Home 04 - Parallax\";s:2:\"id\";i:29;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:22:\"Home 05 - Presentation\";s:2:\"id\";i:30;}i:5;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:23:\"Home 06 - Boxed Sidebar\";s:2:\"id\";i:31;}i:6;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:18:\"Home 07 - Interior\";s:2:\"id\";i:32;}i:7;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:20:\"Home 08 - Sunglasses\";s:2:\"id\";i:33;}i:8;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:17:\"Home 09 - Jewelry\";s:2:\"id\";i:34;}i:9;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:25:\"Home 10 - Sidebar Variant\";s:2:\"id\";i:35;}}}i:1;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:16:\"Category Layouts\";s:2:\"id\";i:23;s:8:\"children\";a:6:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:17:\"Category 1 Column\";s:2:\"id\";i:36;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:18:\"Category 2 Columns\";s:2:\"id\";i:37;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:18:\"Category 3 Columns\";s:2:\"id\";i:38;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:29:\"Category - 6 Products Per Row\";s:2:\"id\";i:39;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:29:\"Category - 4 Products Per Row\";s:2:\"id\";i:40;}i:5;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:29:\"Category - 3 Products Per Row\";s:2:\"id\";i:41;}}}i:2;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:13:\"Product Types\";s:2:\"id\";i:24;s:8:\"children\";a:6:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:14:\"Simple Product\";s:2:\"id\";i:42;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:19:\"Configuable Product\";s:2:\"id\";i:43;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:13:\"Group Product\";s:2:\"id\";i:44;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:14:\"Bundle Product\";s:2:\"id\";i:45;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:15:\"Virtual Product\";s:2:\"id\";i:46;}i:5;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:20:\"Downloadable Product\";s:2:\"id\";i:47;}}}i:3;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:16:\"Product Features\";s:2:\"id\";i:25;s:8:\"children\";a:5:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:28:\"Product With Lens Zoom Round\";s:2:\"id\";i:48;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:29:\"Product With Lens Zoom Square\";s:2:\"id\";i:49;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:23:\"Product With Inner Zoom\";s:2:\"id\";i:50;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:19:\"Product With Upsell\";s:2:\"id\";i:51;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:20:\"Product With Related\";s:2:\"id\";i:52;}}}}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (8, 0, 1, 1, '', 'a:2:{i:1;s:5:\"Links\";i:" . $language_id . ";s:5:\"Links\";}', '', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 9, 2, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:3:{i:0;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:11:\"Suggestions\";s:2:\"id\";i:1;s:8:\"children\";a:6:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:12:\"New Products\";s:2:\"id\";i:2;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:14:\"Back To School\";s:2:\"id\";i:3;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:9:\"Must Have\";s:2:\"id\";i:4;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:16:\"Denim Collection\";s:2:\"id\";i:5;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:15:\"Daily Standards\";s:2:\"id\";i:6;}i:5;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:11:\"Black Label\";s:2:\"id\";i:7;}}}i:1;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:11:\"Collections\";s:2:\"id\";i:8;s:8:\"children\";a:6:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:6:\"Basics\";s:2:\"id\";i:9;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:15:\"Coat And Parkas\";s:2:\"id\";i:10;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:6:\"Shorts\";s:2:\"id\";i:11;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:8:\"T-Shirts\";s:2:\"id\";i:12;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:7:\"Jackets\";s:2:\"id\";i:13;}i:5;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:8:\"Trousers\";s:2:\"id\";i:14;}}}i:2;a:4:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:11:\"Accessories\";s:2:\"id\";i:15;s:8:\"children\";a:6:{i:0;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:7:\"Glasses\";s:2:\"id\";i:16;}i:1;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:16:\"Bags And Wallets\";s:2:\"id\";i:17;}i:2;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:10:\"Fragrances\";s:2:\"id\";i:18;}i:3;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:11:\"Caps & Hats\";s:2:\"id\";i:19;}i:4;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:9:\"Underwear\";s:2:\"id\";i:20;}i:5;a:3:{s:4:\"type\";s:4:\"link\";s:4:\"name\";s:14:\"Men''s Footwear\";s:2:\"id\";i:21;}}}}s:7:\"columns\";s:1:\"3\";s:7:\"submenu\";s:1:\"2\";s:14:\"image_position\";s:1:\"2\";s:11:\"image_width\";s:3:\"480\";s:12:\"image_height\";s:3:\"270\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (9, 0, 1, 2, '', 'a:2:{i:1;s:5:\"Block\";i:" . $language_id . ";s:5:\"Block\";}', '', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', 'a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 3, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:1;s:509:\"&lt;div class=&quot;mega-blockright&quot;&gt;\r\n   &lt;img class=&quot;img-responsive&quot; src=&quot;image/catalog/megamenu-blockright.jpg&quot; alt=&quot;Block&quot;&gt;\r\n   &lt;div class=&quot;mega-right block-center&quot;&gt;&lt;div class=&quot;text-small h3&quot;&gt;Men’s shoes&lt;/div&gt;&lt;div class=&quot;text-large h3&quot;&gt;Sale up to 30% off&lt;/div&gt;&lt;a class=&quot;btn-ex hover-effect02&quot; href=&quot;#&quot;&gt;&lt;span&gt;Explore Now&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;\r\n&lt;/div&gt;\";i:" . $language_id . ";s:509:\"&lt;div class=&quot;mega-blockright&quot;&gt;\r\n   &lt;img class=&quot;img-responsive&quot; src=&quot;image/catalog/megamenu-blockright.jpg&quot; alt=&quot;Block&quot;&gt;\r\n   &lt;div class=&quot;mega-right block-center&quot;&gt;&lt;div class=&quot;text-small h3&quot;&gt;Men’s shoes&lt;/div&gt;&lt;div class=&quot;text-large h3&quot;&gt;Sale up to 30% off&lt;/div&gt;&lt;a class=&quot;btn-ex hover-effect02&quot; href=&quot;#&quot;&gt;&lt;span&gt;Explore Now&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;\r\n&lt;/div&gt;\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:1;s:0:\"\";i:" . $language_id . ";s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (10, 1, 0, 0, '', 'a:2:{i:" . $language_id . ";s:11:\"Accessories\";i:1;s:11:\"Accessories\";}', 'index.php?route=product/category&amp;path=20', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (11, 1, 0, 1, '', 'a:2:{i:" . $language_id . ";s:8:\"Footwear\";i:1;s:8:\"Footwear\";}', 'index.php?route=product/category&amp;path=20', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (12, 1, 0, 2, '', 'a:2:{i:" . $language_id . ";s:8:\"Handbags\";i:1;s:8:\"Handbags\";}', 'index.php?route=product/category&amp;path=18', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (13, 1, 0, 3, '', 'a:2:{i:" . $language_id . ";s:7:\"Jewelry\";i:1;s:7:\"Jewelry\";}', 'index.php?route=product/category&amp;path=20', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (14, 1, 0, 4, '', 'a:2:{i:" . $language_id . ";s:4:\"Mens\";i:1;s:4:\"Mens\";}', 'index.php?route=product/category&amp;path=18', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (15, 1, 0, 5, '', 'a:2:{i:" . $language_id . ";s:6:\"Womens\";i:1;s:6:\"Womens\";}', 'index.php?route=product/category&amp;path=20', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (16, 1, 0, 6, '', 'a:2:{i:" . $language_id . ";s:15:\"Sale promotions\";i:1;s:15:\"Sale promotions\";}', 'index.php?route=product/category&amp;path=18', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}'),
     (17, 1, 0, 7, '', 'a:2:{i:" . $language_id . ";s:10:\"Lookbook !\";i:1;s:10:\"Lookbook !\";}', 'index.php?route=product/category&amp;path=20', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', 'a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}', '', '', '', 0, 0, 0, 0, '100%', 0, '', 'top left', 'no-repeat', 4, 0, 'a:4:{s:4:\"html\";a:1:{s:4:\"text\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}}s:7:\"product\";a:4:{s:2:\"id\";s:0:\"\";s:4:\"name\";s:0:\"\";s:5:\"width\";s:3:\"400\";s:6:\"height\";s:3:\"400\";}s:10:\"categories\";a:7:{s:10:\"categories\";a:0:{}s:7:\"columns\";s:1:\"1\";s:7:\"submenu\";s:1:\"1\";s:14:\"image_position\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";s:15:\"submenu_columns\";s:1:\"1\";}s:8:\"products\";a:5:{s:7:\"heading\";a:2:{i:" . $language_id . ";s:0:\"\";i:1;s:0:\"\";}s:8:\"products\";a:0:{}s:7:\"columns\";s:1:\"1\";s:11:\"image_width\";s:0:\"\";s:12:\"image_height\";s:0:\"\";}}')
");

?>