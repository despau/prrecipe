<?php
/**
 * Plugin Name:       Patronar Recipe
 * Description:       Patronar Recipe plugin can be freely used in any projects. It Allow Users to create and rate Recipes.
 * Version:           0.5.0
 * Author:            Codear
 * Text Domain:       prrecipe
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


 // If this file is called directly, abort.
if ( ! function_exists( 'add_action' )) {
    echo "Hi there! I'm just a plugin. Not much I can do when called directly.";
    exit;
}


// Setup


// Includes
include( 'includes/activate.php' );
include( 'includes/init.php' );
include( 'process/save-post.php' );


// Hooks
register_activation_hook( __FILE__, 'prrecipe_activate_plugin' );
add_action( 'init', 'prrecipe_recipe_init' );
add_action( 'save_post_recipe', 'prrecipe_save_post_admin', 10, 3 );


// Shortcodes