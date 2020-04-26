<?php
  /*
  Template Name: Dynamic Sections
  */
  get_header();
?>

<div class="<?php echo slugify($pagename); ?>">
  <div class="<?php echo slugify($pagename); ?>-inner">
    <?php get_fragment('module-loop'); ?>
  </div>
</div>

<?php get_footer(); ?>