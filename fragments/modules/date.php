<?php 
global $post;
?>
<div class="date-module-contents">
  <?php echo get_meta($post->ID, '_crb_event_date_'.$instance) ?>
</div>
