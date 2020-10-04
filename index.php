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
define('RECIPE_PLUGIN_URL', __FILE__ );


// Includes
include( 'includes/activate.php' );
include( 'includes/init.php' );
include( 'process/save-post.php' );
include( 'process/filter-content.php' );
include( 'includes/front/enqueue.php' );
include( 'process/rate-recipe.php');
include( 'includes/admin/init.php' );
include( 'blocks/enqueue.php' );
include( dirname(RECIPE_PLUGIN_URL) . '/includes/widgets.php');
include( 'includes/widgets/daily-recipe.php' );
include( 'includes/cron.php' );
include( 'includes/deactivate.php' );
include( 'includes/utility.php' );
include( 'includes/shortcodes/creator.php' );


// Hooks
register_activation_hook( __FILE__, 'prrecipe_activate_plugin' );
register_deactivation_hook( __FILE__, 'prrecipe_deactivate_plugin' );
add_action( 'init', 'prrecipe_recipe_init' );
add_action( 'save_post_recipe', 'prrecipe_save_post_admin', 10, 3 );
add_filter( 'the_content', 'prrecipe_filter_recipe_content' );
add_action( 'wp_enqueue_scripts', 'prrecipe_enqueue_scripts', 100);
add_action( 'wp_ajax_prrecipe_rate_recipe', 'prrecipe_rate_recipe' );
add_action( 'wp_ajax_nopriv_prrecipe_rate_recipe', 'prrecipe_rate_recipe' );
add_action( 'admin_init', 'prrecipe_admin_init' );
add_action( 'enqueue_block_editor_assets', 'prrecipe_enqueue_block_editor_assets' );
add_action( 'widgets_init', 'prrecipe_widgets_init' );
add_action( 'prrecipe_daily_recipe_hook', 'prrecipe_daily_generate_recipe' );


// Shortcodes
add_shortcode( 'recipe_creator', 'prrecipe_recipe_creator_shortcode' );