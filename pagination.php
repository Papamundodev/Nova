<?php
$prev_url = get_previous_posts_page_link();
$next_url = get_next_posts_page_link();
?>
<div class="pagination">
    <?php if ($prev_url) : ?>
    <div class="button-wrapper">
        <div class="button-container button-background-primary button-background-animation">
            <a href="<?= esc_url($prev_url); ?>" aria-label="<?php esc_attr_e('Page précédente', 'theme_base'); ?>" title="<?php esc_attr_e('Page précédente', 'theme_base'); ?>"><?php _e('Previous Page', 'theme_base'); ?></a>
            <span class="hover-bg"></span>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($next_url) : ?>
    <div class="button-wrapper">
        <div class="button-container button-background-primary button-background-animation">
            <a href="<?= esc_url($next_url); ?>" aria-label="<?php esc_attr_e('Page suivante', 'theme_base'); ?>" title="<?php esc_attr_e('Page suivante', 'theme_base'); ?>"><?php _e('Next Page', 'theme_base'); ?></a>
            <span class="hover-bg"></span>
        </div>
    </div>
    <?php endif; ?>
</div>