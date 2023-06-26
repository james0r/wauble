<?php

/**
 * Template Name: Search template
 */
?>

<?php get_template_part('template-parts/header'); ?>
<script src="https://unpkg.com/htmx.org@1.8.4"></script>

<div class="container my-8">
  <?php get_search_form(); ?>

  <!-- Begin Loop -->
  <?php if (have_posts() && is_search()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/content-search'); ?>
    <?php endwhile;
  else : ?>
    <?php get_template_part('template-parts/content-none'); ?>
  <?php endif; ?>
  <!-- End Loop -->

</div>

<?php get_template_part('template-parts/footer');
