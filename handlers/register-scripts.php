<?php

namespace Mcq_Quiz\Handlers;


use Mcq_Quiz\Plugin;

class Register_Scripts {

	public static string $prefix = 'mcq-q-';

	public function handle() {

		wp_register_script( self::$prefix . 'admin-main', Plugin::load_asset( 'js/admin.js' ), [ 'jquery' ], Plugin::version(), true );
		wp_register_script( self::$prefix . 'front-main', Plugin::load_asset( 'js/front.js' ), [ 'jquery' ], Plugin::version(), true );

		wp_register_style( self::$prefix . 'admin-main', Plugin::load_asset( 'css/admin.css' ), [], Plugin::version() );
		wp_register_style( self::$prefix . 'front-main', Plugin::load_asset( 'css/front.css' ), [], Plugin::version() );

		wp_register_script( self::$prefix . 'q-block-script', Plugin::plugin_url() . 'blocks/question/script.js', [
			'wp-blocks',
			'wp-element',
		], Plugin::version(), false );

		wp_localize_script( self::$prefix . 'admin-main', 'mcqQAdminObject', [
			'atiq' => 'AR',
		] );
	}
}


