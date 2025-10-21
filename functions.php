<?php

use Theme_base\Base;
use Theme_base\CustomPostType;

if (is_file(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Expose menus publicly (be selective in production!)
add_filter( 'rest_menu_read_access', '__return_true' );



$base = new Base('design_pattern', 'design_pattern');

$base->themeSupports();
$base->registerMenus();
$base->includeStyles();
$base->includeScripts();


$services = new CustomPostType('theme_base', 'service', 'Service', 'Services', 2, 'Description');
add_action('init', [$services, 'register']);