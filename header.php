<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <script>
        (function () {
            var root = document.documentElement;
            root.classList.add('js');
            try {
                var saved = localStorage.getItem('preferred-theme');
                var theme = (saved === 'light-theme' || saved === 'dark-theme')
                    ? saved
                    : 'light-theme';
                root.classList.add(theme);
            } catch (e) {}
        })();
    </script>
    <meta name="title" content="<?= get_the_title() ?: get_bloginfo('name'); ?>">
    <meta name="description" content="<?= \Theme_base\Base::get_meta_description() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/fonts/Coda-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/fonts/Coda-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= get_template_directory_uri(); ?>/assets/fonts/RussoOne.woff2" as="font" type="font/woff2" crossorigin>
    <?php
    $schema_file = get_template_directory() . '/assets/schema-org.json';
    if (file_exists($schema_file)) {
        $schema = json_decode(file_get_contents($schema_file), true);
        if ($schema) {
            $schema_json = str_replace('https://collective-nova.fr', untrailingslashit(home_url()), wp_json_encode($schema));
            echo '<script type="application/ld+json">' . $schema_json . '</script>' . "\n";
        }
    }
    ?>
    <?php wp_head(); ?>
</head>



<body <?php body_class("header-fixed") ?>>
    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }
    ?>
    <div class="animation-moving-item"></div>
    <div class="container">
        <header class="header">
            <!-- Logo -->
            <div class="logo-container">
                <?php get_template_part('partials/header/logo'); ?>
            </div>

            <div class="nav-container">
                <div class="wrapper-navbar">
                    <?php get_template_part('partials/header/navbar-desktop', null, ['theme_location' => 'header']); ?>
                </div>
                <div class="wrapper-navbar">
                    <?php get_template_part('partials/header/navbar-mobile', null, ['theme_location' => 'header']); ?>
                </div>
            </div>

            <div class="button-wrapper">
                <div class="button-container button-background-primary button-background-animation">
                    <a href="<?= home_url() . '/#section-form-title'; ?>" class=""><?= __('Contactez-nous', 'theme_base'); ?></a>
                    <span class="hover-bg"></span>
                </div>
            </div>

            <div class="burger-menu-container">
                <button class="burger-container btn" popovertarget="navmenu-header-mobile" id="theme-navbar-toggler">
                    <div id="burger-menu" class="burger-menu">
                        <span class="custom-burger"></span>
                        <span class="custom-burger"></span>
                        <span class="custom-burger"></span>
                        <span class="custom-burger"></span>
                    </div>
                </button>
            </div>


        </header>


        <aside class="right-drawer">
            <?php get_template_part('partials/tool-kit'); ?>
        </aside>


    </div>