<?php
global $post;
$title = get_the_title();
$content = get_the_content();
$content = wpautop($content);
$featured_image = get_the_post_thumbnail_url($post, "large");
$date_published = get_the_date();
$reading_time = \Theme_base\Base::get_reading_time($content);
?>

<article class="post-full">

    <div class="container">

        <h1 class="title-gradient"><?=$title;?></h1>

        <?php
        $breadcrumbs = \Theme_base\Base::get_breadcrumbs();
        ?>

        <div class="post-header">
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
                <span><?=$date_published;?></span>
                <span class="separator"></span>
                <span><?=$reading_time;?></span>
            </div>
        </div>


        <?php if ($featured_image) : ?>
            <div class="img-container">
                <img src="<?=$featured_image; ?>" alt="<?=$title; ?>" class="post-image">
            </div>
        <?php endif; ?>

        <div class="post-content">
            <?= wpautop($content);?>
        </div>
    </div>
</article>