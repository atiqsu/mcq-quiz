<?php

namespace Mcq_Quiz\Handlers;

class Admin_Page {

	public static string $main_menu_slug = 'mcq_q-parent-root';
	public string $cap = 'manage_options';
	public string $root_icon = 'dashicons-admin-page';

	public function handle() {
		add_action( 'admin_menu', [ $this, 'register' ] );
	}

	public function register() {

		add_menu_page(
			__( 'Mcq Quiz', 'quiz-manager' ),
			__( 'Mcq Quiz', 'quiz-manager' ),
			$this->cap,
			self::$main_menu_slug,
			'',
			$this->root_icon,
			5
		);
	}
}

