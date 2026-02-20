<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
global $wp_query;
?>

<main id="main-<?=$theme_template_name?>" class="">

        <section aria-labelledby="intro-title" class="section-intro container">
            <div class="intro-content-container">
                <h1 id="intro-title" class="title-gradient"><?= $object->name; ?></h1>
            </div>
        </section>

        <section aria-labelledby="section-blog-title" class="section-blog container">
            <?php $section_blog_title = get_field('section_blog_title', $object); ?>
            <h2 id="section-blog-title" class="section-title"><?= $section_blog_title; ?></h2>
            <div class="blog-container ">
                 <?php if(is_array($wp_query->posts) && count($wp_query->posts) > 0): ?>
                <?php foreach ($wp_query->posts as $post) : ?>
                    <?php 
                    $link = get_the_permalink($post->ID); 
                    $excerpt = wp_trim_words(get_the_excerpt($post->ID), 30, '...');
                    ?>
                    <div class="blog-item card">
                        <div class="img-container">
                            <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= get_the_title($post->ID); ?>">
                        </div>
                        <div class="content-container">
                            <h3><?= $post->post_title; ?></h3>
                            <div class="cat-container">
                            <?php foreach (get_the_terms($post->ID, 'expertises') as $expertise) : ?>
                                <?php 
                                $color = get_field('color', $expertise);
                                $category_link = get_term_link($expertise);
                                ?>
                                <span class="expertise-number"><a class="<?=$color;?>-color" href="<?=$category_link;?>"><?=$expertise->name; ?></a></span>
                            <?php endforeach; ?>
                            </div>
                            <p><?= $excerpt; ?></p>
                            <div class="">
                                <div class="button-container button-background-secondary-icon button-wave-animation">
                                    <a href="<?= $link; ?>" class="btn" data-name="En savoir plus">
                                    <span class="button-text">En savoir plus</span>
                                    <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                    <?php get_template_part('pagination'); ?>
                <?php endif; ?>
            </div>
        </section>

</main>

<?php
get_footer();