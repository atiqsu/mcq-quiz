<?php

namespace Mcq_Quiz;

defined( 'ABSPATH' ) || exit;


/**
 * For autoloading classes with custom filename convention
 */
class Autoloader {

	/**
	 * Run autoloader.
	 * Register a function as `__autoload()` implementation.
	 */
	public static function run() {
		spl_autoload_register( [ __CLASS__, 'autoload' ] );
	}

	/**
	 * autoload is responsible for loaing files :P
	 *
	 * @param $class_name
	 *
	 * @author - Md. Atiqur Rahman
	 * @email - atiqur.su@gmail.com
	 *
	 * @return void
	 */
	private static function autoload( $class_name ) {

		if ( 0 !== strpos( $class_name, __NAMESPACE__ ) ) {
			return;
		}

		$file_name = strtolower(
			preg_replace(
				[ '/\b' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
				$class_name
			)
		);

		$file = plugin_dir_path( __FILE__ ) . $file_name . '.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
}

/**
 * Calling the autoloader to load the files with matched pattern
 */
Autoloader::run();

