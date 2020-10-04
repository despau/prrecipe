<?php

function prrerecipe_activate_plugin(){

    if( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ){
        wp_die( __( "You ust update WordPress to use this plugin.", "prrecipe") );
    }

    global $wpdb;


    $createSQL =   "CREATE TABLE `". $wpdb->prefix ." recipe_ratingss` (
            `ID` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `recipe_id` INT(20) UNSIGNED NOT NULL,
            `rating` FLOAT(3,2) UNSIGNED NOT NULL,
            `user_ip` VARCHAR(50) NOT NULL COLLATE,
            PRIMARY KEY (`ID`)
        )
        ". $wpdb->get_charset_collate() ."
        ENGINE=InnoDB
        ;
    ";


    require_once (ABSPATH . 'wp-admin/includes/upgrade.php' );

    dbDelta( $createSQL );

    //setting transcient. worpdress will create this hook for us.
    wp_schedule_event( time(), 'daily', 'prrecipe_daily_recipe_hook',  );


}