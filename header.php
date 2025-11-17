<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?></title>   
    <meta name="description" content="<?= \Theme_base\Base::get_meta_description() ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">	
    <?php wp_head(); ?>
</head>
<body <?php body_class("header-fixed") ?>>
<?php
if (function_exists('wp_body_open')){
    wp_body_open() ;
}
?>

<header class=" header">
        <!-- Logo -->
    <div class="wrapper">
        <?php get_template_part('partials/header/logo'); ?>
    </div>

    <div class="wrapper-navbar">
        <?php get_template_part('partials/header/navbar-desktop', null, ['theme_location' => 'header']); ?>
    </div>
    <div class="wrapper-navbar">
        <?php get_template_part('partials/header/navbar-mobile', null, ['theme_location' => 'header']); ?>
    </div>


            <?php if (function_exists('theme_light_dark_form')): ?>
            <div class="wrapper-theme-light-dark">
                <?=do_shortcode('[theme_light_dark]'); ?>
            </div>
        <?php endif; ?>

    <div class="wrapper">
        <button popovertarget="navmenu-header-mobile" id="theme-navbar-toggler">
            <span class="custom-burger"></span>
            <span class="custom-burger"></span>
            <span class="custom-burger"></span>
            <span class="custom-burger"></span>
        </button>
    </div>


</header>

