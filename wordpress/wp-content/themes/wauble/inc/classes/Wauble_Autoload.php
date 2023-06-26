<?php
/**
 * Autoloader for Wauble classes.
 * All files in /inc/classes/ with a Wauble_ prefix will be autoloaded.
 */

/**
 * The Autoloader class for Wauble.
 */
class Wauble_Autoload {

	private static $class_map;

	public function __construct() {

		// Register our autoloader.
		spl_autoload_register( [ $this, 'include_class_file' ] );
	}


	protected function get_path( $class_name ) {

		// If the class exists in our hardcoded array of classes
		// then get the path and return it.
		// 	self::$class_map = $this->get_class_map();
		// }
		if ( isset( self::$class_map[ $class_name ] ) ) {
			include_once self::$class_map[ $class_name ];
			return;
		}

		$template_dir_path = Wauble::$template_dir_path;

    $paths = [];
    
    // Collect all class files with our themes prefix
		if ( 0 === stripos( $class_name, 'Wauble_' ) ) {

			$filename = $class_name . '.php';

			$paths[] = $template_dir_path . '/inc/classes/' . $filename;

			foreach ( $paths as $path ) {
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					return $path;
				}
			}
		}
		return false;

	}

	/**
	 * Get the path & include the file for the class.
	 */
	public function include_class_file( $class_name ) {
		$path = $this->get_path( $class_name );

		// Include the path.
		if ( $path ) {
			include_once $path;
		}
	}
}