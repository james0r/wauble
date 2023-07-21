<?php

/**
 * This class handles the enqueueing and dequeueing of styles.
 */

class Wauble_Styles {
  private array $styles_to_enqueue;

  private array $styles_to_dequeue;

  private array $admin_styles_to_enqueue;

  public function __construct() {
    $this->styles_to_enqueue = [
      [
        'theme-styles',
        Wauble::$stylesheet_dir_url . '/style.css'
      ],
      [
        'tailwind',
        Wauble::$stylesheet_dir_url . '/dist/css/tailwind.css'
      ],
      [
        'sass-compiled',
        Wauble::$stylesheet_dir_url . '/dist/css/sass-compiled.css'
      ]
    ];

    $this->styles_to_dequeue = [];

    if (WAUBLE_DISABLE_BLOCK_EDITOR) {
      $this->styles_to_dequeue[] = ['wp-block-library'];
      $this->styles_to_dequeue[] = ['wp-block-library-theme'];
      $this->styles_to_dequeue[] = ['wc-blocks-style'];
      $this->styles_to_dequeue[] = ['global-styles'];
      $this->styles_to_dequeue[] = ['classic-theme-styles'];
    }

    $this->admin_styles_to_enqueue = [
      [
        'admin-styles',
        Wauble::$stylesheet_dir_url . '/dist/admin/admin.css'
      ]
    ];

    add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    add_action('wp_enqueue_scripts', [$this, 'dequeue_styles']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    // add_action('wp_enqueue_styles', [$this, 'wauble_register_styles']);
  }

  public function enqueue_styles() {
    array_map(function ($style) {
      call_user_func_array('wp_enqueue_style', $style);
    }, $this->styles_to_enqueue);
  }

  public function dequeue_styles() {
    array_map(function ($style) {
      call_user_func_array('wp_dequeue_style', $style);
    }, $this->styles_to_dequeue);
  }

  public function enqueue_admin_styles() {
    array_map(function ($style) {
      call_user_func_array('wp_enqueue_style', $style);
    }, $this->admin_styles_to_enqueue);
  }
}