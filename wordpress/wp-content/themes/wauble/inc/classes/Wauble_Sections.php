<?php

/**
 * This class retrieves ACF Flex Content sections and renders them where
 * the [render-sections] shortcode is used.
 */

class Wauble_Sections {
  /**
   * @var array $sections An array to store sections.
   */
  public $sections = array();

  /**
   * The array that holds the rendered sections.
   *
   * @var array
   */
  public $rendered_sections = array();

  public function __construct() {
    add_action('wp', [$this, 'initSections']);
    add_action('init', [$this, 'registerShortcode']);
    add_filter('acf/load_value/name=sections', [$this, 'saveDefaultSectionOnNewPost'], 10, 3);
  }

  /**
   * Initializes the sections for the Wauble theme.
   * 
   * This method retrieves the sections from the current post and sets them in the $sections property of the class.
   * 
   * @return void
   */
  public function initSections() {
    global $post;

    if (!$post) return;

    if ($section_fields = get_field('sections', $post->ID)) {
      $sections = array_map([$this, 'setSectionPathKeyValue'], $section_fields);
      $this->sections = $sections;
    }
  }

  /**
   * Registers the shortcode 'sections' and associates it with the 'render' method of the current class instance.
   */
  public function registerShortcode() {
    add_shortcode('sections', [$this, 'render']);
  }


  /**
   * Saves the default section on a new post.
   *
   * @param mixed $value The value of the field.
   * @param int $post_id The ID of the post.
   * @param string $field The name of the field.
   * @return mixed The updated value of the field.
   */
  public function saveDefaultSectionOnNewPost($value, $post_id, $field) {
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

  /**
   * Sets the template path key value for a section.
   *
   * @param array $section The section array.
   * @return array The modified section array with the template path key value set.
   */
  public function setSectionPathKeyValue($section) {
    $section['template'] = str_replace('_', '-', $section['acf_fc_layout']);
    return $section;
  }

  /**
   * Renders the sections of the Wauble theme.
   *
   * This method iterates over the sections array and renders each section using the specified template.
   * It sets query variables for each section, such as section, section_count, and section_is_first_instance,
   * before including the template file using the get_template_part() function.
   * Finally, it returns the rendered sections as a string.
   *
   * @return string The rendered sections.
   */
  public function render() {
    ob_start();
    echo '<!-- Begin Sections -->';
    foreach ($this->sections as $index => $section) {
      $template = $section['template'];
      $section_id = "section-$index";
      $section_class = "section-$template";
      $is_first_instance = !in_array($template, $this->rendered_sections);
      $this->rendered_sections[] = $template;

      $tmp_section = get_query_var('section');
      $tmp_section_count = get_query_var('section_count');
      $tmp_section_is_first_instance = get_query_var('section_is_first_instance');

      set_query_var('section', $section);
      set_query_var('section_count', $index);
      set_query_var('section_is_first_instance', $is_first_instance);

      echo "<section id=\"$section_id\" class=\"$section_class\">";
      get_template_part("sections/$template");
      echo '</section>';

      set_query_var('section', $tmp_section);
      set_query_var('section_count', $tmp_section_count);
      set_query_var('section_is_first_instance', $tmp_section_is_first_instance);
    }
    echo '<!-- End Sections -->';
    return ob_get_clean();
  }
}