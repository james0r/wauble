<?php

/**
 * This class configures Wordpress editors.
 */

class Wauble_Editors {
  public function __construct() {
    
    if (WAUBLE_DISABLE_BLOCK_EDITOR) {
      add_action('admin_init', [$this, 'hideClassicEditorOnPages']);
      add_filter('use_block_editor_for_post', '__return_false');
    } 
  }

  public function hideClassicEditorOnPages() {
    if (isset($_GET['post'])) {
      $post_id = $_GET['post'];
    }
    if (!isset($post_id)) return;

    if (get_post_type($post_id) == 'page' && (get_page_template_slug($post_id) !== 'templates/generic.php')) {
      
      error_log(get_page_template_slug($post_id));
      remove_post_type_support('page', 'editor');
    }
  }
}
