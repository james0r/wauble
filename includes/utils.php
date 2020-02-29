<?php

function crb_image_asset( $asset_name, $alt_tag, $classname = null) {
  $tpl = '<img %s src="%s/%s" alt="%s">';
  $class = '';
  if(empty($classname) === false) {
    $class = sprintf('class="%s"', $classname);
  }
	return sprintf($tpl, $class, get_bloginfo('stylesheet_directory'), ltrim($asset_name, '/'), $alt_tag);
}

function crb_meta_data( $meta_key, $id = null ) {
  if (empty($id) === true) {
    $id = get_the_id();
  }

  $return = null;
  if ( empty($return) === true ) {
    $return = carbon_get_post_meta( $id, $meta_key );
  }
  if ( empty($return) === true ) {
    $return = carbon_get_theme_option($meta_key);
  }
	return $return;
}

function crb_meta_image( $meta_key, $id = null  ) {
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

function crb_get_fragment_name( $section ) {
	return str_replace( '_', '-', $section['_type'] );
}

function crb_page_builder_alg() {
  if ( $list_section = carbon_get_the_post_meta( 'crb_block_sections' ) ) {
  	foreach ( $list_section as $idx => $section ) {
      $section['index'] = $idx;
  		$fragment_name = crb_get_fragment_name( $section );

  		crb_render_fragment( 'page-builder/' . $fragment_name, $section );
  	}
  }
}

// app specific

function expand_alg( $url ) {
  $query = str_replace('#expand?', '', $url);
  parse_str($query, $param);

  $return = array();
  if(isset($param['taxonomy']) === true) {
    $terms = get_terms($param['taxonomy'], array('hide_empty' => false));
    foreach($terms as $term_obj) {
      $return[] = array(
        'title' => $term_obj->name,
        'url' => get_term_link($term_obj),
      );
    }
  } else {
    // The Query
    $args = array(
      'post_type' => $param['post_type'],
      // oldest posts first
      'order' => 'ASC',
      'orderby' => 'date',
      'posts_per_page' => '-1',
    );

    if (empty($param['limit']) === false) {
      $args['posts_per_page'] = $param['limit'];
    }

    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $return[] = array(
          'title' => get_the_title(),
          'url'   => get_permalink(),
        );
      }
    }
  }
  return $return;
}

// shopify inspired polyfills

function asset_img_url( $filename ) {
  return sprintf('%s/assets/images/%s', get_bloginfo('stylesheet_directory'), ltrim($filename, '/'));
}

function img_tag( $filename, $alt_tag, $classname = null) {
  $tpl = '<img %s src="%s/assets/images/%s" alt="%s">';
  $class = '';
  if(empty($classname) === false) {
    $class = sprintf('class="%s"', $classname);
  }
	return sprintf($tpl, $class, get_bloginfo('stylesheet_directory'), ltrim($filename, '/'), $alt_tag);
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

function default_url( $url ) {
  $return = '';
  if ($url !== '#') {
    $return = sprintf('href="%s"', $url);
  }
  return $return;
}

function get_directions( $address ) {
  return sprintf('https://www.google.com/maps/dir/?api=1&destination=%s', $address);
}

function get_the_default_image() {
  return crb_image_asset('assets/images/no-image.svg', 'no image uploaded yet');
}

function get_cat_slug( $id ) {
  $cat = get_category( $id );
  return $cat->slug;
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

function parse_nav( $linklist ) {
  $return = array();
  foreach ($linklist as $id => $obj) {
    $info = array(
      'title' => $obj->title,
      'url'   => $obj->url,
    );
    if(isset($obj->wpse_children) === true) {
      $info['links'] = parse_nav($obj->wpse_children);
    } else if (strpos($obj->url, '#expand') !== false) {
      parse_str($obj->url, $param);
      $info['url'] = $param['actual'];
      $info['links'] = expand_alg($obj->url);
    }
    $return[] = $info;
  }
  return $return;
}

/**
 * Modification of "Build a tree from a flat array in PHP"
 *
 * Authors: @DSkinner, @ImmortalFirefly and @SteveEdson
 *
 * @link https://stackoverflow.com/a/28429487/2078474
 */
function buildTree( array &$elements, $parentId = 0 )
{
    $branch = array();
    foreach ( $elements as &$element )
    {
        if ( $element->menu_item_parent == $parentId )
        {
            $children = buildTree( $elements, $element->ID );
            if ( $children )
                $element->wpse_children = $children;

            $branch[$element->ID] = $element;
            unset( $element );
        }
    }
    return $branch;
}
