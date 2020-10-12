<?php


function prrecipe_admin_enqueue(){

    //return if not in the recipe options page
    if( !isset($_GET['page']) || $_GET['page'] != "prrecipe_plugin_opts" ){
        return;
      }

      wp_register_style( 'prrecipe_bootstrap', plugins_url( '/assets/css/bootstrap.css', RECIPE_PLUGIN_URL ) );

      wp_enqueue_style( 'prrecipe_bootstrap' );

}