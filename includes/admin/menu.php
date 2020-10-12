<?php


function prrerecipe_admin_menus(){

    // add_menu_page( $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $icon_url:string, $position:integer|null )

    add_menu_page(
        'Recipe Options',
        'Recipe Options',
        'edit_theme_options',
        'prrerecipe_plugin_opts',
        'prrecipe_plugin_opts_page'
    );



}