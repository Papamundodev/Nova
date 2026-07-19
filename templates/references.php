<?php

/**
 * Template Name: references Page
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
            <div class="intro-content-container">
                <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
                <p><?= $intro['text']; ?></p>
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

    <section aria-labelledby="section-references-title" class="section-references container">
        <?php
        $section_references = get_field('section_ref', $object);
        ?>
        <?php foreach ($section_references as $index => $reference) : ?>
            <?php
            $category = $reference['category'];
            $title = $reference['title'];
            $description = $reference['description'];
            $gallery = $reference['gallery'];
            ?>
            <div class="reference-item layout-left-right">
                <div class="layout-img">
                    <?php if (!empty($gallery)) : ?>
                        <div class="slider references-gallery" id="section-references-gallery-<?= (int) $index; ?>" data-slider-gallery data-count="<?= count($gallery); ?>">
                            <div class="slider-wrapper gallery-wrapper" data-slider-wrapper-gallery>
                                <?php foreach ($gallery as $item) : ?>
                                    <div class="slide">
                                        <img src="<?= $item['sizes']['layout_img'] ?? $item['url']; ?>" alt="<?= esc_attr($item['alt']); ?>" loading="lazy">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($gallery) > 1) : ?>
                                <div class="wrapper-button-container">
                                    <div class="slide-button-container">
                                        <button class="slide-button-prev slide-button btn" data-slider-prev-gallery type="button" aria-label="<?= esc_attr(__('Image précédente', 'theme_base') ?: 'Image précédente'); ?>">
                                            <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?></span>
                                        </button>
                                    </div>
                                    <div class="slide-button-container">
                                        <button class="slide-button-next slide-button btn" data-slider-next-gallery type="button" aria-label="<?= esc_attr(__('Image suivante', 'theme_base') ?: 'Image suivante'); ?>">
                                            <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?></span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="layout-content">
                    <div>
                        <h3><?= $title; ?></h3>
                        <?php $i = 0; ?>
                        <div class="category-container">
                            <?php
                            if ($category && count($category) > 0) :
                                foreach ($category as $term_id) :
                                    if ($i < 2) :
                                        $term = get_term(intval($term_id), 'expertises');
                                        $cat_color = get_field('color', $term);
                                        $category_link = get_term_link($term); ?>
                                        <div class="category-link bg-<?= $cat_color; ?>-color"><a class="btn" href="<?= $category_link; ?>"><?= $term->name; ?></a></div>
                                <?php endif;
                                    $i++;
                                endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="description content-wysiwyg"><?= $description; ?></div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </section>
</main>


<?php get_footer();
