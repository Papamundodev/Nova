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
            <?php $section_blob_title = get_field('section_blob_title', $object); ?>
            <h2 class=""><?= $section_blob_title ? $section_blob_title : get_the_title($object); ?></h2>
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

        <section class="section-3">
            <?php $section_3 = get_field('section_3', $object); ?>
            <div class="section-3-container container">
                <div class="section-3-content">
                    <div class="btn-pill">
                        <h2 class=""><?= $section_3['title']; ?></h2>
                    </div>
                    <h3><?= $section_3['subtitle']; ?></h3>
                </div>
                <div class="section-3-items">
                    <?php foreach ($section_3['items'] as $item) : ?>
                        <div class="section-3-item">
                            <div class="section-3-item-image">
                                <img src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt'] ?? $item['title']; ?>">
                            </div>
                            <div class="section-3-item-content">
                                <h4><?= $item['title']; ?></h4>
                                <div class="content-wysiwyg"><?= $item['text']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section-4">
            <?php $section_4 = get_field('section_4', $object); ?>
            <?php if ($section_4) : ?>
                <div class="section-4-container container">
                    <?php foreach ($section_4 as $item) : ?>
                        <?php
                        $section_loop = $item['section_loop'] ?? null;
                        if (!$section_loop) {
                            continue;
                        }
                        $title = $section_loop['title'] ?? '';
                        $text = $section_loop['text'] ?? '';
                        $section_img_content = $section_loop['section_img_content'] ?? [];
                        ?>
                        <?php if ($section_img_content || $title || $text) : ?>
                            <div class="section-4-item">
                                <?php if ($title) : ?>
                                    <h2><?= $title; ?></h2>
                                <?php endif; ?>
                                <?php if ($text) : ?>
                                    <div class="content-wysiwyg"><?= $text; ?></div>
                                <?php endif; ?>
                                <?php if ($section_img_content) : ?>
                                    <?php foreach ($section_img_content as $img_item) : ?>
                                        <?php
                                        $image = $img_item['image'] ?? null;
                                        $img_title = $img_item['title'] ?? '';
                                        $img_text = $img_item['text'] ?? '';
                                        ?>
                                        <div class="section-4-img-content">
                                            <?php if ($image) : ?>
                                                <div class="section-4-img-content-image">
                                                    <div class="section-4-item-image">
                                                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt'] ?? $img_title; ?>">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($img_title || $img_text) : ?>
                                                <div class="section-4-img-content-content">
                                                    <?php if ($img_title) : ?>
                                                        <h3><?= $img_title; ?></h3>
                                                    <?php endif; ?>
                                                    <?php if ($img_text) : ?>
                                                        <div class="content-wysiwyg"><?= $img_text; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>


<?php get_footer();
