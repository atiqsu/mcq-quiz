<?php

namespace Mcq_Quiz\Blocks\Question;

use Mcq_Quiz\Core\Choice_Meta;
use Mcq_Quiz\Core\Questionnaire_Cpt;
use Mcq_Quiz\Handlers\Register_Scripts;

class Q_Block {

	public function init() {
		add_action( 'init', [ $this, 'register_block' ] );
	}

	public function get_script_handle(): string {
		return Register_Scripts::$prefix . 'q-block-script';
	}

	public function register_block() {

		wp_enqueue_script( $this->get_script_handle() );

		register_block_type(
			'mcq-manager/q-block',
			[
				'editor_script'   => $this->get_script_handle(),
				'render_callback' => [ $this, 'view_callback' ],
			]
		);
	}

	public function view_callback( $settings ) {

		$questions = get_posts(
			[
				'numberposts' => - 1,
				'post_type'   => Questionnaire_Cpt::TYPE,
			]
		);

		$idd = get_the_ID();
		$prepared = [];

		foreach ( $questions as $question ) {

			$choices = Choice_Meta::getChoiceMetas( $question->ID );

			$prepared[] = [
				'q' => $question->post_title,
				'o' => $choices,
				'd' => $question->post_excerpt,
			];
		}

		ob_start();

		include __DIR__ . '/q-tpl.php';

		return ob_get_clean();
	}
}



