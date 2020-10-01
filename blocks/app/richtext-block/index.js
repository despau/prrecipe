// 1. Import necessary components.
// 2. Define the attributes
// 3. Load the component in the edit()
// 4. Render the block

import block_icons from '../icons/index';

const { registerBlockType }         =   wp.blocks;
const { RichText }                  =   wp.blockEditor;
const { __ }                        =   wp.i18n;

registerBlockType( 'prrecipe/rich-text', {
    title:                              __( 'Rich Text Example', 'prrecipe' ),
    description:                        __( 'Rich text example', 'prrecipe' ),
    category:                           'common',
    icon:                               block_icons.wapuu,
    attributes: {
        message: {
            type:                       'array',
            source:                     'children',
            selector:                   '.message-ctr'
        }
    },
    edit: ( props ) => {
        return (
            <div className={ props.className }>

                <h3>Rich Text Example Block</h3>

                <RichText
                    tagName="div"
                    multiline="p"
                    placeholder={ __( 'Add your content here.', 'prrecipe' ) }
                    onChange={ ( new_val ) => {
                    props.setAttributes({ message: new_val });
                    }}
                    value={ props.attributes.message }
                />

            </div>
        );
    },
    save: ( props ) => {
        return (
            <div>
                <h3>Rich Text Example Block</h3>
                <div className="message-ctr">
                    { props.attributes.message }
                </div>
            </div>
        );
    }
});