
<div class="wrapper-tool-kit">
    <?php if (function_exists('theme_light_dark_form')): ?>
        <div class="wrapper-theme-light-dark">
            <?=do_shortcode('[theme_light_dark]'); ?>
        </div>
    <?php endif; ?>

    <div class="wrapper-design-system-container">
        <a href="<?=home_url() . '/design-system';?>" class="btn icon-button">
            <?php echo file_get_contents(get_template_directory() . '/assets/images/design.svg'); ?>
        </a>
    </div>
</div>
