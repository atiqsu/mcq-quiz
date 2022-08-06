<?php

namespace Mcq_Quiz\Handlers;

class Enqueue_Service {

	public function handle() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_script' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_script' ] );
	}

	public function admin_script() {
		wp_enqueue_script( Register_Scripts::$prefix . 'admin-main' );
		wp_enqueue_style( Register_Scripts::$prefix . 'admin-main' );
	}

	public function frontend_script() {
		wp_enqueue_script( Register_Scripts::$prefix . 'front-main' );
		wp_enqueue_style( Register_Scripts::$prefix . 'front-main' );
	}
}

