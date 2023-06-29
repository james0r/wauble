<?php

/**
 * This class registers static templates found in /static-templates.
 */

class Wauble_Static_Templates {
  public function __construct() {
    add_action('init', [$this, 'static_template_rewrite']);
    add_filter('query_vars', [$this, 'whitelist_query_vars']);
    add_action('template_include', [$this, 'include_static_template']);
  }

  public function static_template_rewrite() {
    add_rewrite_rule('/?$', 'index.php', 'top');

    // Not required. Just here for easier local development.
    flush_rewrite_rules();
  }

  public function whitelist_query_vars($queryVars) {
    $queryVars[] = 'static_template';

    return $queryVars;
  }

  public function include_static_template($template) {

    $staticQueryVarValue = get_query_var('static_template');

    if (!empty($staticQueryVarValue)) {
      return get_stylesheet_directory() . "/static-templates/{$staticQueryVarValue}.php";
    }

    if (is_home()) {
      return get_stylesheet_directory() . '/static-templates/page-blog.php';
    }

    return $template;
  }
}