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


<main id="main-<?=$theme_template_name?>" class="main">

    
        <section aria-labelledby="intro-title" class="section-intro container">
            <?php 
            $intro = get_field('intro', $object);
            ?>
            <div class="intro-content-container">
                <h1 id="intro-title" class="title-gradient"><?= $intro['title']; ?></h1>
                <p><?= $intro['text']; ?></p>
            </div>
            <div class="button-background-primary button-background-animation">
                <a href="<?= $intro['button_link']; ?>" class="btn"><?= $intro['button_text']; ?></a>
                <span class="hover-bg"></span>
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
                    <h2 id="section-our_values-title" ><?= $our_values['title']; ?></h2>
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
            <div class="expertise-container" >
                <?php $i = 0; foreach ($expertises['expertise'] as $item) : ?>
                    <?php 
                    $term_id = $item['category']; 
                    $term = get_term_by('term_id', $term_id, 'expertises');
                    $color = get_field('color', $term);
                    $term_link = get_term_link($term);
                    ?>

                    <div class="expertise accent-<?=$color;?>-color" aria-labelledby="expertise-title">
                        <style>
                            #main-<?=$theme_template_name?> .section-expertise .expertise.accent-<?=$color;?>-color:hover{
                                svg path {
                                    fill: var(--<?=$color;?>-color);
                                    stroke: var(--<?=$color;?>-color);
                                }
                                p {
                                    color: var(--<?=$color;?>-color);
                                }
                            }
                        </style>
                        <span class="expertise-number <?=$color;?>-color">0<?= $i + 1; ?></span>
                        <h3 id="expertise-title-<?=$i;?>" class="expertise-title <?=$color;?>-color"><?= $item['title']; ?></h3>
                        <p class="expertise-text"><?= $item['text']; ?></p>
                        <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                        <a href="<?= $term_link; ?>" class=""></a>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </section>
        <section aria-labelledby="section-projects-title" class="section-projects container">
            <?php $section_projet_title = get_field('section_projet_title', $object); ?>
            <h2 id="section-projects-title" class="section-title"><?= $section_projet_title; ?></h2>
            <div class="projects-container column-layout">
            <?php $projects = get_field('projects', "option"); ?>
                <?php foreach ($projects as $project) : ?>
                    <div class="project card">
                        <div class="img-container">
                            <img src="<?= $project['gallery'][0]['url']; ?>" alt="<?= $project['gallery'][0]['alt']; ?>">
                        </div>
                        <div class="cat-container">
                        <?php foreach ($project['expertises'] as $expertise) : ?>
                            <?php 
                            $color = get_field('color', $expertise);
                            ?>
                            <span class="expertise-number <?=$color;?>-color"><?=$expertise->name; ?></span>
                            <span class="separator">|</span>
                        <?php endforeach; ?>
                        </div>
                        <h3><?= $project['title']; ?></h3>      
                        <div class="button-container button-background-secondary-icon button-wave-animation">
                            <button class="btn" data-name="<?=$project['text'];?>">
                            <span class="button-text"><?=$project['text'];?></span>
                            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                            </button>
                        </div>
                    </div>
            <?php endforeach; ?>
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
                        <img src="<?= $item['image']['url']; ?>" alt="<?= $item['image']['alt']; ?>">
                        <h3><?= $item['title']; ?></h3>
                        <p><?= $item['text']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section aria-labelledby="section-reviews-title" class="section-reviews slider" data-slider>
            <?php $reviews = get_field('reviews', "option"); ?>
            <style>
                :root {
                    --slider-pages: <?= count($reviews); ?>;
                }
            </style>
            <?php $section_reviews_title = get_field('section_reviews_title', $object); ?>
            <div  class="slider-wrapper reviews-wrapper" data-slider-wrapper >
                <?php $i = count($reviews); foreach ($reviews as $review) : ?>
                    <div class="review slide  <?php if ($i === 0) { echo 'fade-in'; } else { echo 'fade-out'; } ?>" slide-number="<?=$i;?>">
                        <div class="layout-img">
                            <img src="<?= $review['image']['url']; ?>" alt="<?= $review['image']['alt']; ?>">
                        </div>
                        <div class="layout-content review-content">
                            <div>
                                <h2 id="section-reviews-title" class=""><?= $section_reviews_title; ?></h2>
                                <p><?= wpautop($review['text']); ?></p>
                                <p class="review-name"><?= $review['name']; ?></p>
                                <p><?= $review['job_title']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php $i--; endforeach; ?>
            </div>
           
                <nav class="slide-button-container "  role="navigation"  aria-labelledby="section-reviews-title" >
            <?php $i = count($reviews); foreach ($reviews as $review) : ?>
                    <button class="slide-bullet btn" data-slider-bullet="<?=$i;?>"></button>
                    <?php $i--; endforeach; ?>
                </nav>
     
        </section>
        <section aria-labelledby="section-blog-title" class="section-blog container">
            <?php $section_blog_title = get_field('section_blog_title', $object); ?>
            <h2 id="section-blog-title" class="section-title"><?= $section_blog_title; ?></h2>
            <div class="blog-container column-layout">
                <?php 
                $query = new WP_Query( array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                $recents_posts = $query->get_posts();
                wp_reset_postdata();
                 ?>
                <?php foreach ($recents_posts as $post) : ?>
                    <?php $link = get_the_permalink($post->ID); ?>
                    <div class="blog-item card">
                        <img src="<?= get_the_post_thumbnail_url($post->ID); ?>" alt="<?= get_the_title($post->ID); ?>">
                        <div class="cat-container">
                        <?php foreach (get_the_terms($post->ID, 'expertises') as $expertise) : ?>
                            <?php 
                            $color = get_field('color', $expertise);
                            ?>
                            <span class="expertise-number <?=$color;?>-color"><?=$expertise->name; ?></span>
                        <?php endforeach; ?>
                        </div>
                        <h3><?= $post->post_title; ?></h3>
                        <div class="flex-center">
                        <div class="button-container button-background-secondary-icon button-wave-animation">
                            <a href="<?= $link; ?>" class="btn" data-name="En savoir plus">
                            <span class="button-text">En savoir plus</span>
                            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                            </a>
                        </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </section>
</main>


<?php
get_footer();