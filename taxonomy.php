<?php
get_header();
global $wp_query;
$posts = $wp_query->posts;
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$content = wpautop($object->description) ?? "";
?>

    <main id="main-<?=$theme_template_name?>">

    <section id="taxonomy-<?=$object->slug?>" class="taxonomy section">

        <!-- Page Title -->
        <div class="wrapper">
            <div class="page-title">
                <h1><?=$object->name?></h1>
            </div><!-- End Page Title -->
        </div>


        <div class="wrapper">
            <?php if(is_array($wp_query->posts) && count($wp_query->posts) > 0): ?>
                <div class="">
                    <?php foreach ($wp_query->posts as $post) : setup_postdata($post); ?>
                        <div class="post-preview">
                            <?php get_template_part('partials/article/post-preview', null, ['post' => $post]); ?>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
                <?php get_template_part('pagination'); ?>
            <?php endif; ?>
        </div>
    </section>
    </main>

<?php
get_footer();