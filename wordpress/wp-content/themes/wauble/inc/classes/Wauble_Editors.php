<?php

/**
 * This class configures Wordpress editors.
 */

class Wauble_Editors {
  public function __construct() {
    
    if (WAUBLE_DISABLE_BLOCK_EDITOR) {
      add_action('admin_init', [$this, 'hide_classic_editor_on_pages']);
      add_filter('use_block_editor_for_post', '__return_false');
    } else {
      add_filter('allowed_block_types_all', [$this, 'get_allowed_block_types']);
    }
  }

  public function hide_classic_editor_on_pages() {
    if (isset($_GET['post'])) {
      $post_id = $_GET['post'];
    }
    if (!isset($post_id)) return;

    if (get_post_type($post_id) == 'page') {
      remove_post_type_support('page', 'editor');
    }
  }

  public function get_allowed_block_types() {
    return array(
      'core/paragraph',
      'core/buttons',
      'core/image',
      'core/embed',
      'core/heading',
      'acf/testimonial',
    );
  }
}
