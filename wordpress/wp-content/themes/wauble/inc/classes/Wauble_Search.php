<?php

/**
 * This class handles WordPress search functionality.
 */

class Wauble_Search {

  public function __construct() {
    add_action('template_redirect', [$this, 'nice_search_redirect']);
    add_action('search_rewrite_rules', [$this, 'search_empty_query_template_redirect']);;
    add_filter('wpseo_title', [$this, 'on_filter_title'], 15);
    add_filter('pre_get_document_title', [$this, 'on_filter_title'], 10);
  }

  public function on_filter_title($title) {
    if (is_search() && get_search_query() === '') {
      return str_replace('You searched for', 'Search', $title);
    }

    return $title;
  }

  public function nice_search_redirect() {
    global $wp_rewrite;
    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks())
      return;

    $search_base = $wp_rewrite->search_base;
    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
      wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
      exit();
    }
  }

  public function search_empty_query_template_redirect($rewrite) {
    global $wp_rewrite;
    $rules = array(
      $wp_rewrite->search_base . '/?$' => 'index.php?s=',
    );
    $rewrite = $rewrite + $rules;
    return $rewrite;
  }
}