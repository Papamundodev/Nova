<?php
$object= get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$theme_location = $args['theme_location'] ?? "header";
$page_for_posts = get_option('page_for_posts');
$menu_items = \Theme_base\Base::wp_get_menu_array($theme_location);
?>


<?php if(is_array($menu_items) && count($menu_items) > 0): ?>
<nav id="navmenu-<?=$theme_location?>" class="navmenu navmenu-desktop">
<ul class="">
    <?php foreach($menu_items as $item): ?>
    <?php if(empty($item['children'])):?>
        <li class="<?= \Theme_base\Base::get_active_class($item) ?> <?= \Theme_base\Base::get_parent_active_class($item, $object) ?> nav-item">
        <a class="nav-link" 
        href="<?=$item['url']?>"
        target="<?=$item['target']?>"
        rel="<?= $item['target'] === '_blank' ? 'noopener' : '' ?>"
        ><?=$item['title']?></a>
        </li>
    <?php else: ?>
        <li class="<?= \Theme_base\Base::get_active_class($item) ?> <?= \Theme_base\Base::get_parent_active_class($item, $object) ?> nav-item">
            <nav aria-label="navigation" tabindex="0" class="dropdown-header dropdown">
                <div class="dropdown-link ">
                    <div class="svg-container">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 1000'><path d='M353.8 853.1H147V646.2L.7 500 147 353.8V147h206.8L500 .7 646.2 147h206.9v206.8L999.3 500 853.1 646.2v206.9H646.2L500 999.3 353.8 853.1z' fill='currentColor'></path></svg>
                    </div>
                    <p class="dropdown-title nav-link"><?=$item['title']?></p> 
                </div>
                <ul class="dropdown-menu">
                    <?php foreach($item['children'] as $child): ?>
                    <li class="<?= \Theme_base\Base::get_active_class($child) ?> nav-item">
                        <a  class="nav-link"
                        href="<?=$child['url']?>"
                        title="<?=$child['title']?>"
                        target="<?=$child['target']?>"
                        rel="<?= $child['target'] === '_blank' ? 'noopener' : '' ?>"
                        ><?=$child['title']?></a>
                    </li>
                    <?php endforeach; ?>
                    <li class="dropdown-footer">
                        <p>Change the hover on dropdown hover to no background and rotate en hover.</p>
                    </li>
                </ul>
            </nav>
        </li>
        <!-- desktop dropdown -->
    <?php endif; ?>
    <?php endforeach; ?>
</ul>
</nav>
<?php endif; ?>


