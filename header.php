<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <?php echo wauble_get_template_part('template-parts/theme-css-vars'); ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>