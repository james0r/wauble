<?php

/**
 * Core class for the Wauble Theme.
 */

class Wauble {
  private static $theme_prefix;

  public static $text_domain;

  public static $instance = null;

  public static $template_dir_path = '';

  public static $template_dir_url = '';

  public static $stylesheet_dir_path = '';

  public static $stylesheet_dir_url = '';

  public static $scripts_dir_path = '';

  public static $scripts_dir_url = '';

  public static $version = WAUBLE_VERSION;

  public $init;

  public $posts;
  
  public $editors;

  public $tweaks;

  public $styles;

  public $login;

  public $scripts;

  public $sections;

  public $colors;

  public $menus;

  public $gutenberg;

  public $static_templates;

  public $acf;

  public $theme_support;

  private function __construct() {
    self::$theme_prefix = 'wauble_';
    self::$text_domain = 'wauble';
    self::$template_dir_path = wp_normalize_path(get_template_directory());
    self::$template_dir_url = get_template_directory_uri();
    self::$stylesheet_dir_path = wp_normalize_path(get_stylesheet_directory());
    self::$stylesheet_dir_url = get_stylesheet_directory_uri();
  }

  // The Wauble Monolith is the Wauble instance that contains member variables for all other class instances.
  // Here, Wauble object is instantiated from within the class itself
  // and stored as a static variable.

  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new Wauble();

      self::$instance->init = new Wauble_Init;
      self::$instance->posts = new Wauble_Posts;
      self::$instance->editors = new Wauble_Editors;
      self::$instance->tweaks = new Wauble_Tweaks;
      self::$instance->scripts = new Wauble_Scripts;
      self::$instance->styles = new Wauble_Styles;
      self::$instance->sections = new Wauble_Sections;
      self::$instance->colors = new Wauble_Colors;
      self::$instance->login = new Wauble_Login;
      self::$instance->menus = new Wauble_Menus;
      self::$instance->acf = new Wauble_ACF;
      self::$instance->static_templates = new Wauble_Static_Templates;
      self::$instance->theme_support = new Wauble_Theme_Support;
    }

    return self::$instance;
  }

  public function getPrefix() {
    return self::$theme_prefix;
  }

  public function getImageAssetUrl($filename) {
    return sprintf('%s/dist/images/%s', self::$stylesheet_dir_url, ltrim($filename, '/'));
  }
  
  public function getStaticAssetUrl($filename) {
    return sprintf('%s/dist/static/%s', self::$stylesheet_dir_url, ltrim($filename, '/'));
  }

  public function getAssetUrl($filename) {
    return sprintf('%s/dist/%s', self::$stylesheet_dir_url, ltrim($filename, '/'));
  }

  public function requireOnce($path = '', $base = '') {
    if ($base === '') {
      $base = self::$template_dir_path;
    }

    if (strpos($path, '/') != 0) {
      $path = '/' . $path;
    }

    if ($this->ifFileExists($base . $path)) {
      require_once $base . $path;
    } else {
      throw new Exception($path . 'File Not Found');
    }
    return $this; // Return class instance for method chaining
  }

  private function ifFileExists($full_path) {
    if (file_exists($full_path)) {
      return true;
    }
  }

  public static function get_normalized_theme_version() {
    $theme_version = self::$version;
    $theme_version_array = explode('.', $theme_version);

    if (isset($theme_version_array[2]) && '0' === $theme_version_array[2]) {
      $theme_version = $theme_version_array[0] . '.' . $theme_version_array[1];
    }

    return $theme_version;
  }
}
