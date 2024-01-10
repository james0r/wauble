<?php get_template_part('template-parts/header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="tw-px-6 md:tw-px-8 tw-py-8">
  <div class="tw-container">
    <?php
    get_template_part('template-parts/content', get_post_type());
    ?>
    <hr>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php get_template_part('template-parts/footer');
