<?php
$faq = $args['faq'];
?>


<details name="dropdown-details" class="dropdown-details dropdown">
    <summary class="default-color">
        <p class="dropdown-title"><?= $faq->post_title; ?></p>
        
        <div class="svg-container">
            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
        </div>
    </summary>
    <p><?= $faq->post_content; ?></p>
</details>