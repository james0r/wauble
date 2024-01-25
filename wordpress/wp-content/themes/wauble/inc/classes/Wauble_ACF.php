<?php

/**
 * This class contains methods for working with Advanced Custom Fields.
 */

class Wauble_ACF {
  public function __construct() {
    add_action('acf/settings/load_json', [$this, 'acf_json_load_point']);
    add_action('acf/settings/save_json', [$this, 'acf_json_save_point']);
    
    add_action('acf/settings/l10n_textdomain', function () {
      return Wauble::$text_domain;
    });
    add_action('acf/init', [$this, 'acf_register_options_pages']);
    
    // Uncomment the following lines and create a /blocks dir in the project root to enable ACR blocks.
    // See: https://github.com/james0r/wauble/tree/e498d51c6c97f6c58b88b63b6d6ee700df9767f3/blocks
    // add_action('acf/init', [$this, 'acf_register_block_types']);
    // add_filter('acf/settings/php_save', [$this, 'acf_php_save_point']);
    // add_filter('acf/settings/php_load', [$this, 'acf_php_load_point']);
  }

  /**
   * Sets the ACF JSON load point.
   *
   * @param array $paths The array of ACF JSON load paths.
   * @return array The modified array of ACF JSON load paths.
   */
  public function acf_json_load_point($paths) {
    unset($paths[0]);

    $paths[] = Wauble()->path('/inc/acf-json');

    return $paths;
  }

  /**
   * Sets the ACF JSON save point path.
   *
   * @param string $path The path to the ACF JSON save point.
   * @return string The updated path to the ACF JSON save point.
   */
  public function acf_json_save_point($path) {
    $path = Wauble()->path('/inc/acf-json');

    return $path;
  }

  /**
   * This method modifies the ACF PHP load points by adding a new path to the array of paths.
   *
   * @param array $paths The array of ACF PHP load points.
   * @return array The modified array of ACF PHP load points.
   */
  public function acf_php_load_point($paths) {
    unset($paths[0]);

    $paths[] = Wauble()->path('/inc/acf-php');

    return $paths;
  }

  /**
   * This method modifies the ACF PHP save point by setting it to the path of the ACF PHP directory.
   *
   * @param string $path The path to the ACF PHP save point.
   * @return string The updated path to the ACF PHP save point.
   */
  public function acf_php_save_point($path) {
    $path = Wauble()->path('/inc/acf-php');

    return $path;
  }


  /**
   * Registers ACF block types.
   * 
   * @return void
   */
  public function acf_register_block_types() {
    if (function_exists('acf_register_block_type')) {
      Wauble()->requireOnce('/blocks/block-types.php');
    }
  }

  /**
   * Registers options pages using Advanced Custom Fields (ACF).
   *
   * This method checks if the ACF plugin is active and then registers the options pages
   * by calling the `acf_add_options_page` function. The options pages are defined in the
   * '/inc/acf-register-options-pages.php' file.
   *
   * @return void
   */
  public function acf_register_options_pages() {
    if (function_exists('acf_add_options_page')) {
      Wauble()->requireOnce('/inc/acf-register-options-pages.php');
    }
  }
}