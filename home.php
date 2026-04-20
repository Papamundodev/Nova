<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
global $wp_query;
?>

<main id="main-<?= $theme_template_name ?>" class="">

    <section aria-labelledby="intro-title" class="section-intro container">
        <?php
        $intro = get_field('intro', $object);
        ?>
        <div class="section-content">
            <div class="intro-content-container">
                <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
                <p><?= $intro['text']; ?></p>
                <div class="button-background-primary button-background-animation">
                    <a href="<?= $intro['link']['url']; ?>" class="btn"><?= $intro['link']['title']; ?></a>
                    <span class="hover-bg"></span>
                </div>
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

    <?php
    if ($wp_query->have_posts()): ?>
        <section aria-labelledby="section-featured-posts-title" id="section-featured-posts" class="section-featured-posts slider " data-slider-featured-posts data-count="<?= count($wp_query->posts); ?>">
            <div class="section-featured-posts-header ">
                <h2 id="section-featured-posts-title" class="section-title">Regarder nos derniers articles en vedette</h2>
                <?php if (count($wp_query->posts) > 1) : ?>
                    <div class="wrapper-button-container">
                        <div class="slide-button-container">
                            <button class="slide-button-prev slide-button btn" data-slider-prev-featured-posts type="button" aria-label="<?= esc_attr(__('Article en vedette précédent', 'theme_base') ?: 'Article en vedette précédent'); ?>">
                                <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?></span>
                            </button>
                        </div>
                        <div class="slide-button-container">
                            <button class="slide-button-next slide-button btn" data-slider-next-featured-posts type="button" aria-label="<?= esc_attr(__('Article en vedette suivant', 'theme_base') ?: 'Article en vedette suivant'); ?>">
                                <span aria-hidden="true"><?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?></span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="slider-wrapper featured-posts-wrapper" data-slider-wrapper-featured-posts>
                <?php foreach ($wp_query->posts as $post) : ?>
                    <div class="slide">
                        <?php get_template_part('partials/article/post-preview', null, ['post' => $post]); ?>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif; ?>

    <section aria-labelledby="section-blog-title" class="section-blog container">
        <div class="product-grid">
            <?php if (is_array($wp_query->posts) && count($wp_query->posts) > 0): ?>
                <?php foreach ($wp_query->posts as $post) : ?>
                    <?php get_template_part('partials/article/post-preview', null, ['post' => $post]); ?>
                <?php endforeach;
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php get_template_part('pagination'); ?>
    </section>

</main>

<?php
get_footer();
