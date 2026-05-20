<?php
global $post;
$title = get_the_title();
$content = $post->post_content;
$featured_image = get_the_post_thumbnail_url($post, "large");
$date_published = get_the_date();
$reading_time = \Theme_base\Base::get_reading_time($content);
$categories = get_the_terms($post->ID, 'category');
?>

<article class="post-full container">

    <?php if ($featured_image) : ?>
        <div class="img-container">
            <img src="<?= $featured_image; ?>" alt="<?= $title; ?>" class="post-image">
        </div>
    <?php endif; ?>

    <div class="post-categories">
        <?php foreach ($categories as $category): ?>
            <?php $color = get_field('color', $category); ?>
            <span class="category-link bg-<?= $color; ?>-color"><a class="btn" href="<?= $category->link; ?>"><?= $category->name; ?></a></span>
        <?php endforeach; ?>
    </div>

    <h1 class="title-gradient"><?= $title; ?></h1>




    <?php
    $breadcrumbs = \Theme_base\Base::get_breadcrumbs();
    ?>

    <!-- <div class="post-header">
        <div id="breadcrumbs" class="breadcrumbs-custom">
            <ul>
                <?php foreach ($breadcrumbs as $breadcrumb): ?>
                    <?php if ($breadcrumb !== end($breadcrumbs)): ?>
                        <li><a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['text'] ?></a></li>
                        <li><span class="separator"></span></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="post-date">
            <span><?= $date_published; ?></span>
            <span class="separator"></span>
            <span><?= $reading_time; ?></span>
        </div>
    </div> -->
    <div class="post-content content-wysiwyg">
        <?= $content; ?>
    </div>

</article>