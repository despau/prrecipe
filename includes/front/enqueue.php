<?php


function prrecipe_enqueue_scripts(){

    wp_register_style( 'prrecipe_rateit', plugins_url( '/assets/rateit/rateit.css', RECIPE_PLUGIN_URL ) );
    wp_enqueue_style( 'prrecipe_rateit' );

    wp_register_script(
        'prrecipe_rateit',
        plugins_url( '/assets/rateit/jquery.rateit.min.js', RECIPE_PLUGIN_URL ),
        ['jquery'],
        '1.0.0',
        true
    );
    wp_register_script(
        'prrecipe_main', plugins_url( '/assets/js/main.js', RECIPE_PLUGIN_URL ), ['jquery'], '1.0.0', true
    );

    wp_localize_script( 'prrecipe_main', 'recipe_obj', [
        'ajax_url'      =>  admin_url( 'admin-ajax.php' )
    ]);

    wp_enqueue_script( 'prrecipe_rateit' );
    wp_enqueue_script( 'prrecipe_main' );

}