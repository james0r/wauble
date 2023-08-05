<?php

/**
 * This class handles post types and loops.
 */

class Wauble_Posts {
  public function __construct() {
    add_action('pre_get_posts', [$this, 'on_pre_get_posts']);
  }

  public function on_pre_get_posts($query) {
    if ($query->is_main_query() && !is_admin() && is_home()) {
      $page_for_posts = get_option('page_for_posts');
      $use_global_posts_per_page = get_field('use_global_posts_per_page', $page_for_posts) ?? null;

      if ($use_global_posts_per_page) {
        return;
      } 

      $query->set('posts_per_page', get_field('posts_per_page', get_option('page_for_posts')));
    }

    if ($query->is_main_query() && !is_admin() && is_search()) {
      $page_for_posts = get_option('page_for_posts');
      $use_global_posts_per_page = get_field('use_global_posts_per_page_on_search', 'option') ?? null;

      if ($use_global_posts_per_page) {
        return;
      } 

      $query->set('posts_per_page', get_field('search_results_posts_per_page', 'option'));
    }
  }
}