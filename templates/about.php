<?php
/**
 * Template Name: About Page
 */
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$featured_image = get_the_post_thumbnail_url($object->ID);
$content = wpautop($object->post_content);
?>


<main id="main-<?=$theme_template_name?>" class="main">

        <section aria-labelledby="intro-title" class="section-intro container">
            <?php 
            $intro = get_field('intro', $object);
            ?>
            <div class="intro-content-container">
                <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
                <p><?= $intro['text']; ?></p>
            </div>
        </section>


        <section aria-labelledby="section-advantages-title" class="section-advantages">
            <?php 
            $advantages = get_field('advantages', $object);
            ?>
            <div class="container">
                <h2 id="section-our_values-title" ><?= $advantages['title']; ?></h2>
                <p><?= wpautop($advantages['text']); ?></p>
                <div class="advantages-container ">
                    <?php foreach ($advantages['value'] as $item) : ?>
                        <div>
                            <img src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>">
                            <h3><?= $item['title']; ?></h3>
                            <p><?= $item['text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section aria-labelledby="section-our_team-title" class="section-our_team">
            <?php 
            $team = get_field('team', 'option');
            $section_team_title = get_field('section_team_title', $object);
            ?>
            <div class="container">
                <h2 id="section-our_team-title" class="section-title"><?= $section_team_title; ?></h2>
                <?php foreach ($team as $item) : ?>
                    <div class="our-team-member">
                        <img src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>">
                        <div>
                        <h3><?= $item['title']; ?></h3>
                        <p><?= wpautop($item['long_text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section aria-labelledby="section-our_values-title" class="section-our_values">
            <?php 
            $our_values = get_field('our_values', $object);
            ?>
            <h2 id="section-our_values-title" class="section-title"><?= $our_values['title']; ?></h2>
            <div class="our-values-container">
                <?php foreach ($our_values['value'] as $item) : ?>
                    <div>
                        <img src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>">
                        <h3><?= $item['title']; ?></h3>
                        <p><?= $item['text']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>


</main>


<?php get_footer();