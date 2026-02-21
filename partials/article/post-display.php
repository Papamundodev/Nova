    <section aria-labelledby="section-blog-title" class="section-blog container">
        <?php $section_blog_title = get_field('section_blog_title', $object); ?>
        <h2 id="section-blog-title" class="section-title"><?= $section_blog_title; ?></h2>
        <div class="blog-container column-layout">
            <?php
            $query = new WP_Query(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            $recents_posts = $query->get_posts();
            wp_reset_postdata();
            ?>
            <?php foreach ($recents_posts as $post) : ?>
                <?php get_template_part('partials/article/post-preview', null, ['post' => $post]); ?>
            <?php endforeach; ?>
        </div>
    </section>