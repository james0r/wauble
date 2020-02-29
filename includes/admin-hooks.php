<?php
// modify the custom post type/taxonomy permalink
function rewrite_rules( $url, $post ) {
  $type = $post->post_type;
  if(empty($type) === true) {
    $type = $post->taxonomy;
  }

  switch ( $type ) { // accepts post_type or taxonomny
    // case 'career':
    //   $return = str_replace( '/career/', '/careers?listing=', $url );
    //   $return = rtrim( $return, "/" );
    //   break;
    // case 'resource_type':
    //   $return = str_replace( '/resource-type/', '/resources?type=', $url );
    //   $return = rtrim( $return, "/" );
    //   break;
    // case 'category':
    //   $return = str_replace( '/category/', '/blog?category=', $url );
    //   $return = rtrim( $return, "/" );
    //   break;
    default:
      $return = $url;
      break;
  }
  return $return;
}
add_filter( 'term_link', 'rewrite_rules', 10, 2 );
add_filter( 'post_type_link', 'rewrite_rules', 10, 2 );

// // disable WP 5.0 block editor
// add_filter('use_block_editor_for_post', '__return_false', 10);

// add icons for use in admin area
add_filter( 'wpsl_admin_marker_dir', 'custom_admin_marker_dir' );
function custom_admin_marker_dir() {
  $admin_marker_dir = get_stylesheet_directory() . '/assets/images/wpsl-markers/';
  return $admin_marker_dir;
}
define( 'WPSL_MARKER_URI', dirname( get_bloginfo( 'stylesheet_url') ) . '/assets/images/wpsl-markers/' );

// customize the admin login screen
add_filter( 'login_headertitle', 'crb_change_login_header_title' );
function crb_change_login_header_title() {
	return get_bloginfo( 'name' );
}

add_filter( 'login_headerurl', 'crb_change_login_header_url' );
function crb_change_login_header_url() {
	return home_url( '/' );
}

// --- helpers ---
