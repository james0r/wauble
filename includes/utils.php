<?php

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}


function cfimageurl( $meta_key, $id = null  ) {
  $image_id = crb_meta_data($meta_key, $id);
  if($image_id === null) {
    $image_id = $meta_key;
  }
  $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
  $image_url = wp_get_attachment_url($image_id);

	return (object) array(
    'url' => $image_url,
    'alt' => $image_alt,
  );
}

function cfthemeta($field) {
  return carbon_get_the_post_meta($field);
}

function cfthemeoption($field) {
  return carbon_get_theme_option($field);
}

function cfmeta($id, $field, $complex = false) {
  return carbon_get_post_meta($id, $field, $complex);
}

function cfattachmentimage ($field, $size = 'master', $icon = false, $attr = '') {
  return wp_get_attachment_image(cfthemeta($field), $size, $icon, $attr);
}

function get_part($part_slug = 'none', $arr = Array()) {
	return crb_render_fragment($part_slug, $arr);
}

// --- helpers ---

function do_truncate( $text, $limit ) {
  $return = $text;
  if(strlen($text) > $limit) {
    $return = substr($text, 0, $limit);
    $return .= '..';
  }
  return $return;
}

function get_directions( $address ) {
  return sprintf('https://www.google.com/maps/dir/?api=1&destination=%s', $address);
}

function slugify( $text ) {
  return str_replace( ' ', '-', strtolower($text) );
}

function get_nav( $menu_name, $args = array() ) {
  $return = array();
  $wp_nav = wp_get_nav_menu_items($menu_name, $args);
  if(is_array($wp_nav) === true) {
    $tree_like = buildTree($wp_nav);
    $return = parse_nav($tree_like);
  }
  return $return;
}

// Adds a toast in the bottom right corner displaying current template while logged into admin

function display_template_toast() {
	if ( is_super_admin() ) {
		global $template;

		$markup = '<div class="wp-template-toast">
						%s
						</div>
						<style>
							.wp-template-toast {
								position: fixed;
								height: 20px;
								width: 150px;
								background: rgba(255,0,0,.5);
								color: white;
								bottom: 0px;
								display: flex;
								justify-content: center;
								font-size: 12px;
								right: 0px;
								border-radius: 5px;
								animation: fadeout 1s 2s forwards;
							}
							@keyframes fadeout {
								from {
									opacity: 1;
								}

								to {
									opacity: 0;
								}
							}
						</style>';

			echo sprintf($markup, basename($template));
	}
}
 
add_action( 'wp_footer', 'display_template_toast' );