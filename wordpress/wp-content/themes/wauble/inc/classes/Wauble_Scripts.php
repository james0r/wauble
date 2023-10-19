<?php

/**
 * This class handles the registering, enqueueing, and dequeueing of scripts.
 */

class Wauble_Scripts {
  public array $scripts_to_enqueue;

  public array $scripts_to_dequeue;

  public array $admin_scripts_to_enqueue;

  public function __construct() {
    $this->scripts_to_enqueue = [];

    $this->scripts_to_dequeue = [];

    $this->admin_scripts_to_enqueue = [
      [
        'admin-scripts',
        Wauble::$stylesheet_dir_url . '/static/js/admin.js'
      ]
    ];

    add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    add_action('wp_enqueue_scripts', [$this, 'dequeueScripts']);
    add_action('admin_enqueue_scripts', [$this, 'enqueueAdminScripts']);
  }

  public function enqueueScripts() {
    // enqueue the Vite module
    Vite::enqueue_module();

    // uncomment to register and enqueue theme scss styles and also uncomment input vite.config.js
    // $filename = Vite::asset('src/scss/theme.scss');
    // wp_enqueue_style('theme-style-scss', $filename, [], null, 'screen');

    // register theme-style-css
    $filename = Vite::asset('src/theme.css');

    // enqueue theme-style-css into our head
    wp_enqueue_style('theme-style', $filename, [], null, 'screen');

    // register theme-script-js
    $filename = Vite::asset('src/theme.js');

    // enqueue theme-script-js into our head (change false to true for footer)
    wp_enqueue_script('theme-script', $filename, [], null, false);

    // update html script type to module wp hack
    Vite::script_type_module('theme-script');

    array_map(function ($script) {
      call_user_func_array('wp_enqueue_script', $script);
    }, $this->scripts_to_enqueue);
  }

  public function dequeueScripts() {
    array_map(function ($script) {
      call_user_func_array('wp_dequeue_script', $script);
    }, $this->scripts_to_dequeue);
  }

  public function enqueueAdminScripts() {
    array_map(function ($script) {
      call_user_func_array('wp_enqueue_script', $script);
    }, $this->admin_scripts_to_enqueue);
  }
}