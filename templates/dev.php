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
    <section class="section-dev container" aria-labelledby="section-dev-title">
        <h1 id="section-dev-title" class="title-gradient">Le développement Nova</h1>
        <div class="scores-grid">
            <?php if ($perfCached !== null) : ?>
                <?php
                $pct = (float) $perfCached;
                $degree = ($pct / 100) * 360;
                ?>
                <div class="score-item" data-tab="performance">
                    <p>Performance</p>
                    <div class="border-animation" data-pourcentage="<?= esc_attr($pct); ?>" style="--pourcentage: <?= esc_attr($pct); ?>%; --degree: <?= esc_attr($degree); ?>deg;">
                        <div class="numbers-border">
                            <div class="point"></div>
                            <span class="odometer border-odometer" data-odometer-value="<?= esc_attr($pct); ?>"><?= esc_html($pct); ?></span><span class="odometer-suffix">%</span>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <span>N/A</span>
            <?php endif; ?>
            <?php if ($accCached !== null) : ?>
                <?php
                $pct = (float) $accCached;
                $degree = ($pct / 100) * 360;
                ?>
                <div class="score-item" data-tab="accessibility">
                    <p>Accessibility</p>
                    <div class="border-animation" data-pourcentage="<?= esc_attr($pct); ?>" style="--pourcentage: <?= esc_attr($pct); ?>%; --degree: <?= esc_attr($degree); ?>deg;">
                        <div class="numbers-border">
                            <div class="point"></div>
                            <span class="odometer border-odometer" data-odometer-value="<?= esc_attr($pct); ?>"><?= esc_html($pct); ?></span><span class="odometer-suffix">%</span>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <span>N/A</span>
            <?php endif; ?>
            <?php if ($bestCached !== null) : ?>
                <?php
                $pct = (float) $bestCached;
                $degree = ($pct / 100) * 360;
                ?>
                <div class="score-item" data-tab="best-practices">
                    <p>Best Practices</p>
                    <div class="border-animation" data-pourcentage="<?= esc_attr($pct); ?>" style="--pourcentage: <?= esc_attr($pct); ?>%; --degree: <?= esc_attr($degree); ?>deg;">
                        <div class="numbers-border">
                            <div class="point"></div>
                            <span class="odometer border-odometer" data-odometer-value="<?= esc_attr($pct); ?>"><?= esc_html($pct); ?></span><span class="odometer-suffix">%</span>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <span>N/A</span>
            <?php endif; ?>
            <?php if ($seoCached !== null) : ?>
                <?php
                $pct = (float) $seoCached;
                $degree = ($pct / 100) * 360;
                ?>
                <div class="score-item" data-tab="seo">
                    <p>SEO</p>
                    <div class="border-animation" data-pourcentage="<?= esc_attr($pct); ?>" style="--pourcentage: <?= esc_attr($pct); ?>%; --degree: <?= esc_attr($degree); ?>deg;">
                        <div class="numbers-border">
                            <div class="point"></div>
                            <span class="odometer border-odometer" data-odometer-value="<?= esc_attr($pct); ?>"><?= esc_html($pct); ?></span><span class="odometer-suffix">%</span>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <span>N/A</span>
            <?php endif; ?>
        </div>
        <div>
            <?php if ($lastUpdated) : ?>
                <div class="last-updated">
                    <p>Dernière mise à jour cron : <?= esc_html($lastUpdated); ?></p>
                    <p>Mesuré avec Google Lighthouse — mis à jour automatiquement.</p>
                </div>
                <div class="tabs-content">
                    <div class="tab-content tab-performance" data-tab="performance">
                        <h2 class="section-title">Performance</h2>
                        <p>A Lighthouse test of the page load is run in the lab, and won't provide an Interaction to Next Paint (INP) metric as there is no user interaction to record.
                            The Total Blocking Time metric aims to provide a partial lab alternative to INP. However, it only looks at the input delay component of INP, which is caused by background tasks unrelated to the user interaction. If the user were to interact with the page at some point, how much input delay would they face? In practice, a lot of time is spent processing the interactions and updating the UI.
                            First Contentful Paint and Speed Index are also not included in the Core Web Vitals. These metrics are strongly correlated with the Largest Contentful Paint. While they do provide valuable information about how fast your page renders, they were not included as Core Web Vitals in their own right.
                            Finally, Time to Interactive is also not a Core Web Vitals metric. Time to Interactive provides useful information on how long it takes for your page to load fully, but it only looks at CPU and network activity rather than focusing on the user.
                        </p>
                        <div class="button-wrapper">
                            <div class="button-background-primary button-background-animation">
                                <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                                <span class="hover-bg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-accessibility" data-tab="accessibility">
                        <h2 class="section-title">Accessibility</h2>
                        <h3>Is Google Lighthouse accurate?</h3>
                        <p>The Lighthouse score is frequently unreliable. Most tools, including PageSpeed Insights, rely on simulated performance data rather than values that are measured directly.</p>
                        <p>To get more accurate Lighthouse data, use a tool like the DebugBear website speed test.</p>
                        <h3>Performance score on mobile vs desktop devices</h3>
                        <p>Unlike the Core Web Vitals, the Lighthouse Performance score uses different score thresholds on desktop and on mobile.</p>
                        <p>For example, to get an LCP subscore of 90+ in Lighthouse you need a Largest Contentful Paint below 2.5 seconds on mobile and below 1.2 seconds on desktop.</p>
                        <div class="button-wrapper">
                            <div class="button-container button-background-primary button-background-animation">
                                <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                                <span class="hover-bg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-best-practices" data-tab="best-practices">
                        <h2 class="section-title">Best Practices</h2>
                        <h3>Lighthouse performance audit filter</h3>
                        <p>On DebugBear you can click View Details to get a detailed analysis for the given metric.</p>
                        <p>For example, when debugging Largest Contentful Paint you can see:</p>
                        <ul>
                            <li>What the LCP element is, and how long the LCP image took to load</li>
                            <li>Whether delays come from server response time, render delay, or other factors</li>
                            <li>A request waterfall highlighting how the LCP image was discovered</li>
                        </ul>
                        <div class="button-wrapper">
                            <div class="button-container button-background-primary button-background-animation">
                                <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                                <span class="hover-bg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-seo" data-tab="seo">
                        <h2 class="section-title">SEO</h2>
                        <p>Lighthouse web performance recommendations</p>
                        <p>The Lighthouse performance audits can give you a lot of insights into what's holding back your Performance score.</p>
                        <p>For example, you could get a recommendation to eliminate render-blocking resources. Render-blocking network requests slow down rendering on the page, hurting your page load milestones like the Largest Contentful Paint. Using the async and defer keywords on scripts helps you avoid these delays.</p>
                        <div class="button-wrapper">
                            <div class="button-container button-background-primary button-background-animation">
                                <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                                <span class="hover-bg"></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="section-design-system">
        <h2 class="">Design System</h2>
        <svg xmlns="http://www.w3.org/2000/svg">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -8" result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>
        <div class="gradient-container">
            <div class="g1"></div>
            <div class="g2"></div>
            <div class="g3"></div>
            <div class="g4"></div>
            <div class="g5"></div>
            <div class="g6"></div>
            <div class="interactive"></div>
        </div>
    </section>

    <section class="section-atomic-design container">
        <div class="grid-2-columns">
            <div class="">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/atomic-design.png" alt="Atomic design">
                <h2 class="section-title">Atomic design</h2>
                <p>Atomic design is a design system that helps you create a consistent and reusable design system for your website. It is a design system that helps you create a consistent and reusable design system for your website.</p>
                <ul>
                    <li>Thème personnalisé pour WordPress (sans plugins, sans builder) — CONSTRUIRE UN SITE et démarrer votre présence digitale</li>
                    <li>Spécialiste e-commerce (WooCommerce, Astro) — CONSTRUIRE UN SITE E-COMMERCE qui convertit</li>
                    <li>Intégration web passionnée — INTÉGRER tout outil de templating visuel comme CMS, Twig, Blade, etc.</li>
                    <li>Créer un SAAS pour votre entreprise, vous avez créé un prototype avec l'IA et vous voulez lui donner vie ? ou vous avez besoin d'automatiser des tâches pour votre business ? — CONSTRUIRE UN SAAS</li>
                    <li>Maintenance & Support — MAINTENIR et SUPPORTER votre site WordPress ou e-commerce</li>
                    <li>Conseil — CONSEILLER votre entreprise pour améliorer votre présence digitale</li>
                </ul>
                <div class="button-wrapper">
                    <div class="button-container button-background-primary button-background-animation">
                        <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                        <span class="hover-bg"></span>
                    </div>
                </div>
            </div>
            <div>
                <img src="<?= get_template_directory_uri(); ?>/assets/images/design-tokens.png" alt="Design tokens">
                <h2 class="section-title">Design tokens</h2>
                <p>Atomic design is a design system that helps you create a consistent and reusable design system for your website. It is a design system that helps you create a consistent and reusable design system for your website.</p>
                <ul>
                    <li>Thème personnalisé pour WordPress (sans plugins, sans builder) — CONSTRUIRE UN SITE et démarrer votre présence digitale</li>
                    <li>Spécialiste e-commerce (WooCommerce, Astro) — CONSTRUIRE UN SITE E-COMMERCE qui convertit</li>
                    <li>Intégration web passionnée — INTÉGRER tout outil de templating visuel comme CMS, Twig, Blade, etc.</li>
                    <li>Créer un SAAS pour votre entreprise, vous avez créé un prototype avec l'IA et vous voulez lui donner vie ? ou vous avez besoin d'automatiser des tâches pour votre business ? — CONSTRUIRE UN SAAS</li>
                    <li>Maintenance & Support — MAINTENIR et SUPPORTER votre site WordPress ou e-commerce</li>
                    <li>Conseil — CONSEILLER votre entreprise pour améliorer votre présence digitale</li>
                </ul>
                <div class="button-wrapper">
                    <div class="button-container button-background-primary button-background-animation">
                        <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                        <span class="hover-bg"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-vanilla-stack section-infinite-scroll container">
        <img src="<?= get_template_directory_uri(); ?>/assets/images/vanilla-stack.png" alt="Vanilla stack">
        <p>
            Vanilla stack is a stack of technologies that helps you create a consistent and reusable design system for your website. It is a stack of technologies that helps you create a consistent and reusable design system for your website.
            Vanilla stack is a stack of technologies that helps you create a consistent and reusable design system for your website. It is a stack of technologies that helps you create a consistent and reusable design system for your website.Vanilla stack is a stack of technologies that helps you create a consistent and reusable design system for your website. It is a stack of technologies that helps you create a consistent and reusable design system for your website.
        </p>
        <div class="scroller">
            <div class="scroller-inner">
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <div class="img-container">
                        <img src="<?= get_template_directory_uri(); ?>/assets/images/logo.png" alt="Vanilla stack" class="logo-stack">
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>



    <section class="section-website">
        <h2 class="section-title">The website in the ecosystem</h2>
        <div class="">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/solar-system.jpg" alt="The website in the ecosystem">
        </div>
        <div class="content container">
            <p>
                The website is a small part of the ecosystem. It is a part of the ecosystem that helps you create a consistent and reusable design system for your website. It is a part of the ecosystem that helps you create a consistent and reusable design system for your website.
                The website is a small part of the ecosystem. It is a part of the ecosystem that helps you create a consistent and reusable design system for your website. It is a part of the ecosystem that helps you create a consistent and reusable design system for your website.
            </p>
            <div class="button-wrapper">
                <div class="button-container button-background-primary button-background-animation">
                    <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                    <span class="hover-bg"></span>
                </div>
            </div>
        </div>
    </section>

    <section class="section-ai-tools container">
        <h2 class="section-title">AI and tools</h2>
        <p>AI tools are a great way to help you create a consistent and reusable design system for your website. It is a tool that helps you create a consistent and reusable design system for your website.</p>
        <div class="ai-tools-image">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/logo.png" alt="AI tools">
        </div>
        <div class="grid-2-columns">
            <div class="">
                <h2 class="section-title">automatiser vos taches répétivtives</h2>
                <p>Atomic design is a design system that helps you create a consistent and reusable design system for your website. It is a design system that helps you create a consistent and reusable design system for your website.</p>
                <ul>
                    <li>Thème personnalisé pour WordPress (sans plugins, sans builder) — CONSTRUIRE UN SITE et démarrer votre présence digitale</li>
                    <li>Spécialiste e-commerce (WooCommerce, Astro) — CONSTRUIRE UN SITE E-COMMERCE qui convertit</li>
                    <li>Intégration web passionnée — INTÉGRER tout outil de templating visuel comme CMS, Twig, Blade, etc.</li>
                    <li>Créer un SAAS pour votre entreprise, vous avez créé un prototype avec l'IA et vous voulez lui donner vie ? ou vous avez besoin d'automatiser des tâches pour votre business ? — CONSTRUIRE UN SAAS</li>
                    <li>Maintenance & Support — MAINTENIR et SUPPORTER votre site WordPress ou e-commerce</li>
                    <li>Conseil — CONSEILLER votre entreprise pour améliorer votre présence digitale</li>
                </ul>
                <div class="button-wrapper">
                    <div class="button-container button-background-primary button-background-animation">
                        <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                        <span class="hover-bg"></span>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="section-title">Vous avez un prototype avec l'IA et vous voulez lui donner vie ?</h2>
                <p>Atomic design is a design system that helps you create a consistent and reusable design system for your website. It is a design system that helps you create a consistent and reusable design system for your website.</p>
                <ul>
                    <li>Thème personnalisé pour WordPress (sans plugins, sans builder) — CONSTRUIRE UN SITE et démarrer votre présence digitale</li>
                    <li>Spécialiste e-commerce (WooCommerce, Astro) — CONSTRUIRE UN SITE E-COMMERCE qui convertit</li>
                    <li>Intégration web passionnée — INTÉGRER tout outil de templating visuel comme CMS, Twig, Blade, etc.</li>
                    <li>Créer un SAAS pour votre entreprise, vous avez créé un prototype avec l'IA et vous voulez lui donner vie ? ou vous avez besoin d'automatiser des tâches pour votre business ? — CONSTRUIRE UN SAAS</li>
                    <li>Maintenance & Support — MAINTENIR et SUPPORTER votre site WordPress ou e-commerce</li>
                    <li>Conseil — CONSEILLER votre entreprise pour améliorer votre présence digitale</li>
                </ul>
                <div class="button-wrapper">
                    <div class="button-container button-background-primary button-background-animation">
                        <a href="<?= home_url() . '/contact'; ?>" class="btn">En savoir plus</a>
                        <span class="hover-bg"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>



<?php get_footer(); ?>