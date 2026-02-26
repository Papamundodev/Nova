<footer>

    <section aria-labelledby="section-form-title" class="section-contact-form">
        <div class="container">
            <?php
            $section_form_title = get_field('section_form_title', "option") ?: 'Contactez-nous';
            $section_form_image = get_field('section_form_image', "option") ?: '';
            ?>
            <div class="layout-left-right">
                <div class="layout-img">
                    <img src="<?= $section_form_image['url']; ?>" alt="<?= $section_form_image['alt']; ?>">
                </div>
                <div class="layout-content">
                    <h2 id="section-form-title" class="section-title"><?= esc_html($section_form_title); ?></h2>
                    <?php get_template_part('partials/form'); ?>
                </div>
            </div>
        </div>
    </section>

    <div class="section-light">
        <section aria-labelledby="section-faq-title" class="section-faq">
            <div class="container">
                <h2 id="section-faq-title" class="section-title">Faq</h2>

                <?php
                $taxonomy = "category";
                $object = get_queried_object();
                $is_wp_post = $object instanceof WP_Post;
                $faq_categories = get_field('faq_categories', $object);
                if ($is_wp_post && !empty($faq_categories)) {
                    if (!empty($faq_categories) && !is_wp_error($faq_categories)) {
                        $tax_query[] = array(
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $faq_categories
                        );
                    }
                }
                $args = array(
                    'post_type' => 'faq',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                );
                if (!empty($tax_query)) {
                    $args['tax_query'] = $tax_query;
                }
                $query = new WP_Query($args);
                wp_reset_postdata();
                ?>
                <?php $faq_i = 0; ?>
                <?php foreach ($query->posts as $faq) : ?>
                    <?php $faq_i++; ?>
                    <?php get_template_part('partials/faq', null, ['faq' => $faq, 'i' => $faq_i]); ?>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <section class="section-banner">
        <div class="scroller">
            <div class="scroller-inner">
                <?php
                $banner_text = get_field('banner_text', 'option');
                if (!empty($banner_text)): ?>
                    <p><?= $banner_text; ?></p>
                <?php endif; ?>
                <div class="svg-container">
                    <?php echo file_get_contents(get_template_directory() . '/assets/images/sun.svg'); ?>
                </div>

            </div>
        </div>
    </section>

    <div class="section-light">
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
        <section class="section-footer container">
            <?php
            $text = get_field('text', 'option');
            $button_contact_footer = get_field('button_contact_footer', 'option');
            $num_fr = get_field('num_fr', 'option');
            $num_en = get_field('num_en', 'option');
            $cities = get_field('cities', 'option');
            ?>
            <div>
                <h2><?= $text; ?></h2>
                <div class="button-container button-background-primary button-background-animation">
                    <a href="<?= $button_contact_footer['url']; ?>" class="btn"><?= $button_contact_footer['title']; ?></a>
                    <span class="hover-bg"></span>
                </div>
            </div>
            <div>
                <h3><?= __('Contact', 'theme_base'); ?></h3>
                <p><?= $num_fr; ?></p>
                <p><?= $num_en; ?></p>
            </div>
            <div>
                <h3><?= __('Où sommes-nous ?', 'theme_base'); ?></h3>
                <?php foreach ($cities as $city) : ?>
                    <p><?= $city['city']; ?></p>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section-footer-nav container">
            <div class="footer-nav-container">
                <div class="wrapper-navbar">
                    <?php get_template_part('partials/header/navbar-desktop', null, ['theme_location' => 'footer']); ?>
                </div>
                <div class="wrapper-navbar-policy">
                    <?php get_template_part('partials/header/navbar-desktop', null, ['theme_location' => 'policy']); ?>
                    <div class="wrapper-navbar footer-logo">
                        <p>@ <?= date('Y'); ?> </p>
                    </div>
                </div>
            </div>
        </section>

    </div>
</footer>
<a href="#" id="scroll-top" class="scroll-top" aria-label="<?php esc_attr_e('Retour en haut de la page', 'theme_base'); ?>" title="<?php esc_attr_e('Retour en haut de la page', 'theme_base'); ?>">
    <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-bold.svg'); ?>
</a>
<?php wp_footer(); ?>


<script>
    (function() {
        // Nettoyer l'URL après affichage des messages de formulaire
        const urlParams = new URLSearchParams(window.location.search);
        const hasFormParams = urlParams.has('form_success') || urlParams.has('form_error') || urlParams.has('form_errors');

        if (hasFormParams) {
            // Nettoyer l'URL sans recharger la page après un court délai
            setTimeout(function() {
                const cleanUrl = window.location.pathname;
                window.history.replaceState({}, document.title, cleanUrl);
            }, 100);
        }
    })();
</script>

</body>

</html>