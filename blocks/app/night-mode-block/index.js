import classnames from 'classnames';
import block_icons from '../icons/index';
import btn_icon from './icon';
import './editor.scss';

const { registerBlockType }         =   wp.blocks;

const { __ }                        =   wp.i18n;

const { BlockControls,
        InspectorControls }         =   wp.blockEditor;

const { Toolbar, Button, Tooltip,
        PanelBody, PanelRow,
        FormToggle }                =   wp.components;

registerBlockType( 'prrecipe/night-mode', {
    title:                              __( 'Night Mode', 'prrecipe' ),
    description:                        __( 'Content with night mode.', 'prrecipe'),
    category:                           'common',
    icon:                               block_icons.wapuu,
    attributes: {
        night_mode: {
            type:                       'boolean',
            default:                    false
        }
    },
    edit: ( props ) => {

        const toggle_night_mode = () => {
            props.setAttributes({
                night_mode: !props.attributes.night_mode
            })
        }

        return [
            <InspectorControls>
                <PanelBody title={ __( 'Night Mode', 'prrecipe' ) }>
                    <PanelRow>
                        <label htmlFor="prrecipe-recipe-night-mode-toggle">
                            { __( 'Night Mode', 'prrecipe' ) }
                        </label>
                        <FormToggle id='prrecipe-recipe-night-mode-toggle'
                                    checked={ props.attributes.night_mode }
                                    onChange={ toggle_night_mode } />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>,
            <div className={ props.className }>
                <BlockControls>
                    <Toolbar>
                        <Tooltip text={ __( 'Night mode', 'prrecipe' ) }>
                            <Button className={ classnames(
                                    'components-icon-button',
                                    'components-toolbar__control',
                                    { 'is-active': props.attributes.night_mode }
                                )}
                                onClick={ toggle_night_mode }>
                                    { btn_icon }
                            </Button>
                        </Tooltip>
                    </Toolbar>
                </BlockControls>
                <div className={ classnames(
                    'content-example',
                    { 'night': props.attributes.night_mode }
                )}>
                    This is an example of a block with night mode.
                </div>
            </div>
        ];
    },
    save: ( props ) => {
        return (
            <div>
                <div className={ classnames(
                    'content-example',
                    { 'night': props.attributes.night_mode }
                )}>
                    This is an example of a block with night mode.
                </div>
            </div>
        )
    }
});
