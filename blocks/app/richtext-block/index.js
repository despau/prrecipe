import block_icons from '../icons/index';

const { registerBlockType }         =   wp.blocks;
const { __ }                        =   wp.i18n;

registerBlockType( 'prrecipe/rich-text', {
    title:                              __( 'Rich Text Example', 'prrecipe' ),
    description:                        __( 'Rich text example', 'prrecipe' ),
    category:                           'common',
    icon:                               block_icons.wapuu,
    attributes: {

    },
    edit: ( props ) => {
        return (
            <div className={ props.className }>
                <h3>Rich Text Example Block</h3>
            </div>
        );
    },
    save: ( props ) => {

    }
});