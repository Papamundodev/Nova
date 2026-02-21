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


<main id="main-<?= $theme_template_name ?>" class="main">

    <section aria-labelledby="intro-title" class="section-intro container">
        <?php
        $intro = get_field('intro', $object);
        ?>
        <div class="intro-content-container">
            <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
            <p><?= $intro['text']; ?></p>
        </div>
        <div class="animation-moving">
            <div class="flying-img-container-primary">
                <?php echo file_get_contents(get_template_directory() . '/assets/images/star-1.svg'); ?>
            </div>
            <div class="flying-img-container-secondary">
                <?php echo file_get_contents(get_template_directory() . '/assets/images/star-2.svg'); ?>
            </div>
            <div class="flying-img-container-tertiary">
                <?php echo file_get_contents(get_template_directory() . '/assets/images/star-3.svg'); ?>
            </div>
        </div>
    </section>


    <section aria-labelledby="section-advantages-title" class="section-advantages">
        <?php
        $advantages = get_field('advantages', $object);
        ?>
        <div class="container">
            <h2 id="section-our_values-title"><?= $advantages['title']; ?></h2>
            <div class="text-container">
                <?= wpautop($advantages['text']); ?>
            </div>
        </div>
        <div class="advantages-container">
            <div class="container">
                <?php foreach ($advantages['value'] as $item) : ?>
                    <div class="advantage-item">
                        <img src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>">
                        <h3><?= $item['title']; ?></h3>
                        <div> <?= wpautop($item['text']); ?></div>
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
                <div id="member-<?= sanitize_title($item['title']); ?>" class="our-team-member">
                    <img src="<?= $item['image']['url']; ?>" class="team-member-picture" alt="<?= $item['image']['alt']; ?>">
                    <div>
                        <h3><?= $item['title']; ?></h3>
                        <div><?= wpautop($item['long_text']); ?></div>
                        <div class="social-container">
                            <?php
                            $malt = $item['malt'];
                            $linkedin = $item['linkedin'];
                            $link = $item['link'];

                            ?>
                            <a class="social-item" href="<?= $malt; ?>" target="_blank">
                                <?php echo file_get_contents(get_template_directory() . '/assets/images/malt.svg'); ?>
                            </a>
                            <a class="social-item" href="<?= $linkedin; ?>" target="_blank">
                                <?php echo file_get_contents(get_template_directory() . '/assets/images/linkedin.svg'); ?>
                            </a>
                            <div class="button-wrapper">
                                <div class="button-container button-background-white button-background-animation">
                                    <a class="cv-link" href="<?= $link['url']; ?>" target="<?= $link['target'] ?? '_blank'; ?>">
                                        <?= $link['title']; ?>
                                    </a>
                                    <span class="hover-bg"></span>
                                </div>
                            </div>
                        </div>
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
