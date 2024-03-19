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
      ['responsive-embeds'],
      ['post-thumbnails'],
      ['revisions']
    ];

    $this->features_to_remove = [];

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