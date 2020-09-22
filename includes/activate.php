<?php

function prerecipe_activate_plugin(){
    if( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ){
        wp_die( __( "You ust update WordPress to use this plugin.", "prrecipe") );
    }
}