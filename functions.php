<?php

use Theme_base\Base;
use Theme_base\CustomPostType;
use Theme_base\Taxonomy;
use Theme_base\Form;
use Theme_base\MessengerWebhook;

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
$base->get_homepage_schema();
$base->registerPageSpeedCron();

$expertises = new Taxonomy('theme_base', 'expertises', 'Expertise', 'Expertises', array('post', 'page'));
$expertises->associateToCustomPostType(array('post', 'page'));



// Initialize contact form handler
new Form();

// Initialize Messenger webhook
new MessengerWebhook();

$faq = new CustomPostType('theme_base', 'faq', 'FAQ', 'FAQs', 2, 'Description');
add_action('init', [$faq, 'register']);
