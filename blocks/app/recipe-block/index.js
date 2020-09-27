
// console.log( wp );

const { registerBlockType }     =   wp.blocks;
const { __ }                    =   wp.i18n;

registerBlockType( 'prrecipe/recipe', {
    title:              __( 'Recipe', 'prrecipe' ),
    description:        __( 'Provides a short summary of the recipe', 'prrecipe' ),
    category:           'common',
    icon:               'welcome-learn-more',
} );