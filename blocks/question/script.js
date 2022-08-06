const { registerBlockType } = wp.blocks;

registerBlockType(
    'mcq-manager/q-block',
    {
        title: 'MCQ Manager',
        description: 'This blocks generates mcq questions',
        icon: 'dashicons-welcome-write-blog',
        category: 'layout',
        attributes: {},
        save: function () {
            return null;
        },
        edit: function () {
            return wp.element.createElement( 'p', '', 'MCQ block successfully generated. It will only shows in frontend.' );
        }
    }
)
