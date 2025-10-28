<?php
global $post;
$title = get_the_title();
$content = get_the_content();
$content = wpautop($content);
$featured_image = get_the_post_thumbnail_url($post, "large");
$date_published = get_the_date();
$reading_time = \Theme_base\Base::get_reading_time($content);
?>

<div class="post-full">

    <div class="text-content">
                        <?php
                $breadcrumbs = \Theme_base\Base::get_breadcrumbs();
                ?>

                <div id="breadcrumbs" class="breadcrumbs-custom">
                    <ul>
                        <?php foreach ($breadcrumbs as $breadcrumb): ?>
                            <?php if ($breadcrumb === end($breadcrumbs)): ?>
                                <li><a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['text'] ?></a></li>
                            <?php else: ?>
                                <li><a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['text'] ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
        <div class="post-title">
            <h1><?=$title;?></h1>
        </div>
        <div class="post-date">
            <span><?=$date_published;?></span>
            <span class="separator">|</span>
            <span><?=$reading_time;?></span>
        </div>

        <?php if ($featured_image) : ?>
            <div class="">
                <img src="<?=$featured_image; ?>" alt="<?=$title; ?>" class="post-image">
            </div>
        <?php endif; ?>

        <div class="post-content">
            <?=$content;?>
        </div>
    </div>

</div>