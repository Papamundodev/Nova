<?php
$post = $args['post'] ?? null;
$title = wp_trim_words($post->post_title, 8, '...');
$content = wp_trim_words(apply_filters('the_content', $post->post_excerpt), 30, '...');
$featured_image = get_the_post_thumbnail_url($post, 'medium');
$link = get_the_permalink($post->ID);
$expertises = get_the_terms($post->ID, 'expertises');
$categories = get_the_terms($post->ID, 'category');
?>
<article class="post-preview  card-hover-primary-color">
    <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= get_the_title($post->ID); ?>">
    <div class="expertise-container">
        <?php $i = 0;
        $expertises = get_the_terms($post->ID, 'expertises');
        if ($expertises && count($expertises) > 0) :
            foreach ($expertises as $expertise) :
                if ($i < 2) :
                    $cat_color = get_field('color', $expertise);
                    $category_link = get_term_link($expertise); ?>
                    <span class="expertise-link"><a class="btn <?= $cat_color; ?>-color" href="<?= $category_link; ?>"><?= $expertise->name; ?></a></span>
            <?php endif;
                $i++;
            endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="category-container">
        <?php $i = 0;
        $categories = get_the_terms($post->ID, 'category');
        if ($categories && count($categories) > 0) :
            foreach ($categories as $category) :
                if ($i < 2) :
                    $cat_color = get_field('color', $category);
                    $cat_link = get_term_link($category); ?>
                    <div class="category-link bg-<?= $cat_color; ?>-color"><a class="btn" href="<?= $cat_link; ?>"><?= $category->name; ?></a></div>
            <?php endif;
                $i++;
            endforeach; ?>
        <?php endif; ?>
    </div>
    <h3><?= $title; ?></h3>
    <div class="post-preview-content"><?= $content; ?></div>
    <a href="<?= $link; ?>" class="stretched-link"></a>
</article>