import block_icons from '../icons/index';
import './editor.scss';


const { registerBlockType }     =   wp.blocks;
const { __ }                    =   wp.i18n;

const { InspectorControls,
    BlockControls,
    AlignmentToolbar,
    BlockAlignmentToolbar }      =   wp.editor;

const { PanelBody, PanelRow,
    TextControl, SelectControl }=   wp.components;

registerBlockType( 'prrecipe/recipe', {

    title:                              __( 'Recipe', 'prrecipe' ),

    description:                        __(
        'Provides a short summary of a recipe.',
        'prrecipe'
    ),

    // common, formatting, layout, widgets, embed
    category:                           'common',

    icon:                               block_icons.wapuu,

    keywords: [
        __( 'Food', 'prrecipe' ),
        __( 'Ingredients', 'prrecipe' ),
        __( 'Meal Type', 'prrecipe' )
    ],

    supports: {
        html:                           false
    },

    attributes: {
        ingredients: {
            type:                       'string',
            source:                     'text',
            selector:                   '.ingredients-ph'
        },
        cooking_time: {
            type:                       'string',
            source:                     'text',
            selector:                   '.cooking-time-ph'
        },
        utensils: {
            type:                       'string',
            source:                     'text',
            selector:                   '.utensils-ph'
        },
        cooking_experience: {
            type:                       'string',
            source:                     'text',
            selector:                   '.cooking-experience-ph',
            default:                    'Beginner'
        },
        meal_type: {
            type:                       'string',
            source:                     'text',
            selector:                   '.meal-type-ph',
            default:                    'Breakfast'
        },
        text_alignment: {
            type:                       'string'
        },
        block_alignment: {
            type:                       'string',
            default:                    'wide'
        }
    },

    // This function will automatically triggered whenever there's a change to the block
    getEditWrapperProps: ( { block_alignment } ) => {
        if( 'left' === block_alignment || 'right' === block_alignment || 'full' === block_alignment ){
            return { 'data-align': block_alignment };
        }
    },

    edit: ( props ) => {  // for the backend. wordpress admin

        // console.log( 'this is the props: ', props );

        return [
            <InspectorControls> {/* for the settings on the sidebar */}
                <PanelBody title={ __( 'Basics', 'prrecipe' ) }>
                    <PanelRow>
                        <p>{ __( 'Configure the contents of your block here.' ,'prrecipe' ) }</p>
                    </PanelRow>

                    <TextControl
                        label={ __( 'Ingredients', 'prrecipe' ) }
                        help={ __( 'Ex: tomatoes, lettuce, olive oil, etc.', 'prrecipe' ) }
                        value={ props.attributes.ingredients }
                        onChange={ ( new_val ) => {
                            props.setAttributes({ ingredients: new_val })
                        }} />

                    <TextControl
                        label={ __( 'Cooking Time', 'prrecipe' ) }
                        help={ __( 'How long will this take to cook?', 'prrecipe' ) }
                        value={ props.attributes.cooking_time }
                        onChange={ ( new_val) => {
                            props.setAttributes({ cooking_time: new_val })
                        }} />

                    <TextControl
                        label={ __( 'Utensils', 'prrecipe' ) }
                        help={ __( 'Ex: spoon, knife, fork', 'prrecipe' ) }
                        value={ props.attributes.utensils }
                        onChange={ ( new_val ) => {
                            props.setAttributes({ utensils: new_val })
                        }} />

                    <SelectControl
                        label={ __( 'Cooking Experience', 'prrecipe' ) }
                        help={ __( 'How skilled should the reader be?', 'prrecipe' ) }
                        value={ props.attributes.cooking_experience }
                        options={[
                            { value: 'Beginner', label: 'Beginner' },
                            { value: 'Intermediate', label: 'Intermediate' },
                            { value: 'Expert', label: 'Expert' }
                        ]}
                        onChange={ ( new_val ) => {
                            props.setAttributes({ cooking_experience: new_val })
                        }} />

                    <SelectControl
                        label={ __( 'Meal Type', 'prrecipe' ) }
                        help={ __( 'When is this best eaten?', 'prrecipe' ) }
                        value={ props.attributes.meal_type }
                        options={[
                            { value: 'Breakfast', label: 'Breakfast' },
                            { value: 'Lunch', label: 'Lunch' },
                            { value: 'Dinner', label: 'Dinner' }
                        ]}
                        onChange={ ( new_val ) => {
                            props.setAttributes({ meal_type: new_val })
                        }} />
                </PanelBody>
            </InspectorControls>,

            <div className={ props.className }>
                <BlockControls>
                    <BlockAlignmentToolbar
                        value={ props.attributes.block_alignment }
                        onChange={ (new_val) => {
                            props.setAttributes({ block_alignment: new_val })
                        }}/>
                    <AlignmentToolbar
                        value={ props.attributes.text_alignment }
                        onChange={ ( new_val ) => {
                            props.setAttributes({ text_alignment: new_val });
                        }}/>
                </BlockControls>

                <ul className="list-unstyled"
                    style={{ textAlign: props.attributes.text_alignment }}>
                    {/* for the admin. backend list. */}
                    <li>
                        <strong>{ __( 'Ingredients', 'prrecipe' ) }: </strong>
                        <span className="ingredients-ph">{ props.attributes.ingredients }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Cooking Time', 'prrecipe' ) }: </strong>
                        <span className="cooking-time-ph">{ props.attributes.cooking_time }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Utensils', 'prrecipe' ) }: </strong>
                        <span className="utensils-ph">{ props.attributes.utensils }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Cooking Experience', 'prrecipe' ) }: </strong>
                        <span className="cooking-experience-ph">{ props.attributes.cooking_experience }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Meal Type', 'prrecipe' ) }: </strong>
                        <span className="meal-type-ph">{ props.attributes.meal_type }</span>
                    </li>
                </ul>
            </div>
        ];
    },

    save: ( props ) => { //for the front end.
        return (
            <div className={ `align${props.attributes.block_alignment}` }>
                <ul className="list-unstyled"
                    style={{ textAlign: props.attributes.text_alignment }}>
                    <li>
                        <strong>{ __( 'Ingredients', 'prrecipe' ) }: </strong>
                        <span className="ingredients-ph">{ props.attributes.ingredients }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Cooking Time', 'prrecipe' ) }: </strong>
                        <span className="cooking-time-ph">{ props.attributes.cooking_time }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Utensils', 'prrecipe' ) }: </strong>
                        <span className="utensils-ph">{ props.attributes.utensils }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Cooking Experience', 'prrecipe' ) }: </strong>
                        <span className="cooking-experience-ph">{ props.attributes.cooking_experience }</span>
                    </li>
                    <li>
                        <strong>{ __( 'Meal Type', 'prrecipe' ) }: </strong>
                        <span className="meal-type-ph">{ props.attributes.meal_type }</span>
                    </li>
                </ul>
            </div>
        )
    }

});