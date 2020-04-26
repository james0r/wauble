<?php 
global $post;
?>
<div class="name-module-contents">
  <?php echo get_meta($post->ID, '_crb_full_name_'.$instance) ?>
</div>
