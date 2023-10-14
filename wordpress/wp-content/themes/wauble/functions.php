<?php

if (!defined('WAUBLE_VERSION')) {
  define('WAUBLE_VERSION', '1.0.0');
}

if (!defined('WAUBLE_MIN_PHP_VER_REQUIRED')) {
  define('WAUBLE_MIN_PHP_VER_REQUIRED', '8.0');
}

if (!defined('WAUBLE_MIN_WP_VER_REQUIRED')) {
  define('WAUBLE_MIN_WP_VER_REQUIRED', '6.0');
}

if (!defined('WAUBLE_DEV_MODE')) {
  define('WAUBLE_DEV_MODE', false);
}

if (!defined('WAUBLE_DISABLE_BLOCK_EDITOR')) {
  define('WAUBLE_DISABLE_BLOCK_EDITOR', true);
}

require_once wp_normalize_path(get_template_directory() . '/inc/helpers.php');

require_once wp_normalize_path(get_template_directory() . '/inc/classes/Wauble.php');

require_once wp_normalize_path(get_template_directory() . '/inc/classes/Wauble_Autoload.php');

require_once wp_normalize_path(get_template_directory() . '/inc/Vite.lib.php');

new Wauble_Autoload;

function Wauble() {
  return Wauble::getInstance();
}

Wauble();