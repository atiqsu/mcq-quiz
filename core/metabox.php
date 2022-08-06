<?php

namespace Mcq_Quiz\Core;

abstract class Metabox {

	abstract public function get_id();

	abstract public function where();

	abstract public function title();

	abstract public function post_type();

	abstract public function get_base_key();

	abstract public function save_metabox( $post_id );

	public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'metabox' ] );
		add_action( 'save_post', [ $this, 'save_metabox' ] );
	}

	public function metabox() {

		$idd    = $this->get_id();
		$title  = $this->title();
		$screen = $this->post_type();

		add_meta_box( $idd, $title, [ $this, 'render' ], $screen, 'advanced', $this->where() );
	}

	public function is_action_valid( $post_id ): bool {

		// Bail out if the user has no permission for edit post
		if ( ! current_user_can( 'edit_posts' ) ) {
			return false;
		}

		// Bail if we're doing an auto save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return false;
		}

		//If is doing auto-save via AJAX: exit function
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return false;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return false;
		}

		$n_fld    = $this->get_base_key() . '_nf';
		$n_action = $this->get_base_key() . '_na';

		if ( ! isset( $_POST[ $n_fld ] ) || ! wp_verify_nonce( $_POST[ $n_fld ], $n_action ) ) {
			return false;
		}

		return true;
	}
}
