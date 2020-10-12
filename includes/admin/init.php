<?php


function prrecipe_admin_init(){
    //add new columns
    include('columns.php');
    include( 'enqueue.php' );
    include( 'settings-api.php' );


    add_filter('manage_recipe_posts_columns', 'prrecipe_add_new_recipe_columns');

    //manage new columns
    add_action('manage_recipe_posts_custom_columns', 'prrecipe_manage_recipe_columns', 10, 2);

    //enqueueing admin scripts
    add_action( 'admin_enqueue_scripts', 'prrecipe_admin_enqueue' );


    add_action( 'admin_post_prrecipe_save_options', 'prrecipe_save_options' );

    //this hook is to call the settings api. it is commented out because we use our custom form to update the recipe options page
    // prrecipe_settings_api();

}