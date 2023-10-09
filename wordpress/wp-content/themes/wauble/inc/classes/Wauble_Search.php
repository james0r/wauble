<?php

/**
 * This class handles WordPress search functionality.
 */

class Wauble_Search {

  public function __construct() {
    add_action('template_redirect', [$this, 'rewriteQueryParamsToUrlSegments']);
    add_action('search_rewrite_rules', [$this, 'rewriteBaseSearchRouteNoParams']);;
    add_filter('wpseo_title', [$this, 'filterTitleTag'], 15);
    add_filter('pre_get_document_title', [$this, 'filterTitleTag'], 10);
    add_filter('get_pagenum_link', [$this, 'filterPaginationLinks'], 10, 2);
  }

  public function filterTitleTag($title) {
    if (is_search() && get_search_query() === '') {
      return str_replace('You searched for', 'Search', $title);
    }

    return $title;
  }

  public function rewriteQueryParamsToUrlSegments() {
    global $wp_rewrite;
    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks())
      return;

    $search_base = $wp_rewrite->search_base;
    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
      wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
      exit();
    }
  }

  public function rewriteBaseSearchRouteNoParams($rewrite) {
    global $wp_rewrite;
    $rules = array(
      $wp_rewrite->search_base . '/?$' => 'index.php?s=',
    );
    $rewrite = $rewrite + $rules;
    return $rewrite;
  }
  
  public function filterPaginationLinks($link, $i) {

    if (is_search()) {
      $link = str_replace('/page/', '/?paged=', $link);
      $link = str_replace($i . '/', $i, $link);
    }

    return $link;
  }
}