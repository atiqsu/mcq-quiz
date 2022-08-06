<?php

namespace Mcq_Quiz\Core;

class Choice_Meta extends Metabox {

	public function get_id() {
		return 'mcq_q-choice-mt';
	}

	public function where() {
		return 'core';
	}

	public function title() {
		return esc_html__( 'Multiple Choice option meta' );
	}

	public static function base_key(): string {
		return 'mcq_q_cmb_questionnaire';
	}

	public function get_base_key(): string {
		return self::base_key();
	}

	public function post_type() {
		return Questionnaire_Cpt::TYPE;
	}

	public function save_metabox( $post_id ) {

		if ( $this->is_action_valid( $post_id ) ) {

			$cNm = $this->get_base_key() . '_correct';
			$iNm = $this->get_base_key() . '_incorrect';

			update_post_meta( $post_id, $cNm, $_POST[ $cNm ] );
			update_post_meta( $post_id, $iNm, $_POST[ $iNm ] );
		}
	}

	public function render( $post ) {

		$cNm = $this->get_base_key() . '_correct';
		$iNm = $this->get_base_key() . '_incorrect';

		$correct = get_post_meta( $post->ID, $cNm, true );
		$correct = empty( $correct ) ? '' : $correct;

		$incorrect = get_post_meta( $post->ID, $iNm, true );
		$incorrect = empty( $incorrect ) ? [] : $incorrect;

		wp_nonce_field( $this->get_base_key() . '_na', $this->get_base_key() . '_nf' ); ?>

        <div class="mcq_q-cmb-wrapper">
            <div class="mcq_q-grp">
                <div class="mcq_q-frm-grp">
                    <label><?php echo esc_html__( 'Correct Answer', 'mcq-quiz' ) ?></label>
                    <input
                            placeholder="<?php echo esc_html__( 'Enter a correct answer here', 'mcq-quiz' ) ?>..."
                            name="<?php echo $this->get_base_key() ?>_correct"
                            value="<?php echo $correct ?>"/>
                </div>
            </div>

            <div class="mcq_q-grp">
                <div class="mcq_q-frm-grp">
                    <label><?php echo esc_html__( 'Incorrect Answer', 'mcq-quiz' ) ?></label>
					<?php

					if ( empty( $incorrect ) ) {
						?>
                        <div class="mcq_q-frm-rptr">
                            <input
                                    placeholder="<?php echo esc_html__( 'Enter a incorrect answer here', 'mcq-quiz' ) ?>..."
                                    name="<?php echo $this->get_base_key() ?>_incorrect[]"/>

                            <span class="mcq_q_rptr_del">X</span>
                        </div>
						<?php
					} else {
						foreach ( $incorrect as $item ) {
							?>
                            <div class="mcq_q-frm-rptr">
                                <input
                                        placeholder="<?php echo esc_html__( 'Enter a incorrect answer here', 'mcq-quiz' ) ?>..."
                                        name="<?php echo $this->get_base_key() ?>_incorrect[]"
                                        value="<?php echo $item ?>"/>
                                <span class="mcq_q_rptr_del">X</span>
                            </div>
							<?php
						}
					}
					?>

                    <button class="mcq_q-btn mcq_q-btn-primary mcq_q-btn-rptr"><?php echo esc_html__( 'Add more', 'mcq-quiz' ) ?></button>
                </div>
            </div>
        </div>
		<?php
	}

	public static function getChoiceMetas( $post_id ): array {

		$correct_ans   = get_post_meta( $post_id, self::base_key() . '_correct', true );
		$incorrect_ans = get_post_meta( $post_id, self::base_key() . '_incorrect', true );

		$choices['cor'] = $correct_ans;

		if ( ! empty( $incorrect_ans ) ) {
			foreach ( $incorrect_ans as $key => $item ) {
				$choices[ 'icr' . $key ] = $item;
			}
		}

		return $choices;
	}
}
