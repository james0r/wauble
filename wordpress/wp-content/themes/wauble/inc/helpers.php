<?php

if ( ! function_exists( 'wauble_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wauble_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'wauble' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('get_page_id_by_slug')) {
  function get_page_id_by_slug($slug) {
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
  function get_id_from_path($slug) {
    $page = get_page_by_path($slug);

    if ($page) {
      return $page->ID;
    } else {
      return null;
    }
  }
}

function escapeJsonString($value) {
  $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
  $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
  $result = str_replace($escapers, $replacements, $value);
  return $result;
}

function wauble_console_log($data) {
  echo '<script>';
  echo 'console.log(' . json_encode($data) . ')';
  echo '</script>';
}

function wauble_get_directions($address) {
  // Redirects to Apple Maps if Apple device and falls back to Google maps if not.
  return sprintf('https://maps.apple.com/?q=%s', $address);
}

function wauble_get_attachment_image_no_srcset($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
  // add a filter to return null for srcset
  add_filter('wp_calculate_image_srcset_meta', '__return_null');
  // get the srcset-less img html
  $html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);
  // remove the above filter
  remove_filter('wp_calculate_image_srcset_meta', '__return_null');

  return $html;
}

// Wrap this awkwardly named WP function
function wauble_attachment_id_from_url($url) {
  return attachment_url_to_postid($url);
}

/**
 * Recursive function that generates from a a multidimensional array of CSS rules, a valid CSS string.
 *
 * @param array $rules
 *   An array of CSS rules in the form of:
 *   array('selector'=>array('property' => 'value')). Also supports selector
 *   nesting, e.g.,
 *   array('selector' => array('selector'=>array('property' => 'value'))).
 *
 * @return string A CSS string of rules. This is not wrapped in <style> tags.
 * @source http://matthewgrasmick.com/article/convert-nested-php-array-css-string
 */
function php_array_to_css($rules, $indent = 0) {
  $css = '';
  $prefix = str_repeat('  ', $indent);

  foreach ($rules as $key => $value) {
      if (is_array($value)) {
          $selector = $key;
          $properties = $value;

          $css .= $prefix . "$selector {\n";
          $css .= $prefix . php_array_to_css($properties, $indent + 1);
          $css .= $prefix . "}\n";
      } else {
          $property = $key;
          $css .= $prefix . "$property: $value;\n";
      }
  }

  return $css;
}
