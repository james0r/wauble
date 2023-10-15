<?php

/**
 * Template Name: Coming Soon template
 * Usage: Install wp-maintenance-mode plugin and set it to a page using this template.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bg-base-100 antialiased font-open-sans">

<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> x-data :class="$store.global.bodyClasses">
  <?php wp_body_open(); ?>
  <a href="#main" class="tw-skip-to-content-link tw-sr-only" tabindex="0">
    Skip to content
  </a>

  <header id="site-header" class="">
  </header>

  <main id="site-main" class="">

    <!-- Begin Loop -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="container">
          This template is assumed to at least partially hard-coded.
        </div>

        <?php echo do_shortcode('[sections]'); ?>

    <?php endwhile;
    endif; ?>
    <!-- End Loop -->

  </main>
  <footer id="site-footer">
  </footer>

  <?php wp_footer(); ?>
</body>

</html>