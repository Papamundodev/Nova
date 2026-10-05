<?php

use Theme_base\Base;

$logo_svg = get_field('logo_svg', 'option');
?>

<div class="img-container-logo-sm">
    <a href="<?= home_url(); ?>" aria-label="<?= get_bloginfo('name'); ?>">
        <?php if ($logo_svg): ?>
            <?= Base::inline_svg_from_attachment($logo_svg); ?>
        <?php endif; ?>
    </a>
</div>