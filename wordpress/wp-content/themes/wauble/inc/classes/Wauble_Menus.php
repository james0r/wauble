<?php

use Log1x\Navi\Navi;

/**
 * This class configures registers and customizes Wordpress menus.
 */

class Wauble_Menus {
  public array $menus;

  public function __construct() {
    $this->menus = [
      'header-menu' => __('Header Menu', 'wauble'),
      'footer-menu' => __('Footer Menu', 'wauble'),
      'site_map_pages' => __('Sitemap Pages', 'wauble')
    ];

    add_action('after_setup_theme', [$this, 'registerNavMenus']);
    add_filter('nav_menu_css_class', [$this, 'addClassToMenuLi'], 1, 3);
    add_filter('nav_menu_link_attributes', [$this, 'addMenuLinkClass'], 1, 3);
  }

  public function registerNavMenus() {
    register_nav_menus($this->menus);
  }

  public function addClassToMenuLi($classes, $item, $args) {
    if (isset($args->item_class)) {
      $classes[] = $args->item_class;
    }
    return $classes;
  }

  public function addMenuLinkClass($atts, $item, $args) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
  }

  public function getNaviMenu($menu_id) {
    return (new Navi())->build($menu_id);
  }
}