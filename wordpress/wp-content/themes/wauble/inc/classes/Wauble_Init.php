<?php

/**
 * This class handles general theme setup actions.
 */

class Wauble_Init {
  public function __construct() {
    add_action('after_setup_theme', [$this, 'add_image_sizes']);
    add_action('wp_footer', [$this, 'debugging_console_table']);

    Wauble()->requireOnce('/inc/helpers.php');
    Wauble()->requireOnce('/vendor/autoload.php');
  }

  public function add_image_sizes() {
    add_image_size('pageBanner', 1500, 350, true);
    add_image_size('test-thumbnail', 200, 300, true);
    add_image_size('test-thumbnail-2X', 400, 600, true);
  }

  public function debugging_console_table() {
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
