<?php
$object= get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$theme_location = $args['theme_location'] ?? "header";

?>


<?php $menu_items = \Theme_base\Base::wp_get_menu_array($theme_location);?>
<?php if(is_array($menu_items) && count($menu_items) > 0): ?>
<nav popover id="navmenu-<?=$theme_location?>-mobile" class="navmenu navmenu-mobile">
  <ul class="">
    <?php foreach($menu_items as $item): ?>
      <?php if(empty($item['children'])):?>
        <li class="<?= \Theme_base\Base::get_active_class($item) ?>">
          <a class="" 
          href="<?=$item['url']?>"
          target="<?=$item['target']?>"
          rel="<?= $item['target'] === '_blank' ? 'noopener ' : '' ?>"
          ><?=$item['title']?></a>
        </li>
      <?php else: ?>


        <!-- mobile dropdown -->
        <details name="navmenu-header-dropdown-mobile-<?=$theme_location?>" class="dropdown dropdown-details">
          <summary class="default-color">
                <div class="svg-container">
                    <svg class="plus-icon-svg" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                        <path id="path-1" d="M32 128C32 123.582 35.5817 120 40 120L216 120C220.418 120 224 123.582 224 128V128C224 132.418 220.418 136 216 136H128H40C35.5817 136 32 132.418 32 128V128Z" />
                        <path id="path-2" d="M128 224C123.582 224 120 220.418 120 216V40C120 35.5817 123.582 32 128 32V32C132.418 32 136 35.5817 136 40V128V216C136 220.418 132.418 224 128 224V224Z" />
                    </svg>  
                </div>
                <p class="dropdown-title"><?=$item['title']?></p>
            </summary>

          <ul class="dropdown-menu">
            <?php foreach($item['children'] as $child): ?>
              <li class="<?= \Theme_base\Base::get_active_class($child) ?>">
                <a  class=""
                href="<?=$child['url']?>"
                title="<?=$child['title']?>"
                target="<?=$child['target']?>"
                rel="<?= $child['target'] === '_blank' ? 'noopener' : '' ?>"
                ><?=$child['title']?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </details>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</nav>
<?php endif; ?>


