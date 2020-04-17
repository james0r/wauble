<?php
define( 'CRB_THEME_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
define( 'THEME_ASSETS', get_stylesheet_directory_uri() . '/assets' );

# Enqueue JS and CSS assets on the front-end
add_action( 'wp_enqueue_scripts', 'crb_enqueue_assets' );
function crb_enqueue_assets() {
	$template_dir = get_template_directory_uri();

	# Enqueue Vendor JS files
	wp_enqueue_script(
		'vendor-scripts',
		$template_dir . crb_assets_bundle( '_wauble.vendor.bundle.min.js' ),
		array( 'jquery' ), // deps
		null, // version -- this is handled by the bundle manifest
		true // in footer
	);

	wp_enqueue_script(
		'authored-scripts',
		$template_dir . crb_assets_bundle( '_wauble.authored.bundle.js' ),
		array( 'jquery' ), // deps
		null, // version -- this is handled by the bundle manifest
		true // in footer
	);

	wp_enqueue_style(
		'vendor-styles',
		$template_dir . crb_assets_bundle( '_wauble.vendor.bundle.css' )
	);

	wp_enqueue_style(
		'authored-styles',
		$template_dir . crb_assets_bundle( '_wauble.authored.bundle.css' )
	);

	# The theme style.css file may contain overrides for the bundled styles
	# Pre-compiled styles override file lives in /_dev/sass/overrides.scss
	crb_enqueue_style( 'theme-styles', $template_dir . '/style.css' );

	# Enqueue Comments JS file
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

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

		# Add Image Sizes
		add_image_size( 'home-slider', 1440, 0 );
		add_image_size( 'intro', 1440, 0 );
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
	return 55;
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

/**
 * Get the path to a versioned bundle relative to the theme directory.
 *
 * @param  string $path
 * @return string
 */
function crb_assets_bundle( $path ) {
	static $manifest = null;

	if ( is_null( $manifest ) ) {
		$manifest_path = CRB_THEME_DIR . 'assets/manifest.json';

		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
		} else {
			$manifest = array();
		}
	}

	$path = isset( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return '/assets/' . $path;
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

function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

function shapeSpace_enable_gutenberg_post_type($can_edit, $post) {
	
	if (empty($post->ID)) return $can_edit;
	
	if ('books' === $post_type) return true;
	
	return $can_edit;
	
}

// Enable Gutenberg for WordPress >= 5.0
add_filter('use_block_editor_for_post_type', 'shapeSpace_enable_gutenberg_post_type', 10, 2);

// WP >= 5.0
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
        $labels->add_new_item = 'Add Article';
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

function remove_menu_items(){
  remove_menu_page('readme.php' );
}

add_action( 'admin_menu', 'remove_menu_items', 999 );


// function wpse121723_register_sidebars() {
//   register_sidebar( array(
//       'name' => 'Home right sidebar',
//       'id' => 'home_right_1',
//       'before_widget' => '<div>',
//       'after_widget' => '</div>',
//       'before_title' => '<h2 class="rounded">',
//       'after_title' => '</h2>',
//   ) );
// }
// add_action( 'widgets_init', 'wpse121723_register_sidebars' );

// function unregister_default_widgets() {
//   unregister_widget('WP_Widget_Pages');
//   unregister_widget('WP_Widget_Calendar');
//   unregister_widget('WP_Widget_Archives');
//   unregister_widget('WP_Widget_Links');
//   unregister_widget('WP_Widget_Meta');
//   unregister_widget('WP_Widget_Search');
//   unregister_widget('WP_Widget_Text');
//   unregister_widget('WP_Widget_Categories');
//   unregister_widget('WP_Widget_Recent_Posts');
//   unregister_widget('WP_Widget_Recent_Comments');
//   unregister_widget('WP_Widget_RSS');
//   unregister_widget('WP_Widget_Media');
//   unregister_widget('WP_Widget_Tag_Cloud');
//   unregister_widget('WP_Nav_Menu_Widget');
//   unregister_widget('Twenty_Eleven_Ephemera_Widget');
//   wp_unregister_sidebar_widget('wpe_widget_powered_by');
// }
// add_action('widgets_init', 'unregister_default_widgets', 18);