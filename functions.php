<?php
define( 'CRB_THEME_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
define( 'THEME_ASSETS', get_stylesheet_directory_uri() . '/assets' );

# Enqueue JS and CSS assets on the front-end
add_action( 'wp_enqueue_scripts', 'crb_enqueue_assets' );

function wauble_resources() {
  wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/style.css' );
  wp_enqueue_script( 'header_js', get_template_directory_uri() . '/assets/header-bundle.js', null, 1.0, false );
  wp_enqueue_script( 'footer_js', get_template_directory_uri() . '/assets/footer-bundle.js', null, 1.0, true );
}

add_action( 'wp_enqueue_scripts', 'wauble_resources' );

function crb_enqueue_assets() {
	$template_dir = get_template_directory_uri();

	# The theme style.css file may contain overrides for the bundled styles
	# Pre-compiled styles override file lives in /_dev/sass/overrides.scss
  crb_enqueue_style( 'theme-styles', $template_dir . '/style.css' );
}

// Customize excerpt word count length
function custom_excerpt_length() {
return 22;
}

add_filter( 'excerpt_length', 'custom_excerpt_length' );

function wauble_setup() {
  // Handle Titles
  add_theme_support( 'title-tag' );

  // Add featured image support
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'small-thumbnail', 720, 720, true );
  add_image_size( 'square-thumbnail', 80, 80, true );
  add_image_size( 'banner-image', 1024, 1024, true );
}

add_action( 'after_setup_theme', 'wauble_setup' );

// # Enqueue JS and CSS assets on admin pages
add_action( 'admin_enqueue_scripts', 'crb_admin_enqueue_scripts' );
add_action( 'login_enqueue_scripts', 'crb_admin_enqueue_scripts' );
function crb_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue Scripts
	crb_enqueue_script( 'theme-admin-functions', $template_dir . '/assets/admin.min.js', array( 'jquery' ) );

	# Enqueue Styles
	crb_enqueue_style( 'theme-admin-styles', $template_dir . '/assets/admin.min.css' );
}

# Enqueue the Dashicons script
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
	wp_enqueue_style( 'dashicons' );
}

# Attach Custom Post Types and Custom Taxonomies
add_action( 'init', 'crb_attach_post_types_and_taxonomies', 0 );

function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once( CRB_THEME_DIR . 'options/post-types.php' );

	# Attach Custom Taxonomies
	include_once( CRB_THEME_DIR . 'options/taxonomies.php' );
}

add_action( 'after_setup_theme', 'crb_setup_theme' );

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if ( ! function_exists( 'crb_setup_theme' ) ) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Autoload dependencies
		$autoload_dir = CRB_THEME_DIR . 'vendor/autoload.php';
		if ( ! is_readable( $autoload_dir ) ) {
			wp_die( __( 'Please, run <code>composer install</code> to download and install the theme dependencies.', 'crb' ) );
		}
		include_once( $autoload_dir );
		\Carbon_Fields\Carbon_Fields::boot();

		# Additional libraries and includes
		include_once( CRB_THEME_DIR . 'includes/admin-hooks.php' );
		include_once( CRB_THEME_DIR . 'includes/utils.php' );
		include_once( CRB_THEME_DIR . 'includes/query-args.php' );
		include_once( CRB_THEME_DIR . 'includes/custom-modules.php' );
		
		# Theme supports
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

		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		# Register Theme Menu Locations
		register_nav_menus( array(
			'header-menu'         => __( 'Header Menu', 'crb' ),
			'footer-menu'         => __( 'Footer Menu', 'crb' ),
			'mobile-menu'         => __( 'Mobile Menu', 'crb' ),
		) );

		# Attach custom shortcodes
		include_once( CRB_THEME_DIR . 'options/shortcodes.php' );

		# Add Actions
		add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

		# Add Filters
		add_filter( 'excerpt_more', 'crb_excerpt_more' );
		add_filter( 'excerpt_length', 'crb_excerpt_length', 999 );
		add_filter( 'crb_theme_favicon_uri', function() {
			return get_template_directory_uri() . '/assets/images/favicon.png';
		} );
    add_filter( 'carbon_fields_map_field_api_key', 'crb_get_google_maps_api_key' );
    
	}
}

function crb_attach_theme_options() {
	# Attach fields
	include_once( CRB_THEME_DIR . 'options/theme-options.php' );
	include_once( CRB_THEME_DIR . 'options/post-meta.php' );
	include_once( CRB_THEME_DIR . 'options/term-meta.php' );
	include_once( CRB_THEME_DIR . 'options/user-meta.php' );
}

function crb_excerpt_more() {
	return '...';
}

function crb_excerpt_length() {
	return 22;
}

add_filter( 'mce_buttons', 'add_page_break', 1, 2 );

function add_page_break( $buttons, $id ){
   /* only add this for content editor */
   if ( 'content' == $id ) {
     /* add next page after more tag button */
     array_splice( $buttons, 13, 0, 'wp_page' );
   }
   return $buttons;
}


function get_part($part_slug = 'none', $arr = Array()) {
	return crb_render_fragment($part_slug, $arr);
}

function display_template_toast() {
	if ( is_super_admin() ) {
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
 
add_action( 'wp_footer', 'display_template_toast' );

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

// add_action( 'admin_init', 'hide_editor' );
 
function hide_editor() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
 
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
     
    if($template_file == 'page-about.php' || $template_file == 'page-home.php'){ // Hide Editor For Template
        remove_post_type_support('page', 'editor');
    }
}

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

// Add support for Block Styles.
add_theme_support( 'wp-block-styles' );

// Add support for full and wide align images.
add_theme_support( 'align-wide' );

// Add support for editor styles.
add_theme_support( 'editor-styles' );

// Enqueue editor styles.
add_editor_style( 'style-editor.css' );

// DISABLES GUTENBERG
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
// Change dashboard Posts to News
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Blog';
        $labels->singular_name = 'Blog';
        $labels->add_new = 'Add Article';
        $labels->add_new_item = 'Add New Article';
        $labels->edit_item = 'Edit Article';
        $labels->new_item = 'News';
        $labels->view_item = 'View Article';
        $labels->search_items = 'Search Blog';
        $labels->not_found = 'No Articles found';
        $labels->not_found_in_trash = 'No Articles found in Trash';
        $labels->all_items = 'All Articles';
        $labels->menu_name = 'Blog';
        $labels->name_admin_bar = 'Blog';
        $get_post_type->menu_icon = 'dashicons-welcome-write-blog';
}

