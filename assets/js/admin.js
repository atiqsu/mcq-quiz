jQuery(document).ready(function ($) {
    'use strict';

    $(document).on('click', 'button.mcq_q-btn-rptr', function (ev) {
        ev.preventDefault();

        let $that = $(this);

        let grp = $that.parent().find('.mcq_q-frm-rptr');

        if (grp.length) {

            let elm = grp.first().clone(true);
            elm.find('input').val('');
            $that.before(elm);
        }
    });

    $(document).on('click', 'span.mcq_q_rptr_del', function (ev) {
        ev.preventDefault();

        let grp = $('.mcq_q-frm-rptr');
        if (grp.length > 1) {
            $(this).closest('div').remove();
        }
    });
});
