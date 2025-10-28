<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
?>

    <main id="main-<?=$theme_template_name?>" class="">

        <section class="section">
            <div class="wrapper content">
                <h1>404</h1>
                <p>Page not found</p>
                <p>The page you are looking for does not exist.</p>
                <a href="<?=home_url()?>" class="">Go back to home</a>
            </div>
        </section>
    </main>

<?php
get_footer();