<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta property="og:image" content="<?php echo $share_image; ?>">
  <meta property="og:url" content="<?php global $wp;
                                    echo home_url($wp->request) ?>">
  <meta property="og:title" content="">
  
  <?php wp_head(); ?>
</head>

<body <?php body_class('') ?>>

<?php get_partial('partials/header'); ?>