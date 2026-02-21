<?php
$faq = $args['faq'];
$i   = isset($args['i']) ? (int) $args['i'] : 0;
$id  = $i > 0 ? 'faq-details-' . $i : '';
?>


<details <?= $id ? 'id="' . esc_attr($id) . '"' : ''; ?> name="dropdown-details" class="dropdown-details dropdown reveal-item">
    <summary class="default-color">
        <p class="dropdown-title"><?= esc_html($faq->post_title); ?></p>

        <div class="svg-container">
            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
        </div>
    </summary>
    <div class="content-wysiwyg"><?= wpautop($faq->post_content); ?></div>
</details>