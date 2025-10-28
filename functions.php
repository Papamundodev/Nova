<?php

use Theme_base\Base;
use Theme_base\CustomPostType;

if (is_file(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}



$base = new Base('design_pattern', 'design_pattern');

$base->themeSupports();
$base->registerMenus();
$base->includeStyles();
$base->includeScripts();
$base->addSVGSupport();
$base->registerWidgets();
$base->sidebar_widgets_language_selector_init();

$services = new CustomPostType('theme_base', 'service', 'Service', 'Services', 2, 'Description');
add_action('init', [$services, 'register']);