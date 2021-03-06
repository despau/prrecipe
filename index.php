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
include( 'process/submit-user-recipe.php' );
include( 'includes/shortcodes/auth-form.php' );
include( 'process/create-account.php' );
include( 'process/login.php' );
include( 'includes/shortcodes/auth-alt-form.php' );
include( 'includes/front/logout-link.php' );
include( 'includes/admin/dashboard-widgets.php' );
include( 'includes/shortcodes/twitter-follow.php' );
include( 'includes/admin/menu.php' );
include( 'includes/admin/options-page.php' );
include( 'process/save-options.php');
include( 'includes/admin/origin-fields.php' );
include( 'process/save-origin.php');
include( 'includes/notice.php' );
include( 'process/remove-notice.php');
include( 'includes/textdomain.php' );



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
add_action( 'wp_ajax_prrecipe_submit_user_recipe', 'prrecipe_submit_user_recipe' );
add_action( 'wp_ajax_nopriv_prrecipe_submit_user_recipe', 'prrecipe_submit_user_recipe' );
add_action( 'wp_ajax_nopriv_prrecipe_create_account', 'prrecipe_create_account' );
add_action( 'wp_ajax_nopriv_prrecipe_user_login', 'prrecipe_user_login' );
// add_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
// add_filter( 'authenticate', 'wp_authenticate_spam_check', 99 );
// add_filter( 'authenticate', 'prrecipe_alt_authenticate', 100, 3 );
// add_filter( 'wp_nav_menu_items', 'patronarrecipe_new_nav_menu_items', 999 );
add_filter( 'wp_nav_menu_secondary_items', 'patronarrecipe_new_nav_menu_items', 999 );
add_action( 'wp_dashboard_setup', 'prrecipe_dashboard_widgets' );
add_action( 'admin_menu', 'prrerecipe_admin_menus' );
add_action( 'origin_add_form_fields', 'prrecipe_origin_add_form_fields' );
add_action( 'origin_edit_form_fields', 'prrecipe_origin_edit_form_fields' );
add_action( 'create_origin', 'prrecipe_save_origin_meta' );
add_action( 'edit_origin', 'prrecipe_edit_origin_meta' );
add_action( 'admin_notices', 'prrecipe_admin_notices');
add_action( 'wp_ajax_prrecipe_dismiss_pending_recipe_notice', 'prrecipe_dismiss_pending_recipe_notice' );
add_action( 'plugins_loaded', 'prrecipe_load_textdomain' );



// Shortcodes
add_shortcode( 'recipe_creator', 'prrecipe_recipe_creator_shortcode' );
add_shortcode( 'recipe_auth_form', 'prrecipe_recipe_auth_form_shortcode' );
add_shortcode( 'recipe_auth_alt_form', 'prrecipe_recipe_auth_alt_form_shortcode' );
add_shortcode( 'twitter_follow', 'prrecipe_twitter_follow_shortcode' );