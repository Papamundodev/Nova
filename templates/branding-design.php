<?php

/**
 * Template Name: Branding Desygn Page
 */
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$featured_image = get_the_post_thumbnail_url($object->ID);
$content = wpautop($object->post_content);
?>


<main id="main-<?= $theme_template_name ?>" class="main">
    <div class="section-light">

        <section aria-labelledby="intro-title" class="section-intro container">
            <?php
            $intro = get_field('intro', $object);
            ?>
            <div class="section-content">
                <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
                <div class="button-pills">
                    <a href="<?= $intro['button_link']['url']; ?>" class="btn"><?= $intro['button_link']['title']; ?> </a>
                </div>
                <div class="intro-content-container">
                    <h2><?= $intro['subtitle']; ?></h2>
                    <div class="description content-wysiwyg"><?= $intro['description']; ?></div>
                </div>
            </div>
            <div class="animation-moving">

                <div class="flying-img-container-primary">
                    <?php echo file_get_contents(get_template_directory() . '/assets/images/star-1.svg'); ?>
                </div>
                <div class="flying-img-container-secondary">
                    <?php echo file_get_contents(get_template_directory() . '/assets/images/star-2.svg'); ?>
                </div>
                <div class="flying-img-container-tertiary">
                    <?php echo file_get_contents(get_template_directory() . '/assets/images/star-3.svg'); ?>
                </div>
            </div>
        </section>


        <section class="section-design-system">
            <h2 class="">Design System</h2>
            <svg xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -8" result="goo" />
                        <feBlend in="SourceGraphic" in2="goo" />
                    </filter>
                </defs>
            </svg>
            <div class="gradient-container">
                <div class="g1"></div>
                <div class="g2"></div>
                <div class="g3"></div>
                <div class="g4"></div>
                <div class="g5"></div>
                <div class="g6"></div>
                <div class="interactive"></div>
            </div>
        </section>

    </div>
</main>


<?php get_footer();
