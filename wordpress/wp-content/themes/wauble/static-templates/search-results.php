<?php 
if ( isset( $_GET['_wpnonce'] ) &&
wp_verify_nonce( $_GET['_wpnonce'], 'search-results' ) ) {

  $s = htmlspecialchars(filter_input(INPUT_GET, 'cs'), ENT_QUOTES);
  $allsearch = new WP_Query("s=$s&showposts=-1");
  ?>
  
  <!-- Begin Loop -->
  <?php if (!empty($s) && $allsearch->have_posts()) : while ($allsearch->have_posts()) : $allsearch->the_post(); ?>
      <?php get_template_part('template-parts/content-search'); ?>
    <?php endwhile;
  else : ?>
    <?php get_template_part('template-parts/content-none'); ?>
  <?php endif; wp_reset_postdata();

} else {
print 'Sorry, your nonce did not verify. It is a secure WordPress site. go get a coffee !!';
exit;
}
?>