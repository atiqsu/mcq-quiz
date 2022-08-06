jQuery(document).ready(function ($) {
    'use strict';

    $(document).on('click', 'button.mcq_q_frm_sbmt', function (ev) {
        ev.preventDefault();

        let blk = $('.q-block-q');
        let rightVal = 0;
        let incorrectVal = 0;
        let count = blk.length;

        blk.each(function (idx) {

            let $val = $(this).find("input[type='radio']:checked").val();

            if ($val === 'cor') {
                rightVal++;
            } else {
                incorrectVal++;
            }
        });

        console.log('total block ', rightVal, incorrectVal);

        let pct = parseFloat(rightVal * 100) / count;

        $('#q-block-res').html(
            `<div>Total: ${count}</div>
            <div>Correct : ${rightVal}</div>
            <div>Incorrect: ${incorrectVal}</div>
            <div>Percentage: ${pct}%</div>
            `
        );
    });
});

