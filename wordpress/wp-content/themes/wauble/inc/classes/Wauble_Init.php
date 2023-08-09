<?php

/**
 * This class handles general theme setup actions.
 */

class Wauble_Init {
  public function __construct() {
    add_action('after_setup_theme', [$this, 'addImageSizes']);
    add_action('after_setup_theme', [$this, 'initI18n']);
    add_action('wp_footer', [$this, 'debuggingConsoleTable']);

    Wauble()->requireOnce('/vendor/autoload.php');
  }

  public function initI18n() {
    load_theme_textdomain(Wauble::$text_domain, get_template_directory() . '/languages');
  }

  public function addImageSizes() {
    add_image_size('wauble-blog-card', 600, 600, true);
    add_image_size('wauble-blog-card-1-5x', 900, 900, true);
    add_image_size('wauble-blog-card-2x', 1200, 1200, true);

    add_image_size('single_featured_image', 1280, 9999, false);
    add_image_size('single_featured_image_2X', 2560, 9999, false);
  }

  public function debuggingConsoleTable() {
    global $template;

    $markup = '<script>
        window.wauble = window.wauble || {}
        window.wauble.wordpress = {}
        window.wauble.wordpress.currentTemplate = "%s"
        window.wauble.wordpress.wpVersion = "%s"
        window.wauble.wordpress.waubleVersion = "%s"
      </script>';

    echo sprintf($markup, basename($template), get_bloginfo('version'), WAUBLE_VERSION);
  }
}
