<?php
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$featured_image = get_the_post_thumbnail_url($object->ID);
$content = wpautop($object->post_content);
$logo_landscape = get_field('logo_landscape', 'option');
$logo_square = get_field('logo_square', 'option');
$logo = get_field('logo', 'option');
?>


<main id="main-<?= $theme_template_name ?>" class="main">


    <section aria-labelledby="intro-title" class="section-intro container">
        <?php
        $intro = get_field('intro', $object);
        ?>
        <div class="section-content">
            <div class="intro-content-container">
                <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
                <p><?= $intro['text']; ?></p>
            </div>
            <div class="button-background-primary button-background-animation">
                <a href="<?= $intro['button_link']; ?>" class="btn"><?= $intro['button_text']; ?></a>
                <span class="hover-bg"></span>
            </div>
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

    <section aria-labelledby="section-our_values-title layout-left-right" class="section-our_values">
        <?php
        $our_values = get_field('our_values', $object);
        ?>
        <div class="layout-img">
            <img src="<?= $our_values['image']['url']; ?>" alt="<?= $our_values['image']['alt']; ?>">
        </div>
        <div class="layout-content">
            <div>
                <h2 id="section-our_values-title"><?= $our_values['title']; ?></h2>
                <p><?= wpautop($our_values['text']); ?></p>
                <div class="button-background-primary button-background-animation">
                    <a href="<?= $our_values['button_link']; ?>" class="btn"><?= $our_values['button_text']; ?></a>
                    <span class="hover-bg"></span>
                </div>
            </div>
        </div>
    </section>

    <section aria-labelledby="section-expertise-title" class="section-expertise container">
        <?php
        $expertises = get_field('expertises', $object);
        ?>
        <h2 id="section-expertise-title" class="section-title"><?= $expertises['title']; ?></h2>
        <div class="expertise-container">
            <?php $i = 0;
            foreach ($expertises['expertise'] as $item) : ?>
                <?php
                $term_id = $item['category'];
                $term = get_term_by('term_id', $term_id, 'expertises');
                $color = get_field('color', $term);
                $term_link = get_term_link($term);
                ?>

                <div id="expertise-<?= sanitize_title($item['title']); ?>" class="expertise accent-<?= $color; ?>-color" aria-labelledby="expertise-title">
                    <style>
                        #main-<?= $theme_template_name ?>.section-expertise .expertise.accent-<?= $color; ?>-color:hover {
                            svg path {
                                fill: var(--<?= $color; ?>-color);
                                stroke: var(--<?= $color; ?>-color);
                            }

                            p {
                                color: var(--<?= $color; ?>-color);
                            }
                        }
                    </style>
                    <span class="expertise-number <?= $color; ?>-color">0<?= $i + 1; ?></span>
                    <h3 id="expertise-title-<?= $i; ?>" class="expertise-title <?= $color; ?>-color"><?= $item['title']; ?></h3>
                    <p class="expertise-text"><?= $item['text']; ?></p>
                </div>
            <?php $i++;
            endforeach; ?>
        </div>
    </section>

    <section aria-labelledby="section-reviews-title" class="section-reviews ">
        <?php
        $portfolio = get_field('portfolio', "option");
        ?>
        <?php $section_reviews_title = get_field('section_reviews_title', $object); ?>
        <div class="review">
            <div class="layout-img">
                <img src="<?= $portfolio['url']; ?>" alt="<?= "découvrez notre portfolio"; ?>">
            </div>
            <div class="layout-content review-content">
                <div>
                    <h2 id="section-reviews-title" class=""><?= $section_reviews_title; ?></h2>
                    <div class="button-container button-background-secondary-icon">
                        <a href="<?= home_url(); ?>" class="btn">
                            <span class="button-text">Découvrez notre Portfolio</span>
                            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section aria-labelledby="section-team-title" class="section-team container">
        <?php
        $team = get_field('team', "option");
        $section_team_title = get_field('section_team_title', $object);
        ?>
        <h2 id="section-team-title" class="section-title"><?= $section_team_title; ?></h2>
        <div class="team-container">
            <?php foreach ($team as $item) : ?>
                <div class="team-member card">
                    <a href="<?= home_url('/about/#member-' . sanitize_title($item['title'])); ?>">
                        <img src="<?= $item['image']['url']; ?>" class="team-member-picture" alt="<?= $item['image']['alt']; ?>">
                    </a>
                    <h3><?= $item['title']; ?></h3>
                    <p><?= $item['text']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


</main>


<?php
get_footer();
