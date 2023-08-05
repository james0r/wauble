<?php

/**
 * This class makes small tweaks to slim, streamline, and generally improve Wordpress.
 */

class Wauble_Tweaks {
  public function __construct() {
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', [$this, 'disableEmojisTinymce']);
    add_filter('wp_resource_hints', [$this, 'disableEmojisRemoveDnsPrefetch'], 10, 2);
    add_action('admin_menu', [$this, 'removeUnusedAdminMenuItems']);
    add_action('wp_dashboard_setup', [$this, 'removeUnusedDashboardWidgets'], 999);

    add_filter('wpcf7_autop_or_not', '__return_false');
  }

  public function disableEmojisTinymce($plugins) {
    if (is_array($plugins)) {
      return array_diff($plugins, ['wpemoji']);
    } else {
      return [];
    }
  }

  public function disableEmojisRemoveDnsPrefetch($urls, $relation_type) {
    if ('dns-prefetch' == $relation_type) {
      /** This filter is documented in wp-includes/formatting.php */
      $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

      $urls = array_diff($urls, [$emoji_svg_url]);
    }

    return $urls;
  }

  public function removeUnusedAdminMenuItems() {
    global $menu;
    $restricted = [__('Links'), __('Comments')];
    end($menu);
    while (prev($menu)) {
      $value = explode(' ', $menu[key($menu)][0]);
      if (in_array($value[0] != null ? $value[0] : '', $restricted)) {
        unset($menu[key($menu)]);
      }
    }
  }

  public function removeUnusedDashboardWidgets() {
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  }
}