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
            <h2>Performance: <?= $perfCached !== null ? esc_html((string) $perfCached) : 'N/A'; ?></h2>
            <h2>Accessibility: <?= $accCached !== null ? esc_html((string) $accCached) : 'N/A'; ?></h2>
            <h2>Best practices: <?= $bestCached !== null ? esc_html((string) $bestCached) : 'N/A'; ?></h2>
            <h2>SEO: <?= $seoCached !== null ? esc_html((string) $seoCached) : 'N/A'; ?></h2>
        </div>
    </section>
</main>

<?php get_footer(); ?>