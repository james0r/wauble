<?php
  /*
  Template Name: Dynamic Sections
  */
  get_header();
?>

<div class="<?php echo slugify($pagename); ?>">
  <div class="<?php echo slugify($pagename); ?>-inner">
    <?php get_fragment('module-loop'); ?>
    <?php carbon_get_the_post_meta('crb_test') ?>
  </div>
</div>

<?php get_footer(); ?>