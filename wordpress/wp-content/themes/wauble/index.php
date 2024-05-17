<?php Wauble()->render('header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="px-6 md:px-8 py-8">
  <div class="container">
    <!-- Todo: Add content here. -->
    <hr>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php Wauble()->render('footer');
