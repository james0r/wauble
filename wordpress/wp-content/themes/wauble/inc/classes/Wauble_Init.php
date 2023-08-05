<?php

/**
 * This class handles general theme setup actions.
 */

class Wauble_Init {
  public function __construct() {
    add_action('after_setup_theme', [$this, 'addImageSizes']);
    add_action('after_setup_theme', [$this, 'initI18n']);
    add_action('wp_footer', [$this, 'debuggingConsoleTable']);

    Wauble()->requireOnce('/inc/helpers.php');
    Wauble()->requireOnce('/vendor/autoload.php');
  }

  public function initI18n() {
    load_theme_textdomain(Wauble::$text_domain, get_template_directory() . '/languages');
  }

  public function addImageSizes() {
    add_image_size('pageBanner', 1500, 350, true);
    add_image_size('testThumbnail', 200, 300, true);
    add_image_size('testThumbnail2X', 400, 600, true);
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
