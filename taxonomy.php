<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
global $wp_query;
?>

<main id="main-<?= $theme_template_name ?>" class="">

    <section aria-labelledby="intro-title" class="section-intro container">
        <div class="intro-content-container">
            <h1 id="intro-title" class="title-gradient"><?= $object->name; ?></h1>
        </div>
    </section>


    <section aria-labelledby="section-blog-title" class="section-blog container">
        <div class="product-grid">
            <?php if (is_array($wp_query->posts) && count($wp_query->posts) > 0): ?>
                <?php foreach ($wp_query->posts as $post) : ?>
                    <?php if (get_post_type($post) === 'post') : ?>
                        <?php get_template_part('partials/article/post-preview', null, ['post' => $post]); ?>
                    <?php endif; ?>
                <?php endforeach;
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php get_template_part('pagination'); ?>
    </section>

</main>

<?php
get_footer();
