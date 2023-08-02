<?php

/**
 * This class handles the enqueueing and dequeueing of styles.
 */

class Wauble_Utils {

  public function __construct() {}

  public static function cssEncodeSectionScoped($rules, $section_count = null, $indent = 0) {
    if ($section_count === null || !isset($section_count)) {
      return self::cssEncode($rules, $indent);
    } else {
      $top_level_selector = array_key_first($rules);
      $scoped_selector = '#section-' . $section_count . ' ' . $top_level_selector;

      $rules[$scoped_selector] = $rules[$top_level_selector];
      unset($rules[$top_level_selector]);

      return self::cssEncode($rules, $indent);
    }
  }

  public static function cssEncode($rules, $indent = 0) {
    $css = '';
    $prefix = str_repeat('  ', $indent);

    foreach ($rules as $key => $value) {
      if (is_array($value)) {
        $selector = $key;
        $properties = $value;

        $css .= $prefix . "$selector {\n";
        $css .= $prefix . self::cssEncode($properties, $indent + 1);
        $css .= $prefix . "}\n";
      } else {
        $property = $key;
        $css .= $prefix . "$property: $value;\n";
      }
    }

    return $css;
  }

  public static function attrsEncode($attrs) {
    $html = '';

    foreach ($attrs as $key => $value) {
      $html .= sprintf('%s="%s" ', $key, $value);
    }

    return $html;
  }

  public static function consoleLog($data) {
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
  }
}