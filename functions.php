<?php

use Theme_base\Base;
use Theme_base\CustomPostType;
use Theme_base\Taxonomy;
use Theme_base\Form;

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
// Temporary: trigger PageSpeed cron on dev page load (remove after testing)
add_action('template_redirect', function () {
    if (is_page('dev') && isset($_GET['run_pagespeed']) && current_user_can('manage_options')) {
        Base::runPageSpeedCron();
        wp_die('PageSpeed cron completed. Check options.');
    }
});

// PageSpeed cron: weekly API call, store scores in options
add_action('theme_base_pagespeed_weekly', [Base::class, 'runPageSpeedCron']);

add_action('init', function () {
    if (wp_next_scheduled('theme_base_pagespeed_weekly')) {
        return;
    }
    wp_schedule_event(time(), 'weekly', 'theme_base_pagespeed_weekly');
}, 99);
$expertises = new Taxonomy('theme_base', 'expertises', 'Expertise', 'Expertises', array('post'));
$expertises->associateToCustomPostType(array('post'));

// Initialize contact form handler
new Form();

$faq = new CustomPostType('theme_base', 'faq', 'FAQ', 'FAQs', 2, 'Description');
add_action('init', [$faq, 'register']);
