<?php

/**
 * Template Name: Search template
 */
?>

<?php get_template_part('template-parts/header'); ?>
<script src="https://unpkg.com/htmx.org@1.8.4"></script>

<div class="px-6 md:px-8">
  <div class="container my-8">
    <div class="max-w-max mx-auto my-4">
      <?php get_template_part('template-parts/searchform'); ?>
    </div>

    <!-- Begin Loop -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('template-parts/content-search'); ?>
    <?php endwhile;
    else : ?>
    <?php get_template_part('template-parts/content-none'); ?>
    <?php endif; ?>
    <!-- End Loop -->

  </div>
</div>


<?php get_template_part('template-parts/footer');