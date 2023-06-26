<?php

/**
 * This class handles the registering, enqueueing, and dequeueing of scripts.
 */

class Wauble_Scripts {
  public array $scripts_to_enqueue;

  public array $scripts_to_dequeue;

  public array $admin_scripts_to_enqueue;

  public function __construct() {
    $this->scripts_to_enqueue = [
      [
        'frontend-bundle',
        Wauble::$stylesheet_dir_url . '/dist/js/frontend-bundle.js',
        null,
        Wauble::$version,
        true
      ]
    ];

    $this->scripts_to_dequeue = [];

    $this->admin_scripts_to_enqueue = [
      [
        'admin-scripts',
        Wauble::$stylesheet_dir_url . '/dist/admin/admin.js'
      ]
    ];

    add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    add_action('wp_enqueue_scripts', [$this, 'dequeue_scripts']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
  }

  public function enqueue_scripts() {
    array_map(function ($script) {
      call_user_func_array('wp_enqueue_script', $script);
    }, $this->scripts_to_enqueue);
  }

  public function dequeue_scripts() {
    array_map(function ($script) {
      call_user_func_array('wp_dequeue_script', $script);
    }, $this->scripts_to_dequeue);
  }

  public function enqueue_admin_scripts() {
    array_map(function ($script) {
      call_user_func_array('wp_enqueue_script', $script);
    }, $this->admin_scripts_to_enqueue);
  }
}