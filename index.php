<?php
get_header();
the_post();
?>

<div>test 123</div>

<?php
if ( is_single() ) {
	get_template_part( 'templates/single', get_post_type() );
} else if ( !is_front_page() && is_home() ) {
  get_template_part( 'templates/page-blog' );
} else {
  get_template_part( 'templates/page-404' );
}

get_footer();
