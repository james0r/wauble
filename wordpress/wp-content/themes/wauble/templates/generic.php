<?php

/**
 * Template Name: Generic Page Template
 * Usage: This template is intended for pages that only render content from the WordPress classic editor.
 */
?>

<?php Wauble()->render('header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="tw-py-12 sm:tw-py-16">
  <section class="tw-px-6 md:tw-px-8">
    <div class="tw-container">
      <h1 class="tw-text-3xl sm:tw-text-5xl tw-font-bold tw-mb-6 sm:tw-mb-8">
        <?php the_title() ?>
      </h1>
    </div>
  </section>
  
  <section class="tw-px-6 md:tw-px-8">
    <div class="tw-container">
      <div class="tw-prose sm:tw-prose-lg">
        <?php the_content() ?>
      </div>
    </div>
  </section>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php Wauble()->render('footer');