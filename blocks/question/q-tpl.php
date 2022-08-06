<div class="mcq_q-qq-wrapper" data-mcq_q_id="<?php echo $idd ?>">

	<?php

	/**
	 * @var $prepared
	 */

	foreach ( $prepared as $ky => $item ) {
		$options = $item['o'];

		Mcq_Quiz\Helper::shuffleOptions( $options );
		?>
        <div class="q-block q-block-q">
            <label>
				<?php echo ( $ky + 1 ) . '. ';
				echo $item['q'] ?>
            </label>

			<?php if ( ! empty( $item['d'] ) ) {
				echo '<p>' . $item['d'] . '</p>';
			} ?>

            <div>

				<?php

				foreach ( $options as $kv => $vl ) {
					?>
                    <label>
                        <input
                                type="radio"
                                name="q_paper<?php echo $ky ?>"
                                value="<?php echo $kv ?>"/>

						<?php echo $vl ?>
                    </label>
					<?php
				}
				?>
            </div>

        </div>
		<?php
	}
	?>
    <div class="q-block" data-mcq_q_id="<?php echo $idd ?>">
        <button class="mcq_q-btn mcq_q_frm_sbmt">Submit Question</button>
    </div>

    <div id="q-block-res" class="q-block"></div>
</div>
<?php



