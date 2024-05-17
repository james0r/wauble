<?php

/**
 * Template Name: Generic Page Template
 * Usage: This template is intended for pages that only render content from the WordPress classic editor.
 */
?>

<?php Wauble()->render('header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="py-12 sm:py-16">
  <section class="px-6 md:px-8">
    <div class="container">
      <h1 class="text-3xl sm:text-5xl font-bold mb-6 sm:mb-8">
        <?php the_title() ?>
      </h1>
    </div>
  </section>
  
  <section class="px-6 md:px-8">
    <div class="container">
      <div class="prose sm:prose-lg">
        <?php the_content() ?>
      </div>
    </div>
  </section>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php Wauble()->render('footer');