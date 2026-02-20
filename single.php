<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
?>

<main id="main-<?=$theme_template_name?>" class="">


        <?php
        if ( have_posts() ):

            while ( have_posts() ):
                the_post(); 
                get_template_part( 'partials/article/post-full' );
            endwhile;

        endif;
        ?>

        <section aria-labelledby="section-related-posts-title" class="section-related-posts">
            <div class="container">
                <h2 id="section-related-posts-title" class="section-title">Related posts</h2>
                <div class="related-posts-container blog-container">
                    <?php 
                    $taxonomy = "category";
                    $object = get_queried_object();
                    $is_wp_post = $object instanceof WP_Post;
                    $related_categories = wp_get_post_terms($object->ID, 'category');
                    $related_categories_ids = array_map(function($category){
                        return $category->term_id;
                    }, $related_categories);
                    if ($is_wp_post && !empty($related_categories_ids)) {
                        if(!empty($related_categories_ids) && !is_wp_error($related_categories_ids)) {
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
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );
                    if (!empty($tax_query)){
                        $args['tax_query'] = $tax_query;
                    }
                    $query = new WP_Query($args);
                    foreach($query->posts as $post):
                        setup_postdata($post);
                        get_template_part('partials/article/post-preview', null, ['post' => $post]);
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

</main>

<?php
get_footer();