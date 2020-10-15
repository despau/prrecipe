<?php

function prrecipe_load_textdomain(){

    $plugin_dir     =   'prrecipe/lang';

    // load_plugin_textdomain( $domain:string, $deprecated:string|false, $plugin_rel_path:string|false )
    load_plugin_textdomain( 'prrecipe', false, $plugin_dir );

}