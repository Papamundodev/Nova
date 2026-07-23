<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
?>

<main id="main-<?= $theme_template_name ?>" class="">


    <?php
    if (have_posts()):

        while (have_posts()):
            the_post();
            get_template_part('partials/article/post-full');
        endwhile;

    endif;
    ?>


    <?php
    $taxonomy = "category";
    $object = get_queried_object();
    $is_wp_post = $object instanceof WP_Post;
    $related_categories = wp_get_post_terms($object->ID, 'category');
    $related_categories_ids = array_map(function ($category) {
        return $category->term_id;
    }, $related_categories);
    if ($is_wp_post && !empty($related_categories_ids)) {
        if (!empty($related_categories_ids) && !is_wp_error($related_categories_ids)) {
            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $related_categories_ids
            );
        }
    }

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'post__not_in' => array($object->ID),
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }
    $query = new WP_Query($args);
    if ($query->have_posts()): ?>
        <section aria-labelledby="section-related-posts-title" id="section-related-posts" class="section-related-posts slider " data-slider-related-posts data-count="<?= count($query->posts); ?>">
            <div class="section-related-posts-header ">
                <h2 id="section-related-posts-title" class="section-title">Articles liés</h2>
                <?php if (count($query->posts) >= 3) : ?>
                    <div class="wrapper-button-container">
                        <div class="slide-button-container">
                            <button class="slide-button-prev slide-button btn" data-slider-prev-related-posts type="button" aria-label="<?= esc_attr(__('Article lié précédent', 'theme_base') ?: 'Article lié précédent'); ?>">
                                <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?></span>
                            </button>
                        </div>
                        <div class="slide-button-container">
                            <button class="slide-button-next slide-button btn" data-slider-next-related-posts type="button" aria-label="<?= esc_attr(__('Article lié suivant', 'theme_base') ?: 'Article lié suivant'); ?>">
                                <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?></span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="slider-wrapper related-posts-wrapper" data-slider-wrapper-related-posts>
                <?php foreach ($query->posts as $post) : ?>
                    <div class="slide">
                        <?php get_template_part('partials/article/post-preview', null, ['post' => $post]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php
get_footer();
