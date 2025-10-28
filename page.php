<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$content = get_the_content();
$title = get_the_title();
?>

    <main id="main-<?=$theme_template_name?>">

        <section class="section">

            <!-- Page Title -->
            <div class="wrapper">
                <div class="page-title">
                    <h1><?=$title; ?></h1>
                </div><!-- End Page Title -->
            </div>

            <div class="wrapper content">
                <div class="content"><?=$content;?></div>
            </div>

        </section>

    </main>

<?php
get_footer();