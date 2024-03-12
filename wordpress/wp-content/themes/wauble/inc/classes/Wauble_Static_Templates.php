<?php

/**
 * This class registers static templates found in /templates/static.
 */

class Wauble_Static_Templates {
  public function __construct() {
    add_action('init', [$this, 'staticTemplateRewrite']);
    add_filter('query_vars', [$this, 'whitelistQueryVars']);
    add_action('template_include', [$this, 'includeStaticTemplate']);
  }

  public function staticTemplateRewrite() {
    add_rewrite_rule('/?$', 'index.php', 'top');

    // Not required. Just here for easier local development.
    flush_rewrite_rules();
  }

  public function whitelistQueryVars($query_vars) {
    $query_vars[] = 'static_template';

    return $query_vars;
  }

  public function includeStaticTemplate($template) {

    $static_query_var_value = get_query_var('static_template');

    if (!empty($static_query_var_value)) {
      return get_stylesheet_directory() . "/templates/static/{$static_query_var_value}.php";
    }

    return $template;
  }
}