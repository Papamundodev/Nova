<?php
$post = $args['post'];
$title = wp_trim_words($post->post_title, 10, '...');
$content = wp_trim_words(get_the_excerpt($post->ID), 100, '...');
$featured_image = get_the_post_thumbnail_url($post, 'medium');
$link = get_the_permalink($post->ID);
?>
<article class="blog-item card">
    <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= get_the_title($post->ID); ?>">
    <div class="cat-container">
    <?php foreach (get_the_terms($post->ID, 'expertises') as $expertise) : ?>
        <?php 
        $color = get_field('color', $expertise);    
        $expertise_link = get_term_link($expertise);
        ?>
        <span class="expertise-number"><a class="<?=$color;?>-color" href="<?=$expertise_link;?>"><?=$expertise->name; ?></a></span>
    <?php endforeach; ?>
    </div>
    <h3><?= $title; ?></h3>
    <div class="flex-center">
    <div class="button-container button-background-secondary-icon button-wave-animation">
        <a href="<?= $link; ?>" class="btn" data-name="En savoir plus">
        <span class="button-text">En savoir plus</span>
        <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
        </a>
    </div>
    </div>
</article>