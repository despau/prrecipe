<?php

function prrerecipe_activate_plugin(){

    if( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ){
        wp_die( __( "You ust update WordPress to use this plugin.", "prrecipe") );
    }


    recipe_init();
    flush_rewrite_rules(  );


    global $wpdb;
    $createSQL      =   "
    CREATE TABLE `" . $wpdb->prefix . "recipe_ratings` (
        `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `recipe_id` BIGINT(20) UNSIGNED NOT NULL,
        `rating` FLOAT(3,2) UNSIGNED NOT NULL,
        `user_ip` VARCHAR(50) NOT NULL,
        PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . ";";


    require( ABSPATH . "/wp-admin/includes/upgrade.php" );
    dbDelta( $createSQL );

    //setting transcient. worpdress will create this hook for us.
    wp_schedule_event( time(), 'daily', 'prrecipe_daily_recipe_hook',  );


}