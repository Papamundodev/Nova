<?php
get_header();
global $wp_query;
$posts = $wp_query->posts;
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$content = wpautop($object->description) ?? "";
?>

    <main id="main-<?=$theme_template_name?>">

    <section id="archive-<?=$object->slug?>" class="archive section">

        <!-- Page Title -->
        <div class="wrapper">
            <div class="page-title">
                <h1><?=$object->name?></h1>
            </div><!-- End Page Title -->
        </div>

        <?php if($content) : ?>
            <div class="wrapper content">
                <?=$content;?>
            </div>
        <?php endif; ?>

    </section>
    </main>

<?php
get_footer();