<?php

namespace Mcq_Quiz;

use Mcq_Quiz\Blocks\Question\Q_Block;
use Mcq_Quiz\Core\Choice_Meta;
use Mcq_Quiz\Core\Questionnaire_Cpt;
use Mcq_Quiz\Handlers\Admin_Page;
use Mcq_Quiz\Handlers\Enqueue_Service;
use Mcq_Quiz\Handlers\Register_Scripts;
use Mcq_Quiz\System\Application;

final class Plugin {

	private Application $application;

	public function __construct( Application $application ) {
		$this->application = $application;
		do_action( 'mcq_quiz/before_loaded' );

		add_action( 'init', [ $this, 'on_init_hook' ] );
		add_action( 'plugins_loaded', [ $this, 'run' ] );

		do_action( 'mcq_quiz/after_loaded' );
	}

	public static function version() {
		return '1.0.0.' . time();
	}

	public static function plugin_dir() {
		return trailingslashit( plugin_dir_path( __FILE__ ) );
	}

	public static function plugin_url() {
		return trailingslashit( plugin_dir_url( __FILE__ ) );
	}

	public static function assets_dir() {
		return trailingslashit( self::plugin_dir() . 'assets/' );
	}

	public static function assets_url() {
		return trailingslashit( self::plugin_url() . 'assets/' );
	}

	public static function load_asset( $path ) {
		return self::assets_url() . ltrim( $path, '/' );
	}

	public static function load_view( $path ) {
		return self::plugin_dir() . '/views/' . ltrim( $path, '/' );
	}

	public function run() {

		$this->application->resolve( Q_Block::class )->init();
		$this->application->resolve( Enqueue_Service::class )->handle();
		$this->application->resolve( Admin_Page::class )->handle();
		$this->application->resolve( Questionnaire_Cpt::class )->handle();
		$this->application->resolve( Choice_Meta::class, new Choice_Meta() );
	}

	public function on_init_hook() {
		load_plugin_textdomain( 'mcq-quiz', false, self::plugin_dir() . 'languages/' );
		$this->application->resolve( Register_Scripts::class )->handle();
	}
}

