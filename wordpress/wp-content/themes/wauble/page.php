<?php Wauble()->component('header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php echo do_shortcode('[sections]'); ?> 

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php Wauble()->component('footer');