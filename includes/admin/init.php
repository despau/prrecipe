<?php


function prrecipe_admin_init(){
    //add new columns
    include('columns.php');

    add_filter('manage_recipe_posts_columns', 'prrecipe_add_new_recipe_columns');

    //manage new columns
    add_filter('manage_recipe_posts_custom_columns', 'prrecipe_manage_recipe_columns', 10, 2);

}