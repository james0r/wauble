<?php
get_header();

$q = new WP_Query; 
  if ( $q >have_posts() ) :
    while ( $q->have_posts() ) : $q->the_post();        
      the_title();
      the_excerpt();
    endwhile;
    
    else:
      wauble_get_template_part('template-parts/module-loop');
    endif;

wp_reset_postdata();

get_footer();

