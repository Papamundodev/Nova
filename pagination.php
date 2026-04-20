<?php
global $wp_query;
$id = "orderby-form";
$next_post = get_next_posts_page_link();
$previous_post = get_previous_posts_page_link();
$paged = get_query_var('paged') ?? 1;
$max_num_page = intval($wp_query->max_num_pages);

// Add anchor to next/previous links for pages 2+
if ($next_post) {
    $next_post .= '#' . $id;
}
if ($previous_post) {
    $previous_post .= '#' . $id;
}
?>
<?php if ($max_num_page > 1) : ?>

    <nav class="" aria-label="<?php esc_attr_e('Pagination', 'theme_base'); ?>">
        <div class="">
            <ul class="pagination">
                <?php if ($paged - 1 !== 0 && $paged !== 0) : ?>
                    <li class="page-item">
                        <a href="<?= $previous_post ?>" class="page-link" aria-label="<?php esc_attr_e('Page précédente', 'theme_base'); ?>" title="<?php esc_attr_e('Page précédente', 'theme_base'); ?>">
                            <div class="img-container">
                                <?= file_get_contents(get_template_directory() . '/assets/images/arrow-left.svg'); ?>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
                <?php

                $pagination = \Theme_base\Base::complus_pagination($wp_query);
                $current_page = null;
                $max_num_page = intval($wp_query->max_num_pages);
                $min_num_page = 1;
                $space_link_allowed = 1;
                foreach ($pagination as $page) {
                    if ($page->isCurrent) {
                        $current_page = $page->page;
                        break;
                    }
                }
                $links_to_show = array_filter($pagination, function ($link) use ($current_page, $max_num_page, $min_num_page, $space_link_allowed) {
                    return (
                        ($link->page <= $current_page + $space_link_allowed && $link->page >= $current_page - $space_link_allowed)
                        || ($link->page == $max_num_page)
                        || ($link->page == $min_num_page)
                    );
                });

                $prev_page = null;
                ?>
                <?php foreach ($links_to_show as $link) : ?>
                    <?php if ($prev_page !== null && ((int) $link->page - (int) $prev_page) > 1) : ?>
                        <li class="page-item disabled">
                            <span class="page-link">…</span>
                        </li>
                    <?php endif; ?>
                    <li class="page-item <?= $link->isCurrent ? 'active' : "" ?> ">
                        <a href="<?= esc_url($link->url) . '#' . $id; ?>" class="page-link" aria-label="<?php printf(esc_attr__('Page %d', 'theme_base'), (int) $link->page); ?>" title="<?php printf(esc_attr__('Page %d', 'theme_base'), (int) $link->page); ?>">
                            <?php _e($link->page) ?>
                        </a>
                    </li>
                    <?php $prev_page = (int) $link->page; ?>
                <?php endforeach; ?>


                <?php if (intval($paged) !== intval($max_num_page)) : ?>
                    <li class="page-item">
                        <a href="<?= $next_post ?>" class="page-link" aria-label="<?php esc_attr_e('Page suivante', 'theme_base'); ?>" title="<?php esc_attr_e('Page suivante', 'theme_base'); ?>">
                            <div class="img-container">
                                <?= file_get_contents(get_template_directory() . '/assets/images/arrow-right.svg'); ?>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

<?php endif; ?>