<?php get_template_part('template-parts/header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php echo do_shortcode('[sections]'); ?>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php get_template_part('template-parts/footer');