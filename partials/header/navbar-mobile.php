<?php
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$theme_location = $args['theme_location'] ?? "header";

?>


<?php $menu_items = \Theme_base\Base::wp_get_menu_array($theme_location); ?>
<?php if (is_array($menu_items) && count($menu_items) > 0): ?>
  <nav popover id="navmenu-<?= $theme_location ?>-mobile" class="navmenu navmenu-mobile container">
    <div class="section-header">
      <?php get_template_part('partials/header/logo'); ?>
      <button class="btn" popovertarget="navmenu-<?= $theme_location ?>-mobile" popoveraction="hide">
        <?= file_get_contents(get_template_directory() . '/assets/images/close.svg'); ?>
      </button>
    </div>
    <ul class="">
      <?php foreach ($menu_items as $item): ?>
        <?php if (empty($item['children'])): ?>
          <li class="<?= \Theme_base\Base::get_active_class($item) ?> card-nav border-primary-color card-hover-primary-color">
            <div class="flex-between">
              <a class="primary-color" href="<?= $item['url'] ?>" popovertarget="navmenu-<?= $theme_location ?>-mobile" popoveraction="hide"><?= $item['title'] ?></a>
              <div class="svg-container svg-primary-color">
                <?= file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
              </div>
            </div>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php
      $expertises = get_terms(array(
        'taxonomy'   => 'expertises',
        'hide_empty' => false,
      ));
      ?>
      <?php foreach ($expertises as $item): ?>
        <?php
        $image = get_field('image', $item);
        $color = get_field('color', $item);
        ?>
        <li class="card-nav border-<?= $color; ?>-color card-hover-<?= $color; ?>-color">
          <div class="flex-between">
            <a class="<?= $color; ?>-color" href="<?= home_url() . "#expertise-" . sanitize_title($item->name); ?>" popovertarget="navmenu-<?= $theme_location ?>-mobile" popoveraction="hide"><?= $item->name ?></a>
            <div class=" svg-container svg-<?= $color; ?>-color">
              <?= file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
<?php endif; ?>