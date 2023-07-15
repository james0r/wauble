<?php

use Log1x\Navi\Navi;

/**
 * This class configures registers and customizes Wordpress menus.
 */

class Wauble_Menus {
  public array $menus;

  public function __construct() {
    $this->menus = [
      'header_menu' => __('Header Menu', 'wauble'),
      'footer_menu' => __('Footer Menu', 'wauble'),
      'site_map_pages' => __('Sitemap Pages', 'wauble')
    ];

    add_action('after_setup_theme', [$this, 'register_nav_menus']);
    add_filter('nav_menu_css_class', [$this, 'add_class_to_menu_li'], 1, 3);
    add_filter('nav_menu_link_attributes', [$this, 'add_menu_link_class'], 1, 3);
  }

  public function register_nav_menus() {
    register_nav_menus($this->menus);
  }

  public function add_class_to_menu_li($classes, $item, $args) {
    if (isset($args->item_class)) {
      $classes[] = $args->item_class;
    }
    return $classes;
  }

  public function add_menu_link_class($atts, $item, $args) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
  }

  public function get_navi_menu($menu_id) {
    return (new Navi())->build($menu_id);
  }
}