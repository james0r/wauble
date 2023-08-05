<?php

/**
 * This class retrieves ACF Flex Content sections and renders them where
 * the [render-sections] shortcode is used.
 */

class Wauble_Sections {
  public $sections = array();

  public $included_sections = array();

  public function __construct() {
    add_action('wp', [$this, 'initSections']);
    add_action('init', [$this, 'registerShortcode']);
    add_filter('acf/load_value/name=sections', [$this, 'addExampleSections'], 10, 3);
  }

  public function initSections() {
    global $post;

    if (!$post) return;

    if ($section_fields = get_field('sections', $post->ID)) {
      $sections = array_map([$this, 'getSectionFilename'], $section_fields);
      $this->sections = $sections;
    }
  }

  public function registerShortcode() {
    add_shortcode('sections', [$this, 'render']);
  }

  public function addExampleSections($value, $post_id, $field) {
    if ($value !== NULL) {
      // $value will only be NULL on a new post
      return $value;
    }
    
    $value = array(
      array(
        'acf_fc_layout' => 'content_area'
      )
    );
    return $value;
  }

  public function getSectionFilename($section) {
    $section['template'] = str_replace('_', '-', $section['acf_fc_layout']);
    return $section;
  }

  public function render() {
    ob_start();
    echo '<!-- Begin Sections -->';
    foreach ($this->sections as $index => $section) {
      $template = $section['template'];
      $section_id = "section-$index";
      $section_class = "section-$template";
      $is_first_instance = !in_array($template, $this->included_sections);
      $this->included_sections[] = $template;

      set_query_var('section', $section);
      set_query_var('section_count', $index);
      set_query_var('section_is_first_instance', $is_first_instance);

      echo "<section id=\"$section_id\" class=\"$section_class\">";
      get_template_part("sections/$template");
      echo '</section>';

      set_query_var('section', null);
      set_query_var('section_count', null);
      set_query_var('section_is_first_instance', null);
    }
    echo '<!-- End Sections -->';
    return ob_get_clean();
  }
}