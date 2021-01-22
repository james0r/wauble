<?php
/**
 * Functions and definitions
 */

define('WAUBLE_THEME_DIR', dirname(__FILE__) . '/');
define('WAUBLE_THEME_ASSETS_DIR', get_stylesheet_directory_uri() . '/assets/');

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
  require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('wauble_setup')) {
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   *
   * @return void
   */
  function wauble_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Twenty-One, use a find and replace
     * to change 'wauble' to the name of your theme in all the template files.
     */
    load_theme_textdomain('wauble', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * This theme does not use a hard-coded <title> tag in the document head,
     * WordPress will provide it for us.
     */
    add_theme_support('title-tag');

    /**
     * Add post-formats support.
     */
    add_theme_support(
      'post-formats',
      array(
        'link',
        'aside',
        'gallery',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat',
      )
    );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1568, 9999);

    register_nav_menus(
      array(
        'primary' => esc_html__('Primary menu', 'wauble'),
        'footer'  => __('Secondary menu', 'wauble'),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5',
      array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
      )
    );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    $logo_width = 300;
    $logo_height = 100;

    add_theme_support(
      'custom-logo',
      array(
        'height'               => $logo_height,
        'width'                => $logo_width,
        'flex-width'           => true,
        'flex-height'          => true,
        'unlink-homepage-logo' => true,
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Add custom editor font sizes.
    add_theme_support(
      'editor-font-sizes',
      array(
        array(
          'name'      => esc_html__('Extra small', 'wauble'),
          'shortName' => esc_html_x('XS', 'Font size', 'wauble'),
          'size'      => 16,
          'slug'      => 'extra-small',
        ),
        array(
          'name'      => esc_html__('Small', 'wauble'),
          'shortName' => esc_html_x('S', 'Font size', 'wauble'),
          'size'      => 18,
          'slug'      => 'small',
        ),
        array(
          'name'      => esc_html__('Normal', 'wauble'),
          'shortName' => esc_html_x('M', 'Font size', 'wauble'),
          'size'      => 20,
          'slug'      => 'normal',
        ),
        array(
          'name'      => esc_html__('Large', 'wauble'),
          'shortName' => esc_html_x('L', 'Font size', 'wauble'),
          'size'      => 24,
          'slug'      => 'large',
        ),
        array(
          'name'      => esc_html__('Extra large', 'wauble'),
          'shortName' => esc_html_x('XL', 'Font size', 'wauble'),
          'size'      => 40,
          'slug'      => 'extra-large',
        ),
        array(
          'name'      => esc_html__('Huge', 'wauble'),
          'shortName' => esc_html_x('XXL', 'Font size', 'wauble'),
          'size'      => 96,
          'slug'      => 'huge',
        ),
        array(
          'name'      => esc_html__('Gigantic', 'wauble'),
          'shortName' => esc_html_x('XXXL', 'Font size', 'wauble'),
          'size'      => 144,
          'slug'      => 'gigantic',
        ),
      )
    );

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Add support for custom line height controls.
    add_theme_support('custom-line-height');

    // Add support for experimental link color control.
    add_theme_support('experimental-link-color');

    // Add support for experimental cover block spacing.
    add_theme_support('custom-spacing');

    // Add support for custom units.
    // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
    add_theme_support('custom-units');

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

    // Change dashboard Posts to Blog
    function wauble_change_post_object() {
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
    add_action('init', 'wauble_change_post_object');

    //Remove Comments and Links from WP Admin Main Nav
    function wauble_remove_menus() {
      global $menu;
      $restricted = array(__('Links'), __('Comments'));
      end($menu);
      while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array($value[0] != null ? $value[0] : '', $restricted)) {
          unset($menu[key($menu)]);
        }
      }
    }
    add_action('admin_menu', 'wauble_remove_menus');
  }
}
add_action('after_setup_theme', 'wauble_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function wauble_widgets_init() {
  register_sidebar(
    array(
      'name'          => esc_html__('Footer', 'wauble'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here to appear in your footer.', 'wauble'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'wauble_widgets_init');

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function wauble_scripts() {
  // Enqueue Wauble styles
  wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/main.css');
  wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/all.min.css');
  wp_enqueue_style('theme-styles', get_template_directory_uri() . '/style.css');

  // Enqueue Wauble scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('header_js', get_template_directory_uri() . '/assets/js/header-bundle.js', null, 1.0, false);
  wp_enqueue_script('footer_js', get_template_directory_uri() . '/assets/js/footer-bundle.js', null, 1.0, true);

  // Threaded comment reply styles.
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'wauble_scripts');

/**
 * Enqueue admin scripts and styles.
 *
 * @return void
 */
function wauble_admin_scripts() {
  wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/admin/admin.css');
  wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/assets/admin/jquery-ui.min.js');
  wp_enqueue_script('admin-scripts', get_template_directory_uri() . '/assets/admin/admin.js');
}
add_action('admin_enqueue_scripts', 'wauble_admin_scripts');

require_once WAUBLE_THEME_DIR . '/inc/helpers.php';

require_once WAUBLE_THEME_DIR . '/inc/libs/CMB2/init.php';

require_once WAUBLE_THEME_DIR . '/inc/dynamic-modules-admin.php';

function cmb2_metaboxes() {
  require_once WAUBLE_THEME_DIR . '/inc/meta/meta-standard.php';
  require_once WAUBLE_THEME_DIR . '/inc/meta/meta-modules.php';
  require_once WAUBLE_THEME_DIR . '/inc/theme-options.php';
}
add_action('cmb2_admin_init', 'cmb2_metaboxes');

 // Create modules table in database for dynamic modules
 function wauble_dynamic_modules_db_table() {
   $sql =
      'CREATE TABLE IF NOT EXISTS modules (
        id int(32) NOT NULL auto_increment ,
        module varchar(100) NOT NULL,
        name varchar(255) NOT NULL,
        page int(32) NOT NULL,
        display_order int(32) NOT NULL,
        PRIMARY KEY  (id)
      )';
   require_once ABSPATH . 'wp-admin/inc/upgrade.php';
   dbDelta($sql);
 }
add_action('after_switch_theme', 'wauble_dynamic_modules_db_table');

function wauble_display_template_toast() {
  if (is_super_admin()) {
    global $template;

    $markup = '<div class="wp-template-toast">
						%s
						</div>
						<style>
							.wp-template-toast {
								position: fixed;
								height: 20px;
								width: 150px;
								background: rgba(255,0,0,.5);
								color: white;
								bottom: 0px;
								display: flex;
								justify-content: center;
								font-size: 12px;
								right: 0px;
								border-radius: 5px;
								animation: fadeout 1s 2s forwards;
							}
							@keyframes fadeout {
								from {
									opacity: 1;
								}

								to {
									opacity: 0;
								}
							}
						</style>';

    echo sprintf($markup, basename($template));
  }
}
add_action('wp_footer', 'wauble_display_template_toast');
