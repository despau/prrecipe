<?php


// function prrecipe_enqueue_block_editor_assets(){

//     wp_register_script(
//         'prrecipe_blocks_bundle',
//         plugins_url( './bloks/dist/bundle.js', RECIPE_PLUGIN_URL ),
//         [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-api' ],
//         filemtime( plugin_dir_path( RECIPE_PLUGIN_URL ) . './blocks/dist/bundle.js' )
//     );

//     wp_enqueue_script( 'prrecipe_blocks_bundle' );

// }


function prrecipe_enqueue_block_editor_assets(){

    wp_register_script(
        'prrecipe_blocks_bundle',
        plugins_url( './dist/bundle.js', __FILE__ ),
        array( 'wp-i18n', 'wp-element', 'wp-blocks' ),
    );

    wp_enqueue_script( 'prrecipe_blocks_bundle' );

}