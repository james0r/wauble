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

<?php 
  if (carbon_get_theme_option('crb_show_promo_options')) : ?>

  <div class="promo-banner-major">
    <div class="minor-container">
      <div class="promo-banner">
        <div class="promo-banner-inner">
          <?php echo carbon_get_theme_option('crb_promo_banner'); ?>
          <i class="fa fa-times promo-close" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>

  <?php endif; ?>

  <?php get_fragment('header'); ?>