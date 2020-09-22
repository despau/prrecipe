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


// Hooks
register_activation_hook( __FILE__, 'prerecipe_activate_plugin' );


// Shortcodes