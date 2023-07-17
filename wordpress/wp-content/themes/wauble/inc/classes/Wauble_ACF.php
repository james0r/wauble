<?php

/**
 * This class initializes Advanced Custom Fields.
 */

class Wauble_ACF {
  public function __construct() {
    add_action('acf/settings/load_json', [$this, 'acf_json_load_point']);
    add_action('acf/settings/save_json', [$this, 'acf_json_save_point']);
    
    add_action('acf/settings/l10n_textdomain', function () {
      return Wauble::$text_domain;
    });
    add_action('acf/init', [$this, 'acf_register_options_pages']);
    add_filter('acf/load_field/name=post_type', [$this, 'acf_load_post_type_field_choices']);
    
    // Uncomment the following lines and create a /blocks dir in the project root to enable ACR blocks.
    // See: https://github.com/james0r/wauble/tree/e498d51c6c97f6c58b88b63b6d6ee700df9767f3/blocks
    // add_filter('block_categories_all', [$this, 'register_block_categories']);
    // add_action('acf/init', [$this, 'acf_register_block_types']);
    // add_filter('acf/settings/php_save', [$this, 'acf_php_save_point']);
    // add_filter('acf/settings/php_load', [$this, 'acf_php_load_point']);
  }

  public function acf_json_load_point($paths) {
    unset($paths[0]);

    $paths[] = Wauble::$stylesheet_dir_path . '/inc/acf-json';

    return $paths;
  }

  public function acf_json_save_point($path) {
    $path = Wauble::$stylesheet_dir_path . '/inc/acf-json';

    return $path;
  }

  public function acf_php_load_point($paths) {
    unset($paths[0]);

    $paths[] = Wauble::$stylesheet_dir_path . '/inc/acf-php';

    return $paths;
  }

  public function acf_php_save_point($path) {
    $path = Wauble::$stylesheet_dir_path . '/inc/acf-php';

    return $path;
  }

  public function register_block_categories($categories) {
    $categories[] = array(
      'slug'  => 'wauble-blocks-category',
      'title' => 'Wauble'
    );

    return $categories;
  }

  public function acf_register_block_types() {
    if (function_exists('acf_register_block_type')) {
      Wauble()->requireOnce('/blocks/block-types.php');
    }
  }

  public function acf_register_options_pages() {
    if (function_exists('acf_add_options_page')) {
      Wauble()->requireOnce('/inc/acf-register-options-pages.php');
    }
  }

  public function acf_load_post_type_field_choices($field) {

    // reset choices
    $field['choices'] = array();

    // get the textarea value from options page without any formatting
    $choices = get_post_types();

    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    // loop through array and add to field 'choices'
    if (is_array($choices)) {

      foreach ($choices as $choice) {

        $field['choices'][$choice] = $choice;
      }
    }

    // return the field
    return $field;
  }
}