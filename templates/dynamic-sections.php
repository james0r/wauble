<?php
  /*
  Template Name: Dynamic Sections
  */
  get_header();
?>

<div class="<?php echo slugify($pagename); ?>">
  <div class="<?php echo slugify($pagename); ?>-inner">
    <?php get_part('module-loop'); ?>
  </div>
</div>