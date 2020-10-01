import classnames from 'classnames';
import block_icons from '../icons/index';

const { registerBlockType }         =   wp.blocks;
const { InspectorControls }         =   wp.editor;
const { __ }                        =   wp.i18n;
const { PanelBody, TextareaControl,
        CheckboxControl,
        RadioControl, RangeControl }=   wp.components;

registerBlockType( 'prrecipe/inspector-controls-example', {
    title:                              __( 'Inspector Controls', 'prrecipe' ),
    description:                        __( 'Inspector Controls.', 'prrecipe'),
    category:                           'common',
    icon:                               block_icons.wapuu,
    attributes: {
        textarea_input: {
            type:                       'text',
        },
        checkbox_input: {
            type:                       'boolean',
            default:                    true,
        },
        radio_input: {
            type:                       'string',
            default:                    'foo',
        },
        range_input: {
            type:                       'number',
            default:                    '5',
        }
    },

    edit: ( props ) => {
        return [
            <InspectorControls>
                <PanelBody title={ __( 'Input Examples', 'prrecipe' ) }>
                    <TextareaControl
                        label={ __( 'Text Area Control', 'prrecipe' ) }
                        help={ __( 'Help Text', 'prrecipe' ) }
                        value={ props.attributes.textarea_input }
                        onChange={( new_val ) => {
                            props.setAttributes( { textarea_input: new_val } )
                        }} />

                    <CheckboxControl
                        heading={ __( 'Checkbox Control', 'prrecipe' ) }
                        label={ __( 'Click me!', 'prrecipe' ) }
                        help={ __( 'Help Text', 'prrecipe' ) }
                        checked={ props.attributes.checkbox_input }
                        onChange={( new_val ) => {
                            props.setAttributes( { checkbox_input: new_val } )
                        }}
                    />

                    <RadioControl
                        label={ __( 'Radio Control', 'prrecipe' ) }
                        selected={ props.attributes.radio_input }
                        options={[
                            { label: 'Foo', value: 'foo' },
                            { label: 'Bar', value: 'bar' },
                        ]}
                        onChange={( new_val ) => {
                            props.setAttributes( { radio_input: new_val } )
                        }} />

                    <RangeControl
                        beforeIcon="arrow-left-alt2"
                        afterIcon="arrow-right-alt2"
                        label={ __( 'Range Control', 'prrecipe' ) }
                        min={ 1 }
                        max={ 10 }
                        value={ props.attributes.range_input }
                        onChange={( new_val ) => {
                            props.setAttributes( { range_input: new_val } )
                        }} />
                </PanelBody>
            </InspectorControls>,

            <div className={ props.className }>
                <TextareaControl
                        label={ __( 'Text Area Control', 'prrecipe' ) }
                        help={ __( 'Help Text', 'prrecipe' ) }
                        value={ props.attributes.textarea_input }
                        onChange={( new_val ) => {
                            props.setAttributes( { textarea_input: new_val } )
                        }} />

                    <CheckboxControl
                        heading={ __( 'Checkbox Control', 'prrecipe' ) }
                        label={ __( 'Click me!', 'prrecipe' ) }
                        help={ __( 'Help Text', 'prrecipe' ) }
                        checked={ props.attributes.checkbox_input }
                        onChange={( new_val ) => {
                            props.setAttributes( { checkbox_input: new_val } )
                        }}
                    />

                    <RadioControl
                        label={ __( 'Radio Control', 'prrecipe' ) }
                        selected={ props.attributes.radio_input }
                        options={[
                            { label: 'Foo', value: 'foo' },
                            { label: 'Bar', value: 'bar' },
                        ]}
                        onChange={( new_val ) => {
                            props.setAttributes( { radio_input: new_val } )
                        }} />

                    <RangeControl
                        beforeIcon="arrow-left-alt2"
                        afterIcon="arrow-right-alt2"
                        label={ __( 'Range Control', 'prrecipe' ) }
                        min={ 1 }
                        max={ 10 }
                        value={ props.attributes.range_input }
                        onChange={( new_val ) => {
                            props.setAttributes( { range_input: new_val } )
                        }} />
            </div>
        ];
    },

    save: ( props ) => {
        return (
            <div>
                <ul>
                    <li><strong>Textarea Input</strong> - { props.attributes.textarea_input }</li>
                    <li><strong>Checkbox Input</strong> - { props.attributes.checkbox_input.toString() }</li>
                    <li><strong>Radio Input</strong> - { props.attributes.radio_input }</li>
                    <li><strong>Range Input</strong> - { props.attributes.range_input }</li>
                </ul>
            </div>
        )
    },

});
