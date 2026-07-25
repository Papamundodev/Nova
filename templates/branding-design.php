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
    </div>


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

    <?php
    $section_banner = get_field('section_banner', $object->ID) ?: [];
    $section_banner_title = $section_banner['title'] ?? '';
    $section_banner_logos = (isset($section_banner['logos']) && is_array($section_banner['logos'])) ? $section_banner['logos'] : [];
    ?>
    <?php if ($section_banner_logos) : ?>
        <section aria-labelledby="section-banner-title" class="section-banner-logos container">
            <?php if ($section_banner_title) : ?>
                <h2 id="section-banner-title" class="section-title"><?= $section_banner_title ?></h2>
            <?php endif; ?>
            <div class="scroller-logos">
                <div class="scroller-inner">
                    <?php
                    if (!empty($section_banner_logos)): ?>
                        <?php foreach ($section_banner_logos as $banner): ?>
                            <?php if (isset($banner['link']) && $banner['link']) : ?>
                                <a href="<?= $banner['link']; ?>" target="_blank" class="img-container">
                                    <img src="<?= $banner['image']['sizes']['partner_logo'] ?? $banner['image']['sizes']['medium'] ?? $banner['image']['url']; ?>" alt="parterns images and link to the partner website">
                                </a>
                            <?php else : ?>
                                <div class="img-container">
                                    <img src="<?= $banner['image']['sizes']['partner_logo'] ?? $banner['image']['sizes']['medium'] ?? $banner['image']['url']; ?>" alt="parterns images and link to the partner website">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $section_projects = get_field('projects', "option");
    ?>
    <?php if (!empty($section_projects)) : ?>
        <section aria-labelledby="section-related-projects-title" id="section-related-projects" class="section-related-projects  slider " data-slider-related-projects data-count="<?= count($section_projects); ?>">
            <div class="section-related-posts-header ">
                <h2 id="section-related-posts-title" class="section-title">Nos projets en <?= get_the_title($object); ?></h2>
                <?php if (count($section_projects) > 1) : ?>
                    <div class="wrapper-button-container">
                        <div class="slide-button-container">
                            <button class="slide-button-prev slide-button btn" data-slider-prev-related-projects type="button" aria-label="<?= esc_attr(__('Article lié précédent', 'theme_base') ?: 'Article lié précédent'); ?>">
                                <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?></span>
                            </button>
                        </div>
                        <div class="slide-button-container">
                            <button class="slide-button-next slide-button btn" data-slider-next-related-projects type="button" aria-label="<?= esc_attr(__('Article lié suivant', 'theme_base') ?: 'Article lié suivant'); ?>">
                                <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?></span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="slider-wrapper related-projects-wrapper" data-slider-wrapper-related-projects>
                <?php foreach ($section_projects as $index => $project) : ?>
                    <?php
                    $page_expertises = get_the_terms($object, 'expertises');
                    $project_expertises = $project['expertises'] ?? [];
                    $display_project = false;
                    if (!empty($page_expertises) && !is_wp_error($page_expertises) && !empty($project_expertises)) {
                        $page_term_ids = wp_list_pluck($page_expertises, 'term_id');
                        foreach ($project_expertises as $expertise) {
                            if (in_array((int) $expertise->term_id, array_map('intval', $page_term_ids), true)) {
                                $display_project = true;
                                break;
                            }
                        }
                    }
                    if (!$display_project) {
                        continue;
                    }

                    ?>
                    <div class="slide <?= count($section_projects) < intval(3) ? 'no-slider' : ' ' ?>">
                        <div class="reference-item layout-left-right">
                            <div class="layout-img">
                                <?php if (!empty($project['gallery'])) : ?>
                                    <img src="<?= $project['gallery'][0]['sizes']['layout_img'] ?? $project['gallery'][0]['url']; ?>" alt="<?= esc_attr($project['gallery'][0]['alt']); ?>" loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div class="layout-content">
                                <div>
                                    <h3><?= $project['title']; ?></h3>
                                    <?php $i = 0; ?>
                                    <div class="category-container">
                                        <?php
                                        if ($project['expertises'] && count($project['expertises']) > 0) :
                                            foreach ($project['expertises'] as $term_id) :
                                                if ($i < 2) :
                                                    $term = get_term(intval($term_id->term_id), 'expertises');
                                                    $cat_color = get_field('color', $term);
                                                    $category_link = get_term_link($term); ?>
                                                    <div class="category-link bg-<?= $cat_color; ?>-color"><a class="btn" href="<?= $category_link; ?>"><?= $term->name; ?></a></div>
                                            <?php endif;
                                                $i++;
                                            endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="description content-wysiwyg"><?= $project['text']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

</main>


<?php get_footer();
