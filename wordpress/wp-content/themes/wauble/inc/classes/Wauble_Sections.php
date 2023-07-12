<?php

/**
 * This class retrieves ACF Flex Content sections and renders them where
 * the [render-sections] shortcode is used.
 */

class Wauble_Sections {
  public $sections = array();

  public function __construct() {
    add_action('wp', [$this, 'init_sections']);
    add_action('init', [$this, 'register_shortcode']);
    add_filter('acf/load_value/name=sections', [$this, 'add_content_area_default_section'], 10, 3);

    global $sections_included;
    $sections_included = array();
  }
  
  public function init_sections() {
    global $post;

    if (!$post) return;

    if ($section_fields = get_field('sections', $post->ID)) {
      $sections = array_map([$this, 'get_section_filename'], $section_fields);
      $this->sections = $sections;
    }
  }

  public function register_shortcode() {
    add_shortcode( 'sections', [$this, 'render'] );
  }

  public function add_content_area_default_section($value, $post_id, $field) {
    if ($value !== NULL) {
      // $value will only be NULL on a new post
      return $value;
    }
    // add default layouts
    $value = array(
      array(
        'acf_fc_layout' => 'content_area' 
      )
    );
    return $value;
  }

  public function get_section_filename($section) {
    $section['template'] = str_replace('_', '-', $section['acf_fc_layout']);
    return $section;
  }

  public function render() {
    ob_start();
    echo '<!-- Begin Sections -->';
    foreach($this->sections as $index => $section) : ?>

      <section id="section-<?php echo $index ?>" class="section-<?php echo $section['template'] ?>">
        <?php
          global $sections_included;

          if (in_array($section['template'], $sections_included)) {
            set_query_var('section_is_first_instance', false);
          } else {
            set_query_var('section_is_first_instance', true);
            array_push($sections_included, $section['template']);
          }

          // Globally set the ACF data and section count for use in the template
          set_query_var('section', $section);
          set_query_var('section_count', $index);

          echo get_template_part('sections/' . $section['template']);

          // Reset the ACF data and section count to prevent scope pollution
          set_query_var('section_is_first_instance', null);
          set_query_var('section', null);
          set_query_var('section_count', null);
          ?>
      </section>

      <?php 
      ?>
      
      <?php endforeach;
    echo '<!-- End Sections -->';
    return ob_get_clean();
  }
}
