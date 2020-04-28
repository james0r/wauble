<?php
define( 'WAUBLE_THEME_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
define( 'THEME_ASSETS', get_stylesheet_directory_uri() . '/assets' );


// ================================================ SCRIPTS	AND STYLESHEETS

function wauble_resources() {
  wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/style.css' );
  crb_enqueue_style( 'theme-styles', get_template_directory_uri() . '/style.css' );
  wp_enqueue_script( 'header_js', get_template_directory_uri() . '/assets/header-bundle.js', null, 1.0, false );
  wp_enqueue_script( 'footer_js', get_template_directory_uri() . '/assets/footer-bundle.js', null, 1.0, true );
}

add_action( 'wp_enqueue_scripts', 'wauble_resources' );

function admin_scripts_styles() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/_dev/admin/admin.css');
  wp_enqueue_script('jquery-ui', get_template_directory_uri().'/_dev/admin/jquery-ui.min.js');
  wp_enqueue_script('admin-scripts', get_template_directory_uri().'/_dev/admin/admin.js');
}

add_action('admin_enqueue_scripts', 'admin_scripts_styles');

// ================================================ THEME SUPPORTS

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'html5', array( 'gallery' ) );
add_theme_support( 'align-wide' );
add_theme_support( 'editor-styles' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'dark-editor-style' );
add_theme_support( 'responsive-embed' );

// ================================================ IMAGE SIZES

add_image_size( 'small-thumbnail', 720, 720, true );
add_image_size( 'square-thumbnail', 80, 80, true );
add_image_size( 'banner-image', 1024, 1024, true );

// ================================================ WAUBLE THEME DEFAULTS



function wauble_theme_setup() {
  
  // ================================================ LIBRARIES & INCLUDES

  if ( file_exists(  WAUBLE_THEME_DIR . 'includes/post-types.php' ) ) {
    require_once  WAUBLE_THEME_DIR . 'includes/post-types.php';
  }
  if ( file_exists(  WAUBLE_THEME_DIR . 'includes/shortcodes.php' ) ) {
    require_once  WAUBLE_THEME_DIR . 'includes/shortcodes.php';
  }
  if ( file_exists(  WAUBLE_THEME_DIR . 'includes/taxonomies.php' ) ) {
    require_once  WAUBLE_THEME_DIR . 'includes/taxonomies.php';
  }
  if ( file_exists(  WAUBLE_THEME_DIR . '/includes/utils.php' ) ) {
    require_once  WAUBLE_THEME_DIR . 'includes/utils.php';
  }
  
  function condensed_body_class($classes) {
      global $post;
   
      // add a class for the name of the page - later might want to remove the auto generated pageid class which isn't very useful
      if( is_page()) {
          $pn = $post->post_name;
          $classes[] = "page_".$pn;
      }
   
      // add a class for the parent page name
      if ( is_page() && $post->post_parent ) {
          $post_parent = get_post($post->post_parent);
          $parentSlug = $post_parent->post_name;
          $classes[] = "parent_".$parentSlug;
      }
   
      // add class for the name of the custom template used (if any)
      $temp = get_page_template();
      if ( $temp != null ) {
          $path = pathinfo($temp);
          $tmp = $path['filename'] . "." . $path['extension'];
          $tn= str_replace(".php", "", $tmp);
          $classes[] = "template_".$tn;
      }

      wp_reset_postdata();
   
      return $classes;
   
  }
  
  add_filter( 'body_class', 'condensed_body_class');

  // Set classes for pagination links

  function next_posts_link_attributes() {
    return 'class="next-button"';
  }
  function prev_posts_link_attributes() {
    return 'class="prev-button"';
  }

  add_filter('next_posts_link_attributes', 'next_posts_link_attributes');
  add_filter('previous_posts_link_attributes', 'prev_posts_link_attributes');

  /**
 * Hide editor on specific pages.
 *
 */
  add_action( 'admin_init', 'hide_editor' );

  function hide_editor() {
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;

    // Hide the editor on the page titled 'Homepage'
    $homepgname = get_the_title($post_id);
    if($homepgname == 'Homepage'){ 
      remove_post_type_support('page', 'editor');
    }

    // Hide the editor on a page with a specific page template
    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if($template_file == 'templates/dynamic-sections.php'){ // the filename of the page template
      remove_post_type_support('page', 'editor');
    }
  }

  // Disables Gutenburg
  add_filter('use_block_editor_for_post', '__return_false', 5);

  // Remove comments page in menu
  add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
  });

  // Remove comments links from admin bar
  add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
  });

  add_action( 'init', 'cp_change_post_object' );
  // Change dashboard Posts to Blog
  function cp_change_post_object() {
      $get_post_type = get_post_type_object('post');
      $labels = $get_post_type->labels;
          $labels->name = 'Blog';
          $labels->singular_name = 'Blog';
          $labels->add_new = 'Add Article';
          $labels->add_new_item = 'Add New';
          $labels->edit_item = 'Edit Article';
          $labels->new_item = 'New Article';
          $labels->view_item = 'View Article';
          $labels->search_items = 'Search Blog';
          $labels->not_found = 'No Articles found';
          $labels->not_found_in_trash = 'No Articles found in Trash';
          $labels->all_items = 'All Articles';
          $labels->menu_name = 'Blog';
          $labels->name_admin_bar = 'Blog';
          $get_post_type->menu_icon = 'dashicons-welcome-write-blog';
  }

  //Remove Comments Bubble from WP Admin Top Bar
  function remove_comment_bubble() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
  }
  add_action( 'wp_before_admin_bar_render', 'remove_comment_bubble' );

  //Remove Comments and Links from WP Admin Main Nav
  function remove_menus(){
  global $menu;
    $restricted = array(__('Links'), __('Comments'));
    end ($menu);
    while (prev($menu)){
      $value = explode(' ',$menu[key($menu)][0]);
      if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }
  }
  add_action('admin_menu', 'remove_menus');

  //Put version numbers for Wauble and active design style in wp admin footer
  function change_admin_footer(){
    $theme_data = wp_get_theme();
    echo $theme_data->get( 'Name' ).' v '.$theme_data->get( 'Version' );
  }
  add_filter('admin_footer_text', 'change_admin_footer'); 
  function change_footer_version() {
    $theme_data = wp_get_theme();
    if($theme_data->parent()){
      echo $theme_data->parent()->get( 'Name' ).' v '.$theme_data->parent()->get( 'Version' );
    }
  }
  add_filter( 'update_footer', 'change_footer_version', 9999);

  //Remove Default Dashboard Widgets
  function disable_default_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_site_health', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
  }
  add_action('admin_menu', 'disable_default_dashboard_widgets');
  
}

add_action( 'after_setup_theme', 'wauble_theme_setup' );

 //AUTO GENERATE MODULES TABLE
 function createModulesTable(){
  $sql =
      "CREATE TABLE IF NOT EXISTS modules (
        id int(32) NOT NULL auto_increment ,
        module varchar(100) NOT NULL,
        name varchar(255) NOT NULL,
        page int(32) NOT NULL,
        display_order int(32) NOT NULL,
        PRIMARY KEY  (id)
      )";
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta( $sql );
}

add_action("after_switch_theme", "createModulesTable");

function rename_theme_options() {
    
  global $menu;
  
  foreach($menu as $key => $item) {
    if ( $item[0] === 'Theme Options' ) {
        $menu[$key][0] = __('Wauble Options','wauble');
    }
  }
 return false;
}
add_action( 'admin_menu', 'rename_theme_options', 999 );