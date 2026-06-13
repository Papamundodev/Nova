<?php
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$theme_location = $args['theme_location'] ?? "header";
$page_for_posts = get_option('page_for_posts');
$menu_items = \Theme_base\Base::wp_get_menu_array($theme_location);
?>


<?php if (is_array($menu_items) && count($menu_items) > 0): ?>
    <nav id="navmenu-<?= $theme_location ?>" class="navmenu navmenu-desktop">
        <ul class="">
            <?php if ($theme_location === "error"): ?>
                <li class="nav-item dropdown-hover dropdown">
                    <div class="dropdown-link nav-link">
                        <div class="svg-container">
                            <?= file_get_contents(get_template_directory() . '/assets/images/chevron.svg'); ?>
                        </div>
                        <p class="dropdown-title"><?= __('Expertises', 'theme_base') ?></p>
                    </div>
                    <?php
                    $expertises = get_field('expertises', "option");
                    ?>
                    <div class="dropdown-menu">
                        <ul>
                            <?php foreach ($expertises['expertises_list'] as $item): ?>
                                <?php
                                $image = get_field('image', $item);
                                $color = get_field('color', $item);
                                $link = get_term_link($item);
                                ?>
                                <li class="card-nav border-<?= $color; ?>-color card-hover-<?= $color; ?>-color">
                                    <div class="img-container bg-<?= $color; ?>-color">
                                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                    </div>
                                    <div class="flex-between">
                                        <a class="<?= $color; ?>-color" href="<?= home_url(); ?>#expertise-<?= sanitize_title($item->name); ?>"><?= $item->name ?></a>
                                        <div class=" svg-container svg-<?= $color; ?>-color">
                                            <?= file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                                        </div>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php foreach ($menu_items as $item): ?>
                <li class="<?= \Theme_base\Base::get_active_class($item) ?> <?= \Theme_base\Base::get_parent_active_class($item, $object) ?> nav-item">
                    <a class="nav-link"
                        href="<?= $item['url'] ?>"
                        target="<?= $item['target'] ?>"
                        rel="<?= $item['target'] === '_blank' ? 'noopener' : '' ?>"><?= $item['title'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
<?php endif; ?>