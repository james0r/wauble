<?php get_template_part('template-parts/header'); ?>

<?php $tag_id = get_queried_object_id(); ?>

<div class="container my-8">
  List of posts with <?php echo get_tag($tag_id)->name ?>

  <!-- Begin Loop -->
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php
      echo '<br>';
      the_title();
      the_content();
      ?>

  <?php endwhile;
  endif; ?>
  <!-- End Loop -->
</div>


<?php get_template_part('template-parts/footer');