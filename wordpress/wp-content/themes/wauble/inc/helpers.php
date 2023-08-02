<?php

if (!function_exists('wauble_posted_by')) :
  /**
   * Prints HTML with meta information for the current author.
   */
  function wauble_posted_by() {
    $byline = sprintf(
      /* translators: %s: post author. */
      esc_html_x('by %s', 'post author', 'wauble'),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

  }
endif;

if (!function_exists('wauble_get_page_id_by_slug')) {
  function wauble_get_page_id_by_slug($slug) {
    $post_data = get_page_by_path($slug);
    return $post_data->ID;
  }
}

if (!function_exists('dd')) {
  function dd($data) {
    ini_set('highlight.comment', '#969896; font-style: italic');
    ini_set('highlight.default', '#FFFFFF');
    ini_set('highlight.html', '#D16568');
    ini_set('highlight.keyword', '#7FA3BC; font-weight: bold');
    ini_set('highlight.string', '#F2C47E');
    $output = highlight_string("<?php\n\n" . var_export($data, true), true);
    echo "<div style=\"background-color: #1C1E21; padding: 1rem\">{$output}</div>";
    die();
  }
}

if (!function_exists('get_id_from_path')) {
  /**
   * Retrieves a page id given its path.
   *
   * @param  string $path
   * @params string $output
   * @param  string $post_type
   * @return int|null
   */
  function get_id_from_path($path, $output, $post_type) {
    $page = get_page_by_path($path, $output, $post_type);

    if ($page) {
      return $page->ID;
    } else {
      return null;
    }
  }
}

if (!function_exists('wauble_escape_json_string')) {
  function wauble_escape_json_string($value) {
    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
  }
}

if (!function_exists('wauble_get_directions')) {
  function wauble_get_directions($address) {
    // Redirects to Apple Maps if Apple device and falls back to Google maps if not.
    return sprintf('https://maps.apple.com/?q=%s', $address);
  }
}

if (!function_exists('wauble_get_attachment_image_no_srcset')) {
  function wauble_get_attachment_image_no_srcset($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
    add_filter('wp_calculate_image_srcset_meta', '__return_null');
    $html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);
    remove_filter('wp_calculate_image_srcset_meta', '__return_null');

    return $html;
  }
}

if (!function_exists('wauble_attachment_id_from_url')) {
  /**
   * Tries to convert a attachment URL to a post ID.
   *
   * @param string $url
   * @return int|null
   */
  function wauble_attachment_id_from_url($url) {
    return attachment_url_to_postid($url);
  }
}