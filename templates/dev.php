<?php

use Theme_base\Base;

/**
 * Template Name: Dev Page
 */
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");

$url = 'https://collective-nova.fr/';

// Cached scores (from weekly cron) - use in production
$perfCached = get_option('pagespeed_scores', [])['performance'] ?? null;
$accCached = get_option('pagespeed_scores', [])['accessibility'] ?? null;
$bestCached = get_option('pagespeed_scores', [])['best-practices'] ?? null;
$seoCached = get_option('pagespeed_scores', [])['seo'] ?? null;
$lastUpdated = get_option('pagespeed_scores', [])['last_updated'] ?? null;


?>

<main id="main-<?= $theme_template_name ?>" class="main">
    <section class="section-dev">
        <div class="container">
            <h1 class="title-gradient">Dev</h1>
            <?php if ($lastUpdated) : ?>
                <p>Last cron update: <?= esc_html($lastUpdated); ?></p>
            <?php endif; ?>
            <div>
                <div>
                    <h2>Performance: <?= $perfCached !== null ? esc_html((string) $perfCached) : 'N/A'; ?></h2>
                    <ul>
                        <li>Better user experience to keep visitors on the page</li>
                        <li>Better SEO ranking to get more organic traffic.</li>
                        <li>Higher conversion rates for your business.</li>
                    </ul>
                </div>
                <div>
                    <h2>Accessibility: <?= $accCached !== null ? esc_html((string) $accCached) : 'N/A'; ?></h2>
                    <ul>
                        <li>Larger audience reach, your website becomes usable for everyone.</li>
                        <li>Better user experience for all visitors.</li>
                        <li>Legal compliance.</li>
                        <li>Stronger brand reputation.</li>
                        <li>Better compatibility across devices</li>
                    </ul>
                </div>
                <div>
                    <h2>Best practices: <?= $bestCached !== null ? esc_html((string) $bestCached) : 'N/A'; ?></h2>
                    <ul>
                        <li>Stronger website security for a more secure website for both the business and its users.</li>
                        <li>Sustainability , maintainability and reliability of the website.</li>
                        <li>Better search engine visibility.</li>
                    </ul>
                </div>
                <div>
                    <h2>SEO: <?= $seoCached !== null ? esc_html((string) $seoCached) : 'N/A'; ?></h2>
                    <ul>
                        <li>More organic traffic , for more conversions.</li>
                        <li>Stronger long-term online presence, to generate opportunities over time.</li>
                        <li>Check more on Marie's page.</li>
                    </ul>
                </div>
            </div>
            <p>Measured with Google Lighthouse — updated automatically.</p>
    </section>

    <section>
        <div class="container">
            <h2>How does Nova's developer work?</h2>
            <ul>
                <li>Design system (sass, scss)</li>
                <li>Vanilla stack (html, css, js, php, vite)</li>
                <li>Wordpress, astro, engine</li>
            </ul>
            <h2>what we propose ?</h2>
            <ul>
                <li>Custom theme for Wordpress (no plugins, no builder) -> BUILD A SITE and start your digital presence</li>
                <li>E-commerce specialist (WooCommerce, Astro) -> BUILD AN E-COMMERCE SITE that convert</li>
                <li>Integration web Passionné -> INTEGRATE any visual form templating tools like csm , twig, blade, etc.</li>
                <li>Create a SAAS for your business, you created a prototy with AI and you want to give it life ? or you need task automatisé for your business ? -> BUILD A SAAS</li>
                <li>Maintenance & Support -> MAINTENANCE & SUPPORT your wordpress website or e-commerce site</li>
                <li>consulting -> CONSULTING your business to improve your digital presence</li>
            </ul>
        </div>
    </section>
</main>

<?php get_footer(); ?>