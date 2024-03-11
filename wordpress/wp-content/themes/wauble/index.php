<?php Wauble()->component('header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="tw-px-6 md:tw-px-8 tw-py-8">
  <div class="tw-container">
    <!-- Todo: Add content here. -->
    <hr>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php Wauble()->component('footer');
