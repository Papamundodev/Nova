<?php
$project = $args['project'] ?? null;
$index = $args['index'] ?? 0;
?>

<div class="project-preview layout-left-right">
    <div class="layout-img">
        <?php if (!empty($project['gallery'])) : ?>
            <div class="slider references-gallery" id="section-references-gallery-<?= (int) $index; ?>" data-slider-gallery data-count="<?= count($project['gallery']); ?>">
                <div class="slider-wrapper gallery-wrapper" data-slider-wrapper-gallery>
                    <?php foreach ($project['gallery'] as $item) : ?>
                        <div class="slide">
                            <img src="<?= $item['sizes']['layout_img'] ?? $item['url']; ?>" alt="<?= esc_attr($item['alt']); ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($project['gallery']) > 1) : ?>
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