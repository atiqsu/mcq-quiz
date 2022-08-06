<?php

namespace Mcq_Quiz\Core;

use Mcq_Quiz\Handlers\Admin_Page;

class Questionnaire_Cpt {

	const TYPE = 'mcq_q-questionnaire';

	public function handle() {
		add_action( 'init', [ $this, 'register_custom_post_types' ] );
	}

	public function register_custom_post_types() {

		$labels = [
			'name'                  => esc_html_x( 'Questions ', 'Cpt General Name', 'mcq-quiz' ),
			'singular_name'         => esc_html_x( 'Question ', 'Cpt Singular Name', 'mcq-quiz' ),
			'menu_name'             => esc_html__( 'Question ', 'mcq-quiz' ),
			'name_admin_bar'        => esc_html__( 'Question ', 'mcq-quiz' ),
			'archives'              => esc_html__( 'Question  Archives', 'mcq-quiz' ),
			'attributes'            => esc_html__( 'Question  Attributes', 'mcq-quiz' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'mcq-quiz' ),
			'all_items'             => esc_html__( 'All Question ', 'mcq-quiz' ),
			'add_new_item'          => esc_html__( 'Add New Question ', 'mcq-quiz' ),
			'add_new'               => esc_html__( 'Add New', 'mcq-quiz' ),
			'new_item'              => esc_html__( 'New Item', 'mcq-quiz' ),
			'edit_item'             => esc_html__( 'Edit Question ', 'mcq-quiz' ),
			'update_item'           => esc_html__( 'Update Item', 'mcq-quiz' ),
			'view_item'             => esc_html__( 'View Item', 'mcq-quiz' ),
			'view_items'            => esc_html__( 'View Items', 'mcq-quiz' ),
			'search_items'          => esc_html__( 'Search Item', 'mcq-quiz' ),
			'not_found'             => esc_html__( 'Not found', 'mcq-quiz' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'mcq-quiz' ),
			'featured_image'        => esc_html__( 'Featured Image', 'mcq-quiz' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'mcq-quiz' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'mcq-quiz' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'mcq-quiz' ),
			'insert_into_item'      => esc_html__( 'Insert into item', 'mcq-quiz' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'mcq-quiz' ),
			'items_list'            => esc_html__( 'Items list', 'mcq-quiz' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'mcq-quiz' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'mcq-quiz' ),
		];

		$args = [
			'label'               => esc_html__( 'Question ', 'mcq-quiz' ),
			'description'         => esc_html__( 'Post Type Description', 'mcq-quiz' ),
			'labels'              => $labels,
			'supports'            => [ 'title', 'excerpt' ],
			'taxonomies'          => [ 'category', 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => Admin_Page::$main_menu_slug,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		];

		register_post_type( self::TYPE, $args );
		flush_rewrite_rules();
	}
}

