<?php

/**
 * This class configures the Wordpress login screen.
 */

class Wauble_Login {

  public static $enable_customizations;

  public function __construct() {

    Self::$enable_customizations = false;

    if (Self::$enable_customizations) {
      add_action('login_enqueue_scripts', [$this, 'customize_login']);
    }
  }

  public function customize_login() {
    $background_img_path = get_stylesheet_directory_uri() . '/dist/images/wordpress_logo.png';
    echo "<style type=\"text/css\" data-test>
        #login h1 a, .login h1 a {
            background-image: url($background_img_path);
            height: 82px;
            width: 82px;
            background-size: 82px 82px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
        body {
          background: linear-gradient(to bottom, var(--color-primary-500), transparent, var(--color-secondary-500)) !important;
        }
    </style>";
  }
}