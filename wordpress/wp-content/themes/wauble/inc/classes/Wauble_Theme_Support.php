<?php

/**
 * This class adds and removes Wordpress theme supports.
 */

class Wauble_Theme_Support {
  public array $features_to_add;
  public array $features_to_remove;

  public function __construct() {
    $this->features_to_add = [
      ['title-tag'],
      ['align-wide'],
      [
        'editor-font-sizes',
        [
          [
            'name'      => esc_html__('Extra small', 'wauble'),
            'shortName' => esc_html_x('XS', 'Font size', 'wauble'),
            'size'      => 16,
            'slug'      => 'extra-small',
          ],
          [
            'name'      => esc_html__('Small', 'wauble'),
            'shortName' => esc_html_x('S', 'Font size', 'wauble'),
            'size'      => 18,
            'slug'      => 'small',
          ],
          [
            'name'      => esc_html__('Normal', 'wauble'),
            'shortName' => esc_html_x('M', 'Font size', 'wauble'),
            'size'      => 20,
            'slug'      => 'normal',
          ],
          [
            'name'      => esc_html__('Large', 'wauble'),
            'shortName' => esc_html_x('L', 'Font size', 'wauble'),
            'size'      => 24,
            'slug'      => 'large',
          ],
          [
            'name'      => esc_html__('Extra large', 'wauble'),
            'shortName' => esc_html_x('XL', 'Font size', 'wauble'),
            'size'      => 40,
            'slug'      => 'extra-large',
          ],
          [
            'name'      => esc_html__('Huge', 'wauble'),
            'shortName' => esc_html_x('XXL', 'Font size', 'wauble'),
            'size'      => 96,
            'slug'      => 'huge',
          ],
          [
            'name'      => esc_html__('Gigantic', 'wauble'),
            'shortName' => esc_html_x('XXXL', 'Font size', 'wauble'),
            'size'      => 144,
            'slug'      => 'gigantic',
          ],
        ]
      ],
      ['responsive-embeds'],
      ['custom-line-height'],
      ['custom-spacing'],
      ['custom-units'],
      ['post-thumbnails']
    ];

    $this->features_to_remove = [
      ['core-block-patterns']
    ];

    add_action('after_setup_theme', [$this, 'addThemeSupport']);
    add_action('after_setup_theme', [$this, 'removeThemeSupport']);
  }

  public function addThemeSupport() {
    array_map(function ($feature) {
      call_user_func_array('add_theme_support', $feature);
    }, $this->features_to_add);
  }

  public function removeThemeSupport() {
    array_map(function ($feature) {
      call_user_func_array('remove_theme_support', $feature);
    }, $this->features_to_remove);
  }
}