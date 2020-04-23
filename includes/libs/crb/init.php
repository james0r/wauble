<?php

# Autoload dependencies
$autoload_dir = CRB_THEME_DIR . 'vendor/autoload.php';
if ( ! is_readable( $autoload_dir ) ) {
  wp_die( __( 'Please, run <code>composer install</code> to download and install the theme dependencies.', 'crb' ) );
}
include_once( $autoload_dir );
\Carbon_Fields\Carbon_Fields::boot();